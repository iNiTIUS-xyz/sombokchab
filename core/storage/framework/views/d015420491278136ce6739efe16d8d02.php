<?php $__env->startSection('product-name'); ?>
    <?php echo e($product->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('product-category'); ?>
    <?php if($product?->category): ?>
        <li class="category-list">
            <a class="list-item" href="<?php echo e(route('frontend.products.category', $product?->category?->slug)); ?>">
                <?php echo e($product?->category?->name); ?>

            </a>
        </li>
    <?php endif; ?>

    <?php if($product?->subCategory): ?>
        <li class="category-list">
            <a class="list-item" href="<?php echo e(route('frontend.products.subcategory', $product?->subCategory?->slug)); ?>">
                <?php echo e($product?->subCategory?->name); ?>

            </a>
        </li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/font-awesome.min.css')); ?>">
    <?php if(moduleExists('Chat')): ?>
        <?php echo $__env->make('chat::components.frontend-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php

    $attributes = $product?->inventory_detail_count ?? null;
    $campaign_product = $product->campaign_product ?? null;
    $campaignProductEndDate = $product->campaign->end_date ?? ($product->campaign->end_date->end_date ?? '');
    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
    $campaignSoldCount = $product?->campaign_sold_product;
    $stock_count = $campaign_product
        ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0
        : optional($product->inventory)->stock_count;
    $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ? $stock_count : 0;
    $filter = $filter ?? false;
    $product_img_url = render_image($product->image, render_type: 'url');

    $vendor_information = $product->vendor ?? '';
    $product_id = $product->id ?? 0;
    $facebook_meta_image = render_image($product->metaData?->facebook_meta_image ?? null, render_type: 'url');
    $twitter_meta_image = render_image($product->metaData?->twitter_meta_image ?? null, render_type: 'url');
?>
<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_page_meta_data_for_product($product); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Shop Details area end -->
    <div class="bradecrumb-wraper-div">
        <?php if (isset($component)) { $__componentOriginalc6a949685b53c67365c6ff02d2dfb6bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc6a949685b53c67365c6ff02d2dfb6bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.breadcrumb.frontend-breadcrumb','data' => ['title' => __('Product Details'),'innerTitle' => $product->category?->name,'subInnerTitle' => $product->subCategory?->name,'chidInnerTitle' => $product->childCategorySingle?->name ?? '','routeName' => route('frontend.products.category', $product->category?->slug ?? 'x'),'subRouteName' => route('frontend.products.subcategory', $product->subCategory?->slug ?? 'x'),'childRouteName' => route('frontend.products.child-category', $product->childCategorySingle?->slug ?? 'x')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.breadcrumb.frontend-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Product Details')),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->category?->name),'subInnerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->subCategory?->name),'chidInnerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->childCategorySingle?->name ?? ''),'routeName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('frontend.products.category', $product->category?->slug ?? 'x')),'subRouteName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('frontend.products.subcategory', $product->subCategory?->slug ?? 'x')),'childRouteName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('frontend.products.child-category', $product->childCategorySingle?->slug ?? 'x'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc6a949685b53c67365c6ff02d2dfb6bc)): ?>
