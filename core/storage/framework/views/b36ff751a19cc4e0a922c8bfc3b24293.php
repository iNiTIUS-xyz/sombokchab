<?php
    $id = $id ?? null;
    $oldImage = $oldImage ?? null;
    $galleryImage = $galleryImage ?? null;
?>

<?php if(isset($multiple) && $multiple): ?>
    <div class="dashboard__card mediaUploads__card">
        <div class="dashboard__card__header">
            <h4 class="dashboard__card__title">
                <?php echo e($title); ?>

                <small class="text-info"><?php echo e(__('Image size should be 1080 X 1080')); ?></small>
            </h4>
        </div>
        <div class="dashboard__card__body profile-photo-upload">
            <div class="profile-photo-change bg-white mt-4">
                <div class="upload-finish media-upload-btn-wrapper mt-4">
                    <div class="img-wrap row d-flex">
                        <?php if(isset($galleryImage)): ?>
                            <?php if($galleryImage && $galleryImage != 'null'): ?>
                                <?php $__currentLoopData = $galleryImage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gl_img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="upload-thumb col-xxl-2">
                                        <?php echo !empty($gl_img) ? render_image($gl_img) : $signature_image_tag; ?>

                                        <span class="close-thumb" data-media-id="<?php echo e($gl_img->id); ?>"> <i
                                                class="las la-times"></i> </span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
                    $galleryIds = $galleryImage?->pluck('id')?->toArray() ?? [];
                ?>
                <input type="hidden" name="<?php echo e($name); ?>" value="<?php echo e(implode('|', $galleryIds)); ?>">
                <button type="button" data-mulitple="true" class="photo-upload  media_upload_form_btn popup-modal"
                    data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                    data-imgid="<?php echo e($id ?? ''); ?>">
                    <span class="upload-icon"> <i class="las la-cloud-upload-alt"></i> </span>
                    <h5 class="dashboard-common-title">
                        <?php echo e(__('Click Files to this area to upload')); ?>

                    </h5>
                    <span class="upload-para mt-2"> <?php echo e(__('Dimension of the logo image should be 600 x 600px')); ?>

                    </span>
                </button>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="dashboard__card mediaUploads__card">
        <div class="dashboard__card__header">
            <h4 class="dashboard__card__title">
                <?php echo e($title); ?>

                <small class="text-info">(<?php echo e(__('Image size should be 1080 X 1080')); ?>)</small>
            </h4>
        </div>
        <div class="dashboard__card__body profile-photo-upload">
            <div class="profile-photo-change bg-white mt-4">
                <div class="upload-finish media-upload-btn-wrapper mt-4">
                    <div class="img-wrap row d-flex">
                        <?php if(!empty($oldImage)): ?>
                            <div class="upload-thumb col-xxl-2">
                                <?php echo !empty($oldImage) ? render_image($oldImage) : $signature_image_tag; ?>

                                <span class="close-thumb" data-media-id="<?php echo e($oldImage->id); ?>"> <i
                                        class="las la-times"></i> </span>
                            </div>
                            <?php $signature_image_upload_btn_label = __('Change Image'); ?>
                        <?php endif; ?>
                    </div>
                </div>

                <input type="hidden" name="<?php echo e($name); ?>" value="<?php echo e($oldImage?->id); ?>">
                <button type="button" class="photo-upload  media_upload_form_btn popup-modal"
                    data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                    data-imgid="<?php echo e($id ?? ''); ?>">
                    <span class="upload-icon">
                        <i class="las la-cloud-upload-alt"></i>
                    </span>
                    <h5 class="dashboard-common-title">
                        <?php echo e(__('Click Files to this area to upload')); ?>

                    </h5>
                    <span class="upload-para mt-2">
                        <?php echo e(__('Dimension of the logo image should be 600 x 600px')); ?>

                    </span>
                </button>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/components/media/media-upload.blade.php ENDPATH**/ ?>