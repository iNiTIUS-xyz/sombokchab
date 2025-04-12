<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Country')); ?>

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
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title"><?php echo e(__('All Countries')); ?></h4>
                        <div class="dashboard__card__header__right">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-bulk-action')): ?>
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
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-new')): ?>
                                <div class="btn-wrapper">
                                    <button class="cmn_btn btn_bg_profile" data-bs-toggle="modal"
                                        data-bs-target="#country_new_modal"><?php echo e(__('Add Country')); ?></button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-bulk-action')): ?>
                                        <?php if (isset($component)) { $__componentOriginal4d3af3b5bc4ed8a5305ff1314f7911e3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4d3af3b5bc4ed8a5305ff1314f7911e3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.th','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bulk-action.th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4d3af3b5bc4ed8a5305ff1314f7911e3)): ?>
<?php $attributes = $__attributesOriginal4d3af3b5bc4ed8a5305ff1314f7911e3; ?>
<?php unset($__attributesOriginal4d3af3b5bc4ed8a5305ff1314f7911e3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4d3af3b5bc4ed8a5305ff1314f7911e3)): ?>
<?php $component = $__componentOriginal4d3af3b5bc4ed8a5305ff1314f7911e3; ?>
<?php unset($__componentOriginal4d3af3b5bc4ed8a5305ff1314f7911e3); ?>
<?php endif; ?>
                                    <?php endif; ?>
                                    <th><?php echo e(__('ID')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $all_countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-bulk-action')): ?>
                                                <?php if (isset($component)) { $__componentOriginald14b2686e56f8beccefd58f04b9cb87f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald14b2686e56f8beccefd58f04b9cb87f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.td','data' => ['id' => $country->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bulk-action.td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($country->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald14b2686e56f8beccefd58f04b9cb87f)): ?>
<?php $attributes = $__attributesOriginald14b2686e56f8beccefd58f04b9cb87f; ?>
<?php unset($__attributesOriginald14b2686e56f8beccefd58f04b9cb87f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald14b2686e56f8beccefd58f04b9cb87f)): ?>
<?php $component = $__componentOriginald14b2686e56f8beccefd58f04b9cb87f; ?>
<?php unset($__componentOriginald14b2686e56f8beccefd58f04b9cb87f); ?>
<?php endif; ?>
                                            <?php endif; ?>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($country->name); ?></td>
                                            <td><?php if (isset($component)) { $__componentOriginal439bbb984835c787af382f4832e48744 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal439bbb984835c787af382f4832e48744 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-span','data' => ['status' => $country->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('status-span'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($country->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal439bbb984835c787af382f4832e48744)): ?>
<?php $attributes = $__attributesOriginal439bbb984835c787af382f4832e48744; ?>
<?php unset($__attributesOriginal439bbb984835c787af382f4832e48744); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal439bbb984835c787af382f4832e48744)): ?>
<?php $component = $__componentOriginal439bbb984835c787af382f4832e48744; ?>
<?php unset($__componentOriginal439bbb984835c787af382f4832e48744); ?>
<?php endif; ?></td>
                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-delete')): ?>
                                                    <?php if (isset($component)) { $__componentOriginalbda4b33cac0b283685fc5d69625c1b03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbda4b33cac0b283685fc5d69625c1b03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.btn.swal.delete','data' => ['route' => route('admin.country.delete', $country->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table.btn.swal.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.country.delete', $country->id))]); ?>
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
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-update')): ?>
                                                    <a href="#1" data-bs-toggle="modal"
                                                        data-bs-target="#country_edit_modal"
                                                        class="btn btn-primary btn-sm btn-xs mb-2 me-1 country_edit_btn"
                                                        data-id="<?php echo e($country->id); ?>" data-name="<?php echo e($country->name); ?>"
                                                        data-status="<?php echo e($country->status); ?>">
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
            
        </div>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-update')): ?>
        <div class="modal fade" id="country_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Update country')); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="<?php echo e(route('admin.country.update')); ?>" method="post">
                        <input type="hidden" name="id" id="country_id">
                        <div class="modal-body">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="edit_name"><?php echo e(__('Name')); ?></label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="<?php echo e(__('Name')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="edit_status"><?php echo e(__('Status')); ?></label>
                                <select name="status" class="form-control" id="edit_status">
                                    <option value="publish"><?php echo e(__('Publish')); ?></option>
                                    <option value="draft"><?php echo e(__('Draft')); ?></option>
                                </select>
                            </div>
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


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-new')): ?>
        <div class="modal fade" id="country_new_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Add new country')); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <div class="model-body p-4">
                        <form action="<?php echo e(route('admin.country.new')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Name')); ?></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="<?php echo e(__('Name')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="status"><?php echo e(__('Status')); ?></label>
                                <select name="status" class="form-control" id="status">
                                    <option value="publish"><?php echo e(__('Publish')); ?></option>
                                    <option value="draft"><?php echo e(__('Draft')); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="cmn_btn btn_bg_profile"><?php echo e(__('Add New')); ?></button>
                            </div>
                        </form>
                    </div>
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
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-bulk-action')): ?>
        <?php if (isset($component)) { $__componentOriginal8ddcbd826c2f6b7eb96d55f7a3dc18b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ddcbd826c2f6b7eb96d55f7a3dc18b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.js','data' => ['route' => route('admin.country.bulk.action')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bulk-action.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.country.bulk.action'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8ddcbd826c2f6b7eb96d55f7a3dc18b8)): ?>
<?php $attributes = $__attributesOriginal8ddcbd826c2f6b7eb96d55f7a3dc18b8; ?>
<?php unset($__attributesOriginal8ddcbd826c2f6b7eb96d55f7a3dc18b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8ddcbd826c2f6b7eb96d55f7a3dc18b8)): ?>
<?php $component = $__componentOriginal8ddcbd826c2f6b7eb96d55f7a3dc18b8; ?>
<?php unset($__componentOriginal8ddcbd826c2f6b7eb96d55f7a3dc18b8); ?>
<?php endif; ?>
    <?php endif; ?>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.country_edit_btn', function() {
                let el = $(this);
                let id = el.data('id');
                let name = el.data('name');
                let status = el.data('status');
                let modal = $('#country_edit_modal');

                modal.find('#country_id').val(id);
                modal.find('#edit_status option[value="' + status + '"]').attr('selected', true);
                modal.find('#edit_name').val(name);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/CountryManage\Resources/views/backend/all-country.blade.php ENDPATH**/ ?>