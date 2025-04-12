<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Product Delivery Manage')); ?>

<?php $__env->stopSection(); ?>
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
    <?php if (isset($component)) { $__componentOriginal3321b247a065dca630ecc06232f9782c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3321b247a065dca630ecc06232f9782c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bulk-action.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3321b247a065dca630ecc06232f9782c)): ?>
<?php $attributes = $__attributesOriginal3321b247a065dca630ecc06232f9782c; ?>
<?php unset($__attributesOriginal3321b247a065dca630ecc06232f9782c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3321b247a065dca630ecc06232f9782c)): ?>
<?php $component = $__componentOriginal3321b247a065dca630ecc06232f9782c; ?>
<?php unset($__componentOriginal3321b247a065dca630ecc06232f9782c); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12">
        <div class="row g-4">
            <div class="col-lg-8">
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
                        <h4 class="dashboard__card__title"><?php echo e(__('All Delivery Manages')); ?></h4>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-delivery-manage-delete')): ?>
                            <?php if (isset($component)) { $__componentOriginal66c712c34c984896b01ed8a6324aa4c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66c712c34c984896b01ed8a6324aa4c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.dropdown','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bulk-action.dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal66c712c34c984896b01ed8a6324aa4c2)): ?>
<?php $attributes = $__attributesOriginal66c712c34c984896b01ed8a6324aa4c2; ?>
<?php unset($__attributesOriginal66c712c34c984896b01ed8a6324aa4c2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal66c712c34c984896b01ed8a6324aa4c2)): ?>
<?php $component = $__componentOriginal66c712c34c984896b01ed8a6324aa4c2; ?>
<?php unset($__componentOriginal66c712c34c984896b01ed8a6324aa4c2); ?>
<?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                    <th><?php echo e(__('ID')); ?></th>
                                    <th><?php echo e(__('Icon')); ?></th>
                                    <th><?php echo e(__('Title')); ?></th>
                                    <th><?php echo e(__('Sub Title')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $delivery_manages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td>
                                                <?php if (isset($component)) { $__componentOriginal113d24c6bffdee3ee68577114f8cf5c9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal113d24c6bffdee3ee68577114f8cf5c9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.preview-icon','data' => ['class' => $item->icon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backend.preview-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->icon)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal113d24c6bffdee3ee68577114f8cf5c9)): ?>
<?php $attributes = $__attributesOriginal113d24c6bffdee3ee68577114f8cf5c9; ?>
<?php unset($__attributesOriginal113d24c6bffdee3ee68577114f8cf5c9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal113d24c6bffdee3ee68577114f8cf5c9)): ?>
<?php $component = $__componentOriginal113d24c6bffdee3ee68577114f8cf5c9; ?>
<?php unset($__componentOriginal113d24c6bffdee3ee68577114f8cf5c9); ?>
<?php endif; ?>
                                            </td>
                                            <td><?php echo e($item->title); ?></td>
                                            <td><?php echo e($item->sub_title); ?></td>
                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-delivery_manage-delete')): ?>
                                                    <?php if (isset($component)) { $__componentOriginalbda4b33cac0b283685fc5d69625c1b03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbda4b33cac0b283685fc5d69625c1b03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.btn.swal.delete','data' => ['route' => route('admin.delivery.option.delete', $item->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table.btn.swal.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.delivery.option.delete', $item->id))]); ?>
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
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-delivery_manage-edit')): ?>
                                                    <a href="#1" data-bs-toggle="modal"
                                                        data-bs-target="#delivery_manage_edit_modal"
                                                        class="btn btn-primary btn-sm btn-xs mb-2 me-1 delivery_manage_edit_btn"
                                                        data-id="<?php echo e($item->id); ?>" data-title="<?php echo e($item->title); ?>"
                                                        data-sub-title="<?php echo e($item->sub_title); ?>"
                                                        data-icon="<?php echo e($item->icon); ?>">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-delivery_manage-create')): ?>
                <div class="col-lg-4">
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__title"><?php echo e(__('Add New Delivery Manage')); ?></h4>
                        </div>
                        <div class="dashboard__card__body custom__form mt-4">
                            <form action="<?php echo e(route('admin.delivery.option.store')); ?>" method="post"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="name"><?php echo e(__('Title')); ?></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="<?php echo e(__('Title')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name"><?php echo e(__('Sub Title')); ?></label>
                                    <input type="text" class="form-control" id="sub_title" name="sub_title"
                                        placeholder="<?php echo e(__('Sub Title')); ?>">
                                </div>
                                <div class="form-group">
                                    
                                    
                                    <?php if (isset($component)) { $__componentOriginal3b86294c7bb86dff49299fa05b25231f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b86294c7bb86dff49299fa05b25231f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.icon-picker','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backend.icon-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b86294c7bb86dff49299fa05b25231f)): ?>
