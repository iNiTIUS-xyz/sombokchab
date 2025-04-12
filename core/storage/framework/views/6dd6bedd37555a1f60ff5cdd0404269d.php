<ul class="sub-menu mega-menu-inner category-megamenu">
    <li class="mega-menu-single-section">
        <ul class="mega-menu-main">
            <li>
                <h5 class="menu-title"><?php echo e(html_entity_decode($title)); ?></h5>
            </li>
            <?php $__currentLoopData = $mega_menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="round-menu-product">
                    <a href="<?php echo e(route("frontend.products.subcategory",["id" => $item->id,"slug" => $item->slug])); ?>">
                        <?php echo e(html_entity_decode($item->name)); ?>

                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </li>
</ul><?php /**PATH C:\wamp64\www\sombokchab\core\app\Providers/../MenuBuilder/CategoryMenu/views/style_three_category_menu.blade.php ENDPATH**/ ?>