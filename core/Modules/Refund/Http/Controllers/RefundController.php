<?php

namespace Modules\Refund\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Refund\Entities\RefundDeductedAmount;
use Modules\Refund\Entities\RefundRequest;
use Modules\Refund\Entities\RefundTrackStatusReason;
use Modules\Refund\Http\Services\RefundMailServices;
use Modules\Refund\Http\Services\RefundTransaction;
use Modules\Refund\Http\Traits\RefundRequestData;
use Modules\Wallet\Http\Services\WalletService;

class RefundController extends Controller {
    use RefundRequestData;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index() {
        $refundRequests = RefundRequest::withCount("requestProduct")
            ->with("currentTrackStatus", "user:id,name,email,phone", "order:id,order_number,order_status,created_at", "order.paymentMeta")
            ->paginate(20);

        return view('refund::admin.refund.request', compact('refundRequests'));
    }

    public function viewRequest($id) {
        // fetch all information about this request
        $request = RefundRequest::query()
            ->with([
                "currentTrackStatus",
                "preferredOption",
                "products",
                "user",
                "order" => function ($query) {
                    $query->withCount("orderItems");
                },
                "order.paymentMeta",
                "requestFile",
                "requestTrack",
                "requestProduct",
                "productVariant",
                "productVariant.productColor",
                "productVariant.productSize",
            ])
            ->findOrFail($id);

        return view("refund::admin.refund.request-view", compact('request'));
    }

    public function updateTrackStatus($id, Request $request) {
        $data = $request->validate([
            "track_status"             => "required|string",
            "reason"                   => "nullable|array",
            "reason.*"                 => "nullable|string",
            "deducted_amount_reason"   => "nullable|array",
            "deducted_amount_reason.*" => "nullable|string",
            "deducted_amount"          => "nullable|array",
            "deducted_amount.*"        => "nullable",
            "refund_fee"               => "nullable",
        ]);

        $mailableData = [];
        $id = (int) $id;
        $refundRequest = RefundRequest::with("preferredOption")->find($id);

        // now store refund request track
        $trackId = $this->storeRefundRequestTrack($id, $data["track_status"], auth('admin')->id());

        if (!empty($data["reason"]) && in_array($data["track_status"], ["cancel", "canceled_by_delivery_man"])) {
            $reason = [];
            foreach ($data["reason"] as $item) {
                $reason[] = [
                    "request_track_id" => $trackId->id,
                    "reason"           => $item,
                ];
            }

            $mailableData["reasons"] = $reason;

            RefundTrackStatusReason::insert($reason);
        } elseif ($data["track_status"] == "payment_returned" && !empty($data["deducted_amount_reason"] ?? []) && !empty($data["deducted_amount"] ?? [])) {
            $refund_deducted_amounts = [];
            $total_amount = RefundTransaction::get_refund_item_total_amount($id);

            foreach ($data["deducted_amount_reason"] as $key => $value) {
                $deducted_amount = $data["deducted_amount"][$key] ?? 0;
                $refund_deducted_amounts[] = [
                    "refund_request_track_id" => $trackId->id,
                    "reason"                  => $value ?? '',
                    "amount"                  => $deducted_amount,
                    "created_at"              => now(),
                ];

                $total_amount -= $deducted_amount;
            }

            $mailableData["deducted_amount"] = $refund_deducted_amounts;
            RefundDeductedAmount::insert($refund_deducted_amounts);

            // update refund_requests table column
            if (!empty($data["refund_fee"])) {
                RefundRequest::where("id", $id)->update([
                    "refund_fee" => $data["refund_fee"],
                ]);

                $mailableData["refund_fee"] = $data["refund_fee"];

                $total_amount -= $data["refund_fee"];
            }

            // need to minus vendor account amount
            WalletService::updateVendorWalletFromRefund($refundRequest);

            // check if preferred option is wallet than move forward
            if ($refundRequest->preferredOption?->name == "Wallet") {
                // here update wallet
                WalletService::updateRefundRequest($total_amount, $refundRequest);
            }
        }

        // send email from here
        RefundMailServices::sendMail($refundRequest, $data["track_status"], $mailableData);

        return back()->with([
            "message"    => __("Successfully Updated Refund Request Status"),
            "alert-type" => "success",
        ]);
    }
}
