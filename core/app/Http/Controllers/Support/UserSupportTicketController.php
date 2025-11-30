<?php

namespace App\Http\Controllers\Support;

use App\Support\SupportDepartment;
use App\Support\SupportTicket;
use App\XGNotification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Order\Entities\Order;

class UserSupportTicketController extends Controller {
    const BASE_PATH = 'frontend.user.dashboard.support-tickets.';

    public function page() {
        $departments = SupportDepartment::where(['status' => 'publish'])->get();
        $user_orders = Order::with('paymentMeta')->where('user_id', auth('web')->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view(self::BASE_PATH . 'create', compact('departments', 'user_orders'));
    }

    // public function store(Request $request){
    //     $request->validate([
    //        'title' => 'required|string|max:191',
    //     //    'priority' => 'required|string|max:191',
    //        'description' => 'required|string',
    //        'departments' => 'required|string',
    //        'order_id' => 'required|string',
    //     ],[
    //         'title.required' =>  __('subject required'),
    //         // 'priority.required' =>  __('priority required'),
    //         'description.required' => __('description required'),
    //         'departments.required' => __('departments required'),
    //         'order_id.required' => __('order required'),
    //     ]);

    //     SupportTicket::create([
    //         'via' => $request->via,
    //         'operating_system' => null,
    //         'user_agent' => $_SERVER['HTTP_USER_AGENT'],
    //         'description' => $request->description,
    //         'title' => $request->subject,
    //         'status' => 'open',
    //         // 'priority' => $request->priority,
    //         'user_id' => auth('web')->user()->id,
    //         'order_id' => $request->order_id,
    //         'admin_id' => null,
    //         'departments' => $request->departments
    //     ]);

    //     $msg = get_static_option('support_ticket_success_message') ?? __('Thanks for contact us, we will reply soon');

    //     return back()->with(FlashMsg::settings_update($msg));
    // }

    public function store(Request $request) {
        $request->validate([
            'title'       => 'required|string|max:191',
            'description' => 'required|string',
            'departments' => 'required|string',
            'order_id'    => 'required|string|exists:orders,order_number',
        ], [
            'title.required'       => __('Title is required'),
            'description.required' => __('Description is required'),
            'departments.required' => __('Department is required'),
            'order_id.required'    => __('Order is required'),
            'order_id.exists'      => __('Invalid order selected'),
        ]);

        $support_ticket = SupportTicket::create([
            'via'              => $request->via,
            'operating_system' => null,
            'user_agent'       => $_SERVER['HTTP_USER_AGENT'],
            'description'      => $request->description,
            'title'            => $request->title,
            'status'           => 'open',
            'user_id'          => auth('web')->user()->id,
            'order_id'         => $request->order_id,
            'admin_id'         => null,
            'departments'      => $request->departments,
        ]);

        $notification = new XGNotification();
        $notification->vendor_id = $support_ticket->vendor_id ?? null;
        $notification->delivery_man_id = null;
        $notification->user_id = $support_ticket->user_id ?? null;
        $notification->model = 'Modules\SupportTicket\Entities\SupportTicket';
        $notification->model_id = $support_ticket->id;
        $notification->message = $request->title . ' "A new support ticket created successfully"';
        $notification->type = 'support_ticket_customer';
        $notification->is_read_admin = 0;
        $notification->is_read_vendor = 0;
        $notification->is_read_delivery_man = 0;
        $notification->is_read_user = 0;

        $notification->save();

        return $support_ticket->id
        ? redirect()->route('user.home.support.tickets')->with([
            'message'    => __('Support ticket created successfully.'),
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => __('Support ticket creation failed.'),
            'alert-type' => 'error',
        ]);
    }
}
