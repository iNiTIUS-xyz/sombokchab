@php
    $attributes = $product?->inventory_detail_count ?? null;
    $campaign_product = $product->campaign_product ?? null;
    $campaignProductEndDate = $product->campaign->end_date ?? ($product->campaign->end_date->end_date ?? '');
    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
    $campaignSoldCount = $product?->campaign_sold_product;
    // $stock_count = $campaign_product
    //     ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0
    //     : optional($product->inventory)->stock_count;
    // $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ?? 0 ? $stock_count : 0;

    $stock_count = optional($product->inventory)->stock_count;
    $filter = $filter ?? false;
@endphp

<div class="col-xxl-2 col-xl-3 col-md-4 col-sm-6 my-0">
    <div class="product__card my-3">
        @if ($campaign_percentage)
            <div class="product__offer">
                <span class="product__offer__para">{{ round($campaign_percentage) }}% {{ __('Off') }}</span>
            </div>
        @endif

        <div class="product__card__thumb">
            <a href="{{ route('frontend.products.single', $product->slug) }}">
                {!! render_image($product->image) !!}
            </a>
            
        </div>

        <div class="product__card__contents mt-3">
            <h6 class="product__card__contents__title mt-2">
                <a href="{{ route('frontend.products.single', $product->slug) }}">
                    {{ langWiseShowValue(Str::limit($product->name, 25, '...'), Str::limit($product->name_km, 25, '...')) }}
                </a>
            </h6>

            <div class="rating-wrap">
                <x-product::frontend.common.rating-markup :rating-count="$product->ratings_count" :avg-rattings="$product->ratings_avg_rating ?? 0" />
            </div>

            <div class="product__price">
                <span class="product__price__current color-two">
                    {{ float_amount_with_currency_symbol(calculatePrice($sale_price, $product)) }}
                </span>
                <s class="product__price__old">
                    {{ $deleted_price ? float_amount_with_currency_symbol(calculatePrice($deleted_price, $product)) : '' }}
                </s>
            </div>

            <div class="product__card__cart mt-3">
                @if ($stock_count <= 0)
                    <button type="button" class="product__card__cart__outline radius-30 out-of-stock-btn" disabled>
                        {{ __('Out of Stock') }}
                    </button>
                @else
                    @if (isset($attributes) && $attributes > 0)
                        <a data-type="text" data-old-text="{{ __('View Details') }}" title="{{ __('View Details') }}"
                            data-action-route="{{ route('frontend.products.single-quick-view', $product->slug) }}"
                            data-attributes="{{ $product->attributes }}" data-id="{{ $product->id }}"
                            class="product__card__cart__btn radius-30 product-quick-view-ajax {{ $class ?? '' }}">
                            {{ __('View Details') }}
                        </a>
                    @else
                        <a data-type="text" data-old-text="{{ __('Add To Cart') }}" href="#1" title="{{ __('Add To Cart') }}"
                            data-attributes="{{ $product->attribute }}" data-id="{{ $product->id }}"
                            class="product__card__cart__outline radius-30 add_to_cart_ajax {{ $class ?? '' }}">
                            {{ __('Add To Cart') }}
                        </a>
                    @endif
                @endif

                <div class="product__card__cart__right">
                    @if ($stock_count <= 0)
                        {{-- Disabled Compare for Out of Stock --}}
                        <button type="button" class="product__card__cart__btn__icon out-of-stock-btn"
                            title="Unavailable" disabled>
                            <i class="las la-retweet"></i>
                        </button>
                    @else
                        <a href="javascript:void(0)" data-id="{{ $product->id }}" title="Add to compare"
                            class="{{ $class ?? '' }} product__card__cart__btn__icon cart-loading icon add_to_compare_ajax">
                            <i class="las la-retweet"></i>
                        </a>
                    @endif

                    @if (isset($attributes) && $attributes > 0)
                        <a title="View Details"
                            class="{{ $class ?? '' }} product-quick-view-ajax favourite icon cart-loading product__card__cart__btn__icon"
                            href="#1"
                            data-action-route="{{ route('frontend.products.single-quick-view', $product->slug) }}">
                            <i class="lar la-save"></i>
                        </a>
                    @else
                        <a href="#1" data-id="{{ $product->id }}" title="Save for later"
                            class="{{ $class ?? '' }} add_to_wishlist_ajax icon cart-loading product__card__cart__btn__icon">
                            <i class="lar la-save"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
