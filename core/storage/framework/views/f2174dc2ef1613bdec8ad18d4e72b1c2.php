<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Add new Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
    <?php if (isset($component)) { $__componentOriginaldfdc73ee107e48d175ea9d298bebd7fa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldfdc73ee107e48d175ea9d298bebd7fa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('summernote.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldfdc73ee107e48d175ea9d298bebd7fa)): ?>
<?php $attributes = $__attributesOriginaldfdc73ee107e48d175ea9d298bebd7fa; ?>
<?php unset($__attributesOriginaldfdc73ee107e48d175ea9d298bebd7fa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldfdc73ee107e48d175ea9d298bebd7fa)): ?>
<?php $component = $__componentOriginaldfdc73ee107e48d175ea9d298bebd7fa; ?>
<?php unset($__componentOriginaldfdc73ee107e48d175ea9d298bebd7fa); ?>
<?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
        $subCat = $product?->subCategory?->id ?? null;
        $childCat = $product?->childCategory?->pluck('id')->toArray() ?? null;
        $cat = $product?->category?->id ?? null;
        $selectedDeliveryOption = $product?->delivery_option?->pluck('delivery_option_id')?->toArray() ?? [];
    ?>
    <div class="dashboard-top-contents">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-inner-contents search-area top-searchbar-wrapper">
                    <div class="dashboard-flex-contetns w-100">
                        <div class="dashboard-flex-contetns w-100">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <h3 class="heading-three fw-500"> <?php echo e(__('Update Product')); ?> </h3>
                                <div class="button-wrappers">
                                    <a href="<?php echo e(route('vendor.products.all')); ?>"
                                        class="btn btn-info"><?php echo e(__('Product List')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-products-add bg-white radius-20 mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex align-items-start">
                    <div class="col-md-2">
                        <div class="nav flex-column nav-pills border-1 radius-10 me-3" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-general-info-tab" data-bs-toggle="pill"
                                data-bs-target="#v-general-info-tab" type="button" role="tab"
                                aria-controls="v-general-info-tab" aria-selected="true"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> <?php echo e(__('General Info')); ?>

                            </button>
                            <button class="nav-link" id="v-pills-price-tab" data-bs-toggle="pill"
                                data-bs-target="#v-price-tab" type="button" role="tab" aria-controls="v-price-tab"
                                aria-selected="false"><span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                <?php echo e(__('Price')); ?>

                            </button>
                            <button class="nav-link" id="v-pills-images-tab-tab" data-bs-toggle="pill"
                                data-bs-target="#v-images-tab" type="button" role="tab" aria-controls="v-images-tab"
                                aria-selected="false"><span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                <?php echo e(__('Images')); ?>

                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-inventory-tab" type="button" role="tab"
                                aria-controls="v-inventory-tab" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> <?php echo e(__('Inventory')); ?>

                            </button>
                            <button class="nav-link" id="v-pills-tags-and-label" data-bs-toggle="pill"
                                data-bs-target="#v-tags-and-label" type="button" role="tab"
                                aria-controls="v-tags-and-label" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> <?php echo e(__('Tags & Label')); ?>

                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-attributes-tab" type="button" role="tab"
                                aria-controls="v-attributes-tab" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> <?php echo e(__('Attributes')); ?>

                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-categories-tab" type="button" role="tab"
                                aria-controls="v-categories-tab" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> <?php echo e(__('Categories')); ?>

                            </button>
                            <button class="nav-link" id="v-pills-delivery-option-tab" data-bs-toggle="pill"
                                data-bs-target="#v-delivery-option-tab" type="button" role="tab"
                                aria-controls="v-delivery-option-tab" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> <?php echo e(__('Delivery Option')); ?>

                            </button>
                            <button class="nav-link" id="v-pills-meta-tag-tab" data-bs-toggle="pill"
                                data-bs-target="#v-meta-tag-tab" type="button" role="tab"
                                aria-controls="v-meta-tag-tab" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> <?php echo e(__('Product Meta')); ?>

                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-settings-tab" type="button" role="tab"
                                aria-controls="v-settings-tab" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                <?php echo e(__('Product Settings')); ?>

                            </button>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <form data-request-route="<?php echo e(route('vendor.products.edit', $product->id)); ?>" method="post"
                            id="product-create-form">
                            <?php echo csrf_field(); ?>
                            <input name="id" type="hidden" value="<?php echo e($product?->id); ?>">
                            <div class="input-group">
                                <select name="product_status" id="form-control">
                                    <option value="publish" <?php if($product->product_status == 'publish'): ?> selected <?php endif; ?>>
                                        Publish
                                    </option>
                                    <option value="draft" <?php if($product->product_status == 'draft'): ?> selected <?php endif; ?>>
                                        Save as draft
                                    </option>
                                </select>
                                <button class="cmn_btn btn_bg_profile">Update Product</button>
                            </div>
                            <div class="tab-content margin-top-10" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-general-info-tab" role="tabpanel"
                                    aria-labelledby="v-general-info-tab">
                                    <?php if (isset($component)) { $__componentOriginal44dba662345aae91a0bf3a1619cb1b9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44dba662345aae91a0bf3a1619cb1b9a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.general-info','data' => ['brands' => $data['brands'],'product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::general-info'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['brands' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['brands']),'product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal44dba662345aae91a0bf3a1619cb1b9a)): ?>
<?php $attributes = $__attributesOriginal44dba662345aae91a0bf3a1619cb1b9a; ?>
<?php unset($__attributesOriginal44dba662345aae91a0bf3a1619cb1b9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44dba662345aae91a0bf3a1619cb1b9a)): ?>
<?php $component = $__componentOriginal44dba662345aae91a0bf3a1619cb1b9a; ?>
<?php unset($__componentOriginal44dba662345aae91a0bf3a1619cb1b9a); ?>
<?php endif; ?>
                                </div>
                                <div class="tab-pane fade" id="v-price-tab" role="tabpanel"
                                    aria-labelledby="v-price-tab">
                                    <?php if (isset($component)) { $__componentOriginal771a1650cfb4bb4dd8de98148ea3cb3e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal771a1650cfb4bb4dd8de98148ea3cb3e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.product-price','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::product-price'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal771a1650cfb4bb4dd8de98148ea3cb3e)): ?>
<?php $attributes = $__attributesOriginal771a1650cfb4bb4dd8de98148ea3cb3e; ?>
<?php unset($__attributesOriginal771a1650cfb4bb4dd8de98148ea3cb3e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal771a1650cfb4bb4dd8de98148ea3cb3e)): ?>
<?php $component = $__componentOriginal771a1650cfb4bb4dd8de98148ea3cb3e; ?>
<?php unset($__componentOriginal771a1650cfb4bb4dd8de98148ea3cb3e); ?>
<?php endif; ?>
                                </div>
                                <div class="tab-pane fade" id="v-inventory-tab" role="tabpanel"
                                    aria-labelledby="v-inventory-tab">
                                    <?php if (isset($component)) { $__componentOriginalf595fd8f911855a4836be03ba944fb9f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf595fd8f911855a4836be03ba944fb9f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.product-inventory','data' => ['units' => $data['units'],'inventory' => $product?->inventory,'uom' => $product?->uom]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::product-inventory'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['units' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['units']),'inventory' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product?->inventory),'uom' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product?->uom)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf595fd8f911855a4836be03ba944fb9f)): ?>
