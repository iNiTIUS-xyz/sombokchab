@php
    $categories = Modules\Attributes\Entities\Category::where('status_id', 1)
        ->select(['id', 'name'])
        ->get();
@endphp
<!-- Header area Starts -->
<header class="header-style-01 topbar-bg-4">
    <div class="desktop-navbar">
        <!-- Topbar area Starts -->
        <div class="topbar-bottom-area topbar-bottom-four py-2">
            <div class="" style="padding: 0px 10px">
                <div class="row align-items-center">
                    <div class="col-lg-1 d-none d-lg-block">
                        <div class="topbar-logo">
                            <a href="{{ route('homepage') }}">
                                @if (!empty(filter_static_option_value('site_logo', $global_static_field_data)))
                                    {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)) !!}
                                @else
                                    <h2 class="site-title">
                                        {{ filter_static_option_value('site_title', $global_static_field_data) }}</h2>
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-1 d-none d-lg-block">
                        <div class="gtranslate_wrapper"></div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <div class="category-searchbar">
                            <div class="category-searchbar">
                                <form action="#" class="single-searchbar searchbar-suggetions">
                                    <div class="input-group">
                                        <select class="form--control category-select" id="search_category_id">
                                            <option value="all">All Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input autocomplete="off" class="form--control radius-5" id="search_form_input"
                                            type="text" placeholder="{{ 'Search For Products' }}">

                                        <button type="submit" class="right-position-button margin-2 radius-5">
                                            <i class="las la-search"></i>
                                        </button>
                                    </div>

                                    <div class="search-suggestions" id="search_suggestions_wrap">
                                        <div class="search-inner">
                                            {{-- <div class="category-suggestion item-suggestions">
                                                <h6 class="item-title">{{ __('Category Suggestions') }}</h6>
                                                <ul id="search_result_categories" class="category-suggestion-list mt-4">
                                                </ul>
                                            </div> --}}
                                            <div class="product-suggestion item-suggestions">
                                                <h6 class="item-title text-center">{{ __('Product Suggestions') }}</h6>
                                                <ul id="search_result_products" class="product-suggestion-list my-4">
                                                </ul>
                                                <a href="" class="showMoreProduct"
                                                    style="text-align: center; display: block;">
                                                    See More
                                                </a>
                                            </div>
                                            <div class="product-suggestion item-suggestions" style="display:none;"
                                                id="no_product_found_div">
                                                <h6 class="item-title  text-center">
                                                    <span class="text-center">{{ __('No Product Found') }}</span>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-2 d-none d-lg-block">
                        <div class="single-right-content">

                            <div class="track-icon-list header-card-area-content-wrapper">
                                <!-- Currency Selector with Dropdown Icon -->
                                <div class="custom-dropdown" style="float: right; margin-left: 10px;">
                                    <select id="currency-selector" class="form-control" style="width: 70px">
                                        <option value="USD" selected>USD</option>
                                        <option value="KHR">KHR</option>
                                    </select>
                                </div>

                                @include('frontend.partials.header.navbar.card-and-wishlist-area')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar area Ends -->
        <!-- Menu area Starts -->
        <nav class="navbar navbar-area nav-five navbar-expand-lg py-1" style="background: rgb(57, 77, 72);">
            <div class="container container_1608 nav-container  {{ $containerClass ?? '' }}"
                style="max-width: 100%; width: 100%; margin: 0px">
                <div class="navbar-inner-all">
                    <div class="navbar-inner-all--left">
                        <div class="nav-category category_bars">
                            <span class="nav-category-bars"><i class="las la-bars"></i> {{ __('Categories') }}</span>
                        </div>
                        <div class="responsive-mobile-menu d-lg-none d-block">
                            <div class="logo-wrapper">
                                <a href="{{ route('homepage') }}">
                                    @if (!empty(filter_static_option_value('site_logo', $global_static_field_data)))
                                        {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)) !!}
                                    @else
                                        <h2 class="site-title">
                                            {{ filter_static_option_value('site_title', $global_static_field_data) }}
                                        </h2>
                                    @endif
                                </a>
                            </div>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#mares_main_menu">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="show-nav-right-contents">
                                <i class="las la-ellipsis-v"></i>
                            </div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="mares_main_menu">
                        <ul class="navbar-nav">
                            {!! render_frontend_menu($primary_menu) !!}
                        </ul>
                    </div>
                    <div class="navbar-right-content">
                        <div class="topbar-bottom-right-flex">
                            <div class="topbar-right-offer">
                                <ul class="list">
                                    @if (auth('web')->check())
                                        <li class="me-2">
                                            <a href="{{ route('frontend.products.track.order') }}"
                                                class="track-icon-single text-white">
                                                <span class="icon">
                                                    <i class="las la-map-marker-alt text-white"></i>
                                                </span>
                                                {{ __('Order Tracking') }}
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth('vendor')->check())
                                        {{-- Vendor is logged in --}}
                                    @else
                                        @if (!auth('web')->check())
                                            @if (get_static_option('enable_vendor_registration') === 'on')
                                                <li class="me-2">
                                                    <a class="btn btn-sm text-dark become-a-seller-button"
                                                        href="{{ route('vendor.register') }}"
                                                        style="background-color: var(--main-color-two);">
                                                        {{ __('Become a Vendor') }}
                                                    </a>
                                                </li>
                                            @endif

                                            <li class="">
                                                <a href="{{ route('vendor.login') }}">
                                                    {{ __('Vendor Sign In') }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    {!! render_frontend_menu(get_static_option('topbar_menu')) !!}
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </nav>
        <!-- Menu area end -->
    </div>

    <div class="mobile-navbar">

        <!-- Menu area Starts -->
        <nav class="navbar navbar-area nav-five navbar-expand-lg py-1" style="background: rgb(57, 77, 72);">
            <div class="container container_1608 nav-container  {{ $containerClass ?? '' }}"
                style="max-width: 100%; width: 100%; margin: 0px">
                <div class="navbar-inner-all">
                    <div class="navbar-inner-all--left">

                        <div class="responsive-mobile-menu d-lg-none d-block">
                            <div class="logo-wrapper">
                                <a href="{{ route('homepage') }}">
                                    @if (!empty(filter_static_option_value('site_logo', $global_static_field_data)))
                                        {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)) !!}
                                    @else
                                        <h2 class="site-title">
                                            {{ filter_static_option_value('site_title', $global_static_field_data) }}
                                        </h2>
                                    @endif
                                </a>
                            </div>


                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#mares_main_menu">
                                <span class="">
                                    <i class="las la-list-ul text-white" style="font-size: 36px;"></i>
                                </span>
                            </button>
                            {{-- <div class="show-nav-right-contents">
                                <i class="las la-ellipsis-v text-white"></i>
                            </div> --}}

                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="mares_main_menu">
                        <div class="topbar-bottom-right-flex mt-3">
                            <div class="topbar-right-offer">
                                <ul class="list">
                                    <li>
                                        <div class="gtranslate_wrapper"></div>
                                    </li>
                                    <li>
                                        <!-- Currency Selector with Dropdown Icon -->
                                        <div class="custom-dropdown">
                                            <select id="currency-selector">
                                                <option value="USD" selected>USD</option>
                                                <option value="KHR">KHR</option>
                                            </select>
                                        </div>
                                    </li>
                                    <div class="account d-flex">
                                        @include('frontend.partials.header.navbar.card-and-wishlist-area')
                                    </div>
                                    {!! render_frontend_menu(get_static_option('topbar_menu')) !!}

                                    <li class="me-2">
                                        <a href="{{ route('frontend.products.track.order') }}"
                                            class="track-icon-single text-white">
                                            <span class="icon">
                                                <i class="las la-map-marker-alt text-white"></i>
                                            </span>
                                            {{ __('Order Tracking') }}
                                        </a>
                                    </li>
                                    @if (auth('vendor')->check())
                                        {{-- Vendor is logged in --}}
                                    @else
                                        @if (!auth('web')->check())
                                            @if (get_static_option('enable_vendor_registration') === 'on')
                                                <li class="me-2">
                                                    <a class="btn btn-sm text-dark become-a-seller-button"
                                                        href="{{ route('vendor.register') }}"
                                                        style="background-color: var(--main-color-two);">
                                                        {{ __('Become a Vendor') }}
                                                    </a>
                                                </li>
                                            @endif

                                            <li class="">
                                                <a href="{{ route('vendor.login') }}">
                                                    {{ __('Vendor Sign In') }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif

                                </ul>
                            </div>
                        </div>
                        <ul class="navbar-nav">
                            {!! render_frontend_menu($primary_menu) !!}
                        </ul>

                    </div>

                </div>
            </div>
        </nav>
        <!-- Menu area end -->

        <!-- Topbar area Starts -->
        <div class="topbar-bottom-area topbar-bottom-four py-2">
            <div class="" style="padding: 0px 10px">
                <div class="row align-items-center">
                    <div class="col-2">
                        <div class="nav-category category_bars text-center">
                            <span class="nav-category-bars"><i class="las la-bars"></i></span>
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="category-searchbar">
                            <form action="#" class="single-searchbar searchbar-suggetions">
                                <div class="input-group">
                                    <select class="form--control category-select" id="search_category_id">
                                        <option value="all">All Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input autocomplete="off" class="form--control radius-5" id="search_form_input"
                                        type="text" placeholder="{{ 'Search For Products' }}">

                                    <button type="submit" class="right-position-button margin-2 radius-5">
                                        <i class="las la-search"></i>
                                    </button>
                                </div>
                                <div class="search-suggestions" id="search_suggestions_wrap">
                                    <div class="search-inner">
                                        {{-- <div class="category-suggestion item-suggestions">
                                            <h6 class="item-title">{{ __('Category Suggestions') }}</h6>
                                            <ul id="search_result_categories" class="category-suggestion-list mt-4">

                                            </ul>
                                        </div> --}}
                                        <div class="product-suggestion item-suggestions">
                                            <h6 class="item-title text-center">{{ __('Product Suggestions') }}</h6>
                                            <ul id="search_result_products" class="product-suggestion-list mt-4">

                                            </ul>
                                            <a href="" class="showMoreProduct"
                                                style="text-align: center; display: block;">
                                                See More
                                            </a>
                                        </div>

                                        <div class="product-suggestion item-suggestions" style="display:none;"
                                            id="no_product_found_div">
                                            <h6 class="item-title  text-center">
                                                <span class="text-center">
                                                    {{ __('No Product Found') }}
                                                </span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar area Ends -->

    </div>

    <!-- Category nav wrapper  -->
    <div class="categoryNav_overlay"></div>
    <div class="categoryNav">
        <div class="categoryNav__close"><i class="las la-times"></i></div>
        <div class="categoryNav_sidebar">
            <h3 class="categoryNav__title">{{ __('All Categories') }}</h3>
            <div class="categoryNav__inner mt-3">
                <ul class="categoryNav__list parent_menu menu_visible">
                    {!! render_frontend_menu(get_static_option('megamenu'), 'category_menu') !!}
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Image Search Modal -->
<div class="modal fade" id="imageSearchModal" tabindex="-1" role="dialog" aria-labelledby="imageSearchModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload an Image for Search</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <input type="file" id="imageSearchInput" accept="image/*" class="form-control">
                <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid mt-3"
                    style="display:none; max-height: 200px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="uploadImageForSearch()">Search</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Input Group Styles */
    .category-searchbar .input-group {
        display: flex;
        width: 100%;
        border-radius: 5px;
        overflow: hidden;
        border: 1px solid #A69D9D;
    }

    /* Category Select Styles - Now on the left */
    .category-searchbar .category-select {
        width: 180px;
        border: none;
        border-right: 1px solid #ddd;
        background-color: #f8f9fa;
        padding: 0 15px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 15px;
        order: 1;
        /* Ensures it appears first */
    }

    /* Search Input Styles */
    .category-searchbar #search_form_input {
        flex: 1;
        border: none;
        padding: 10px 200px;
        order: 2;
        /* Appears after the select */
    }

    /* Search Button Styles */
    .category-searchbar .right-position-button {
        background: var(--main-color-one);
        color: white;
        border: none;
        padding: 0 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        order: 3;
        /* Appears last */
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .category-searchbar .category-select {
            width: 120px;
            padding: 0 10px;
        }
    }

    @media (max-width: 1200px) {

        .category-searchbar .input-group {
            display: flex;
            width: 90%;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #A69D9D;
        }

    }

    @media (min-width: 1300px) {

        .category-searchbar .input-group {
            display: flex;
            width: 90%;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #A69D9D;
        }

    }

    @media (min-width: 1200px) {

        .category-searchbar .input-group {
            display: flex;
            width: 88%;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #A69D9D;
        }

    }

    @media (min-width: 1500px) {

        .category-searchbar .input-group {
            display: flex;
            width: 98%;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #A69D9D;
        }

    }

    /* @media (min-width: 1510px) (min-width: 1670px) {

        .category-searchbar .input-group {
            display: flex;
            width: 82%;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #A69D9D;
        }

    } */

    @media (min-width: 1400px) (min-width: 1460px) {

        .category-searchbar .input-group {
            display: flex;
            width: 95%;
            border-radius: 5px;
            overflow: hidden;
            border: 1px solid #A69D9D;
        }

    }
