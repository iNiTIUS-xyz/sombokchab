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
                "gateway_name" => "required|exists:vendor_wallet_gateways,id",
                "gateway_filed" => "nullable|array",
                "gateway_qr_file" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
            ]);

            // Sanitize dynamic fields if present
            if ($request->filled('gateway_filed')) {
                foreach ($data['gateway_filed'] as $key => $value) {
                    $data['gateway_filed'][$key] = SanitizeInput::esc_html($value);
                }
            }

            $gatewayQrFile = null;
            if ($request->hasFile('gateway_qr_file')) {
                $file = $request->file('gateway_qr_file');
                $fileName = 'qr_' . time() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/vendor/qr';
                $file->move(public_path($path), $fileName);
                $gatewayQrFile = $path . '/' . $fileName;
            }

            VendorWalletGatewaySetting::query()->create([
                "vendor_id" => auth("vendor")->id(),
                "vendor_wallet_gateway_id" => $request->gateway_name,
                "wallet_option_name" => $request->wallet_option_name,
                "fileds" => $request->filled('gateway_filed') ? serialize($data['gateway_filed']) : null,
                "gateway_qr_file" => $gatewayQrFile, // Only set if uploaded, otherwise null (new record)
            ]);

            DB::commit();
            return back()->with([
                'message' => __('Successfully created withdraw option'),
                'alert-type' => 'success',
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with([
                'message' => __('Failed to create withdraw option: ') . $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->validate([
                "gateway_name" => "required|exists:vendor_wallet_gateways,id",
                "gateway_filed" => "nullable|array",
                "gateway_qr_file" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
            ]);

            $walletGatewaySetting = VendorWalletGatewaySetting::where('vendor_id', auth("vendor")->id())->findOrFail($id);

            // Sanitize dynamic fields if present
            if ($request->filled('gateway_filed')) {
                foreach ($data['gateway_filed'] as $key => $value) {
                    $data['gateway_filed'][$key] = SanitizeInput::esc_html($value);
                }
            }

            if ($request->hasFile('gateway_qr_file')) {
                // Delete old QR if exists
                if ($walletGatewaySetting->gateway_qr_file && file_exists(public_path($walletGatewaySetting->gateway_qr_file))) {
                    unlink(public_path($walletGatewaySetting->gateway_qr_file));
                }

                $file = $request->file('gateway_qr_file');
                $fileName = 'qr_' . time() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/vendor/qr';
                $file->move(public_path($path), $fileName);
                $walletGatewaySetting->gateway_qr_file = $path . '/' . $fileName;
            }
            // If no new file, do NOT touch gateway_qr_file → preserves existing

            $walletGatewaySetting->vendor_wallet_gateway_id = $request->gateway_name;
            $walletGatewaySetting->wallet_option_name = $request->wallet_option_name;
            $walletGatewaySetting->fileds = $request->filled('gateway_filed') ? serialize($data['gateway_filed']) : null;

            $walletGatewaySetting->save();

            DB::commit();
            return back()->with([
                'message' => __('Successfully updated withdraw option'),
                'alert-type' => 'success',
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with([
                'message' => __('Failed to update withdraw option: ') . $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $walletGatewaySetting = VendorWalletGatewaySetting::where('vendor_id', auth("vendor")->id())->findOrFail($id);

            if ($walletGatewaySetting->gateway_qr_file && file_exists(public_path($walletGatewaySetting->gateway_qr_file))) {
                unlink(public_path($walletGatewaySetting->gateway_qr_file));
            }

            $walletGatewaySetting->delete();
            DB::commit();
            return back()->with([
                'message' => __('Successfully deleted withdraw option'),
                'alert-type' => 'success',
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with([
                'message' => __('Failed to delete withdraw option'),
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
            'message' => __('Wallet gateway status changed successfully.'),
            'alert-type' => 'success',
        ]);
    }
}
