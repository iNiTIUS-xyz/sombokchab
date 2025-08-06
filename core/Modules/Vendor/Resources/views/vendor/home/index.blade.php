@extends('vendor.vendor-master')
@section('site-title')
    {{ __('Dashboard') }}
@endsection
@section('style')
    <x-media.css />
    <x-datatable.css />
    <x-bulk-action.css />
@endsection

@section('content')
    <div class="dashboard-profile-inner">
        <div class="row g-4 justify-content-center">
            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para ff-rubik"> {{ __('Current Balance') }} </span>
                            <h2 class="order-titles"> {{ float_amount_with_currency_symbol($current_balance) }} </h2>
                        </div>
                        <div class="icon">
                            <i class="las la-tasks"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para"> {{ __('Pending Balance') }} </span>
                            <h2 class="order-titles"> {{ float_amount_with_currency_symbol($pending_balance) }} </h2>
                        </div>
                        <div class="icon">
                            <i class="las la-file-invoice-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">

                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para ff-rubik"> {{ __('Order Completed Balance') }} </span>
                            <h2 class="order-titles"> {{ float_amount_with_currency_symbol($total_complete_order_amount) }}
                            </h2>
                        </div>
                        <div class="icon">
                            <i class="las la-handshake"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para ff-rubik"> {{ __('Total Earning') }} </span>
                            <h2 class="order-titles"> {{ float_amount_with_currency_symbol($total_order_amount) }} </h2>
                        </div>
                        <div class="icon">
                            <i class="las la-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para"> {{ __('Total Product') }} </span>
                            <h2 class="order-titles"> {{ $total_product }} </h2>
                        </div>
                        <div class="icon">
                            <i class="las la-file-invoice-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">

                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para ff-rubik"> {{ __('Total Campaign') }} </span>
                            <h2 class="order-titles"> {{ $totalCampaign }} </h2>
                        </div>
                        <div class="icon">
                            <i class="las la-handshake"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para ff-rubik"> {{ __('Total Order') }} </span>
                            <h2 class="order-titles"> {{ $totalOrder }} </h2>
                        </div>
                        <div class="icon">
                            <i class="las la-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <span class="order-para ff-rubik"> {{ __('Success Order') }} </span>
                            <h2 class="order-titles"> {{ $successOrder }} </h2>
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
                <h3 class="my-3">Financial Summary</h3>
                <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="financial_summary_daily-tab" data-bs-toggle="tab" type="button">Daily</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="financial_summary_weekly-tab" data-bs-toggle="tab" type="button">Weekly</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="financial_summary_monthly-tab" data-bs-toggle="tab" type="button">Monthly</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="financial_summary_yearly-tab" data-bs-toggle="tab" type="button">Yearly</button>
                    </li>
                </ul>
                <div class="mt-3" id="financial_summary_chart"></div>
            </div>
            <div class="col-md-6">
                <h3 class="my-3">Top Vendors</h3>
                <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="top_vendors_daily-tab" data-bs-toggle="tab" type="button">Daily</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="top_vendors_weekly-tab" data-bs-toggle="tab" type="button">Weekly</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="top_vendors_monthly-tab" data-bs-toggle="tab" type="button">Monthly</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="top_vendors_yearly-tab" data-bs-toggle="tab" type="button">Yearly</button>
                    </li>
                </ul>
                <div class="mt-3" id="top_vendor_chart"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <x-datatable.js />
    <x-media.js />
    <x-table.btn.swal.js />

    <script>
        var options = {
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

        var chart = new ApexCharts(document.querySelector("#financial_summary_chart"), options);
        chart.render();

        // Update Chart Data on Tab Click
        document.querySelector('#financial_summary_daily-tab').addEventListener('click', function () {
            chart.updateOptions({
                series: [{ name: 'Net Profit', data: [10, 20, 15, 30, 25, 20, 18] }],
                xaxis: { categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] }
            });
        });

        document.querySelector('#financial_summary_weekly-tab').addEventListener('click', function () {
            chart.updateOptions({
                series: [{ name: 'Net Profit', data: [100, 120, 90, 110] }],
                xaxis: { categories: ['Week 1', 'Week 2', 'Week 3', 'Week 4'] }
            });
        });

        document.querySelector('#financial_summary_monthly-tab').addEventListener('click', function () {
            chart.updateOptions({
                series: [{ name: 'Net Profit', data: [
                    100, 90, 95, 110, 105, 115, 120, 98, 102, 108,
                    111, 99, 103, 107, 113, 109, 104, 112, 118, 125,
                    130, 119, 117, 116, 114, 121, 123, 126, 127, 129
                ] }],
                xaxis: { categories: Array.from({ length: 30 }, (_, i) => (i + 1).toString()) }
            });
        });

        document.querySelector('#financial_summary_yearly-tab').addEventListener('click', function () {
            chart.updateOptions({
                series: [{ name: 'Net Profit', data: [500, 620, 580, 710, 600, 300] }],
                xaxis: { categories: ['2020', '2021', '2022', '2023', '2024', '2025'] }
            });
        });
    </script>
    <script>
        var top_vendor_options = {
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
            colors: ['#e74c3c'],
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

        var top_vendor_chart = new ApexCharts(document.querySelector("#top_vendor_chart"), top_vendor_options);
        top_vendor_chart.render();

        // Update Chart Data on Tab Click
        document.querySelector('#top_vendors_daily-tab').addEventListener('click', function () {
            top_vendor_chart.updateOptions({
                series: [{ name: 'Net Profit', data: [10, 20, 15, 30, 25, 20, 18] }],
                xaxis: { categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] }
            });
        });

        document.querySelector('#top_vendors_weekly-tab').addEventListener('click', function () {
            top_vendor_chart.updateOptions({
                series: [{ name: 'Net Profit', data: [100, 120, 90, 110] }],
                xaxis: { categories: ['Week 1', 'Week 2', 'Week 3', 'Week 4'] }
            });
        });

        document.querySelector('#top_vendors_monthly-tab').addEventListener('click', function () {
            top_vendor_chart.updateOptions({
                series: [{ name: 'Net Profit', data: [
                    100, 90, 95, 110, 105, 115, 120, 98, 102, 108,
                    111, 99, 103, 107, 113, 109, 104, 112, 118, 125,
                    130, 119, 117, 116, 114, 121, 123, 126, 127, 129
                ] }],
                xaxis: { categories: Array.from({ length: 30 }, (_, i) => (i + 1).toString()) }
            });
        });

        document.querySelector('#top_vendors_yearly-tab').addEventListener('click', function () {
            top_vendor_chart.updateOptions({
                series: [{ name: 'Net Profit', data: [500, 620, 580, 710, 600, 300] }],
                xaxis: { categories: ['2020', '2021', '2022', '2023', '2024', '2025'] }
            });
        });
    </script>
@endsection
