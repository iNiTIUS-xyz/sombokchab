<?php

namespace Modules\Wallet\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Order\Entities\SubOrder;
use Modules\Vendor\Http\Services\VendorServices;
use Modules\Wallet\Entities\VendorWalletGateway;
use Modules\Wallet\Entities\VendorWalletGatewaySetting;
use Modules\Wallet\Entities\VendorWithdrawRequest;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Entities\WalletHistory;
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
        // first og all get all list of payment gateway that is created bu admin
        $adminGateways = VendorWalletGateway::where("status_id", 1)->get();
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
            "adminGateways"               => $adminGateways,
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

        $qrFileName = null;

        if ($request->hasFile('qr_file')) {
            if (!file_exists(public_path('uploads/refund-qr'))) {
                mkdir(public_path('uploads/refund-qr'), 0777, true);
            }

            $filename = time() . rand(1111, 9999) . '.' . $request->qr_file->getClientOriginalExtension();
            $request->qr_file->move(public_path('uploads/refund-qr'), $filename);
            $qrFileName = 'uploads/refund-qr/' . $filename;
        }

        $data = $request->validated();

        $data['qr_file'] = $qrFileName;
        $data['gateway_fields'] = $qrFileName ? null : $data['gateway_fields'];

        $wallet = Wallet::where("vendor_id", $data["vendor_id"])->first();

        if ($wallet->balance >= $data["amount"]) {

            $withdraw = VendorWithdrawRequest::create($data);

            return back()->with([
                'message'    => $withdraw ? 'Successfully sent your request' : 'Failed to send request',
                'alert-type' => $withdraw ? 'success' : 'error',
            ]);
        }

        return back()->with([
            'message'    => 'Your requested amount is greater than your available balance',
            'alert-type' => 'error',
        ]);
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
