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
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        .border-bottom-1 {
            border-bottom: 1px solid #ddd;
        }

        .badge {
            line-height: 15px;
        }

        body {
            background-color: #eeeeee;
            font-family: 'Open Sans', serif
        }

        .container {
            margin-top: 50px;
            margin-bottom: 50px
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }
        .track-wrapper {
            height: 100%;
            display: block;
        }
        .track {
            position: relative;
            background-color: #ddd;
            height: 5px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px;
        }
        @media screen and (max-width: 480px) {
            .track {
                margin-bottom: 80px;
            }
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 20%;
            margin-top: -13px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #FF5722
        }

        .track .step::before {
            height: 5px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 13px;
        }

        .track .step.active .icon {
            background: #ee5435;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #ee5435;
            border-color: #ee5435;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color: #ff2b00;
            border-radius: 1px
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('My Orders')); ?>

<?php $__env->stopSection(); ?>
<?php
    $edit = $edit ?? false;
?>
<?php $__env->startSection('content'); ?>
    <div class="row g-4">
        <div class="col-md-12">
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
            <?php if (isset($component)) { $__componentOriginal5836ea34a6758bf192c104f6f2992c55 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5836ea34a6758bf192c104f6f2992c55 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.success','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5836ea34a6758bf192c104f6f2992c55)): ?>
