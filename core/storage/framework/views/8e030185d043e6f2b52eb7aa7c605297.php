<?php
    if (!isset($product)) {
        $product = null;
    }
?>

<div class="general-info-wrapper dashboard__card">
    <div class="dashboard__card__header">
        <h4 class="dashboard__card__title"> <?php echo e(__('General Information')); ?> </h4>
    </div>
    <div class="dashboard__card__body custom__form general-info-form">
        <form action="#">
            <div class="row g-3 mt-2">
                <div class="col-sm-12">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2"> <?php echo e(__('Name')); ?> </label>
                        <input type="text" class="form--control radius-10" id="product-name"
                            value="<?php echo e($product?->name ?? ''); ?>" name="name"
                            placeholder="<?php echo e(__('Write product Name...')); ?>">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2"> <?php echo e(__('Slug')); ?> </label>
                        <input type="text" class="form--control radius-10" id="product-slug"
                            value="<?php echo e($product?->slug ?? ''); ?>" name="slug"
                            placeholder="<?php echo e(__('Write product slug...')); ?>">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2"> <?php echo e(__('Short Description')); ?> </label>
                        <textarea style="height: 120px" class="form--control form--message  radius-10" name="summery"
                            placeholder="<?php echo e(__('Write Short Description')); ?>"><?php echo e($product?->summary ?? ''); ?></textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2"> <?php echo e(__('Description')); ?> </label>
                        <textarea class="form--control summernote radius-10" name="description" placeholder="<?php echo e(__('Type Description')); ?>"><?php echo $product?->description; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2"> <?php echo e(__('Brand')); ?> </label>
                        <div class="nice-select-two">
                            <select name="brand" class="form-control" id="brand_id">
                                <option value=""><?php echo e(__('Select brand')); ?></option>
                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php echo e($item->id == $product?->brand_id ? 'selected' : ''); ?>

                                        value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/components/general-info.blade.php ENDPATH**/ ?>