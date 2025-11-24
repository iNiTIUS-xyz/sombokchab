<?php

namespace Modules\Refund\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Refund\Entities\RefundPreferredOption;
use Modules\Wallet\Http\Requests\StoreRefundPreferredOptionRequest;

class RefundPreferredOptionController extends Controller {
    public function index() {
        $preferredOptions = RefundPreferredOption::with("status")->get();

        return view("refund::admin.preferred-option.index", compact('preferredOptions'));
    }

    public function store(StoreRefundPreferredOptionRequest $request) {
        try {
            DB::beginTransaction();
            $validated = $request->validated();

            $data = RefundPreferredOption::create([
                'name'      => $validated['gateway_name'],
                'fields'    => isset($validated['is_file']) && $validated['is_file'] == 'yes' ? null : serialize($validated['filed']),
                'status_id' => $validated['status_id'],
                'is_file'   => isset($validated['is_file']) ? 'yes' : 'no',
            ]);
            DB::commit();

            return back()->with([
                "status"     => (bool) $data,
                "alert-type" => $data ? "success" : "error",
                "message"    => $data ? __("Payment Gateway created successfully.") : __("Failed to create payment gateway try again."),
            ]);
        } catch (\Throwable $e) {

            return back()->with([
                "alert-type" => 'error',
                "message"    => __("Failed to create payment gateway try again."),
            ]);
        }
    }

    public function update(StoreRefundPreferredOptionRequest $request) {
        try {

            $validated = $request->validated();

            $id = $validated["id"];

            DB::beginTransaction();

            $data = RefundPreferredOption::where("id", $id)->update([
                'name'      => $validated['gateway_name'],
                'fields'    => isset($validated['is_file']) && $validated['is_file'] == 'yes' ? null : serialize($validated['filed']),
                'status_id' => $validated['status_id'],
                'is_file'   => isset($validated['is_file']) ? 'yes' : 'no',
            ]);

            DB::commit();

            return back()->with([
                "alert-type" => $data ? "success" : "error",
                "message"    => $data ? __("Payment Gateway updated successfully.") : __("Failed to update payment gateway try again."),
            ]);
        } catch (\Throwable $e) {
            return back()->with([
                "alert-type" => "error",
                "message"    => __("Failed to update payment gateway try again."),
            ]);
        }
    }

    public function delete($id) {
        return RefundPreferredOption::where("id", $id)->delete() ? "ok" : "false";
    }

    public function statusChange(Request $request, $id) {
        RefundPreferredOption::where('id', $id)->update([
            'status_id' => $request->status,
        ]);

        return redirect()->back()->with([
            'message'    => __('Refund referred option status changed successfully.'),
            'alert-type' => 'success',
        ]);
    }
}
