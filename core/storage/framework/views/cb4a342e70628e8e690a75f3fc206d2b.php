<div class="dashboard__card">
    <div class="dashboard__card__header">
        <h4 class="dashboard__card__title"><?php echo e(__('Campaign Product')); ?></h4>
        <?php if(isset($remove_btn)): ?>
            <span class="cross-btn"><i class="las la-times-circle"></i></span>
        <?php endif; ?>
    </div>
    <div class="dashboard__card__body custom__form mt-4">
        <div class="form-group select_product">
            <label for="product_id"><?php echo e(__('Select Product')); ?></label>
            <select name="product_id[]" id="product_id" class="form-control wide repeater_product_id">
                <option><?php echo e(__('Select Product')); ?></option>
                <?php $__currentLoopData = $all_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->id); ?>" data-price="<?php echo e($product->price); ?>"
                        data-sale_price="<?php echo e($product->sale_price); ?>"
                        data-stock="<?php echo e(optional($product->inventory)->stock_count ?? 0); ?>">
                        <?php echo e($product->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="original_price"><?php echo e(__('Original Price')); ?></label>
            <input type="number" class="form-control original_price product_original_price" disabled>
        </div>
        <div class="form-group">
            <label for="campaign_price"><?php echo e(__('Price for Campaign')); ?></label>
            <input type="number" name="campaign_price[]" class="form-control campaign_price" step="0.01">
        </div>
        <div class="form-group">
            <label for="available_num_of_units"><?php echo e(__('No. of Units Available')); ?></label>
            <input type="number" class="form-control available_num_of_units" disabled>
        </div>
        <div class="form-group">
            <label for="units_for_sale"><?php echo e(__('No. of Units for Sale')); ?></label>
            <input type="number" name="units_for_sale[]" class="form-control units_for_sale">
        </div>
        <div class="form-group">
            <label for="start_date"><?php echo e(__('Start Date')); ?></label>
            <input type="text" name="start_date[]" class="form-control flatpickr start_date">
        </div>
        <div class="form-group">
            <label for="end_date"><?php echo e(__('End Date')); ?></label>
            <input type="text" name="end_date[]" id="end_date" class="form-control flatpickr end_date">
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Campaign\Resources/views/backend/add_new_campaign_product.blade.php ENDPATH**/ ?>