<?php $attributes = $__attributesOriginal3b86294c7bb86dff49299fa05b25231f; ?>
<?php unset($__attributesOriginal3b86294c7bb86dff49299fa05b25231f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b86294c7bb86dff49299fa05b25231f)): ?>
<?php $component = $__componentOriginal3b86294c7bb86dff49299fa05b25231f; ?>
<?php unset($__componentOriginal3b86294c7bb86dff49299fa05b25231f); ?>
<?php endif; ?>
                                </div>
                                <div class="btn-wrapper mt-4">
                                    <button type="submit" class="cmn_btn btn_bg_profile"><?php echo e(__('Add New')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-delivery_manage-edit')): ?>
        <div class="modal fade" id="delivery_manage_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Update Delivery Manage')); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="<?php echo e(route('admin.delivery.option.update')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" id="delivery_manage_id">
                        <div class="modal-body">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Title')); ?></label>
                                <input type="text" class="form-control" id="edit-title" name="title"
                                    placeholder="<?php echo e(__('Title')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Name')); ?></label>
                                <input type="text" class="form-control" id="edit-sub-title" name="sub_title"
                                    placeholder="<?php echo e(__('Sub Title')); ?>">
                            </div>
                            <?php if (isset($component)) { $__componentOriginal3b86294c7bb86dff49299fa05b25231f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b86294c7bb86dff49299fa05b25231f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.icon-picker','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backend.icon-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b86294c7bb86dff49299fa05b25231f)): ?>
<?php $attributes = $__attributesOriginal3b86294c7bb86dff49299fa05b25231f; ?>
<?php unset($__attributesOriginal3b86294c7bb86dff49299fa05b25231f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b86294c7bb86dff49299fa05b25231f)): ?>
<?php $component = $__componentOriginal3b86294c7bb86dff49299fa05b25231f; ?>
<?php unset($__componentOriginal3b86294c7bb86dff49299fa05b25231f); ?>
<?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save Change')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginal579359c93efc143f4744524389ba1039 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal579359c93efc143f4744524389ba1039 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal579359c93efc143f4744524389ba1039)): ?>
<?php $attributes = $__attributesOriginal579359c93efc143f4744524389ba1039; ?>
<?php unset($__attributesOriginal579359c93efc143f4744524389ba1039); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal579359c93efc143f4744524389ba1039)): ?>
<?php $component = $__componentOriginal579359c93efc143f4744524389ba1039; ?>
<?php unset($__componentOriginal579359c93efc143f4744524389ba1039); ?>
<?php endif; ?>
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
    <?php if (isset($component)) { $__componentOriginal540660149c6f6c7aee4b9c2a93ee3bf0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal540660149c6f6c7aee4b9c2a93ee3bf0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.backend.icon-picker-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backend.icon-picker-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal540660149c6f6c7aee4b9c2a93ee3bf0)): ?>
<?php $attributes = $__attributesOriginal540660149c6f6c7aee4b9c2a93ee3bf0; ?>
<?php unset($__attributesOriginal540660149c6f6c7aee4b9c2a93ee3bf0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal540660149c6f6c7aee4b9c2a93ee3bf0)): ?>
<?php $component = $__componentOriginal540660149c6f6c7aee4b9c2a93ee3bf0; ?>
<?php unset($__componentOriginal540660149c6f6c7aee4b9c2a93ee3bf0); ?>
<?php endif; ?>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.delivery_manage_edit_btn', function() {
                let el = $(this);
                let id = el.data('id');
                let title = el.data('title');
                let sub_title = el.data('sub-title');
                let modal = $('#delivery_manage_edit_modal');

                modal.find('#delivery_manage_id').val(id);
                modal.find('#edit-title').val(title);
                modal.find('#edit-sub-title').val(sub_title);
                // modal.find('#edit-icon').val(icon);
                modal.find('.icp-dd').attr('data-selected', el.data('icon'));
                modal.find('.iconpicker-component i').attr('class', el.data('icon'));

                modal.show();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Attributes\Resources/views/backend/delivery-option/index.blade.php ENDPATH**/ ?>