<?php $attributes = $__attributesOriginalc6a949685b53c67365c6ff02d2dfb6bc; ?>
<?php unset($__attributesOriginalc6a949685b53c67365c6ff02d2dfb6bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6a949685b53c67365c6ff02d2dfb6bc)): ?>
<?php $component = $__componentOriginalc6a949685b53c67365c6ff02d2dfb6bc; ?>
<?php unset($__componentOriginalc6a949685b53c67365c6ff02d2dfb6bc); ?>
<?php endif; ?>
    </div>
    <section class="shop-details-area padding-top-100 padding-bottom-50">
        <div class="container container-one">
            <div class="row justify-content-center">
                <div class="col-xxl-9 col-xl-9">
                    <div class="row">
                        <div class="col-lg-8 col-xl-7">
                            <div class="shop-details-top-slider big-product-image">
                                <div class="shop-details-thumb-wrapper text-center bg-item-five product-image"
                                    data-img-src="<?php echo e(render_image($product->image, render_type: 'url', class: 'lazyloads')); ?>">
                                    <div class="shop-details-thums" id="shop-details-thums">
                                        <?php echo render_image($product->image, class: 'lazyloads'); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="shop-details-bottom-slider-area mt-4">
                                <div class="global-slick-init shop-details-click-img dot-style-one banner-dots dot-absolute slider-inner-margin"
                                    data-infinite="true" data-slidesToShow="5" data-dots="true"
                                    data-rtl="<?php echo e(get_user_lang_direction() == 'rtl' ? 'true' : 'false'); ?>"
                                    data-autoplaySpeed="3000" data-autoplay="true"
                                    data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 4}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 992,"settings": {"slidesToShow": 3,"arrows": false,"dots": true}},{"breakpoint": 768, "settings": {"slidesToShow": 2} },{"breakpoint": 376, "settings": {"slidesToShow": 2} }]'>
                                    <div class="shop-details-thumb-wrapper text-center bg-item-five">
                                        <div class="shop-details-thums shop-details-thums-small">
                                            <?php echo render_image($product->image, class: 'lazyloads'); ?>

                                        </div>
                                    </div>
                                    <?php $__currentLoopData = $product->gallery_images ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="shop-details-thumb-wrapper text-center bg-item-five">
                                            <div class="shop-details-thums shop-details-thums-small">
                                                <?php echo render_image($image, class: 'lazyloads'); ?>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xl-5">
                            <div class="single-shop-details-wrapper padding-left-50">
                                <h2 class="details-title"><?php echo e($product->name); ?></h2>
                                <div class="rating-wrap">
                                    <?php echo view('product::components.frontend.common.rating-markup', compact('product')); ?>

                                </div>

                                <?php if($stock_count > (int) get_static_option('product_in_stock_limit_set') ?? 0): ?>
                                    <span data-stock-text="<?php echo e($stock_count); ?>"
                                        class="availability text-success"><?php echo e(filter_static_option_value('product_in_stock_text', $setting_text, __('In stock'))); ?>

                                        (<?php echo e($stock_count); ?>)
                                    </span>
                                <?php else: ?>
                                    <span data-stock-text="<?php echo e($stock_count); ?>"
                                        class="availability text-danger"><?php echo e(filter_static_option_value('product_out_of_stock_text', $setting_text, __('Out of stock'))); ?></span>
                                <?php endif; ?>

                                <div class="price-update-through mt-4">
                                    <h3 class="ff-rubik flash-prices color-one price" data-main-price="<?php echo e($sale_price); ?>"
                                        data-price-percentage="<?php echo e(\Modules\TaxModule\Services\CalculateTaxServices::pricesEnteredWithTax() ? $product->tax_options_sum_rate : 0); ?>"
                                        data-currency-symbol="<?php echo e(site_currency_symbol()); ?>" id="price">
                                        <?php echo e(float_amount_with_currency_symbol(calculatePrice($sale_price, $product))); ?>

                                    </h3>
                                    <span class="fs-22 flash-old-prices" id="deleted_price"
                                        data-deleted-price="<?php echo e(calculatePrice($deleted_price, $product)); ?>">
                                        <?php echo e(float_amount_with_currency_symbol(calculatePrice($deleted_price, $product))); ?>

                                    </span>
                                </div>

                                <div class="short-description mt-3">
                                    <p class="info"><?php echo purify_html($product->summary); ?></p>
                                </div>

                                <?php if($productSizes->count() > 0 && !empty(current(current($productSizes)))): ?>
                                    <div class="value-input-area margin-top-15 size_list">
                                        <span class="input-list">
                                            <strong class="color-light"><?php echo e(__('Size:')); ?></strong>
                                            <input class="form--input value-size" name="size" type="text"
                                                value="">
                                            <input type="hidden" id="selected_size">
                                        </span>

                                        <ul class="size-lists" data-type="Size">
                                            <?php $__currentLoopData = $productSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!empty($product_size)): ?>
                                                    <li class="" data-value="<?php echo e(optional($product_size)->id); ?>"
                                                        data-display-value="<?php echo e(optional($product_size)->name); ?>">
                                                        <?php echo e(optional($product_size)->name); ?> </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?php if($productColors->count() > 0 && current(current($productColors))): ?>
                                    <div class="value-input-area mt-4 color_list">
                                        <span class="input-list">
                                            <strong class="color-light"><?php echo e(__('Color:')); ?></strong>
                                            <input class="form--input value-size" disabled name="color" type="text"
                                                value="">
                                            <input type="hidden" id="selected_color">
                                        </span>

                                        <ul class="size-lists color-list" data-type="Color">
                                            <?php $__currentLoopData = $productColors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!empty($product_color)): ?>
                                                    <li style="background: <?php echo e(optional($product_color)->color_code); ?>"
                                                        class="radius-percent-50"
                                                        data-value="<?php echo e(optional($product_color)->id); ?>"
                                                        data-display-value="<?php echo e(optional($product_color)->name); ?>">
                                                        <span class="color-list-overlay"></span>
                                                        <span
                                                            style="background: <?php echo e(optional($product_color)->color_code); ?>"></span>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?php $__currentLoopData = $available_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute => $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="value-input-area margin-top-15 attribute_options_list">
                                        <span class="input-list">
                                            <strong class="color-light"><?php echo e($attribute); ?></strong>
                                            <input class="form--input value-size" type="text" value="">
                                            <input type="hidden" id="selected_attribute_option"
                                                name="selected_attribute_option">
                                        </span>

                                        <ul class="size-lists" data-type="<?php echo e($attribute); ?>">
                                            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="" data-value="<?php echo e($option); ?>"
                                                    data-display-value="<?php echo e($option); ?>"> <?php echo e($option); ?> </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <div class="quantity-area mt-4">
                                    <div class="quantity-flex">
                                        <span class="quantity-title color-light"> <?php echo e(__('Quantity:')); ?> </span>
                                        <div class="product-quantity">
                                            <span class="substract">
                                                <i class="las la-minus"></i>
                                            </span>

                                            <input class="quantity-input" id="quantity" type="number"
                                                value="01" />

                                            <span class="plus">
                                                <i class="las la-plus"></i>
                                            </span>
                                        </div>
                                        <span data-stock-text="<?php echo e($stock_count); ?>"
                                            class="stock-available <?php echo e($stock_count ? 'text-success' : 'text-danger'); ?>">
                                            <?php echo e($stock_count ? "In Stock ($stock_count)" : 'Out of stock'); ?> </span>
                                    </div>
                                    <div class="quantity-btn margin-top-40">
                                        <div class="btn-wrapper">
                                            <a href="#1" data-id="<?php echo e($product->id); ?>"
                                                class="cmn-btn btn-bg-1 radius-0 cart-loading add_to_cart_single_page">
                                                <?php echo e(__('Add to Cart')); ?> </a>
                                        </div>
                                        <a href="#1" data-id="<?php echo e($product->id); ?>"
                                            class="heart-btn fs-32 color-one radius-0 add_to_wishlist_single_page">
                                            <i class="lar la-heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="wishlist-compare">
                                    <div class="wishlist-compare-btn">
                                        <a href="#1" data-id="<?php echo e($product->id); ?>"
                                            class="btn-wishlist buy_now_single_page btn-details btn-buyNow mt-4"> <i
                                                class="las la-cart-arrow-down"></i> <?php echo e(__('Buy now')); ?> </a>
                                        <a href="#1" data-id="<?php echo e($product->id); ?>"
                                            class="btn-wishlist add_to_compare_single_page btn-details btn-addCompare mt-4">
                                            <i class="las la-retweet"></i> <?php echo e(__('Add Compare')); ?> </a>
                                    </div>
                                </div>
                                <div class="shop-details-stock shop-border-top pt-4 mt-4">
                                    <div class="details-checkout-shop">
                                        <span class="guaranteed-checkout fw-500 color-light">
                                            <?php echo e(__('Guaranteed Safe Checkout')); ?> </span>
                                        <div class="global-slick-init payment-slider nav-style-two dot-style-one slider-inner-margin"
                                            data-infinite="true" data-arrows="true" data-dots="false"
                                            data-slidesToShow="5" data-swipeToSlide="true" data-autoplay="true"
                                            data-autoplaySpeed="2500"
                                            data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                                            data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>'
                                            data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 5}},{"breakpoint": 1200,"settings": {"slidesToShow": 4}},{"breakpoint": 992,"settings": {"slidesToShow": 4,"arrows": false,"dots": true}},{"breakpoint": 768, "settings": {"slidesToShow": 2} },{"breakpoint": 576, "settings": {"slidesToShow": 2} }]'>
                                            <?php $__currentLoopData = $paymentGateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="slick-item">
                                                    <div class="payment-slider-item">
                                                        <?php echo render_image($gateway->oldImage); ?>

                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <ul class="stock-category mt-4">
                                        <?php if($product?->category): ?>
                                            <li class="category-list">
                                                <strong> <?php echo e(__('Category:')); ?> </strong>
                                                <a class="list-item"
                                                    href="<?php echo e(route('frontend.products.category', $product?->category?->slug)); ?>">
                                                    <?php echo e($product?->category?->name); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($product?->subCategory): ?>
                                            <li class="category-list">
                                                <strong> <?php echo e(__('Sub Category:')); ?> </strong>
                                                <a class="list-item"
                                                    href="<?php echo e(route('frontend.products.subcategory', $product?->subCategory?->slug)); ?>">
                                                    <?php echo e($product?->subCategory?->name); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($product->childCategory): ?>
                                            <li class="category-list">
                                                <strong> <?php echo e(__('Child Category:')); ?> </strong>
                                                <?php $__currentLoopData = $product?->childCategory ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a class="list-item"
                                                        href="<?php echo e(route('frontend.products.child-category', $childCategory?->slug)); ?>">
                                                        <?php echo e($childCategory?->name); ?>

                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(!empty(get_static_option('product_sku_show_hide'))): ?>
                                            <li class="category-list">
                                                <strong> <?php echo e(__('Sku:')); ?> </strong>
                                                <label class="list-item"> <?php echo e($product->inventory?->sku); ?> </label>
                                            </li>
                                        <?php endif; ?>
                                    </ul>

                                    <?php if($product->tag?->isNotEmpty()): ?>
                                        <div class="tags-area-shop shop-border-top pt-4 mt-4">
                                            <span class="tags-span color-light"> <strong> <?php echo e(__('Tags:')); ?> </strong>
                                            </span>
                                            <ul class="tags-shop-list">
                                                <?php $__currentLoopData = $product->tag ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="list">
                                                        <a
                                                            href="<?php echo e(route('frontend.products.all', ['tag-name' => $tag->tag_name])); ?>">
                                                            <?php echo e($tag->tag_name); ?> </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shop Details tab area starts -->
                    <section class="tab-details-tab-area padding-top-50">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="details-tab-wrapper">
                                    <ul class="tabs details-tab">
                                        <li class="<?php echo e($product->reviews_count > 0 ? '' : 'active'); ?> ff-rubik fw-500"
                                            data-tab="description"> <?php echo e(__('Description')); ?> </li>
                                        <li class="ff-rubik fw-500 <?php echo e(empty($product?->vendor) ? 'd-none' : ''); ?>"
                                            data-tab="information"> <?php echo e(__('Information')); ?> </li>
                                        <li class="<?php echo e($product->reviews_count > 0 ? 'active' : ''); ?> ff-rubik fw-500"
                                            data-tab="reviews"> <?php echo e(__('Reviews')); ?>

                                            (<?php echo e($product->reviews_count); ?>) </li>
                                    </ul>
                                    <div id="description"
                                        class="tab-content-item <?php echo e($product->reviews_count > 0 ? '' : 'active'); ?>">
                                        <?php echo $product->description; ?>

                                    </div>
                                    <div id="information" class="tab-content-item">
                                        <div class="single-details-tab mt-2">
                                            <?php if($product?->vendor?->username): ?>
                                                <div class="tab-information">
                                                    <div class="about-seller-flex-content align-items-center">
                                                        <div class="about-seller-thumb">
                                                            <a
                                                                href="<?php echo e(route('frontend.vendors.single', $product?->vendor?->username)); ?>">
                                                                <?php echo render_image($product?->vendor?->vendor_shop_info?->logo); ?>

                                                            </a>
                                                        </div>
                                                        <div class="about-seller-content">
                                                            <h5 class="title">
                                                                <a
                                                                    href="<?php echo e(route('frontend.vendors.single', $product?->vendor?->username)); ?>">
                                                                    <?php echo e($product?->vendor?->owner_name); ?>

                                                                </a>
                                                            </h5>

                                                            <div class="rating-wrap mt-2">
                                                                <div class="rating-wrap">
                                                                    <?php if (isset($component)) { $__componentOriginalb6c5b1e9eac415ed561873efc6076843 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6c5b1e9eac415ed561873efc6076843 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.common.rating-markup','data' => ['avgRattings' => $product?->vendor
                                                                            ?->vendor_product_rating_avg_product_ratingsrating,'ratingCount' => $product?->vendor
                                                                            ?->vendor_product_rating_count]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.common.rating-markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['avg-rattings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product?->vendor
                                                                            ?->vendor_product_rating_avg_product_ratingsrating),'rating-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product?->vendor
                                                                            ?->vendor_product_rating_count)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6c5b1e9eac415ed561873efc6076843)): ?>
