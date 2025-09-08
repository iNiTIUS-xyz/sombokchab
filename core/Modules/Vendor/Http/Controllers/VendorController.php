<?php

namespace Modules\Vendor\Http\Controllers;

use Carbon\Carbon;
use App\Mail\BasicMail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Vendor\Entities\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Order\Entities\SubOrder;
use Modules\CountryManage\Entities\City;
use Modules\CountryManage\Entities\State;
use Modules\SupportTicket\Entities\SupportTicket;

class VendorController extends Controller
{
    public function adminIndex()
    {
        return "Admin Index method rendered";
    }

    public function index()
    {
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

        return view("vendor::vendor.home.index", compact(
            'supportTickets',
            'topVendorsDaily',
            'topVendorsWeekly',
            'topVendorsMonthly',
            'topVendorsYearly',
        ));
    }

    public function getIncomeData(Request $request)
    {
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = SubOrder::query()
            ->where('vendor_id', auth("vendor")->id())
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'));

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        switch ($type) {
            case 'daily':
                $data = $query->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date, SUM(total_amount) as amount")
                    ->when(!$startDate || !$endDate, fn($q) => $q->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay()))
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->pluck('amount', 'date')
                    ->toArray();
                break;

            case 'weekly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    WEEK(created_at, 1) as week_number,
                    CONCAT('Week ', WEEK(created_at, 1)) as week,
                    SUM(total_amount) as amount
                ")
                        ->groupBy('year', 'week_number', 'week')
                        ->orderBy('year', 'asc')
                        ->orderBy('week_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->week => $item->amount])
                        ->toArray();
                } else {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    WEEK(created_at, 1) as week_number,
                    CONCAT('Week ', WEEK(created_at, 1)) as week,
                    SUM(total_amount) as amount
                ")
                        ->where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('year', 'week_number', 'week')
                        ->orderBy('year', 'asc')
                        ->orderBy('week_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->week => $item->amount])
                        ->toArray();
                }
                break;

            case 'monthly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    MONTH(created_at) as month_number,
                    DATE_FORMAT(created_at, '%M %Y') as month_name,
                    SUM(total_amount) as amount
                ")
                        ->groupBy('year', 'month_number', 'month_name')
                        ->orderBy('year', 'asc')
                        ->orderBy('month_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->month_name => $item->amount])
                        ->toArray();
                } else {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    MONTH(created_at) as month_number,
                    DATE_FORMAT(created_at, '%M') as month_name,
                    SUM(total_amount) as amount
                ")
                        ->whereYear('created_at', Carbon::now()->year)
                        ->groupBy('year', 'month_number', 'month_name')
                        ->orderBy('year', 'asc')
                        ->orderBy('month_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->month_name => $item->amount])
                        ->toArray();
                }
                break;

            case 'yearly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    SUM(total_amount) as amount
                ")
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->get()
                        ->pluck('amount', 'year')
                        ->toArray();
                } else {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    SUM(total_amount) as amount
                ")
                        ->where('created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
                        ->where('created_at', '<=', Carbon::now()->endOfYear())
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->get()
                        ->pluck('amount', 'year')
                        ->toArray();
                }
                break;

            default:
                $data = [];
                break;
        }

        return response()->json($data);
    }

    public function getProductsData(Request $request)
    {
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('start_date');

        $query = DB::table('sub_order_items')
            ->join('sub_orders', 'sub_order_items.sub_order_id', '=', 'sub_orders.id')
            ->join('orders', 'sub_orders.order_id', '=', 'orders.id')
            ->join('products', 'sub_order_items.product_id', '=', 'products.id')
            ->where('sub_orders.vendor_id', auth("vendor")->id())
            ->select(
                'products.name',
                DB::raw('SUM(sub_order_items.quantity) as total_quantity')
            );

        if ($startDate && $endDate) {
            $query->whereBetween('orders.created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        switch ($type) {
            case 'daily':
                $data = $query->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') as date, SUM(sub_order_items.quantity) as total_quantity")
                    ->when(!$startDate || !$endDate, fn($q) => $q->where('orders.created_at', '>=', Carbon::now()->subDays(6)->startOfDay()))
                    ->groupBy('date', 'products.name')
                    ->orderBy('date', 'asc')
                    ->get()
                    ->groupBy('date')
                    ->map(function ($group) {
                        return $group->pluck('total_quantity', 'products.name')->toArray();
                    })
                    ->first() ?? [];
                break;

            case 'weekly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                        YEAR(orders.created_at) as year,
                        WEEK(orders.created_at, 1) as week_number,
                        CONCAT('Week ', WEEK(orders.created_at, 1)) as week,
                        products.name,
                        SUM(sub_order_items.quantity) as total_quantity
                    ")
                        ->groupBy('year', 'week_number', 'week', 'products.name')
                        ->orderBy('year', 'asc')
                        ->orderBy('week_number', 'asc')
                        ->get()
                        ->groupBy('week')
                        ->map(function ($group) {
                            return $group->pluck('total_quantity', 'products.name')->toArray();
                        })
                        ->first() ?? [];
                } else {
                    $data = $query->selectRaw("
                        YEAR(orders.created_at) as year,
                        WEEK(orders.created_at, 1) as week_number,
                        CONCAT('Week ', WEEK(orders.created_at, 1)) as week,
                        products.name,
                        SUM(sub_order_items.quantity) as total_quantity
                    ")
                        ->where('orders.created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('orders.created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('year', 'week_number', 'week', 'products.name')
                        ->orderBy('year', 'asc')
                        ->orderBy('week_number', 'asc')
                        ->get()
                        ->groupBy('week')
                        ->map(function ($group) {
                            return $group->pluck('total_quantity', 'products.name')->toArray();
                        })
                        ->first() ?? [];
                }
                break;

            case 'monthly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                        YEAR(orders.created_at) as year,
                        MONTH(orders.created_at) as month_number,
                        DATE_FORMAT(orders.created_at, '%M %Y') as month_name,
                        products.name,
                        SUM(sub_order_items.quantity) as total_quantity
                    ")
                        ->groupBy('year', 'month_number', 'month_name', 'products.name')
                        ->orderBy('year', 'asc')
                        ->orderBy('month_number', 'asc')
                        ->get()
                        ->groupBy('month_name')
                        ->map(function ($group) {
                            return $group->pluck('total_quantity', 'products.name')->toArray();
                        })
                        ->first() ?? [];
                } else {
                    $data = $query->selectRaw("
                        YEAR(orders.created_at) as year,
                        MONTH(orders.created_at) as month_number,
                        DATE_FORMAT(orders.created_at, '%M') as month_name,
                        products.name,
                        SUM(sub_order_items.quantity) as total_quantity
                    ")
                        ->whereYear('orders.created_at', Carbon::now()->year)
                        ->groupBy('year', 'month_number', 'month_name', 'products.name')
                        ->orderBy('year', 'asc')
                        ->orderBy('month_number', 'asc')
                        ->get()
                        ->groupBy('month_name')
                        ->map(function ($group) {
                            return $group->pluck('total_quantity', 'products.name')->toArray();
                        })
                        ->first() ?? [];
                }
                break;

            case 'yearly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                        YEAR(orders.created_at) as year,
                        products.name,
                        SUM(sub_order_items.quantity) as total_quantity
                    ")
                        ->groupBy('year', 'products.name')
                        ->orderBy('year', 'asc')
                        ->get()
                        ->groupBy('year')
                        ->map(function ($group) {
                            return $group->pluck('total_quantity', 'products.name')->toArray();
                        })
                        ->first() ?? [];
                } else {
                    $data = $query->selectRaw("
                        YEAR(orders.created_at) as year,
                        products.name,
                        SUM(sub_order_items.quantity) as total_quantity
                    ")
                        ->where('orders.created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
                        ->where('orders.created_at', '<=', Carbon::now()->endOfYear())
                        ->groupBy('year', 'products.name')
                        ->orderBy('year', 'asc')
                        ->get()
                        ->groupBy('year')
                        ->map(function ($group) {
                            return $group->pluck('total_quantity', 'products.name')->toArray();
                        })
                        ->first() ?? [];
                }
                break;

            default:
                $data = [];
                break;
        }

        return response()->json($data);
    }

    public function user_email_verify_index()
    {
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
                    'message' => $message_body
                ]));
            } catch (\Exception $e) {
                //
            }
        }

