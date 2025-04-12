<table class="customs-tables pt-4 position-relative" id="myTable">
    <div class="load-ajax-data"></div>
    <thead class="head-bg">
        <tr>
            <th class="check-all-rows p-3">
                <div class="mark-all-checkbox text-center">
                    <input type="checkbox" class="all-checkbox">
                </div>
            </th>
            <th> <?php echo e(__('id')); ?> </th>
            <th> <?php echo e(__('Name')); ?> </th>
            <th> <?php echo e(__('Brand')); ?> </th>
            <th> <?php echo e(__('Categories')); ?> </th>
            <th> <?php echo e(__('Stock Qty')); ?> </th>
            <th> <?php echo e(__('Status')); ?> </th>
            <th> <?php echo e(__('Product Status')); ?> </th>
            <th> <?php echo e(__('Actions')); ?> </th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $products["items"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="table-cart-row" data-product-id-row="<?php echo e($product->id); ?>">
                <td data-label="Check All" class="text-center">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-bulk-destroy')): ?>
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
                    <?php endif; ?>
                </td>
                <td data-label="Check All" class="text-center">
                    <?php echo e($product->id); ?>

                </td>

                <td class="product-name-info">
                    <div class="d-flex gap-2">
                        <div class="logo-brand position-relative">
                            <div class="image-box">
                                <?php echo render_image($product->image); ?>

                            </div>

                            <?php if(false): ?>
                                <button data-product-id="<?php echo e($product->id); ?>" data-bs-target="#mediaUpdateModalId"
                                    data-bs-toggle="modal"
                                    class="product-image-change-action-button btn btn-sm btn-outline-primary position-absolute top-0 left-0 rounded-circle">
                                    <i class="las la-pen"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                        <div class="product-summary">
                            <p class="font-weight-bold mb-1"><?php echo e($product->name); ?></p>
                            <p><?php echo e(Str::words($product->summary, 5)); ?></p>
                        </div>
                    </div>
                </td>

                <td data-label="Image">
                    <div class="d-flex gap-2">
                        <div class="logo-brand product-brand">
                            <?php echo render_image($product?->brand?->logo); ?>

                        </div>
                        <b class=""><?php echo e($product?->brand?->name); ?></b>
                    </div>
                </td>

                <td class="price-td" data-label="Name">
                    <span class="category-field">
                        <?php if($product?->category?->name): ?>
                            <b> <?php echo e(__('Category')); ?>: </b>
                        <?php endif; ?>
                        <?php echo e($product?->category?->name); ?>

                    </span> <br>
                    <span class="category-field">
                        <?php if($product?->subCategory?->name): ?>
                            <b> <?php echo e(__('Sub Category')); ?>: </b>
                        <?php endif; ?>
                        <?php echo e($product?->subCategory?->name); ?>

                    </span><br>
                </td>

                <td class="price-td" data-label="Quantity">
                    <span class="quantity-number"> <?php echo e($product?->inventory?->stock_count); ?></span>
                </td>

                <td data-label="Status">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-status')): ?>
                        <?php if (isset($component)) { $__componentOriginal78d8c73e7a744fc2818eadc33ac26215 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal78d8c73e7a744fc2818eadc33ac26215 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.table.status','data' => ['statuses' => $statuses,'statusId' => $product?->status_id,'id' => $product->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::table.status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['statuses' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($statuses),'statusId' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product?->status_id),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal78d8c73e7a744fc2818eadc33ac26215)): ?>
<?php $attributes = $__attributesOriginal78d8c73e7a744fc2818eadc33ac26215; ?>
<?php unset($__attributesOriginal78d8c73e7a744fc2818eadc33ac26215); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal78d8c73e7a744fc2818eadc33ac26215)): ?>
<?php $component = $__componentOriginal78d8c73e7a744fc2818eadc33ac26215; ?>
<?php unset($__componentOriginal78d8c73e7a744fc2818eadc33ac26215); ?>
<?php endif; ?>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <?php echo e(Str::ucfirst($product?->product_status)); ?>

                </td>
                <td data-label="Actions">
                    <div class="action-icon">
                        <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>" class="icon eye">
                            <i class="las la-eye"></i>
                        </a>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-update')): ?>
                            <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="icon edit">
                                <i class="las la-pen-alt"></i>
                            </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-clone')): ?>
                            <a href="<?php echo e(route('admin.products.clone', $product->id)); ?>" class="icon clone">
                                <i class="las la-copy"></i>
                            </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-destroy')): ?>
                            <a data-product-url="<?php echo e(route('admin.products.destroy', $product->id)); ?>" href="#1"
                                class="delete-row icon deleted">
                                <i class="las la-trash-alt"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="text-warning text-center"><?php echo e(__('No Product Found')); ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="custom-pagination-wrapper">
    <div class="pagination-info d-flex gap-3">
        <p>
            <strong><?php echo e(__('Per Page:')); ?></strong>
            <span><?php echo e($products['per_page']); ?></span>
        </p>
        <p>
            <strong><?php echo e(__('From:')); ?></strong>
            <span><?php echo e($products['from']); ?></span>
            <strong> <?php echo e(__('To:')); ?></strong>
            <span><?php echo e($products['to']); ?></span>
        </p>
        <p>
            <strong><?php echo e(__('Total Page:')); ?></strong>
            <span><?php echo e($products['total_page']); ?></span>
        </p>
        <p>
            <strong><?php echo e(__('Total Products:')); ?></strong>
            <span><?php echo e($products['total_items']); ?></span>
        </p>
    </div>

    <div class="pagination">
        <ul class="pagination-list">
            <?php $__currentLoopData = $products['links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e($link); ?>"
                        class="page-number <?php echo e($loop->iteration == $products['current_page'] ? 'current' : ''); ?>"><?php echo e($loop->iteration); ?></a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/search.blade.php ENDPATH**/ ?>