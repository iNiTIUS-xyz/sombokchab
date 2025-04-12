<?php
    $campaign_product = $product->campaign_product ?? null;
    $campaignProductEndDate = $product->campaign->end_date ?? $product->campaign->end_date->end_date ?? '';
    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
    $campaignSoldCount = $product?->campaign_sold_product;
    $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : optional($product->inventory)->stock_count;
    $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ?? 0 ? $stock_count : 0;
    $rating_width = round(($product->ratings_avg_rating ?? 0) * 20);
?>

<div class="slick-slider-items wow fadeInUp" data-wow-delay=".<?php echo e($loop->iteration); ?>s">
    <div class="global-card-item vendor-global-card-item radius-10">
        <div class="global-card-thumb radius-10">
            <a href="#1">
                <?php echo render_image($product->image); ?>

            </a>

            <?php if($campaign_percentage > 0): ?>
                <div class="thumb-top-contents">
                    <span class="percent-box bg-color-two radius-5"> -<?php echo e($campaign_percentage); ?>% </span>
                </div>
            <?php endif; ?>

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
            <h4 class="common-title"> <a href="<?php echo e(route("frontend.products.single", $product->slug)); ?>"><?php echo e($product->name); ?></a> </h4>
            <div class="d-flex flex-wrap justify-content-between">
                <div class="stock mt-2">
                    <span class="stock-available <?php echo e($stock_count ? "text-success" : "text-danger"); ?>"> <?php echo e($stock_count ? "In Stock ($stock_count)" : "Out of stock"); ?> </span>
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
            <div class="price-update-through mt-2">
                <span class="fs-24 fw-500 flash-prices"> <?php echo e(float_amount_with_currency_symbol($sale_price)); ?> </span>
                <span class="fs-18 flash-old-prices"> <?php echo e(float_amount_with_currency_symbol($deleted_price)); ?> </span>
            </div>
            <div class="btn-wrapper mt-3">
                <?php if($product?->inventory_detail_count > 0): ?>
                    <a href="javacript:void(0)" data-action-route="<?php echo e(route('frontend.products.single-quick-view', $product->slug)); ?>" data-attributes="<?php echo e($product->attributes); ?>" data-id="<?php echo e($product->id); ?>" class="cmn-btn btn-outline-two color-two btn-small product-quick-view-ajax"><?php echo e(__("Buy Now")); ?></a>
                <?php else: ?>
                    <a href="javacript:void(0)" data-id="<?php echo e($product->id); ?>" class="cmn-btn btn-outline-two color-two btn-small add_to_buy_now_ajax"><?php echo e(__("Buy Now")); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Product\Resources/views/components/frontend/grid-style-04.blade.php ENDPATH**/ ?>