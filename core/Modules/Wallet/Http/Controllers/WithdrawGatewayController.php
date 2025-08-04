<?php

namespace Modules\Wallet\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Wallet\Entities\VendorWalletGateway;
use Modules\Wallet\Http\Requests\StoreGatewayRequest;
use App\Helpers\SanitizeInput;

class WithdrawGatewayController extends Controller
{
    public function gateway()
    {
        $gateways  = VendorWalletGateway::with("status")->get();

        return view("wallet::backend.withdraw.gateway", compact("gateways"));
    }

    public function storeGateway(StoreGatewayRequest $request)
    {

        $fields = [];

        foreach ($request->filed ?? [] as $key => $value) {
            $fields[$key] = SanitizeInput::esc_html($value);
        }

        $data = new VendorWalletGateway();
        $data->name = $request->gateway_name;
        $data->filed = isset($request->is_file) &&  $request->is_file == 'yes' ? null : serialize($fields);
        $data->status_id = $request->status_id;
        $data->is_file = isset($request->is_file) ? $request->is_file : 'no';
        $data->save();

        return back()->with(["status" => (bool)$data, "type" => $data ? "success" : "danger", "msg" => $data ? __("Payment Gateway created successfully.") : __("Failed to create payment gateway try again.")]);
    }


    public function updateGateway(StoreGatewayRequest $request)
    {

        $fields = [];

        foreach ($request->filed ?? [] as $key => $value) {
            $fields[$key] = SanitizeInput::esc_html($value);
        }

        $data =  VendorWalletGateway::query()
            ->findOrFail($request->id);
        $data->name = $request->gateway_name;
        $data->filed = isset($request->is_file) &&  $request->is_file == 'yes' ? null : serialize($fields);
        $data->status_id = $request->status_id;
        $data->is_file = isset($request->is_file) ? $request->is_file : 'no';
        $data->save();

        return back()->with(["status" => (bool)$data, "type" => $data ? "success" : "danger", "msg" => $data ? __("Payment Gateway updated successfully.") : __("Failed to update payment gateway try again.")]);
    }
    public function deleteGateway($id)
    {
        return VendorWalletGateway::where("id", $id)->delete() ? "ok" : "false";
    }

    public function statusChange(Request $request, $id)
    {
        VendorWalletGateway::where('id', $id)->update([
            'status_id' => $request->status,
        ]);

        return redirect()->back()->with([
            'msg' => __('Wallet gateway status changed successfully.'),
            'type' => 'success'
        ]);
    }
}
