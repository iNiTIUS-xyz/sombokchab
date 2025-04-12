

<?php if(session()->has('msg')): ?>
    <div class="alert alert-<?php echo e(session('type')); ?> alert-dismissible fade show" role="alert">
        <?php echo session('msg'); ?>

        <button type="button" class="close btn-sm btn-warning text-danger" data-bs-dismiss="alert">
            X
        </button>
    </div>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/components/msg/flash.blade.php ENDPATH**/ ?>