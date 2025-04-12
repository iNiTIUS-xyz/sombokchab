<?php if(session()->has('stock_error')): ?>
    <?php $__currentLoopData = session('stock_error'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-danger">
            <?php echo $item["msg"]; ?>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/components/msg/stock_error.blade.php ENDPATH**/ ?>