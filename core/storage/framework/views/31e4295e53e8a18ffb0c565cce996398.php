<?php $__env->startSection('site-title', __('Chat module')); ?>

<?php $__env->startSection('style'); ?>
    <?php if(moduleExists('Chat')): ?>
        <?php echo $__env->make("chat::components.frontend-css", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/vendor-chat.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('section'); ?>
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
                                <?php $__currentLoopData = $user_chat_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if (isset($component)) { $__componentOriginal18aee51324c35f42b69aaa3bc96ab601 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18aee51324c35f42b69aaa3bc96ab601 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'chat::components.user.user-list','data' => ['userChat' => $user_chat]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('chat::user.user-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user-chat' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user_chat)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18aee51324c35f42b69aaa3bc96ab601)): ?>
<?php $attributes = $__attributesOriginal18aee51324c35f42b69aaa3bc96ab601; ?>
<?php unset($__attributesOriginal18aee51324c35f42b69aaa3bc96ab601); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18aee51324c35f42b69aaa3bc96ab601)): ?>
<?php $component = $__componentOriginal18aee51324c35f42b69aaa3bc96ab601; ?>
<?php unset($__componentOriginal18aee51324c35f42b69aaa3bc96ab601); ?>
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
    <?php if (isset($component)) { $__componentOriginaldb17ce5be12fe17ce7c13b1f8732ce6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb17ce5be12fe17ce7c13b1f8732ce6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'chat::components.user.user-chat-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('chat::user.user-chat-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldb17ce5be12fe17ce7c13b1f8732ce6a)): ?>
<?php $attributes = $__attributesOriginaldb17ce5be12fe17ce7c13b1f8732ce6a; ?>
<?php unset($__attributesOriginaldb17ce5be12fe17ce7c13b1f8732ce6a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldb17ce5be12fe17ce7c13b1f8732ce6a)): ?>
<?php $component = $__componentOriginaldb17ce5be12fe17ce7c13b1f8732ce6a; ?>
<?php unset($__componentOriginaldb17ce5be12fe17ce7c13b1f8732ce6a); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Chat\Resources/views/user/index.blade.php ENDPATH**/ ?>