
<?php
    if (!isset($detail)) {
        $detail = null;
    }
    $key = $key ?? 'none';
?>

<div class="inventory_item shadow-sm rounded" <?php if(isset($key)): ?> data-id="<?php echo e($key); ?>" <?php endif; ?>>
    <?php if(isset($inventoryDetail) && !is_null($inventoryDetail)): ?>
        <input type="hidden" name="inventory_details_id[]" value="<?php echo e($inventoryDetail->id); ?>" />
    <?php endif; ?>
    <div class="row g-4">
        <div class="col">
            <div class="form-row  row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xxl-6">
                <div class="col">
                    <div class="form-group">
                        <label for="item_size"><?php echo e(__('Item Size')); ?></label>
                        <select name="item_size[]" class="form-control product-inventory-variant-select">
                            <option value=""><?php echo e(__('Select Size')); ?></option>
                            <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($size->id); ?>" <?php if(isset($detail) && $detail->size == $size->id): ?> selected <?php endif; ?>>
                                    <?php echo e($size->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="item_color"><?php echo e(__('Item Color')); ?></label>
                        <select name="item_color[]" class="form-control product-inventory-variant-select">
                            <option value=""><?php echo e(__('Select Color')); ?></option>
                            <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($color->id); ?>" <?php if(isset($detail) && $detail->color == $color->id): ?> selected <?php endif; ?>>
                                    <?php echo e($color->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="item_additional_price"><?php echo e(__('Additional Price')); ?></label>
                        <input type="number" step="0.01" name="item_additional_price[]" id="item_additional_price"
                            class="form-control" min="0" placeholder="<?php echo e(__('Additional price')); ?>"
                            value="<?php echo e($detail?->additional_price ?? 0); ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="item_stock_count"><?php echo e(__('Extra cost')); ?> </label>
                        <input type="number" name="item_extra_cost[]" id="item_stock_count" class="form-control"
                            min="0" placeholder="<?php echo e(__('Extra cost')); ?>" value="<?php echo e($detail?->add_cost ?? 0); ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="item_stock_count"><?php echo e(__('Stock Count')); ?> <i
                                class="las la-star required-filed"></i></label>
                        <input type="number" name="item_stock_count[]" id="item_stock_count" class="form-control"
                            min="0" placeholder="<?php echo e(__('Stock Count')); ?>"
                            value="<?php echo e($detail->stock_count ?? 0); ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <?php
                            $image = isset($detail?->attr_image) ? $detail?->attr_image ?? '' : '';
                        ?>
                        <?php if (isset($component)) { $__componentOriginal0df8641fc6be7d03bbc3b12e975af785 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0df8641fc6be7d03bbc3b12e975af785 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media-upload','data' => ['oldimage' => $image,'title' => __('Attribute Image'),'name' => 'item_image[]','dimentions' => '1280x1280']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['oldimage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($image),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Attribute Image')),'name' => 'item_image[]','dimentions' => '1280x1280']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0df8641fc6be7d03bbc3b12e975af785)): ?>
<?php $attributes = $__attributesOriginal0df8641fc6be7d03bbc3b12e975af785; ?>
<?php unset($__attributesOriginal0df8641fc6be7d03bbc3b12e975af785); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0df8641fc6be7d03bbc3b12e975af785)): ?>
<?php $component = $__componentOriginal0df8641fc6be7d03bbc3b12e975af785; ?>
<?php unset($__componentOriginal0df8641fc6be7d03bbc3b12e975af785); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="item_selected_attributes">
                <?php if(isset($detail) && !is_null($detail) && !is_null($detail->attribute)): ?>
                    <?php $__currentLoopData = $detail->attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                        name="item_attribute_name[<?php echo e($key); ?>][]"
                                        value="<?php echo e($attribute->attribute_name); ?>" readonly />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                        name="item_attribute_value[<?php echo e($key); ?>][]"
                                        value="<?php echo e($attribute->attribute_value); ?>" readonly />
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-danger remove_details_attribute" data-id="<?php echo e($attribute->id); ?>">
                                    x
                                </button>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="row g-4 align-items-end">
                <div class="col">
                    <div class="form-group">
                        <label><?php echo e(__('Attribute Name')); ?></label>
                        <select name="item_attribute_name[]" class="form-control select2 item_attribute_name">
                            <option value=""><?php echo e(__('Select Attribute')); ?></option>
                            <?php $__currentLoopData = $allAvailableAttributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($attribute->id); ?>" data-terms="<?php echo e($attribute->terms); ?>">
                                    <?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label><?php echo e(__('Attribute Value')); ?></label>
                        <select name="item_attribute_value[]" class="form-control select2 item_attribute_value">
                            <option value=""><?php echo e(__('Select attribute value')); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-auto text-center">
                    <button type="button" class="btn btn-success add_item_attribute">
                        <i class="las la-arrow-up"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="item_repeater_add_remove">
                <div class="repeater_button">
                    <button type="button" class="btn btn-success btn-xs add">
                        <i class="las la-plus"></i>
                    </button>
                </div>

                <?php if(!isset($isFirst) || !$isFirst): ?>
                    <div class="repeater_button mt-2">
                        <button type="button" class="btn btn-danger btn-xs remove">
                            <i class="las la-trash-alt"></i>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-12">
            <p class="mt-2">
                <?php echo e(__('Click on the up arrow button beside attribute select after selecting the attribute')); ?></p>
            <p class="attribute-warning">
                <?php echo e(__('In a variant, you cannot select the same attribute more than once, so please create a new variant if you need to do so')); ?>

            </p>
        </div>
    </div>
</div>


<?php if(isset($not_needed)): ?>
    <div class="variant_variant_info_repeater">
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="variant_color"><?php echo e(__('Color')); ?></label>
                    <?php if(isset($variantId)): ?>
                        <input type="hidden" class="variant_id" name="variant_id[]" value="<?php echo e($variantId); ?>">
                    <?php endif; ?>
                    <select class="form-control" name="variant_color[]" id="variant_color">
                        <option value=""><?php echo e(__('Select Color')); ?></option>
                        <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($color->id); ?>" <?php if(isset($selectedColor) && $selectedColor->id == $color->id): ?> selected <?php endif; ?>>
                                <?php echo e($color->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="variant_size"><?php echo e(__('Size')); ?></label>
                    <select class="form-control" name="variant_size[]" id="variant_size">
                        <option value=""><?php echo e(__('Select Size')); ?></option>
                        <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($size->id); ?>" <?php if(isset($selectedSize) && $selectedSize->id == $size->id): ?> selected <?php endif; ?>>
                                <?php echo e($size->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="variant_stock_count"><?php echo e(__('Quantity')); ?></label>
                    <input type="number" name="variant_stock_count[]" id="variant_stock_count" class="form-control"
                        step="0.01" <?php if(isset($quantity)): ?> value="<?php echo e($quantity); ?>" <?php endif; ?>>
                </div>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-sm btn-success add_variant_info_btn"><i
                        class="las la-plus"></i>
                </button>
                <?php if($loop != 1): ?>
                    <button type="button"
                        class="btn btn-sm btn-danger remove_this_variant_info_btn <?php if(isset($variantId)): ?> remove_variant <?php endif; ?>"
                        <?php if(isset($isFirst) && $isFirst): ?> readonly <?php endif; ?>><i class="las la-trash-alt"></i>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/components/variant-info/repeater.blade.php ENDPATH**/ ?>