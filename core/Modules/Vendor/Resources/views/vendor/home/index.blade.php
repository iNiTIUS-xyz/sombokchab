@extends('vendor.vendor-master')

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
    </style>
@endsection

@section('content')
    <div class="row">
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
                                            <button class="nav-link" id="financial_summary_weekly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Weekly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_monthly-tab" data-bs-toggle="tab"
                                                type="button">
                                                Monthly
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="financial_summary_yearly-tab" data-bs-toggle="tab"
                                                type="button">
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
                                        <li class="nav-item">
                                            <input type="text" class="form-control dateFinancialSummaryRange"
                                                id="vendor_sign_up">
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
    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

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
                    width: 3,
                    curve: 'smooth'
                },
                markers: {
                    size: 4
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
                    url: '{{ route('vendor.income.data') }}',
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

                let chartTitle = '';
                if (chartType.toLowerCase() === 'daily') {
                    chartTitle = 'Last 7 Days';
                } else {
                    chartTitle = chartType.charAt(0).toUpperCase() + chartType.slice(1);
                }

                chart.updateOptions({
                    series: [{
                        name: 'Net Profit',
                        data: values
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
                    xaxis: {
                        categories: labels
                    },
                    title: {
                        text: 'Order Revenue - ' + chartTitle
                    },
                    stroke: {
                        show: true,
                        width: 3,
                        curve: 'smooth'
                    },
                    markers: {
                        size: 4
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let currentType = 'daily';
            let currentStartDate = null;
            let currentEndDate = null;

            function generateAlternatingColors(count) {
                const colors = ['#41695a', '#609C78'];
                return Array.from({
                    length: count
                }, (_, i) => colors[i % colors.length]);
            }

            let chartOptions = {
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
                            return value && value.length > 15 ? value.substring(0, 15) + '...' : value ||
                                '';
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

            let chart = new ApexCharts(document.querySelector("#top_vendors_two_chart"), chartOptions);
            chart.render();

            function fetchVendorData(type, startDate = null, endDate = null) {
                chart.updateOptions({
                    title: {
                        text: 'Loading data...'
                    }
                });

                const requestData = {
                    type
                };
                if (startDate && endDate) {
                    requestData.start_date = startDate;
                    requestData.end_date = endDate;
                }

                $.ajax({
                    url: '{{ route('vendor.products.data') }}',
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

            function updateChart(data, chartType) {
                const labels = Object.keys(data);
                const values = Object.values(data).map(val => parseInt(val) || 0);

                let chartTitle = 'Top Selling Products';
                if (chartType.toLowerCase() === 'daily') {
                    chartTitle += ' - Last 7 Days';
                } else {
                    chartTitle += ` - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}`;
                }

                chart.updateOptions({
                    series: [{
                        name: 'Total Sold',
                        data: values
                    }],
                    xaxis: {
                        categories: labels
                    },
                    colors: generateAlternatingColors(labels.length),
                    title: {
                        text: chartTitle
                    },
                    legend: {
                        show: false
                    }
                });
            }

            document.querySelector('#top_vendors_two_daily-tab').addEventListener('click', function() {
                currentType = 'daily';
                fetchVendorData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#top_vendors_two_weekly-tab').addEventListener('click', function() {
                currentType = 'weekly';
                fetchVendorData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#top_vendors_two_monthly-tab').addEventListener('click', function() {
                currentType = 'monthly';
                fetchVendorData(currentType, currentStartDate, currentEndDate);
            });

            document.querySelector('#top_vendors_two_yearly-tab').addEventListener('click', function() {
                currentType = 'yearly';
                fetchVendorData(currentType, currentStartDate, currentEndDate);
            });

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
                fetchVendorData(currentType, currentStartDate, currentEndDate);
            });

            fetchVendorData(currentType);
        });
    </script>
@endsection
