<?php $__env->startSection('page-title'); ?>
    <?php echo e($campaign->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Shop area end -->
    <section class="shop-area padding-top-100 padding-bottom-100">
        <div class="container container-one">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-5">
                    <div class="shop-left">
                        <div class="single-shops">
                            <ul class="shop-flex-icon tabs">
                                <li class="shop-icons" data-tab="tab-grid">
                                    <a href="#1" class="icon"> <i class="las la-bars"></i> </a>
                                </li>
                                <li class="shop-icons active" data-tab="tab-grid2">
                                    <a href="#1" class="icon"> <i class="las la-border-all"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab-grid2" class="tab-content-item active">
                <div class="row mt-4">
                    <?php $__currentLoopData = $products['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal4deeb32099fed4b9eb9bbafb7a057418 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4deeb32099fed4b9eb9bbafb7a057418 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.campaign-grid-style-01','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.campaign-grid-style-01'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4deeb32099fed4b9eb9bbafb7a057418)): ?>
<?php $attributes = $__attributesOriginal4deeb32099fed4b9eb9bbafb7a057418; ?>
<?php unset($__attributesOriginal4deeb32099fed4b9eb9bbafb7a057418); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4deeb32099fed4b9eb9bbafb7a057418)): ?>
<?php $component = $__componentOriginal4deeb32099fed4b9eb9bbafb7a057418; ?>
<?php unset($__componentOriginal4deeb32099fed4b9eb9bbafb7a057418); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div id="tab-grid" class="tab-content-item">
                <div class="row mt-4">
                    <?php $__currentLoopData = $products['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginalbe1fbff3375088752084c62742f52e0b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbe1fbff3375088752084c62742f52e0b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'product::components.frontend.campaign-list-style-01','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('product::frontend.campaign-list-style-01'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbe1fbff3375088752084c62742f52e0b)): ?>
<?php $attributes = $__attributesOriginalbe1fbff3375088752084c62742f52e0b; ?>
<?php unset($__attributesOriginalbe1fbff3375088752084c62742f52e0b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbe1fbff3375088752084c62742f52e0b)): ?>
<?php $component = $__componentOriginalbe1fbff3375088752084c62742f52e0b; ?>
<?php unset($__componentOriginalbe1fbff3375088752084c62742f52e0b); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="custom-pagination mt-4 mt-lg-5">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <?php if($products['total_page'] > 1): ?>
                                    <?php if(!empty($products['previous_page'] ?? [])): ?>
                                        <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                            <a href="<?php echo e($products['previous_page']); ?>" class="page-link"
                                                aria-hidden="true">‹</a>
                                        </li>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = $products['links']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="page-item <?php echo e($loop->iteration == $products['current_page'] ? 'active' : ''); ?>"
                                            aria-current="page">
                                            <a href="<?php echo e($link); ?>" class="page-link"><?php echo e($loop->iteration); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if(!empty($products['next_page'] ?? [])): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo e($products['next_page']); ?>" rel="next"
                                                aria-label="Next »">›</a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop area end -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            loopcounter('campaign-counter');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/campaign/index.blade.php ENDPATH**/ ?>