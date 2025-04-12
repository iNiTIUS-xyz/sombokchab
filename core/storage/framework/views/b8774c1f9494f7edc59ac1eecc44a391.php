<?php $__currentLoopData = $deliveryMans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deliveryMan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if (isset($component)) { $__componentOriginal7ec633fb229f86fa0a9709c981a2add4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7ec633fb229f86fa0a9709c981a2add4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'deliveryman::components.delivery-man','data' => ['deliveryMan' => $deliveryMan]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('deliveryman::delivery-man'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['deliveryMan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($deliveryMan)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7ec633fb229f86fa0a9709c981a2add4)): ?>
<?php $attributes = $__attributesOriginal7ec633fb229f86fa0a9709c981a2add4; ?>
<?php unset($__attributesOriginal7ec633fb229f86fa0a9709c981a2add4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7ec633fb229f86fa0a9709c981a2add4)): ?>
<?php $component = $__componentOriginal7ec633fb229f86fa0a9709c981a2add4; ?>
<?php unset($__componentOriginal7ec633fb229f86fa0a9709c981a2add4); ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/DeliveryMan\Resources/views/admin/assign-delivery-man/delivery-man-result.blade.php ENDPATH**/ ?>