</style>

<style>
    @media only screen and (min-width: 992px) {
        .desktop-navbar {
            display: block;
        }

        .mobile-navbar {
            display: none;
        }
    }

    @media only screen and (max-width: 991px) {
        .desktop-navbar {
            display: none;
        }

        .mobile-navbar {
            display: block;
        }
    }

    @media (min-width: 300px) and (max-width: 991px) {
        .navbar-right-content {
            margin-top: -80px;
        }

        .navbar-area .nav-container .navbar-collapse.show .navbar-nav {
            background: transparent;
        }

        .nav-category {
            padding: 8px 10px;
            border-radius: 4px;
            width: 100%;
        }

        .nav-category .nav-category-bars i {
            font-size: 35px;
        }

        .navbar-area .navbar-toggler {
            border: none;
            padding: 0px;
            /* top: 30%; */
            right: 0px;
        }

        .mobile-navbar .topbar-right-offer .single-icon .icon {
            font-size: 22px;
            color: #FFF;
        }

        .mobile-navbar .topbar-right-offer .single-icon .icon .las.la-shopping-cart {
            font-size: 28px;
            color: #FFF;
            margin-top: 3px;
        }

        .mobile-navbar .topbar-right-offer .single-icon .icon .las.la-retweet {
            margin-top: 5px;
            font-size: 26px;
            color: #FFF;
        }

        .mobile-navbar .topbar-right-offer .single-icon .icon {
            font-size: 22px;
            color: #FFF;
        }
    }



    /* General Styles */
    .single-right-content .track-icon-list {
        float: right;
    }

    #google_translate_element .goog-te-gadget img {
        display: none !important;
    }

    .gtranslate_wrapper option:first-child {
        display: none;
    }


    .gtranslate_wrapper {
        width: 100%;
        justify-content: center;
        align-items: center;
        display: flex;
    }

    .gtranslate_wrapper .gt_selector,
    #currency-selector {
        width: 100px;
        height: 42px;
        font-size: 15px;
        border: 1px solid #DDD;
        padding: 0px 10px;
        background: transparent;
        color: #FFF;
        border-radius: 5px;
        appearance: none;
        /* Remove default arrow */
        -webkit-appearance: none;
        /* Remove default arrow for Safari */
        -moz-appearance: none;
        /* Remove default arrow for Firefox */
        text-align: center;
    }

    .gtranslate_wrapper .gt_selector option,
    #currency-selector option {
        background: var(--main-color-one) !important;
        border-radius: 0px !important;
    }

    .single-searchbar.searchbar-suggetions .input-group {
        border: 1px solid #A69D9D;
        border-radius: 5px;
    }

    .single-searchbar.searchbar-suggetions input:focus {
        border: none !important;
        box-shadow: none !important;
    }

    /* Custom Dropdown with Icon */
    .custom-dropdown {
        position: relative;
        display: inline-block;
    }

    .custom-dropdown .dropdown-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        /* Ensure the icon doesn't interfere with clicking */
        color: #FFF;
        /* Match the text color */
        font-size: 12px;
        /* Adjust size as needed */
    }
