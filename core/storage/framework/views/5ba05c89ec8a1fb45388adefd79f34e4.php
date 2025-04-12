<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Trashed Products')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginal716d70be21e3c614b1cf25988150bc54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal716d70be21e3c614b1cf25988150bc54 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.variant-info.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::variant-info.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal716d70be21e3c614b1cf25988150bc54)): ?>
<?php $attributes = $__attributesOriginal716d70be21e3c614b1cf25988150bc54; ?>
<?php unset($__attributesOriginal716d70be21e3c614b1cf25988150bc54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal716d70be21e3c614b1cf25988150bc54)): ?>
<?php $component = $__componentOriginal716d70be21e3c614b1cf25988150bc54; ?>
<?php unset($__componentOriginal716d70be21e3c614b1cf25988150bc54); ?>
<?php endif; ?>
    <style>
        .float-left {
            float: left;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
        $allProduct = '';
            if (!$products->isEmpty())
                {
                    if (count($products) > 1)
                        {
                            $allProduct = $products->pluck('id')->toArray();
                            $allProduct = implode('|',$allProduct);
                        } else {
                            $allProduct = current(current($products))->id;
                        }
                }
    ?>

    <div class="dashboard-recent-order">
        <div class="row">
            <?php if (isset($component)) { $__componentOriginalef2154c4b1054a3a28aacfea8e05a555 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalef2154c4b1054a3a28aacfea8e05a555 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('flash-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalef2154c4b1054a3a28aacfea8e05a555)): ?>
<?php $attributes = $__attributesOriginalef2154c4b1054a3a28aacfea8e05a555; ?>
<?php unset($__attributesOriginalef2154c4b1054a3a28aacfea8e05a555); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalef2154c4b1054a3a28aacfea8e05a555)): ?>
<?php $component = $__componentOriginalef2154c4b1054a3a28aacfea8e05a555; ?>
<?php unset($__componentOriginalef2154c4b1054a3a28aacfea8e05a555); ?>
<?php endif; ?>
            <div class="col-lg-12 mt-4">
                <div class="recent-order-wrapper dashboard-table bg-white">
                    <div class="product-list-title-flex d-flex flex-wrap align-items-center justify-content-between">
                        <h3><?php echo e(__('Product Trash')); ?></h3>
                        <?php if (isset($component)) { $__componentOriginal45707fd03740a949cf0a590c71f427e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal45707fd03740a949cf0a590c71f427e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.table.bulk-action','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::table.bulk-action'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal45707fd03740a949cf0a590c71f427e7)): ?>
<?php $attributes = $__attributesOriginal45707fd03740a949cf0a590c71f427e7; ?>
<?php unset($__attributesOriginal45707fd03740a949cf0a590c71f427e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal45707fd03740a949cf0a590c71f427e7)): ?>
<?php $component = $__componentOriginal45707fd03740a949cf0a590c71f427e7; ?>
<?php unset($__componentOriginal45707fd03740a949cf0a590c71f427e7); ?>
<?php endif; ?>

                        <a href="#1" class="btn btn-danger btn-sm delete-all"
                           data-product-delete-all-url="<?php echo e(route("vendor.products.trash.empty")); ?>"> <?php echo e(__('Empty Trash')); ?></a>
                        <div class="btn-wrapper">
                            <a class="btn btn-primary btn-sm"
                               href="<?php echo e(route('vendor.products.all')); ?>"><?php echo e(__('Back')); ?></a>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive--md mt-4">
                        <table class="custom--table pt-4" id="myTable">
                            <thead class="head-bg">
                            <tr>
                                <th class="check-all-rows">
                                    <div class="mark-all-checkbox">
                                        <input type="checkbox" class="all-checkbox">
                                    </div>
                                </th>

                                <th> <?php echo e(__("Name")); ?> </th>
                                <th> <?php echo e(__("Brand")); ?> </th>
                                <th> <?php echo e(__("Categories")); ?> </th>
                                <th> <?php echo e(__("Stock Qty")); ?> </th>
                                <th> <?php echo e(__("Actions")); ?> </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="table-cart-row">
                                    <td data-label="Check All">
                                        <?php if (isset($component)) { $__componentOriginal829055984a21292d13f60a38139f1b92 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal829055984a21292d13f60a38139f1b92 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.table.bulk-delete-checkbox','data' => ['id' => $product->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::table.bulk-delete-checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal829055984a21292d13f60a38139f1b92)): ?>
<?php $attributes = $__attributesOriginal829055984a21292d13f60a38139f1b92; ?>
<?php unset($__attributesOriginal829055984a21292d13f60a38139f1b92); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal829055984a21292d13f60a38139f1b92)): ?>
<?php $component = $__componentOriginal829055984a21292d13f60a38139f1b92; ?>
<?php unset($__componentOriginal829055984a21292d13f60a38139f1b92); ?>
<?php endif; ?>
                                    </td>

                                    <td class="product-name-info">
                                        <div class="d-flex gap-2">
                                            <div class="logo-brand">
                                                <?php echo render_image_markup_by_attachment_id($product?->image_id); ?>

                                            </div>
                                            <b class=""><?php echo e($product->name); ?></b>
                                            <p><?php echo e(Str::words($product->summary, 10)); ?></p>
                                        </div>
                                    </td>

                                    <td data-label="Image">
                                        <div class="d-flex gap-2">
                                            <div class="logo-brand product-brand">
                                                <?php echo render_image_markup_by_attachment_id($product?->brand?->image_id); ?>

                                            </div>
                                            <b class=""><?php echo e($product?->brand?->name); ?></b>
                                        </div>
                                    </td>

                                    <td class="price-td" data-label="Name">
                                        <?php if($product?->category?->name): ?>
                                            <b> <?php echo e(__('Category')); ?>: </b>
                                        <?php endif; ?><?php echo e($product?->category?->name); ?> <br>
                                        <?php if($product?->subCategory?->name): ?>
                                            <b> <?php echo e(__('Sub Category')); ?>: </b>
                                        <?php endif; ?><?php echo e($product?->subCategory?->name); ?> <br>
                                    </td>

                                    <td class="price-td" data-label="Quantity">
                                        <span class="quantity-number"> <?php echo e($product?->inventory?->stock_count); ?></span>
                                    </td>

                                    <td data-label="Actions">
                                        <div class="action-icon">
                                            <a href="<?php echo e(route("vendor.products.trash.restore", $product->id)); ?>"
                                               class="product-restore btn btn-success btn-sm"> <?php echo e(__('Restore')); ?> </a>
                                            <a data-product-delete-url="<?php echo e(route("vendor.products.trash.delete", $product->id)); ?>"
                                               href="#1"
                                               class="product-delete btn btn-danger btn-sm"> <?php echo e(__('Delete')); ?> </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="9"
                                        class="text-center text-warning"> <?php echo e(__('No Trashed Product Available')); ?> </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginal4f951e8c2a9ac49386f46ebb0fdc8a83 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4f951e8c2a9ac49386f46ebb0fdc8a83 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.table.bulk-action-js','data' => ['url' => route('vendor.products.trash.bulk.destroy')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::table.bulk-action-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('vendor.products.trash.bulk.destroy'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4f951e8c2a9ac49386f46ebb0fdc8a83)): ?>
