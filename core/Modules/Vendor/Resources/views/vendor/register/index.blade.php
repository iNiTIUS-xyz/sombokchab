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
                        <div class="alert alert-success" id="sentSuccess" style="display: none;">OTP Sent Successfully!</div>
                        <div class="alert alert-success" id="verifiedSuccess" style="display: none;">Account Created Successfully!</div>

                        <!-- STEP 1: Vendor Registration Form Fields -->
                        <div id="step-1">
                            <form id="vendor-form" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <input type="hidden" name="phone" id="verified_phone">

                                <input type="hidden" name="country_id" value="31">

                                <!-- Phone Number (with country code) -->
                                <div class="form-group">
                                    <label class="label-title color-light mb-2"> {{ __('Phone Number *') }} </label>
                                    <div class="input-group">
                                        <!-- If you prefer a dropdown for phone country code, do so here:
                                             for example: +1, +880, +855 -->
                                        <select id="phone_country_code" class="form-select" style="width: 30% !important;">
                                            <option value="+1" selected>+1</option>
                                            <option value="+880">+880</option>
                                            <option value="+855">+855</option>
                                        </select>
                                        <input
                                            id="number"
                                            name="phone"
                                            type="text"
                                            class="form--control radius-10"
                                            placeholder="Phone Number"
                                            required
                                            style="width: 70% !important;"
                                        />
                                    </div>
                                    <small class="text-danger" id="phoneError"></small>
                                </div>

                                <div class="row">
                                    <!-- Owner Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Owner Name *') }} </label>
                                            <input
                                                name="owner_name"
                                                id="owner_name"
                                                type="text"
                                                class="form--control radius-10"
                                                placeholder="{{ __('Owner Name') }}"
                                                required
                                            />
                                            <small class="text-danger" id="ownerNameError"></small>
                                        </div>
                                    </div>

                                    <!-- Store Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Store Name *') }} </label>
                                            <input
                                                name="business_name"
                                                id="business_name"
                                                type="text"
                                                class="form--control radius-10"
                                                placeholder="{{ __('Store Name') }}"
                                                required
                                            />
                                            <small class="text-danger" id="businessNameError"></small>
                                        </div>
                                    </div>

                                    <!-- Email (Optional) -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Email') }} </label>
                                            <input
                                                name="email"
                                                id="email"
                                                type="text"
                                                class="form--control radius-10"
                                                placeholder="{{ __('Email') }}"
                                            />
                                            <small class="text-danger" id="emailError"></small>
                                        </div>
                                    </div>

                                    <!-- Username -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Username *') }} </label>
                                            <input
                                                name="username"
                                                id="username"
                                                type="text"
                                                class="form--control radius-10"
                                                placeholder="{{ __('Username') }}"
                                                required
                                            />
                                            <small class="text-danger" id="usernameError"></small>
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Password *') }} </label>
                                            <input
                                                name="password"
                                                id="password"
                                                type="password"
                                                class="form--control radius-10"
                                                placeholder="{{ __('Password') }}"
                                                required
                                            />
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
                                            <label class="label-title color-light mb-2"> {{ __('Confirm Password *') }} </label>
                                            <input
                                                name="password_confirmation"
                                                id="password_confirmation"
                                                type="password"
                                                class="form--control radius-10"
                                                placeholder="{{ __('Confirm Password') }}"
                                                required
                                            />
                                            <small class="text-danger" id="passwordConfirmError"></small>
                                        </div>
                                    </div>

                                    <!-- Business Category -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Business Category *') }} </label>
                                            <div class="nice-select-two">
                                                <select
                                                    name="business_type"
                                                    id="business_type"
                                                    class="form--control radius-10"
                                                    required
                                                >
                                                    <option value="">Select business type</option>
                                                    @foreach ($business_type as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <small class="text-danger" id="businessTypeError"></small>
                                        </div>
                                    </div>

                                    <!-- Passport / National ID -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Passport or National ID *') }} </label>
                                            <input
                                                name="passport_nid"
                                                id="passport_nid"
                                                type="text"
                                                class="form--control radius-10"
                                                placeholder="{{ __('Passport or National ID') }}"
                                                required
                                            />
                                            <small class="text-danger" id="passportNidError"></small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms & Conditions -->
                                <div class="form-group">
                                    <div class="box-wrap form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            id="toc_and_privacy"
                                            name="agree_terms"
                                            required
                                        />
                                        <label class="form-check-label" for="toc_and_privacy">
                                            {{ __('Accept all') }}
                                            <a href="{{ url(get_static_option('toc_page_link')) }}" class="text-active">
                                                {{ __('Terms and Conditions') }}
                                            </a> &amp;
                                            <a href="{{ url(get_static_option('privacy_policy_link')) }}" class="text-active">
                                                {{ __('Privacy Policy') }}
                                            </a>
                                        </label>
                                    </div>
                                    <small class="text-danger" id="termsError"></small>
                                </div>

                                <!-- reCAPTCHA -->
                                <div id="recaptcha-container"></div>

                                <!-- Continue Button -->
                                <button
                                    type="button"
                                    class="btn btn-next step-button-outline my-4"
                                    onclick="sendCodeAndContinue()"
                                    id="continueButton"
                                    disabled
                                >
                                <i class="las la-arrow-right la-3x"></i>
                                </button>
                            </form>
                        </div>

                        <!-- STEP 2: OTP Verification -->
                        <div id="step-2" style="display: none;">
                            <button
                                type="button"
                                class="btn btn-prev step-button-outline mb-4"
                                onclick="prevStep()"
                            >
                            <i class="las la-arrow-left la-3x"></i>
                            </button>

                            <div class="form-group">
                                <label>Enter OTP</label>
                                <input
                                    type="text"
                                    id="verificationCode"
                                    class="form-control"
                                    placeholder="6-digit Code"
                                    style="border-radius: 10px;"
                                />
                                <small class="text-danger" id="verificationCodeError"></small>
                            </div>

                            <button
                                type="button"
                                class="btn btn-next step-button-outline mt-4"
                                onclick="verifyAndCreateAccount()"
                            >
                                Verify & Create Account
                            </button>
                            

                            <div class="mt-3">
                                <button
                                    type="button"
                                    class="btn btn-link"
                                    id="resendOtpButton"
                                    onclick="resendCode()"
                                    disabled
                                >
                                    Resend OTP <span id="resendTimer">(60s)</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Match styling from your second snippet */
        #vendor-form label {
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
    <!-- Firebase and Google Captcha Scripts (Consolidated) -->
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render={{ get_static_option('site_google_captcha_v3_site_key') }}"></script>

    <script>
        // ----------------- reCAPTCHA & Firebase Init ----------------- //
        grecaptcha.ready(function() {
            grecaptcha.execute("{{ get_static_option('site_google_captcha_v3_site_key') }}", {
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

        // ----------------- FIELD & ELEMENT REFS ----------------- //
        const phoneCountryCode  = document.getElementById('phone_country_code');
        const phoneField        = document.getElementById('number');
        const ownerNameField    = document.getElementById('owner_name');
        const businessNameField = document.getElementById('business_name');
        const emailField        = document.getElementById('email');
        const usernameField     = document.getElementById('username');
        const passwordField     = document.getElementById('password');
        const confirmField      = document.getElementById('password_confirmation');
        const businessTypeField = document.getElementById('business_type');
        const passportNidField  = document.getElementById('passport_nid');
        const termsCheckbox     = document.getElementById('toc_and_privacy');

        // Error displays
        const phoneErrorEl        = document.getElementById('phoneError');
        const ownerNameErrorEl    = document.getElementById('ownerNameError');
        const businessNameErrorEl = document.getElementById('businessNameError');
        const emailErrorEl        = document.getElementById('emailError');
        const usernameErrorEl     = document.getElementById('usernameError');
        const passwordErrorEl     = document.getElementById('passwordError');
        const confirmErrorEl      = document.getElementById('passwordConfirmError');
        const businessTypeErrorEl = document.getElementById('businessTypeError');
        const passportNidErrorEl  = document.getElementById('passportNidError');
        const termsErrorEl        = document.getElementById('termsError');

        const continueButton      = document.getElementById('continueButton');

        // Timer references
        let resendTimer = null;
        let timeLeft    = 60;

        // ----------------- ON LOAD: Render reCAPTCHA ----------------- //
        window.onload = function() {
            renderReCAPTCHA();
            updateContinueButton(); // Check initial
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
            recaptchaVerifier.render().then(widgetId => {
                console.log("reCAPTCHA widget ID:", widgetId);
            });
        }

        // ----------------- VALIDATION FUNCTIONS ----------------- //
        function validatePhone(countryCode, rawNumber) {
            const fullPhone = (countryCode + rawNumber).trim();
            if (!rawNumber.trim()) return 'Phone number is required';

            // Example patterns: +1\d{10}, +8801\d{9}, +855\d{8,9}
            const phoneRegex = /^(\+1\d{10}|\+8801\d{9}|\+855\d{8,9})$/;
            return phoneRegex.test(fullPhone) ? '' : 'Invalid phone number';
        }

        function validateOwnerName(value) {
            return !value.trim() ? 'Owner name is required' : '';
        }

        function validateBusinessName(value) {
            return !value.trim() ? 'Store name is required' : '';
        }

        function validateEmail(value) {
            const trimmed = value.trim();
            if (!trimmed) return ''; // optional
            if (/\s/.test(trimmed)) return 'Email cannot contain spaces';
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(trimmed) ? '' : 'Invalid email';
        }

        function validateUsername(value) {
            if (!value.trim()) return 'Username is required';
            // 3-20 chars, letters/digits/dot/underscore, no spaces
            const re = /^[A-Za-z0-9._]{3,20}$/;
            return re.test(value)
              ? ''
              : 'Username must be 3–20 chars (letters, numbers, ., _) with no spaces';
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

        // Availability check
        async function checkFieldAvailability(field, value) {
            if (!value.trim()) return ''; // skip if empty
            try {
                const resp = await fetch("{{ route('check.vendor.data.availability') }}", {
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
                console.error('Error in availability check:', e);
                return 'Server error. Please try again later.';
            }
        }

        // Generic function to show a message for X seconds
        function displayTempMessage(elementId, message, seconds = 5) {
            const el = document.getElementById(elementId);
            el.textContent = message;
            el.style.display = 'block';
            setTimeout(() => {
                el.style.display = 'none';
            }, seconds * 1000);
        }

        // ----------------- REAL-TIME VALIDATION (Event Listeners) ----------------- //
        phoneField.addEventListener('input', async () => {
            const errorMsg = validatePhone(phoneCountryCode.value, phoneField.value);
            if (!errorMsg) {
                // check DB if local validation passed
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

        // ----------------- Enable or Disable Continue button ----------------- //
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

            // Ensure all required fields are non-empty
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

        // 1) Send OTP
        function sendCodeAndContinue() {
            const fullPhone = phoneCountryCode.value + phoneField.value;
            // double-check phone validation
            const phoneErr = validatePhone(phoneCountryCode.value, phoneField.value);
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

                    // Move to step 2 after 1s
                    setTimeout(() => {
                        document.getElementById('step-1').style.display = 'none';
                        document.getElementById('step-2').style.display = 'block';
                        startResendTimer();
                    }, 1000);
                })
                .catch((error) => {
                    console.error("Error sending OTP:", error);
                    displayTempMessage('error', error.message, 5);
                });
        }

        // 2) Verify OTP
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

                    // Now submit vendor form
                    setTimeout(() => {
                        const form = document.getElementById('vendor-form');
                        form.action = "{{ route('vendor.vendor_registration') }}";
                        form.submit();
                    }, 2000);
                })
                .catch((error) => {
                    console.error("OTP verification error:", error);
                    document.getElementById('verificationCodeError').textContent = error.message;
                });
        }

        // "Back" button from Step 2 -> Step 1
        function prevStep() {
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-1').style.display = 'block';
        }

        // Resend OTP
        function resendCode() {
            // re-init the 60s countdown
            timeLeft = 60;
            sendCodeAndContinue();
        }
    </script>
@endsection
