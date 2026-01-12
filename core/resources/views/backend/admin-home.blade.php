@extends('backend.admin-master')

@section('site-title')
    {{ __('Dashboard') }}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .badge-custom {
            background-color: #dee2e6;
            color: #000;
            font-size: 14px;
            margin-right: 5px;
        }

        .section-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .view-all {
            float: right;
            color: #41695a;
            font-weight: 500;
            text-decoration: none;
        }

        .view-all:hover {
            text-decoration: underline;
        }

        .vendor-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .vendor-number {
            font-weight: 600;
            margin-right: 10px;
            font-size: 1rem;
            width: 20px;
            text-align: right;
        }

        .vendor-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #41695a;
            margin-right: 10px;
        }

        .vendor-name {
            font-weight: 500;
            font-size: 1rem;
            color: #333;
        }

        .subtitle {
            font-size: 0.85rem;
            font-weight: 600;
            color: #41695a;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
        }

        /* Toolbar pan (hand) icon color */
        .apexcharts-toolbar .apexcharts-pan-icon svg {
            stroke: #41695a !important;
            fill: #41695a !important;
        }


        /* Base track */
        #new_vendor_signup_scroll,
        #new_customer_signup_scroll {
            -webkit-appearance: none;
            appearance: none;
            height: 6px;
            border-radius: 4px;
            background: #e9ecef;
            outline: none;
        }

        /* WebKit thumb */
        #new_vendor_signup_scroll::-webkit-slider-thumb,
        #new_customer_signup_scroll::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #41695a;
            /* your green */
            border: 2px solid #2f4f45;
            /* subtle ring */
            cursor: pointer;
            margin-top: -5px;
            /* vertically center on 6px track */
        }

        /* Firefox thumb */
        #new_vendor_signup_scroll::-moz-range-thumb,
        #new_customer_signup_scroll::-moz-range-thumb {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #41695a;
            border: 2px solid #2f4f45;
            cursor: pointer;
        }

        /* Firefox track */
        #new_vendor_signup_scroll::-moz-range-track,
        #new_customer_signup_scroll::-moz-range-track {
            height: 6px;
            border-radius: 4px;
            background: #e9ecef;
        }

        /* Focus ring */
        #new_vendor_signup_scroll:focus-visible,
        #new_customer_signup_scroll:focus-visible {
            outline: 2px solid rgba(65, 105, 90, .35);
            outline-offset: 2px;
        }

        #new_vendor_signup_nav,
        #new_customer_signup_nav {
            display: none;
        }

        #top_vendor_nav,
        #top_products_nav,
        #campaign_one_nav,
        #website_nav,
        #pending_vendor_payouts_nav,
        #order_revenue_nav {
            display: none;
        }

        /* tilt values drawn on top of bars */
        /* Make all bar values vertical */
        #website_visitor_chart .apexcharts-datalabel,
        #new_customer_signup_chart .apexcharts-datalabel,
        #new_vendor_signup_chart .apexcharts-datalabel,
        #top_vendor_chart .apexcharts-datalabel,
        #top_products_chart .apexcharts-datalabel,
        #order_revenue_chart .apexcharts-datalabel,
        #pending_vendor_payouts_chart .apexcharts-datalabel,
        #campaign_one_chart .apexcharts-datalabel {
            transform: rotate(-90deg) !important;
            transform-origin: center center !important;
            transform-box: fill-box !important;
        }

        .date_range_picker {
            height: 48px !important;
            padding: 0 20px 0 20px !important;
            text-align: center !important;
            border: none;
            padding: 0px !important;
            margin: 0px !important;
            font-weight: 500;
        }

        .custom-date-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .custom-range-label {
            font-weight: 500;
            color: #6c757d;
        }

        .custom-range-value {
            display: none;
            font-weight: 600;
            color: #6b7280;
            /* same gray tone as screenshot */
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        {{-- website Stats --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <h3 class="my-3">Website User Statistics</h3>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="website_daily-tab"
                                                type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="website_weekly-tab" type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="website_monthly-tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="website_yearly-tab" type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control date_range_picker" id="website_picker"
                                                data-target="#website_date_text" placeholder="Custom Date Range">
                                            <span class="custom-range-value" id="website_date_text"></span>

                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="website_visitor_chart"></div>
                                        <!-- scroll bar -->
                                        <input id="website_scroll" class="form-range mt-2 w-100" type="range"
                                            min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="website_nav"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
                                </div>
                                <div class="col-md-6" style="display: flex; justify-content: center; align-items: center;">
                                    <div class="text-center">
                                        <h5>Real-time Active Visitors</h5>
                                        <h2>61</h2>
                                        <span class="badge bg-light text-dark">Online</span>
                                    </div>
                                </div>

                                {{-- New vendor signup chart --}}
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="new_vendor_signup_daily-tab"
                                                type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="new_vendor_signup_weekly-tab"
                                                type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="new_vendor_signup_monthly-tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="new_vendor_signup_yearly-tab"
                                                type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item ">
                                            <input type="text" class="form-control date_range_picker"
                                                id="vendor_sign_up_picker" placeholder="Custom Date Range"
                                                data-target="#vendor_signup_date_text">
                                            <span class="custom-range-value" id="vendor_signup_date_text"></span>
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="new_vendor_signup_chart"></div>
                                        <!-- scroll bar -->
                                        <input id="new_vendor_signup_scroll" class="form-range mt-2 w-100" type="range"
                                            min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="new_vendor_signup_nav" style="height:110px;"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
                                </div>

                                {{-- New customer signup chart --}}
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="new_customer_signup_daily-tab"
                                                type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="new_customer_signup_weekly-tab"
                                                type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="new_customer_signup_monthly-tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="new_customer_signup_yearly-tab"
                                                type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control date_range_picker"
                                                id="customer_sign_up_picker" data-target="#customer_sign_up_date_text">
                                            <span class="custom-range-value" id="customer_sign_up_date_text"></span>
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="new_customer_signup_chart"></div>
                                        <!-- scroll bar -->
                                        <input id="new_customer_signup_scroll" class="form-range mt-2 w-100"
                                            type="range" min="0" max="0" value="0"
                                            step="1" />
                                    </div>
                                    <div class="mt-2" id="new_customer_signup_nav" style="height:110px;"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Campaign Stats --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <h3 class="my-3">Campaign Statistics</h3>
                            <div class="row g-5">
                                <div class="col-md-6"
                                    style="display: flex; justify-content: center; align-items: center;">
                                    <div class="text-center">
                                        <h5>Active Campaigns</h5>
                                        <h2>
                                            {{ $campaign->count() }}
                                        </h2>
                                        <span class="badge bg-light text-dark">Live Now</span>
                                    </div>
                                </div>
                                {{-- Campaign Creation chart --}}
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="campaign_one_daily-tab"
                                                type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="campaign_one_weekly-tab"
                                                type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="campaign_one_monthly-tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="campaign_one_yearly-tab"
                                                type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control date_range_picker"
                                                id="campaign_one_picker" placeholder="Custom Date Range"
                                                data-target="#campaign_date_text">
                                            <span class="custom-range-value" id="campaign_date_text"></span>
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="campaign_one_chart"></div>
                                        <!-- scroll bar -->
                                        <input id="campaign_one_scroll" class="form-range mt-2 w-100" type="range"
                                            min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="campaign_one_nav" style="height:110px;"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Notification info --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <h3 class="my-3">Notifications</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('admin.vendor.all') }}">
                                                Vendors:
                                            </a>
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $vendor->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('admin.vendor.all') }}">
                                                New Vendor Requests:
                                            </a>
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $vendorRequest->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('admin.products.all') }}">
                                                Products:
                                            </a>
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $products->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('admin.products.all') }}">
                                                Pending Products:
                                            </a>
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $productsPending->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('admin.wallet.withdraw-request') }}">
                                                Vendor Withdrawal Requests:
                                            </a>
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $vendorWithdrawRequests->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('admin.support.ticket.all') }}">
                                                Customer Support Tickets:
                                            </a>
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $customerSupportTickets->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('admin.support.ticket.all.vendor') }}">
                                                Vendor Support Tickets:
                                            </a>
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $vendorSupportTickets->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('admin.refund.request') }}">
                                                Refund Requests:
                                            </a>
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $refundRequests->count() }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <h3 class="my-3">Top Performers</h3>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="p-4">
                                        <p class="subtitle">Top Selling Vendor</p>
                                        <div class="row">
                                            @foreach ($topVendorsInfos as $topVendors)
                                                <div class="col-6">
                                                    <div class="vendor-item">
                                                        <span class="vendor-number">
                                                            {{ $loop->iteration }}.
                                                        </span>
                                                        <img src="{{ file_exists($topVendors['logo']) ? asset($topVendors['logo']) : null }}"
                                                            alt="Theresa Webb" class="vendor-img">
                                                        <a class="vendor-name" target="__blank"
                                                            href="{{ route('admin.vendor.edit', $topVendors['id']) }}">
                                                            {{ $topVendors['name'] }}
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card p-4">
                                        <p class="subtitle">Top Selling Products</p>
                                        <ul class="list-unstyled product-list text-justify">
                                            @foreach ($topProducts as $key => $topProduct)
                                                <li class="p-1">
                                                    <a class="text-dark"
                                                        href="{{ route('admin.products.edit', $topProduct->id) }}"
                                                        target="__blank">
                                                        {{ $key + 1 }}.
                                                        {{ Str::limit($topProduct->name, 80, '...') }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Top vendors --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <h3 class="my-3">Top Performer Statistics</h3>

                            <div class="row performer_statistics g-5">
                                <!-- Top Selling Vendors -->
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="top_vendors_daily-tab"
                                                type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_vendors_weekly-tab"
                                                type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_vendors_monthly-tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_vendors_yearly-tab"
                                                type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control date_range_picker"
                                                id="top_vendors_picker" data-target="#top_vendors_date_text" />
                                            <span class="custom-range-value" id="top_vendors_date_text"></span>
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="top_vendor_chart"></div>
                                        <!-- scrollbar -->
                                        <input id="top_vendor_scroll" class="form-range mt-2 w-100" type="range"
                                            min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="top_vendor_nav" style="height:110px;"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
                                </div>

                                <!-- Top Selling Products -->
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="top_products_daily-tab"
                                                type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_products_weekly-tab"
                                                type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_products_monthly-tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_products_yearly-tab"
                                                type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control date_range_picker"
                                                id="top_products_picker" data-target="#top_products_date_text" />
                                            <span class="custom-range-value" id="top_products_date_text"></span>
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="top_products_chart"></div>
                                        <!-- scrollbar -->
                                        <input id="top_products_scroll" class="form-range mt-2 w-100" type="range"
                                            min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="top_products_nav" style="height:110px;"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- vendor management  --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="dashboard__card">
                <div class="dashboard__card__body">
                    <h4 class="my-3">Vendor Verifications</h4>
                    <div class="p-3 bg-light rounded-3">
                        <h6 class="text-center pb-2">Account Verification</h6>
                        <div class="row g-3 mb-2">
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Pending</span>
                                    <span class="fw-bold text-warning">14</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Approved</span>
                                    <span class="fw-bold text-success">55</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Rejected</span>
                                    <span class="fw-bold text-danger">43</span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-center pb-2">Product Verification</h6>
                        <div class="row g-3 mb-2">
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Pending</span>
                                    <span class="fw-bold text-warning">{{ $unpublishProduct->count() }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Approved</span>
                                    <span class="fw-bold text-success">{{ $publishProduct->count() }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Rejected</span>
                                    <span class="fw-bold text-danger">{{ $rejectedProduct->count() }}</span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-center pb-2">Withdrawal Requests</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Pending</span>
                                    <span class="fw-bold text-warning">{{ $pendingWithdraw->count() }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Completed</span>
                                    <span class="fw-bold text-success">{{ $completedWithdraw->count() }}</span>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Processing</span>
                                    <span class="fw-bold text-info">{{ $processingWithdraw->count() }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Refunded</span>
                                    <span class="fw-bold text-success">{{ $refundedWithdraw->count() }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Failed</span>
                                    <span class="fw-bold text-warning">{{ $failedWithdraw->count() }}</span>
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Cancelled</span>
                                    <span class="fw-bold text-danger">{{ $cancelledWithdraw->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h4 class="mb-2">Vendor Support Tickets</h4>
                    <div class="p-3 bg-light rounded-3">
                        <div class="row g-3 mb-2">
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Tickets Open</span>
                                    <span class="fw-bold text-warning">
                                        {{ $vendorTicketData['vendorTotalOpenTicket']->count() }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>High Priority Tickets</span>
                                    <span class="fw-bold text-info">
                                        {{ $vendorTicketData['vendorTotalPriorityTicket']->count() }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Tickets Closed</span>
                                    <span class="fw-bold text-danger">
                                        {{ $vendorTicketData['vendorTotalCloseTicket']->count() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h4 class="mb-2">Customer Support Tickets</h4>
                    <div class="p-3 bg-light rounded-3">
                        <div class="row g-3 mb-2">
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Tickets Open</span>
                                    <span class="fw-bold text-warning">
                                        {{ $customerTicketData['totalOpenTicket']->count() }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>High Priority Tickets</span>
                                    <span class="fw-bold text-info">
                                        {{ $customerTicketData['totalPriorityTicket']->count() }}

                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Tickets Closed</span>
                                    <span class="fw-bold text-danger">
                                        {{ $customerTicketData['totalCloseTicket']->count() }}

                                    </span>
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Close Tickets</span>
                                    <span class="fw-bold text-danger">
                                        {{ $customerTicketData['refundRequest']->count() }}
                                    </span>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Financial Summary --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <h3 class="my-3">Financial Summary</h3>
                            <div class="row g-5">
                                {{-- Order Revenue chart --}}
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="order_revenue_daily-tab"
                                                type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="order_revenue_weekly-tab"
                                                type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="order_revenue_monthly-tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="order_revenue_yearly-tab"
                                                type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control date_range_picker"
                                                id="order_revenue_picker" placeholder="Custom Date Range"
                                                data-target="#order_revenue_date_text">
                                            <span class="custom-range-value" id="order_revenue_date_text"></span>
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="order_revenue_chart"></div>
                                        <!-- scroll bar -->
                                        <input id="order_revenue_scroll" class="form-range mt-2 w-100" type="range"
                                            min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="order_revenue_nav" style="height:110px;"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
                                </div>

                                {{-- Pending Vendor Payouts chart --}}
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pending_vendor_payouts_daily-tab"
                                                type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pending_vendor_payouts_weekly-tab"
                                                type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pending_vendor_payouts_monthly-tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pending_vendor_payouts_yearly-tab"
                                                type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control date_range_picker"
                                                id="pending_vendor_payouts_picker" placeholder="Custom Date Range"
                                                data-target="#pending_vendor_payouts_date_text">
                                            <span class="custom-range-value" id="pending_vendor_payouts_date_text"></span>
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="pending_vendor_payouts_chart"></div>
                                        <!-- scroll bar -->
                                        <input id="pending_vendor_payouts_scroll" class="form-range mt-2 w-100"
                                            type="range" min="0" max="0" value="0"
                                            step="1" />
                                    </div>
                                    <div class="mt-2" id="pending_vendor_payouts_nav" style="height:110px;"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-ml-12">
            {{-- <div class="dashboard__card">
                <div class="dashboard__card__body">
                    <h4 class="mb-4">Performance Monitoring</h4>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card shadow-sm rounded-3 text-center p-3">
                                <h6>Page Load Time</h6>
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="p-2 bg-light rounded">
                                            <small>Home Page</small>
                                            <h5 class="text-success">
                                                {{ round((microtime(true) - LARAVEL_START) * 1000, 2) . 's' }}</h5>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="p-2 bg-light rounded">
                                            <small>Product Page</small>
                                            <h5 class="text-success">2s</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm rounded-3 text-center p-3">
                                <h6>API Latency</h6>
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="p-2 bg-light rounded">
                                            <small>AVG</small>
                                            <h5 class="text-success">200ms</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm rounded-3 text-center p-3">
                                <h6>User Sessions</h6>
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="p-2 bg-light rounded">
                                            <small>Signed In</small>
                                            <h5 class="text-success">150</h5>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="p-2 bg-light rounded">
                                            <small>Avg Duration</small>
                                            <h5 class="text-success">5m</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row g-3">
                <div class="col-md-4">
                    <div class="card shadow-sm rounded-3 p-3">
                        <h6>Website & Version Info</h6>
                        <p class="mb-1">
                            Website Version: {{ app()->version() }} | Website PHP Version: {{ substr(PHP_VERSION, 0, 3) }}
                        </p>
                        <p class="mb-1">
                            Last Development Year: {{ date('Y') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm rounded-3 p-3 text-center">
                        <h6>Log Summary</h6>
                        <div class="row mt-2">
                            <div class="col">
                                <div class="p-4 bg-light rounded">
                                    <small>Vendor</small>
                                    <h5 class="text-success">
                                        {{ $totalVendors->count() }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-4 bg-light rounded">
                                    <small>Admin</small>
                                    <h5 class="text-success">
                                        {{ $totalAdmin->count() }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-4 bg-light rounded">
                                    <small>Customer</small>
                                    <h5 class="text-success">
                                        {{ $totalCustomer->count() }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Security Alerts -->
                <div class="col-md-4">
                    <div class="card shadow-sm rounded-3 p-3">
                        <h6>Security Alerts</h6>
                        <div class="row g-2 mt-2">
                            <div class="col-6">
                                <div class="p-2 bg-light rounded d-flex justify-content-between align-items-center">
                                    <small>Pending Password Resets</small>
                                    <span class="text-success fw-bold">
                                        {{ $pass_reset_count }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // 1) Initialize ALL your pickers with autoUpdateInput: false
        $('.date_range_picker').daterangepicker({
            opens: 'left',
            autoUpdateInput: false, // ← stop autofill
            minDate: moment('2024-01-01'),
            maxDate: moment().endOf('year')
        });

        // 2) After init, force the placeholder (run AFTER all inits)
        $(window).on('load', function() {
            $('.date_range_picker').val('').attr('placeholder', 'Custom date range');
        });

        // 3) When the user picks a range, set the value yourself
        $('.date_range_picker').on('apply.date_range_picker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        // 4) If you need to enforce a minimum span, do it on apply (NOT in the init callback)
        $('.date_range_picker').on('apply.date_range_picker', function(ev, picker) {
            const minDays = 1; // example: at least 1 day
            if (picker.endDate.diff(picker.startDate, 'months', true) < 1) {
                picker.setEndDate(picker.startDate.clone().add(1, 'months'));
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            }
        });

        // 5) Optional: handle clear/cancel to restore placeholder
        $('.date_range_picker').on('cancel.date_range_picker', function() {
            $(this).val('').attr('placeholder', 'Custom date range');
        });
    </script>

    {{-- New Vendor and New Customer Signup --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ---------- Shared helpers ----------
            const clamp = (n, lo, hi) => Math.min(hi, Math.max(lo, n));

            function makeBrushBarChart({
                ids,
                url,
                seriesName,
                titleBase
            }) {
                let currentType = 'daily';
                let currentStartDate = null;
                let currentEndDate = null;

                // full dataset
                let rawLabels = [];
                let displayLabels = [];

                let
                    labels = []; // ["2025-09-01", ...] | ["W36, Sep-2025", ...] | ["Jan 2025", ...] | ["2024","2025",...]
                let values = []; // [1,2,0,...]
                let points = []; // [{x:i,y:v}]

                // current viewport (inclusive indices into full arrays)
                let vMin = 0,
                    vMax = 0;

                // DOM
                const elMain = document.querySelector('#' + ids.main);
                const elNav = document.querySelector('#' + ids.nav);
                const elScroll = document.querySelector('#' + ids.scroll);

                // ---------- Tabs UI ----------
                const tabIds = [ids.tabs.daily, ids.tabs.weekly, ids.tabs.monthly, ids.tabs.yearly];

                function setActiveTabUI(type) {
                    const map = {
                        daily: ids.tabs.daily,
                        weekly: ids.tabs.weekly,
                        monthly: ids.tabs.monthly,
                        yearly: ids.tabs.yearly
                    };
                    const activeId = map[type];
                    tabIds.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.classList.toggle('active', id === activeId);
                    });
                }

                // ---------- Main (category) chart ----------
                const mainOpts = {
                    series: [{
                        name: seriesName,
                        data: []
                    }],
                    chart: {
                        id: ids.main + '_chart',
                        type: 'bar',
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                        animations: {
                            easing: 'easeinout',
                            speed: 180
                        }
                    },
                    title: {
                        text: titleBase,
                        align: 'left'
                    },
                    colors: ['#e0bb20'],
                    grid: {
                        padding: {
                            left: 2,
                            right: 2
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '18%',
                            borderRadius: 6,
                            distributed: false
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        position: 'bottom', // 👈 keep near bottom (for vertical bars)
                        offsetY: 20, // 👈 moves up from the x-axis baseline
                        background: {
                            enabled: false
                        },
                        style: {
                            colors: ['#000'],
                            fontWeight: 400,
                            fontSize: '10px',
                        },
                        formatter: (v) => v
                    },
                    xaxis: {
                        type: 'category',
                        categories: [],
                        tickPlacement: 'on',
                        rangePadding: 'none',
                        labels: {
                            rotate: -90,
                            rotateAlways: true,
                            trim: false,
                            hideOverlappingLabels: false
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Sign-Ups'
                        }
                    },
                    tooltip: {
                        x: {
                            formatter: (val, {
                                dataPointIndex
                            }) => (visibleLabels[dataPointIndex] ?? '')
                        },
                        y: {
                            formatter: (val) => `${val} sign-ups`
                        }
                    }
                };

                // this array mirrors the xaxis categories each update; used by tooltip
                let visibleLabels = [];

                const chart = new ApexCharts(elMain, mainOpts);
                chart.render();

                // ---------- Navigator (numeric) ----------
                let nav = null;

                function renderNav() {
                    if (nav) nav.destroy();

                    const navData = values.map((y, i) => ({
                        x: i,
                        y
                    }));

                    // default window = up to 60 bars
                    vMin = 0;
                    vMax = Math.max(0, Math.min(values.length - 1, 60));

                    nav = new ApexCharts(elNav, {
                        chart: {
                            id: ids.nav + '_chart',
                            height: 110,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                            animations: {
                                enabled: false
                            },
                            // We manually handle selection; brush is unnecessary with category axis in main.
                            selection: {
                                enabled: true,
                                xaxis: {
                                    min: vMin,
                                    max: vMax
                                }
                            },
                            events: {
                                selection: (ctx, {
                                    xaxis
                                }) => {
                                    const minI = clamp(Math.round(xaxis.min), 0, labels.length - 1);
                                    const maxI = clamp(Math.round(xaxis.max), 0, labels.length - 1);
                                    applyViewport(minI, maxI, {
                                        from: 'nav'
                                    });
                                }
                            }
                        },
                        colors: ['#e0bb20'],
                        stroke: {
                            width: 1,
                            colors: ['#e0bb20']
                        },
                        series: [{
                            name: 'Range',
                            data: navData
                        }],
                        xaxis: {
                            type: 'numeric',
                            labels: {
                                show: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        },
                        yaxis: {
                            show: false
                        },
                        dataLabels: {
                            enabled: false
                        },
                        fill: {
                            opacity: 0.2
                        }
                    });

                    nav.render();
                    applyViewport(vMin, vMax);
                    updateScrollbar();
                }

                // ---------- Viewport sync (slice to visible window) ----------
                function applyViewport(minI, maxI, {
                    from = 'code'
                } = {}) {
                    vMin = Math.max(0, Math.min(minI, maxI));
                    vMax = Math.max(0, Math.max(minI, maxI));

                    // slice visible window for main chart
                    const windowVals = values.slice(vMin, vMax + 1);
                    visibleLabels = displayLabels.slice(vMin, vMax + 1);

                    chart.updateOptions({
                        series: [{
                            name: seriesName,
                            data: windowVals
                        }],
                        xaxis: {
                            categories: visibleLabels
                        }
                    }, false, false);

                    // keep navigator’s selection synced
                    if (nav && from !== 'nav') {
                        nav.updateOptions({
                            chart: {
                                selection: {
                                    enabled: true,
                                    xaxis: {
                                        min: vMin,
                                        max: vMax
                                    }
                                }
                            }
                        }, false, false);
                    }

                    if (from !== 'scroll') updateScrollbar();
                }

                // ---------- Scrollbar ----------
                function updateScrollbar() {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const maxLeft = Math.max(0, labels.length - windowSize);
                    elScroll.max = String(maxLeft);
                    elScroll.step = '1';
                    elScroll.value = String(clamp(vMin, 0, maxLeft));
                    elScroll.disabled = (maxLeft === 0);
                    elScroll.title = 'Scroll to pan. Hold Ctrl/Cmd + Wheel to zoom. Wheel to pan.';
                }

                elScroll.addEventListener('input', () => {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const left = parseInt(elScroll.value || '0', 10);
                    applyViewport(left, left + windowSize - 1, {
                        from: 'scroll'
                    });
                });

                // ---------- Smooth wheel zoom & pan on MAIN ----------
                elMain.addEventListener('wheel', (e) => {
                    if (!labels.length) return;

                    const rect = elMain.getBoundingClientRect();
                    const relX = Math.min(rect.width, Math.max(0, e.clientX - rect.left));
                    const frac = rect.width > 0 ? (relX / rect.width) : 0.5;
                    const centerIdx = Math.round(vMin + frac * Math.max(0, (vMax - vMin)));

                    const delta = e.deltaY || e.wheelDelta || 0;

                    if (e.ctrlKey || e.metaKey) {
                        // ZOOM
                        e.preventDefault();
                        const currentWindow = Math.max(1, vMax - vMin + 1);
                        const scale = delta > 0 ? 1.15 : 1 / 1.15;
                        let newWindow = Math.round(currentWindow * scale);
                        newWindow = clamp(newWindow, 5, Math.max(10, Math.ceil(labels.length * 0.9)));

                        const half = Math.floor(newWindow / 2);
                        let newMin = clamp(centerIdx - half, 0, Math.max(0, labels.length - newWindow));
                        let newMax = newMin + newWindow - 1;
                        applyViewport(newMin, newMax);
                    } else {
                        // PAN
                        const panStep = Math.max(1, Math.round((vMax - vMin + 1) * 0.1));
                        const dir = delta > 0 ? 1 : -1;
                        const newMin = clamp(vMin + dir * panStep, 0, Math.max(0, labels.length - (vMax -
                            vMin + 1)));
                        const newMax = newMin + (vMax - vMin);
                        applyViewport(newMin, newMax);
                    }
                }, {
                    passive: false
                });

                // Double-click to reset window
                elMain.addEventListener('dblclick', () => {
                    const fullMax = Math.max(0, labels.length - 1);
                    const initialMax = Math.min(fullMax, 60);
                    applyViewport(0, initialMax);
                });

                // ---------- Data fetch & ingest ----------
                function fetchData(type, startDate = null, endDate = null) {
                    setActiveTabUI(type);
                    chart.updateOptions({
                        title: {
                            text: 'Loading…'
                        }
                    });
                    const req = {
                        type
                    };
                    if (startDate && endDate) {
                        req.start_date = startDate;
                        req.end_date = endDate;
                    }

                    $.ajax({
                        url,
                        type: 'GET',
                        data: req,
                        success: (payload) => ingest(payload, type),
                        error: () => chart.updateOptions({
                            title: {
                                text: 'Error loading data'
                            }
                        })
                    });
                }

                function ingest(payload, chartType) {
                    // keep insertion order, de-dupe keys
                    const seen = new Set();
                    rawLabels = [];
                    values = [];
                    Object.keys(payload).forEach(k => {
                        if (!seen.has(k)) {
                            seen.add(k);
                            rawLabels.push(k);
                            values.push(parseInt(payload[k]) || 0);
                        }
                    });

                    // build display labels
                    displayLabels = rawLabels.map(k => {
                        if (chartType === 'daily') {
                            // API gives YYYY-MM-DD → show DD-MMM-YYYY (e.g., 01-Oct-2025)
                            return moment(k, 'YYYY-MM-DD', true).isValid() ?
                                moment(k, 'YYYY-MM-DD').format('DD, MMM YY') :
                                k; // fallback if not a date string
                        }
                        return k; // weekly/monthly/yearly already humanized by backend
                    });

                    chart.updateOptions({
                        title: {
                            text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}`
                        }
                    });

                    // rebuild navigator + main
                    labels = rawLabels.slice(); // keep indices aligned for viewport math
                    renderNav(); // sets vMin/vMax and paints both charts
                }


                // ---------- Tabs ----------
                document.getElementById(ids.tabs.daily).addEventListener('click', () => {
                    currentType = 'daily';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.weekly).addEventListener('click', () => {
                    currentType = 'weekly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.monthly).addEventListener('click', () => {
                    currentType = 'monthly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.yearly).addEventListener('click', () => {
                    currentType = 'yearly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                // ---------- Date picker ----------
                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                }, function(start, end) {
                    const months = end.diff(start, 'months', true);
                    if (months < 1) {
                        this.setStartDate(moment(start));
                        this.setEndDate(moment(start).add(1, 'months'));
                    }
                });

                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                });

                $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {

                    currentStartDate = picker.startDate.format('YYYY-MM-DD');
                    currentEndDate = picker.endDate.format('YYYY-MM-DD');

                    const target = this.dataset.target;
                    if (target) {
                        const span = document.querySelector(target);
                        span.textContent =
                            picker.startDate.format('DD/MM/YYYY') +
                            ' to ' +
                            picker.endDate.format('DD/MM/YYYY');

                        span.style.display = 'inline';
                    }

                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                $('#' + ids.picker).on('cancel.daterangepicker', function() {
                    const target = this.dataset.target;
                    if (target) {
                        const span = document.querySelector(target);
                        span.textContent = '';
                        span.style.display = 'none';
                    }
                });



                // ---------- First load ----------
                setActiveTabUI('daily');
                fetchData(currentType);

                // expose if needed
                return {
                    refresh: () => fetchData(currentType, currentStartDate, currentEndDate)
                };
            }

            // ===== Vendors =====
            makeBrushBarChart({
                ids: {
                    main: 'new_vendor_signup_chart',
                    nav: 'new_vendor_signup_nav',
                    scroll: 'new_vendor_signup_scroll',
                    picker: 'vendor_sign_up_picker',
                    tabs: {
                        daily: 'new_vendor_signup_daily-tab',
                        weekly: 'new_vendor_signup_weekly-tab',
                        monthly: 'new_vendor_signup_monthly-tab',
                        yearly: 'new_vendor_signup_yearly-tab',
                    }
                },
                url: '{{ route('vendors.data') }}',
                seriesName: 'New Vendors',
                titleBase: 'New Vendor Sign Up'
            });

            // ===== Customers =====
            makeBrushBarChart({
                ids: {
                    main: 'new_customer_signup_chart',
                    nav: 'new_customer_signup_nav',
                    scroll: 'new_customer_signup_scroll',
                    picker: 'customer_sign_up_picker',
                    tabs: {
                        daily: 'new_customer_signup_daily-tab',
                        weekly: 'new_customer_signup_weekly-tab',
                        monthly: 'new_customer_signup_monthly-tab',
                        yearly: 'new_customer_signup_yearly-tab',
                    }
                },
                url: '{{ route('customers.data') }}',
                seriesName: 'New Customers',
                titleBase: 'New Customer Sign Up'
            });
        });
    </script>

    {{-- Campaigns --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ---------- Shared helpers ----------
            const clamp = (n, lo, hi) => Math.min(hi, Math.max(lo, n));

            function makeBrushBarChart({
                ids,
                url,
                seriesName,
                titleBase
            }) {
                let currentType = 'daily';
                let currentStartDate = null;
                let currentEndDate = null;

                // full dataset
                let rawLabels = [];
                let displayLabels = [];

                let
                    labels = []; // ["2025-09-01", ...] | ["W36, Sep-2025", ...] | ["Jan 2025", ...] | ["2024","2025",...]
                let values = []; // [1,2,0,...]
                let points = []; // [{x:i,y:v}]

                // current viewport (inclusive indices into full arrays)
                let vMin = 0,
                    vMax = 0;

                // DOM
                const elMain = document.querySelector('#' + ids.main);
                const elNav = document.querySelector('#' + ids.nav);
                const elScroll = document.querySelector('#' + ids.scroll);

                // ---------- Tabs UI ----------
                const tabIds = [ids.tabs.daily, ids.tabs.weekly, ids.tabs.monthly, ids.tabs.yearly];

                function setActiveTabUI(type) {
                    const map = {
                        daily: ids.tabs.daily,
                        weekly: ids.tabs.weekly,
                        monthly: ids.tabs.monthly,
                        yearly: ids.tabs.yearly
                    };
                    const activeId = map[type];
                    tabIds.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.classList.toggle('active', id === activeId);
                    });
                }

                // ---------- Main (category) chart ----------
                const mainOpts = {
                    series: [{
                        name: seriesName,
                        data: []
                    }],
                    chart: {
                        id: ids.main + '_chart',
                        type: 'bar',
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: false
                        }, // hide apex toolbar
                        zoom: {
                            enabled: false
                        }, // we'll handle zoom/pan ourselves
                        animations: {
                            easing: 'easeinout',
                            speed: 180
                        }
                    },
                    title: {
                        text: titleBase,
                        align: 'left'
                    },
                    colors: ['#e0bb20'], // Match vendor/customer yellow color
                    grid: {
                        padding: {
                            left: 2,
                            right: 2
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '18%',
                            borderRadius: 6,
                            distributed: false
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        position: 'bottom', // 👈 keep near bottom (for vertical bars)
                        offsetY: 20, // 👈 moves up from the x-axis baseline
                        background: {
                            enabled: false
                        },
                        style: {
                            colors: ['#000'], // Black data labels to match vendor/customer
                            fontWeight: 400,
                            fontSize: '10px',
                            // rotate: -45   // Keep commented out to match vertical alignment
                        },
                        formatter: (v) => v
                    },
                    xaxis: {
                        type: 'category', // ← category axis (exact 1:1 with visible bars)
                        categories: [],
                        tickPlacement: 'on',
                        rangePadding: 'none',
                        labels: {
                            rotate: -90,
                            rotateAlways: true,
                            trim: false,
                            hideOverlappingLabels: false
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Campaigns'
                        }
                    },
                    tooltip: {
                        x: {
                            formatter: (val, {
                                dataPointIndex
                            }) => (visibleLabels[dataPointIndex] ?? '')
                        },
                        y: {
                            formatter: (val) => `${val} campaigns`
                        }
                    }
                };

                // this array mirrors the xaxis categories each update; used by tooltip
                let visibleLabels = [];

                const chart = new ApexCharts(elMain, mainOpts);
                chart.render();

                // ---------- Navigator (numeric) ----------
                let nav = null;

                function renderNav() {
                    if (nav) nav.destroy();

                    const navData = values.map((y, i) => ({
                        x: i,
                        y
                    }));

                    // default window = up to 60 bars
                    vMin = 0;
                    vMax = Math.max(0, Math.min(values.length - 1, 60));

                    nav = new ApexCharts(elNav, {
                        chart: {
                            id: ids.nav + '_chart',
                            height: 110,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                            animations: {
                                enabled: false
                            },
                            // We manually handle selection; brush is unnecessary with category axis in main.
                            selection: {
                                enabled: true,
                                xaxis: {
                                    min: vMin,
                                    max: vMax
                                }
                            },
                            events: {
                                selection: (ctx, {
                                    xaxis
                                }) => {
                                    const minI = clamp(Math.round(xaxis.min), 0, labels.length - 1);
                                    const maxI = clamp(Math.round(xaxis.max), 0, labels.length - 1);
                                    applyViewport(minI, maxI, {
                                        from: 'nav'
                                    });
                                }
                            }
                        },
                        colors: ['#e0bb20'], // Match vendor/customer yellow color
                        stroke: {
                            width: 1,
                            colors: ['#e0bb20'] // Match vendor/customer yellow color
                        },
                        series: [{
                            name: 'Range',
                            data: navData
                        }],
                        xaxis: {
                            type: 'numeric',
                            labels: {
                                show: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        },
                        yaxis: {
                            show: false
                        },
                        dataLabels: {
                            enabled: false
                        },
                        fill: {
                            opacity: 0.2
                        }
                    });

                    nav.render();
                    applyViewport(vMin, vMax);
                    updateScrollbar();
                }

                // ---------- Viewport sync (slice to visible window) ----------
                function applyViewport(minI, maxI, {
                    from = 'code'
                } = {}) {
                    vMin = Math.max(0, Math.min(minI, maxI));
                    vMax = Math.max(0, Math.max(minI, maxI));

                    // slice visible window for main chart
                    const windowVals = values.slice(vMin, vMax + 1);
                    visibleLabels = displayLabels.slice(vMin, vMax + 1);

                    chart.updateOptions({
                        series: [{
                            name: seriesName,
                            data: windowVals
                        }],
                        xaxis: {
                            categories: visibleLabels
                        }
                    }, false, false);

                    // keep navigator’s selection synced
                    if (nav && from !== 'nav') {
                        nav.updateOptions({
                            chart: {
                                selection: {
                                    enabled: true,
                                    xaxis: {
                                        min: vMin,
                                        max: vMax
                                    }
                                }
                            }
                        }, false, false);
                    }

                    if (from !== 'scroll') updateScrollbar();
                }

                // ---------- Scrollbar ----------
                function updateScrollbar() {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const maxLeft = Math.max(0, labels.length - windowSize);
                    elScroll.max = String(maxLeft);
                    elScroll.step = '1';
                    elScroll.value = String(clamp(vMin, 0, maxLeft));
                    elScroll.disabled = (maxLeft === 0);
                    elScroll.title = 'Scroll to pan. Hold Ctrl/Cmd + Wheel to zoom. Wheel to pan.';
                }

                elScroll.addEventListener('input', () => {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const left = parseInt(elScroll.value || '0', 10);
                    applyViewport(left, left + windowSize - 1, {
                        from: 'scroll'
                    });
                });

                // ---------- Smooth wheel zoom & pan on MAIN ----------
                elMain.addEventListener('wheel', (e) => {
                    if (!labels.length) return;

                    const rect = elMain.getBoundingClientRect();
                    const relX = Math.min(rect.width, Math.max(0, e.clientX - rect.left));
                    const frac = rect.width > 0 ? (relX / rect.width) : 0.5;
                    const centerIdx = Math.round(vMin + frac * Math.max(0, (vMax - vMin)));

                    const delta = e.deltaY || e.wheelDelta || 0;

                    if (e.ctrlKey || e.metaKey) {
                        // ZOOM
                        e.preventDefault();
                        const currentWindow = Math.max(1, vMax - vMin + 1);
                        const scale = delta > 0 ? 1.15 : 1 / 1.15;
                        let newWindow = Math.round(currentWindow * scale);
                        newWindow = clamp(newWindow, 5, Math.max(10, Math.ceil(labels.length * 0.9)));

                        const half = Math.floor(newWindow / 2);
                        let newMin = clamp(centerIdx - half, 0, Math.max(0, labels.length - newWindow));
                        let newMax = newMin + newWindow - 1;
                        applyViewport(newMin, newMax);
                    } else {
                        // PAN
                        const panStep = Math.max(1, Math.round((vMax - vMin + 1) * 0.1));
                        const dir = delta > 0 ? 1 : -1;
                        const newMin = clamp(vMin + dir * panStep, 0, Math.max(0, labels.length - (vMax -
                            vMin + 1)));
                        const newMax = newMin + (vMax - vMin);
                        applyViewport(newMin, newMax);
                    }
                }, {
                    passive: false
                });

                // Double-click to reset window
                elMain.addEventListener('dblclick', () => {
                    const fullMax = Math.max(0, labels.length - 1);
                    const initialMax = Math.min(fullMax, 60);
                    applyViewport(0, initialMax);
                });

                // ---------- Data fetch & ingest ----------
                function fetchData(type, startDate = null, endDate = null) {
                    setActiveTabUI(type);
                    chart.updateOptions({
                        title: {
                            text: 'Loading…'
                        }
                    });
                    const req = {
                        type
                    };
                    if (startDate && endDate) {
                        req.start_date = startDate;
                        req.end_date = endDate;
                    }

                    $.ajax({
                        url,
                        type: 'GET',
                        data: req,
                        success: (payload) => ingest(payload, type),
                        error: () => chart.updateOptions({
                            title: {
                                text: 'Error loading data'
                            }
                        })
                    });
                }

                function ingest(payload, chartType) {
                    // keep insertion order, de-dupe keys
                    const seen = new Set();
                    rawLabels = [];
                    values = [];
                    Object.keys(payload).forEach(k => {
                        if (!seen.has(k)) {
                            seen.add(k);
                            rawLabels.push(k);
                            values.push(parseInt(payload[k]) || 0);
                        }
                    });

                    // build display labels
                    displayLabels = rawLabels.map(k => {
                        if (chartType === 'daily') {
                            // API gives YYYY-MM-DD → show DD-MMM-YYYY (e.g., 01-Oct-2025)
                            return moment(k, 'YYYY-MM-DD', true).isValid() ?
                                moment(k, 'YYYY-MM-DD').format('DD, MMM YY') :
                                k; // fallback if not a date string
                        }
                        return k; // weekly/monthly/yearly already humanized by backend
                    });

                    chart.updateOptions({
                        title: {
                            text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}`
                        }
                    });

                    // rebuild navigator + main
                    labels = rawLabels.slice(); // keep indices aligned for viewport math
                    renderNav(); // sets vMin/vMax and paints both charts
                }

                // ---------- Tabs ----------
                document.getElementById(ids.tabs.daily).addEventListener('click', () => {
                    currentType = 'daily';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.weekly).addEventListener('click', () => {
                    currentType = 'weekly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.monthly).addEventListener('click', () => {
                    currentType = 'monthly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.yearly).addEventListener('click', () => {
                    currentType = 'yearly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                // ---------- Date picker ----------
                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                }, function(start, end) {
                    const months = end.diff(start, 'months', true);
                    if (months < 1) {
                        this.setStartDate(moment(start));
                        this.setEndDate(moment(start).add(1, 'months'));
                    }
                });

                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                });

                $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {

                    currentStartDate = picker.startDate.format('YYYY-MM-DD');
                    currentEndDate = picker.endDate.format('YYYY-MM-DD');

                    const target = this.dataset.target;
                    if (target) {
                        const span = document.querySelector(target);
                        span.textContent =
                            picker.startDate.format('DD/MM/YYYY') +
                            ' to ' +
                            picker.endDate.format('DD/MM/YYYY');

                        span.style.display = 'inline';
                    }

                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                $('#' + ids.picker).on('cancel.daterangepicker', function() {
                    const target = this.dataset.target;
                    if (target) {
                        const span = document.querySelector(target);
                        span.textContent = '';
                        span.style.display = 'none';
                    }
                });



                // ---------- First load ----------
                setActiveTabUI('daily');
                fetchData(currentType);

                // expose if needed
                return {
                    refresh: () => fetchData(currentType, currentStartDate, currentEndDate)
                };
            }

            // ===== Campaigns =====
            makeBrushBarChart({
                ids: {
                    main: 'campaign_one_chart',
                    nav: 'campaign_one_nav',
                    scroll: 'campaign_one_scroll',
                    picker: 'campaign_one_picker',
                    tabs: {
                        daily: 'campaign_one_daily-tab',
                        weekly: 'campaign_one_weekly-tab',
                        monthly: 'campaign_one_monthly-tab',
                        yearly: 'campaign_one_yearly-tab',
                    }
                },
                url: '{{ route('campaigns.data') }}',
                seriesName: 'Campaigns Created',
                titleBase: 'Active Campaigns'
            });
        });
    </script>

    {{-- Top Vendor and Top Products --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const clamp = (n, lo, hi) => Math.min(hi, Math.max(lo, n));

            function makeBrushBarChart({
                ids,
                url,
                seriesName,
                titleBase,
                isTopChart = false,
                unit = ''
            }) {
                let currentType = 'daily';
                let currentStartDate = null;
                let currentEndDate = null;

                let rawLabels = [];
                let displayLabels = [];
                let topNames = [];
                let topSales = [];
                let labels = [];
                let values = [];

                let vMin = 0,
                    vMax = 0;

                const elMain = document.querySelector('#' + ids.main);
                const elNav = document.querySelector('#' + ids.nav);
                const elScroll = document.querySelector('#' + ids.scroll);

                const tabIds = [ids.tabs.daily, ids.tabs.weekly, ids.tabs.monthly, ids.tabs.yearly];

                function setActiveTabUI(type) {
                    const map = {
                        daily: ids.tabs.daily,
                        weekly: ids.tabs.weekly,
                        monthly: ids.tabs.monthly,
                        yearly: ids.tabs.yearly
                    };
                    const activeId = map[type];
                    tabIds.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.classList.toggle('active', id === activeId);
                    });
                }

                const mainOpts = {
                    series: [{
                        name: seriesName,
                        data: []
                    }],
                    chart: {
                        id: ids.main + '_chart',
                        type: 'bar',
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                        animations: {
                            easing: 'easeinout',
                            speed: 180
                        }
                    },
                    title: {
                        text: titleBase,
                        align: 'left'
                    },
                    colors: ['#e0bb20'],
                    grid: {
                        padding: {
                            left: 2,
                            right: 2
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '18%',
                            borderRadius: 6,
                            distributed: false
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        position: 'bottom', // 👈 keep near bottom (for vertical bars)
                        offsetY: 20, // 👈 moves up from the x-axis baseline
                        background: {
                            enabled: false
                        },
                        style: {
                            colors: ['#000'],
                            fontWeight: 400,
                            fontSize: '10px',
                            rotate: -90 // Vertical alignment for values
                        },
                        formatter: function(val, {
                            dataPointIndex,
                            w
                        }) {
                            const name = topNames[dataPointIndex] || '';
                            if (unit === 'sales') {
                                return val > 1 ? `${name} (${val} ${unit})` : `${val}`;
                            } else {
                                return `${val} ${unit}`;
                            }
                        }
                    },
                    xaxis: {
                        type: 'category',
                        categories: [],
                        tickPlacement: 'on',
                        rangePadding: 'none',
                        labels: {
                            rotate: -90,
                            rotateAlways: true,
                            trim: false,
                            hideOverlappingLabels: false
                        }
                    },
                    yaxis: {
                        title: {
                            text: seriesName
                        }
                    },
                    tooltip: {
                        x: {
                            formatter: (val, {
                                dataPointIndex
                            }) => (visibleLabels[dataPointIndex] ?? '')
                        },
                        y: {
                            formatter: (val) => `${val} ${unit}`
                        },
                        custom: function({
                            series,
                            seriesIndex,
                            dataPointIndex,
                            w
                        }) {
                            const val = series[seriesIndex][dataPointIndex];
                            const label = w.globals.labels[dataPointIndex];
                            const name = topNames[dataPointIndex] || 'Unknown';
                            const sales = topSales[dataPointIndex] ||
                                val; // Use value as proxy for sales if topSales is not populated
                            return `<div style="padding:6px 8px;">
                                <strong>${name}</strong><br>
                                ${label}<br>
                                Total Items: ${val} ${unit}<br>
                                Total Sold: ${sales}
                            </div>`;
                        }
                    }
                };

                let visibleLabels = [];
                const chart = new ApexCharts(elMain, mainOpts);
                chart.render();

                let nav = null;

                function renderNav() {
                    if (nav) nav.destroy();

                    const navData = values.map((y, i) => ({
                        x: i,
                        y
                    }));

                    vMin = 0;
                    vMax = Math.max(0, Math.min(values.length - 1, 60));

                    nav = new ApexCharts(elNav, {
                        chart: {
                            id: ids.nav + '_chart',
                            height: 110,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                            animations: {
                                enabled: false
                            },
                            selection: {
                                enabled: true,
                                xaxis: {
                                    min: vMin,
                                    max: vMax
                                }
                            },
                            events: {
                                selection: (ctx, {
                                    xaxis
                                }) => {
                                    const minI = clamp(Math.round(xaxis.min), 0, labels.length - 1);
                                    const maxI = clamp(Math.round(xaxis.max), 0, labels.length - 1);
                                    applyViewport(minI, maxI, {
                                        from: 'nav'
                                    });
                                }
                            }
                        },
                        colors: ['#e0bb20'],
                        stroke: {
                            width: 1,
                            colors: ['#e0bb20']
                        },
                        series: [{
                            name: 'Range',
                            data: navData
                        }],
                        xaxis: {
                            type: 'numeric',
                            labels: {
                                show: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        },
                        yaxis: {
                            show: false
                        },
                        dataLabels: {
                            enabled: false
                        },
                        fill: {
                            opacity: 0.2
                        }
                    });

                    nav.render();
                    applyViewport(vMin, vMax);
                    updateScrollbar();
                }

                function applyViewport(minI, maxI, {
                    from = 'code'
                } = {}) {
                    vMin = Math.max(0, Math.min(minI, maxI));
                    vMax = Math.max(0, Math.max(minI, maxI));

                    const windowVals = values.slice(vMin, vMax + 1);
                    visibleLabels = displayLabels.slice(vMin, vMax + 1);

                    chart.updateOptions({
                        series: [{
                            name: seriesName,
                            data: windowVals
                        }],
                        xaxis: {
                            categories: visibleLabels
                        }
                    }, false, false);

                    if (nav && from !== 'nav') {
                        nav.updateOptions({
                            chart: {
                                selection: {
                                    enabled: true,
                                    xaxis: {
                                        min: vMin,
                                        max: vMax
                                    }
                                }
                            }
                        }, false, false);
                    }

                    if (from !== 'scroll') updateScrollbar();
                }

                function updateScrollbar() {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const maxLeft = Math.max(0, labels.length - windowSize);
                    elScroll.max = String(maxLeft);
                    elScroll.step = '1';
                    elScroll.value = String(clamp(vMin, 0, maxLeft));
                    elScroll.disabled = (maxLeft === 0);
                    elScroll.title = 'Scroll to pan. Hold Ctrl/Cmd + Wheel to zoom. Wheel to pan.';
                }

                elScroll.addEventListener('input', () => {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const left = parseInt(elScroll.value || '0', 10);
                    applyViewport(left, left + windowSize - 1, {
                        from: 'scroll'
                    });
                });

                elMain.addEventListener('wheel', (e) => {
                    if (!labels.length) return;

                    const rect = elMain.getBoundingClientRect();
                    const relX = Math.min(rect.width, Math.max(0, e.clientX - rect.left));
                    const frac = rect.width > 0 ? (relX / rect.width) : 0.5;
                    const centerIdx = Math.round(vMin + frac * Math.max(0, (vMax - vMin)));

                    const delta = e.deltaY || e.wheelDelta || 0;

                    if (e.ctrlKey || e.metaKey) {
                        e.preventDefault();
                        const currentWindow = Math.max(1, vMax - vMin + 1);
                        const scale = delta > 0 ? 1.15 : 1 / 1.15;
                        let newWindow = Math.round(currentWindow * scale);
                        newWindow = clamp(newWindow, 5, Math.max(10, Math.ceil(labels.length * 0.9)));

                        const half = Math.floor(newWindow / 2);
                        let newMin = clamp(centerIdx - half, 0, Math.max(0, labels.length - newWindow));
                        let newMax = newMin + newWindow - 1;
                        applyViewport(newMin, newMax);
                    } else {
                        const panStep = Math.max(1, Math.round((vMax - vMin + 1) * 0.1));
                        const dir = delta > 0 ? 1 : -1;
                        const newMin = clamp(vMin + dir * panStep, 0, Math.max(0, labels.length - (vMax -
                            vMin + 1)));
                        const newMax = newMin + (vMax - vMin);
                        applyViewport(newMin, newMax);
                    }
                }, {
                    passive: false
                });

                elMain.addEventListener('dblclick', () => {
                    const fullMax = Math.max(0, labels.length - 1);
                    const initialMax = Math.min(fullMax, 60);
                    applyViewport(0, initialMax);
                });

                function fetchData(type, startDate = null, endDate = null) {
                    setActiveTabUI(type);
                    chart.updateOptions({
                        title: {
                            text: 'Loading…'
                        }
                    });
                    const req = {
                        type
                    };
                    if (startDate && endDate) {
                        req.start_date = startDate;
                        req.end_date = endDate;
                    }

                    $.ajax({
                        url,
                        type: 'GET',
                        data: req,
                        success: (payload) => ingest(payload, type),
                        error: () => chart.updateOptions({
                            title: {
                                text: 'Error loading data'
                            }
                        })
                    });
                }

                function ingest(payload, chartType) {
                    const seen = new Set();
                    rawLabels = [];
                    values = [];
                    topNames = [];
                    topSales = [];

                    Object.keys(payload).forEach(k => {
                        if (!seen.has(k)) {
                            seen.add(k);
                            rawLabels.push(k);
                            const val = payload[k];
                            if (isTopChart && typeof val === 'object' && val !== null && 'name' in val &&
                                'value' in val) {
                                values.push(parseInt(val.value) || 0);
                                topNames.push(val.name || 'None');
                                topSales.push(parseInt(val.sales || val.value) ||
                                    0); // Use value as proxy for sales if not provided
                            } else {
                                values.push(parseInt(val) || 0);
                                topNames.push('');
                                topSales.push(0);
                            }
                        }
                    });

                    displayLabels = rawLabels.map(k => {
                        if (chartType === 'daily' && moment(k, 'YYYY-MM-DD', true).isValid()) {
                            return moment(k, 'YYYY-MM-DD').format('DD, MMM YY');
                        }
                        return k;
                    });

                    chart.updateOptions({
                        title: {
                            text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}`
                        }
                    });

                    labels = rawLabels.slice();
                    renderNav();
                }

                document.getElementById(ids.tabs.daily).addEventListener('click', () => {
                    currentType = 'daily';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.weekly).addEventListener('click', () => {
                    currentType = 'weekly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.monthly).addEventListener('click', () => {
                    currentType = 'monthly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.yearly).addEventListener('click', () => {
                    currentType = 'yearly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year')
                });
                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                });

                $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {

                    currentStartDate = picker.startDate.format('YYYY-MM-DD');
                    currentEndDate = picker.endDate.format('YYYY-MM-DD');

                    const target = this.dataset.target;
                    if (target) {
                        const span = document.querySelector(target);
                        span.textContent =
                            picker.startDate.format('DD/MM/YYYY') +
                            ' to ' +
                            picker.endDate.format('DD/MM/YYYY');

                        span.style.display = 'inline';
                    }

                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                $('#' + ids.picker).on('cancel.daterangepicker', function() {
                    const target = this.dataset.target;
                    if (target) {
                        const span = document.querySelector(target);
                        span.textContent = '';
                        span.style.display = 'none';
                    }
                });



                setActiveTabUI('daily');
                fetchData(currentType);
            }

            // Top Selling Vendors
            makeBrushBarChart({
                ids: {
                    main: 'top_vendor_chart',
                    nav: 'top_vendor_nav',
                    scroll: 'top_vendor_scroll',
                    picker: 'top_vendors_picker',
                    tabs: {
                        daily: 'top_vendors_daily-tab',
                        weekly: 'top_vendors_weekly-tab',
                        monthly: 'top_vendors_monthly-tab',
                        yearly: 'top_vendors_yearly-tab',
                    }
                },
                url: '{{ route('top-vendors.data') }}',
                seriesName: 'Sales',
                titleBase: 'Top Selling Vendors',
                isTopChart: true,
                unit: 'sales'
            });

            // Top Selling Products
            makeBrushBarChart({
                ids: {
                    main: 'top_products_chart',
                    nav: 'top_products_nav',
                    scroll: 'top_products_scroll',
                    picker: 'top_products_picker',
                    tabs: {
                        daily: 'top_products_daily-tab',
                        weekly: 'top_products_weekly-tab',
                        monthly: 'top_products_monthly-tab',
                        yearly: 'top_products_yearly-tab',
                    }
                },
                url: '{{ route('top-products.data') }}',
                seriesName: 'Units Sold',
                titleBase: 'Top Selling Products',
                isTopChart: true,
                unit: 'items'
            });
        });
    </script>


    {{-- Vendor Payout --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ---------- Shared helpers ----------
            const clamp = (n, lo, hi) => Math.min(hi, Math.max(lo, n));

            function makeBrushBarChart({
                ids,
                url,
                seriesName,
                titleBase
            }) {
                let currentType = 'daily';
                let currentStartDate = null;
                let currentEndDate = null;

                // full dataset
                let rawLabels = [];
                let displayLabels = [];

                let
                    labels = []; // ["2025-09-01", ...] | ["W36, Sep-2025", ...] | ["Jan 2025", ...] | ["2024","2025",...]
                let values = []; // [1,2,0,...]
                let points = []; // [{x:i,y:v}]

                // current viewport (inclusive indices into full arrays)
                let vMin = 0,
                    vMax = 0;

                // DOM
                const elMain = document.querySelector('#' + ids.main);
                const elNav = document.querySelector('#' + ids.nav);
                const elScroll = document.querySelector('#' + ids.scroll);

                // ---------- Tabs UI ----------
                const tabIds = [ids.tabs.daily, ids.tabs.weekly, ids.tabs.monthly, ids.tabs.yearly];

                function setActiveTabUI(type) {
                    const map = {
                        daily: ids.tabs.daily,
                        weekly: ids.tabs.weekly,
                        monthly: ids.tabs.monthly,
                        yearly: ids.tabs.yearly
                    };
                    const activeId = map[type];
                    tabIds.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.classList.toggle('active', id === activeId);
                    });
                }

                // ---------- Main (category) chart ----------
                const mainOpts = {
                    series: [{
                        name: seriesName,
                        data: []
                    }],
                    chart: {
                        id: ids.main + '_chart',
                        type: 'bar',
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: false
                        }, // hide apex toolbar
                        zoom: {
                            enabled: false
                        }, // we'll handle zoom/pan ourselves
                        animations: {
                            easing: 'easeinout',
                            speed: 180
                        }
                    },
                    title: {
                        text: titleBase,
                        align: 'left'
                    },
                    colors: ['#e0bb20'], // Match vendor/customer yellow color
                    grid: {
                        padding: {
                            left: 2,
                            right: 2
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '18%',
                            borderRadius: 6,
                            distributed: false
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        position: 'bottom', // 👈 keep near bottom (for vertical bars)
                        offsetY: 20, // 👈 moves up from the x-axis baseline
                        background: {
                            enabled: false
                        },
                        style: {
                            colors: ['#000'], // Black data labels to match vendor/customer
                            fontWeight: 400,
                            fontSize: '10px',
                            // rotate: -45   // Keep commented out to match vertical alignment
                        },
                        formatter: (v) => `$ ${v.toFixed(2)}`
                    },
                    xaxis: {
                        type: 'category', // ← category axis (exact 1:1 with visible bars)
                        categories: [],
                        tickPlacement: 'on',
                        rangePadding: 'none',
                        labels: {
                            rotate: -90,
                            rotateAlways: true,
                            trim: false,
                            hideOverlappingLabels: false
                        }
                    },
                    yaxis: {
                        title: {
                            text: '$ (USD)'
                        }
                    },
                    tooltip: {
                        x: {
                            formatter: (val, {
                                dataPointIndex
                            }) => (visibleLabels[dataPointIndex] ?? '')
                        },
                        y: {
                            formatter: (val) => `$ ${val.toFixed(2)} USD`
                        }
                    }
                };

                // this array mirrors the xaxis categories each update; used by tooltip
                let visibleLabels = [];

                const chart = new ApexCharts(elMain, mainOpts);
                chart.render();

                // ---------- Navigator (numeric) ----------
                let nav = null;

                function renderNav() {
                    if (nav) nav.destroy();

                    const navData = values.map((y, i) => ({
                        x: i,
                        y
                    }));

                    if (navData.length === 0 || values.length <= 12) {
                        return; // No data or small dataset, skip nav
                    }

                    // default window = up to 60 bars
                    vMin = 0;
                    vMax = Math.max(0, Math.min(values.length - 1, 60));

                    nav = new ApexCharts(elNav, {
                        chart: {
                            id: ids.nav + '_chart',
                            height: 110,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                            animations: {
                                enabled: false
                            },
                            // We manually handle selection; brush is unnecessary with category axis in main.
                            selection: {
                                enabled: true,
                                xaxis: {
                                    min: vMin,
                                    max: vMax
                                }
                            },
                            events: {
                                selection: (ctx, {
                                    xaxis
                                }) => {
                                    const minI = clamp(Math.round(xaxis.min), 0, labels.length - 1);
                                    const maxI = clamp(Math.round(xaxis.max), 0, labels.length - 1);
                                    applyViewport(minI, maxI, {
                                        from: 'nav'
                                    });
                                }
                            }
                        },
                        colors: ['#e0bb20'], // Match vendor/customer yellow color
                        stroke: {
                            width: 1,
                            colors: ['#e0bb20'] // Match vendor/customer yellow color
                        },
                        series: [{
                            name: 'Range',
                            data: navData
                        }],
                        xaxis: {
                            type: 'numeric',
                            labels: {
                                show: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        },
                        yaxis: {
                            show: false
                        },
                        dataLabels: {
                            enabled: false
                        },
                        fill: {
                            opacity: 0.2
                        }
                    });

                    nav.render();
                    applyViewport(vMin, vMax);
                    updateScrollbar();
                }

                // ---------- Viewport sync (slice to visible window) ----------
                function applyViewport(minI, maxI, {
                    from = 'code'
                } = {}) {
                    vMin = Math.max(0, Math.min(minI, maxI));
                    vMax = Math.max(0, Math.max(minI, maxI));

                    // slice visible window for main chart
                    const windowVals = values.slice(vMin, vMax + 1);
                    visibleLabels = displayLabels.slice(vMin, vMax + 1);

                    chart.updateOptions({
                        series: [{
                            name: seriesName,
                            data: windowVals
                        }],
                        xaxis: {
                            categories: visibleLabels
                        }
                    }, false, false);

                    // keep navigator’s selection synced
                    if (nav && from !== 'nav') {
                        nav.updateOptions({
                            chart: {
                                selection: {
                                    enabled: true,
                                    xaxis: {
                                        min: vMin,
                                        max: vMax
                                    }
                                }
                            }
                        }, false, false);
                    }

                    if (from !== 'scroll') updateScrollbar();
                }

                // ---------- Scrollbar ----------
                function updateScrollbar() {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const maxLeft = Math.max(0, labels.length - windowSize);
                    elScroll.max = String(maxLeft);
                    elScroll.step = '1';
                    elScroll.value = String(clamp(vMin, 0, maxLeft));
                    elScroll.disabled = (maxLeft === 0);
                    elScroll.title = 'Scroll to pan. Hold Ctrl/Cmd + Wheel to zoom. Wheel to pan.';
                }

                elScroll.addEventListener('input', () => {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const left = parseInt(elScroll.value || '0', 10);
                    applyViewport(left, left + windowSize - 1, {
                        from: 'scroll'
                    });
                });

                // ---------- Smooth wheel zoom & pan on MAIN ----------
                elMain.addEventListener('wheel', (e) => {
                    if (!labels.length) return;

                    const rect = elMain.getBoundingClientRect();
                    const relX = Math.min(rect.width, Math.max(0, e.clientX - rect.left));
                    const frac = rect.width > 0 ? (relX / rect.width) : 0.5;
                    const centerIdx = Math.round(vMin + frac * Math.max(0, (vMax - vMin)));

                    const delta = e.deltaY || e.wheelDelta || 0;

                    if (e.ctrlKey || e.metaKey) {
                        // ZOOM
                        e.preventDefault();
                        const currentWindow = Math.max(1, vMax - vMin + 1);
                        const scale = delta > 0 ? 1.15 : 1 / 1.15;
                        let newWindow = Math.round(currentWindow * scale);
                        newWindow = clamp(newWindow, 5, Math.max(10, Math.ceil(labels.length * 0.9)));

                        const half = Math.floor(newWindow / 2);
                        let newMin = clamp(centerIdx - half, 0, Math.max(0, labels.length - newWindow));
                        let newMax = newMin + newWindow - 1;
                        applyViewport(newMin, newMax);
                    } else {
                        // PAN
                        const panStep = Math.max(1, Math.round((vMax - vMin + 1) * 0.1));
                        const dir = delta > 0 ? 1 : -1;
                        const newMin = clamp(vMin + dir * panStep, 0, Math.max(0, labels.length - (vMax -
                            vMin + 1)));
                        const newMax = newMin + (vMax - vMin);
                        applyViewport(newMin, newMax);
                    }
                }, {
                    passive: false
                });

                // Double-click to reset window
                elMain.addEventListener('dblclick', () => {
                    const fullMax = Math.max(0, labels.length - 1);
                    const initialMax = Math.min(fullMax, 60);
                    applyViewport(0, initialMax);
                });

                // ---------- Data fetch & ingest ----------
                function fetchData(type, startDate = null, endDate = null) {
                    setActiveTabUI(type);
                    chart.updateOptions({
                        title: {
                            text: 'Loading…'
                        }
                    });
                    const req = {
                        type
                    };
                    if (startDate && endDate) {
                        req.start_date = startDate;
                        req.end_date = endDate;
                    }

                    $.ajax({
                        url,
                        type: 'GET',
                        data: req,
                        success: (payload) => ingest(payload, type),
                        error: () => chart.updateOptions({
                            title: {
                                text: 'Error loading data'
                            }
                        })
                    });
                }

                function ingest(payload, chartType) {
                    // keep insertion order, de-dupe keys
                    const seen = new Set();
                    rawLabels = [];
                    values = [];
                    Object.keys(payload).forEach(k => {
                        if (!seen.has(k)) {
                            seen.add(k);
                            rawLabels.push(k);
                            values.push(parseFloat(payload[k]) || 0.0);
                        }
                    });

                    // build display labels
                    displayLabels = rawLabels.map(k => {
                        if (chartType === 'daily') {
                            // API gives YYYY-MM-DD → show DD-MMM-YYYY (e.g., 01-Oct-2025)
                            return moment(k, 'YYYY-MM-DD', true).isValid() ?
                                moment(k, 'YYYY-MM-DD').format('DD, MMM YY') :
                                k; // fallback if not a date string
                        }
                        return k; // weekly/monthly/yearly already humanized by backend
                    });

                    chart.updateOptions({
                        title: {
                            text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}`
                        }
                    });

                    // rebuild navigator + main
                    labels = rawLabels.slice(); // keep indices aligned for viewport math
                    renderNav(); // sets vMin/vMax and paints both charts
                }

                // ---------- Tabs ----------
                document.getElementById(ids.tabs.daily).addEventListener('click', () => {
                    currentType = 'daily';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.weekly).addEventListener('click', () => {
                    currentType = 'weekly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.monthly).addEventListener('click', () => {
                    currentType = 'monthly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.yearly).addEventListener('click', () => {
                    currentType = 'yearly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                // ---------- Date picker ----------
                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                }, function(start, end) {
                    const months = end.diff(start, 'months', true);
                    if (months < 1) {
                        this.setStartDate(moment(start));
                        this.setEndDate(moment(start).add(1, 'months'));
                    }
                });
                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                });

                $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {

                    currentStartDate = picker.startDate.format('YYYY-MM-DD');
                    currentEndDate = picker.endDate.format('YYYY-MM-DD');

                    const target = this.dataset.target;
                    if (target) {
                        const span = document.querySelector(target);
                        span.textContent =
                            picker.startDate.format('DD/MM/YYYY') +
                            ' to ' +
                            picker.endDate.format('DD/MM/YYYY');

                        span.style.display = 'inline';
                    }

                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                $('#' + ids.picker).on('cancel.daterangepicker', function() {
                    const target = this.dataset.target;
                    if (target) {
                        const span = document.querySelector(target);
                        span.textContent = '';
                        span.style.display = 'none';
                    }
                });



                // ---------- First load ----------
                setActiveTabUI('daily');
                fetchData(currentType);

                // expose if needed
                return {
                    refresh: () => fetchData(currentType, currentStartDate, currentEndDate)
                };
            }

            // ===== Pending Vendor Payouts =====
            makeBrushBarChart({
                ids: {
                    main: 'pending_vendor_payouts_chart',
                    nav: 'pending_vendor_payouts_nav',
                    scroll: 'pending_vendor_payouts_scroll',
                    picker: 'pending_vendor_payouts_picker',
                    tabs: {
                        daily: 'pending_vendor_payouts_daily-tab',
                        weekly: 'pending_vendor_payouts_weekly-tab',
                        monthly: 'pending_vendor_payouts_monthly-tab',
                        yearly: 'pending_vendor_payouts_yearly-tab',
                    }
                },
                url: '{{ route('vendor-payouts.data') }}',
                seriesName: 'Pending Payouts',
                titleBase: 'Pending Vendor Payouts'
            });
        });
    </script>

    {{-- Order Revenue --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ---------- Shared helpers ----------
            const clamp = (n, lo, hi) => Math.min(hi, Math.max(lo, n));

            function makeBrushBarChart({
                ids,
                url,
                seriesName,
                titleBase
            }) {
                let currentType = 'daily';
                let currentStartDate = null;
                let currentEndDate = null;

                // full dataset
                let rawLabels = [];
                let displayLabels = [];

                let
                    labels = []; // ["2025-09-01", ...] | ["W36, Sep-2025", ...] | ["Jan 2025", ...] | ["2024","2025",...]
                let values = []; // [1,2,0,...]
                let points = []; // [{x:i,y:v}]

                // current viewport (inclusive indices into full arrays)
                let vMin = 0,
                    vMax = 0;

                // DOM
                const elMain = document.querySelector('#' + ids.main);
                const elNav = document.querySelector('#' + ids.nav);
                const elScroll = document.querySelector('#' + ids.scroll);

                // ---------- Tabs UI ----------
                const tabIds = [ids.tabs.daily, ids.tabs.weekly, ids.tabs.monthly, ids.tabs.yearly];

                function setActiveTabUI(type) {
                    const map = {
                        daily: ids.tabs.daily,
                        weekly: ids.tabs.weekly,
                        monthly: ids.tabs.monthly,
                        yearly: ids.tabs.yearly
                    };
                    const activeId = map[type];
                    tabIds.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.classList.toggle('active', id === activeId);
                    });
                }

                // ---------- Main (category) chart ----------
                const mainOpts = {
                    series: [{
                        name: seriesName,
                        data: []
                    }],
                    chart: {
                        id: ids.main + '_chart',
                        type: 'bar',
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: false
                        }, // hide apex toolbar
                        zoom: {
                            enabled: false
                        }, // we'll handle zoom/pan ourselves
                        animations: {
                            easing: 'easeinout',
                            speed: 180
                        }
                    },
                    title: {
                        text: titleBase,
                        align: 'left'
                    },
                    colors: ['#e0bb20'],
                    grid: {
                        padding: {
                            left: 2,
                            right: 2
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '18%',
                            borderRadius: 6,
                            distributed: false
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        position: 'bottom', // 👈 keep near bottom (for vertical bars)
                        offsetY: 20, // 👈 moves up from the x-axis baseline
                        background: {
                            enabled: false
                        },
                        style: {
                            colors: ['#000'],
                            fontWeight: 400,
                            fontSize: '10px',
                            // rotate: -45   // 👈 tilt the numbers
                        },
                        formatter: (v) => `$ ${v.toFixed(2)}`
                    },
                    xaxis: {
                        type: 'category', // ← category axis (exact 1:1 with visible bars)
                        categories: [],
                        tickPlacement: 'on',
                        rangePadding: 'none',
                        labels: {
                            rotate: -90,
                            rotateAlways: true,
                            trim: false,
                            hideOverlappingLabels: false
                        }
                    },
                    yaxis: {
                        title: {
                            text: '$ (USD)'
                        }
                    },
                    tooltip: {
                        x: {
                            formatter: (val, {
                                dataPointIndex
                            }) => (visibleLabels[dataPointIndex] ?? '')
                        },
                        y: {
                            formatter: (val) => `$ ${val.toFixed(2)} USD`
                        }
                    }
                };

                // this array mirrors the xaxis categories each update; used by tooltip
                let visibleLabels = [];

                const chart = new ApexCharts(elMain, mainOpts);
                chart.render();

                // ---------- Navigator (numeric) ----------
                let nav = null;

                function renderNav() {
                    if (nav) nav.destroy();

                    const navData = values.map((y, i) => ({
                        x: i,
                        y
                    }));

                    if (navData.length === 0 || values.length <= 12) {
                        return; // No data or small dataset, skip nav
                    }

                    // default window = up to 60 bars
                    vMin = 0;
                    vMax = Math.max(0, Math.min(values.length - 1, 60));

                    nav = new ApexCharts(elNav, {
                        chart: {
                            id: ids.nav + '_chart',
                            height: 110,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                            animations: {
                                enabled: false
                            },
                            // We manually handle selection; brush is unnecessary with category axis in main.
                            selection: {
                                enabled: true,
                                xaxis: {
                                    min: vMin,
                                    max: vMax
                                }
                            },
                            events: {
                                selection: (ctx, {
                                    xaxis
                                }) => {
                                    const minI = clamp(Math.round(xaxis.min), 0, labels.length - 1);
                                    const maxI = clamp(Math.round(xaxis.max), 0, labels.length - 1);
                                    applyViewport(minI, maxI, {
                                        from: 'nav'
                                    });
                                }
                            }
                        },
                        colors: ['#e0bb20'],
                        stroke: {
                            width: 1,
                            colors: ['#e0bb20']
                        },
                        series: [{
                            name: 'Range',
                            data: navData
                        }],
                        xaxis: {
                            type: 'numeric',
                            labels: {
                                show: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        },
                        yaxis: {
                            show: false
                        },
                        dataLabels: {
                            enabled: false
                        },
                        fill: {
                            opacity: 0.2
                        }
                    });

                    nav.render();
                    applyViewport(vMin, vMax);
                    updateScrollbar();
                }

                // ---------- Viewport sync (slice to visible window) ----------
                function applyViewport(minI, maxI, {
                    from = 'code'
                } = {}) {
                    vMin = Math.max(0, Math.min(minI, maxI));
                    vMax = Math.max(0, Math.max(minI, maxI));

                    // slice visible window for main chart
                    const windowVals = values.slice(vMin, vMax + 1);
                    visibleLabels = displayLabels.slice(vMin, vMax + 1);

                    chart.updateOptions({
                        series: [{
                            name: seriesName,
                            data: windowVals
                        }],
                        xaxis: {
                            categories: visibleLabels
                        }
                    }, false, false);

                    // keep navigator’s selection synced
                    if (nav && from !== 'nav') {
                        nav.updateOptions({
                            chart: {
                                selection: {
                                    enabled: true,
                                    xaxis: {
                                        min: vMin,
                                        max: vMax
                                    }
                                }
                            }
                        }, false, false);
                    }

                    if (from !== 'scroll') updateScrollbar();
                }

                // ---------- Scrollbar ----------
                function updateScrollbar() {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const maxLeft = Math.max(0, labels.length - windowSize);
                    elScroll.max = String(maxLeft);
                    elScroll.step = '1';
                    elScroll.value = String(clamp(vMin, 0, maxLeft));
                    elScroll.disabled = (maxLeft === 0);
                    elScroll.title = 'Scroll to pan. Hold Ctrl/Cmd + Wheel to zoom. Wheel to pan.';
                }

                elScroll.addEventListener('input', () => {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const left = parseInt(elScroll.value || '0', 10);
                    applyViewport(left, left + windowSize - 1, {
                        from: 'scroll'
                    });
                });

                // ---------- Smooth wheel zoom & pan on MAIN ----------
                elMain.addEventListener('wheel', (e) => {
                    if (!labels.length) return;

                    const rect = elMain.getBoundingClientRect();
                    const relX = Math.min(rect.width, Math.max(0, e.clientX - rect.left));
                    const frac = rect.width > 0 ? (relX / rect.width) : 0.5;
                    const centerIdx = Math.round(vMin + frac * Math.max(0, (vMax - vMin)));

                    const delta = e.deltaY || e.wheelDelta || 0;

                    if (e.ctrlKey || e.metaKey) {
                        // ZOOM
                        e.preventDefault();
                        const currentWindow = Math.max(1, vMax - vMin + 1);
                        const scale = delta > 0 ? 1.15 : 1 / 1.15;
                        let newWindow = Math.round(currentWindow * scale);
                        newWindow = clamp(newWindow, 5, Math.max(10, Math.ceil(labels.length * 0.9)));

                        const half = Math.floor(newWindow / 2);
                        let newMin = clamp(centerIdx - half, 0, Math.max(0, labels.length - newWindow));
                        let newMax = newMin + newWindow - 1;
                        applyViewport(newMin, newMax);
                    } else {
                        // PAN
                        const panStep = Math.max(1, Math.round((vMax - vMin + 1) * 0.1));
                        const dir = delta > 0 ? 1 : -1;
                        const newMin = clamp(vMin + dir * panStep, 0, Math.max(0, labels.length - (vMax -
                            vMin + 1)));
                        const newMax = newMin + (vMax - vMin);
                        applyViewport(newMin, newMax);
                    }
                }, {
                    passive: false
                });

                // Double-click to reset window
                elMain.addEventListener('dblclick', () => {
                    const fullMax = Math.max(0, labels.length - 1);
                    const initialMax = Math.min(fullMax, 60);
                    applyViewport(0, initialMax);
                });

                // ---------- Data fetch & ingest ----------
                function fetchData(type, startDate = null, endDate = null) {
                    setActiveTabUI(type);
                    chart.updateOptions({
                        title: {
                            text: 'Loading…'
                        }
                    });
                    const req = {
                        type
                    };
                    if (startDate && endDate) {
                        req.start_date = startDate;
                        req.end_date = endDate;
                    }

                    $.ajax({
                        url,
                        type: 'GET',
                        data: req,
                        success: (payload) => ingest(payload, type),
                        error: () => chart.updateOptions({
                            title: {
                                text: 'Error loading data'
                            }
                        })
                    });
                }

                function ingest(payload, chartType) {
                    // keep insertion order, de-dupe keys
                    const seen = new Set();
                    rawLabels = [];
                    values = [];
                    Object.keys(payload).forEach(k => {
                        if (!seen.has(k)) {
                            seen.add(k);
                            rawLabels.push(k);
                            values.push(parseFloat(payload[k]) || 0.0);
                        }
                    });

                    // build display labels
                    displayLabels = rawLabels.map(k => {
                        if (chartType === 'daily') {
                            // API gives YYYY-MM-DD → show DD-MMM-YYYY (e.g., 01-Oct-2025)
                            return moment(k, 'YYYY-MM-DD', true).isValid() ?
                                moment(k, 'YYYY-MM-DD').format('DD, MMM YY') :
                                k; // fallback if not a date string
                        }
                        return k; // weekly/monthly/yearly already humanized by backend
                    });

                    chart.updateOptions({
                        title: {
                            text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}`
                        }
                    });

                    // rebuild navigator + main
                    labels = rawLabels.slice(); // keep indices aligned for viewport math
                    renderNav(); // sets vMin/vMax and paints both charts
                }


                // ---------- Tabs ----------
                document.getElementById(ids.tabs.daily).addEventListener('click', () => {
                    currentType = 'daily';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.weekly).addEventListener('click', () => {
                    currentType = 'weekly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.monthly).addEventListener('click', () => {
                    currentType = 'monthly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.yearly).addEventListener('click', () => {
                    currentType = 'yearly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                // ---------- Date picker ----------
                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                }, function(start, end) {
                    const months = end.diff(start, 'months', true);
                    if (months < 1) {
                        this.setStartDate(moment(start));
                        this.setEndDate(moment(start).add(1, 'months'));
                    }
                });

                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                });

                $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {

                    currentStartDate = picker.startDate.format('YYYY-MM-DD');
                    currentEndDate = picker.endDate.format('YYYY-MM-DD');

                    const target = this.dataset.target;
                    if (target) {
                        const span = document.querySelector(target);
                        span.textContent =
                            picker.startDate.format('DD/MM/YYYY') +
                            ' to ' +
                            picker.endDate.format('DD/MM/YYYY');

                        span.style.display = 'inline';
                    }

                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                $('#' + ids.picker).on('cancel.daterangepicker', function() {
                    const target = this.dataset.target;
                    if (target) {
                        const span = document.querySelector(target);
                        span.textContent = '';
                        span.style.display = 'none';
                    }
                });



                // ---------- First load ----------
                setActiveTabUI('daily');
                fetchData(currentType);

                // expose if needed
                return {
                    refresh: () => fetchData(currentType, currentStartDate, currentEndDate)
                };
            }

            // ===== Order Revenue =====
            makeBrushBarChart({
                ids: {
                    main: 'order_revenue_chart',
                    nav: 'order_revenue_nav',
                    scroll: 'order_revenue_scroll',
                    picker: 'order_revenue_picker',
                    tabs: {
                        daily: 'order_revenue_daily-tab',
                        weekly: 'order_revenue_weekly-tab',
                        monthly: 'order_revenue_monthly-tab',
                        yearly: 'order_revenue_yearly-tab',
                    }
                },
                url: '{{ route('income.data') }}',
                seriesName: 'Order Revenue',
                titleBase: 'Order Revenue'
            });
        });
    </script>


    // {{-- Website Visitors Dummy Graph --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ---------- Shared helpers ----------
            const clamp = (n, lo, hi) => Math.min(hi, Math.max(lo, n));

            function makeBrushBarChart({
                ids,
                url,
                seriesName,
                titleBase
            }) {
                let currentType = 'daily';
                let currentStartDate = null;
                let currentEndDate = null;

                // full dataset
                let rawLabels = [];
                let displayLabels = [];

                let
                    labels = []; // ["2025-09-01", ...] | ["W36, Sep-2025", ...] | ["Jan 2025", ...] | ["2024","2025",...]
                let values = []; // [1,2,0,...]
                let points = []; // [{x:i,y:v}]

                // current viewport (inclusive indices into full arrays)
                let vMin = 0,
                    vMax = 0;

                // DOM
                const elMain = document.querySelector('#' + ids.main);
                const elNav = document.querySelector('#' + ids.nav);
                const elScroll = document.querySelector('#' + ids.scroll);

                // ---------- Tabs UI ----------
                const tabIds = [ids.tabs.daily, ids.tabs.weekly, ids.tabs.monthly, ids.tabs.yearly];

                function setActiveTabUI(type) {
                    const map = {
                        daily: ids.tabs.daily,
                        weekly: ids.tabs.weekly,
                        monthly: ids.tabs.monthly,
                        yearly: ids.tabs.yearly
                    };
                    const activeId = map[type];
                    tabIds.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.classList.toggle('active', id === activeId);
                    });
                }

                // ---------- Main (category) chart ----------
                const mainOpts = {
                    series: [{
                        name: seriesName,
                        data: []
                    }],
                    chart: {
                        id: ids.main + '_chart',
                        type: 'bar',
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: false
                        }, // hide apex toolbar
                        zoom: {
                            enabled: false
                        }, // we'll handle zoom/pan ourselves
                        animations: {
                            easing: 'easeinout',
                            speed: 180
                        }
                    },
                    title: {
                        text: titleBase,
                        align: 'left'
                    },
                    colors: ['#e0bb20'], // Match vendor/customer yellow color
                    grid: {
                        padding: {
                            left: 2,
                            right: 2,
                            bottom: 20 // Increased bottom padding to reduce overlap with x-axis labels
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '18%',
                            borderRadius: 6,
                            distributed: false,
                            dataLabels: {
                                position: 'bottom' // Ensure labels start from the top of the bar
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        offsetY: 10, // Start from the x-axis line; adjust to positive if needed
                        background: {
                            enabled: false
                        },
                        style: {
                            colors: ['#000'], // Black data labels to match vendor/customer
                            fontWeight: 400,
                            fontSize: '10px'
                            // Vertical alignment handled by CSS with rotate: -90deg
                        },
                        formatter: (v) => v
                    },
                    xaxis: {
                        type: 'category', // ← category axis (exact 1:1 with visible bars)
                        categories: [],
                        tickPlacement: 'on',
                        rangePadding: 'none',
                        labels: {
                            rotate: -90,
                            rotateAlways: true,
                            trim: false,
                            hideOverlappingLabels: false
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Website Visitors'
                        }
                    },
                    tooltip: {
                        x: {
                            formatter: (val, {
                                dataPointIndex
                            }) => (visibleLabels[dataPointIndex] ?? '')
                        },
                        y: {
                            formatter: (val) => `${val} visitors`
                        }
                    }
                };

                // this array mirrors the xaxis categories each update; used by tooltip
                let visibleLabels = [];

                const chart = new ApexCharts(elMain, mainOpts);
                chart.render();

                // ---------- Navigator (numeric) ----------
                let nav = null;

                function renderNav() {
                    if (nav) nav.destroy();

                    const navData = values.map((y, i) => ({
                        x: i,
                        y
                    }));

                    // default window = up to 60 bars
                    vMin = 0;
                    vMax = Math.max(0, Math.min(values.length - 1, 60));

                    nav = new ApexCharts(elNav, {
                        chart: {
                            id: ids.nav + '_chart',
                            height: 110,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                            animations: {
                                enabled: false
                            },
                            // We manually handle selection; brush is unnecessary with category axis in main.
                            selection: {
                                enabled: true,
                                xaxis: {
                                    min: vMin,
                                    max: vMax
                                }
                            },
                            events: {
                                selection: (ctx, {
                                    xaxis
                                }) => {
                                    const minI = clamp(Math.round(xaxis.min), 0, labels.length - 1);
                                    const maxI = clamp(Math.round(xaxis.max), 0, labels.length - 1);
                                    applyViewport(minI, maxI, {
                                        from: 'nav'
                                    });
                                }
                            }
                        },
                        colors: ['#e0bb20'], // Match vendor/customer yellow color
                        stroke: {
                            width: 1,
                            colors: ['#e0bb20'] // Match vendor/customer yellow color
                        },
                        series: [{
                            name: 'Range',
                            data: navData
                        }],
                        xaxis: {
                            type: 'numeric',
                            labels: {
                                show: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        },
                        yaxis: {
                            show: false
                        },
                        dataLabels: {
                            enabled: false
                        },
                        fill: {
                            opacity: 0.2
                        }
                    });

                    nav.render();
                    applyViewport(vMin, vMax);
                    updateScrollbar();
                }

                // ---------- Viewport sync (slice to visible window) ----------
                function applyViewport(minI, maxI, {
                    from = 'code'
                } = {}) {
                    vMin = Math.max(0, Math.min(minI, maxI));
                    vMax = Math.max(0, Math.max(minI, maxI));

                    // slice visible window for main chart
                    const windowVals = values.slice(vMin, vMax + 1);
                    visibleLabels = displayLabels.slice(vMin, vMax + 1);

                    chart.updateOptions({
                        series: [{
                            name: seriesName,
                            data: windowVals
                        }],
                        xaxis: {
                            categories: visibleLabels
                        }
                    }, false, false);

                    // keep navigator’s selection synced
                    if (nav && from !== 'nav') {
                        nav.updateOptions({
                            chart: {
                                selection: {
                                    enabled: true,
                                    xaxis: {
                                        min: vMin,
                                        max: vMax
                                    }
                                }
                            }
                        }, false, false);
                    }

                    if (from !== 'scroll') updateScrollbar();
                }

                // ---------- Scrollbar ----------
                function updateScrollbar() {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const maxLeft = Math.max(0, labels.length - windowSize);
                    elScroll.max = String(maxLeft);
                    elScroll.step = '1';
                    elScroll.value = String(clamp(vMin, 0, maxLeft));
                    elScroll.disabled = (maxLeft === 0);
                    elScroll.title = 'Scroll to pan. Hold Ctrl/Cmd + Wheel to zoom. Wheel to pan.';
                }

                elScroll.addEventListener('input', () => {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const left = parseInt(elScroll.value || '0', 10);
                    applyViewport(left, left + windowSize - 1, {
                        from: 'scroll'
                    });
                });

                // ---------- Smooth wheel zoom & pan on MAIN ----------
                elMain.addEventListener('wheel', (e) => {
                    if (!labels.length) return;

                    const rect = elMain.getBoundingClientRect();
                    const relX = Math.min(rect.width, Math.max(0, e.clientX - rect.left));
                    const frac = rect.width > 0 ? (relX / rect.width) : 0.5;
                    const centerIdx = Math.round(vMin + frac * Math.max(0, (vMax - vMin)));

                    const delta = e.deltaY || e.wheelDelta || 0;

                    if (e.ctrlKey || e.metaKey) {
                        // ZOOM
                        e.preventDefault();
                        const currentWindow = Math.max(1, vMax - vMin + 1);
                        const scale = delta > 0 ? 1.15 : 1 / 1.15;
                        let newWindow = Math.round(currentWindow * scale);
                        newWindow = clamp(newWindow, 5, Math.max(10, Math.ceil(labels.length * 0.9)));

                        const half = Math.floor(newWindow / 2);
                        let newMin = clamp(centerIdx - half, 0, Math.max(0, labels.length - newWindow));
                        let newMax = newMin + newWindow - 1;
                        applyViewport(newMin, newMax);
                    } else {
                        // PAN
                        const panStep = Math.max(1, Math.round((vMax - vMin + 1) * 0.1));
                        const dir = delta > 0 ? 1 : -1;
                        const newMin = clamp(vMin + dir * panStep, 0, Math.max(0, labels.length - (vMax -
                            vMin + 1)));
                        const newMax = newMin + (vMax - vMin);
                        applyViewport(newMin, newMax);
                    }
                }, {
                    passive: false
                });

                // Double-click to reset window
                elMain.addEventListener('dblclick', () => {
                    const fullMax = Math.max(0, labels.length - 1);
                    const initialMax = Math.min(fullMax, 60);
                    applyViewport(0, initialMax);
                });

                // ---------- Data fetch & ingest ----------
                function fetchData(type, startDate = null, endDate = null) {
                    setActiveTabUI(type);
                    chart.updateOptions({
                        title: {
                            text: 'Loading…'
                        }
                    });
                    const req = {
                        type
                    };
                    if (startDate && endDate) {
                        req.start_date = startDate;
                        req.end_date = endDate;
                    }

                    $.ajax({
                        url,
                        type: 'GET',
                        data: req,
                        success: (payload) => ingest(payload, type),
                        error: () => chart.updateOptions({
                            title: {
                                text: 'Error loading data'
                            }
                        })
                    });
                }

                function ingest(payload, chartType) {
                    // keep insertion order, de-dupe keys
                    const seen = new Set();
                    rawLabels = [];
                    values = [];
                    Object.keys(payload).forEach(k => {
                        if (!seen.has(k)) {
                            seen.add(k);
                            rawLabels.push(k);
                            values.push(parseInt(payload[k]) || 0);
                        }
                    });

                    // build display labels
                    displayLabels = rawLabels.map(k => {
                        if (chartType === 'daily') {
                            // API gives YYYY-MM-DD → show DD-MMM-YY (e.g., 01-Oct-25)
                            return moment(k, 'YYYY-MM-DD', true).isValid() ?
                                moment(k, 'YYYY-MM-DD').format('DD, MMM YY') :
                                k; // fallback if not a date string
                        }
                        return k; // weekly/monthly/yearly already humanized by backend
                    });

                    chart.updateOptions({
                        title: {
                            text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}`
                        }
                    });

                    // rebuild navigator + main
                    labels = rawLabels.slice(); // keep indices aligned for viewport math
                    renderNav(); // sets vMin/vMax and paints both charts
                }

                // ---------- Tabs ----------
                document.getElementById(ids.tabs.daily).addEventListener('click', () => {
                    currentType = 'daily';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.weekly).addEventListener('click', () => {
                    currentType = 'weekly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.monthly).addEventListener('click', () => {
                    currentType = 'monthly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.yearly).addEventListener('click', () => {
                    currentType = 'yearly';
                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                // ---------- Date picker ----------
                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                }, function(start, end) {
                    const months = end.diff(start, 'months', true);
                    if (months < 1) {
                        this.setStartDate(moment(start));
                        this.setEndDate(moment(start).add(1, 'months'));
                    }
                });
                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                });

                $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {

                    currentStartDate = picker.startDate.format('YYYY-MM-DD');
                    currentEndDate = picker.endDate.format('YYYY-MM-DD');

                    const target = this.dataset.target;
                    if (target) {
                        const span = document.querySelector(target);
                        span.textContent =
                            picker.startDate.format('DD/MM/YYYY') +
                            ' to ' +
                            picker.endDate.format('DD/MM/YYYY');

                        span.style.display = 'inline';
                    }

                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                $('#' + ids.picker).on('cancel.daterangepicker', function() {
                    const target = this.dataset.target;
                    if (target) {
                        const span = document.querySelector(target);
                        span.textContent = '';
                        span.style.display = 'none';
                    }
                });



                // ---------- First load with dummy data ----------
                setActiveTabUI('daily');
                const dummyData = {
                    '2025-09-08': 75,
                    '2025-09-09': 82,
                    '2025-09-10': 90,
                    '2025-09-11': 110,
                    '2025-09-12': 95,
                    '2025-09-13': 120,
                    '2025-09-14': 130,
                    '2025-09-15': 105,
                    '2025-09-16': 115,
                    '2025-09-17': 140,
                    '2025-09-18': 125,
                    '2025-09-19': 150,
                    '2025-09-20': 135,
                    '2025-09-21': 160,
                    '2025-09-22': 145,
                    '2025-09-23': 170,
                    '2025-09-24': 155,
                    '2025-09-25': 180,
                    '2025-09-26': 165,
                    '2025-09-27': 190,
                    '2025-09-28': 175,
                    '2025-09-29': 200,
                    '2025-09-30': 185,
                    '2025-10-01': 195,
                    '2025-10-02': 180,
                    '2025-10-03': 170,
                    '2025-10-04': 160,
                    '2025-10-05': 150,
                    '2025-10-06': 140,
                    '2025-10-07': 130
                };
                ingest(dummyData, 'daily');

                // expose if needed
                return {
                    refresh: () => fetchData(currentType, currentStartDate, currentEndDate)
                };
            }

            // ===== Website Visitors =====
            makeBrushBarChart({
                ids: {
                    main: 'website_visitor_chart',
                    nav: 'website_nav',
                    scroll: 'website_scroll',
                    picker: 'website_picker',
                    tabs: {
                        daily: 'website_daily-tab',
                        weekly: 'website_weekly-tab',
                        monthly: 'website_monthly-tab',
                        yearly: 'website_yearly-tab',
                    }
                },
                url: '{{ route('websiteVisits.data') }}', // Placeholder URL
                seriesName: 'Website Visitors',
                titleBase: 'Website Visitors - Demo'
            });
        });
    </script>
@endsection
