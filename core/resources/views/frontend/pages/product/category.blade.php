@extends('frontend.frontend-page-master')
@section('page-title')
    {{ $category_name }}
@endsection
@section('site-title')
    {{ $category_name }}
@endsection
@section('page-meta-data')
    <meta name="description"
        content="{{ get_static_option('product_page_' . $user_select_lang_slug . '_meta_description') }}">
    <meta name="tags" content="{{ get_static_option('product_page_' . $user_select_lang_slug . '_meta_tags') }}">
@endsection

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
    </style>
@endsection

@section('content')
    <div class="shop-grid-area-wrapper left-sidebar mt-5" id="shop">
        <div class="container container_1608 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-5">
                            <div class="shop-left">
                                <div class="single-shops">
                                    <ul class="shop-flex-icon tabs">
                                        <li class="shop-icons" data-tab="tab-grid">
                                            <a href="javascript:;" class="icon">
                                                <i class="las la-bars"></i>
                                            </a>
                                        </li>
                                        <li class="shop-icons active" data-tab="tab-grid2">
                                            <a href="javascript:;" class="icon">
                                                <i class="las la-border-all"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7">
                            <div class="shop-right">
                                <div class="single-shops">
                                    <div class="shop-nice-select">
                                        <select id="order_by" data-type="order_by" data-val="order_by">
                                            <option value="desc"> {{ __('Latest') }} </option>
                                            <option value="asc"> {{ __('Oldest') }} </option>
                                            <option value="a-z"> {{ __('Product A to Z') }} </option>
                                            <option value="z-a"> {{ __('Product Z to A') }} </option>
                                            <option value="price_low_to_high"> {{ __('Price low to high') }} </option>
                                            <option value="price_high_to_low"> {{ __('Price high to low') }} </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="tab-grid2" class="tab-content-item active">
                        <div class="row mt-4">
                            @foreach ($all_products as $product)
                                <div class="col-xl-3 col-lg-4 col-sm-6 mt-4">
                                    <x-product::frontend.grid-style-03 :$product :$loop :isAllowBuyNow="get_static_option('enable_buy_now_button_on_shop_page') === 'on'" />
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="tab-grid" class="tab-content-item">
                        <div class="row mt-4">
                            @foreach ($all_products as $product)
                                <div class="col-xl-4 col-lg-4 col-sm-6 mt-4">
                                    <x-product::frontend.list-style-02 :$product :$loop :isAllowBuyNow="get_static_option('enable_buy_now_button_on_shop_page') === 'on'" />
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="pagination-default">
                                {!! $all_products->links() !!}
                            </div>
                        </div>
                    </div>
                    @if ($all_products->total() < 1)
                        <div class="cart-page-wrapper padding-top-100 padding-bottom-50">
                            <x-frontend.page.empty :image="get_static_option('empty_cart_image')" :text="__('No product found!')" />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Your existing order_by code
            const orderBySelect = document.getElementById('order_by');
            if (orderBySelect) {
                orderBySelect.addEventListener('change', function() {
                    const params = new URLSearchParams(window.location.search);
                    params.set('order_by', this.value);
                    window.location.href = `${window.location.pathname}?${params.toString()}`;
                });

                const currentOrderBy = new URLSearchParams(window.location.search).get('order_by');
                if (currentOrderBy) {
                    orderBySelect.value = currentOrderBy;
                }
            }

        });
    </script>
@endsection
