<?php

namespace Modules\DeliveryMan\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Modules\DeliveryMan\Entities\DeliveryMan;
use Modules\DeliveryMan\Entities\DeliveryManOrder;
use Modules\DeliveryMan\Entities\DeliveryManPickupPoint;
use Modules\DeliveryMan\Entities\DeliveryManZone;
use Modules\DeliveryMan\Events\AssignDeliveryManEmail;
use Modules\DeliveryMan\Http\Requests\HandleAssignDeliveryManRequest;
use Modules\DeliveryMan\Services\GoogleMapServices;
use Modules\Order\Entities\Order;
use Modules\Order\Services\OrderServices;
use Modules\Wallet\Http\Services\WalletService;

class AssignDeliveryManController extends Controller
{
    public function orders()
    {
        // first of all we need to get all sub order for login user
        $all_orders = Order::with("paymentMeta")
            ->whereHas("orderTrack", function ($query){
                $query->whereNot("name", "assigned_delivery_man")->whereNot("name", "delivered");
            })
            ->orderByDesc("id")->paginate(20);

        return view("deliveryman::admin.assign-delivery-man.index", compact("all_orders"));
    }

    public function assign($order_id, Request $request){
        // get order details
        $order = $this->orderDetailsMethod($order_id);
        // get delivery man zone
        $all_zones = DeliveryManZone::select("id","name")->get();
        $deliveryMans = DeliveryManZone::query()->select("id","name");

        // check auto suggestion delivery man is on or not if enable then get send request to google map for getting suggestion for delivery man
        if(get_static_option("auto_suggestion_delivery_man") == 'on'){
            $address = $this->generateOrderAddress($order->address?->country?->name ?? "",$order->address?->state?->name ?? "",$order->address?->cityInfo?->name ?? "", ($order?->address?->address_one ?? '' ) . ' , ' . ($order?->address?->address_two ?? '' ));//"Dhaka, Dhaka, Bangladesh, 24727";

            // this service will give you latitude and longitude
            $location = GoogleMapServices::geocodeAddress($address);
            $long  = $location['long'];
            $lat  = $location['lat'];

            $zones = $deliveryMans->whereRaw("St_Contains(coordinates, POINT(?,?))",[$long,$lat])->get();
        }else{
            $zones = $deliveryMans->get();
        }

        // where is the query then will return all delivery man those zone are found
        $deliveryMans = $this->searchDeliveryMan($request)
            ->whereIn("id", $zones->pluck("id")?->toArray())->get();

        return view("deliveryman::admin.assign-delivery-man.assign", compact('request','zones', 'all_zones', 'deliveryMans', 'order'));
    }

    private function generateOrderAddress($country = "", $state = "", $city = "", $address = ""){
        $address = "";
        $address .= $country ?? "";
        $address .= (strlen($address) > 0 ? " , " : "") . $state ?? "";
        $address .= (strlen($address) > 0 ? " , " : "") . $city ?? "";
        $address .= (strlen($address) > 0 ? " , " : "") . $address ?? "";

        return $address;
    }

