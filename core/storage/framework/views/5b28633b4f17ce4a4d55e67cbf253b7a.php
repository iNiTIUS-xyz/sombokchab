<?php
    if (!isset($product)) {
        $product = null;
    }
?>

<div class="general-info-wrapper dashboard__card">
    <div class="dashboard__card__header">
        <h4 class="dashboard__card__title"> <?php echo e(__('Product Settings')); ?> </h4>
    </div>
    <div class="dashboard__card__body custom__form">
        <div class="row g-3 mt-2">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="min_purchase"><?php echo e(__('Minimum quantity of Purchase')); ?></label>
                    <input id="min_purchase" name="min_purchase" class="form--control"
                        value="<?php echo e($product?->min_purchase); ?>" placeholder="<?php echo e(__('Minimum quantity of purchase')); ?>">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="max_purchase"><?php echo e(__('Maximum quantity of Purchase')); ?></label>
                    <input id="max_purchase" name="max_purchase" class="form--control"
                        value="<?php echo e($product?->max_purchase); ?>" placeholder="<?php echo e(__('Maximum quantity of Purchase')); ?>">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="vendor-coupon-switch d-flex align-items-center mt-3">
                    <label for="coupon-switch4"><?php echo e(__('Refundable')); ?></label>
                    <input name="is_refundable" class="custom-switch" type="checkbox" id="coupon-switch4"
                        <?php echo e($product?->is_refundable ? 'checked' : ''); ?> />
                    <label class="switch-label" for="coupon-switch4"><?php echo e(__('Create')); ?></label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="vendor-coupon-switch d-flex align-items-center">
                    <label for="coupon-switch5"><?php echo e(__('Inventory Warning')); ?></label>
                    <input name="is_inventory_warning" class="custom-switch" type="checkbox" id="coupon-switch5"
                        <?php echo e($product?->is_inventory_warn_able ? 'checked' : ''); ?> />
                    <label class="switch-label" for="coupon-switch5"></label>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Product\Resources/views/components/settings.blade.php ENDPATH**/ ?>