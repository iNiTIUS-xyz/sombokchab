@extends('frontend.frontend-page-master')

@if (!empty($vendor))
    @section('page-title')
        {{ $vendor->business_name }} {{ __('Products') }}
    @endsection
@else
    @section('page-title')
        <span id="page-title-text">
            @if (request()->has('category'))
                {{ request()->get('category') }}
            @else
                {{ __('Products') }}
            @endif
        </span>
    @endsection
@endif

@section('style')
    <style>
        .preloader-parent-wrapper {
            position: relative;
            min-height: 600px;
        }

        .pre-loader {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            flex-direction: column;
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 99;
            transform: translate(-50%, -50%);
        }

        .pre-loader .shape {
            display: flex;
            justify-content: center;
            align-items: center;
            transform: translateY(-3em);
        }

        .pre-loader .shape .circle {
            width: 30px;
            height: 30px;
            background-color: var(--main-color-one);
            border-radius: 50%;
            margin: 0 1rem;
            animation: bounce 1.0s linear infinite;
        }

        .pre-loader .shape .circle:nth-child(2) {
            animation-delay: 0.1s;
        }

        .pre-loader .shape .circle:nth-child(3) {
            animation-delay: 0.2s;
        }

        .pre-loader .shadow-loader {
            display: flex;
            justify-content: center;
            align-items: center;
            transform: translateY(-3em);
        }

        .pre-loader .shadow-loader .shape-shadow {
            width: 30px;
            height: 18px;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            margin: 0 1rem;
            animation: bounceShadow 0.6s linear infinite;
            transform: translateY(3em) scale(0.5);
        }

        .pre-loader .shadow-loader .shape-shadow:nth-child(2) {
            animation-delay: 0.1s;
        }

        .pre-loader .shadow-loader .shape-shadow:nth-child(3) {
            animation-delay: 0.2s;
        }

        .border-1 {
            border-color: var(--main-color-one) !important;
        }

        @keyframes bounce {

            from,
            to {
                transform: translateY(0) scale(1, 1);
                animation-timing-function: ease-in;
            }

            45% {
                transform: translateY(3em) scale(1, 1);
                animation-timing-function: linear;
            }

            50% {
                transform: translateY(3em) scale(1.5, 0.5);
                animation-timing-function: linear;
            }

            100% {
                transform: translateY(3em) scale(1, 1);
                animation-timing-function: ease-out;
            }
        }

        @keyframes bounceShadow {

            from,
            to {
                transform: translateY(3em) scale(0.5);
                filter: blur(5px);
            }

            45% {
                transform: translateY(3em) scale(0.5);
            }

            50% {
                box-shadow: 20px 0 5px rgba(0, 0, 0, 0.1), -20px 0 5px rgba(0, 0, 0, 0.1);
            }

            100% {
                transform: translateY(3em) scale(0.5);
                box-shadow: unset;
            }
        }

        .selectder-filter-contents .selected-flex-list li a {
            color: var(--main-color-one) !important;
        }
    </style>
@endsection

