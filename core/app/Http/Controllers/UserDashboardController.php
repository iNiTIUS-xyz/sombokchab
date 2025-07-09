<?php

namespace App\Http\Controllers;

use Str;
use App\User;
use App\Mail\BasicMail;
use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use App\Events\SupportMessage;
use App\Support\SupportTicket;
use App\Shipping\ShippingAddress;
use Modules\Order\Entities\Order;
use Illuminate\Support\Facades\DB;
use App\Mail\SentSupportTicketMail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Order\Entities\SubOrder;
use App\Support\SupportTicketMessage;
use Illuminate\Contracts\View\Factory;
use Modules\Order\Entities\OrderTrack;
use Modules\Refund\Entities\RefundReason;
use Modules\Refund\Entities\RefundRequest;
use Modules\CountryManage\Entities\Country;
use Modules\Product\Entities\ProductSellInfo;
use Illuminate\Contracts\Foundation\Application;
use Modules\Refund\Http\Services\RefundServices;
use Modules\Refund\Entities\RefundPreferredOption;
use Modules\DeliveryMan\Entities\DeliveryManRating;
use Modules\Refund\Http\Requests\HandleUserRefundRequest;

class UserDashboardController extends Controller
{
    public const BASE_PATH = 'frontend.user.dashboard.';

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function user_index()
    {
        $product_count = ProductSellInfo::where('user_id', auth('web')->user()->id)->count();
        $support_ticket_count = SupportTicket::where('user_id', auth('web')->user()->id)->count();
        $all_orders = Order::with(['paymentMeta', 'refundRequest.currentTrackStatus'])->withCount('isDelivered')
            ->where('user_id', auth('web')->user()->id)
            ->orderBy('id', 'DESC')
            ->get();

        return view(self::BASE_PATH . 'user-home', compact('all_orders', 'product_count', 'support_ticket_count'));
    }

    public function user_email_verify_index()
    {
        $user_details = Auth::guard('web')->user();
        if ($user_details->email_verified == 1) {
            return redirect()->route('user.home');
        }
        if (empty($user_details->email_verify_token)) {
            User::find($user_details->id)->update(['email_verify_token' => \Str::random(8)]);
            $user_details = User::find($user_details->id);
            $message_body = __('Here is your verification code') . ' <span class="verify-code">' . $user_details->email_verify_token . '</span>';

            try {
                Mail::to($user_details->email)->send(new BasicMail([
                    'subject' => __('Verify your email address'),
                    'message' => $message_body,
                ]));
            } catch (\Exception $e) {
                //
            }
        }

        return view('frontend.user.email-verify');
    }

    public function reset_user_email_verify_code()
    {
        $user_details = Auth::guard('web')->user();
        if ($user_details->email_verified == 1) {
            return redirect()->route('user.home');
        }
        $message_body = __('Here is your verification code') . ' <span class="verify-code">' . $user_details->email_verify_token . '</span>';

        try {
            Mail::to($user_details->email)->send(new BasicMail([
                'subject' => __('Verify your email address'),
                'message' => $message_body,
            ]));
        } catch (\Exception $e) {
            return redirect()->route('user.email.verify')->with(['msg' => $e->getMessage(), 'type' => 'danger']);
        }

        return redirect()->route('user.email.verify')->with(['msg' => __('Resend Verify Email Success'), 'type' => 'success']);
    }

