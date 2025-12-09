@extends('frontend.frontend-master')
@section('style')
    <style>
        #vendor-form label {
            line-height: 20px;
            color: var(--heading-color);
            font-size: 16px !important;
            font-weight: 500 !important;
        }

        small.text-danger {
            font-size: 12px;
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
    <section class="vendor-registration-area padding-top-20 padding-bottom-20">
        <div class="container container-one">
            <div class="row justify-content-center flex-lg-row flex-column-reverse">
                <div class="col-lg-5">
                    <x-error-msg />
                    <x-msg.success />
                    <div class="dashboard__card">
                        <div class="alert alert-danger" id="error" style="display: none;"></div>
                        <div class="alert alert-success" id="sentSuccess" style="display: none;">
                            OTP Sent Successfully!
                        </div>
                        <div class="alert alert-success" id="verifiedSuccess" style="display: none;">
                            Account Created Successfully!
                        </div>
                        <div id="step-1">
                            <form id="vendor-form" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <input type="hidden" name="phone" id="verified_phone">
                                <input type="hidden" name="country_id" value="31">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="label-title mb-2">
                                                {{ __('Store Name') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input name="business_name" id="business_name" type="text" maxlength="50"
                                                class="form--control radius-10" placeholder="{{ __('Enter Store Name') }}"
                                                required />
                                            <small class="text-danger" id="businessNameError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title mb-2">
                                                {{ __('Phone Number') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <select id="phone_country_code" name="phone_country_code"
                                                    class="form-select" style="width: 35% !important;">
                                                    <option value="+1" selected>+1</option>
                                                    <option value="+880">+880</option>
                                                    <option value="+855">+855</option>
                                                </select>
                                                <input id="number" name="phone" type="number"
                                                    class="form--control radius-10"
                                                    placeholder="{{ __('Enter Phone Number') }}" required
                                                    style="width: 85% !important;" />
                                            </div>
                                            <small class="text-danger" id="phoneError"></small>
                                        </div>
                                    </div>
                                    <!-- Username -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title mb-2">
                                                {{ __('Username') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input name="username" id="username" type="text" maxlength="20"
                                                class="form--control radius-10" placeholder="{{ __('Enter Username') }}"
                                                required />
                                            <small class="text-danger" id="usernameError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title mb-2">
                                                {{ __('Email') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input name="email" id="email" type="text" maxlength="50"
                                                class="form--control radius-10" placeholder="{{ __('Enter Email') }}" />
                                            <small class="text-danger" id="emailError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title mb-2">
                                                {{ __('Passport or National ID') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input name="passport_nid" id="passport_nid" type="number"
                                                class="form--control radius-10"
                                                placeholder="{{ __('Enter Passport or National ID') }}" required />
                                            <small class="text-danger" id="passportNidError"></small>
                                        </div>
                                    </div>
                                    <div class="nice-select-two mb-2">
                                        <div class="form-group">
                                            <label class="label-title mb-2">
                                                {{ __('Business Category') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select id="business_type" name="business_type_id" class="form--control"
                                                aria-label="Business Category">
                                                <option value="">{{ __('Select business category') }}</option>
                                                @foreach ($business_type as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('business_type_id', $vendor->business_type_id ?? '') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12" id="taxIdWrapper">
                                        <div class="form-group">
                                            <label class="label-title mb-2">
                                                {{ __('Tax ID') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input name="tax_id" id="tax_id" type="text" maxlength="13"
                                                class="form--control radius-10" placeholder="{{ __('Enter Tax ID') }}" />
                                            <small class="text-danger" id="taxIdError"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title mb-2">
                                                {{ __('Password') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="position-relative">
                                                <input name="password" id="password" type="password" maxlength="30"
                                                    class="form--control radius-10"
                                                    placeholder="{{ __('Enter Password') }}" required />
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
                                            <small class="text-danger" id="passwordError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title mb-2">
                                                {{ __('Confirm Password') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="position-relative">
                                                <input name="password_confirmation" id="password_confirmation"
                                                    maxlength="30" type="password" class="form--control radius-10"
                                                    placeholder="{{ __('Enter Confirm Password') }}" required />
                                                <div class="toggle-password position-absolute"
                                                    style="right: 10px; top: 45%; transform: translateY(-50%); cursor: pointer;">
                                                    <span class="hide-icon-two" style="display: inline;">
                                                        <i class="las la-eye-slash"></i>
                                                    </span>
                                                    <span class="show-icon-two" style="display: none;">
                                                        <i class="las la-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
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
                                                target="__blank">{{ __('Terms and Conditions') }}</a>
                                            {{ __('&') }}

                                            <a href="{{ get_static_option('privacy_policy_link') ?: '#' }}"
                                                class="text-active" target="_blank">
                                                {{ __('Privacy Policy') }}
                                            </a>


                                        </label>
                                    </div>
                                    <small class="text-danger" id="termsError"></small>
                                </div>
                                <div id="recaptcha-container"></div>
                                <div class="form-group" style="text-align: center;">
                                    <button type="button" class="btn btn-next step-button-outline p-2"
                                        onclick="sendCodeAndContinue()" id="continueButton" disabled>
                                        <span class="">{{ __('Next') }} </span>
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
@endsection
@section('script')
    <script
        src="https://www.google.com/recaptcha/api.js?render={{ get_static_option('site_google_captcha_v3_site_key') }}">
    </script>
    <script>
        // execute recaptcha if present
        if (window.grecaptcha) {
            grecaptcha.ready(function() {
                grecaptcha.execute("{{ get_static_option('site_google_captcha_v3_site_key') }}", {
                    action: 'homepage'
                }).then(function(token) {
                    const gEl = document.getElementById('gcaptcha_token');
                    if (gEl) gEl.value = token;
                });
            });
        }

        // --- ELEMENT REFERENCES (grab now; some may be null until DOM ready) ---
        const phoneCountryCode = document.getElementById('phone_country_code');
        const phoneField = document.getElementById('number');
        const businessNameField = document.getElementById('business_name');
        const emailField = document.getElementById('email');
        const usernameField = document.getElementById('username');
        const passwordField = document.getElementById('password');
        const confirmField = document.getElementById('password_confirmation');
        const passportNidField = document.getElementById('passport_nid');
        const taxIdField = document.getElementById('tax_id');
        const businessSelect = document.getElementById('business_type');
        const taxIdWrapper = document.getElementById('taxIdWrapper');
        const termsCheckbox = document.getElementById('toc_and_privacy');

        // Error displays
        const phoneErrorEl = document.getElementById('phoneError');
        const businessNameErrorEl = document.getElementById('businessNameError');
        const emailErrorEl = document.getElementById('emailError');
        const usernameErrorEl = document.getElementById('usernameError');
        const passwordErrorEl = document.getElementById('passwordError');
        const confirmErrorEl = document.getElementById('passwordConfirmError');
        const passportNidErrorEl = document.getElementById('passportNidError');
        const taxIdErrorEl = document.getElementById('taxIdError');
        const termsErrorEl = document.getElementById('termsError');
        const continueButton = document.getElementById('continueButton');

        // Timer references
        let resendTimer = null;
        let timeLeft = 60;

        // ----------------- VALIDATORS ----------------- //
        function validatePhone(countryCode, rawNumber) {
            const fullPhone = (countryCode || '') + (rawNumber || '');
            const trimmedRaw = (rawNumber || '').toString().trim();
            if (!trimmedRaw) return 'Phone number is required';
            const phoneDigitsOnly = fullPhone.replace(/\D/g, '');
            if (phoneDigitsOnly.length < 8 || phoneDigitsOnly.length > 14) {
                return 'Phone number must be between 8 and 14 digits';
            }
            if (!/^\+?\d+$/.test(fullPhone)) {
                return 'Phone number must contain only digits and optional leading +';
            }
            return '';
        }

        function validateBusinessName(value) {
            const trimmed = (value || '').trim();
            if (!trimmed) return 'Store name is required';
            if (trimmed.length < 3) return 'Store name must be at least 3 characters';
            if (!/^[A-Za-z0-9 ]+$/.test(trimmed)) {
                return 'Store name can contain only letters, numbers and spaces';
            }
            if (/^\d+$/.test(trimmed)) {
                return 'Store name cannot be only numbers';
            }
            return '';
        }

        function validateEmail(value) {
            const trimmed = (value || '').trim();
            if (!trimmed) return '';
            if (/\s/.test(trimmed)) return 'Email cannot contain spaces';
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(trimmed) ? '' : 'Invalid email';
        }

        function validateUsername(value) {
            if (!value || !value.trim()) return 'Username is required';
            const re = /^[A-Za-z0-9_]{3,20}$/;
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

        function validatePassportNid(value) {
            const trimmed = (value || '').trim();
            if (!trimmed) return 'Passport/National ID is required';
            if (!/^[A-Za-z0-9]+$/.test(trimmed)) {
                return 'Passport/National ID can contain only letters and numbers';
            }
            if (/^[A-Za-z]+$/.test(trimmed)) {
                return 'Passport/National ID cannot be only letters';
            }
            return '';
        }

        function validateTaxId(value) {
            const re = /^[A-Za-z]\d{12}$/;
            if (!re.test((value || '').trim())) {
                return 'Tax ID must be 1 letter followed by 12 digits (e.g., L000000000000)';
            }
            return '';
        }

        function validateTerms(isChecked) {
            return !isChecked ? 'You must accept the terms and conditions' : '';
        }

        // ----------------- SERVER AVAILABILITY CHECK ----------------- //
        async function checkFieldAvailability(field, value) {
            if (!value || !String(value).trim()) return '';
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
                if (resp.ok) return '';
                const errorJson = await resp.json();
                return errorJson.error || 'Server error. Please try again later.';
            } catch (e) {
                console.error('Error in availability check:', e);
                return 'Server error. Please try again later.';
            }
        }

        function displayTempMessage(elementId, message, seconds = 5) {
            const el = document.getElementById(elementId);
            if (!el) return;
            el.textContent = message;
            el.style.display = 'block';
            setTimeout(() => {
                el.style.display = 'none';
            }, seconds * 1000);
        }

        // ----------------- TAX ID TOGGLING (ROBUST WITH SELECT2 SUPPORT) ----------------- //
        (function setupTaxToggle() {
            // If necessary elements missing, skip setup (but keep rest of script working)
            if (!businessSelect || !taxIdWrapper || !taxIdField) return;

            // 1) find a reliable option value for visible text "Business" (case-insensitive)
            let businessOptionValueForBusinessText = null;
            for (let i = 0; i < businessSelect.options.length; i++) {
                const opt = businessSelect.options[i];
                if (!opt || !opt.text) continue;
                const txt = opt.text.trim().toLowerCase();
                if (txt === 'business' || txt.includes('business')) {
                    businessOptionValueForBusinessText = opt.value;
                    break;
                }
            }

            function isBusinessSelected() {
                const selectedVal = businessSelect.value;
                const selectedText = (businessSelect.options[businessSelect.selectedIndex] || {}).text || '';
                if (businessOptionValueForBusinessText !== null && selectedVal !== undefined) {
                    return String(selectedVal) === String(businessOptionValueForBusinessText);
                }
                return String(selectedText).trim().toLowerCase() === 'business' || String(selectedText).toLowerCase()
                    .includes('business');
            }

            function toggleTaxIdField() {
                if (isBusinessSelected()) {
                    taxIdWrapper.style.display = 'block';
                    taxIdField.setAttribute('required', 'required');
                } else {
                    taxIdWrapper.style.display = 'none';
                    taxIdField.removeAttribute('required');
                    taxIdField.value = '';
                    if (taxIdErrorEl) taxIdErrorEl.textContent = '';
                }
                if (typeof updateContinueButton === 'function') updateContinueButton();
            }

            // bind native
            businessSelect.addEventListener('change', toggleTaxIdField);
            // also bind jquery/select2 change if jQuery exists
            if (window.jQuery) {
                try {
                    window.jQuery('#business_type').on('change', toggleTaxIdField);
                } catch (e) {
                    /* ignore */
                }
            }

            // tax input validate only when required
            taxIdField.addEventListener('input', function() {
                if (!taxIdField.hasAttribute('required') || taxIdWrapper.style.display === 'none') {
                    if (taxIdErrorEl) taxIdErrorEl.textContent = '';
                    if (typeof updateContinueButton === 'function') updateContinueButton();
                    return;
                }
                if (taxIdErrorEl) taxIdErrorEl.textContent = validateTaxId(taxIdField.value);
                if (typeof updateContinueButton === 'function') updateContinueButton();
            });

            // call toggle after short delay so select2 initialization (if used) completes
            setTimeout(toggleTaxIdField, 200);
        })();

        // ----------------- REAL-TIME VALIDATION BINDINGS ----------------- //
        // phone
        if (phoneField) {
            phoneField.addEventListener('input', async () => {
                const errorMsg = validatePhone(phoneCountryCode ? phoneCountryCode.value : '', phoneField
                    .value);
                if (!errorMsg) {
                    const fullPhone = (phoneCountryCode ? phoneCountryCode.value : '') + phoneField.value;
                    const dbError = await checkFieldAvailability('phone', fullPhone);
                    if (phoneErrorEl) phoneErrorEl.textContent = dbError;
                } else {
                    if (phoneErrorEl) phoneErrorEl.textContent = errorMsg;
                }
                if (typeof updateContinueButton === 'function') updateContinueButton();
            });
        }
        if (phoneCountryCode) {
            phoneCountryCode.addEventListener('change', async () => {
                const errorMsg = validatePhone(phoneCountryCode.value, phoneField ? phoneField.value : '');
                if (!errorMsg) {
                    const fullPhone = phoneCountryCode.value + (phoneField ? phoneField.value : '');
                    const dbError = await checkFieldAvailability('phone', fullPhone);
                    if (phoneErrorEl) phoneErrorEl.textContent = dbError;
                } else {
                    if (phoneErrorEl) phoneErrorEl.textContent = errorMsg;
                }
                if (typeof updateContinueButton === 'function') updateContinueButton();
            });
        }

        // business name
        if (businessNameField) {
            businessNameField.addEventListener('input', () => {
                if (businessNameErrorEl) businessNameErrorEl.textContent = validateBusinessName(businessNameField
                    .value);
                if (typeof updateContinueButton === 'function') updateContinueButton();
            });
        }

        // email
        if (emailField) {
            emailField.addEventListener('input', async () => {
                const localErr = validateEmail(emailField.value);
                if (!localErr && emailField.value.trim()) {
                    const dbErr = await checkFieldAvailability('email', emailField.value.trim());
                    if (emailErrorEl) emailErrorEl.textContent = dbErr;
                } else {
                    if (emailErrorEl) emailErrorEl.textContent = localErr;
                }
                if (typeof updateContinueButton === 'function') updateContinueButton();
            });
        }

        // username
        if (usernameField) {
            usernameField.addEventListener('input', async () => {
                const localErr = validateUsername(usernameField.value);
                if (!localErr && usernameField.value.trim()) {
                    const dbErr = await checkFieldAvailability('username', usernameField.value.trim());
                    if (usernameErrorEl) usernameErrorEl.textContent = dbErr;
                } else {
                    if (usernameErrorEl) usernameErrorEl.textContent = localErr;
                }
                if (typeof updateContinueButton === 'function') updateContinueButton();
            });
        }

        // password
        if (passwordField) {
            passwordField.addEventListener('input', () => {
                if (passwordErrorEl) passwordErrorEl.textContent = validatePassword(passwordField.value);
                if (typeof updateContinueButton === 'function') updateContinueButton();
            });
        }

        // confirm password
        if (confirmField) {
            confirmField.addEventListener('input', () => {
                if (confirmErrorEl) confirmErrorEl.textContent = validateConfirmPassword(confirmField.value,
                    passwordField ? passwordField.value : '');
                if (typeof updateContinueButton === 'function') updateContinueButton();
            });
        }

        // passport / nid
        if (passportNidField) {
            passportNidField.addEventListener('input', () => {
                if (passportNidErrorEl) passportNidErrorEl.textContent = validatePassportNid(passportNidField
                    .value);
                if (typeof updateContinueButton === 'function') updateContinueButton();
            });
        }

        // terms
        if (termsCheckbox) {
            termsCheckbox.addEventListener('change', () => {
                if (termsErrorEl) termsErrorEl.textContent = validateTerms(termsCheckbox.checked);
                if (typeof updateContinueButton === 'function') updateContinueButton();
            });
        }

        // ----------------- Enable/Disable Continue Button ----------------- //
        function updateContinueButton() {
            const taxRequired = taxIdField && taxIdField.hasAttribute('required') && (!taxIdWrapper || taxIdWrapper.style
                .display !== 'none');

            const errorsPresent = (
                (phoneErrorEl && phoneErrorEl.textContent) ||
                (businessNameErrorEl && businessNameErrorEl.textContent) ||
                (emailErrorEl && emailErrorEl.textContent) ||
                (usernameErrorEl && usernameErrorEl.textContent) ||
                (passwordErrorEl && passwordErrorEl.textContent) ||
                (confirmErrorEl && confirmErrorEl.textContent) ||
                (passportNidErrorEl && passportNidErrorEl.textContent) ||
                (taxRequired ? (taxIdErrorEl && taxIdErrorEl.textContent) : '') ||
                (termsErrorEl && termsErrorEl.textContent)
            );

            const requiredFilled = (
                (phoneField && phoneField.value && phoneField.value.trim()) &&
                (businessNameField && businessNameField.value && businessNameField.value.trim()) &&
                (usernameField && usernameField.value && usernameField.value.trim()) &&
                (passwordField && passwordField.value && passwordField.value.trim()) &&
                (confirmField && confirmField.value && confirmField.value.trim()) &&
                (passportNidField && passportNidField.value && passportNidField.value.trim()) &&
                (!taxRequired || (taxIdField && taxIdField.value && taxIdField.value.trim())) &&
                (termsCheckbox && termsCheckbox.checked)
            );

            if (continueButton) continueButton.disabled = (!!errorsPresent || !requiredFilled);
        }

        // ----------------- OTP Logic ----------------- //
        function startResendTimer() {
            const resendBtn = document.getElementById('resendOtpButton');
            const resendTimerSpan = document.getElementById('resendTimer');
            timeLeft = 60;
            if (resendBtn) resendBtn.disabled = true;
            if (resendTimerSpan) resendTimerSpan.textContent = '(60s)';
            if (resendTimer) clearInterval(resendTimer);
            resendTimer = setInterval(() => {
                timeLeft--;
                if (resendTimerSpan) resendTimerSpan.textContent = `${timeLeft}s`;
                if (timeLeft <= 0) {
                    clearInterval(resendTimer);
                    if (resendBtn) resendBtn.disabled = false;
                    if (resendTimerSpan) resendTimerSpan.textContent = '';
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
            const s1 = document.getElementById('step-1');
            const s2 = document.getElementById('step-2');
            if (s2) s2.style.display = 'none';
            if (s1) s1.style.display = 'block';
            if (resendTimer) clearInterval(resendTimer);
        }

        function resendCode() {
            timeLeft = 60;
            sendCodeAndContinue();
        }

        // ----------------- INITIALIZE ON LOAD ----------------- //
        window.addEventListener('load', function() {
            // Ensure tax id visibility/required state is correct on page load
            try {
                if (typeof updateContinueButton === 'function') updateContinueButton();
                // call toggle function if it exists in the closure above (setupTaxToggle executed immediately)
                // If businessSelect exists, we already set a timeout to toggle; do one immediate check too
                if (businessSelect && taxIdWrapper && taxIdField) {
                    // small safety toggle - will be overridden by the setTimeout in the toggle setup if necessary
                    const evt = new Event('change', {
                        bubbles: true
                    });
                    try {
                        businessSelect.dispatchEvent(evt);
                    } catch (e) {
                        /* ignore */
                    }
                }
            } catch (e) {
                console.error(e);
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
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
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password_confirmation');
            const showIcon = document.querySelector('.show-icon-two');
            const hideIcon = document.querySelector('.hide-icon-two');
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
    </script>


    <script>
        $(document).ready(function() {

            // Initialize Select2


            // Toggle Tax ID field
            function toggleTaxIdField() {
                let selectedText = $("#business_type option:selected").text().trim();

                if (selectedText === "Business") {
                    $("#taxIdWrapper").show();
                } else {
                    $("#taxIdWrapper").hide();
                    $("#tax_id").val("");
                    $("#taxIdError").text("");
                }
            }

            // Run on page load
            toggleTaxIdField();

            // Run on change
            $("#business_type").on("change", function() {
                toggleTaxIdField();
            });

        });
    </script>
@endsection