    public function handleAssign(HandleAssignDeliveryManRequest $request, $order_id){
        // request validation and store it into data variable
        $data = $request->validated();
        // first thing first is to check order that is not defined delivery man before
        $order = Order::where("id", $order_id)->with(
                "paymentMeta", "address","deliveryMan",
                "orderItems", "orderItems.variant.productColor",
                "orderItems.variant.productSize", "orderItems.variant.attribute",
                "orderItems.variant","orderItems.product:id,name"
            )
            // this whereHas will check is orderTrack is ordered and not delivered
            ->whereHas("orderTrack", function ($tractQuery){
                $tractQuery->whereNot("name","delivered");
                $tractQuery->where("name","ordered");
            })
            // count deliveryMan
            ->withCount("deliveryMan")->first();


        // update wallet amount for this delivery man add amount into pending balance
        $commission_amount = $data['commission_amount'];
        if($data["commission_type"] == 'percentage'){
            // get sub total from order payment meta data
            $commission_amount = $order->paymentMeta?->sub_total * $data['commission_amount'] / 100;
        }

        // if this order doesn't have assigned delivery man then assign and if have then send error response to the client side
        if($order->delivery_man_count > 0){
            $order_commission_amount = $data['commission_amount'];
            if($order?->deliveryMan?->commission_type == 'percentage'){
                // get sub total from order payment meta data
                $order_commission_amount = $order->paymentMeta?->sub_total * $order?->deliveryMan?->commission_amount / 100;
            }

            // delete old delivery_man_order for for assign new delivery man
            WalletService::updateDeliveryManWallet($order?->deliveryMan?->delivery_man_id, $order_commission_amount, false,'pending_balance', $order->id,$order->transaction_id);
            DeliveryManOrder::where("order_id", $order_id)->delete();
        }

        // check delivery man type if delivery man type is not employee then allow those field for delivery_man_orders table
        // fields name, commission_type, commission_amount
        $deliveryMan = DeliveryMan::where("id", $data["delivery_man"])->first();
        $message = "";
        // check delivery man is exist then check delivery man type
        if(empty($deliveryMan)){
            $message = __("Successfully changed delivery man and re assigned");
        }else{
            // check delivery man is active or not if not then send error response
            if($deliveryMan->status != 'active'){
                return back()->with([
                    "type" => "danger",
                    "msg" => "You can't assign delivery man cause the selected delivery man status is " . ($deliveryMan->status ?? "not active")
                ]);
            }

            // check delivery man is not employee then update request data if they are not null
            if($deliveryMan->delivery_man_type == 'employee'){
                $data["commission_type"] = null;
                $data["commission_amount"] = null;
            }
        }

        // when assign delivery man for a order then update order order track assigned delivery man
        // prepare delivery man order data
        // now assign delivery man

        $deliveryManOrder = DeliveryManOrder::create([
            "order_id" => $order_id,
            "delivery_man_id" => $data["delivery_man"],
            "pickup_point_id" => $data["pickup_point_id"],
            "delivery_date" => Carbon::parse($data["date"]),
            "commission_type" => $data["commission_type"] ?? null,
            "commission_amount" => $data["commission_amount"] ?? null,
            "payment_type" => $order->payment_status == 'complete' ? __("Paid") : __("Due"),
            "total_amount" => $order?->paymentMeta?->total_amount,
            "created_by" => auth()->user()->id,
            "updated_by" => auth()->user()->id,
            "created_by_type" => "admin",
            "updated_by_type" => "admin"
        ]);

        // update order tracking status
        OrderServices::storeOrderTrack($order_id,"assigned_delivery_man", auth()->user()->id, 'admin');

        WalletService::updateDeliveryManWallet($deliveryMan->id,$commission_amount, true,'pending_balance', $order->id,$order->transaction_id);

        // now send email to delivery man
        event(new AssignDeliveryManEmail(["deliveryMan" => $deliveryMan, "order" => $order,"pickupPoint" => $data["pickup_point_id"],"deliveryManOrder" => $deliveryManOrder]));

        // now send response from here
        return back()->with([
            "type" => $deliveryManOrder ? "success" : "error",
            "msg" => $deliveryManOrder ? __(!empty($message) ? $message : "Successfully assigned delivery man") : __("Failed to assign delivery man")
        ]);
    }

