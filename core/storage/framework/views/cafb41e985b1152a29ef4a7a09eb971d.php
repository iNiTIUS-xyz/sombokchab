<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Product Inventory')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/nice-select.css')); ?>">
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
        .singleFlexitem {
            background: #FFFFFF;
            -webkit-box-shadow: 0px 1px 80px 12px rgba(26, 40, 68, 0.06);
            box-shadow: 0px 1px 80px 12px rgba(26, 40, 68, 0.06);
            padding: 20px;
            padding-bottom: 0;
            border-radius: 12px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: start;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -webkit-transition: 0.4s;
            transition: 0.4s;
            cursor: pointer;
        }
        @media (max-width: 1199px) {
            .singleFlexitem {
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
            }
        }
        .singleFlexitem .listCap {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            /*-webkit-box-align: center;*/
            /*-ms-flex-align: center;*/
            /*align-items: center;*/
            -webkit-transition: 0.4s;
            transition: 0.4s;
            margin-bottom: 20px;
            cursor: pointer;
            left: auto;
        }
        @media only screen and (min-width: 1200px) and (max-width: 1399.99px) {
            .singleFlexitem .listCap {
                padding: 10px;
            }
        }
        @media (max-width: 991px) {
            .singleFlexitem .listCap {
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                margin-bottom: 10px;
            }
        }
        .singleFlexitem .listCap .recentImg {
            margin-right: 20px;
        }
        @media (max-width: 575px) {
            .singleFlexitem .listCap .recentImg {
                margin-bottom: 15px;
            }
        }
        @media only screen and (min-width: 1200px) and (max-width: 1399.99px) {
            .singleFlexitem .listCap .recentImg {
                width: 29%;
                margin-right: 9px;
            }
        }
        .singleFlexitem .listCap .recentImg img {
            border-radius: 12px;
            margin-bottom: 16px;
        }
        @media only screen and (min-width: 1200px) and (max-width: 1399.99px) {
            .singleFlexitem .listCap .recentImg img {
                width: 100%;
            }
        }
        .singleFlexitem .listCap .recentCaption .featureTittle {
            font-family: var(--heading-font);
            margin-bottom: 9px;
            line-height: 1.5;
            color: var(--heading-color);
            font-weight: 500;
            font-size: 20px;
            display: block;
        }
        .singleFlexitem .listCap .recentCaption .featureTittle:hover {
            color: var(--heading-color);
        }
        @media only screen and (min-width: 1200px) and (max-width: 1399.99px) {
            .singleFlexitem .listCap .recentCaption .featureTittle {
                font-size: 15px;
            }
        }
        @media only screen and (min-width: 992px) and (max-width: 1199px) {
            .singleFlexitem .listCap .recentCaption .featureTittle {
                font-size: 21px;
            }
        }
        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .singleFlexitem .listCap .recentCaption .featureTittle {
                font-size: 18px;
            }
        }
        @media (max-width: 575px) {
            .singleFlexitem .listCap .recentCaption .featureTittle {
                font-size: 18px;
            }
        }
        .singleFlexitem .listCap .recentCaption .featureCap {
            font-family: var(--heading-font);
            font-size: 15px;
            color: var(--heading-font);
            margin-bottom: 11px;
        }
        @media only screen and (min-width: 1200px) and (max-width: 1399.99px) {
            .singleFlexitem .listCap .recentCaption .featureCap {
                font-size: 12px;
                margin-bottom: 7px;
            }
        }
        .singleFlexitem .listCap .recentCaption .featureCap .subCap {
            font-family: var(--heading-font);
            font-family: var(--heading-font);
            color: var(--main-color-two);
            font-weight: 400;
        }
        @media only screen and (min-width: 1200px) and (max-width: 1399.99px) {
            .singleFlexitem .listCap .recentCaption .featureCap .subCap {
                font-size: 12px;
            }
        }
        .cat label {
            font-weight: 500;
            color: var(--heading-color);
        }
        .singleFlexitem .featurePricing {
            margin-bottom: 18px;
            font-family: var(--heading-font);
            color: var(--heading-color);
            font-weight: 500;
            font-size: 22px;
            display: block;
            text-align: center;
        }
        .singleFlexitem .featurePricing del{
            font-weight: 400;
            font-size: 18px;
        }
        @media only screen and (min-width: 1200px) and (max-width: 1399.99px) {
            .singleFlexitem .featurePricing {
                font-size: 17px;
                margin-bottom: 7px;
            }
        }
        .singleFlexitem:hover .cat-caption .product-price i {
            color: var(--main-color-two);
            font-size: 16px;
        }



        .pro-btn1 {
            font-family: var(--heading-font);
            -webkit-transition: 0.4s;
            -moz-transition: 0.4s;
            transition: 0.4s;
            border: 1px solid transparent;
            background: rgba(var(--customer-profile-rgb), 0.1);
            color: var(--customer-profile);
            text-transform: capitalize;
            padding: 1px 8px;
            font-size: 15px;
            font-weight: 400;
            display: inline-block;
            border-radius: 6px;
            margin-right: 6px;
            margin-bottom: 10px;

        }

        .pro-btn2 {
            font-family: var(--heading-font);
            -webkit-transition: 0.4s;
            -moz-transition: 0.4s;
            transition: 0.4s;
            border: 1px solid transparent;
            background: rgba(82, 78, 183, 0.1);
            color: var(--customer-profile);
            text-transform: uppercase;
            padding: 4px 8px;
            font-size: 14px;
            font-weight: 400;
            display: inline-block;
            border-radius: 6px;
            margin-bottom: 10px;

        }

        .pro-btn2:hover {
            background: var(--customer-profile);
            color: #fff;
        }
        .pro-btn1:hover {
            background: var(--customer-profile);
            color: #fff;
        }

        .recentImg{
            width: 360px;
        }
    </style>
