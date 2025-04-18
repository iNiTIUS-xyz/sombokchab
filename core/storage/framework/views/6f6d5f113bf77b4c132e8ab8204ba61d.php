<div class="single-icon">
    <a class="icon" href="<?php echo e(route("frontend.products.wishlist")); ?>"> <i class="lar la-heart"></i> </a>
    <a href="#1" class="icon-notification"> <?php echo e(\Gloudemans\Shoppingcart\Facades\Cart::instance("wishlist")->content()->count()); ?> </a>
</div>
<div class="single-icon cart-shopping">
    <div class="single-icon cart-shopping">
        <a class="icon" href="<?php echo e(route('frontend.products.cart')); ?>"> <i class="las la-shopping-cart"></i> </a>
        <a href="#1" class="icon-notification cart-item-count-amount"> <?php echo e(\Gloudemans\Shoppingcart\Facades\Cart::instance("default")->content()->count()); ?> </a>
        <div class="addto-cart-contents ">
            <div class="single-addto-cart-wrappers">
                <?php
                    $cart = \Gloudemans\Shoppingcart\Facades\Cart::instance("default")->content();
                    $subtotal = 0;
                ?>
                <?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $subtotal += calculatePrice($cart_item->price,$cart_item?->options) * $cart_item->qty;
                    ?>
                    <div class="single-addto-carts">
                        <div class="addto-cart-flex-contents">
                            <div class="addto-cart-thumb">
                                <a href="<?php echo e(route("frontend.products.single",$cart_item->options->slug ?? '')); ?>">
                                    <?php echo render_image($cart_item?->options?->image ?? 0); ?>

                                </a>
                            </div>
                            <div class="addto-cart-img-contents">
                                <h6 class="addto-cart-title">
                                    <a href="<?php echo e(route("frontend.products.single",$cart_item->options->slug ?? '')); ?>"> <?php echo e(Str::words($cart_item->name, 5)); ?> </a>
                                    <p>
                                        <?php if(!empty($cart_item?->options?->color_name ?? null)): ?>
                                        <?php echo e(__("Color")); ?>: <?php echo e($cart_item?->options?->color_name); ?> ,
                                        <?php endif; ?>

                                        <?php if(!empty($cart_item?->options?->size_name ?? null)): ?>
                                        <?php echo e(__("Size")); ?>: <?php echo e($cart_item?->options?->size_name); ?> ,
                                        <?php endif; ?>

                                        <?php if(!empty($cart_item?->options?->attributes ?? null)): ?>
                                            <?php $__currentLoopData = $cart_item?->options?->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($loop->last): ?>
                                                    <?php echo e($key); ?> : <?php echo e($value); ?>

                                                <?php else: ?>
                                                    <?php echo e($key); ?> : <?php echo e($value); ?> ,
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </p>
                                </h6>
                                <div class="price-updates mt-2">
                                    <span class="price-title fs-16 fw-500"> <?php echo e(amount_with_currency_symbol(calculatePrice($cart_item->price,$cart_item?->options))); ?> </span>
                                    <del class="del-price fs-16 fw-500 color-heading"> <?php echo e(amount_with_currency_symbol(calculatePrice($cart_item?->options?->regular_price ?? $cart_item->price,$cart_item?->options))); ?> </del>
                                </div>
                            </div>
                        </div>

                        <span class="addto-cart-counts color-heading fw-500 px-3"> <?php echo e($cart_item->qty); ?> </span>

                        <a data-label="Close" data-product_hash_id="<?php echo e($cart_item->rowId); ?>" href="#1" class="ff-jost close-cart px-3">
                            <span class="icon-close color-heading"> <i class="las la-times"></i> </span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="single-addto-carts">
                        <p class="text-center"><?php echo e(__('No Item in Cart')); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if($cart->count() != 0): ?>
                <div class="cart-total-amount">
                    <h6 class="amount-title"> <?php echo e(__('Total Amount:')); ?> </h6> <span class="fs-18 fw-500 color-light"> <?php echo e(site_currency_symbol().$subtotal); ?> </span></div>
                <div class="btn-wrapper mt-3">
                    <a href="<?php echo e(route('frontend.checkout')); ?>" class="cart-btn radius-0 w-100"> <?php echo e(__('Checkout')); ?> </a>
                </div>
                <div class="btn-wrapper mt-3">
                    <a href="<?php echo e(route('frontend.products.cart')); ?>" class="cart-btn cart-btn-outline radius-0 w-100"> <?php echo e(__('View Cart')); ?> </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="single-icon">
    <a class="icon" href="<?php echo e(route('frontend.products.compare')); ?>"> <i class="las la-retweet"></i> </a>
</div>
<div class="track-icon-list-item single-icon">
    <div class="login-account">
        <?php if(auth('web')->check()): ?>
            <a class="accounts" href="#1">
                <i class="las la-user"></i>
                <span class="icon-title"><?php echo e(auth('web')->user()->name); ?></span>
            </a>

            <ul class="account-list-item">
                <li class="list"><a
                            href="<?php echo e(route('user.home')); ?>"><?php echo e(__('Dashboard')); ?></a> </li>
                <li class="list"><a
                            href="<?php echo e(route('user.home.edit.profile')); ?>"><?php echo e(__('Edit Profile')); ?></a>
                </li>
                <li class="list"><a
                            href="<?php echo e(route('user.home.change.password')); ?>"><?php echo e(__('Change Password')); ?></a>
                </li>
                <li class="list"><a
                            href="<?php echo e(route('user.product.order.all')); ?>"><?php echo e(__('My Orders')); ?></a>
                </li>
                <li class="list"><a
                            href="<?php echo e(route('user.shipping.address.all')); ?>"><?php echo e(__('Shipping Address')); ?></a>
                </li>
                <li class="list"><a
                            href="<?php echo e(route('user.home.support.tickets')); ?>"><?php echo e(__('Support Ticket')); ?></a>
                </li>
                <li class="list">
                    <a href="<?php echo e(route('user.logout')); ?>"
                       onclick="event.preventDefault();document.getElementById('menu_logout_submit_btn').dispatchEvent(new MouseEvent('click'));">
                        <?php echo e(__('Sign out')); ?>

                    </a>
                    <form action="<?php echo e(route('user.logout')); ?>" method="POST"
                          style="display: none;">
                        <?php echo csrf_field(); ?>
                        <button id="menu_logout_submit_btn" type="submit"></button>
                    </form>
                </li>
            </ul>
        <?php else: ?>
            <a class="accounts" href="#1"><i class="las la-user"></i> <span
                        class="icon-title"><?php echo e(__('Account')); ?></span></a>
            <ul class="account-list-item">
                <li class="list"> <a href="<?php echo e(route('user.login')); ?>">
                        <?php echo e(__('Sign In')); ?> </a> </li>
                <li class="list"> <a href="<?php echo e(route('user.register')); ?>">
                        <?php echo e(__('Sign Up')); ?> </a> </li>
            </ul>
        <?php endif; ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/partials/header/navbar/card-and-wishlist-area.blade.php ENDPATH**/ ?>