<?php $attributes = $__attributesOriginalb6c5b1e9eac415ed561873efc6076843; ?>
<?php unset($__attributesOriginalb6c5b1e9eac415ed561873efc6076843); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6c5b1e9eac415ed561873efc6076843)): ?>
<?php $component = $__componentOriginalb6c5b1e9eac415ed561873efc6076843; ?>
<?php unset($__componentOriginalb6c5b1e9eac415ed561873efc6076843); ?>
<?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="seller-details-box">
                                                        <ul class="seller-box-list">
                                                            <li class="box-list"> <?php echo e(__('From')); ?> <strong>
                                                                    <?php echo e($product?->vendor?->vendor_address?->country?->name); ?>

                                                                </strong> </li>
                                                            <li class="box-list"> <?php echo e(__('About Since')); ?> <strong>
                                                                    <?php echo e($product?->vendor?->created_at?->format('Y')); ?>

                                                                </strong> </li>
                                                        </ul>
                                                        <p class="seller-details-para"><?php echo $product?->vendor?->description; ?></p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div id="reviews"
                                        class="tab-content-item <?php echo e($product->reviews_count > 0 ? 'active' : ''); ?> ">
                                        <div class="single-details-tab">
                                            <div class="feedback">
                                                <?php if(auth('web')->check()): ?>
                                                    <?php if($user_has_item && $user_rated_already): ?>
                                                        <div class="ratings select-ratings">
                                                            <p><?php echo e(__('Your rating')); ?> <span class="required">*</span>
                                                            </p>
                                                            <a href="#1">
                                                                <i data-rating="1" class="lar la-star icon"></i>
                                                                <i data-rating="2" class="lar la-star icon"></i>
                                                                <i data-rating="3" class="lar la-star icon"></i>
                                                                <i data-rating="4" class="lar la-star icon"></i>
                                                                <i data-rating="5" class="lar la-star icon"></i>
                                                            </a>
                                                        </div>
                                                        <div class="feedback-form">
                                                            <form method="POST"
                                                                action="<?php echo e(route('frontend.products.ratings.store', $product->slug)); ?>">
                                                                <?php echo csrf_field(); ?>
                                                                <input name="id" value="<?php echo e($product->id); ?>"
                                                                    type="hidden">
                                                                <input value="" name="rating" id="rating-number"
                                                                    type="hidden" />

                                                                <div class="form-group">
                                                                    <label for="comment">
                                                                        <?php echo e(filter_static_option_value('your_reviews_text', $setting_text, __('Your review'))); ?>

                                                                        &nbsp;
                                                                        <span class="required">*</span>
                                                                    </label>
                                                                    <textarea class="form-control" id="comment" name="comment" required=""
                                                                        placeholder="<?php echo e(filter_static_option_value('write_your_feedback_text', $setting_text, __('Write your feedback here'))); ?>"></textarea>
                                                                </div>
                                                                <div class="btn-wrapper">
                                                                    <button type="submit"
                                                                        class="btn-default rounded-btn">
                                                                        <?php echo e(filter_static_option_value('post_your_feedback_text', $setting_text, __('Post your feedback'))); ?>

                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <form action="<?php echo e(route('user.login')); ?>" method="post"
                                                                class="register-form" id="login_form_order_page">
                                                                <?php echo csrf_field(); ?>
                                                                <div class="error-wrap"></div>

                                                                <div class="row">
                                                                    <div class="form-group col-12">
                                                                        <label
                                                                            for="login_email"><?php echo e(__('Email or User Name')); ?>

                                                                            <span class="ex">*</span></label>
                                                                        <input class="form-control" type="text"
                                                                            name="username" id="login_email" required />
                                                                    </div>
                                                                    <div class="form-group col-12">
                                                                        <label for="login_password"><?php echo e(__('Password')); ?>

                                                                            <span class="ex">*</span></label>
                                                                        <input class="form-control" type="password"
                                                                            name="password" id="login_password"
                                                                            required />
                                                                    </div>
                                                                    <div class="form-group form-check col-12 mx-4">
                                                                        <input type="checkbox" name="remember"
                                                                            class="form-check-input" id="login_remember">
                                                                        <label class="form-check-label"
                                                                            for="remember"><?php echo e(__('Remember me')); ?>

                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="btn-pair">
                                                                    <div class="btn-wrapper">
                                                                        <button type="button"
                                                                            class="cmn-btn btn-bg-1 radius-0"
                                                                            id="login_btn"><?php echo e(__('SIGN IN')); ?></button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>


                                                <div class="tab-review">
                                                    <?php $__empty_1 = true; $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <div class="about-seller-flex-content">
                                                            <div class="about-seller-thumb">
                                                                <a href="#1"> <?php echo render_image($review->user->profile_image); ?> </a>
                                                            </div>
                                                            <div class="about-seller-content">
                                                                <h5 class="title"> <a href="#1">
                                                                        <?php echo e($review?->user?->name); ?> </a> </h5>
                                                                <div class="rating-wrap mt-2">
                                                                    <?php if (isset($component)) { $__componentOriginalb6c5b1e9eac415ed561873efc6076843 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6c5b1e9eac415ed561873efc6076843 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.common.rating-markup','data' => ['avgRattings' => $product->reviews_avg_rating]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.common.rating-markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['avg-rattings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->reviews_avg_rating)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6c5b1e9eac415ed561873efc6076843)): ?>
