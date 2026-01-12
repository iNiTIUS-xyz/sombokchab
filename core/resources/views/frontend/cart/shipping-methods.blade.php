@php
    $subtotal = null;
@endphp

<div class="card-footer checkout__card__footer">
    <h6 class="checkout__card__title card-title py-2">
        {{ __('Shipping options') }}
    </h6>

    <input type="hidden" class="shipping_cost" name="shipping_cost[{{ empty($key) ? 'admin' : $c_vendor?->id }}]" />

    <ul class="shippingMethod__wrapper shipping-method-wrapper">
        @foreach ($adminShippingMethod ?? [] as $method)
            @php
                $method->cost = calculatePrice($method->cost, $method, 'shipping');
                if ($method->is_default) {
                    $default_shipping_cost = $method->cost;
                }
            @endphp

            <li data-shipping-cost-id="{{ $method->id }}" data-shipping-cost="{{ round($method->cost) }}"
                class="shippingMethod__wrapper__item checkout-shipping-method align-items-center border-1 py-2 px-4 {{ $method->is_default ? 'active' : '' }}">
                <span class="checkbox">
                    <span class="inner"></span>
                </span>
                <span class="title">
                    {{ $method?->title }}
                </span>
                <span class="zone">
                    ({{ __('Zone:') }} {{ $method?->zone?->name }})
                </span>
                <span class="title">-</span>
                <span class="amount">
                    {{ amount_with_currency_symbol(round($method->cost)) }}
                </span>
            </li>
        @endforeach
    </ul>
    <div class="checkout__card__footer__estimate d-flex justify-content-end" style="display: none !important;">
        <div class="checkout__card__footer__estimate__main">
            <div class="checkout__card__footer__estimate__list">
                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                    <b>{{ __('Sub Total') }}</b>
                    <b id="vendor_subtotal" class="vendor_subtotal">
                        {{ float_amount_with_currency_symbol($subtotal) }}
                    </b>
                </div>
                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                    <b>{{ __('Shipping Cost') }}</b>
                    <b id="vendor_shipping_cost" class="vendor_shipping_cost">
                        {{ float_amount_with_currency_symbol($default_shipping_cost) }}
                    </b>
                </div>
                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                    <b>{{ __('Total') }}</b>
                    <b id="vendor_total">
                        {{ float_amount_with_currency_symbol($subtotal + $default_shipping_cost) }}
                    </b>
                </div>
            </div>
        </div>
    </div>
</div>
