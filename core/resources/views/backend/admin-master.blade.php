<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ get_static_option('site_title') }} -
        @if (request()->path() == 'admin-home')
            {{ get_static_option('site_tag_line') }}
        @else
            @yield('site-title')
        @endif
    </title>
    @php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'), 'full', false);
    @endphp
    @include('frontend.partials.css-variable')
    @if (!empty($site_favicon))
        <link rel="icon" href="{{ $site_favicon['img_url'] }}" type="image/png">
        {!! render_favicon_by_id($site_favicon['img_url']) !!}
    @endif
    <!-- favicon -->
    <link rel=icon href="{{ asset('assets/favicon-dashboard.png') }}" sizes="16x16" type="icon/png">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap5.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- slick carousel  -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <!-- LineAwesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
    <link href="{{ asset('assets/backend/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/custom-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/toastr.css') }}">
    <script>
        window.appUrl = "{{ url('/') }}";
    </script>
    <style>
        :root {
            --app-url: "{{ url('/') }}"
        }

        .ml-5-px {
            margin-left: 5px;
        }

        .media-upload-btn-wrapper {
            display: flex !important;
            flex-direction: column !important;
            align-items: flex-start !important;
        }

        .swal2-confirm.swal2-styled.swal2-default-outline {
            background-color: var(--danger-color) !important;
        }

        #dataTable {
            width: 100%;
            text-align: left !important
        }

        #dataTable thead {
            height: 50px;
        }

        #dataTable thead,
        #dataTable thead tr,
        #dataTable thead tr th,
        #dataTable tbody,
        #dataTable tbody tr,
        #dataTable tbody tr td {
            text-align: left !important
        }

        #dataTable tbody tr td {
            padding: 5px;
        }

        .alert-success,
        .alert-danger {
            text-transform: lowercase;
        }

        .alert-success:first-letter,
        .alert-danger:first-letter {
            text-transform: uppercase;
        }

        .form-select {
            width: 100% !important;
            font-size: 14px !important;
            font-weight: 400 !important;
            line-height: 20px !important;
            color: var(--paragraph-color) !important;
            height: 48px !important;
            border: 1px solid var(--border-two) !important;
            border-radius: 5px !important;
        }

        .dt-button.buttons-excel.buttons-html5 {
            background-color: var(--main-color-one) !important;
            color: var(--white) !important;
            border: none !important;
            padding: 6px 16px !important;
            border-radius: 4px !important;
            font-weight: 600 !important;
            box-shadow: none !important;
            margin-top: 5px;
        }

        .dt-button.buttons-excel.buttons-html5:hover {
            color: var(--main-color-one) !important;
            background-color: var(--white) !important;
        }

        /* div.dt-container div.dt-layout-row div.dt-layout-cell{
            display: block !important;
        } */
        table.dataTable .dt-type-numeric span.dt-column-order {
            position: relative !important;
        }

        #dataTable thead input {
            border: 1px solid #DDD;
            width: 100%;
            box-shadow: 0 0 10px rgb(255 255 255 / 10%);
            color: var(--body-color);
            border-radius: 4px;
        }
    </style>

    @yield('style')
    @yield('pwa-header')
</head>