<?php $attributes = $__attributesOriginalb6c5b1e9eac415ed561873efc6076843; ?>
<?php unset($__attributesOriginalb6c5b1e9eac415ed561873efc6076843); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6c5b1e9eac415ed561873efc6076843)): ?>
<?php $component = $__componentOriginalb6c5b1e9eac415ed561873efc6076843; ?>
<?php unset($__componentOriginalb6c5b1e9eac415ed561873efc6076843); ?>
<?php endif; ?>
                                                                </div>
                                                                <p class="about-review-para">
                                                                    <?php echo e($review->review_msg); ?>

                                                                </p>
                                                                <span
                                                                    class="review-date"><?php echo e($review->created_at->format('d F Y')); ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <h3 class="title text-warning mt-3"><?php echo e(__('No review found')); ?>

                                                        </h3>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Shop Details tab area end -->
                </div>
                <div class="col-xxl-3 col-xl-3">
                    <div class="shop-details-right-sidebar">
                        <?php if($reward ?? '' == true): ?>
                            <div class="single-sidebar-details single-border">
                                <div class="shop-details-gift center-text">
                                    <a href="#1" class="gift-icon"> <i class="las la-gifts"></i> </a>
                                    <h5 class="reward-title fw-500"> <?php echo e(__('Reward Point: 300')); ?> </h5>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($product->vendor): ?>
                            <div class="single-sidebar-details single-border margin-top-40">
                                <div class="shop-details-sold center-text">
                                    <h5 class="title-sidebar-global"> <?php echo e(__('Sold By:')); ?> </h5>
                                    <div class="best-seller-sidebar mt-4">
                                        <a href="<?php echo e(route('frontend.vendors.single', $product->vendor->username)); ?>"
                                            class="thumb-brand">
                                            <?php echo render_image($product->vendor?->vendor_shop_info?->logo); ?>

                                        </a>
                                        <div class="best-seller-contents mt-3">
                                            <h5 class="common-title-two">
                                                <a
                                                    href="<?php echo e(route('frontend.vendors.single', $product->vendor->username)); ?>">
                                                    <?php echo e($product->vendor->business_name); ?>

                                                </a>
                                                <?php if(!empty($product->vendor)): ?>
                                                    <?php if (isset($component)) { $__componentOriginaldbf8ca47d590a5962387840951976eae = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbf8ca47d590a5962387840951976eae = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badges.store-verify-badge','data' => ['vendorStatus' => $product->vendor?->status_id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badges.store-verify-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['vendorStatus' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->vendor?->status_id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldbf8ca47d590a5962387840951976eae)): ?>
<?php $attributes = $__attributesOriginaldbf8ca47d590a5962387840951976eae; ?>
<?php unset($__attributesOriginaldbf8ca47d590a5962387840951976eae); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldbf8ca47d590a5962387840951976eae)): ?>
<?php $component = $__componentOriginaldbf8ca47d590a5962387840951976eae; ?>
<?php unset($__componentOriginaldbf8ca47d590a5962387840951976eae); ?>
<?php endif; ?>
                                                <?php endif; ?>
                                            </h5>

                                            <div class="rating-wrap mt-2">
                                                <div class="rating-wrap">
                                                    <?php if (isset($component)) { $__componentOriginalb6c5b1e9eac415ed561873efc6076843 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6c5b1e9eac415ed561873efc6076843 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.common.rating-markup','data' => ['avgRattings' => $product->vendor
                                                        ->vendor_product_rating_avg_product_ratingsrating,'ratingCount' => $product->vendor->vendor_product_rating_count]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.common.rating-markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['avg-rattings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->vendor
                                                        ->vendor_product_rating_avg_product_ratingsrating),'rating-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->vendor->vendor_product_rating_count)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6c5b1e9eac415ed561873efc6076843)): ?>
