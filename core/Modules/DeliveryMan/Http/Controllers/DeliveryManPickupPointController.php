<?php

namespace Modules\DeliveryMan\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Modules\CountryManage\Entities\City;
    use Modules\CountryManage\Entities\Country;
    use Modules\CountryManage\Entities\State;
    use Modules\DeliveryMan\Entities\DeliveryManPickupPoint;
    use Modules\DeliveryMan\Entities\DeliveryManZone;
    use Modules\DeliveryMan\Http\Requests\DeliveryManPickupPointRequest;
    use Modules\Vendor\Entities\Vendor;

    class DeliveryManPickupPointController extends Controller
    {
        public function index()
        {
            // render pickup point list with
            $pickupPoints = DeliveryManPickupPoint::with("zone", "vendor","country","state","city")->paginate(20);

            return view("deliveryman::admin.pickup-point.index", compact('pickupPoints'));
        }

        public function create(){
            $data = [
                "deliveryZones" => DeliveryManZone::select("id","name")->where("is_active", 1)->get(),
                "vendors" => Vendor::select("id","owner_name","business_name","email","username")->get(),
                "countries" => Country::select("id","name")->get()
            ];

            return view("deliveryman::admin.pickup-point.create", $data);
        }

        public function store(DeliveryManPickupPointRequest $request)
        {
            $pickupPoint = DeliveryManPickupPoint::create($request->validated());

            return back()->with([
                "msg" => $pickupPoint ? __("Successfully created pickup point") : __("Failed to create pickup point"),
                "type" => $pickupPoint ? "success" : "danger"
            ]);
        }

        public function edit(DeliveryManPickupPoint $deliveryManPickupPoint, $id)
        {
            $deliveryManPickupPoint = $deliveryManPickupPoint->with("country.states","state.cities")->find($id);

            $data = [
                "deliveryZones" => DeliveryManZone::select("id","name")->where("is_active", 1)->get(),
                "vendors" => Vendor::select("id","owner_name","business_name","email","username")->get(),
                "countries" => Country::select("id","name")->get(),
                "pickupPoint" => $deliveryManPickupPoint,
                "states" => $deliveryManPickupPoint->country?->states ?? [],
                "cities" => $deliveryManPickupPoint->state?->cities ?? [],
            ];

            return view("deliveryman::admin.pickup-point.edit", $data);
        }

        public function update(DeliveryManPickupPointRequest $request, DeliveryManPickupPoint $deliveryManPickupPoint,$id)
        {
            $deliveryManPickupPoint = $deliveryManPickupPoint->find($id);
            $deliveryManPickupPoint->update($request->validated());

            return back()->with([
                "msg" => $deliveryManPickupPoint ? __("Successfully updated pickup point") : __("Failed to update pickup point"),
                "type" => $deliveryManPickupPoint ? "success" : "danger"
            ]);
        }

        public function destroy(DeliveryManPickupPoint $deliveryManPickupPoint, $id)
        {
            $deliveryManPickupPoint = $deliveryManPickupPoint->find($id)->delete();

            return back()->with([
                "msg" => $deliveryManPickupPoint ? __("Successfully deleted pickup point") : __("Failed to delete pickup point"),
                "type" => $deliveryManPickupPoint ? "success" : "danger"
            ]);
        }
    }
