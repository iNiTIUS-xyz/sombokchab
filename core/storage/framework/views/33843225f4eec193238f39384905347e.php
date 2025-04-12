<?php
    if (!isset($tag)) {
        $tag = null;
        $tag_name = '';
    } else {
        $tag_name_arr = $tag->pluck('tag_name')?->toArray();
        $tag_name = implode(',', $tag_name_arr ?? []);
    }
    
    if (!isset($singlebadge)) {
        $singlebadge = null;
    }
?>

<div class="general-info-wrapper dashboard__card">
    <div class="dashboard__card__header">
        <h4 class="dashboard__card__title"> <?php echo e(__('Product Tags and Badge')); ?> </h4>
    </div>
    <div class="dashboard__card__body custom__form">
        <div class="row g-3 mt-2">
            <div class="col-sm-12">
                <div class="dashboard-input">
                    <label class="dashboard-label"> <?php echo e(__('Tags')); ?> </label>
                    <input type="text" name="tags" class="form-control tags_input radius-10" data-role="tagsinput"
                        value="<?php echo e($tag_name); ?>">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="dashboard-input">
                    <label class="dashboard-label"> <?php echo e(__('Labels')); ?> </label>
                    <div class="d-flex flex-wrap gap-2 justify-content-start">
                        <input type="hidden" name="badge_id" value="<?php echo e($singlebadge); ?>" id="badge_id_input" />
                        <?php $__currentLoopData = $badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="badge-item d-flex <?php echo e($badge->id === $singlebadge ? 'active' : ''); ?>"
                                data-badge-id="<?php echo e($badge->id); ?>">
                                <div class="icon">
                                    <?php echo App\Http\Services\Media::render_image($badge->badgeImage, size: 'thumb'); ?>

                                </div>
                                <div class="content">
                                    <h6 class="title"><?php echo e($badge->name); ?></h6>
                                    <span
                                        class="badge badge-<?php echo e($badge->type ? 'success bg-success' : 'warning bg-warning'); ?>"><?php echo e($badge->type ? __('Permanent') : __('Temporary')); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Product\Resources/views/components/tags-and-badge.blade.php ENDPATH**/ ?>