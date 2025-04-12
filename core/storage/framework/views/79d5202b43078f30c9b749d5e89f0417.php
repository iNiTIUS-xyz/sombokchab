<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('New Ticket')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginald6c22cd6617e2f6bf867d0caa6f43bfa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald6c22cd6617e2f6bf867d0caa6f43bfa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.niceselect.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('niceselect.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald6c22cd6617e2f6bf867d0caa6f43bfa)): ?>
<?php $attributes = $__attributesOriginald6c22cd6617e2f6bf867d0caa6f43bfa; ?>
<?php unset($__attributesOriginald6c22cd6617e2f6bf867d0caa6f43bfa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald6c22cd6617e2f6bf867d0caa6f43bfa)): ?>
<?php $component = $__componentOriginald6c22cd6617e2f6bf867d0caa6f43bfa; ?>
<?php unset($__componentOriginald6c22cd6617e2f6bf867d0caa6f43bfa); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-12">
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
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title"><?php echo e(__('New Ticket')); ?></h4>
                        <a href="<?php echo e(route('vendor.support.ticket.all')); ?>"
                            class="cmn_btn btn_bg_profile"><?php echo e(__('All Support Tickets')); ?></a>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="<?php echo e(route('vendor.support.ticket.new')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label><?php echo e(__('Title')); ?></label>
                                <input type="text" class="form-control" name="title" placeholder="<?php echo e(__('Title')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Subject')); ?></label>
                                <input type="text" class="form-control" name="subject" placeholder="<?php echo e(__('Subject')); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Priority')); ?></label>
                                <select name="priority" class="form-control">
                                    <option value="low"><?php echo e(__('Low')); ?></option>
                                    <option value="medium"><?php echo e(__('Medium')); ?></option>
                                    <option value="high"><?php echo e(__('High')); ?></option>
                                    <option value="urgent"><?php echo e(__('Urgent')); ?></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?php echo e(__('Departments')); ?></label>
                                <select name="departments" class="form-control">
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($dep->id); ?>"><?php echo e($dep->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?php echo e(__('Description')); ?></label>
                                <textarea name="description" class="form-control" cols="30" rows="10" placeholder="<?php echo e(__('Description')); ?>"></textarea>
                            </div>
                            <div class="form-group btn-wrapper">
                                <button type="submit" class="cmn_btn btn_bg_profile"><?php echo e(__('Submit Ticket')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginalfc21ac509768111c9db09ce0360a300e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfc21ac509768111c9db09ce0360a300e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.niceselect.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('niceselect.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfc21ac509768111c9db09ce0360a300e)): ?>
<?php $attributes = $__attributesOriginalfc21ac509768111c9db09ce0360a300e; ?>
<?php unset($__attributesOriginalfc21ac509768111c9db09ce0360a300e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfc21ac509768111c9db09ce0360a300e)): ?>
<?php $component = $__componentOriginalfc21ac509768111c9db09ce0360a300e; ?>
<?php unset($__componentOriginalfc21ac509768111c9db09ce0360a300e); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.vendor-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/SupportTicket\Resources/views/vendor/new-ticket.blade.php ENDPATH**/ ?>