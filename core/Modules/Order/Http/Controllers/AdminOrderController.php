<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\SubOrder;
use Modules\Order\Services\OrderService;
use Modules\Order\Services\OrderServices;
use Modules\Order\Traits\OrderDetailsTrait;
use Modules\Vendor\Entities\Vendor;
use Modules\Wallet\Http\Services\WalletService;

class AdminOrderController extends Controller
{
    use OrderDetailsTrait;

    public function index()
    {
        // first of all we need to get all sub order for login user
        $all_orders = SubOrder::with("order:id,payment_status,created_at", "vendor")
            ->withCount("orderItem")
            ->orderByDesc("id")
            ->get();

        return view('order::admin.index', compact("all_orders"));
    }

    public function orders()
    {

        $all_orders = Order::query()
            ->with([
                "paymentMeta",
                "orderTrack" => function ($query) {
                    $query->orderByDesc('id')->limit(1);
                }
            ])
            ->orderByDesc("id")
            ->get();

        return view('order::admin.order-list', compact("all_orders"));
    }

    public function subOrderDetails($id)
    {
        return OrderService::subOrderDetails($id);
    }

    public function orderVendorList()
    {
        // first of all i need to get all vendor with some order information
        $vendors = Vendor::with("logo", "cover_photo")
            ->withCount([
                "order as total_order" => function ($order) {
                    $order->orderByDesc("orders.id");
                },
                "order as complete_order" => function ($order) {
                    $order->where("orders.order_status", "complete");
                },
                "order as pending_order" => function ($order) {
                    $order->where("orders.order_status", "pending");
                },
                "product"
            ])
            ->whereHas("order")
            ->withSum("subOrder as total_earning", "sub_orders.total_amount")
            ->get();

        return view("order::admin.vendors", compact("vendors"));
    }

    public function details($id)
    {
        $order = $this->orderDetailsMethod($id);

        return view("order::admin.details", compact("order"));
    }

    public function vendorOrders($username)
    {
        $vendor = Vendor::select("id", "username")->where("username", $username)->firstOrFail();

        // first of all we need to get all sub order for login user
        $all_orders = SubOrder::with("order:id,payment_status,created_at", "vendor")
            ->withCount("orderItem")
            ->where("vendor_id", $vendor->id)
            ->orderByDesc("id")
            ->paginate(get_static_option("order_vendor_list"));

        return view('order::admin.index', compact("all_orders"));
    }

    public function edit($orderId)
    {
        $order = $this->orderDetailsMethod($orderId);

        if ($order->SubOrders->count() == 1 && !empty($order->SubOrders->first()->vendor_id)) {
        }

        $edit = true;

        return view("order::admin.details", compact("order", "edit"));
    }

    public function updateOrderTrack(Request $request)
    {
        $orderTrack = $request->validate([
            "order_id" => "required",
            "order_track" => "required",
            "order_track.*" => "required"
        ]);

        foreach ($orderTrack["order_track"] as $track) {
            if ($track == 'delivered') {

                WalletService::completeOrderAmount($orderTrack["order_id"]);

            }

            OrderServices::storeOrderTrack($orderTrack["order_id"], $track, auth()->user()->id, 'admin');
        }

        return back()->with(["type" => "success", "msg" => __("Order track updated successfully.")]);
    }

    public function updateOrderStatus(Request $request)
    {
        $orderData = $request->validate([
            "order_status" => "required",
            "payment_status" => "required",
            "order_id" => "required"
        ]);

        Order::where("id", $orderData["order_id"])->update([
            "order_status" => $orderData["order_status"],
            "payment_status" => $orderData["payment_status"],
        ]);

        return back()->with(["type" => "success", "msg" => __("Status updated successfully.")]);
    }

    public function orderStatusChange(Request $request, $id)
    {
        Order::where("id", $id)->update([
            "order_status" => $request->order_status,
        ]);

        return back()->with(["type" => "success", "msg" => __("Order status changed successfully.")]);
    }

    public function paymentStatusChange(Request $request, $id)
    {

        Order::where("id", $id)->update([
            "payment_status" => $request->payment_status,
        ]);

        return back()->with(["type" => "success", "msg" => __("Order payment status changed successfully.")]);
    }
}
