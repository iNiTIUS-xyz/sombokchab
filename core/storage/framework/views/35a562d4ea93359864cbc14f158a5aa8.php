<!-- Header area Starts -->
<header class="header-style-01 topbar-bg-4">
    <div class="desktop-navbar">
        <!-- Topbar area Starts -->
        <div class="topbar-bottom-area topbar-bottom-four py-2">
            <div class="" style="padding: 0px 10px">
                <div class="row align-items-center">
                    <div class="col-lg-1 d-none d-lg-block">
                        <div class="topbar-logo">
                            <a href="<?php echo e(route('homepage')); ?>">
                                <?php if(!empty(filter_static_option_value('site_logo', $global_static_field_data))): ?>
                                    <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)); ?>

                                <?php else: ?>
                                    <h2 class="site-title">
                                        <?php echo e(filter_static_option_value('site_title', $global_static_field_data)); ?></h2>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-1 d-none d-lg-block">
                        <div class="gtranslate_wrapper"></div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <div class="category-searchbar">
                            <form action="#" class="single-searchbar searchbar-suggetions">
                                <input autocomplete="off" class="form--control radius-5" id="search_form_input"
                                    type="text" placeholder="<?php echo e('Search For Products'); ?>">
                                <button type="submit" class="right-position-button margin-2 radius-5"> <i
                                        class="las la-search"></i> </button>
                                <div class="search-suggestions" id="search_suggestions_wrap">
                                    <div class="search-inner">
                                        <div class="category-suggestion item-suggestions">
                                            <h6 class="item-title"><?php echo e(__('Category Suggestions')); ?></h6>
                                            <ul id="search_result_categories" class="category-suggestion-list mt-4">

                                            </ul>
                                        </div>
                                        <div class="product-suggestion item-suggestions">
                                            <h6 class="item-title"><?php echo e(__('Product Suggestions')); ?></h6>
                                            <ul id="search_result_products" class="product-suggestion-list mt-4">

                                            </ul>
                                        </div>

                                        <div class="product-suggestion item-suggestions" style="display:none;"
                                            id="no_product_found_div">
                                            <h6 class="item-title d-flex justify-content-between">
                                                <span>
                                                    <?php echo e(__('No Product Found')); ?>

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
                                <!-- Currency Selector with Dropdown Icon -->
                                <div class="custom-dropdown" style="float: right; margin-left: 10px;">
                                    <select id="currency-selector" class="form-control" style="width: 70px">
                                        <option value="USD" selected>USD</option>
                                        <option value="KHR">KHR</option>
                                    </select>
                                </div>

                                <?php echo $__env->make('frontend.partials.header.navbar.card-and-wishlist-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar area Ends -->
        <!-- Menu area Starts -->
        <nav class="navbar navbar-area nav-five navbar-expand-lg py-1" style="background: rgb(57, 77, 72);">
            <div class="container container_1608 nav-container  <?php echo e($containerClass ?? ''); ?>"
                style="max-width: 100%; width: 100%; margin: 0px">
                <div class="navbar-inner-all">
                    <div class="navbar-inner-all--left">
                        <div class="nav-category category_bars">
                            <span class="nav-category-bars"><i class="las la-bars"></i> <?php echo e(__('Categories')); ?></span>
                        </div>
                        <div class="responsive-mobile-menu d-lg-none d-block">
                            <div class="logo-wrapper">
                                <a href="<?php echo e(route('homepage')); ?>">
                                    <?php if(!empty(filter_static_option_value('site_logo', $global_static_field_data))): ?>
                                        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)); ?>

                                    <?php else: ?>
                                        <h2 class="site-title">
                                            <?php echo e(filter_static_option_value('site_title', $global_static_field_data)); ?>

                                        </h2>
                                    <?php endif; ?>
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
                            <?php echo render_frontend_menu($primary_menu); ?>

                        </ul>
                    </div>
                    <div class="navbar-right-content">
                        <div class="topbar-bottom-right-flex">
                            <div class="topbar-right-offer">
                                <ul class="list">
                                    <li class="me-2">
                                        <a href="<?php echo e(route('frontend.products.track.order')); ?>"
                                            class="track-icon-single text-white">
                                            <span class="icon">
                                                <i class="las la-map-marker-alt text-white"></i>
                                            </span>
                                            <?php echo e(__('Order Tracking')); ?>

                                        </a>
                                    </li>
                                    <?php if(auth('vendor')->check()): ?>
                                        
                                    <?php else: ?>
                                        
                                        <?php if(!auth('web')->check()): ?>
                                            <?php if(get_static_option('enable_vendor_registration') === 'on'): ?>
                                                <li class="me-2">
                                                    <a class="btn btn-sm text-dark become-a-seller-button"
                                                        href="<?php echo e(route('vendor.register')); ?>"
                                                        style="background-color: var(--main-color-two);">
                                                        <?php echo e(__('Become a Vendor')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <li class="">
                                                <a href="<?php echo e(route('vendor.login')); ?>">
                                                    <?php echo e(__('Vendor Login')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php echo render_frontend_menu(get_static_option('topbar_menu')); ?>

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
            <div class="container container_1608 nav-container  <?php echo e($containerClass ?? ''); ?>"
                style="max-width: 100%; width: 100%; margin: 0px">
                <div class="navbar-inner-all">
                    <div class="navbar-inner-all--left">

                        <div class="responsive-mobile-menu d-lg-none d-block">
                            <div class="logo-wrapper">
                                <a href="<?php echo e(route('homepage')); ?>">
                                    <?php if(!empty(filter_static_option_value('site_logo', $global_static_field_data))): ?>
                                        <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)); ?>

                                    <?php else: ?>
                                        <h2 class="site-title">
                                            <?php echo e(filter_static_option_value('site_title', $global_static_field_data)); ?>

                                        </h2>
                                    <?php endif; ?>
                                </a>
                            </div>


                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#mares_main_menu">
                                <span class="">
                                    <i class="las la-list-ul text-white" style="font-size: 36px;"></i>
                                </span>
                            </button>
                            

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
                                        <?php echo $__env->make('frontend.partials.header.navbar.card-and-wishlist-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <?php echo render_frontend_menu(get_static_option('topbar_menu')); ?>


                                    <li class="me-2">
                                        <a href="<?php echo e(route('frontend.products.track.order')); ?>"
                                            class="track-icon-single text-white">
                                            <span class="icon">
                                                <i class="las la-map-marker-alt text-white"></i>
                                            </span>
                                            <?php echo e(__('Order Tracking')); ?>

                                        </a>
                                    </li>
                                    <?php if(!auth('web')->check()): ?>
                                        <?php if(get_static_option('enable_vendor_registration') === 'on'): ?>
                                            <li class="me-2">
                                                <a class="btn btn-sm text-dark become-a-seller-button"
                                                    href="<?php echo e(route('vendor.register')); ?>"
                                                    style="background-color: var(--main-color-two);">
                                                    <?php echo e(__('Become a Vendor')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <li class="">
                                            <a href="<?php echo e(route('vendor.login')); ?>">
                                                <?php echo e(__('Vendor Login')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>

                                </ul>
                            </div>
                        </div>
                        <ul class="navbar-nav">
                            <?php echo render_frontend_menu($primary_menu); ?>

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
                                <input autocomplete="off" class="form--control radius-5" id="search_form_input"
                                    type="text" placeholder="<?php echo e('Search For Products'); ?>">
                                <button type="submit" class="right-position-button margin-2 radius-5"> <i
                                        class="las la-search"></i> </button>
                                <div class="search-suggestions" id="search_suggestions_wrap">
                                    <div class="search-inner">
                                        <div class="category-suggestion item-suggestions">
                                            <h6 class="item-title"><?php echo e(__('Category Suggestions')); ?></h6>
                                            <ul id="search_result_categories" class="category-suggestion-list mt-4">

                                            </ul>
                                        </div>
                                        <div class="product-suggestion item-suggestions">
                                            <h6 class="item-title"><?php echo e(__('Product Suggestions')); ?></h6>
                                            <ul id="search_result_products" class="product-suggestion-list mt-4">

                                            </ul>
                                        </div>

                                        <div class="product-suggestion item-suggestions" style="display:none;"
                                            id="no_product_found_div">
                                            <h6 class="item-title d-flex justify-content-between">
                                                <span>
                                                    <?php echo e(__('No Product Found')); ?>

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
            <h3 class="categoryNav__title"><?php echo e(__('All Category')); ?></h3>
            <div class="categoryNav__inner mt-3">
                <ul class="categoryNav__list parent_menu menu_visible">
                    <?php echo render_frontend_menu(get_static_option('megamenu'), 'category_menu'); ?>

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

<!-- Header area end -->
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

        fetch("<?php echo e(route('search.image')); ?>", {
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
<?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/partials/header/header-variant-03.blade.php ENDPATH**/ ?>