        return view('vendor::vendor.vendor.email-verify');
    }

    public function reset_user_email_verify_code()
    {
        $user_details = Auth::guard('vendor')->user();
        if ($user_details->email_verified == 1) {
            return redirect()->route('vendor.home');
        }

        $message_body = __('Here is your verification code') . ' <span class="verify-code">' . $user_details->email_verify_token . '</span>';

        try {
            Mail::to($user_details->email)->send(new BasicMail([
                'subject' => __('Verify your email address'),
                'message' => $message_body
            ]));
        } catch (\Exception $e) {
            return redirect()->route('vendor.email.verify')->with(['msg' => $e->getMessage(), 'type' => 'danger']);
        }

        return redirect()->route('vendor.email.verify')->with(['msg' => __('Resend Verify Email Success'), 'type' => 'success']);
    }

    public function user_email_verify(Request $request)
    {
        $request->validate([
            'verification_code' => 'required'
        ], [
            'verification_code.required' => __('verify code is required')
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

    public function get_state(Request $request): JsonResponse
    {
        $id = $request->validate(["country_id" => "required"]);
        $states = State::where("country_id", $id)->get();

        return response()->json(["success" => true, "type" => "success"] + render_view_for_nice_select($states));
    }
    public function get_city(Request $request): JsonResponse
    {
        $id = $request->validate(["country_id" => "required", "state_id" => "required"]);
        $states = City::where($id)->get();

        return response()->json(["success" => true, "type" => "success"] + render_view_for_nice_select($states));
    }
}
