@extends('backend.admin-master')

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
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Create Campaign') }}</h4>
                        @can('view-campaign')
                            <div class="btn-wrapper">
                                <a href="{{ route('admin.campaigns.all') }}" class="cmn_btn btn_bg_profile">
                                    {{ __('All Campaigns') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-ml-12">
        <form action="{{ route('admin.campaigns.new') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="dashboard__card">

                                {{-- Campaign Name --}}
                                <div class="mb-3">
                                    <label class="form-label">Campaign Name (English) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="campaign_name"
                                        placeholder="Enter campaign name (English)" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">ឈ្មោះយុទ្ធនាការ (ខ្មែរ) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="campaign_name_km"
                                        placeholder="បញ្ចូលឈ្មោះយុទ្ធនាការ (ខ្មែរ)" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Campaign Subtitle (English) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="campaign_subtitle"
                                        placeholder="Enter campaign subtitle (English)" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">ចំណងជើងរងយុទ្ធនាការ (ខ្មែរ) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="campaign_subtitle_km"
                                        placeholder="បញ្ចូលចំណងជើងរងយុទ្ធនាការ (ខ្មែរ)" required>
                                </div>

                                {{-- Image --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        {{ __('Campaign Image') }} <span class="text-danger">*</span>
                                    </label>

                                    <x-media-upload :title="__('')" name="image" :dimentions="'1920x1080'" required="true" />
                                </div>


                                {{-- Status --}}
                                <div class="mb-3">
                                    <label class="form-label">Publish Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select" required>
                                        <option value="draft">Unpublished</option>
                                        <option value="publish">Published</option>
                                    </select>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="discountCheck">
                                    <label class="form-check-label" for="discountCheck">
                                        Set Global Discount Percentage
                                    </label>
                                </div>

                                <div class="mb-3" id="showHideDisPer" style="display: none;">
                                    <input type="number" class="form-control" id="discountPercentage"
                                        placeholder="Set Discount Percentage" min="0" max="100" step="0.01">
                                </div>



                                <div class="mb-3">
                                    <label class="form-label">
                                        Start Date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control flatpickr" id="fixed_from_date"
                                        name="campaign_start_date" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        End Date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control flatpickr" id="fixed_to_date"
                                        name="campaign_end_date" required>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="set_fixed_date"
                                        name="use_fixed_dates">
                                    <label class="form-check-label" for="set_fixed_date">
                                        Set Global Fixed Date Range
                                    </label>
                                </div>
                                <button class="cmn_btn btn_bg_profile" type="submit">Add Campaign</button>

                            </div>
                        </div>

                        {{-- Product Section --}}
                        <div class="col-md-8">
                            <div class="dashboard__card campain_product_section">
                                <label class="form-label">Campaign Products <span class="text-danger">*</span></label>
                                <select class="form-control select2 product_select" id="productId"
                                    onchange="selectCampaignProduct(this)">
                                    <option selected disabled>Select One</option>
                                    @foreach ($all_products as $product)
                                        <option value="{{ $product->id }}" data-product_name="{{ $product->name }}"
                                            data-price="{{ $product->price }}"
                                            data-sale_price="{{ $product->sale_price }}"
                                            data-stock="{{ optional($product->inventory)->stock_count ?? 0 }}">
                                            {{ Str::limit($product->name, 100) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="accordion" id="campaignProducts"></div>

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
            $('.select2.product_select').select2();
        });

        flatpickr(".flatpickr", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        // Track added products
        let addedProducts = [];

        // Add product
        function selectCampaignProduct() {
            let selected = $("#productId option:selected");
            let productId = selected.val();
            let productName = selected.data("product_name");
            let productPrice = selected.data("price");
            let productStock = selected.data("stock");

            if (addedProducts.includes(productId)) {
                toastr.error('This product is already added!');
                return;
            }

            addedProducts.push(productId);

            let uid = "product_" + productId;

            let html = `
                <div class="accordion-item mb-2" id="accordion-${productId}">
                    <h2 class="accordion-header d-flex align-items-center">
                        <input type="hidden" name="product_id[]" value="${productId}">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#${uid}">
                            ${productName}
                        </button>
                        <button type="button" class="btn btn-danger ms-2"
                            onclick="removeCampaignProduct(${productId})">
                            <i class="ti-trash"></i>
                        </button>
                    </h2>

                    <div id="${uid}" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="row g-3">

                                <div class="col-md-3">
                                    <label class="form-label">Original Price</label>
                                    <input type="text" class="form-control" value="${productPrice}" readonly>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">
                                        Price for Campaign
                                        <span class="text-danger">*</span>
                                        </label>
                                    <input type="number" class="form-control campaign-price"
                                        name="campaign_price[]" data-original="${productPrice}"
                                        step="0.01" required>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">No. of Units Available</label>
                                    <input type="text" class="form-control" value="${productStock}" readonly>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">
                                       No. of Units for Sale
                                        <span class="text-danger">*</span>
                                        </label>
                                    <input type="number" class="form-control"
                                        name="units_for_sale[]" data-available="${productStock}"
                                        value="0" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">
                                        Start Date
                                        <span class="text-danger">*</span>
                                        </label>
                                    <input type="text" class="form-control dataPickerStart" name="start_date[]" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">
                                        End Date
                                        <span class="text-danger">*</span>
                                        </label>
                                    <input type="text" class="form-control dataPickerEnd" name="end_date[]" required>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            `;

            $("#campaignProducts").append(html);

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

        // Remove product
        function removeCampaignProduct(id) {
            $("#accordion-" + id).remove();
            addedProducts = addedProducts.filter(pid => pid != id);
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

        $('#discountCheck').on('change', function() {

            if ($(this).is(':checked')) {
                $('#discountPercentage').show().val("");
                $('#showHideDisPer').show();
            } else {
                $('#discountPercentage').hide().val("");
                $('#showHideDisPer').hide();
            }
        });

        $('#discountPercentage').on('input', function() {

            let discountPercent = parseFloat($(this).val());

            if (isNaN(discountPercent) || discountPercent <= 0) return;

            if (discountPercent >= 100) {
                toastr.error("Discount must be less than 100%");
                $(this).val(99.99);
                discountPercent = 99.99;
            }

            $('.campaign-price').each(function() {
                let original = parseFloat($(this).data("original"));
                let discountedPrice = original - (original * discountPercent / 100);
                $(this).val(discountedPrice.toFixed(2));
            });
        });
    </script>
@endsection
