<script>
    (function ($) {
        "use strict"
        $(document).ready(function () {
            $(document).on('click', '.add_variant_info_btn', function () {
                $(this).closest('.variant_info').append(`<?php if (isset($component)) { $__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.variant-info.repeater','data' => ['isFirst' => false,'colors' => $colors,'sizes' => $sizes,'allAvailableAttributes' => $allAttributes]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::variant-info.repeater'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['is-first' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors),'sizes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes),'all-available-attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($allAttributes)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba)): ?>
<?php $attributes = $__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba; ?>
<?php unset($__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba)): ?>
<?php $component = $__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba; ?>
<?php unset($__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba); ?>
<?php endif; ?>`);
            });

            $(document).on('click', '.remove_this_variant_info_btn', function () {
                $(this).closest('.variant_info_repeater').remove();
            });
        });

        $(document).on('click', '.add_item_attribute', function (e) {
            let container = $(this).closest('.inventory_item');
            let attribute_name_field = container.find('.item_attribute_name');
            let attribute_value_field = container.find('.item_attribute_value');
            let attribute_name = attribute_name_field.find('option:selected').text();
            let attribute_value = attribute_value_field.find('option:selected').text();

            let container_id = container.data('id');

            if (!container_id) {
                container_id = 0;
            }

            if (attribute_name_field.val().length && attribute_value_field.val().length) {
                let attribute_repeater = '';
                attribute_repeater += '<div class="row align-items-center">';
                attribute_repeater += '<input type="hidden" name="item_attribute_id[' + container_id + '][]" value="">';
                attribute_repeater += '<div class="col">';
                attribute_repeater += '<div class="form-group">';
                attribute_repeater += '<input type="text" class="form-control" name="item_attribute_name[' + container_id + '][]" value="' + attribute_name + '" readonly />';
                attribute_repeater += '</div>';
                attribute_repeater += '</div>';
                attribute_repeater += '<div class="col">';
                attribute_repeater += '<div class="form-group">';
                attribute_repeater += '<input type="text" class="form-control" name="item_attribute_value[' + container_id + '][]" value="' + attribute_value + '" readonly />';
                attribute_repeater += '</div>';
                attribute_repeater += '</div>';
                attribute_repeater += '<div class="col-auto">';
                attribute_repeater += '<button class="btn btn-danger remove_details_attribute"> x </button>';
                attribute_repeater += '</div>';
                attribute_repeater += '</div>';

                container.find('.item_selected_attributes').append(attribute_repeater);

                attribute_name_field.val('');
                attribute_value_field.val('');
            } else {
                toastr.warning('<?php echo e(__("Select both attribute name and value")); ?>');
            }
        });

        let inventory_item_id = 0;

        $(document).on('click', '.repeater_button .add', function (e) {
            let inventory_item = `<?php if (isset($component)) { $__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.variant-info.repeater','data' => ['colors' => $colors,'sizes' => $sizes,'allAvailableAttributes' => $allAttributes]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::variant-info.repeater'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors),'sizes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes),'all-available-attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($allAttributes)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba)): ?>
<?php $attributes = $__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba; ?>
<?php unset($__attributesOriginal5fce59f0e605ba0cf9a62042ea7014ba); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba)): ?>
<?php $component = $__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba; ?>
<?php unset($__componentOriginal5fce59f0e605ba0cf9a62042ea7014ba); ?>
<?php endif; ?>`;

            if (inventory_item_id < 1) {
                inventory_item_id = $('.inventory_items_container .inventory_item').length;
            }

            $('.inventory_items_container').append(inventory_item);

            // check if there is any element found that contains .inventory_item and data-id=none then update attr
            let inventoryItems = $('.inventory_item:last-child');
            inventoryItems.attr('data-id', Number(inventoryItems.prev().attr('data-id')) + 1)

            $('select').select2();
        });

        $(document).on('click', '.remove_details_attribute', function (e) {
            e.preventDefault();

            $(this).parent().parent().remove();
        })

        $(document).on('click', '.repeater_button .remove', function (e) {
            if($('.repeater_button .remove').length > 1){
                $(this).closest('.inventory_item').remove();
            }
        });

        // listen changes event
        $(document).on('change', '.item_attribute_name', function (){
            // get value from selected value
            let value = $(this).find("option:selected").text();
            // target variant container
            let oldValue = $(this).closest(".inventory_item").find(`input[value="${value}"]`);

            // check old value length is bigger then 0 that mean's this value is already selected
            let attribute_warning = $(this).closest(".inventory_item").find('.attribute-warning');
            attribute_warning.css('color', 'black');

            if(oldValue.length > 0){
                toastr.warning(`<?php echo e(__("In a variant, you cannot select the same attribute more than once, so please create a new variant if you need to do so")); ?>`)
                $(this).find("option").each(function (){
                    $(this).attr("selected", false)
                })
                $(this).find("option:first-child").attr("selected", true);

                attribute_warning.css('color', 'red');

                return false;
            }

            let terms = $(this).find('option:selected').data('terms');
            let terms_html = '<option value=""><?php echo e(__("Select attribute value")); ?></option>';
            terms.map(function (term) {
                terms_html += '<option value="' + term + '">' + term + '</option>';
            });
            $(this).closest('.inventory_item').find('.item_attribute_value').html(terms_html);
        })
    })(jQuery);
</script>
<?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/components/variant-info/js.blade.php ENDPATH**/ ?>