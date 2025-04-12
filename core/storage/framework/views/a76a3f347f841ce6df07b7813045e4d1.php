<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d)): ?>
<?php $attributes = $__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d; ?>
<?php unset($__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d)): ?>
<?php $component = $__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d; ?>
<?php unset($__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d); ?>
<?php endif; ?>
    <style>
        .card img {
            height: 110px;
        }

        .font-size-14 {
            font-size: 14px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All vendors list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title"><?php echo e(__('All Vendors Order Profile')); ?></h3>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="table-wrap">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th><?php echo e(__('SL NO:')); ?></th>
                            <th style="width:80px"><?php echo e(__('Image')); ?></th>
                            <th><?php echo e(__('Info')); ?></th>
                            <th><?php echo e(__('Total Product')); ?></th>
                            <th><?php echo e(__('Total Orders')); ?></th>
                            <th><?php echo e(__('Pending Order')); ?></th>
                            <th><?php echo e(__('Complete Order')); ?></th>
                            <th><?php echo e(__('Total Earning')); ?></th>
                            <th><?php echo e(__('Action')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td>
                                    <div class="table-image"><?php echo render_image($vendor->logo); ?></div>
                                </td>
                                <td>
                                    <h6><?php echo e($vendor->business_name); ?></h6>
                                    <p class="font-size-14">
                                        <b><?php echo e(__('Vendor:')); ?> </b>
                                        <?php echo e($vendor->owner_name); ?> (<?php echo e($vendor->username); ?>)
                                    </p>
                                </td>
                                <td><?php echo e($vendor->product_count); ?></td>
                                <td><?php echo e($vendor->total_order); ?></td>
                                <td><?php echo e($vendor->pending_order); ?></td>
                                <td><?php echo e($vendor->complete_order); ?></td>
                                <td><b><?php echo e(float_amount_with_currency_symbol($vendor->total_earning)); ?></b></td>
                                <td>
                                    <a href="<?php echo e(route('frontend.vendors.single', $vendor->username)); ?>"
                                        class="btn btn-sm btn-info">
                                        <?php echo e(__('Visit Store')); ?>

                                    </a>
                                    <a href="<?php echo e(route('admin.orders.vendor.order', $vendor->username)); ?>"
                                        class="btn btn-sm btn-primary">
                                        <?php echo e(__('See Orders')); ?>

                                    </a>
                                    <a href="<?php echo e(route('admin.orders.vendor.order', $vendor->username)); ?>"
                                        class="btn btn-sm btn-secondary">
                                        <?php echo e(__('Vendor info')); ?>

                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Order\Resources/views/admin/vendors.blade.php ENDPATH**/ ?>