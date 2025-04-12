<div class="checkout-order-summery bg-item-badge">
    <div class="order-summery-contents text-center">
        <h2 class="summery-title"> <?php echo e(__('Order Summery')); ?> </h2>
        <div class="coupon-form mt-4">
            <div class="single-input">
                <label>
                    <input class="form--control" name="coupon" type="text"
                        value="<?php echo e(old('coupon') ?? request()->coupon); ?>" placeholder="<?php echo filter_static_option_value('coupon_placeholder', $setting_text, __('Enter your coupon code')); ?>">
                </label>
            </div>

            <button type="button" data-action="<?php echo e(route('frontend.shop.checkout.sync-product-coupon.ajax')); ?>"
                class="apply-coupon"> <?php echo filter_static_option_value('apply_coupon_btn_text', $setting_text, __('apply coupon')); ?> </button>
        </div>

        <?php
            $default_shipping_cost_amount = isset($default_shipping) && $default_shipping->id ? $default_shipping_cost : 0;
        ?>

        <div class="order-shipping-methods">

        </div>

        <div class="single-coupon-list mt-4">
            <ul class="coupon-flex-list coupon-border">
                <li class="list"> <b> <?php echo e(__('Items Total')); ?> </b> <b id="checkout_items_total">
                    <?php echo e(amount_with_currency_symbol(toFixed($itemsTotal, 0))); ?> </b>
                </li>
                <li class="list"> <b> <?php echo e(__('Discount Amount')); ?> </b>
                    <b id="coupon_amount"> <?php echo e(amount_with_currency_symbol(0.0)); ?> </b>
                </li>
                <?php if($enableTaxAmount): ?>
                    <li class="list">
                        <b> <?php echo e(__('Tax Amount')); ?> </b>
                        <b id="checkout_tax_amount">
                            <?php echo e(amount_with_currency_symbol(toFixed(0,0))); ?>

                        </b>
                    </li>
                        <?php if(get_static_option('display_price_in_the_shop') === 'exclusive'): ?>
                            <li class="list">
                                <small>
                                    <b><?php echo e(__('Exclusive tax')); ?></b>
                                    <?php echo e(__('means that tax is added on top of the retail price at the time of the sale.')); ?>

                                </small>
                            </li>
                        <?php endif; ?>
                <?php else: ?>
                    <li class="list"> <b> <?php echo e(__('Tax Amount')); ?> </b>
                        <b id="checkout_tax_amount">
                            <?php echo e(get_static_option('display_price_in_the_shop') == 'including' ? __('Inclusive Tax') : ''); ?>

                        </b>
                    </li>
                <?php endif; ?>
                <li class="list"> <b> <?php echo e(__('Total Delivery Cost')); ?> </b> <b id="checkout_delivery_cost">
                        <?php echo e(amount_with_currency_symbol(0)); ?> </b> </li>
                <li class="list"> <b> <?php echo e(__('Payment Amount')); ?> </b> <b id="total_payment_amount">
                        <?php echo e(amount_with_currency_symbol(0)); ?> </b> </li>
                <li class="list "> <b> <?php echo e(__('Total')); ?> </b> <b id="checkout_total">
                        <?php echo e(amount_with_currency_symbol(0)); ?> </b> </li>
            </ul>
        </div>

        <div class="payment-inlines mt-4">
            <h6 class="payment-label fw-500"> <?php echo e(__('Select Payment Method')); ?> </h6>

            

            <div class="payment-card">
                <?php echo render_payment_gateway_for_form(true); ?>

            </div>
        </div>

        <div class="checkbox-inlines mt-3">
            <?php
                $checkout_page_terms_text = get_static_option('checkout_page_terms_text');
                $checkout_page_terms_link_url = get_static_option('checkout_page_terms_link_url');
                $checkout_page_terms_link_url = $checkout_page_terms_link_url ? url($checkout_page_terms_link_url) : '#';

                $terms_text = str_replace(['[lnk]', '[/lnk]'], ["<a class='terms' href='$checkout_page_terms_link_url'>", '</a>'], $checkout_page_terms_text);
            ?>
            <input class="check-input" type="checkbox" id="terms_check" />
            <label class="checkbox-label" for="terms_check">
                <?php echo $terms_text; ?>

            </label>
        </div>

        
        <div class="btn-wrapper mt-3">
            <a href="#1" id="place_order" class="cmn-btn btn-bg-1 w-100 radius-0"> <?php echo e(__('Confirm Your Order')); ?>

            </a>
        </div>
        
        
        <div class="btn-wrapper mt-3">
            <a href="<?php echo e(route('frontend.products.cart')); ?>" class="cmn-btn btn-outline-steam w-100 radius-0">
                <?php echo e(__('Return to Cart')); ?> </a>
        </div>
    </div>
</div>


<style>

    .checkout-order-summery {
        position: sticky;
        top: 20px; /* Adjust as needed */
        overflow-y: auto; /* Allows scrolling if content is long */
        flex: 1;
    }

    .billing-form.checkout-billing-form{
        display: flex;
        align-items: flex-start;
    }
</style><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/cart/partials/order-summary.blade.php ENDPATH**/ ?>