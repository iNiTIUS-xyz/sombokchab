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
    $campaign_percentage = round($campaign_percentage, 0);
?>

<div class="col-xxl-6 col-lg-12 mt-4 campaign-counter" data-date="<?php echo e($campaign_product->end_date->format("Y-m-d h:i:s")); ?>">
    <div class="shop-list-wrapper single-border">
        <div class="shop-wrapper-flex">
            <div class="signle-shop-list">
                <div class="shop-list-flex">
                    <div class="shop-thumbs">
                        <a href="<?php echo e(route("frontend.products.single",$product->slug)); ?>">
                            <?php echo render_image($product->image); ?>

                        </a>
                        <?php if($campaign_percentage > 0): ?>
                            <div class="thumb-top-contents">
                                <span class="percent-box bg-color-two radius-5"> -<?php echo e($campaign_percentage); ?>% </span>
                            </div>
                        <?php endif; ?>
                        <div class="campaign-countdown">
                            <div><span class="counter-days"></span></div>
                            <div><span class="counter-hours"></span></div>
                            <div><span class="counter-minutes"></span></div>
                            <div><span class="counter-seconds"></span></div>
                        </div>
                    </div>

                    <div class="shop-list-contents">
                        <h2 class="common-title"> <a href="<?php echo e(route("frontend.products.single", $product->slug)); ?>"><?php echo e($product->name); ?></a> </h2>

                        <div class="global-card-right">
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
                </div>
            </div>
            <div class="single-shop-cart center-text">
                <h2 class="price-title"> <?php echo e(float_amount_with_currency_symbol(calculatePrice($sale_price, $product))); ?> </h2>
                <div class="shop-cart-flex mt-3">
                    <div class="btn-wrapper">
                        <a href="#1" class="cmn-btn btn-bg-1  btn-small radius-0 cart-loading"> <?php echo e(__("Add to Cart")); ?> </a>
                    </div>
                </div>
                <div class="btn-shop-botttom mt-3">
                    <ul class="global-thumb-icons">
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
            </div>
        </div>
    </div>
</div><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/components/frontend/campaign-list-style-01.blade.php ENDPATH**/ ?>