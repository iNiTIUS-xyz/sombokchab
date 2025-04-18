
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('frontend.partials.pages-portion.dynamic-page-builder-part', ['page_post' => $page_details], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left_side_content'); ?>
    <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page_left_sidebar', $page_details->id); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('right_side_content'); ?>
    <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page_right_sidebar', $page_details->id); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function (){
            loopcounter("loopCounter_global")
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/frontend-home.blade.php ENDPATH**/ ?>