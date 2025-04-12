<div class="thumb-top-contents right-side">
    <?php if($campaign_percentage > 0): ?>
        <span class="percent-box bg-color-two radius-5"> -<?php echo e(round($campaign_percentage,0)); ?>% </span>
    <?php endif; ?>
    <?php if(!empty($product?->badge)): ?>
        <span class="percent-box bg-color-stock radius-5"> <?php echo e($product?->badge?->name); ?> </span>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Product\Resources/views/components/frontend/common/badge-and-discount.blade.php ENDPATH**/ ?>