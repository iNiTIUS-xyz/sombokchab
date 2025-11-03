@php
    $attributes = $product?->inventory_detail_count ?? null;
    $isOutOfStock = $stock_count <= 0;
@endphp

@if (isset($attributes) && $attributes > 0)
    <li class="lists">
        <a class="product-quick-view-ajax favourite icon cart-loading {{ $isOutOfStock ? 'text-danger disabled-link' : '' }}"
            href="#1" title="Add to cart"
            data-action-route="{{ route('frontend.products.single-quick-view', $product->slug) }}"
            @if ($isOutOfStock) disabled aria-disabled="true" @endif>
            <i class="las la-shopping-bag"></i>
        </a>
    </li>
@else
    <li class="lists">
        <a href="#1" data-attributes="{{ $product->attribute }}" data-id="{{ $product->id }}" title="Add to cart"
            class="icon cart-loading {{ $isOutOfStock ? 'text-danger disabled-link' : '' }} {{ $isAllowBuyNow ?? false ? 'add_to_buy_now_ajax' : 'add_to_cart_ajax' }}"
            @if ($isOutOfStock) disabled aria-disabled="true" @endif>
            <i class="las la-shopping-bag"></i>
        </a>
    </li>
@endif

@if (isset($attributes) && $attributes > 0)
    <li class="lists">
        <a class="product-quick-view-ajax favourite icon cart-loading {{ $isOutOfStock ? 'text-danger disabled-link' : '' }}"
            href="#1" title="Save for Later"
            data-action-route="{{ route('frontend.products.single-quick-view', $product->slug) }}"
            @if ($isOutOfStock) disabled aria-disabled="true" @endif>
            <i class="lar la-save"></i>
        </a>
    </li>
@else
    <li class="lists">
        <a href="#1" data-id="{{ $product->id }}"
            class="favourite add_to_wishlist_ajax icon cart-loading {{ $isOutOfStock ? 'text-danger disabled-link' : '' }}"
            title="Save for Later" @if ($isOutOfStock) disabled aria-disabled="true" @endif>
            <i class="lar la-save"></i>
        </a>
    </li>
@endif

<li class="lists">
    <a href="#1" data-id="{{ $product->id }}" class="favourite add_to_compare_ajax icon cart-loading "
        title="Add to compare" @if ($isOutOfStock) disabled aria-disabled="true" @endif>
        <i class="las la-retweet"></i>
    </a>
</li>

{{-- Optional Quick View --}}
{{--
<li class="lists">
    <a class="product-quick-view-ajax favourite icon cart-loading"
       href="#1"
       data-action-route="{{ route('frontend.products.single-quick-view', $product->slug) }}">
        <i class="lar la-eye"></i>
    </a>
</li>
--}}

<style>
    .disabled-link {
        pointer-events: none;
        opacity: 0.6;
        cursor: not-allowed !important;
    }
</style>
