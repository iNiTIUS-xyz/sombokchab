<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'all_products'
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'all_products'
]); ?>
<?php foreach (array_filter(([
    'all_products'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if(($all_products['total_page'] ?? 0) > 1): ?>
    <ul class="pagination-list">
        <?php $__currentLoopData = $all_products["links"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a data-page-index="<?php echo e($loop->iteration); ?>" href="<?php echo e($link); ?>"
                   class="page-number <?php echo e($loop->iteration == $all_products["current_page"] ? "current" : ""); ?>">
                    <?php echo e($loop->iteration); ?>

                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?><?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/components/search-product-list-pagination.blade.php ENDPATH**/ ?>