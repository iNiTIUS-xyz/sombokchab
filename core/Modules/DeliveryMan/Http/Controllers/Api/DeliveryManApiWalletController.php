<?php

namespace Modules\DeliveryMan\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use LaravelIdea\Helper\Modules\Wallet\Entities\_IH_Wallet_C;
use Modules\DeliveryMan\Entities\DeliveryManWalletGateway;
use Modules\DeliveryMan\Entities\DeliveryManWalletGatewaySaved;
use Modules\DeliveryMan\Entities\DeliveryManWithdrawRequest;
use Modules\DeliveryMan\Http\Resources\AdminDeliveryManGatewayResource;
use Modules\DeliveryMan\Services\DeliveryManServices;
use Modules\DeliveryMan\Transformers\DeliveryManWalletGatewaysResource;
use Modules\Wallet\Entities\VendorWalletGatewaySetting;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Entities\WalletHistory;
use Modules\Wallet\Http\Services\WalletService;
use Modules\Wallet\WalletDeliveryManHistory;

class DeliveryManApiWalletController extends Controller
{
    public function walletGatewayList(): JsonResponse
    {
        // when call this method client side should get a payment gateway list that are created by admin
        $walletGateways = DeliveryManWalletGateway::all();
        // get saved gateway
        $savedGateway = DeliveryManWalletGatewaySaved::where(["delivery_man_id" => auth()->user()->id])->first();

        // save gateway
        if($savedGateway){
            $savedGateway->fields = $savedGateway?->fields ? unserialize($savedGateway?->fields) : null;
        }

        return response()->json([
            "wallet_gateways" => AdminDeliveryManGatewayResource::collection($walletGateways),
            "saved_gateway" => $savedGateway
        ]);
    }

    public function walletHistory(): JsonResponse
    {
        $wallet = Wallet::where('delivery_man_id', auth()->user()->id)->first();

        // check wallet is empty or not if empty that mean's wallet doesn't exist on database
        if(empty($wallet)){
            // now create new wallet row in database
            $wallet = WalletService::createWallet(auth()->user()->id, 'delivery_man');
        }

        // this line will fetch and paginate all available wallet history have in the wallet_delivery_man_histories table
        $histories = WalletDeliveryManHistory::where('wallet_id', $wallet->id)->latest()->paginate(10);

        return response()->json([
            "histories" => $histories
        ]);
    }

    public function walletInfo(Request $request): JsonResponse
    {
        $wallet = Wallet::where("delivery_man_id",auth()->user()->id)->first();
        // check delivery man have wallet or not
        if(empty($wallet)){
            // this wallet is empty now create new wallet for delivery man
            $wallet = WalletService::createWallet(auth()->user()->id, "delivery_man_id");
        }

        // get total withdraw amount
        $totalWithdraw = DeliveryManWithdrawRequest::where("request_status","completed")
            ->sum("amount");
        $todayWithdraw = DeliveryManWithdrawRequest::where("request_status","completed")
            ->whereDate("created_at", now()->format('Y-m-d'))->sum("amount");

        return response()->json(["wallet" => $wallet, "today_withdraw" => toFixed($todayWithdraw), "total_withdraw" => toFixed($totalWithdraw)]);
    }

    public function saveWalletGateway(Request $request){
        $data = $request->validate([
            "selected_gateway_id" => "required",
            "gateway_fields" => "required|array",
            "gateway_fields.*" => "sometimes"
        ]);

        $walletGatewaySettings = DeliveryManWalletGatewaySaved::updateOrCreate([
            "delivery_man_id" => auth()->user()->id
        ],[
            "delivery_man_id" => auth()->user()->id,
            "delivery_man_gateway_id" => $data["selected_gateway_id"],
            "fields" => serialize($data['gateway_fields'])
        ]);

        return [
            "success" => (bool) $walletGatewaySettings ?? false ,
            "msg" => $walletGatewaySettings ? __("Successfully updated wallet settings") : __("Failed to update wallet settings")
        ];
    }
}
