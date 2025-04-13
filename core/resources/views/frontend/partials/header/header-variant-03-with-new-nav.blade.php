<!-- Header area Starts -->
<header class="header-style-01 topbar-bg-4">
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
                        <form action="{{ route("frontend.search.results") }}" class="single-searchbar searchbar-suggetions" method="GET">
                            @csrf
                            {{-- <input autocomplete="off" class="form--control radius-5" id="search_form_input"
                                type="text" placeholder="{{ 'Search For Products' }}">
                            <div class="right-position-button margin-2 radius-5" style="top: 0px;">

                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#imageSearchModal">
                                    <i class="la la-camera la-2x text-light"></i>
                                </button>
                                <button type="submit" class="btn"> <i
                                    class="las la-search la-2x text-light"></i> </button>
                            </div> --}}
                            @php
                                $all_category = Modules\Attributes\Entities\Category::where('status_id', '1')
                                    ->with('subcategory.childcategory') // Ensure child categories are loaded
                                    ->get();
                            @endphp

                            <div class="input-group">
                                <!-- Category Dropdown -->
                                <select class="form-select" id="searchCategory" name="category_id" style="max-width: 200px;">
                                    <option value="">All</option>
                                    @foreach ($all_category as $category)
                                        <option value="{{ $category->id }}" style="font-weight: bold;">
                                            {{ $category->name }}
                                        </option>
                                        {{-- @foreach ($category->subcategory as $subcategory)
                                            <option value="{{ $subcategory->id }}">
                                                - {{ $subcategory->name }}
                                            </option>
                                            @if ($subcategory->childcategory->count())
                                                @foreach ($subcategory->childcategory as $childcategory)
                                                    <option value="{{ $childcategory->id }}">
                                                        -- {{ $childcategory->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endforeach --}}
                                    @endforeach
                                </select>

                                <!-- Search Input -->
                                <input autocomplete="off" class="form-control" id="search_form_input" name="search"
                                    type="text" placeholder="Search For Products">

                                <!-- Buttons -->
                                <a class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#imageSearchModal">
                                    <i class="la la-camera text-light la-2x" style="padding-top: 5px;"></i>
                                </a>
                                <button type="submit" class="btn btn-outline-secondary">
                                    <i class="las la-search text-light la-2x"></i>
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
                                        <h6 class="item-title">{{ __('Product Suggestions') }}</h6>
                                        <ul id="search_result_products" class="product-suggestion-list mt-4">

                                        </ul>
                                    </div>

                                    <div class="product-suggestion item-suggestions" style="display:none;"
                                        id="no_product_found_div">
                                        <h6 class="item-title d-flex justify-content-between">
                                            <span>
                                                {{ __('No Product Found') }}
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-2 d-none d-lg-block">
                    <div class="single-right-content">
                        
                        <div class="track-icon-list header-card-area-content-wrapper">
                            <select id="currency-selector" class="form-control" style="background: transparent; width: 55px;color: #FFF;font-size: 15px; text-align: center;">
                                <option value="USD" selected>USD</option>
                                <option value="KHR">Khmer (KHR)</option>
                            </select>
                            
                            
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
        <div class="container container_1608 nav-container  {{ $containerClass ?? "" }}" style="max-width: 100%; width: 100%; margin: 0px">
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
                                        {{ filter_static_option_value('site_title', $global_static_field_data) }}</h2>
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
                                <li class="me-2">
                                    <a href="{{ route('frontend.products.track.order') }}" class="track-icon-single text-white">
                                        <span class="icon">
                                            <i class="las la-map-marker-alt text-white"></i>
                                        </span>
                                        {{ __('Order Tracking') }}
                                    </a>
                                </li>
                                @if(!auth('web')->check())
                                    @if(get_static_option("enable_vendor_registration") === 'on')
                                        <li class="me-2">
                                            <a class="btn btn-sm text-dark become-a-seller-button" href="{{ route('vendor.register') }}" style="background-color: var(--main-color-two);">
                                                {{ __('Become a Vendor') }}
                                            </a>
                                        </li>
                                    @endif
                                    
                                    <li class="">
                                        <a href="{{ route('vendor.login') }}">
                                            {{ __('Vendor Login') }}
                                        </a>
                                    </li>
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
<div class="modal fade" id="imageSearchModal" tabindex="-1" role="dialog" aria-labelledby="imageSearchModalLabel" aria-hidden="true">
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
                <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid mt-3" style="display:none; max-height: 200px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="uploadImageForSearch()">Search</button>
            </div>
        </div>
    </div>
</div>

<!-- Header area end -->
<style>
    .single-right-content .track-icon-list{
        float: right;
    }

    #google_translate_element .goog-te-gadget img{
        display: none !important;
    }

    .gtranslate_wrapper{
        width: 100%;
        justify-content: center;
        align-items: center;
        display: flex;
    }

    .gtranslate_wrapper  .gt_selector {
        width: 100px;
        height: 42px;
        font-size: 15px;
        border: 1px solid #DDD;
        padding: 0px 10px;
        background: transparent;
        color: #FFF;
        border-radius: 5px;
        float: right;
    }
    .gtranslate_wrapper  .gt_selector option,
    #currency-selector option {
        background: var(--main-color-one) !important;
        border-radius: 0px !important;
    }

    .single-searchbar.searchbar-suggetions .input-group{
        border: 1px solid #A69D9D;
        border-radius: 5px;
    }

    .single-searchbar.searchbar-suggetions input:focus{
        border: none !important;
        box-shadow: none !important;
    }
    
