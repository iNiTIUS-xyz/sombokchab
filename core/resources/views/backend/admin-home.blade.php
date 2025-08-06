@extends('backend.admin-master')
@section('site-title')
    {{ __('Dashboard') }}
@endsection
@section('content')
    @php
        $statistics = [
            ['title' => __('Total Admin'), 'value' => $total_admin, 'icon' => 'lar la-user'],
            ['title' => __('Total Customer'), 'value' => $total_user, 'icon' => 'lar la-user'],
            ['title' => __('Total Blog'), 'value' => $all_blogs_count, 'icon' => 'lar la-edit'],
            ['title' => __('Total Products'), 'value' => $all_products_count, 'icon' => 'las la-box'],
            ['title' => __('Completed Sale'), 'value' => $all_completed_sell_count, 'icon' => 'las la-boxes'],
            ['title' => __('Pending Sale'), 'value' => $all_pending_sell_count, 'icon' => 'las la-history'],
            ['title' => __('Sold Amount'), 'value' => $total_sold_amount, 'icon' => 'las la-coins'],
            ['title' => __('Ongoing Campaign'), 'value' => $total_ongoing_campaign, 'icon' => 'las la-gifts'],
        ];
    @endphp

    <div class="dashboard-profile-inner">
        {{-- <div class="row g-4 justify-content-center">
            <div class="col-xxl-3 col-xl-6 col-sm-6 orders-child">
                <a href="{{ route('admin.all.user') }}">
                    <div class="single-orders">
                        <div class="orders-shapes"></div>
                        <div class="orders-flex-content">
                            <div class="contents">
                                <span class="order-para"> {{ __('Total Admin') }} </span>
                                <h2 class="order-titles"> {{ $total_admin }} </h2>
                            </div>
                            <div class="icon">
                                <i class="las la-tasks"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xxl-3 col-xl-6 col-sm-6 orders-child">
                <a href="{{ route('admin.vendor.all') }}">
                    <div class="single-orders">
                        <div class="orders-shapes"></div>
                        <div class="orders-flex-content">
                            <div class="contents">
                                <span class="order-para"> {{ __('Total Vendors') }} </span>
                                <h2 class="order-titles"> {{ $total_vendor }} </h2>
                            </div>
                            <div class="icon">
                                <i class="las la-handshake"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xxl-3 col-xl-6 col-sm-6 orders-child">
                <a href="{{ route('admin.all.frontend.user') }}">
                    <div class="single-orders">
                        <div class="orders-shapes"></div>
                        <div class="orders-flex-content">
                            <div class="contents">
                                <span class="order-para"> {{ __('Total Customers') }} </span>
                                <h2 class="order-titles"> {{ $total_user }} </h2>
                            </div>
                            <div class="icon">
                                <i class="las la-handshake"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xxl-3 col-xl-6 col-sm-6 orders-child">
                <a href="{{ route('admin.blog') }}">
                    <div class="single-orders">
                        <div class="orders-shapes">
                        </div>
                        <div class="orders-flex-content">
                            <div class="contents">
                                <span class="order-para"> {{ __('Total Blogs') }} </span>
                                <h2 class="order-titles"> {{ $all_blogs_count }} </h2>
                            </div>
                            <div class="icon">
                                <i class="las la-dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xxl-3 col-xl-6 col-sm-6 orders-child">
                <a href="{{ route('admin.products.all') }}">
                    <div class="single-orders">
                        <div class="orders-shapes">
                        </div>
                        <div class="orders-flex-content">
                            <div class="contents">
                                <span class="order-para"> {{ __('Total Product') }} </span>
                                <h2 class="order-titles"> {{ $all_products_count }} </h2>
                            </div>
                            <div class="icon">
                                <i class="las la-dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xxl-3 col-xl-6 col-sm-6 orders-child">
                <a href="{{ route('admin.orders.list') }}">
                    <div class="single-orders">
                        <div class="orders-shapes">
                        </div>
                        <div class="orders-flex-content">
                            <div class="contents">
                                <span class="order-para"> {{ __('Total Completed Order') }} </span>
                                <h2 class="order-titles"> {{ $all_completed_sell_count }} </h2>
                            </div>
                            <div class="icon">
                                <i class="las la-file-invoice-dollar"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xxl-3 col-xl-6 col-sm-6 orders-child">
                <a href="{{ route('admin.orders.list') }}">
                    <div class="single-orders">
                        <div class="orders-shapes">
                        </div>
                        <div class="orders-flex-content">
                            <div class="contents">
                                <span class="order-para"> {{ __('Total Pending Order') }} </span>
                                <h2 class="order-titles"> {{ $all_pending_sell_count }} </h2>
                            </div>
                            <div class="icon">
                                <i class="las la-file-invoice-dollar"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xxl-3 col-xl-6 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para"> {{ __('Total Sold Amount') }} </span>
                            <h2 class="order-titles"> {{ $total_sold_amount }} </h2>
                        </div>
                        <div class="icon">
                            <i class="las la-file-invoice-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para"> {{ __('Last week earning') }} </span>
                            <h2 class="order-titles"> {{ $last_week_earning }} </h2>
                        </div>
                        <div class="icon">
                            <i class="las la-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para"> {{ __('This month earning') }} </span>
                            <h2 class="order-titles"> {{ $running_month_earning }} </h2>
                        </div>
                        <div class="icon">
                            <i class="las la-file-invoice-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para"> {{ __('Last month earning') }} </span>
                            <h2 class="order-titles"> {{ $last_month_earning }} </h2>
                        </div>
                        <div class="icon">
                            <i class="las la-file-invoice-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-6 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para"> {{ __('This year earning') }} </span>
                            <h2 class="order-titles"> {{ $this_year_earning }} </h2>
                        </div>
                        <div class="icon">
                            <i class="las la-file-invoice-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row g-5 mt-2">
            <div class="col-md-6">
                <h3 class="my-3">Income Statement</h3>
                <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="income_statement_daily-tab" data-bs-toggle="tab" type="button">
                            Daily
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="income_statement_weekly-tab" data-bs-toggle="tab" type="button">
                            Weekly
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="income_statement_monthly-tab" data-bs-toggle="tab" type="button">
                            Monthly
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="income_statement_yearly-tab" data-bs-toggle="tab" type="button">
                            Yearly
                        </button>
                    </li>
                </ul>
                <div class="mt-3" id="income_statement_chart"></div>
            </div>
            <div class="col-md-6">
                <h3 class="my-3">Top Vendors</h3>
                <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="top_vendors_daily-tab" data-bs-toggle="tab" type="button">
                            Daily
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="top_vendors_weekly-tab" data-bs-toggle="tab" type="button">
                            Weekly
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="top_vendors_monthly-tab" data-bs-toggle="tab" type="button">
                            Monthly
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="top_vendors_yearly-tab" data-bs-toggle="tab" type="button">
                            Yearly
                        </button>
                    </li>
                </ul>
                <div class="mt-3" id="top_vendor_chart"></div>
            </div>
        </div>


        <div class="row g-5 mt-2">
            <div class="col-md-6">
                <h3 class="my-3">Analytics</h3>
                <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="analytics_daily-tab" data-bs-toggle="tab" type="button">
                            Daily
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="analytics_weekly-tab" data-bs-toggle="tab" type="button">
                            Weekly
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="analytics_monthly-tab" data-bs-toggle="tab" type="button">
                            Monthly
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="analytics_yearly-tab" data-bs-toggle="tab" type="button">
                            Yearly
                        </button>
                    </li>
                </ul>
                <div class="mt-3" id="analytics_chart"></div>
            </div>
            <div class="col-md-6">
                <h3 class="mb-5"></h3>
                <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="analytics_two_daily-tab" data-bs-toggle="tab" type="button">
                            Daily
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="analytics_two_weekly-tab" data-bs-toggle="tab" type="button">
                            Weekly
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="analytics_two_monthly-tab" data-bs-toggle="tab" type="button">
                            Monthly
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="analytics_two_yearly-tab" data-bs-toggle="tab" type="button">
                            Yearly
                        </button>
                    </li>
                </ul>
                <div class="mt-3" id="analytics_chart_two"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            series: [{
                name: "Desktops",
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
            }
        ],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            },
            toolbar: { show: true, tools: { download: false } }
        },
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

        var analytics_chart_two = new ApexCharts(document.querySelector("#analytics_chart_two"), options);
        analytics_chart_two.render();
    </script>
    <script>
         var analytics_options = {
        series: [
            {
                name: 'Net Profit',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            },
        ],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: true, tools: { download: false } }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRadius: 5,
                borderRadiusApplication: 'end'
            },
        },
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
          y:{
            formatter: function (val) {
                return "$ " + val + " thousands"
            }
        }
        }};

        var analytics_chart = new ApexCharts(document.querySelector("#analytics_chart"), analytics_options);
        analytics_chart.render();
    </script>

    <script>
        // ===== INCOME STATEMENT DATA =====
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
            const red = '#e74c3c';
            const blue = '#3498db';
            return Array.from({ length }, (_, i) => i % 2 === 0 ? red : blue);
        }

        // ===== INCOME STATEMENT CHART =====
        var income_statement_options = {
            series: [{
                name: 'Net Profit',
                data: Object.values(incomeDaily)
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: true, tools: { download: false } }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '30%',
                    borderRadius: 10,
                    borderRadiusApplication: 'end'
                }
            },
            dataLabels: { enabled: false },
            stroke: { show: true, width: 2, colors: ['transparent'] },
            xaxis: {
                categories: Object.keys(incomeDaily)
            },
            yaxis: {
                title: { text: '$ (USD)' }
            },
            fill: { opacity: 1 },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "$ " + val + " USD"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#income_statement_chart"), income_statement_options);
        chart.render();

        function updateIncomeChart(data) {
            chart.updateOptions({
                series: [{ name: 'Net Profit', data: Object.values(data) }],
                xaxis: { categories: Object.keys(data) }
            });
        }

        // Income Tabs Event Listeners
        document.querySelector('#income_statement_daily-tab').addEventListener('click', function () {
            updateIncomeChart(incomeDaily);
        });

        document.querySelector('#income_statement_weekly-tab').addEventListener('click', function () {
            updateIncomeChart(incomeWeekly);
        });

        document.querySelector('#income_statement_monthly-tab').addEventListener('click', function () {
            updateIncomeChart(incomeMonthly);
        });

        document.querySelector('#income_statement_yearly-tab').addEventListener('click', function () {
            updateIncomeChart(incomeYearly);
        });

        // ===== TOP VENDORS CHART =====
        const top_vendor_options = {
            series: [{
                name: 'Net Profit',
                data: Object.values(topVendorsDaily)
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: true, tools: { download: false } }
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
            colors: generateAlternatingColors(Object.keys(topVendorsDaily).length),
            dataLabels: { enabled: false },
            stroke: { show: true, width: 2, colors: ['transparent'] },
            xaxis: {
                categories: Object.keys(topVendorsDaily)
            },
            yaxis: {
                title: { text: 'Total Sales' }
            },
            legend: { show: false },
            fill: { opacity: 1 },
            tooltip: {
                y: {
                    formatter: function (val) {
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
                series: [{ name: 'Net Profit', data: values }],
                xaxis: { categories: labels },
                colors: generateAlternatingColors(labels.length),
                legend: { show: false }
            });
        }

        // Vendor Tabs Event Listeners
        document.querySelector('#top_vendors_daily-tab').addEventListener('click', function () {
            updateVendorChart(topVendorsDaily);
        });

        document.querySelector('#top_vendors_weekly-tab').addEventListener('click', function () {
            updateVendorChart(topVendorsWeekly);
        });

        document.querySelector('#top_vendors_monthly-tab').addEventListener('click', function () {
            updateVendorChart(topVendorsMonthly);
        });

        document.querySelector('#top_vendors_yearly-tab').addEventListener('click', function () {
            updateVendorChart(topVendorsYearly);
        });

        // Set default chart data on page load
        document.addEventListener('DOMContentLoaded', () => {
            updateVendorChart(topVendorsDaily);
        });
    </script>
@endsection
