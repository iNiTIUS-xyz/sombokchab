<!-- Trending Porduct Starts -->
<section class="trendingProduct__area padding-top-20 padding-bottom-20">
    <div class="container container_1608">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-left section_borderBottom">
                    <h2 class="title"><?php echo e($section_title ?? ""); ?></h2>
                    <div class="allProduct__tab">
                        <ul class="tabs">
                            <li data-card-style="2" data-item-limit="12" id="product_filter_featured_products" data-tab="featured_product" class="tabs_list"><?php echo e(__("Featured")); ?></li>
                            <li data-card-style="2" data-item-limit="12" id="product_filter_top_selling" data-tab="top_selling_product" class="tabs_list"><?php echo e(__("Top Selling")); ?></li>
                            <li data-card-style="2" data-item-limit="12" id="product_filter_new_products" data-tab="weekly_top_product" class="tabs_list"><?php echo e(__("Weekly Top")); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gy-5 mt-1" id="product_filter_section">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginal926af592f72658f362beb15f3c871af6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal926af592f72658f362beb15f3c871af6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.grid-style-05','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.grid-style-05'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal926af592f72658f362beb15f3c871af6)): ?>
<?php $attributes = $__attributesOriginal926af592f72658f362beb15f3c871af6; ?>
<?php unset($__attributesOriginal926af592f72658f362beb15f3c871af6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal926af592f72658f362beb15f3c871af6)): ?>
<?php $component = $__componentOriginal926af592f72658f362beb15f3c871af6; ?>
<?php unset($__componentOriginal926af592f72658f362beb15f3c871af6); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<!-- Trending Porduct end --><?php /**PATH C:\wamp64\www\sombokchab\core\app\Providers/../PageBuilder/views/product/product_filter_two.blade.php ENDPATH**/ ?>