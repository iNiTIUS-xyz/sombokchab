<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li data-value="<?php echo e($item->id); ?>" class="option"><?php echo e($item->name); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Vendor\Resources/views/backend/get_state/list.blade.php ENDPATH**/ ?>