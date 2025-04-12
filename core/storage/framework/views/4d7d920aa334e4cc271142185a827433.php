<?php
    $attributes = $product?->inventory_detail_count ?? null;
    $campaign_product = $product->campaign_product ?? null;
    $campaignProductEndDate = $product->campaign->end_date ?? $product->campaign->end_date->end_date ?? '';
    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
    $campaignSoldCount = $product?->campaign_sold_product;
    $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : optional($product->inventory)->stock_count;
    $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ? $stock_count : 0;
    $filter = $filter ?? false;
    $product_img_url = render_image($product->image,render_type: 'url');
    $randomCountDown = rand(1111111,9999999);
?>
<div class="modal-dialog modal-xl">
    <div class="modal-content quick-view-modal p-2 py-4 p-sm-4">
        <div class="quick-view-close-btn-wrapper quick-view-details">
            <button class="quick-view-close-btn"><i class="las la-times"></i></button>
        </div>
        <!-- Shop Details area end -->
        <section class="shop-details-area">
            <div class="container container-one">
                <div class="row justify-content-center">
                    <div class="col-xxl-12 col-xl-12">
                        <div class="row g-4">
                            <div class="col-lg-6 col-xl-6">
                                <div class="shop-details-top-slider big-product-image">

                                    <div class="quick-view-shop-details-thumb-wrapper text-center bg-item-five quick-view-product-image"
                                            data-img-src="<?php echo e(render_image($product->image,class: 'lazyloads',render_type: 'url')); ?>">
                                        <div class="shop-details-thums">
                                            <?php echo render_image($product->image,class: 'lazyloads'); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="shop-details-bottom-slider-area mt-4">
                                    <div class="global-slick-quick-view-init shop-details-click-img dot-style-one banner-dots dot-absolute slider-inner-margin"
                                         data-infinite="true" data-slidesToShow="4" data-dots="true"
                                         data-rtl="<?php echo e(get_user_lang_direction() == 'rtl' ? 'true' : 'false'); ?>"
                                         data-autoplaySpeed="3000"
                                        data-autoplay="true" data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 3}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 992,"settings": {"slidesToShow": 3,"arrows": false,"dots": true}},{"breakpoint": 768, "settings": {"slidesToShow": 2} },{"breakpoint": 576, "settings": {"slidesToShow": 2} }]'>
                                        <div class="shop-details-thumb-wrapper text-center bg-item-five">
                                            <div class="shop-details-thums shop-details-thums-small">
                                                <?php echo render_image($product->image,class: 'lazyloads'); ?>

                                            </div>
                                        </div>

                                        <?php $__currentLoopData = $product->gallery_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="shop-details-thumb-wrapper text-center bg-item-five">
                                                <div class="shop-details-thums shop-details-thums-small">
                                                    <?php echo render_image($image,class: 'lazyloads'); ?>

                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-5">
                                <div class="single-shop-details-wrapper">
                                    <h2 class="details-title"><?php echo e($product->name); ?></h2>
                                    <div class="rating-wrap">
                                        <?php echo view('product::components.frontend.common.rating-markup', compact('product')); ?>

                                    </div>

                                    <?php if($stock_count > 0): ?>
                                        <span data-stock-text="<?php echo e($stock_count); ?>" class="quick-view-availability text-success"><?php echo e(filter_static_option_value('product_in_stock_text', $setting_text, __('In stock'))); ?> (<?php echo e($stock_count); ?>)</span>
                                    <?php else: ?>
                                        <span data-stock-text="<?php echo e($stock_count); ?>" class="quick-view-availability text-danger"><?php echo e(filter_static_option_value('product_out_of_stock_text', $setting_text, __('Out of stock'))); ?></span>
                                    <?php endif; ?>

                                    <div class="price-update-through mt-4">
                                        <h3 class="ff-rubik flash-prices color-one price"
                                            data-main-price="<?php echo e($sale_price); ?>"
                                            data-currency-symbol="<?php echo e(site_currency_symbol()); ?>"
                                            data-price-percentage="<?php echo e(\Modules\TaxModule\Services\CalculateTaxServices::pricesEnteredWithTax() ? $product->tax_options_sum_rate : 0); ?>"
                                            id="quick-view-price"> <?php echo e(float_amount_with_currency_symbol(calculatePrice($sale_price, $product))); ?> </h3>
                                        <span class="fs-22 flash-old-prices" id="deleted_price" data-deleted-price="<?php echo e(calculatePrice($deleted_price, $product)); ?>">
                                            <?php echo e(float_amount_with_currency_symbol(calculatePrice($deleted_price, $product))); ?>

                                        </span>
                                    </div>

                                    <div class="short-description mt-3">
                                        <p class="info"><?php echo $product->summary; ?></p>
                                    </div>

                                    <?php if($productSizes->count() > 0 && !empty(current(current($productSizes)))): ?>
                                        <div class="quick-view-value-input-area margin-top-15 size_list">
                                            <span class="input-list">
                                                <strong class="color-light"><?php echo e(__('Size:')); ?></strong>
                                                <input class="form--input value-size" name="size" type="text" value="">
                                                <input type="hidden" id="quick_view_selected_size">
                                            </span>
                                            <ul class="quick-view-size-lists" data-type="Size">
                                                <?php $__currentLoopData = $productSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!empty($product_size)): ?>
                                                        <li class=""
                                                            data-value="<?php echo e(optional($product_size)->id); ?>"
                                                            data-display-value="<?php echo e(optional($product_size)->name); ?>"
                                                        > <?php echo e(optional($product_size)->name); ?> </li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($productColors->count() > 0 && current(current($productColors))): ?>
                                        <div class="quick-view-value-input-area mt-4 color_list">
                                            <span class="input-list">
                                                <strong class="color-light"><?php echo e(__('Color:')); ?></strong>
                                                <input class="form--input value-size" disabled name="color" type="text" value="">
                                                <input type="hidden" id="quick_view_selected_color">
                                            </span>

                                            <ul class="quick-view-size-lists color-list" data-type="Color">
                                                <?php $__currentLoopData = $productColors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!empty($product_color)): ?>
                                                        <li style="background: <?php echo e(optional($product_color)->color_code); ?>"
                                                            class="radius-percent-50"
                                                            data-value="<?php echo e(optional($product_color)->id); ?>"
                                                            data-display-value="<?php echo e(optional($product_color)->name); ?>">
                                                            <span class="color-list-overlay"></span>
                                                            <span style="background: <?php echo e(optional($product_color)->color_code); ?>"></span>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                    <?php $__currentLoopData = $available_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute => $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="quick-view-value-input-area margin-top-15 attribute_options_list">
                                        <span class="input-list">
                                            <strong class="color-light"><?php echo e($attribute); ?></strong>
                                            <input class="form--input value-size" type="text" value="">
                                            <input type="hidden" id="selected_attribute_option"
                                                    name="selected_attribute_option">
                                        </span>
                                            <ul class="quick-view-size-lists" data-type="<?php echo e($attribute); ?>">
                                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="" data-value="<?php echo e($option); ?>"
                                                        data-display-value="<?php echo e($option); ?>" > <?php echo e($option); ?> </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <div class="quantity-area mt-4">
                                        <div class="quantity-flex">
                                            <span class="quantity-title color-light"> <?php echo e(__("Quantity:")); ?> </span>
                                            <div class="product-quantity">
                                                <span class="substract"><i class="las la-minus"></i></span><input class="quantity-input" id="quick-view-quantity" type="number" value="01"><span class="plus"><i class="las la-plus"></i></span>
                                            </div>

                                            <span data-stock-text="<?php echo e($stock_count); ?>" class="quick-view-stock-available <?php echo e($stock_count ? "text-success" : "text-danger"); ?>"> <?php echo e($stock_count ? "In Stock ($stock_count)" : "Out of stock"); ?> </span>
                                        </div>
                                        <div class="quantity-btn margin-top-40">
                                            <div class="btn-wrapper">
                                                <a href="#1" data-id="<?php echo e($product->id); ?>" class="cmn-btn btn-bg-1 radius-0 cart-loading add_to_cart_single_page_quick_view"> <?php echo e(__("Add to Cart")); ?> </a>
                                            </div>
                                            <a href="#1" data-id="<?php echo e($product->id); ?>" class="heart-btn add_to_wishlist_single_page_quick_view fs-32 color-one radius-0"> <i class="lar la-heart"></i> </a>
                                        </div>
                                    </div>
                                    <div class="wishlist-compare">
                                        <div class="wishlist-compare-btn mt-4">
                                            <a href="#1" data-id="<?php echo e($product->id); ?>" class="btn-wishlist buy_now_single_page_quick_view btn-details btn-buyNow"> <i class="las la-cart-arrow-down"></i> <?php echo e(__("Buy now")); ?> </a>
                                            <a href="#1" data-id="<?php echo e($product->id); ?>" class="btn-wishlist add_to_compare_single_page_quick_view btn-details btn-addCompare"> <i class="las la-retweet"></i> <?php echo e(__("Add Compare")); ?> </a>
                                        </div>
                                    </div>
                                    <div class="shop-details-stock shop-border-top pt-4 mt-4">
                                        <div class="details-checkout-shop">
                                            <span class="guaranteed-checkout fw-500 color-light"> <?php echo e(__("Guaranteed Safe Checkout")); ?> </span>
                                            <div class="global-slick-quick-view-init mt-4 payment-slider nav-style-two dot-style-one slider-inner-margin"
                                                 data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="5" data-swipeToSlide="true"
                                                 data-rtl="<?php echo e(get_user_lang_direction() == 'rtl' ? 'true' : 'false'); ?>"
                                                 data-autoplay="true" data-autoplaySpeed="2500" data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                                                        data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>' data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 5}},{"breakpoint": 1200,"settings": {"slidesToShow": 4}},{"breakpoint": 992,"settings": {"slidesToShow": 4,"arrows": false,"dots": true}},{"breakpoint": 768, "settings": {"slidesToShow": 2} },{"breakpoint": 576, "settings": {"slidesToShow": 2} }]'>
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
                                            <li class="category-list">
                                                <strong> <?php echo e(__("Category:")); ?> </strong>
                                                <a class="list-item" href="<?php echo e(route("frontend.products.category", $product?->category?->slug)); ?>"> <?php echo e($product?->category?->name); ?> </a>
                                            </li>
                                            <li class="category-list">
                                                <strong> <?php echo e(__("Sub Category:")); ?> </strong>
                                                <a class="list-item" href="<?php echo e(route("frontend.products.subcategory", $product?->subCategory?->slug)); ?>"> <?php echo e($product?->subCategory?->name); ?> </a>
                                            </li>
                                            <li class="category-list">
                                                <strong> <?php echo e(__("Child Category:")); ?> </strong>
                                                <?php $__currentLoopData = $product?->childCategory ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a class="list-item" href="<?php echo e(route("frontend.products.child-category", $childCategory?->slug)); ?>"> <?php echo e($childCategory?->name); ?> </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </li>
                                            <li class="category-list">
                                                <strong> <?php echo e(__("Sku:")); ?> </strong>
                                                <label class="list-item"> <?php echo e($product->inventory?->sku); ?> </label>
                                            </li>
                                        </ul>

                                        <?php if($product->tag?->isNotEmpty()): ?>
                                            <div class="tags-area-shop shop-border-top pt-4 mt-4">
                                                <span class="tags-span color-light"> <strong> <?php echo e(__("Tags:")); ?> </strong> </span>
                                                <ul class="tags-shop-list">
                                                    <?php $__currentLoopData = $product->tag; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="list">
                                                            <a href="<?php echo e(route('frontend.products.all', ['tag-name' => $tag->tag_name])); ?>"> <?php echo e($tag->tag_name); ?> </a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-xl-12">
                        <div class="shop-details-right-sidebar">
                            <?php if($reward ?? "" == true): ?>
                                <div class="single-sidebar-details single-border">
                                    <div class="shop-details-gift center-text">
                                        <a href="#1" class="gift-icon"> <i class="las la-gifts"></i> </a>
                                        <h5 class="reward-title fw-500"> <?php echo e(__("Reward Point: 300")); ?> </h5>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-xl-4 col-md-6"><?php if($product->vendor): ?>
                                        <div class="single-sidebar-details single-border margin-top-40">
                                            <div class="shop-details-sold center-text">
                                                <h5 class="title-sidebar-global"> <?php echo e(__("Sold BY:")); ?> </h5>
                                                <div class="best-seller-sidebar mt-4">
                                                    <a href="#1" class="thumb-brand">
                                                        <?php echo render_image($product->vendor?->vendor_shop_info?->logo); ?>

                                                    </a>
                                                    <div class="best-seller-contents mt-3">
                                                        <h5 class="common-title-two">
                                                            <a href="#1"> <?php echo e($product->vendor->business_name); ?> </a>
                                                        </h5>

                                                        <div class="rating-wrap mt-2">
                                                            <div class="rating-wrap">
                                                                <?php if (isset($component)) { $__componentOriginalb6c5b1e9eac415ed561873efc6076843 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6c5b1e9eac415ed561873efc6076843 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.common.rating-markup','data' => ['avgRattings' => $product->vendor->vendor_product_rating_avg_product_ratingsrating,'ratingCount' => $product->vendor->vendor_product_rating_count]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.common.rating-markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['avg-rattings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->vendor->vendor_product_rating_avg_product_ratingsrating),'rating-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->vendor->vendor_product_rating_count)]); ?>
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

                                                        <a href="<?php echo e(route("frontend.vendor.product", $product->vendor->username)); ?>" class="color-stock d-block fs-16 fw-500 mt-3">
                                                            <?php echo e($product->vendor?->product_count ?? 0); ?><?php echo e(__(" Products")); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?></div>
                                <div class="col-xl-4 col-md-6"><div class="single-sidebar-details single-border margin-top-40 px-2">
                                        <div class="shop-details-share center-text px-0">
                                            <h5 class="title-sidebar-global"> <?php echo e(__("Share")); ?>: </h5>
                                            <ul class="share-list mt-4">
                                                <?php echo single_post_share(route('frontend.products.single', purify_html($product->slug)), purify_html($product->name), $product_img_url); ?>

                                            </ul>
                                        </div>
                                    </div></div>
                                <div class="col-xl-4 col-md-6"><?php if($product->productDeliveryOption?->isNotEmpty()): ?>
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
                                    <?php endif; ?></div>
                            </div>

                            <?php if($product->vendor?->product_count > 0): ?>
                                <div class="single-sidebar-details single-border margin-top-40">
                                    <div class="shop-product-slider center-text">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h5 class="title-sidebar-global text-left"> <?php echo e(__("Seller's Products")); ?> </h5>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-lg-12">
                                                <div class="global-slick-quick-view-init deal-slider nav-style-two dot-style-one slider-inner-margin"
                                                     data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="3" data-swipeToSlide="true"
                                                     data-rtl="<?php echo e(get_user_lang_direction() == 'rtl' ? 'true' : 'false'); ?>"
                                                     data-autoplay="true" data-autoplaySpeed="2500" data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                                                        data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>' data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 1}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 992,"settings": {"slidesToShow": 2,"arrows": false,"dots": true}},{"breakpoint": 768, "settings": {"slidesToShow": 2} },{"breakpoint": 576, "settings": {"slidesToShow": 1} }]'>
                                                    <?php $__currentLoopData = $product->vendor->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="slick-slider-items wow fadeInUp" data-wow-delay=".<?php echo e($loop->iteration); ?>s">
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
    </div>
</div>



<script>

    <?php
        $product_inventory_set = current($product_inventory_set) ?? "";
    ?>

    // check condition if those variable are declared than no need to declare again
    window.quick_view_attribute_store = JSON.parse('<?php echo json_encode($product_inventory_set); ?>');
    window.quick_view_additional_info_store = JSON.parse('<?php echo json_encode($additional_info_store); ?>');
    window.quick_view_available_options = $('.quick-view-value-input-area');

    loopcounter('flash-countdown-product-quick-view-<?php echo e($randomCountDown); ?>');
</script>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/product/quick-view.blade.php ENDPATH**/ ?>