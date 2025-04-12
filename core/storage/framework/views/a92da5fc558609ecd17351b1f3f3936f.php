<?php
    if (!isset($selectedDeliveryOption)) {
        $selectedDeliveryOption = [];
    }
?>

<div class="general-info-wrapper dashboard__card">
    <div class="dashboard__card__header">
        <h4 class="dashboard__card__title"> <?php echo e(__('Delivery Options')); ?> </h4>
    </div>
    <div class="general-info-form dashboard__card__body">
        <div class="row g-3 mt-2">
            <div class="col-sm-12">
                <div class="d-flex flex-wrap gap-3 justify-content-start">
                    <input type="hidden" value="<?php echo e(implode(' , ', $selectedDeliveryOption)); ?>" name="delivery_option"
                        class="delivery-option-input" />

                    <?php $__currentLoopData = $deliveryOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deliveryOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="delivery-item d-flex <?php echo e(in_array($deliveryOption->id, $selectedDeliveryOption) ? 'active' : ''); ?>"
                            data-delivery-option-id="<?php echo e($deliveryOption->id); ?>">
                            <div class="icon">
                                <i class="<?php echo e($deliveryOption->icon); ?>"></i>
                            </div>
                            <div class="content">
                                <h6 class="title"><?php echo e($deliveryOption->title); ?></h6>
                                <p><?php echo e($deliveryOption->sub_title); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Product\Resources/views/components/delivery-option.blade.php ENDPATH**/ ?>