<div class="checkout-order-summery bg-item-badge">
    <div class="order-summery-contents text-center">
        <h2 class="summery-title"> {{ __('Order Summary') }} </h2>
        <div class="coupon-form mt-4">
            <div class="single-input">
                <label>
                    <input class="form--control" name="coupon" type="text"
                        value="{{ old('coupon') ?? request()->coupon }}" placeholder="{!! filter_static_option_value('coupon_placeholder', $setting_text, __('Enter your coupon code')) !!}">
                </label>
            </div>
            <button type="button" data-action="{{ route('frontend.shop.checkout.sync-product-coupon.ajax') }}"
                class="apply-coupon">
                {!! filter_static_option_value('apply_coupon_btn_text', $setting_text, __('apply coupon')) !!}
            </button>
        </div>

        @php
            $default_shipping_cost_amount =
                isset($default_shipping) && $default_shipping->id ? $default_shipping_cost : 0;
        @endphp

        <div class="order-shipping-methods">

        </div>

        <div class="single-coupon-list mt-4">
            <ul class="coupon-flex-list coupon-border">
                <li class="list">
                    <b>
                        {{ __('Sub total') }}
                    </b>
                    <b id="checkout_items_total">
                        {{ amount_with_currency_symbol(toFixed($itemsTotal, 0)) }}
                    </b>
                </li>
                <li class="list">
                    <b>
                        {{ __('Discount amount') }}
                    </b>
                    <b id="coupon_amount">
                        {{ amount_with_currency_symbol(0.0) }}
                    </b>
                </li>
                @if ($enableTaxAmount)
                    <li class="list">
                        <b>
                            {{ __('Tax amount') }}
                        </b>
                        <b id="checkout_tax_amount">
                            {{ amount_with_currency_symbol(toFixed(0, 0)) }}
                        </b>
                    </li>
                    @if (get_static_option('display_price_in_the_shop') === 'exclusive')
                        <li class="list">
                            <small>
                                <b>{{ __('Exclusive tax') }}</b>
                                {{ __('means that tax is added on top of the retail price at the time of the sale.') }}
                            </small>
                        </li>
                    @endif
                @else
                    <li class="list">
                        <b>
                            {{ __('Tax amount') }}
                        </b>
                        <b id="checkout_tax_amount">
                            {{ get_static_option('display_price_in_the_shop') == 'including' ? __('Tax Inclusive') : '' }}
                        </b>
                    </li>
                @endif
                <li class="list">
                    <b>
                        {{ __('Total delivery cost') }}
                    </b>
                    <b id="checkout_delivery_cost">
                        {{ amount_with_currency_symbol(0) }}
                    </b>
                </li>
                <li class="list">
                    <b>
                        {{ __('Payment amount') }}
                    </b>
                    <b id="total_payment_amount">
                        {{ amount_with_currency_symbol(0) }}
                    </b>
                </li>
                <li class="list ">
                    <b>
                        {{ __('Grand total') }}
                    </b>
                    <b id="checkout_total">
                        {{ amount_with_currency_symbol(0) }}
                    </b>
                </li>
            </ul>
        </div>

        <div class="payment-inlines mt-4">
            <h6 class="payment-label fw-500 mb-3">
                {{ __('Select payment method') }}
            </h6>
            <div class="payment-card">
                {!! render_payment_gateway_for_form(true) !!}
            </div>
        </div>
        <div class="checkbox-inlines mt-3">
            @php
                $checkout_page_terms_text = get_static_option('checkout_page_terms_text');
                $checkout_page_terms_link_url = get_static_option('checkout_page_terms_link_url');
                $checkout_page_terms_link_url = $checkout_page_terms_link_url
                    ? url($checkout_page_terms_link_url)
                    : '#';

                $terms_text = str_replace(
                    ['[lnk]', '[/lnk]'],
                    ["<a class='terms' href='$checkout_page_terms_link_url'>", '</a>'],
                    $checkout_page_terms_text,
                );
            @endphp
            <input class="check-input" type="checkbox" id="terms_check" />
            <label class="checkbox-label" for="terms_check">
                Accept all
                <a class="text-success" href="{{ $checkout_page_terms_link_url }}">
                    Terms and Condition
                </a> &
                <a class="text-success" href="{{ $checkout_page_terms_text }}">
                    Privacy Policy
                </a>
            </label>
        </div>

        <div class="btn-wrapper mt-3">
            <a href="#1" id="place_order" class="cmn-btn btn-bg-1 w-100 radius-0"> {{ __('Confirm Your Order') }}
            </a>
        </div>

        <div class="btn-wrapper mt-3">
            <a href="{{ route('frontend.products.cart') }}" class="cmn-btn btn-outline-steam w-100 radius-0">
                {{ __('Return to Cart') }}
            </a>
        </div>
    </div>
</div>

<style>
    .checkout-order-summery {
        position: sticky;
        top: 20px;
        overflow-y: auto;
        flex: 1;
    }

    /* .billing-form.checkout-billing-form {
        display: flex;
        align-items: flex-start;
    } */
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radios = document.querySelectorAll('input[name="payment_gateway"]');
        const hiddenInput = document.getElementById('selected_payment_gateway');

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                hiddenInput.value = this.value;
            });
        });
    });
</script>
