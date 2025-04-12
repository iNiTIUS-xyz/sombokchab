<div class="contact-us-area-wrapper padding-top-100 padding-bottom-50">
    <div class="container">
        <div class="row g-4 gx-5">
            <div class="col-md-5 col-lg-4">
                <div class="address-wrapper">
                    <div class="title-section">
                        <h4 class="title"><?php echo e($title); ?></h4>
                    </div>
                    <ul class="address-list">
                        <?php $__currentLoopData = $settings['contact_page_contact_info_01']['title_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="single-address-item">
                                <div class="icon-box">
                                    <i
                                        class="<?php echo e($settings['contact_page_contact_info_01']['icon_'][$loop->index]); ?> icon"></i>
                                </div>
                                <div class="content">
                                    <h5 class="title"><?php echo e($title); ?></h5>
                                    <p class="info">
                                        <?php echo e($settings['contact_page_contact_info_01']['description_'][$loop->index]); ?>

                                    </p>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-7 col-lg-8">
                <div class="get-in-touch-wrapper">
                    <h3 class="title"><?php echo e($form_title); ?></h3>

                    <div class="w-100">
                        <?php if(session('msg') !== null && session('type') !== null): ?>
                            <div class="alert alert-<?php echo e(session('type')); ?>"><?php echo e(session('msg')); ?></div>
                        <?php endif; ?>
                    </div>

                    <?php if(!empty($custom_form_id)): ?>
                        <?php $form_details = App\FormBuilder::find($custom_form_id); ?>
                        <?php echo App\Helpers\FormBuilderCustom::render_form(optional($form_details)->id, null, null, 'btn-default'); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\sombokchab\core\app\Providers/../PageBuilder/views/contact/contact_area_style_one.blade.php ENDPATH**/ ?>