<?php $attributes = $__attributesOriginalb6c5b1e9eac415ed561873efc6076843; ?>
<?php unset($__attributesOriginalb6c5b1e9eac415ed561873efc6076843); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6c5b1e9eac415ed561873efc6076843)): ?>
<?php $component = $__componentOriginalb6c5b1e9eac415ed561873efc6076843; ?>
<?php unset($__componentOriginalb6c5b1e9eac415ed561873efc6076843); ?>
<?php endif; ?>
                                                </div>
                                            </div>

                                            <a href="<?php echo e(route('frontend.vendor.product', $product->vendor->username)); ?>"
                                                class="color-stock d-block fs-16 fw-500 mt-3">
                                                <?php echo e($product->vendor?->product_count ?? 0); ?> <?php echo e(__('Products')); ?>

                                            </a>

                                            <div class="sidebar-wrapper-btn">
                                                <a href="<?php echo e(route('frontend.vendors.single', $product->vendor->username)); ?>"
                                                    class="visit-btn btn-visit-chat visit__btn__outline mt-3">
                                                    <?php echo e(__('Visit Store')); ?>

                                                </a>
                                                <?php if(moduleExists('Chat')): ?>
                                                    <?php echo $__env->make('chat::components.live-chat-button', [
                                                        'from' => 'product',
                                                        'product' => $product,
                                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($product->productDeliveryOption->isNotEmpty()): ?>
                            <div class="single-sidebar-details single-border margin-top-40">
                                <div class="shop-details-list">
                                    <ul class="promo-list">
                                        <?php $__currentLoopData = $product->productDeliveryOption ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list">
                                                <div class="icon"> <i class="<?php echo e($option->icon); ?>"></i> </div>
                                                <div class="promon-icon-contents">
                                                    <h6 class="promo-title fw-500"> <?php echo e($option->title); ?> </h6>
                                                    <span class="promo-para"> <?php echo e($option->sub_title); ?> </span>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="single-sidebar-details single-border margin-top-40">
                            <div class="shop-details-share center-text">
                                <h5 class="title-sidebar-global"> <?php echo e(__('Share:')); ?> </h5>
                                <ul class="share-list mt-4">
                                    <?php echo single_post_share(
                                        route('frontend.products.single', purify_html($product->slug)),
                                        purify_html($product->name),
                                        $product_img_url,
                                    ); ?>

                                </ul>
                            </div>
                        </div>
                        <?php if($product->vendor?->product_count > 0): ?>
                            <div class="single-sidebar-details single-border margin-top-40">
                                <div class="shop-product-slider center-text">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h5 class="title-sidebar-global text-left"> <?php echo e(__("Seller's Products")); ?>

                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="global-slick-init deal-slider nav-style-two dot-style-one slider-inner-margin"
                                                data-infinite="true" data-arrows="true" data-dots="false"
                                                data-slidesToShow="1" data-swipeToSlide="true"
                                                data-rtl="<?php echo e(get_user_lang_direction() == 'rtl' ? 'true' : 'false'); ?>"
                                                data-autoplay="true" data-autoplaySpeed="2500"
                                                data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                                                data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>'
                                                data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 1}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 992,"settings": {"slidesToShow": 2,"arrows": false,"dots": true}},{"breakpoint": 768, "settings": {"slidesToShow": 2} },{"breakpoint": 576, "settings": {"slidesToShow": 1} }]'>
                                                <?php $__currentLoopData = $product->vendor->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="slick-slider-items wow fadeInUp"
                                                        data-wow-delay=".<?php echo e($loop->iteration); ?>s">
                                                        <?php if (isset($component)) { $__componentOriginal787b2d37cd3d2d971fca1cfd7834581b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal787b2d37cd3d2d971fca1cfd7834581b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.grid-style-03','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.grid-style-03'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal787b2d37cd3d2d971fca1cfd7834581b)): ?>
<?php $attributes = $__attributesOriginal787b2d37cd3d2d971fca1cfd7834581b; ?>
<?php unset($__attributesOriginal787b2d37cd3d2d971fca1cfd7834581b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal787b2d37cd3d2d971fca1cfd7834581b)): ?>
<?php $component = $__componentOriginal787b2d37cd3d2d971fca1cfd7834581b; ?>
<?php unset($__componentOriginal787b2d37cd3d2d971fca1cfd7834581b); ?>
<?php endif; ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details area end -->
    <!-- Related Products area Starts -->
    <?php if($related_products->count() > 0): ?>
        <section class="related-products-area padding-top-50 padding-bottom-100">
            <div class="container container-one">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-left section-border-bottom">
                            <div class="title-left">
                                <h2 class="title"> <?php echo e(__('Related Products')); ?> </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <div class="global-slick-init relatedProducts-slider recent-slider nav-style-one slider-inner-margin"
                            data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="6"
                            data-swipeToSlide="true"
                            data-rtl="<?php echo e(get_user_lang_direction() == 'rtl' ? 'true' : 'false'); ?>" data-autoplay="true"
                            data-autoplaySpeed="2500"
                            data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                            data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>'
                            data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 5}},{"breakpoint": 1400,"settings": {"slidesToShow": 4}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 992,"settings": {"slidesToShow": 2}},{"breakpoint": 768, "settings": {"slidesToShow": 2}},{"breakpoint": 576, "settings": {"slidesToShow": 1} }]'>
                            <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (isset($component)) { $__componentOriginal787b2d37cd3d2d971fca1cfd7834581b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal787b2d37cd3d2d971fca1cfd7834581b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.grid-style-03','data' => ['product' => $product,'loop' => $loop]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.grid-style-03'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product),'loop' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loop)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal787b2d37cd3d2d971fca1cfd7834581b)): ?>
