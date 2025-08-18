@extends('vendor.vendor-master')

@section('site-title')
    {{ __('Products List') }}
@endsection

@section('style')
    <link href="{{ asset('assets/css/flatpickr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <x-product::variant-info.css />
    <x-media.css type="vendor" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <style>
        .offcanvas-top {
            height: 44vh !important;
            left: 360px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .select2-container .select2-selection--single {
            height: 43px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 9px !important;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-top: 7px !important;
        }
    </style>
@endsection

@section('content')
    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasTopLabel">Advance Search</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="" method="get">
                <div class="dashboard__card">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label-1" for="search-name">{{ __('Product Name') }}</label>
                                <input name="name" class="form--control input-height-1" id="search-name"
                                    value="{{ request('name') }}" placeholder="{{ __('Enter Product Name') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label-1" for="search-sku">{{ __('SKU') }}</label>
                                <input name="sku" class="form--control input-height-1" id="search-sku"
                                    value="{{ request('sku') }}" placeholder="{{ __('Enter SKU') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label-1" for="search-brand">
                                    {{ __('Brand') }}
                                </label>
                                <select name="brand" class="form-control select2">
                                    <option value="" disabled selected>
                                        Select One
                                    </option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}"
                                            @if (request('brand') == $brand->name) selected @endif>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label-1" for="search-category">
                                    {{ __('Category') }}
                                </label>
                                <select name="category" class="form-control select2">
                                    <option value="" disabled selected>
                                        Select One
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}"
                                            @if (request('category') == $category->name) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="label-1" for="search-sub_category">
                                    {{ __('Sub Category') }}
                                </label>
                                <select name="category" class="form-control select2">
                                    <option value="" disabled selected>
                                        Select One
                                    </option>
                                    @foreach ($sub_categories as $sub_category)
                                        <option value="{{ $sub_category->name }}"
                                            @if (request('sub_category') == $sub_category->name) selected @endif>
                                            {{ $sub_category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label-1" for="search-from_price">{{ __('Min Price') }}</label>
                                        <input name="from_price" class="form--control input-height-1" id="search-from_price"
                                            value="{{ request('from_price') }}"
                                            placeholder="{{ __('Enter Min Price') }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label-1" for="search-to_price">{{ __('Max Price') }}</label>
                                        <input name="to_price" class="form--control input-height-1" id="search-to_price"
                                            value="{{ request('to_price') }}" placeholder="{{ __('Enter Max Price') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard__card__body">
                    <button class="btn btn-primary" type="submit">
                        {{ __('Search') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="dashboard-recent-order">
        <div class="row">
            <div class="col-md-12">
                <x-flash-msg />
            </div>
            <div class="col-lg-12 mt-2">
                <div class="btn-wrapper" style="width: 98%">
                    <a class="cmn_btn btn_bg_profile mb-3"
                        href="{{ route('vendor.products.create') }}">{{ __('Add New Product') }}</a>
                    <a class="cmn_btn btn_bg_danger mb-3" style="float: right"
                        href="{{ route('vendor.products.trash.all') }}">{{ __('Trash Bin') }}</a>
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <div class="dashboard__card__header__left">
                            <h3 class="dashboard__card__title mb-2">{{ __('Products List') }}</h3>
                            <div class="d-flex flex-wrap bulk-delete-wrapper gap-2">

                            </div>
                        </div>
                        <div class="dashboard__card__header__right">
                            <div class="btn-wrapper">
                                @if (request('name') ||
                                        request('sku') ||
                                        request('brand') ||
                                        request('category') ||
                                        request('sub_category') ||
                                        request('from_price') ||
                                        request('to_price'))
                                    <a href="{{ route('vendor.products.all') }}"
                                        class="cmn_btn btn-danger text-right text-white">
                                        {{ __('Clear Search') }}
                                    </a>
                                @endif
                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                                    {{ __('Advance Search') }}
                                </button>
                            </div>
                            <div class="btn-wrapper">
                                <x-product::table.bulk-action />
                            </div>
                        </div>
                    </div>
                    <div class="dashboard__card__body dashboard-table mt-4">
                        <div class="table-wrap table-responsive" id="product-table-body">
                            @php
                                $route = 'vendor';
                            @endphp
                            {!! view('product::vendor.search', compact('products', 'statuses', 'route')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup type="vendor" />
    <x-product::product-image-modal />
@endsection

@section('script')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <x-product::table.status-js type="vendor" />
    <x-product::table.bulk-action-js :url="route('vendor.products.bulk.destroy')" />
    <x-product::product-image-js :route="route('vendor.products.update-image')" />
    <x-media.js type="vendor" />
    <script>
        $(".select2").select2();
    </script>
    <script>
        $(function() {
            $("#search-date_range").flatpickr({
                mode: "range",
                dateFormat: "Y-m-d",
            });

            $("#product-search-form").fadeOut();
            $(document).on("click", "#product-list-title-flex h3", function() {
                $("#product-search-form").fadeToggle();
            })

            $(document).ready(function() {
                $(".load-ajax-data").fadeOut();
            })

            $(document).on("click", "#product-search-button", function() {
                $("#product-search-form").trigger("submit");
            });

            $(document).on("submit", "#product-search-form", function(e) {
                e.preventDefault();
                let form_data = $("#product-search-form").serialize().toString();
                form_data += "&count=" + $("#number-of-item").val();

                // product-table-body
                send_ajax_request("GET", null, $(this).attr("action") + "?" + form_data, () => {
                    // before send request
                    $(".load-ajax-data").fadeIn();
                }, (data) => {
                    $("#product-table-body").html(data);
                    $(".load-ajax-data").fadeOut();
                }, (data) => {
                    prepare_errors(data);
                });
            });

            $(document).on("change", "#number-of-item", function(e) {
                e.preventDefault();
                let form_data = $("#product-search-form").serialize().toString()
                form_data += "&count=" + $(this).val();

                // product-table-body
                send_ajax_request("GET", null, $("#product-search-form").attr("action") + "?" + form_data,
                    () => {
                        // before send request
                        $(".load-ajax-data").fadeIn();
                    }, (data) => {
                        $("#product-table-body").html(data);
                        $(".load-ajax-data").fadeOut();
                    }, (data) => {
                        prepare_errors(data);
                    });
            });

            /*
            ========================================
                Row Remove Click Delete
            ========================================
            */
            $(document).on("click", ".pagination-list li a", function(e) {
                e.preventDefault();

                $(".pagination-list li a").removeClass("current");
                $(this).addClass("current");

                // product-table-body
                send_ajax_request("GET", null, $(this).attr("href"), () => {
                    // before send request
                    $(".load-ajax-data").fadeIn();
                }, (data) => {
                    $("#product-table-body").html(data);
                    $(".load-ajax-data").fadeOut();
                }, (data) => {
                    prepare_errors(data);
                });
            });

            $(document).on("click", ".delete-row", function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ee0000',
                    cancelButtonColor: '#55545b',
                    confirmButtonText: "{{ __('Yes, delete it!') }}",
                    cancelButtonText: "{{ __('No') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        send_ajax_request("GET", null, $(this).data("product-url"), () => {
                            // before send request
                            toastr.warning("Request send please wait while");
                        }, (data) => {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );

                            let product = $(this).parent().parent().parent();
                            product.fadeOut();

                            if (data) {
                                setTimeout(() => {
                                    product.remove();
                                    $(".tenant_info").load(location.href +
                                        " .tenant_info");
                                    ajax_toastr_success_message(
                                        "Successfully moved to trash");
                                }, 800)
                            }

                        }, (data) => {
                            prepare_errors(data);
                        })
                    }
                });
            });
        });
    </script>

    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable only if the table exists
            if ($('#productDataTable').length) {
                $('#productDataTable').DataTable({
                    paging: true,
                    lengthChange: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    responsive: true,
                    language: {
                        search: "Filter:"
                    }
                });
            }
        });
    </script>
@endsection
