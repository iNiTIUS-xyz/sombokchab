@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Customer Sign Up') }}
@endsection
@section('content')

    <style>
        .label-title.text-bold{
            font-size: 16px !important;
            font-weight: 500 !important;
            color: var(--heading-color);
        }
    </style>

    <section class="sign-in-area-wrapper padding-top-20 padding-bottom-20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="sign-in register">
                        <div class="form-wrapper custom__form mt-4">
                            <x-msg.error />
                            <x-msg.flash />

                            {{-- Alert messages --}}
                            <div class="alert alert-danger" id="error" style="display: none;"></div>
                            <div class="alert alert-success" id="sentSuccess" style="display: none;">
                                OTP sent successfully.
                            </div>
                            <div class="alert alert-success" id="verifiedSuccess" style="display: none;">
                                Account created successfully.
                            </div>

                            {{-- Step 1: Registration Form --}}
                            <div id="step-1">
                                <form id="account-form" method="post" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <input type="hidden" name="phone" id="verified_phone">

                                    <div class="row">
                                        <!-- Phone Number -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    class="label-title text-bold mb-2">{{ __('Phone Number *') }}</label>
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
                                                <label class="label-title text-bold mb-2">{{ __('Name *') }}</label>
                                                <input type="text" name="name" id="name"
                                                    class="form--control radius-10" placeholder="{{ __('Name *') }}"
                                                    required>
                                                <small class="text-danger" id="nameError"></small>
                                            </div>
                                        </div>

                                        <!-- Username (Updated Validation) -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-title text-bold mb-2">{{ __('Username *') }}</label>
                                                <input type="text" name="username" id="username"
                                                    class="form--control radius-10" placeholder="{{ __('Username *') }}"
                                                    required>
                                                {{-- <small class="text-muted">
                                                    Allowed: letters (A-Z, a-z), numbers (0-9), underscores (_)
                                                </small> --}}
                                                <small class="text-danger" id="usernameError"></small>
                                            </div>
                                        </div>

                                        <!-- Email (Optional) -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-title text-bold mb-2">{{ __('Email') }}</label>
                                                <input type="email" name="email" id="email"
                                                    class="form--control radius-10" placeholder="{{ __('Email') }}">
                                                <small class="text-danger" id="emailError"></small>
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-title text-bold mb-2">{{ __('Password *') }}</label>
                                                <input type="password" name="password" id="password"
                                                    class="form--control radius-10" placeholder="{{ __('Password *') }}"
                                                    required>
                                                {{-- <small>
                                                    <ul>
                                                        <li>Minimum 8 characters</li>
                                                    </ul>
                                                </small> --}}
                                                <small class="text-danger" id="passwordError"></small>
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    class="label-title text-bold mb-2">{{ __('Confirm Password *') }}</label>
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" class="form--control radius-10"
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
                                    <div class="form-group text-right" style="text-align: right;">
                                        <button type="button" class="btn btn-next step-button-outline p-2"
                                            onclick="sendCodeAndContinue()" id="continueButton" disabled>
                                            <span class="">Next </span>
                                            <i class="las la-arrow-right"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            {{-- Step 2: OTP Verification --}}
                            <div id="step-2" style="display: none;">
                                <div class="col-12 pb-3 mb-4">
                                    <div class="form-group">
                                        <label>Enter OTP</label>
                                        <input type="text" id="verificationCode" class="form--control radius-10"
                                            placeholder="6-digit Code" style="border-radius: 10px;" />
                                        <small class="text-danger" id="verificationCodeError"></small>
                                        <button type="button"
                                            style="background: transparent; border: none; text-decoration: underline; color: #41695a; float: right"
                                            id="resendOtpButton" onclick="resendCode()" disabled>
                                            Resend OTP <span id="resendTimer">(60s)</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12 pb-3">
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-prev p-2 mb-4" onclick="prevStep()">
                                            <i class="las la-arrow-left"></i>
                                            <span class="">Back </span>
                                        </button>
                                        <button type="button" class="btn btn-next submit-button p-2"
                                            onclick="verifyAndCreateAccount()" style="float: right">
                                            Verify & Create Account
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Already have an account -->
                    <div class="signin__account__para d-flex justify-content-center" style="margin-top: 10px">
                        <p class="info">
                            {{ __('Already have an account?') }}
                            <a href="{{ route('user.login') }}" class="active">
                                <strong>{{ __('Sign In') }}</strong>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // ================== Fields & References ================== //
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
        let timeLeft = 60;

        // ================== Username Validation ================== //
        function validateUsername(value) {
            if (!value.trim()) return 'Username is required';

            const re = /^[A-Za-z0-9_]{3,20}$/; // Removed '.' from the character set
            if (!re.test(value)) {
                return 'Username must be 3–20 characters (letters, numbers, underscore( _ )) with no spaces';
            }

            return '';
        }

        // Block invalid characters in username field
        usernameField.addEventListener('keypress', (e) => {
            const allowedChars = /^[A-Za-z0-9._]$/;
            const key = String.fromCharCode(e.keyCode || e.which);

            if (!allowedChars.test(key)) {
                e.preventDefault();
                usernameErrorEl.textContent = 'Only letters, numbers, . and _ allowed';
                return false;
            }
        });

        // Real-time username validation
        usernameField.addEventListener('input', async () => {
            const val = usernameField.value;
            let errorMsg = validateUsername(val);

            if (!errorMsg && val.trim()) {
                errorMsg = await checkFieldAvailability('username', val.trim());
            }

            usernameErrorEl.textContent = errorMsg;
            updateContinueButton();
        });

        // ================== Other Validations ================== //
        function validatePhone(fullPhone) {
            const phoneRegex = /^(\+855\d{8,9}|\+8801\d{9}|\+1\d{10})$/;
            if (!fullPhone.trim()) return 'Phone number is required';
            return phoneRegex.test(fullPhone) ? '' : 'Invalid phone number';
        }

        function validateEmail(value) {
            const trimmed = value.trim();
            if (!trimmed) return '';
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
            if (!value.trim()) return '';
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

                if (resp.ok) return '';
                const errorJson = await resp.json();
                return errorJson.error || 'Server error. Please try again later.';
            } catch (e) {
                console.error('Error in field availability check:', e);
                return 'Server error. Please try again later.';
            }
        }

        // ================== Form Utilities ================== //
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

        // ================== OTP Logic ================== //
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
                const response = await fetch("{{ route('send.otp') }}", {
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
            }

            try {
                const response = await fetch("{{ route('verify.otp') }}", {
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

        // ================== Initialize ================== //
        window.onload = () => {
            updateContinueButton();

            // Add event listeners for other fields
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
        };
    </script>
    
@endsection
