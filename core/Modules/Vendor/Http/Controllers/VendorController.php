<?php

namespace Modules\Vendor\Http\Controllers;

use App\Mail\BasicMail;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\CountryManage\Entities\City;
use Modules\CountryManage\Entities\State;
use Modules\Order\Entities\SubOrder;
use Modules\Product\Entities\Product;
use Modules\SupportTicket\Entities\SupportTicket;
use Modules\Vendor\Entities\Vendor;
use Modules\Wallet\Entities\VendorWithdrawRequest;

class VendorController extends Controller {
    public function adminIndex() {
        return "Admin Index method rendered";
    }

    public function index() {
        $baseQuery = DB::table('sub_order_items')
            ->join('sub_orders', 'sub_order_items.sub_order_id', '=', 'sub_orders.id')
            ->join('orders', 'sub_orders.order_id', '=', 'orders.id')
            ->join('products', 'sub_order_items.product_id', '=', 'products.id')
            ->where('sub_orders.vendor_id', auth("vendor")->id())
            ->select(
                'products.name',
                DB::raw('SUM(sub_order_items.quantity) as total_quantity')
            )
            ->groupBy('products.name');

        $topVendorsDaily = (clone $baseQuery)
            ->whereDate('orders.created_at', Carbon::today())
            ->groupBy('products.name')
            ->pluck('total_quantity', 'products.name');

        // Weekly
        $topVendorsWeekly = (clone $baseQuery)
            ->whereBetween('orders.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('products.name')
            ->pluck('total_quantity', 'products.name');

        // Monthly
        $topVendorsMonthly = (clone $baseQuery)
            ->whereMonth('orders.created_at', Carbon::now()->month)
            ->whereYear('orders.created_at', Carbon::now()->year)
            ->groupBy('products.name')
            ->pluck('total_quantity', 'products.name');

        // Yearly
        $topVendorsYearly = (clone $baseQuery)
            ->whereYear('orders.created_at', Carbon::now()->year)
            ->groupBy('products.name')
            ->pluck('total_quantity', 'products.name');

        $supportTickets = [];

        $supportTickets['all_tickets'] = SupportTicket::query()
            ->where('vendor_id', auth('vendor')->id())
            ->get();

        $supportTickets['all_open_tickets'] = SupportTicket::query()
            ->where('status', 'open')
            ->where('vendor_id', auth('vendor')->id())
            ->get();

        $supportTickets['all_close_tickets'] = SupportTicket::query()
            ->where('status', 'close')
            ->where('vendor_id', auth('vendor')->id())
            ->get();

        $supportTickets['all_high_tickets'] = SupportTicket::query()
            ->where('priority', 'high')
            ->where('vendor_id', auth('vendor')->id())
            ->get();
        $supportTickets['all_low_tickets'] = SupportTicket::query()
            ->where('priority', 'low')
            ->where('vendor_id', auth('vendor')->id())
            ->get();
        $supportTickets['all_medium_tickets'] = SupportTicket::query()
            ->where('priority', 'medium')
            ->where('vendor_id', auth('vendor')->id())
            ->get();

        //Vendor withdraw
        $pendingWithdraw = VendorWithdrawRequest::query()
            ->where('vendor_id', auth('vendor')->id())
            ->where('request_status', 'pending')
            ->get();
        $processingWithdraw = VendorWithdrawRequest::query()
            ->where('vendor_id', auth('vendor')->id())
            ->where('request_status', 'processing')
            ->get();
        $completedWithdraw = VendorWithdrawRequest::query()
            ->where('vendor_id', auth('vendor')->id())
            ->where('request_status', 'completed')
            ->get();
        $failedWithdraw = VendorWithdrawRequest::query()
            ->where('vendor_id', auth('vendor')->id())
            ->where('request_status', 'failed')
            ->get();
        $refundedWithdraw = VendorWithdrawRequest::query()
            ->where('vendor_id', auth('vendor')->id())
            ->where('request_status', 'refunded')
            ->get();
        $cancelledWithdraw = VendorWithdrawRequest::query()
            ->where('vendor_id', auth('vendor')->id())
            ->where('request_status', 'cancelled')
            ->get();

        //Product
        $publishProduct = Product::query()
            ->where('vendor_id', auth('vendor')->id())
            ->where('product_status', 'publish')
            ->get();
        $unpublishProduct = Product::query()
            ->where('vendor_id', auth('vendor')->id())
            ->where('product_status', 'unpublish')
            ->get();
        $rejectedProduct = Product::query()
            ->where('vendor_id', auth('vendor')->id())
            ->where('product_status', 'rejected')
            ->get();
        return view("vendor::vendor.home.index", compact(
            'supportTickets',
            'topVendorsDaily',
            'topVendorsWeekly',
            'topVendorsMonthly',
            'topVendorsYearly',
            'pendingWithdraw',
            'processingWithdraw',
            'completedWithdraw',
            'failedWithdraw',
            'refundedWithdraw',
            'cancelledWithdraw',
            'publishProduct',
            'unpublishProduct',
            'rejectedProduct',
        ));
    }

    public function getIncomeData(Request $request) {
        $type = $request->input('type', 'daily');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $vendorId = auth('vendor')->id();

        $base = SubOrder::query()
            ->where('vendor_id', $vendorId)
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'));

        // Determine default range
        if ($startDate && $endDate) {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
        } else {
            switch ($type) {
            case 'daily':
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                break;

            case 'weekly':
                $start = Carbon::now()->startOfMonth()->startOfWeek(Carbon::MONDAY);
                $end = Carbon::now()->endOfMonth()->endOfWeek(Carbon::SUNDAY);
                break;

            case 'monthly':
                $start = Carbon::now()->startOfYear();
                $end = Carbon::now()->endOfYear();
                break;

            case 'yearly':
                $start = Carbon::now()->subYears(4)->startOfYear(); // last 5 years
                $end = Carbon::now()->endOfYear();
                break;
            }
        }

        $query = $base->clone()->whereBetween('created_at', [$start, $end]);
        $data = [];

        switch ($type) {
        // =============== DAILY ===============
        case 'daily':
            $sums = $query->selectRaw('DATE(created_at) as d, SUM(total_amount) as a')
                ->groupBy('d')->pluck('a', 'd');

            $cursor = $start->copy();
            while ($cursor->lte($end)) {
                $lbl = $cursor->toDateString();
                $data[$lbl] = (float) ($sums[$lbl] ?? 0.0);
                $cursor->addDay();
            }
            break;

        // =============== WEEKLY ===============
        case 'weekly':
            $sums = $query->selectRaw('YEARWEEK(created_at, 3) as yw, SUM(total_amount) as a')
                ->groupBy('yw')->pluck('a', 'yw');

            $cursor = $start->copy()->startOfWeek(Carbon::MONDAY);
            while ($cursor->lte($end)) {
                $isoYear = $cursor->format('o');
                $isoWeek = $cursor->format('W');
                $key = (int) ($isoYear . str_pad($isoWeek, 2, '0', STR_PAD_LEFT));
                $label = 'W' . $isoWeek . ', ' . $cursor->copy()->endOfWeek()->format('M-Y');
                $data[$label] = (float) ($sums[$key] ?? 0.0);
                $cursor->addWeek();
            }
            break;

        // =============== MONTHLY ===============
        case 'monthly':
            $sums = $query->selectRaw('YEAR(created_at) as y, MONTH(created_at) as m, SUM(total_amount) as a')
                ->groupBy('y', 'm')
                ->get()
                ->reduce(function ($carry, $row) {
                    $carry[sprintf('%04d-%02d', $row->y, $row->m)] = (float) $row->a;
                    return $carry;
                }, []);

            $cursor = $start->copy();
            while ($cursor->lte($end)) {
                $key = $cursor->format('Y-m');
                $label = $cursor->format('M Y');
                $data[$label] = (float) ($sums[$key] ?? 0.0);
                $cursor->addMonth();
            }
            break;

        // =============== YEARLY ===============
        case 'yearly':
            $sums = $query->selectRaw('YEAR(created_at) as y, SUM(total_amount) as a')
                ->groupBy('y')
                ->pluck('a', 'y');

            $cursor = $start->copy();
            while ($cursor->lte($end)) {
                $year = $cursor->format('Y');
                $data[$year] = (float) ($sums[$year] ?? 0.0);
                $cursor->addYear();
            }
            break;
        }

        return response()->json($data);
    }

    public function getVendorProductsData(Request $request) {
        $type = $request->input('type', 'daily');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $start = \Carbon\Carbon::parse($startDate)->startOfDay();
            $end = \Carbon\Carbon::parse($endDate)->endOfDay();
        } else {
            switch ($type) {
            case 'daily':
                $start = now()->startOfMonth();
                $end = now()->endOfMonth();
                break;
            case 'weekly':
                $start = now()->startOfMonth()->startOfWeek();
                $end = now()->endOfMonth()->endOfWeek();
                break;
            case 'monthly':
                $start = now()->startOfYear();
                $end = now()->endOfYear();
                break;
            case 'yearly':
                $start = now()->subYears(4)->startOfYear();
                $end = now()->endOfYear();
                break;
            }
        }

        $vendorId = auth('vendor')->id();

        $base = \DB::table('sub_order_items')
            ->join('orders', 'sub_order_items.order_id', '=', 'orders.id')
            ->join('products', 'sub_order_items.product_id', '=', 'products.id')
            ->join('sub_orders', 'sub_order_items.sub_order_id', '=', 'sub_orders.id')
            ->where('sub_orders.vendor_id', $vendorId)
            ->whereBetween('orders.created_at', [$start, $end]);

        $data = [];

        $makeBucket = function ($label, $top) {
            return $top
            ? ['name' => \Illuminate\Support\Str::limit($top->name, 100, '...'), 'value' => (int) $top->value]
            : ['name' => 'None', 'value' => 0];
        };

        switch ($type) {
        case 'daily':
            for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                $top = (clone $base)
                    ->whereBetween('orders.created_at', [$date->copy()->startOfDay(), $date->copy()->endOfDay()])
                    ->selectRaw('COALESCE(products.name,"Unknown") as name, SUM(sub_order_items.quantity) as value')
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('value')
                    ->first();
                $data[$date->toDateString()] = $makeBucket($date->toDateString(), $top);
            }
            break;

        case 'weekly':
            for ($cursor = $start->copy(); $cursor->lte($end); $cursor->addWeek()) {
                $weekStart = $cursor->copy()->startOfWeek();
                $weekEnd = $cursor->copy()->endOfWeek();
                $top = (clone $base)
                    ->whereBetween('orders.created_at', [$weekStart, $weekEnd])
                    ->selectRaw('COALESCE(products.name,"Unknown") as name, SUM(sub_order_items.quantity) as value')
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('value')
                    ->first();
                $label = 'W' . $cursor->format('W') . ', ' . $cursor->format('M-Y');
                $data[$label] = $makeBucket($label, $top);
            }
            break;

        case 'monthly':
            for ($cursor = $start->copy(); $cursor->lte($end); $cursor->addMonth()) {
                $monthStart = $cursor->copy()->startOfMonth();
                $monthEnd = $cursor->copy()->endOfMonth();
                $top = (clone $base)
                    ->whereBetween('orders.created_at', [$monthStart, $monthEnd])
                    ->selectRaw('COALESCE(products.name,"Unknown") as name, SUM(sub_order_items.quantity) as value')
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('value')
                    ->first();
                $label = $cursor->format('M Y');
                $data[$label] = $makeBucket($label, $top);
            }
            break;

        case 'yearly':
            for ($cursor = $start->copy(); $cursor->lte($end); $cursor->addYear()) {
                $yearStart = $cursor->copy()->startOfYear();
                $yearEnd = $cursor->copy()->endOfYear();
                $top = (clone $base)
                    ->whereBetween('orders.created_at', [$yearStart, $yearEnd])
                    ->selectRaw('COALESCE(products.name,"Unknown") as name, SUM(sub_order_items.quantity) as value')
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('value')
                    ->first();
                $label = $cursor->format('Y');
                $data[$label] = $makeBucket($label, $top);
            }
            break;
        }

