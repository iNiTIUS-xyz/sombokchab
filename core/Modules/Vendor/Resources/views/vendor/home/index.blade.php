@extends('vendor.vendor-master')

@section('site-title')
    {{ __('Dashboard') }}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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


        /* Toolbar pan (hand) icon color */
        .apexcharts-toolbar .apexcharts-pan-icon svg {
            stroke: #41695a !important;
            fill: #41695a !important;
        }


        /* Base track */
        #vendor_top_product_scroll,
        #financial_summary_scroll {
            -webkit-appearance: none;
            appearance: none;
            height: 6px;
            border-radius: 4px;
            background: #e9ecef;
            outline: none;
        }

        /* WebKit thumb */
        #vendor_top_product_scroll::-webkit-slider-thumb,
        #financial_summary_scroll::-webkit-slider-thumb {
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
        #vendor_top_product_scroll::-moz-range-thumb,
        #financial_summary_scroll::-moz-range-thumb {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #41695a;
            border: 2px solid #2f4f45;
            cursor: pointer;
        }

        /* Firefox track */
        #vendor_top_product_scroll::-moz-range-track,
        #financial_summary_scroll::-moz-range-track {
            height: 6px;
            border-radius: 4px;
            background: #e9ecef;
        }

        /* Focus ring */
        #vendor_top_product_scroll:focus-visible,
        #financial_summary_scroll:focus-visible {
            outline: 2px solid rgba(65, 105, 90, .35);
            outline-offset: 2px;
        }

        #vendor_top_product_nav,
        #financial_summary_nav {
            display: none;
        }

        /* tilt values drawn on top of bars */
        /* Make all bar values vertical */
        #vendor_top_product_chart .apexcharts-datalabel,
        #financial_summary_chart .apexcharts-datalabel {
            transform: rotate(-90deg) !important;
            transform-origin: center center !important;
            transform-box: fill-box !important;
        }

        .date_range_picker {
            height: 48px !important;
            padding: 0 20px 0 20px !important;
            text-align: center !important;
            border: none;
            padding: 0px !important;
            margin: 0px !important;
            font-weight: 500;
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
                                            <input type="text" class="form-control date_range_picker"
                                                id="financial_summary_picker" />
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="financial_summary_chart"></div>
                                        <!-- scrollbar -->
                                        <input id="financial_summary_scroll" class="form-range mt-2 w-100" type="range"
                                            min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="financial_summary_nav" style="height:110px;"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
                                </div>

                                <!-- ==================== TOP SELLING PRODUCTS (VENDOR) ==================== -->
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="vendor_top_product_daily-tab" type="button">Daily</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="vendor_top_product_weekly-tab" type="button">Weekly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="vendor_top_product_monthly-tab" type="button">Monthly</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="vendor_top_product_yearly-tab" type="button">Yearly</button>
                                        </li>
                                        <li class="nav-item">
                                            <input type="text" class="form-control date_range_picker" id="vendor_top_product_picker" />
                                        </li>
                                    </ul>

                                    <div class="mt-3 position-relative">
                                        <div id="vendor_top_product_chart"></div>
                                        <input id="vendor_top_product_scroll" class="form-range mt-2 w-100" type="range" min="0" max="0" value="0" step="1" />
                                    </div>
                                    <div class="mt-2" id="vendor_top_product_nav" style="height:110px;"></div>
                                    <small>Ctrl/⌘ + wheel to zoom in and zoom out</small>
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
                            <h3 class="my-3">Vendor Support</h3>
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
                                            Total Closed Tickets:
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
    <script src="//cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // 1) Initialize ALL your pickers with autoUpdateInput: false
        $('.date_range_picker').daterangepicker({
            opens: 'left',
            autoUpdateInput: false, // ← stop autofill
            minDate: moment('2024-01-01'),
            maxDate: moment().endOf('year')
        });

        // 2) After init, force the placeholder (run AFTER all inits)
        $(window).on('load', function() {
            $('.date_range_picker').val('').attr('placeholder', 'Custom date range');
        });

        // 3) When the user picks a range, set the value yourself
        $('.date_range_picker').on('apply.date_range_picker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        // 4) If you need to enforce a minimum span, do it on apply (NOT in the init callback)
        $('.date_range_picker').on('apply.date_range_picker', function(ev, picker) {
            const minDays = 1; // example: at least 1 day
            if (picker.endDate.diff(picker.startDate, 'months', true) < 1) {
                picker.setEndDate(picker.startDate.clone().add(1, 'months'));
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            }
        });

        // 5) Optional: handle clear/cancel to restore placeholder
        $('.date_range_picker').on('cancel.date_range_picker', function() {
            $(this).val('').attr('placeholder', 'Custom date range');
        });
    </script>

    {{-- Order Revenue --}}
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
                        position: 'bottom', // 👈 keep near bottom (for vertical bars)
                        offsetY: 20, // 👈 moves up from the x-axis baseline
                        background: {
                            enabled: false
                        },
                        style: {
                            colors: ['#000'],
                            fontWeight: 400,
                            fontSize: '10px',
                            // rotate: -45   // 👈 tilt the numbers
                        },
                        formatter: (v) => `$ ${v.toFixed(2)}`
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
                            formatter: (val) => `$ ${val.toFixed(2)} USD`
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
                    // Clear old data and navigator
                    rawLabels = [];
                    values = [];
                    displayLabels = [];
                    visibleLabels = [];
                    if (nav) {
                        nav.destroy();
                        nav = null;
                    }

                    // Populate new data
                    Object.keys(payload).forEach(k => {
                        rawLabels.push(k);
                        values.push(parseFloat(payload[k]) || 0.0);
                    });

                    // Format display labels
                    displayLabels = rawLabels.map(k => {
                        if (chartType === 'daily') {
                            return moment(k, 'YYYY-MM-DD', true).isValid()
                                ? moment(k, 'YYYY-MM-DD').format('DD, MMM YY')
                                : k;
                        }
                        return k; // weekly, monthly, yearly already humanized
                    });

                    // Update main chart (hard refresh)
                    chart.updateOptions({
                        title: {
                            text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}`
                        },
                        xaxis: {
                            categories: displayLabels
                        },
                        series: [{
                            name: seriesName,
                            data: values
                        }]
                    }, true, true);

                    // Reset viewport & rebuild navigator
                    labels = rawLabels.slice();
                    vMin = 0;
                    vMax = Math.min(values.length - 1, 60);
                    applyViewport(vMin, vMax);
                    renderNav();
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
                    autoUpdateInput: false,
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

            // ===== Order Revenue =====
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
            url: '{{ route('vendor.income.data') }}',
            seriesName: 'Order Revenue',
            titleBase: 'Order Revenue'
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        // ---------- tiny helpers ----------
        const clamp = (n, lo, hi) => Math.min(hi, Math.max(lo, n));

        /**
         * Generic brush + scrollbar bar chart (admin-style)
         * Used here for: Vendor Top Products
         */
        function makeBrushBarChart({
            ids,           // { main, nav, scroll, picker, tabs: { daily, weekly, monthly, yearly } }
            url,           // endpoint
            seriesName,    // e.g., "Units Sold"
            titleBase,     // e.g., "Top Selling Products"
            isTopChart = true,
            unit = 'items' // suffix for values
        }) {
            // current state
            let currentType = 'daily';
            let currentStartDate = null;
            let currentEndDate = null;

            // full data (all buckets)
            let rawLabels = [];     // API keys (daily: YYYY-MM-DD; weekly: "W##, Mon-YYYY"; etc.)
            let displayLabels = []; // human-friendly labels that match rawLabels index
            let topNames = [];      // product names (when isTopChart)
            let values = [];        // numeric values per bucket

            // the visible window [vMin..vMax]
            let vMin = 0, vMax = 0;

            // DOM
            const elMain   = document.getElementById(ids.main);
            const elNav    = document.getElementById(ids.nav);
            const elScroll = document.getElementById(ids.scroll);

            // ----- Tabs Active UI -----
            const tabIds = [ids.tabs.daily, ids.tabs.weekly, ids.tabs.monthly, ids.tabs.yearly];
            function setActiveTabUI(type) {
            const map = {
                daily:   ids.tabs.daily,
                weekly:  ids.tabs.weekly,
                monthly: ids.tabs.monthly,
                yearly:  ids.tabs.yearly
            };
            tabIds.forEach(id => {
                const btn = document.getElementById(id);
                if (!btn) return;
                btn.classList.toggle('active', id === map[type]);
                btn.setAttribute('aria-selected', id === map[type] ? 'true' : 'false');
            });
            }

            // ----- Main chart -----
            const mainOpts = {
            series: [{ name: seriesName, data: [] }],
            chart: {
                id: ids.main + '_chart',
                type: 'bar',
                height: 350,
                background: '#ffffff',
                toolbar: { show: false },
                animations: { easing: 'easeinout', speed: 180 }
            },
            title: { text: titleBase, align: 'left' },
            colors: ['#e0bb20'],
            grid: { padding: { left: 2, right: 2 } },
            plotOptions: {
                bar: { columnWidth: '18%', borderRadius: 6, distributed: false }
            },
            dataLabels: {
                enabled: true,
                position: 'bottom',
                offsetY: 20,
                background: { enabled: false },
                style: { colors: ['#000'], fontWeight: 400, fontSize: '10px', rotate: -90 },
                formatter: (val) => `${val} ${unit}`
            },
            xaxis: {
                type: 'category',
                categories: [],
                tickPlacement: 'on',
                rangePadding: 'none',
                labels: { rotate: -90, rotateAlways: true, trim: false, hideOverlappingLabels: false }
            },
            yaxis: { title: { text: seriesName } },
            tooltip: {
                custom: ({ series, seriesIndex, dataPointIndex, w }) => {
                const val   = series[seriesIndex][dataPointIndex];
                const label = w.globals.labels[dataPointIndex] ?? '';
                const name  = topNames[dataPointIndex] || 'Unknown';
                return `<div style="padding:6px 8px;">
                    <strong>${name}</strong><br>
                    ${label}<br>
                    Total: ${val} ${unit}
                </div>`;
                }
            }
            };

            const chart = new ApexCharts(elMain, mainOpts);
            chart.render();

            // ----- Navigator (mini area) -----
            let nav = null;

            function renderNav() {
            if (nav) nav.destroy();

            // numeric x for nav
            const navData = values.map((y, i) => ({ x: i, y }));

            // default window up to 60 bars
            vMin = 0;
            vMax = Math.max(0, Math.min(values.length - 1, 60));

            nav = new ApexCharts(elNav, {
                chart: {
                id: ids.nav + '_chart',
                height: 110,
                type: 'area',
                toolbar: { show: false },
                animations: { enabled: false },
                selection: { enabled: true, xaxis: { min: vMin, max: vMax } },
                events: {
                    selection: (ctx, { xaxis }) => {
                    const minI = clamp(Math.round(xaxis.min), 0, Math.max(0, values.length - 1));
                    const maxI = clamp(Math.round(xaxis.max), 0, Math.max(0, values.length - 1));
                    applyViewport(minI, maxI, { from: 'nav' });
                    }
                }
                },
                colors: ['#e0bb20'],
                stroke: { width: 1, colors: ['#e0bb20'] },
                series: [{ name: 'Range', data: navData }],
                xaxis: { type: 'numeric', labels: { show: false }, tooltip: { enabled: false } },
                yaxis: { show: false },
                dataLabels: { enabled: false },
                fill: { opacity: 0.2 }
            });

            nav.render();
            // Paint first window
            applyViewport(vMin, vMax);
            updateScrollbar();
            }

            // ----- Viewport slice -> update main chart -----
            function applyViewport(minI, maxI, { from = 'code' } = {}) {
            vMin = Math.max(0, Math.min(minI, maxI));
            vMax = Math.max(0, Math.max(minI, maxI));

            const windowVals   = values.slice(vMin, vMax + 1);
            const windowLabels = displayLabels.slice(vMin, vMax + 1);

            chart.updateOptions({
                series: [{ name: seriesName, data: windowVals }],
                xaxis:  { categories: windowLabels }
            }, false, false);

            if (nav && from !== 'nav') {
                nav.updateOptions({
                chart: { selection: { enabled: true, xaxis: { min: vMin, max: vMax } } }
                }, false, false);
            }

            if (from !== 'scroll') updateScrollbar();
            }

            // ----- Scrollbar -----
            function updateScrollbar() {
            const windowSize = Math.max(1, vMax - vMin + 1);
            const maxLeft = Math.max(0, rawLabels.length - windowSize);
            elScroll.max = String(maxLeft);
            elScroll.step = '1';
            elScroll.value = String(clamp(vMin, 0, maxLeft));
            elScroll.disabled = (maxLeft === 0);
            elScroll.title = 'Scroll to pan. Hold Ctrl/Cmd + Wheel to zoom. Wheel to pan.';
            }

            elScroll.addEventListener('input', () => {
            const windowSize = Math.max(1, vMax - vMin + 1);
            const left = parseInt(elScroll.value || '0', 10);
            applyViewport(left, left + windowSize - 1, { from: 'scroll' });
            });

            // ----- Wheel zoom/pan on main (optional; safe to keep) -----
            elMain.addEventListener('wheel', (e) => {
            if (!rawLabels.length) return;
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
                newWindow = clamp(newWindow, 5, Math.max(10, Math.ceil(rawLabels.length * 0.9)));
                const half = Math.floor(newWindow / 2);
                let newMin = clamp(centerIdx - half, 0, Math.max(0, rawLabels.length - newWindow));
                let newMax = newMin + newWindow - 1;
                applyViewport(newMin, newMax);
            } else {
                // PAN
                const panStep = Math.max(1, Math.round((vMax - vMin + 1) * 0.1));
                const dir = delta > 0 ? 1 : -1;
                const newMin = clamp(vMin + dir * panStep, 0, Math.max(0, rawLabels.length - (vMax - vMin + 1)));
                const newMax = newMin + (vMax - vMin);
                applyViewport(newMin, newMax);
            }
            }, { passive: false });

            // Double-click to reset view
            elMain.addEventListener('dblclick', () => {
            const fullMax = Math.max(0, rawLabels.length - 1);
            const initialMax = Math.min(fullMax, 60);
            applyViewport(0, initialMax);
            });

            // ----- Fetch + ingest -----
            function fetchData(type, startDate = null, endDate = null) {
            setActiveTabUI(type);
            chart.updateOptions({ title: { text: 'Loading…' } });

            const params = { type };
            if (startDate && endDate) {
                params.start_date = startDate;
                params.end_date = endDate;
            }

            $.ajax({
                url,
                type: 'GET',
                data: params,
                success: (payload) => ingest(payload, type),
                error:   () => chart.updateOptions({ title: { text: 'Error loading data' } })
            });
            }

            function ingest(payload, chartType) {
            // reset
            rawLabels = [];
            displayLabels = [];
            topNames = [];
            values = [];

            // keep insertion order
            const seen = new Set();
            Object.keys(payload).forEach(k => {
                if (seen.has(k)) return;
                seen.add(k);

                const row = payload[k];
                // Expect { name: "Product", value: N } per bucket (same as admin)
                if (isTopChart && row && typeof row === 'object' && 'value' in row) {
                rawLabels.push(k);
                displayLabels.push(
                    (chartType === 'daily' && moment(k, 'YYYY-MM-DD', true).isValid())
                    ? moment(k, 'YYYY-MM-DD').format('DD, MMM YY')
                    : k
                );
                topNames.push(row.name || 'None');
                values.push(parseInt(row.value) || 0);
                } else {
                // fallback if API returns plain numbers
                rawLabels.push(k);
                displayLabels.push(k);
                topNames.push('');
                values.push(parseInt(row) || 0);
                }
            });

            chart.updateOptions({
                title: { text: `${titleBase} - ${chartType.charAt(0).toUpperCase() + chartType.slice(1)}` }
            });

            // rebuild nav + viewport
            renderNav();
            }

            // ----- Tab handlers -----
            document.getElementById(ids.tabs.daily)?.addEventListener('click', () => {
            currentType = 'daily';
            fetchData(currentType, currentStartDate, currentEndDate);
            });
            document.getElementById(ids.tabs.weekly)?.addEventListener('click', () => {
            currentType = 'weekly';
            fetchData(currentType, currentStartDate, currentEndDate);
            });
            document.getElementById(ids.tabs.monthly)?.addEventListener('click', () => {
            currentType = 'monthly';
            fetchData(currentType, currentStartDate, currentEndDate);
            });
            document.getElementById(ids.tabs.yearly)?.addEventListener('click', () => {
            currentType = 'yearly';
            fetchData(currentType, currentStartDate, currentEndDate);
            });

            // ----- Date Range Picker -----
            // (Uses the same class you already have; but binds specifically to this input's id)
            const $picker = $('#' + ids.picker);
            $picker.daterangepicker({
            opens: 'left',
            autoUpdateInput: false,
            minDate: moment('2024-01-01'),
            maxDate: moment().endOf('year')
            });

            // display chosen range in the input + refetch
            $picker.on('apply.daterangepicker', function (ev, picker) {
            currentStartDate = picker.startDate.format('YYYY-MM-DD');
            currentEndDate   = picker.endDate.format('YYYY-MM-DD');
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            fetchData(currentType, currentStartDate, currentEndDate);
            });

            $picker.on('cancel.daterangepicker', function () {
            $(this).val('').attr('placeholder', 'Custom Date Range');
            // optional: clear the filter and reload the default window
            currentStartDate = currentEndDate = null;
            fetchData(currentType);
            });

            // ----- First load -----
            setActiveTabUI('daily');
            fetchData(currentType);

            // Expose manual refresh if you need later
            return {
            refresh: () => fetchData(currentType, currentStartDate, currentEndDate)
            };
        }

        // ===== Mount: Vendor Top Products =====
        makeBrushBarChart({
            ids: {
            main:   'vendor_top_product_chart',
            nav:    'vendor_top_product_nav',
            scroll: 'vendor_top_product_scroll',
            picker: 'vendor_top_product_picker',
            tabs: {
                daily:   'vendor_top_product_daily-tab',
                weekly:  'vendor_top_product_weekly-tab',
                monthly: 'vendor_top_product_monthly-tab',
                yearly:  'vendor_top_product_yearly-tab',
            }
            },
            url: '{{ route('vendor.products.data') }}', // keep exactly as in your page
            seriesName: 'Units Sold',
            titleBase: 'Top Selling Products',
            isTopChart: true,
            unit: 'items'
        });

        });
    </script>

@endsection