<?php $__env->stopSection(); ?>



<?php
    $inventory_details = true;
//    dd($product->category);
?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12">
        <div class="row">








            <div class="col-lg-12 mt-3">
                <!-- Single -->
                <div class="singleFlexitem social">
                    <div class="listCap">
                        <div class="recentImg">
                            <?php echo render_image($product->image); ?>

                            <span class="featurePricing"><?php echo e(amount_with_currency_symbol($product->price)); ?> <del><?php echo e(amount_with_currency_symbol($product->sale_price)); ?></del></span>
                        </div>
                        <div class="recentCaption">
                            <div class="d-flex justify-content-between">
                                <h5><a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>" class="featureTittle"><?php echo e($product->name); ?></a></h5>
                                <div class="btn-wrapper mb-20">
                                    <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>" class="btn btn-info">
                                        <i class="lar la-eye icon"></i><span><?php echo e(__("View")); ?></span>
                                    </a>
                                    <a href="<?php echo e(route('vendor.products.edit', $product->id)); ?>" class="btn btn-primary">
                                        <?php echo e(__("Edit")); ?>

                                    </a>
                                </div>
                            </div>

                            <p class="featureCap"><?php echo e($product?->summary); ?></p>

                            <div class="d-flex">
                                  <div class="cat d-flex flex-column gap-1">
                                      <label><?php echo e(__("Category")); ?></label>
                                      <?php if($product?->category): ?>
                                          <span class="pro-btn1"><?php echo e($product?->category?->name); ?></span>
                                      <?php endif; ?>
                                  </div>
                                <div class="cat d-flex flex-column gap-1">
                                    <label><?php echo e(__("Sub Category")); ?></label>
                                    <?php if($product?->subCategory): ?>
                                        <span class="pro-btn1"><?php echo e($product?->subCategory?->name); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="cat">
                                <label><?php echo e(__("Child Category")); ?></label>
                                <?php if($product?->childCategory): ?>
                                    <?php $__currentLoopData = $product->childCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="pro-btn1"><?php echo e($childCategory?->name); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <form action="<?php echo e(route('vendor.products.inventory.update')); ?>" method="POST" id="update-inventory-form">
                <?php echo csrf_field(); ?>
                <input value="<?php echo e($product->id); ?>" name="product_id" type="hidden">

                <div class="col-lg-12 mt-3">
                    <div class="card p-5">
                        <?php if (isset($component)) { $__componentOriginalf595fd8f911855a4836be03ba944fb9f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf595fd8f911855a4836be03ba944fb9f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.product-inventory','data' => ['inventoryPage' => true,'units' => $data['units'],'inventory' => $product?->inventory,'uom' => $product?->uom]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::product-inventory'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['inventory_page' => true,'units' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data['units']),'inventory' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product?->inventory),'uom' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product?->uom)]); ?>
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
                </div>

                <div class="col-lg-12 mt-3">
                    <?php if (isset($component)) { $__componentOriginald05d10d07926653407a375bfd2d024bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald05d10d07926653407a375bfd2d024bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.product-attribute','data' => ['inventorydetails' => $inventory?->inventoryDetails,'colors' => $product_colors,'sizes' => $product_sizes,'allAttributes' => $all_attributes]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::product-attribute'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['inventorydetails' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($inventory?->inventoryDetails),'colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product_colors),'sizes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product_sizes),'allAttributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_attributes)]); ?>
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

                <div class="form-group">
                    <button class="btn btn-sm btn-info"><?php echo e(__("Update Inventory")); ?></button>
                </div>
            </form>
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

    <?php if (isset($component)) { $__componentOriginal154f995f507ef8fdfd0c7ffbcca5d27e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal154f995f507ef8fdfd0c7ffbcca5d27e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.variant-info.js','data' => ['colors' => $product_colors,'sizes' => $product_sizes,'allAttributes' => $all_attributes]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::variant-info.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product_colors),'sizes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product_sizes),'all-attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_attributes)]); ?>
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
    <script src="<?php echo e(asset('assets/backend/js/jquery.nice-select.min.js')); ?>"></script>
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
        (function ($) {
            'use script'

            $(document).on("submit", "#update-inventory-form", function (e) {
                e.preventDefault();
                let data = new FormData(e.target);

                send_ajax_request("post", data, '<?php echo e(route('vendor.products.inventory.update')); ?>', function () {

                }, function (data) {
                    if(data.type == 'success'){
                        toastr.success(data.msg);
                    }else{
                        toastr.error(data.msg);
                    }

                }, function () {

                });
            });

            $(document).ready(function () {
                let nice_select_el = $('.nice-select');
                if (nice_select_el.length > 0) {
                    nice_select_el.niceSelect();
                }
            });
        })(jQuery)
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.vendor-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Inventory\Resources/views/vendor/edit.blade.php ENDPATH**/ ?>