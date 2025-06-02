@extends('frontend.frontend-page-master')

@section('page-title')
    @if (request()->get('keyword'))
        {{ __('Search Result') }}
    @else
        {{ __('Shop') }}
    @endif
@endsection

@section('content')
    @php
        $all_category = Modules\Attributes\Entities\Category::query()
            ->with(['subcategory', 'subcategory.childcategory'])
            ->get();
        $all_brands = Modules\Attributes\Entities\Brand::get();
        $min_price = 0;
        $max_price = 1000;
    @endphp

    <section class="signin-area padding-top-20 padding-bottom-20">
        <div class="container container-one">
            <div class="shop-contents-wrapper style-02">
                <div class="shop-icon shop-icon-text">
                    <div class="sidebar-icon sidebar-icon-text">
                        Filter
                    </div>
                </div>
                <div class="shop-sidebar-content">
                    <div class="shop-close-main">
                        <div class="close-bars">
                            <i class="las la-times"></i>
                        </div>
                        <div class="single-shop-left border-1">
                            <div class="shop-left-title open">
                                <h5 class="title"> {{ __('Category') }} </h5>
                                <div class="shop-left-list margin-top-15">
                                    <ul class="shop-lists active-list">
                                        @foreach ($all_category as $category)
                                            <li class="list @if (request('category_id') == $category->id) active @endif">
                                                <a
                                                    href="{{ route('frontend.dynamic.shop.page', ['keyword' => request('keyword'), 'category_id' => $category->id]) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="single-shop-left border-1 margin-top-40">
                            <div class="shop-left-title open">
                                <h5 class="title"> {{ __('Brands') }} </h5>
                                <div class="shop-left-list margin-top-15">
                                    <ul class="shop-lists active-list brand-list">
                                        @foreach ($all_brands as $brand)
                                            <li class="list @if (request('brand_id') == $brand->id) active @endif">
                                                <a
                                                    href="{{ route('frontend.dynamic.shop.page', ['keyword' => request('keyword'), 'category_id' => request('category_id'), 'brand_id' => $brand->id]) }}">
                                                    {{ $brand->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shop-grid-contents">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-5">
                            <div class="shop-left">
                                <div class="single-shops">
                                    <ul class="shop-flex-icon tabs">
                                        <li class="shop-icons" data-tab="tab-grid">
                                            <a href="javascript:;" class="icon"> <i class="las la-bars"></i> </a>
                                        </li>
                                        <li class="shop-icons active" data-tab="tab-grid2">
                                            <a href="javascript:;" class="icon"> <i class="las la-border-all"></i> </a>
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
                                            <option value="desc"> {{ __('Order By Desc') }} </option>
                                            <option value="asc"> {{ __('Order By ASC') }} </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="preloader-parent-wrapper d-none">
                        <div class="shop-page-preloader pre-loader">
                            <!-- partial:index.partial.html -->
                            <div class="shape">
                                <div class="circle"></div>
                                <div class="circle"></div>
                                <div class="circle"></div>
                            </div>
                            <div class="shadow-loader">
                                <div class="shape-shadow"></div>
                                <div class="shape-shadow"></div>
                                <div class="shape-shadow"></div>
                            </div>
                            <!-- partial -->
                        </div>
                    </div>
                    <div id="tab-grid2" class="tab-content-item active">
                        <div class="row mt-4">
                            @foreach ($products as $product)
                                <x-product::frontend.grid-style-06 :$product />
                            @endforeach
                        </div>
                    </div>

                    <div id="tab-grid" class="tab-content-item">
                        <div class="row mt-4">
                            @foreach ($products as $product)
                                <x-product::frontend.grid-style-03 :$product />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        //
    </script>
@endsection
