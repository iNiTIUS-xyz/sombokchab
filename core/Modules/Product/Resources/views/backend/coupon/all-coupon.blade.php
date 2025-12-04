@extends('backend.admin-master')

@section('site-title', __('Manage Coupon'))

@section('style')
    <x-bulk-action.css />
    <x-select2.select2-css />

    <style>
        #form_category,
        #edit_#form_category,
        #form_subcategory,
        #form_childcategory,
        #edit_#form_subcategory,
        #edit_#form_childcategory,
        #form_products,
        #edit_ #form_products {
            display: none;
        }

        .lds-ellipsis {
            position: fixed;
            width: 80px;
            height: 80px;
            left: 50vw;
            top: 40vh;
            z-index: 50;
            display: none;
        }

        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;

            background: {
                    {
                    get_static_option('site_color')
                }
            }

            ;
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(24px, 0);
            }
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row g-4">
            <div class="col-12">
                {{--
            <x-error-msg />
            <x-flash-msg /> --}}
                <div class="mb-4">
                    @can('add-coupon')
                        <a href="#1" data-bs-toggle="modal" data-bs-target="#coupon_add_modal"
                            class="cmn_btn btn_bg_profile">{{ __('Add New Coupon') }}</a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('All Coupons') }}</h4>
                        @can('view-coupon')
                            <x-bulk-action.dropdown />
                        @endcan
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('view-coupon')
                                        <x-bulk-action.th />
                                    @endcan
                                    <th>{{ __('Code') }}</th>
                                    <th>{{ __('Discount Type') }}</th>
                                    <th>{{ __('Discount') }}</th>
                                    <th>{{ __('Expire Date') }}</th>
                                    <th>{{ __('Publish Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_product_coupon as $data)
                                        <tr>
                                            @can('view-coupon')
                                                <x-bulk-action.td :id="$data->id" />
                                            @endcan
                                            <td>{{ $data->code }}</td>
                                            <td>
                                                @if ($data->discount_type == 'percentage')
                                                    <span>Percentage</span>
                                                @else
                                                    <span>Amount</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->discount_type == 'percentage')
                                                    {{ $data->discount }}%
                                                @else
                                                    {{ amount_with_currency_symbol($data->discount) }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ date('M j, Y', strtotime($data->expire_date)) }}
                                            </td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $data->status }} {{ $data->status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ ucfirst($data->status == 'publish' ? __('Publish') : __('Unpublish')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form
                                                            action="{{ route('admin.products.coupon.status.change', $data->id) }}"
                                                            method="POST" id="status-form-activate-{{ $data->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="publish">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Publish') }}
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('admin.products.coupon.status.change', $data->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $data->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="draft">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Unpublish') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @can('edit-coupon')
                                                    <a href="#1" data-bs-toggle="modal" title="{{ __('Edit') }}"
                                                        data-bs-target="#category_edit_modal"
                                                        class="btn btn-warning btn-xs text-dark mb-2 me-1 category_edit_btn"
                                                        data-id="{{ $data->id }}" data-title="{{ $data->title }}"
                                                        data-code="{{ $data->code }}"
                                                        data-discount_on="{{ $data->discount_on }}"
                                                        data-discount_on_details="{{ $data->discount_on_details }}"
                                                        data-discount="{{ $data->discount }}"
                                                        data-discount_type="{{ $data->discount_type }}"
                                                        data-expire_date="{{ $data->expire_date }}"
                                                        data-status="{{ $data->status }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-coupon')
                                                    <x-table.btn.swal.delete :route="route('admin.products.coupon.delete', $data->id)" />
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @can('add-coupon')
                <div class="modal fade" id="coupon_add_modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content custom__form">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('Add New Coupon') }}</h5>
                                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                            </div>
                            <form action="{{ route('admin.products.coupon.new') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="title">
                                                    {{ __('Coupon Title') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="{{ __('Title') }}" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="code">
                                                    {{ __('Coupon Code') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="code" name="code"
                                                    placeholder="{{ __('Code') }}" required="">
                                                <span id="status_text" class="text-danger" style="display: none"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="discount_on">
                                            {{ __('Discount On') }}
                                        </label>
                                        <select name="discount_on" id="discount_on" class="form-control form-select">
                                            @foreach ($coupon_apply_options as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="form_category">
                                        <label for="category">
                                            {{ __('Category') }}
                                        </label>
                                        <select name="category" id="category" class="form-control form-select">
                                            <option value="">
                                                {{ __('Select a Category') }}
                                            </option>
                                            @foreach ($all_categories as $key => $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="form_subcategory">
                                        <label for="subcategory">
                                            {{ __('Subcategory') }}
                                        </label>
                                        <select name="subcategory" id="subcategory" class="form-control form-select">
                                            <option value="">
                                                {{ __('Select a Subcategory') }}
                                            </option>
                                            @foreach ($all_subcategories as $key => $subcategory)
                                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="form_childcategory">
                                        <label for="childcategory">
                                            {{ __('Child Category') }}
                                        </label>
                                        <select name="childcategory" id="childcategory" class="form-control form-select">
                                            <option value="">
                                                {{ __('Select a child category') }}
                                            </option>
                                            @foreach ($all_child_categories as $key => $child_category)
                                                <option value="{{ $child_category->id }}">{{ $child_category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="form_products">
                                        <label for="products">
                                            {{ __('Products') }}
                                        </label>
                                        <select name="products[]" id="products" class="form-control wide select2" multiple>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="discount_type">
                                                    {{ __('Discount Type') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select name="discount_type" class="form-control form-select"
                                                    id="discount_type" required="">
                                                    <option value="percentage">
                                                        {{ __('Percentage') }}
                                                    </option>
                                                    <option value="amount">
                                                        {{ __('Amount') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="discount">
                                                    {{ __('Discount') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" class="form-control" id="discount" name="discount"
                                                    placeholder="{{ __('Discount') }}" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="expire_date">
                                                    {{ __('Expire Date') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="date" class="form-control flatpickr" id="expire_date"
                                                    name="expire_date" placeholder="{{ __('Expire Date') }}" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="status">
                                                    {{ __('Publish Status') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select name="status" class="form-control form-select" id="status"
                                                    required="">
                                                    <option value="publish">
                                                        {{ __('Publish') }}
                                                    </option>
                                                    <option value="draft">
                                                        {{ __('Unpublish') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            @can('edit-coupon')
                <div class="modal fade" id="category_edit_modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content custom__form">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    {{ __('Update Coupon') }}</h5>
                                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                            </div>
                            <form action="{{ route('admin.products.coupon.update') }}" method="post">
                                <input type="hidden" name="id" id="coupon_id">
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="title">
                                                    {{ __('Coupon Title') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="edit_title" name="title"
                                                    placeholder="{{ __('Title') }}" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="edit_code">
                                                    {{ __('Coupon Code') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="edit_code" name="code"
                                                    placeholder="{{ __('Code') }}">
                                                <span id="status_text" class="text-danger" style="display: none"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="discount_on">
                                            {{ __('Discount On') }}
                                        </label>
                                        <select name="discount_on" id="edit_discount_on" class="form-control form-select">
                                            <option value="">
                                                {{ __('Select an option') }}
                                            </option>
                                            @foreach ($coupon_apply_options as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="edit_form_category">
                                        <label for="category">
                                            {{ __('Category') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="category" id="edit_category" class="form-control form-select">
                                            <option value="">
                                                {{ __('Select a Category') }}
                                            </option>
                                            @foreach ($all_categories as $key => $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="edit_form_subcategory">
                                        <label for="subcategory">
                                            {{ __('Subcategory') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="subcategory" id="edit_subcategory" class="form-control form-select">
                                            <option value="">
                                                {{ __('Select a Subcategory') }}
                                            </option>
                                            @foreach ($all_subcategories as $key => $subcategory)
                                                <option value="{{ $subcategory->id }}">
                                                    {{ $subcategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="edit_form_childcategory">
                                        <label for="childcategory">
                                            {{ __('Child Category') }}
                                        </label>
                                        <select name="childcategory" id="edit_childcategory"
                                            class="form-control form-select">
                                            <option value="">
                                                {{ __('Select a child category') }}
                                            </option>
                                            @foreach ($all_child_categories as $key => $child_category)
                                                <option value="{{ $child_category->id }}">
                                                    {{ $child_category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="edit_form_products">
                                        <label for="products">
                                            {{ __('Products') }}
                                        </label>
                                        <select name="products[]" id="edit_products" class="form-control wide select2"
                                            multiple>
                                        </select>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="edit_discount_type">
                                                    {{ __('Discount Type') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select name="discount_type" class="form-control form-select"
                                                    id="edit_discount_type" required="">
                                                    <option value="percentage">
                                                        {{ __('Percentage') }}
                                                    </option>
                                                    <option value="amount">
                                                        {{ __('Amount') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="edit_discount">
                                                    {{ __('Discount') }}
                                                </label>
                                                <input type="number" class="form-control" id="edit_discount"
                                                    name="discount" required="" placeholder="{{ __('Discount') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="edit_expire_date">
                                                    {{ __('Expire Date') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="date" class="form-control flatpickr" id="edit_expire_date"
                                                    name="expire_date" placeholder="{{ __('Expire Date') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="edit_status">
                                                    {{ __('Publish Status') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select name="status" class="form-control form-select" id="edit_status">
                                                    <option value="draft">
                                                        {{ __('Unpublish') }}
                                                    </option>
                                                    <option value="publish">
                                                        {{ __('Publish') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        {{ __('Close') }}
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="lds-ellipsis" style="display:none;">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <x-select2.select2-js />
    <x-table.btn.swal.js />

    @can('view-coupon')
        <script>
            (function($) {
                $(document).ready(function() {
                    $(document).on('click', '#bulk_delete_btn', function(e) {
                        e.preventDefault();

                        var bulkOption = $('#bulk_option').val();
                        var allCheckbox = $('.bulk-checkbox:checked');
                        var allIds = [];

                        allCheckbox.each(function(index, value) {
                            allIds.push($(this).val());
                        });

                        if (allIds.length > 0 && bulkOption == 'delete') {
                            Swal.fire({
                                title: '{{ __('Are you sure?') }}',
                                text: '{{ __('You would not be able to revert this action!') }}',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#ee0000',
                                cancelButtonColor: '#55545b',
                                confirmButtonText: '{{ __('Yes, delete them!') }}',
                                cancelButtonText: "{{ __('No') }}"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#bulk_delete_btn').text('{{ __('Deleting...') }}');

                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin.products.coupon.bulk.action') }}",
                                        data: {
                                            _token: "{{ csrf_token() }}",
                                            ids: allIds,
                                        },
                                        success: function(data) {
                                            Swal.fire(
                                                '{{ __('Deleted!') }}',
                                                '{{ __('Selected data have been deleted.') }}',
                                                'success'
                                            );
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        },
                                        error: function() {
                                            Swal.fire(
                                                'Error!',
                                                'Failed to delete data.',
                                                'error'
                                            );
                                        }
                                    });
                                }
                            });
                        } else {
                            Swal.fire(
                                'Warning!',
                                '{{ __('Please select at least one item and choose delete option.') }}',
                                'warning'
                            );
                        }
                    });

                    // Handle "select all" checkbox
                    $('.all-checkbox').on('change', function(e) {
                        e.preventDefault();
                        var value = $(this).is(':checked');
                        var allChek = $(this).closest('table').find('.bulk-checkbox');

                        allChek.prop('checked', value);
                    });
                });
            })(jQuery);
        </script>
    @endcan

    <script>
        $(document).ready(function() {
            $('.select2').each(function() {
                if (!$(this).data('select2')) {
                    $(this).select2({
                        width: '100%'
                    });
                }
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            flatpickr(".flatpickr", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });

            // EDIT modal open -> populate fields
            $(document).on('click', '.category_edit_btn', function() {
                let el = $(this);
                let id = el.data('id');
                let status = el.data('status');
                let modal = $('#category_edit_modal');
                let discount_on = el.data('discount_on');
                let discount_on_details = el.data('discount_on_details').length > 0 ? el.data(
                    'discount_on_details') : [];

                modal.find('#coupon_id').val(id);
                modal.find('#edit_status').val(status).trigger('change');
                modal.find('#edit_code').val(el.data('code'));
                modal.find('#edit_discount').val(el.data('discount'));
                modal.find('#edit_discount_type').val(el.data('discount_type')).trigger('change');
                modal.find('#edit_expire_date').val(el.data('expire_date'));
                modal.find('#edit_title').val(el.data('title'));
                modal.find('#edit_discount_on').val(el.data('discount_on')).trigger('change');

                // re-init flatpickr for edit expire date with default value
                flatpickr("#edit_expire_date", {
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                    defaultDate: el.data('expire_date')
                });

                // hide all dependent selects initially
                $('#edit_form_category').hide();
                $('#edit_form_subcategory').hide();
                $('#edit_form_childcategory').hide();
                $('#edit_form_products').hide();

                if (discount_on == 'product') {
                    // load products & pre-select values
                    loadProductDiscountHtml($('#edit_discount_on'), '#edit_products', true,
                        discount_on_details);
                } else if (discount_on) {
                    // show the correct container and set value
                    $('#edit_form_' + discount_on + ' option[value="' + discount_on_details + '"]').prop(
                        'selected', true);
                    $('#edit_form_' + discount_on).show();
                }
            });

            // coupon code validation events
            $('#code').on('keyup', function() {
                validateCoupon(this);
            });

            $('#edit_code').on('keyup', function() {
                validateCoupon(this);
            });

            // Discount on change events for create and edit
            $('#discount_on').on('change', function() {
                loadProductDiscountHtml(this, '#products', false, []);
            });

            $('#edit_discount_on').on('change', function() {
                loadProductDiscountHtml(this, '#edit_products', true, []);
            });
        });


        function loadProductDiscountHtml(context, target_selector, is_edit, values) {
            let product_select = $(target_selector);

            let selector_prefix = is_edit ? 'edit_' : '';
            $('#' + selector_prefix + 'form_category').hide();
            $('#' + selector_prefix + 'form_subcategory').hide();
            $('#' + selector_prefix + 'form_childcategory').hide();
            $('#' + selector_prefix + 'form_products').hide();

            let chosen = $(context).val();

            if (chosen == 'category') {
                $('#' + selector_prefix + 'form_category').show(500);
            } else if (chosen == 'subcategory') {
                $('#' + selector_prefix + 'form_subcategory').show(500);
            } else if (chosen == 'childcategory') {
                $('#' + selector_prefix + 'form_childcategory').show(500);
            } else if (chosen == 'product') {

                $('.lds-ellipsis').show();

                $.get('{{ route('admin.products.coupon.products') }}')
                    .then(function(data) {
                        $('.lds-ellipsis').hide();


                        let options = '';
                        if (data && data.length) {
                            data.forEach(function(product) {
                                options += '<option value="' + product.id + '">' + product.name + '</option>';
                            });
                        }

                        // populate select
                        product_select.html(options);

                        // show wrapper
                        if (is_edit) {
                            $('#edit_form_products').show(500);
                        } else {
                            $('#form_products').show(500);
                        }

                        // destroy select2 if initialized previously to avoid duplicates
                        if (product_select.data('select2')) {
                            product_select.select2('destroy');
                        }

                        // initialize select2
                        product_select.select2({
                            width: '100%',
                            placeholder: "{{ __('Select Products') }}"
                        });

                        // if any values passed (edit), set them
                        if (Array.isArray(values) && values.length) {
                            // ensure values are strings (because option values are strings)
                            let valArr = values.map(function(v) {
                                return String(v);
                            });
                            product_select.val(valArr).trigger('change');
                        } else {
                            product_select.val(null).trigger('change');
                        }

                    }).catch(function(err) {
                        $('.lds-ellipsis').hide();
                        console.error('Failed to load products:', err);
                    });
            }
        }

        function validateCoupon(context) {
            let code = $(context).val();
            let submit_btn = $(context).closest('form').find('button[type=submit]');
            // find the hidden coupon id if present (edit form has <input id="coupon_id">)
            let couponId = $(context).closest('form').find('#coupon_id').val() || null;
            // locate the status text element relative to this input (works for both add/edit)
            let status_text = $(context).closest('.form-group').find('#status_text');

            // hide message initially
            status_text.hide();

            if (!code || code.length === 0) {
                submit_btn.prop("disabled", false);
                return;
            }

            // optimistically disable submit while checking
            submit_btn.prop("disabled", true);

            // send coupon id (if present) so backend can exclude it from the uniqueness check
            $.get("{{ route('admin.products.coupon.check') }}", {
                    code: code,
                    id: couponId
                })
                .then(function(data) {
                    // data is expected to be an integer count
                    if (data > 0) {
                        let msg = "{{ __('This coupon is already taken') }}";
                        status_text.removeClass('text-success').addClass('text-danger').text(msg).show();
                        submit_btn.prop("disabled", true);
                    } else {
                        let msg = "{{ __('This coupon is available') }}";
                        status_text.removeClass('text-danger').addClass('text-success').text(msg).show();
                        submit_btn.prop("disabled", false);
                    }
                }).catch(function(err) {
                    // on error, allow submission but hide message
                    console.error('Coupon check failed:', err);
                    status_text.hide();
                    submit_btn.prop("disabled", false);
                });
        }
    </script>
@endsection
