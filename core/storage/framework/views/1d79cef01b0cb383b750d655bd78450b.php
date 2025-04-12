<?php
    $attributes = $product?->inventory_detail_count ?? null;
?>

<?php if(isset($attributes) && $attributes > 0): ?>
    <li class="lists">
        <a class="product-quick-view-ajax favourite icon cart-loading" href="#1"
           data-action-route="<?php echo e(route('frontend.products.single-quick-view', $product->slug)); ?>">
            <i class="las la-shopping-bag"></i>
        </a>
    </li>
<?php else: ?>
    <li class="lists">
        <a href="#1" data-attributes="<?php echo e($product->attribute); ?>" data-id="<?php echo e($product->id); ?>"
           class="icon cart-loading <?php echo e(($isAllowBuyNow ?? false) ? "add_to_buy_now_ajax" : "add_to_cart_ajax"); ?>" >
            <i class="las la-shopping-bag"></i>
        </a>
    </li>
<?php endif; ?>

<?php if(isset($attributes) && $attributes > 0): ?>
    <li class="lists">
        <a class="product-quick-view-ajax favourite icon cart-loading" href="#1"
           data-action-route="<?php echo e(route('frontend.products.single-quick-view', $product->slug)); ?>">
            <i class="lar la-heart"></i>
        </a>
    </li>
<?php else: ?>
    <li class="lists">
        <a href="#1" data-id="<?php echo e($product->id); ?>" class="favourite add_to_wishlist_ajax icon cart-loading">
            <i class="lar la-heart"></i>
        </a>
    </li>
<?php endif; ?>

<li class="lists">
    <a href="#1" data-id="<?php echo e($product->id); ?>" class="favourite add_to_compare_ajax icon cart-loading">
        <i class="las la-retweet"></i>
    </a>
</li>

<li class="lists">
    <a class="product-quick-view-ajax favourite icon cart-loading" href="#1"
       data-action-route="<?php echo e(route('frontend.products.single-quick-view', $product->slug)); ?>">
        <i class="lar la-eye"></i>
    </a>
</li><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/components/frontend/common/link-option.blade.php ENDPATH**/ ?>