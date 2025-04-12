<?php $__env->startSection('site-title', __('Tax Class')); ?>

<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div>
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
    </div>

    <div class="row g-4">
        <div class="col-md-7">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <div class="dashboard__card__header__left">
                        <h3 class="dashboard__card__title"><?php echo e(__('Manage Tax Class')); ?></h3>
                        <small class="text-secondary mt-1">
                            <?php echo e(__("if a class have any you can't delete class from hare you need to delete all options first or you can force for delete")); ?>

                        </small>
                    </div>
                </div>
                <div class="dashboard__card__body mt-4">
                    <div class="table-wrap">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('SL NO')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($class->name); ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm"
                                                href="<?php echo e(route('admin.tax-module.tax-class-option', $class->id)); ?>"><?php echo e(__('View')); ?></a>
                                            <button data-id="<?php echo e($class->id); ?>" data-name="<?php echo e($class->name); ?>"
                                                id="updateTaxClassButton" class="btn btn-primary btn-sm"
                                                data-bs-target="#updateTaxClass"
                                                data-bs-toggle="modal"><?php echo e(__('Edit')); ?></button>
                                            <button id="deleteTaxClassButton" data-id="<?php echo e($class->id); ?>"
                                                data-option-count="<?php echo e($class->class_option_count); ?>"
                                                data-href="<?php echo e(route('admin.tax-module.tax-class-delete', $class->id)); ?>"
                                                class="btn btn-danger btn-sm"><?php echo e(__('Delete')); ?></button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h3 class="dashboard__card__title"><?php echo e(__('Create tax class')); ?></h3>
                </div>
                <div class="dashboard__card__body custom__form mt-4">
                    <form action="<?php echo e(route('admin.tax-module.tax-class')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="#tax-class-name" class="form-label"><?php echo e(__('Name')); ?></label>
                            <input name="name" type="text" class="form-control"
                                placeholder="<?php echo e(__('Write tax class name')); ?>" />
                        </div>

                        <div class="form-group">
                            <button class="cmn_btn btn_bg_profile"><?php echo e(__('Create')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateTaxClass" tabindex="-1" aria-labelledby="exampleUpdateTaxClass" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content custom__form">
                <form action="<?php echo e(route('admin.tax-module.tax-class')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <input type="hidden" name="id" value="" id="tax-class-id" class="form-control">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Update tax class')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="#update-tax-class-name" class="form-label"><?php echo e(__('Name')); ?></label>
                            <input id="update-tax-class-name" name="name" type="text" class="form-control"
                                placeholder="<?php echo e(__('Write tax class name')); ?>" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).on("click", "#updateTaxClassButton", function() {
            $("#updateTaxClass #tax-class-id").val($(this).attr("data-id"));
            $("#updateTaxClass #update-tax-class-name").val($(this).attr("data-name"));

        })
        $(document).on("click", "#deleteTaxClassButton", function() {
            let countOption = $(this).attr("data-option-count");
            let formData = new FormData();
            formData.append("_method", "DELETE");
            formData.append("_token", "<?php echo e(csrf_token()); ?>");
            formData.append("id", $(this).attr("data-id"));

            if (countOption > 0) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "if delete this tax class then all tax class option will be deleted and You won't be able to revert those!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        send_ajax_request("GET", formData, $(this).data("data-href"), () => {
                            // before send request
                            toastr.warning("Request send please wait while");
                        }, (data) => {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );

                            $(this).parent().parent().remove();
                        }, (data) => {
                            prepare_errors(data);
                        })
                    }
                });
            }

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
                    send_ajax_request("post", formData, $(this).data("data-href"), () => {
                        // before send request
                        toastr.warning("Request send please wait while");
                    }, (data) => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );

                        $(this).parent().parent().remove();
                    }, (data) => {
                        prepare_errors(data);
                    })
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/TaxModule\Resources/views/backend/class/index.blade.php ENDPATH**/ ?>