<div class="category-megamenu">
    <?php $__currentLoopData = $mega_menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="single-megamenu">
            <h5 class="submenu-title"> <?php echo e($item->name); ?> </h5>
                <?php
                    $sub_category_id = $item->id;

                    $products = $item->product;
                ?>
                <?php if($products->isNotEmpty()): ?>
                    <?php $__currentLoopData = $products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-category-megamenu text-center border-1">
                            <?php
                            $campaign_product = !is_null($product->campaignProduct) ? $product->campaignProduct : getCampaignProductById($product->id);
                            $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
                            $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
                            $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
                            ?>
                            <h5 class="submenu-title"><?php echo e($product->name); ?></h5>
                            <div class="image-contents">
                                <div class="category-thumb">
                                    <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>">
                                        <?php echo render_image($product->image); ?>

                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\xampp\htdocs\sombokchab\core\app\Providers/../MenuBuilder/CategoryMenu/views/style_one_category_menu.blade.php ENDPATH**/ ?>