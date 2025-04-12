<?php

namespace Modules\DeliveryMan\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\DeliveryMan\Enums\DeliveryManStatusEnum;
use Modules\CountryManage\Entities\Country;
use Modules\DeliveryMan\Entities\DeliveryMan;
use Modules\DeliveryMan\Entities\DeliveryManOrder;
use Modules\DeliveryMan\Entities\DeliveryManZone;
use Modules\DeliveryMan\Http\Requests\AdminDeliveryManStatusChangeRequest;
use Modules\DeliveryMan\Http\Requests\StoreAdminDeliveryManRequest;
use Modules\DeliveryMan\Http\Requests\UpdateAdminDeliveryManRequest;
use Modules\DeliveryMan\Services\AdminDeliveryManServices;
use Modules\DeliveryMan\Services\DeliveryManServices;
use Throwable;

class AdminDeliveryManController extends Controller
{
    public function index(Request $request){
        $deliveryMans = AdminDeliveryManServices::getDeliveryMan($request);
        $statuses = array_column(DeliveryManStatusEnum::cases(), 'value');
        $deliveryZones = DeliveryManZone::select("name","id")->whereHas("deliveryMan")
            ->where("is_active", 1)->get();

        return view("deliveryman::admin.delivery-man.index",compact('statuses', 'deliveryMans', 'deliveryZones'));
    }

    public function ratings($deliveryManId): Factory|View|Application
    {
        // get delivery man information with deliveryman zone and if delivery man not found then show 404 page
        $deliveryMan = DeliveryManServices::ratings($deliveryManId);
        $paginationLimit = DeliveryManServices::paginationLimit;

        return view("deliveryman::admin.delivery-man.ratings", compact("deliveryMan","paginationLimit"));
    }

    public function details($deliveryMan): Factory|View|Application
    {
        $data = [
            "zones" => DeliveryManZone::where("is_active", 1)->get(),
            "deliveryManTypes" => deliveryManTypes(),
            "vehicleTypes" => vehicleTypes(),
            "identityTypes" => identityTypes(),
            "countries" => Country::select("id","name")->get(),
            "deliveryMan" => DeliveryMan::with("zone","credentials", "presentAddress", "permanentAddress")
                ->where("id", $deliveryMan)->first(),
        ];

        return view("deliveryman::admin.delivery-man.view", $data);
    }

    /**
     * @param int $deliveryMan
     * @return Application|Factory|View
     */
    final public function history(int $deliveryMan):Application|Factory|View
    {
        extract(DeliveryManServices::histories($deliveryMan));

        return view("deliveryman::admin.delivery-man.history", compact("deliveryMan","deliveryManOrders"));
    }

    public function trackSingleOrder($order_id, $delivery_man_id): JsonResponse
    {
        // check delivery man and order id if exist then go forward
        $order = DeliveryManOrder::with([
            "order",
            "order.address",
            "order.address.country",
            "order.address.state",
            "order.address.cityInfo",
            "orderTrack",
            "deliveryMan",
            "pickupPoint",
            "pickupPoint.country",
            "pickupPoint.state",
            "pickupPoint.city",
        ])->where("order_id", $order_id)->where("delivery_man_id", $delivery_man_id)->firstOr(function (){
            abort(403);
        });
        
        $orderTrack = $order->orderTrack->first();
        $pickupPoint = $order->pickupPoint;
        $deliveryManAddr = $order->deliveryMan?->presentAddress ?? "";

        $deliveryOrderAddress = DeliveryManServices::generateDeliveryOrderAddress($order);
        $pickupPointAddress = DeliveryManServices::generatePickupPointAddress($pickupPoint);
        $deliveryManAddress = DeliveryManServices::generateDeliveryManAddress($deliveryManAddr);

        $html = view("deliveryman::admin.tracking.details", compact("order","deliveryOrderAddress","pickupPointAddress","deliveryManAddress"))->render();

        return response()->json([
            "html" => $html,
            "from" => $pickupPointAddress,
            "to" => $deliveryOrderAddress,
            "latitude" => $order->deliveryMan?->latitude,
            "longitude" => $order->deliveryMan?->longitude,
        ]);
    }

