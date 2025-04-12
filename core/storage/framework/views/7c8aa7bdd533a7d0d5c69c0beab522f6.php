<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Product Inventory')); ?>

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
        <div class="row">
            <div class="col-lg-12">
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
                        <h4 class="dashboard__card__title"><?php echo e(__('Product Inventory')); ?></h4>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-inventory-delete')): ?>
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
                                    <th><?php echo e(__('ID')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('SKU')); ?></th>
                                    <th><?php echo e(__('Stock')); ?></th>
                                    <th><?php echo e(__('Sold')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $all_inventory_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php if (isset($component)) { $__componentOriginald14b2686e56f8beccefd58f04b9cb87f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald14b2686e56f8beccefd58f04b9cb87f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.td','data' => ['id' => $inventory->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bulk-action.td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($inventory->id)]); ?>
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
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($inventory?->product?->name); ?></td>
                                            <td><?php echo e($inventory->sku); ?></td>
                                            <td><?php echo e($inventory->stock_count ?? 0); ?></td>
                                            <td><?php echo e($inventory->sold_count ?? 0); ?></td>
                                            <td>
                                                
                                                <?php if (isset($component)) { $__componentOriginalbda4b33cac0b283685fc5d69625c1b03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbda4b33cac0b283685fc5d69625c1b03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.btn.swal.delete','data' => ['route' => route('vendor.products.inventory.delete', $inventory->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table.btn.swal.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('vendor.products.inventory.delete', $inventory->id))]); ?>
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
                                                
                                                
                                                <?php if (isset($component)) { $__componentOriginalca17f499cceba420fca78673c4527cc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalca17f499cceba420fca78673c4527cc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.btn.edit','data' => ['route' => route('vendor.products.inventory.edit', $inventory->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table.btn.edit'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('vendor.products.inventory.edit', $inventory->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalca17f499cceba420fca78673c4527cc3)): ?>
<?php $attributes = $__attributesOriginalca17f499cceba420fca78673c4527cc3; ?>
<?php unset($__attributesOriginalca17f499cceba420fca78673c4527cc3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalca17f499cceba420fca78673c4527cc3)): ?>
<?php $component = $__componentOriginalca17f499cceba420fca78673c4527cc3; ?>
<?php unset($__componentOriginalca17f499cceba420fca78673c4527cc3); ?>
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
    </div>
    
    <?php if (isset($component)) { $__componentOriginal8ddcbd826c2f6b7eb96d55f7a3dc18b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ddcbd826c2f6b7eb96d55f7a3dc18b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.js','data' => ['route' => route('admin.products.inventory.bulk.action')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bulk-action.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.products.inventory.bulk.action'))]); ?>
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
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.vendor-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Inventory\Resources/views/vendor/all.blade.php ENDPATH**/ ?>