</style>

<script>
    window.gtranslateSettings = {
        "default_language": "en",
        "languages": ["en", "km"],
        "wrapper_selector": ".gtranslate_wrapper"
    }
</script>
<script src="https://cdn.gtranslate.net/widgets/latest/dropdown.js" defer></script>

<script>
    document.addEventListener("DOMContentLoaded", async function() {
        const CURRENCYFREAKS_API_KEY = "24b96ee77023425b95d417d36bc4a830";
        const currencySelector = document.getElementById("currency-selector");
        const INACTIVITY_LIMIT = 5 * 60 * 1000; // 5 minutes in milliseconds

        // Load stored currency selection and last activity time
        let storedCurrency = localStorage.getItem("selectedCurrency");
        let lastActivityTime = localStorage.getItem("lastActivityTime");

        // Check if inactive for 5 min, then reset to USD
        if (storedCurrency && lastActivityTime) {
            if (Date.now() - parseInt(lastActivityTime) > INACTIVITY_LIMIT) {
                localStorage.removeItem("selectedCurrency");
                storedCurrency = "USD";
            }
        }

        // If we have a stored currency, apply it
        if (storedCurrency) {
            currencySelector.value = storedCurrency;
            await applyCurrencyChange(storedCurrency);
        }

        // Event listener for currency change
        currencySelector.addEventListener("change", async function() {
            const selectedCurrency = this.value;

            // Store currency in localStorage and update activity time
            localStorage.setItem("selectedCurrency", selectedCurrency);
            localStorage.setItem("lastActivityTime", Date.now());

            await applyCurrencyChange(selectedCurrency);
        });

        async function applyCurrencyChange(selectedCurrency) {
            const allPricesData = [];

            // Collect price elements
            document.querySelectorAll(".price-update-through, .product__price").forEach(container => {
                const currentElem = container.querySelector(
                    ".flash-prices, .product__price__current");
                if (!currentElem) return;

                const oldElem = container.querySelector(
                    ".flash-old-prices, .product__price__old");
                let baseCurrent = getBaseUsdPrice(currentElem, ["data-usd-price",
                    "data-main-price"
                ]);
                let baseOld = oldElem ? getBaseUsdPrice(oldElem, ["data-usd-price",
                    "data-deleted-price"
                ]) : 0;

                // Save base USD price once
                if (!currentElem.hasAttribute("data-usd-price")) {
                    currentElem.setAttribute("data-usd-price", baseCurrent);
                }
                if (oldElem && !oldElem.hasAttribute("data-usd-price")) {
                    oldElem.setAttribute("data-usd-price", baseOld);
                }

                // Re-fetch after storage (in case original values came from visible text)
                baseCurrent = parseFloat(currentElem.getAttribute("data-usd-price"));
                baseOld = oldElem ? parseFloat(oldElem.getAttribute("data-usd-price")) : 0;


                allPricesData.push({
                    currentElem,
                    oldElem,
                    baseCurrent,
                    baseOld
                });
            });

            // If USD, revert to base
            if (selectedCurrency === "USD") {
                allPricesData.forEach(({
                    currentElem,
                    oldElem,
                    baseCurrent,
                    baseOld
                }) => {
                    currentElem.textContent = formatCurrency(baseCurrent, "USD", "en-US");
                    if (oldElem) oldElem.textContent = formatCurrency(baseOld, "USD", "en-US");
                });
                return;
            }

            // Fetch conversion rate if not USD
            try {
                const url =
                    `https://api.currencyfreaks.com/latest?apikey=${CURRENCYFREAKS_API_KEY}&symbols=KHR`;
                const response = await fetch(url);
                const data = await response.json();

                if (!data.rates || !data.rates.KHR) throw new Error("No KHR rate found.");
                const rate = parseFloat(data.rates.KHR);
                if (isNaN(rate)) throw new Error("Invalid KHR rate.");

                allPricesData.forEach(({
                    currentElem,
                    oldElem,
                    baseCurrent,
                    baseOld
                }) => {
                    currentElem.textContent = formatCurrency(baseCurrent * rate, "KHR",
                        "km-KH");
                    if (oldElem) oldElem.textContent = formatCurrency(baseOld * rate, "KHR",
                        "km-KH");
                });

            } catch (error) {
                console.error("Error fetching KHR rate:", error);
            }
        }

        function getBaseUsdPrice(elem, possibleAttrs = []) {
            for (const attr of possibleAttrs) {
                const val = elem.getAttribute(attr);
                if (val) {
                    const parsed = parseFloat(val.replace(/[^0-9.]/g, ""));
                    if (!isNaN(parsed)) return parsed;
                }
            }
            const textVal = elem.textContent.trim();
            const parsedText = parseFloat(textVal.replace(/[^0-9.]/g, ""));
            return isNaN(parsedText) ? 0 : parsedText;
        }

        function formatCurrency(value, currencyCode, locale) {
            return new Intl.NumberFormat(locale, {
                style: "currency",
                currency: currencyCode
            }).format(value);
        }
    });
