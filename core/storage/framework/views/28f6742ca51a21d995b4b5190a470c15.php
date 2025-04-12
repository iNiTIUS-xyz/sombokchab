<?php
    $disableForm = $disableForm ?? false;
    $orderTracks = \Modules\Order\Services\OrderServices::orderTrackArray();
    $orderTrackIcons = ['', '', '', '', ''];

    $orderTrack = $order->orderTrack->pluck('name')->toArray();
?>

<div class="dashboard__card">
    <div class="dashboard__card__header">
        <h4 class="dashboard__card__title"><?php echo e(__('Update order track status')); ?></h4>
    </div>
    <div class="dashboard__card__body mt-4">
        <?php if($disableForm === false): ?>
            <form method="post" action="<?php echo e(route('admin.orders.update.order-track')); ?>" class="">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" value="<?php echo e($order->id); ?>" name="order_id">
        <?php endif; ?>


        <div class="d-flex flex-wrap flex-xl-nowrap gap-3 justify-content-center">
            <?php $__currentLoopData = $orderTracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(in_array('assigned_delivery_man', $orderTrack) && $track == 'picked_by_courier'): ?>
                    <div class="form-group text-center">
                        <label
                            for="<?php echo e('assigned_delivery_man'); ?>"><?php echo e(ucwords(str_replace(['-', '_'], ' ', 'assigned_delivery_man'))); ?></label>
                        <?php if(!$disableForm): ?>
                            <input <?php echo e('checked disabled'); ?> class="order-track-input" id="<?php echo e('assigned_delivery_man'); ?>"
                                value="<?php echo e('assigned_delivery_man'); ?>" type="checkbox" name="order_track[]" />
                        <?php endif; ?>
                    </div>

                    <?php continue; ?>
                <?php endif; ?>

                <div class="form-group text-center">
                    <label for="<?php echo e($track); ?>"><?php echo e(ucwords(str_replace(['-', '_'], ' ', $track))); ?></label>
                    <?php if(!$disableForm): ?>
                        <input <?php echo e(in_array($track, $orderTrack) ? 'checked disabled' : ''); ?> class="order-track-input"
                            id="<?php echo e($track); ?>" value="<?php echo e($track); ?>" type="checkbox"
                            name="order_track[]" />
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="track-wrapper">
            <div class="track">
            <?php $__currentLoopData = $orderTracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(in_array('assigned_delivery_man', $orderTrack) && $track == 'picked_by_courier'): ?>
                    <div class="step active"> <span class="icon"> <i class="las la-check"></i> </span> <small
                            class="text"><?php echo e(ucwords(str_replace(['-', '_'], ' ', 'assigned_delivery_man'))); ?></small>
                    </div>
                    <?php continue; ?>
                <?php endif; ?>

                <div class="step <?php echo e(in_array($track, $orderTrack) ? 'active' : ''); ?>"> <span class="icon"> <i
                            class="las la-check"></i> </span> <small
                        class="text"><?php echo e(ucwords(str_replace(['-', '_'], ' ', $track))); ?></small> </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        </div>
        <?php if($disableForm === false): ?>
            <div class="form-group">
                <button <?php echo e($orderTracks == $orderTrack ? 'disabled' : ''); ?>

                    class="cmn_btn btn_bg_profile "><?php echo e(__('Update')); ?></button>
            </div>
            </form>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Order\Resources/views/components/order-track.blade.php ENDPATH**/ ?>