<?php $attributes = $__attributesOriginalf595fd8f911855a4836be03ba944fb9f; ?>
<?php unset($__attributesOriginalf595fd8f911855a4836be03ba944fb9f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf595fd8f911855a4836be03ba944fb9f)): ?>
<?php $component = $__componentOriginalf595fd8f911855a4836be03ba944fb9f; ?>
<?php unset($__componentOriginalf595fd8f911855a4836be03ba944fb9f); ?>
<?php endif; ?>
                                </div>
                                <div class="tab-pane fade" id="v-images-tab" role="tabpanel"
                                    aria-labelledby="v-images-tab">
                                    <?php if (isset($component)) { $__componentOriginal06626ae97c3c09153c056d67afc921d0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal06626ae97c3c09153c056d67afc921d0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.product-image','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::product-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal06626ae97c3c09153c056d67afc921d0)): ?>
<?php $attributes = $__attributesOriginal06626ae97c3c09153c056d67afc921d0; ?>
<?php unset($__attributesOriginal06626ae97c3c09153c056d67afc921d0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal06626ae97c3c09153c056d67afc921d0)): ?>
<?php $component = $__componentOriginal06626ae97c3c09153c056d67afc921d0; ?>
<?php unset($__componentOriginal06626ae97c3c09153c056d67afc921d0); ?>
<?php endif; ?>
                                </div>
                                <div class="tab-pane fade" id="v-tags-and-label" role="tabpanel"
                                    aria-labelledby="v-tags-and-label">
                                    <?php if (isset($component)) { $__componentOriginal98d951242ec5284e44404e7d0a34c0ec = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal98d951242ec5284e44404e7d0a34c0ec = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.tags-and-badge','data' => ['badges' => $data['badges'],'tag' => $product?->tag,'singlebadge' => $product?->badge_id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::tags-and-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['badges' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['badges']),'tag' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product?->tag),'singlebadge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product?->badge_id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal98d951242ec5284e44404e7d0a34c0ec)): ?>
