<div class="checkout-order-summery bg-item-badge">
    <div class="order-summery-contents text-center">
        <h2 class="summery-title">{{ __('Order Summary') }}</h2>

        <div class="coupon-form mt-4">
            <div class="single-input">
                <label>
                    <input class="form--control" name="coupon" type="text"
                        value="{{ old('coupon') ?? request()->coupon }}"
                        placeholder="{!! filter_static_option_value('coupon_placeholder', $setting_text, __('Enter your coupon code')) !!}">
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

        <div class="order-shipping-methods"></div>

        <div class="single-coupon-list mt-4">
            <ul class="coupon-flex-list coupon-border">
                <li class="list">
                    <b>{{ __('Sub total') }}</b>
                    {{-- ✅ Add numeric subtotal for JS + show with exact decimals --}}
                    <b id="checkout_items_total" data-amount="{{ number_format($subtotal, 2, '.', '') }}">
                        {{ amount_with_currency_symbol(number_format($subtotal, 2, '.', '')) }}
                    </b>
                </li>

                <li class="list">
                    <b>{{ __('Discount amount') }}</b>
                    <b id="coupon_amount">{{ amount_with_currency_symbol(number_format(0.0, 2, '.', '')) }}</b>
                </li>

                <li class="list">
                    <b>{{ __('Total delivery cost') }}</b>
                    <b id="checkout_delivery_cost">{{ amount_with_currency_symbol(number_format(0, 2, '.', '')) }}</b>
                </li>

                <li class="list">
                    <b>{{ __('Grand total') }}</b>
                    <b id="checkout_total">{{ amount_with_currency_symbol(number_format(0, 2, '.', '')) }}</b>
                </li>
            </ul>
        </div>

        <div class="payment-inlines mt-4">
            <h6 class="payment-label fw-500 mb-3">{{ __('Select payment method') }}</h6>
            <div class="payment-card">
                {!! render_payment_gateway_for_form(true) !!}
            </div>
        </div>

        <div class="checkbox-inlines mt-3">
            @php
                $checkout_page_terms_text = get_static_option('checkout_page_terms_text');
                $checkout_page_terms_link_url = get_static_option('checkout_page_terms_link_url');
                $checkout_page_terms_link_url = $checkout_page_terms_link_url ? url($checkout_page_terms_link_url) : '#';
                $terms_text = str_replace(
                    ['[lnk]', '[/lnk]'],
                    ["<a class='terms' href='$checkout_page_terms_link_url'>", '</a>'],
                    $checkout_page_terms_text,
                );
            @endphp

            <input class="check-input" type="checkbox" id="terms_check" />
            <label class="checkbox-label" for="terms_check">
                Accept all
                <a class="text-success" href="{{ $checkout_page_terms_link_url }}">Terms and Condition</a> &
                <a class="text-success" href="{{ $checkout_page_terms_text }}">Privacy Policy</a>
            </label>
        </div>

        <div class="btn-wrapper mt-3">
            <a href="#1" id="place_order" class="cmn-btn btn-bg-1 w-100 radius-0">
                {{ __('Confirm Your Order') }}
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
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const CURRENCY = "{{ site_currency_symbol() }}";

    function parseMoney(text) {
        if (!text) return 0;
        return parseFloat(String(text).replace(CURRENCY, '').replace(/[^0-9.\-]/g, '')) || 0;
    }

    function getSubTotal() {
        const el = document.getElementById("checkout_items_total");
        if (!el) return 0;
        const attr = el.getAttribute("data-amount");
        if (attr !== null && attr !== "") return parseFloat(attr) || 0;
        return parseMoney(el.innerText);
    }

    function getCouponAmount() {
        const el = document.getElementById("coupon_amount");
        return el ? parseMoney(el.innerText) : 0;
    }

    function getAllShippingCosts() {
        let total = 0;
        document.querySelectorAll(".shippingMethod__wrapper__item.active").forEach(function (item) {
            total += parseFloat(item.getAttribute("data-shipping-cost")) || 0;
        });
        return total;
    }

    function fmt(n) {
        return CURRENCY + Number(n).toFixed(2);
    }

    function updateTotals() {
        const subTotal = getSubTotal();
        const coupon = getCouponAmount();
        const shipping = getAllShippingCosts();
        const grandTotal = (subTotal - coupon) + shipping;

        document.getElementById("checkout_delivery_cost").innerText = fmt(shipping);
        document.getElementById("checkout_total").innerText = fmt(grandTotal);
    }

    // Initial calc
    updateTotals();

    // When user changes a shipping option
    document.querySelectorAll(".shippingMethod__wrapper__item").forEach(function (item) {
        item.addEventListener("click", function () {
            const parent = item.parentNode;
            parent.querySelectorAll(".shippingMethod__wrapper__item").forEach(i => i.classList.remove("active"));
            item.classList.add("active");
            updateTotals();
        });
    });

    // Auto recalc when coupon updates
    const couponEl = document.getElementById("coupon_amount");
    if (couponEl && window.MutationObserver) {
        new MutationObserver(function () { updateTotals(); })
            .observe(couponEl, { childList: true, subtree: true, characterData: true });
    }

    document.addEventListener("coupon_applied", updateTotals);
});
</script>
