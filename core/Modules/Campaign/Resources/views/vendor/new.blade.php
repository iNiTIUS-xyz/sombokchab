@extends('vendor.vendor-master')

@section('site-title')
    {{ __('Create Campaign') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/flatpickr.min.css') }}">
    <x-media.css />
    <style>
        .form-section {
            background: transparent;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
        }

        .accordion-button::after {
            margin-left: auto;
        }

        .delete-btn {
            background: none;
            border: none;
            color: red;
            font-size: 18px;
        }

        .accordion-item {
            background: var(--gray-two) !important;
        }

        .dashboard__card {
            height: auto !important;
        }

        .accordion-button:not(.collapsed) {
            color: var(--main-color-one) !important;
            background-color: var(--white) !important;
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .125);
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Create Campaign') }}
                        </h4>
                        <div class="btn-wrapper">
                            <a href="{{ route('vendor.campaigns.all') }}" class="cmn_btn btn_bg_profile">
                                {{ __('All Campaigns') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-ml-12">
        <form action="{{ route('vendor.campaigns.new') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="dashboard__card">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Campaign Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="campaign_name"
                                        placeholder="Enter campaign name" value="{{ old('campaign_name') }}" required>
                                    @error('campaign_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Campaign Subtitle
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="campaign_subtitle"
                                        placeholder="Enter campaign subtitle" value="{{ old('campaign_subtitle') }}"
                                        required>
                                    @error('campaign_subtitle')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <x-media-upload :title="__('Campaign Image')" name="image" :dimentions="'1920x1080'" />
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Campaign Status
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="status" class="form-select" required>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                                            {{ __('Draft') }}</option>
                                        <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>
                                            {{ __('Publish') }}</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="discountCheck">
                                    <label class="form-check-label" for="discountCheck">
                                        Set Discount Percentage
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <input type="number" class="form-control" id="discountPercentage"
                                        placeholder="Set Discount Percentage" min="0" max="100" step="0.01">
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="set_fixed_date"
                                        name="use_fixed_dates">
                                    <label class="form-check-label" for="set_fixed_date">
                                        Set Fixed Date Range
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="text" class="form-control flatpickr" id="fixed_from_date"
                                        name="campaign_start_date" value="{{ old('campaign_start_date') }}" required>
                                    @error('campaign_start_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">End Date</label>
                                    <input type="text" class="form-control flatpickr" id="fixed_to_date"
                                        name="campaign_end_date" value="{{ old('campaign_end_date') }}" required>
                                    @error('campaign_end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button class="btn btn-success w-100" type="submit">
                                    {{ __('Add Campaign') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="dashboard__card campain_product_section">
                                <label class="form-label">
                                    Campaign Products
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control select2 product_select" id="productId"
                                    onchange="selectCampaignProduct(this)">
                                    <option selected disabled>
                                        Select One
                                    </option>
                                    @foreach ($all_products as $product)
                                        <option value="{{ $product->id }}" data-product_id="{{ $product->id }}"
                                            data-product_name="{{ $product->name }}" data-price="{{ $product->price }}"
                                            data-sale_price="{{ $product->sale_price }}"
                                            data-stock="{{ optional($product->inventory)->stock_count ?? 0 }}">
                                            {{ Str::limit($product->name, 100, '...') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="accordion" id="campaignProducts"></div>
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('campaign_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('units_for_sale')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <x-media.markup />
@endsection

@section('script')
    <x-media.js />
    <script src="{{ asset('assets/backend/js/flatpickr.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2.product_select').select2({
                placeholder: "{{ __('Select Product') }}",
            });
        });
    </script>
    <script>
        flatpickr(".flatpickr", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        // Keep track of added products
        let addedProducts = [];

        function selectCampaignProduct() {
            let selected = $("#productId option:selected");
            let productId = selected.data("product_id");
            let productName = selected.data("product_name");
            let productPrice = selected.data("price");
            let productStock = selected.data("stock");

            // Prevent duplicate
            if (addedProducts.includes(productId)) {
                toastr.error('This product is already added to the campaign!');
                return;
            }

            addedProducts.push(productId);

            let uniqueId = "product_" + productId;

            let html = `
                <div class="accordion-item mb-2" id="accordion-${productId}">
                    <h2 class="accordion-header d-flex align-items-center">
                        <input type="hidden" name="product_id[]" value="${productId}">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#${uniqueId}"
                            aria-expanded="false"
                            aria-controls="${uniqueId}">
                            ${productName}
                        </button>
                        <button type="button" class="btn btn-danger ms-2" onclick="removeCampaignProduct(${productId})">
                            <i class="ti-trash"></i>
                        </button>
                    </h2>
                    <div id="${uniqueId}" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Original Price</label>
                                    <input type="text" class="form-control original-price" value="${productPrice}" readonly />
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Price for Campaign</label>
                                    <input type="number" class="form-control campaign-price"
                                        value=""
                                        step="0.01"
                                        name="campaign_price[]"
                                        data-original="${productPrice}"
                                        oninput="checkCampaignPrice(this)" required />
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">No. of Units Available</label>
                                    <input type="text" class="form-control available-units" value="${productStock}" readonly />
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">No. of Units for Sale</label>
                                    <input type="number" class="form-control units-for-sale"
                                        value="0"
                                        name="units_for_sale[]"
                                        data-available="${productStock}"
                                        oninput="checkUnitsForSale(this)" required />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Start Date</label>
                                    <input type="text" class="form-control dataPickerStart" name="start_date[]" required />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">End Date</label>
                                    <input type="text" class="form-control dataPickerEnd" name="end_date[]" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $("#campaignProducts").append(html);

            // Initialize flatpickr only for new inputs
            $("#accordion-" + productId + " .dataPickerStart").flatpickr({
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });
            $("#accordion-" + productId + " .dataPickerEnd").flatpickr({
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });
        }

        function checkUnitsForSale(input) {
            let available = parseInt($(input).data("available"));
            let entered = parseInt($(input).val());

            if (entered > available) {
                toastr.error('Cannot exceed available units');
                $(input).val(available);
            } else if (entered < 0 || isNaN(entered)) {
                $(input).val(0);
            }
        }

        function checkCampaignPrice(input) {
            let original = parseFloat($(input).data("original"));
            let entered = parseFloat($(input).val());

            if (entered > original) {
                toastr.error('Campaign price cannot be higher than original price');
                $(input).val(original);
            } else if (entered < 0 || isNaN(entered)) {
                $(input).val(0);
            }
        }

        $('#set_fixed_date').on('change', function() {
            if ($(this).is(':checked')) {
                let from_date = $('#fixed_from_date').val();
                let to_date = $('#fixed_to_date').val();

                if (from_date && to_date) {
                    $('.dataPickerStart').each(function() {
                        if (this._flatpickr) {
                            this._flatpickr.setDate(from_date, true);
                        } else {
                            $(this).flatpickr({
                                altInput: true,
                                altFormat: "F j, Y",
                                dateFormat: "Y-m-d",
                                defaultDate: from_date
                            });
                        }
                    });

                    $('.dataPickerEnd').each(function() {
                        if (this._flatpickr) {
                            this._flatpickr.setDate(to_date, true);
                        } else {
                            $(this).flatpickr({
                                altInput: true,
                                altFormat: "F j, Y",
                                dateFormat: "Y-m-d",
                                defaultDate: to_date
                            });
                        }
                    });
                } else {
                    toastr.error("Please select fixed date range first");
                    $(this).prop('checked', false);
                }
            }
        });

        function removeCampaignProduct(productId) {
            $("#accordion-" + productId).remove();
            addedProducts = addedProducts.filter(id => id !== productId);
        }

        $('#discountCheck').on('change', function() {
            if ($(this).is(':checked')) {
                let discountPercent = parseFloat($('#discountPercentage').val());

                if (isNaN(discountPercent) || discountPercent <= 0) {
                    toastr.error("Please enter a valid discount percentage first");
                    $(this).prop('checked', false);
                    return;
                }

                $('.campaign-price').each(function() {
                    let original = parseFloat($(this).data("original"));
                    let discountedPrice = original - (original * discountPercent / 100);

                    if (discountedPrice < 0) discountedPrice = 0;

                    $(this).val(discountedPrice.toFixed(2));
                });
            }
        });

        $('#discountPercentage').on('input', function() {
            if ($('#discountCheck').is(':checked')) {
                let discountPercent = parseFloat($(this).val());

                if (isNaN(discountPercent) || discountPercent < 0) return;

                $('.campaign-price').each(function() {
                    let original = parseFloat($(this).data("original"));
                    let discountedPrice = original - (original * discountPercent / 100);

                    if (discountedPrice < 0) discountedPrice = 0;

                    $(this).val(discountedPrice.toFixed(2));
                });
            }
        });
    </script>
@endsection
