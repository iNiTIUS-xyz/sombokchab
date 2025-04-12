<div class="category-megamenu">
    <?php $__currentLoopData = $mega_menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="single-category-megamenu text-center border-1">
            <ul class="mega-menu-main">
                <li class="round-menu-product">
                    <a href="<?php echo e(route("frontend.products.subcategory",["id" => $item->id,"slug" => $item->slug])); ?>">
                        <?php if(!empty($item->image)): ?>
                            <?php echo render_image($item->image); ?>

                        <?php else: ?>
                            <img src="<?php echo e(asset('assets/uploads/no-image.png')); ?>">
                        <?php endif; ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route("frontend.products.subcategory",["id" => $item->id,"slug" => $item->slug])); ?>">
                        <h5 class="menu-title-x style-two-category-heading"><?php echo e($item->name); ?></h5>
                    </a>
                </li>
            </ul>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\app\Providers/../MenuBuilder/CategoryMenu/views/style_two_category_menu.blade.php ENDPATH**/ ?>