<?php $attributes = $__attributesOriginal98d951242ec5284e44404e7d0a34c0ec; ?>
<?php unset($__attributesOriginal98d951242ec5284e44404e7d0a34c0ec); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal98d951242ec5284e44404e7d0a34c0ec)): ?>
<?php $component = $__componentOriginal98d951242ec5284e44404e7d0a34c0ec; ?>
<?php unset($__componentOriginal98d951242ec5284e44404e7d0a34c0ec); ?>
<?php endif; ?>
                                </div>
                                <div class="tab-pane fade" id="v-attributes-tab" role="tabpanel"
                                    aria-labelledby="v-attributes-tab">
                                    <?php if (isset($component)) { $__componentOriginald05d10d07926653407a375bfd2d024bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald05d10d07926653407a375bfd2d024bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.product-attribute','data' => ['inventorydetails' => $product?->inventory?->inventoryDetails,'colors' => $data['product_colors'],'sizes' => $data['product_sizes'],'allAttributes' => $data['all_attribute']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::product-attribute'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['inventorydetails' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product?->inventory?->inventoryDetails),'colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['product_colors']),'sizes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['product_sizes']),'allAttributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['all_attribute'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald05d10d07926653407a375bfd2d024bf)): ?>
<?php $attributes = $__attributesOriginald05d10d07926653407a375bfd2d024bf; ?>
<?php unset($__attributesOriginald05d10d07926653407a375bfd2d024bf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald05d10d07926653407a375bfd2d024bf)): ?>
<?php $component = $__componentOriginald05d10d07926653407a375bfd2d024bf; ?>
<?php unset($__componentOriginald05d10d07926653407a375bfd2d024bf); ?>
<?php endif; ?>
                                </div>
                                <div class="tab-pane fade" id="v-categories-tab" role="tabpanel"
                                    aria-labelledby="v-categories-tab">
                                    <?php if (isset($component)) { $__componentOriginal40339e9ffebd5a9ccc61294a8255f651 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal40339e9ffebd5a9ccc61294a8255f651 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.categories','data' => ['subCategories' => $sub_categories,'categories' => $data['categories'],'childCategories' => $child_categories,'selectedChildCat' => $childCat,'selectedSubCat' => $subCat,'selectedcat' => $cat]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::categories'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sub_categories' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sub_categories),'categories' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['categories']),'child_categories' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($child_categories),'selected_child_cat' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($childCat),'selected_sub_cat' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subCat),'selectedcat' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cat)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal40339e9ffebd5a9ccc61294a8255f651)): ?>
<?php $attributes = $__attributesOriginal40339e9ffebd5a9ccc61294a8255f651; ?>
<?php unset($__attributesOriginal40339e9ffebd5a9ccc61294a8255f651); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal40339e9ffebd5a9ccc61294a8255f651)): ?>
<?php $component = $__componentOriginal40339e9ffebd5a9ccc61294a8255f651; ?>
<?php unset($__componentOriginal40339e9ffebd5a9ccc61294a8255f651); ?>
<?php endif; ?>
                                </div>
                                <div class="tab-pane fade" id="v-delivery-option-tab" role="tabpanel"
                                    aria-labelledby="v-delivery-option-tab">
                                    <?php if (isset($component)) { $__componentOriginalcca59b495b73e62e6afb4384ea549ddf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcca59b495b73e62e6afb4384ea549ddf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.delivery-option','data' => ['selectedDeliveryOption' => $selectedDeliveryOption,'deliveryOptions' => $data['deliveryOptions']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::delivery-option'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['selected_delivery_option' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selectedDeliveryOption),'deliveryOptions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['deliveryOptions'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcca59b495b73e62e6afb4384ea549ddf)): ?>
<?php $attributes = $__attributesOriginalcca59b495b73e62e6afb4384ea549ddf; ?>
<?php unset($__attributesOriginalcca59b495b73e62e6afb4384ea549ddf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcca59b495b73e62e6afb4384ea549ddf)): ?>
<?php $component = $__componentOriginalcca59b495b73e62e6afb4384ea549ddf; ?>
<?php unset($__componentOriginalcca59b495b73e62e6afb4384ea549ddf); ?>
<?php endif; ?>
                                </div>
                                <div class="tab-pane fade" id="v-meta-tag-tab" role="tabpanel"
                                    aria-labelledby="v-meta-tag-tab">
                                    <?php if (isset($component)) { $__componentOriginal0f49bb7901108822a0eb9dca148f93b4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f49bb7901108822a0eb9dca148f93b4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.meta-seo','data' => ['metaData' => $product->metaData]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::meta-seo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['meta_data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->metaData)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f49bb7901108822a0eb9dca148f93b4)): ?>
