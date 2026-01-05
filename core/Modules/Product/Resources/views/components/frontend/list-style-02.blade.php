@php
    $attributes = $product?->inventory_detail_count ?? null;
    $campaign_product = $product->campaign_product ?? null;

    $campaignEndDate =
        optional($campaign_product?->campaign)->end_date
        ?? optional($product->campaign)->end_date;

    $sale_price = $campaign_product
        ? optional($campaign_product)->campaign_price
        : $product?->sale_price;

    $deleted_price = !is_null($campaign_product)
        ? $product?->sale_price
        : $product->price;

    $campaign_percentage = !is_null($campaign_product)
        ? getPercentage($product?->sale_price, $sale_price)
        : false;

    $stock_count = optional($product->inventory)->stock_count;
    $isAllowBuyNow = $isAllowBuyNow ?? false;
@endphp

<div class="slick-slider-items border-1 mt-4 campaign-counter"
     @if($campaignEndDate)
         data-date="{{ $campaignEndDate->format('Y-m-d H:i:s') }}"
     @endif
>
    <div class="single-flash-item">
        <div class="flash-flex-item">

            {{-- Image --}}
            <div class="flash-item-image radius-5">
                {!! render_image($product->image) !!}

                {{-- Badge & Discount --}}
                {!! view(
                    'product::components.frontend.common.badge-and-discount',
                    compact('product', 'campaign_percentage')
                ) !!}

                {{-- Action Icons --}}
                <ul class="flash-thumb-icons hover-color-two">
                    {!! view(
                        'product::components.frontend.common.link-option',
                        compact('product', 'attributes', 'isAllowBuyNow', 'stock_count')
                    ) !!}
                </ul>
            </div>

            {{-- Content --}}
            <div class="flash-item-contents">

                {{-- Countdown (ADDED) --}}
                @if($campaignEndDate)
                    <div class="campaign-countdown mb-2">
                        <span class="counter-days"></span>d
                        <span class="counter-hours"></span>h
                        <span class="counter-minutes"></span>m
                        <span class="counter-seconds"></span>s
                    </div>
                @endif

                {{-- Title --}}
                <h6 class="title hover-color-two">
                    <a href="{{ route('frontend.products.single', $product->slug) }}">
                        {{ langWiseShowValue($product->name, $product->name_km) }}
                    </a>
                </h6>

                {{-- Stock Status (ADDED) --}}
                <div class="stock-available mb-1 {{ $stock_count > 0 ? 'text-success' : 'text-danger' }}">
                    {{ $stock_count > 0 ? __('In Stock') . " ($stock_count)" : __('Out of Stock') }}
                </div>

                {{-- Rating --}}
                @if ($product->ratings_count > 0)
                    <div class="d-flex radius-5" style="height: 15px;">
                        <span class="product__card__review__icon">
                            <i class="las la-star" style="color: var(--review-color);"></i>
                        </span>
                        <x-product::frontend.common.rating-markup
                            :rating-count="$product->ratings_count"
                            :avg-rattings="$product->ratings_avg_rating ?? 0"
                        />
                    </div>
                @endif

                {{-- Price --}}
                <div class="price-update-through margin-top-15">
                    <span class="fs-20 fw-500 ff-rubik flash-prices color-one">
                        {{ float_amount_with_currency_symbol(calculatePrice($sale_price, $product)) }}
                    </span>

                    <span class="fs-16 flash-old-prices">
                        {{ float_amount_with_currency_symbol(calculatePrice($deleted_price, $product)) }}
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>