<body>
    <!-- Dashboard area Starts -->
    <div class="body-overlay"></div>

    <div class="dashboard-area dashboard-padding">
        <div class="container-fluid p-0">
            <div class="dashboard-contents-wrapper">
                <div class="dashboard-icon">
                    <div class="sidebar-icon">
                        <i class="las la-bars"></i>
                    </div>
                </div>
                @include('layouts.backend.sidebar')
                <div class="dashboard-right-contents mt-4 mt-lg-0">
                    @include('layouts.backend.top-header')
                    <div class="wrapper-container">
                        @yield('content')
                    </div>
                    <div class="wrapper-container d-flex justify-content-between py-3 mt-3 bg-white px-4 radius-5">
                        <div class="copyright-block">
                            {!! render_footer_copyright_text() !!}
                        </div>
                        <div class="version-code-wrapper">
                            {{-- V-{{ get_static_option("site_script_version",'1.0.0') }} --}}
                            V-1.0.0
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard area end -->

    <!-- jquery -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <!-- jquery Migrate -->
    <script src="{{ asset('assets/js/jquery-migrate.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('assets/js/bootstrap5.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/backend/js/toastr.min.js') }}"></script>
    <!-- Lazy Load Js -->
    <script src="{{ asset('assets/js/jquery.lazy.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <!-- All Plugins js -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <!-- Range Slider -->
    <script src="{{ asset('assets/js/nouislider-8.5.1.min.js') }}"></script>
    <!-- All Plugins two js -->
    <script src="{{ asset('assets/js/plugin-two.js') }}"></script>
    <!-- Nice Scroll -->
    <script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
    <!-- Calendar js -->
    <script src="{{ asset('assets/js/calendar-bundle.js') }}"></script>
    <!-- Chart Js -->
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script src="{{ asset('assets/backend/js/fontawesome-iconpicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>

    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    {!! Toastr::message() !!}

    <!-- Javascript Helpers -->
    <script src="{{ asset('assets/js/helpers.js') }}"></script>
    <!-- Javascript Helpers -->
    <script src="{{ asset('assets/frontend/js/jquery-ui.js') }}"></script>

    <x-notification.js />

    <script>
        $(document).ready(function() {

            // 1) clone header once (no events) and prepare filter row
            // $('#dataTable thead tr').clone(false).addClass('filters').appendTo('#dataTable thead');
            $('#dataTable thead tr').clone(false).addClass('filters').appendTo('#dataTable thead');


            // 2) clean cloned header: remove dropdown/button/form elements so inputs are clean
            $('#dataTable thead tr.filters').find('.dropdown-menu, .btn-group, button, a, form, .badge').remove();

            // 3) insert inputs into cloned header
            $('#dataTable thead tr.filters th').each(function(i) {
                // Skip checkbox column (first column)
                if (i === 0) {
                    $(this).html(''); // keep empty
                    return;
                }

                const title = $(this).text().trim();
                $(this).html(
                    '<input type="text" placeholder="' + title + '" style="width:100%;" />'
                );
            });


            // Helper: returns a renderer function that preserves HTML for display
            // but extracts only the dropdown-toggle/button text for filtering/searching.
            function createStatusRenderer() {
                return function(data, type, row, meta) {
                    if (!data) return '';
                    if (type === 'display') return data;

                    var tmp = document.createElement('div');
                    tmp.innerHTML = data;

                    // prefer the visible toggle/button text (handles your bootstrap markup)
                    var btn = tmp.querySelector('.dropdown-toggle, button, .btn');
                    if (btn && btn.textContent.trim().length) return btn.textContent.trim();

                    // fallback: remove dropdown-menu elements and return remaining text
                    tmp.querySelectorAll('.dropdown-menu').forEach(function(n) {
                        n.remove();
                    });
                    return tmp.textContent.trim();
                };
            }

            // Build dynamic columnDefs: detect columns that contain dropdowns/buttons in first body row
            const dynamicDefs = [];
            // find the first non-empty row in tbody (some pages may have no rows)
            const $firstRow = $('#dataTable tbody tr:visible:first');
            if ($firstRow.length) {
                $firstRow.find('td').each(function(idx) {
                    // check the cell's HTML for typical dropdown/button markers
                    const html = $(this).html() || '';
                    // test for presence of dropdown-toggle, btn-group, or dropdown-menu
                    if (html.indexOf('dropdown-toggle') !== -1 || html.indexOf('btn-group') !== -1 || html
                        .indexOf('dropdown-menu') !== -1) {
                        dynamicDefs.push({
                            targets: idx,
                            render: createStatusRenderer()
                        });
                    }
                });
            }

            // OPTIONAL: if you want to also inspect header cells (for columns with no rows yet)
            // and detect columns that have a .status placeholder in the header,
            // you could add a fallback scan of the first thead row. (Not enabled by default.)
            // Example:
            // if (dynamicDefs.length === 0) {
            //   $('#dataTable thead tr:first th').each(function(idx) {
            //     if ($(this).text().toLowerCase().indexOf('status') !== -1) {
            //       dynamicDefs.push({ targets: idx, render: createStatusRenderer() });
            //     }
            //   });
            // }

            // Initialize DataTable using the dynamic columnDefs
            let table = new DataTable('#dataTable', {
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: false,
                order: [],
                info: true,
                autoWidth: false,
                responsive: true,
                pagingType: "simple_numbers",
                layout: {
                    topStart: 'pageLength',
                    topEnd: {
                        buttons: [{
                            extend: 'excel',
                            text: 'Export All'
                        }],
                        search: {
                            placeholder: "Type Here"
                        }
                    },
                    bottomStart: 'info',
                    bottomEnd: 'paging'
                },

                // add dynamically built columnDefs (may be empty if no matching columns found)
                columnDefs: dynamicDefs,

                initComplete: function() {
                    const api = this.api();
                    // bind the cloned-header inputs to column search
                    $('#dataTable thead tr.filters th').each(function(i) {
                        var $input = $('input', this);
                        if ($input.length === 0) return;
                        $input.on('keyup change clear', function() {
                            api.column(i).search(this.value).draw();
                        });
                        $input.on('click', function(e) {
                            e.stopPropagation();
                        });
                    });
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.swal_delete_button', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '{{ __('Are you sure?') }}',
                text: '{{ __('This action cannot be undone.') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#55545b',
                confirmButtonText: "{{ __('Yes, delete it!') }}",
                cancelButtonText: "{{ __('No') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });

        // Calendar js
        // https://www.cssscript.com/demo/event-calendar-color

        // if($('#custom-color-calendar').length > 0){
        //     new Calendar({
        //         id: '#custom-color-calendar',
        //     })
        // }

        function convertToSlug(text) {
            return text
                .toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
        }



        $(document).on('click', '.swal_change_language_button', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '{{ __('Are you sure to make this language as a default language?') }}',
                text: '{{ __('Languages will be turn changed as default') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#55545b',
                confirmButtonText: "{{ __('Yes, Change it!') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });

        $(document).on('click', '#remove-dummy-data', function(e) {
            e.preventDefault();
            this_el = $(this);
            Swal.fire({
                title: "Are you sure?",
                text: "if you delete dummy vendors then you cannot restore again!",
                icon: "warning",
                cancelButtonColor: "#d33",
                showCancelButton: true,
                confirmButtonText: "Continue",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    send_ajax_request('GET', null, this_el.attr('href'), function() {}, function(res) {
                        if (res.success) {
                            toastr.success('Dummy Data Deleted Success')
                            setTimeout(() => {
                                window.location = window.location.href;
                            }, 500);
                        } else {
                            toastr.warning('Something Went Wrong')
                        }
                    });
                }
            });
        })
    </script>
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            timeOut: 3000
        };
    </script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'success') }}";

            switch (type) {
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
    {!! Toastr::message() !!}
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error', {
                    closeButton: true,
                    progressBar: true,

                });
            @endforeach
        @endif
    </script>

    @yield('script')
    @yield('pwa-footer')
</body>

</html>
