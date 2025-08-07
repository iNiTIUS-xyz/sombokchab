<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\User;
use App\Admin;
use App\Language;
use Carbon\Carbon;
use App\ContactInfoItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Vendor\Entities\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Order\Entities\SubOrder;
use Modules\Product\Entities\Product;
use Modules\Campaign\Entities\Campaign;
use Modules\Refund\Entities\RefundRequest;
use Modules\Order\Entities\OrderPaymentMeta;
use Modules\Product\Entities\ProductSellInfo;
use Modules\SupportTicket\Entities\SupportTicket;
use Modules\Wallet\Entities\VendorWithdrawRequest;

class AdminDashboardController extends Controller
{
    public function adminIndex()
    {
        $income_daily = SubOrder::selectRaw("DATE_FORMAT(created_at, '%a') as label, SUM(total_amount) as amount")
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('label')
            ->get();

        // Income Statement (Weekly - Last 4 weeks)
        $income_weekly = SubOrder::selectRaw("YEARWEEK(created_at, 1) as week, SUM(total_amount) as amount")
            ->whereBetween('created_at', [Carbon::now()->subWeeks(4), Carbon::now()])
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('week')
            ->get();

        // Income Statement (Monthly - Current Year)
        $income_monthly = SubOrder::selectRaw("DATE_FORMAT(created_at, '%b') as label, SUM(total_amount) as amount")
            ->whereYear('created_at', Carbon::now()->year)
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('label')
            ->get();

        // Income Statement (Yearly - Last 5 Years)
        $income_yearly = SubOrder::selectRaw("YEAR(created_at) as label, SUM(total_amount) as amount")
            ->whereYear('created_at', '>=', Carbon::now()->subYears(5)->year)
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('label')
            ->get();

        // Top Vendors (Last 7 Days)
        $top_vendors = SubOrder::selectRaw("vendors.owner_name as label, SUM(total_amount) as amount")
            ->join('vendors', 'sub_orders.vendor_id', '=', 'vendors.id')
            ->whereNotNull('vendor_id')
            ->whereBetween('sub_orders.created_at', [Carbon::now()->subDays(31), Carbon::now()])
            ->groupBy('label')
            ->orderByDesc('amount')
            ->limit(10)
            ->get();

        // 🔹 1. Top Vendors - Daily (Last 7 Days)
        $top_vendors_daily = SubOrder::selectRaw("vendors.owner_name as label, SUM(total_amount) as amount")
            ->join('vendors', 'sub_orders.vendor_id', '=', 'vendors.id')
            ->whereNotNull('vendor_id')
            ->whereBetween('sub_orders.created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('label')
            ->orderByDesc('amount')
            ->limit(10)
            ->get();

        // 🔹 2. Top Vendors - Weekly (Last 4 Weeks)
        $top_vendors_weekly = SubOrder::selectRaw("vendors.owner_name as label, YEARWEEK(sub_orders.created_at, 1) as week, SUM(total_amount) as amount")
            ->join('vendors', 'sub_orders.vendor_id', '=', 'vendors.id')
            ->whereNotNull('vendor_id')
            ->whereBetween('sub_orders.created_at', [Carbon::now()->subWeeks(4), Carbon::now()])
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('label', 'week')
            ->get()
            ->groupBy('label')
            ->map(fn($group) => $group->sum('amount'))
            ->sortDesc()
            ->take(10);

        // 🔹 3. Top Vendors - Monthly (Last 12 Months)
        $top_vendors_monthly = SubOrder::selectRaw("vendors.owner_name as label, DATE_FORMAT(sub_orders.created_at, '%Y-%m') as month, SUM(total_amount) as amount")
            ->join('vendors', 'sub_orders.vendor_id', '=', 'vendors.id')
            ->whereNotNull('vendor_id')
            ->where('sub_orders.created_at', '>=', Carbon::now()->subMonths(12)->startOfMonth())
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('label', 'month')
            ->get()
            ->groupBy('label')
            ->map(fn($group) => $group->sum('amount'))
            ->sortDesc()
            ->take(10);

        // 🔹 4. Top Vendors - Yearly (Last 5 Years)
        $top_vendors_yearly = SubOrder::selectRaw("vendors.owner_name as label, YEAR(sub_orders.created_at) as year, SUM(total_amount) as amount")
            ->join('vendors', 'sub_orders.vendor_id', '=', 'vendors.id')
            ->whereNotNull('vendor_id')
            ->where('sub_orders.created_at', '>=', Carbon::now()->subYears(5)->startOfYear())
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('label', 'year')
            ->get()
            ->groupBy('label')
            ->map(fn($group) => $group->sum('amount'))
            ->sortDesc()
            ->take(10);

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

        $baseQuery = DB::table('sub_order_items')
            ->join('orders', 'sub_order_items.order_id', '=', 'orders.id')
            ->join('products', 'sub_order_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(sub_order_items.quantity) as total_quantity'));

        // Daily
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

            'income_daily' => $income_daily,
            'income_weekly' => $income_weekly,
            'income_monthly' => $income_monthly,
            'income_yearly' => $income_yearly,

            'top_vendors' => $top_vendors,
            'top_vendors_daily' => $top_vendors_daily,
            'top_vendors_weekly' => $top_vendors_weekly,
            'top_vendors_monthly' => $top_vendors_monthly,
            'top_vendors_yearly' => $top_vendors_yearly,

            'topVendorsDaily' => $topVendorsDaily,
            'topVendorsWeekly' => $topVendorsWeekly,
            'topVendorsMonthly' => $topVendorsMonthly,
            'topVendorsYearly' => $topVendorsYearly,
        ]);
    }

    public  function health()
    {
        $all_user = Admin::all()->except(Auth::id());

        return view('backend.health')->with(['all_user' => $all_user]);
    }

    public function get_chart_data(Request $request)
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
            // ->whereMonth('created_at',date('m'))
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

    public function getSaleCountPerDayChartData(Request $request)
    {
        /* -----------------------------------------------------
           TOTAL SALES Per Day In last 30 days
       -------------------------------------------------------- */
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

    public function getOrderCountPerDayChartData(Request $request)
    {
        /* -----------------------------------------------------
           TOTAL SALES Per Day In last 30 days
       -------------------------------------------------------- */
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
            ->with(['msg' => __('You Logged Out !!'), 'type' => 'danger']);
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
