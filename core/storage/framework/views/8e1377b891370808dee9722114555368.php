

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Customer Sign In')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="signin-area padding-top-20 padding-bottom-20">
        <div class="container-three">
            <div class="signin-wrappers">
                <div class="signin-contents">
                    <form action="<?php echo e(route('user.login')); ?>" method="post" class="login-form padding-top-20 register-form"
                        id="login_form_order_page" onsubmit="return validateLoginForm()">
                        <?php echo csrf_field(); ?>
                        <div class="error-wrap"></div>
                        <div class="alert alert-success showLoginRedirect" style="display: none;"></div>
                        <div class="single-input">
                            <div class="phone-input">
                                <label class="label-title mb-2"> <?php echo e(__('Phone Number')); ?> </label>
                                <div class="d-flex">
                                    <select id="phone_country_code" class="form-select"
                                        style="width: 30% !important; border: 1px solid rgba(221, 221, 221, 0.4) !important; box-shadow: 0 0 10px rgba(255, 255, 255, 0.1) !important;">
                                        <option value="+1" selected>+1</option>
                                        <option value="+880">+880</option>
                                        <option value="+855">+855</option>
                                    </select>
                                    <input id="number" name="phone" type="number" class="form--control radius-10"
                                        placeholder="<?php echo e(__('Phone Number')); ?>" required
                                        style="width: 70% !important; border-radius: 0px;">
                                </div>
                                <small id="login_phone_error" class="text-danger"></small>
                            </div>
                            <div class="email-input" style="display: none;">
                                <label class="label-title mb-2"> <?php echo e(__('Email')); ?> </label>
                                <input class="form--control" type="email" name="email" id="login_email"
                                    placeholder="<?php echo e(__('Type Email')); ?>" required>
                                <small id="login_email_error" class="text-danger"></small>
                            </div>
                            <div class="toggle-input-type mb-3 text-end">
                                <button type="button" id="togglePhoneEmail"
                                    style="background: transparent; border: none; text-decoration: underline;">
                                    <?php echo e(__('Use Email')); ?>

                                </button>
                            </div>
                        </div>
                        <!-- Password Input with Toggle Eye -->
                        <div class="single-input">
                            <label class="label-title mb-2"> <?php echo e(__('Password')); ?> </label>
                            <div class="position-relative">
                                <input class="form--control" type="password" id="login_password" name="password"
                                    placeholder="<?php echo e(__('Type Password')); ?>">
                                <div class="toggle-password position-absolute"
                                    style="right: 10px; top: 45%; transform: translateY(-50%); cursor: pointer;">
                                    <span class="hide-icon" style="display: inline;">
                                        <i class="las la-eye-slash"></i>
                                    </span>
                                    <span class="show-icon" style="display: none;">
                                        <i class="las la-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <small id="login_password_error" class="text-danger"></small>
                        </div>

                        <div class="dashboard-btn-wrapper">
                            <button type="submit" id="login_btn" class="btn-submit dashboard-bg w-100">
                                <?php echo e(__('Sign In')); ?>

                            </button>
                        </div>
                    </form>
                    <div class="single-checbox mt-3">
                        <div class="checkbox-inlines">
                            <input class="check-input" type="checkbox" id="login_remember" name="remember">
                            <label class="checkbox-label" for="login_remember"> <?php echo e(__('Remember Me')); ?> </label>
                        </div>
                        <div class="forgot-password">
                            <a href="<?php echo e(route('user.forget.password')); ?>" class="forgot-btn color-one">
                                <?php echo e(__('Forgot Password?')); ?> </a>
                        </div>
                    </div>
                    <div class="dashboard-bottom-contents" style="display: flex; justify-content: center;">
                        <div class="account-bottom">
                            <span class="account-title mt-3"> <?php echo e(__("Don't have an account?")); ?> </span>
                            <a href="<?php echo e(route('user.register')); ?>" class="signup-login mt-3">
                                <?php echo e(__('Sign Up')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                    let isEmail = $('.email-input').is(':visible');
                    let phone = $('#number').val();
                    let email = $('#login_email').val();
                    let password = $('#login_password').val();
                    let remember = $('#login_remember').is(':checked');
                    let countryCode = $('#phone_country_code').val();
    
                    let loginInput = isEmail ? email : (countryCode + phone);
    
                    el.text('<?php echo e(__('Please Wait')); ?>');
    
                    $.ajax({
                        type: 'post',
                        url: "<?php echo e(route('user.ajax.login')); ?>",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            [isEmail ? 'phone' : 'phone']: loginInput,
                            password: password,
                            remember: remember,
                        },
                        success: function(data) {
                            if (data.status === 'invalid') {
                                el.text('<?php echo e(__('Sign In')); ?>');
                                formContainer.find('.error-wrap').html(
                                    '<div class="alert alert-danger">' + data.msg +
                                    '</div>');
                            } else {
                                formContainer.find('.error-wrap').html('');
                                $(".showLoginRedirect").show();
                                $(".showLoginRedirect").text(data.msg);
                                setTimeout(function() {
                                    location.reload();
                                }, 500);
                            }
                        },
                        error: function(data) {
                            console.log('Error Response:', data.responseJSON);
                            let response = data.responseJSON.errors || {};
                            formContainer.find('.error-wrap').html(
                                '<ul class="alert alert-danger"></ul>');
                            $.each(response, function(key, errors) {
                                formContainer.find('.error-wrap ul').append('<li>' +
                                    capitalizeFirstLetter(errors[0]) + '</li>');
                            });
                            el.text('<?php echo e(__('Sign In')); ?>');
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
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('login_password');
            const showIcon = document.querySelector('.show-icon');
            const hideIcon = document.querySelector('.hide-icon');

            showIcon.addEventListener('click', function() {
                passwordInput.type = 'text';
                showIcon.style.display = 'none';
                hideIcon.style.display = 'inline';
            });

            hideIcon.addEventListener('click', function() {
                passwordInput.type = 'password';
                showIcon.style.display = 'inline';
                hideIcon.style.display = 'none';
            });
        });
        // Toggle Phone/Email
        document.getElementById('togglePhoneEmail').addEventListener('click', function() {
            const phoneInput = document.querySelector('.phone-input');
            const emailInput = document.querySelector('.email-input');
            const toggleButton = this;

            if (phoneInput.style.display === 'none') {
                phoneInput.style.display = 'block';
                emailInput.style.display = 'none';
                toggleButton.textContent = '<?php echo e(__('Use Email')); ?>';
            } else {
                phoneInput.style.display = 'none';
                emailInput.style.display = 'block';
                toggleButton.textContent = '<?php echo e(__('Use Phone')); ?>';
            }
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const phoneInputDiv = document.querySelector('.phone-input');
            const emailInputDiv = document.querySelector('.email-input');
            const toggleButton = document.getElementById('togglePhoneEmail');
            const phoneInput = document.getElementById('number');
            const emailInput = document.getElementById('login_email');
            const countryCode = document.getElementById('phone_country_code');
            const rememberCheckbox = document.getElementById('login_remember');

            // Load from cookies
            const rememberedType = getCookie("remembered_type");
            const rememberedValue = getCookie("remembered_value");
            const rememberedCode = getCookie("remembered_code");

            if (rememberedType === "email") {
                phoneInputDiv.style.display = "none";
                emailInputDiv.style.display = "block";
                toggleButton.textContent = '<?php echo e(__('Use Phone')); ?>';
                emailInput.value = rememberedValue;
                rememberCheckbox.checked = true;
            } else if (rememberedType === "phone") {
                phoneInputDiv.style.display = "block";
                emailInputDiv.style.display = "none";
                toggleButton.textContent = '<?php echo e(__('Use Email')); ?>';
                phoneInput.value = rememberedValue;
                if (rememberedCode) {
                    countryCode.value = rememberedCode;
                }
                rememberCheckbox.checked = true;
            }

            // Save input value on login click
            document.getElementById('login_btn').addEventListener('click', function() {
                const isEmail = emailInputDiv.style.display === "block";
                if (rememberCheckbox.checked) {
                    if (isEmail) {
                        setCookie("remembered_type", "email", 7);
                        setCookie("remembered_value", emailInput.value, 7);
                    } else {
                        setCookie("remembered_type", "phone", 7);
                        setCookie("remembered_value", phoneInput.value, 7);
                        setCookie("remembered_code", countryCode.value, 7);
                    }
                } else {
                    eraseCookie("remembered_type");
                    eraseCookie("remembered_value");
                    eraseCookie("remembered_code");
                }
            });
        });

        // Cookie Helpers
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function eraseCookie(name) {
            document.cookie = name + "=; Max-Age=-99999999;";
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/user/login.blade.php ENDPATH**/ ?>