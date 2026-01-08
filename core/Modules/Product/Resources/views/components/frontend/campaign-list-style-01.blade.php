@php
    $attributes = $product?->inventory_detail_count ?? null;
    $campaign_product = $product->campaign_product ?? null;

    $campaignEndDate =
        optional($campaign_product?->campaign)->end_date
        ?? optional($product->campaign)->end_date;

    $sale_price = $campaign_product
        ? optional($campaign_product)->campaign_price
        : $product->sale_price;

    $deleted_price = !is_null($campaign_product)
        ? $product->sale_price
        : $product->price;

    $campaign_percentage = !is_null($campaign_product)
        ? getPercentage($product->sale_price, $sale_price)
        : false;

    $stock_count = optional($product->inventory)->stock_count;
    $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ?? 0
        ? $stock_count
        : 0;

    $isAllowBuyNow = $isAllowBuyNow ?? false;
@endphp

<div class="col-xxl-4 col-xl-4 col-md-6 col-12 mt-4 campaign-counter"
     @if($campaignEndDate)
         data-date="{{ $campaignEndDate->format('Y-m-d H:i:s') }}"
     @endif
>
    <div class="shop-list-wrapper single-border">
        <div class="shop-wrapper-flex">

            {{-- LEFT SIDE --}}
            <div class="signle-shop-list">
                <div class="shop-list-flex">

                    {{-- Image --}}
                    <div class="shop-thumbs">
                        <a href="{{ route('frontend.products.single', $product->slug) }}">
                            {!! render_image($product->image) !!}
                        </a>

                        {{-- Badge & Discount (SAME AS SLIDER) --}}
                        {!! view(
                            'product::components.frontend.common.badge-and-discount',
                            compact('product', 'campaign_percentage')
                        ) !!}

                        {{-- Countdown --}}
                        @if($campaignEndDate)
                            <div class="campaign-countdown">
                                <span class="counter-days"></span>d
                                <span class="counter-hours"></span>h
                                <span class="counter-minutes"></span>m
                                <span class="counter-seconds"></span>s
                            </div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="shop-list-contents">
                        <h2 class="common-title">
                            <a href="{{ route('frontend.products.single', $product->slug) }}">
                                {{ langWiseShowValue(
                                    Str::limit($product->name, 25, '...'),
                                    Str::limit($product->name_km, 25, '...')
                                ) }}
                            </a>
                        </h2>

                        {{-- Stock --}}
                        <div class="stock-available mb-1 {{ $stock_count > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $stock_count > 0 ? __('In Stock') . " ($stock_count)" : __('Out of Stock') }}
                        </div>

                        {{-- Rating --}}
                        <div class="rating-wrap">
                            <x-product::frontend.common.rating-markup
                                :rating-count="$product->ratings_count"
                                :avg-rattings="$product->ratings_avg_rating ?? 0"
                            />
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="single-shop-cart center-text">
                <h2 class="price-title">
                    {{ float_amount_with_currency_symbol(calculatePrice($sale_price, $product)) }}
                    <span class="old-price d-block">
                        {{ float_amount_with_currency_symbol(calculatePrice($deleted_price, $product)) }}
                    </span>
                </h2>

                {{-- Cart Button --}}
                <div class="shop-cart-flex mt-3">
                    <div class="btn-wrapper">
                        @if ($stock_count <= 0)
                            <button class="cmn-btn btn-bg-1 btn-small radius-0" disabled>
                                {{ __('Out of Stock') }}
                            </button>
                        @else
                            @if ($attributes > 0)
                                <a href="{{ route('frontend.products.single', $product->slug) }}"
                                   class="cmn-btn btn-bg-1 btn-small radius-0">
                                    {{ __('View Details') }}
                                </a>
                            @else
                                <a href="#1"
                                   data-id="{{ $product->id }}"
                                   data-attributes="{{ $product->attribute }}"
                                   class="cmn-btn btn-bg-1 btn-small radius-0 add_to_cart_ajax">
                                    {{ __('Add To Cart') }}
                                </a>
                            @endif
                        @endif
                    </div>
                </div>

                {{-- Action Icons --}}
                <div class="btn-shop-botttom mt-3">
                    <ul class="global-thumb-icons">
                        {!! view(
                            'product::components.frontend.common.link-option',
                            compact('product', 'attributes', 'isAllowBuyNow', 'stock_count')
                        ) !!}
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