    /**
     * @param int $deliveryManId
     * @return Application|View|Factory
     */
    final public function tracking(int $deliveryManId): Application|View|Factory
    {
        extract(DeliveryManServices::tracking($deliveryManId));

        return view("deliveryman::admin.tracking.index", compact("deliveryMan", "ordersList"));
    }

    /**
     * @return Application|View|Factory
     */
    final public function create():Application|View|Factory
    {
        $data = [
            "zones" => (new DeliveryManZone)->where("is_active", 1)->get(),
            "deliveryManTypes" => deliveryManTypes(),
            "vehicleTypes" => vehicleTypes(),
            "identityTypes" => identityTypes(),
            "countries" => Country::select("id","name")->get(),
        ];

        return view("deliveryman::admin.delivery-man.create", $data);
    }

    /**
     * @param StoreAdminDeliveryManRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(StoreAdminDeliveryManRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            // first we need to create delivery man
            $deliveryMan = (new AdminDeliveryManServices)->storeDeliveryMan($data);
            // store permanent address
            AdminDeliveryManServices::storePermanentAddress($deliveryMan['id'], $data);
            // store present address
            AdminDeliveryManServices::storePresentAddress($deliveryMan['id'], $data);
            // store delivery man credentials
            AdminDeliveryManServices::storeCredentials($deliveryMan['id'], $data);

            DB::commit();

            return back()->with([
                "type" => "success",
                "msg" => __("Successfully created delivery man."),
            ]);
        } catch (Throwable $e) {
            DB::rollBack();

            return back()->with([
                "type" => "danger",
                "msg" => __("Failed to create delivery man"),
            ]);
        }
    }

    /**
     * @throws Exception
     */
    public function update(UpdateAdminDeliveryManRequest $request,int $deliveryMan)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $oldDeliveryMan = DeliveryMan::with("zone","credentials","presentAddress","permanentAddress")->find($deliveryMan);

            // first we need to create delivery man
            $deliveryMan = AdminDeliveryManServices::updateDeliveryMan($data, $oldDeliveryMan);

            // store permanent address
            AdminDeliveryManServices::updatePermanentAddress($data, $oldDeliveryMan);
            // store present address
            AdminDeliveryManServices::updatePresentAddress($data, $oldDeliveryMan);
            // store delivery man credentials
            AdminDeliveryManServices::updateCredentials($data, $oldDeliveryMan, $oldDeliveryMan->id);

            DB::commit();

            return redirect()->route("admin.delivery-man.index")->with([
                "type" => "success",
                "msg" => __("Successfully updated delivery man."),
            ]);
        } catch (Throwable $e) {
            DB::rollBack();

            return back()->with([
                "type" => "danger",
                "msg" => __("Failed to create delivery man"),
            ]);
        }
    }

    public function changeStatus(AdminDeliveryManStatusChangeRequest $request){
        $request = $request->validated();

        $status = DeliveryMan::where("id", $request["id"])->update([
            "status" => $request['status']
        ]);

        return back()->with([
            "msg" => $status ? __("Successfully updated delivery status") : __("Failed to update status"),
            "type" => $status ? "success" : "danger"
        ]);
    }

    public function edit($deliveryMan){
        $data = [
            "zones" => DeliveryManZone::where("is_active", 1)->get(),
            "deliveryManTypes" => deliveryManTypes(),
            "vehicleTypes" => vehicleTypes(),
            "identityTypes" => identityTypes(),
            "countries" => Country::select("id","name")->get(),
            "deliveryMan" => DeliveryMan::with("zone","credentials", "presentAddress", "permanentAddress")
                ->where("id", $deliveryMan)->first(),
        ];

        return view("deliveryman::admin.delivery-man.edit", $data);
    }

    public function destroy(DeliveryMan $deliveryMan){

    }

    public function search(Request $request){
        // here we will search and paginate
        $deliveryMans = AdminDeliveryManServices::getDeliveryMan($request);

        return view("deliveryman::components.delivery-result", compact('deliveryMans'))->render();
    }
}
