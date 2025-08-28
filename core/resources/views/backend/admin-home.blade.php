@extends('backend.admin-master')

@section('site-title')
    {{ __('Dashboard') }}
@endsection

@section('style')
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
                {{-- <div class="col-md-4">
                    <div class="card shadow-sm rounded-3 p-3">
                        <h6>Development & Version Info</h6>
                        <p class="mb-1">Mobile App Version: 2.1.0 | Desktop: 2.1.0</p>
                        <p class="mb-1">Last Development: Jul 16, 2025 10:00</p>
                        <button class="btn btn-sm btn-success">Rollback</button> | <a href="#">Version
                            History</a>
                    </div>
                </div> --}}
                <div class="col-md-4">
                    <div class="card shadow-sm rounded-3 p-3 text-center">
                        <h6>Error Log Summary</h6>
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
                                    <small>Recent Login Failures</small>
                                    <span class="text-warning fw-bold">7</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded d-flex justify-content-between align-items-center">
                                    <small>Pending Password Resets</small>
                                    <span class="text-success fw-bold">5</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded d-flex justify-content-between align-items-center mt-2">
                                    <small>Potential IP Anomalies</small>
                                    <span class="text-danger fw-bold">4</span>
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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var website_stars_options = {
            series: [{
                name: "Desktops",
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
            }],
            chart: {
                height: 350,
                type: 'line',
                background: '#ffffff',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: true,
                    tools: {
                        download: false
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Visitor',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
        };

        var webstie_chart = new ApexCharts(document.querySelector("#webstie_chart"), website_stars_options);
        webstie_chart.render();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Pass data from Laravel to JavaScript
            let sp_vendorsDaily = @json($vendorsDaily);
            let sp_vendorsWeekly = @json($vendorsWeekly);
            let sp_vendorsMonthly = @json($vendorsMonthly);
            let sp_vendorsYearly = @json($vendorsYearly);

            // Function to generate alternating colors
            function sp_generateAlternatingColors(count) {
                const colors = ['#41695a', '#609C78'];
                return Array.from({
                    length: count
                }, (_, i) => colors[i % colors.length]);
            }

            // Chart configuration
            let sp_ven_two_chartOptions = {
                series: [{
                    name: 'New Vendors',
                    data: []
                }],
                chart: {
                    type: 'bar', // Default type
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
                        horizontal: false,
                        columnWidth: '15%',
                        borderRadius: 5,
                        borderRadiusApplication: 'end'
                    },
                },
                title: {
                    text: 'New Vendor Sign Up',
                    align: 'left'
                },
                colors: ['#41695a'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
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
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + ' sign-ups';
                        }
                    }
                }
            };

            // Initialize chart
            let sp_vendors_chart = new ApexCharts(
                document.querySelector("#webstie_two_chart"),
                sp_ven_two_chartOptions
            );
            sp_vendors_chart.render();

            // Function to update chart with type
            function sp_updateVendorChart(data, chartType) {
                const labels = Object.keys(data);
                const values = Object.values(data).map(val => parseInt(val) || 0);

                sp_vendors_chart.updateOptions({
                    series: [{
                        name: 'New Vendors',
                        data: values
                    }],
                    chart: {
                        type: chartType,
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: true,
                            tools: {
                                download: false
                            }
                        }
                    },
                    xaxis: {
                        categories: labels
                    },
                    colors: sp_generateAlternatingColors(labels.length),
                    legend: {
                        show: false
                    },
                    stroke: {
                        show: chartType === 'line' ? true : true,
                        width: chartType === 'line' ? 3 : 2,
                        colors: chartType === 'line' ? ['#41695a'] : ['transparent']
                    },
                    markers: {
                        size: chartType === 'line' ? 4 : 0
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '15%',
                            borderRadius: 5,
                            borderRadiusApplication: 'end'
                        }
                    }
                });
            }

            // Attach event listeners to tabs with alternating chart types
            document.querySelector('#webstie_two_daily-tab').addEventListener('click', () => sp_updateVendorChart(
                sp_vendorsDaily, 'bar'));
            document.querySelector('#webstie_two_weekly-tab').addEventListener('click', () => sp_updateVendorChart(
                sp_vendorsWeekly, 'line'));
            document.querySelector('#webstie_two_monthly-tab').addEventListener('click', () => sp_updateVendorChart(
                sp_vendorsMonthly, 'bar'));
            document.querySelector('#webstie_two_yearly-tab').addEventListener('click', () => sp_updateVendorChart(
                sp_vendorsYearly, 'line'));

            // Initial chart load (Daily data as bar)
            sp_updateVendorChart(sp_vendorsDaily, 'bar');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Pass data from Laravel to JavaScript
            let sp_customersDaily = @json($customersDaily);
            let sp_customersWeekly = @json($customersWeekly);
            let sp_customersMonthly = @json($customersMonthly);
            let sp_customersYearly = @json($customersYearly);

            // Function to generate alternating colors
            function sp_generateAlternatingColors(count) {
                const colors = ['#41695a', '#609C78'];
                return Array.from({
                    length: count
                }, (_, i) => colors[i % colors.length]);
            }

            // Chart configuration
            let sp_customer_chartOptions = {
                series: [{
                    name: 'New Customers',
                    data: []
                }],
                chart: {
                    type: 'bar', // Default type
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
                        horizontal: false,
                        columnWidth: '15%',
                        borderRadius: 5,
                        borderRadiusApplication: 'end'
                    },
                },
                title: {
                    text: 'New Customer Sign Up',
                    align: 'left'
                },
                colors: ['#41695a'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent'],
                    curve: 'straight' // Ensure smooth line for line charts
                },
                xaxis: {
                    categories: [],
                    labels: {
                        formatter: function(value) {
                            return value && value.length > 15 ? value.substring(0, 15) + '...' : value ||
                            '';
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Number of Sign-Ups'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + ' sign-ups';
                        }
                    }
                }
            };

            // Initialize chart
            let sp_customers_chart = new ApexCharts(document.querySelector("#webstie_three_chart"),
                sp_customer_chartOptions);
            sp_customers_chart.render();

            // Function to update chart with type
            function sp_updateCustomerChart(data, chartType) {
                const labels = Object.keys(data);
                const values = Object.values(data).map(val => parseInt(val) || 0);

                sp_customers_chart.updateOptions({
                    series: [{
                        name: 'New Customers',
                        data: values
                    }],
                    chart: {
                        type: chartType,
                        height: 350,
                        background: '#ffffff',
                        toolbar: {
                            show: true,
                            tools: {
                                download: false
                            }
                        }
                    },
                    xaxis: {
                        categories: labels
                    },
                    colors: sp_generateAlternatingColors(labels.length),
                    legend: {
                        show: false
                    },
                    stroke: {
                        show: true,
                        width: chartType === 'line' ? 3 : 2,
                        colors: chartType === 'line' ? ['#41695a'] : ['transparent'],
                        curve: 'straight' // Ensure continuous line
                    },
                    markers: {
                        size: chartType === 'line' ? 4 : 0,
                        strokeColors: chartType === 'line' ? '#41695a' : 'transparent',
                        strokeWidth: chartType === 'line' ? 2 : 0
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '15%',
                            borderRadius: 5,
                            borderRadiusApplication: 'end'
                        }
                    }
                });
            }

            // Attach event listeners to tabs with alternating chart types
            document.querySelector('#webstie_three_daily-tab').addEventListener('click', () =>
                sp_updateCustomerChart(sp_customersDaily, 'bar'));
            document.querySelector('#webstie_three_weekly-tab').addEventListener('click', () =>
                sp_updateCustomerChart(sp_customersWeekly, 'line'));
            document.querySelector('#webstie_three_monthly-tab').addEventListener('click', () =>
                sp_updateCustomerChart(sp_customersMonthly, 'bar'));
            document.querySelector('#webstie_three_yearly-tab').addEventListener('click', () =>
                sp_updateCustomerChart(sp_customersYearly, 'line'));

            // Initial chart load (Daily data as bar)
            sp_updateCustomerChart(sp_customersDaily, 'bar');
        });
    </script>

    <script>
        var analytics_options = {
            series: [{
                name: 'Net Profit',
                data: [44, 63, 60, 66, 55, 57, 56, 61, 58, ]
            }, ],
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
                    horizontal: false,
                    columnWidth: '15%',
                    borderRadius: 5,
                    borderRadiusApplication: 'end'
                },
            },
            colors: ['#e0bb20'],
            dataLabels: {
                enabled: false
            },
            title: {
                text: 'Download Status',
                align: 'left'
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };

        var analytics_chart = new ApexCharts(document.querySelector("#analytics_chart"), analytics_options);
        analytics_chart.render();
    </script>

    <script>
        var analytics_two_options = {
            series: [{
                name: "Desktops",
                data: [10, 41, 69, 91, 148, 35, 51, 49, 62, ]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                },
                background: '#ffffff',
                toolbar: {
                    show: true,
                    tools: {
                        download: false
                    }
                }
            },
            title: {
                text: 'Sign up conversion rate',
                align: 'left'
            },
            colors: ['#41695a'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
        };

        var analytics_two_chart = new ApexCharts(document.querySelector("#analytics_two_chart"), analytics_two_options);
        analytics_two_chart.render();
    </script>

    <script>
        var analytics_three_options = {
            series: [{
                name: "Desktops",
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                },
                background: '#ffffff',
                toolbar: {
                    show: true,
                    tools: {
                        download: false
                    }
                }
            },
            title: {
                text: 'Purchase conversion rate',
                align: 'left'
            },
            colors: ['#41695a'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
        };

        var analytics_three_chart = new ApexCharts(document.querySelector("#analytics_three_chart"),
            analytics_three_options);
        analytics_three_chart.render();
    </script>


    <script>
        const incomeDaily = @json($income_daily->pluck('amount', 'label'));
        const incomeWeekly = @json($income_weekly->pluck('amount', 'week'));
        const incomeMonthly = @json($income_monthly->pluck('amount', 'label'));
        const incomeYearly = @json($income_yearly->pluck('amount', 'label'));
        // ===== Helper: Alternating Colors =====
        function generateAlternatingColors(length) {
            const colorOne = '#41695a';
            const colorTwo = '#e0bb20';
            return Array.from({
                length
            }, (_, i) => i % 2 === 0 ? colorOne : colorTwo);
        }

        var financial_summary_options = {
            series: [{
                name: 'Net Profit',
                data: Object.values(incomeDaily)
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
                    horizontal: false,
                    columnWidth: '30%',
                    borderRadius: 10,
                    borderRadiusApplication: 'end'
                }
            },
            title: {
                text: 'Order Revenue',
                align: 'left'
            },
            colors: ['#41695a'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: Object.keys(incomeDaily)
            },
            yaxis: {
                title: {
                    text: '$ (USD)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " USD"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#financial_summary_chart"), financial_summary_options);
        chart.render();

        function updateIncomeChart(data) {
            chart.updateOptions({
                series: [{
                    name: 'Net Profit',
                    data: Object.values(data)
                }],
                xaxis: {
                    categories: Object.keys(data)
                }
            });
        }
        document.querySelector('#financial_summary_daily-tab').addEventListener('click', function() {
            updateIncomeChart(incomeDaily);
        });

        document.querySelector('#financial_summary_weekly-tab').addEventListener('click', function() {
            updateIncomeChart(incomeWeekly);
        });

        document.querySelector('#financial_summary_monthly-tab').addEventListener('click', function() {
            updateIncomeChart(incomeMonthly);
        });

        document.querySelector('#financial_summary_yearly-tab').addEventListener('click', function() {
            updateIncomeChart(incomeYearly);
        });
    </script>

    <script>
        // Laravel variables from controller
        let fs_two_daily = @json($vendorWithdrawDaily);
        let fs_two_weekly = @json($vendorWithdrawWeekly);
        let fs_two_monthly = @json($vendorWithdrawMonthly);
        let fs_two_yearly = @json($vendorWithdrawYearly);

        // Function to generate alternating colors
        function fs_two_generateColors(count) {
            const colors = ['#e0bb20', '#c79f1a'];
            return Array.from({
                length: count
            }, (_, i) => colors[i % colors.length]);
        }

        // Chart default options
        let fs_two_chartOptions = {
            series: [{
                name: 'Revenue',
                data: []
            }],
            chart: {
                type: 'bar',
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
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    borderRadius: 5,
                    borderRadiusApplication: 'end'
                },
            },
            colors: ['#e0bb20'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: [],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands";
                    }
                }
            }
        };

        // Create chart instance
        let financial_summary_two_chart = new ApexCharts(
            document.querySelector("#financial_summary_two_chart"),
            fs_two_chartOptions
        );
        financial_summary_two_chart.render();

        // Function to update chart data
        function fs_two_updateChart(data) {
            const labels = Object.keys(data);
            const values = Object.values(data).map(val => parseFloat(val));

            financial_summary_two_chart.updateOptions({
                series: [{
                    name: 'Revenue',
                    data: values
                }],
                xaxis: {
                    categories: labels
                },
                colors: fs_two_generateColors(labels.length),
                legend: {
                    show: false
                }
            });
        }

        // Event listeners for tabs
        document.querySelector('#financial_summary_two_daily-tab').addEventListener('click', function() {
            fs_two_updateChart(fs_two_daily);
        });
        document.querySelector('#financial_summary_two_weekly-tab').addEventListener('click', function() {
            fs_two_updateChart(fs_two_weekly);
        });
        document.querySelector('#financial_summary_two_monthly-tab').addEventListener('click', function() {
            fs_two_updateChart(fs_two_monthly);
        });
        document.querySelector('#financial_summary_two_yearly-tab').addEventListener('click', function() {
            fs_two_updateChart(fs_two_yearly);
        });

        // Load daily data on page load
        document.addEventListener('DOMContentLoaded', () => {
            fs_two_updateChart(fs_two_daily);
        });
    </script>

    <script>
        var campaign_one_options = {
            series: [{
                name: "Desktops",
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                },
                background: '#ffffff',
                toolbar: {
                    show: true,
                    tools: {
                        download: false
                    }
                }
            },
            title: {
                text: 'Campaign Visitor',
                align: 'left'
            },
            colors: ['#e0bb20'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
        };

        var campaign_one_chart = new ApexCharts(document.querySelector("#campaign_one_chart"), campaign_one_options);
        campaign_one_chart.render();
    </script>

    <script>
        var campaign_two_options = {
            series: [{
                name: 'Net Profit',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, ],
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
                    horizontal: false,
                    columnWidth: '15%',
                    borderRadius: 5,
                    borderRadiusApplication: 'end'
                },
            },
            title: {
                text: 'Campaign sign up',
                align: 'left'
            },
            colors: ['#41695a'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };

        var campaign_two_chart = new ApexCharts(document.querySelector("#campaign_two_chart"), campaign_two_options);
        campaign_two_chart.render();
    </script>

    <script>
        var campaign_three_options = {
            series: [{
                name: 'Net Profit',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, ],
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
                    horizontal: false,
                    columnWidth: '15%',
                    borderRadius: 5,
                    borderRadiusApplication: 'end'
                },
            },
            title: {
                text: 'Campaign Purchase',
                align: 'left'
            },
            colors: ['#e0bb20'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };

        var campaign_three_chart = new ApexCharts(document.querySelector("#campaign_three_chart"), campaign_three_options);
        campaign_three_chart.render();
    </script>

    <script>
        // ===== TOP VENDORS DATA =====
        const topVendorsDaily = @json($top_vendors_daily);
        const topVendorsWeekly = @json($top_vendors_weekly);
        const topVendorsMonthly = @json($top_vendors_monthly);
        const topVendorsYearly = @json($top_vendors_yearly);

        const top_vendor_options = {
            series: [{
                name: 'Net Profit',
                data: Object.values(topVendorsDaily)
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
                    horizontal: false,
                    columnWidth: '30%',
                    borderRadius: 10,
                    borderRadiusApplication: 'end',
                    distributed: true
                }
            },
            title: {
                text: 'Top Seeling Vendor',
                align: 'left'
            },
            colors: generateAlternatingColors(Object.keys(topVendorsDaily).length),
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: Object.keys(topVendorsDaily)
            },
            yaxis: {
                title: {
                    text: 'Total Sales'
                }
            },
            legend: {
                show: false
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " USD";
                    }
                }
            }
        };

        const top_vendor_chart = new ApexCharts(document.querySelector("#top_vendor_chart"), top_vendor_options);
        top_vendor_chart.render();

        function updateVendorChart(data) {
            const labels = Object.keys(data);
            const values = Object.values(data);
            top_vendor_chart.updateOptions({
                series: [{
                    name: 'Net Profit',
                    data: values
                }],
                xaxis: {
                    categories: labels
                },
                colors: generateAlternatingColors(labels.length),
                legend: {
                    show: false
                }
            });
        }

        // Vendor Tabs Event Listeners
        document.querySelector('#top_vendors_daily-tab').addEventListener('click', function() {
            updateVendorChart(topVendorsDaily);
        });

        document.querySelector('#top_vendors_weekly-tab').addEventListener('click', function() {
            updateVendorChart(topVendorsWeekly);
        });

        document.querySelector('#top_vendors_monthly-tab').addEventListener('click', function() {
            updateVendorChart(topVendorsMonthly);
        });

        document.querySelector('#top_vendors_yearly-tab').addEventListener('click', function() {
            updateVendorChart(topVendorsYearly);
        });

        // Set default chart data on page load
        document.addEventListener('DOMContentLoaded', () => {
            updateVendorChart(topVendorsDaily);
        });
    </script>

    <script>
        let sp_topVendorsDaily = @json($topVendorsDaily);
        let sp_topVendorsWeekly = @json($topVendorsWeekly);
        let sp_topVendorsMonthly = @json($topVendorsMonthly);
        let sp_topVendorsYearly = @json($topVendorsYearly);

        function sp_generateAlternatingColors(count) {
            const colors = ['#41695a', '#609C78'];
            return Array.from({
                length: count
            }, (_, i) => colors[i % colors.length]);
        }

        let sp_t_v_t_chartOptions = {
            series: [{
                name: 'Total Sold',
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
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '15%',
                    borderRadius: 5,
                    borderRadiusApplication: 'end'
                },
            },
            title: {
                text: 'Top Selling Products',
                align: 'left'
            },
            colors: ['#41695a'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: [],
                labels: {
                    formatter: function(value) {
                        return value.length > 15 ? value.substring(0, 15) + '...' : value;
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Quantity Sold'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + ' sold';
                    }
                }
            }
        };

        let sp_top_vendors_chart = new ApexCharts(document.querySelector("#top_vendors_two_chart"), sp_t_v_t_chartOptions);
        sp_top_vendors_chart.render();

        function sp_updateVendorChart(data) {
            const labels = Object.keys(data);
            const values = Object.values(data).map(val => parseInt(val));

            sp_top_vendors_chart.updateOptions({
                series: [{
                    name: 'Total Sold',
                    data: values
                }],
                xaxis: {
                    categories: labels
                },
                colors: sp_generateAlternatingColors(labels.length),
                legend: {
                    show: false
                }
            });
        }

        // Corrected event listeners with matching IDs
        document.querySelector('#top_vendors_two_daily-tab').addEventListener('click', function() {
            sp_updateVendorChart(sp_topVendorsDaily);
        });
        document.querySelector('#top_vendors_two_weekly-tab').addEventListener('click', function() {
            sp_updateVendorChart(sp_topVendorsWeekly);
        });
        document.querySelector('#top_vendors_two_monthly-tab').addEventListener('click', function() {
            sp_updateVendorChart(sp_topVendorsMonthly);
        });
        document.querySelector('#top_vendors_two_yearly-tab').addEventListener('click', function() {
            sp_updateVendorChart(sp_topVendorsYearly);
        });

        document.addEventListener('DOMContentLoaded', () => {
            sp_updateVendorChart(sp_topVendorsDaily);
        });
    </script>
@endsection
