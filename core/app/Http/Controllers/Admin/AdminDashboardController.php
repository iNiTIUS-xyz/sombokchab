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
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Vendor::query();

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        switch ($type) {
            case 'daily':
                if ($startDate && $endDate) {
                    $data = Vendor::select([
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('COUNT(*) as count')
                    ])
                        ->whereBetween('created_at', [
                            Carbon::parse($startDate)->startOfDay(),
                            Carbon::parse($endDate)->endOfDay()
                        ])
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->pluck('count', 'date')
                        ->toArray();
                } else {
                    $data = Vendor::select([
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('COUNT(*) as count')
                    ])
                        ->where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->pluck('count', 'date')
                        ->toArray();
                }
                break;

            case 'weekly':
                if ($startDate && $endDate) {
                    $data = $query->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('WEEK(created_at, 1) as week_number'),
                        DB::raw('CONCAT("Week ", WEEK(created_at, 1)) as week'),
                        DB::raw('COUNT(*) as count')
                    )
                        ->groupBy('year', 'week_number', 'week')
                        ->orderBy('year', 'asc')
                        ->orderBy('week_number', 'asc')
                        ->get()
                        ->mapWithKeys(function ($item) {
                            return [$item->week => $item->count];
                        })
                        ->toArray();
                } else {
                    $data = $query->select(
                        DB::raw('WEEK(created_at, 1) as week_number'),
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('CONCAT("Week ", WEEK(created_at, 1) - WEEK(CURRENT_DATE - INTERVAL 1 MONTH, 1) + 1) as week'),
                        DB::raw('COUNT(*) as count')
                    )
                        ->where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('year', 'week_number', 'week')
                        ->orderBy('year', 'asc')
                        ->orderBy('week_number', 'asc')
                        ->get()
                        ->mapWithKeys(function ($item) {
                            return [$item->week => $item->count];
                        })
                        ->toArray();
                }
                break;

            case 'monthly':
                if ($startDate && $endDate) {
                    $data = $query->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('MONTH(created_at) as month_number'),
                        DB::raw('DATE_FORMAT(created_at, "%M %Y") as month_name'),
                        DB::raw('COUNT(*) as count')
                    )
                        ->groupBy('year', 'month_number', 'month_name')
                        ->orderBy('year', 'asc')
                        ->orderBy('month_number', 'asc')
                        ->get()
                        ->mapWithKeys(function ($item) {
                            return [$item->month_name => $item->count];
                        })
                        ->toArray();
                } else {
                    $data = $query->select(
                        DB::raw('MONTH(created_at) as month_number'),
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('DATE_FORMAT(created_at, "%M") as month_name'),
                        DB::raw('COUNT(*) as count')
                    )
                        ->whereYear('created_at', Carbon::now()->year)
                        ->groupBy('year', 'month_number', 'month_name')
                        ->orderBy('year', 'asc')
                        ->orderBy('month_number', 'asc')
                        ->get()
                        ->mapWithKeys(function ($item) {
                            return [$item->month_name => $item->count];
                        })
                        ->toArray();
                }
                break;

            case 'yearly':
                if ($startDate && $endDate) {
                    $data = $query->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('COUNT(*) as count')
                    )
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->get()
                        ->pluck('count', 'year')
                        ->toArray();
                } else {
                    $data = $query->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('COUNT(*) as count')
                    )
                        ->where('created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
                        ->where('created_at', '<=', Carbon::now()->endOfYear())
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->get()
                        ->pluck('count', 'year')
                        ->toArray();
                }
                break;

            default:
                $data = [];
                break;
        }

        return response()->json($data);
    }

    public function getCustomerData(Request $request)
    {
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = User::query();

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        switch ($type) {
            case 'daily':
                if ($startDate && $endDate) {
                    $data = User::select([
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('COUNT(*) as count')
                    ])
                        ->whereBetween('created_at', [
                            Carbon::parse($startDate)->startOfDay(),
                            Carbon::parse($endDate)->endOfDay()
                        ])
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->pluck('count', 'date')
                        ->toArray();
                } else {
                    $data = User::select([
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('COUNT(*) as count')
                    ])
                        ->where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->pluck('count', 'date')
                        ->toArray();
                }
                break;

            case 'weekly':
                if ($startDate && $endDate) {
                    $data = $query->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('WEEK(created_at, 1) as week_number'),
                        DB::raw('CONCAT("Week ", WEEK(created_at, 1)) as week'),
                        DB::raw('COUNT(*) as count')
                    )
                        ->groupBy('year', 'week_number', 'week')
                        ->orderBy('year', 'asc')
                        ->orderBy('week_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->week => $item->count])
                        ->toArray();
                } else {
                    $data = $query->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('WEEK(created_at, 1) as week_number'),
                        DB::raw('CONCAT("Week ", WEEK(created_at, 1)) as week'),
                        DB::raw('COUNT(*) as count')
                    )
                        ->where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('year', 'week_number', 'week')
                        ->orderBy('year', 'asc')
                        ->orderBy('week_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->week => $item->count])
                        ->toArray();
                }
                break;

            case 'monthly':
                if ($startDate && $endDate) {
                    $data = $query->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('MONTH(created_at) as month_number'),
                        DB::raw('DATE_FORMAT(created_at, "%M %Y") as month_name'),
                        DB::raw('COUNT(*) as count')
                    )
                        ->groupBy('year', 'month_number', 'month_name')
                        ->orderBy('year', 'asc')
                        ->orderBy('month_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->month_name => $item->count])
                        ->toArray();
                } else {
                    $data = $query->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('MONTH(created_at) as month_number'),
                        DB::raw('DATE_FORMAT(created_at, "%M") as month_name'),
                        DB::raw('COUNT(*) as count')
                    )
                        ->whereYear('created_at', Carbon::now()->year)
                        ->groupBy('year', 'month_number', 'month_name')
                        ->orderBy('year', 'asc')
                        ->orderBy('month_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->month_name => $item->count])
                        ->toArray();
                }
                break;

            case 'yearly':
                if ($startDate && $endDate) {
                    $data = $query->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('COUNT(*) as count')
                    )
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->get()
                        ->pluck('count', 'year')
                        ->toArray();
                } else {
                    $data = $query->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('COUNT(*) as count')
                    )
                        ->where('created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
                        ->where('created_at', '<=', Carbon::now()->endOfYear())
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->get()
                        ->pluck('count', 'year')
                        ->toArray();
                }
                break;

            default:
                $data = [];
                break;
        }

        return response()->json($data);
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

    public function getTopVendorsData(Request $request)
    {
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = SubOrder::query()
            ->join('vendors', 'sub_orders.vendor_id', '=', 'vendors.id')
            ->whereNotNull('sub_orders.vendor_id')
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'));

        if ($startDate && $endDate) {
            $query->whereBetween('sub_orders.created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        switch ($type) {
            case 'daily':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("vendors.owner_name as label, SUM(sub_orders.total_amount) as amount")
                        ->whereBetween('sub_orders.created_at', [
                            Carbon::parse($startDate)->startOfDay(),
                            Carbon::parse($endDate)->endOfDay()
                        ])
                        ->groupBy('label')
                        ->orderByDesc('amount')
                        ->limit(10)
                        ->pluck('amount', 'label')
                        ->toArray();
                } else {
                    $data = $query->selectRaw("vendors.owner_name as label, SUM(sub_orders.total_amount) as amount")
                        ->where('sub_orders.created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('sub_orders.created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('label')
                        ->orderByDesc('amount')
                        ->limit(10)
                        ->pluck('amount', 'label')
                        ->toArray();
                }
                break;

            case 'weekly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                    vendors.owner_name as label,
                    YEAR(sub_orders.created_at) as year,
                    WEEK(sub_orders.created_at, 1) as week_number,
                    CONCAT('Week ', WEEK(sub_orders.created_at, 1)) as week_label,
                    SUM(sub_orders.total_amount) as amount
                ")
                        ->groupBy('label', 'year', 'week_number', 'week_label')
                        ->get()
                        ->groupBy('label')
                        ->map(function ($group) {
                            return $group->sum('amount');
                        })
                        ->sortDesc()
                        ->take(10)
                        ->toArray();
                } else {
                    $data = $query->selectRaw("
                    vendors.owner_name as label,
                    YEAR(sub_orders.created_at) as year,
                    WEEK(sub_orders.created_at, 1) as week_number,
                    CONCAT('Week ', WEEK(sub_orders.created_at, 1)) as week_label,
                    SUM(sub_orders.total_amount) as amount
                ")
                        ->where('sub_orders.created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('sub_orders.created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('label', 'year', 'week_number', 'week_label')
                        ->get()
                        ->groupBy('label')
                        ->map(function ($group) {
                            return $group->sum('amount');
                        })
                        ->sortDesc()
                        ->take(10)
                        ->toArray();
                }
                break;

            case 'monthly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                    vendors.owner_name as label,
                    YEAR(sub_orders.created_at) as year,
                    MONTH(sub_orders.created_at) as month_number,
                    DATE_FORMAT(sub_orders.created_at, '%M %Y') as month_name,
                    SUM(sub_orders.total_amount) as amount
                ")
                        ->groupBy('label', 'year', 'month_number', 'month_name')
                        ->get()
                        ->groupBy('label')
                        ->map(function ($group) {
                            return $group->sum('amount');
                        })
                        ->sortDesc()
                        ->take(10)
                        ->toArray();
                } else {
                    $data = $query->selectRaw("
                    vendors.owner_name as label,
                    YEAR(sub_orders.created_at) as year,
                    MONTH(sub_orders.created_at) as month_number,
                    DATE_FORMAT(sub_orders.created_at, '%M') as month_name,
                    SUM(sub_orders.total_amount) as amount
                ")
                        ->whereYear('sub_orders.created_at', Carbon::now()->year)
                        ->groupBy('label', 'year', 'month_number', 'month_name')
                        ->get()
                        ->groupBy('label')
                        ->map(function ($group) {
                            return $group->sum('amount');
                        })
                        ->sortDesc()
                        ->take(10)
                        ->toArray();
                }
                break;

            case 'yearly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                    vendors.owner_name as label,
                    YEAR(sub_orders.created_at) as year,
                    SUM(sub_orders.total_amount) as amount
                ")
                        ->groupBy('label', 'year')
                        ->get()
                        ->groupBy('label')
                        ->map(function ($group) {
                            return $group->sum('amount');
                        })
                        ->sortDesc()
                        ->take(10)
                        ->toArray();
                } else {
                    $data = $query->selectRaw("
                    vendors.owner_name as label,
                    YEAR(sub_orders.created_at) as year,
                    SUM(sub_orders.total_amount) as amount
                ")
                        ->where('sub_orders.created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
                        ->where('sub_orders.created_at', '<=', Carbon::now()->endOfYear())
                        ->groupBy('label', 'year')
                        ->get()
                        ->groupBy('label')
                        ->map(function ($group) {
                            return $group->sum('amount');
                        })
                        ->sortDesc()
                        ->take(10)
                        ->toArray();
                }
                break;

            default:
                $data = [];
                break;
        }

        return response()->json($data);
    }

    public function getTopProductsData(Request $request)
    {
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = DB::table('sub_order_items')
            ->join('orders', 'sub_order_items.order_id', '=', 'orders.id')
            ->join('products', 'sub_order_items.product_id', '=', 'products.id')
            ->select('products.name as label', DB::raw('SUM(sub_order_items.quantity) as total_quantity'));

        if ($startDate && $endDate) {
            $query->whereBetween('orders.created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        switch ($type) {
            case 'daily':
                if ($startDate && $endDate) {
                    $data = $query->whereBetween('orders.created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ])
                        ->groupBy('label')
                        ->orderByDesc('total_quantity')
                        ->limit(10)
                        ->pluck('total_quantity', 'label')
                        ->toArray();
                } else {
                    $data = $query->where('orders.created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('orders.created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('label')
                        ->orderByDesc('total_quantity')
                        ->limit(10)
                        ->pluck('total_quantity', 'label')
                        ->toArray();
                }
                break;

            case 'weekly':
                $data = $query->selectRaw("
                    products.name as label,
                    WEEK(orders.created_at, 1) as week_number,
                    CONCAT('Week ', WEEK(orders.created_at, 1) - WEEK(CURRENT_DATE - INTERVAL 1 MONTH, 1) + 1, ': ', products.name) as week_label,
                    SUM(sub_order_items.quantity) as total_quantity
                ")
                    ->where('orders.created_at', '>=', Carbon::now()->startOfMonth())
                    ->where('orders.created_at', '<=', Carbon::now()->endOfMonth())
                    ->groupBy('label', 'week_number', 'week_label')
                    ->get()
                    ->groupBy('label')
                    ->map(function ($group) {
                        return $group->sum('total_quantity');
                    })
                    ->sortDesc()
                    ->take(10)
                    ->toArray();
                break;

            case 'monthly':
                $data = $query->selectRaw("
                    products.name as label,
                    MONTH(orders.created_at) as month_number,
                    DATE_FORMAT(orders.created_at, '%M') as month_name,
                    SUM(sub_order_items.quantity) as total_quantity
                ")
                    ->whereYear('orders.created_at', Carbon::now()->year)
                    ->groupBy('label', 'month_number', 'month_name')
                    ->get()
                    ->groupBy('label')
                    ->map(function ($group) {
                        return $group->sum('total_quantity');
                    })
                    ->sortDesc()
                    ->take(10)
                    ->toArray();
                break;

            case 'yearly':
                $data = $query->selectRaw("
                    products.name as label,
                    YEAR(orders.created_at) as year,
                    SUM(sub_order_items.quantity) as total_quantity
                ")
                    ->where('orders.created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
                    ->where('orders.created_at', '<=', Carbon::now()->endOfYear())
                    ->groupBy('label', 'year')
                    ->get()
                    ->groupBy('label')
                    ->map(function ($group) {
                        return $group->sum('total_quantity');
                    })
                    ->sortDesc()
                    ->take(10)
                    ->toArray();
                break;

            default:
                $data = [];
                break;
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

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        switch ($type) {
            case 'daily':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date, SUM(amount) as total")
                        ->whereBetween('created_at', [
                            Carbon::parse($startDate)->startOfDay(),
                            Carbon::parse($endDate)->endOfDay()
                        ])
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->pluck('total', 'date')
                        ->toArray();
                } else {
                    $data = $query->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date, SUM(amount) as total")
                        ->where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->pluck('total', 'date')
                        ->toArray();
                }
                break;

            case 'weekly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    WEEK(created_at, 1) as week_number,
                    CONCAT('Week ', WEEK(created_at, 1)) as week,
                    SUM(amount) as total
                ")
                        ->groupBy('year', 'week_number', 'week')
                        ->orderBy('year', 'asc')
                        ->orderBy('week_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->week => $item->total])
                        ->toArray();
                } else {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    WEEK(created_at, 1) as week_number,
                    CONCAT('Week ', WEEK(created_at, 1)) as week,
                    SUM(amount) as total
                ")
                        ->where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('year', 'week_number', 'week')
                        ->orderBy('year', 'asc')
                        ->orderBy('week_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->week => $item->total])
                        ->toArray();
                }
                break;

            case 'monthly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    MONTH(created_at) as month_number,
                    DATE_FORMAT(created_at, '%M %Y') as month_name,
                    SUM(amount) as total
                ")
                        ->groupBy('year', 'month_number', 'month_name')
                        ->orderBy('year', 'asc')
                        ->orderBy('month_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->month_name => $item->total])
                        ->toArray();
                } else {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    MONTH(created_at) as month_number,
                    DATE_FORMAT(created_at, '%M') as month_name,
                    SUM(amount) as total
                ")
                        ->whereYear('created_at', Carbon::now()->year)
                        ->groupBy('year', 'month_number', 'month_name')
                        ->orderBy('year', 'asc')
                        ->orderBy('month_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->month_name => $item->total])
                        ->toArray();
                }
                break;

            case 'yearly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    SUM(amount) as total
                ")
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->pluck('total', 'year')
                        ->toArray();
                } else {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    SUM(amount) as total
                ")
                        ->where('created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
                        ->where('created_at', '<=', Carbon::now()->endOfYear())
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->pluck('total', 'year')
                        ->toArray();
                }
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

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        switch ($type) {
            case 'daily':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date, COUNT(*) as count")
                        ->whereBetween('created_at', [
                            Carbon::parse($startDate)->startOfDay(),
                            Carbon::parse($endDate)->endOfDay()
                        ])
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->pluck('count', 'date')
                        ->toArray();
                } else {
                    $data = $query->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date, COUNT(*) as count")
                        ->where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->pluck('count', 'date')
                        ->toArray();
                }
                break;

            case 'weekly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    WEEK(created_at, 1) as week_number,
                    CONCAT('Week ', WEEK(created_at, 1)) as week,
                    COUNT(*) as count
                ")
                        ->groupBy('year', 'week_number', 'week')
                        ->orderBy('year', 'asc')
                        ->orderBy('week_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->week => $item->count])
                        ->toArray();
                } else {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    WEEK(created_at, 1) as week_number,
                    CONCAT('Week ', WEEK(created_at, 1)) as week,
                    COUNT(*) as count
                ")
                        ->where('created_at', '>=', Carbon::now()->startOfMonth())
                        ->where('created_at', '<=', Carbon::now()->endOfMonth())
                        ->groupBy('year', 'week_number', 'week')
                        ->orderBy('year', 'asc')
                        ->orderBy('week_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->week => $item->count])
                        ->toArray();
                }
                break;

            case 'monthly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    MONTH(created_at) as month_number,
                    DATE_FORMAT(created_at, '%M %Y') as month_name,
                    COUNT(*) as count
                ")
                        ->groupBy('year', 'month_number', 'month_name')
                        ->orderBy('year', 'asc')
                        ->orderBy('month_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->month_name => $item->count])
                        ->toArray();
                } else {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    MONTH(created_at) as month_number,
                    DATE_FORMAT(created_at, '%M') as month_name,
                    COUNT(*) as count
                ")
                        ->whereYear('created_at', Carbon::now()->year)
                        ->groupBy('year', 'month_number', 'month_name')
                        ->orderBy('year', 'asc')
                        ->orderBy('month_number', 'asc')
                        ->get()
                        ->mapWithKeys(fn($item) => [$item->month_name => $item->count])
                        ->toArray();
                }
                break;

            case 'yearly':
                if ($startDate && $endDate) {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    COUNT(*) as count
                ")
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->pluck('count', 'year')
                        ->toArray();
                } else {
                    $data = $query->selectRaw("
                    YEAR(created_at) as year,
                    COUNT(*) as count
                ")
                        ->where('created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
                        ->where('created_at', '<=', Carbon::now()->endOfYear())
                        ->groupBy('year')
                        ->orderBy('year', 'asc')
                        ->pluck('count', 'year')
                        ->toArray();
                }
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
