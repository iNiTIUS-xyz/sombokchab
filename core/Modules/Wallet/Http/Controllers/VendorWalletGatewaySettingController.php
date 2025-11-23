<?php

namespace Modules\Wallet\Http\Controllers;

use App\Helpers\SanitizeInput;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Wallet\Entities\VendorWalletGateway;
use Modules\Wallet\Entities\VendorWalletGatewaySetting;

class VendorWalletGatewaySettingController extends Controller {
    public function index() {
        // first og all get all list of payment gateway that is created bu admin
        $adminGateways = VendorWalletGateway::where("status_id", 1)->get();
        $savedGateway = VendorWalletGatewaySetting::where(["vendor_id" => auth("vendor")->id()])->first();

        return view("wallet::vendor.withdraw-gateway-settings", ["adminGateways" => $adminGateways, "savedGateway" => $savedGateway]);
    }

    public function update(Request $request) {
        $data = $request->validate([
            "gateway_name"    => "required",
            "gateway_filed"   => "sometimes|array",
            "gateway_filed.*" => "sometimes|string",
        ]);

        foreach ($data['gateway_filed'] as $key => $value) {
            $data['gateway_filed'][$key] = SanitizeInput::esc_html($value);
        }

        $walletGatewaySettings = VendorWalletGatewaySetting::updateOrCreate([
            "vendor_id" => auth("vendor")->id(),
        ], [
            "vendor_id"                => auth("vendor")->id(),
            "vendor_wallet_gateway_id" => $data["gateway_name"],
            "fileds"                   => serialize($data['gateway_filed']),
        ]);

        return back()->with([
            'message'    => $walletGatewaySettings
            ? __('Successfully updated wallet settings')
            : __('Failed to update wallet settings'),

            'alert-type' => $walletGatewaySettings ? 'success' : 'error',
        ]);

    }

    public function statusChange(Request $request, $id) {
        VendorWalletGateway::where('id', $id)->update([
            'status_id' => $request->status,
        ]);

        return redirect()->back()->with([
            'message'    => __('Wallet gateway status changed successfully.'),
            'alert-type' => 'success',
        ]);

    }
}
