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
        .card img {
            height: 110px;
        }

        .font-size-14 {
            font-size: 14px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title', __('Order Details')); ?>

<?php $__env->startSection('content'); ?>
    <div class="row g-4">
        <?php if($subOrders->vendor): ?>
            <div class="col-md-12">
                <div class="dashboard__card card__two">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title"><?php echo e(__('Vendor Information')); ?></h4>

                        <div class="d-flex justify-content-between gap-2">
                            <b><?php echo e(__("This order status")); ?></b>
                            <span class="badge <?php echo e($subOrders->order_status === 'order_cancelled' ? 'bg-danger' : 'bg-dark'); ?>">
                                <?php echo e(ucfirst(str_replace(["_","-"]," ",$subOrders->order_status))); ?>

                            </span>
                        </div>
                    </div>
                    <div class="dashboard__card__body">
                        <div class="row g-4 justify-content-between">
                            <div class="col-xxl-6 col-md-6">
                                <div class="subOrder__single">
                                    <div class="subOrder__single__flex">
                                        <div class="subOrder__single__thumb">
                                            <?php echo render_image($subOrders->vendor->logo); ?>

                                        </div>
                                        <div class="subOrder__single__contents">
                                            <h5 class="dashboard__card__title"><?php echo e($subOrders->vendor->business_name); ?></h5>
                                            <p class="subOrder__single__title mt-2">
                                                <strong><?php echo e($subOrders->vendor->owner_name); ?></strong>
                                                (<?php echo e($subOrders->vendor->username); ?>)
                                            </p>
                                            <p class="subOrder__single__para">
                                                <?php echo e(strip_tags($subOrders->vendor->description)); ?>

                                            </p>

                                            <div class="subOrder__single__item no__between">
                                                <span class="subOrder__single__item__left"><?php echo e(__('Total Income')); ?> </span>
                                                <h6 class="subOrder__single__item__right">
                                                    <?php echo e(float_amount_with_currency_symbol($subOrders->vendor->total_earning)); ?>

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-md-6">
                                <div class="subOrder__single__item">
                                    <span class="subOrder__single__item__left"><?php echo e(__('Total Product')); ?></span>
                                    <h6 class="subOrder__single__item__right"><?php echo e($subOrders->vendor->product_count); ?></h6>
                                </div>
                                <div class="subOrder__single__item">
                                    <span class="subOrder__single__item__left"><?php echo e(__('Total Orders')); ?></span>
                                    <h6 class="subOrder__single__item__right"><?php echo e($subOrders->vendor->pending_order); ?></h6>
                                </div>
                                <div class="subOrder__single__item">
                                    <span class="subOrder__single__item__left"><?php echo e(__('Pending Orders')); ?></span>
                                    <h6 class="subOrder__single__item__right"><?php echo e($subOrders->vendor->pending_order); ?></h6>
                                </div>
                                <div class="subOrder__single__item">
                                    <span class="subOrder__single__item__left"><?php echo e(__('Complete Orders')); ?></span>
                                    <h6 class="subOrder__single__item__right"><?php echo e($subOrders->vendor->complete_order); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-6">
            <div class="dashboard__card card__two">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title"><?php echo e(__('Order Information')); ?></h4>
                </div>
                <div class="dashboard__card__body">
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Sub Order ID')); ?></span>
                        <span class="subOrder__single__item__right">#<?php echo e($subOrders->id); ?></span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Transaction ID')); ?></span>
                        <span class="subOrder__single__item__right"><?php echo e($subOrders->order->transaction_id); ?></span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Payment Gateway')); ?></span>
                        <span
                            class="subOrder__single__item__right"><?php echo e(ucwords(str_replace(['_', '-'], ' ', $subOrders->order->payment_gateway))); ?></span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Payment Status')); ?></span>
                        <span
                            class="subOrder__single__item__right"><?php echo e(str($subOrders->order->order_status)->ucfirst()); ?></span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Total Product')); ?></span>
                        <span class="subOrder__single__item__right"><?php echo e($subOrders->order_item_count); ?></span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Total Cost')); ?></span>
                        <span
                            class="subOrder__single__item__right"><?php echo e(float_amount_with_currency_symbol($subOrders->total_amount + $subOrders->shipping_cost + $subOrders->tax_amount)); ?>

                        </span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Shipping Cost')); ?></span>
                        <span
                            class="subOrder__single__item__right"><?php echo e(float_amount_with_currency_symbol($subOrders->shipping_cost)); ?></span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Tax Amount')); ?></span>
                        <?php if($subOrders->tax_type == 'inclusive_price'): ?>
                            <span class="subOrder__single__item__left"><?php echo e(__('Inclusive Tax')); ?></span>
                        <?php else: ?>
                            <span
                                class="subOrder__single__item__right"><?php echo e(float_amount_with_currency_symbol($subOrders->tax_amount)); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="dashboard__card card__two">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title"><?php echo e(__('Billing Information')); ?></h4>
                </div>
                <div class="dashboard__card__body">
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Name')); ?></span>
                        <span class="subOrder__single__item__right">
                            <?php echo e($subOrders->order?->address?->name); ?>

                        </span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Email')); ?></span>
                        <span class="subOrder__single__item__right">
                            <?php echo e($subOrders->order?->address?->email); ?>

                        </span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Mobile')); ?></span>
                        <span class="subOrder__single__item__right">
                            <?php echo e($subOrders->order?->address?->phone); ?>

                        </span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Country')); ?></span>
                        <span class="subOrder__single__item__right">
                            <?php echo e($subOrders->order?->address?->country?->name); ?>

                        </span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('State')); ?></span>
                        <span class="subOrder__single__item__right">
                            <?php echo e($subOrders->order?->address?->state?->name); ?>

                        </span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('City')); ?></span>
                        <span class="subOrder__single__item__right">
                            <?php echo e($subOrders->order?->address?->city); ?>

                        </span>
                    </div>
                    <div class="subOrder__single__item">
                        <span class="subOrder__single__item__left"><?php echo e(__('Zip Code')); ?></span>
                        <span class="subOrder__single__item__right">
                            <?php echo e($subOrders->order?->address?->zipcode); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="dashboard__card card__two">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title"><?php echo e(__('Order Items')); ?></h4>
                </div>
                <div class="dashboard__card__body">
                    <div class="table-wrapper table-wrap">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('SL NO:')); ?></th>
                                    <th style="width: 60px"><?php echo e(__('Image')); ?></th>
                                    <th><?php echo e(__('Info')); ?></th>
                                    <th><?php echo e(__('QTY')); ?></th>
                                    <th><?php echo e(__('Price')); ?></th>
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
                                        <td>
                                            <div class="table-image"><?php echo render_image($product->image); ?></div>
                                        </td>
                                        <td>
                                            <p><?php echo e($product->name); ?></p>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Order\Resources/views/admin/order-details.blade.php ENDPATH**/ ?>