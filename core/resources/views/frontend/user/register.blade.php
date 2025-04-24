@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Sign Up') }}
@endsection
@section('content')
    <section class="sign-in-area-wrapper padding-top-20 padding-bottom-20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="sign-in register">
                        <div class="form-wrapper custom__form mt-4">
                            <x-msg.error />
                            <x-msg.flash />

                            {{-- Alert messages to show for 5s and then hide --}}
                            <div class="alert alert-danger" id="error" style="display: none;"></div>
                            <div class="alert alert-success" id="sentSuccess" style="display: none;">OTP Sent Successfully!
                            </div>
                            <div class="alert alert-success" id="verifiedSuccess" style="display: none;">Account Created
                                Successfully!</div>

                            <!-- Step 1: Account Details and Phone Number -->
                            <div id="step-1">
                                <form id="account-form" method="post" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <input type="hidden" name="phone" id="verified_phone">

                                    <div class="row">
                                        <!-- Phone and Country Code -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-title color-light mb-2"> {{ __('Phone Number *') }}
                                                </label>
                                                <div class="input-group">
                                                    <select name="phone_country_code" id="phone_country_code"
                                                        class="form-select" required>
                                                        <option value="+1" selected>+1</option>
                                                        <option value="+880">+880</option>
                                                        <option value="+855">+855</option>
                                                    </select>
                                                    <input type="text" id="number" name="phone"
                                                        class="form--control radius-10" placeholder="Phone Number *"
                                                        style="width: unset" required>
                                                </div>
                                                <small class="text-danger" id="phoneError"></small>
                                            </div>
                                        </div>

                                        <!-- Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-title color-light mb-2"> {{ __('Name *') }} </label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="{{ __('Name *') }}" required>
                                                <small class="text-danger" id="nameError"></small>
                                            </div>
                                        </div>

                                        <!-- Username -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-title color-light mb-2"> {{ __('Username *') }} </label>
                                                <input type="text" name="username" id="username" class="form-control"
                                                    placeholder="{{ __('Username *') }}" required>
                                                <small class="text-danger" id="usernameError"></small>
                                            </div>
                                        </div>

                                        <!-- Email (Optional) -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-title color-light mb-2"> {{ __('Email') }} </label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    placeholder="{{ __('Email') }}">
                                                <small class="text-danger" id="emailError"></small>
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-title color-light mb-2"> {{ __('Password *') }} </label>
                                                <input type="password" name="password" id="password" class="form-control"
                                                    placeholder="{{ __('Password *') }}" required>
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
                                                <label class="label-title color-light mb-2"> {{ __('Confirm Password *') }}
                                                </label>
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" class="form-control"
                                                    placeholder="{{ __('Confirm Password *') }}" required>
                                                <small class="text-danger" id="passwordConfirmError"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Terms & Conditions -->
                                    <div class="form-group">
                                        <div class="box-wrap form-check">
                                            <input type="checkbox" class="form-check-input" id="toc_and_privacy"
                                                name="agree_terms" required>
                                            <label class="form-check-label" for="toc_and_privacy">
                                                {{ __('Accept all') }}
                                                <a href="{{ url(get_static_option('toc_page_link')) }}"
                                                    class="text-active">{{ __('Terms and Conditions') }}</a> &amp;
                                                <a href="{{ url(get_static_option('privacy_policy_link')) }}"
                                                    class="text-active">{{ __('Privacy Policy') }}</a>
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
                                <button type="button" class="btn btn-prev step-button-outline mb-4"
                                    onclick="prevStep()">
                                    <i class="las la-arrow-left la-3x"></i>
                                </button>

                                <div class="form-group">
                                    <label>Enter OTP</label>
                                    <input type="text" id="verificationCode" class="form-control"
                                        placeholder="6-digit Code">
                                    <small class="text-danger" id="verificationCodeError"></small>
                                </div>
                                <div class="mt-3 d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-next step-button-outline bg-success text-white"
                                        onclick="verifyAndCreateAccount()">
                                        Verify & Create Account
                                    </button>
                                    <!-- 'Resend OTP' button with 60s timer in #resendTimer -->
                                    <button type="button" class="btn btn-link float-right" id="resendOtpButton"
                                        onclick="resendCode()" disabled>
                                        Resend OTP <span id="resendTimer">(60s)</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Already have an account -->
                            <div class="signin__account__para d-flex justify-content-center" style="margin-top: 3.5rem">
                                <p class="info">{{ __('Already Have account?') }}</p>
                                <a href="{{ route('user.login') }}" class="active">
                                    <strong>{{ __('Sign in') }}</strong>
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

        .btn:disabled {
            color: #FFF;
            background-color: #656565;
            border-color: #656565;
        }

        #step-1 .btn.btn-next.step-button-outline {
            padding: 0px;
            border: none;
            font-weight: bold;
            float: right;
        }

        #step-2 .btn.btn-prev.step-button-outline {
            padding: 0px;
            border: none;
            font-weight: bold;
        }
    </style>
