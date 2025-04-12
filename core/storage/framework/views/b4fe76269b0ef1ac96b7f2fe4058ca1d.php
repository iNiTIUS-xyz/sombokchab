<!-- Promo area start -->
<section class="promo_area padding-top-20 padding-bottom-20">
    <div class="container container_1608">
        <div class="promo__wrapper bg-white">
            <div class="row gy-4 gx-2">
                <?php $__currentLoopData = ($settings['iconBoxThree']['title_'] ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                    <div class="promo__item">
                        <div class="promo__item__flex">
                            <div class="promo__item__icon">
                                <?php echo render_image($settings['iconBoxThree']["image_"][$key] ?? 0); ?>

                            </div>
                            <div class="promo__item__contents">
                                <h4 class="promo__item__title"><?php echo e($title); ?></h4>
                                <p class="promo__item__para mt-1">
                                    <?php echo e($settings['iconBoxThree']['description_'][$key] ?? ''); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<!-- Promo area end --><?php /**PATH C:\wamp64\www\sombokchab\core\app\Providers/../PageBuilder/views/iconbox/iconbox-03.blade.php ENDPATH**/ ?>