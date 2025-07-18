@extends('frontend.frontend-master')

@section('content')
    <div class="breadcrumb-area breadcrumb-padding bg-item-badge">
        <div class="breadcrumb-shapes">
            <img src="{{ asset('assets/img/shop/badge-s1.png') }}" alt="">
            <img src="{{ asset('assets/img/shop/badge-s2.png') }}" alt="">
            <img src="{{ asset('assets/img/shop/badge-s3.png') }}" alt="">
        </div>
        <div class="container container-one">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-contents">
                        <h2 class="breadcrumb-title"> {{ __('Vendor Sign Up') }} </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area end -->

    <!-- Vendor Registration area Starts -->
    <section class="vendor-registration-area padding-top-20 padding-bottom-20">
        <div class="container container-one">
            <div class="row justify-content-center flex-lg-row flex-column-reverse">
                <div class="col-lg-5">
                    <x-error-msg />
                    <x-msg.success />

                    <div class="dashboard__card">
                        <!-- Alert messages to show/hide after 5s -->
                        <div class="alert alert-danger" id="error" style="display: none;"></div>
                        <div class="alert alert-success" id="sentSuccess" style="display: none;">OTP Sent Successfully!
                        </div>
                        <div class="alert alert-success" id="verifiedSuccess" style="display: none;">Account Created
                            Successfully!</div>

                        <!-- STEP 1: Vendor Registration Form Fields -->
                        <div id="step-1">
                            <form id="vendor-form" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <input type="hidden" name="phone" id="verified_phone">
                                <input type="hidden" name="country_id" value="31">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label-title mb-2"> {{ __('Store Name *') }} </label>
                                            <input name="business_name" id="business_name" type="text"
                                                class="form--control radius-10" placeholder="{{ __('Store Name') }}"
                                                required />
                                            <small class="text-danger" id="businessNameError"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title mb-2"> {{ __('Phone Number *') }} </label>
                                            <div class="input-group">
                                                <select id="phone_country_code" name="phone_country_code"
                                                    class="form-select" style="width: 35% !important;">
                                                    <option value="+1" selected>+1</option>
                                                    <option value="+880">+880</option>
                                                    <option value="+855">+855</option>
                                                </select>
                                                <input id="number" name="phone" type="number"
                                                    class="form--control radius-10" placeholder="Phone Number" required
                                                    style="width: 85% !important;" />
                                            </div>
                                            <small class="text-danger" id="phoneError"></small>
                                        </div>
                                    </div>

                                    <!-- Username -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title mb-2"> {{ __('Username *') }} </label>
                                            <input name="username" id="username" type="text"
                                                class="form--control radius-10" placeholder="{{ __('Username') }}"
                                                required />
                                            <small class="text-danger" id="usernameError"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title mb-2"> {{ __('Email') }} </label>
                                            <input name="email" id="email" type="text"
                                                class="form--control radius-10" placeholder="{{ __('Email') }}" />
                                            <small class="text-danger" id="emailError"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title mb-2">
                                                {{ __('Passport or National ID *') }} </label>
                                            <input name="passport_nid" id="passport_nid" type="text"
                                                class="form--control radius-10"
                                                placeholder="{{ __('Passport or National ID') }}" required />
                                            <small class="text-danger" id="passportNidError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title mb-2"> {{ __('Password *') }} </label>
                                            <input name="password" id="password" type="password"
                                                class="form--control radius-10" placeholder="{{ __('Password') }}"
                                                required />

                                            <small class="text-danger" id="passwordError"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title mb-2"> {{ __('Confirm Password *') }}
                                            </label>
                                            <input name="password_confirmation" id="password_confirmation"
                                                type="password" class="form--control radius-10"
                                                placeholder="{{ __('Confirm Password') }}" required />
                                            <small class="text-danger" id="passwordConfirmError"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="box-wrap form-check">
                                        <input type="checkbox" class="form-check-input" id="toc_and_privacy"
                                            name="agree_terms" required />
                                        <label class="form-check-label" for="toc_and_privacy"
                                            style="font-weight: bold !important;">
                                            {{ __('Accept all') }}
                                            <a href="{{ url(get_static_option('toc_page_link')) }}" class="text-active"
                                                target="__blank">{{ __('Terms and Conditions') }}</a> &amp;
                                            <a href="{{ url(get_static_option('privacy_policy_link')) }}"
                                                class="text-active" target="__blank">{{ __('Privacy Policy') }}</a>
                                        </label>
                                    </div>
                                    <small class="text-danger" id="termsError"></small>
                                </div>
                                <div id="recaptcha-container"></div>
                                <div class="form-group" style="text-align: center;">
                                    <button type="button" class="btn btn-next step-button-outline p-2"
                                        onclick="sendCodeAndContinue()" id="continueButton" disabled>
                                        <span class="">Next </span>
                                        <i class="las la-arrow-right"></i>
                                    </button>
                                </div>

                            </form>
                        </div>

                        <!-- STEP 2: OTP Verification -->
                        <div id="step-2" style="display: none;">
                            <div class="col-12 pb-3 mb-4">
                                <div class="form-group">
                                    <label class="label-title">Enter OTP</label>
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
            </div>
        </div>
    </section>

    <style>
        #vendor-form label {
            line-height: 20px;
            color: var(--heading-color);
            font-size: 16px !important;
            font-weight: 500 !important;
        }

        .btn {
            font-size: 16px;
        }

        .input-group {
            position: relative;
            display: flex;
            flex-wrap: nowrap;
            align-items: stretch;
            width: 100%;
        }

        .btn:disabled {
            color: #656565;
            background-color: transparent;
            border-color: #656565;
        }

        #step-1 .btn.btn-next.step-button-outline {
            border: 1px solid var(--main-color-one);
            font-weight: bold;
            font-size: 16px;
        }

        #step-2 .btn.btn-prev.step-button {
            border: none;
            font-weight: bold;
            border: 1px solid var(--main-color-one);
        }

        #step-2 .btn.btn-prev {
            color: #4d4d4d;
            font-weight: bold;
            border: 1px solid #4d4d4d;
        }

        #step-2 .btn.btn-prev:hover {
            color: #FFF;
            font-weight: bold;
            background: #4d4d4d;
            border: 1px solid #4d4d4d;
        }

        #step-2 .btn.submit-button {
            border: 1px solid var(--main-color-one);
            font-weight: bold;
            background: var(--main-color-one);
            color: #FFF;
        }

        #step-2 .btn.submit-button:hover {
            border: 1px solid #284137;
            font-weight: bold;
            background: #284137;
            color: #FFF;
        }

        .form--control {
            width: 100%;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            color: var(--paragraph-color);
            height: 55px;
            border: 1px solid var(--border-two);
            border-radius: 5px;
        }
    </style>
