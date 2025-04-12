<?php $__env->startSection("style"); ?>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
        .card {position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 0.10rem }
        .card-header:first-child {border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0 }
        .card-header {padding: 0.75rem 1.25rem;margin-bottom: 0;background-color: #fff;border-bottom: 1px solid rgba(0, 0, 0, 0.1) }
        .track {position: relative;background-color: #ddd;height: 5px;display: -webkit-box;display: -ms-flexbox;display: flex;margin-top: 30px;}
        .track .step {-webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;width: 25%;margin-top: -13px;text-align: center;position: relative }
        .track .step.active:before {background: #FF5722 }.track .step::before {height: 5px;position: absolute;content: "";width: 100%;left: 0;top: 13px;}
        .track .step.active .icon {background: #ee5435;color: #fff }
        .track .icon {display: inline-block;width: 30px;height: 30px;line-height: 30px;position: relative;border-radius: 100%;background: #ddd }
        .track .step.active .text {font-weight: 400;color: #000 }
        .track .text {display: block;margin-top: 7px }.itemside {position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100% }
        .itemside .aside {position: relative;-ms-flex-negative: 0;flex-shrink: 0 }.img-sm {width: 80px;height: 80px;padding: 7px }
        ul.row, ul.row-sm {list-style: none;padding: 0 }.itemside .info {padding-left: 15px;padding-right: 7px }
        .itemside .title {display: block;margin-bottom: 5px;color: #212529 }p {margin-top: 0;margin-bottom: 1rem }
        .btn-warning {color: #ffffff;background-color: #ee5435;border-color: #ee5435;border-radius: 1px }
        .btn-warning:hover {color: #ffffff;background-color: #ff2b00;border-color: #ff2b00;border-radius: 1px }
        .d-flex.gap-4.justify-content-center .form-group {
            width: 25%;
        }
        .dashboard__card{
            display: flex;
            align-items: center;
            flex-direction: column;
            width: 100%;
        }

        .dashboard__card > div {
            width: 100%
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Payment Success')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="patment-success-area padding-top-100 padding-bottom-50">
        <div class="container">
            <div class="row padding-bottom-50">
                <div class="col-lg-12">
                    <div class="content text-center">
                        <img src="<?php echo e(asset('assets/frontend/img/icon/check-icon.svg')); ?>" alt="icon">
                        <h2 class="page-status-title margin-top-40"><?php echo e(__('Your order is Completed!')); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="payment-success-wrapper">
                        <div class="payment-contents">
                            <h4 class="title"><div class="icon"> <?php echo e(__('Payment Successful')); ?>  <i class="las la-check text-success"></i> </div>
                            </h4>

                            <ul class="payment-list margin-top-40">
                                <li><?php echo e(__('Payment Gateway')); ?>: <span class="payment-strong"><?php echo e(render_payment_gateway_name($payment_details->payment_gateway)); ?></span></li>
                                <li><?php echo e(__('Phone')); ?>: <span class="payment-strong"><?php echo e($payment_details->address->phone); ?></span></li>
                                <li><?php echo e(__('Name')); ?>: <span class="payment-strong"><?php echo e($payment_details->address->name); ?></span></li>
                                <li><?php echo e(__('Email')); ?>: <span class="payment-strong"><?php echo e($payment_details->address->email); ?></span></li>
                            </ul>

                            <ul class="payment-list payment-list-two margin-top-30">
                                <li><span class="list-bold"><?php echo e(__('Amount Paid')); ?>: </span> <span class="payment-strong payment-bold"><?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta->total_amount)); ?></span></li>
                                <li><?php echo e(__('Transaction ID')); ?>: <span class="payment-strong"><?php echo e($payment_details->transaction_id); ?></span></li>
                            </ul>

                            <div class="btn-wrapper margin-top-40">
                                <?php if(auth('web')->check()): ?>
                                    <a href="<?php echo e(route('user.home')); ?>" class="default-btn color-one"><?php echo e(__('Go to Dashboard')); ?></a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('homepage')); ?>" class="btn btn-primary outline-one"><?php echo e(__('Back to Home')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    
                    <?php if (isset($component)) { $__componentOriginal72d30dca238bfde3c546b1120597c5fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72d30dca238bfde3c546b1120597c5fe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'order::components.order-track','data' => ['order' => $payment_details,'disableForm' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('order::order-track'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['order' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($payment_details),'disable-form' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72d30dca238bfde3c546b1120597c5fe)): ?>
<?php $attributes = $__attributesOriginal72d30dca238bfde3c546b1120597c5fe; ?>
<?php unset($__attributesOriginal72d30dca238bfde3c546b1120597c5fe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72d30dca238bfde3c546b1120597c5fe)): ?>
<?php $component = $__componentOriginal72d30dca238bfde3c546b1120597c5fe; ?>
<?php unset($__componentOriginal72d30dca238bfde3c546b1120597c5fe); ?>
<?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="order-completed-area-wrapper padding-top-50 padding-bottom-100">
        <div class="container">
            <div class="row padding-bottom-50">
                <div class="col-lg-12">
                    <div class="order-data">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('order number')); ?></th>
                                    <th><?php echo e(__('date')); ?></th>
                                    <th><?php echo e(__('Sub Total')); ?></th>
                                    <th><?php echo e(__('Shipping Cost')); ?></th>
                                    <th><?php echo e(__('Tax Amount')); ?></th>
                                    <th><?php echo e(__('Discount amount')); ?></th>
                                    <th><?php echo e(__('Payable Amount')); ?></th>
                                    <th><?php echo e(__('payment method')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#<?php echo e($payment_details->id); ?></td>
                                    <td><?php echo e($payment_details->created_at->format('d/m/Y')); ?></td>
                                    <td><?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta?->sub_total)); ?></td>
                                    <td><?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta?->shipping_cost)); ?></td>
                                    <td><?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta?->tax_amount)); ?></td>
                                    <td><?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta?->coupon_amount)); ?></td>
                                    <td><?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta?->total_amount)); ?></td>
                                    <td><?php echo e(str_replace('_', ' ', render_payment_gateway_name($payment_details->payment_gateway))); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="order-complete-wrap">
                        <h4 class="title"><?php echo e(__('order details')); ?></h4>

                        <div class="checkout-page-content-wrapper mt-4">
                            <?php
                                $adminShopManage = \App\AdminShopManage::first();
                                $itemsTotal = null;
                            ?>

                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card mb-3">
                                    <?php
                                        $subtotal = null;
                                        $default_shipping_cost = null;

                                    ?>

                                    <div class="card-header">
                                        <?php echo e(__("ITEM")); ?> <?php echo e($order?->orderItem?->count()); ?> <br>
                                        <?php echo e(__("Sold By:")); ?> <?php echo e($order->vendor?->business_name ?? $adminShopManage?->store_name); ?>

                                    </div>

                                    <div class="card-body">
                                        <?php $__currentLoopData = $order?->orderItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $prd_image = $orderItem->product->image;

                                                if(!empty($orderItem->variant?->attr_image)){
                                                    $prd_image = $orderItem->variant->attr_image;
                                                }
                                            ?>

                                            <div class="check-cart-flex-contents justify-content-between d-flex mb-2">
                                                <div class="checkout-cart-thumb" style="width: 80px">
                                                    <?php echo render_image($prd_image, class: 'w-100'); ?>

                                                </div>
                                                <div class="checkout-cart-img-contents">
                                                    <h6 class="checkout-cart-title fs-18"> <a href="#1"> <?php echo e(Str::words($orderItem->product->name, 5)); ?> </a>
                                                        <p>
                                                            <?php echo e($orderItem?->variant?->productColor ? __("Color:") . $orderItem?->variant?->productColor?->name . ' , ' : ""); ?>

                                                            <?php echo e($orderItem?->variant?->productSize ? __("Size:") . $orderItem?->variant?->productSize?->name . ' , ' : ""); ?>

                                                            <?php $__currentLoopData = $orderItem?->variant?->attribute ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php echo e($attr->attribute_name); ?>

                                                                : <?php echo e($attr->attribute_value); ?>


                                                                <?php if(!$loop->last): ?>
                                                                    ,
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </p>
                                                    </h6>
                                                </div>
                                                <span class="d-block product-items w-10"> <?php echo e($orderItem->quantity ?? "0"); ?> <?php echo e(__("QTY")); ?> </span>

                                                <div class="d-flex gap-2 w-20">
                                                    <del class="checkout-cart-price color-heading fw-500"> <?php echo e(amount_with_currency_symbol($orderItem->sale_price)); ?> </del>
                                                    <b class="checkout-cart-price color-heading fw-500 font-weight-bold"> <?php echo e(amount_with_currency_symbol($orderItem->price)); ?> </b>
                                                </div>
                                            </div>

                                            <?php
                                                $subtotal += $orderItem->sale_price * $orderItem->quantity;
                                                $itemsTotal += $orderItem->sale_price * $orderItem->quantity;
                                            ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <div class="card-footer">
                                        <div class="d-flex justify-content-end">
                                            <div style="width: 30%">
                                                <div class="">
                                                    <div class="d-flex justify-content-between">
                                                        <b><?php echo e(__("Sub Total")); ?></b> <b id="vendor_subtotal"><?php echo e(float_amount_with_currency_symbol($order->total_amount)); ?></b>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <b><?php echo e(__("Tax Amount")); ?></b> <b id="vendor_tax_amount">
                                                            <?php if($order->tax_type == "inclusive_price"): ?>
                                                                <?php echo e(__("Inclusive Tax")); ?>

                                                            <?php else: ?>
                                                                <?php echo e(float_amount_with_currency_symbol($order->tax_amount)); ?>

                                                            <?php endif; ?>
                                                        </b>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <b><?php echo e(__("Shipping Cost")); ?></b> <b id="vendor_shipping_cost"><?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta?->shipping_cost)); ?></b>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <b><?php echo e(__("Total")); ?></b> <b id="vendor_total"><?php echo e(float_amount_with_currency_symbol($order->total_amount + $payment_details->paymentMeta?->shipping_cost + $order->tax_amount)); ?></b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-wrapper text-right">
                        <a href="<?php echo e(route('homepage')); ?>" class="btn btn-success rounded-btn semi-bold"><?php echo e(__('back to home')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/payment/payment-success.blade.php ENDPATH**/ ?>