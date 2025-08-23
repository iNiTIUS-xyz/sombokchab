@extends('vendor.vendor-master')
@section('site-title')
    {{ __('Dashboard') }}
@endsection
@section('style')
    <x-media.css />
    <x-datatable.css />
    <x-bulk-action.css />

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
                                <div class="col-md-12">
                                    <h3 class="my-3">Financial Summary</h3>
                                </div>
                            </div>
                            <div class="row g-5 mt-2">
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="financial_summary_daily-tab"
                                                data-bs-toggle="tab" type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_weekly-tab" data-bs-toggle="tab"
                                                type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_monthly-tab" data-bs-toggle="tab"
                                                type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_yearly-tab" data-bs-toggle="tab"
                                                type="button">Yearly</button>
                                        </li>
                                    </ul>
                                    <div class="mt-3" id="financial_summary_chart"></div>
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
                                            <button class="nav-link" id="top_vendors_two_monthly-tab" data-bs-toggle="tab"
                                                type="button">
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
                                    <a href="#" class="text-primary">View All</a>
                                </div>
                            </div>
                            <div class="row g-5">
                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <span class="badge badge-custom">
                                            Total Tickets:
                                            {{ $supportTickets['all_tickets']->count() }}
                                        </span>
                                        <span class="badge badge-custom">
                                            Total Open Tickets:
                                            {{ $supportTickets['all_open_tickets']->count() }}
                                        </span>
                                        <span class="badge badge-custom">
                                            Total Close Tickets:
                                            {{ $supportTickets['all_close_tickets']->count() }}
                                        </span>

                                        <span class="badge badge-custom">
                                            Total High Priority Tickets:
                                            {{ $supportTickets['all_high_tickets']->count() }}
                                        </span>

                                        <span class="badge badge-custom">
                                            Total Low Priority Tickets:
                                            {{ $supportTickets['all_low_tickets']->count() }}
                                        </span>
                                        <span class="badge badge-custom">
                                            Total Medium Priority Tickets:
                                            {{ $supportTickets['all_medium_tickets']->count() }}
                                        </span>
                                    </div>
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

    <x-datatable.js />
    <x-media.js />
    <x-table.btn.swal.js />

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