    public function user_email_verify(Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
        ], [
            'verification_code.required' => __('verify code is required'),
        ]);
        $user_details = Auth::guard('web')->user();
        $user_info = User::where(['id' => $user_details->id, 'email_verify_token' => $request->verification_code])->first();
        if (empty($user_info)) {
            return redirect()->back()->with(['msg' => __('your verification code is wrong, try again'), 'type' => 'danger']);
        }
        $user_info->email_verified = 1;
        $user_info->save();

        return redirect()->route('user.home');
    }

    public function user_profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            // 'email' => 'required|email|max:30|unique:users,id,'.$request->user_id,
            'phone' => 'required|string|max:30',
            'state' => 'nullable|string|max:30',
            'city' => 'nullable|string|max:30',
            'zipcode' => 'nullable|string|max:30',
            'country' => 'nullable|string|max:30',
            'address' => 'nullable|string',
            'image' => 'nullable|string',
        ], [
            'name.' => __('Name is required'),
            // 'email.required' => __('email is required'),
            'email.email' => __('Provide valid email'),
        ]);

        User::find(Auth::guard()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $request->image,
            'phone' => $request->phone,
            'state' => $request->state,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'country' => $request->country,
            'address' => $request->address,
        ]);

        return redirect()->back()->with(['msg' => __('Profile updated successfully.'), 'type' => 'success']);
    }

    public function deactivateAccount(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        // Check if password and phone match the logged-in user
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Password Didn\'t Match');
        }

        // Deactivate the account
        $user->deactive_status = 1;
        $user->save();

        // Log out the user
        Auth::logout();

        return redirect()->route('homepage')->with('success', 'Your account has been deactivated.');
    }

    public function user_password_change(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'old_password.required' => __('Old password is required'),
            'password.required' => __('Password is required'),
            'password.confirmed' => __('password must have to be confirmed'),
        ]);

        $user = User::findOrFail(Auth::guard()->user()->id);

        if (Hash::check($request->old_password, $user->password)) {

            $user->password = Hash::make($request->password);
            $user->save();
            // Auth::guard('web')->logout();

            return redirect()->back()->with(['msg' => __('Password changed successfully.'), 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => __('Current password do not match.'), 'type' => 'danger']);
    }

    public function edit_profile()
    {
        return view(self::BASE_PATH . 'edit-profile')
            ->with(['user_details' => $this->logged_user_details()]);
    }

    public function change_password()
    {
        return view(self::BASE_PATH . 'change-password');
    }

    public function logged_user_details()
    {
        $old_details = '';
        if (empty($old_details)) {
            $old_details = User::findOrFail(Auth::guard('web')->user()->id);
        }

        return $old_details;
    }

    public function allShippingAddress()
    {
        if (!auth()->check('web')) {
            return redirect()->route('homepage');
        }
        $all_country = Country::where('status', 'publish')->get();
        $all_shipping_address = ShippingAddress::where('user_id', getUserByGuard('web')->id)->get();

        return view(self::BASE_PATH . 'shipping.all', compact('all_shipping_address', 'all_country'));
    }



    public function createShippingAddress()
    {
        $all_country = Country::where('status', 'publish')->get();

        return view(self::BASE_PATH . 'shipping.new', compact('all_country'));
    }

    public function storeShippingAddress(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (!auth('web')->user()) {
            return back()->with(FlashMsg::explain('danger', __('Login to add new ')));
        }

        $request->validate([
            'shipping_address_name' => 'nullable|string|max:191',
            'name' => 'required|string|max:191',
            'email' => 'nullable|string|max:191',
            'phone' => 'required|string|max:191',
            'country' => 'required|string|max:191',
            'state' => 'nullable|string|max:191',
            'city' => 'nullable|string|max:191',
            'zipcode' => 'nullable|string|max:191',
            'address' => 'nullable|string|max:191',
            'is_default' => 'nullable',
        ], [
            'phone.required' => 'Phone number is required.'
        ]);

        $existShippingAddress = ShippingAddress::query()
            ->where('name', $request->name)
            ->get();


        if ($existShippingAddress->count() > 0) {
            return back()->with(FlashMsg::explain('danger', __('Shipping address with this name already exits.')));
        }

        // Reset all to non-default
        ShippingAddress::query()->update(['is_default' => 0]);

        $user_shipping_address = ShippingAddress::create([
            'shipping_address_name' => $request->shipping_address_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_id' => getUserByGuard('web')->id ?? null,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zipcode,
            'address' => $request->address,
            'is_default' => $request->is_default,
        ]);

        $this->makeChangeDefault($user_shipping_address->id);


        return $user_shipping_address->id
            ? redirect()->route('user.shipping.address.all')->with(FlashMsg::create_succeed('Shipping address'))
            : back()->with(FlashMsg::create_failed('Shipping address'));
    }

    private function makeChangeDefault($shippingAddressId)
    {
        $shippingAddress = ShippingAddress::findOrFail($shippingAddressId);

        // If the address is not marked as default, do nothing
        if (!$shippingAddress->is_default) {
            return;
        }

        // Reset all other addresses for this user to non-default
        ShippingAddress::where('user_id', $shippingAddress->user_id)
            ->where('id', '!=', $shippingAddressId)
            ->update(['is_default' => 0]);

        // Ensure the specified address is marked as default (in case it was altered)
        $shippingAddress->update(['is_default' => 1]);
    }

    public function editShippingAddress(Request $request)
    {
        $address = ShippingAddress::find($request->id);
        $all_country = Country::where('status', 'publish')->get();
        return view(self::BASE_PATH . 'shipping.edit', compact('all_country', 'address'));
    }

    public function updateShippingAddress(Request $request)
    {
        $request->validate([
            'shipping_address_name' => 'nullable|string|max:191',
            'name' => 'required|string|max:191',
            'email' => 'nullable|string|max:191',
            'phone' => 'required|string|max:191',
            'country' => 'required|string|max:191',
            'state' => 'nullable|string|max:191',
            'city' => 'nullable|string|max:191',
            'zipcode' => 'nullable|string|max:191',
            'address' => 'nullable|string|max:191',
            'is_default' => 'nullable',
        ], [
            'phone.required' => 'Phone Number is Required.'
        ]);


        $existShippingAddress = ShippingAddress::query()
            ->where('id', '!=', $request->id)
            ->where('name', $request->name)
            ->get();

        if ($existShippingAddress->count() > 0) {
            return back()->with(FlashMsg::explain('danger', __('Shipping address with this name already exits.')));
        }

        $address = ShippingAddress::find($request->id);

        if (!$address) {
            return back()->with(FlashMsg::explain('danger', __('Address not found.')));
        }

        // Reset all to non-default
        ShippingAddress::query()->update(['is_default' => 0]);

        $address->update([
            'shipping_address_name' => $request->shipping_address_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zipcode,
            'address' => $request->address,
            'is_default' => $request->is_default,
        ]);

        // Redirect to the all shipping addresses page with a success message
        return redirect()->route('user.shipping.address.all')->with(FlashMsg::update_succeed('Shipping address'));
    }

    public function makeDefault($id)
    {
        // Reset all to non-default
        ShippingAddress::query()->update(['is_default' => 0]);
        // Set the selected one to default
        $shippingAddress = ShippingAddress::findOrFail($id);
        $shippingAddress->is_default = 1;
        $shippingAddress->save();

        return redirect()->route('user.shipping.address.all')->with(FlashMsg::update_succeed('Default shippging address'));
    }

    public function deleteShippingAddress($id)
    {
        if (ShippingAddress::findOrFail($id)->delete()) {
            return back()->with(FlashMsg::delete_succeed('Shipping address'));
        }

        return back()->with(FlashMsg::delete_failed('Shipping address'));
    }

    public function allOrdersPage(): Factory|View|Application
    {

        $all_orders = Order::with(['paymentMeta', 'refundRequest.currentTrackStatus'])->withCount('isDelivered')
            ->where('user_id', auth('web')->user()->id)
            ->orderBy('id', 'DESC')
            ->get();

        return view(self::BASE_PATH . 'order.all', compact('all_orders'));
    }

    public function allRefundsPage(): Factory|View|Application
    {
        if (!moduleExists("Refund")) {
            abort(404);
        }

        $refundRequests = RefundRequest::query()
            ->withCount('requestProduct')
            ->with('currentTrackStatus', 'user:id,name,email,phone', 'order:id,order_number,order_status,created_at', 'order.paymentMeta')
            ->where('user_id', auth('web')->user()->id)->orderByDesc('id')
            ->get();

        return view(self::BASE_PATH . 'refund.all', compact('refundRequests'));
    }

    public function viewRequest($id)
    {
        if (!moduleExists("Refund")) {
            abort(404);
        }

        // fetch all information about this request
        $request = RefundRequest::with([
            'currentTrackStatus',
            'preferredOption',
            'products',
            'user',
            'order' => function ($query) {
                $query->withCount('orderItems');
            },
            'order.paymentMeta',
            'requestFile',
            'requestTrack',
            'requestProduct',
            'productVariant',
            'productVariant.productColor',
            'productVariant.productSize'
        ])
            ->findOrFail($id);

        return view(self::BASE_PATH . 'refund.view-request', compact('request'));
    }

    public function orderRefundPage($id)
    {
        if (!moduleExists("Refund")) {
            abort(404);
        }

        // get all order items
        $order = Order::with(['refundRequest', 'paymentMeta', 'orderItems', 'orderItems.product', 'orderItems.variant', 'orderItems.variant.productColor', 'orderItems.variant.productSize'])
            ->withCount('isDelivered', 'refundRequest')
            ->whereHas('isDelivered')
            ->whereHas('address')
            ->where('user_id', auth('web')->user()->id)->orderBy('id', 'DESC')
            ->where('id', $id)
            ->firstOrFail();
        $subOrders = SubOrder::with(['order', 'vendor', 'orderItem', 'orderItem.product', 'orderItem.variant', 'orderItem.variant.productColor', 'orderItem.variant.productSize'])
            ->where('order_id', $id)->get();
        $refundable_items = RefundServices::getProduct($id);
        $refundReasons = RefundReason::all();
        $refundPreferredOptions = RefundPreferredOption::all();

        return view(self::BASE_PATH . 'order.refund', compact('id', 'order', 'subOrders', 'refundable_items', 'refundReasons', 'refundPreferredOptions'));
    }

    public function handleRefundRequest(HandleUserRefundRequest $request, $id)
    {
        if (!moduleExists("Refund")) {
            abort(404);
        }

        try {

            $refundProducts = RefundServices::prepareRefundRequestData($request->validated(), $id);


            if ($refundProducts) {
                return redirect()->route('user.product.refund-request')->with([
                    'msg' => __('Your refund request has been sent successfully.'),
                    'type' => 'success',
                ]);
            }
            dd(2, $refundProducts);

        } catch (\Throwable $e) {

            dd($e);

            return back()->with([
                'msg' => __('An error occurred while processing your refund request. Please try again later.'),
                'type' => 'danger',
            ]);
        }
    }


    public function orderDetailsPage($item)
    {
        $payment_details = Order::query()
            ->with(['address', 'paymentMeta'])
            ->when(moduleExists("DeliveryMan"), function ($query) {
                $query->with("deliveryMan");
            })
            ->where('order_number', $item)
            ->first();

        if (!$payment_details) {
            return redirect()->route('user.home')->with([
                'msg' => __('Order not found.'),
                'type' => 'danger',
            ]);
        }

        $orders = SubOrder::query()
            ->with([
                'order',
                'vendor',
                'orderItem',
                'orderItem.product',
                'orderItem.variant',
                'orderItem.variant.productColor',
                'orderItem.variant.productSize'
            ])
            ->where('order_id', $payment_details->id)
            ->get();

        $orderTrack = OrderTrack::where('order_id', $payment_details->id)->orderByDesc('id')->first();

        return view(self::BASE_PATH . 'order.details', compact('item', 'orders', 'payment_details', 'orderTrack'));
    }

    public function orderDeliveryManRatting($item, Request $request)
    {
        // first verified user input data then insert ratting into database
        $data = $request->validate([
            'ratting' => 'required|integer',
            'review' => 'nullable|string',
        ]);

        if (!moduleExists("DeliveryMan")) {
            abort(403);
        }

        // check order is exist or not if order not exist then show 404 page
        $order = Order::with('deliveryMan')->findOrFail($item); // if order is not found on database then it will show 404 page
        // check this order is contain delivery man or not if this order does not have assigned delivery man then show exception
        if (!empty($order->deliveryMan)) {
            // first check if this order is have already a ratting then user can't give ratting again
            if (DeliveryManRating::where('delivery_man_id', $order->deliveryMan?->delivery_man_id)->count() < 1) {
                DeliveryManRating::create([
                    'user_id' => auth()->id(),
                    'delivery_man_id' => $order->deliveryMan?->delivery_man_id,
                    'rating' => $data['ratting'],
                    'review' => $data['review'],
                    'status' => 'active',
                ]);

                return back()->with([
                    'msg' => __('Successfully sent your feedback'),
                    'type' => 'success',
                ]);
            }

            return back()->with([
                'msg' => __('This order already have a feedback'),
                'type' => 'danger',
            ]);
        }

        throw new \Exception('Delivery man not assigned for this order');
    }

    public function support_tickets()
    {
        $all_tickets = SupportTicket::query()
            ->where('user_id', auth('web')->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view(self::BASE_PATH . 'support-tickets.all')->with(['all_tickets' => $all_tickets]);
    }

    public function support_ticket_view(Request $request, $id)
    {
        $ticket_details = SupportTicket::findOrFail($id);
        $all_messages = SupportTicketMessage::where(['support_ticket_id' => $id])->get();
        $q = $request->q ?? '';

        return view(self::BASE_PATH . 'support-tickets.view')->with(['ticket_details' => $ticket_details, 'all_messages' => $all_messages, 'q' => $q]);
    }

    public function support_ticket_message(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required',
            'user_type' => 'required|string|max:191',
            'message' => 'required',
            'send_notify_mail' => 'nullable|string',
            'file' => 'nullable|max:204800',
        ]);

        $ticket_info = SupportTicketMessage::create([
            'support_ticket_id' => $request->ticket_id,
            'type' => $request->user_type,
            'message' => $request->message,
            'notify' => $request->send_notify_mail ? 'on' : 'off',
        ]);

        if ($request->hasFile('file')) {
            $uploaded_file = $request->file;
            $file_extension = 'zip';
            $file_name = Str::uuid() . '-' . time() . '.' . $file_extension;
            $uploaded_file->move('assets/uploads/ticket', $file_name);
            $ticket_info->attachment = $file_name;
            $ticket_info->save();
        }

        //send mail to user
        event(new SupportMessage($ticket_info));

        // if (isset($request->send_notify_mail) && $request->send_notify_mail == 'on') {

        //     $details = [
        //         'title' => "You have a new support ticket message. Please check and reply.",
        //         'url' => ,
        //     ];

        //     Mail::to($request->email)->send(new SentSupportTicketMail($details));
        // }

        return back()->with(FlashMsg::settings_update(__('Message sent successfully.')));
    }

    public function support_ticket_priority_change(Request $request)
    {
        $request->validate([
            'priority' => 'required|string|max:191',
        ]);
        SupportTicket::findOrFail($request->id)->update([
            'priority' => $request->priority,
        ]);

        return 'ok';
    }

    public function support_ticket_status_change(Request $request)
    {
        // $request->validate([
        //     'status' => 'required|string|max:191',
        // ]);
        // SupportTicket::findOrFail($request->id)->update([
        //     'status' => $request->status,
        // ]);

        // return 'ok';
        $request->validate([
            'id' => 'required|exists:support_tickets,id',
            'status' => 'required|in:open,close',
        ]);

        $ticket = SupportTicket::where('id', $request->id)
            ->where('user_id', auth('web')->id())
            ->firstOrFail();

        $ticket->status = $request->status;
        $ticket->save();

        return response()->json(['success' => true]);
    }


    /** ===================================================================
     *                  Order Cancel
     * =================================================================== */
    // public function orderCancel($orderId)
    // {
    //     // Fetch the order
    //     $order = Order::where('id', $orderId)
    //         ->where('user_id', auth('web')->id()) // Ensure the user owns the order
    //         ->first();

    //     // Check if order exists and is cancelable
    //     if (!$order || !$order->isCancelableStatus || $order->order_status !== 'pending') {
    //         return redirect()->back()->with('error', 'This order cannot be canceled.');
    //     }

    //     // Update order status to "canceled"
    //     $order->update(['order_status' => 'canceled']);

    //     // Optionally, add an entry to `orderTrack` to log the cancellation
    //     // $order->orderTrack()->create([
    //     //     'order_id' => $order->id,
    //     //     'name' => 'canceled'
    //     // ]);

    //     return redirect()->back()->with('success', 'Order has been successfully canceled.');
    // }

    public function orderCancel(Request $request, $orderId)
    {
        // Fetch the order
        $order = Order::where('id', $orderId)
            ->where('user_id', auth('web')->id()) // Ensure the user owns the order
            ->first();

        // Check if order exists and is cancelable
        if (!$order || !$order->isCancelableStatus || $order->order_status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'This order cannot be canceled.'], 400);
        }

        $order->update(['order_status' => 'canceled']);
        return response()->json(['success' => true]);
    }
}
