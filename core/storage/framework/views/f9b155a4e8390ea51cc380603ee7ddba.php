<!-- Popular Porduct Starts -->
<section class="popularProduct__area padding-top-20 padding-bottom-20 ">
    <div class="container container_1608">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-left section_borderBottom">
                    <h2 class="title"><?php echo e($section_title ?? ''); ?></h2>
                    <div class="btn_wrapper">
                        <a href="<?php echo e(route('frontend.products.all')); ?>" class="viewAll_btn">
                            <?php echo e(__('View All')); ?> <i class="las la-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gy-5 mt-1">
            <?php $__currentLoopData = $all_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
<!-- Popular Porduct end -->
<?php /**PATH C:\xampp\htdocs\sombokchab\core\app\Providers/../PageBuilder/views/product/popular_product_two.blade.php ENDPATH**/ ?>