@endsection

@section('script')
    <script>
        // ----------------- Fields & References ----------------- //
        const phoneCountryCode = document.getElementById('phone_country_code');
        const phoneField = document.getElementById('number');
        const nameField = document.getElementById('name');
        const usernameField = document.getElementById('username');
        const emailField = document.getElementById('email');
        const passwordField = document.getElementById('password');
        const confirmField = document.getElementById('password_confirmation');
        const termsCheckbox = document.getElementById('toc_and_privacy');
        const continueButton = document.getElementById('continueButton');

        // Error message elements
        const phoneErrorEl = document.getElementById('phoneError');
        const usernameErrorEl = document.getElementById('usernameError');
        const emailErrorEl = document.getElementById('emailError');
        const passwordErrorEl = document.getElementById('passwordError');
        const confirmErrorEl = document.getElementById('passwordConfirmError');
        const termsErrorEl = document.getElementById('termsError');

        // Timer references
        let resendTimer = null;
        let timeLeft = 60; // For the 60s countdown

        // ----------------- Validation Helpers ----------------- //
        function validatePhone(fullPhone) {
            const phoneRegex = /^(\+855\d{8,9}|\+8801\d{9}|\+1\d{10})$/;
            if (!fullPhone.trim()) return 'Phone number is required';
            return phoneRegex.test(fullPhone) ? '' : 'Invalid phone number';
        }

        function validateUsername(value) {
            if (!value.trim()) return 'Username is required';
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
            const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!.*\s).{8,}$/;
            if (!re.test(value)) {
                return 'Password must have at least 8 characters with 1 uppercase, 1 lowercase, 1 number, and no spaces';
            }
            return '';
        }

        function validateConfirmPassword(confirmVal, passwordVal) {
            return confirmVal !== passwordVal ? 'Passwords do not match' : '';
        }

        function validateTerms(isChecked) {
            return !isChecked ? 'You must accept the terms and conditions' : '';
        }

        async function checkFieldAvailability(field, value) {
            if (!value.trim()) return ''; // skip if empty
            try {
                const resp = await fetch("{{ route('check.user.data.availability') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        field,
                        value
                    })
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

            continueButton.disabled = !requiredFilled || hasAnyError;
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
                    resendTimerSpan.textContent = '';
                }
            }, 1000);
        }

        async function sendCodeAndContinue() {
            const fullPhone = phoneCountryCode.value + phoneField.value;
            const phoneErr = validatePhone(fullPhone);
            if (phoneErr) {
                phoneErrorEl.textContent = phoneErr;
                return;
            }

            try {
                const response = await fetch('http://localhost/sombokchab/send-otp', { // Adjust route as needed
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        phone: fullPhone
                    })
                });

                const data = await response.json();
                if (response.ok) {
                    displayTempMessage('sentSuccess', 'OTP Sent Successfully!', 5);
                    setTimeout(() => {
                        document.getElementById('step-1').style.display = 'none';
                        document.getElementById('step-2').style.display = 'block';
                        startResendTimer();
                    }, 1000);
                } else {
                    displayTempMessage('error', data.error || 'Failed to send OTP. Please try again.', 5);
                }
            } catch (error) {
                console.error('Error sending OTP:', error);
                displayTempMessage('error', 'Server error. Please try again later.', 5);
            }
        }

        async function verifyAndCreateAccount() {
            const code = document.getElementById('verificationCode').value.trim();
            const fullPhone = phoneCountryCode.value + phoneField.value;

            if (!code) {
                document.getElementById('verificationCodeError').textContent = 'Verification code is required';
                return;
            } else {
                document.getElementById('verificationCodeError').textContent = '';
            }

            try {
                const response = await fetch('http://localhost/sombokchab/verify-otp', { // Adjust route as needed
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        phone: fullPhone,
                        otp: code
                    })
                });

                const data = await response.json();
                if (response.ok) {
                    document.getElementById('verified_phone').value = fullPhone;
                    displayTempMessage('verifiedSuccess', 'Account Created Successfully!', 5);
                    setTimeout(() => {
                        document.getElementById('account-form').submit();
                    }, 2000);
                } else {
                    displayTempMessage('error', data.error || 'Invalid OTP. Please try again.', 5);
                }
            } catch (error) {
                console.error('Error verifying OTP:', error);
                displayTempMessage('error', 'Server error. Please try again later.', 5);
            }
        }

        function prevStep() {
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-1').style.display = 'block';
            clearInterval(resendTimer);
        }

        function resendCode() {
            timeLeft = 60;
            sendCodeAndContinue();
        }

        // ----------------- On Load ----------------- //
        window.onload = () => {
            updateContinueButton();
        };
    </script>
@endsection
