<!-- Category area Starts -->
<section class="category__area padding-top-20 padding-bottom-20">
    <div class="container container_1608">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-left section_borderBottom">
                    <h2 class="title"><?php echo e($section_title); ?></h2>
                    <div class="append_category"></div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="category__slider">
                    <div class="global-slick-init slider-inner-margin" data-appendArrows=".append_category"
                         data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="9"
                         data-swipeToSlide="true"
                         data-autoplay="false" data-autoplaySpeed="2500"
                         data-rtl="<?php echo e(get_user_lang_direction() == 'rtl' ? 'true' : 'false'); ?>"
                         data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                         data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>'
                         data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 7}},{"breakpoint": 1200,"settings": {"slidesToShow": 5}},{"breakpoint": 992,"settings": {"slidesToShow": 4}},{"breakpoint": 768,"settings": {"slidesToShow": 3}},{"breakpoint": 500, "settings": {"slidesToShow": 2} }]'>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="category__slider__item">
                                <a href="<?php echo e(route('frontend.products.category', $category->slug)); ?>">
                                    <div class="single__category text-center">
                                        <div class="single__category__thumb">
                                            <?php echo render_image($category->image); ?>

                                        </div>
                                        <div class="single__category__contents mt-3">
                                            <h6 class="single__category__title"><?php echo e($category->name); ?></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Category area end -->
<?php /**PATH C:\xampp\htdocs\sombokchab\core\app\Providers/../PageBuilder/views/category/choose-category-two.blade.php ENDPATH**/ ?>