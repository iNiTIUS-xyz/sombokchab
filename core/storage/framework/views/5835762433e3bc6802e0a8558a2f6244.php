<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e($page_post->meta_description); ?>">
    <meta name="tags" content="<?php echo e($page_post->meta_tags); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title'); ?>
    <?php echo e($page_post->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e($page_post->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('og-meta'); ?>
    <meta name="og:title" content="<?php echo e($page_post->title); ?>">
    <meta name="og:description" content="<?php echo e($page_post->meta_description); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($page_post->page_builder_status == 0): ?>
        <div class="container padding-top-100 padding-bottom-50">
            <?php echo $page_post->content; ?>

        </div>
    <?php else: ?>
        <?php echo $__env->make('frontend.partials.pages-portion.dynamic-page-builder-part', ['page_post' => $page_post], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('left_side_content'); ?>
    <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page(
        'dynamic_page_left_sidebar',
        $page_post->id,
    ); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('right_side_content'); ?>
    <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page(
        'dynamic_page_right_sidebar',
        $page_post->id,
    ); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/pages/dynamic-single.blade.php ENDPATH**/ ?>