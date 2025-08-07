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
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="my-3">Webstie Stats</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="#" class="text-warning">View All</a>
                                </div>
                            </div>
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
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="webstie_two_daily-tab" data-bs-toggle="tab"
                                                type="button">
                                                Daily
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
                                                Daily
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="my-3">Analytics</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="#" class="text-warning">View All</a>
                                </div>
                            </div>
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
        </div>
        {{-- Campaign Stats --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="my-3">Campaign Stats</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="#" class="text-warning">View All</a>
                                </div>
                            </div>
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
                                    </ul>
                                    <div class="mt-3" id="campaign_one_chart"></div>
                                </div>
                                <div class="col-md-6">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="my-3">Notifications</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="#" class="text-warning">View All</a>
                                </div>
                            </div>
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
        {{-- Top vendors --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="my-3">Top vendors</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="#" class="text-warning">View All</a>
                                </div>
                            </div>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="top_vendors_daily-tab"
                                                data-bs-toggle="tab" type="button">
                                                Daily
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
                                                Daily
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
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="my-3">Vendor managements</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="#" class="text-warning">View All</a>
                                </div>
                            </div>
                            <div class="row g-5">
                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <span class="badge badge-custom">Product Pending: 10</span>
                                        <span class="badge badge-custom">Approved: 15</span>
                                        <span class="badge badge-custom">Rejected: 2</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="badge badge-custom">Withdrawal Requests Pending: 2</span>
                                        <span class="badge badge-custom">Approved: 1</span>
                                        <span class="badge badge-custom">Rejected: 0</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- vendor Support  --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="my-3">Vendor Support</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="#" class="text-warning">View All</a>
                                </div>
                            </div>
                            <div class="row g-5">
                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <span class="badge badge-custom">Total Tickets Open: 10</span>
                                        <span class="badge badge-custom">High Priority Tickets: 5</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Customer Support --}}
        <div class="col-lg-12 col-ml-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="my-3">Customer Support</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="#" class="text-warning">View All</a>
                                </div>
                            </div>
                            <div class="row g-5">
                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <span class="badge badge-custom">
                                            Total Tickets Open: {{ $customerTicketData['totalOpenTicket']->count() }}
                                        </span>
                                        <span class="badge badge-custom">
                                            High Priority Tickets: {{ $customerTicketData['totalCloseTicket']->count() }}
                                        </span>
                                        <span class="badge badge-custom">
                                            Refund Request: {{ $customerTicketData['refundRequest']->count() }}
                                        </span>
                                    </div>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="my-3">Financial Summary</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="#" class="text-warning">View All</a>
                                </div>
                            </div>
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
                                    </ul>
                                    <div class="mt-3" id="financial_summary_two_chart"></div>
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
        var webstie_two_options = {
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
            colors: ['#41695a'],
            dataLabels: {
                enabled: false
            },
            title: {
                text: 'New vendor sign up',
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

        var webstie_two_chart = new ApexCharts(document.querySelector("#webstie_two_chart"), webstie_two_options);
        webstie_two_chart.render();
    </script>

    <script>
        var webstie_three_options = {
            series: [{
                name: 'Net Profit',
                data: [44, 55, 58, 63, 60, 66, 57, 56, 61, ]
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
            colors: ['#41695a'],
            dataLabels: {
                enabled: false
            },
            title: {
                text: 'New customer sign up',
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

        var webstie_three_chart = new ApexCharts(document.querySelector("#webstie_three_chart"), webstie_three_options);
        webstie_three_chart.render();
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

        // ===== TOP VENDORS DATA =====
        const topVendorsDaily = @json($top_vendors_daily);
        const topVendorsWeekly = @json($top_vendors_weekly);
        const topVendorsMonthly = @json($top_vendors_monthly);
        const topVendorsYearly = @json($top_vendors_yearly);

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
        var financial_summary_two_options = {
            series: [{
                name: 'Revenue',
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
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

        var financial_summary_two_chart = new ApexCharts(document.querySelector("#financial_summary_two_chart"),
            financial_summary_two_options);
        financial_summary_two_chart.render();
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

        let sp_chartOptions = {
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

        let sp_top_vendors_chart = new ApexCharts(document.querySelector("#top_vendors_two_chart"), sp_chartOptions);
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
