<?php

namespace Modules\DeliveryMan\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\DeliveryMan\Entities\DeliveryManWalletGateway;
use Modules\DeliveryMan\Entities\DeliveryManWalletGatewaySaved;
use Modules\DeliveryMan\Entities\DeliveryManWithdrawRequest;
use Modules\DeliveryMan\Http\Requests\DeliveryManHandleWithdrawRequest;
use Modules\DeliveryMan\Http\Resources\DeliveryManWithdrawRequestResource;
use Modules\Order\Entities\SubOrder;
use Modules\Vendor\Http\Resources\AdminWalletGatewayResource;
use Modules\Wallet\Entities\Wallet;

class DeliveryManWithdrawController extends Controller
{
    public function withdraw(){
        $wallet = Wallet::where("delivery_man_id", auth()->user()->id)->first();
        // first og all get all list of payment gateway that is created bu admin
        $adminGateways = DeliveryManWalletGateway::where("status_id",1)->get();
        $savedGateway = DeliveryManWalletGatewaySaved::where(["delivery_man_id" => auth()->user()->id])->first();

        if($savedGateway){
            $savedGateway->fields = $savedGateway?->fields ? unserialize($savedGateway?->fields) : null;
        }

        return [
            "total_order_amount" => (double) SubOrder::where("vendor_id", auth()->guard("sanctum")->id())->sum("total_amount"),
            "total_complete_order_amount" => (double) SubOrder::where("vendor_id", auth()->guard("sanctum")->id())->where("order_status", "complete")->whereHas("orderTrack", function ($orderTrack){
                $orderTrack->where("name", "delivered");
            })->sum("total_amount"),
            "pending_balance" => $wallet->pending_balance,
            "current_balance" => $wallet->balance,
            "adminGateways" => AdminWalletGatewayResource::collection($adminGateways),
            "savedGateway" => $savedGateway,
        ];
    }

    public function withdrawRequests(){
        $withdrawRequests = DeliveryManWithdrawRequest::with("gateway")
            ->where("delivery_man_id", auth()->user()->id)
            ->orderByDesc("id")->paginate(10);

        return DeliveryManWithdrawRequestResource::collection($withdrawRequests);
    }

    public function handleWithdraw(DeliveryManHandleWithdrawRequest $request){
        $data = $request->validated();
        $wallet = Wallet::where("delivery_man_id", $data["delivery_man_id"])->first();

        if($wallet->balance >= $data["amount"]){
            $withdraw = DeliveryManWithdrawRequest::create($data);

            return [
                "success" => (bool) $withdraw ?? false,
                "msg" => $withdraw ? "Successfully sent your request" : "Failed to send request"
            ];
        }

        return ["success" => false,"type" => "danger", "msg" => "Your requested amount is greater than your available balance"];
    }
}
