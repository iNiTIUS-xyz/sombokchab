<?php $__env->startSection('page-title', __('Vendor Page')); ?>
<?php $__env->startSection('title', __('Vendor Page')); ?>

<?php $__env->startSection('style'); ?>
    <style>
        /* Vendor Banner Css */
        .vendor-banner-area {
            padding: 120px 0;
            position: relative;
        }

        .vendor-banner-area::before {
            content: "";
            position: absolute;
            height: 100%;
            width: 100%;
            left: 0;
            top: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }

        .vendor-banner-contents {
            position: relative;
        }

        .vendor-banner-contents-title {
            font-size: 70px;
            font-weight: 500;
            line-height: 1.2;
            color: #fff;
            margin: -10px 0 0;
        }

        @media (min-width: 1200px) and (max-width: 1399.98px) {
            .vendor-banner-contents-title {
                font-size: 64px;
            }
        }

        @media (min-width: 992px) and (max-width: 1199.98px) {
            .vendor-banner-contents-title {
                font-size: 56px;
            }
        }

        @media (min-width: 300px) and (max-width: 991.98px) {
            .vendor-banner-contents-title {
                font-size: 48px;
            }
        }

        @media only screen and (max-width: 767.98px) {
            .vendor-banner-contents-title {
                font-size: 42px;
            }
        }

        @media only screen and (max-width: 575.98px) {
            .vendor-banner-contents-title {
                font-size: 36px;
            }
        }

        @media only screen and (max-width: 480px) {
            .vendor-banner-contents-title {
                font-size: 30px;
            }
        }

        @media only screen and (max-width: 375px) {
            .vendor-banner-contents-title {
                font-size: 28px;
            }
        }

        /* Vendor SuperMarket Css */
        .vendor-superMarker-area {
            position: relative;
        }

        .vendor-superMarket-shape img {
            max-width: 120px;
        }

        @media (min-width: 300px) and (max-width: 991.98px) {
            .vendor-superMarket-shape img {
                max-width: 100px;
            }
        }

        @media only screen and (max-width: 575.98px) {
            .vendor-superMarket-shape img {
                max-width: 80px;
            }
        }

        .vendor-superMarket-shape img:nth-child(1) {
            position: absolute;
            left: 16%;
            top: -60px;
        }

        @media (min-width: 300px) and (max-width: 991.98px) {
            .vendor-superMarket-shape img:nth-child(1) {
                top: -50px;
            }
        }

        @media only screen and (max-width: 575.98px) {
            .vendor-superMarket-shape img:nth-child(1) {
                top: -40px;
            }
        }

        .vendor-superMarket-flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            gap: 20px 24px;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .vendor-superMarket-title {
            font-size: 46px;
            line-height: 1.2;
            font-weight: 500;
            color: var(--heading-color);
        }

        @media (min-width: 300px) and (max-width: 991.98px) {
            .vendor-superMarket-title {
                font-size: 36px;
            }
        }

        @media only screen and (max-width: 480px) {
            .vendor-superMarket-title {
                font-size: 32px;
            }
        }

        @media only screen and (max-width: 375px) {
            .vendor-superMarket-title {
                font-size: 28px;
            }
        }

        .vendor-superMarket-para {
            font-size: 18px;
            line-height: 26px;
            font-weight: 400;
            color: var(--light-color);
            -webkit-hyphens: none;
            -ms-hyphens: none;
            hyphens: none;
            -webkit-line-clamp: unset;
        }

        @media only screen and (max-width: 767.98px) {
            .vendor-superMarket-para {
                font-size: 16px;
            }
        }

        .vendor-superMarket-contents {
            max-width: 600px;
        }

        @media (min-width: 300px) and (max-width: 991.98px) {
            .vendor-superMarket-contents {
                width: 100%;
            }
        }

        .vendor-superMarket-contents-contact-item {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            gap: 12px;
            font-size: 16px;
            font-weight: 400;
            color: var(--light-color);
        }

        .vendor-superMarket-contents-contact-item:not(:last-child) {
            margin-bottom: 10px;
        }

        /* vendor Section title */
        .section-title .title .title-color {
            color: var(--main-color-two);
        }

        /* vendor Global card */
        .vendor-global-card-item {
            border: 1px solid #EDEDED;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .vendor-global-card-item .global-card-thumb {
            background-color: #F9F9F9;
            padding: 20px;
            height: 240px;
            width: 100%;
            text-align: center;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .vendor-global-card-item .global-card-thumb img {
            margin-inline: auto;
            width: auto;
            max-height: 190px;
            max-width: 100%;
        }

        .vendor-global-card-item .common-title {
            font-size: 18px;
            font-weight: 500;
            line-height: 24px;
            color: var(--heading-color);
        }

        .vendor-global-card-item .stock-available {
            font-weight: 400;
            color: var(--light-color);
        }

        .vendor-global-card-item .btn-wrapper .btn-outline-two {
            border-width: 1px !important;
            padding-inline: 15px !important;
            line-height: 24px;
            font-weight: 400;
        }

        .price-btn-flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            gap: 15px 0;
        }

        .thumb-top-rated {
            position: absolute;
            top: 20px;
            left: 0px;
            z-index: 9;
            display: block;
        }

        .thumb-top-rated.right-side {
            left: auto;
            right: 0px;
        }

        .thumb-top-rated.right-side .thumb-top-rated-item {
            border-radius: 5px 0 0 5px;
        }

        .thumb-top-rated-item {
            display: block;
            font-weight: 500;
            font-size: 14px;
            line-height: 20px;
            padding: 5px 15px;
            color: #fff;
            background-color: var(--main-color-one);
            border-radius: 0 5px 5px 0;
        }

        .thumb-top-rated-item:not(:last-child) {
            margin-bottom: 10px;
        }

        .thumb-top-rated-item.bg-two {
            background-color: var(--main-color-two);
        }

        .thumb-top-rated-item.bg-three {
            background-color: var(--main-color-three);
        }

        .vendor-product-isotope {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            gap: 12px;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .vendor-product-isotope.isootope-button {
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .vendor-product-isotope.isootope-button .list {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            gap: 7px;
        }

        .vendor-product-isotope.isootope-button .list:not(:last-child) {
            margin-right: 0;
        }

        .vendor-product-isotope.isootope-button .list.active {
            color: unset;
        }

        .vendor-product-isotope.isootope-button .list::before {
            background-color: unset;
        }

        .vendor-product-isotope .list {
            display: inline-block;
            padding: 5px 12px;
            font-size: 16px;
            line-height: 20px;
            font-weight: 300;
            color: var(--light-color);
            border: 1px solid var(--extra-light-color);
            border-radius: 10px;
            cursor: pointer;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .vendor-product-isotope .list::before {
            background-color: unset !important;
        }

        .vendor-product-isotope .list.active,
        .vendor-product-isotope .list:hover {
            background-color: var(--main-color-two);
            border-color: var(--main-color-two);
            color: #fff !important;
        }

        .vendor-product-isotope .list.active img,
        .vendor-product-isotope .list:hover img {
            -webkit-filter: invert(97%) sepia(93%) saturate(29%) hue-rotate(24deg) brightness(107%) contrast(107%);
            filter: invert(97%) sepia(93%) saturate(29%) hue-rotate(24deg) brightness(107%) contrast(107%);
        }

        .vendor-product-isotope .list img {
            margin: -4px 0 0;
        }

        .append-popularProduct {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            gap: 12px;
        }

        .append-popularProduct .prev-icon,
        .append-popularProduct .next-icon {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            height: 40px;
            width: 40px;
            background-color: rgba(var(--main-color-two-rgb), 0.6);
            color: #fff;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
        }

        .append-popularProduct .prev-icon:hover,
        .append-popularProduct .next-icon:hover {
            background-color: var(--main-color-two);
        }

        .product-countdown {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            gap: 5px 12px;
        }

        .product-countdown-para {
            font-size: 16px;
            line-height: 24px;
            font-weight: 400;
            color: var(--heading-color);
        }
        .only-img-page-wrapper.cart .img-box img {
            height: 100%;
        }

        .only-img-page-wrapper.cart .img-box {
            height: 400px;
            display: flex;
            justify-content: center;
        }


      /* store color settings   */
        .vendor-superMarket-para {
            color: <?php echo e($vendor?->vendor_shop_info?->colors['store_paragraph_color'] ?? 'var(--light-color)'); ?>;
        }
        .section-title .title {
            color: <?php echo e($vendor?->vendor_shop_info?->colors['store_heading_color'] ?? 'var(--heading-color)'); ?>;
        }
        .section-title .title .title-color{
            color: <?php echo e($vendor?->vendor_shop_info?->colors['store_color'] ?? 'var(--main-color-two)'); ?>;
        }
        .btn-wrapper .cmn-btn.btn-bg-2 {
            background: <?php echo e($vendor?->vendor_shop_info?->colors['store_secondary_color'] ?? 'var(--main-color-two)'); ?>;
            border: 2px solid <?php echo e($vendor?->vendor_shop_info?->colors['store_secondary_color'] ?? 'var(--main-color-two)'); ?>;
        }
        .vendor-banner-contents-title {
            color: <?php echo e($vendor?->vendor_shop_info?->colors['store_heading_color'] ?? '#fff'); ?>;
        }
        .vendor-superMarket-title {
            color: <?php echo e($vendor?->vendor_shop_info?->colors['store_heading_color'] ?? 'var(--heading-color)'); ?>;
        }
        .vendor-product-isotope .list.active, .vendor-product-isotope .list:hover {
            background-color: <?php echo e($vendor?->vendor_shop_info?->colors['store_secondary_color'] ?? 'var(--main-color-two)'); ?>;
        }
        .append-popularProduct .prev-icon, .append-popularProduct .next-icon {
            background-color: <?php echo e($vendor?->vendor_shop_info?->colors['store_secondary_color'] ?? 'rgba(var(--main-color-two-rgb), 0.6)'); ?>;
        }
        .append-popularProduct .prev-icon:hover, .append-popularProduct .next-icon:hover {
            background-color: <?php echo e($vendor?->vendor_shop_info?->colors['store_color'] ?? 'var(--main-color-two)'); ?>;
        }
    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="vendor-banner-area" style="<?php echo e(render_image($vendor->cover_photo, size: 'full', render_type: 'bg')); ?>;">
        <div class="container">
            <div class="vendor-banner-contents center-text">
                <h2 class="vendor-banner-contents-title"><?php echo e(__('Welcome to')); ?> <?php echo e($vendor->business_name); ?></h2>
            </div>
        </div>
    </div>
    <!-- Vendor Banner area end -->

    <?php if($vendor->product_count < 1): ?>
        <div class="cart-page-wrapper padding-top-20 padding-bottom-20">
            <?php if (isset($component)) { $__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.page.empty','data' => ['image' => get_static_option('empty_cart_image'),'text' => __('No products found for this vendor!')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.page.empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('empty_cart_image')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('No products found for this vendor!'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d)): ?>
<?php $attributes = $__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d; ?>
<?php unset($__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d)): ?>
<?php $component = $__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d; ?>
<?php unset($__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d); ?>
<?php endif; ?>
        </div>
    <?php else: ?>
        <!-- Vendor supermarket area start -->
        <section class="vendor-superMarker-area padding-top-20 padding-bottom-20">
            <div class="vendor-superMarket-shape">
                <?php echo render_image($vendor->logo); ?>

                <?php if (isset($component)) { $__componentOriginaldbf8ca47d590a5962387840951976eae = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbf8ca47d590a5962387840951976eae = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badges.store-verify-badge','data' => ['vendorStatus' => $vendor->status_id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('badges.store-verify-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['vendorStatus' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($vendor->status_id)]); ?>
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
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="vendor-superMarket">
                            <div class="vendor-superMarket-flex">
                                <div class="vendor-superMarket-contents">
                                    <h4 class="vendor-superMarket-title"><?php echo e($vendor->business_name); ?></h4>
                                    <?php if($vendor->vendor_product_rating_count > 0): ?>
                                        <div class="rating-wrap mt-2">
                                            <div class="ratings">
                                                <span class="hide-rating"></span>
                                                <span class="show-rating"
                                                    style="width: <?php echo e(($vendor->vendor_product_rating_avg_product_ratingsrating ?? 0) * 20); ?>"></span>
                                            </div>
                                            <p> <span class="total-ratings">(<?php echo e($vendor->vendor_product_rating_count); ?>+
                                                    Review)</span></p>
                                        </div>
                                    <?php endif; ?>

                                    <p class="vendor-superMarket-para mt-3">
                                        <?php echo e($vendor->description); ?>

                                    </p>
                                </div>
                                <div class="btn-wrapper">
                                    <a href="<?php echo e(route('frontend.vendor.product', $vendor->username)); ?>"
                                        class="cmn-btn btn-bg-2 btn-small"><?php echo e($vendor->product_count); ?>

                                        <?php echo e(__('Products are available')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Vendor supermarket area end -->

        <!-- Vendor Popular Product area Starts -->
        <section class="vendor-popular-product-area padding-top-50 padding-bottom-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-left">
                            <h2 class="title"><?php echo e(__('Our Popular')); ?> <span class="title-color"><?php echo e(__('Product')); ?></span>
                            </h2>
                            <div class="append-popularProduct"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="global-slick-init slider-inner-margin" data-appendArrows=".append-popularProduct"
                            data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="4"
                            data-swipeToSlide="true"
                             data-rtl="<?php echo e(get_user_lang_direction() == 'rtl' ? 'true' : 'false'); ?>"
                             data-autoplay="false" data-autoplaySpeed="2500"
                            data-prevArrow='<div class="prev-icon"><i class="las la-angle-left"></i></div>'
                            data-nextArrow='<div class="next-icon"><i class="las la-angle-right"></i></div>'
                            data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 4}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 992,"settings": {"slidesToShow": 2}},{"breakpoint": 576, "settings": {"slidesToShow": 1} }]'>

                            <?php $__currentLoopData = $ourPopularProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (isset($component)) { $__componentOriginalf4189877c329cba31b6a25fa996c73cc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4189877c329cba31b6a25fa996c73cc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.grid-style-04','data' => ['product' => $product,'loop' => $loop]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.grid-style-04'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product),'loop' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loop)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4189877c329cba31b6a25fa996c73cc)): ?>
