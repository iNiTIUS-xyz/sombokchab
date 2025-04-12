<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Sign Up')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="sign-in-area-wrapper padding-top-20 padding-bottom-20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6">
                <div class="sign-in register">
                    <div class="form-wrapper custom__form mt-4">
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
                        <?php if (isset($component)) { $__componentOriginal54abcd52ec2e8ec857d4d6feae648c79 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.flash','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.flash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79)): ?>
<?php $attributes = $__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79; ?>
<?php unset($__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54abcd52ec2e8ec857d4d6feae648c79)): ?>
<?php $component = $__componentOriginal54abcd52ec2e8ec857d4d6feae648c79; ?>
<?php unset($__componentOriginal54abcd52ec2e8ec857d4d6feae648c79); ?>
<?php endif; ?>

                        
                        <div class="alert alert-danger" id="error" style="display: none;"></div>
                        <div class="alert alert-success" id="sentSuccess" style="display: none;">OTP Sent Successfully!</div>
                        <div class="alert alert-success" id="verifiedSuccess" style="display: none;">Account Created Successfully!</div>

                        <!-- Step 1: Account Details and Phone Number -->
                        <div id="step-1">
                            <form id="account-form" method="post" enctype="multipart/form-data" novalidate>
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <input type="hidden" name="phone" id="verified_phone">

                                <div class="row">
                                    <!-- Phone and Country Code -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> <?php echo e(__('Phone Number *')); ?> </label>
                                            <div class="input-group">
                                                <select name="phone_country_code" id="phone_country_code" class="form-select" required>
                                                    <option value="+1" selected>+1</option>
                                                    <option value="+880">+880</option>
                                                    <option value="+855">+855</option>
                                                </select>
                                                <input type="text" id="number" name="phone"
                                                       class="form--control radius-10"
                                                       placeholder="Phone Number *" style="width: unset" required>
                                            </div>
                                            <small class="text-danger" id="phoneError"></small>
                                        </div>
                                    </div>

                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> <?php echo e(__('Name *')); ?> </label>
                                            <input type="text" name="name" id="name"
                                                   class="form-control" placeholder="<?php echo e(__('Name *')); ?>" required>
                                            <small class="text-danger" id="nameError"></small>
                                        </div>
                                    </div>

                                    <!-- Username -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> <?php echo e(__('Username *')); ?> </label>
                                            <input type="text" name="username" id="username"
                                                   class="form-control" placeholder="<?php echo e(__('Username *')); ?>" required>
                                            <small class="text-danger" id="usernameError"></small>
                                        </div>
                                    </div>

                                    <!-- Email (Optional) -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> <?php echo e(__('Email')); ?> </label>
                                            <input type="email" name="email" id="email"
                                                   class="form-control" placeholder="<?php echo e(__('Email')); ?>">
                                            <small class="text-danger" id="emailError"></small>
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> <?php echo e(__('Password *')); ?> </label>
                                            <input type="password" name="password" id="password"
                                                   class="form-control" placeholder="<?php echo e(__('Password *')); ?>" required>
                                            <small>
                                                <ul>
                                                    <li>Minimum 8 characters</li>
                                                </ul>
                                            </small>
                                            <small class="text-danger" id="passwordError"></small>
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> <?php echo e(__('Confirm Password *')); ?> </label>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                   class="form-control" placeholder="<?php echo e(__('Confirm Password *')); ?>" required>
                                            <small class="text-danger" id="passwordConfirmError"></small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms & Conditions -->
                                <div class="form-group">
                                    <div class="box-wrap form-check">
                                        <input type="checkbox" class="form-check-input" id="toc_and_privacy" name="agree_terms" required>
                                        <label class="form-check-label" for="toc_and_privacy">
                                            <?php echo e(__('Accept all')); ?>

                                            <a href="<?php echo e(url(get_static_option('toc_page_link'))); ?>" class="text-active"><?php echo e(__('Terms and Conditions')); ?></a> &amp;
                                            <a href="<?php echo e(url(get_static_option('privacy_policy_link'))); ?>" class="text-active"><?php echo e(__('Privacy Policy')); ?></a>
                                        </label>
                                    </div>
                                    <small class="text-danger" id="termsError"></small>
                                </div>

                                <!-- reCAPTCHA container -->
                                <div id="recaptcha-container"></div>

                                <button type="button" class="btn btn-next step-button-outline"
                                        onclick="sendCodeAndContinue()" id="continueButton" disabled>
                                    <i class="las la-arrow-right la-3x"></i>
                                </button>
                                <!-- (We keep this p#resend-timer hidden or remove it if you prefer)
                                <p id="resend-timer" style="display:none; margin-top:10px; color: #ff0000;"></p> -->
                            </form>
                        </div>

                        <!-- Step 2: OTP Verification (REPLACED WITH YOUR SNIPPET) -->
                        <div id="step-2" style="display: none;">
                            <button type="button" class="btn btn-prev step-button-outline mb-4" onclick="prevStep()">
                                <i class="las la-arrow-left la-3x"></i>
                            </button>

                            <div class="form-group">
                                <label>Enter OTP</label>
                                <input type="text" id="verificationCode" class="form-control" placeholder="6-digit Code">
                                <small class="text-danger" id="verificationCodeError"></small>
                            </div>
                            
                            <button type="button" class="btn btn-next step-button-outline" onclick="verifyAndCreateAccount()">
                                Verify OTP
                            </button>
                            
                            
                            <div class="mt-3">
                                <!-- 'Resend OTP' button with 60s timer in #resendTimer -->
                                <button type="button" class="btn btn-link" id="resendOtpButton" onclick="resendCode()" disabled>
                                    Resend OTP <span id="resendTimer">(60s)</span>
                                </button>
                            </div>
                        </div>

                        <!-- Already have an account -->
                        <div class="signin__account__para d-flex justify-content-center" style="margin-top: 3.5rem">
                            <p class="info"><?php echo e(__('Already Have account?')); ?></p>
                            <a href="<?php echo e(route('user.login')); ?>" class="active">
                                <strong><?php echo e(__('Sign in')); ?></strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    #account-form label {
        font-size: 16px;
        font-weight: bold;
    }
    .btn:disabled{
        color: #FFF;
        background-color: #656565;
        border-color: #656565;
    }
    #step-1 .btn.btn-next.step-button-outline{
        padding: 0px;
        border: none;
        font-weight: bold;
        float: right;
    }
    #step-2 .btn.btn-prev.step-button-outline{
        padding: 0px;
        border: none;
        font-weight: bold;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>"></script>

