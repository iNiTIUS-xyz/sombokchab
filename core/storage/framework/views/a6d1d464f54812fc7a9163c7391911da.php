<li> <?php echo e(__("Selected Filter:")); ?> </li>
<?php $__currentLoopData = request()->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!empty($value) && $key !== '_token'): ?>
        <?php if(!empty($value) && $key !== 'page'): ?>
            <li> <a class="click-hide close-search-selected-item" data-key="<?php echo e($key); ?>" href="javascript:void(0)"> <?php echo e($value); ?> </a> </li>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<li> <a class="click-hide-parent clear-search" href="javascript:void(0)"> <?php echo e(__("Clear All")); ?> </a> </li><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/frontend/search/selected-search-item.blade.php ENDPATH**/ ?>