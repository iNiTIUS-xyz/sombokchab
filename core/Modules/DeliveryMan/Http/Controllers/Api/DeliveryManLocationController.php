<?php

namespace Modules\DeliveryMan\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\DeliveryMan\Entities\DeliveryMan;

class DeliveryManLocationController extends Controller
{
    public function updateLocation(Request $request)
    {
        // make validation
        $data = $request->validate([
            "lat" => "required",
            "long" => "required"
        ]);

        $deliveryMan = DeliveryMan::where("id", auth()->user()->id)->update([
            'latitude' => $data["lat"],
            'longitude' => $data["long"],
        ]);

        return response()->json([
            "status" => $deliveryMan,
            "msg" => $deliveryMan ? __("Successfully updated location") : __("Failed to update location")
        ]);
    }
}
