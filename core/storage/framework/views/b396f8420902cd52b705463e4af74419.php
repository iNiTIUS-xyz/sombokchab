<?php
    if (!isset($inventory)) {
        $inventory = null;
    }

    if (!isset($uom)) {
        $uom = null;
    }
?>
<div class="dashboard__card">
    <div class="dashboard__card__header">
        <h4 class="dashboard__card__title"><?php echo e(__('Product Inventory')); ?></h4>
    </div>
    <div class="dashboard__card__body custom__form mt-4">
        <?php if(isset($inventoryPage)): ?>
            <div class="row">
        <?php endif; ?>
        <div class="<?php if(isset($inventoryPage)): ?> col-md-4 <?php else: ?> dashboard-input <?php endif; ?>">
            <label class="dashboard-label"> <?php echo e(__('Sku')); ?> </label>
            <input type="text" class="form--control radius-10 form-control" name="sku" value="<?php echo e($inventory?->sku); ?>" required>
            <small class="mt-2 mb-0 d-block"><?php echo e(__('Custom Unique Code for this product.')); ?></small>
        </div>

        <div class="<?php if(isset($inventoryPage)): ?> col-md-4 <?php else: ?> dashboard-input <?php endif; ?>">
            <label class="dashboard-label"> <?php echo e(__('Quantity')); ?> </label>
            <input type="tel" class="form--control radius-10" name="quantity"
                value="<?php echo e($inventory?->stock_count); ?>">
            <small
                class="mt-2 mb-0 d-block"><?php echo e(__('This will be replaced with the sum of inventory items. if any inventory  item is registered..')); ?>

            </small>
        </div>

        <div class="<?php if(isset($inventoryPage)): ?> col-md-2 <?php else: ?> dashboard-input <?php endif; ?>">
            <label class="dashboard-label"> <?php echo e(__('Unit')); ?> </label>

            <div class="nice-select-two">
                <select class="select2 form-control" name="unit_id" required>
                    <option value=""><?php echo e(__('Select Unit')); ?></option>
                    <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e($unit->id === $uom?->unit_id ? 'selected' : ''); ?> value="<?php echo e($unit->id); ?>">
                            <?php echo e($unit->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <small class="mt-2 mb-0 d-block"><?php echo e(__('Select Unit')); ?></small>
            </div>
        </div>

        <div class="<?php if(isset($inventoryPage)): ?> col-md-2 <?php else: ?> dashboard-input <?php endif; ?>">
            <label class="dashboard-label"> <?php echo e(__('Unit Of Measurement')); ?> </label>
            <input type="number" name="uom" class="form--control radius-10" value="<?php echo e($uom?->quantity); ?>"
                placeholder="<?php echo e(__('Enter Unit Of Measurement')); ?>">
            <small class="mt-2 mb-0 d-block"><?php echo e(__('Enter the number here')); ?></small>
        </div>
        <?php if(isset($inventoryPage)): ?>
    </div>
    <?php endif; ?>
</div>
</div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Product\Resources/views/components/product-inventory.blade.php ENDPATH**/ ?>