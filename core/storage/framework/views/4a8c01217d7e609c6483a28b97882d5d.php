<?php $__env->startSection('section'); ?>
    <?php if($all_shipping_address && $all_shipping_address->count()): ?>
        <div class="dashboard__card__shipping">
            <div class="dashboard__card__header">
                <h4 class="dashboard__card__title"><?php echo e(__('My Shipping Address')); ?></h4>
                <div class="btn-wrapper">
                    <a href="<?php echo e(route('user.shipping.address.new')); ?>"
                        class="cmn_btn btn_bg_2"><?php echo e(__('Add Shipping Address')); ?></a>
                </div>
            </div>
            <div class="dashboard__card__body mt-4">
                <div class="table-responsive table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Address')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $all_shipping_address; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($address->name); ?></td>
                                    <td><?php echo e($address->address); ?></td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="<?php echo e(route('user.shipping.address.edit', $address->id)); ?>" class="btn btn-sm btn-warning btn-xs mb-2 me-1">
                                            <i class="las la-edit"></i>
                                        </a>
                                    
                                        <!-- Delete Button -->
                                        <?php if (isset($component)) { $__componentOriginalbda4b33cac0b283685fc5d69625c1b03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbda4b33cac0b283685fc5d69625c1b03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.btn.swal.delete','data' => ['route' => route('shipping.address.delete', $address->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table.btn.swal.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('shipping.address.delete', $address->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbda4b33cac0b283685fc5d69625c1b03)): ?>
<?php $attributes = $__attributesOriginalbda4b33cac0b283685fc5d69625c1b03; ?>
<?php unset($__attributesOriginalbda4b33cac0b283685fc5d69625c1b03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbda4b33cac0b283685fc5d69625c1b03)): ?>
<?php $component = $__componentOriginalbda4b33cac0b283685fc5d69625c1b03; ?>
<?php unset($__componentOriginalbda4b33cac0b283685fc5d69625c1b03); ?>
<?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <?php echo $all_shipping_address->links(); ?>

                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            <?php echo e(__('No Shipping Address Found. ')); ?>

            <a class="btn btn-link" href="<?php echo e(route('user.shipping.address.new')); ?>"><?php echo e(__('Create New?')); ?></a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <?php if (isset($component)) { $__componentOriginal00998a08d228f09b1bf9dc38aef52d23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal00998a08d228f09b1bf9dc38aef52d23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.btn.swal.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table.btn.swal.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal00998a08d228f09b1bf9dc38aef52d23)): ?>
<?php $attributes = $__attributesOriginal00998a08d228f09b1bf9dc38aef52d23; ?>
<?php unset($__attributesOriginal00998a08d228f09b1bf9dc38aef52d23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal00998a08d228f09b1bf9dc38aef52d23)): ?>
<?php $component = $__componentOriginal00998a08d228f09b1bf9dc38aef52d23; ?>
<?php unset($__componentOriginal00998a08d228f09b1bf9dc38aef52d23); ?>
<?php endif; ?>

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

<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/user/dashboard/shipping/all.blade.php ENDPATH**/ ?>