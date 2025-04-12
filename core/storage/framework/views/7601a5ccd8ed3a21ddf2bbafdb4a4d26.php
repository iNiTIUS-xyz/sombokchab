<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d)): ?>
<?php $attributes = $__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d; ?>
<?php unset($__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d)): ?>
<?php $component = $__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d; ?>
<?php unset($__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d); ?>
<?php endif; ?>
    <style>
        .card img{
            height: 110px;
        }

        .font-size-14{
            font-size: 14px;
        }

        .d-flex.gap-2{
            justify-content: unset;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title', __('Order Details')); ?>

<?php $__env->startSection('content'); ?>
    <div class="row g-4">
        <?php if($subOrders->vendor): ?>
            <div class="col-md-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title"><?php echo e(__("Vendor Information")); ?></h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="row g-4">
                            <div class="col-md-2 col-sm-2">
                                <?php echo render_image($subOrders?->vendor?->logo); ?>

                            </div>
                            <div class="col-md-5 col-sm-5">
                                <div class="px-0">
                                    <h5 class="dashboard__card__title"><?php echo e($subOrders?->vendor?->business_name); ?></h5>
                                    <p class="dashboard__card__para card-text mt-2">
                                        <b><?php echo e($subOrders?->vendor?->owner_name); ?></b> (<?php echo e($subOrders?->vendor?->username); ?>)
                                    </p>
                                    <p class="dashboard__card__para card-text mt-2">
                                        <?php echo e(strip_tags($subOrders?->vendor?->description)); ?>

                                    </p>

                                    <div class="d-flex mt-2">
                                        <b><?php echo e(__("Total Income")); ?> </b>
                                        <h6 style="margin-left: 10px"><?php echo e(float_amount_with_currency_symbol($subOrders?->vendor?->total_earning)); ?></h6>
                                    </div>
                                </div>

                                <?php if(auth('vendor')->check()): ?>
                                    <?php if($subOrders->order_status !== 'order_cancelled'): ?>
                                        <?php if($subOrders->order_status == 'pending'): ?>
                                            <div class="d-flex gap-2 mt-2">
                                                <button class="btn btn-sm btn-primary approve-order-for-delivery"><?php echo e(__("Approve order for delivery")); ?></button>
                                                <button class="btn btn-sm btn-danger cancel-order"><?php echo e(__("Cancel Order")); ?></button>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($subOrders->order_status !== 'pending' && $subOrders->order_status !== 'product_sent_to_admin'): ?>
                                            <div class="d-flex gap-2 mt-2">
                                                <button class="btn btn-sm btn-primary product-sent-to-admin"><?php echo e(__("Product sent to admin")); ?></button>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="d-flex gap-2 mt-2">
                                            <button disabled class="btn btn-sm btn-danger"><?php echo e(__("You've cancelled this order")); ?></button>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-4 col-sm-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <b><?php echo e(__("Total Product")); ?></b>
                                    <h6><?php echo e($subOrders?->vendor?->product_count); ?></h6>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <b><?php echo e(__("Total Orders")); ?></b>
                                    <h6><?php echo e($subOrders?->vendor?->pending_order); ?></h6>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <b><?php echo e(__("Pending Orders")); ?></b>
                                    <h6><?php echo e($subOrders?->vendor?->pending_order); ?></h6>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <b><?php echo e(__("Complete Orders")); ?></b>
                                    <h6><?php echo e($subOrders?->vendor?->complete_order); ?></h6>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <h4 class="my-3 dashboard__card__title"><?php echo e(__("Order Status")); ?></h4>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <b><?php echo e(__("Your Last order status")); ?></b>
                                    <h6 class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                            $subOrders->order_status === 'order_cancelled' => 'text-danger',
                                        ]); ?>">
                                        <?php echo e(ucfirst(str_replace(["_","-"]," ",$subOrders->order_status))); ?>

                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-12">
                                <p><b><?php echo e(__("Note:")); ?></b> <?php echo e(__("You can approve order or cancel order if you do this then your order status will be changed once you approved then you can change status for order item sent to admin")); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-md-6">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title"><?php echo e(__("Order Information")); ?></h4>
                </div>
                <div class="dashboard__card__body mt-4">
                    <div class="d-flex justify-content-between mb-2">
                        <b><?php echo e(__("Sub Order ID")); ?></b>
                        <h6>#<?php echo e($subOrders->id); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <b><?php echo e(__("Transaction ID")); ?></b>
                        <h6><?php echo e($subOrders->order?->transaction_id); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <b><?php echo e(__("Payment Gateway")); ?></b>
                        <h6><?php echo e(ucwords(str_replace(["_", "-"]," ",$subOrders->order?->payment_gateway))); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <b><?php echo e(__("Payment Status")); ?></b>
                        <h6><?php echo e(str($subOrders->order?->order_status)->ucfirst()); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <b><?php echo e(__("Total Product")); ?></b>
                        <h6><?php echo e($subOrders->order_item_count); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <b><?php echo e(__("Total Cost")); ?></b>
                        <h6><?php echo e(float_amount_with_currency_symbol($subOrders->total_amount)); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <b><?php echo e(__("Shipping Cost")); ?></b>
                        <h6><?php echo e(float_amount_with_currency_symbol($subOrders->shipping_cost)); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <b><?php echo e(__("Tax Amount")); ?></b>
                        <h6><?php echo e(float_amount_with_currency_symbol($subOrders->tax_amount)); ?></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title"><?php echo e(__("Billing Information")); ?></h4>
                </div>
                <div class="dashboard__card__body mt-4">
                    <div class="d-flex justify-content-between mb-3">
                        <b><?php echo e(__("Name")); ?></b>
                        <h6><?php echo e($subOrders->order?->address?->name); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <b><?php echo e(__("Email")); ?></b>
                        <h6><?php echo e($subOrders->order?->address?->email); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <b><?php echo e(__("Mobile")); ?></b>
                        <h6><?php echo e($subOrders->order?->address?->phone); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <b><?php echo e(__("Country")); ?></b>
                        <h6><?php echo e($subOrders->order?->address?->country?->name); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <b><?php echo e(__("State")); ?></b>
                        <h6><?php echo e($subOrders->order?->address?->state?->name); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <b><?php echo e(__("City")); ?></b>
                        <h6><?php echo e($subOrders->order?->address?->cityInfo?->name); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <b><?php echo e(__("Zip Code")); ?></b>
                        <h6><?php echo e($subOrders->order?->address?->zipcode); ?></h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title"><?php echo e(__("Order Items")); ?></h4>
                </div>
                <div class="dashboard__card__body mt-4">
                    <div class="table-wrapper table-wrap">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th><?php echo e(__("SL NO:")); ?></th>
                                    <th style="width: 60px"><?php echo e(__("Image")); ?></th>
                                    <th><?php echo e(__("Info")); ?></th>
                                    <th><?php echo e(__("QTY")); ?></th>
                                    <th><?php echo e(__("Price")); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $subOrders->orderItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $product = $subOrders->product->find($item->product_id);
                                        $variant = $subOrders->productVariant->find($item->variant_id);
                                    ?>

                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo render_image($product->image, class: 'w-100 h-100'); ?></td>
                                        <td>
                                            <h6><?php echo e($product->name); ?></h6>
                                            <?php if($variant): ?>
                                                <p>
                                                    <?php if($variant->productColor): ?>
                                                        <?php echo e($variant->productColor->name); ?>,
                                                    <?php endif; ?>
                                                    <?php if($variant->productSize): ?>
                                                        <?php echo e($variant->productSize->name); ?>

                                                    <?php endif; ?>

                                                    <?php $__currentLoopData = $variant->attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        , <?php echo e($attr->attribute_name); ?>: <?php echo e($attr->attribute_value); ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e($item->quantity); ?>

                                        </td>
                                        <td><?php echo e(float_amount_with_currency_symbol($item->price)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).on("click", ".approve-order-for-delivery", function (){
            let el = $(this);

            let formData = new FormData();
            formData.append('order_status', "approved_order_status");
            formData.append('_token', "<?php echo e(csrf_token()); ?>");

            el.attr('disabled', true)

            Swal.fire({
                position: 'center',
                icon: "warning",
                title: "Are you sure to change this status?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Update",
            }).then(function (result){
                if (result.isConfirmed) {
                    send_ajax_request("POST",formData, "<?php echo e(route("vendor.orders.update-order-status", $subOrders->id)); ?>", () => {}, (response) => {
                        el.removeAttr('disabled')

                        ajax_toastr_success_message(response)

                        setTimeout(function (){
                            window.location.reload()
                        }, 1500)
                    }, (errors) => {
                        el.removeAttr('disabled')

                        prepare_errors(errors)
                    })
                }else{
                    el.removeAttr('disabled')
                }
            })
        })
        $(document).on("click", ".product-sent-to-admin", function (){
            let el = $(this);

            let formData = new FormData();
            formData.append('order_status', "product_sent_to_admin");
            formData.append('_token', "<?php echo e(csrf_token()); ?>");

            el.attr('disabled', true)

            Swal.fire({
                position: 'center',
                icon: "warning",
                title: "Are you sure to change this status?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Update",
            }).then(function (result) {
                if (result.isConfirmed) {
                    send_ajax_request("POST",formData, "<?php echo e(route("vendor.orders.update-order-status", $subOrders->id)); ?>", () => {}, (response) => {
                        el.removeAttr('disabled')

                        ajax_toastr_success_message(response)

                        setTimeout(function (){
                            window.location.reload()
                        }, 1500)
                    }, (errors) => {
                        el.removeAttr('disabled')

                        prepare_errors(errors)
                    })
                }else{
                    el.removeAttr('disabled')
                }
            });
        })
        $(document).on("click", ".cancel-order", function (){
            let el = $(this);

            let formData = new FormData();
            formData.append('order_status', "order_cancelled");
            formData.append('_token', "<?php echo e(csrf_token()); ?>");

            el.attr('disabled', true)

            Swal.fire({
                position: 'center',
                icon: "warning",
                title: "Are you sure to change this status?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Update",
            }).then(function (result) {
                if (result.isConfirmed) {
                    send_ajax_request("POST", formData, "<?php echo e(route("vendor.orders.update-order-status", $subOrders->id)); ?>", () => {
                    }, (response) => {
                        el.removeAttr('disabled')

                        ajax_toastr_success_message(response)

                        setTimeout(function () {
                            window.location.reload()
                        }, 1500)
                    }, (errors) => {
                        el.removeAttr('disabled')

                        prepare_errors(errors)
                    })
                }else{
                    el.removeAttr('disabled')
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.vendor-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Order\Resources/views/vendor/details.blade.php ENDPATH**/ ?>