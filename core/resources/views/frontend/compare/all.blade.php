@extends('frontend.frontend-page-master')
@section('page-title', __('Compare'))

@section('style')
    <style>
        .only-img-page-wrapper.cart .img-box img {
            height: 100%;
        }

        .only-img-page-wrapper.cart .img-box {
            height: 400px;
            display: flex;
            justify-content: center;
        }

        .icon.cart-loading.product__card__cart__btn__icon.remove_compare_item_ajax{
            border: 1px solid var(--danger-color);
        }
        
        .icon.cart-loading.product__card__cart__btn__icon.remove_compare_item_ajax i{
            color: var(--danger-color);
        }

        .icon.cart-loading.product__card__cart__btn__icon.remove_compare_item_ajax:hover{
            background: var(--danger-color);
        }
        
        .icon.cart-loading.product__card__cart__btn__icon.remove_compare_item_ajax:hover i{
            color: var(--white) !important;
        }
    </style>
@endsection

@php
    $setting_text = \App\StaticOption::whereIn('option_name', [
        'product_in_stock_text',
        'product_out_of_stock_text',
        'details_tab_text',
        'additional_information_text',
        'reviews_text',
        'your_reviews_text',
        'write_your_feedback_text',
        'post_your_feedback_text',
    ])
        ->get()
        ->mapWithKeys(fn($item) => [$item->option_name => $item->option_value])
        ->toArray();

    $products = \Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->content();

@endphp

