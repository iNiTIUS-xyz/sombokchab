<form action="<?php echo e(route("frontend.ajax.products.search")); ?>" method="get" id="search_product" style="display: none">
    <?php echo csrf_field(); ?>
    <?php if($vendor ?? null): ?>
        <input type="hidden" id="vendor_username" name="vendor_username" value="<?php echo e($vendor->username ?? ''); ?>">
    <?php endif; ?>
    <input type="hidden" id="name" name="name" value="<?php echo e(request()->name ?? ''); ?>">
    <input type="hidden" id="brand" name="brand" value="<?php echo e(request()->brand ?? ''); ?>">
    <input type="hidden" id="category" name="category" value="<?php echo e(request()->category ?? ''); ?>">
    <input type="hidden" id="sub_category" name="sub_category" value="<?php echo e(request()->sub_category ?? ''); ?>">
    <input type="hidden" id="child_category" name="child_category" value="<?php echo e(request()->child_category ?? ''); ?>">
    <input type="hidden" id="color" name="color" value="<?php echo e(request()->color ?? ''); ?>">
    <input type="hidden" id="size" name="size" value="<?php echo e(request()->size ?? ''); ?>">
    <input type="hidden" id="delivery_option" name="delivery_option" value="<?php echo e(request()->delivery_option ?? ''); ?>">
    <input type="hidden" id="min_price" name="min_price" value="<?php echo e(request()->min_price ?? ''); ?>">
    <input type="hidden" id="max_price" name="max_price" value="<?php echo e(request()->max_price ?? ''); ?>">
    <input type="hidden" id="rating" name="rating" value="<?php echo e(request()->rating ?? ''); ?>">
    <input type="hidden" id="search_order_by" name="order_by" value="<?php echo e(request()->order_by ?? ''); ?>">
    <input type="hidden" id="search_page" name="page" value="<?php echo e(request()->page ?? ''); ?>">
    <input type="hidden" id="search_country" name="country" value="<?php echo e(request()->country?? ''); ?>">
    <input type="hidden" id="search_city" name="city" value="<?php echo e(request()->city?? ''); ?>">
    <input type="hidden" id="search_state" name="state" value="<?php echo e(request()->state?? ''); ?>">
</form>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/partials/product/product-filter-form.blade.php ENDPATH**/ ?>