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
        #top_products_nav {
            display: none;
        }

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
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="webstie_daily-tab"
                                                type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="webstie_weekly-tab" type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="webstie_monthly-tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="webstie_yearly-tab" type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control dateWebstieRange" id="webstie_picker"
                                                placeholder="Custom Date Range">
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="webstie_chart"></div>
                                        <!-- scroll bar -->
                                        <input id="webstie_scroll" class="form-range mt-2 w-100" type="range"
                                            min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="webstie_nav"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
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
                                        <li class="nav-item">
                                            <input type="text" class="form-control dateRangeWebstie"
                                                id="vendor_sign_up_picker" placeholder="Custom Date Range">
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
                                            <input type="text" class="form-control dateWebstieRange"
                                                id="customer_sign_up_picker">
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
                                            <input type="text" class="form-control dateCampaignRange"
                                                id="campaign_one_picker" placeholder="Custom Date Range">
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="campaign_one_chart"></div>
                                        <!-- scroll bar -->
                                        <input id="campaign_one_scroll" class="form-range mt-2 w-100" type="range"
                                            min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="campaign_one_nav"></div>
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
                                            <input type="text" class="form-control dateRangeTopVendor"
                                                id="top_vendors_picker" />
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
                                            <button class="nav-link active" id="top_vendors_two_daily-tab"
                                                type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_vendors_two_weekly-tab"
                                                type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_vendors_two_monthly-tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_vendors_two_yearly-tab"
                                                type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control dateTopVendorsRange"
                                                id="top_products_picker" />
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="top_vendors_two_chart"></div>
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
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="financial_summary_daily-tab"
                                                type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_weekly-tab"
                                                type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_monthly-tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_yearly-tab"
                                                type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control dateRangeFinancialSummary"
                                                id="financial_summary_picker" placeholder="Custom Date Range">
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="financial_summary_chart"></div>
                                        <input id="financial_summary_scroll" class="form-range mt-2 w-100" type="range"
                                            min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="financial_summary_nav"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
                                </div>
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="financial_summary_two_daily-tab"
                                                type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_two_weekly-tab"
                                                type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_two_monthly-tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_two_yearly-tab"
                                                type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control dateFinancialSummaryRange"
                                                id="financial_summary_two_picker" placeholder="Custom Date Range">
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="financial_summary_two_chart"></div>
                                        <!-- scroll bar -->
                                        <input id="financial_summary_two_scroll" class="form-range mt-2 w-100"
                                            type="range" min="0" max="0" value="0"
                                            step="1" />
                                    </div>
                                    <div class="mt-2" id="financial_summary_two_nav"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
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
                        background: {
                            enabled: false
                        },
                        style: {
                            colors: ['#000'],
                            fontWeight: 400,
                            fontSize: '10px',
                            // rotate: -45   // 👈 tilt the numbers
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
                    autoUpdateInput: true,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                }, function(start, end) {
                    const months = end.diff(start, 'months', true);
                    if (months < 1) {
                        this.setStartDate(moment(start));
                        this.setEndDate(moment(start).add(1, 'months'));
                    }
                });

                $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {
                    currentStartDate = picker.startDate.format('YYYY-MM-DD');
                    currentEndDate = picker.endDate.format('YYYY-MM-DD');
                    fetchData(currentType, currentStartDate, currentEndDate);
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
                        height: 380,
                        background: '#ffffff',
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                        animations: {
                            easing: 'easeinout',
                            speed: 200
                        }
                    },
                    title: {
                        text: titleBase,
                        align: 'left'
                    },
                    colors: ['#e0bb20'],
                    grid: {
                        padding: {
                            left: 5,
                            right: 5,
                            bottom: 25
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '40%',
                            borderRadius: 5,
                            dataLabels: {
                                position: 'top'
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        offsetY: -14,
                        style: {
                            colors: ['#000'],
                            fontWeight: 600,
                            fontSize: '11px',
                            textAnchor: 'middle'
                        },
                        formatter: function(val, {
                            dataPointIndex,
                            w
                        }) {
                            const label = w.globals.labels[dataPointIndex];
                            // Show only "Jun 2025" or whatever the x-axis label is + value
                            return `${val}`;
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
                            hideOverlappingLabels: false,
                            offsetY: 6,
                            style: {
                                fontSize: '10px',
                                fontWeight: 500
                            }
                        }
                    },
                    yaxis: {
                        title: {
                            text: seriesName
                        },
                        min: 0,
                        labels: {
                            style: {
                                fontSize: '10px'
                            }
                        }
                    },
                    tooltip: {
                        shared: false,
                        intersect: true,
                        custom: function({
                            series,
                            seriesIndex,
                            dataPointIndex,
                            w
                        }) {
                            const val = series[seriesIndex][dataPointIndex];
                            const label = w.globals.labels[dataPointIndex];
                            const name = (topNames[dataPointIndex] || 'Unknown');
                            return `<div style="padding:6px 8px;">
                            <strong>${name}</strong><br>
                            ${label}<br>
                            ${val} ${unit}
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
                            width: 1
                        },
                        series: [{
                            name: 'Range',
                            data: navData
                        }],
                        xaxis: {
                            type: 'numeric',
                            labels: {
                                show: false
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
                }

                elScroll.addEventListener('input', () => {
                    const windowSize = Math.max(1, vMax - vMin + 1);
                    const left = parseInt(elScroll.value || '0', 10);
                    applyViewport(left, left + windowSize - 1, {
                        from: 'scroll'
                    });
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

                    Object.keys(payload).forEach(k => {
                        if (!seen.has(k)) {
                            seen.add(k);
                            rawLabels.push(k);
                            const val = payload[k];
                            if (isTopChart && typeof val === 'object' && val !== null && 'name' in val &&
                                'value' in val) {
                                values.push(parseInt(val.value) || 0);
                                topNames.push(val.name || 'None');
                            } else {
                                values.push(parseInt(val) || 0);
                                topNames.push('');
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

                // Tabs
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
                    autoUpdateInput: true,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year')
                });

                $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {
                    currentStartDate = picker.startDate.format('YYYY-MM-DD');
                    currentEndDate = picker.endDate.format('YYYY-MM-DD');
                    fetchData(currentType, currentStartDate, currentEndDate);
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
                    main: 'top_vendors_two_chart',
                    nav: 'top_products_nav',
                    scroll: 'top_products_scroll',
                    picker: 'top_products_picker',
                    tabs: {
                        daily: 'top_vendors_two_daily-tab',
                        weekly: 'top_vendors_two_weekly-tab',
                        monthly: 'top_vendors_two_monthly-tab',
                        yearly: 'top_vendors_two_yearly-tab',
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

                // current viewport (inclusive indices into full arrays)
                let vMin = 0,
                    vMax = 0;

                // DOM
                const elMain = document.querySelector('#' + ids.main);
                const elNav = document.querySelector('#' + ids.nav);
                const elScroll = document.querySelector('#' + ids.scroll);

                // Charts
                let chart = null;
                let nav = null;

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
                function initMainChart() {
                    if (chart) {
                        chart.destroy();
                    }
                    elMain.innerHTML = '';

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
                        colors: ['#41695a'],
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
                            background: {
                                enabled: false
                            },
                            style: {
                                colors: ['#000'],
                                fontWeight: 400,
                                fontSize: '10px',
                            },
                            formatter: (v) => `${v}`
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
                                formatter: (val) => `$ ${val} USD`
                            }
                        }
                    };

                    chart = new ApexCharts(elMain, mainOpts);
                    chart.render();
                }

                // this array mirrors the xaxis categories each update; used by tooltip
                let visibleLabels = [];

                // ---------- Navigator (numeric) ----------
                function renderNav() {
                    if (nav) {
                        nav.destroy();
                        nav = null;
                    }
                    elNav.innerHTML = '';

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
                        colors: ['#41695a'],
                        stroke: {
                            width: 1,
                            colors: ['#41695a']
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
                    if (!labels.length || !chart) return;

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
                    if (!labels.length) return;
                    const fullMax = Math.max(0, labels.length - 1);
                    const initialMax = Math.min(fullMax, 60);
                    applyViewport(0, initialMax);
                });

                // ---------- Data fetch & ingest ----------
                function fetchData(type, startDate = null, endDate = null) {
                    currentType = type;
                    setActiveTabUI(type);

                    // Clear everything
                    if (chart) {
                        chart.destroy();
                        chart = null;
                    }
                    elMain.innerHTML = '';
                    if (nav) {
                        nav.destroy();
                        nav = null;
                    }
                    elNav.innerHTML = '';
                    elScroll.value = '0';
                    elScroll.max = '0';
                    elScroll.disabled = true;

                    // Re-init main chart with loading title
                    initMainChart();
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
                        error: () => {
                            if (chart) {
                                chart.updateOptions({
                                    title: {
                                        text: 'Error loading data'
                                    }
                                });
                            }
                        }
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
                            values.push(parseFloat(payload[k]) || 0);
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

                    if (chart) {
                        chart.updateOptions({
                            title: {
                                text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}`
                            }
                        });
                    }

                    // rebuild navigator + main
                    labels = rawLabels.slice(); // keep indices aligned for viewport math

                    // Update main with full data initially
                    if (chart) {
                        const fullVals = values.slice();
                        visibleLabels = displayLabels.slice();
                        chart.updateOptions({
                            series: [{
                                name: seriesName,
                                data: fullVals
                            }],
                            xaxis: {
                                categories: displayLabels
                            }
                        });
                    }

                    // Render nav only if not daily and enough data
                    if (chartType !== 'daily' && values.length > 12) {
                        renderNav();
                    }
                }


                // ---------- Tabs ----------
                document.getElementById(ids.tabs.daily).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('daily', currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.weekly).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('weekly', currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.monthly).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('monthly', currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.yearly).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('yearly', currentStartDate, currentEndDate);
                });

                // ---------- Date picker ----------
                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: true,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                }, function(start, end) {
                    const months = end.diff(start, 'months', true);
                    if (months < 1) {
                        this.setStartDate(moment(start));
                        this.setEndDate(moment(start).add(1, 'months'));
                    }
                });

                $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {
                    currentStartDate = picker.startDate.format('YYYY-MM-DD');
                    currentEndDate = picker.endDate.format('YYYY-MM-DD');
                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                // ---------- First load ----------
                setActiveTabUI('daily');
                fetchData('daily');

                // expose if needed
                return {
                    refresh: () => fetchData(currentType, currentStartDate, currentEndDate)
                };
            }

            // ===== Financial Summary =====
            makeBrushBarChart({
                ids: {
                    main: 'financial_summary_chart',
                    nav: 'financial_summary_nav',
                    scroll: 'financial_summary_scroll',
                    picker: 'financial_summary_picker',
                    tabs: {
                        daily: 'financial_summary_daily-tab',
                        weekly: 'financial_summary_weekly-tab',
                        monthly: 'financial_summary_monthly-tab',
                        yearly: 'financial_summary_yearly-tab',
                    }
                },
                url: '{{ route('income.data') }}',
                seriesName: 'Net Profit',
                titleBase: 'Order Revenue'
            });
        });
    </script>

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

                // current viewport (inclusive indices into full arrays)
                let vMin = 0,
                    vMax = 0;

                // DOM
                const elMain = document.querySelector('#' + ids.main);
                const elNav = document.querySelector('#' + ids.nav);
                const elScroll = document.querySelector('#' + ids.scroll);

                // Charts
                let chart = null;
                let nav = null;

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
                function initMainChart() {
                    if (chart) {
                        chart.destroy();
                    }
                    elMain.innerHTML = '';

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
                        colors: ['#41695a'],
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
                            background: {
                                enabled: false
                            },
                            style: {
                                colors: ['#000'],
                                fontWeight: 400,
                                fontSize: '10px',
                            },
                            formatter: (v) => v,
                            position: 'top'
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
                                text: '$ (thousands)'
                            }
                        },
                        tooltip: {
                            x: {
                                formatter: (val, {
                                    dataPointIndex
                                }) => (visibleLabels[dataPointIndex] ?? '')
                            },
                            y: {
                                formatter: (val) => `$ ${val} thousands`
                            }
                        }
                    };

                    chart = new ApexCharts(elMain, mainOpts);
                    chart.render();
                }

                // this array mirrors the xaxis categories each update; used by tooltip
                let visibleLabels = [];

                // ---------- Navigator (numeric) ----------
                function renderNav() {
                    if (nav) {
                        nav.destroy();
                        nav = null;
                    }
                    elNav.innerHTML = '';

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
                        colors: ['#41695a'],
                        stroke: {
                            width: 1,
                            colors: ['#41695a']
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
                    if (!labels.length || !chart) return;

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
                    if (!labels.length) return;
                    const fullMax = Math.max(0, labels.length - 1);
                    const initialMax = Math.min(fullMax, 60);
                    applyViewport(0, initialMax);
                });

                // ---------- Data fetch & ingest ----------
                function fetchData(type, startDate = null, endDate = null) {
                    currentType = type;
                    setActiveTabUI(type);

                    // Clear everything
                    if (chart) {
                        chart.destroy();
                        chart = null;
                    }
                    elMain.innerHTML = '';
                    if (nav) {
                        nav.destroy();
                        nav = null;
                    }
                    elNav.innerHTML = '';
                    elScroll.value = '0';
                    elScroll.max = '0';
                    elScroll.disabled = true;

                    // Re-init main chart with loading title
                    initMainChart();
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
                        error: () => {
                            if (chart) {
                                chart.updateOptions({
                                    title: {
                                        text: 'Error loading data'
                                    }
                                });
                            }
                        }
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
                            values.push(parseFloat(payload[k]) || 0);
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

                    if (chart) {
                        chart.updateOptions({
                            title: {
                                text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}`
                            }
                        });
                    }

                    // rebuild navigator + main
                    labels = rawLabels.slice(); // keep indices aligned for viewport math

                    // Update main with full data initially
                    if (chart) {
                        const fullVals = values.slice();
                        visibleLabels = displayLabels.slice();
                        chart.updateOptions({
                            series: [{
                                name: seriesName,
                                data: fullVals
                            }],
                            xaxis: {
                                categories: displayLabels
                            }
                        });
                    }

                    // Render nav only if not daily and enough data
                    if (chartType !== 'daily' && values.length > 12) {
                        renderNav();
                    }
                }


                // ---------- Tabs ----------
                document.getElementById(ids.tabs.daily).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('daily', currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.weekly).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('weekly', currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.monthly).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('monthly', currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.yearly).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('yearly', currentStartDate, currentEndDate);
                });

                // ---------- Date picker ----------
                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: true,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                }, function(start, end) {
                    const months = end.diff(start, 'months', true);
                    if (months < 1) {
                        this.setStartDate(moment(start));
                        this.setEndDate(moment(start).add(1, 'months'));
                    }
                });

                $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {
                    currentStartDate = picker.startDate.format('YYYY-MM-DD');
                    currentEndDate = picker.endDate.format('YYYY-MM-DD');
                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                // ---------- First load ----------
                setActiveTabUI('daily');
                fetchData('daily');

                // expose if needed
                return {
                    refresh: () => fetchData(currentType, currentStartDate, currentEndDate)
                };
            }

            // ===== Financial Summary Two =====
            makeBrushBarChart({
                ids: {
                    main: 'financial_summary_two_chart',
                    nav: 'financial_summary_two_nav',
                    scroll: 'financial_summary_two_scroll',
                    picker: 'financial_summary_two_picker',
                    tabs: {
                        daily: 'financial_summary_two_daily-tab',
                        weekly: 'financial_summary_two_weekly-tab',
                        monthly: 'financial_summary_two_monthly-tab',
                        yearly: 'financial_summary_two_yearly-tab',
                    }
                },
                url: '{{ route('vendor-payouts.data') }}',
                seriesName: 'Revenue',
                titleBase: 'Pending Vendor Payouts'
            });
        });
    </script>

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

                // current viewport (inclusive indices into full arrays)
                let vMin = 0,
                    vMax = 0;

                // DOM
                const elMain = document.querySelector('#' + ids.main);
                const elNav = document.querySelector('#' + ids.nav);
                const elScroll = document.querySelector('#' + ids.scroll);

                // Charts
                let chart = null;
                let nav = null;

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
                function initMainChart() {
                    if (chart) {
                        chart.destroy();
                    }
                    elMain.innerHTML = '';

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
                        colors: ['#41695a'],
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
                            background: {
                                enabled: false
                            },
                            style: {
                                colors: ['#000'],
                                fontWeight: 400,
                                fontSize: '10px',
                                // rotate: -45   // 👈 tilt the numbers
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

                    chart = new ApexCharts(elMain, mainOpts);
                    chart.render();
                }

                // this array mirrors the xaxis categories each update; used by tooltip
                let visibleLabels = [];

                // ---------- Navigator (numeric) ----------
                function renderNav() {
                    if (nav) {
                        nav.destroy();
                        nav = null;
                    }
                    elNav.innerHTML = '';

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
                        colors: ['#41695a'],
                        stroke: {
                            width: 1,
                            colors: ['#41695a']
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
                    if (!labels.length || !chart) return;

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
                    if (!labels.length) return;
                    const fullMax = Math.max(0, labels.length - 1);
                    const initialMax = Math.min(fullMax, 60);
                    applyViewport(0, initialMax);
                });

                // ---------- Data fetch & ingest ----------
                function fetchData(type, startDate = null, endDate = null) {
                    currentType = type;
                    setActiveTabUI(type);

                    // Clear everything
                    if (chart) {
                        chart.destroy();
                        chart = null;
                    }
                    elMain.innerHTML = '';
                    if (nav) {
                        nav.destroy();
                        nav = null;
                    }
                    elNav.innerHTML = '';
                    elScroll.value = '0';
                    elScroll.max = '0';
                    elScroll.disabled = true;

                    // Re-init main chart with loading title
                    initMainChart();
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
                        error: () => {
                            if (chart) {
                                chart.updateOptions({
                                    title: {
                                        text: 'Error loading data'
                                    }
                                });
                            }
                        }
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

                    if (chart) {
                        chart.updateOptions({
                            title: {
                                text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}`
                            }
                        });
                    }

                    // rebuild navigator + main
                    labels = rawLabels.slice(); // keep indices aligned for viewport math

                    // Update main with full data initially
                    if (chart) {
                        const fullVals = values.slice();
                        visibleLabels = displayLabels.slice();
                        chart.updateOptions({
                            series: [{
                                name: seriesName,
                                data: fullVals
                            }],
                            xaxis: {
                                categories: displayLabels
                            }
                        });
                    }

                    // Render nav only if not daily and enough data
                    if (chartType !== 'daily' && values.length > 12) {
                        renderNav();
                    }
                }


                // ---------- Tabs ----------
                document.getElementById(ids.tabs.daily).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('daily', currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.weekly).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('weekly', currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.monthly).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('monthly', currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.yearly).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('yearly', currentStartDate, currentEndDate);
                });

                // ---------- Date picker ----------
                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: true,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                }, function(start, end) {
                    const months = end.diff(start, 'months', true);
                    if (months < 1) {
                        this.setStartDate(moment(start));
                        this.setEndDate(moment(start).add(1, 'months'));
                    }
                });

                $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {
                    currentStartDate = picker.startDate.format('YYYY-MM-DD');
                    currentEndDate = picker.endDate.format('YYYY-MM-DD');
                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                // ---------- First load ----------
                setActiveTabUI('daily');
                fetchData('daily');

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
                titleBase: 'Campaign Creation'
            });
        });
    </script>

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

                // current viewport (inclusive indices into full arrays)
                let vMin = 0,
                    vMax = 0;

                // DOM
                const elMain = document.querySelector('#' + ids.main);
                const elNav = document.querySelector('#' + ids.nav);
                const elScroll = document.querySelector('#' + ids.scroll);

                // Charts
                let chart = null;
                let nav = null;

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
                function initMainChart() {
                    if (chart) {
                        chart.destroy();
                    }
                    elMain.innerHTML = '';

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
                        colors: ['#41695a'],
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
                            background: {
                                enabled: false
                            },
                            style: {
                                colors: ['#000000'],
                                fontWeight: 400,
                                fontSize: '10px',
                                // rotate: -45   // 👈 tilt the numbers
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
                                text: 'Number of Visits'
                            }
                        },
                        tooltip: {
                            x: {
                                formatter: (val, {
                                    dataPointIndex
                                }) => (visibleLabels[dataPointIndex] ?? '')
                            },
                            y: {
                                formatter: (val) => `${val} visits`
                            }
                        }
                    };

                    chart = new ApexCharts(elMain, mainOpts);
                    chart.render();
                }

                // this array mirrors the xaxis categories each update; used by tooltip
                let visibleLabels = [];

                // ---------- Navigator (numeric) ----------
                function renderNav() {
                    if (nav) {
                        nav.destroy();
                        nav = null;
                    }
                    elNav.innerHTML = '';

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
                        colors: ['#41695a'],
                        stroke: {
                            width: 1,
                            colors: ['#41695a']
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
                    if (!labels.length || !chart) return;

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
                    if (!labels.length) return;
                    const fullMax = Math.max(0, labels.length - 1);
                    const initialMax = Math.min(fullMax, 60);
                    applyViewport(0, initialMax);
                });

                // ---------- Data fetch & ingest ----------
                function fetchData(type, startDate = null, endDate = null) {
                    currentType = type;
                    setActiveTabUI(type);

                    // Clear everything
                    if (chart) {
                        chart.destroy();
                        chart = null;
                    }
                    elMain.innerHTML = '';
                    if (nav) {
                        nav.destroy();
                        nav = null;
                    }
                    elNav.innerHTML = '';
                    elScroll.value = '0';
                    elScroll.max = '0';
                    elScroll.disabled = true;

                    // Re-init main chart with loading title
                    initMainChart();
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
                        error: () => {
                            if (chart) {
                                chart.updateOptions({
                                    title: {
                                        text: 'Error loading data'
                                    }
                                });
                            }
                        }
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

                    if (chart) {
                        chart.updateOptions({
                            title: {
                                text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}`
                            }
                        });
                    }

                    // rebuild navigator + main
                    labels = rawLabels.slice(); // keep indices aligned for viewport math

                    // Update main with full data initially
                    if (chart) {
                        const fullVals = values.slice();
                        visibleLabels = displayLabels.slice();
                        chart.updateOptions({
                            series: [{
                                name: seriesName,
                                data: fullVals
                            }],
                            xaxis: {
                                categories: displayLabels
                            }
                        });
                    }

                    // Render nav only if not daily and enough data
                    if (chartType !== 'daily' && values.length > 12) {
                        renderNav();
                    }
                }


                // ---------- Tabs ----------
                document.getElementById(ids.tabs.daily).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('daily', currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.weekly).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('weekly', currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.monthly).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('monthly', currentStartDate, currentEndDate);
                });
                document.getElementById(ids.tabs.yearly).addEventListener('click', (e) => {
                    e.preventDefault();
                    fetchData('yearly', currentStartDate, currentEndDate);
                });

                // ---------- Date picker ----------
                $('#' + ids.picker).daterangepicker({
                    opens: 'left',
                    autoUpdateInput: true,
                    minDate: moment('2024-01-01'),
                    maxDate: moment().endOf('year'),
                }, function(start, end) {
                    const months = end.diff(start, 'months', true);
                    if (months < 1) {
                        this.setStartDate(moment(start));
                        this.setEndDate(moment(start).add(1, 'months'));
                    }
                });

                $('#' + ids.picker).on('apply.daterangepicker', function(ev, picker) {
                    currentStartDate = picker.startDate.format('YYYY-MM-DD');
                    currentEndDate = picker.endDate.format('YYYY-MM-DD');
                    fetchData(currentType, currentStartDate, currentEndDate);
                });

                // ---------- First load ----------
                setActiveTabUI('daily');
                fetchData('daily');

                // expose if needed
                return {
                    refresh: () => fetchData(currentType, currentStartDate, currentEndDate)
                };
            }

            // ===== Website =====
            makeBrushBarChart({
                ids: {
                    main: 'webstie_chart',
                    nav: 'webstie_nav',
                    scroll: 'webstie_scroll',
                    picker: 'webstie_picker',
                    tabs: {
                        daily: 'webstie_daily-tab',
                        weekly: 'webstie_weekly-tab',
                        monthly: 'webstie_monthly-tab',
                        yearly: 'webstie_yearly-tab',
                    }
                },
                url: '{{ route('websiteVisits.data') }}',
                seriesName: 'Website Visits',
                titleBase: 'Website Traffic'
            });
        });
    </script>
@endsection
