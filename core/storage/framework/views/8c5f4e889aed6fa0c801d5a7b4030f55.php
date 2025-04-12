<?php
    $visibility_class = '';

    if (request()->routeIs('frontend.dynamic.page')) {
        if (isset($page_post) && !$page_post->breadcrumb_status) {
            $visibility_class = 'd-none';
        }
    }

    if (request()->routeIs('homepage')) {
        $visibility_class = 'd-none';
        if (isset($page_details) && $page_details->breadcrumb_status) {
            $visibility_class = '';
        }
    } elseif (request()->routeIs('frontend.vendors.single')) {
        $visibility_class = 'd-none';
    }
?>


<?php if(Route::currentRouteName() != 'frontend.products.single'): ?>
    <!-- Breadcrumb area Starts -->
    <div class="breadcrumb-area breadcrumb-padding bg-item-badge <?php echo e($visibility_class); ?>">
        <div class="breadcrumb-shapes">
            <img src="<?php echo e(asset('assets/img/shop/badge-s1.png')); ?>" alt="">
            <img src="<?php echo e(asset('assets/img/shop/badge-s2.png')); ?>" alt="">
            <img src="<?php echo e(asset('assets/img/shop/badge-s3.png')); ?>" alt="">
        </div>

        <div class="container container-one">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-contents">
                        <h2 class="breadcrumb-title">
                             <?php echo $__env->yieldContent('page-title'); ?>
                        </h2>

                        
                        <ul class="breadcrumb-list">
                            <?php if(Route::currentRouteName() === 'frontend.products.single'): ?>
                                <?php echo $__env->yieldContent('product-category'); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area end -->
<?php endif; ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/partials/breadcrumb.blade.php ENDPATH**/ ?>