<?php $attributes = $__attributesOriginal5836ea34a6758bf192c104f6f2992c55; ?>
<?php unset($__attributesOriginal5836ea34a6758bf192c104f6f2992c55); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5836ea34a6758bf192c104f6f2992c55)): ?>
<?php $component = $__componentOriginal5836ea34a6758bf192c104f6f2992c55; ?>
<?php unset($__componentOriginal5836ea34a6758bf192c104f6f2992c55); ?>
<?php endif; ?>
        </div>
        <?php if($edit): ?>
            <div class="col-md-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title"><?php echo e(__('Update Order')); ?></h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                
                                
                                <div class="dashboard__card">
                                    <div class="dashboard__card__header">
                                        <h4 class="dashboard__card__title"><?php echo e(__('Order Status & Payment Status')); ?></h4>
                                    </div>
                                    <div class="dashboard__card__body custom__form mt-4">
                                        <form id="updateOrder" method="post"
                                            action="<?php echo e(route('admin.orders.update.order-status')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <input type="hidden" value="<?php echo e($order->id); ?>" name="order_id">
                                            <div class="form-group">
                                                <label for=""><?php echo e(__('Order Status')); ?></label>
                                                <select
                                                    <?php echo e($order->order_status == 'complete' ||  $order->order_status == 'canceled' || $order->order_status == 'rejected' ? 'readonly' : ''); ?>

                                                    name="order_status" class="form-control">
                                                    <option <?php echo e($order->order_status == 'pending' ? 'selected' : ''); ?>

                                                        value="pending"><?php echo e(__('Pending')); ?></option>
                                                    <option <?php echo e($order->order_status == 'complete' ? 'selected' : ''); ?>

                                                        value="complete"><?php echo e(__('Complete')); ?></option>
                                                    <option <?php echo e($order->order_status == 'failed' ? 'selected' : ''); ?>

                                                        value="failed"><?php echo e(__('Failed')); ?></option>
                                                    <option <?php echo e($order->order_status == 'rejected' ? 'selected' : ''); ?>

                                                        value="rejected"><?php echo e(__('Rejected')); ?></option>
                                                    <option <?php echo e($order->order_status == 'canceled' ? 'selected' : ''); ?>

                                                        value="canceled"><?php echo e(__('Canceled')); ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for=""><?php echo e(__('Payment Status')); ?></label>
                                                <select
                                                    <?php echo e($order->payment_status == 'complete' || $order->payment_status == 'rejected' ? 'readonly' : ''); ?>

                                                    name="payment_status" class="form-control">
                                                    <option <?php echo e($order->payment_status == 'pending' ? 'selected' : ''); ?>

                                                        value="pending"><?php echo e(__('Pending')); ?></option>
                                                    <option <?php echo e($order->payment_status == 'complete' ? 'selected' : ''); ?>

                                                        value="complete"><?php echo e(__('Complete')); ?></option>
                                                    <option <?php echo e($order->payment_status == 'failed' ? 'selected' : ''); ?>

                                                        value="failed"><?php echo e(__('Failed')); ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button class="cmn_btn btn_bg_profile"
                                                    <?php echo e(($order->order_status == 'complete' || $order->order_status == 'rejected') ? 'disabled' : ''); ?>>
                                                    <?php echo e(__('Update')); ?>

                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <?php if (isset($component)) { $__componentOriginal72d30dca238bfde3c546b1120597c5fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72d30dca238bfde3c546b1120597c5fe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'order::components.order-track','data' => ['order' => $order]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('order::order-track'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['order' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order)]); ?>
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
            </div>
        <?php endif; ?>
        <div class="col-md-6">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title"><?php echo e(__('Orders Details')); ?></h4>
                    <div class="d-flex justify-content-between">
                        <b><?php echo e(__('Order ID')); ?></b>
                        <h6>#<?php echo e($order->id); ?></h6>
                    </div>
                </div>
                <div class="dashboard__card__body mt-4">
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('Transaction ID')); ?></span>
                        <span class="request__right"><?php echo e($order->transaction_id); ?></span>
                    </div>
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('Payment Gateway')); ?></span>
                        <span class="request__right"><?php echo e(ucwords(str_replace(['_', '-'], ' ', $order->payment_gateway))); ?></span>
                    </div>
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('Payment Status')); ?></span>
                        <span class="request__right"><?php echo e(str($order->payment_status)->ucfirst()); ?></span>
                    </div>
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('Total Product')); ?></span>
                        <span class="request__right"><?php echo e($order->order_items_count); ?></span>
                    </div>
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('Items Total')); ?></span>
                        <span
                            class="request__right"><?php echo e(float_amount_with_currency_symbol($order?->paymentMeta?->sub_total)); ?>

                        </span>
                    </div>
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('Discount Amount')); ?></span>
                        <span
                            class="request__right"><?php echo e(float_amount_with_currency_symbol($order?->paymentMeta?->coupon_amount)); ?>

                        </span>
                    </div>
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('Shipping Cost')); ?></span>
                        <span class="request__right"><?php echo e(float_amount_with_currency_symbol($order?->paymentMeta?->shipping_cost)); ?> </span>
                    </div>
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('Tax Amount')); ?></span>
                        <span class="request__right"><?php echo e(float_amount_with_currency_symbol($order?->paymentMeta?->tax_amount)); ?></span>
                    </div>
                    <div class="d-flex justify-content-between py-2">
                        <span class="request__left"><?php echo e(__('Total Amount')); ?></span>
                        <span
                            class="request__right"><?php echo e(float_amount_with_currency_symbol($order?->paymentMeta?->total_amount)); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>

        <?php
            $addr = $order?->address?->cityInfo?->name . ' , ' . $order?->address?->state?->name . ' , ' . $order?->address?->country?->name . ' , ' . $order?->address?->zipcode;
        ?>

        <div class="col-md-6">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title"><?php echo e(__('Billing Information')); ?></h4>
                </div>
                <div class="dashboard__card__body mt-4">
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('Name')); ?></span>
                        <span class="request__right"><?php echo e($order?->address?->name); ?></span>
                    </div>
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('Email')); ?></span>
                        <span class="request__right"><?php echo e($order?->address?->email); ?></span>
                    </div>
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('Mobile')); ?></span>
                        <span class="request__right"><?php echo e($order?->address?->phone); ?></span>
                    </div>
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('Country')); ?></span>
                        <span class="request__right"><?php echo e($order?->address?->country?->name); ?></span>
                    </div>
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('State')); ?></span>
                        <span class="request__right"><?php echo e($order?->address?->state?->name); ?></span>
                    </div>
                    <div class="request__item">
                        <span class="request__left"><?php echo e(__('City')); ?></span>
                        <span class="request__right"><?php echo e($order?->address?->cityInfo?->name); ?></span>
                    </div>
                    <div class="d-flex justify-content-between pt-2">
                        <span class="request__left"><?php echo e(__('Zip Code')); ?></span>
                        <span class="request__right"><?php echo e($order?->address?->zipcode); ?></span>
                    </div>
                    <div class="d-flex justify-content-between pt-2">
                        <span class="request__left"><?php echo e(__('Address')); ?></span>
                        <span class="request__right"><?php echo e($order?->address?->address); ?></span>
                    </div>
                    <div class="d-flex justify-content-between pt-2">
                        <span class="request__left"><?php echo e(__('Note')); ?></span>
                        <span class="request__right"><?php echo e($order?->note); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard__card mt-4">
        <div class="dashboard__card__header">
            <h4 class="dashboard__card__title"><?php echo e(__('Sub Order Information')); ?></h4>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="row g-4">
                <?php $__currentLoopData = $order->SubOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subOrders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(empty($subOrders->vendor)): ?>
                        <?php
                            $adminShop = \App\AdminShopManage::with('logo')->first();
                            $adminProductCount = \Modules\Product\Entities\Product::query()
                                ->whereNotNull('admin_id')
                                ->count();
                            $adminTotalOrderCount = \Modules\Order\Entities\SubOrder::query()
                                ->whereNull('vendor_id')
                                ->count();
                            $adminCompleteOrderCount = \Modules\Order\Entities\SubOrder::query()
                                ->whereRelation('order', 'order_status', '=', 'complete')
                                ->whereNull('vendor_id')
                                ->count();
                            $adminPendingOrderCount = \Modules\Order\Entities\SubOrder::query()
                                ->whereRelation('order', 'order_status', '=', 'pending')
                                ->whereNull('vendor_id')
                                ->count();
                            $adminCompleteOrderIncome = \Modules\Order\Entities\SubOrder::query()
                                ->whereRelation('order', 'order_status', '=', 'complete')
                                ->whereNull('vendor_id')
                                ->sum('total_amount');
                        ?>
                        <div class="col-md-12">
                            <div class="dashboard__card">
                                <div class="dashboard__card__header">
                                    <h5 class="dashboard__card__title"><?php echo e($adminShop->store_name); ?></h5>
                                    <div class="dashboard__card__header__right">
                                        <div class="d-flex justify-content-between gap-1">
                                            <b><?php echo e(__('Sub Order ID')); ?> </b>
                                            <b class="request__right">#<?php echo e($subOrders->id); ?></b>
                                        </div>
                                        <a href="<?php echo e(route('admin.orders.details', $subOrders->id)); ?>"
                                            class="cmn_btn btn_bg_profile">
                                            <i class="las la-eye"></i> <small><?php echo e(__('View Sub Order')); ?></small>
                                        </a>
                                    </div>
                                </div>
                                <div class="dashboard__card__body mt-4">
                                    <div class="row g-4">
                                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                                            <div class="subOrder__single">
                                                <div class="subOrder__single__thumb">
                                                    <?php echo render_image($adminShop->logo, class: 'w-50'); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                                            <div class="subOrder__single">
                                                <div class="subOrder__single__item">
                                                    <span class="subOrder__single__item__left">
                                                        <h6><?php echo e($adminShop->store_name); ?></h6>
                                                    </span>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Total Income')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e(float_amount_with_currency_symbol($adminCompleteOrderIncome)); ?>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                                            <div class="subOrder__single">
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Total Product')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e($adminProductCount); ?>

                                                    </h6>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Total Orders')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e($adminTotalOrderCount); ?></h6>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Pending Orders')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e($adminPendingOrderCount); ?>

                                                    </h6>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Complete Orders')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e($adminCompleteOrderCount); ?>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                                            <div class="subOrder__single">
                                                <div class="subOrder__single__item">
                                                    <span class="subOrder__single__item__left">
                                                        <h6><?php echo e(__('Order Information')); ?></h6>
                                                    </span>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Order Product Count')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e($subOrders->order_item_count); ?>

                                                    </h6>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Payment Status')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e(ucwords($subOrders->payment_status)); ?></h6>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span class="subOrder__single__item__left"><?php echo e(__('Order Amount')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e(float_amount_with_currency_symbol($subOrders->total_amount)); ?>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-md-12">
                            <div class="dashboard__card">
                                <div class="dashboard__card__header">
                                    <h5 class="title"><?php echo e($subOrders->vendor?->business_name); ?></h5>
                                    <div class="dashboard__card__header__right">

                                        <div class="d-flex justify-content-between gap-1">
                                            <b><?php echo e(__('This order status')); ?> </b>
                                            <b class="badge <?php echo e($subOrders->order_status === 'order_cancelled' ? 'bg-danger' : 'bg-dark'); ?>">
                                                <?php echo e(ucfirst(str_replace(["_","-"], " ", $subOrders->order_status))); ?></b>
                                        </div>

                                        <div class="d-flex justify-content-between gap-1">
                                            <b><?php echo e(__('Sub Order ID')); ?> </b>
                                            <b class="request__right">#<?php echo e($subOrders->id); ?></b>
                                        </div>
                                        <a href="<?php echo e(route('admin.orders.details', $subOrders->id)); ?>"
                                            class="cmn_btn btn_bg_profile">
                                            <i class="las la-eye"></i> <small><?php echo e(__('View Sub Order')); ?></small>
                                        </a>
                                    </div>
                                </div>
                                <div class="dashboard__card__body mt-4">
                                    <div class="row g-4">
                                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                                            <div class="subOrder__single">
                                                <div class="subOrder__single__thumb">
                                                    <?php echo render_image($subOrders->vendor->logo, class: 'w-50'); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                                            <div class="subOrder__single">
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e($subOrders->vendor->owner_name); ?></span>
                                                    <div class="subOrder__single__item__right">
                                                        <h6>(<?php echo e($subOrders->vendor->username); ?>)</h6>
                                                    </div>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(strip_tags($subOrders->vendor->description)); ?></span>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Total Income')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e(float_amount_with_currency_symbol($subOrders->vendor->total_earning)); ?>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                                            <div class="subOrder__single">
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Total Product')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e($subOrders->vendor->product_count); ?></h6>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Total Orders')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e($subOrders->vendor->pending_order); ?></h6>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Pending Orders')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e($subOrders->vendor->pending_order); ?></h6>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Complete Orders')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e($subOrders->vendor->complete_order); ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-sm-6">
                                            <div class="subOrder__single">
                                                <div class="subOrder__single__item">
                                                    <span class="subOrder__single__item__left">
                                                        <h6><?php echo e(__('Order Information')); ?></h6>
                                                    </span>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Order Product Count')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e($subOrders->order_item_count); ?>

                                                    </h6>
                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span class="subOrder__single__item__left"><?php echo e(__('Payment Status')); ?></span>

                                                    <?php if($subOrders->order->payment_status == 'complete'): ?>
                                                        <h6 class="badge badge-sm bg-success subOrder__single__item__right"><?php echo e(__('Complete')); ?></h6>
                                                    <?php elseif($subOrders->order->payment_status == 'pending'): ?>
                                                        <h6 class="badge badge-sm bg-warning subOrder__single__item__right"><?php echo e(__('Pending')); ?></h6>
                                                    <?php elseif($subOrders->order->payment_status == 'failed'): ?>
                                                        <h6 class="badge badge-sm bg-danger subOrder__single__item__right"><?php echo e(__('Failed')); ?></h6>
                                                    <?php endif; ?>

                                                </div>
                                                <div class="subOrder__single__item">
                                                    <span
                                                        class="subOrder__single__item__left"><?php echo e(__('Order Amount')); ?></span>
                                                    <h6 class="badge badge-sm bg-success subOrder__single__item__right">
                                                        <?php echo e(float_amount_with_currency_symbol($subOrders->total_amount)); ?>

                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(get_static_option('map_api_key_client')); ?>&libraries=drawing,places&v=3.45.8">
    </script>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script>
        function geocodeAddress(address) {
            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({
                address: address
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
                } else {

                }
            });
        }

        // Call the function with your address
        var address = "Dhaka, Dhaka, Bangladesh, 24727";

        $(document).ready(function() {
            console.log(geocodeAddress(address));
        });


        (function($) {
            "use strict";
            $(document).on("change", ".order-track-input", function() {
                let el = $(this);
                $(".order-track-input").removeAttr("checked");
                $(".order-track-input").each(function() {
                    $(this).prop("checked", true);
                    if (el.val() == $(this).val()) {
                        return false;
                    }
                })
            });
            $(document).ready(function() {
                $(document).on('click', '.bodyUser_overlay', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });
                $(document).on('click', '.mobile_nav', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });
                $(document).on('click', '.swal_delete_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__('Are you sure?')); ?>',
                        text: '<?php echo e(__('You would not be able to revert this item!')); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });
            })
        })(jQuery)
    </script>
    <?php if (isset($component)) { $__componentOriginal579359c93efc143f4744524389ba1039 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal579359c93efc143f4744524389ba1039 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal579359c93efc143f4744524389ba1039)): ?>
<?php $attributes = $__attributesOriginal579359c93efc143f4744524389ba1039; ?>
<?php unset($__attributesOriginal579359c93efc143f4744524389ba1039); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal579359c93efc143f4744524389ba1039)): ?>
<?php $component = $__componentOriginal579359c93efc143f4744524389ba1039; ?>
<?php unset($__componentOriginal579359c93efc143f4744524389ba1039); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Order\Resources/views/admin/details.blade.php ENDPATH**/ ?>