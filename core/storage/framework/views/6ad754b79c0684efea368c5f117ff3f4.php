<style>
    :root {
        --main-color-one: <?php echo e(get_static_option('site_color')); ?> !important;
        --secondary-color: <?php echo e(get_static_option('site_secondary_color')); ?>;
        --heading-color: <?php echo e(get_static_option('site_heading_color')); ?> !important;
        --special-color: <?php echo e(get_static_option('site_special_color')); ?> !important;
        --paragraph-color: <?php echo e(get_static_option('site_paragraph_color')); ?> !important;
        --form-bg-color: <?php echo e(get_static_option('site_form_bg_color')); ?>;
        --footer-bg-color: <?php echo e(get_static_option('site_footer_bg_color')); ?>;
        <?php
            $heading_font_family = !empty(get_static_option('heading_font')) ? get_static_option('heading_font_family') :
              get_static_option('body_font_family')
               ?>
        --heading-font: "<?php echo e($heading_font_family); ?>",sans-serif;
        --body-font:"<?php echo e(get_static_option('body_font_family')); ?>",sans-serif;
        --extra-font: <?php echo get_static_option('extra_font_family') ?>, serif;
    }
</style><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/partials/css-variable.blade.php ENDPATH**/ ?>