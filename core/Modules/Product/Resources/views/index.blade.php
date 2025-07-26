@extends('backend.admin-master')
@section('site-title')
    {{ __('Product List Page') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <link href="{{ asset('assets/css/flatpickr.min.css') }}" rel="stylesheet">
    <x-product::variant-info.css />
    <x-media.css />
@endsection
@section('content')
    <div class="dashboard-recent-order">
        <div class="row g-4">
            @can('product-search')
                <div class="col-md-12">
                    <x-flash-msg />
                    <div class="recent-order-wrapper dashboard-table bg-white">
                        <form class="custom__form" action="" method="get">
                            <div id="product-list-title-flex"
                                class="product-list-title-flex d-flex flex-wrap align-items-center justify-content-between">
                                <h3 class="cursor-pointer">
                                    {{ __('Search Products') }}
                                </h3>
                                <button type="submit" class="cmn_btn btn_bg_profile">
                                    {{ __('Search') }}
                                </button>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-name">{{ __('Name') }}</label>
                                        <input name="name" class="form-control" id="search-name"
                                            value="{{ request('name') }}" placeholder="{{ __('Enter name') }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-sku">{{ __('SKU') }}</label>
                                        <input name="sku" class="form-control" id="search-sku"
                                            value="{{ request('sku') }}" placeholder="{{ __('Enter sku') }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-brand">{{ __('Brand') }}</label>
                                        <input name="brand" class="form-control" id="search-brand"
                                            value="{{ request('brand') }}"
                                            placeholder="{{ __('Enter brand') }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-category">{{ __('Category') }}</label>
                                        <input name="category" class="form-control" id="search-category"
                                            value="{{ request('category') }}" placeholder="{{ __('Enter categroy') }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-sub_category">{{ __('Sub Category') }}</label>
                                        <input name="sub_category" class="form-control" id="search-brand"
                                            value="{{ request('sub_category') }}" placeholder="{{ __('Enter sub category') }}" />
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-category">{{ __('Child Category') }}</label>
                                        <input name="child_category" class="form-control" id="search-category"
                                            value="{{ old('child_category') }}"
                                            placeholder="{{ __('Enter clild category') }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-color">{{ __('Color Name') }}</label>
                                        <input name="color" class="form-control" id="search-color"
                                            value="{{ old('color') }}" placeholder="{{ __('Enter color name') }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-size">{{ __('Size Name') }}</label>
                                        <input name="size" class="form-control" id="search-size" value="{{ old('size') }}"
                                            name="{{ __('Enter size name') }}" />
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="search-is_inventory_warn_able" class="checkbox-label-1">
                                            <input type="checkbox" name="is_inventory_warn_able" class="form--checkbox-1"
                                                id="search-is_inventory_warn_able"
                                                value="{{ old('is_inventory_warn_able') }}" />
                                            {{ __('Inventory Warning') }}
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label for="search-refundable" class="checkbox-label-1">
                                            <input type="checkbox" name="refundable" class="form--checkbox-1"
                                                id="search-refundable" value="{{ old('refundable') }}" />
                                            {{ __('Refundable') }}
                                        </label>
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-1" for="search-from_price">
                                                    {{ __('Min Price') }}
                                                </label>
                                                <input name="from_price" class="form-control" id="search-from_price"
                                                    value="{{ request('from_price') }}"
                                                    placeholder="{{ __('Enter min price') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-1" for="search-to_price">
                                                    {{ __('Max Price') }}
                                                </label>
                                                <input name="to_price" class="form-control" id="search-to_price"
                                                    value="{{ request('to_price') }}"
                                                    placeholder="{{ __('Enter max price') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-date_range">
                                            {{ __('Created Date Range') }}
                                        </label>
                                        <input name="date_range" class="form-control" id="search-date_range"
                                            value="{{ old('date_range') }}" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-order_by">{{ __('Order By') }}</label>
                                        <select name="order_by" class="form-control" id="search-order_by"
                                            value="{{ old('order_by') }}">
                                            <option value="">{{ __('Select Order By Option') }}</option>
                                            <option value="asc">{{ __('Asc') }}</option>
                                            <option value="desc">{{ __('DESC') }}</option>
                                        </select>
                                    </div>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                </div>
            @endcan

            <div class="col-lg-12">
                <div class="row mx-2 mb-4">
                    <div class="col-md-6">
                        @can('product-create')
                            <div class="dashboard__card__header__right">
                                <a class="cmn_btn btn_bg_profile"
                                    href="{{ route('admin.products.create') }}">{{ __('Add New Product') }}</a>
                            </div>
                        @endcan
                    </div>
                    <div class="col-md-6 text-end">
                        @can('product-trash')
                            <div class="btn-wrapper-trash margin-right-20">
                                <a class="cmn_btn btn_bg_danger btn-sm" href="{{ route('admin.products.trash.all') }}">
                                    {{ __('Trash') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h3 class="dashboard__card__title">{{ __('Product list') }}</h3>
                    </div>
                    <div class="dashboard__card__header mt-4">
                        <div class="dashboard__card__header__right"></div>
                        @can('product-bulk-destroy')
                            <x-product::table.bulk-action />
                        @endcan
                    </div>
                    <div class="dashboard-table table-wrap">
                        <div class="table-responsive mt-4" id="product-table-body">
                            {!! view('product::search', compact('products', 'statuses')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-product::product-image-modal />
    <x-media.markup />
@endsection
@section('script')
    <x-media.js />

    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    @can('product-status-update')
        <x-product::table.status-js />
    @endcan

    @can('product-bulk-destroy')
        <x-product::table.bulk-action-js :url="route('admin.products.bulk.destroy')" />
    @endcan
    <x-product::product-image-js />
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

                            setTimeout(() => {
                                product.remove();
                                $(".tenant_info").load(location.href +
                                    " .tenant_info");
                                ajax_toastr_success_message(data);
                            }, 800)

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
        $(document).ready(function () {
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
