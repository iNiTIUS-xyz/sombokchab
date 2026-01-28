@extends('frontend.frontend-page-master')

@section('page-title')
    {{ __('Checkout') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/common/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/payment.css') }}">
    <x-loader.css />
    <style>
        .user-shipping-address-item.active .btn-outline-primary {
            color: #fff !important;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .checkout-shipping-method:hover {
            cursor: pointer;
        }

        .shippingMethod__wrapper {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            flex-wrap: wrap;
        }

        .shippingMethod__wrapper__item {
            display: flex;
            align-items: center !important;
            gap: .75rem;
            padding: .65rem 1rem !important;
            border: 1px solid #d9d9d9 !important;
            border-radius: .5rem;
            background: #fff !important;
            cursor: pointer;
            transition: border-color .2s ease, background-color .2s ease;
            width: 100%;
            font-size: .875rem !important;
        }

        .shippingMethod__wrapper__item span.title {
            color: var(--black) !important;
            font-weight: bold;
        }

        .shippingMethod__wrapper__item span.checkbox {
            height: 20px !important;
            width: 20px !important;
            background: var(--white);
            border: 2px solid var(--paragraph-color);
            border-radius: 50%;
            position: relative;
        }

        .shippingMethod__wrapper__item span.zone {
            margin: -5px !important;
        }

        .shippingMethod__wrapper__item span.checkbox .inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        .shippingMethod__wrapper__item span.amount {
            font-weight: bold;
            margin: -5px !important;
        }

        .shippingMethod__wrapper__item.active,
        .shippingMethod__wrapper__item:hover {
            color: var(--paragraph-color) !important;
            border: 1px solid var(--main-color-one) !important;
        }

        .shippingMethod__wrapper__item.active span.title,
        .shippingMethod__wrapper__item:hover span.title {
            color: var(--main-color-one) !important;
            font-weight: bold;
        }

        .shippingMethod__wrapper__item.active span.other_text,
        .shippingMethod__wrapper__item:hover span.other_text {
            color: var(--main-color-one) !important;
        }

        .shippingMethod__wrapper__item.active span.checkbox,
        .shippingMethod__wrapper__item:hover span.checkbox {
            border: 2px solid var(--main-color-one);
        }

        .shippingMethod__wrapper__item.active span.checkbox .inner,
        .shippingMethod__wrapper__item:hover span.checkbox .inner {
            background: var(--main-color-two) !important;
            border: 2px solid var(--white) !important;
            margin-bottom: 2px;
        }
    </style>


    <style>
        .shipping-option-list {
            margin: 0;
            padding: 0;
        }

        .shipping-option-item {
            list-style: none;
            margin-bottom: .75rem;
        }

        .option-card {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .65rem 1rem;
            border: 1px solid #d9d9d9;
            border-radius: .5rem;
            background: #fff;
            cursor: pointer;
            transition: border-color .2s ease, background-color .2s ease;
            width: 100%;
        }

        .option-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .option-card:has(.option-input:checked) {
            border: 1px solid var(--main-color-one);
        }

        .option-radio {
            width: 22px;
            height: 22px;
            border: 2px solid #bfbfbf;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            flex: 0 0 22px;
        }

        .option-radio::after {
            content: "";
            position: absolute;
            inset: 3px;
            border-radius: 50%;
            background: var(--main-color-two);
            transform: scale(0);
            transition: transform .15s ease;
        }

        .option-title {
            font-weight: 600;
            color: #111;
            line-height: 1.1;
        }

        .option-sub {
            font-size: .875rem;
            color: #666;
        }

        .option-badge {
            margin-left: .5rem;
            padding: .15rem .45rem;
            font-size: .7rem;
            border-radius: .35rem;
            background: #111;
            color: #fff;
        }

        .option-card:hover {
            border-color: var(--main-color-one);
            box-shadow: 0 0 0 3px rgba(30, 123, 133, .08);
        }

        .option-input:checked+.option-radio {
            border-color: var(--main-color-one);
        }

        .option-input:checked+.option-radio::after {
            transform: scale(1);
        }

        .option-input:checked~.option-text .option-title {
            color: var(--main-color-one);
        }

        .option-input:checked~.option-text .option-sub {
            color: #444;
        }

        .shipping-option-list {
            display: block;
        }
    </style>
@endsection

@php
    $carts = Cart::instance('default')->content();
    $uniqueProductIds = $carts->pluck('id')->unique()->toArray();

    $country_id = old('country_id') ?? 0;
    $state_id = old('state_id') ?? 0;
    $city_id = old('city') ?? 0;

    $carts = $carts->groupBy('options.vendor_id');

    $vendors = \Modules\Vendor\Entities\Vendor::with('shippingMethod', 'shippingMethod.zone')
        ->whereIn('id', $carts->keys())
        ->get();
@endphp

@section('content')
    @if ($all_cart_items->count() > 0)
        <div class="checkout-area-wrapper padding-top-20 padding-bottom-20">
            <div class="container">
                @if (!auth('web')->check())
                    @include('frontend.cart.partials.login')
                @endif

                <form action="{{ route('frontend.checkout') }}" class="billing-form checkout-billing-form" method="POST"
                    id="billing_info" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-7 col-lg-7">
                            <x-msg.stock_error />
                            <x-msg.flash />
                            <x-msg.error />

                            <div class="checkout-inner-content">
                                <div class="billing-details-area-wrapper">
                                    <h4 class="title mb-3">
                                        {{ __('Shipping details') }}
                                    </h4>
                                    @if (auth('web')->check())
                                        <div class="btn-wrapper">
                                            <button type="button" class="cmn-btn btn-bg-1 billing_details_click btn-small">
                                                {{ __('New Shipping Address') }}
                                            </button>
                                        </div>
                                    @endif

                                    <ul class="mt-3" style="flex-wrap: unset !important;">
                                        @foreach ($all_user_shipping ?? [] as $shipping_address)
                                            <li class="shipping-option-item">
                                                @include('frontend.cart.partials.shipping-address-option')
                                            </li>
                                        @endforeach
                                    </ul>
                                    <input type="hidden" name="coupon" id="coupon_code"
                                        value="{{ old('coupon') ?? request()->coupon }}">
                                    <input type="hidden" name="ship_to_another_address" id="ship_to_another_address">
                                    <input type="hidden" name="selected_shipping_option"
                                        value="{{ $default_shipping->id }}">
                                    <input type="hidden" name="selected_payment_gateway"
                                        value="{{ get_static_option('site_default_payment_gateway') }}">
                                    <input type="hidden" name="agree" id="term_agree">
                                    <input type="file" name="cheque_payment_input" id="cheque_payment" class="d-none">
                                    <input type="file" name="bank_transfer_input" id="bank_transfer" class="d-none">

                                    @include('frontend.cart.partials.billing-info')
                                </div>

                                <div class="cart-items-wrapper">
                                    @include('frontend.cart.cart-items.cart-items-wrapper')
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 col-lg-5">
                            @include('frontend.cart.partials.order-summary')
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="row padding-top-100 padding-bottom-100">
            <div class="col-md-8 m-auto">
                <x-msg.stock_error />
                <x-msg.flash />
                <x-msg.error />
                <div class="w-50 m-auto">
                    <x-frontend.page.empty :image="get_static_option('empty_cart_image')" :text="filter_static_option_value(
                        'checkout_page_no_product_text',
                        $setting_text,
                        __('No products in your cart!'),
                    )" />
                </div>
            </div>
        </div>
    @endif

    <div class="popup_modal_checkout_overlay"></div>

    <div class="checkout-inner-content popup_modal_checkout">
        <div class="billing-details-area-wrapper position-relative">
            <div class="d-flex justify-content-end position-absolute top-0 right-0 w-100">
                <h3 class="title d-none">
                    {{ filter_static_option_value('checkout_billing_section_title', $setting_text, __('Billing Details')) }}
                </h3>
                <div class="checkout_modal_close"><i class="las la-times"></i></div>
            </div>

            <form action="{{ route('frontend.checkout') }}" class="billing-form" method="POST" id="shopping_address"
                enctype="multipart/form-data">
                @csrf
                @php $modal = true; @endphp
                @include('frontend.cart.partials.billing-info')
            </form>
        </div>
    </div>

    <x-loader.html />
@endsection

@section('script')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC-p_XBbow_dJCi5TKLw69gIXITC4hvkE&libraries=places&callback=initialize">
    </script>

    <script>
        $(document).ready(function() {
            let lastCityId = null;

            function getSelectedAddressCity($input) {
                if (!$input || !$input.length) return null;
                const $data = $input.closest('label').next('.visually-hidden');
                return $data.length ? $data.data('city') : null;
            }

            function syncShippingMethods() {
                $('.showShippingDisplay').each(function() {
                    const $container = $(this);
                    const vendorId = $container.data('vendor-id') || 'admin';
                    const $shippingInput = $container.find('input.shipping_cost');

                    if ($shippingInput.length) {
                        $shippingInput.attr('name', `shipping_cost[${vendorId}]`);
                    }

                    const $items = $container.find('.checkout-shipping-method');
                    if (!$items.length) return;

                    let $active = $items.filter('.active').first();
                    if (!$active.length) {
                        $active = $items.first().addClass('active');
                    }

                    const shippingCost = Number($active.data('shipping-cost')) || 0;
                    const shippingCostId = $active.data('shipping-cost-id') || '';

                    $container.find('.vendor_shipping_cost').text(amount_with_currency_symbol(shippingCost));
                    $container.find('.shipping_cost').val(shippingCostId);
                });

                calculateOrderSummaryNoTax();
                document.dispatchEvent(new Event("shipping_methods_loaded"));
            }

            function loadShippingMethods(shippingAddressId) {
                $.ajax({
                    url: "{{ route('frontend.checkout.shipping.methods') }}",
                    type: "GET",
                    data: {
                        shipping_address_id: shippingAddressId
                    },
                    beforeSend: function() {
                        $('.showShippingDisplay').slideUp();
                    },
                    success: function(response) {

                        $('.showShippingDisplay').html(response.html);
                        $('.showShippingDisplay').stop(true, true).slideDown();
                        syncShippingMethods();

                    },
                    error: function() {
                        $('.showShippingDisplay').slideUp();
                        alert('Failed to load shipping methods');
                    }
                });
            }
            // On radio change
            $('body').on('change', 'input[name="shipping_address_id"]', function() {
                const shippingAddressId = $(this).val();
                const cityId = getSelectedAddressCity($(this));

                if (shippingAddressId && (lastCityId === null || String(cityId) !== String(lastCityId))) {
                    lastCityId = cityId;
                    loadShippingMethods(shippingAddressId);
                } else if (!shippingAddressId) {
                    $('.showShippingDisplay').slideUp();
                }
            });

            // Page load (default checked)
            const defaultChecked = $('input[name="shipping_address_id"]:checked').val();

            if (defaultChecked) {
                lastCityId = getSelectedAddressCity($('input[name="shipping_address_id"]:checked'));
                loadShippingMethods(defaultChecked);
            }

        });
    </script>

    <script>
        function initialize() {
            // prevent enter submit during map typing
            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });

            const geocoder = new google.maps.Geocoder();

            let latitude = parseFloat(document.getElementById("address-latitude").value) || 11.5564;
            let longitude = parseFloat(document.getElementById("address-longitude").value) || 104.9282;

            const map = new google.maps.Map(document.getElementById("address-map"), {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                zoom: 13,
            });

            const marker = new google.maps.Marker({
                map: map,
                position: {
                    lat: latitude,
                    lng: longitude
                },
                draggable: true,
                visible: true
            });

            const locationInput = document.getElementById("address-input");
            const autocomplete = new google.maps.places.Autocomplete(locationInput);

            google.maps.event.addListener(autocomplete, "place_changed", function() {
                marker.setVisible(false);
                const place = autocomplete.getPlace();

                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    locationInput.value = "";
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();
                setLocationCoordinates(lat, lng);

                document.getElementById("address").value = place.formatted_address ? place.formatted_address : (
                    place.name || "");
            });

            google.maps.event.addListener(marker, "dragend", function(e) {
                const lat = e.latLng.lat();
                const lng = e.latLng.lng();
                setLocationCoordinates(lat, lng);

                geocoder.geocode({
                    location: {
                        lat,
                        lng
                    }
                }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK && results[0]) {
                        locationInput.value = results[0].formatted_address;
                        document.getElementById("address").value = results[0].formatted_address;
                    }
                });
            });

            const addressEl = document.getElementById("address");
            addressEl.addEventListener("change", function() {
                geocodeAddress(addressEl.value, geocoder, map, marker);
            });

            function geocodeAddress(address, geocoder, map, marker) {
                if (!address) return;
                geocoder.geocode({
                    address: address
                }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK && results[0]) {
                        const latLng = results[0].geometry.location;
                        map.setCenter(latLng);
                        map.setZoom(17);
                        marker.setPosition(latLng);
                        const lat = latLng.lat(),
                            lng = latLng.lng();
                        setLocationCoordinates(lat, lng);
                        locationInput.value = results[0].formatted_address;
                    }
                });
            }

            function setLocationCoordinates(lat, lng) {
                document.getElementById("address-latitude").value = lat;
                document.getElementById("address-longitude").value = lng;
            }
        }
    </script>

    <script>
        function getSubTotals() {
            let totalAmount = 0;
            $(".vendor_subtotal").each(function() {
                totalAmount += replaceSymbol($(this).text());
            });
            return totalAmount;
        }

        function getTotalShippingCost() {
            let totalAmount = 0;
            $(".vendor_shipping_cost").each(function() {
                totalAmount += replaceSymbol($(this).text());
            });
            return totalAmount;
        }

        function replaceSymbol(text) {
            let amount_format = "{{ get_static_option('amount_format_by') }}";
            return parseFloat((text.replace("{{ site_currency_symbol() }}", "")).replace(amount_format, ''));
        }

        function calculateOrderSummaryNoTax() {
            let discountAmount = $("#coupon_amount").text().trim().replace("{{ site_currency_symbol() }}", "");
            discountAmount = parseFloat(discountAmount === '' ? 0 : discountAmount);

            let subTotal = getSubTotals();
            let totalShippingCost = getTotalShippingCost();

            $("#checkout_items_total").text(amount_with_currency_symbol(subTotal.toFixed(2)));
            $("#checkout_delivery_cost").text(amount_with_currency_symbol(totalShippingCost.toFixed(2)));

            let grandTotal = (subTotal - discountAmount) + totalShippingCost;
            $("#total_payment_amount").text(amount_with_currency_symbol(grandTotal.toFixed(2)));
            $("#checkout_total").text(amount_with_currency_symbol(grandTotal.toFixed(2)));
        }

        let defaultGateway = $('#site_global_payment_gateway').val();
        $('.payment-gateway-wrapper ul li[data-gateway="' + defaultGateway + '"]').addClass('selected');

        $(document).on("click", ".wallet-payment-input", function() {
            if ($(this).is(':checked')) {
                $('.payment-card').fadeOut();
                $('.payment-gateway-wrapper').find(('input')).val('Wallet');
                $('.payment_gateway_passing_clicking_name').val('Wallet');
            } else {
                $('.payment-card').fadeIn();
                $('.payment-gateway-wrapper').find(('input')).val('');
                $('.payment_gateway_passing_clicking_name').val('');
            }
        });

        $(document).on('click', '.payment-gateway-wrapper > ul > li', function(e) {
            e.preventDefault();

            let gateway = $(this).data('gateway');
            let $wrapper = $('.payment-gateway-wrapper');

            // Visual highlight
            $(this).addClass('selected').siblings().removeClass('selected');

            // Show/hide manual payment ID field
            if (gateway === 'manual_payment') {
                $('.manual_transaction_id').removeClass('d-none');
            } else {
                $('.manual_transaction_id').addClass('d-none');
            }

            // Update hidden fields
            $wrapper.find('input[name="selected_payment_gateway"]').val(gateway);
            $('.payment_gateway_passing_clicking_name').val(gateway);
        });

        $(document).on("click", ".user-shipping-address-item", function(e) {
            e.preventDefault();
            e.stopPropagation();

            let $this = $(this);
            let states = JSON.parse($this.attr("data-states"));
            let cities = JSON.parse($this.attr("data-cities"));
            let selectedCountry = $this.data('country');
            let selectedState = $this.data('state');
            let selectedCity = $this.data('city');

            $(".billing-form #name").val($this.data('name'));
            $(".billing-form #email").val($this.data('email'));
            $(".billing-form #address").val($this.data('address'));
            $(".billing-form #phone").val($this.data('phone'));
            $(".billing-form #zipcode").val($this.data('zipcode'));

            $("#country_id").val(selectedCountry);

            let statehtml = "<option value=''>{{ __('Select State') }}</option>";
            states.forEach((state) => {
                let selected = state.id == selectedState ? 'selected' : '';
                statehtml += `<option value="${state.id}" ${selected}>${state.name}</option>`;
            });
            $("#state_id").html(statehtml).val(selectedState);

            let cityhtml = "<option value=''>{{ __('Select City') }}</option>";
            cities.forEach((city) => {
                let selected = city.id == selectedCity ? 'selected' : '';
                cityhtml += `<option value="${city.id}" ${selected}>${city.name}</option>`;
            });
            $("#city_id").html(cityhtml).val(selectedCity);

            $(".user-shipping-address-item").removeClass("active");
            $this.addClass("active");
        });

        $(document).ready(function() {
            const defaultAddress = $('.user-shipping-address-item.active');
            if (defaultAddress.length > 0) {
                defaultAddress.trigger('click');
            }
            selectDefaultShippingMethod();
            calculateOrderSummaryNoTax();
        });

        $(document).on("click", ".checkout-shipping-method", function() {
            let shippingCost = Number($(this).attr("data-shipping-cost"));
            let shippingCostId = $(this).attr("data-shipping-cost-id");
            let currencySymbol = "{{ site_currency_symbol() }}";
            let subTotal = $(this).parent().parent().find("#vendor_subtotal").text().replace(currencySymbol, "");

            if (!$(this).hasClass("active")) {
                $(this).parent().find(".checkout-shipping-method").removeClass("active");
                $(this).addClass("active");
                $(this).parent().parent().find("#vendor_shipping_cost").html(amount_with_currency_symbol(
                    shippingCost));
                $(this).parent().parent().find(".shipping_cost").val(shippingCostId);

                calculateOrderSummaryNoTax();
            }
        });

        $(document).on('click', '#terms_check', function() {
            $('#billing_info input[name=agree]').val(1);
        });

        $(document).on('click', '#place_order', function(e) {
            e.preventDefault();

            // Require Terms & Conditions
            if (!$('#terms_check').is(':checked')) {
                toastr.error("Please accept the Terms and Conditions before placing your order.");
                return false;
            }

            // Ensure shipping and payment details synced
            selectDefaultShippingMethod();

            // Submit form
            $('.checkout-billing-form').trigger('submit');
        });


        $(document).on("click", ".apply-coupon", function() {
            let url = $(this).attr('data-action');
            let coupon = $(this).parent().find('input[name=coupon]').val();

            $('.lds-ellipsis').show();
            $('#coupon_code').val(coupon);
            $('#discount_summery').hide();
            $('#discount_summery #coupon_amount').html("{{ site_currency_symbol() }}" + 0);

            submitCoupon(url, coupon);
        });

        $(document).on("submit", "#discount-coupon", function(e) {
            e.preventDefault();

            let url = $(this).attr('action');
            let coupon = $(this).find('input[name=coupon]').val();

            $('.lds-ellipsis').show();
            $('#coupon_code').val(coupon);
            $('#discount_summery').hide();
            $('#discount_summery #coupon_amount').html("{{ site_currency_symbol() }}" + 0);

            submitCoupon(url, coupon);
        });

        function submitCoupon(url, coupon) {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    coupon: coupon
                },
                success: function(data) {
                    $('.lds-ellipsis').hide();
                    if (data.type == 'success') {
                        toastr.success('{{ __('Coupon applied') }}');
                        $('#coupon_amount').text(amount_with_currency_symbol(data.coupon_amount));
                        $('#coupon_code').val(coupon);
                        $('#discount_summery').show();
                    } else {
                        toastr.error('{{ __('Coupon invalid') }}');
                    }
                    calculateOrderSummaryNoTax();
                },
                error: function() {
                    $('.lds-ellipsis').hide();
                    toastr.error('{{ __('Something went wrong') }}');
                }
            });
        }

        // Ensure default shipping method is selected before submitting
        function selectDefaultShippingMethod() {
            $(".card-footer .checkout-shipping-method.active").each(function() {
                let shippingCost = $(this).attr("data-shipping-cost");
                let shippingCostId = $(this).attr("data-shipping-cost-id");

                $(this).parent().parent().find(".vendor_shipping_cost").text(amount_with_currency_symbol(
                    shippingCost));
                $(this).parent().parent().find(".shipping_cost").val(shippingCostId);
            });
        }
    </script>

    @if (moduleExists('ShippingModule'))
        @include('shippingmodule::frontend.shipping-charge')
    @endif

    <script>
        $(document).on("submit", "#shopping_address", function(e) {
            e.preventDefault();
            let currentForm = $(this);
            send_ajax_request(
                "POST",
                new FormData(e.target),
                "{{ route('frontend.shipping.address.store') }}",
                () => {},
                (data) => {
                    ajax_toastr_success_message(data);
                    $(".user-shipping-address-wrapper").append(data.option);
                    currentForm.trigger("reset");
                    $('.popup_modal_checkout_overlay').removeClass('show');
                    $('.popup_modal_checkout').removeClass('show');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                },
                function(xhr) {
                    ajax_toastr_error_message(xhr);
                }
            )
        });

        $(document).on("change", "#modal_country_id", function() {
            let country_id = $(this).val();
            send_ajax_request(
                "get",
                "",
                "{{ route('frontend.get-states') }}/" + country_id,
                () => {},
                (data) => {
                    if (data.success) {
                        $(this).parent().parent().find("#modal_state_id").html(data.data);
                    }
                },
                function(xhr) {
                    ajax_toastr_error_message(xhr);
                }
            )
        });

        $(document).on("change", "#modal_state_id", function() {
            let state_id = $(this).val();
            let payload = new FormData();
            payload.append("id", state_id);
            payload.append("type", "state");
            payload.append("_token", "{{ csrf_token() }}");

            // We only use this for cities; no tax handling.
            send_ajax_request(
                "POST",
                payload,
                "{{ route('frontend.shipping.module.methods') }}",
                () => {},
                (data) => {
                    if (data.success) {
                        let cityhtml = "<option value=''> {{ __('Select an city') }} </option>";
                        data?.cities?.forEach((city) => {
                            cityhtml += "<option value='" + city.id + "'>" + city.name + "</option>";
                        });
                        $("#modal_city_id").html(cityhtml);
                    }
                },
                function(xhr) {
                    ajax_toastr_error_message(xhr);
                }
            )
        });

        $(document).on('click', '.billing_details_click', function() {
            $('.popup_modal_checkout, .popup_modal_checkout_overlay').toggleClass('show');
        });

        $(document).on('click', '.popup_modal_checkout_overlay, .checkout_modal_close', function() {
            $('.popup_modal_checkout, .popup_modal_checkout_overlay').removeClass('show');
        });

        $(document).on("click", ".create-accounts", function() {
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $(".account-create-fields").slideUp();
                $("input[name='create_account']").val('');
            } else {
                $(this).addClass("active");
                $(".account-create-fields").slideDown();
                $("input[name='create_account']").val(1);
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Copies values from hidden address data div to hidden billing inputs
            function syncShippingToBilling(dataEl) {
                if (!dataEl) return;

                const get = key => dataEl.dataset[key] || '';

                document.querySelector('#full_name').value = get('name');
                document.querySelector('#address').value = get('address');
                document.querySelector('#zip_code').value = get('zipcode');
                document.querySelector('#country_id').value = get('country');
                document.querySelector('#state_id').value = get('state');
                document.querySelector('#city_id').value = get('city');
                document.querySelector('#phone').value = get('phone');
                document.querySelector('#email').value = get('email');
            }

            // On initial load, sync the default checked address
            const defaultAddressInput = document.querySelector('.option-input:checked');
            if (defaultAddressInput) {
                const hiddenDataEl = defaultAddressInput.closest('label').nextElementSibling;
                syncShippingToBilling(hiddenDataEl);
            }

            // When the user selects another shipping address
            document.querySelectorAll('.option-input').forEach(radio => {
                radio.addEventListener('change', function() {
                    const hiddenDataEl = this.closest('label').nextElementSibling;
                    syncShippingToBilling(hiddenDataEl);
                });
            });

            // Double-check before submit (for safety)
            document.querySelector('#billing_info')?.addEventListener('submit', function() {
                const selected = document.querySelector('.option-input:checked');
                if (selected) {
                    const hiddenDataEl = selected.closest('label').nextElementSibling;
                    syncShippingToBilling(hiddenDataEl);
                }
            });
        });
    </script>
@endsection
