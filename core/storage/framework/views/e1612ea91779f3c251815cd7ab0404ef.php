<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Product List Page')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(asset('assets/css/flatpickr.min.css')); ?>" rel="stylesheet">
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
    <?php if (isset($component)) { $__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.css','data' => ['type' => 'vendor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'vendor']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa)): ?>
<?php $attributes = $__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa; ?>
<?php unset($__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa)): ?>
<?php $component = $__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa; ?>
<?php unset($__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="dashboard-recent-order">
        <div class="row">
            <div class="col-md-12">
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
                <div class="dashboard__card">
                    <div class="dashboard__card__header" id="product-list-title-flex">
                        <h3 class="dashboard__card__title cursor-pointer"><?php echo e(__('Search Product Module')); ?>

                            <i class="las la-angle-down"></i>
                        </h3>
                        <button id="product-search-button" type="submit" class="cmn_btn btn_bg_profile"><?php echo e(__('Search')); ?></button>
                    </div>
                    <div class="dashboard__card__body custom__form">
                        <form id="product-search-form" class="mt-4" action="<?php echo e(route('vendor.products.search')); ?>"
                            method="get">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-name"><?php echo e(__("Name")); ?></label>
                                        <input name="name" class="form--control input-height-1" id="search-name"
                                            value="<?php echo e(request()->name ?? old('name')); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-sku"><?php echo e(__("SKU")); ?></label>
                                        <input name="sku" class="form--control input-height-1" id="search-sku"
                                            value="<?php echo e(request()->sku ?? old('sku')); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-brand"><?php echo e(__("Brand")); ?></label>
                                        <input name="brand" class="form--control input-height-1" id="search-brand"
                                            value="<?php echo e(request()->brand ?? old('brand')); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-category"><?php echo e(__("Category")); ?></label>
                                        <input name="category" class="form--control input-height-1" id="search-category"
                                            value="<?php echo e(old('category')); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-sub_category"><?php echo e(__("Sub Categor")); ?>y</label>
                                        <input name="sub_category" class="form--control input-height-1" id="search-brand"
                                            value="<?php echo e(old('sub_category')); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-category"><?php echo e(__("Child Category")); ?></label>
                                        <input name="child_category" class="form--control input-height-1"
                                            id="search-category" value="<?php echo e(old('child_category')); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-color"><?php echo e(__("Color Name")); ?></label>
                                        <input name="color" class="form--control input-height-1" id="search-color"
                                            value="<?php echo e(old('color')); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-size"><?php echo e(__("Size Name")); ?></label>
                                        <input name="size" class="form--control input-height-1" id="search-size"
                                            value="<?php echo e(old('size')); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group dashboard_checkbox">
                                        <input type="checkbox" name="is_inventory_warn_able" class="check_input"
                                            id="search-is_inventory_warn_able"
                                            value="<?php echo e(old('is_inventory_warn_able')); ?>" />
                                        <label for="search-is_inventory_warn_able" class="checkbox_label"><?php echo e(__("Inventory
                                            Warning")); ?></label>
                                    </div>
                                    <div class="form-group dashboard_checkbox">
                                        <input type="checkbox" name="refundable" class="check_input" id="search-refundable"
                                            value="<?php echo e(old('refundable')); ?>" />
                                        <label for="search-refundable" class="checkbox_label"><?php echo e(__("Refundable")); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-1" for="search-from_price"><?php echo e(__("From Price")); ?></label>
                                                <input name="from_price" class="form--control input-height-1"
                                                    id="search-from_price" value="<?php echo e(old('from_price')); ?>" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-1" for="search-to_price"><?php echo e(__("TO Price")); ?></label>
                                                <input name="to_price" class="form--control input-height-1"
                                                    id="search-to_price" value="<?php echo e(old('to_price')); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-date_range"><?php echo e(__("Created Date Range")); ?></label>
                                        <input name="date_range" class="form--control input-height-1"
                                            id="search-date_range" value="<?php echo e(old('date_range')); ?>" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="label-1" for="search-order_by"><?php echo e(__("Order By")); ?></label>
                                        <select name="order_by" class="form--control input-height-1" id="search-order_by"
                                            value="<?php echo e(old('order_by')); ?>">
                                            <option value=""><?php echo e(__("Select Order By Option")); ?></option>
                                            <option value="asc"><?php echo e(__("Asc")); ?></option>
                                            <option value="desc"><?php echo e(__("DESC")); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <div class="dashboard__card__header__left">
                            <h3 class="dashboard__card__title mb-2"><?php echo e(__('Product List')); ?></h3>
                            <div class="d-flex flex-wrap bulk-delete-wrapper gap-2">
                                <label for="number-of-item"><?php echo e(__("Number Of Rows")); ?></label>
                                <select name="count" id="number-of-item">
                                    <option value="10"><?php echo e(__("10")); ?></option>
                                    <option value="25"><?php echo e(__("25")); ?></option>
                                    <option value="50"><?php echo e(__("50")); ?></option>
                                    <option value="100"><?php echo e(__("100")); ?></option>
                                </select>

                                <div class="btn-wrapper-trash">
                                    <a class="btn btn-danger btn-sm"
                                        href="<?php echo e(route('vendor.products.trash.all')); ?>"><?php echo e(__('Trash')); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard__card__header__right">
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
                            <div class="btn-wrapper">
                                <a class="cmn_btn btn_bg_profile"
                                    href="<?php echo e(route('vendor.products.create')); ?>"><?php echo e(__('Add New Product')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard__card__body dashboard-table mt-4">
                        <div class="table-wrap table-responsive" id="product-table-body">
                            <?php
                                $route = 'vendor';
                            ?>

                            <?php echo view('product::vendor.search', compact('products', 'statuses', 'route')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.markup','data' => ['type' => 'vendor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'vendor']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75)): ?>
<?php $attributes = $__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75; ?>
<?php unset($__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75)): ?>
<?php $component = $__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75; ?>
<?php unset($__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal39bbcd3f5bd246c6e97551909a1880c6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal39bbcd3f5bd246c6e97551909a1880c6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.product-image-modal','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::product-image-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal39bbcd3f5bd246c6e97551909a1880c6)): ?>
<?php $attributes = $__attributesOriginal39bbcd3f5bd246c6e97551909a1880c6; ?>
<?php unset($__attributesOriginal39bbcd3f5bd246c6e97551909a1880c6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal39bbcd3f5bd246c6e97551909a1880c6)): ?>
<?php $component = $__componentOriginal39bbcd3f5bd246c6e97551909a1880c6; ?>
<?php unset($__componentOriginal39bbcd3f5bd246c6e97551909a1880c6); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/flatpickr.js')); ?>"></script>
    <?php if (isset($component)) { $__componentOriginal506d9058559d904c2ef0466c006dcc32 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal506d9058559d904c2ef0466c006dcc32 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.table.status-js','data' => ['type' => 'vendor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::table.status-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'vendor']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal506d9058559d904c2ef0466c006dcc32)): ?>
