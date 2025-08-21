@extends('backend.admin-master')

@section('site-title')
    {{ __('Create Campaign') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/flatpickr.min.css') }}">
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
                        @can('campaigns')
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
        <form action="">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="dashboard__card">
                                <div class="mb-3">
                                    <label class="form-label">Campaign Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter campaign name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Campaign Subtitle <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter campaign subtitle">
                                </div>
                                <div class="mb-3">
                                    <x-media-upload :title="__('Campaign Image')" name="image" :dimentions="'1920x1080'" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Campaign Status
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select">
                                        <option>Published</option>
                                        <option>Draft</option>
                                        <option>Archived</option>
                                    </select>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="discountCheck">
                                    <label class="form-check-label" for="discountCheck">
                                        Set Discount Percentage
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Set Discount Percentage">
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="set_fixed_date">
                                    <label class="form-check-label" for="set_fixed_date">
                                        Set Fixed Date Range
                                    </label>
                                </div>
                                <div class="mb-3 d-flex gap-2">
                                    <input type="text" class="form-control flatpickr" id="fixed_from_date">
                                </div>
                                <div class="mb-3 d-flex gap-2">
                                    <input type="text" class="form-control flatpickr" id="fixed_to_date">
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
                                <select class="form-control" id="productId" onchange="selectCampaignProduct(this)">
                                    <option selected disabled>
                                        Select One
                                    </option>
                                    @foreach ($all_products as $product)
                                        <option value="{{ $product->id }}" data-product_id="{{ $product->id }}"
                                            data-product_name="{{ $product->name }}" data-price="{{ $product->price }}"
                                            data-sale_price="{{ $product->sale_price }}"
                                            data-stock="{{ optional($product->inventory)->stock_count ?? 0 }}">
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="accordion" id="campaignProducts">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/js/flatpickr.js') }}"></script>
    <script>
        flatpickr(".flatpickr", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
    </script>
    <script>
        // Keep track of added products
        let addedProducts = [];

        function selectCampaignProduct() {
            let selected = $("#productId option:selected");
            let productId = selected.data("product_id");
            let productName = selected.data("product_name");
            let productPrice = selected.data("price");
            let productSalePrice = selected.data("sale_price");
            let productStock = selected.data("stock");

            // Prevent duplicate
            if (addedProducts.includes(productId)) {
                alert("This product is already added to the campaign!");
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
                                    <input type="text" class="form-control" value="${productPrice}" readonly />
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Price for Campaign</label>
                                    <input type="text" class="form-control" value="" name="campaign_price[]"/>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">No. of Units Available</label>
                                    <input type="text" class="form-control" value="${productStock}" readonly />
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">No. of Units for Sale</label>
                                    <input type="text" class="form-control" value="0" name="units_for_sale[]" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Start Date</label>
                                    <input type="text" class="form-control dataPickerStart" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">End Date</label>
                                    <input type="text" class="form-control dataPickerEnd" />
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

        // Apply fixed date range if checked
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
                    alert("Please select fixed date range first");
                    $(this).prop('checked', false);
                }
            }
        });

        function removeCampaignProduct(productId) {
            $("#accordion-" + productId).remove();
            addedProducts = addedProducts.filter(id => id !== productId);
        }
    </script>
@endsection
