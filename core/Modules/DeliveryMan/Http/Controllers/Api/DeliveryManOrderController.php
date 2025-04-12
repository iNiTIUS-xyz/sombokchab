<?php

namespace Modules\DeliveryMan\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\DeliveryMan\Entities\DeliveryManOrder;
use Modules\Order\Services\OrderServices;
use Modules\Wallet\Http\Services\WalletService;

class DeliveryManOrderController extends Controller {
    /**
     * @throws Exception
     */
    public function changeOrderStatus(Request $request){
        // this method will change order status of given status
        $orderTrack = $request->validate([
            "order_id" => "required",
            "order_track" => "required",
            "order_track.*" => "required"
        ]);

        // get order information
        $orderInformation = DeliveryManOrder::where("order_id", $orderTrack['order_id'])
            ->with(["orderPaymentMeta","orderTrack" => function ($query){
                $query->latest('id')->limit(1);
            }])
            ->where("delivery_man_id", auth()->user()->id)
            ->whereHas("orderTrack")
            ->firstOrFail();

        // now check this order status if this order is already delivered then throw exception
        $dbOrderTrack = $orderInformation->orderTrack->first();

        if($dbOrderTrack->name == 'delivered'){
            return response()->json([
                "msg" => __("This order is already delivered, you can't change this order status further.")
            ], 403);
        }

        foreach($orderTrack["order_track"] as $track){
            if($track == 'delivered'){
                //todo:: add order amount from pending balance to main balance
                WalletService::completeOrderAmount($orderTrack["order_id"]);
                //todo:: add wallet history that mean's transaction history
                // now update delivery man wallet balance if order have delivery commission fee

                $deliveryManCommission = $orderInformation->commission_amount;
                // make delivery man amount
                if ($orderInformation->commission_type == 'percentage'){
                    $deliveryManCommission = calculatePercentageAmount($orderInformation->orderPaymentMeta->sub_total, $orderInformation->commission_amount);
                }

                WalletService::updateDeliveryManWallet(auth()->user()->id,$deliveryManCommission,column: 'balance', order_id: $orderTrack["order_id"]);
            }

            // store order tracking row
            OrderServices::storeOrderTrack($orderTrack["order_id"],$track, auth()->user()->id, 'delivery_man');
        }

        return response()->json([
            "type" => "success",
            "msg" => __("Order track updated successfully.")
        ]);
    }
}
