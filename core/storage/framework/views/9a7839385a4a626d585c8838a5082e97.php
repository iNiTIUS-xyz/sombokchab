<?php echo $__env->make('frontend.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>

<!-- Left Right area starts -->
<div class="left-right-area">
    <div class="container container-one">
        <div class="row flex-xxl-row flex-column-reverse">
            <div class="col-xxl-3">
                <?php echo $__env->yieldContent('left_side_content'); ?>
            </div>
            <div class="col-xxl-9">
                <?php echo $__env->yieldContent('right_side_content'); ?>
            </div>
        </div>
    </div>
</div>
<!-- Left Right area ends -->

<!-- back to top area start -->
<div class="back-to-top bg-color-two">
    <span class="back-top"> <i class="las la-angle-up"></i> </span>
</div>
<!-- back to top area end -->

<?php echo $__env->make('frontend.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/frontend-page-master.blade.php ENDPATH**/ ?>