<?php $attributes = $__attributesOriginal506d9058559d904c2ef0466c006dcc32; ?>
<?php unset($__attributesOriginal506d9058559d904c2ef0466c006dcc32); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal506d9058559d904c2ef0466c006dcc32)): ?>
<?php $component = $__componentOriginal506d9058559d904c2ef0466c006dcc32; ?>
<?php unset($__componentOriginal506d9058559d904c2ef0466c006dcc32); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal4f951e8c2a9ac49386f46ebb0fdc8a83 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4f951e8c2a9ac49386f46ebb0fdc8a83 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.table.bulk-action-js','data' => ['url' => route('vendor.products.bulk.destroy')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::table.bulk-action-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('vendor.products.bulk.destroy'))]); ?>
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
    <?php if (isset($component)) { $__componentOriginal7b61ce9fd3aef2debdf8e4c96f3da089 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7b61ce9fd3aef2debdf8e4c96f3da089 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.product-image-js','data' => ['route' => route('vendor.products.update-image')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::product-image-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('vendor.products.update-image'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7b61ce9fd3aef2debdf8e4c96f3da089)): ?>
<?php $attributes = $__attributesOriginal7b61ce9fd3aef2debdf8e4c96f3da089; ?>
<?php unset($__attributesOriginal7b61ce9fd3aef2debdf8e4c96f3da089); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7b61ce9fd3aef2debdf8e4c96f3da089)): ?>
<?php $component = $__componentOriginal7b61ce9fd3aef2debdf8e4c96f3da089; ?>
<?php unset($__componentOriginal7b61ce9fd3aef2debdf8e4c96f3da089); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.js','data' => ['type' => 'vendor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'vendor']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e)): ?>
<?php $attributes = $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e; ?>
<?php unset($__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e)): ?>
<?php $component = $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e; ?>
<?php unset($__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e); ?>
<?php endif; ?>
    <script>
        $(function() {
            $("#search-date_range").flatpickr({
                mode: "range",
                dateFormat: "Y-m-d",
            });

            $("#product-search-form").fadeOut();
            $(document).on("click", "#product-list-title-flex h3", function() {
                $("#product-search-form").fadeToggle();
            })

            $(document).ready(function() {
                $(".load-ajax-data").fadeOut();
            })

            $(document).on("click", "#product-search-button", function() {
                $("#product-search-form").trigger("submit");
            });

            $(document).on("submit", "#product-search-form", function(e) {
                e.preventDefault();
                let form_data = $("#product-search-form").serialize().toString();
                form_data += "&count=" + $("#number-of-item").val();

                // product-table-body
                send_ajax_request("GET", null, $(this).attr("action") + "?" + form_data, () => {
                    // before send request
                    $(".load-ajax-data").fadeIn();
                }, (data) => {
                    $("#product-table-body").html(data);
                    $(".load-ajax-data").fadeOut();
                }, (data) => {
                    prepare_errors(data);
                });
            });

            $(document).on("change", "#number-of-item", function(e) {
                e.preventDefault();
                let form_data = $("#product-search-form").serialize().toString()
                form_data += "&count=" + $(this).val();

                // product-table-body
                send_ajax_request("GET", null, $("#product-search-form").attr("action") + "?" + form_data,
                () => {
                    // before send request
                    $(".load-ajax-data").fadeIn();
                }, (data) => {
                    $("#product-table-body").html(data);
                    $(".load-ajax-data").fadeOut();
                }, (data) => {
                    prepare_errors(data);
                });
            });

            /*
            ========================================
                Row Remove Click Delete
            ========================================
            */
            $(document).on("click", ".pagination-list li a", function(e) {
                e.preventDefault();

                $(".pagination-list li a").removeClass("current");
                $(this).addClass("current");

                // product-table-body
                send_ajax_request("GET", null, $(this).attr("href"), () => {
                    // before send request
                    $(".load-ajax-data").fadeIn();
                }, (data) => {
                    $("#product-table-body").html(data);
                    $(".load-ajax-data").fadeOut();
                }, (data) => {
                    prepare_errors(data);
                });
            });

            $(document).on("click", ".delete-row", function(e) {
                e.preventDefault();
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
                        send_ajax_request("GET", null, $(this).data("product-url"), () => {
                            // before send request
                            toastr.warning("Request send please wait while");
                        }, (data) => {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );

                            let product = $(this).parent().parent().parent();
                            product.fadeOut();

                            if(data){
                                setTimeout(() => {
                                    product.remove();
                                    $(".tenant_info").load(location.href +
                                        " .tenant_info");
                                    ajax_toastr_success_message("Successfully moved to trash");
                                }, 800)
                            }

                        }, (data) => {
                            prepare_errors(data);
                        })
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.vendor-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/vendor/index.blade.php ENDPATH**/ ?>