<script>
    // ----------------- reCAPTCHA & Firebase Init ----------------- //
    grecaptcha.ready(function() {
        grecaptcha.execute("<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>", {
            action: 'homepage'
        }).then(function(token) {
            document.getElementById('gcaptcha_token').value = token;
        });
    });

    const firebaseConfig = {
        apiKey: "AIzaSyC0MrxJImZMkVRN4giYpv8K11NpmWc7DNY",
        authDomain: "sombokchab-laravel.firebaseapp.com",
        projectId: "sombokchab-laravel",
        storageBucket: "sombokchab-laravel.firebasestorage.app",
        messagingSenderId: "663828199574",
        appId: "1:663828199574:web:b205a70700279494cbeab7",
        measurementId: "G-95NBRK1SJ5"
    };
    firebase.initializeApp(firebaseConfig);

    let recaptchaVerifier;
    let confirmationResult = null;

    // ----------------- Fields & References ----------------- //
    const phoneCountryCode = document.getElementById('phone_country_code');
    const phoneField       = document.getElementById('number');
    const nameField        = document.getElementById('name');
    const usernameField    = document.getElementById('username');
    const emailField       = document.getElementById('email');
    const passwordField    = document.getElementById('password');
    const confirmField     = document.getElementById('password_confirmation');
    const termsCheckbox    = document.getElementById('toc_and_privacy');
    const continueButton   = document.getElementById('continueButton');

    // Error message elements
    const phoneErrorEl     = document.getElementById('phoneError');
    const usernameErrorEl  = document.getElementById('usernameError');
    const emailErrorEl     = document.getElementById('emailError');
    const passwordErrorEl  = document.getElementById('passwordError');
    const confirmErrorEl   = document.getElementById('passwordConfirmError');
    const termsErrorEl     = document.getElementById('termsError');

    // Timer references
    let resendTimer = null;
    let timeLeft    = 60; // For the 60s countdown

    //////////////////////////////
    // VALIDATION HELPERS
    //////////////////////////////

    function validatePhone(fullPhone) {
        const phoneRegex = /^(\+855\d{8,9}|\+8801\d{9}|\+1\d{10})$/;
        if (!fullPhone.trim()) return 'Phone number is required';
        return phoneRegex.test(fullPhone) ? '' : 'Invalid phone number';
    }

    function validateUsername(value) {
        if (!value.trim()) return 'Username is required';
        // 3-20 chars, letters/numbers/dot/underscore, no spaces
        const re = /^[A-Za-z0-9._]{3,20}$/;
        if (!re.test(value)) {
            return 'Username must be 3–20 chars (letters, numbers, ., _) with no spaces';
        }
        return '';
    }

    function validateEmail(value) {
        const trimmed = value.trim();
        if (!trimmed) return ''; // optional
        if (/\s/.test(trimmed)) return 'Email cannot contain spaces';
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(trimmed) ? '' : 'Invalid email';
    }

    function validatePassword(value) {
        // At least 8 chars, 1 uppercase, 1 lowercase, 1 digit, no spaces
        const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!.*\s).{8,}$/;
        if (!re.test(value)) {
            return 'Password must have atleast (8 Characters with 1 Uppercase, 1 Lowercase, 1 Number, and No spaces allowed)';
        }
        return '';
    }

    function validateConfirmPassword(confirmVal, passwordVal) {
        return (confirmVal !== passwordVal) ? 'Passwords do not match' : '';
    }

    function validateTerms(isChecked) {
        return !isChecked ? 'You must accept the terms and conditions' : '';
    }

    async function checkFieldAvailability(field, value) {
        if (!value.trim()) return ''; // skip if empty
        try {
            const resp = await fetch("<?php echo e(route('check.user.data.availability')); ?>", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ field, value })
            });
            if (resp.ok) {
                return ''; // no conflict
            }
            const errorJson = await resp.json();
            return errorJson.error || 'Server error. Please try again later.';
        } catch (e) {
            console.error('Error in field availability check:', e);
            return 'Server error. Please try again later.';
        }
    }

    // Show a message for X seconds, then hide
    function displayTempMessage(elementId, message, seconds = 5) {
        const el = document.getElementById(elementId);
        el.textContent = message;
        el.style.display = 'block';
        setTimeout(() => {
            el.style.display = 'none';
        }, seconds * 1000);
    }

    function updateContinueButton() {
        const requiredFilled = (
            phoneField.value.trim() &&
            nameField.value.trim() &&
            usernameField.value.trim() &&
            passwordField.value.trim() &&
            confirmField.value.trim() &&
            termsCheckbox.checked
        );

        const hasAnyError = (
            phoneErrorEl.textContent ||
            usernameErrorEl.textContent ||
            emailErrorEl.textContent ||
            passwordErrorEl.textContent ||
            confirmErrorEl.textContent ||
            termsErrorEl.textContent
        );

        continueButton.disabled = (!requiredFilled || hasAnyError);
    }

    // ----------------- Event Listeners ----------------- //
    phoneField.addEventListener('input', async () => {
        const fullPhone = phoneCountryCode.value + phoneField.value;
        let errorMsg = validatePhone(fullPhone);
        if (!errorMsg) {
            errorMsg = await checkFieldAvailability('phone', fullPhone);
        }
        phoneErrorEl.textContent = errorMsg;
        updateContinueButton();
    });

    phoneCountryCode.addEventListener('change', async () => {
        const fullPhone = phoneCountryCode.value + phoneField.value;
        let errorMsg = validatePhone(fullPhone);
        if (!errorMsg) {
            errorMsg = await checkFieldAvailability('phone', fullPhone);
        }
        phoneErrorEl.textContent = errorMsg;
        updateContinueButton();
    });

    usernameField.addEventListener('input', async () => {
        const val = usernameField.value;
        let errorMsg = validateUsername(val);
        if (!errorMsg && val.trim()) {
            errorMsg = await checkFieldAvailability('username', val.trim());
        }
        usernameErrorEl.textContent = errorMsg;
        updateContinueButton();
    });

    emailField.addEventListener('input', async () => {
        const val = emailField.value;
        let errorMsg = validateEmail(val);
        if (!errorMsg && val.trim()) {
            errorMsg = await checkFieldAvailability('email', val.trim());
        }
        emailErrorEl.textContent = errorMsg;
        updateContinueButton();
    });

    passwordField.addEventListener('input', () => {
        const errorMsg = validatePassword(passwordField.value);
        passwordErrorEl.textContent = errorMsg;
        updateContinueButton();
    });

    confirmField.addEventListener('input', () => {
        const errorMsg = validateConfirmPassword(confirmField.value, passwordField.value);
        confirmErrorEl.textContent = errorMsg;
        updateContinueButton();
    });

    termsCheckbox.addEventListener('change', () => {
        const errorMsg = validateTerms(termsCheckbox.checked);
        termsErrorEl.textContent = errorMsg;
        updateContinueButton();
    });

    // ----------------- On Load: render reCAPTCHA, init checks ----------------- //
    window.onload = () => {
        renderReCAPTCHA();
        updateContinueButton();
    };

    function renderReCAPTCHA() {
        if (!recaptchaVerifier) {
            recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                size: 'normal',
                callback: function() {
                    console.log("reCAPTCHA resolved");
                },
                'expired-callback': function() {
                    console.error("reCAPTCHA expired. Re-initializing...");
                    renderReCAPTCHA();
                }
            });
        }
        recaptchaVerifier.render().then((widgetId) => {
            console.log("reCAPTCHA widget ID:", widgetId);
        });
    }

    // ----------------- OTP Logic ----------------- //
    function startResendTimer() {
        const resendOtpButton = document.getElementById('resendOtpButton');
        const resendTimerSpan = document.getElementById('resendTimer');
        timeLeft = 60;
        resendOtpButton.disabled = true;
        resendTimerSpan.textContent = `(60s)`;

        resendTimer = setInterval(() => {
            timeLeft--;
            resendTimerSpan.textContent = `(${timeLeft}s)`;
            if (timeLeft <= 0) {
                clearInterval(resendTimer);
                resendOtpButton.disabled = false;
                resendTimerSpan.textContent = ``;
            }
        }, 1000);
    }

    function sendCodeAndContinue() {
        const fullPhone = phoneCountryCode.value + phoneField.value;
        const phoneErr = validatePhone(fullPhone);
        if (phoneErr) {
            phoneErrorEl.textContent = phoneErr;
            return;
        }

        if (!recaptchaVerifier) {
            renderReCAPTCHA();
            displayTempMessage('error', "reCAPTCHA not initialized. Please try again.");
            return;
        }

        firebase.auth().signInWithPhoneNumber(fullPhone, recaptchaVerifier)
            .then((result) => {
                confirmationResult = result;
                displayTempMessage('sentSuccess', "OTP Sent Successfully!", 5);

                setTimeout(() => {
                    document.getElementById('step-1').style.display = 'none';
                    document.getElementById('step-2').style.display = 'block';
                    startResendTimer();
                }, 1000);
            })
            .catch((error) => {
                console.error("Error during sendCodeAndContinue:", error);
                displayTempMessage('error', error.message, 5);
            });
    }

    function verifyAndCreateAccount() {
        const code = document.getElementById('verificationCode').value.trim();
        if (!code) {
            document.getElementById('verificationCodeError').textContent = 'Verification code is required';
            return;
        } else {
            document.getElementById('verificationCodeError').textContent = '';
        }

        confirmationResult.confirm(code)
            .then(() => {
                // OTP verified
                const fullPhone = phoneCountryCode.value + phoneField.value;
                document.getElementById('verified_phone').value = fullPhone;
                displayTempMessage('verifiedSuccess', "Account Created Successfully!", 5);

                // Submit after short delay
                setTimeout(() => {
                    document.getElementById('account-form').submit();
                }, 2000);
            })
            .catch((error) => {
                console.error("Error verifying OTP:", error);
                displayTempMessage('error', error.message, 5);
            });
    }

    function prevStep() {
        // Return user from step 2 to step 1
        document.getElementById('step-2').style.display = 'none';
        document.getElementById('step-1').style.display = 'block';
    }

    function resendCode() {
        // Reset the countdown
        timeLeft = 60;
        sendCodeAndContinue();
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/user/register.blade.php ENDPATH**/ ?>