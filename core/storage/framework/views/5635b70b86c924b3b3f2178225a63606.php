<?php
    $attributes = $product?->inventory_detail_count ?? null;
    $campaign_product = $product->campaign_product ?? null;
    $campaignProductEndDate = $product->campaign->end_date ?? ($product->campaign->end_date->end_date ?? '');
    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
    $campaignSoldCount = $product?->campaign_sold_product;
    $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : optional($product->inventory)->stock_count;
    $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ?? 0 ? $stock_count : 0;
    $filter = $filter ?? false;
?>

<div class="col-xxl-2 col-xl-3 col-md-4 col-sm-6">
    <div class="product__card my-3">
        <?php if($campaign_percentage): ?>
            <div class="product__offer">
                <span class="product__offer__para"><?php echo e(round($campaign_percentage)); ?>% <?php echo e(__('Off')); ?></span>
            </div>
        <?php endif; ?>
        <div class="product__card__thumb">

            <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>">
                <?php echo render_image($product->image); ?>

            </a>
            <?php if($product->ratings_count > 0): ?>
                <div class="product__card__review radius-5">
                    <span class="product__card__review__icon"><i class="las la-star"></i></span>
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
            <?php endif; ?>
        </div>
        <div class="product__card__contents mt-3">

            <h6 class="product__card__contents__title mt-2">
                <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>">
                    <?php echo e($product->name); ?>

                </a>
            </h6>
            <div class="product__price mt-2">
                <span
                    class="product__price__current color-two"><?php echo e(float_amount_with_currency_symbol(calculatePrice($sale_price, $product))); ?></span>
                <s
                    class="product__price__old"><?php echo e($deleted_price ? float_amount_with_currency_symbol(calculatePrice($deleted_price, $product)) : ''); ?></s>
            </div>
            <div class="product__card__cart mt-3">
                <?php if(isset($attributes) && $attributes > 0): ?>
                    <a data-type="text" data-old-text="<?php echo e(__('View Details')); ?>" data-action-route="<?php echo e(route('frontend.products.single-quick-view', $product->slug)); ?>"
                        data-attributes="<?php echo e($product->attributes); ?>" data-id="<?php echo e($product->id); ?>"
                        class="product__card__cart__btn radius-30 product-quick-view-ajax <?php echo e($class ?? ''); ?>">
                        <?php echo e(__('View Details')); ?>

                    </a>
                <?php else: ?>
                    <a data-type="text" data-old-text="<?php echo e(__('Add to Cart')); ?>" href="#1" data-attributes="<?php echo e($product->attribute); ?>" data-id="<?php echo e($product->id); ?>"
                        class="product__card__cart__outline radius-30 add_to_cart_ajax <?php echo e($class ?? ''); ?>">
                        <?php echo e(__('Add to Cart')); ?>

                    </a>
                <?php endif; ?>

                <div class="product__card__cart__right">
                    <a href="javascript:void(0)" data-id="<?php echo e($product->id); ?>"
                        class="<?php echo e($class ?? ''); ?> product__card__cart__btn__icon cart-loading icon add_to_compare_ajax">
                        <i class="las la-retweet"></i>
                    </a>

                    <?php if(isset($attributes) && $attributes > 0): ?>
                        <a class="<?php echo e($class ?? ''); ?> product-quick-view-ajax favourite icon cart-loading product__card__cart__btn__icon"
                            href="#1"
                            data-action-route="<?php echo e(route('frontend.products.single-quick-view', $product->slug)); ?>">
                            <i class="lar la-heart"></i>
                        </a>
                    <?php else: ?>
                        <a href="#1" data-id="<?php echo e($product->id); ?>"
                            class="<?php echo e($class ?? ''); ?> add_to_wishlist_ajax icon cart-loading product__card__cart__btn__icon">
                            <i class="lar la-heart"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Product\Resources/views/components/frontend/grid-style-05.blade.php ENDPATH**/ ?>