<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Vendor List')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 dashboard-area">
        <div class="row">
            <div class="col-lg-12">
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
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title"><?php echo e(__('Vendor List')); ?></h4>
                        <div class="dashboard__card__header__right">
                            <a class="cmn_btn btn_bg_profile" href="<?php echo e(route('admin.vendor.create')); ?>"><?php echo e(__('Vendor Create')); ?></a>
                        </div>
                    </div>
                    <div class="dashboard__card__body dashboard-recent-order mt-4">
                        <div class="table-wrap dashboard-table">
                            <div class="table-responsive table-responsive--md">
                                <table class="custom--table pt-4" id="myTable">
                                    <thead class="head-bg">
                                        <tr>
                                            <th> <?php echo e(__('SL NO:')); ?> </th>
                                            <th class="min-width-100"> <?php echo e(__('Vendor Info')); ?> </th>
                                            <th class="min-width-250"> <?php echo e(__('Shop Info')); ?> </th>
                                            <th class="min-width-100"> <?php echo e(__('Status')); ?> </th>
                                            <th> <?php echo e(__('Actions')); ?> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="table-cart-row">
                                                <td>
                                                    <?php echo e($loop->iteration); ?>

                                                </td>

                                                <td class="price-td" data-label="Name">
                                                    <div class="vendorList__item">
                                                        <span class="vendorList__label vendor-label"><?php echo e(__('Name:')); ?>

                                                        </span>
                                                        <span class="vendorList__value vendor-value">
                                                            <?php echo e($vendor->owner_name); ?>

                                                        </span>
                                                    </div>
                                                    <div class="vendorList__item">
                                                        <span class="vendorList__label vendor-label"><?php echo e(__('Email:')); ?>

                                                        </span>
                                                        <span class="vendorList__value vendor-value">
                                                            <?php echo e($vendor->vendor_shop_info?->email); ?>

                                                        </span>
                                                    </div>
                                                    <div class="vendorList__item">
                                                        <span
                                                            class="vendorList__label vendor-label"><?php echo e(__('Business Type:')); ?>

                                                        </span>
                                                        <span class="vendorList__value vendor-value">
                                                            <?php echo e($vendor->business_type?->name); ?>

                                                        </span>
                                                    </div>
                                                </td>

                                                <td class="price-td" data-label="Owner Name">
                                                    <div class="vendorList__flex">
                                                        <div class="vendorList__thumb">
                                                            <?php echo \App\Http\Services\Media::render_image($vendor?->vendor_shop_info?->logo, attribute: "style='width:80px'"); ?>

                                                        </div>
                                                        <div class="vendorList__inner">
                                                            <div class="vendorList__item">
                                                                <span
                                                                    class="vendorList__label vendor-label"><?php echo e(__('Shop Name:')); ?>

                                                                </span>
                                                                <span class="vendorList__value vendor-value">
                                                                    <?php echo e($vendor->business_name); ?></span>
                                                            </div>
                                                            <div class="vendorList__item">
                                                                <span
                                                                    class="vendorList__label vendor-label"><?php echo e(__('Shop Number:')); ?>

                                                                </span>
                                                                <span class="vendorList__value vendor-value">
                                                                    <?php echo e($vendor->vendor_shop_info?->number); ?></span>
                                                            </div>
                                                            <?php if(!empty($vendor->commission_type)): ?>
                                                                <div class="vendorList__item">
                                                                    <b class="vendorList__label vendor-label"><?php echo e(__('Commission Type:')); ?>

                                                                    </b>
                                                                    <b class="vendorList__value vendor-value">
                                                                        <?php echo e($vendor->commission_type); ?></b>
                                                                </div>
                                                                <div class="vendorList__item">
                                                                    <b class="vendorList__label vendor-label"><?php echo e(__('Commission Amount:')); ?>

                                                                    </b>
                                                                    <b class="vendorList__value vendor-value">
                                                                        <?php echo e($vendor->commission_amount); ?></b>
                                                                </div>
                                                                <div class="vendorList__item">
                                                                    <b class="vendorList__label vendor-label"><?php echo e(__('Update Commission:')); ?>

                                                                    </b>
                                                                    <button data-vendor-id="<?php echo e($vendor->id); ?>"
                                                                        class="btn btn-sm btn-info update-individual-commission"
                                                                        data-bs-target="#vendor-commission"
                                                                        data-bs-toggle="modal">
                                                                        <i class="las la-pen"></i>
                                                                    </button>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-label="Status">
                                                    <div class="status-dropdown">
                                                        <select data-vendor-id="<?php echo e($vendor->id); ?>" name="status"
                                                            id="vendor-status" class="form-control form-control-sm">
                                                            <?php echo status_option($type = "option",$vendor->status_id); ?>

                                                        </select>
                                                    </div>
                                                </td>

                                                <td data-label="Actions">
                                                    <div class="action-icon">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-details')): ?>
                                                            <a href="#1" data-id="<?php echo e($vendor->id); ?>"
                                                                class="icon vendor-detail" data-bs-toggle="modal"
                                                                data-bs-target="#vendor-details">
                                                                <i class="las la-eye"></i>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-edit')): ?>
                                                            <a href="<?php echo e(route('admin.vendor.edit', $vendor->id)); ?>"
                                                                class="icon"> <i class="las la-pen-alt"></i> </a>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-delete')): ?>
                                                            <a data-vendor-url="<?php echo e(route('admin.vendor.delete', $vendor->id)); ?>"
                                                                href="#1" class="icon delete-row"> <i
                                                                    class="las la-trash-alt"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>

                                <div class="pagination">
                                    <?php echo e($vendors->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-details')): ?>
        <!-- Modal -->
        <div class="modal fade" id="vendor-details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Vendor Details')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vendor-individual-commission-settings')): ?>
        <!-- Modal -->
        <div class="modal fade" id="vendor-commission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="vendorCommission"><?php echo e(__('Vendor Commission')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('admin.vendor.individual-commission-settings')); ?>"
                            id="individual_vendor_commission_settings" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <input type="hidden" value="" name="vendor_id" id="vendor_id" />

                            <div class="form-group">
                                <label for="commission_type"><?php echo e(__('Select commission type')); ?></label>
                                <select name="commission_type" id="commission_type" class="form-control">
                                    <option value=""><?php echo e(__('Select an option')); ?></option>
                                    <option value="fixed_amount"><?php echo e(__('Fixed amount')); ?></option>
                                    <option value="percentage"><?php echo e(__('Percentage')); ?></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="amount"><?php echo e(__('Write percentage.')); ?></label>
                                <input class="form-control form-control-sm" type="number" name="commission_amount"
                                    id="amount" placeholder="<?php echo e(__('Write percentage hare.')); ?>" />
                            </div>

                            <div class="form-group">
                                <button class="cmn_btn btn_bg_profile"><?php echo e(__('Update vendor settings')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="body-overlay-desktop"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).on("click", ".vendor-detail", function(e) {
            let data = new FormData(),
                id = $(this).data("id");
            data.append("id", id);
            data.append("_token", "<?php echo e(csrf_token()); ?>");

            send_ajax_request("post", data, "<?php echo e(route('admin.vendor.show')); ?>", () => {
                // before send request
            }, (data) => {
                // receive success response
                $("#vendor-details .modal-body").html(data);
            }, (data) => {
                prepare_errors(data);
            })
        });


        let previousValue;
        // Store the previous value when the select gains focus
        $(document).on("focus", ".status-dropdown select", function() {
            previousValue = $(this).val();
        });
        // Handle the change event
        $(document).on("change", ".status-dropdown select", function() {
            let selectElement = $(this);
            let selectedValue = selectElement.val();
            if (!confirm("Are you sure to change this vendor status?")) {
                // If the user cancels, revert to the previous value
                selectElement.val(previousValue);
                return;
            }

            // Proceed with the change
            let data = new FormData();
            data.append("_token", "<?php echo e(csrf_token()); ?>");
            data.append("status_id", selectedValue);
            data.append("vendor_id", selectElement.data("vendor-id"));

            send_ajax_request("post", data, "<?php echo e(route('admin.vendor.update-status')); ?>", () => {
                toastr.warning("Request sent, please wait.");
            }, (data) => {
                toastr.success("Vendor Status Changed Successfully");
            }, (data) => {
                prepare_errors(data);
            });
        });


        $(document).on("submit", "#individual_vendor_commission_settings", function(e) {
            e.preventDefault();
            let data = new FormData(e.target);

            send_ajax_request("post", data, $(this).attr("action"), () => {
                toastr.warning('<?php echo e(__('Individual commission updating request is sent.')); ?>');
            }, (response) => {
                ajax_toastr_success_message(response)
            }, (errors) => {
                ajax_toastr_error_message(errors)
            });
        });

        $(document).on("click", ".update-individual-commission", function() {
            let vendor_id = $(this).attr("data-vendor-id");
            $("#individual_vendor_commission_settings  #vendor_id").val(vendor_id)

            send_ajax_request("GET", null, "<?php echo e(route('admin.vendor.get-vendor-commission-information')); ?>/" +
                vendor_id, () => {

                }, (response) => {
                    $("#individual_vendor_commission_settings #commission_type option[value=" + response
                        .commission_type + "]").attr("selected", true);
                    $("#individual_vendor_commission_settings  #amount").val(response.commission_amount);
                }, (errors) => {
                    ajax_toastr_error_message(errors)
                });
        });

        $(document).on("submit", "#individual_vendor_commission_settings", function(e) {
            e.preventDefault();

            send_ajax_request("post", new FormData(e.target), $(this).attr("action"), () => {
                toastr.warning('<?php echo e(__('Individual commission updating request is sent.')); ?>');
            }, (response) => {
                ajax_toastr_success_message(response)
            }, (errors) => {
                ajax_toastr_error_message(errors)
            });
        });
       
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Vendor\Resources/views/backend/index.blade.php ENDPATH**/ ?>