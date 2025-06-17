<?php

namespace Modules\Refund\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RefundSettingsController extends Controller
{
    public function index(){
        return view("refund::admin.settings.index");
    }

    public function update(Request $request){
        update_static_option("how_long_user_will_eligible_for_refund", $request->how_long_user_will_eligible_for_refund);
        update_static_option("courier_address", $request->courier_address);

        return back()->with([
            "msg" => __("Refund settings updated successfully."),
            "type" => 'success'
        ]);
    }
}
