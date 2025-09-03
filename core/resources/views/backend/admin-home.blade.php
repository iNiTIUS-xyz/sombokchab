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
            color: green;
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
            border: 2px solid #28a745;
            margin-right: 10px;
        }

        .vendor-name {
            font-weight: 500;
            font-size: 1rem;
            color: #333;
        }

        .subtitle {
            font-size: 0.85rem;
            text-transform: uppercase;
            font-weight: 600;
            color: #198754;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
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
                                                Last 7 Days
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
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="webstie_two_daily-tab" data-bs-toggle="tab"
                                                type="button">
                                                Last 7 Days
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="webstie_two_weekly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="webstie_two_monthly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="webstie_two_yearly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Yearly
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control dateRange" id="vendor_sign_up">
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="webstie_two_chart"></div>
                                </div>
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="webstie_three_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Last 7 Days
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="webstie_three_weekly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="webstie_three_monthly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="webstie_three_yearly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Yearly
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="webstie_three_chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Analytics --}}
        <div class="col-lg-12 col-ml-12 mb-3">
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
                                                Last 7 Days
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
                                                Last 7 Days
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
                                                Last 7 Days
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
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="campaign_one_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Last 7 Days
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
                                    </ul>
                                    <div class="mt-3" id="campaign_one_chart"></div>
                                </div>
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="campaign_two_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Last 7 Days
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
                                                Last 7 Days
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
                            <h3 class="my-3">Top Vendors</h3>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card p-4">
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
                                                        <span class="vendor-name">
                                                            {{ $topVendors['name'] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- Top Selling Products -->
                                <div class="col-md-6">
                                    <div class="card p-4">
                                        <p class="subtitle">Top Selling Products</p>
                                        <ul class="list-unstyled product-list text-justify">
                                            @foreach ($topProducts as $key => $topProduct)
                                                <li class="p-1">
                                                    {{ $loop->iteration }}. {{ Str::limit($key, 80, '...') }}
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
                            <h3 class="my-3">Top vendors</h3>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="top_vendors_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Last 7 Days
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_vendors_weekly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_vendors_monthly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_vendors_yearly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Yearly
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="top_vendor_chart"></div>
                                </div>
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="top_vendors_two_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Last 7 Days
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_vendors_two_weekly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_vendors_two_monthly-tab"
                                                data-bs-toggle="tab" type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="top_vendors_two_yearly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Yearly
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="top_vendors_two_chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- vendor management  --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="card shadow rounded-3">
                <div class="card-body">
                    <h4 class="my-3">Vendor managements</h4>
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
                                    <h4 class="fw-bold text-warning">53</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Approved</span>
                                    <h4 class="fw-bold text-success">546</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Rejected</span>
                                    <h4 class="fw-bold text-danger">3</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Withdrawal Requests Pending</span>
                                    <h4 class="fw-bold text-warning">132</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Approved</span>
                                    <h4 class="fw-bold text-success">65</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Rejected</span>
                                    <h4 class="fw-bold text-danger">7</h4>
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
                                    <h4 class="fw-bold text-warning">
                                        {{ $vendorTicketData['vendorTotalOpenTicket']->count() }}</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>High Priority Tickets</span>
                                    <h4 class="fw-bold text-success">
                                        {{ $vendorTicketData['vendorTotalPriorityTicket']->count() }}</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Close Tickets</span>
                                    <h4 class="fw-bold text-danger">
                                        {{ $vendorTicketData['vendorTotalCloseTicket']->count() }}</h4>
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
                                    <h4 class="fw-bold text-warning">
                                        {{ $customerTicketData['totalOpenTicket']->count() }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>High Priority Tickets</span>
                                    <h4 class="fw-bold text-success">
                                        {{ $customerTicketData['totalCloseTicket']->count() }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Close Tickets</span>
                                    <h4 class="fw-bold text-danger">
                                        {{ $vendorTicketData['vendorTotalCloseTicket']->count() }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div
                                    class="d-flex justify-content-between align-items-center bg-light border rounded py-3 px-2">
                                    <span>Total Close Tickets</span>
                                    <h4 class="fw-bold text-danger">
                                        {{ $customerTicketData['refundRequest']->count() }}
                                    </h4>
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
                                                Last 7 Days
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
                                    </ul>
                                    <div class="mt-3" id="financial_summary_chart"></div>
                                </div>
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="financial_summary_two_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Last 7 Days
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
            <div class="card shadow rounded-3 mb-4">
                <div class="card-body">
                    <h4 class="mb-4">Performance Monitoring</h4>
                    <div class="row g-3">
                        <!-- Page Load Time -->
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
                                            <h5 class="mt-1 text-success">2s</h5>
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
                        <!-- API Latency -->
                        <div class="col-md-4">
                            <div class="card shadow-sm rounded-3 text-center p-3">
                                <h6>API Latency</h6>
                                <div class="p-2 bg-light rounded mt-2">
                                    <h5 class="text-success">AVG 200ms</h5>
                                </div>
                            </div>
                        </div>
                        <!-- User Sessions -->
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
                            {{-- <div class="col-6">
                                <div class="p-2 bg-light rounded d-flex justify-content-between align-items-center">
                                    <small>Recent Login Failures</small>
                                    <span class="text-warning fw-bold">7</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded d-flex justify-content-between align-items-center mt-2">
                                    <small>Potential IP Anomalies</small>
                                    <span class="text-danger fw-bold">4</span>
                                </div>
                            </div> --}}
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
            let currentType = 'daily';
            let currentStartDate = null;
            let currentEndDate = null;

            // Chart config (always line)
            let sp_ven_two_chartOptions = {
                series: [{
                    name: 'New Vendors',
                    data: []
                }],
                chart: {
                    type: 'line',
                    height: 350,
                    background: '#ffffff',
                    toolbar: {
                        show: true,
                        tools: {
                            download: false
                        }
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3,
                    colors: ['#41695a']
                },
                markers: {
                    size: 4,
                    colors: ['#41695a'],
                    strokeColors: '#fff',
                    strokeWidth: 2
                },
                title: {
                    text: 'New Vendor Sign Up',
                    align: 'left'
                },
                colors: ['#41695a'],
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: [],
                    labels: {
                        formatter: function(value) {
                            return value && value.length > 15 ?
                                value.substring(0, 15) + '...' :
                                value || '';
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Number of Sign-Ups'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + ' sign-ups';
                        }
                    }
                }
            };

            let sp_vendors_chart = new ApexCharts(
                document.querySelector("#webstie_two_chart"),
                sp_ven_two_chartOptions
            );
            sp_vendors_chart.render();

            // Fetch Data
            function fetchVendorData(type, startDate = null, endDate = null) {
                sp_vendors_chart.updateOptions({
                    title: {
                        text: 'Loading data...'
                    }
                });

                const requestData = {
                    type: type
                };
                if (startDate && endDate) {
                    requestData.start_date = startDate;
                    requestData.end_date = endDate;
                }

                $.ajax({
                    url: '{{ route('vendors.data') }}',
                    type: 'GET',
                    data: requestData,
                    success: function(data) {
                        updateChart(data, type);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        sp_vendors_chart.updateOptions({
                            title: {
                                text: 'Error loading data'
                            }
                        });
                    }
                });
            }

            // Update chart (always line)
            function updateChart(data, chartType) {
                const labels = Object.keys(data);
                const values = Object.values(data).map(val => parseInt(val) || 0);

                sp_vendors_chart.updateOptions({
                    series: [{
                        name: 'New Vendors',
                        data: values
                    }],
                    xaxis: {
                        categories: labels
                    },
                    title: {
                        text: 'New Vendor Sign Up - ' + chartType.charAt(0).toUpperCase() + chartType.slice(
                            1)
                    }
                });
            }

            // Tabs
            document.querySelector('#webstie_two_daily-tab').addEventListener('click', function() {
                currentType = 'daily';
                fetchVendorData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#webstie_two_weekly-tab').addEventListener('click', function() {
                currentType = 'weekly';
                fetchVendorData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#webstie_two_monthly-tab').addEventListener('click', function() {
                currentType = 'monthly';
                fetchVendorData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#webstie_two_yearly-tab').addEventListener('click', function() {
                currentType = 'yearly';
                fetchVendorData(currentType, currentStartDate, currentEndDate);
            });

            // Date Range Picker
            $('.dateRange').daterangepicker({
                opens: 'left',
                autoUpdateInput: true
            });

            $('.dateRange').on('apply.daterangepicker', function(ev, picker) {
                currentStartDate = picker.startDate.format('YYYY-MM-DD');
                currentEndDate = picker.endDate.format('YYYY-MM-DD');
                fetchVendorData(currentType, currentStartDate, currentEndDate);
            });

            // Initial load
            fetchVendorData(currentType);
        });
    </script>
@endsection
