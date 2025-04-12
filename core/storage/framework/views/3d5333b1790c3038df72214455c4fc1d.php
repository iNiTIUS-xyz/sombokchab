<!-- Breadcrumb area Starts -->
<div class="breadcrumb-area breadcrumb-padding bg-item-badge">
    <div class="breadcrumb-shapes">
        <img src="<?php echo e(asset('assets/img/shop/badge-s1.png')); ?>" alt="">
        <img src="<?php echo e(asset('assets/img/shop/badge-s2.png')); ?>" alt="">
        <img src="<?php echo e(asset('assets/img/shop/badge-s3.png')); ?>" alt="">
    </div>
    <div class="container container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-contents">
                    <h2 class="details-title">
                        <?php echo e($title); ?>

                    </h2>
                    <ul class="breadcrumb-list">
                        <li class="list"><a href="<?php echo e(route('homepage')); ?>"> <?php echo e(__('Home')); ?></a></li>
                        <li class="list"><a href="<?php echo e($routeName); ?>"><?php echo e($innerTitle); ?> </a></li>
                        <?php if(isset($subInnerTitle) && $subInnerTitle): ?>
                         <li class="list"><a href="<?php echo e($subRouteName); ?>"><?php echo e($subInnerTitle ?? ''); ?> </a></li>
                        <?php endif; ?>
                        <?php if(isset($chidInnerTitle) && !empty($chidInnerTitle)): ?>
                         <li class="list"><a href="<?php echo e($childRouteName); ?>"><?php echo e($chidInnerTitle ?? ''); ?> </a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area end --><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/components/frontend/breadcrumb/frontend-breadcrumb.blade.php ENDPATH**/ ?>