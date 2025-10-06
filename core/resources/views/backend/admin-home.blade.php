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
        background: #41695a;           /* your green */
        border: 2px solid #2f4f45;      /* subtle ring */
        cursor: pointer;
        margin-top: -5px;               /* vertically center on 6px track */
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
        outline: 2px solid rgba(65,105,90,.35);
        outline-offset: 2px;
        }

        #new_vendor_signup_nav, #new_customer_signup_nav {
            display: none;
        }
        #top_vendor_nav, #top_products_nav { display: none; }

        /* tilt values drawn on top of bars */
        /* Make all bar values vertical */
        #new_customer_signup_chart .apexcharts-datalabel,
        #new_vendor_signup_chart .apexcharts-datalabel,
        #top_vendor_chart .apexcharts-datalabel,
        #top_vendors_two_chart .apexcharts-datalabel {
            transform: rotate(-90deg) !important;
            transform-origin: center center !important;
            transform-box: fill-box !important;
        }

    </style>
@endsection

@section('content')
    <div class="row">
        {{-- Webstie Stats --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <h3 class="my-3">Website User Statistics</h3>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="webstie_daily-tab" data-bs-toggle="tab"
                                                type="button">
                                                Daily
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="webstie_weekly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="webstie_monthly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="webstie_yearly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Yearly
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="webstie_chart"></div>
                                </div>
                                <div class="col-md-6">
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
                                        <button class="nav-link active" id="new_vendor_signup_daily-tab" type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="new_vendor_signup_weekly-tab" type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="new_vendor_signup_monthly-tab" type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="new_vendor_signup_yearly-tab" type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                        <input type="text" class="form-control dateRangeWebstie" id="vendor_sign_up_picker" placeholder="Custom Date Range">
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="new_vendor_signup_chart"></div>
                                        <!-- scroll bar -->
                                        <input id="new_vendor_signup_scroll" class="form-range mt-2 w-100" type="range" min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="new_vendor_signup_nav" style="height:110px;"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
                                </div>

                                {{-- New customer signup chart --}}
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="new_customer_signup_daily-tab" type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="new_customer_signup_weekly-tab" type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="new_customer_signup_monthly-tab" type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="new_customer_signup_yearly-tab" type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                        <input type="text" class="form-control dateWebstieRange" id="customer_sign_up_picker">
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="new_customer_signup_chart"></div>
                                        <!-- scroll bar -->
                                        <input id="new_customer_signup_scroll" class="form-range mt-2 w-100" type="range" min="0" max="0" value="0" step="1" />
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
        {{-- Analytics --}}
        {{-- <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <h3 class="my-3">Analytics</h3>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="analytics_daily-tab" data-bs-toggle="tab"
                                                type="button">
                                                Daily
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="analytics_weekly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="analytics_monthly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="analytics_yearly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Yearly
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="analytics_chart"></div>
                                </div>
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="analytics_two_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Daily
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="analytics_two_weekly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="analytics_two_monthly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="analytics_two_yearly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Yearly
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="analytics_two_chart"></div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="analytics_three_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Daily
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="analytics_three_weekly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="analytics_three_monthly-tab"
                                                data-bs-toggle="tab" type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="analytics_three_yearly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Yearly
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="analytics_three_chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- Campaign Stats --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <h3 class="my-3">Campaign Statistics</h3>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <div class="text-center">
                                        <h5>Active Campaigns</h5>
                                        <h2>
                                            {{ $campaign->count() }}
                                        </h2>
                                        <span class="badge bg-light text-dark">Live Now</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="campaign_one_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Daily
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="campaign_one_weekly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="campaign_one_monthly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="campaign_one_yearly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Yearly
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control dateCampaignRange"
                                                id="vendor_sign_up">
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="campaign_one_chart"></div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="campaign_two_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Daily
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="campaign_two_weekly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="campaign_two_monthly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="campaign_two_yearly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Yearly
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="campaign_two_chart"></div>
                                </div>
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="campaign_three_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Daily
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="campaign_three_weekly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="campaign_three_monthly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="campaign_three_yearly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Yearly
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="campaign_three_chart"></div>
                                </div> --}}
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
                                            Vendors:
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $vendor->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            New Vendor Requests:
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $vendorRequest->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Products:
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $products->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Pending Products:
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $productsPending->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Vendor Withdrawal Requests:
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $vendorWithdrawRequests->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            High Priority Support Tickets:
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $supportTickets->count() }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Refund Requests:
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
                                        <button class="nav-link active" id="top_vendors_daily-tab" type="button">Daily</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="top_vendors_weekly-tab" type="button">Weekly</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="top_vendors_monthly-tab" type="button">Monthly</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="top_vendors_yearly-tab" type="button">Yearly</button>
                                    </li>
                                    <li class="nav-item">
                                        <input type="text" class="form-control dateRangeTopVendor" id="top_vendors_picker" />
                                    </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                    <div id="top_vendor_chart"></div>
                                    <!-- scrollbar -->
                                    <input id="top_vendor_scroll" class="form-range mt-2 w-100" type="range" min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="top_vendor_nav" style="height:110px;"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
                                </div>

                                <!-- Top Selling Products -->
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="top_vendors_two_daily-tab" type="button">Daily</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="top_vendors_two_weekly-tab" type="button">Weekly</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="top_vendors_two_monthly-tab" type="button">Monthly</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="top_vendors_two_yearly-tab" type="button">Yearly</button>
                                    </li>
                                    <li class="nav-item">
                                        <input type="text" class="form-control dateTopVendorsRange" id="top_products_picker" />
                                    </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                    <div id="top_vendors_two_chart"></div>
                                    <!-- scrollbar -->
                                    <input id="top_products_scroll" class="form-range mt-2 w-100" type="range" min="0" max="0" value="0" step="1" />
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
                    <h4 class="my-3">Vendor Managements</h4>
                    <div class="p-3 bg-light rounded-3">
                        <div class="row g-3 mb-2">
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Account Verification Pending</span>
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
                        <div class="row g-3 mb-2">
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Product Verification Pending</span>
                                    <span class="fw-bold text-warning">53</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Approved</span>
                                    <span class="fw-bold text-success">546</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Rejected</span>
                                    <span class="fw-bold text-danger">3</span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Withdrawal Requests Pending</span>
                                    <span class="fw-bold text-warning">132</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Approved</span>
                                    <span class="fw-bold text-success">65</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Rejected</span>
                                    <span class="fw-bold text-danger">7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h4 class="mb-4">Vendor Support</h4>
                    <div class="p-3 bg-light rounded-3">
                        <div class="row g-3 mb-2">
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Tickets Open</span>
                                    <span class="fw-bold text-warning">
                                        {{ $vendorTicketData['vendorTotalOpenTicket']->count() }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>High Priority Tickets</span>
                                    <span class="fw-bold text-success">
                                        {{ $vendorTicketData['vendorTotalPriorityTicket']->count() }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Close Tickets</span>
                                    <span class="fw-bold text-danger">
                                        {{ $vendorTicketData['vendorTotalCloseTicket']->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h4 class="mb-4">Customer Support</h4>
                    <div class="p-3 bg-light rounded-3">
                        <div class="row g-3 mb-2">
                            <div class="col-md-3">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Tickets Open</span>
                                    <span class="fw-bold text-warning">
                                        {{ $customerTicketData['totalOpenTicket']->count() }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>High Priority Tickets</span>
                                    <span class="fw-bold text-success">
                                        {{ $customerTicketData['totalCloseTicket']->count() }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Close Tickets</span>
                                    <span class="fw-bold text-danger">
                                        {{ $vendorTicketData['vendorTotalCloseTicket']->count() }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Close Tickets</span>
                                    <span class="fw-bold text-danger">
                                        {{ $customerTicketData['refundRequest']->count() }}
                                    </span>
                                </div>
                            </div>
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
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="financial_summary_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Daily
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_weekly-tab"
                                                data-bs-toggle="tab" type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_monthly-tab"
                                                data-bs-toggle="tab" type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_yearly-tab"
                                                data-bs-toggle="tab" type="button">
                                                Yearly
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control dateRangeFinancialSummary"
                                                id="vendor_sign_up">
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="financial_summary_chart"></div>
                                </div>
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="financial_summary_two_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Daily
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_two_weekly-tab"
                                                data-bs-toggle="tab" type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_two_monthly-tab"
                                                data-bs-toggle="tab" type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_two_yearly-tab"
                                                data-bs-toggle="tab" type="button">
                                                Yearly
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control dateFinancialSummaryRange"
                                                id="vendor_sign_up">
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="financial_summary_two_chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="dashboard__card">
                <div class="dashboard__card__body">
                    <h4 class="mb-4">Performance Monitoring</h4>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card shadow-sm rounded-3 text-center p-3">
                                <div class="row g-3 mt-2">
                                    <div class="col-md-12">
                                        <div class="p-2 bg-light rounded">
                                            <small>Page Load Time</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-2 bg-light rounded">
                                            <small>Home Page</small>
                                            <h5 class="mt-1 text-success">
                                                {{ round((microtime(true) - LARAVEL_START) * 1000, 2) . 's' }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-2 bg-light rounded">
                                            <small>Product Page</small>
                                            <h5 class="mt-1 text-success">2s</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm rounded-3 text-center p-3">
                                <h6>API Latency</h6>
                                <div class="p-2 bg-light rounded mt-2">
                                    <h5 class="text-success">AVG 200ms</h5>
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
            </div>
            <div class="row g-3">
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
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    // ---------- Shared helpers ----------
    const clamp = (n, lo, hi) => Math.min(hi, Math.max(lo, n));
    
    function makeBrushBarChart({ ids, url, seriesName, titleBase }) {
        let currentType = 'daily';
        let currentStartDate = null;
        let currentEndDate = null;

        // full dataset
        let rawLabels = [];
        let displayLabels = [];

        let labels = [];      // ["2025-09-01", ...] | ["W36, Sep-2025", ...] | ["Jan 2025", ...] | ["2024","2025",...]
        let values = [];      // [1,2,0,...]
        let points = [];      // [{x:i,y:v}]

        // current viewport (inclusive indices into full arrays)
        let vMin = 0, vMax = 0;

        // DOM
        const elMain   = document.querySelector('#' + ids.main);
        const elNav    = document.querySelector('#' + ids.nav);
        const elScroll = document.querySelector('#' + ids.scroll);

        // ---------- Tabs UI ----------
        const tabIds = [ids.tabs.daily, ids.tabs.weekly, ids.tabs.monthly, ids.tabs.yearly];
        function setActiveTabUI(type) {
        const map = { daily: ids.tabs.daily, weekly: ids.tabs.weekly, monthly: ids.tabs.monthly, yearly: ids.tabs.yearly };
        const activeId = map[type];
        tabIds.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.classList.toggle('active', id === activeId);
        });
        }

        // ---------- Main (category) chart ----------
        const mainOpts = {
        series: [{ name: seriesName, data: [] }],
        chart: {
            id: ids.main + '_chart',
            type: 'bar',
            height: 350,
            background: '#ffffff',
            toolbar: { show: false },                 // hide apex toolbar
            zoom: { enabled: false },                 // we'll handle zoom/pan ourselves
            animations: { easing: 'easeinout', speed: 180 }
        },
        title: { text: titleBase, align: 'left' },
        colors: ['#e0bb20'],
        grid: { padding: { left: 2, right: 2 } },
        plotOptions: { bar: { columnWidth: '18%', borderRadius: 6, distributed: false } },
        dataLabels: {
            enabled: true,
            background: { enabled: false },
            style: {
                colors: ['#000'],
                fontWeight: 400,
                fontSize: '10px',
                // rotate: -45   // 👈 tilt the numbers
            },
            formatter: (v) => v
        },
        xaxis: {
            type: 'category',                         // ← category axis (exact 1:1 with visible bars)
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
        yaxis: { title: { text: 'Number of Sign-Ups' } },
        tooltip: {
            x: { formatter: (val, { dataPointIndex }) => (visibleLabels[dataPointIndex] ?? '') },
            y: { formatter: (val) => `${val} sign-ups` }
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

            const navData = values.map((y, i) => ({ x: i, y }));

            // default window = up to 60 bars
            vMin = 0;
            vMax = Math.max(0, Math.min(values.length - 1, 60));

            nav = new ApexCharts(elNav, {
                chart: {
                id: ids.nav + '_chart',
                height: 110,
                type: 'area',
                toolbar: { show: false },
                animations: { enabled: false },
                // We manually handle selection; brush is unnecessary with category axis in main.
                selection: { enabled: true, xaxis: { min: vMin, max: vMax } },
                events: {
                    selection: (ctx, { xaxis }) => {
                    const minI = clamp(Math.round(xaxis.min), 0, labels.length - 1);
                    const maxI = clamp(Math.round(xaxis.max), 0, labels.length - 1);
                    applyViewport(minI, maxI, { from: 'nav' });
                    }
                }
                },
                colors: ['#e0bb20'],
                stroke: { width: 1, colors: ['#e0bb20'] },
                series: [{ name: 'Range', data: navData }],
                xaxis: { type: 'numeric', labels: { show: false }, tooltip: { enabled: false } },
                yaxis: { show: false },
                dataLabels: { enabled: false },
                fill: { opacity: 0.2 }
            });

            nav.render();
            applyViewport(vMin, vMax);
            updateScrollbar();
        }

        // ---------- Viewport sync (slice to visible window) ----------
        function applyViewport(minI, maxI, { from = 'code' } = {}) {
            vMin = Math.max(0, Math.min(minI, maxI));
            vMax = Math.max(0, Math.max(minI, maxI));

            // slice visible window for main chart
            const windowVals = values.slice(vMin, vMax + 1);
            visibleLabels    = displayLabels.slice(vMin, vMax + 1);

            chart.updateOptions({
                series: [{ name: seriesName, data: windowVals }],
                xaxis: { categories: visibleLabels }
            }, false, false);

            // keep navigator’s selection synced
            if (nav && from !== 'nav') {
                nav.updateOptions({
                chart: { selection: { enabled: true, xaxis: { min: vMin, max: vMax } } }
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
            applyViewport(left, left + windowSize - 1, { from: 'scroll' });
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
                const newMin = clamp(vMin + dir * panStep, 0, Math.max(0, labels.length - (vMax - vMin + 1)));
                const newMax = newMin + (vMax - vMin);
                applyViewport(newMin, newMax);
            }
            }, { passive: false });

            // Double-click to reset window
            elMain.addEventListener('dblclick', () => {
            const fullMax = Math.max(0, labels.length - 1);
            const initialMax = Math.min(fullMax, 60);
            applyViewport(0, initialMax);
        });

        // ---------- Data fetch & ingest ----------
        function fetchData(type, startDate = null, endDate = null) {
            setActiveTabUI(type);
            chart.updateOptions({ title: { text: 'Loading…' } });
            const req = { type };
            if (startDate && endDate) { req.start_date = startDate; req.end_date = endDate; }

            $.ajax({
                url,
                type: 'GET',
                data: req,
                success: (payload) => ingest(payload, type),
                error: () => chart.updateOptions({ title: { text: 'Error loading data' } })
            });
        }

        function ingest(payload, chartType) {
            // keep insertion order, de-dupe keys
            const seen = new Set();
            rawLabels = [];
            values = [];
            Object.keys(payload).forEach(k => {
                if (!seen.has(k)) { seen.add(k); rawLabels.push(k); values.push(parseInt(payload[k]) || 0); }
            });

            // build display labels
            displayLabels = rawLabels.map(k => {
                if (chartType === 'daily') {
                // API gives YYYY-MM-DD → show DD-MMM-YYYY (e.g., 01-Oct-2025)
                return moment(k, 'YYYY-MM-DD', true).isValid()
                    ? moment(k, 'YYYY-MM-DD').format('DD, MMM YY')
                    : k; // fallback if not a date string
                }
                return k; // weekly/monthly/yearly already humanized by backend
            });

            chart.updateOptions({
                title: { text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}` }
            });

            // rebuild navigator + main
            labels = rawLabels.slice(); // keep indices aligned for viewport math
            renderNav(); // sets vMin/vMax and paints both charts
        }


        // ---------- Tabs ----------
        document.getElementById(ids.tabs.daily).addEventListener('click',  () => { currentType = 'daily';  fetchData(currentType, currentStartDate, currentEndDate); });
        document.getElementById(ids.tabs.weekly).addEventListener('click', () => { currentType = 'weekly'; fetchData(currentType, currentStartDate, currentEndDate); });
        document.getElementById(ids.tabs.monthly).addEventListener('click',()=> { currentType = 'monthly';fetchData(currentType, currentStartDate, currentEndDate); });
        document.getElementById(ids.tabs.yearly).addEventListener('click', () => { currentType = 'yearly';  fetchData(currentType, currentStartDate, currentEndDate); });

        // ---------- Date picker ----------
        $('#' + ids.picker).daterangepicker({
        opens: 'left',
        autoUpdateInput: true,
        minDate: moment('2024-01-01'),
        maxDate: moment().endOf('year'),
        }, function(start, end) {
        const months = end.diff(start, 'months', true);
        if (months < 1) { this.setStartDate(moment(start)); this.setEndDate(moment(start).add(1, 'months')); }
        });

        $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {
        currentStartDate = picker.startDate.format('YYYY-MM-DD');
        currentEndDate   = picker.endDate.format('YYYY-MM-DD');
        fetchData(currentType, currentStartDate, currentEndDate);
        });

        // ---------- First load ----------
        setActiveTabUI('daily');
        fetchData(currentType);

        // expose if needed
        return { refresh: () => fetchData(currentType, currentStartDate, currentEndDate) };
    }

    // ===== Vendors =====
    makeBrushBarChart({
        ids: {
        main: 'new_vendor_signup_chart',
        nav: 'new_vendor_signup_nav',
        scroll: 'new_vendor_signup_scroll',
        picker: 'vendor_sign_up_picker',
        tabs: {
            daily:   'new_vendor_signup_daily-tab',
            weekly:  'new_vendor_signup_weekly-tab',
            monthly: 'new_vendor_signup_monthly-tab',
            yearly:  'new_vendor_signup_yearly-tab',
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
            daily:   'new_customer_signup_daily-tab',
            weekly:  'new_customer_signup_weekly-tab',
            monthly: 'new_customer_signup_monthly-tab',
            yearly:  'new_customer_signup_yearly-tab',
        }
        },
        url: '{{ route('customers.data') }}',
        seriesName: 'New Customers',
        titleBase: 'New Customer Sign Up'
    });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ---------- Shared helpers ----------
        const clamp = (n, lo, hi) => Math.min(hi, Math.max(lo, n));
        
        function makeBrushBarChart({ ids, url, seriesName, titleBase, isTopChart = false, unit = '' }) {
            let currentType = 'daily';
            let currentStartDate = null;
            let currentEndDate = null;

            // full dataset
            let rawLabels = [];
            let displayLabels = [];
            let topNames = [];

            let labels = [];      // ["2025-09-01", ...] | ["W36, Sep-2025", ...] | ["Jan 2025", ...] | ["2024","2025",...]
            let values = [];      // [1,2,0,...]
            let points = [];      // [{x:i,y:v}]

            // current viewport (inclusive indices into full arrays)
            let vMin = 0, vMax = 0;

            // DOM
            const elMain   = document.querySelector('#' + ids.main);
            const elNav    = document.querySelector('#' + ids.nav);
            const elScroll = document.querySelector('#' + ids.scroll);

            // ---------- Tabs UI ----------
            const tabIds = [ids.tabs.daily, ids.tabs.weekly, ids.tabs.monthly, ids.tabs.yearly];
            function setActiveTabUI(type) {
            const map = { daily: ids.tabs.daily, weekly: ids.tabs.weekly, monthly: ids.tabs.monthly, yearly: ids.tabs.yearly };
            const activeId = map[type];
            tabIds.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.classList.toggle('active', id === activeId);
            });
            }

            // ---------- Main (category) chart ----------
            const mainOpts = {
            series: [{ name: seriesName, data: [] }],
            chart: {
                id: ids.main + '_chart',
                type: 'bar',
                height: 350,
                background: '#ffffff',
                toolbar: { show: false },                 // hide apex toolbar
                zoom: { enabled: false },                 // we'll handle zoom/pan ourselves
                animations: { easing: 'easeinout', speed: 180 }
            },
            title: { text: titleBase, align: 'left' },
            colors: ['#e0bb20'],
            grid: { padding: { left: 2, right: 2, bottom: 22 } },   // more space at the bottom
            plotOptions: {
              bar: {
                columnWidth: '18%',
                borderRadius: 6,
                distributed: false,
                dataLabels: { position: 'bottom' }   // ← anchor labels at bar base (y=0)
              }
            },
            dataLabels: {
                enabled: true,
                offsetY: -2,                         // fallback; position is controlled above
                background: { enabled: false },
                style: {
                    colors: ['#000'],
                    fontWeight: 600,
                    fontSize: isTopChart ? '10px' : '12px',
                },
                formatter: isTopChart 
                    ? function(v, { dataPointIndex }) { 
                        if (v === 0) return '0';
                        return v >= 1 
                            ? (seriesName === 'Sales' 
                                ? `${topNames[dataPointIndex]}\n${v} ${unit}` 
                                : `${v} ${unit.split(' ')[0].toLowerCase()},\n${v} ${unit.split(' ')[1].toLowerCase()}`)
                            : `${v}`;
                    }
                    : (v) => (v === 0 ? '0' : v)
            },
            xaxis: {
                type: 'category',                         // ← category axis (exact 1:1 with visible bars)
                categories: [],
                tickPlacement: 'on',
                rangePadding: 'none',
                labels: {
                    rotate: -90,
                    rotateAlways: true,
                    trim: false,
                    hideOverlappingLabels: false,
                    offsetY: 6,
                    style: {
                        fontSize: '10px' // Reduce font size to minimize overlap risk
                    }
                }
            },
            yaxis: { title: { text: seriesName }, min: 0 }, // Ensure y-axis starts at 0 to avoid overlap
            tooltip: {
                x: { formatter: (val, { dataPointIndex }) => (visibleLabels[dataPointIndex] ?? '') },
                y: { formatter: isTopChart 
                    ? (val, { dataPointIndex }) => val === 0 ? 'No data' : `${topNames[dataPointIndex] || 'Unknown'}: ${val} ${unit}`
                    : (val) => `${val} ${unit}` 
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

                const navData = values.map((y, i) => ({ x: i, y }));

                // default window = up to 60 bars
                vMin = 0;
                vMax = Math.max(0, Math.min(values.length - 1, 60));

                nav = new ApexCharts(elNav, {
                    chart: {
                    id: ids.nav + '_chart',
                    height: 110,
                    type: 'area',
                    toolbar: { show: false },
                    animations: { enabled: false },
                    // We manually handle selection; brush is unnecessary with category axis in main.
                    selection: { enabled: true, xaxis: { min: vMin, max: vMax } },
                    events: {
                        selection: (ctx, { xaxis }) => {
                        const minI = clamp(Math.round(xaxis.min), 0, labels.length - 1);
                        const maxI = clamp(Math.round(xaxis.max), 0, labels.length - 1);
                        applyViewport(minI, maxI, { from: 'nav' });
                        }
                    }
                    },
                    colors: ['#e0bb20'],
                    stroke: { width: 1, colors: ['#e0bb20'] },
                    series: [{ name: 'Range', data: navData }],
                    xaxis: { type: 'numeric', labels: { show: false }, tooltip: { enabled: false } },
                    yaxis: { show: false },
                    dataLabels: { enabled: false },
                    fill: { opacity: 0.2 }
                });

                nav.render();
                applyViewport(vMin, vMax);
                updateScrollbar();
            }

            // ---------- Viewport sync (slice to visible window) ----------
            function applyViewport(minI, maxI, { from = 'code' } = {}) {
                vMin = Math.max(0, Math.min(minI, maxI));
                vMax = Math.max(0, Math.max(minI, maxI));

                // slice visible window for main chart
                const windowVals = values.slice(vMin, vMax + 1);
                visibleLabels    = displayLabels.slice(vMin, vMax + 1);
                const windowTopNames = topNames.slice(vMin, vMax + 1); // for consistency, though not used here

                chart.updateOptions({
                    series: [{ name: seriesName, data: windowVals }],
                    xaxis: { categories: visibleLabels }
                }, false, false);

                // keep navigator’s selection synced
                if (nav && from !== 'nav') {
                    nav.updateOptions({
                    chart: { selection: { enabled: true, xaxis: { min: vMin, max: vMax } } }
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
                applyViewport(left, left + windowSize - 1, { from: 'scroll' });
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
                    const newMin = clamp(vMin + dir * panStep, 0, Math.max(0, labels.length - (vMax - vMin + 1)));
                    const newMax = newMin + (vMax - vMin);
                    applyViewport(newMin, newMax);
                }
                }, { passive: false });

                // Double-click to reset window
                elMain.addEventListener('dblclick', () => {
                const fullMax = Math.max(0, labels.length - 1);
                const initialMax = Math.min(fullMax, 60);
                applyViewport(0, initialMax);
            });

            // ---------- Data fetch & ingest ----------
            function fetchData(type, startDate = null, endDate = null) {
                setActiveTabUI(type);
                chart.updateOptions({ title: { text: 'Loading…' } });
                const req = { type };
                if (startDate && endDate) { req.start_date = startDate; req.end_date = endDate; }

                $.ajax({
                    url,
                    type: 'GET',
                    data: req,
                    success: (payload) => ingest(payload, type),
                    error: () => chart.updateOptions({ title: { text: 'Error loading data' } })
                });
            }

            function ingest(payload, chartType) {
                // keep insertion order, de-dupe keys
                const seen = new Set();
                rawLabels = [];
                values = [];
                topNames = [];
                Object.keys(payload).forEach(k => {
                    if (!seen.has(k)) {
                        seen.add(k);
                        rawLabels.push(k);
                        const val = payload[k];
                        if (isTopChart && typeof val === 'object' && val !== null && 'name' in val && 'value' in val) {
                            values.push(parseInt(val.value) || 0);
                            topNames.push(val.name || 'None');
                        } else {
                            values.push(parseInt(val) || 0);
                            topNames.push(''); // placeholder
                        }
                    }
                });

                // build display labels
                displayLabels = rawLabels.map(k => {
                    if (chartType === 'daily') {
                    // API gives YYYY-MM-DD → show DD-MMM-YYYY (e.g., 01-Oct-2025)
                    return moment(k, 'YYYY-MM-DD', true).isValid()
                        ? moment(k, 'YYYY-MM-DD').format('DD, MMM YY')
                        : k; // fallback if not a date string
                    }
                    return k; // weekly/monthly/yearly already humanized by backend
                });

                chart.updateOptions({
                    title: { text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}` }
                });

                // rebuild navigator + main
                labels = rawLabels.slice(); // keep indices aligned for viewport math
                renderNav(); // sets vMin/vMax and paints both charts
            }


            // ---------- Tabs ----------
            document.getElementById(ids.tabs.daily).addEventListener('click',  () => { currentType = 'daily';  fetchData(currentType, currentStartDate, currentEndDate); });
            document.getElementById(ids.tabs.weekly).addEventListener('click', () => { currentType = 'weekly'; fetchData(currentType, currentStartDate, currentEndDate); });
            document.getElementById(ids.tabs.monthly).addEventListener('click',()=> { currentType = 'monthly';fetchData(currentType, currentStartDate, currentEndDate); });
            document.getElementById(ids.tabs.yearly).addEventListener('click', () => { currentType = 'yearly';  fetchData(currentType, currentStartDate, currentEndDate); });

            // ---------- Date picker ----------
            $('#' + ids.picker).daterangepicker({
            opens: 'left',
            autoUpdateInput: true,
            minDate: moment('2024-01-01'),
            maxDate: moment().endOf('year'),
            }, function(start, end) {
            const months = end.diff(start, 'months', true);
            if (months < 1) { this.setStartDate(moment(start)); this.setEndDate(moment(start).add(1, 'months')); }
            });

            $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {
            currentStartDate = picker.startDate.format('YYYY-MM-DD');
            currentEndDate   = picker.endDate.format('YYYY-MM-DD');
            fetchData(currentType, currentStartDate, currentEndDate);
            });

            // ---------- First load ----------
            setActiveTabUI('daily');
            fetchData(currentType);

            // expose if needed
            return { refresh: () => fetchData(currentType, currentStartDate, currentEndDate) };
        }

        // ===== Top Selling Vendors =====
        makeBrushBarChart({
            ids: {
            main:   'top_vendor_chart',
            nav:    'top_vendor_nav',
            scroll: 'top_vendor_scroll',
            picker: 'top_vendors_picker',
            tabs: {
                daily:   'top_vendors_daily-tab',
                weekly:  'top_vendors_weekly-tab',
                monthly: 'top_vendors_monthly-tab',
                yearly:  'top_vendors_yearly-tab',
            }
            },
            url: '{{ route('top-vendors.data') }}',
            seriesName: 'Sales',
            titleBase: 'Top Selling Vendors',
            isTopChart: true,
            unit: 'sales'
        });

        // ===== Top Selling Products =====
        makeBrushBarChart({
            ids: {
            main:   'top_vendors_two_chart',
            nav:    'top_products_nav',
            scroll: 'top_products_scroll',
            picker: 'top_products_picker',
            tabs: {
                daily:   'top_vendors_two_daily-tab',
                weekly:  'top_vendors_two_weekly-tab',
                monthly: 'top_vendors_two_monthly-tab',
                yearly:  'top_vendors_two_yearly-tab',
            }
            },
            url: '{{ route('top-products.data') }}',
            seriesName: 'Units Sold',
            titleBase: 'Top Selling Products',
            isTopChart: true,
            unit: 'items, sold'
        });
    });
</script>




    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Variables to store current state
            let currentType = 'daily';
            let currentStartDate = null;
            let currentEndDate = null;

            // Chart configuration
            let financial_summary_options = {
                series: [{
                    name: 'Net Profit',
                    data: []
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    background: '#ffffff',
                    toolbar: {
                        show: true,
                        tools: {
                            download: false,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan: true,
                            reset: true
                        }
                    },
                    zoom: {
                        enabled: true,
                        type: 'x',
                        autoScaleYaxis: true
                    }
                },
                title: {
                    text: 'Order Revenue',
                    align: 'left'
                },
                colors: ['#41695a'],
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return "$" + val;
                    },
                    style: {
                        colors: ['#ffffff'],
                        fontSize: '12px'
                    },
                    offsetY: -20
                },
                plotOptions: {
                    bar: {
                        columnWidth: '25%',
                        borderRadius: 6
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        formatter: function(value) {
                            return value && value.length > 30 ?
                                value.substring(0, 20) + '...' :
                                value || '';
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: '$ (USD)'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "$ " + val + " USD"
                        }
                    },
                    style: {
                        colors: ['#ffffff']
                    }
                }
            };

            // Initialize chart
            let chart = new ApexCharts(
                document.querySelector("#financial_summary_chart"),
                financial_summary_options
            );
            chart.render();

            // Function to fetch data via AJAX
            function fetchIncomeData(type, startDate = null, endDate = null) {
                // Show loading state
                chart.updateOptions({
                    title: {
                        text: 'Loading data...'
                    }
                });

                // Prepare request data
                const requestData = {
                    type: type,
                };

                // Add date range if provided
                if (startDate && endDate) {
                    requestData.start_date = startDate;
                    requestData.end_date = endDate;
                }

                $.ajax({
                    url: '{{ route('income.data') }}',
                    type: 'GET',
                    data: requestData,
                    success: function(data) {
                        updateChart(data, type);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        chart.updateOptions({
                            title: {
                                text: 'Error loading data'
                            }
                        });
                    }
                });
            }

            // Function to update chart with data
            function updateChart(data, chartType) {
                const labels = Object.keys(data);
                const values = Object.values(data).map(val => parseFloat(val) || 0);

                chart.updateOptions({
                    series: [{
                        name: 'Net Profit',
                        data: values
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: true,
                            tools: {
                                download: false,
                                zoom: true,
                                zoomin: true,
                                zoomout: true,
                                pan: true,
                                reset: true
                            }
                        },
                        zoom: {
                            enabled: true,
                            type: 'x',
                            autoScaleYaxis: true
                        }
                    },
                    xaxis: {
                        categories: labels
                    },
                    title: {
                        text: 'Order Revenue - ' + chartType.charAt(0).toUpperCase() + chartType.slice(1)
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '18%',
                            borderRadius: 6
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            return "$" + val;
                        },
                        style: {
                            colors: ['#ffffff'],
                            fontSize: '12px'
                        },
                        offsetY: -20
                    },
                    tooltip: {
                        style: {
                            colors: ['#ffffff']
                        }
                    }
                });
            }

            // Set up tab click handlers
            document.querySelector('#financial_summary_daily-tab').addEventListener('click', function() {
                currentType = 'daily';
                fetchIncomeData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#financial_summary_weekly-tab').addEventListener('click', function() {
                currentType = 'weekly';
                fetchIncomeData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#financial_summary_monthly-tab').addEventListener('click', function() {
                currentType = 'monthly';
                fetchIncomeData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#financial_summary_yearly-tab').addEventListener('click', function() {
                currentType = 'yearly';
                fetchIncomeData(currentType, currentStartDate, currentEndDate);
            });

            // Initialize date range picker
            $('.dateRangeFinancialSummary').daterangepicker({
                opens: 'left',
                autoUpdateInput: true,
                minDate: moment('2024-01-01'),
                maxDate: moment().endOf('year'),
            }, function(start, end) {
                var months = end.diff(start, 'months', true);
                if (months < 1) {
                    this.setStartDate(moment(start));
                    this.setEndDate(moment(start).add(1, 'months'));
                }
            });

            $('.dateRangeFinancialSummary').on('apply.daterangepicker', function(ev, picker) {
                currentStartDate = picker.startDate.format('YYYY-MM-DD');
                currentEndDate = picker.endDate.format('YYYY-MM-DD');
                fetchIncomeData(currentType, currentStartDate, currentEndDate);
            });

            // Load initial data
            fetchIncomeData(currentType);
        });
    </script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Variables to store current state
            let currentType = 'daily';
            let currentStartDate = null;
            let currentEndDate = null;

            // Chart configuration
            let top_vendor_options = {
                series: [{
                    name: 'Net Profit',
                    data: []
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    background: '#ffffff',
                    toolbar: {
                        show: true,
                        tools: {
                            download: false
                        }
                    }
                },
                title: {
                    text: 'Top Selling Vendors',
                    align: 'left'
                },
                colors: ['#41695a'],
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#ffffff']
                    },
                    position: 'top'
                },
                plotOptions: {
                    bar: {
                        columnWidth: '18%',
                        borderRadius: 6
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        formatter: function(value) {
                            return value && value.length > 15 ?
                                value.substring(0, 20) + '...' :
                                value || '';
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: '$ (USD)'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "$ " + val + " USD"
                        }
                    }
                }
            };

            // Initialize chart
            let top_vendor_chart = new ApexCharts(
                document.querySelector("#top_vendor_chart"),
                top_vendor_options
            );
            top_vendor_chart.render();

            // Function to fetch data via AJAX
            function fetchTopVendorsData(type, startDate = null, endDate = null) {
                // Show loading state
                top_vendor_chart.updateOptions({
                    title: {
                        text: 'Loading data...'
                    }
                });

                // Prepare request data
                const requestData = {
                    type: type,
                };

                // Add date range if provided
                if (startDate && endDate) {
                    requestData.start_date = startDate;
                    requestData.end_date = endDate;
                }

                $.ajax({
                    url: '{{ route('top-vendors.data') }}',
                    type: 'GET',
                    data: requestData,
                    success: function(data) {
                        updateChart(data, type);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        top_vendor_chart.updateOptions({
                            title: {
                                text: 'Error loading data'
                            }
                        });
                    }
                });
            }

            // Function to update chart with data
            function updateChart(data, chartType) {
                const labels = Object.keys(data);
                const values = Object.values(data).map(val => parseFloat(val) || 0);

                top_vendor_chart.updateOptions({
                    series: [{
                        name: 'Net Profit',
                        data: values
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: true,
                            tools: {
                                download: false
                            }
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '18%',
                            borderRadius: 6
                        }
                    },
                    xaxis: {
                        categories: labels
                    },
                    title: {
                        text: 'Top Selling Vendors - ' + chartType.charAt(0).toUpperCase() + chartType
                            .slice(1)
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            colors: ['#ffffff']
                        }
                    }
                });
            }

            // Set up tab click handlers
            document.querySelector('#top_vendors_daily-tab').addEventListener('click', function() {
                currentType = 'daily';
                fetchTopVendorsData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#top_vendors_weekly-tab').addEventListener('click', function() {
                currentType = 'weekly';
                fetchTopVendorsData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#top_vendors_monthly-tab').addEventListener('click', function() {
                currentType = 'monthly';
                fetchTopVendorsData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#top_vendors_yearly-tab').addEventListener('click', function() {
                currentType = 'yearly';
                fetchTopVendorsData(currentType, currentStartDate, currentEndDate);
            });

            // Initialize date range picker
            $('.dateRangeTopVendor').daterangepicker({
                opens: 'left',
                autoUpdateInput: true,
                minDate: moment('2024-01-01'),
                maxDate: moment().endOf('year'),
            }, function(start, end) {
                var months = end.diff(start, 'months', true);
                if (months < 1) {
                    this.setStartDate(moment(start));
                    this.setEndDate(moment(start).add(1, 'months'));
                }
            });

            $('.dateRangeTopVendor').on('apply.daterangepicker', function(ev, picker) {
                currentStartDate = picker.startDate.format('YYYY-MM-DD');
                currentEndDate = picker.endDate.format('YYYY-MM-DD');
                fetchTopVendorsData(currentType, currentStartDate, currentEndDate);
            });

            // Load initial data
            fetchTopVendorsData(currentType);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Variables to store current state
            let currentType = 'daily';
            let currentStartDate = null;
            let currentEndDate = null;

            // Chart configuration
            let sp_t_v_t_chartOptions = {
                series: [{
                    name: 'Total Sold',
                    data: []
                }],
                chart: {
                    type: 'bar', // Changed from 'line' to 'bar'
                    height: 350,
                    background: '#ffffff',
                    toolbar: {
                        show: true,
                        tools: {
                            download: false
                        }
                    }
                },
                title: {
                    text: 'Top Selling Products',
                    align: 'left'
                },
                colors: ['#41695a'],
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#ffffff']
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '18%',
                        borderRadius: 6
                    }
                },
                stroke: {
                    show: true,
                    width: 2
                },
                xaxis: {
                    categories: [],
                    labels: {
                        formatter: function(value) {
                            return value && value.length > 15 ?
                                value.substring(0, 20) + '...' :
                                value || '';
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Quantity Sold'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + ' sold';
                        }
                    }
                }
            };

            // Initialize chart
            let sp_top_vendors_chart = new ApexCharts(
                document.querySelector("#top_vendors_two_chart"),
                sp_t_v_t_chartOptions
            );
            sp_top_vendors_chart.render();

            // Function to fetch data via AJAX
            function fetchTopProductsData(type, startDate = null, endDate = null) {
                // Show loading state
                sp_top_vendors_chart.updateOptions({
                    title: {
                        text: 'Loading data...'
                    }
                });

                // Prepare request data
                const requestData = {
                    type: type,
                };

                // Add date range if provided
                if (startDate && endDate) {
                    requestData.start_date = startDate;
                    requestData.end_date = endDate;
                }

                $.ajax({
                    url: '{{ route('top-products.data') }}',
                    type: 'GET',
                    data: requestData,
                    success: function(data) {
                        updateChart(data, type);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        sp_top_vendors_chart.updateOptions({
                            title: {
                                text: 'Error loading data'
                            }
                        });
                    }
                });
            }

            // Function to update chart with data
            function updateChart(data, chartType) {
                const labels = Object.keys(data);
                const values = Object.values(data).map(val => parseInt(val) || 0);

                sp_top_vendors_chart.updateOptions({
                    series: [{
                        name: 'Total Sold',
                        data: values
                    }],
                    chart: {
                        type: 'bar', // Changed from 'line' to 'bar'
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: true,
                            tools: {
                                download: false
                            }
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '20%',
                            borderRadius: 6
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            colors: ['#ffffff']
                        }
                    },
                    xaxis: {
                        categories: labels
                    },
                    title: {
                        text: 'Top Selling Products - ' + chartType.charAt(0).toUpperCase() + chartType
                            .slice(1)
                    },
                    stroke: {
                        show: true,
                        width: 2
                    }
                });
            }

            // Set up tab click handlers
            document.querySelector('#top_vendors_two_daily-tab').addEventListener('click', function() {
                currentType = 'daily';
                fetchTopProductsData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#top_vendors_two_weekly-tab').addEventListener('click', function() {
                currentType = 'weekly';
                fetchTopProductsData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#top_vendors_two_monthly-tab').addEventListener('click', function() {
                currentType = 'monthly';
                fetchTopProductsData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#top_vendors_two_yearly-tab').addEventListener('click', function() {
                currentType = 'yearly';
                fetchTopProductsData(currentType, currentStartDate, currentEndDate);
            });

            // Initialize date range picker
            $('.dateTopVendorsRange').daterangepicker({
                opens: 'left',
                autoUpdateInput: true,
                minDate: moment('2024-01-01'),
                maxDate: moment().endOf('year'),
            }, function(start, end) {
                var months = end.diff(start, 'months', true);
                if (months < 1) {
                    this.setStartDate(moment(start));
                    this.setEndDate(moment(start).add(1, 'months'));
                }
            });

            $('.dateTopVendorsRange').on('apply.daterangepicker', function(ev, picker) {
                currentStartDate = picker.startDate.format('YYYY-MM-DD');
                currentEndDate = picker.endDate.format('YYYY-MM-DD');
                fetchTopProductsData(currentType, currentStartDate, currentEndDate);
            });

            // Load initial data
            fetchTopProductsData(currentType);
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Variables to store current state
            let currentType = 'daily';
            let currentStartDate = null;
            let currentEndDate = null;

            // Chart configuration
            let fs_two_chartOptions = {
                series: [{
                    name: 'Revenue',
                    data: []
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    background: '#ffffff',
                    toolbar: {
                        show: true,
                        tools: {
                            download: false
                        }
                    }
                },
                title: {
                    text: 'Pending Vendor Payouts',
                    align: 'left'
                },
                colors: ['#41695a'],
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#ffffff']
                    },
                    position: 'top'
                },
                plotOptions: {
                    bar: {
                        columnWidth: '18%',
                        borderRadius: 6
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        formatter: function(value) {
                            return value && value.length > 15 ?
                                value.substring(0, 20) + '...' :
                                value || '';
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: '$ (thousands)'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "$ " + val + " thousands"
                        }
                    }
                }
            };

            // Initialize chart
            let financial_summary_two_chart = new ApexCharts(
                document.querySelector("#financial_summary_two_chart"),
                fs_two_chartOptions
            );
            financial_summary_two_chart.render();

            // Function to fetch data via AJAX
            function fetchVendorPayoutsData(type, startDate = null, endDate = null) {
                // Show loading state
                financial_summary_two_chart.updateOptions({
                    title: {
                        text: 'Loading data...'
                    }
                });

                // Prepare request data
                const requestData = {
                    type: type,
                };

                // Add date range if provided
                if (startDate && endDate) {
                    requestData.start_date = startDate;
                    requestData.end_date = endDate;
                }

                $.ajax({
                    url: '{{ route('vendor-payouts.data') }}',
                    type: 'GET',
                    data: requestData,
                    success: function(data) {
                        updateChart(data, type);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        financial_summary_two_chart.updateOptions({
                            title: {
                                text: 'Error loading data'
                            }
                        });
                    }
                });
            }

            // Function to update chart with data
            function updateChart(data, chartType) {
                const labels = Object.keys(data);
                const values = Object.values(data).map(val => parseFloat(val) || 0);

                financial_summary_two_chart.updateOptions({
                    series: [{
                        name: 'Revenue',
                        data: values
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: true,
                            tools: {
                                download: false
                            }
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '18%',
                            borderRadius: 6
                        }
                    },
                    xaxis: {
                        categories: labels
                    },
                    title: {
                        text: 'Pending Vendor Payouts - ' + chartType.charAt(0).toUpperCase() + chartType
                            .slice(1)
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            colors: ['#ffffff']
                        }
                    }
                });
            }

            // Set up tab click handlers
            document.querySelector('#financial_summary_two_daily-tab').addEventListener('click', function() {
                currentType = 'daily';
                fetchVendorPayoutsData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#financial_summary_two_weekly-tab').addEventListener('click', function() {
                currentType = 'weekly';
                fetchVendorPayoutsData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#financial_summary_two_monthly-tab').addEventListener('click', function() {
                currentType = 'monthly';
                fetchVendorPayoutsData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#financial_summary_two_yearly-tab').addEventListener('click', function() {
                currentType = 'yearly';
                fetchVendorPayoutsData(currentType, currentStartDate, currentEndDate);
            });

            // Initialize date range picker
            $('.dateFinancialSummaryRange').daterangepicker({
                opens: 'left',
                autoUpdateInput: true,
                minDate: moment('2024-01-01'),
                maxDate: moment().endOf('year'),
            }, function(start, end) {
                var months = end.diff(start, 'months', true);
                if (months < 1) {
                    this.setStartDate(moment(start));
                    this.setEndDate(moment(start).add(1, 'months'));
                }
            });

            $('.dateFinancialSummaryRange').on('apply.daterangepicker', function(ev, picker) {
                currentStartDate = picker.startDate.format('YYYY-MM-DD');
                currentEndDate = picker.endDate.format('YYYY-MM-DD');
                fetchVendorPayoutsData(currentType, currentStartDate, currentEndDate);
            });

            // Load initial data
            fetchVendorPayoutsData(currentType);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Variables to store current state
            let currentType = 'daily';
            let currentStartDate = null;
            let currentEndDate = null;

            // Chart configuration
            let campaign_one_options = {
                series: [{
                    name: 'Campaigns Created',
                    data: []
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    background: '#ffffff',
                    toolbar: {
                        show: true,
                        tools: {
                            download: false
                        }
                    },
                    zoom: {
                        enabled: false
                    }
                },
                title: {
                    text: 'Campaign Creation',
                    align: 'left'
                },
                colors: ['#41695a'],
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#ffffff']
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '15%',
                        borderRadius: 6
                    }
                },
                stroke: {
                    show: true,
                    width: 2
                },
                xaxis: {
                    categories: [],
                    labels: {
                        formatter: function(value) {
                            return value && value.length > 15 ?
                                value.substring(0, 20) + '...' :
                                value || '';
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Number of Campaigns'
                    }
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'],
                        opacity: 0.5
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + ' campaigns';
                        }
                    }
                }
            };

            // Initialize chart
            let campaign_one_chart = new ApexCharts(
                document.querySelector("#campaign_one_chart"),
                campaign_one_options
            );
            campaign_one_chart.render();

            // Function to fetch data via AJAX
            function fetchCampaignData(type, startDate = null, endDate = null) {
                // Show loading state
                campaign_one_chart.updateOptions({
                    title: {
                        text: 'Loading data...'
                    }
                });

                // Prepare request data
                const requestData = {
                    type: type,
                };

                // Add date range if provided
                if (startDate && endDate) {
                    requestData.start_date = startDate;
                    requestData.end_date = endDate;
                }

                $.ajax({
                    url: '{{ route('campaigns.data') }}',
                    type: 'GET',
                    data: requestData,
                    success: function(data) {
                        updateChart(data, type);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        campaign_one_chart.updateOptions({
                            title: {
                                text: 'Error loading data'
                            }
                        });
                    }
                });
            }

            // Function to update chart with data
            function updateChart(data, chartType) {
                const labels = Object.keys(data);
                const values = Object.values(data).map(val => parseInt(val) || 0);

                campaign_one_chart.updateOptions({
                    series: [{
                        name: 'Campaigns Created',
                        data: values
                    }],
                    chart: {
                        type: 'bar', // Changed from 'line' to 'bar'
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: true,
                            tools: {
                                download: false
                            }
                        },
                        zoom: {
                            enabled: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '18%',
                            borderRadius: 6
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            colors: ['#ffffff'] // Set text color to white
                        }
                    },
                    xaxis: {
                        categories: labels
                    },
                    title: {
                        text: 'Campaign Creation - ' + chartType.charAt(0).toUpperCase() + chartType.slice(
                            1)
                    },
                    stroke: {
                        show: true,
                        width: 2
                    }
                });
            }

            // Set up tab click handlers
            document.querySelector('#campaign_one_daily-tab').addEventListener('click', function() {
                currentType = 'daily';
                fetchCampaignData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#campaign_one_weekly-tab').addEventListener('click', function() {
                currentType = 'weekly';
                fetchCampaignData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#campaign_one_monthly-tab').addEventListener('click', function() {
                currentType = 'monthly';
                fetchCampaignData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#campaign_one_yearly-tab').addEventListener('click', function() {
                currentType = 'yearly';
                fetchCampaignData(currentType, currentStartDate, currentEndDate);
            });

            // Initialize date range picker
            $('.dateCampaignRange').daterangepicker({
                opens: 'left',
                autoUpdateInput: true,
                minDate: moment('2024-01-01'),
                maxDate: moment().endOf('year'),
            }, function(start, end) {
                var months = end.diff(start, 'months', true);
                if (months < 1) {
                    this.setStartDate(moment(start));
                    this.setEndDate(moment(start).add(1, 'months'));
                }
            });

            $('.dateCampaignRange').on('apply.daterangepicker', function(ev, picker) {
                currentStartDate = picker.startDate.format('YYYY-MM-DD');
                currentEndDate = picker.endDate.format('YYYY-MM-DD');
                fetchCampaignData(currentType, currentStartDate, currentEndDate);
            });

            // Load initial data
            fetchCampaignData(currentType);
        });
    </script>
@endsection
