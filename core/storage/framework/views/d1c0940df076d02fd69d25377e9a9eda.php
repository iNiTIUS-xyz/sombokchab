<?php $__env->startSection('site-title', __('Vendor withdraw gateway page')); ?>

<?php $__env->startSection('style'); ?>
    <style>
        .w-90 {
            width: 90%;
        }

        .w-20 {
            width: 20%;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12">
        <div class="row g-4">
            <div class="col-lg-7">
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
                <div class="dashboard__card card__two">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title"><?php echo e(__('Refund preferred options')); ?></h4>
                    </div>
                    <div class="dashboard__card__body">
                        <div class="table-wrap">
                            <table class="table-responsive table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('SL NO:')); ?></th>
                                        <th><?php echo e(__('Gateway Name:')); ?></th>
                                        <th><?php echo e(__('Gateway Fields:')); ?></th>
                                        <th><?php echo e(__('Gateway Status:')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $__currentLoopData = $preferredOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $preferredOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($preferredOption->name); ?></td>
                                            <td><?php echo e(implode(' , ', unserialize($preferredOption->fields))); ?></td>
                                            <td>
                                                <?php if (isset($component)) { $__componentOriginal439bbb984835c787af382f4832e48744 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal439bbb984835c787af382f4832e48744 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-span','data' => ['status' => $preferredOption->status?->name]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('status-span'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($preferredOption->status?->name)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal439bbb984835c787af382f4832e48744)): ?>
<?php $attributes = $__attributesOriginal439bbb984835c787af382f4832e48744; ?>
<?php unset($__attributesOriginal439bbb984835c787af382f4832e48744); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal439bbb984835c787af382f4832e48744)): ?>
<?php $component = $__componentOriginal439bbb984835c787af382f4832e48744; ?>
<?php unset($__componentOriginal439bbb984835c787af382f4832e48744); ?>
<?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refund-preferred-option-update')): ?>
                                                    <button type="button" data-name="<?php echo e($preferredOption->name); ?>"
                                                        data-id="<?php echo e($preferredOption->id); ?>"
                                                        data-status="<?php echo e($preferredOption->status_id); ?>"
                                                        data-blog-filed="<?php echo e(json_encode(unserialize($preferredOption->fields))); ?>"
                                                        class="btn btn-sm btn-info mb-2 me-1 update-gateway"
                                                        data-bs-toggle="modal" data-bs-target="#edit-gateway-modal">
                                                        <i class="ti-pencil"></i>
                                                    </button>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refund-preferred-option-update')): ?>
                                                    <?php if (isset($component)) { $__componentOriginalbda4b33cac0b283685fc5d69625c1b03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbda4b33cac0b283685fc5d69625c1b03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.btn.swal.delete','data' => ['route' => route(
                                                        'admin.refund.preferred-option.delete',
                                                        $preferredOption->id,
                                                    )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table.btn.swal.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route(
                                                        'admin.refund.preferred-option.delete',
                                                        $preferredOption->id,
                                                    ))]); ?>
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
            <div class="col-lg-5">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refund-preferred-option-store')): ?>
                    <div class="dashboard__card card__two">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__title"><?php echo e(__('Refund preferred option create')); ?></h4>
                        </div>
                        <div class="dashboard__card__body custom__form">
                            <form class="" method="POST" action="<?php echo e(route('admin.refund.preferred-option.store')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label class="w-100"><?php echo e(__('Name:')); ?></label>
                                    <input class="form-control" name="gateway_name"
                                        placeholder="<?php echo e(__('Write gateway name...')); ?>">

                                    <small class="info">
                                        <?php echo e(__('If you want to merge refund value to user wallet, then use Wallet like this')); ?><br>
                                        <?php echo e(__('Only for wallet')); ?>

                                    </small>
                                </div>

                                <div class="form-group">
                                    <div class="dashboard__card card__two">
                                        <div class="dashboard__card__header">
                                            <h4 class="dashboard__card__title"><?php echo e(__('Gateway required filed.')); ?></h4>
                                        </div>
                                        <div class="dashboard__card__body">
                                            <div class="form-group row">
                                                <div class="w-90 d-flex align-items-center">
                                                    <input class="form-control" name="filed[]"
                                                        placeholder="<?php echo e(__('Write filed name...')); ?>">
                                                </div>
                                                <div
                                                    class="col-md-1 d-flex flex-column align-items-center justify-content-center pb-2 gap-2">
                                                    <button type="button" class="btn btn-info btn-sm gateway-filed-add">
                                                        <i class="las la-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm gateway-filed-remove">
                                                        <i class="las la-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><?php echo e(__('Select Status')); ?></label>
                                    <select name="status_id" class="form-control">
                                        <option value=""><?php echo e(__('Select Status')); ?></option>
                                        <option value="1"><?php echo e(__('Active')); ?></option>
                                        <option value="2"><?php echo e(__('inactive')); ?></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button class="cmn_btn btn_bg_profile"><?php echo e(__('Create gateway')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="edit-gateway-modal" tabindex="-1" aria-labelledby="edit-gateway-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content custom__form">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('refund-preferred-option-update')): ?>
                    <form class="" method="POST" action="<?php echo e(route('admin.refund.preferred-option.update')); ?>">
                        <?php echo method_field('PUT'); ?>
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="" name="id" />

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Refund preferred option update')); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label class="w-100"><?php echo e(__('Name:')); ?></label>
                                <input class="form-control" name="gateway_name"
                                    placeholder="<?php echo e(__('Write gateway name...')); ?>">

                                <small class="info">
                                    <?php echo e(__('If you want to merge refund value to user wallet, then use Wallet like this')); ?> .
                                    <?php echo e(__('Only for wallet')); ?>

                                </small>
                            </div>
                            <div class="dashboard__card">
                                <div class="dashboard__card__header">
                                    <h4 class="dashboard__card__title"><?php echo e(__('Gateway required filed.')); ?></h4>
                                </div>
                                <div class="card-body gateway-filed-body">

                                </div>
                            </div>

                            <div class="form-group">
                                <label><?php echo e(__('Select Status')); ?></label>
                                <select name="status_id" class="form-control">
                                    <option value=""><?php echo e(__('Select Status')); ?></option>
                                    <option value="1"><?php echo e(__('Active')); ?></option>
                                    <option value="2"><?php echo e(__('inactive')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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
    <script>
        $(document).on("click", ".update-gateway", function() {
            let fileds = JSON.parse($(this).attr("data-blog-filed"));
            $("#edit-gateway-modal input[name='gateway_name']").val($(this).attr("data-name"))
            $("#edit-gateway-modal select[name='status_id'] option[value='" + $(this).attr("data-status") + "']")
                .attr("selected", true);
            $("#edit-gateway-modal input[name='id']").val($(this).attr("data-id"));

            if (fileds.length > 0) {
                let list_filed = "";

                fileds.forEach(function(value, index, array) {
                    list_filed += `
                        <div class="form-group row">
                            <div class="w-90 d-flex align-items-center">
                                <input class="form-control" value="${value}" name="filed[]" placeholder="Write filed name...">
                            </div>
                            <div class="col-md-1 d-flex flex-column align-items-center justify-content-center pb-2 gap-2">
                                <button type="button" class="btn btn-info btn-sm gateway-filed-add">
                                    <i class="las la-plus"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm gateway-filed-remove">
                                    <i class="las la-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    `;
                })

                $(".gateway-filed-body").html(list_filed);
            } else {
                $(".gateway-filed-body").html(`<div class="form-group row">
                    <div class="w-90 d-flex align-items-center">
                        <input class="form-control" name="filed[]" placeholder="Write filed name...">
                    </div>
                    <div class="col-md-1 d-flex flex-column align-items-center justify-content-center pb-2 gap-2">
                        <button type="button" class="btn btn-info btn-sm gateway-filed-add">
                            <i class="las la-plus"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm gateway-filed-remove">
                            <i class="las la-trash-alt"></i>
                        </button>
                    </div>
                </div>`);
            }

        });

        $(document).on("click", ".gateway-filed-add", function() {
            let elem = $(this).parent().parent();
            elem.parent().append(elem.clone());
        });

        $(document).on("click", ".gateway-filed-remove", function() {
            if ($(".gateway-filed-remove").length == 1) {
                return null;
            }
            let elem = $(this).parent().parent().fadeOut(250, () => {
                $(this).parent().parent().remove();
            });
        });

        $(document).on("click", ".update-withdraw-gateway", function(e) {
            e.preventDefault();


            send_ajax_request("PUT")
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Refund\Resources/views/admin/preferred-option/index.blade.php ENDPATH**/ ?>