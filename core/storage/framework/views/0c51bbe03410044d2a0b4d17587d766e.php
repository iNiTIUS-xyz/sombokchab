<?php
    $product = $product ?? null;
    $avg_rattings = $avgRattings ?? null;
    $ratingCount = $ratingCount ?? null;
?>

<?php if(!empty($product)): ?>
    <?php
        $rating_width = round(($product->reviews_avg_rating ?? 0) * 20);
    ?>

    <div class="ratings <?php echo e($rating_width == 0 ? "d-none" : ""); ?>">
        <span class="hide-rating"></span>
        <span class="show-rating" style="width: <?php echo e($rating_width); ?>%!important"></span>
    </div>
    <p> <span class="total-ratings"><?php echo e($product->reviews_count ? "(". $product->reviews_count .")" : ""); ?></span></p>
<?php elseif(!empty($avg_rattings)): ?>
    <?php
        $rating_width = round(($avg_rattings) * 20);
    ?>

    <div class="ratings <?php echo e($rating_width == 0 ? "d-none" : ""); ?>">
        <span class="hide-rating"></span>
        <span class="show-rating" style="width: <?php echo e($rating_width); ?>%!important"></span>
    </div>
    <?php if($ratingCount): ?>
        <p> <span class="total-ratings"><?php echo e($ratingCount ? "(". $ratingCount .")" : ""); ?></span></p>
    <?php endif; ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Product\Resources/views/components/frontend/common/rating-markup.blade.php ENDPATH**/ ?>