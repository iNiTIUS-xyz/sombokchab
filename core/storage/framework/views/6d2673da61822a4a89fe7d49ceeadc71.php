<?php
if (!isset($product)) {
    $product = null;
}

$taxClasses = $taxClasses ?? [];
?>

<div class="general-info-wrapper dashboard__card">
    <div class="dashboard__card__header">
        <h4 class="dashboard__card__title"> <?php echo e(__('Price Manage')); ?> </h4>
    </div>
    <div class="general-info-form dashboard__card__body custom__form">
        <div class="row g-3 mt-2">
            <div class="col-sm-12">
                <div class="dashboard-input">
                    <label class="dashboard-label color-light mb-2"> <?php echo e(__('Base Cost')); ?> </label>
                    <input type="text" class="form--control radius-10" value="<?php echo e($product?->cost); ?>" name="cost"
                        placeholder="<?php echo e(__('Base Cost...')); ?>">
                    <p><?php echo e(__('Purchase price of this product.')); ?></p>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="dashboard-input">
                    <label class="dashboard-label color-light mb-2"> <?php echo e(__('Regular Price')); ?> </label>
                    <input type="text" class="form--control radius-10" value="<?php echo e($product?->price); ?>" name="price"
                        placeholder="<?php echo e(__('Enter Regular Price...')); ?>">
                    <small><?php echo e(__('This price will display like this')); ?> <del>( <?php echo e(site_currency_symbol()); ?>

                            10)</del></small>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="dashboard-input">
                    <label class="dashboard-label color-light mb-2"> <?php echo e(__('Sale Price')); ?> </label>
                    <input type="text" class="form--control radius-10" value="<?php echo e($product?->sale_price); ?>"
                        name="sale_price" placeholder="<?php echo e(__('Enter Sale Price...')); ?>">
                    <small><?php echo e(__('This will be your product selling price')); ?></small>
                </div>
            </div>

            <?php if(get_static_option('tax_system') == 'advance_tax_system'): ?>
                <div class="col-sm-6">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2"> <?php echo e(__('Is Taxable')); ?> </label>
                        <select class="form--control radius-10" name="is_taxable">
                            <option value=""><?php echo e(__('Select is taxable')); ?></option>
                            <option <?php echo e($product?->is_taxable == 1 ? 'selected' : ''); ?> value="1">
                                <?php echo e(__('Taxable')); ?></option>
                            <option <?php echo e($product?->is_taxable == 0 ? 'selected' : ''); ?> value="0">
                                <?php echo e(__('Non-Taxable')); ?></option>
                        </select>
                        <small><?php echo e(__('If you designate your product as taxable, it implies that applicable taxes will be levied on the product.')); ?></small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2"> <?php echo e(__('Tax class')); ?> </label>

                        <select class="form--control radius-10" name="tax_class_id">
                            <option value=""><?php echo e(__('Select a tax class for this product')); ?></option>
                            <?php $__currentLoopData = $taxClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e($product?->tax_class_id == $tax_class->id ? 'selected' : ''); ?>

                                    value="<?php echo e($tax_class->id); ?>"><?php echo e($tax_class->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <small><?php echo e(__('If you select taxable then you need to select tax class')); ?></small>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/components/product-price.blade.php ENDPATH**/ ?>