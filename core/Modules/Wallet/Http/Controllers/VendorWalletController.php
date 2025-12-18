<?php

namespace Modules\Wallet\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Wallet\Entities\Wallet;
use Modules\Order\Entities\SubOrder;
use Modules\Wallet\Entities\WalletHistory;
use Modules\Vendor\Http\Services\VendorServices;
use Modules\Wallet\Entities\VendorWithdrawRequest;
use Modules\Wallet\Entities\VendorWalletGatewaySetting;
use Modules\Wallet\Http\Requests\VendorHandleWithdrawRequest;

class VendorWalletController extends Controller
{
    public function index()
    {
        $data = VendorServices::vendorAccountBanner();

        return view("wallet::vendor.index", $data);
    }

    public function withdraw()
    {
        $wallet = Wallet::where("vendor_id", auth()->guard("vendor")->id())->first();

        $vendorWalletGatewaySettingLists = VendorWalletGatewaySetting::query()
            ->where(["vendor_id" => auth("vendor")->id()])
            ->with(['vendorWalletGateway'])
            ->get();

        $savedGateway = VendorWalletGatewaySetting::where(["vendor_id" => auth("vendor")->id()])->first();

        $wallet = Wallet::where("vendor_id", auth()->guard("vendor")->id())->first();

        // Calculate total complete order amount (delivered only)
        $total_complete_order_amount = (float) SubOrder::where("vendor_id", auth()->guard("vendor")->id())
            ->whereHas("orderTrack", function ($orderTrack) {
                $orderTrack->where("name", "delivered");
            })
            ->sum("total_amount");

        $total_order_amount = (float) ($total_complete_order_amount + ($wallet->pending_balance ?? 0));

        $data = [
            "total_order_amount" => $total_order_amount,
            "total_complete_order_amount" => $total_complete_order_amount,
            "pending_balance" => toFixed($wallet->pending_balance ?? 0, 0),
            "current_balance" => toFixed($wallet->balance ?? 0, 0),
            "vendorWalletGatewaySettingLists" => $vendorWalletGatewaySettingLists,
            "savedGateway"                => $savedGateway,
        ];

        return view("wallet::vendor.wallet-withdraw", $data);
    }

    public function withdrawRequestPage()
    {
        $withdrawRequests = VendorWithdrawRequest::with("gateway")
            ->where("vendor_id", auth("vendor")->id())
            ->whereHas("gateway")
            ->orderByDesc("id")
            ->get();

        return view("wallet::vendor.wallet-request", compact("withdrawRequests"));
    }

    public function handleWithdraw(VendorHandleWithdrawRequest $request)
    {
        DB::beginTransaction();

        try {

            $vendorId = auth('vendor')->id();
            $data     = $request->validated();

            $gatewaySetting = VendorWalletGatewaySetting::with('vendorWalletGateway')
                ->where('vendor_id', $vendorId)
                ->findOrFail($request->gateway_id);

            $data['vendor_id']      = $vendorId;
            $data['qr_file']        = $gatewaySetting->gateway_qr_file ? $gatewaySetting->gateway_qr_file : null;
            $data['gateway_fields'] = $gatewaySetting->fileds ? json_encode(unserialize($gatewaySetting->fileds)) : null;

            $wallet = Wallet::where('vendor_id', $vendorId)->lockForUpdate()->firstOrFail();

            if ($wallet->balance < $data['amount']) {
                return back()->with([
                    'message'    => 'Your requested amount is greater than your available balance',
                    'alert-type' => 'error',
                ]);
            }

            VendorWithdrawRequest::create($data);

            DB::commit();

            return back()->with([
                'message'    => 'Successfully sent your request',
                'alert-type' => 'success',
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();
            return back()->with([
                'message'    => 'Something went wrong. Please try again.',
                'alert-type' => 'error',
            ]);
        }
    }


    public function walletHistory()
    {
        $histories = WalletHistory::query()
            ->where("vendor_id", auth('vendor')->id())
            ->orderByDesc('id')
            ->get();

        return view("wallet::vendor.wallet-history", compact('histories'));
    }
}
