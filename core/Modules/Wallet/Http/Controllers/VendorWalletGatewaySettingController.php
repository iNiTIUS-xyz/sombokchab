<?php

namespace Modules\Wallet\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SanitizeInput;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Wallet\Entities\VendorWalletGateway;
use Modules\Wallet\Entities\VendorWalletGatewaySetting;

class VendorWalletGatewaySettingController extends Controller
{
    public function index()
    {
        $adminGateways = VendorWalletGateway::query()
            ->where("status_id", 1)
            ->get();
        $vendorWalletGatewaySettingLists = VendorWalletGatewaySetting::query()
            ->where(["vendor_id" => auth("vendor")->id()])
            ->with(['vendorWalletGateway'])
            ->get();

        return view("wallet::vendor.withdraw-gateway-settings", compact('vendorWalletGatewaySettingLists', 'adminGateways'));
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validate([
                "gateway_name"    => "nullable",
                "gateway_filed"   => "nullable|array",
                "gateway_filed.*" => "nullable|string",
                "gateway_qr_file" => "nullable",
            ]);

            if (isset($data['gateway_filed'])) {
                foreach ($data['gateway_filed'] as $key => $value) {
                    $data['gateway_filed'][$key] = SanitizeInput::esc_html($value);
                }
            }

            $gatewayQrFile = null;

            if ($request->hasFile('gateway_qr_file')) {

                if ($gatewayQrFile && file_exists(public_path($gatewayQrFile))) {
                    unlink(public_path($gatewayQrFile));
                }

                $file = $request->file('gateway_qr_file');
                $fileName = 'qr_' . time() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/vendor/qr';

                $file->move(public_path($path), $fileName);
                $gatewayQrFile = $path . '/' . $fileName;
            }

            VendorWalletGatewaySetting::query()
                ->create([
                    "vendor_id" => auth("vendor")->id(),
                    "vendor_wallet_gateway_id" => $request->gateway_name,
                    "vendor_id"                => auth("vendor")->id(),
                    "fileds"                   => isset($data['gateway_filed']) ? serialize($data['gateway_filed']) : null,
                    "gateway_qr_file"          => $gatewayQrFile,
                ]);

            DB::commit();

            return back()->with([
                'message' => __('Successfully updated wallet settings'),
                'alert-type' => 'success',
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with([
                'message' =>  __('Failed to update wallet settings'),
                'alert-type' => 'error',
            ]);
        }
    }

    public function statusChange(Request $request, $id)
    {
        VendorWalletGateway::where('id', $id)->update([
            'status_id' => $request->status,
        ]);

        return redirect()->back()->with([
            'message'    => __('Wallet gateway status changed successfully.'),
            'alert-type' => 'success',
        ]);
    }
}
