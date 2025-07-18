@php
    $attributes = \Modules\Product\Entities\ProductInventoryDetails::where("product_id",$product->id)->count();

    $campaign_product = getCampaignProductById($product->id);
    $campaignProductEndDate = $product->campaign->end_date ?? $product->campaign->end_date->end_date ?? '';

    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;

    $campaignSoldCount = \Modules\Campaign\Entities\CampaignSoldProduct::where("product_id",$product->id)->first();
    $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : optional($product->inventory)->stock_count;
    $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ? $stock_count : 0;
@endphp
<div class="single-product-view-grid-style-01 product_card">
    <div class="product-thumb">
        <a href="{{ route('frontend.products.single', $product->slug) }}" class="img-link">
            {!! render_image_markup_by_attachment_id($product->image, '', 'grid', true) !!}
        </a>
        <ul class="other-content">
            @if(!empty($campaign_percentage))
                <li>
                    <span class="badge-tag">{{ round($campaign_percentage,0) }}%</span>
                </li>
            @endif
            @if(!empty($product->badge))
                <li>
                    <span class="discount-tag">{{ $product->badge }}</span>
                </li>
            @endif
        </ul>
        <ul class="other-content-2">
            @if(isset($attributes) && $attributes > 0)
                <li>
                    <a href="{{ route('frontend.products.single', $product->slug) }}" class="favourite">
                        <i class="las la-heart icon hover"></i>
                        <i class="lar la-save icon regular"></i>
                    </a>
                </li>
            @else
                <li>
                    <a href="#1" data-id="{{ $product->id }}" class="favourite add_to_wishlist_ajax">
                        <i class="las la-heart icon hover"></i>
                        <i class="lar la-save icon regular"></i>
                    </a>
                </li>
            @endif
            <li>
                <a href="#1" data-id="{{ $product->id }}" class="favourite add_to_compare_ajax">
                    <i class="las la-plus-square icon hover"></i>
                    <i class="lar la-plus-square icon regular"></i>
                </a>
            </li>

            @if(isset($attributes) && $attributes > 0)
                <li>
                    <a class="product-quick-view-ajax favourite" href="#1"
                       data-action-route="{{ route('frontend.products.single-quick-view', $product->slug) }}">
                        <i class="lar la-eye icon regular"></i>
                        <i class="lar la-eye icon hover"></i>
                    </a>
                </li>
            @else
                <li>
                    <a href="#1" {!! getQuickViewDataMarkup($product) !!} class="favourite quick-view">
                        <i class="lar la-eye icon regular"></i>
                        <i class="lar la-eye icon hover"></i>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <div class="product-content">
        <div class="main-content">
            @if(!is_null($product->category))
            <a href="{{ route('frontend.products.category', [
                                'id' => optional($product->category)->id,
                                'slug' => \Str::slug(optional($product->category)->title ?? 'x')
                            ]) }}" class="category">{{ optional($product->category)->title }}</a>
            @endif                
            <h4 class="product-title">
                <a href="{{ route('frontend.products.single', $product->slug) }}">{{ $product->title }}</a>
            </h4>
            <span class="quantity">{{ $product->uom?->quantity }} {{ $product->uom?->unit?->name }}</span>

            @if ($stock_count > 0)
                <span class="availability">{{ __('In stock') }} ({{ $stock_count }})</span>
            @else
                <span class="availability text-danger">{{ __('Sold out') }} ({{ $stock_count }})</span>
            @endif

            <div class="ratings">
                @if($product->ratingCount())
                {!! ratingMarkup($product->ratingAvg(), $product->ratingCount()) !!}
                @endif
            </div>
            <div class="product-pricing">
                <del>{{ float_amount_with_currency_symbol($deleted_price) }}</del>
                <span class="price">{{ float_amount_with_currency_symbol($sale_price) }}</span>
            </div>
        </div>
        <div class="hover-content">
            <div class="cart-control">
                <div class="value-button minus decrease"><i class="las la-minus"></i></div>
                <input type="number" name="quantity" class="qty_" value="1" />
                <div class="value-button plus increase"><i class="las la-plus"></i></div>
            </div>
            <div class="btn-wrapper">
                @if(isset($attributes) && $attributes > 0)
                    <a href="{{ route('frontend.products.single', $product->slug) }}" class="add-cart-style-01">{{ __('View Options') }}</a>
                @else
                    <a href="#1" data-attributes="{{ $product->attributes }}" data-id="{{ $product->id }}" class="add-cart-style-01 add_to_cart_ajax_with_quantity">{{ __('Add to Bag') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
