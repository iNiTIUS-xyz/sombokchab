<?php

namespace Modules\Refund\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Refund\Entities\RefundReason;
use Modules\Refund\Http\Requests\StoreReasonRequest;
use Modules\Refund\Http\Requests\UpdateReasonRequest;

class AdminReasonController extends Controller
{
    public function index()
    {
        $reasons = RefundReason::all();

        return view("refund::admin.reason.index", compact('reasons'));
    }

    public function store(StoreReasonRequest $request)
    {
        $reason = RefundReason::create($request->validated());

        return response()->json([
            "msg" => $reason ? __("Successfully created reason") : __("Failed to create reason"),
            "success" => (bool) $reason,
        ]);
    }

    public function update(UpdateReasonRequest $request)
    {
        $reason = RefundReason::where("id", $request->id ?? 0)
            ->update($request->validated());

        return response()->json([
            "msg" => $reason ? __("Successfully updated reason") : __("Failed to update reason"),
            "success" => (bool) $reason,
        ]);
    }

    public function destroy(RefundReason $reason)
    {
        $reason = $reason->delete();

        return back()->with([
            "msg" => $reason ? __("Successfully deleted reason") : __("Failed to delete reason"),
            "type" => 'success',
            "success" => (bool) $reason,
        ]);
    }

}