</style>
<script>
    window.gtranslateSettings = {
        "default_language":"en",
        "languages":["en","km"],
        "wrapper_selector":".gtranslate_wrapper"
        }
</script>
<script src="https://cdn.gtranslate.net/widgets/latest/dropdown.js" defer></script>

<script>
    document.addEventListener("DOMContentLoaded", async function () {
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
        currencySelector.addEventListener("change", async function () {
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
                const currentElem = container.querySelector(".flash-prices, .product__price__current");
                if (!currentElem) return;

                const oldElem = container.querySelector(".flash-old-prices, .product__price__old");
                const baseCurrent = getBaseUsdPrice(currentElem, ["data-main-price"]);
                const baseOld = oldElem ? getBaseUsdPrice(oldElem, ["data-deleted-price"]) : 0;

                allPricesData.push({ currentElem, oldElem, baseCurrent, baseOld });
            });

            // If USD, revert to base
            if (selectedCurrency === "USD") {
                allPricesData.forEach(({ currentElem, oldElem, baseCurrent, baseOld }) => {
                    currentElem.textContent = formatCurrency(baseCurrent, "USD", "en-US");
                    if (oldElem) oldElem.textContent = formatCurrency(baseOld, "USD", "en-US");
                });
                return;
            }

            // Fetch conversion rate if not USD
            try {
                const url = `https://api.currencyfreaks.com/latest?apikey=${CURRENCYFREAKS_API_KEY}&symbols=KHR`;
                const response = await fetch(url);
                const data = await response.json();

                if (!data.rates || !data.rates.KHR) throw new Error("No KHR rate found.");
                const rate = parseFloat(data.rates.KHR);
                if (isNaN(rate)) throw new Error("Invalid KHR rate.");

                allPricesData.forEach(({ currentElem, oldElem, baseCurrent, baseOld }) => {
                    currentElem.textContent = formatCurrency(baseCurrent * rate, "KHR", "km-KH");
                    if (oldElem) oldElem.textContent = formatCurrency(baseOld * rate, "KHR", "km-KH");
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
            return new Intl.NumberFormat(locale, { style: "currency", currency: currencyCode }).format(value);
        }
    });
</script>
<script>
   document.getElementById("imageSearchInput").addEventListener("change", function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
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