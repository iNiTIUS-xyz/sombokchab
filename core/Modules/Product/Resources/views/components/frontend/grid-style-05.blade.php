@php
    $attributes = $product?->inventory_detail_count ?? null;
    $campaign_product = $product->campaign_product ?? null;

    $campaignProductEndDate =
        $product->campaign->end_date
        ?? ($product->campaign->end_date->end_date ?? null);

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
    $filter = $filter ?? false;
@endphp

<div class="col-xxl-2 col-xl-4 col-md-4 col-sm-6 my-0">
    <div class="product__card my-3">

        {{-- Product Image --}}
        <div class="product__card__thumb">
            <a href="{{ route('frontend.products.single', $product->slug) }}">
                {!! render_image($product->image) !!}
            </a>

            {{-- Badge & Discount (REUSED COMPONENT) --}}
            {!! view(
                'product::components.frontend.common.badge-and-discount',
                compact('product', 'campaign_percentage')
            ) !!}
        </div>

        {{-- Product Contents --}}
        <div class="product__card__contents mt-3">

            {{-- Title --}}
            <h6 class="product__card__contents__title mt-2">
                <a href="{{ route('frontend.products.single', $product->slug) }}">
                    {{ langWiseShowValue(
                        Str::limit($product->name, 25, '...'),
                        Str::limit($product->name_km, 25, '...')
                    ) }}
                </a>
            </h6>

            {{-- Rating --}}
            <div class="rating-wrap">
                <x-product::frontend.common.rating-markup
                    :rating-count="$product->ratings_count"
                    :avg-rattings="$product->ratings_avg_rating ?? 0"
                />
            </div>

            {{-- Price --}}
            <div class="product__price">
                <span class="product__price__current color-two">
                    {{ float_amount_with_currency_symbol(calculatePrice($sale_price, $product)) }}
                </span>

                @if($deleted_price)
                    <s class="product__price__old">
                        {{ float_amount_with_currency_symbol(calculatePrice($deleted_price, $product)) }}
                    </s>
                @endif
            </div>

            {{-- Cart Actions --}}
            <div class="product__card__cart mt-3">
                @if ($stock_count <= 0)
                    <button type="button"
                            class="product__card__cart__outline radius-30 out-of-stock-btn"
                            disabled>
                        {{ __('Out of Stock') }}
                    </button>
                @else
                    @if (isset($attributes) && $attributes > 0)
                        <a href="{{ route('frontend.products.single', $product->slug) }}"
                           class="product__card__cart__btn radius-30"
                           title="{{ __('View Details') }}">
                            {{ __('View Details') }}
                        </a>
                    @else
                        <a href="#1"
                           data-id="{{ $product->id }}"
                           data-attributes="{{ $product->attribute }}"
                           data-old-text="{{ __('Add To Cart') }}"
                           class="product__card__cart__outline radius-30 add_to_cart_ajax"
                           title="{{ __('Add To Cart') }}">
                            {{ __('Add To Cart') }}
                        </a>
                    @endif
                @endif

                {{-- Right Icons --}}
                <div class="product__card__cart__right">
                    <a href="javascript:void(0)"
                       data-id="{{ $product->id }}"
                       title="{{ __('Add To Compare') }}"
                       class="product__card__cart__btn__icon cart-loading icon add_to_compare_ajax">
                        <i class="las la-retweet"></i>
                    </a>

                    @if (isset($attributes) && $attributes > 0)
                        <a href="#1"
                           title="{{ __('View Details') }}"
                           class="product-quick-view-ajax favourite icon cart-loading product__card__cart__btn__icon"
                           data-action-route="{{ route('frontend.products.single-quick-view', $product->slug) }}">
                            <i class="lar la-save"></i>
                        </a>
                    @else
                        <a href="#1"
                           data-id="{{ $product->id }}"
                           title="{{ __('Save For Later') }}"
                           class="add_to_wishlist_ajax icon cart-loading product__card__cart__btn__icon">
                            <i class="lar la-save"></i>
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
