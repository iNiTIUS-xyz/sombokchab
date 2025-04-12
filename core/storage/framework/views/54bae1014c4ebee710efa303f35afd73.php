<?php
    $messages = $data->messages;
    $user_image = render_image($data->user->profile_image, defaultImage: true);
    $vendor_image = render_image($data->vendor->logo, defaultImage: true);
?>

<?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if (isset($component)) { $__componentOriginalbf8dc5622ed787c79e8fa46927872ee8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbf8dc5622ed787c79e8fa46927872ee8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'chat::components.user-message','data' => ['message' => $message,'userimage' => $user_image,'vendorimage' => $vendor_image]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('chat::user-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($message),'userimage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user_image),'vendorimage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($vendor_image)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbf8dc5622ed787c79e8fa46927872ee8)): ?>
<?php $attributes = $__attributesOriginalbf8dc5622ed787c79e8fa46927872ee8; ?>
<?php unset($__attributesOriginalbf8dc5622ed787c79e8fa46927872ee8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbf8dc5622ed787c79e8fa46927872ee8)): ?>
<?php $component = $__componentOriginalbf8dc5622ed787c79e8fa46927872ee8; ?>
<?php unset($__componentOriginalbf8dc5622ed787c79e8fa46927872ee8); ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Chat\Resources/views/messages.blade.php ENDPATH**/ ?>