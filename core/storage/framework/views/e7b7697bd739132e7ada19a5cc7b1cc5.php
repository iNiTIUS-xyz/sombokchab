<?php
    if (!isset($inventorydetails)) {
        $inventorydetails = [];
    }
?>
<div class="dashboard__card mt-4">
    <div class="dashboard__card__header">
        <div class="dashboard__card__header__left">
            <h5 class="dashboard__card__title"><?php echo e(__('Custom Inventory variant')); ?></h5>
            <p class="dashboard__card__para mt-3">
                <?php echo e(__('Inventory will be variant of this product.')); ?>

            </p>
            <p class="dashboard__card__para mt-1">
                <?php echo e(__('All inventory stock count will be merged and replace to main stock of this product.')); ?>

            </p>
            <p class="dashboard__card__para mt-1">
                <?php echo e(__('Stock count filed is required.')); ?>

            </p>
        </div>
    </div>
    <div class="dashboard__card__body mt-4">
        <div class="inventory_items_container">
            <?php $__empty_1 = true; $__currentLoopData = $inventorydetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if (isset($component)) { $__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.variant-info.repeater','data' => ['detail' => $detail,'isFirst' => false,'colors' => $colors,'sizes' => $sizes,'allAvailableAttributes' => $allAttributes,'key' => $key]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::variant-info.repeater'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['detail' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($detail),'is-first' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors),'sizes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes),'all-available-attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($allAttributes),'key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($key)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba)): ?>
<?php $attributes = $__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba; ?>
<?php unset($__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba)): ?>
<?php $component = $__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba; ?>
<?php unset($__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php if (isset($component)) { $__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.variant-info.repeater','data' => ['isFirst' => true,'colors' => $colors,'sizes' => $sizes,'allAvailableAttributes' => $allAttributes]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::variant-info.repeater'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['is-first' => true,'colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors),'sizes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes),'all-available-attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($allAttributes)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba)): ?>
<?php $attributes = $__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba; ?>
<?php unset($__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba)): ?>
<?php $component = $__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba; ?>
<?php unset($__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/components/product-attribute.blade.php ENDPATH**/ ?>