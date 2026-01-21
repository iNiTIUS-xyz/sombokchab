@extends('backend.admin-master')
@section('site-title')
    {{ __('Add New Coupon') }}
@endsection
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
    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Add New Coupon') }}</h4>
                        @can('view-coupon')
                            <div class="btn-wrapper">
                                <a href="{{ route('admin.products.coupon.all') }}" class="cmn_btn btn_bg_profile">
                                    {{ __('All Coupons') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-12">
                <div class="dashboard__card">
                    <form action="{{ route('admin.products.coupon.new') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>{{ __('Coupon Title') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" required
                                    placeholder="Enter Coupon Title">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>{{ __('Coupon Code') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="code" name="code" required
                                    placeholder="Enter Coupon Code">
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
                                    <option value="{{ $subcategory->id }}">
                                        {{ $subcategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3" id="form_childcategory">
                            <label>{{ __('Child Category') }}</label>
                            <select name="childcategory" class="form-control form-select">
                                <option value="">{{ __('Select a child category') }}</option>
                                @foreach ($all_child_categories as $child_category)
                                    <option value="{{ $child_category->id }}">
                                        {{ $child_category->name }}
                                    </option>
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
                                <input type="number" class="form-control discount" name="discount" min="1"
                                    max="99.99" step="0.01" required pattern="[0-9]+(\.[0-9]{1,2})?"
                                    placeholder="Enter Discount">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>{{ __('Expire Date') }} <span class="text-danger">*</span></label>
                                <input type="date" class="form-control flatpickr" name="expire_date" required
                                    placeholder="Enter Expire Date">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>{{ __('Publish Status') }} <span class="text-danger">*</span></label>
                                <select name="status" class="form-control form-select" required>
                                    <option value="publish">{{ __('Publish') }}</option>
                                    <option value="draft">{{ __('Unpublish') }}</option>
                                </select>
                            </div>
                        </div>

                        @can('add-coupon')
                            <div class="btn-wrapper mt-2">
                                <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Add') }}</button>
                                <a href="{{ route('admin.products.coupon.all') }}" class="cmn_btn default-theme-btn"
                                    style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                    {{ __('Back') }}
                                </a>
                            </div>
                        @endcan
                    </form>

                </div>
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

            function limitText(text, limit = 100) {
                return text.length > limit ? text.substring(0, limit) + '...' : text;
            }
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
                                    `<option value="${product.id}">${limitText(product.name, 100)}</option>`
                                );
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const discount = document.querySelector('.discount');

            discount.addEventListener('input', function() {
                let value = parseFloat(this.value);

                if (value > 99.99) {
                    this.value = 99.99;
                }

                if (value < 1) {
                    this.value = '';
                }
            });
        });
    </script>
@endsection
