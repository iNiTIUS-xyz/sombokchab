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
                        id="login_form_order_page" onsubmit="return validateLoginForm()">
                        <div class="error-wrap"></div>

                        <div class="single-input">
                            <label class="label-title mb-2"> <?php echo e(__("Phone Number or Email")); ?> </label>
                            <input class="form--control" type="text" id="login_phone" name="phone"
                                placeholder="<?php echo e(__("Type Phone Number with Country Code or Email")); ?>">
                            <small id="login_phone_error" class="text-danger"></small>
                        </div>
                        <div class="single-input mt-4">
                            <label class="label-title mb-2"> <?php echo e(__("Password")); ?> </label>
                            <input class="form--control" type="password" id="login_password" name="password"
                                placeholder="<?php echo e(__('Password')); ?>"
                                >
                            <small id="login_password_error" class="text-danger"></small>
                        </div>
                        <button class="btn-submit w-100" type="submit" id="login_btn"> <?php echo e(__("Sign In")); ?> </button>
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
                    <div class="signin-bottom-contents">
                        <div class="or-contents mb-2">
                            <span class="or-para"> <?php echo e(__("Or")); ?> </span>
                        </div>
                        <div class="signin-others">
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <?php if(get_static_option('enable_google_login')): ?>
                                        <a href="<?php echo e(route('login.google.redirect')); ?>" class="special-account">
                                            <img src="<?php echo e(asset('assets/frontend/img/icon/google-icon.svg')); ?>" alt="icon">
                                            <p class="special-account-para"><?php echo e(__("Login With Google")); ?></p>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                
                            </div>
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
        function validatePhoneOrEmail(value) {
            const phoneRegex = /^(\+855\d{8,9}|\+8801\d{9}|\+1\d{10})$/; // Phone number format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email format

            if (phoneRegex.test(value) || emailRegex.test(value)) {
                return ''; // Valid input
            }
            return 'Enter a valid phone number or email';
        }

        function validatePassword(value) {
            return value.trim() === '' ? 'Password is required' : '';
        }

        function validateLoginForm() {
            const phoneOrEmailField = document.getElementById('login_phone');
            const passwordField = document.getElementById('login_password');
            const phoneErrorField = document.getElementById('login_phone_error');
            const passwordErrorField = document.getElementById('login_password_error');

            // Validate phone/email
            const phoneOrEmailError = validatePhoneOrEmail(phoneOrEmailField.value.trim());
            phoneErrorField.textContent = phoneOrEmailError;

            // Validate password
            const passwordError = validatePassword(passwordField.value);
            passwordErrorField.textContent = passwordError;

            // Prevent form submission if there are errors
            return phoneOrEmailError === '' && passwordError === '';
        }

        // Real-time validation
        document.getElementById('login_phone').addEventListener('input', function () {
            const errorMessage = validatePhoneOrEmail(this.value.trim());
            document.getElementById('login_phone_error').textContent = errorMessage;
        });

        document.getElementById('login_password').addEventListener('input', function () {
            const errorMessage = validatePassword(this.value.trim());
            document.getElementById('login_password_error').textContent = errorMessage;
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/user/login.blade.php ENDPATH**/ ?>