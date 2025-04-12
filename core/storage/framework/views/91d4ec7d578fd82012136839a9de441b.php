<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('User Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("style"); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bodyUser_overlay"></div>
    <section class="login-page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="user-dashboard-wrapper">
                        <div class="mobile_nav">
                            <i class="las la-cogs"></i>
                        </div>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link bg-main text-white"><i
                                            class="lar la-user-circle"></i><?php echo e(optional(Auth::guard('web')->user())->name); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home')): ?> active <?php endif; ?>"
                                   href="<?php echo e(route('user.home')); ?>"><?php echo e(__('Dashboard')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home.edit.profile')): ?> active <?php endif; ?> "
                                   href="<?php echo e(route('user.home.edit.profile')); ?>"><?php echo e(__('Edit Profile')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home.change.password')): ?> active <?php endif; ?> "
                                   href="<?php echo e(route('user.home.change.password')); ?>"><?php echo e(__('Change Password')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.product.order.all')): ?> active <?php endif; ?>"
                                   href="<?php echo e(route('user.product.order.all')); ?>"><?php echo e(__('My Orders')); ?></a>
                            </li>
                            <?php if(moduleExists("Chat")): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if(request()->routeIs('frontend.chat.home')): ?> active <?php endif; ?>"
                                       href="<?php echo e(route('frontend.chat.home')); ?>"><?php echo e(__('Chat List')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(moduleExists("Refund")): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if(request()->routeIs('user.product.refund-request')): ?> active <?php endif; ?>"
                                       href="<?php echo e(route('user.product.refund-request')); ?>"><?php echo e(__('Refund Request')); ?></a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user-home.wallet.history')): ?> active <?php endif; ?>"
                                   href="<?php echo e(route('user-home.wallet.history')); ?>"><?php echo e(__('Wallet history')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.shipping.address.all')): ?> active <?php endif; ?>"
                                   href="<?php echo e(route('user.shipping.address.all')); ?>"><?php echo e(__('Shipping Address')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home.support.tickets')): ?> active <?php endif; ?>"
                                   href="<?php echo e(route('user.home.support.tickets')); ?>"><?php echo e(__('Support Ticket')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('user.logout')); ?>"
                                   onclick="event.preventDefault();document.getElementById('logout_submit_btn').dispatchEvent(new MouseEvent('click'));">
                                    <?php echo e(__('Logout')); ?>

                                </a>

                                <form id="logout-form" action="<?php echo e(route('user.logout')); ?>" method="POST"
                                      style="display: none;">
                                    <?php echo csrf_field(); ?>
                                    <button id="logout_submit_btn" type="submit"></button>
                                </form>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel">
                                <div class="message-show margin-top-10">
                                    <?php if (isset($component)) { $__componentOriginal5836ea34a6758bf192c104f6f2992c55 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5836ea34a6758bf192c104f6f2992c55 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.success','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5836ea34a6758bf192c104f6f2992c55)): ?>
<?php $attributes = $__attributesOriginal5836ea34a6758bf192c104f6f2992c55; ?>
<?php unset($__attributesOriginal5836ea34a6758bf192c104f6f2992c55); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5836ea34a6758bf192c104f6f2992c55)): ?>
<?php $component = $__componentOriginal5836ea34a6758bf192c104f6f2992c55; ?>
<?php unset($__componentOriginal5836ea34a6758bf192c104f6f2992c55); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalae73592a9186217aa45553528a0de34b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalae73592a9186217aa45553528a0de34b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalae73592a9186217aa45553528a0de34b)): ?>
<?php $attributes = $__attributesOriginalae73592a9186217aa45553528a0de34b; ?>
<?php unset($__attributesOriginalae73592a9186217aa45553528a0de34b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalae73592a9186217aa45553528a0de34b)): ?>
<?php $component = $__componentOriginalae73592a9186217aa45553528a0de34b; ?>
<?php unset($__componentOriginalae73592a9186217aa45553528a0de34b); ?>
<?php endif; ?>
                                </div>
                                <?php echo $__env->yieldContent('section'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            $('select[name="country"] option[value="<?php echo e(optional(auth()->guard('web')->user())->country); ?>"]').attr('selected', true);
        });

        $(document).on('click', '.bodyUser_overlay', function() {
            $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
        });

        $(document).on('click', '.mobile_nav', function() {
            $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/user/dashboard/user-master.blade.php ENDPATH**/ ?>