<?php $attributes = $__attributesOriginal787b2d37cd3d2d971fca1cfd7834581b; ?>
<?php unset($__attributesOriginal787b2d37cd3d2d971fca1cfd7834581b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal787b2d37cd3d2d971fca1cfd7834581b)): ?>
<?php $component = $__componentOriginal787b2d37cd3d2d971fca1cfd7834581b; ?>
<?php unset($__componentOriginal787b2d37cd3d2d971fca1cfd7834581b); ?>
<?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- Related Products area end -->

    <?php if(moduleExists('Chat')): ?>
        <?php echo $__env->make('chat::components.live-chat-modal', ['vendor' => $vendor_information], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if(!empty($vendor_information) && moduleExists('Chat')): ?>
        <?php echo $__env->make('chat::components.frontend-js', ['id' => $product_id, 'vendor' => $vendor_information], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <script>
        let attribute_store = JSON.parse('<?php echo json_encode($product_inventory_set); ?>');

        let additional_info_store = JSON.parse('<?php echo json_encode($additional_info_store); ?>');
        let available_options = $('.value-input-area');
        let selected_variant = '';
        let site_currency_symbol = '<?php echo e(site_currency_symbol()); ?>';

        $(document).on("click", ".select-ratings a i", function() {
            rating_icon.call(this)
        });

        function rating_icon() {
            let rating = $(this).data('rating');
            let icon = document.querySelectorAll(".select-ratings a i");

            // icon[i].classList.remove("las");
            $(".select-ratings a i").each(function() {
                $(this).removeClass("las text-warning").addClass("lar text-warning");
            });

            for (let i = 0; i < rating; i++) {
                icon[i].classList.replace("lar", "las");
            }

            $("#rating-number").val(rating);
        }

        $(document).on('click', '.size-lists li', function(event) {
            let el = $(this);
            let value = el.data('displayValue');
            let parentWrap = el.parent().parent();
            el.addClass('active');
            el.siblings().removeClass('active');
            parentWrap.find('input[type=text]').val(value);
            parentWrap.find('input[type=hidden]').val(el.data('value'));

            $('.size-lists li').addClass('disabled-option');

            // selected attributes
            productDetailSelectedAttributeSearch(this);
        });

        $(document).on('click', '.add_to_cart_single_page', function(e) {
            e.preventDefault();
            let selected_size = $('#selected_size').val();
            let selected_color = $('#selected_color').val();
            let site_currency_symbol = "<?php echo e(site_currency_symbol()); ?>";

            $(".size-lists.active")

            let pid_id = getAttributesForCart();

            let product_id = $(this).data('id');
            let quantity = Number($('#quantity').val().trim());
            let price = $('#price').text().split(site_currency_symbol)[1];
            let attributes = {};
            let product_variant = pid_id;

            attributes['price'] = price;

            // if selected attribute is a valid product item
            if (validateSelectedAttributes()) {
                $.ajax({
                    url: '<?php echo e(route('frontend.products.add.to.cart.ajax')); ?>',
                    type: 'POST',
                    data: {
                        product_id: product_id,
                        quantity: quantity,
                        pid_id: pid_id,
                        product_variant: product_variant,
                        selected_size: selected_size,
                        selected_color: selected_color,
                        attributes: attributes,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(data) {
                        if (data.type ?? false) {
                            toastr[data.type](data.msg);
                        } else {
                            toastr.success(data.msg);
                        }

                        if (data.quantity_msg) {
                            toastr.warning(data.quantity_msg)
                        }

                        loadHeaderCardAndWishlistArea(data);
                    },
                    erorr: function(err) {
                        toastr.error('<?php echo e(__('An error occurred')); ?>');
                    }
                });
            } else {
                toastr.error('<?php echo e(__('Select all attribute to proceed')); ?>');
            }
        });

        $(document).on('click', '.buy_now_single_page', function(e) {
            e.preventDefault();
            let selected_size = $('#selected_size').val();
            let selected_color = $('#selected_color').val();
            let site_currency_symbol = "<?php echo e(site_currency_symbol()); ?>";

            $(".size-lists.active")

            let pid_id = getAttributesForCart();

            let product_id = $(this).data('id');
            let quantity = Number($('#quantity').val().trim());
            let price = $('#price').text().split(site_currency_symbol)[1];
            let attributes = {};
            let product_variant = pid_id;

            attributes['price'] = price;

            // if selected attribute is a valid product item
            if (validateSelectedAttributes()) {
                $.ajax({
                    url: '<?php echo e(route('frontend.products.add.to.cart.ajax')); ?>',
                    type: 'POST',
                    data: {
                        product_id: product_id,
                        quantity: quantity,
                        pid_id: pid_id,
                        product_variant: product_variant,
                        selected_size: selected_size,
                        selected_color: selected_color,
                        attributes: attributes,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(data) {
                        if (data.type ?? false) {
                            toastr[data.type](data.msg);
                        } else {
                            toastr.success(data.msg);
                        }

                        if (data.quantity_msg) {
                            toastr.warning(data.quantity_msg)
                        }

                        setTimeout(function() {
                            window.location.href = "<?php echo e(route('frontend.checkout')); ?>";
                        }, 1500);
                    },
                    erorr: function(err) {
                        toastr.error('<?php echo e(__('An error occurred')); ?>');
                    }
                });
            } else {
                toastr.error('<?php echo e(__('Select all attribute to proceed')); ?>');
            }
        });

        $(document).on('click', '.add_to_wishlist_single_page', function(e) {
            e.preventDefault();
            let selected_size = $('#selected_size').val();
            let selected_color = $('#selected_color').val();
            let site_currency_symbol = "<?php echo e(site_currency_symbol()); ?>";

            $(".size-lists.active")

            let pid_id = getAttributesForCart();

            let product_id = $(this).data('id');
            let quantity = Number($('#quantity').val().trim());
            let price = $('#price').text().split(site_currency_symbol)[1];
            let attributes = {};
            let product_variant = pid_id;

            attributes['price'] = price;

            // if selected attribute is a valid product item
            if (validateSelectedAttributes()) {
                $.ajax({
                    url: '<?php echo e(route('frontend.products.add.to.wishlist.ajax')); ?>',
                    type: 'POST',
                    data: {
                        product_id: product_id,
                        quantity: quantity,
                        pid_id: pid_id,
                        product_variant: product_variant,
                        selected_size: selected_size,
                        selected_color: selected_color,
                        attributes: attributes,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(data) {
                        if (data.type ?? false) {
                            toastr[data.type](data.msg);
                        } else {
                            toastr.success(data.msg);
                        }

                        if (data.quantity_msg) {
                            toastr.warning(data.quantity_msg)
                        }

                        loadHeaderCardAndWishlistArea(data);
                    },
                    erorr: function(err) {
                        toastr.error('<?php echo e(__('An error occurred')); ?>');
                    }
                });
            } else {
                toastr.error('<?php echo e(__('Select all attribute to proceed')); ?>');
            }
        });

        $(document).on('click', '.add_to_compare_single_page', function(e) {
            e.preventDefault();
            let selected_size = $('#selected_size').val();
            let selected_color = $('#selected_color').val();
            let site_currency_symbol = "<?php echo e(site_currency_symbol()); ?>";

            $(".size-lists.active")

            let pid_id = getAttributesForCart();

            let product_id = $(this).data('id');
            let quantity = Number($('#quantity').val().trim());
            let price = $('#price').text().split(site_currency_symbol)[1];
            let attributes = {};
            let product_variant = pid_id;

            attributes['price'] = price;

            // if selected attribute is a valid product item
            if (validateSelectedAttributes()) {
                $.ajax({
                    url: '<?php echo e(route('frontend.products.add.to.compare')); ?>',
                    type: 'POST',
                    data: {
                        product_id: product_id,
                        quantity: quantity,
                        pid_id: pid_id,
                        product_variant: product_variant,
                        selected_size: selected_size,
                        selected_color: selected_color,
                        attributes: attributes,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(data) {
                        if (data.type ?? false) {
                            toastr[data.type](data.msg);
                        } else {
                            toastr.success(data.msg);
                        }

                        if (data.quantity_msg) {
                            toastr.warning(data.quantity_msg)
                        }

                        loadHeaderCardAndWishlistArea(data);
                    },
                    erorr: function(err) {
                        toastr.error('<?php echo e(__('An error occurred')); ?>');
                    }
                });
            } else {
                toastr.error('<?php echo e(__('Select all attribute to proceed')); ?>');
            }
        });


        function productDetailSelectedAttributeSearch(selected_item) {
            /*
             * search based on all selected attributes
             *
             * 1. get all selected attributes in {key:value} format
             * 2. search in attribute_store for all available matches
             * 3. display available matches (keep available matches selectable, and rest as disabled)
             * */

            let available_variant_types = [];
            let selected_options = {};
            let selected_option_with_val = {};

            // get all selected attributes in {key:value} format
            available_options.map(function(k, option) {
                let selected_option = $(option).find('li.active');
                let type = selected_option.closest('.size-lists').data('type');
                let value = selected_option.data('displayValue');

                if (type) {
                    available_variant_types.push(type);
                }

                if (type && value) {
                    selected_options[type] = value;
                }
            });

            syncImage(view_selected_options());
            syncPrice(view_selected_options());
            syncStock(view_selected_options());

            // search in attribute_store for all available matches
            let available_variants_selection = [];
            let selected_attributes_by_type = {};

            attribute_store.map(function(arr) {
                let matched = true;

                Object.keys(selected_options).map(function(type) {
                    if (arr[type] != selected_options[type]) {
                        matched = false;
                    }
                })

                if (matched) {
                    available_variants_selection.push(arr);

                    // insert as {key: [value, value...]}
                    Object.keys(arr).map(function(type) {
                        // not array available for the given key
                        if (!selected_attributes_by_type[type]) {
                            selected_attributes_by_type[type] = []
                        }

                        // insert value if not inserted yet
                        if (selected_attributes_by_type[type].indexOf(arr[type]) <= -1) {
                            selected_attributes_by_type[type].push(arr[type]);
                        }
                    })
                }
            });

            // selected item doesn't contain a product then deselect all selected option hare
            if (Object.keys(selected_attributes_by_type).length == 0) {
                $('.size-lists li.active').each(function() {
                    let sizeItem = $(this).parent().parent();

                    sizeItem.find('input[type=hidden]').val('');
                    sizeItem.find('input[type=text]').val('');
                });

                $('.size-lists li.active').removeClass("active");
                $('.size-lists li.disabled-option').removeClass("disabled-option");

                let el = $(selected_item);
                let value = el.data('displayValue');

                el.addClass("active");

                $(this).find('input[type=hidden]').val(value);
                $(this).find('input[type=text]').val(el.data('value'));

                productDetailSelectedAttributeSearch();
            }

            // keep only available matches selectable
            Object.keys(selected_attributes_by_type).map(function(type) {
                // initially, disable all buttons
                $('.size-lists[data-type="' + type + '"] li').addClass('disabled-option');

                // make buttons selectable for the available options
                selected_attributes_by_type[type].map(function(value) {
                    let available_buttons = $('.size-lists[data-type="' + type +
                        '"] li[data-display-value="' + value + '"]');
                    available_buttons.map(function(key, el) {
                        $(el).removeClass('disabled-option');
                    })
                });
            });
            //  check is empty object
            // selected_attributes_by_type
        }

        function syncImage(selected_options) {
            //todo fire when attribute changed
            let hashed_key = getSelectionHash(selected_options);

            let product_image_el = $('.shop-details-thumb-wrapper.product-image img');

            let img_original_src = $('.shop-details-thumb-wrapper.product-image').attr('data-img-src');

            // if selection has any image to it
            if (additional_info_store[hashed_key]) {
                let attribute_image = additional_info_store[hashed_key].image;
                if (attribute_image) {
                    product_image_el.attr('src', attribute_image);
                } else {
                    product_image_el.attr('src', img_original_src);
                }
            } else {
                product_image_el.attr('src', img_original_src);
            }
        }

        function syncPrice(selected_options) {
            let hashed_key = getSelectionHash(selected_options);

            let product_price_el = $('#price');
            let product_main_price = Number(product_price_el.data('mainPrice')).toFixed(0);
            let tax_percentage = Number(String(product_price_el.data('price-percentage'))).toFixed(0);
            let site_currency_symbol = product_price_el.data('currencySymbol');

            // if selection has any additional price to it
            if (additional_info_store[hashed_key]) {
                let attribute_price = additional_info_store[hashed_key]['additional_price'];
                if (attribute_price) {
                    product_main_price = Number(product_main_price) + Number(attribute_price);
                    let price = calculatePercentage(product_main_price, Number(tax_percentage));

                    product_price_el.text(site_currency_symbol + (Number(price) + Number(product_main_price)));
                } else {
                    product_price_el.text(site_currency_symbol + (calculatePercentage(Number(product_main_price), Number(
                        tax_percentage)) + Number(product_main_price)));
                }
            } else {
                product_price_el.text(site_currency_symbol + (calculatePercentage(Number(product_main_price), Number(
                    tax_percentage)) + Number(product_main_price)));
            }
        }

        function syncStock(selected_options) {
            let hashed_key = getSelectionHash(selected_options);
            let product_stock_el = $('.availability');
            let product_item_left_el = $('.stock-available');

            // if selection has any size and color to it

            if (additional_info_store[hashed_key]) {
                let stock_count = additional_info_store[hashed_key]['stock_count'];

                let stock_message = '';
                if (Number(stock_count) > 0) {
                    stock_message = `<span class="text-success"><?php echo e(__('In Stock')); ?></span>`;
                    product_item_left_el.text(`Only! ${stock_count} Item Left!`);
                    product_item_left_el.addClass('text-success');
                    product_item_left_el.removeClass('text-danger');
                } else {
                    stock_message = `<span class="text-danger"><?php echo e(__('Our fo Stock')); ?></span>`;
                    product_item_left_el.text(`No Item Left!`);
                    product_item_left_el.addClass('text-danger');
                    product_item_left_el.removeClass('text-success');
                }

                product_stock_el.html(stock_message);

            } else {
                product_stock_el.html(product_stock_el.data("stock-text"))
                product_item_left_el.html(product_item_left_el.data("stock-text"))
            }
        }

        function attributeSelected() {
            let total_options_count = $('.size-lists').length;
            let selected_options_count = $('.size-lists li.active').length;
            return total_options_count === selected_options_count;
        }

        function view_selected_options() {
            let selected_options = {};
            let available_options = $('.value-input-area');
            // get all selected attributes in {key:value} format
            available_options.map(function(k, option) {
                let selected_option = $(option).find('li.active');
                let type = selected_option.closest('.size-lists').data('type');
                let value = selected_option.data('displayValue');

                if (type && value) {
                    selected_options[type] = value;
                }
            });

            let ordered_data = {};
            let selected_options_keys = Object.keys(selected_options).sort();

            selected_options_keys.map(function(e) {
                ordered_data[e] = String(selected_options[e]);
            });

            return ordered_data;
        }

        function getAttributesForCart() {
            let selected_options = view_selected_options();
            let cart_selected_options = selected_options;
            let hashed_key = getSelectionHash(selected_options);

            // if selected attribute set is available
            if (additional_info_store[hashed_key]) {
                return additional_info_store[hashed_key]['pid_id'];
            }

            // if selected attribute set is not available
            if (Object.keys(selected_options).length) {
                toastr.error('<?php echo e(__('Attribute not available')); ?>')
            }

            return '';
        }

        function send_ajax_response_get_response(type, url) {
            $.ajax({
                url: url,
                type: type,
                data: {
                    style: "two",
                    limit: $(".product-filter-two-wrapper").data("item-limit")
                },
                headers: {
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>",
                },
                beforeSend: function() {
                    $(".product-filter-two-wrapper").attr("style", "height:912px");
                    $(".filter-style-block-preloader.lds-ellipsis").show();
                },
                success: function(data) {
                    $(".filter-style-block-preloader.lds-ellipsis").hide(300);
                    $(".product-filter-two-wrapper").removeAttr("style");
                    $(".product-filter-two-wrapper").html(data).removeAttr("style");

                    if (data.success == false) {
                        toastr.warning('There something is wrong please try again');
                    }
                },
                erorr: function(err) {
                    $(".product-filter-two-wrapper").removeAttr("style");
                    $(".filter-style-block-preloader.lds-ellipsis").hide(300);
                    toastr.error('<?php echo e(__('An error occurred')); ?>');
                }
            });
        }

        function validateSelectedAttributes() {
            let selected_options = view_selected_options();
            let hashed_key = getSelectionHash(selected_options);

            // validate if product has any attribute
            if (attribute_store.length) {
                if (!Object.keys(selected_options).length) {
                    return false;
                }

                if (!additional_info_store[hashed_key]) {
                    return false;
                }

                return !!additional_info_store[hashed_key]['pid_id'];
            }

            return true;
        }

        function getSelectionHash(selected_options) {
            return MD5(JSON.stringify(selected_options));
        }
        $(document).on("click", ".shop-details-thums-small", function() {
            src = $(this).children().attr('src');
            $("#shop-details-thums").children('img').attr("src", src);
        })
        $(document).on({
            mouseenter: function() {
                // When the mouse enters an element with class 'shop-details-thums-small'
                var src = $(this).children('img').attr('src');
                $("#shop-details-thums").children('img').attr("src", src);
            },
        }, '.shop-details-thums-small');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/frontend/details.blade.php ENDPATH**/ ?>