@php
    $productPageSlug = \App\Page::select('slug')
        ->where('id', get_static_option('product_page'))
        ->first();
@endphp

<!-- All Product area Starts -->
<section class="allProduct_area padding-top-20 padding-bottom-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-left">
                    <h2 class="title">{{ $section_title }}</h2>
                    <a href="{{ route('frontend.dynamic.page', $productPageSlug->slug) }}"
                        class="browseAl">{{ __('Browse All') }}</a>
                </div>
            </div>
        </div>
        <div class="row g-4 row-cols-xl-6 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-vxxs-2 row-cols-1 mt-4">
            @foreach ($products as $product)
                @php
                    $campaign_product = $product->campaign_product ?? null;
                    $campaignProductEndDate = $product->campaign->end_date ?? ($product->campaign->end_date->end_date ?? '');
                    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
                    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
                    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
                    $campaignSoldCount = $product?->campaign_sold_product;
                    $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : optional($product->inventory)->stock_count;
                    $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ? $stock_count : 0;
                    $rating_width = round(($product->ratings_avg_rating ?? 0) * 20);
                    $campaign_percentage = round($campaign_percentage, 0);
                @endphp
                <div class="col wow fadeInUp" data-wow-delay=".{{ $loop->iteration }}s">
                    <div class="product_card">
                        <div class="product_card__thumb">
                            <a href="{{ route('frontend.products.single', $product->slug) }}"
                                class="product_card__thumb__bgImg"
                                style="{{ render_image($product->image, render_type: 'bg') }}">
                            </a>
                            @if ($campaign_percentage > 0)
                                <div class="product_card__thumb__percent">
                                    <span class="percent-box">-{{ $campaign_percentage }}%</span>
                                </div>
                            @endif
                            <ul class="product_card__thumb__icons hover-color-one">
                                <x-product::frontend.common.link-option :$product />
                            </ul>
                        </div>
                        <div class="product_card__contents">
                            <h5 class="product_card__title">
                                <a href="{{ route('frontend.products.single', $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <h4 class="product_card__price mt-2">
                                {{ float_amount_with_currency_symbol(calculatePrice($sale_price, $product)) }}
                                <s>{{ float_amount_with_currency_symbol(calculatePrice($deleted_price, $product)) }}</s>
                            </h4>

                            <div class="rating-wrap mt-2">
                                <div class="rating-wrap">
                                    <x-product::frontend.common.rating-markup :rating-count="$product->ratings_count" :avg-rattings="$product->ratings_avg_rating ?? 0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- All Product area end -->
