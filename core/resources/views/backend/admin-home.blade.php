@extends('backend.admin-master')

@section('site-title')
    {{ __('Dashboard') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 mb-3">
        <div class="row">
            <div class="col-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__body">
                        <div class="row g-5">
                            <div class="col-md-6">
                                <h3 class="my-3">Financial Summary</h3>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="#" class="text-warning">View All</a>
                            </div>
                            <div class="col-md-6">
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
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-ml-12 mb-3">
        <div class="row">
            <div class="col-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__body">
                        <div class="row g-5">
                            <div class="col-md-6">
                                <h3 class="my-3">Campaign Stats</h3>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="#" class="text-warning">View All</a>
                            </div>
                            <div class="col-md-6">
                                <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="campaign_daily-tab" data-bs-toggle="tab" type="button">
                                            Daily
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="campaign_weekly-tab" data-bs-toggle="tab" type="button">
                                            Weekly
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="campaign_monthly-tab" data-bs-toggle="tab" type="button">
                                            Monthly
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="campaign_yearly-tab" data-bs-toggle="tab" type="button">
                                            Yearly
                                        </button>
                                    </li>
                                </ul>
                                <div class="mt-3" id="campaign_chart"></div>
                            </div>
                            <div class="col-md-6">
                                <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="campaign_two_daily-tab" data-bs-toggle="tab" type="button">
                                            Daily
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="campaign_two_weekly-tab" data-bs-toggle="tab" type="button">
                                            Weekly
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="campaign_two_monthly-tab" data-bs-toggle="tab" type="button">
                                            Monthly
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="campaign_two_yearly-tab" data-bs-toggle="tab" type="button">
                                            Yearly
                                        </button>
                                    </li>
                                </ul>
                                <div class="mt-3" id="campaign_two_chart"></div>
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
                        <div class="row g-5">
                            <div class="col-md-6">
                                <h3 class="my-3">Analytics</h3>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="#" class="text-warning">View All</a>
                            </div>
                            <div class="col-md-6">
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
                                <div class="text-center">
                                    <div class="mt-3" id="analytics_chart"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-ml-12 mb-3">
        <div class="row">
            <div class="col-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__body">
                        <div class="row g-5">
                            <div class="col-md-6">
                                <h3 class="my-3">Webstie Stats</h3>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="#" class="text-warning">View All</a>
                            </div>
                            <div class="col-md-6">
                                <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="webstie_daily-tab" data-bs-toggle="tab" type="button">
                                            Daily
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="webstie_weekly-tab" data-bs-toggle="tab" type="button">
                                            Weekly
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="webstie_monthly-tab" data-bs-toggle="tab" type="button">
                                            Monthly
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="webstie_yearly-tab" data-bs-toggle="tab" type="button">
                                            Yearly
                                        </button>
                                    </li>
                                </ul>
                                <div class="text-center">
                                    <div class="mt-3" id="webstie_chart"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="webstie_two_daily-tab" data-bs-toggle="tab" type="button">
                                            Daily
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="webstie_two_weekly-tab" data-bs-toggle="tab" type="button">
                                            Weekly
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="webstie_two_monthly-tab" data-bs-toggle="tab" type="button">
                                            Monthly
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="webstie_two_yearly-tab" data-bs-toggle="tab" type="button">
                                            Yearly
                                        </button>
                                    </li>
                                </ul>
                                <div class="mt-3" id="webstie_chart_two"></div>
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
            return Array.from({ length }, (_, i) => i % 2 === 0 ? colorOne : colorTwo);
        }

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
            title: {
                text: 'Order Revenue.',
                align: 'left'
            },
            colors: ['#41695a'],
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
            title: {
                text: 'Top Seeling Vendor',
                align: 'left'
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

    <script>
        var campaign_options = {
        series: [44, 55, 41, 17],
        labels: ["Flash Campaign", "Eid Campaign", "New Arival", "Best Sales"],
        chart: {
            width: 380,
            type: 'donut',
        },
        plotOptions: {
            pie: {
                startAngle: -90,
                endAngle: 270
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'gradient',
        },
        legend: {
            formatter: function(val, opts) {
                return val + " - " + opts.w.globals.series[opts.seriesIndex]
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
        };

        var campaign_chart = new ApexCharts(document.querySelector("#campaign_chart"), campaign_options);
        campaign_chart.render();
    </script>

    <script>
         var campaign_two_options = {
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
                columnWidth: '15%',
                borderRadius: 5,
                borderRadiusApplication: 'end'
            },
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

        var campaign_two_chart = new ApexCharts(document.querySelector("#campaign_two_chart"), campaign_two_options);
        campaign_two_chart.render();
    </script>


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
        title: {
            text: 'Sign up converstaion rate.',
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
                columnWidth: '15%',
                borderRadius: 5,
                borderRadiusApplication: 'end'
            },
        },
        title: {
            text: 'Download Status',
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
         var webstie_chart_two_options = {
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
                columnWidth: '15%',
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
          y:{
            formatter: function (val) {
                return "$ " + val + " thousands"
            }
        }
        }};

        var webstie_chart_two_chart = new ApexCharts(document.querySelector("#webstie_chart_two"), webstie_chart_two_options);
        webstie_chart_two_chart.render();
    </script>

    <script>
        var website_stars_options = {
            series: [{
                name: "Desktops",
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
            }],
            chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
            },
            dataLabels: {
            enabled: false
            },
            stroke: {
            curve: 'straight'
            },
            title: {
            text: 'Product Trends by Month',
            align: 'left'
            },
            grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
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

@endsection
