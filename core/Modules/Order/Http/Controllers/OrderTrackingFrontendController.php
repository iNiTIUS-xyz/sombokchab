<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use Modules\Order\Traits\OrderDetailsTrait;

class OrderTrackingFrontendController extends Controller
{
    use OrderDetailsTrait;

    public function trackOrderPage(Request $request)
    {
        if ($request->has("order_id") && $request->has("phone")) {
            // Find the order by order_number instead of using orderDetailsMethod
            $order = Order::where("tracking_code", $request->order_id)->first();

            // Check if order exists and the phone number matches
            // abort_if(!$order || ($order->address?->phone ?? '') !== $request->phone, 403);

            return view("order::frontend.track-order", compact("order"));
        }

        return view("order::frontend.track-order-form");
    }

}
