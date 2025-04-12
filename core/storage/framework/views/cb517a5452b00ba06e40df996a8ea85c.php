<?php if($status === 'draft'): ?>
    <span class="alert alert-sm alert-warning" ><?php echo e(__('Draft')); ?></span>
<?php elseif($status === 'archive'): ?>
    <span class="alert alert-sm alert-warning" ><?php echo e(__('Archive')); ?></span>
<?php elseif($status === 'pending'): ?>
    <span class="alert alert-sm alert-warning" ><?php echo e(__('Pending')); ?></span>
<?php elseif($status === 'Active'): ?>
    <span class="alert alert-sm alert-success" ><?php echo e(__('Active')); ?></span>
<?php elseif($status === 'In-Active' || $status === 'Inactive'): ?>
    <span class="alert alert-sm alert-danger" ><?php echo e(__('In Active')); ?></span>
<?php elseif($status === 'complete' || $status === 'completed'): ?>
    <span class="alert alert-sm alert-success" ><?php echo e(__('Complete')); ?></span>
<?php elseif($status === 'close'): ?>
    <span class="alert alert-sm alert-danger" ><?php echo e(__('Close')); ?></span>
<?php elseif($status === 'in_progress' || $status === 'processing'): ?>
    <span class="alert alert-sm alert-info" ><?php echo e(__('In Progress')); ?></span>
<?php elseif($status === 'publish'): ?>
    <span class="alert alert-sm alert-success" ><?php echo e(__('Publish')); ?></span>
<?php elseif($status === 'approved'): ?>
    <span class="alert alert-sm alert-success" ><?php echo e(__('Approved')); ?></span>
<?php elseif($status === 'confirm'): ?>
    <span class="alert alert-sm alert-success" ><?php echo e(__('Confirm')); ?></span>
<?php elseif($status === 'yes'): ?>
    <span class="alert alert-sm alert-success" ><?php echo e(__('Yes')); ?></span>
<?php elseif($status === 'no'): ?>
    <span class="alert alert-sm alert-danger" ><?php echo e(__('No')); ?></span>
<?php elseif($status === 'cancel' || $status === 'cancelled'): ?>
    <span class="alert alert-sm alert-danger" ><?php echo e(__('Cancel')); ?></span>
<?php elseif($status === 'failed'): ?>
    <span class="alert alert-sm alert-danger" ><?php echo e(__('Failed')); ?></span>
<?php elseif($status === 'refunded'): ?>
    <span class="alert alert-sm alert-warning" ><?php echo e(__('Refunded')); ?></span>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/components/status-span.blade.php ENDPATH**/ ?>