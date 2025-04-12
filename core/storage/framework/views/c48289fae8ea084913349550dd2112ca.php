<?php
    if (!isset($selectedcat)) {
        $selectedcat = null;
    }
    
    if (!isset($selectedSubCat)) {
        $selectedSubCat = null;
    }
    
    if (!isset($selectedcat)) {
        $selectedcat = null;
    }
    
    $categories = !isset($categories) ? [] : $categories;
    $sub_categories = !isset($subCategories) ? [] : $subCategories;
    $child_categories = !isset($childCategories) ? [] : $childCategories;
?>

<div class="dashboard-attr-add-wrapper">
    <div class="dashboard-input mt-4">
        <label class="dashboard-label color-light mb-2"><?php echo e(__('Category')); ?></label>
        <div class="nice-select-two">
            <select name="category_id" id="category" class="form-control">
                <option value=""><?php echo e(__('Select Category')); ?></option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e($selectedcat === $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="dashboard-input mt-4">
        <label class="dashboard-label color-light mb-2"><?php echo e(__('Sub Category')); ?></label>
        <div class="nice-select-two">
            <select class="form-control" name="sub_category" id="sub_category">
                <option value=""><?php echo e(__('Select Sub Category')); ?></option>
                <?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->id); ?>" <?php echo e($item->id == $selectedSubCat ? 'selected' : ''); ?>>
                        <?php echo e($item->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="dashboard-input mt-4">
        <label class="dashboard-label color-light mb-2"><?php echo e(__('Child Category')); ?> </label>
        <div class="nice-select-two">
            <select name="child_category[]" multiple id="child_category" class="form-control">
                <option value=""><?php echo e(__('Select Child Category')); ?></option>
                <?php $__currentLoopData = $child_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->id); ?>"
                        <?php echo e(in_array($item->id, $selectedChildCat) ? 'selected' : ''); ?>><?php echo e($item->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Product\Resources/views/components/categories.blade.php ENDPATH**/ ?>