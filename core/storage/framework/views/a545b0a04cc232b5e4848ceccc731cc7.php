<?php
    $oldimage = isset($oldimage) ? $oldimage : null;
    $imageId = $oldimage?->id ?? ($oldimage ?? null);
    $required = isset($required) ? $required : null;
?>

<?php if((($multiple ?? null) != true) ?? true): ?>
    <div class="form-group" id="<?php echo e($name); ?>">
        <label for="<?php echo e($name); ?>"><?php echo e(__($title)); ?></label>
        <?php $signature_image_upload_btn_label = __('Upload Image'); ?>
        <div class="media-upload-btn-wrapper">
            <div class="img-wrap">
                <?php if(isset($oldimage) && !empty($oldimage)): ?>

                    <div class="upload-finish media-upload-btn-wrapper mt-4">
                        <div class="img-wrap row d-flex">
                            <div class="upload-thumb col-lg-12">
                                <?php echo render_image($oldimage); ?>


                                <span class="close-thumb" data-media-id="<?php echo e($imageId); ?>"> <i class="las la-times"></i> </span>
                            </div>
                        </div>
                    </div>

                    <?php $signature_image_upload_btn_label = __('Change Image'); ?>
                <?php endif; ?>
            </div>
            <br>
            <input type="hidden" <?php $required ?> name="<?php echo e($name); ?>" value="<?php echo e($imageId); ?>">
            <button type="button" class="btn btn-info media_upload_form_btn popup-modal"
                    data-btntitle="<?php echo e(__('Select Image')); ?>"
                    data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                    data-imgid="<?php echo e($imageId ?? ''); ?>"
                    data-bs-toggle="modal"
                    data-bs-target="#media_upload_modal">
                <?php echo e(__($signature_image_upload_btn_label)); ?>

            </button>
        </div>
        <small><?php echo e(__('Recommended image size is ')); ?> <?php echo e($dimentions ?? ''); ?></small>
        <?php if(isset($hint) && is_string($hint)): ?>
        <small class="text-secondary"> (<?php echo e($hint); ?>)</small>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if(isset($multiple) && $multiple): ?>
<div class="form-group ">
    <label for="image"><?php echo e(__($title)); ?></label>
    <div class="media-upload-btn-wrapper">
        <div class="img-wrap">
            <?php if(isset($galleryImages)): ?>
                <?php $gallery_images = json_decode($galleryImages, true); ?>
                <?php if($gallery_images && $gallery_images != 'null'): ?>
                    <?php $__currentLoopData = $gallery_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gl_img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $work_section_img = get_attachment_image_by_id($gl_img, null, true); ?>
                        <?php if(!empty($work_section_img)): ?>
                            <div class="attachment-preview">
                                <div class="thumbnail">
                                    <div class="centered">
                                        <img class="avatar user-thumb"
                                            src="<?php echo e($work_section_img['img_url']); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <input <?php $required ?> type="hidden" name="<?php echo e($name); ?>">
        <button type="button" class="btn btn-info media_upload_form_btn popup-modal"
                data-btntitle="<?php echo e(__('Select Image')); ?>"
                data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                data-bs-toggle="modal"
                data-mulitple="true"
                data-bs-target="#media_upload_modal">
            <?php echo e(__('Upload Image')); ?>

        </button>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/components/media-upload.blade.php ENDPATH**/ ?>