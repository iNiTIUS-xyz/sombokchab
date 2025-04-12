<!-- Banner area Starts -->
<div class="banner__area padding-top-20 padding-bottom-">
    <div class="container container_1608">
        <div class="row g-4">
            <div class="col-xxl-4">
                <div class="banner__height">
                    <div class="row g-4">
                        <div class="col-xxl-12 col-lg-6">
                            <div class="banner__card bg__blue radius-5">
                                <div class="banner__card__flex">
                                    <div class="banner__card__contents">
                                        <span class="banner__card__subtitle mb-2"><?php echo e($section_one_sub_title); ?></span>
                                        <h2 class="banner__card__title"><?php echo e($section_one_title); ?></h2>
                                        <div class="btn_wrapper mt-4">
                                            <a href="<?php echo e($section_one_button_url ?? 'javascript:void(0)'); ?>"
                                                class="cmn_btn btn_bg_yellow radius-30"><?php echo e($section_one_button_text); ?></a>
                                        </div>
                                    </div>
                                    <div class="banner__card__thumb">
                                        <?php echo render_image($section_one_image); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-lg-6">
                            <div class="banner__card bg__yellow text-center radius-5">
                                <div class="banner__card__contents">
                                    <span class="banner__card__subtitle mb-2"><?php echo e($section_two_sub_title); ?></span>
                                    <h2 class="banner__card__title"><?php echo e($section_two_title); ?></h2>
                                </div>
                                <div class="banner__card__thumb">
                                    <?php echo render_image($section_two_image); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8">
                <div class="banner__slider bg__blue banner__height radius-5">
                    <div class="banner__slider__waveShape">
                        <img src="<?php echo e(asset('assets/frontend/img/banner/banner_waves.png')); ?>" alt="banner_waves">
                    </div>
                    <div class="global-slick-init dot-style-one slider-inner-margin" data-infinite="true"
                        data-arrows="false" data-dots="true" data-slidesToShow="1" data-swipeToSlide="true"
                        data-rtl="<?php echo e(get_user_lang_direction() == 'rtl' ? 'true' : 'false'); ?>"
                        data-autoplay="false" data-autoplaySpeed="2500"
                        data-prevArrow='<div class="prev-icon"><i class="las la-angle-left"></i></div>'
                        data-nextArrow='<div class="next-icon"><i class="las la-angle-right"></i></div>'
                        data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 1}},{"breakpoint": 1200,"settings": {"slidesToShow": 1}},{"breakpoint": 992,"settings": {"slidesToShow": 1}},{"breakpoint": 576, "settings": {"slidesToShow": 1} }]'>
                        


                        <?php $__currentLoopData = $repeater['background_image_'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="banner__slider__item">
                                <div class="banner__wrap">
                                    <div class="banner__contents">
                                        <span
                                            class="banner__contents__subtitle mb-3"><?php echo e($repeater['subtitle_'][$key] ?? ''); ?></span>
                                        <h2 class="banner__contents__title">
                                            <?php echo strip_tags($repeater['title_'][$key] ?? ''); ?>

                                        </h2>
                                        <div class="btn_wrapper mt-5 mt-lg-5">
                                            <?php if($repeater['button_text_'][$key] ?? false): ?>
                                                <a href="<?php echo e($repeater['button_url_'][$key]); ?>"
                                                    class="cmn_btn btn_bg_black radius-30">
                                                    <?php echo e($repeater['button_text_'][$key]); ?>

                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="banner__wrap__thumb">
                                        <?php echo render_image($repeater['background_image_'][$key] ?? 0); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner area end -->
<?php /**PATH C:\wamp64\www\sombokchab\core\app\Providers/../PageBuilder/views/banner/banner_style_nine.blade.php ENDPATH**/ ?>