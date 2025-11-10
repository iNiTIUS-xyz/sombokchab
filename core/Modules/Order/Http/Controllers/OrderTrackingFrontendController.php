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
        if ($request->filled('order_number') && $request->filled('phone')) {

            // Fetch order
            $order = Order::where('order_number', trim($request->order_number))->first();

            if (!$order) {
                return back()
                    ->with('type', 'danger')
                    ->with('info', __('Order not found.'));
            }

            // Get the user associated with the order
            $user = $order->user; // Must have relationship in Order model

            if (!$user) {
                return back()
                    ->with('type', 'danger')
                    ->with('info', __('No registered user found for this order.'));
            }

            // Normalize both numbers before comparing (remove spaces, +, -, etc.)
            $inputPhone = preg_replace('/\D/', '', $request->phone); // only digits
            $dbPhone = preg_replace('/\D/', '', $user->phone);

            if ($inputPhone !== $dbPhone) {
                return back()
                    ->with('type', 'danger')
                    ->with('info', __('Phone number does not match our records.'));
            }

            // If everything matches
            return view('order::frontend.track-order', compact('order'));
        }

        return view('order::frontend.track-order-form');
    }

}
