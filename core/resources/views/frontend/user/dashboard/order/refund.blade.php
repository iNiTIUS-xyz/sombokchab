@extends('frontend.user.dashboard.user-master')

@section('style')
    <x-datatable.css />
    <style>
        .product-image {
            width: 60px;
        }
    </style>
@endsection

@section('site-title')
    {{ __('My Orders') }}
@endsection

@section('section')
    @if ($order?->refund_request_count < 1)
        <div class="form-header-wrap d-flex justify-content-between">
            <h3 class="title__two">{{ __('Order Details') }}</h3>
        </div>
        <div class="order-items-wrapper">
            <div class="order__refund__item">
                <div class="row g-4 justify-content-between">
                    <div class="col-xxl-6 col-md-7">
                        <div class="payment-contents">
                            <ul class="payment-list margin-top-40">
                                <li>
                                    <span class="payment-list-left">{{ __('Payment Gateway') }}:</span>
                                    <span
                                        class="payment-list-right">{{ render_payment_gateway_name($order?->payment_gateway) }}</span>
                                </li>
                                <li>
                                    <span class="payment-list-left">{{ __('Phone Number') }}:</span>
                                    <span class="payment-list-right">{{ $order?->address?->phone }}</span>
                                </li>
                                <li>
                                    <span class="payment-list-left">{{ __('Full Name') }}:</span>
                                    <span class="payment-list-right">{{ $order?->address?->name }}</span>
                                </li>
                                <li>
                                    <span class="payment-list-left">{{ __('Email') }}:</span>
                                    <span class="payment-list-right">{{ $order?->address?->email }}</span>
                                </li>
                            </ul>

                            <ul class="payment-list payment-list-two margin-top-15">
                                <li>
                                    <span class="payment-list-left">{{ __('Amount Paid') }}:</span>
                                    <span class="payment-list-right">
                                        {{ float_amount_with_currency_symbol($order?->paymentMeta?->total_amount) }}
                                    </span>
                                </li>
                                <li>
                                    <span class="payment-list-left">{{ __('Transaction ID') }}:</span>
                                    <span class="payment-list-right">{{ $order?->transaction_id }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('user.product.order.refund', $id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="custom__form">
                    <div class="order__refund__item mt-5">
                        <h4 class="title__two">{{ __('Only Available Product for Refund') }}</h4>
                        <div class="order__refund__item__available mt-4">
                            {{-- @foreach ($refundable_items ?? [] as $item) --}}
                            @foreach ($subOrders as $order)
                                @foreach ($order?->orderItem as $item)
                                    <div class="order__refund__item__available__single">
                                        <input type="hidden" name="product_name[{{ $item->id }}]"
                                            value="{{ $item->product?->name }}" />
                                        <div class="refunded__product">
                                            <div class="refunded__product__left">
                                                <div class="select-box">
                                                    <input type="checkbox" class="request-product-checkbox"
                                                        name="request_item_id[]" value="{{ $item->id }}"
                                                        class="form-check-input" />
                                                </div>
                                                <div class="refunded__product__main">
                                                    <div class="refunded__product__thumb product-image">
                                                        {!! render_image($item->product?->image) !!}
                                                    </div>
                                                    <div class="refunded__product__info product-info">
                                                        <h5 class="refunded__product__title">{{ $item->product?->name }}
                                                        </h5>
                                                        <p>
                                                            {{ $item?->variant?->productColor ? __('Color:') . $item?->variant?->productColor?->name . ' , ' : '' }}
                                                            {{ $item?->variant?->productSize ? __('Size:') . $item?->variant?->productSize?->name . ' , ' : '' }}
                                                            @foreach ($item?->variant?->attribute ?? [] as $attr)
                                                                {{ $attr->attribute_name }}
                                                                : {{ $attr->attribute_value }}

                                                                @if (!$loop->last)
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="refunded__product__price__item">
                                                <div class="refunded__product__price__multiply product-quantity">
                                                    {{ $item->quantity }} x
                                                    {{ float_amount_with_currency_symbol($item->price) }}
                                                </div>
                                                <div class="refunded__product__price product-quantity">
                                                    {{ float_amount_with_currency_symbol($item->quantity * $item->price) }}
                                                </div>
                                            </div>
                                            <div class="refunded__product__select product-refund-reason">
                                                <select name="refund_reason[{{ $item->id }}]" id="refund_reason"
                                                    class="form-select">
                                                    <option value="">{{ __('Select a reason') }}</option>
                                                    @foreach ($refundReasons as $reason)
                                                        <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                                                    @endforeach
                                                </select>

                                                <p class="error-info text-danger"></p>
                                            </div>
                                            <div class="refunded__product__quantity product-refund-quantity">
                                                <input name="refund_quantity[{{ $item->id }}]" id=""
                                                    class="form-control refunded__product__quantity__input"
                                                    value="{{ $item->quantity }}" min="1"
                                                    max="{{ $item->quantity }}" />
                                                <p class="error-info text-danger"></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div class="order__refund__item">
                        <h3 class="title__two">{{ __('Additional Information') }}</h3>
                        <div class="order__refund__item__inner mt-4">
                            <div class="row g-4">
                                <div class="col-sm-12">
                                    <div class="form-group additional-information-wrapper">
                                        <label class="form-label"
                                            for="#additional-info">{{ __('Additional Information') }}</label>
                                        <textarea name="additional_information" id="additional-info" cols="30" rows="4" class="textarea-form"></textarea>
                                        <p class="error-info text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label"
                                            for="#courier_address">{{ __('Courier Address') }}</label>
                                        <textarea disabled readonly name="courier_address" id="courier_address" cols="30" rows="4"
                                            class="textarea-form">{{ get_static_option('courier_address') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group preferred-option-wrapper">
                                        <label class="form-label" for="#additional-info">{{ __('Payment Option') }}</label>
                                        <select class="form-control" name="preferred_option" id="preferred_option">
                                            <option value="">{{ __('Select Payment Option') }}</option>
                                            @foreach ($refundPreferredOptions as $option)
                                                <option value="{{ $option->id }}"
                                                    data-fields='@json(unserialize($option->fields))'
                                                    data-is-file="{{ $option->is_file ? 1 : 0 }}">
                                                    {{ $option->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="error-info text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="#additional-info">
                                            {{ __('Upload Images') }}
                                        </label>
                                        <input type="file" name="files[]" id="" multiple max="6"
                                            class="form-control-file" />
                                    </div>
                                </div>
                                <div class="col-md-12 preferred-method-fields"></div>
                                <div class="col-md-12">
                                    <div class="form-group d-flex justify-content-end">
                                        <button type="submit" class="cmn_btn btn_bg_profile refund_request_button">
                                            {{ __('Request Refund') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @else
        <div class="row">
            <div class="col-md-12 text-center py-5">
                <h2 class="title py-5 text-danger">{{ __('You have already requested for refund') }}</h2>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Show/hide sidebar
            $(document).on('click', '.bodyUser_overlay', function() {
                $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
            });

            $(document).on('click', '.mobile_nav', function() {
                $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
            });

            // Checkbox styling logic
            $(document).on("click", ".request-product-checkbox", function() {
                $(this).closest('.refunded__product').toggleClass("border-info selected-refund-product",
                    this.checked);
            });

            // Submit validation logic
            $(document).on("click", ".refund_request_button", function(e) {
                let isValid = true;

                $(".request-product-checkbox").each(function() {
                    let parent = $(this).closest('.refunded__product');

                    if ($(this).prop('checked')) {
                        let reason = parent.find(".product-refund-reason select").val();
                        let quantity = parent.find(".product-refund-quantity input").val();
                        let maxQty = parent.find(".product-refund-quantity input").attr('max');

                        if (!reason) {
                            parent.find(".product-refund-reason .error-info").text(
                                "Please select a reason");
                            isValid = false;
                        } else {
                            parent.find(".product-refund-reason .error-info").text("");
                        }

                        if (parseInt(quantity) > parseInt(maxQty)) {
                            parent.find(".product-refund-quantity .error-info").text(
                                "Quantity must be equal or less than " + maxQty
                            );
                            isValid = false;
                        } else {
                            parent.find(".product-refund-quantity .error-info").text("");
                        }
                    }
                });

                // At least one checkbox should be selected
                if ($(".request-product-checkbox:checked").length < 1) {
                    toastr.warning("Please select a product first for requesting refund");
                    isValid = false;
                }

                // Preferred option required
                if ($('#preferred_option').val() === '') {
                    $('.preferred-option-wrapper .error-info').text("Please select preferred option");
                    isValid = false;
                } else {
                    $('.preferred-option-wrapper .error-info').text("");
                }

                // Additional info required
                if ($('#additional-info').val().trim() === '') {
                    $('.additional-information-wrapper .error-info').text(
                        "Please write additional information");
                    isValid = false;
                } else {
                    $('.additional-information-wrapper .error-info').text("");
                }

                return isValid;
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            // Triggered when preferred option changes
            $('#preferred_option').on('change', function() {
                let $selected = $(this).find("option:selected");
                let isFile = parseInt($selected.data("is-file"));
                let fieldsRaw = $selected.data("fields");
                let fields = [];

                try {
                    fields = typeof fieldsRaw === 'string' ? JSON.parse(fieldsRaw) : fieldsRaw;
                } catch (e) {
                    console.error("Error parsing dynamic fields:", e);
                }

                let html = '';

                // If file upload is required (QR Code file)
                if (isFile === 1) {
                    html += `
                        <div class="form-group mt-3">
                            <label class="form-label">Attachment</label>
                            <input class="form-control-file" name="qr_file" type="file" />
                        </div>
                    `;
                }

                // Dynamic input fields (bank name, account number etc)
                if (Array.isArray(fields)) {
                    fields.forEach(function(field) {
                        const name = field.replace(/\s+/g, '_').toLowerCase();
                        html += `
                            <div class="form-group mt-3">
                                <label class="form-label">${field}</label>
                                <input class="form-control" name="fields[${name}]" type="text" />
                            </div>
                        `;
                    });
                }

                $('.preferred-method-fields').html(html);
            });

        });
    </script>
@endsection
