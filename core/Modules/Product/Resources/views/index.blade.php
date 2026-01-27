@extends('backend.admin-master')

@section('site-title')
    {{ __('Product List Page') }}
@endsection

@section('style')
    <link href="{{ asset('assets/css/flatpickr.min.css') }}" rel="stylesheet">
    <x-product::variant-info.css />
    <x-media.css />
    <style>
        .offcanvas-top {
            height: 45vh !important;
            left: 360px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .select2-container .select2-selection--single {
            height: 43px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 3px !important;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-top: 7px !important;
            line-height: 27px !important;
        }
    </style>
@endsection

@section('content')
    @can('view-product')
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
    @endcan
    <div class="dashboard-recent-order">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row mx-2 mb-4">
                    <div class="col-md-6">
                        @can('add-product')
                            <div class="dashboard__card__header__right">
                                <a class="cmn_btn btn_bg_profile" href="{{ route('admin.products.create') }}">
                                    {{ __('Add New Product') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="btn-wrapper-trash margin-right-20">
                            @can('add-product')
                                <a class="cmn_btn btn-success text-white mb-3 mx-2 text-right"
                                    href="{{ route('admin.products.import.all') }}">
                                    {{ __('Import Product') }}
                                </a>
                            @endcan
                            @can('delete-product')
                                <a class="cmn_btn btn_bg_danger btn-sm px-4 me-2"
                                    href="{{ route('admin.products.trash.all') }}">
                                    {{ __('Trash Bin') }}
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <div class="dashboard__card__header__left">
                            <h3 class="dashboard__card__title mb-2">{{ __('Products List') }}</h3>
                            <div class="d-flex flex-wrap bulk-delete-wrapper gap-2"></div>
                        </div>
                        <div class="dashboard__card__header__right">
                            @can('view-product')
                                <div class="btn-wrapper">
                                    @if (request('name') ||
                                            request('sku') ||
                                            request('brand') ||
                                            request('category') ||
                                            request('sub_category') ||
                                            request('from_price') ||
                                            request('to_price'))
                                        <a href="{{ route('admin.products.all') }}"
                                            class="cmn_btn btn-danger text-right text-white">
                                            {{ __('Clear Search') }}
                                        </a>
                                    @endif
                                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                                        {{ __('Advanced Search') }}
                                    </button>
                                </div>
                            @endcan
                            <div class="btn-wrapper">
                                <div class="bulk-delete-wrapper d-flex mt-3">
                                    <select name="bulk_option" id="bulk_option">
                                        <option value="">
                                            {{ __('Bulk Action') }}
                                        </option>
                                        <option value="delete">
                                            {{ __('Delete') }}
                                        </option>
                                        <option value="active">{{ __('Publish') }}</option>
                                        <option value="inactive">{{ __('Unpublish') }}</option>
                                    </select>
                                    <button class="btn btn-primary " id="bulk_delete_btn">
                                        {{ __('Apply') }}
                                    </button>
                                </div>

                            </div>
                        </div>
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

    @can('edit-product')
        <x-product::table.status-js />
    @endcan

    @can('delete-product')
        <script>
            (function($) {
                $(document).ready(function() {

                    $(document).on('click', '#bulk_delete_btn', function(e) {
                        e.preventDefault();

                        var bulkOption = $('#bulk_option').val();
                        var allCheckbox = $('.bulk-checkbox:checked');
                        var allIds = [];

                        allCheckbox.each(function() {
                            allIds.push($(this).val());
                        });

                        if (bulkOption == "") {
                            Swal.fire('Warning!', 'Please choose a bulk action first.', 'warning');
                            return;
                        }

                        if (allIds.length === 0) {
                            Swal.fire('Warning!', 'Please select at least one item.', 'warning');
                            return;
                        }

                        // 🔥 Dynamic Messages
                        let title = '';
                        let text = '';
                        let successMsg = '';

                        if (bulkOption === 'delete') {
                            title = 'Are you sure?';
                            text = 'This will permanently delete selected items!';
                            successMsg = 'Selected items have been deleted.';
                        } else if (bulkOption === 'active') {
                            title = 'Publish Items?';
                            text = 'Selected items will be published.';
                            successMsg = 'Selected items are now published.';
                        } else if (bulkOption === 'inactive') {
                            title = 'Unpublish Items?';
                            text = 'Selected items will be unpublished.';
                            successMsg = 'Selected items are now unpublished.';
                        }

                        Swal.fire({
                            title: title,
                            text: text,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: bulkOption === 'delete' ? '#ee0000' : '#28a745',
                            cancelButtonColor: '#55545b',
                            confirmButtonText: 'Yes, continue!',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {

                            if (result.isConfirmed) {

                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('admin.products.bulk.action') }}",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        ids: allIds,
                                        type: bulkOption,
                                    },
                                    success: function() {
                                        Swal.fire('Success!', successMsg, 'success');
                                        // reload after action
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    },
                                    error: function() {
                                        Swal.fire('Error!', 'Action failed. Try again.', 'error');
                                    }
                                });

                            }
                        });
                    });
                    $('.all-checkbox').on('change', function() {
                        var value = $(this).is(':checked');
                        $(this).closest('table').find('.bulk-checkbox').prop('checked', value);
                    });

                });
            })(jQuery);
        </script>
    @endcan
    <x-product::product-image-js />
    <script>
        $(".select2").select2();
    </script>
    <script>
        $(function() {
            $("#search-date_range").flatpickr({
                mode: "range",
                dateFormat: "Y-m-d",
            });

            $("#manage-product-form").fadeOut();

            $(document).on("click", "#product-list-title-flex h3", function() {
                $("#manage-product-form").fadeToggle();
            })

            $(document).ready(function() {
                $(".load-ajax-data").fadeOut();
            })

            $(document).on("click", "#manage-product-button", function() {
                $("#manage-product-form").trigger("submit");
            });

            $(document).on("submit", "#manage-product-form", function(e) {
                e.preventDefault();
                let form_data = $("#manage-product-form").serialize().toString();
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
                let form_data = $("#manage-product-form").serialize().toString()
                form_data += "&count=" + $(this).val();

                // product-table-body
                send_ajax_request("GET", null, $("#manage-product-form").attr("action") + "?" + form_data,
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
@endsection
