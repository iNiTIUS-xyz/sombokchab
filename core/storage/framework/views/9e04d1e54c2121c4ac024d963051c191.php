<!DOCTYPE html>
<html class="no-js" lang="<?php echo e(App\Helpers\LanguageHelper::user_lang_slug()); ?>"
    dir="<?php echo e(App\Helpers\LanguageHelper::user_lang_dir()); ?>">

<head>
    <?php echo $__env->make('frontend.partials.google-analytics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(empty($global_static_field_data)): ?>
        <?php
            $global_static_field_data = [];
        ?>
    <?php endif; ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if(request()->routeIs('homepage')): ?>
        <meta name="description"
            content="<?php echo e(filter_static_option_value('site_meta_description', $global_static_field_data)); ?>">
        <meta name="tags" content="<?php echo e(filter_static_option_value('site_meta_tags', $global_static_field_data)); ?>">
    <?php else: ?>
        <?php echo $__env->yieldContent('page-meta-data'); ?>
    <?php endif; ?>
    <?php echo render_favicon_by_id(filter_static_option_value('site_favicon', $global_static_field_data)); ?>

    <?php echo load_google_fonts(); ?>


    <?php echo $__env->make('frontend.partials.css-variable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap5.min.css')); ?>">
    <!-- animate -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.css')); ?>">
    <!-- slick carousel  -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/slick.css')); ?>">
    <!-- LineAwesome -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/line-awesome.min.css')); ?>">
    <!-- Plugins css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins.cs')); ?>s">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">

    <?php echo $__env->yieldContent('style'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/toastr.css')); ?>">

    <?php if(!empty(filter_static_option_value('site_rtl_enabled', $global_static_field_data)) || get_user_lang_direction() == 'rtl'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/rtl.css')); ?>">
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/dynamic-style.css')); ?>">
    <?php echo $__env->make('frontend.partials.og-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        let siteurl = "<?php echo e(url('/')); ?>";
    </script>
    <?php echo filter_static_option_value('site_third_party_tracking_code', $global_static_field_data); ?>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
</head>

<?php
    $home_page_variant = $home_page ?? filter_static_option_value('home_page_variant', $global_static_field_data);
?>

<body>
    <!-- Header area Starts -->
    <header class="header-style-01">
        <?php
            $page_details = $page_details ?? ($page_post ?? '');
            $navbar_type = $page_details->navbar_variant ?? (get_static_option('global_navbar_variant') ?? 1);
        ?>

        <?php echo $__env->make('frontend.partials.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if($navbar_type == 3 || $navbar_type == 2): ?>
            <?php echo $__env->make('frontend.partials.header.header-variant-03', ['containerClass' => $navbar_type == 2 ? "container_1608" : ""], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('frontend.partials.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('frontend.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('frontend.partials.navbar-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </header>
    <div class="body-overlay"></div>
    <div class="body-overlay-desktop"></div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/partials/header.blade.php ENDPATH**/ ?>