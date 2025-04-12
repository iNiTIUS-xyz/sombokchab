<?php $__env->startSection('site-title', __('Chat module')); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/vendor-chat.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard__body">
        <div class="dashboard__inner">
            <div class="chat_wrapper">
                <div class="chat_wrapper__flex">
                    <div class="chat_sidebar d-lg-none">
                        <i class="las la-bars"></i>
                    </div>
                    <div class="chat_wrapper__contact radius-10">
                        <div class="chat_wrapper__contact__close">
                            <div class="close_chat d-lg-none"> <i class="las la-times"></i> </div>
                            <ul class="chat_wrapper__contact__list">
                                <?php $__currentLoopData = $vendor_chat_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor_chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if (isset($component)) { $__componentOriginal3b520b273c559620832c455978c6940b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b520b273c559620832c455978c6940b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'chat::components.vendor.user-list','data' => ['vendorchat' => $vendor_chat]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('chat::vendor.user-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['vendorchat' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($vendor_chat)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b520b273c559620832c455978c6940b)): ?>
<?php $attributes = $__attributesOriginal3b520b273c559620832c455978c6940b; ?>
<?php unset($__attributesOriginal3b520b273c559620832c455978c6940b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b520b273c559620832c455978c6940b)): ?>
<?php $component = $__componentOriginal3b520b273c559620832c455978c6940b; ?>
<?php unset($__componentOriginal3b520b273c559620832c455978c6940b); ?>
<?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                    <div class="chat_wrapper__details radius-10">
                        <div class="chat_wrapper__details__header d-none" id="chat_header">

                        </div>

                        <div class="chat_wrapper__details__inner vendor-chat-body" id="chat_body">
                        </div>

                        <div class="chat_wrapper__details__footer profile-border-top d-none" id="vendor-message-footer">
                            <div class="chat_wrapper__details__footer__form custom-form">
                                <form action="#">
                                    <div class="single-input">
                                        <textarea name="message" class="form--control form-message" id="message" placeholder="<?php echo e(__('Write your message')); ?>"></textarea>
                                    </div>
                                </form>
                                <div class="hat-wrapper-details-footer-btn btn_flex justify-content-end mt-2">
                                    <label class="dropMedia dashboard_table__title__btn btn-outline-border radius-5"
                                        for="message-file">
                                        <input type="file" class="dropMedia__uploader" id="message-file">
                                        <span class="dropMedia__file" id="uploadImage"><i class="fa-solid fa-paperclip"></i>
                                            <?php echo e(__('Attach Files')); ?></span>
                                    </label>
                                    <a href="#1" class="dashboard_table__title__btn btn_bg_profile radius-5"
                                        id="vendor-send-message-to-user"><?php echo e(__('Send Message')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        let users_list = {
            <?php echo e($arr); ?>

        };
    </script>
    <?php if (isset($component)) { $__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'chat::components.livechat-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('chat::livechat-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac)): ?>
<?php $attributes = $__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac; ?>
<?php unset($__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac)): ?>
<?php $component = $__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac; ?>
<?php unset($__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal40dcf1f01f84fa71dc8bb31113ae2e1f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40dcf1f01f84fa71dc8bb31113ae2e1f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'chat::components.vendor.vendor-chat-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('chat::vendor.vendor-chat-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40dcf1f01f84fa71dc8bb31113ae2e1f)): ?>
<?php $attributes = $__attributesOriginal40dcf1f01f84fa71dc8bb31113ae2e1f; ?>
<?php unset($__attributesOriginal40dcf1f01f84fa71dc8bb31113ae2e1f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40dcf1f01f84fa71dc8bb31113ae2e1f)): ?>
<?php $component = $__componentOriginal40dcf1f01f84fa71dc8bb31113ae2e1f; ?>
<?php unset($__componentOriginal40dcf1f01f84fa71dc8bb31113ae2e1f); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.vendor-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Chat\Resources/views/vendor/index.blade.php ENDPATH**/ ?>