<?php
    $type = $type ?? '';
?>

<?php if($type == ''): ?>
    <a tabindex="0" class="btn btn-sm btn-danger btn-xs mb-2 me-1 swal_delete_button">
        <i class="ti-trash"></i>
    </a>
<?php else: ?>
    <a class="dropdown-item swal_delete_button"><i class="ti-trash"></i> <?php echo e(__('Delete')); ?> </a>
<?php endif; ?>


<form method='post' action='<?php echo e($url); ?>' class="d-none">
    <?php if($type != ''): ?>
        <?php echo method_field('DELETE'); ?>
        <?php echo csrf_field(); ?>
    <?php endif; ?>

    <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
    <br>
    <button type="submit" class="swal_form_submit_btn btn-sm d-none"></button>
</form>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/components/delete-popover.blade.php ENDPATH**/ ?>