@endsection

@section('script')
    <script
        src="https://www.google.com/recaptcha/api.js?render={{ get_static_option('site_google_captcha_v3_site_key') }}">
    </script>

    <script>
        // ----------------- reCAPTCHA Init ----------------- //
        grecaptcha.ready(function() {
            grecaptcha.execute("{{ get_static_option('site_google_captcha_v3_site_key') }}", {
                action: 'homepage'
            }).then(function(token) {
                document.getElementById('gcaptcha_token').value = token;
            });
        });

        // ----------------- FIELD & ELEMENT REFS ----------------- //
        const phoneCountryCode = document.getElementById('phone_country_code');
        const phoneField = document.getElementById('number');
        const ownerNameField = document.getElementById('owner_name');
        const businessNameField = document.getElementById('business_name');
        const emailField = document.getElementById('email');
        const usernameField = document.getElementById('username');
        const passwordField = document.getElementById('password');
        const confirmField = document.getElementById('password_confirmation');
        const businessTypeField = document.getElementById('business_type');
        const passportNidField = document.getElementById('passport_nid');
        const termsCheckbox = document.getElementById('toc_and_privacy');

        // Error displays
        const phoneErrorEl = document.getElementById('phoneError');
        const ownerNameErrorEl = document.getElementById('ownerNameError');
        const businessNameErrorEl = document.getElementById('businessNameError');
        const emailErrorEl = document.getElementById('emailError');
        const usernameErrorEl = document.getElementById('usernameError');
        const passwordErrorEl = document.getElementById('passwordError');
        const confirmErrorEl = document.getElementById('passwordConfirmError');
        const businessTypeErrorEl = document.getElementById('businessTypeError');
        const passportNidErrorEl = document.getElementById('passportNidError');
        const termsErrorEl = document.getElementById('termsError');

        const continueButton = document.getElementById('continueButton');

        // Timer references
        let resendTimer = null;
        let timeLeft = 60;

        function validatePhone(countryCode, rawNumber) {
            const fullPhone = (countryCode + rawNumber).trim();

            if (!rawNumber.trim()) return 'Phone number is required';

            const phoneDigitsOnly = fullPhone.replace(/\D/g, ''); // Remove non-digit characters

            if (phoneDigitsOnly.length < 8 || phoneDigitsOnly.length > 10) {
                return 'Phone number must be between 8 and 10 digits';
            }

            if (!/^\+?\d+$/.test(fullPhone)) {
                return 'Phone number must contain only digits and optional leading +';
            }

            return '';
        }

        function validateOwnerName(value) {
            const trimmed = value.trim();
            if (!trimmed) return 'Vendor name is required';
            if (trimmed.length < 3) return 'Vendor name must be at least 3 characters';
            if (trimmed.length > 30) return 'Vendor name cannot exceed 30 characters';
            if (/@/.test(trimmed)) return 'Vendor name cannot contain "@" character';
            return '';
        }

        function validateBusinessName(value) {
            const trimmed = value.trim();
            if (!trimmed) return 'Store name is required';
            if (trimmed.length < 3) return 'Store name must be at least 3 characters';
            if (trimmed.length > 30) return 'Store name cannot exceed 30 characters';
            if (/@/.test(trimmed)) return 'Store name cannot contain "@" character';
            return '';
        }

        function validateEmail(value) {
            const trimmed = value.trim();
            if (!trimmed) return '';
            if (/\s/.test(trimmed)) return 'Email cannot contain spaces';
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(trimmed) ? '' : 'Invalid email';
        }

        // function validateUsername(value) {
        //     const trimmed = value.trim();
        //     if (!trimmed) return 'Username is required';
        //     if (trimmed.includes(' ')) return 'Username cannot contain spaces';

        //     const re = /^[A-Za-z0-9._]{3,20}$/;
        //     return re.test(trimmed) ?
        //         '' :
        //         'Username must be 3–20 characters (letters, numbers, ., _)';
        // }

        function validateUsername(value) {
            if (!value.trim()) return 'Username is required';

            const re = /^[A-Za-z0-9_]{3,20}$/; // Removed '.' from the character set
            if (!re.test(value)) {
                return 'Username must be 3–20 characters (letters, numbers, underscore( _ )) with no spaces';
            }

            return '';
        }

        function validatePassword(value) {
            const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!.*\s).{8,}$/;
            if (!re.test(value)) {
                return 'Password must have at least 8 characters, 1 uppercase, 1 lowercase, 1 number, no spaces';
            }
            return '';
        }

        function validateConfirmPassword(confirmVal, passwordVal) {
            return confirmVal !== passwordVal ? 'Passwords do not match' : '';
        }

        function validateBusinessType(value) {
            return !value.trim() ? 'Business type is required' : '';
        }

        function validatePassportNid(value) {
            return !value.trim() ? 'Passport/National ID is required' : '';
        }

        function validateTerms(isChecked) {
            return !isChecked ? 'You must accept the terms and conditions' : '';
        }

        async function checkFieldAvailability(field, value) {
            if (!value.trim()) return '';
            try {
                const resp = await fetch("{{ route('check.vendor.data.availability') }}", {
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
                    return '';
                }
                const errorJson = await resp.json();
                return errorJson.error || 'Server error. Please try again later.';
            } catch (e) {
                console.error('Error in availability check:', e);
                return 'Server error. Please try again later.';
            }
        }

        function displayTempMessage(elementId, message, seconds = 5) {
            const el = document.getElementById(elementId);
            el.textContent = message;
            el.style.display = 'block';
            setTimeout(() => {
                el.style.display = 'none';
            }, seconds * 1000);
        }

        // ----------------- REAL-TIME VALIDATION ----------------- //
        phoneField.addEventListener('input', async () => {
            const errorMsg = validatePhone(phoneCountryCode.value, phoneField.value);
            if (!errorMsg) {
                const fullPhone = phoneCountryCode.value + phoneField.value;
                const dbError = await checkFieldAvailability('phone', fullPhone);
                phoneErrorEl.textContent = dbError;
            } else {
                phoneErrorEl.textContent = errorMsg;
            }
            updateContinueButton();
        });

        phoneCountryCode.addEventListener('change', async () => {
            const errorMsg = validatePhone(phoneCountryCode.value, phoneField.value);
            if (!errorMsg) {
                const fullPhone = phoneCountryCode.value + phoneField.value;
                const dbError = await checkFieldAvailability('phone', fullPhone);
                phoneErrorEl.textContent = dbError;
            } else {
                phoneErrorEl.textContent = errorMsg;
            }
            updateContinueButton();
        });

        ownerNameField.addEventListener('input', () => {
            ownerNameErrorEl.textContent = validateOwnerName(ownerNameField.value);
            updateContinueButton();
        });

        businessNameField.addEventListener('input', () => {
            businessNameErrorEl.textContent = validateBusinessName(businessNameField.value);
            updateContinueButton();
        });

        emailField.addEventListener('input', async () => {
            const localErr = validateEmail(emailField.value);
            if (!localErr && emailField.value.trim()) {
                const dbErr = await checkFieldAvailability('email', emailField.value.trim());
                emailErrorEl.textContent = dbErr;
            } else {
                emailErrorEl.textContent = localErr;
            }
            updateContinueButton();
        });

        usernameField.addEventListener('input', async () => {
            const localErr = validateUsername(usernameField.value);
            if (!localErr && usernameField.value.trim()) {
                const dbErr = await checkFieldAvailability('username', usernameField.value.trim());
                usernameErrorEl.textContent = dbErr;
            } else {
                usernameErrorEl.textContent = localErr;
            }
            updateContinueButton();
        });

        passwordField.addEventListener('input', () => {
            passwordErrorEl.textContent = validatePassword(passwordField.value);
            updateContinueButton();
        });

        confirmField.addEventListener('input', () => {
            confirmErrorEl.textContent = validateConfirmPassword(confirmField.value, passwordField.value);
            updateContinueButton();
        });

        businessTypeField.addEventListener('change', () => {
            businessTypeErrorEl.textContent = validateBusinessType(businessTypeField.value);
            updateContinueButton();
        });

        passportNidField.addEventListener('input', () => {
            passportNidErrorEl.textContent = validatePassportNid(passportNidField.value);
            updateContinueButton();
        });

        termsCheckbox.addEventListener('change', () => {
            termsErrorEl.textContent = validateTerms(termsCheckbox.checked);
            updateContinueButton();
        });

        // ----------------- Enable/Disable Continue Button ----------------- //
        function updateContinueButton() {
            const errorsPresent = (
                phoneErrorEl.textContent ||
                ownerNameErrorEl.textContent ||
                businessNameErrorEl.textContent ||
                emailErrorEl.textContent ||
                usernameErrorEl.textContent ||
                passwordErrorEl.textContent ||
                confirmErrorEl.textContent ||
                businessTypeErrorEl.textContent ||
                passportNidErrorEl.textContent ||
                termsErrorEl.textContent
            );

            const requiredFilled = (
                phoneField.value.trim() &&
                ownerNameField.value.trim() &&
                businessNameField.value.trim() &&
                usernameField.value.trim() &&
                passwordField.value.trim() &&
                confirmField.value.trim() &&
                businessTypeField.value.trim() &&
                passportNidField.value.trim() &&
                termsCheckbox.checked
            );

            continueButton.disabled = (!!errorsPresent || !requiredFilled);
        }

        // ----------------- OTP Logic ----------------- //
        function startResendTimer() {
            const resendBtn = document.getElementById('resendOtpButton');
            const resendTimerSpan = document.getElementById('resendTimer');
            timeLeft = 60;
            resendBtn.disabled = true;
            resendTimerSpan.textContent = '(60s)';

            resendTimer = setInterval(() => {
                timeLeft--;
                resendTimerSpan.textContent = `(${timeLeft}s)`;
                if (timeLeft <= 0) {
                    clearInterval(resendTimer);
                    resendBtn.disabled = false;
                    resendTimerSpan.textContent = '';
                }
            }, 1000);
        }

        async function sendCodeAndContinue() {
            const fullPhone = phoneCountryCode.value + phoneField.value;
            const phoneErr = validatePhone(phoneCountryCode.value, phoneField.value);
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
            } else {
                document.getElementById('verificationCodeError').textContent = '';
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
                        const form = document.getElementById('vendor-form');
                        form.action = "{{ route('vendor.vendor_registration') }}";
                        form.submit();
                    }, 2000);
                } else {
                    document.getElementById('verificationCodeError').textContent = data.error ||
                        'Invalid OTP. Please try again.';
                }
            } catch (error) {
                console.error('Error verifying OTP:', error);
                document.getElementById('verificationCodeError').textContent = 'Server error. Please try again later.';
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
