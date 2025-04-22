
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Sign In')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- SignIn Area Starts -->
    <section class="signin-area padding-top-20 padding-bottom-20">
        <div class="container-three">
            <div class="signin-wrappers">
                <div class="signin-contents">
                    
                    <form action="<?php echo e(route('user.login')); ?>" method="post" class="login-form padding-top-20 register-form"
                        id="login_form_order_page">
                        <div class="error-wrap"></div>
                        <?php echo csrf_field(); ?>
                        <div class="single-input">
                            <label class="label-title mb-2"> <?php echo e(__("Phone Number or Email")); ?> </label>
                            <input class="form--control" type="text" id="login_phone" name="phone"
                                placeholder="<?php echo e(__("Type Phone Number without Country Code or Email")); ?>">
                            <small id="login_phone_error" class="text-danger"></small>
                        </div>

                        <div class="dashboard-input mt-4">
                            <label class="label-title mb-2"> <?php echo e(__('Password')); ?> </label>
                            <input class="form--control" name="password" id="login_password" type="password"
                                placeholder="<?php echo e(__('Type Password')); ?>">
                            <div class="toggle-password">
                                <span class="show-icon" style="display: inline;"> <i class="las la-eye-slash"></i> </span>
                                <span class="hide-icon" style="display: none;"> <i class="las la-eye"></i> </span>
                            </div>
                            <small id="login_password_error" class="text-danger"></small>
                        </div>

                        
                        <div class="dashboard-btn-wrapper mt-4">
                            <button type="submit" class="btn-submit dashboard-bg w-100"> <?php echo e(__('Sign In')); ?></button>
                        </div>
                    </form>

                    
                    
                    
                    <div class="single-checbox mt-3">
                        <div class="checkbox-inlines">
                            <input class="check-input" type="checkbox" id="login_remember" name="remember">
                            <label class="checkbox-label" for="login_remember"> <?php echo e(__("Remember Me")); ?> </label>
                        </div>
                        <div class="forgot-password">
                            <a href="<?php echo e(route('user.forget.password')); ?>" class="forgot-btn color-one"> <?php echo e(__("Forgot Password?")); ?> </a>
                        </div>
                    </div>
                    
                    <div class="dashboard-bottom-contents">
                        <div class="account-bottom">
                            <span class="account-title mt-3"> <?php echo e(__("Don't have an account?")); ?> </span>
                            <a href="<?php echo e(route('user.register')); ?>" class="signup-login mt-3">
                                <?php echo e(__('Sign up')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SignIn Area end -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('frontend.partials.google-captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.gdpr-cookie', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.inline-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.twakto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if (isset($component)) { $__componentOriginal736127cac1f97bc67262d6f79cdd5eaf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal736127cac1f97bc67262d6f79cdd5eaf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sweet-alert-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sweet-alert-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal736127cac1f97bc67262d6f79cdd5eaf)): ?>
<?php $attributes = $__attributesOriginal736127cac1f97bc67262d6f79cdd5eaf; ?>
<?php unset($__attributesOriginal736127cac1f97bc67262d6f79cdd5eaf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal736127cac1f97bc67262d6f79cdd5eaf)): ?>
<?php $component = $__componentOriginal736127cac1f97bc67262d6f79cdd5eaf; ?>
<?php unset($__componentOriginal736127cac1f97bc67262d6f79cdd5eaf); ?>
<?php endif; ?>
    <script src="<?php echo e(asset('assets/common/js/toastr.min.js')); ?>"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $(document).on('click', '#login_btn', function(e) {
                    e.preventDefault();
                    let formContainer = $('#login_form_order_page');
                    let el = $(this);
                    let phone = $('#login_form_order_page #login_phone').val();
                    let password = $('#login_form_order_page #login_password').val();
                    let remember = $('#login_form_order_page #login_remember').val();

                    el.text('<?php echo e(__('Please Wait')); ?>');

                    $.ajax({
                        type: 'post',
                        url: "<?php echo e(route('user.ajax.login')); ?>",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            phone: phone,
                            password: password,
                            remember: remember,
                        },
                        success: function(data) {
                            if (data.status === 'invalid') {
                                el.text('<?php echo e(__('Login')); ?>');
                                formContainer.find('.error-wrap').html(
                                    '<div class="alert alert-danger">' + data.msg +
                                    '</div>');
                            } else {
                                formContainer.find('.error-wrap').html('');
                                el.text('<?php echo e(__('Login Success.. Redirecting ..')); ?>');
                                setTimeout(function() {
                                    location.reload();
                                }, 500);
                            }
                        },
                        error: function(data) {
                            let response = data['responseJSON']['errors'];

                            formContainer.find('.error-wrap').html(
                                '<ul class="alert alert-danger"></ul>');
                            $.each(response, function(value, index) {
                                formContainer.find('.error-wrap ul').append('<li>' +
                                    capitalizeFirstLetter(index[0]) + '</li>');
                            });
                            el.text('<?php echo e(__('Login')); ?>');
                        }
                    });
                });

                $('.nav-item .nav-link').on('click', function() {
                    $('#forgot-password').removeClass('active');
                });
            });
        })(jQuery)

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>

    

    <script>
        // Toggle Password Visibility
        const passwordInput = document.getElementById('login_password');
            const showIcon = document.querySelector('.show-icon');
            const hideIcon = document.querySelector('.hide-icon');

            showIcon.addEventListener('click', function () {
                passwordInput.type = 'text';
                showIcon.style.display = 'none';
                hideIcon.style.display = 'inline';
            });

            hideIcon.addEventListener('click', function () {
                passwordInput.type = 'password';
                showIcon.style.display = 'inline';
                hideIcon.style.display = 'none';
            });
    </script>

    <!-- JavaScript for Toggle Functionality and Password Visibility -->
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/user/login.blade.php ENDPATH**/ ?>