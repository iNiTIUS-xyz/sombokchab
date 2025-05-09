@php
    $attributes = $product?->inventory_detail_count ?? null;
    $campaign_product = $product->campaign_product ?? null;
    $campaignProductEndDate = $product->campaign->end_date ?? $product->campaign->end_date->end_date ?? '';
    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
    $campaignSoldCount = $product?->campaign_sold_product;
    $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : optional($product->inventory)->stock_count;
    $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ?? 0 ? $stock_count : 0;
    $rating_width = round(($product->ratings_avg_rating ?? 0) * 20);
@endphp

<div class="single-trendy-products style-02">
    <div class="trendy-flex-content">
        <div class="trendy-thumb single-border radius-10">
            <a href="{{ route("frontend.products.single",$product->slug) }}">
                {!! render_image($product->image) !!}
            </a>

            {!! view('product::components.frontend.common.badge-and-discount', compact('product', 'campaign_percentage')) !!}
        </div>
        <div class="products-contents">
            <h5 class="common-title-three hover-color-two">
                <a href="{{ route("frontend.products.single",$product->slug) }}"> {{ Str::limit($product->name, 25, '...') }}</a>
            </h5>
            <div class="price-update-through mt-3">
                <span class="fs-20 fw-500 ff-rubik flash-prices color-two"> {{ float_amount_with_currency_symbol(calculatePrice($sale_price, $product)) }} </span>
                <span class="fs-16 flash-old-prices"> {{ float_amount_with_currency_symbol(calculatePrice($deleted_price, $product)) }} </span>
            </div>
        </div>
    </div>
</div>