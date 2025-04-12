<?php $__env->startSection('style'); ?>
    <style>
        /* End Contract Css */
        .end-contract-single {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        .end-contract-single:not(:first-child) {
            margin-top: 24px;
        }

        .end-contract-single-select {
            display: -ms-grid;
            display: grid;
        }

        .end-contract-feedback-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--heading-color);
        }

        .end-contract-feedback-para {
            font-size: 16px;
            color: var(--paragraph-color);
            line-height: 24px;
        }

        .end-contract-feedback-single {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        .end-contract-feedback-single:not(:first-child) {
            margin-top: 24px;
        }

        .end-contract-feedback-single-title {
            font-size: 20px;
            font-weight: 600;
            line-height: 28px;
            color: var(--heading-color);
        }

        .end-contract-feedback-single-title-flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            gap: 15px 10px;
        }

        .end-contract-reaction {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            gap: 20px;
        }

        .end-contract-reaction-item {
            border: 1px solid var(--border-color);
            padding: 0px 15px;
            border-radius: 30px;
            line-height: 42px;
            cursor: pointer;
            position: relative;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .end-contract-reaction-item:hover,
        .end-contract-reaction-item.active {
            border-color: var(--secondary-color);
            color: var(--secondary-color);
            background-color: rgba(var(--secondary-color-rgb), 0.1);
        }

        .end-contract-reaction-item:hover .end-contract-reaction-item-tooltip,
        .end-contract-reaction-item.active .end-contract-reaction-item-tooltip {
            visibility: visible;
            opacity: 1;
            z-index: 9;
        }

        .end-contract-reaction-item:hover .end-contract-reaction-icon,
        .end-contract-reaction-item.active .end-contract-reaction-icon {
            border-color: var(--secondary-color);
        }

        .end-contract-reaction-item:hover .end-contract-reaction-review-star,
        .end-contract-reaction-item.active .end-contract-reaction-review-star {
            color: var(--secondary-color);
        }

        .end-contract-reaction-item-tooltip {
            position: absolute;
            top: -30px;
            left: 0;
            text-align: center;
            background: var(--secondary-color);
            color: #fff;
            padding: 3px 12px;
            line-height: 20px;
            border-radius: 3px;
            font-size: 12px;
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-transition: 0.3s;
            transition: 0.3s;
            visibility: hidden;
            opacity: 0;
        }

        .end-contract-reaction-item-tooltip::before {
            content: "";
            position: absolute;
            left: auto;
            right: auto;
            bottom: -10px;
            height: 0;
            width: 0;
            border-right: 10px solid transparent;
            border-left: 10px solid transparent;
            border-top: 20px solid var(--secondary-color);
            border-radius: 5px;
            z-index: -1;
        }

        .end-contract-reaction-item-flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .end-contract-reaction-icon {
            border-right: 1px solid var(--border-color);
            padding-right: 10px;
            margin-right: 10px;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .end-contract-reaction-review-star {
            font-size: 15px;
            color: var(--body-color);
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .end-contract-reaction-review-star:not(:last-child) {
            margin-right: 2px;
        }

        /* start Contract widget Css */
        .end-contract-widget-item {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
        }

        .end-contract-widget-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .end-contract-widget-list-item {
            font-size: 16px;
            line-height: 30px;
            position: relative;
            text-align: left;
            z-index: 2;
            padding: 5px 10px 5px 40px;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
            border-radius: 5px;
            border: 1px solid var(--border-color);
        }

        .end-contract-widget-list-item:not(:last-child) {
            margin-bottom: 10px;
        }

        .end-contract-widget-list-item.active {
            background-color: rgba(var(--success-color-rgb), 0.1);
            color: var(--success-color);
            border-color: var(--success-color);
        }

        .end-contract-widget-list-item.active::after {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            background: var(--success-color);
            border-color: var(--success-color);
        }

        .end-contract-widget-list-item::after {
            content: "";
            position: absolute;
            height: 22px;
            width: 22px;
            border: 1px solid var(--border-color);
            left: 10px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            background: none;
            border-radius: 3px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            font-size: 12px;
            color: #fff;
            cursor: pointer;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
            border-radius: 50%;
        }

        .overall-score {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            gap: 15px;
        }

        .overall-score-para {
            font-size: 16px;
            line-height: 24px;
            color: var(--paragraph-color);
        }

        .overall-score-review {
            border: 1px solid var(--border-color);
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 16px;
            line-height: 24px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            gap: 5px;
        }

        .overall-score-review-icon {
            color: var(--secondary-color);
            font-size: 15px;
        }

        .overall-score-review-para {
            color: var(--paragraph-color);
            font-size: 16px;
            line-height: 24px;
        }

        .profile-border-top {
            border-top: 1px solid #EAECF0;
            padding-top: 20px;
            margin-top: 20px;
        }

        .profile-border-bottom {
            border-bottom: 1px solid #EAECF0;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        /* btn profile */
        .btn-profile {
            color: var(--paragraph-color);
            font-size: 16px;
            font-weight: 500;
            font-family: var(--body-font);
            display: inline-block;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            line-height: 24px;
            padding: 7px 20px;
            white-space: nowrap;
            -webkit-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
        }

        @media only screen and (max-width: 575.98px) {
            .btn-profile {
                padding: 6px 20px;
                font-size: 15px;
            }
        }

        @media only screen and (max-width: 375px) {
            .btn-profile {
                padding: 5px 15px;
                font-size: 14px;
            }
        }

        .btn-profile.btn-bg-1 {
            background-color: var(--main-color-one);
            color: #fff;
        }

        .btn-profile.btn-bg-1:hover {
            background-color: rgba(var(--main-color-one-rgb), 0.8);
        }

        .btn-profile.btn-outline-gray {
            border: 1px solid var(--border-color);
            padding: 6px 19px;
        }

        .btn-profile.btn-outline-gray:hover {
            background-color: var(--main-color-one);
            border-color: var(--main-color-one);
            color: #fff;
        }

        @media only screen and (max-width: 575.98px) {
            .btn-profile.btn-outline-gray {
                padding: 5px 15px;
            }
        }

        @media only screen and (max-width: 375px) {
            .btn-profile.btn-outline-gray {
                padding: 4px 15px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Payment Success')); ?>

<?php $__env->stopSection(); ?>

<?php
    use Modules\DeliveryMan\Entities\DeliveryManRating;
?>

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
    </div>

    <div class="patment-success-area padding-top-100 padding-bottom-100">
        <?php if(moduleExists("DeliveryMan")): ?>
            <?php if(!empty($payment_details->deliveryMan) && DeliveryManRating::where('delivery_man_id', $payment_details->deliveryMan?->delivery_man_id)->count() < 1): ?>
                <!-- End Contract area Starts -->
                <div class="end-contract-area section-bg-2">
                    <div class="container">
                        <div class="row gy-4 justify-content-center">
                            <div class="col-lg-8">
                                <div class="end-contract">
                                    <div class="end-contract-feedback mt-4 padding-bottom-50">
                                        <h4 class="end-contract-feedback-title"><?php echo e(__('Provide Feedback')); ?></h4>
                                        <div class="end-contract-feedback-contents mt-4">
                                            <div data-reaction-type="communication" class="end-contract-feedback-single">
                                                <div class="end-contract-feedback-single-title-flex">
                                                    <h4 class="end-contract-feedback-single-title">
                                                        <?php echo e(__('Rate delivery man service')); ?> </h4>
                                                </div>
                                                <div class="end-contract-feedback-single-contents profile-border-top">
                                                    <form action="<?php echo e(route('user.product.order.delivery-man-ratting', $item)); ?>"
                                                          method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <input id="delivery-man-ratting-input" type="hidden" name="ratting"
                                                               value="" />

                                                        <div class="end-contract-reaction">
                                                            <div class="end-contract-reaction-item reaction-list"
                                                                 data-ratting-number="1">
                                                            <span
                                                                    class="end-contract-reaction-item-tooltip"><?php echo e(__('Very sad')); ?></span>
                                                                <div class="end-contract-reaction-item-flex">
                                                                    <div class="end-contract-reaction-icon">
                                                                        <img src="<?php echo e(asset("assets/img/icons/sad_reaction.svg")); ?>"
                                                                             alt="">
                                                                    </div>
                                                                    <div class="end-contract-reaction-review">
                                                                    <span class="end-contract-reaction-review-star"><i
                                                                                class="las la-star"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="end-contract-reaction-item reaction-list"
                                                                 data-ratting-number="2">
                                                            <span
                                                                    class="end-contract-reaction-item-tooltip"><?php echo e(__('Not Good')); ?></span>
                                                                <div class="end-contract-reaction-item-flex">
                                                                    <div class="end-contract-reaction-icon">
                                                                        <img src="<?php echo e(asset("assets/img/icons/not_good_reaction.svg")); ?>"
                                                                             alt="">
                                                                    </div>
                                                                    <div class="end-contract-reaction-review">
                                                                    <span class="end-contract-reaction-review-star"><i
                                                                                class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="end-contract-reaction-item reaction-list"
                                                                 data-ratting-number="3">
                                                            <span
                                                                    class="end-contract-reaction-item-tooltip"><?php echo e(__("It's Ok")); ?></span>
                                                                <div class="end-contract-reaction-item-flex">
                                                                    <div class="end-contract-reaction-icon">
                                                                        <img src="<?php echo e(asset("assets/img/icons/its_ok_reaction.svg")); ?>"
                                                                             alt="">
                                                                    </div>
                                                                    <div class="end-contract-reaction-review">
                                                                    <span class="end-contract-reaction-review-star"><i
                                                                                class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="end-contract-reaction-item reaction-list"
                                                                 data-ratting-number="4">
                                                            <span
                                                                    class="end-contract-reaction-item-tooltip"><?php echo e(__("I'm Happy")); ?></span>
                                                                <div class="end-contract-reaction-item-flex">
                                                                    <div class="end-contract-reaction-icon">
                                                                        <img src="<?php echo e(asset("assets/img/icons/happy_reaction.svg")); ?>"
                                                                             alt="">
                                                                    </div>
                                                                    <div class="end-contract-reaction-review">
                                                                    <span class="end-contract-reaction-review-star"><i
                                                                                class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="end-contract-reaction-item reaction-list"
                                                                 data-ratting-number="5">
                                                            <span
                                                                    class="end-contract-reaction-item-tooltip"><?php echo e(__('Very Happy')); ?></span>
                                                                <div class="end-contract-reaction-item-flex">
                                                                    <div class="end-contract-reaction-icon">
                                                                        <img src="<?php echo e(asset("assets/img/icons/very_happy_reaction.svg")); ?>"
                                                                             alt="">
                                                                    </div>
                                                                    <div class="end-contract-reaction-review">
                                                                    <span class="end-contract-reaction-review-star"><i
                                                                                class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group delivery-man-rating-button d-none">
                                                            <label
                                                                    for="comment"><?php echo e(__('Write comment')); ?>(<?php echo e(__('optional')); ?>)</label>
                                                            <textarea name="review" id="comment" cols="30" rows="5"></textarea>
                                                        </div>

                                                        <div class="form-group">

                                                            <button class="btn btn-info delivery-man-rating-button d-none"
                                                                    type="submit"><?php echo e(__('Submit Rating')); ?></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Contract area end -->
            <?php endif; ?>
        <?php endif; ?>

        <div class="container">
            <div class="row g-4 gx-5">
                <div class="col-lg-6">
                    <div class="order__details__single">
                        <div class="payment-success-wrapper">
                            <div class="payment-contents">
                                <h4 class="title__two"> <?php echo e(__('Payment Details')); ?> </h4>
                                <ul class="payment-list margin-top-40">
                                    <li>
                                        <span class="payment-list-left"><?php echo e(__('Payment Gateway:')); ?></span>
                                        <span class="payment-list-right"><?php echo e(render_payment_gateway_name($payment_details->payment_gateway)); ?></span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left"><?php echo e(__('Phone:')); ?></span>
                                        <span class="payment-list-right">
                                            <?php echo e($payment_details->address->phone); ?></span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left"><?php echo e(__('Name:')); ?></span>
                                        <span class="payment-list-right"><?php echo e($payment_details->address->name); ?></span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left"><?php echo e(__('Email:')); ?></span>
                                        <span class="payment-list-right"><?php echo e($payment_details->address->email); ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="order__details__single">
                        <div class="payment-success-wrapper">
                            <div class="payment-contents">
                                <h4 class="title__two"> <?php echo e(__('Order Details')); ?> </h4>
                                <ul class="payment-list payment-list-two margin-top-30">
                                    <li>
                                        <span class="payment-list-left list-bold"><?php echo e(__('Amount Paid:')); ?> </span>
                                        <span class="payment-list-right payment-bold">
                                            <?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta?->total_amount)); ?></span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left list-bold"><?php echo e(__('Payment Status:')); ?> </span>
                                        <span class="payment-list-right payment-bold">
                                            <?php echo e(ucfirst($payment_details->payment_status)); ?></span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left list-bold"><?php echo e(__('Order Status:')); ?> </span>
                                        <span class="payment-list-right payment-bold">
                                            <?php echo e(ucfirst($payment_details->order_status)); ?></span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left list-bold"><?php echo e(__('Order Track:')); ?> </span>
                                        <span class="payment-list-right payment-bold"> <?php echo e(ucfirst(str_replace(['-','_'],' ',$orderTrack->name))); ?></span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left list-bold"><?php echo e(__('Order Track ID:')); ?> </span>
                                        <span class="payment-list-right payment-bold">
                                            <?php echo e(ucfirst($payment_details->order_number)); ?></span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left"><?php echo e(__('Transaction ID:')); ?></span>
                                        <span class="payment-list-right"><?php echo e($payment_details->transaction_id); ?></span>
                                    </li>
                                </ul>

                                <div class="btn-wrapper margin-top-40">
                                    <a href="<?php echo e(route('user.home')); ?>"
                                        class="cmn_btn btn_bg_2"><?php echo e(__('Go to Dashboard')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 padding-top-60">
                    <div class="order__details__single">
                        <h4 class="title__two"><?php echo e(__('Order details View')); ?></h4>
                        <div class="order__details__wrap checkout-page-content-wrapper margin-top-20">
                            <?php
                                $adminShopManage = \App\AdminShopManage::first();
                                $itemsTotal = null;
                            ?>
                            <div class="row g-4">
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-12">
                                        <div class="order__details__item">
                                            <div class="order__item">
                                                <?php $__currentLoopData = $order?->orderItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $prd_image = $orderItem->product?->image;

                                                        if (!empty($orderItem->variant?->attr_image)) {
                                                            $prd_image = $orderItem->variant->attr_image;
                                                        }
                                                    ?>
                                                    <div class="order__item__single">
                                                        <div class="order__item__single__flex">
                                                            <div class="order__item__product">
                                                                <div
                                                                    class="order__item__product__thumb checkout-cart-thumb">
                                                                    <?php echo render_image($prd_image, class: 'w-100'); ?>

                                                                </div>
                                                                <div
                                                                    class="order__item__product__contents checkout-cart-img-contents">
                                                                    <h6
                                                                        class="order__item__product__name checkout-cart-title">
                                                                        <a href="#1">
                                                                            <?php echo e(Str::words($orderItem->product?->name, 5)); ?>

                                                                        </a>
                                                                        <p>
                                                                            <?php echo e($orderItem?->variant?->productColor ? __('Color:') . $orderItem?->variant?->productColor?->name . ' , ' : ''); ?>

                                                                            <?php echo e($orderItem?->variant?->productSize ? __('Size:') . $orderItem?->variant?->productSize?->name . ' , ' : ''); ?>

                                                                            <?php $__currentLoopData = $orderItem?->variant?->attribute ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php echo e($attr->attribute_name); ?>

                                                                                : <?php echo e($attr->attribute_value); ?>


                                                                                <?php if(!$loop->last): ?>
                                                                                    ,
                                                                                <?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </p>
                                                                    </h6>
                                                                    <?php
                                                                        $subtotal = null;
                                                                        $default_shipping_cost = null;
                                                                    ?>

                                                                    <p class="order__item__product__span mt-2">
                                                                        <span
                                                                            class="order__item__product__span__left"><?php echo e(__('Sold By:')); ?></span>
                                                                        <span
                                                                            class="order__item__product__span__right"><?php echo e($order->vendor?->business_name ?? $adminShopManage?->store_name); ?></span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <p class="d-block product-items">
                                                                <span><?php echo e(__('QTY:')); ?></span>
                                                                <strong
                                                                    class="color-heading"><?php echo e($orderItem->quantity ?? '0'); ?></strong>
                                                            </p>
                                                            <div class="d-flex gap-2">
                                                                <s class="checkout-cart-price">
                                                                    <?php echo e(amount_with_currency_symbol($orderItem->sale_price)); ?>

                                                                </s>
                                                                <strong class="color-heading">
                                                                    <?php echo e(amount_with_currency_symbol($orderItem->price)); ?>

                                                                </strong>
                                                            </div>
                                                        </div>

                                                        <?php
                                                            $subtotal += $orderItem->sale_price * $orderItem->quantity;
                                                            $itemsTotal += $orderItem->sale_price * $orderItem->quantity;
                                                        ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="order__item__footer">
                                                <?php if($order->order_status === 'order_cancelled'): ?>
                                                    <h4 class="py-2 text-danger text-center pt-4"><?php echo e(__("This order is cancelled by the seller")); ?></h4>
                                                <?php else: ?>
                                                    <div class="order__item__estimate">
                                                        <div class="order__item__estimate__single d-flex justify-content-between">
                                                            <span><?php echo e(__('Sub Total')); ?></span>
                                                            <strong id="vendor_subtotal">
                                                                <?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta?->sub_total)); ?>

                                                            </strong>
                                                        </div>
                                                        <div class="order__item__estimate__single d-flex justify-content-between mt-3">
                                                            <span><?php echo e(__('Discount Amount')); ?></span>
                                                            <strong id="vendor_tax_amount"><?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta?->coupon_amount)); ?></strong>
                                                        </div>
                                                        <div
                                                                class="order__item__estimate__single d-flex justify-content-between">
                                                            <span><?php echo e(__('Tax Amount')); ?></span>
                                                            <strong id="vendor_tax_amount"><?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta?->tax_amount)); ?></strong>
                                                        </div>
                                                        <div class="order__item__estimate__single d-flex justify-content-between">
                                                            <span><?php echo e(__('Shipping Cost')); ?></span>
                                                            <strong id="vendor_shipping_cost"><?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta?->shipping_cost)); ?></strong>
                                                        </div>
                                                        <div class="order__item__estimate__single d-flex justify-content-between">
                                                            <span><?php echo e(__('Total')); ?></span>
                                                            <strong id="vendor_total"><?php echo e(float_amount_with_currency_symbol($payment_details->paymentMeta?->total_amount)); ?></strong>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        $(document).on('click', '.reaction-list', function() {
            $(this).siblings().removeClass("active");
            $(this).addClass("active");

            // check .delivery-man-rating-button this button is contain class d-none then remove this class from this button
            if ($('.delivery-man-rating-button').hasClass('d-none'))
                $('.delivery-man-rating-button').removeClass('d-none')

            // now update current rating amount in ratting input field
            $('#delivery-man-ratting-input').val($(this).attr("data-ratting-number"));
        });

        $(document).on('click', '.click-skip', function() {
            $(this).parent().parent().find(".reaction-list.active").removeClass("active");
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/user/dashboard/order/details.blade.php ENDPATH**/ ?>