    private function orderDetailsMethod($orderId){
        // fetch order where requested id is exist
        // get order with suborders , paymentMeta, address and orderTrack
        return Order::where("id", $orderId)->with(["SubOrders" => function ($subOrderQuery){
            $subOrderQuery->with([
                    "order",
                    "vendor" => function ($vendorQuery){
                        $vendorQuery->withCount(["order as total_order" => function ($order){
                            $order->orderByDesc("orders.id");
                        },"order as complete_order" => function ($order){
                            $order->where("orders.order_status", "complete");
                        },"order as pending_order" => function ($order){
                            $order->where("orders.order_status", "pending");
                        },"product"])->withSum("subOrder as total_earning","sub_orders.total_amount");
                    },
                    "vendor.logo",
                    "order.paymentMeta",
                    "order.address",
                    "order.address.country",
                    "order.address.state",
                    "order.address.cityInfo",
                    "order.orderTrack",
                    "orderItem",
                    "productVariant.productColor",
                    "productVariant.productSize",
                    "productVariant",
                    "product",
                ])->withCount("orderItem");
            },"paymentMeta", "address",
            "address.country",
            "address.state",
            "address.cityInfo", "orderTrack",
            "deliveryMan.pickupPoint",
            "deliveryMan.deliveryMan.zone:id,name","deliveryMan.deliveryMan.permanentAddress",
            "deliveryMan.deliveryMan.presentAddress",
        ])->withCount("orderItems","deliveryMan")->first();
    }

    public function deliveryManDetails(int $deliveryManId){
        // first need to details of this delivery man
        $deliveryMan = DeliveryMan::with("credentials:id,delivery_man_id,identity_type","zone","presentAddress","presentAddress.country","presentAddress.state","presentAddress.city","permanentAddress","permanentAddress.country","permanentAddress.state","permanentAddress.city")
            ->withCount(["deliveryManOrder" => function ($query){
                $query->whereHas("order.orderTrack", function ($od_query){
                    $od_query->where("name","=", "delivered");
                });
            },"deliveryManOrder as delivery_man_queue_order_count" => function ($query){
                $query->whereHas("order.orderTrack", function ($od_query){
                    $od_query->where("name","!=", "delivered");
                });
            }])
            ->find($deliveryManId);

        $deliveryManPickupPoints = DeliveryManPickupPoint::where("zone_id", $deliveryMan->zone_id)->get();

        $html = view("deliveryman::admin.assign-delivery-man.delivery-man-details", compact("deliveryMan"))->render();
        $fields = view("deliveryman::admin.assign-delivery-man.commission-fields", compact("deliveryMan","deliveryManPickupPoints"))->render();

        return response()->json([
            "html" => $html,
            "fields" => $fields
        ]);
    }

    public function findDeliveryMan(Request $request){
        // find delivery man
        $deliveryMan = DeliveryMan::where("zone_id", $request->zone_id ?? '')->get();

        return view("deliveryman::admin.find-delivery-man.index", compact("deliveryMan"));
    }

    public function deliveryManSearch(Request $request){
        $deliveryMans = $this->searchDeliveryMan($request)->get();

        return view("deliveryman::admin.assign-delivery-man.delivery-man-result", compact("deliveryMans"))->render();
    }

    private function searchDeliveryMan($request) {
        $data = $request->validate([
            "name" => "nullable",
            "email" => "nullable|email",
            "zone_id" => "nullable",
            "number" => "nullable",
        ]);

        return DeliveryMan::with("zone")
            ->withCount(["deliveryManOrder" => function ($query){
                $query->whereHas("order.orderTrack", function ($od_query){
                    $od_query->where("name","=", "delivered");
                });
            },"deliveryManOrder as delivery_man_queue_order_count" => function ($query){
                $query->whereHas("order.orderTrack", function ($od_query){
                    $od_query->where("name","!=", "delivered");
                });
            }])
            ->when($request->has("name") && !empty($data['name']), function ($query) use ($data){
                $searchTerms = explode(' ', trim(strip_tags($data['name'])));

                foreach ($searchTerms as $term) {
                    $query->where(function ($subQuery) use ($term) {
                        $subQuery->where('first_name', 'LIKE', "%$term%")
                            ->orWhere('last_name', 'LIKE', "%$term%");
                    });
                }

                return $query;
            })
            ->when($request->has("email") && !empty($data['email']), function ($query) use ($data) {
                $query->where("email", $data["email"]);
            })
            ->when($request->has("zone_id") && !empty($data['zone_id']), function ($query) use ($data) {
                $query->where("zone_id", $data["zone_id"]);
            })
            ->when($request->has("number") && !empty($data['number']), function ($query) use ($data) {
                $query->where("phone", $data["number"]);
            })->where("status", "active");
    }
}
