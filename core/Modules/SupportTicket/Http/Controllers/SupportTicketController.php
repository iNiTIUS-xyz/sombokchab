<?php

namespace Modules\SupportTicket\Http\Controllers;

use Str;
use Storage;
use App\XGNotification;
use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use App\Events\SupportMessage;
use Modules\User\Entities\User;
use Illuminate\Routing\Controller;
use Modules\Vendor\Entities\Vendor;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Modules\SupportTicket\Entities\SupportTicket;
use Modules\SupportTicket\Entities\SupportDepartment;
use Modules\SupportTicket\Entities\SupportTicketMessage;
use Modules\SupportTicket\Http\Requests\AdminStoreSendMessageRequest;
use Modules\SupportTicket\Http\Requests\AdminStoreSupportTicketRequest;

class SupportTicketController extends Controller
{
    public function page_settings()
    {
        return view('supportticket::backend.page-settings');
    }

    public function update_page_settings(Request $request)
    {
        $field_rules = [
            'support_ticket_login_notice' => 'nullable|string',
            'support_ticket_form_title' => 'nullable|string',
            'support_ticket_button_text' => 'nullable|string',
            'support_ticket_success_message' => 'nullable|string',
        ];

        $request->validate($field_rules);

        foreach ($field_rules as $field => $rule) {
            update_static_option($field, $request->$field);
        }

        return back()->with(FlashMsg::settings_update());
    }

    public function all_tickets()
    {
        $all_tickets = SupportTicket::query()
            ->with('department', 'user')
            ->where('vendor_id', null)
            ->orderBy('id', 'desc')
            ->get();

        return view('supportticket::backend.all-tickets')->with(['all_tickets' => $all_tickets]);
    }

    public function all_vendor_tickets()
    {
        $all_tickets = SupportTicket::query()
            ->with('department', 'vendor')
            ->whereNot('vendor_id', null)
            ->orderBy('id', 'desc')
            ->get();

        return view('supportticket::backend.vendor-tickets')->with(['all_tickets' => $all_tickets]);
    }

    public function new_ticket()
    {
        $all_users = User::all();
        $all_vendors = Vendor::all();
        $all_departments = SupportDepartment::where(['status' => 'publish'])->get();

        return view('supportticket::backend.new-ticket')->with(['all_users' => $all_users, 'departments' => $all_departments, 'all_vendors' => $all_vendors]);
    }

    public function store_ticket(AdminStoreSupportTicketRequest $request)
    {
        $support_ticket = SupportTicket::create([
            'title' => $request->title,
            'via' => 'admin',
            'operating_system' => null,
            'user_agent' => null,
            'description' => $request->description,
            'subject' => null,
            'status' => 'open',
            'priority'  => null,
            'user_id' => $request->user_type == 'customer' ? $request->user_id : null,
            'vendor_id' => $request->user_type == 'vendor' ? $request->vendor_id : null,
            'departments' => $request->departments,
            'admin_id' => Auth::guard('admin')->user()->id,
        ]);

        $notification = new XGNotification();
        $notification->vendor_id  = $support_ticket->vendor_id ?? null;
        $notification->delivery_man_id   = null;
        $notification->user_id   = $support_ticket->user_id ?? null;
        $notification->model  = 'Modules\SupportTicket\Entities\SupportTicket';
        $notification->model_id  = $support_ticket->id;
        $notification->message  = $request->title . ' "A new support ticket created successfully"';
        $notification->type  = 'support_ticket_admin';
        $notification->is_read_admin  = 0;
        $notification->is_read_vendor  = 0;
        $notification->is_read_delivery_man  = 0;
        $notification->is_read_user  = 0;

        $notification->save();

        return $support_ticket->id
            ? back()->with(FlashMsg::create_succeed('Support ticket'))
            : back()->with(FlashMsg::create_failed('Support ticket'));
    }

    public function listView(Request $request, $id)
    {
        $ticket_details = SupportTicket::with('admin')->findOrFail($id);
        $all_messages = SupportTicketMessage::where(['support_ticket_id' => $id])->get();
        $q = $request->q ?? '';

        return view('supportticket::backend.view-ticket')->with([
            'ticket_details' => $ticket_details,
            'all_messages' => $all_messages,
            'q' => $q,
        ]);
    }

    public function delete(Request $request, $id)
    {
        SupportTicket::findOrFail($id)->delete();

        return back()->with(FlashMsg::delete_succeed('Support ticket'));
    }

    public function priority_change(Request $request)
    {
        $request->validate(['priority' => 'required|string|max:191']);
        SupportTicket::findOrFail($request->id)->update([
            'priority' => $request->priority,
        ]);

        return 'ok';
    }

    public function status_change(Request $request)
    {
        $request->validate(['status' => 'required|string|max:191']);
        SupportTicket::findOrFail($request->id)->update([
            'status' => $request->status,
        ]);

        return 'ok';
    }

    public function send_message(AdminStoreSendMessageRequest $request)
    {
        $ticket_info = SupportTicketMessage::create([
            'support_ticket_id' => $request->ticket_id,
            'type' => $request->user_type,
            'admin_id' => Auth::guard('admin')->user()->id,
            'message' => $request->message,
            'notify' => $request->send_notify_mail ? 'on' : 'off',
        ]);
        $imageExtensions = [
            'png',
            'gif',
            'jpg',
            'jpeg'
        ];
        if ($request->hasFile('file')) {
            $uploaded_file = $request->file;
            $file_extension = $uploaded_file->extension();
            $file_name = Str::uuid() . '-' . time() . '.' . $file_extension;
            if (in_array($file_extension, $imageExtensions)) {
                $image = Image::make($uploaded_file);
                Storage::disk('asset_path')->put('assets/uploads/ticket/' . $file_name, (string) $image->encode());
            } else {
                $uploaded_file->move('assets/uploads/ticket', $file_name);
            }
            $ticket_info->attachment = $file_name;
            $ticket_info->save();
        }

        event(new SupportMessage($ticket_info));

        return back()->with(FlashMsg::settings_update(__('Message Sent Successfully.')));
    }

    public function bulk_action(Request $request)
    {
        SupportTicket::whereIn('id', $request->ids)->delete();

        return response()->json(['status' => 'ok']);
    }
}
