@extends('backend.admin-master')
@section('site-title')
    {{ __('Update Coupon') }}
@endsection
@section('style')
    <x-bulk-action.css />
    <x-select2.select2-css />
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Update Coupon') }}</h4>
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
                    <form action="{{ route('admin.products.coupon.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $coupon->id }}">


                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>{{ __('Coupon Title') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title"
                                    value="{{ old('title', $coupon->title) }}" required>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label>{{ __('Coupon Code') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="code"
                                    value="{{ old('code', $coupon->code) }}">

                                <small id="status_text_edit" class="text-danger mt-1" style="display:none;"></small>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>{{ __('Discount On') }} <span class="text-danger">*</span></label>
                            <select name="discount_on" id="edit_discount_on" class="form-control form-select">
                                @foreach ($coupon_apply_options as $key => $value)
                                    <option value="{{ $key }}"
                                        {{ $coupon->discount_on === $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        @php
                            $discountDetails = json_decode($coupon->discount_on_details, true);
                        @endphp

                        <div class="form-group mb-3" id="edit_form_category"
                            style="{{ $coupon->discount_on === 'category' ? '' : 'display:none' }}">
                            <label>{{ __('Category') }}</label>
                            <select name="category" class="form-control form-select">
                                @foreach ($all_categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $discountDetails == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3" id="edit_form_subcategory"
                            style="{{ $coupon->discount_on === 'subcategory' ? '' : 'display:none' }}">
                            <label>{{ __('Subcategory') }}</label>

                            <select name="subcategory" class="form-control form-select">
                                <option value="">{{ __('Select a Subcategory') }}</option>

                                @foreach ($all_subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}"
                                        {{ $discountDetails == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group mb-3" id="edit_form_childcategory"
                            style="{{ $coupon->discount_on === 'childcategory' ? '' : 'display:none' }}">
                            <label>{{ __('Child Category') }}</label>

                            <select name="childcategory" class="form-control form-select">
                                <option value="">{{ __('Select a Child Category') }}</option>

                                @foreach ($all_child_categories as $child_category)
                                    <option value="{{ $child_category->id }}"
                                        {{ $discountDetails == $child_category->id ? 'selected' : '' }}>
                                        {{ $child_category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group mb-3" id="edit_form_products"
                            style="{{ $coupon->discount_on === 'product' ? '' : 'display:none' }}">
                            <label>{{ __('Products') }}</label>

                            @php
                                $selectedProducts = is_array($discountDetails) ? $discountDetails : [];
                            @endphp

                            <select name="products[]" id="edit_products" class="form-control select2-multi" multiple>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ in_array($product->id, $selectedProducts) ? 'selected' : '' }}>
                                        {{ \Illuminate\Support\Str::limit($product->name, 100) }}
                                    </option>
                                @endforeach
                            </select>

                        </div>



                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>
                                    {{ __('Discount Type') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="discount_type" id="edit_discount_type" class="form-control form-select"
                                    required>
                                    <option value="percentage"
                                        {{ $coupon->discount_type === 'percentage' ? 'selected' : '' }}>
                                        {{ __('Percentage') }}
                                    </option>
                                    <option value="amount" {{ $coupon->discount_type === 'amount' ? 'selected' : '' }}>
                                        {{ __('Amount') }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>
                                    {{ __('Discount') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control discount" id="edit_discount" step="0.01"
                                    max="99..99" placeholder="Enter Discount" name="discount" required
                                    pattern="[0-9]+(\.[0-9]{1,2})?" value="{{ $coupon->discount }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>{{ __('Expire Date') }} <span class="text-danger">*</span></label>
                                <input type="date" class="form-control flatpickr" id="edit_expire_date"
                                    placeholder="Enter Expire Date" name="expire_date" value="{{ $coupon->expire_date }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>{{ __('Publish Status') }} <span class="text-danger">*</span></label>
                                <select name="status" id="edit_status" class="form-control form-select">
                                    <option value="draft" {{ $coupon->status === 'draft' ? 'selected' : '' }}>Unpublish
                                    </option>
                                    <option value="publish" {{ $coupon->status === 'publish' ? 'selected' : '' }}>Publish
                                    </option>
                                </select>
                            </div>
                        </div>



                        @can('add-coupon')
                            <div class="btn-wrapper mt-2">
                                <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Update') }}</button>
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

            const $editProducts = $('#edit_products');
            $editProducts.select2({
                width: '100%',
                placeholder: "{{ __('Select Products') }}",
                allowClear: true
            });
            let productsLoaded = false;

            $editProducts.on('select2:opening', function() {

                if (productsLoaded) return;
                productsLoaded = true;

                $.get("{{ route('admin.products.coupon.products') }}", function(data) {

                    data.forEach(function(product) {

                        if ($editProducts.find('option[value="' + product.id + '"]')
                            .length === 0) {

                            const option = new Option(
                                product.name,
                                product.id,
                                false,
                                false
                            );

                            $editProducts.append(option);
                        }
                    });

                    $editProducts.trigger('change');
                });
            });
            $('#edit_discount_on').on('change', function() {
                const val = $(this).val();
                $('#edit_form_category, #edit_form_subcategory, #edit_form_childcategory, #edit_form_products')
                    .hide();
                $('#edit_form_' + val).show();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            function initSelect2(element) {
                if ($(element).length && !$(element).data('select2')) {
                    $(element).select2({
                        width: '100%',
                        placeholder: "{{ __('Select Products') }}",
                        allowClear: true
                    });
                }
            }
            flatpickr(".flatpickr", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d"
            });

            $('.discount').on('input', function() {
                if (this.value < 0) this.value = 1;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const discountType = document.querySelector('select[name="discount_type"]');
            const discountInput = document.querySelector('.discount');

            function validateDiscount() {
                const type = discountType.value;
                let value = parseFloat(discountInput.value) || 0;

                if (type === 'percentage') {
                    if (value > 99.99) {
                        discountInput.value = 99.99;
                    } else if (value < 1 && discountInput.value !== '') {
                        discountInput.value = 1;
                    }
                }

            }

            discountInput.addEventListener('input', validateDiscount);

            discountType.addEventListener('change', function() {
                const type = this.value;
                let value = parseFloat(discountInput.value) || 0;

                if (type === 'percentage') {

                    if (value < 1 && discountInput.value !== '') {
                        discountInput.value = 1;
                    }
                    discountInput.min = 1;
                    discountInput.max = 99.99;
                    discountInput.placeholder = "Enter Discount (1-99.99%)";
                } else if (type === 'amount') {
                    // Remove restrictions for amount
                    discountInput.min = 0;
                    discountInput.max = "";
                    discountInput.placeholder = "Enter Discount Amount";
                }

                validateDiscount();
            });

            discountType.dispatchEvent(new Event('change'));
        });
    </script>
@endsection
