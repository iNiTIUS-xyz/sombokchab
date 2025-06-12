@extends('frontend.frontend-page-master')

@section('page-title')
    @if (request()->get('keyword') || request()->get('category_id'))
        {{ __('Your Search Result') }}
    @else
        {{ __('All Categories') }}
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
            <div class="shop-contents-wrapper style-02 gap-3">
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
                                        <select id="order_by" name="order_by">
                                            <option value="latest"> {{ __('Latest') }} </option>
                                            <option value="oldest"> {{ __('Oldest') }} </option>
                                            <option value="price_low_high"> {{ __('Price: Low to High') }} </option>
                                            <option value="price_high_low"> {{ __('Price: High to Low') }} </option>
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
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderBySelect = document.getElementById('order_by');

            orderBySelect.addEventListener('change', function() {
                const params = new URLSearchParams(window.location.search);
                params.set('order_by', this.value);
                window.location.href = `${window.location.pathname}?${params.toString()}`;
            });

            const currentOrderBy = new URLSearchParams(window.location.search).get('order_by');
            if (currentOrderBy) {
                orderBySelect.value = currentOrderBy;
            }
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle category and brand list items
            document.querySelectorAll('.shop-lists .list').forEach(item => {
                item.addEventListener('click', function(e) {
                    // Prevent default if it's a link (but still process our logic)
                    const isLink = e.target.tagName === 'A';
                    if (isLink) e.preventDefault();

                    // Get current URL parameters
                    const params = new URLSearchParams(window.location.search);
                    const paramName = this.closest('.shop-left-title').querySelector('.title')
                        .textContent.trim().toLowerCase();
                    const itemId = this.querySelector('a')?.getAttribute('href').match(
                        /(category_id|brand_id)=(\d+)/)?.[2];

                    if (this.classList.contains('active')) {
                        // If active, remove the class and remove from URL
                        this.classList.remove('active');
                        params.delete(paramName === 'category' ? 'category_id' : 'brand_id');
                    } else {
                        // If not active, add the class and add to URL
                        this.classList.add('active');
                        if (itemId) {
                            params.set(paramName === 'category' ? 'category_id' : 'brand_id',
                                itemId);
                        }
                    }

                    // Update URL (without page reload if you prefer)
                    const newUrl = `${window.location.pathname}?${params.toString()}`;
                    if (isLink) {
                        window.location.href = newUrl;
                    } else {
                        history.pushState({}, '', newUrl);
                        // You might want to add AJAX loading of products here
                    }
                });
            });

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

            // Initialize active states from URL
            function initActiveStates() {
                const params = new URLSearchParams(window.location.search);
                const categoryId = params.get('category_id');
                const brandId = params.get('brand_id');

                if (categoryId) {
                    document.querySelector(`.shop-lists .list a[href*="category_id=${categoryId}"]`)?.parentElement
                        .classList.add('active');
                }

                if (brandId) {
                    document.querySelector(`.brand-list .list a[href*="brand_id=${brandId}"]`)?.parentElement
                        .classList.add('active');
                }
            }

            initActiveStates();
        });
    </script>
@endsection
