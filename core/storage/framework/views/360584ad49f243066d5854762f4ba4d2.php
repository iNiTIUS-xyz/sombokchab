<div class="dashboard-top-contents mb-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="top-inner-contents search-area top-searchbar-wrapper">
                <div class="dashboard-flex-contetns">
                    <div class="dashboard-left-flex">
                        <span class="date-text"> 20 Jan, 2022 07:20pm </span>
                        <div class="d-flex align-items-center">
                            <h2 class="heading-two fw-500 mt-2"> Welcome, Happy Hour </h2>
                            <h2 class="mt-2 fw-500">&nbsp;- <?php echo e(auth('vendor')->user()->owner_name); ?></h2>
                        </div>

                        <?php if(auth('vendor')->user()->is_vendor_verified && auth('vendor')->user()->verified_at): ?>
                            <p class="text-success"><?php echo e(__('Verified Vendor')); ?></p>
                        <?php else: ?>
                            <p class="text-warning"><?php echo e(__('Not Verified Yet')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="dashboard-right-flex">
                        <div class="author-flex-contents">
                            <div class="author-icon">
                                <div class="single-icon-flex">
                                    <div class="single-icon notifications-parent">
                                        <?php if (isset($component)) { $__componentOriginal0f3dc6594714ebd279cc7a1931aa176c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f3dc6594714ebd279cc7a1931aa176c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.notification.header','data' => ['type' => 'vendor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('notification.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'vendor']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f3dc6594714ebd279cc7a1931aa176c)): ?>
<?php $attributes = $__attributesOriginal0f3dc6594714ebd279cc7a1931aa176c; ?>
<?php unset($__attributesOriginal0f3dc6594714ebd279cc7a1931aa176c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f3dc6594714ebd279cc7a1931aa176c)): ?>
<?php $component = $__componentOriginal0f3dc6594714ebd279cc7a1931aa176c; ?>
<?php unset($__componentOriginal0f3dc6594714ebd279cc7a1931aa176c); ?>
<?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="author-thumb-contents">
                                <div class="author-thumb">
                                    <?php
                                        $vendor = auth()->guard('vendor')->user();
                                        $profile_img = get_attachment_image_by_id($vendor->image, null, true);
                                    ?>
                                    <?php if(!empty($profile_img)): ?>
                                        <img src="<?php echo e($profile_img['img_url']); ?>" alt="<?php echo e($vendor->owner_name); ?>">
                                    <?php else: ?>
                                        <i class="las la-user"></i>
                                    <?php endif; ?>
                                </div>

                                <ul class="author-account-list">
                                    <li class="list"><a
                                            href="<?php echo e(route('vendor.profile.update')); ?>"><?php echo e(__('Edit Profile')); ?></a>
                                    </li>
                                    <li class="list"><a
                                            href="<?php echo e(route('vendor.password.change')); ?>"><?php echo e(__('Password Change')); ?></a>
                                    </li>
                                    <li class="list"><a href="<?php echo e(route('vendor.logout')); ?>"><?php echo e(__('Logout')); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/layouts/vendor/top-header.blade.php ENDPATH**/ ?>