<?php $attributes = $__attributesOriginal4f951e8c2a9ac49386f46ebb0fdc8a83; ?>
<?php unset($__attributesOriginal4f951e8c2a9ac49386f46ebb0fdc8a83); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4f951e8c2a9ac49386f46ebb0fdc8a83)): ?>
<?php $component = $__componentOriginal4f951e8c2a9ac49386f46ebb0fdc8a83; ?>
<?php unset($__componentOriginal4f951e8c2a9ac49386f46ebb0fdc8a83); ?>
<?php endif; ?>
    <script>
        $(document).on("click", ".delete-all", function (e) {
            e.preventDefault();
            let el = $(this);
            let delete_url = el.data('product-delete-all-url');
            let allIds = '<?php echo e($allProduct); ?>';

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete all!'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (allIds != '') {
                        $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i><?php echo e(__("Deleting")); ?>');
                        $.ajax({
                            'type': "POST",
                            'url': delete_url,
                            'data': {
                                _token: "<?php echo e(csrf_token()); ?>",
                                ids: allIds
                            },
                            success: function (data) {
                                toastr.success('Trash in Empty');
                                setTimeout(() => {
                                    location.reload();
                                }, 1000)
                            }
                        });
                    }
                }
            });
        });

        $(document).on("click", ".product-delete", function (e) {
            e.preventDefault();
            let delete_url = $(this).data('product-delete-url');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.replace(delete_url);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.vendor-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/vendor/trash.blade.php ENDPATH**/ ?>