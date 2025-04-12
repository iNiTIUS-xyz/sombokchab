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
        .product-image {
            width: 60px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('My Orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('section'); ?>
    <?php if($order->refund_request_count < 1): ?>
        <div class="form-header-wrap d-flex justify-content-between">
            <h3 class="title__two"><?php echo e(__('Order Details')); ?></h3>
        </div>
        <div class="order-items-wrapper">
            <div class="order__refund__item">
                <div class="row g-4 justify-content-between">
                    <div class="col-xxl-6 col-md-7">
                        <div class="payment-contents">
                            <ul class="payment-list margin-top-40">
                                <li>
                                    <span class="payment-list-left"><?php echo e(__('Payment Gateway')); ?>:</span>
                                    <span
                                        class="payment-list-right"><?php echo e(render_payment_gateway_name($order->payment_gateway)); ?></span>
                                </li>
                                <li>
                                    <span class="payment-list-left"><?php echo e(__('Phone')); ?>:</span>
                                    <span class="payment-list-right"><?php echo e($order->address->phone); ?></span>
                                </li>
                                <li>
                                    <span class="payment-list-left"><?php echo e(__('Name')); ?>:</span>
                                    <span class="payment-list-right"><?php echo e($order->address->name); ?></span>
                                </li>
                                <li>
                                    <span class="payment-list-left"><?php echo e(__('Email')); ?>:</span>
                                    <span class="payment-list-right"><?php echo e($order->address->email); ?></span>
                                </li>
                            </ul>

                            <ul class="payment-list payment-list-two margin-top-30">
                                <li>
                                    <span class="payment-list-left"><?php echo e(__('Amount Paid')); ?></span>
                                    <span
                                        class="payment-list-right"><?php echo e(float_amount_with_currency_symbol($order->paymentMeta->total_amount)); ?>

                                    </span>
                                </li>
                                <li>
                                    <span class="payment-list-left"><?php echo e(__('Transaction ID')); ?></span>
                                    <span class="payment-list-right"><?php echo e($order->transaction_id); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
            <form action="<?php echo e(route('user.product.order.refund', $id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="custom__form">
                    <div class="order__refund__item mt-5">
                        <h4 class="title__two"><?php echo e(__('Only available product for refund')); ?></h4>
                        <div class="order__refund__item__available mt-4">
                            
                            <?php $__currentLoopData = $subOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $order?->orderItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="order__refund__item__available__single">
                                        <input type="hidden" name="product_name[<?php echo e($item->id); ?>]"
                                            value="<?php echo e($item->product?->name); ?>" />
                                        <div class="refunded__product">
                                            <div class="refunded__product__left">
                                                <div class="select-box">
                                                    <input type="checkbox" class="request-product-checkbox"
                                                        name="request_item_id[]" value="<?php echo e($item->id); ?>"
                                                        class="form-check-input" />
                                                </div>
                                                <div class="refunded__product__main">
                                                    <div class="refunded__product__thumb product-image">
                                                        <?php echo render_image($item->product?->image); ?>

                                                    </div>
                                                    <div class="refunded__product__info product-info">
                                                        <h5 class="refunded__product__title"><?php echo e($item->product?->name); ?>

                                                        </h5>
                                                        <p>
                                                            <?php echo e($item?->variant?->productColor ? __('Color:') . $item?->variant?->productColor?->name . ' , ' : ''); ?>

                                                            <?php echo e($item?->variant?->productSize ? __('Size:') . $item?->variant?->productSize?->name . ' , ' : ''); ?>

                                                            <?php $__currentLoopData = $item?->variant?->attribute ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php echo e($attr->attribute_name); ?>

                                                                : <?php echo e($attr->attribute_value); ?>


                                                                <?php if(!$loop->last): ?>
                                                                    ,
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="refunded__product__price__item">
                                                <div class="refunded__product__price__multiply product-quantity">
                                                    <?php echo e($item->quantity); ?> x
                                                    <?php echo e(float_amount_with_currency_symbol($item->price)); ?>

                                                </div>
                                                <div class="refunded__product__price product-quantity">
                                                    <?php echo e(float_amount_with_currency_symbol($item->quantity * $item->price)); ?>

                                                </div>
                                            </div>
                                            <div class="refunded__product__select product-refund-reason">
                                                <select name="refund_reason[<?php echo e($item->id); ?>]" id="refund_reason"
                                                    class="form-control">
                                                    <option value=""><?php echo e(__('Select a reason')); ?></option>
                                                    <?php $__currentLoopData = $refundReasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($reason->id); ?>"><?php echo e($reason->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                                <p class="error-info text-danger"></p>
                                            </div>
                                            <div class="refunded__product__quantity product-refund-quantity">
                                                <input name="refund_quantity[<?php echo e($item->id); ?>]" id=""
                                                    class="form-control refunded__product__quantity__input"
                                                    value="<?php echo e($item->quantity); ?>" min="1"
                                                    max="<?php echo e($item->quantity); ?>" />
                                                <p class="error-info text-danger"></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="order__refund__item">
                        <h3 class="title__two"><?php echo e(__('Additional Information')); ?></h3>
                        <div class="order__refund__item__inner mt-4">
                            <div class="row g-4">
                                <div class="col-sm-12">
                                    <div class="form-group additional-information-wrapper">
                                        <label class="form-label"
                                            for="#additional-info"><?php echo e(__('Additional Information')); ?></label>
                                        <textarea name="additional_information" id="additional-info" cols="30" rows="4" class="textarea-form"></textarea>
                                        <p class="error-info text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label"
                                            for="#courier_address"><?php echo e(__('Courier Address')); ?></label>
                                        <textarea disabled readonly name="courier_address" id="courier_address" cols="30" rows="4"
                                            class="textarea-form"><?php echo e(get_static_option('courier_address')); ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group preferred-option-wrapper">
                                        <label class="form-label"
                                            for="#additional-info"><?php echo e(__('Set Preferred option')); ?></label>
                                        <select class="form-control" name="preferred_option" id="preferred_option">
                                            <option value=""><?php echo e(__('Select preferred option')); ?>

                                            </option>
                                            <?php $__currentLoopData = $refundPreferredOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option data-fields="<?php echo e(json_encode(unserialize($option->fields))); ?>"
                                                    value="<?php echo e($option->id); ?>"><?php echo e($option->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <p class="error-info text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label"
                                            for="#additional-info"><?php echo e(__('Upload images')); ?></label>
                                        <input type="file" name="files[]" id="" multiple max="6"
                                            class="form-control-file" />
                                    </div>
                                </div>
                                <div class="col-md-12 preferred-method-fields"></div>
                                <div class="col-md-12">
                                    <div class="form-group d-flex justify-content-end">
                                        <button type="submit"
                                            class="cmn_btn btn_bg_profile refund_request_button"><?php echo e(__('Request to refund')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12 text-center py-5">
                <h2 class="title py-5 text-danger"><?php echo e(__('You have already requested for refund')); ?></h2>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.bodyUser_overlay', function() {
                $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
            });
            $(document).on('click', '.mobile_nav', function() {
                $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
            });
        });
        $(document).on("change", "#preferred_option", function() {
            let preferredMethods = '',
                fields = JSON.parse($(this).find("option:selected").attr("data-fields"));

            fields.forEach(function(value, key) {
                let name = value.replace(" ", "_");

                if (name != 'undefined') {
                    preferredMethods = preferredMethods + `
                        <div class="form-group">
                            <label class="form-label">${value.capitalize()}</label>
                            <input class="form-control" name="fields[${name}]" />
                        </div>
                    `;
                }
            })

            $(".preferred-method-fields").html(preferredMethods);
        });

        // $(document).on("click", ".request-product-checkbox", function() {
        //     if ($(this).prop('checked')) {
        //         $(this).parent().parent().addClass("border-info selected-refund-product");
        //     } else {
        //         $(this).parent().parent().removeClass("border-info selected-refund-product");
        //     }
        // });

        $(document).on("click", ".request-product-checkbox", function() {
            if ($(this).prop('checked')) {
                $(this).closest('.refunded__product').addClass("border-info selected-refund-product");
            } else {
                $(this).closest('.refunded__product').removeClass("border-info selected-refund-product");
            }
        });

        $(document).on("click", ".refund_request_button", function() {
            let isDetectError = true;

            $(".request-product-checkbox").each(function() {
                let reasonParent = $(this).parent().parent();
                if ($(this).prop('checked') && reasonParent.find(".product-refund-reason select").val() ===
                    '') {
                    reasonParent.find(".product-refund-reason .error-info").text("Please select a reason")

                    isDetectError = false;
                }

                if (reasonParent.find(".product-refund-quantity input").val() > reasonParent.find(
                        ".product-refund-quantity input").attr('max')) {
                    reasonParent.find(".product-refund-quantity .error-info").text(
                        "Quantity must be equal or less than " + reasonParent.find(
                            ".product-refund-quantity input").attr('max'))

                    isDetectError = false;
                }
            });

            if ($(".request-product-checkbox:checked").length < 1) {
                isDetectError = false;

                toastr.warning("Please select a product first for requesting refund");
            }

            if ($(this).closest("form").find('.preferred-option-wrapper select').val() === '') {
                isDetectError = false;

                $(this).closest("form").find('.preferred-option-wrapper .error-info').text(
                    "Please select preferred option");
            }

            if ($(this).closest("form").find('#additional-info').val() === '') {
                $(this).closest("form").find('.additional-information-wrapper .error-info').text(
                    "Please write add additional information");
            }

            return isDetectError;
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/user/dashboard/order/refund.blade.php ENDPATH**/ ?>