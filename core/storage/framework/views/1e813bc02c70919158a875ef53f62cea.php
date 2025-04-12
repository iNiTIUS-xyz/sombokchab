<?php if(session()->has('msg')): ?>
    <div class="alert alert-<?php echo e(session('type') ? session('type') : 'success'); ?> alert-dismissible fade show">
        <?php echo Purifier::clean(session('msg')); ?>

        <button type="button btn-sm" class="close" data-bs-dismiss="alert">X</button>
    </div>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/components/msg/success.blade.php ENDPATH**/ ?>