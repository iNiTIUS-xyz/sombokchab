<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('User Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('section'); ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="user-dashboard-card style-01 ">
                <div class="icon"><i class="las la-calendar-alt"></i></div>
                <div class="content">
                    <h4 class="title"><?php echo e(__('Total Orders')); ?></h4>
                    <span class="number"><?php echo e($product_count); ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="user-dashboard-card style-01 ">
                <div class="icon"><i class="las la-calendar-alt"></i></div>
                <div class="content">
                    <h4 class="title"><?php echo e(__('Support Tickets')); ?></h4>
                    <span class="number"><?php echo e($support_ticket_count); ?></span>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <?php if (isset($component)) { $__componentOriginal3fdcf7d392c0d5628bcd3384351686c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3fdcf7d392c0d5628bcd3384351686c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-orders-table','data' => ['allOrders' => $all_orders]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('user-orders-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allOrders' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_orders)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3fdcf7d392c0d5628bcd3384351686c7)): ?>
<?php $attributes = $__attributesOriginal3fdcf7d392c0d5628bcd3384351686c7; ?>
<?php unset($__attributesOriginal3fdcf7d392c0d5628bcd3384351686c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3fdcf7d392c0d5628bcd3384351686c7)): ?>
<?php $component = $__componentOriginal3fdcf7d392c0d5628bcd3384351686c7; ?>
<?php unset($__componentOriginal3fdcf7d392c0d5628bcd3384351686c7); ?>
<?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.bodyUser_overlay', function() {
                $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
            });
            $(document).on('click', '.mobile_nav', function() {
                $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/user/dashboard/user-home.blade.php ENDPATH**/ ?>