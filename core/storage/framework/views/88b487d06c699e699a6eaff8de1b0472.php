<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Widgets')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/jquery-ui.min.css')); ?>">
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-6">
                <?php if (isset($component)) { $__componentOriginal292f56c7d55035d9ce06be27ba7a6275 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal292f56c7d55035d9ce06be27ba7a6275 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-message','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal292f56c7d55035d9ce06be27ba7a6275)): ?>
<?php $attributes = $__attributesOriginal292f56c7d55035d9ce06be27ba7a6275; ?>
<?php unset($__attributesOriginal292f56c7d55035d9ce06be27ba7a6275); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal292f56c7d55035d9ce06be27ba7a6275)): ?>
<?php $component = $__componentOriginal292f56c7d55035d9ce06be27ba7a6275; ?>
<?php unset($__componentOriginal292f56c7d55035d9ce06be27ba7a6275); ?>
<?php endif; ?>
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
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title"><?php echo e(__('All Widgets')); ?></h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <ul id="sortable_02" class="available-form-field all-widgets sortable_02">
                            <?php echo render_admin_panel_widgets_list(); ?>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="sidebar-list-wrap">
                    <?php echo get_admin_sidebar_list(); ?>

                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
    <script src="<?php echo e(asset('assets/frontend/js/jquery-ui.min.js')); ?>"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                let body_element = $('body');

                $(".sortable").sortable({
                    axis: "y",
                    placeholder: "sortable-placeholder",
                    receive: function(event, ui) {
                        resetOrder(this.id);
                    },
                    stop: function(event, ui) {
                        resetOrder(this.id);
                    }
                }).disableSelection();

                $(".sortable_02").sortable({
                    connectWith: '.sortable_widget_location',
                    helper: "clone",
                    remove: function(e, li) {
                        let Item = li.item.length > 0 ? li.item[0] : li.item;
                        let widgetName = Item.getAttribute('data-name');
                        let markup = '';
                        $.ajax({
                            'url': "<?php echo e(route('admin.widgets.markup')); ?>",
                            'type': "POST",
                            'data': {
                                '_token': "<?php echo csrf_token(); ?>",
                                'widget_name': widgetName,
                            },
                            async: false,
                            success: function(data) {
                                markup = data;
                            }
                        });
                        // markup += '</div>'; //end content div
                        li.item.clone()
                            .html(markup)
                            .insertAfter(li.item);
                        $(this).sortable('cancel');
                        return markup;
                    }
                }).disableSelection();

                body_element.on('click', '.remove-widget', function(e) {
                    $(this).parent().remove();
                    $(".sortable_02").sortable("refreshPositions");
                    let parent = $(this).parent();
                    let widgetType = parent.find('input[name="widget_type"]').val();
                    resetOrder();

                    if (widgetType === 'update') {
                        let widget_id = parent.find('input[name="id"]').val();
                        $.ajax({
                            'url': "<?php echo e(route('admin.widgets.delete')); ?>",
                            'type': "POST",
                            'data': {
                                '_token': "<?php echo csrf_token(); ?>",
                                'id': widget_id
                            },
                            success: function(data) {}
                        });
                    }
                });

                body_element.on('click', '.expand', function(e) {
                    $(this).parent().find('.content-part').toggleClass('show');
                    let expand = $(this).children('i');
                    if (expand.hasClass('ti-angle-down')) {
                        expand.attr('class', 'ti-angle-up');
                    } else {
                        expand.attr('class', 'ti-angle-down');
                    }
                });

                body_element.on('click', '.widget_save_change_button', function(e) {
                    e.preventDefault();
                    let parent = $(this).parent().find('.widget_save_change_button');
                    parent.text('Saving...').attr('disabled', true);
                    let formClass = $(this).parent();
                    let formData = formClass.serializeArray();
                    let widgetType = $(this).parent().find('input[name="widget_type"]').val();
                    let formAction = $(this).parent().attr('action');
                    let updateId = '';
                    let formContainer = $(this).parent();

                    $.ajax({
                        type: "POST",
                        url: formAction,
                        data: formClass.serializeArray(),
                        success: function(data) {
                            updateId = data.id;
                            if (widgetType === 'new') {
                                formContainer.attr('action',
                                    "<?php echo e(route('admin.widgets.update')); ?>")
                                formContainer.find('input[name="widget_type"]').val(
                                    'update');
                                formContainer.prepend(
                                    '<input type="hidden" name="id" value="' +
                                    updateId + '">');
                            }
                        }
                    });
                    parent.text('saved..');
                    setTimeout(function() {
                        parent.text('Save Changes').attr('disabled', false);
                    }, 1000);
                });

                /**
                 * reset order function
                 **/
                function resetOrder(droppedOn) {
                    let allItems = $('#' + droppedOn + ' li');
                    $.each(allItems, function(index, value) {
                        $(this).find('input[name="widget_order"]').val(index + 1);
                        $(this).find('input[name="widget_location"]').val(droppedOn);
                        let id = $(this).find('input[name="id"]').val();
                        let widget_order = index + 1;
                        if (typeof id != 'undefined') {
                            reset_db_order(id, widget_order);
                        }
                    });
                }

                /**
                 * reorder function
                 **/
                function reset_db_order(id, widget_order) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(route('admin.widgets.update.order')); ?>",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            id: id,
                            widget_order: widget_order
                        },
                        success: function(data) {
                            //response ok if it saved success
                        }
                    });
                }
            });
            $(document).on('click', '.widget-area-expand', function(e) {
                e.preventDefault();
                let widget_body = $(this).parent().parent().find('.widget-area-body');
                widget_body.toggleClass('hide');
                let expand = $(this).children('i');
                if (expand.hasClass('ti-angle-down')) {
                    expand.attr('class', 'ti-angle-up');
                } else {
                    expand.attr('class', 'ti-angle-down');
                    let allWidgets = $(this).parent().parent().find('.widget-area-body ul li');
                    $.each(allWidgets, function(value) {
                        $(this).find('.content-part').removeClass('show');
                    });
                }
            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/backend/widgets/widget-index.blade.php ENDPATH**/ ?>