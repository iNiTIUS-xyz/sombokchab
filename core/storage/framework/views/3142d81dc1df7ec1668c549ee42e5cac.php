<div class="checkout-page-content-wrapper mt-4">
    <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card checkout__card mb-3">
            <?php
                $c_vendor = $vendors->find($key);
                $adminShippingMethod = null;
                $adminShopManage = null;
                $subtotal = null;
                $default_shipping_cost = null;
                $v_tax_total = 0;

                if (empty($key)) {
                    $adminShippingMethod = \Modules\ShippingModule\Entities\AdminShippingMethod::with('zone')->get();
                    $adminShopManage = \App\AdminShopManage::latest()->first();
                }
            ?>

            <?php if(empty($key)): ?>
                <div class="card-header checkout__card__header">
                    <h4 class="title checkout__card__title"><?php echo e($adminShopManage?->store_name); ?></h4>
                </div>
            <?php endif; ?>

            <?php if(!empty($c_vendor)): ?>
                <div class="card-header checkout__card__header">
                    <h4 class="title  checkout__card__title"><?php echo e($c_vendor?->business_name); ?></h4>
                </div>
            <?php endif; ?>

            <div class="card-body checkout__card__body">
                <?php $__currentLoopData = $vendor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $item->options = (object) $item->options;
                        $taxAmount = $taxProducts->where('id', $item->id)->first();
                        if (!empty($taxAmount)) {
                            $taxAmount->tax_options_sum_rate = $taxAmount->tax_options_sum_rate ?? 0;
                            $price = calculatePrice($item->price, $taxAmount);
                            $regular_price = calculatePrice($item->options->regular_price ?? 0, $item->options);
                            $v_tax_total += calculatePrice($item->price, $taxAmount, 'percentage') * $item->qty;
                        } else {
                            $price = calculatePrice($item->price, $item->options);
                            $regular_price = calculatePrice($item->options->regular_price ?? 0, $item->options);
                        }
                    ?>
                    <div class="checkout__card__wrap check-cart-flex-contents justify-content-between d-flex">
                        <div class="checkout__card__wrap__product">
                            <div class="checkout__card__thumb checkout-cart-thumb">
                                <?php echo render_image($item?->options?->image ?? 0, class: 'w-100'); ?>

                            </div>
                            <div class="checkout__card__contents checkout-cart-img-contents">
                                <h6 class="checkout__card__item__title checkout-cart-title fs-18">
                                    <a href="#1"> <?php echo e(Str::words($item->name, 5)); ?> </a>
                                    <p>
                                        <?php if(!empty($item?->options?->color_name ?? null)): ?>
                                            <?php echo e(__('Color')); ?>: <?php echo e($item?->options?->color_name); ?> ,
                                        <?php endif; ?>

                                        <?php if(!empty($item?->options?->size_name ?? null)): ?>
                                            <?php echo e(__('Size')); ?>: <?php echo e($item?->options?->size_name ?? null); ?> ,
                                        <?php endif; ?>

                                        <?php if(!empty($item?->options?->attributes ?? null)): ?>
                                            <?php $__currentLoopData = $item?->options?->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyInside => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($loop->last): ?>
                                                    <?php echo e($keyInside); ?> : <?php echo e($value); ?>

                                                <?php else: ?>
                                                    <?php echo e($keyInside); ?> : <?php echo e($value); ?> ,
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </p>
                                </h6>
                            </div>
                        </div>

                        <span class="checkout__card__qty d-block product-items w-10">
                            <?php echo e($item->qty ?? '0'); ?> <?php echo e(__('QTY')); ?>

                        </span>

                        <div class="checkout__card__price d-flex gap-2 w-20">
                            <del class="checkout__card__price__del checkout-cart-price color-heading fw-500">
                                <?php echo e(amount_with_currency_symbol($regular_price)); ?>

                            </del>

                            <b
                                class="checkout__card__price__main checkout-cart-price color-heading fw-500 font-weight-bold">
                                <?php echo e(amount_with_currency_symbol($price)); ?>

                            </b>
                        </div>
                    </div>

                    <?php

                        $subtotal += $price * $item->qty;
                        $itemsTotal += $price * $item->qty;
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if(!empty($c_vendor)): ?>
                <div class="card-footer checkout__card__footer">
                    <h6 class="card-title py-2"><?php echo e(__('Shipping Cost')); ?></h6>
                    <input type="hidden" class="shipping_cost" name="shipping_cost[<?php echo e($c_vendor->id); ?>]" />
                    <div class="shippingMethod__wrapper shipping-method-wrapper d-flex gap-2 justify-content-start">
                        <?php $__currentLoopData = $c_vendor?->shippingMethod ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $method->cost = calculatePrice($method->cost, $shippingTaxClass, 'shipping');
                                if ($method->is_default) {
                                    $default_shipping_cost = $method->cost;
                                }
                            ?>
                            <div data-shipping-cost-id="<?php echo e($method->id); ?>" data-shipping-cost="<?php echo e($method->cost); ?>"
                                data-shipping-percentage="<?php echo e($shippingTaxClass); ?>"
                                class="shippingMethod__wrapper__item checkout-shipping-method align-items-center gap-3 border-1 d-flex justify-content-between py-2 px-4 <?php echo e($method->is_default ? 'active' : ''); ?>">
                                <div class="shippingMethod__wrapper__item__left w-90">
                                    <b>
                                        <?php echo e($method?->title); ?>

                                    </b>
                                    <p>
                                        <?php echo e(__('Zone:')); ?>

                                        <?php echo e($method?->zone?->name); ?>

                                    </p>
                                </div>
                                <div class="shippingMethod__wrapper__item__right 10">
                                    <h6>
                                        <?php echo e(amount_with_currency_symbol(round($method->cost))); ?>

                                    </h6>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <hr />
                    <div class="checkout__card__footer__estimate d-flex justify-content-end">
                        <div class="checkout__card__footer__estimate__main">
                            <div class="checkout__card__footer__estimate__list">
                                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">

                                    <b><?php echo e(__('Sub Total')); ?></b> <b id="vendor_subtotal"
                                        class="vendor_subtotal"><?php echo e(float_amount_with_currency_symbol($subtotal)); ?></b>
                                </div>

                                <?php if($enableTaxAmount): ?>
                                    <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                        <b><?php echo e(__('Tax Amount')); ?></b> <b id="vendor_tax_amount"
                                            class="vendor_tax_amount"><?php echo e(float_amount_with_currency_symbol($v_tax_total)); ?></b>
                                    </div>
                                <?php else: ?>
                                    <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                        <b><?php echo e(__('Tax Amount')); ?></b> <b id="vendor_tax_amount"
                                            class="vendor_tax_amount">
                                            <?php echo e(get_static_option('display_price_in_the_shop') == 'including' ? __('Inclusive Tax') : ''); ?>

                                        </b>
                                    </div>
                                <?php endif; ?>

                                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                    <b><?php echo e(__('Shipping Cost')); ?></b> <b id="vendor_shipping_cost"
                                        class="vendor_shipping_cost"><?php echo e(float_amount_with_currency_symbol($default_shipping_cost)); ?></b>
                                </div>
                                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                    <b><?php echo e(__('Total')); ?></b>
                                    <b
                                        id="vendor_total"><?php echo e(float_amount_with_currency_symbol($subtotal + $default_shipping_cost)); ?></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(empty($key)): ?>
                <div class="card-footer checkout__card__footer">
                    <h6 class="checkout__card__title card-title py-2"><?php echo e(__('Shipping Cost')); ?></h6>
                    <input type="hidden" class="shipping_cost" name="shipping_cost[admin]" />

                    <div class="shippingMethod__wrapper shipping-method-wrapper d-flex gap-2 justify-content-start">
                        <?php $__currentLoopData = $adminShippingMethod ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $method->cost = calculatePrice($method->cost, $shippingTaxClass, 'shipping');
                                if ($method->is_default) {
                                    $default_shipping_cost = $method->cost;
                                }
                            ?>

                            <div data-shipping-cost-id="<?php echo e($method->id); ?>" data-shipping-cost="<?php echo e($method->cost); ?>"
                                data-shipping-percentage="<?php echo e($shippingTaxClass); ?>"
                                class="shippingMethod__wrapper__item checkout-shipping-method align-items-center gap-3 border-1 d-flex justify-content-between py-2 px-4 <?php echo e($method->is_default ? 'active' : ''); ?>">
                                <div class="shippingMethod__wrapper__item__left w-90">
                                    <b>
                                        <?php echo e($method?->title); ?>

                                    </b>
                                    <p>
                                        <?php echo e(__('Zone: ')); ?>

                                        <?php echo e($method?->zone?->name); ?>

                                    </p>
                                </div>
                                <div class="shippingMethod__wrapper__item__right 10">
                                    <h6 class="shippingMethod__wrapper__item__right__price">
                                        <?php echo e(amount_with_currency_symbol(round($method->cost))); ?>

                                    </h6>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <hr />

                    <div class="checkout__card__footer__estimate d-flex justify-content-end">
                        <div class="checkout__card__footer__estimate__main">
                            <div class="checkout__card__footer__estimate__list">
                                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                    <b><?php echo e(__('Sub Total')); ?></b> <b id="vendor_subtotal"
                                        class="vendor_subtotal"><?php echo e(float_amount_with_currency_symbol($subtotal)); ?></b>
                                </div>

                                <?php if($enableTaxAmount): ?>
                                    <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                        <b><?php echo e(__('Tax Amount')); ?></b>
                                        <b id="vendor_tax_amount" class="vendor_tax_amount">
                                            <?php echo e(float_amount_with_currency_symbol($v_tax_total)); ?>

                                        </b>
                                    </div>
                                <?php else: ?>
                                    <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                        <b><?php echo e(__('Tax Amount')); ?></b>
                                        <b id="vendor_tax_amount" class="vendor_tax_amount">
                                            <?php echo e(get_static_option('display_price_in_the_shop') == 'including' ? __('Inclusive Tax') : ''); ?>

                                        </b>
                                    </div>
                                <?php endif; ?>

                                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                    <b><?php echo e(__('Shipping Cost')); ?></b>
                                    <b id="vendor_shipping_cost" class="vendor_shipping_cost">
                                        <?php echo e(float_amount_with_currency_symbol($default_shipping_cost)); ?>

                                    </b>
                                </div>

                                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                    <b><?php echo e(__('Total')); ?></b>
                                    <b id="vendor_total">
                                        <?php echo e(float_amount_with_currency_symbol($subtotal + $default_shipping_cost)); ?>

                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/cart/cart-items/cart-items-wrapper.blade.php ENDPATH**/ ?>