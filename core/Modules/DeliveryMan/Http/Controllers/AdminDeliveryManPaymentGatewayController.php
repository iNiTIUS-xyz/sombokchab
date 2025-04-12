<?php

namespace Modules\DeliveryMan\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\DeliveryMan\Entities\DeliveryManWalletGateway;
use Modules\Wallet\Entities\DeliveryManWalletGatewaySetting;
use Modules\Wallet\Http\Requests\StoreGatewayRequest;

class AdminDeliveryManPaymentGatewayController extends Controller
{

    public function gateway()
    {
        $gateways  = DeliveryManWalletGateway::with("status")->get();

        return view("deliveryman::admin.gateway.gateway", compact("gateways"));
    }

    public function storeGateway(StoreGatewayRequest $request){
        $data = $request->validated();
        $data['fields'] = $data['filed'];
        unset($data["filed"]);


        $data = DeliveryManWalletGateway::create($data);

        return back()->with(["status" => (bool)$data, "type" => $data ? "success" : "danger", "msg" => $data ? __("Payment Gateway created successfully.") : __("Failed to create payment gateway try again.")]);
    }


    public function updateGateway(StoreGatewayRequest $request){
        $data = $request->validated();
        $data['fields'] = $data['filed'];

        $id = $data["id"];
        unset($data["id"]);
        unset($data["filed"]);

        $data = DeliveryManWalletGateway::where("id", $id)->update($data);

        return back()->with(["status" => (bool)$data, "type" => $data ? "success" : "danger", "msg" => $data ? __("Payment Gateway updated successfully.") : __("Failed to update payment gateway try again.")]);
    }
    public function deleteGateway($id){
        return DeliveryManWalletGateway::where("id", $id)->delete() ? "ok" : "false";
    }
}