@section('content')
    @php $item_width = 'col-lg-4'; @endphp

    <section class="shop-area padding-top-50 padding-bottom-50">
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
                                <h5 class="title"> {{ __('Categories') }} </h5>
                                <div class="shop-left-list margin-top-15">
                                    <ul class="shop-lists">
                                        @foreach ($all_category as $category)
                                            <li data-val="{{ $category->name }}" data-type="category"
                                                class="list menu-item-has-children {{ request('category') === $category->name ? 'active open' : '' }}">
                                                <a href="javascript:void(0)" class="text-dark">
                                                    {{ langWiseShowValue($category->name, $category->name_km) }}
                                                </a>
                                                <ul class="submenu {{ request('category') === $category->name ? 'show' : 'none' }}"
                                                    style="display: {{ request('category') === $category->name ? 'block' : 'none' }};">
                                                    @foreach ($category->subcategory as $sub_cat)
                                                        <li data-val="{{ $sub_cat->name }}" data-type="sub_category"
                                                            class="list {{ request('sub_category') === $sub_cat->name ? 'active' : '' }}">
                                                            <a href="javascript:void(0)" class="text-dark">
                                                                {{ langWiseShowValue($sub_cat->name, $sub_cat->name_km) }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="single-shop-left border-1 margin-top-40">
                            <div class="shop-left-title open">
                                <h5 class="title"> {{ __('Prices Range') }} </h5>
                                <div class="shop-left-list mt-4">
                                    <form class="price-range-slider" method="post" data-start-min="{{ $min_price }}"
                                        data-start-max="{{ $max_price }}" data-min="{{ $min_price }}"
                                        data-max="{{ $max_price }}" data-step="5">
                                        <div class="ui-range-slider"></div>
                                        <div class="ui-range-slider-footer">
                                            <div class="ui-range-values">
                                                <span class="ui-price-title"> {{ __('Prices') }}: </span>
                                                <div class="ui-range-value-min">{{ site_currency_symbol() }}<span
                                                        class="min_price">{{ $min_price }}</span>
                                                    <input id="min_price_search" data-type="min_price" type="hidden"
                                                        value="{{ $min_price }}">
                                                </div>-
                                                <div class="ui-range-value-max">{{ site_currency_symbol() }}<span
                                                        class="max_price">{{ $max_price }}</span>
                                                    <input id="max_price_search" data-type="max_price" type="hidden"
                                                        value="{{ $max_price }}">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="single-shop-left border-1 margin-top-40">
                            <div class="shop-left-title open">
                                <h5 class="title"> {{ __('Colors') }} </h5>
                                <div class="shop-left-list margin-top-15">
                                    <ul class="color-lists active-list">
                                        @foreach ($all_colors as $color)
                                            <li data-type="color" data-val="{{ $color->name }}" class="list">
                                                <a style="background-color: {{ $color->color_code }}!important"
                                                    class="radius-5" href="#1"> </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="single-shop-left border-1 margin-top-40">
                            <div class="shop-left-title open">
                                <h5 class="title"> {{ __('Sizes') }} </h5>
                                <div class="shop-left-list margin-top-15">
                                    <ul class="size-lists active-list" data-type="size">
                                        @foreach ($all_sizes as $size)
                                            <li data-type="size" data-val="{{ $size->name }}" data-type="size"
                                                class="list">
                                                <a class="radius-5" href="#1"> {{ $size->name }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                        <div class="single-shop-left border-1 margin-top-40">
                            <div class="shop-left-title open">
                                <h5 class="title"> {{ __('Filter By Rating') }} </h5>
                                <div class="shop-left-list">
                                    <ul class="filter-lists active-list margin-top-20 review-filter">
                                        <li data-type="rating" data-val="5" class="list">
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                        </li>
                                        <li data-type="rating" data-val="4" class="list">
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="lar la-star"></i> </a>
                                        </li>
                                        <li data-type="rating" data-val="3" class="list">
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="lar la-star"></i> </a>
                                            <a href="#1"> <i class="lar la-star"></i> </a>
                                        </li>
                                        <li data-type="rating" data-val="2" class="list">
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="lar la-star"></i> </a>
                                            <a href="#1"> <i class="lar la-star"></i> </a>
                                            <a href="#1"> <i class="lar la-star"></i> </a>
                                        </li>
                                        <li data-type="rating" data-val="1" class="list">
                                            <a href="#1"> <i class="las la-star"></i> </a>
                                            <a href="#1"> <i class="lar la-star"></i> </a>
                                            <a href="#1"> <i class="lar la-star"></i> </a>
                                            <a href="#1"> <i class="lar la-star"></i> </a>
                                            <a href="#1"> <i class="lar la-star"></i> </a>
                                        </li>
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
                                            <li data-type="brand" data-val="{{ $brand->name }}" class="list">
                                                <a href="#1" class="text-dark">
                                                    {{ langWiseShowValue($brand->name, $brand->name_km) }}
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
                    @if (get_static_option('shop_filter_by_location') === 'on')
                        <div class="mb-4 mx-2 ">
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <div class="shop-nice-select ">
                                                <label for="" class="d-block text-black mb-2">Country</label>
                                                @php
                                                    $countries = \Modules\CountryManage\Entities\Country::all();
                                                @endphp
                                                <select id="country" data-type="country" data-val="country"
                                                    class="search_location">
                                                    <option value="">{{ __('Select an Country') }}</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="shop-nice-select">
                                                <label for="" class="d-block text-black mb-2">City</label>
                                                <select id="city" data-type="city" data-val="city"
                                                    class="search_location">
                                                    <option value="">{{ __('Select an City') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="shop-nice-select">
                                                <label for="" class="d-block text-black mb-2">State</label>
                                                <select id="state" data-type="state" data-val="state"
                                                    class="search_location">
                                                    <option value="">{{ __('Select an State') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-5">
                            <div class="shop-left">
                                <div class="single-shops">
                                    <ul class="shop-flex-icon tabs">
                                        <li class="shop-icons" data-tab="tab-grid">
                                            <a href="#1" class="icon"> <i class="las la-bars"></i> </a>
                                        </li>
                                        <li class="shop-icons active" data-tab="tab-grid2">
                                            <a href="#1" class="icon"> <i class="las la-border-all"></i> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7">
                            <div class="shop-right">
                                <span class="showing-results showing-results-item-count color-light"> {{ __('Showing') }}
                                    {{ $all_products['from'] }}-{{ $all_products['to'] }} {{ __('of') }}
                                    {{ $all_products['total_items'] }} {{ __('results') }} </span>
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
                        <div class="col-lg-12">
                            <div class="selectder-filter-contents click-hide-filter mt-4">
                                <p> {{ __('Filter Terms:') }} </p>
                                <ul class="selected-flex-list">
                                    @include('product::frontend.search.selected-search-item')
                                </ul>
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
                            @foreach ($all_products['items'] as $product)
                                <x-product::frontend.grid-style-07 :$product :$loop :isAllowBuyNow="get_static_option('enable_buy_now_button_on_shop_page') === 'on'" />
                            @endforeach
                        </div>
                    </div>

                    <div id="tab-grid" class="tab-content-item">
                        <div class="row mt-4">
                            @foreach ($all_products['items'] as $product)
                                <div class="col-xl-6 col-lg-6 col-sm-12">
                                    <x-product::frontend.list-style-02 :$product :$loop :isAllowBuyNow="get_static_option('enable_buy_now_button_on_shop_page') === 'on'" />
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if (($all_products['total_page'] ?? 0) > 1)
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pagination-default">
                                    <div class="pagination">
                                        <x-load-more-pagination :all_products="$all_products" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.product.product-filter-form')
@endsection
@section('script')
    @include('frontend.partials.product.product-filter-script')
    <script>
        $(document).ready(function() {
            // Trigger form submission if category, subcategory, or child category is selected
            if ($('#category').val() || $('#sub_category').val() || $('#child_category').val()) {
                submitForm();
            }

            // Ensure submenu is expanded for active parent category
            $('.shop-lists .list.active').each(function() {
                $(this).parents('.submenu').addClass('show');
                $(this).parents('.shop-left-title').addClass('open');
            });
        });


        $(document).on("submit", "#search_product", function(e) {
            e.preventDefault();

            const activeTab = $('.tab-content-item.active');
            const preloaderWrapper = $('.preloader-parent-wrapper');

            activeTab.removeClass('active');
            preloaderWrapper.removeClass('d-none');
            preloaderWrapper.addClass('d-block');
            send_ajax_request($(this).attr("method"), new FormData(e.target), $(this).attr("action") + "?" + $(this)
                .serialize(),
                () => {

                }, (data) => {
                    $("#tab-grid2").html(data.grid);
                    $("#tab-grid").html(data.list);
                    $(".selected-flex-list").html(data.selected_search)
                    $(".showing-results-item-count").html(data.showing_items)
                    $(".pagination").html(data.pagination_list)

                    preloaderWrapper.removeClass('d-block');
                    preloaderWrapper.addClass('d-none');
                    activeTab.addClass('active');
                }, () => {
                    preloaderWrapper.removeClass('d-block');
                    preloaderWrapper.addClass('d-none');
                    activeTab.addClass('active');
                }
            );
        });

        // close-search-selected-item
        // clear-search
        $(document).on('click', '.close-search-selected-item', function() {
            $("#" + $(this).attr('data-key')).val('');

            submitForm();
        })

        $(document).on('click', '.clear-search', function() {
            $('.close-search-selected-item').each(function() {
                $("#" + $(this).attr('data-key')).val('');
            })

            submitForm();
        })

        function submitForm() {
            $("#search_product").trigger("submit");
        }

        // write code for ajax pagination
        $(document).on("click", ".pagination a", function(e) {
            e.preventDefault();

            $("#search_page").val($(this).attr("data-page-index"));

            submitForm();
        });

        // $(document).on("click", ".list[data-type=category] a", function() {
        //     $("#" + $(this).parent().attr("data-type")).val($(this).parent().attr("data-val"));

        //     let categoryName = $(this).parent().attr("data-val");

        //     $("#page-title-text").text(categoryName);
        //     submitForm();
        // });

        // $(document).on("click", ".list[data-type=sub_category] a", function() {
        //     let $parent = $(this).parent();
        //     let subCategoryName = $parent.attr("data-val");

        //     $parent.siblings("[data-type=sub_category]").removeClass("active");

        //     $parent.addClass("active");

        //     $("#" + $parent.attr("data-type")).val(subCategoryName);

        //     $("#page-title-text").text(subCategoryName);

        //     submitForm();
        // });

        $(document).on("click", ".list[data-type=category] a", function() {
            const $li = $(this).parent();
            const catName = $li.attr("data-val");

            $("#category").val(catName);
            $("#sub_category").val('');
            $("#child_category").val('');

            $("#page-title-text").text(catName);

            submitForm();
        });

        $(document).on("click", ".list[data-type=sub_category] a", function() {
            const $li = $(this).parent();
            const subCatName = $li.attr("data-val");

            const $parentCatLi = $li.closest('.menu-item-has-children[data-type=category]');
            const parentCatName = $parentCatLi.attr("data-val") || '';

            $("#category").val(parentCatName);
            $("#sub_category").val(subCatName);
            $("#child_category").val('');

            $li.siblings("[data-type=sub_category]").removeClass("active");
            $li.addClass("active");

            $("#page-title-text").text(subCatName);

            submitForm();
        });


        $(document).on("click", ".list[data-type=child_category] a", function() {
            let $parent = $(this).parent();
            let childCategoryName = $parent.attr("data-val");

            $parent.siblings("[data-type=child_category]").removeClass("active");

            $parent.addClass("active");

            $("#" + $parent.attr("data-type")).val(childCategoryName);

            $("#page-title-text").text(childCategoryName);

            submitForm();
        });

        $(document).on("click", ".color-lists .list[data-type=color] a", function() {
            $("#" + $(this).parent().attr("data-type")).val($(this).parent().attr("data-val"));

            submitForm();
        });

        $(document).on("click", ".size-lists .list[data-type=size] a", function() {
            $("#" + $(this).parent().attr("data-type")).val($(this).parent().attr("data-val"));

            submitForm();
        });

        $(document).on("click", ".brand-list .list[data-type=brand] a", function() {
            $("#" + $(this).parent().attr("data-type")).val($(this).parent().attr("data-val"));

            submitForm();
        });

        $(document).on("click", ".review-filter .list[data-type=rating] a", function() {
            $("#" + $(this).parent().attr("data-type")).val($(this).parent().attr("data-val"));

            submitForm();
        });

        $(document).on('click', '.active-list .list a', function() {
            $(this).parent().siblings().removeClass('active');
            $(this).parent().siblings().find('.submenu .list').removeClass('active');
            $(this).parent().addClass('active');
        });

        $(document).on("change", "#order_by", function() {
            $("#search_order_by").val($(this).val());

            submitForm();
        });

        $(document).on("change", "#country", function() {
            $("#search_country").val($(this).val());

            submitForm();
        });
        $(document).on("change", "#state", function() {
            $("#search_state").val($(this).val());

            submitForm();
        });
        $(document).on("change", "#city", function() {
            $("#search_city").val($(this).val());

            submitForm();
        });

        $(document).on("change", "#country", function() {
            // first i need to get all states
            // get all shipping methods
            // insert all shipping methods on .all-shipping-options
            // Add tax amount to all the orders
            let country_id = $(this).val();
            let data = new FormData();
            data.append("id", country_id);
            data.append("type", "country");
            data.append("_token", "{{ csrf_token() }}");

            send_ajax_request("POST", data, "{{ route('frontend.shipping.module.methods') }}", () => {

            }, (data) => {
                if (data.success) {
                    let statehtml = "<option value=''> {{ __('Select an state') }} </option>";
                    data?.states?.forEach((state) => {
                        statehtml += "<option value='" + state.id + "'>" + state.name +
                            "</option>";
                    });

                    $('#state').html(statehtml);

                }
            }, function(xhr) {
                ajax_toastr_error_message(xhr);
            })
        });
        $(document).on("change", "#state", function() {
            // first, i need to get all states
            // to get all shipping methods
            // to insert all shipping methods on .all-shipping-options
            // Add tax amount to all the orders
            let state_id = $(this).val();
            let data = new FormData();
            data.append("id", state_id);
            data.append("type", "state");
            data.append("_token", "{{ csrf_token() }}");

            send_ajax_request("POST", data, "{{ route('frontend.shipping.module.methods') }}", () => {

            }, (data) => {
                if (data.success) {


                    let cityhtml = "<option value=''> {{ __('Select an city') }} </option>";
                    data?.cities?.forEach((city) => {
                        cityhtml += "<option value='" + city.id + "'>" + city.name +
                            "</option>";
                    });
                    $("#city").html(cityhtml);

                }
            }, function(xhr) {
                ajax_toastr_error_message(xhr);
            })
        });
    </script>
    <script>
        $(function() {

            $(document).on('click', '#load_more_button', function(e) {
                e.preventDefault();

                let button = $(this);
                if (button.prop('disabled')) return;

                let currentPage = parseInt(button.data('current-page')) + 1;
                let totalPages = parseInt(button.data('total-pages'));
                let spinner = button.find('.btn-loading-spinner');

                spinner.removeClass('d-none');
                button.prop('disabled', true);

                // set page in form
                $("#search_page").val(currentPage);

                $.ajax({
                    url: $("#search_product").attr('action') + "?" + $("#search_product")
                        .serialize(),
                    type: $("#search_product").attr('method') || 'GET',
                    data: new FormData($("#search_product")[0]),
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {

                        let gridItems = $(data.grid).find(
                            '.col-xxl-3, .col-xl-4, .col-md-4, .col-sm-6');
                        gridItems.addClass('new-loaded-item');
                        $('#tab-grid2 .row').append(gridItems);

                        let listItems = $(data.list);
                        $('#tab-grid .row').append(listItems);

                        button.data('current-page', currentPage);
                        if (currentPage >= totalPages) {
                            button.hide();
                        }

                        if (data.showing_items !== undefined) {
                            $(".showing-results-item-count").html(data.showing_items);
                        }

                        // scroll to first newly-added product
                        let firstNew = gridItems.first().length ? gridItems.first() : listItems
                            .first();
                        if (firstNew.length) {
                            $('html, body').animate({
                                scrollTop: firstNew.offset().top - 100
                            }, 500);
                        }
                    },
                    error: function(xhr, status, err) {
                        console.error('AJAX error:', status, err, xhr.responseText);
                        toastr.error('Error loading more products. Please try again.');
                    },
                    complete: function() {
                        spinner.addClass('d-none');
                        button.prop('disabled', false);
                    }
                });
            });

            // auto load on scroll
            $(window).on('scroll', function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
                    let btn = $('#load_more_button');
                    if (btn.length && btn.is(':visible') && !btn.prop('disabled')) {
                        btn.trigger('click');
                    }
                }
            });

        });
    </script>
@endsection
