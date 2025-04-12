<?php

namespace Modules\Refund\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Refund\Entities\RefundPreferredOption;
use Modules\Wallet\Http\Requests\StoreRefundPreferredOptionRequest;

class RefundPreferredOptionController extends Controller
{
    public function index(){
        $preferredOptions = RefundPreferredOption::with("status")->get();

        return view("refund::admin.preferred-option.index", compact('preferredOptions'));
    }

    public function store(StoreRefundPreferredOptionRequest $request){
        $data = RefundPreferredOption::create($request->validated());

        return back()->with(["status" => (bool)$data, "type" => $data ? "success" : "danger", "msg" => $data ? __("Payment Gateway created successfully.") : __("Failed to create payment gateway try again.")]);
    }


    public function update(StoreRefundPreferredOptionRequest $request){
        $data = $request->validated();

        $id = $data["id"];
        unset($data["id"]);

        $data = RefundPreferredOption::where("id", $id)->update($data);

        return back()->with(["status" => (bool)$data, "type" => $data ? "success" : "danger", "msg" => $data ? __("Payment Gateway updated successfully.") : __("Failed to update payment gateway try again.")]);
    }
    public function delete($id){
        return RefundPreferredOption::where("id", $id)->delete() ? "ok" : "false";
    }
}
