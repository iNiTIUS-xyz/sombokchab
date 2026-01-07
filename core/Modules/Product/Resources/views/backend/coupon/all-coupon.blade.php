@extends('backend.admin-master')

@section('site-title', __('Manage Coupon'))

@section('style')
    <x-bulk-action.css />
    <x-select2.select2-css />

    <style>
        #form_category,
        #edit_form_category,
        #form_subcategory,
        #edit_form_subcategory,
        #form_childcategory,
        #edit_form_childcategory,
        #form_products,
        #edit_form_products {
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
            background: {{ get_static_option('site_color') }};
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
                <div class="mb-4">
                    @can('add-coupon')
                        <a href="#1" data-bs-toggle="modal" data-bs-target="#coupon_add_modal"
                            class="cmn_btn btn_bg_profile">{{ __('Add New Coupon') }}</a>
                    @endcan
                </div>

                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Coupons') }}</h4>
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
                                            <td>{{ $data->discount_type == 'percentage' ? 'Percentage' : 'Amount' }}</td>
                                            <td>
                                                @if ($data->discount_type == 'percentage')
                                                    {{ $data->discount }}%
                                                @else
                                                    {{ amount_with_currency_symbol($data->discount) }}
                                                @endif
                                            </td>
                                            <td>{{ date('M j, Y', strtotime($data->expire_date)) }}</td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $data->status }} {{ $data->status == 'publish' ? 'bg-primary' : 'bg-danger' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown">
                                                        {{ ucfirst($data->status == 'publish' ? __('Publish') : __('Unpublish')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form
                                                            action="{{ route('admin.products.coupon.status.change', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="publish">
                                                            <button type="submit"
                                                                class="dropdown-item">{{ __('Publish') }}</button>
                                                        </form>
                                                        <form
                                                            action="{{ route('admin.products.coupon.status.change', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="draft">
                                                            <button type="submit"
                                                                class="dropdown-item">{{ __('Unpublish') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @can('edit-coupon')
                                                    <a href="#1" data-bs-toggle="modal"
                                                        data-bs-target="#category_edit_modal"
                                                        class="btn btn-warning btn-sm text-dark mb-2 me-1 category_edit_btn"
                                                        data-id="{{ $data->id }}" data-title="{{ $data->title }}"
                                                        data-code="{{ $data->code }}"
                                                        data-discount_on="{{ $data->discount_on }}"
                                                        data-discount_on_details="{{ is_array($data->discount_on_details) ? json_encode($data->discount_on_details) : $data->discount_on_details }}"
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

            <!-- Add Modal -->
            @can('add-coupon')
                <div class="modal fade" id="coupon_add_modal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content custom__form">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('Add New Coupon') }}</h5>
                                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                            </div>
                            <form action="{{ route('admin.products.coupon.new') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('Coupon Title') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('Coupon Code') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="code" name="code" required>
                                            <small id="status_text_add" class="text-danger mt-1" style="display:none;"></small>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>{{ __('Discount On') }} <span class="text-danger">*</span></label>
                                        <select name="discount_on" id="discount_on" class="form-control form-select">
                                            @foreach ($coupon_apply_options as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3" id="form_category">
                                        <label>{{ __('Category') }}</label>
                                        <select name="category" class="form-control form-select">
                                            <option value="">{{ __('Select a Category') }}</option>
                                            @foreach ($all_categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3" id="form_subcategory">
                                        <label>{{ __('Subcategory') }}</label>
                                        <select name="subcategory" class="form-control form-select">
                                            <option value="">{{ __('Select a Subcategory') }}</option>
                                            @foreach ($all_subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3" id="form_childcategory">
                                        <label>{{ __('Child Category') }}</label>
                                        <select name="childcategory" class="form-control form-select">
                                            <option value="">{{ __('Select a child category') }}</option>
                                            @foreach ($all_child_categories as $child_category)
                                                <option value="{{ $child_category->id }}">{{ $child_category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3" id="form_products">
                                        <label>{{ __('Products') }}</label>
                                        <select name="products[]" id="products" class="form-control wide" multiple></select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('Discount Type') }} <span class="text-danger">*</span></label>
                                            <select name="discount_type" class="form-control form-select" required>
                                                <option value="percentage">{{ __('Percentage') }}</option>
                                                <option value="amount">{{ __('Amount') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('Discount') }} <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control discount" name="discount"
                                                min="1" step="0.01" required pattern="[0-9]+(\.[0-9]{1,2})?">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('Expire Date') }} <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control flatpickr" name="expire_date" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('Publish Status') }} <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control form-select" required>
                                                <option value="publish">{{ __('Publish') }}</option>
                                                <option value="draft">{{ __('Unpublish') }}</option>
                                            </select>
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

            <!-- Edit Modal -->
            @can('edit-coupon')
                <div class="modal fade" id="category_edit_modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content custom__form">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('Update Coupon') }}</h5>
                                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                            </div>
                            <form action="{{ route('admin.products.coupon.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" id="coupon_id">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('Coupon Title') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="edit_title" name="title"
                                                required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('Coupon Code') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="edit_code" name="code">
                                            <small id="status_text_edit" class="text-danger mt-1"
                                                style="display:none;"></small>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>{{ __('Discount On') }} <span class="text-danger">*</span></label>
                                        <select name="discount_on" id="edit_discount_on" class="form-control form-select">
                                            @foreach ($coupon_apply_options as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3" id="edit_form_category">
                                        <label>{{ __('Category') }}</label>
                                        <select name="category" id="edit_category" class="form-control form-select">
                                            <option value="">{{ __('Select a Category') }}</option>
                                            @foreach ($all_categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3" id="edit_form_subcategory">
                                        <label>{{ __('Subcategory') }}</label>
                                        <select name="subcategory" id="edit_subcategory" class="form-control form-select">
                                            <option value="">{{ __('Select a Subcategory') }}</option>
                                            @foreach ($all_subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3" id="edit_form_childcategory">
                                        <label>{{ __('Child Category') }}</label>
                                        <select name="childcategory" id="edit_childcategory"
                                            class="form-control form-select">
                                            <option value="">{{ __('Select a child category') }}</option>
                                            @foreach ($all_child_categories as $child_category)
                                                <option value="{{ $child_category->id }}">{{ $child_category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3" id="edit_form_products">
                                        <label>{{ __('Products') }}</label>
                                        <select name="products[]" id="edit_products" class="form-control wide"
                                            multiple></select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('Discount Type') }} <span class="text-danger">*</span></label>
                                            <select name="discount_type" id="edit_discount_type"
                                                class="form-control form-select" required>
                                                <option value="percentage">{{ __('Percentage') }}</option>
                                                <option value="amount">{{ __('Amount') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('Discount') }} <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control discount" id="edit_discount"
                                                name="discount" required pattern="[0-9]+(\.[0-9]{1,2})?">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('Expire Date') }} <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control flatpickr" id="edit_expire_date"
                                                name="expire_date">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('Publish Status') }} <span class="text-danger">*</span></label>
                                            <select name="status" id="edit_status" class="form-control form-select">
                                                <option value="draft">{{ __('Unpublish') }}</option>
                                                <option value="publish">{{ __('Publish') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="lds-ellipsis">
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

    <script>
        $(document).ready(function() {
            // Initialize Select2 properly
            function initSelect2(element) {
                if ($(element).length && !$(element).data('select2')) {
                    $(element).select2({
                        width: '100%',
                        placeholder: "{{ __('Select Products') }}",
                        allowClear: true
                    });
                }
            }

            // Flatpickr
            flatpickr(".flatpickr", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d"
            });

            // Prevent negative values
            $('.discount').on('input', function() {
                if (this.value < 0) this.value = 1;
            });

            // Load products and initialize Select2
            function loadProducts(targetId, preselected = []) {
                $('.lds-ellipsis').show();
                $.get('{{ route('admin.products.coupon.products') }}')
                    .done(function(data) {
                        let $select = $(targetId);
                        $select.empty();

                        if (data && data.length) {
                            data.forEach(function(product) {
                                $select.append(
                                    `<option value="${product.id}">${product.name}</option>`);
                            });
                        }

                        // Destroy if already initialized
                        if ($select.data('select2')) {
                            $select.select2('destroy');
                        }

                        // Re-init Select2
                        initSelect2($select);

                        // Pre-select values if any
                        if (preselected.length) {
                            $select.val(preselected.map(String)).trigger('change');
                        }

                        $('.lds-ellipsis').hide();
                    })
                    .fail(function() {
                        $('.lds-ellipsis').hide();
                        alert('Failed to load products.');
                    });
            }

            // Handle Discount On Change
            $('#discount_on').on('change', function() {
                let val = $(this).val();
                $('#form_category, #form_subcategory, #form_childcategory, #form_products').hide();

                if (val === 'product') {
                    $('#form_products').show(500);
                    loadProducts('#products');
                } else if (val) {
                    $('#form_' + val).show(500);
                }
            });

            $('#edit_discount_on').on('change', function() {
                let val = $(this).val();
                $('#edit_form_category, #edit_form_subcategory, #edit_form_childcategory, #edit_form_products')
                    .hide();

                if (val === 'product') {
                    $('#edit_form_products').show(500);
                    loadProducts('#edit_products');
                } else if (val) {
                    $('#edit_form_' + val).show(500);
                }
            });

            // Edit Button Click
            $('.category_edit_btn').on('click', function() {
                let el = $(this);

                $('#coupon_id').val(el.data('id'));
                $('#edit_title').val(el.data('title'));
                $('#edit_code').val(el.data('code'));
                $('#edit_discount').val(el.data('discount'));
                $('#edit_discount_type').val(el.data('discount_type')).trigger('change');
                $('#edit_expire_date').val(el.data('expire_date'));
                $('#edit_status').val(el.data('status')).trigger('change');
                $('#edit_discount_on').val(el.data('discount_on')).trigger('change');

                // Reset all fields
                $('#edit_form_category, #edit_form_subcategory, #edit_form_childcategory, #edit_form_products')
                    .hide();
                $('#edit_category, #edit_subcategory, #edit_childcategory').val('');
                let $editProducts = $('#edit_products');
                if ($editProducts.data('select2')) $editProducts.select2('destroy');
                $editProducts.empty();

                let discountOn = el.data('discount_on');
                let details = el.data('discount_on_details') || [];

                // If product, load and preselect
                if (discountOn === 'product' && details.length) {
                    $('#edit_form_products').show(500);
                    loadProducts('#edit_products', details);
                } else if (discountOn && details) {
                    $('#edit_' + discountOn).val(details).trigger('change');
                    $('#edit_form_' + discountOn).show(500);
                }
            });

            // Coupon Code Validation
            $('#code, #edit_code').on('keyup', function() {
                let $input = $(this);
                let code = $input.val().trim();
                let $status = $input.attr('id') === 'code' ? $('#status_text_add') : $('#status_text_edit');
                let couponId = $('#coupon_id').val() || null;
                let $submit = $input.closest('form').find('button[type="submit"]');

                $status.hide();
                if (!code) {
                    $submit.prop('disabled', false);
                    return;
                }

                $submit.prop('disabled', true);
                $.get("{{ route('admin.products.coupon.check') }}", {
                        code: code,
                        id: couponId
                    })
                    .done(function(count) {
                        if (count > 0) {
                            $status.removeClass('text-success').addClass('text-danger')
                                .text("{{ __('This coupon is already taken') }}").show();
                        } else {
                            $status.removeClass('text-danger').addClass('text-success')
                                .text("{{ __('This coupon is available') }}").show();
                            $submit.prop('disabled', false);
                        }
                    })
                    .fail(function() {
                        $status.hide();
                        $submit.prop('disabled', false);
                    });
            });
        });
    </script>
@endsection
