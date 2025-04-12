<?php
    $wishlist = $wishlist ?? false;
?>

<div class="cart-area">
    <div class="container container-one">
        <div class="cart-wrapper">
            <div class="row g-4">
                <div class="col-xl-8 mt-4 m-auto">
                    <div class="table-list-content table-cart-clear">
                        <div class="table-responsive table-responsive--md">
                            <table class="custom--table table-border radius-10">
                                <thead class="head-bg">
                                    <tr>
                                        <th> <?php echo e(__('Product Name')); ?> </th>
                                        <th> <?php echo e(__('Unite Price')); ?> </th>
                                        <th> <?php echo e(__('Quantity')); ?> </th>
                                        <th> <?php echo e(__('Total Price')); ?> </th>
                                        <th> <?php echo e(__('Action')); ?> </th>
                                    </tr>
                                </thead>
                                <tbody class="cart-table-body">
                                    <?php $__currentLoopData = $all_cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="table-cart-row" data-product_hash_id="<?php echo e($cart_item->rowId); ?>"
                                            data-product-id="<?php echo e($key); ?>"
                                            data-varinat-id="<?php echo e($cart_item?->options?->variant_id ?? 'admin'); ?>">
                                            <td data-label="Product Name">
                                                <div class="product-name-table">
                                                    <a
                                                        href="<?php echo e(route('frontend.products.single', $cart_item->options->slug ?? '')); ?>">
                                                        <div class="thumbs bg-image radius-10"
                                                            style="background-image: url(<?php echo e(render_image($cart_item?->options['image'] ?? 0, render_type: 'path')); ?>);">
                                                        </div>
                                                    </a>

                                                    <div class="carts-contents">
                                                        <a
                                                            href="<?php echo e(route('frontend.products.single', $cart_item->options->slug ?? '')); ?>">
                                                            <span class="name-title"><?php echo e($cart_item->name); ?></span>
                                                        </a>

                                                        <p>
                                                            <?php if(!empty($cart_item?->options['color_name'] ?? null)): ?>
                                                                <?php echo e(__('Color:')); ?>

                                                                <?php echo e($cart_item?->options['color_name']); ?> ,
                                                            <?php endif; ?>

                                                            <?php if(!empty($cart_item?->options['size_name'] ?? null)): ?>
                                                                <?php echo e(__('Size:')); ?>

                                                                <?php echo e($cart_item?->options['size_name'] ?? null); ?> ,
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

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="price-td text-center" data-label="Unite Price">
                                                <?php echo e(amount_with_currency_symbol($cart_item->price)); ?> </td>
                                            <td data-label="Quantity">
                                                <div class="product-quantity">
                                                    <span class="substract"><i class="las la-minus"></i></span>
                                                    <input class="quantity-input" type="number"
                                                        value="<?php echo e($cart_item->qty); ?>"><span class="plus"><i
                                                            class="las la-plus"></i></span>
                                                </div>
                                            </td>
                                            <td class="color-one price-td text-center" data-label="Total Price">
                                                <?php echo e(amount_with_currency_symbol($cart_item->price * $cart_item->qty ?? 0)); ?>

                                            </td>
                                            <td data-label="Close">
                                                <?php if($wishlist): ?>
                                                    <a data-label="Move" data-type="tr"
                                                        data-product_hash_id="<?php echo e($cart_item->rowId); ?>" href="#1"
                                                        class="ff-jost move-cart px-3 btn btn-info">
                                                        <span class="icon-close text-light">
                                                            <i class="las la-shopping-cart"></i>
                                                        </span>
                                                    </a>
                                                    <a data-label="Close" data-type="tr"
                                                        data-product_hash_id="<?php echo e($cart_item->rowId); ?>" href="#1"
                                                        class="ff-jost remove-wishlist px-3 btn btn-danger">
                                                        <span class="icon-close text-light">
                                                            <i class="las la-trash-alt"></i>
                                                        </span>
                                                    </a>
                                                <?php else: ?>
                                                    <a data-label="Move" data-type="tr"
                                                        data-product_hash_id="<?php echo e($cart_item->rowId); ?>" href="#1"
                                                        class="ff-jost move-wishlist px-3 btn btn-info">
                                                        <span class="icon-close text-light">
                                                            <i class="lar la-heart"></i>
                                                        </span>
                                                    </a>
                                                    <a data-label="Close" data-type="tr"
                                                        data-product_hash_id="<?php echo e($cart_item->rowId); ?>" href="#1"
                                                        class="ff-jost remove-cart px-3 btn btn-danger">
                                                        <span class="icon-close">
                                                            <i class="las la-trash-alt"></i>
                                                        </span>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if(!$wishlist): ?>
                            <div class="table-update-btn margin-top-40 gap-4">
                                <a href="#1" class="btn-update text-white btn-info cart-update-table btn-table btn-border-1">
                                    <?php echo e(__('Update Cart')); ?>

                                </a>

                                <a href="<?php echo e(route('frontend.checkout')); ?>" class="btn-table btn-border-1 btn-success text-light">
                                    <?php echo e(__('Checkout')); ?>

                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/cart/cart-partial.blade.php ENDPATH**/ ?>