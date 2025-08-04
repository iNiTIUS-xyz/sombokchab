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
        <div class="row g-4 justify-content-center">
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
        </div>

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
    </div>
@endsection

@section('script')

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var income_statement_options = {
            series: [{
                name: 'Net Profit',
                data: [10, 20, 15, 30, 25, 20, 18]
            }],
            chart: {
                type: 'bar',
                height: 350,
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
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
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
                    formatter: function (val) {
                        return "$ " + val + " USD"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#income_statement_chart"), income_statement_options);
        chart.render();

        // Update Chart Data on Tab Click
        document.querySelector('#income_statement_daily-tab').addEventListener('click', function () {
            chart.updateOptions({
                series: [{ name: 'Net Profit', data: [10, 20, 15, 30, 25, 20, 18] }],
                xaxis: { categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] }
            });
        });

        document.querySelector('#income_statement_weekly-tab').addEventListener('click', function () {
            chart.updateOptions({
                series: [{ name: 'Net Profit', data: [100, 120, 90, 110] }],
                xaxis: { categories: ['Week 1', 'Week 2', 'Week 3', 'Week 4'] }
            });
        });

        document.querySelector('#income_statement_monthly-tab').addEventListener('click', function () {
            chart.updateOptions({
                series: [{ name: 'Net Profit', data: [
                    100, 90, 95, 110, 105, 115, 120, 98, 102, 108,
                    111, 99, 103, 107, 113, 109, 104, 112, 118, 125,
                    130, 119, 117, 116, 114, 121, 123, 126, 127, 129
                ] }],
                xaxis: { categories: Array.from({ length: 30 }, (_, i) => (i + 1).toString()) }
            });
        });

        document.querySelector('#income_statement_yearly-tab').addEventListener('click', function () {
            chart.updateOptions({
                series: [{ name: 'Net Profit', data: [500, 620, 580, 710, 600, 300] }],
                xaxis: { categories: ['2020', '2021', '2022', '2023', '2024', '2025'] }
            });
        });
    </script>

    <script>
        function generateAlternatingColors(length) {
            const red = '#e74c3c';
            const blue = '#3498db';
            return Array.from({ length }, (_, i) => i % 2 === 0 ? red : blue);
        }

        const dailyData = [10, 20, 15, 30, 25, 20, 18];
        const weeklyData = [100, 120, 90, 110];
        const monthlyData = [
            100, 90, 95, 110, 105, 115, 120, 98, 102, 108,
            111, 99, 103, 107, 113, 109, 104, 112, 118, 125,
            130, 119, 117, 116, 114, 121, 123, 126, 127, 129
        ];
        const yearlyData = [500, 620, 580, 710, 600, 300];

        const top_vendor_options = {
            series: [{
                name: 'Net Profit',
                data: dailyData
            }],
            chart: {
                type: 'bar',
                height: 350,
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
            colors: generateAlternatingColors(dailyData.length),
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            },
            yaxis: {
                title: {
                    text: 'Total'
                }
            },
            legend: {
                show: false // ✅ Hide the color legend
            },
            fill: {
                opacity: 1
            },
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

        // Tab click events
        document.querySelector('#top_vendors_daily-tab').addEventListener('click', function () {
            top_vendor_chart.updateOptions({
                series: [{ name: 'Net Profit', data: dailyData }],
                xaxis: { categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] },
                colors: generateAlternatingColors(dailyData.length),
                legend: { show: false }
            });
        });

        document.querySelector('#top_vendors_weekly-tab').addEventListener('click', function () {
            top_vendor_chart.updateOptions({
                series: [{ name: 'Net Profit', data: weeklyData }],
                xaxis: { categories: ['Week 1', 'Week 2', 'Week 3', 'Week 4'] },
                colors: generateAlternatingColors(weeklyData.length),
                legend: { show: false }
            });
        });

        document.querySelector('#top_vendors_monthly-tab').addEventListener('click', function () {
            top_vendor_chart.updateOptions({
                series: [{ name: 'Net Profit', data: monthlyData }],
                xaxis: { categories: Array.from({ length: 30 }, (_, i) => (i + 1).toString()) },
                colors: generateAlternatingColors(monthlyData.length),
                legend: { show: false }
            });
        });

        document.querySelector('#top_vendors_yearly-tab').addEventListener('click', function () {
            top_vendor_chart.updateOptions({
                series: [{ name: 'Net Profit', data: yearlyData }],
                xaxis: { categories: ['2020', '2021', '2022', '2023', '2024', '2025'] },
                colors: generateAlternatingColors(yearlyData.length),
                legend: { show: false }
            });
        });
    </script>

@endsection