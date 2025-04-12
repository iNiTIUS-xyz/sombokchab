<?php

namespace Modules\DeliveryMan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDeliveryManSettingsController extends Controller
{
    public function settings(){
        return view("deliveryman::admin.settings.index");
    }

    public function handleSettings(Request $request){
        $data = $request->validate([
            "map_api_key_client" => "nullable|string",
            "auto_suggestion_delivery_man" => "nullable|string",
            "map_api_server_key" => "nullable|string",
            "firebase_server_key" => "nullable|string",
        ]);

        update_static_option("map_api_key_client",$data["map_api_key_client"] ?? "");
        update_static_option("map_api_server_key",$data["map_api_server_key"] ?? "");
        update_static_option("auto_suggestion_delivery_man",$data["auto_suggestion_delivery_man"] ?? "");
        update_static_option("firebase_server_key",$data["firebase_server_key"] ?? "");

        return back()->with([
            "msg" => __("Successfully updated delivery man settings"),
            "type" => "success"
        ]);
    }
}