<?php $attributes = $__attributesOriginal0f49bb7901108822a0eb9dca148f93b4; ?>
<?php unset($__attributesOriginal0f49bb7901108822a0eb9dca148f93b4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f49bb7901108822a0eb9dca148f93b4)): ?>
<?php $component = $__componentOriginal0f49bb7901108822a0eb9dca148f93b4; ?>
<?php unset($__componentOriginal0f49bb7901108822a0eb9dca148f93b4); ?>
<?php endif; ?>
                                </div>
                                <div class="tab-pane fade" id="v-settings-tab" role="tabpanel"
                                    aria-labelledby="v-settings-tab">
                                    <?php if (isset($component)) { $__componentOriginal2ecf4ce759150287176afad1046f561d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ecf4ce759150287176afad1046f561d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.settings','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::settings'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ecf4ce759150287176afad1046f561d)): ?>
<?php $attributes = $__attributesOriginal2ecf4ce759150287176afad1046f561d; ?>
<?php unset($__attributesOriginal2ecf4ce759150287176afad1046f561d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ecf4ce759150287176afad1046f561d)): ?>
<?php $component = $__componentOriginal2ecf4ce759150287176afad1046f561d; ?>
<?php unset($__componentOriginal2ecf4ce759150287176afad1046f561d); ?>
<?php endif; ?>
                                </div>
                            </div>
                        </form>
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
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('script'); ?>
        <script src="<?php echo e(asset('assets/common/js/jquery-ui.min.js')); ?>" rel="stylesheet"></script>
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
        <?php if (isset($component)) { $__componentOriginale5b58a3009df297f039f4deb857ae091 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale5b58a3009df297f039f4deb857ae091 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.summernote.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('summernote.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale5b58a3009df297f039f4deb857ae091)): ?>
<?php $attributes = $__attributesOriginale5b58a3009df297f039f4deb857ae091; ?>
<?php unset($__attributesOriginale5b58a3009df297f039f4deb857ae091); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale5b58a3009df297f039f4deb857ae091)): ?>
<?php $component = $__componentOriginale5b58a3009df297f039f4deb857ae091; ?>
<?php unset($__componentOriginale5b58a3009df297f039f4deb857ae091); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal154f995f507ef8fdfd0c7ffbcca5d27e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal154f995f507ef8fdfd0c7ffbcca5d27e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.variant-info.js','data' => ['colors' => $data['product_colors'],'sizes' => $data['product_sizes'],'allAttributes' => $data['all_attribute']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::variant-info.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['product_colors']),'sizes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['product_sizes']),'all-attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['all_attribute'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal154f995f507ef8fdfd0c7ffbcca5d27e)): ?>
<?php $attributes = $__attributesOriginal154f995f507ef8fdfd0c7ffbcca5d27e; ?>
<?php unset($__attributesOriginal154f995f507ef8fdfd0c7ffbcca5d27e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal154f995f507ef8fdfd0c7ffbcca5d27e)): ?>
<?php $component = $__componentOriginal154f995f507ef8fdfd0c7ffbcca5d27e; ?>
<?php unset($__componentOriginal154f995f507ef8fdfd0c7ffbcca5d27e); ?>
<?php endif; ?>

        <script>
            $('#product-slug').on('keyup', function() {
                let title_text = $(this).val();
                $('#product-slug').val(convertToSlug(title_text))
            });

            $(document).on("submit", "#product-create-form", function(e) {
                e.preventDefault();

                send_ajax_request("post", new FormData(e.target), $(this).attr("data-request-route"), function() {
                    toastr.warning("Request sent successfully ");
                }, function(data) {
                    if (data.success) {
                        toastr.success("Product updated Successfully");
                    }
                }, function(xhr) {
                    ajax_toastr_error_message(xhr);
                });
            })

            let inventory_item_id = 0;
            $(document).on("click", ".delivery-item", function() {
                $(this).toggleClass("active");
                $(this).effect("shake", {
                    direction: "up",
                    times: 1,
                    distance: 2
                }, 500);

                let delivery_option = "";
                $.each($(".delivery-item.active"), function() {
                    delivery_option += $(this).data("delivery-option-id") + " , ";
                })

                delivery_option = delivery_option.slice(0, -3)

                $(".delivery-option-input").val(delivery_option);
            });

            $(document).on("change", "#category", function() {
                let data = new FormData();
                data.append("_token", "<?php echo e(csrf_token()); ?>");
                data.append("category_id", $(this).val());

                send_ajax_request("post", data, '<?php echo e(route('vendor.product.category.sub-category')); ?>', function() {
                    $("#sub_category").html("<option value=''><?php echo e(__('Select Sub Category')); ?></option>");
                    $("#child_category").html("<option value=''><?php echo e(__('Select Child Category')); ?></option>");
                    $("#select2-child_category-container").html('');
                }, function(data) {
                    $("#sub_category").html(data.html);
                }, function(xhr) {
                    ajax_toastr_error_message(xhr);
                });
            });

            $(document).on("change", "#sub_category", function() {
                let data = new FormData();
                data.append("_token", "<?php echo e(csrf_token()); ?>");
                data.append("sub_category_id", $(this).val());

                send_ajax_request("post", data, '<?php echo e(route('vendor.product.category.child-category')); ?>', function() {
                    $("#child_category").html("<option value=''><?php echo e(__('Select Child Category')); ?></option>");
                    $("#select2-child_category-container").html('');
                }, function(data) {
                    $("#child_category").html(data.html);
                }, function(xhr) {
                    ajax_toastr_error_message(xhr);
                });
            });

            $(document).on('click', '.badge-item', function(e) {
                $(".badge-item").removeClass("active");
                // $(this).effect( "shake", { direction: "up", times: 1, distance: 2}, 500 );
                $(this).addClass("active");
                $("#badge_id_input").val($(this).attr("data-badge-id"));
            });

            $(document).on("click", ".close-icon", function() {
                $('#media_upload_modal').modal('hide');
            });
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.vendor-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/vendor/edit.blade.php ENDPATH**/ ?>