@section('content')
    <!-- Compare Area Starts -->
    <section class="compare-area padding-top-100 padding-bottom-100">
        <div class="container ">
            <div class="row g-4">
                @forelse($products as $product)
                    {{-- @php
                        $product_inventory = \Modules\Product\Entities\ProductInventory::where(
                            'product_id',
                            $product->id,
                        )->first();

                        $campaign_product = $product->campaign_product ?? null;
                        $campaignSoldCount = $product?->campaign_sold_product;
                        $stock_count = $campaign_product
                            ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0
                            : optional($product->inventory)->stock_count;

                        if ($product->options->variant_id ?? false) {
                            $product_inventory_details = \Modules\Product\Entities\ProductInventoryDetail::where(
                                'id',
                                $product->options->variant_id,
                            )->first();
                            $stock_count = $campaign_product
                                ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0
                                : $product_inventory_details->stock_count;
                        } else {
                            $product_inventory_details = null;
                        }

                        $stock_count =
                            $stock_count > (int) get_static_option('product_in_stock_limit_set') ? $stock_count : 0;
                    @endphp --}}
                    @php
                        $product_inventory = \Modules\Product\Entities\ProductInventory::where(
                            'product_id',
                            $product->id,
                        )->first();
                        $campaign_product = $product->campaign_product ?? null;
                        $campaignSoldCount = $product?->campaign_sold_product ?? null;
                        $stock_count = $campaign_product
                            ? $campaign_product->units_for_sale - (optional($campaignSoldCount)->sold_count ?? 0)
                            : optional($product->inventory)->stock_count;
                        // // Check if product has variants
                        // if ($product->options->variant_id ?? false) {
                        //     $product_inventory_details = \Modules\Product\Entities\ProductInventoryDetail::where(
                        //         'id',
                        //         $product->options->variant_id,
                        //     )->first();

                        //     // For variant products, use variant stock count (not campaign units)
                        //     $stock_count = $campaign_product
                        //         ? $campaign_product->units_for_sale - (optional($campaignSoldCount)->sold_count ?? 0)
                        //         : ($product_inventory_details->stock_count ?? 0);
                        // } else {
                        //     $product_inventory_details = null;
                        //     // For non-variant products, use main product stock
                        //     $stock_count = $campaign_product
                        //         ? $campaign_product->units_for_sale - (optional($campaignSoldCount)->sold_count ?? 0)
                        //         : optional($product->inventory)->stock_count;
                        // }

                        // Apply stock limit check
                        $stock_count =
                            $stock_count > (int) get_static_option('product_in_stock_limit_set') ? $stock_count : 0;
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="single-compare text-center">
                            <div class="compare-thumbs">
                                @if (!is_int($product->options->image))
                                    <a href="#1"> {!! render_image($product->options->image) !!} </a>
                                @endif
                            </div>
                            <div class="compare-contents mt-2">
                                <h5>
                                    <a href="{{ route('frontend.products.single', $product->options->slug ?? '') }}">
                                        {{-- {{ $product->name }} --}}
                                        {{ Str::limit($product->name, 100, '...') }}
                                    </a>
                                </h5>
                                <ul class="compare-review-list mt-2">
                                    <li class="rating-wrap">
                                        <div class="ratings">
                                            <span class="hide-rating"></span>
                                            <span class="show-rating"
                                                style="width: {{ $product->options->avg_review * 20 }}%!important"></span>
                                        </div>
                                        <p> <span class="total-ratings">({{ $product->options->review_count ?? 0 }})</span>
                                        </p>
                                    </li>
                                </ul>
                                <h4 class="common-price-title-four color-one mt-2">
                                    {{ float_amount_with_currency_symbol($product->price) }} </h4>
                                <ul class="compare-content-list mt-3">
                                    <li class="list">
                                        <span class="model"> {{ __('SKU:') }} {{ $product->options->sku }} </span>
                                    </li>
                                    <li class="list">
                                        <p class="common-para">
                                            {{ strip_tags($product->options->sort_description) }}
                                        </p>
                                    </li>
                                    {{-- <li class="list">
                                        @if ($stock_count > 0)
                                            <span
                                                class="availability">{{ filter_static_option_value('product_in_stock_text', $setting_text, __('In stock')) }}
                                                ({{ $stock_count }})
                                            </span>
                                        @else
                                            <span
                                                class="availability text-danger">{{ filter_static_option_value('product_out_of_stock_text', $setting_text, __('Sold out')) }}</span>
                                        @endif
                                    </li> --}}
                                    @if ($product->options->color_name ?? null)
                                        <li class="list">{{ __('Color:') }} <b class="">
                                                {{ $product->options->color_name }} </b> </li>
                                    @endif
                                    @if ($product->options->size_name ?? null)
                                        <li class="list">{{ __('Size:') }} <b class="">
                                                {{ $product->options->size_name }} </b> </li>
                                    @endif
                                    @if ($product->options->attributes ?? null)
                                        @foreach ($product->options->attributes as $key => $value)
                                            <li class="list">
                                                {{ $key }}:
                                                <b class="">
                                                    {{ $value }}
                                                </b>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <div class="btn-wrapper mt-2 d-flex">
                                    <a href="javascript:;" data-id="{{ $product->id }}"
                                        class="product__card__cart__outline radius-30 add_to_cart_ajax">
                                        <span class="icon-close">
                                            <i class="las la-shopping-cart"></i> Add to Cart
                                        </span>
                                    </a>
                                    <a href="javascript:;" data-id="{{ $product->id }}"
                                        class="add_to_wishlist_ajax icon cart-loading product__card__cart__btn__icon">
                                        <span class="icon-close">
                                            <i class="lar la-save"></i>
                                        </span>
                                    </a>
                                    <a href="#1" data-product_hash_id="{{ $product->rowId }}"
                                        class="icon cart-loading product__card__cart__btn__icon remove_compare_item_ajax" title="Remove">
                                        <i class="la la-times"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class=" cart-page-wrapper">
                            <x-frontend.page.empty :image="get_static_option('compare_empty_image')" :text="get_static_option('compare_title') ?? __('No products in your compare page!')" />
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Compare Area end -->
@endsection
@section('script')
    <script>
        (function($) {
            'use strict'

            $(document).on('click', '.remove_compare_item_ajax', function(e) {
                e.preventDefault();

                let formData = new FormData();
                formData.append("rowId", $(this).attr("data-product_hash_id"));
                formData.append("_token", "{{ csrf_token() }}");

                send_ajax_request("post", formData, "{{ route('frontend.products.compare.ajax.remove') }}",
                    () => {

                    }, (data) => {
                        loadHeaderCardAndWishlistArea(data);
                        ajax_toastr_success_message(data);
                        $(".compare-area").load(location.href + " .compare-area");
                    }, (errors) => {
                        prepare_errors(errors);
                    })
            });
        })(jQuery)
    </script>
@endsection
