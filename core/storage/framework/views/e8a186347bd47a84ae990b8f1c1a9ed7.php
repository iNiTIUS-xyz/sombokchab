<div class="row mt-4">
    <?php $__empty_1 = true; $__currentLoopData = $all_products["items"] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-xl-3 col-lg-4 col-sm-6 mt-4">
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
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-md-12">
            <div class="w-50 m-auto padding-top-100 padding-bottom-100">
                <?php if (isset($component)) { $__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.page.empty','data' => ['image' => get_static_option('empty_cart_image'),'text' => get_static_option('empty_cart_text') ?? __('No products in your cart!')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.page.empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('empty_cart_image')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('empty_cart_text') ?? __('No products in your cart!'))]); ?>
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
            <h3 class="text-warning text-center">
                <?php echo e(__("No product found")); ?>

            </h3>
        </div>
    <?php endif; ?>
</div><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/frontend/search/grid.blade.php ENDPATH**/ ?>