<?php $attributes = $__attributesOriginalf4189877c329cba31b6a25fa996c73cc; ?>
<?php unset($__attributesOriginalf4189877c329cba31b6a25fa996c73cc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4189877c329cba31b6a25fa996c73cc)): ?>
<?php $component = $__componentOriginalf4189877c329cba31b6a25fa996c73cc; ?>
<?php unset($__componentOriginalf4189877c329cba31b6a25fa996c73cc); ?>
<?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Vendor Popular Porduct area end -->

        <!-- Vendor All Product area Start -->
        <section class="vendor-all-product-area padding-top-50 padding-bottom-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2 class="title"><?php echo e(__('Our All')); ?> <span class="title-color"><?php echo e(__('Product')); ?></span></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-list mt-4">
                            <ul class="isootope-button vendor-product-isotope">
                                <li class="list active" data-filter="*">
                                    <?php echo e(__("All Product")); ?>

                                </li>
                                <?php $__currentLoopData = $ourAllProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list" data-filter=".<?php echo e($category->slug); ?>">
                                        <?php echo e($category->name); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="imageloaded">
                    <div class="row grid mt-4">
                        <?php $__currentLoopData = $ourAllProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $category->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xxl-3 col-lg-4 col-md-6 mt-4 grid-item <?php echo e($category->slug); ?> wow fadeInUp"
                                    data-wow-delay=".<?php echo e($loop->iteration); ?>s">
                                    <?php
                                        $campaign_product = $product->campaign_product ?? null;
                                        $campaignProductEndDate = $product->campaign->end_date ?? ($product->campaign->end_date->end_date ?? '');
                                        $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
                                        $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
                                        $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
                                        $campaignSoldCount = $product?->campaign_sold_product;
                                        $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : optional($product->inventory)->stock_count;
                                        $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ? $stock_count : 0;
                                        $rating_width = round(($product->ratings_avg_rating ?? 0) * 20);
                                    ?>

                                    <div class="global-card-item vendor-global-card-item radius-10">
                                        <div class="global-card-thumb radius-10">
                                            <a href="#1">
                                                <?php echo render_image($product->image); ?>

                                            </a>
                                            <ul class="global-thumb-icons hover-color-two">
                                                <?php if (isset($component)) { $__componentOriginal81acad0afa8bc6f8d7807625a8903bc9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal81acad0afa8bc6f8d7807625a8903bc9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.common.link-option','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.common.link-option'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal81acad0afa8bc6f8d7807625a8903bc9)): ?>
<?php $attributes = $__attributesOriginal81acad0afa8bc6f8d7807625a8903bc9; ?>
<?php unset($__attributesOriginal81acad0afa8bc6f8d7807625a8903bc9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal81acad0afa8bc6f8d7807625a8903bc9)): ?>
<?php $component = $__componentOriginal81acad0afa8bc6f8d7807625a8903bc9; ?>
<?php unset($__componentOriginal81acad0afa8bc6f8d7807625a8903bc9); ?>
<?php endif; ?>
                                            </ul>
                                        </div>
                                        <div class="global-card-contents">
                                            <h4 class="common-title">
                                                <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>">
                                                    <?php echo e($product->name); ?>

                                                </a>
                                            </h4>

                                            <div class="d-flex flex-wrap justify-content-between">
                                                <div class="stock mt-2">
                                                    <span
                                                        class="stock-available <?php echo e($stock_count ? 'text-success' : 'text-danger'); ?>">
                                                        <?php echo e($stock_count ? "In Stock ($stock_count)" : 'Out of stock'); ?> </span>
                                                </div>

                                                <div class="rating-wrap mt-2">
                                                    <div class="rating-wrap">
                                                        <?php if (isset($component)) { $__componentOriginalb6c5b1e9eac415ed561873efc6076843 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6c5b1e9eac415ed561873efc6076843 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.common.rating-markup','data' => ['ratingCount' => $product->ratings_count,'avgRattings' => $product->ratings_avg_rating ?? 0]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.common.rating-markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rating-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->ratings_count),'avg-rattings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->ratings_avg_rating ?? 0)]); ?>
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
                                            <div class="price-btn-flex mt-2">
                                                <div class="price-update-through">
                                                    <span class="fs-24 fw-500 flash-prices color-two">
                                                        <?php echo e(float_amount_with_currency_symbol($sale_price)); ?> </span>
                                                    <span class="fs-18 flash-old-prices">
                                                        <?php echo e(float_amount_with_currency_symbol($deleted_price)); ?> </span>
                                                </div>
                                                <div class="btn-wrapper">
                                                    <?php if($product?->inventory_detail_count > 0): ?>
                                                        <a href="javacript:void(0)"
                                                            data-action-route="<?php echo e(route('frontend.products.single-quick-view', $product->slug)); ?>"
                                                            data-attributes="<?php echo e($product->attributes); ?>"
                                                            data-id="<?php echo e($product->id); ?>"
                                                            class="cmn-btn btn-outline-two color-two btn-small product-quick-view-ajax"><?php echo e(__('Buy Now')); ?></a>
                                                    <?php else: ?>
                                                        <a href="javacript:void(0)" data-id="<?php echo e($product->id); ?>"
                                                            class="cmn-btn btn-outline-two color-two btn-small add_to_buy_now_ajax"><?php echo e(__('Buy Now')); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Vendor All Product area end -->

        <?php if(!$vendorCampaigns->isEmpty()): ?>
            <!-- Vendor Product Campaign area Start -->
            <section class="vendor-campaing-area padding-bottom-50 padding-top-50">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title-countdown">
                                <div class="section-title text-left">
                                    <h2 class="title"><?php echo e(__('Our')); ?> <span
                                            class="title-color"><?php echo e(__('Campaigns')); ?></span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <?php $__currentLoopData = $vendorCampaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xl-4 col-lg-4 col-sm-6 mt-4 campaign-counter"
                                data-date="<?php echo e($campaign->end_date->format('Y-m-d h:i:s')); ?>">
                                <div class="global-card-item center-text radius-10">
                                    <div class="global-card-thumb radius-10">
                                        <a href="<?php echo e(route('frontend.products.campaign', $campaign->slug)); ?>">
                                            <?php echo render_image($campaign->campaignImage); ?>

                                        </a>
                                    </div>
                                    <div class="global-card-contents">
                                        <div class="campaign-countdown">
                                            <div><span class="counter-days"></span> d</div>
                                            <div><span class="counter-hours"></span> h</div>
                                            <div><span class="counter-minutes"></span> m</div>
                                            <div><span class="counter-seconds"></span> s</div>
                                        </div>
                                        <h4 class="common-title-two mt-3"> <a href="#1"> <?php echo e($campaign->title); ?> </a>
                                        </h4>
                                        <p class="common-para mt-1">
                                            <?php echo e($campaign->subtitle); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
            <!-- Vendor Product Campaign area end -->
        <?php endif; ?>


        <!-- vendor location -->
        <?php if(!empty($vendor->vendor_address?->google_map_location)): ?>
            <section class="vendor-superMarker-area padding-top-50 padding-bottom-50">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title-countdown">
                                <div class="section-title text-left">
                                    <h2 class="title"><?php echo e(__('Store')); ?> <span class="title-color"><?php echo e(__('Location')); ?></span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="vendor-superMarket mt-5">
                                <div class="vendor-superMarket-flex">
                                     <iframe src="<?php echo e($vendor->vendor_address?->google_map_location); ?>"
                                            width="1296" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>


        <!-- back to top area start -->
        <div class="back-to-top bg-color-two">
            <span class="back-top"> <i class="las la-angle-up"></i> </span>
        </div>
        <!-- back to top area end -->
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            loopcounter('campaign-counter');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Vendor\Resources/views/frontend/single-vendors.blade.php ENDPATH**/ ?>