</script>
<script>
    document.getElementById("imageSearchInput").addEventListener("change", function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("imagePreview").src = e.target.result;
                document.getElementById("imagePreview").style.display = "block";
            };
            reader.readAsDataURL(file);
        }
    });

    function uploadImageForSearch() {
        const fileInput = document.getElementById("imageSearchInput");
        const file = fileInput.files[0];

        if (!file) {
            alert("Please upload an image first.");
            return;
        }

        const formData = new FormData();
        formData.append("image", file);
        formData.append("_token", document.querySelector('input[name="_token"]').value);

        fetch("{{ route('search.image') }}", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.products.length > 0) {
                    displayProductResults(data.products);
                } else {
                    document.getElementById("no_product_found_div").style.display = "block";
                }

                // Close modal after search
                $("#imageSearchModal").modal("hide");
            })
            .catch(error => {
                console.error("Error:", error);
            });
    }

    function displayProductResults(products) {
        const productList = document.getElementById("search_result_products");
        productList.innerHTML = ""; // Clear previous results

        products.forEach(product => {
            const li = document.createElement("li");
            li.innerHTML = `<a href="/product/${product.id}">${product.name}</a>`;
            productList.appendChild(li);
        });

        document.getElementById("search_suggestions_wrap").style.display = "block";
    }
</script>
