<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title', __('Refund Settings')); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalae73592a9186217aa45553528a0de34b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalae73592a9186217aa45553528a0de34b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalae73592a9186217aa45553528a0de34b)): ?>
<?php $attributes = $__attributesOriginalae73592a9186217aa45553528a0de34b; ?>
<?php unset($__attributesOriginalae73592a9186217aa45553528a0de34b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalae73592a9186217aa45553528a0de34b)): ?>
<?php $component = $__componentOriginalae73592a9186217aa45553528a0de34b; ?>
<?php unset($__componentOriginalae73592a9186217aa45553528a0de34b); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal54abcd52ec2e8ec857d4d6feae648c79 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.flash','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.flash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79)): ?>
<?php $attributes = $__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79; ?>
<?php unset($__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54abcd52ec2e8ec857d4d6feae648c79)): ?>
<?php $component = $__componentOriginal54abcd52ec2e8ec857d4d6feae648c79; ?>
<?php unset($__componentOriginal54abcd52ec2e8ec857d4d6feae648c79); ?>
<?php endif; ?>
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title"><?php echo e(__('Refund Settings')); ?></h3>
        </div>
        <div class="dashboard__card__body custom__form mt-4">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refund-settings-update')): ?>
                <form method="POST" action="<?php echo e(route('admin.refund.settings.update')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>
                <div class="form-group">
                    <label for="how-long" class="form-label"><?php echo e(__('How long customer will be eligible for refund')); ?></label>
                    <input type="number" id="how-long" class="form-control form-control-sm"
                        name="how_long_user_will_eligible_for_refund"
                        value="<?php echo e(get_static_option('how_long_user_will_eligible_for_refund')); ?>">
                </div>

                <div class="form-group">
                    <label for="courier_address" class="form-label"><?php echo e(__('Courier address')); ?></label>
                    <textarea type="number" name="courier_address" id="courier_address"><?php echo e(get_static_option('courier_address')); ?></textarea>
                </div>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refund-settings-update')): ?>
                    <div class="form-group">
                        <button class="cmn_btn btn_bg_profile"><?php echo e(__('Update settings')); ?></button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Refund\Resources/views/admin/settings/index.blade.php ENDPATH**/ ?>