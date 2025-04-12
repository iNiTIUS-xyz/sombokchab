<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
    <div class="allProduct__item radius-10 bg-white">
        <div class="allProduct__item__thumb">
            <a href="<?php echo e(route('frontend.vendors.single', $vendor->username)); ?>">
                <?php echo render_image($vendor->cover_photo); ?>

            </a>
        </div>
        <div class="allProduct__item__contents">
            <div class="allProduct__item__brand overflow-hidden">
                <a href="<?php echo e(route('frontend.vendors.single', $vendor->username)); ?>">
                    <?php echo render_image($vendor->logo); ?>

                </a>
            </div>
            <h4 class="allProduct__item__title mt-2">
                <a href="<?php echo e(route('frontend.vendors.single', $vendor->username)); ?>">
                    <?php echo e($vendor->business_name); ?>

                </a>
            </h4>
            <?php if($vendor->vendor_product_rating_count > 0): ?>
                <div class="product__card__review radius-5 mt-2">
                    <span class="product__card__review__icon"><i class="las la-star"></i></span>
                    <span class="product__card__review__rating"><?php echo e(toFixed($vendor->vendor_product_rating_avg_rating,1)); ?></span>
                    <span class="product__card__review__times">(<?php echo e($vendor->vendor_product_rating_count); ?>)</span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Vendor\Resources/views/components/style-one.blade.php ENDPATH**/ ?>