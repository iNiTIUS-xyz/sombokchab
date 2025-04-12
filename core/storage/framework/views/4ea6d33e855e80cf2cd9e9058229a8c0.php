<?php if($products->count() < 1): ?>
    <h2 class="title text-center w-100 py-5"><?php echo e(__("No Product Found")); ?></h2>
<?php endif; ?>
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(((int) request()->card_style) === 2): ?>
        <?php if (isset($component)) { $__componentOriginal926af592f72658f362beb15f3c871af6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal926af592f72658f362beb15f3c871af6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.grid-style-05','data' => ['product' => $item]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.grid-style-05'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item)]); ?>
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
    <?php else: ?>
        <div class="single-grid">
            <?php if (isset($component)) { $__componentOriginalab1383846b573106e566b5155989c0e0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalab1383846b573106e566b5155989c0e0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.product.product-card-03','data' => ['product' => $item,'isAjax' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.product.product-card-03'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item),'isAjax' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalab1383846b573106e566b5155989c0e0)): ?>
<?php $attributes = $__attributesOriginalab1383846b573106e566b5155989c0e0; ?>
<?php unset($__attributesOriginalab1383846b573106e566b5155989c0e0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalab1383846b573106e566b5155989c0e0)): ?>
<?php $component = $__componentOriginalab1383846b573106e566b5155989c0e0; ?>
<?php unset($__componentOriginalab1383846b573106e566b5155989c0e0); ?>
<?php endif; ?>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/partials/filter-item.blade.php ENDPATH**/ ?>