<?php
    if (isset($permissions) && !auth('admin')->user()->can($permissions)){
        return;
    }
?>


<div class="bulk-delete-wrapper d-flex mt-3">
    <select name="bulk_option" id="bulk_option" >
        <option value=""><?php echo e(__('Bulk Action')); ?></option>
        <option value="delete"><?php echo e(__('Delete')); ?></option>
    </select>

    <button class="btn btn-primary " id="bulk_delete_btn"><?php echo e(__('Apply')); ?></button>
</div><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/components/table/bulk-action.blade.php ENDPATH**/ ?>