<!-- All Product area Start -->
<section class="counter__area counter__shadow padding-top-20 padding-bottom-20 margin-top-50">
    <div class="container container_1608">
        <div class="row g-4">
            <?php $__currentLoopData = $settings['iconBoxThree']['title_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-sm-6">
                    <div class="counter__item text-center">
                        <div class="counter__item__icon">
                            <?php echo render_image($settings['iconBoxThree']["image_"][$key] ?? 0); ?>

                        </div>
                        <div class="counter__item__contents mt-3">
                            <h3 class="counter__item__title"><?php echo e($title); ?></h3>
                            <p class="counter__item__para mt-2">
                                <?php echo e($settings['iconBoxThree']['description_'][$key] ?? ''); ?>

                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<!-- All Product area ends --><?php /**PATH C:\xampp\htdocs\sombokchab\core\app\Providers/../PageBuilder/views/iconbox/iconbox-04.blade.php ENDPATH**/ ?>