        return response()->json($data);
    }

    public function user_email_verify_index() {
        $user_details = Auth::guard('vendor')->user();

        if ($user_details->email_verified == 1) {
            return redirect()->route('vendor.home');
        }

        if (empty($user_details->email_verify_token)) {
            Vendor::find($user_details->id)->update(['email_verify_token' => \Str::random(8)]);

            $user_details = Vendor::find($user_details->id);
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

        return view('vendor::vendor.vendor.email-verify');
    }

    public function reset_user_email_verify_code() {
        $user_details = Auth::guard('vendor')->user();
        if ($user_details->email_verified == 1) {
            return redirect()->route('vendor.home');
        }

        $message_body = __('Here is your verification code') . ' <span class="verify-code">' . $user_details->email_verify_token . '</span>';

        try {
            Mail::to($user_details->email)->send(new BasicMail([
                'subject' => __('Verify your email address'),
                'message' => $message_body,
            ]));
        } catch (\Exception $e) {
            return redirect()->route('vendor.email.verify')->with(['msg' => $e->getMessage(), 'type' => 'danger']);
        }

        return redirect()->route('vendor.email.verify')->with(['msg' => __('Resend Verify Email Success'), 'type' => 'success']);
    }

    public function user_email_verify(Request $request) {
        $request->validate([
            'verification_code' => 'required',
        ], [
            'verification_code.required' => __('verify code is required'),
        ]);

        $user_details = Auth::guard('vendor')->user();
        $user_info = Vendor::where(['id' => $user_details->id, 'email_verify_token' => $request->verification_code])->first();

        if (empty($user_info)) {
            return redirect()->back()->with(['msg' => __('your verification code is wrong, try again'), 'type' => 'danger']);
        }

        $user_info->email_verified = 1;
        $user_info->save();

        return redirect()->route('vendor.home');
    }

    public function get_state(Request $request): JsonResponse {
        $id = $request->validate(["country_id" => "required"]);
        $states = State::where("country_id", $id)->get();

        return response()->json(["success" => true, "type" => "success"] + render_view_for_nice_select($states));
    }
    public function get_city(Request $request): JsonResponse {
        $id = $request->validate(["country_id" => "required", "state_id" => "required"]);
        $states = City::where($id)->get();

        return response()->json(["success" => true, "type" => "success"] + render_view_for_nice_select($states));
    }
}
