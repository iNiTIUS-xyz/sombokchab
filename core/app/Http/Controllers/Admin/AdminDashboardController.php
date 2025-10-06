<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Admin;
use App\Language;
use Carbon\Carbon;
use App\ContactInfoItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Vendor\Entities\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Order\Entities\SubOrder;
use Modules\Product\Entities\Product;
use Modules\Campaign\Entities\Campaign;
use Modules\Refund\Entities\RefundRequest;
use Modules\Product\Entities\ProductSellInfo;
use Modules\SupportTicket\Entities\SupportTicket;
use Modules\Wallet\Entities\VendorWithdrawRequest;

class AdminDashboardController extends Controller
{
    public function adminIndex()
    {
        $topVendors = SubOrder::selectRaw("
                vendors.id,
                vendors.owner_name as name,
                SUM(total_amount) as total_amount
            ")
            ->join('vendors', 'sub_orders.vendor_id', '=', 'vendors.id')
            ->whereNotNull('vendor_id')
            ->where('sub_orders.created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('vendors.id', 'vendors.owner_name')
            ->orderByDesc('total_amount')
            ->take(10)
            ->get();

        $vendorIds = $topVendors->pluck('id');

        $topVendorsInfos = Vendor::query()
            ->with([
                'vendor_shop_info.cover_photo',
                'vendor_shop_info.logo'
            ])
            ->whereIn('id', $vendorIds)
            ->get()
            ->map(function ($vendor) use ($topVendors) {

                $amount = $topVendors->firstWhere('id', $vendor->id)->total_amount;
                return [
                    'id' => $vendor->id,
                    'name' => $vendor->owner_name,
                    'total_amount' => $amount,
                    'logo' => optional($vendor->vendor_shop_info->logo)->path,
                ];
            });

        $campaign = Campaign::query()
            ->where('status', 'publish')
            ->get();

        $vendor = Vendor::query()
            ->get();

        $vendorRequest = Vendor::query()
            ->where('is_vendor_verified', 0)
            ->get();

        $products = Product::query()
            ->get();

        $productsPending = Product::query()
            ->where('product_status', '!=', 'publish')
            ->get();

        $vendorWithdrawRequests = VendorWithdrawRequest::query()
            ->where('request_status', 'pending')
            ->get();

        $supportTickets = SupportTicket::query()
            ->where('priority', 'high')
            ->get();
        $refundRequests = RefundRequest::query()
            ->where('status', 'pending')
            ->get();

        $customerTicketData = [];

        $customerTicketData['totalOpenTicket'] = SupportTicket::query()
            ->where('user_id', '!=', null)
            ->where('status', 'open')
            ->get();

        $customerTicketData['totalCloseTicket'] = SupportTicket::query()
            ->where('user_id', '!=', null)
            ->where('status', 'close')
            ->get();

        $customerTicketData['refundRequest'] = RefundRequest::query()
            ->where('user_id', '!=', null)
            ->get();

        $vendorTicketData = [];

        $vendorTicketData['vendorTotalOpenTicket'] = SupportTicket::query()
            ->where('vendor_id', '!=', null)
            ->where('status', 'open')
            ->get();

        $vendorTicketData['vendorTotalCloseTicket'] = SupportTicket::query()
            ->where('vendor_id', '!=', null)
            ->where('status', 'close')
            ->get();

        $vendorTicketData['vendorTotalPriorityTicket'] = SupportTicket::query()
            ->where('vendor_id', '!=', null)
            ->where('priority', 'high')
            ->get();

        $baseQuery = DB::table('sub_order_items')
            ->join('orders', 'sub_order_items.order_id', '=', 'orders.id')
            ->join('products', 'sub_order_items.product_id', '=', 'products.id')
            ->select('products.id', 'products.name', DB::raw('SUM(sub_order_items.quantity) as total_quantity'));

        $topProducts = (clone $baseQuery)
            ->whereYear('orders.created_at', Carbon::now()->year)
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_quantity', 'desc')
            ->limit(10)
            ->get();

        $vendorWithdrawData = [];

        $vendorWithdrawData['totalwithdraw'] = VendorWithdrawRequest::query()
            ->get();

        $vendorWithdrawData['pendingwithdraw'] = VendorWithdrawRequest::query()
            ->where('request_status', 'pending')
            ->get();

        $vendorWithdrawData['totalNotPendingWithdraw'] = VendorWithdrawRequest::query()
            ->where('request_status', '!=', 'pending')
            ->get();

        $totalVendors = Vendor::get();
        $totalAdmin = Admin::get();
        $totalCustomer = User::get();

        $pass_reset_count = DB::table('password_resets')->count();

        return view('backend.admin-home')->with([
            'campaign' => $campaign,
            'vendor' => $vendor,
            'vendorRequest' => $vendorRequest,
            'products' => $products,
            'productsPending' => $productsPending,
            'vendorWithdrawRequests' => $vendorWithdrawRequests,
            'supportTickets' => $supportTickets,
            'refundRequests' => $refundRequests,
            'customerTicketData' => $customerTicketData,
            'vendorTicketData' => $vendorTicketData,

            'totalVendors' => $totalVendors,
            'totalAdmin' => $totalAdmin,
            'totalCustomer' => $totalCustomer,

            'vendorWithdrawData' => $vendorWithdrawData,

            'topProducts' => $topProducts,
            'topVendorsInfos' => $topVendorsInfos,

            'pass_reset_count' => $pass_reset_count,
        ]);
    }

    public function getVendorData(Request $request)
    {
        $type      = $request->input('type', 'daily');
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        // Establish the effective range based on defaults you described
        if ($startDate && $endDate) {
            $start = \Carbon\Carbon::parse($startDate)->startOfDay();
            $end   = \Carbon\Carbon::parse($endDate)->endOfDay();
        } else {
            switch ($type) {
                case 'daily':
                    $start = \Carbon\Carbon::now()->startOfMonth();
                    $end   = \Carbon\Carbon::now()->endOfMonth();
                    break;
                case 'weekly':
                    $start = \Carbon\Carbon::now()->startOfMonth()->startOfWeek(\Carbon\Carbon::MONDAY);
                    $end   = \Carbon\Carbon::now()->endOfMonth()->endOfWeek(\Carbon\Carbon::SUNDAY);
                    break;
                case 'monthly':
                    $start = \Carbon\Carbon::now()->startOfYear();
                    $end   = \Carbon\Carbon::now()->endOfYear();
                    break;
                case 'yearly':
                    $start = \Carbon\Carbon::now()->subYears(4)->startOfYear(); // last 5 years including current
                    $end   = \Carbon\Carbon::now()->endOfYear();
                    break;
                default:
                    $start = \Carbon\Carbon::now()->startOfMonth();
                    $end   = \Carbon\Carbon::now()->endOfMonth();
            }
        }

        // Base query constrained by range (for performance)
        $base = Vendor::query()
            ->whereBetween('created_at', [$start->copy()->startOfDay(), $end->copy()->endOfDay()]);

        $data = [];

        switch ($type) {
            case 'daily': {
                // counts grouped by date
                $counts = $base->clone()
                    ->selectRaw('DATE(created_at) as d, COUNT(*) as c')
                    ->groupBy('d')
                    ->pluck('c', 'd');

                // build full day range with zeros
                $cursor = $start->copy()->startOfDay();
                while ($cursor->lte($end)) {
                    $lbl = $cursor->toDateString(); // YYYY-MM-DD
                    $data[$lbl] = (int) ($counts[$lbl] ?? 0);
                    $cursor->addDay();
                }
                break;
            }

            case 'weekly': {
                // ISO week key (oW => ISO year + week). Example: 202536
                $counts = $base->clone()
                    ->selectRaw('YEARWEEK(created_at, 3) as yw, COUNT(*) as c') // 3 => ISO week, Monday start
                    ->groupBy('yw')
                    ->pluck('c', 'yw');

                // iterate weeks from Monday..Sunday
                $cursorStart = $start->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
                $rangeEnd    = $end->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

                while ($cursorStart->lte($rangeEnd)) {
                    $isoYear = (int) $cursorStart->format('o');  // ISO year
                    $isoWeek = (int) $cursorStart->format('W');  // 1..53
                    $key     = (int) ($isoYear . str_pad((string)$isoWeek, 2, '0', STR_PAD_LEFT)); // matches YEARWEEK(...,3)

                    // Label: "W{week}, {Mon-YYYY}" using the week *start* month
                    // $label = 'W' . $isoWeek . ', ' . $cursorStart->format('M-Y');
                    $label = 'W' . $isoWeek . ', ' . $cursorStart->copy()->endOfWeek(\Carbon\Carbon::SUNDAY)->format('M-Y');

                    $data[$label] = (int) ($counts[$key] ?? 0);

                    $cursorStart->addWeek();
                }
                break;
            }

            case 'monthly': {
                // counts grouped by month/year
                $counts = $base->clone()
                    ->selectRaw('YEAR(created_at) as y, MONTH(created_at) as m, COUNT(*) as c')
                    ->groupBy('y', 'm')
                    ->get()
                    ->reduce(function ($carry, $row) {
                        $key = sprintf('%04d-%02d', $row->y, $row->m);
                        $carry[$key] = (int) $row->c;
                        return $carry;
                    }, []);

                $cursor = $start->copy()->startOfMonth();
                while ($cursor->lte($end)) {
                    $key   = $cursor->format('Y-m');
                    $label = $cursor->format('M Y'); // "Jan 2025"
                    $data[$label] = (int) ($counts[$key] ?? 0);
                    $cursor->addMonth();
                }
                break;
            }

            case 'yearly': {
                $counts = $base->clone()
                    ->selectRaw('YEAR(created_at) as y, COUNT(*) as c')
                    ->groupBy('y')
                    ->pluck('c', 'y');

                $cursor = $start->copy()->startOfYear();
                while ($cursor->lte($end)) {
                    $year = (int) $cursor->format('Y');
                    $data[(string)$year] = (int) ($counts[$year] ?? 0);
                    $cursor->addYear();
                }
                break;
            }

            default:
                // fall back to empty
                $data = [];
        }

        return response()->json($data);
    }


    public function getCustomerData(Request $request)
    {
        $type      = $request->input('type', 'daily');
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        if ($startDate && $endDate) {
            $start = \Carbon\Carbon::parse($startDate)->startOfDay();
            $end   = \Carbon\Carbon::parse($endDate)->endOfDay();
        } else {
            switch ($type) {
                case 'daily':
                    $start = \Carbon\Carbon::now()->startOfMonth();
                    $end   = \Carbon\Carbon::now()->endOfMonth();
                    break;
                case 'weekly':
                    $start = \Carbon\Carbon::now()->startOfMonth()->startOfWeek(\Carbon\Carbon::MONDAY);
                    $end   = \Carbon\Carbon::now()->endOfMonth()->endOfWeek(\Carbon\Carbon::SUNDAY);
                    break;
                case 'monthly':
                    $start = \Carbon\Carbon::now()->startOfYear();
                    $end   = \Carbon\Carbon::now()->endOfYear();
                    break;
                case 'yearly':
                    $start = \Carbon\Carbon::now()->subYears(4)->startOfYear(); // last 5 incl. current
                    $end   = \Carbon\Carbon::now()->endOfYear();
                    break;
                default:
                    $start = \Carbon\Carbon::now()->startOfMonth();
                    $end   = \Carbon\Carbon::now()->endOfMonth();
            }
        }

        $base = User::query()
            ->whereBetween('created_at', [$start->copy()->startOfDay(), $end->copy()->endOfDay()]);

        $out = [];

        switch ($type) {
            case 'daily': {
                $counts = $base->clone()
                    ->selectRaw('DATE(created_at) as d, COUNT(*) as c')
                    ->groupBy('d')
                    ->pluck('c', 'd');

                $cursor = $start->copy()->startOfDay();
                while ($cursor->lte($end)) {
                    $lbl = $cursor->toDateString(); // YYYY-MM-DD
                    $out[$lbl] = (int)($counts[$lbl] ?? 0);
                    $cursor->addDay();
                }
                break;
            }

            case 'weekly': {
                // keyed by ISO YEARWEEK (mode 3 = ISO weeks)
                $counts = $base->clone()
                    ->selectRaw('YEARWEEK(created_at, 3) as yw, COUNT(*) as c')
                    ->groupBy('yw')
                    ->pluck('c', 'yw');

                $cursor = $start->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
                $rangeEnd = $end->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

                while ($cursor->lte($rangeEnd)) {
                    $isoYear = (int)$cursor->format('o');
                    $isoWeek = (int)$cursor->format('W');
                    $key     = (int)($isoYear . str_pad((string)$isoWeek, 2, '0', STR_PAD_LEFT));
                    $label   = 'W' . $isoWeek . ', ' . $cursor->format('M-Y'); // e.g., W36, Sep-2025
                    $out[$label] = (int)($counts[$key] ?? 0);
                    $cursor->addWeek();
                }
                break;
            }

            case 'monthly': {
                $counts = $base->clone()
                    ->selectRaw('YEAR(created_at) as y, MONTH(created_at) as m, COUNT(*) as c')
                    ->groupBy('y', 'm')
                    ->get()
                    ->reduce(function($carry, $r) {
                        $carry[sprintf('%04d-%02d', $r->y, $r->m)] = (int)$r->c;
                        return $carry;
                    }, []);

                $cursor = $start->copy()->startOfMonth();
                while ($cursor->lte($end)) {
                    $key   = $cursor->format('Y-m');
                    $label = $cursor->format('M Y'); // Jan 2025
                    $out[$label] = (int)($counts[$key] ?? 0);
                    $cursor->addMonth();
                }
                break;
            }

            case 'yearly': {
                $counts = $base->clone()
                    ->selectRaw('YEAR(created_at) as y, COUNT(*) as c')
                    ->groupBy('y')
                    ->pluck('c', 'y');

                $cursor = $start->copy()->startOfYear();
                while ($cursor->lte($end)) {
                    $year = (int)$cursor->format('Y');
                    $out[(string)$year] = (int)($counts[$year] ?? 0);
                    $cursor->addYear();
                }
                break;
            }

            default:
                $out = [];
        }

        return response()->json($out);
    }


    public function getIncomeData(Request $request)
    {
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = SubOrder::query()
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'));

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        switch ($type) {
            case 'daily':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date, SUM(total_amount) as amount")
                        ->whereBetween('created_at', [
                            Carbon::parse($startDate)->startOfDay(),
                            Carbon::parse($endDate)->endOfDay()
                        ])
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->pluck('amount', 'date')
                        ->toArray();
                } else {
                    $data = $query->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date, SUM(total_amount) as amount")
                        ->where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->pluck('amount', 'date')
                        ->toArray();
                }
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
                        ->mapWithKeys(function ($item) {
                            $weekStart = Carbon::parse($item->week_start)->format('j');
                            $weekEnd   = Carbon::parse($item->week_end)->format('j M');
                            $label = "W {$item->week_number} ({$weekStart} - {$weekEnd})";
                            return [$label => $item->amount];
                        })
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
                        ->mapWithKeys(function ($item) {
                            $weekStart = Carbon::parse($item->week_start)->format('j');
                            $weekEnd   = Carbon::parse($item->week_end)->format('j M');
                            $label = "W {$item->week_number} ({$weekStart} - {$weekEnd})";
                            return [$label => $item->amount];
                        })
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

public function getTopVendorsData(Request $request)
{
    $type      = $request->input('type', 'daily');
    $startDate = $request->input('start_date');
    $endDate   = $request->input('end_date');

    // ---- Align default windows with your signup charts ----
    if ($startDate && $endDate) {
        $start = \Carbon\Carbon::parse($startDate)->startOfDay();
        $end   = \Carbon\Carbon::parse($endDate)->endOfDay();
    } else {
        switch ($type) {
            case 'daily':
                $start = \Carbon\Carbon::now()->startOfMonth();
                $end   = \Carbon\Carbon::now()->endOfMonth();
                break;
            case 'weekly':
                $start = \Carbon\Carbon::now()->startOfMonth()->startOfWeek(\Carbon\Carbon::MONDAY);
                $end   = \Carbon\Carbon::now()->endOfMonth()->endOfWeek(\Carbon\Carbon::SUNDAY);
                break;
            case 'monthly':
                $start = \Carbon\Carbon::now()->startOfYear();
                $end   = \Carbon\Carbon::now()->endOfYear();
                break;
            case 'yearly':
                $start = \Carbon\Carbon::now()->subYears(4)->startOfYear(); // last 5 incl current
                $end   = \Carbon\Carbon::now()->endOfYear();
                break;
            default:
                $start = \Carbon\Carbon::now()->startOfMonth();
                $end   = \Carbon\Carbon::now()->endOfMonth();
        }
    }

    // ---- Base query within window (delivered only, like before) ----
    $base = SubOrder::query()
        ->join('vendors', 'sub_orders.vendor_id', '=', 'vendors.id')
        ->whereNotNull('sub_orders.vendor_id')
        ->whereHas('orderTrack', fn ($q) => $q->where('name', 'delivered'))
        ->whereBetween('sub_orders.created_at', [$start->copy()->startOfDay(), $end->copy()->endOfDay()]);

    $data = [];

    switch ($type) {
        case 'daily': {
            $cursor = $start->copy()->startOfDay();
            while ($cursor->lte($end)) {
                $bucketStart = $cursor->copy()->startOfDay();
                $bucketEnd = $cursor->copy()->endOfDay();
                $top = $base->clone()
                    ->whereBetween('sub_orders.created_at', [$bucketStart, $bucketEnd])
                    ->selectRaw('COALESCE(vendors.owner_name, "Unknown") as name, COUNT(sub_orders.id) as value')
                    ->groupBy('vendors.id', 'vendors.owner_name')
                    ->orderByDesc('value')
                    ->first();

                $lbl = $cursor->toDateString(); // YYYY-MM-DD
                $data[$lbl] = $top ? ['name' => $top->name, 'value' => (int) $top->value] : ['name' => 'None', 'value' => 0];
                $cursor->addDay();
            }
            break;
        }

        case 'weekly': {
            $cursor = $start->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
            $rangeEnd = $end->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

            while ($cursor->lte($rangeEnd)) {
                $bucketStart = $cursor->copy()->startOfWeek();
                $bucketEnd = $cursor->copy()->endOfWeek();
                $top = $base->clone()
                    ->whereBetween('sub_orders.created_at', [$bucketStart, $bucketEnd])
                    ->selectRaw('COALESCE(vendors.owner_name, "Unknown") as name, COUNT(sub_orders.id) as value')
                    ->groupBy('vendors.id', 'vendors.owner_name')
                    ->orderByDesc('value')
                    ->first();

                $isoWeek = (int) $cursor->format('W');
                $label = 'W' . $isoWeek . ', ' . $cursor->format('M-Y');
                $data[$label] = $top ? ['name' => $top->name, 'value' => (int) $top->value] : ['name' => 'None', 'value' => 0];
                $cursor->addWeek();
            }
            break;
        }

        case 'monthly': {
            $cursor = $start->copy()->startOfMonth();
            while ($cursor->lte($end)) {
                $bucketStart = $cursor->copy()->startOfMonth();
                $bucketEnd = $cursor->copy()->endOfMonth();
                $top = $base->clone()
                    ->whereBetween('sub_orders.created_at', [$bucketStart, $bucketEnd])
                    ->selectRaw('COALESCE(vendors.owner_name, "Unknown") as name, COUNT(sub_orders.id) as value')
                    ->groupBy('vendors.id', 'vendors.owner_name')
                    ->orderByDesc('value')
                    ->first();

                $label = $cursor->format('M Y');
                $data[$label] = $top ? ['name' => $top->name, 'value' => (int) $top->value] : ['name' => 'None', 'value' => 0];
                $cursor->addMonth();
            }
            break;
        }

        case 'yearly': {
            $cursor = $start->copy()->startOfYear();
            while ($cursor->lte($end)) {
                $bucketStart = $cursor->copy()->startOfYear();
                $bucketEnd = $cursor->copy()->endOfYear();
                $top = $base->clone()
                    ->whereBetween('sub_orders.created_at', [$bucketStart, $bucketEnd])
                    ->selectRaw('COALESCE(vendors.owner_name, "Unknown") as name, COUNT(sub_orders.id) as value')
                    ->groupBy('vendors.id', 'vendors.owner_name')
                    ->orderByDesc('value')
                    ->first();

                $label = $cursor->format('Y');
                $data[$label] = $top ? ['name' => $top->name, 'value' => (int) $top->value] : ['name' => 'None', 'value' => 0];
                $cursor->addYear();
            }
            break;
        }

        default:
            $data = [];
    }

    return response()->json($data);
}


public function getTopProductsData(Request $request)
{
    $type      = $request->input('type', 'daily');
    $startDate = $request->input('start_date');
    $endDate   = $request->input('end_date');

    // ---- Align default windows with your signup charts ----
    if ($startDate && $endDate) {
        $start = \Carbon\Carbon::parse($startDate)->startOfDay();
        $end   = \Carbon\Carbon::parse($endDate)->endOfDay();
    } else {
        switch ($type) {
            case 'daily':
                $start = \Carbon\Carbon::now()->startOfMonth();
                $end   = \Carbon\Carbon::now()->endOfMonth();
                break;
            case 'weekly':
                $start = \Carbon\Carbon::now()->startOfMonth()->startOfWeek(\Carbon\Carbon::MONDAY);
                $end   = \Carbon\Carbon::now()->endOfMonth()->endOfWeek(\Carbon\Carbon::SUNDAY);
                break;
            case 'monthly':
                $start = \Carbon\Carbon::now()->startOfYear();
                $end   = \Carbon\Carbon::now()->endOfYear();
                break;
            case 'yearly':
                $start = \Carbon\Carbon::now()->subYears(4)->startOfYear(); // last 5 incl current
                $end   = \Carbon\Carbon::now()->endOfYear();
                break;
            default:
                $start = \Carbon\Carbon::now()->startOfMonth();
                $end   = \Carbon\Carbon::now()->endOfMonth();
        }
    }

    // ---- Base query within window ----
    $base = \DB::table('sub_order_items')
        ->join('orders', 'sub_order_items.order_id', '=', 'orders.id')
        ->join('products', 'sub_order_items.product_id', '=', 'products.id')
        ->whereBetween('orders.created_at', [$start->copy()->startOfDay(), $end->copy()->endOfDay()]);

    $data = [];

    switch ($type) {
        case 'daily': {
            $cursor = $start->copy()->startOfDay();
            while ($cursor->lte($end)) {
                $bucketStart = $cursor->copy()->startOfDay();
                $bucketEnd = $cursor->copy()->endOfDay();
                $top = $base->clone()
                    ->whereBetween('orders.created_at', [$bucketStart, $bucketEnd])
                    ->selectRaw('COALESCE(products.name, "Unknown") as name, SUM(sub_order_items.quantity) as value')
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('value')
                    ->first();

                $lbl = $cursor->toDateString(); // YYYY-MM-DD
                $data[$lbl] = $top ? ['name' => $top->name, 'value' => (int) $top->value] : ['name' => 'None', 'value' => 0];
                $cursor->addDay();
            }
            break;
        }

        case 'weekly': {
            $cursor = $start->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
            $rangeEnd = $end->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

            while ($cursor->lte($rangeEnd)) {
                $bucketStart = $cursor->copy()->startOfWeek();
                $bucketEnd = $cursor->copy()->endOfWeek();
                $top = $base->clone()
                    ->whereBetween('orders.created_at', [$bucketStart, $bucketEnd])
                    ->selectRaw('COALESCE(products.name, "Unknown") as name, SUM(sub_order_items.quantity) as value')
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('value')
                    ->first();

                $isoWeek = (int) $cursor->format('W');
                $label = 'W' . $isoWeek . ', ' . $cursor->format('M-Y');
                $data[$label] = $top ? ['name' => $top->name, 'value' => (int) $top->value] : ['name' => 'None', 'value' => 0];
                $cursor->addWeek();
            }
            break;
        }

        case 'monthly': {
            $cursor = $start->copy()->startOfMonth();
            while ($cursor->lte($end)) {
                $bucketStart = $cursor->copy()->startOfMonth();
                $bucketEnd = $cursor->copy()->endOfMonth();
                $top = $base->clone()
                    ->whereBetween('orders.created_at', [$bucketStart, $bucketEnd])
                    ->selectRaw('COALESCE(products.name, "Unknown") as name, SUM(sub_order_items.quantity) as value')
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('value')
                    ->first();

                $label = $cursor->format('M Y');
                $data[$label] = $top ? ['name' => $top->name, 'value' => (int) $top->value] : ['name' => 'None', 'value' => 0];
                $cursor->addMonth();
            }
            break;
        }

        case 'yearly': {
            $cursor = $start->copy()->startOfYear();
            while ($cursor->lte($end)) {
                $bucketStart = $cursor->copy()->startOfYear();
                $bucketEnd = $cursor->copy()->endOfYear();
                $top = $base->clone()
                    ->whereBetween('orders.created_at', [$bucketStart, $bucketEnd])
                    ->selectRaw('COALESCE(products.name, "Unknown") as name, SUM(sub_order_items.quantity) as value')
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('value')
                    ->first();

                $label = $cursor->format('Y');
                $data[$label] = $top ? ['name' => $top->name, 'value' => (int) $top->value] : ['name' => 'None', 'value' => 0];
                $cursor->addYear();
            }
            break;
        }

        default:
            $data = [];
    }

    return response()->json($data);
}
    public function getVendorPayoutsData(Request $request)
    {
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = DB::table('vendor_withdraw_requests')
            ->where('request_status', 'pending');

        switch ($type) {
            case 'daily':
                $dailyQuery = $query->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date, SUM(amount) as total");

                if ($startDate && $endDate) {
                    $dailyQuery->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                } else {
                    $dailyQuery->whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ]);
                }

                $data = $dailyQuery->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->pluck('total', 'date')
                    ->toArray();
                break;

            case 'weekly':
                $weeklyQuery = $query->selectRaw("
                    YEAR(created_at) as year,
                    WEEK(created_at, 1) as week_number,
                    MIN(created_at) as week_start,
                    MAX(created_at) as week_end,
                    SUM(amount) as total
                ");

                if ($startDate && $endDate) {
                    $weeklyQuery->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                } else {
                    $weeklyQuery->whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ]);
                }

                $data = $weeklyQuery->groupBy('year', 'week_number')
                    ->orderBy('year', 'asc')
                    ->orderBy('week_number', 'asc')
                    ->get()
                    ->mapWithKeys(function ($item) {
                        $weekStart = Carbon::parse($item->week_start)->startOfWeek(Carbon::MONDAY)->format('j');
                        $weekEnd   = Carbon::parse($item->week_start)->endOfWeek(Carbon::SUNDAY)->format('j M');
                        $label     = "W {$item->week_number} ({$weekStart} - {$weekEnd})";
                        return [$label => $item->total];
                    })
                    ->toArray();
                break;

            case 'monthly':
                $monthlyQuery = $query->selectRaw("
                YEAR(created_at) as year,
                MONTH(created_at) as month_number,
                DATE_FORMAT(created_at, '%M %Y') as month_name,
                SUM(amount) as total
            ");

                if ($startDate && $endDate) {
                    $monthlyQuery->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                } else {
                    $monthlyQuery->whereYear('created_at', Carbon::now()->year)
                        ->whereMonth('created_at', Carbon::now()->month);
                }

                $data = $monthlyQuery->groupBy('year', 'month_number', 'month_name')
                    ->orderBy('year', 'asc')
                    ->orderBy('month_number', 'asc')
                    ->get()
                    ->mapWithKeys(fn($item) => [$item->month_name => $item->total])
                    ->toArray();
                break;

            case 'yearly':
                $yearlyQuery = $query->selectRaw("
                YEAR(created_at) as year,
                SUM(amount) as total
            ");

                if ($startDate && $endDate) {
                    $yearlyQuery->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                } else {
                    $yearlyQuery->where('created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
                        ->where('created_at', '<=', Carbon::now()->endOfYear());
                }

                $data = $yearlyQuery->groupBy('year')
                    ->orderBy('year', 'asc')
                    ->pluck('total', 'year')
                    ->toArray();
                break;

            default:
                $data = [];
                break;
        }

        return response()->json($data);
    }

    public function getCampaignData(Request $request)
    {
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Campaign::query();

        switch ($type) {
            case 'daily':
                $dailyQuery = $query->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date, COUNT(*) as count");

                if ($startDate && $endDate) {
                    $dailyQuery->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                } else {
                    $dailyQuery->whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ]);
                }

                $data = $dailyQuery->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->pluck('count', 'date')
                    ->toArray();
                break;

            case 'weekly':
                $weeklyQuery = $query->selectRaw("
                YEAR(created_at) as year,
                WEEK(created_at, 1) as week_number,
                CONCAT('Week ', WEEK(created_at, 1)) as week,
                COUNT(*) as count
            ");

                if ($startDate && $endDate) {
                    $weeklyQuery->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                } else {
                    $weeklyQuery->whereBetween('created_at', [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ]);
                }

                $data = $weeklyQuery->groupBy('year', 'week_number', 'week')
                    ->orderBy('year', 'asc')
                    ->orderBy('week_number', 'asc')
                    ->get()
                    ->mapWithKeys(fn($item) => [$item->week => $item->count])
                    ->toArray();
                break;

            case 'monthly':
                $monthlyQuery = $query->selectRaw("
                YEAR(created_at) as year,
                MONTH(created_at) as month_number,
                DATE_FORMAT(created_at, '%M %Y') as month_name,
                COUNT(*) as count
            ");

                if ($startDate && $endDate) {
                    $monthlyQuery->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                } else {
                    $monthlyQuery->whereYear('created_at', Carbon::now()->year)
                        ->whereMonth('created_at', Carbon::now()->month);
                }

                $data = $monthlyQuery->groupBy('year', 'month_number', 'month_name')
                    ->orderBy('year', 'asc')
                    ->orderBy('month_number', 'asc')
                    ->get()
                    ->mapWithKeys(fn($item) => [$item->month_name => $item->count])
                    ->toArray();
                break;

            case 'yearly':
                $yearlyQuery = $query->selectRaw("
                YEAR(created_at) as year,
                COUNT(*) as count
            ");

                if ($startDate && $endDate) {
                    $yearlyQuery->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                } else {
                    $yearlyQuery->where('created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
                        ->where('created_at', '<=', Carbon::now()->endOfYear());
                }

                $data = $yearlyQuery->groupBy('year')
                    ->orderBy('year', 'asc')
                    ->pluck('count', 'year')
                    ->toArray();
                break;

            default:
                $data = [];
                break;
        }

        return response()->json($data);
    }

    public  function health()
    {
        $all_user = Admin::all()->except(Auth::id());

        return view('backend.health')->with(['all_user' => $all_user]);
    }

    public function get_chart_data()
    {
        $all_sell_amount = ProductSellInfo::select('total_amount', 'created_at')
            ->whereYear('created_at', date('Y'))
            ->where(['status' => 'complete'])
            ->get()
            ->groupBy(function ($query) {
                return Carbon::parse($query->created_at)->format('M');
            })->toArray();

        $chart_labels = [];
        $chart_data = [];

        foreach ($all_sell_amount as $month => $amount) {
            $chart_labels[] = $month;
            $chart_data[] = array_sum(array_column($amount, 'total_amount'));
        }

        return response()->json([
            'labels' => $chart_labels,
            'data' => $chart_data,
        ]);
    }

    public function get_chart_by_date_data(Request $request)
    {
        $all_sales_total_per_month = ProductSellInfo::select('total_amount', 'created_at')
            ->where(['status' => 'complete'])
            ->whereDate('created_at', '>', Carbon::now()->subDays(30))
            ->get()
            ->groupBy(function ($query) {
                return Carbon::parse($query->created_at)->format("D, d M 'y");
            })->toArray();
        $chart_labels = [];
        $chart_data = [];
        foreach ($all_sales_total_per_month as $month => $amount) {
            $chart_labels[] = $month;
            $chart_data[] = array_sum(array_column($amount, 'total_amount'));
        }

        return response()->json([
            'labels' => $chart_labels,
            'data' => $chart_data,
        ]);
    }

    public function getSaleCountPerDayChartData()
    {
        $chart_labels = [];
        $chart_data = [];

        $all_sales_per_day = ProductSellInfo::select('id', 'created_at')
            ->where(['status' => 'complete'])
            ->whereDate('created_at', '>', Carbon::now()->subDays(30))
            ->get()
            ->groupBy(function ($query) {
                return Carbon::parse($query->created_at)->format("D, d M 'y");
            })->toArray();

        foreach ($all_sales_per_day as $date => $sales) {
            $chart_labels[] = $date;
            $chart_data[] = count($sales);
        }

        return response()->json([
            'labels' => $chart_labels,
            'data' => $chart_data,
        ]);
    }

    public function getOrderCountPerDayChartData()
    {
        $chart_labels = [];
        $chart_data = [];

        $all_sales_per_day = ProductSellInfo::select('id', 'created_at')
            ->whereDate('created_at', '>', Carbon::now()->subDays(30))
            ->get()
            ->groupBy(function ($query) {
                return Carbon::parse($query->created_at)->format("D, d M 'y");
            })->toArray();

        foreach ($all_sales_per_day as $date => $sales) {
            $chart_labels[] = $date;
            $chart_data[] = count($sales);
        }

        return response()->json([
            'labels' => $chart_labels,
            'data' => $chart_data,
        ]);
    }

    public function logged_user_details()
    {
        $old_details = '';
        if (empty($old_details)) {
            $old_details = User::findOrFail(Auth::guard('web')->user()->id);
        }

        return $old_details;
    }

    public function admin_settings()
    {
        return view('auth.admin.settings');
    }

    public function admin_profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'image' => 'nullable|string|max:191',
        ]);

        Admin::find(Auth::user()->id)->update(['name' => $request->name, 'email' => $request->email, 'image' => $request->image]);

        return redirect()->back()->with(['msg' => __('Profile updated successfully.'), 'type' => 'success']);
    }

    public function admin_password_chagne(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Admin::findOrFail(Auth::id());

        if (Hash::check($request->old_password, $user->password)) {

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('admin.login')->with(['msg' => __('Password Changed Successfully.'), 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => __('Unable to change the Password. Please try again or check your old Password.'), 'type' => 'danger']);
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();

        return redirect()
            ->route('admin.login')
            ->with(['msg' => __('Sign out successful.'), 'type' => 'success']);
    }

    public function admin_profile()
    {
        return view('auth.admin.edit-profile');
    }

    public function admin_password()
    {
        return view('auth.admin.change-password');
    }

    public function contact()
    {
        $all_contact_info_items = ContactInfoItem::all();

        return view('backend.pages.contact')->with([
            'all_contact_info_item' => $all_contact_info_items,
        ]);
    }

    public function update_contact(Request $request)
    {
        $request->validate([
            'page_title' => 'required|string|max:191',
            'get_title' => 'required|string|max:191',
            'get_description' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        update_static_option('contact_page_title', $request->page_title);
        update_static_option('contact_page_get_title', $request->get_title);
        update_static_option('contact_page_get_description', $request->get_description);
        update_static_option('contact_page_latitude', $request->latitude);
        update_static_option('contact_page_longitude', $request->longitude);

        return redirect()->back()->with(['msg' => __('Contact Page Info Update Success'), 'type' => 'success']);
    }

    public function blog_page()
    {
        $all_languages = Language::orderBy('default', 'desc')->get();

        return view('backend.pages.blog')->with(['all_languages' => $all_languages]);
    }

    public function blog_page_update(Request $request)
    {
        $request->validate([
            'blog_page_title' => 'nullable',
            'blog_page_item' => 'nullable',
            'blog_page_category_widget_title' => 'nullable',
            'blog_page_recent_post_widget_title' => 'nullable',
            'blog_page_recent_post_widget_item' => 'nullable',
        ]);

        $blog_page_title = 'blog_page_title';
        $blog_page_item = 'blog_page_item';
        $blog_page_category_widget_title = 'blog_page_category_widget_title';
        $blog_page_recent_post_widget_title = 'blog_page_recent_post_widget_title';
        $blog_page_recent_post_widget_item = 'blog_page_recent_post_widget_item';

        update_static_option('blog_page_title', $request->$blog_page_title);
        update_static_option('blog_page_item', $request->$blog_page_item);
        update_static_option('blog_page_category_widget_title', $request->$blog_page_category_widget_title);
        update_static_option('blog_page_recent_post_widget_title', $request->$blog_page_recent_post_widget_title);
        update_static_option('blog_page_recent_post_widget_item', $request->$blog_page_recent_post_widget_item);

        return redirect()->back()->with(['msg' => __('Blog Settings Update Success'), 'type' => 'success']);
    }

    public function home_variant()
    {
        return view('backend.pages.home.home-variant');
    }

    public function update_home_variant(Request $request)
    {
        $request->validate([
            'home_page_variant' => 'required|string',
        ]);
        update_static_option('home_page_variant', $request->home_page_variant);

        return redirect()->back()->with(['msg' => __('Home Variant Settings Updated..'), 'type' => 'success']);
    }

    public function admin_set_static_option(Request $request)
    {
        $request->validate([
            'static_option' => 'required|string',
            'static_option_value' => 'required|string',
        ]);
        set_static_option($request->static_option, $request->static_option_value);

        return 'ok';
    }

    public function admin_get_static_option(Request $request)
    {
        $request->validate([
            'static_option' => 'required|string',
        ]);
        $data = get_static_option($request->static_option);

        return response()->json($data);
    }

    public function admin_update_static_option(Request $request)
    {
        $request->validate([
            'static_option' => 'required|string',
            'static_option_value' => 'required|string',
        ]);
        update_static_option($request->static_option, $request->static_option_value);

        return 'ok';
    }

    public function dark_mode_toggle(Request $request)
    {
        if ($request->mode == 'off') {
            update_static_option('site_admin_dark_mode', 'on');
        }
        if ($request->mode == 'on') {
            update_static_option('site_admin_dark_mode', 'off');
        }

        return response()->json(['status' => 'done']);
    }
}
