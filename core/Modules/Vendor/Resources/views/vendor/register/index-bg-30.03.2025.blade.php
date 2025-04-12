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
                        {{-- <ul class="breadcrumb-list">
                            <li class="list"> <a href="{{ route('homepage') }}"> {{ __('Home') }} </a> </li>
                            <li class="list"> {{ __('Registration') }} </li>
                        </ul> --}}
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

                        <div class="alert alert-danger" id="error" style="display: none;"></div>
                        <div class="alert alert-success" id="sentSuccess" style="display: none;">OTP Sent Successfully!</div>
                        <div class="alert alert-success" id="verifiedSuccess" style="display: none;">Account Created Successfully!</div>
                    

                        <!-- Step 1: Form Fields -->
                        <div id="step-1">
                            <form id="vendor-form" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <input type="hidden" name="phone" id="verified_phone">

                                <!-- Phone Number -->
                                <div class="form-group">
                                    <label class="label-title color-light mb-2"> {{ __('Phone Number *') }} </label>
                                    <input value="{{ old('phone') }}" id="number" name="phone" type="text"
                                        class="form--control radius-10" placeholder="{{ __('Phone Number (with country code)') }}" required>
                                    <small class="text-danger" id="phoneError"></small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                         <!-- Owner Name -->
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Owner Name *') }} </label>
                                            <input value="{{ old('owner_name') }}" name="owner_name" id="owner_name" type="text"
                                                class="form--control radius-10" placeholder="{{ __('Owner Name') }}" required>
                                            <small class="text-danger" id="ownerNameError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Business Name -->
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Store Name *') }} </label>
                                            <input value="{{ old('business_name') }}" name="business_name" id="business_name" type="text"
                                                class="form--control radius-10" placeholder="{{ __('Store Name') }}" required>
                                            <small class="text-danger" id="businessNameError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Email -->
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Email') }} </label>
                                            <input value="{{ old('email') }}" name="email" id="email" type="text"
                                                class="form--control radius-10" placeholder="{{ __('Email') }}">
                                            <small class="text-danger" id="emailError"></small>
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                       <!-- Username -->
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Username *') }} </label>
                                            <input value="{{ old('username') }}" name="username" id="username" type="text"
                                                class="form--control radius-10" placeholder="{{ __('Username') }}" required>
                                            <small class="text-danger" id="usernameError"></small>
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <!-- Password -->
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Password *') }} </label>
                                            <input value="{{ old('password') }}" name="password" id="password" type="password"
                                                class="form--control radius-10" placeholder="{{ __('Password') }}" required>
                                                <small>
                                                    <ul>
                                                        <li>Minimum 8 characters</li>
                                                    </ul>
                                                </small>
                                                <small class="text-danger" id="passwordError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Confirm Password -->
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Confirm Password *') }} </label>
                                            <input name="password_confirmation" id="password_confirmation" type="password" class="form--control radius-10"
                                                placeholder="{{ __('Confirm Password') }}" required>
                                            <small class="text-danger" id="passwordConfirmError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Business Category -->
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Business Category *') }} </label>
                                            <div class="nice-select-two">
                                                <select name="business_type" id="business_type" class="form--control radius-10" required>
                                                    <option value="">{{ __('Select business type') }}</option>
                                                    @foreach ($business_type as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <small class="text-danger" id="businessTypeError"></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Passport or National ID -->
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Passport or National ID *') }} </label>
                                            <input value="{{ old('passport_nid') }}" name="passport_nid" id="passport_nid" type="text"
                                                class="form--control radius-10" placeholder="{{ __('Passport or National ID') }}" required>
                                            <small class="text-danger" id="passportNidError"></small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                {{-- <div class="form-group">
                                    <label class="label-title color-light mb-2"> {{ __('Description') }} </label>
                                    <textarea name="description" id="description" class="form--control form--message radius-10">{{ old('description') }}</textarea>
                                    <small class="text-danger" id="descriptionError"></small>
                                </div> --}}

                                <!-- Terms and Conditions -->
                                <div class="form-group">
                                    <div class="box-wrap form-check">
                                        <div class="left">
                                            <input type="checkbox" class="form-check-input" id="toc_and_privacy" name="agree_terms" required>
                                            <label class="form-check-label" for="toc_and_privacy">
                                                {{ __('Accept all') }}
                                                <a href="{{ url(get_static_option('toc_page_link')) }}" class="text-active">{{ __('Terms and Conditions') }}</a> &amp;
                                                <a href="{{ url(get_static_option('privacy_policy_link')) }}" class="text-active">{{ __('Privacy Policy') }}</a>
                                            </label>
                                        </div>
                                    </div>
                                    <small class="text-danger" id="termsError"></small>
                                </div>

                                <!-- reCAPTCHA -->
                                <div id="recaptcha-container"></div>

                                <!-- Continue Button -->
                                <button type="button" class="btn btn-next step-button-outline mt-4" onclick="sendCodeAndContinue()" id="continueButton" disabled>Continue</button>
                            </form>
                        </div>

                        <!-- Step 2: OTP Verification -->
                        <div id="step-2" style="display: none;">
                            <div id="verification-form" class="mb-3">
                                <form>
                                    <div class="form-group d-flex">
                                        <input type="text" id="verificationCode" class="form-control" placeholder="Enter verification code" style="border-radius: 10px 0px 0px 10px;">
                                        <button type="button" class="btn btn-submit" onclick="verifyAndCreateAccount()" style="border-radius: 0px 10px 10px 0px;">Verify & Create Account</button>
                                    </div>
                                    <button class="btn btn-outline-success">Resend Code</button>
                                    <small class="text-danger" id="verificationCodeError"></small>
                                </form>
                            </div>
                            <button type="button" class="btn btn-prev step-button-outline" onclick="prevStep()">Back</button>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </section>

    


    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    <script
        src="https://www.google.com/recaptcha/api.js?render={{ get_static_option('site_google_captcha_v3_site_key') }}">
    </script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute("{{ get_static_option('site_google_captcha_v3_site_key') }}", {
                action: 'homepage'
            }).then(function(token) {
                document.getElementById('gcaptcha_token').value = token;
            });
        });
    </script>

    <script>
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
    </script>

    <script>
        let currentStep = 1; // Step tracker
        const phoneField = document.getElementById('number');
        const emailField = document.getElementById('email');
        const usernameField = document.getElementById('username');
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('password_confirmation');
        const businessTypeField = document.getElementById('business_type');
        // const descriptionField = document.getElementById('description');
        const termsCheckbox = document.getElementById('toc_and_privacy');
        const continueButton = document.getElementById('continueButton');

        // Validation Functions for Each Field
        function validatePhoneField() {
            const phoneError = validatePhone(phoneField.value);
            checkFieldAvailability('phone', phoneField.value).then(phoneDbError => {
                document.getElementById('phoneError').textContent = phoneError || phoneDbError;
                toggleContinueButton();
            });
        }

        function validateEmailField() {
            const emailError = validateEmail(emailField.value);
            if (emailField.value.trim() !== '') {
                checkFieldAvailability('email', emailField.value).then(emailDbError => {
                    document.getElementById('emailError').textContent = emailError || emailDbError;
                    toggleContinueButton();
                });
            } else {
                document.getElementById('emailError').textContent = emailError;
                toggleContinueButton();
            }
        }

        function validateUsernameField() {
            checkFieldAvailability('username', usernameField.value).then(usernameDbError => {
                document.getElementById('usernameError').textContent = usernameDbError;
                toggleContinueButton();
            });
        }

        function validatePasswordField() {
            const passwordError = validatePassword(passwordField.value);
            document.getElementById('passwordError').textContent = passwordError;
            toggleContinueButton();
        }

        function validateConfirmPasswordField() {
            const confirmPasswordError = validateConfirmPassword(confirmPasswordField.value, passwordField.value);
            document.getElementById('passwordConfirmError').textContent = confirmPasswordError;
            toggleContinueButton();
        }

        function validateBusinessTypeField() {
            const businessTypeError = validateRequired(businessTypeField.value, 'Business type');
            document.getElementById('businessTypeError').textContent = businessTypeError;
            toggleContinueButton();
        }

        function validateTermsField() {
            const termsError = validateTerms(termsCheckbox.checked);
            document.getElementById('termsError').textContent = termsError;
            toggleContinueButton();
        }

        // Enable or Disable the Continue Button
        function toggleContinueButton() {
            const errors = [
                document.getElementById('phoneError').textContent,
                document.getElementById('emailError').textContent,
                document.getElementById('usernameError').textContent,
                document.getElementById('passwordError').textContent,
                document.getElementById('passwordConfirmError').textContent,
                document.getElementById('businessTypeError').textContent,
                document.getElementById('termsError').textContent
            ].filter(error => error !== '');

            continueButton.disabled = errors.length > 0;
        }

        // Add Event Listeners for Real-Time Validation
        phoneField.addEventListener('input', validatePhoneField);
        emailField.addEventListener('input', validateEmailField);
        usernameField.addEventListener('input', validateUsernameField);
        passwordField.addEventListener('input', validatePasswordField);
        confirmPasswordField.addEventListener('input', validateConfirmPasswordField);
        businessTypeField.addEventListener('change', validateBusinessTypeField);
        termsCheckbox.addEventListener('change', validateTermsField);

        // Reusable Validation Functions
        function validatePhone(value) {
            const phoneRegex = /^(\+855\d{8,9}|\+8801\d{9}|\+1\d{10})$/;
            return !phoneRegex.test(value) ? 'Invalid phone number format' : '';
        }

        function validateEmail(value) {
            if (value.trim() === '') {
                return ''; // Email is optional
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return !emailRegex.test(value) ? 'Invalid email format' : '';
        }

        function validatePassword(value) {
            return value.length < 8 ? 'Password must be at least 8 characters long' : '';
        }

        function validateConfirmPassword(value, password) {
            return value !== password ? 'Passwords do not match' : '';
        }

        function validateRequired(value, fieldName) {
            return value.trim() === '' ? `${fieldName} is required` : '';
        }

        function validateTerms(isChecked) {
            return !isChecked ? 'You must accept the terms and conditions' : '';
        }

        // Check Field Availability in the Database
        async function checkFieldAvailability(field, value) {
            if (value.trim() === '') return ''; // Skip validation for empty fields

            try {
                const response = await fetch("{{ route('check.vendor.data.availability') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ field, value })
                });

                if (!response.ok) {
                    const errorResponse = await response.json();
                    return errorResponse.error || 'Server error. Please try again later.';
                }

                return ''; // No error
            } catch (error) {
                console.error('Error during field availability check:', error);
                return 'Server error. Please try again later.';
            }
        }


        // Function to verify OTP and submit form
        function verifyAndCreateAccount() {
            const code = document.getElementById('verificationCode').value;

            if (!code) {
                document.getElementById('verificationCodeError').textContent = 'Verification code is required';
                return;
            }

            window.confirmationResult.confirm(code)
                .then(() => {
                    // OTP successfully verified
                    document.getElementById('verified_phone').value = phoneField.value; // Set the verified phone number
                    document.getElementById('verifiedSuccess').style.display = 'block';

                    // Trigger form submission to the vendor registration route
                    setTimeout(() => {
                        const form = document.getElementById('vendor-form');
                        form.action = "{{ route('vendor.vendor_registration') }}"; // Set form action dynamically
                        form.method = "POST"; // Ensure the form uses POST
                        form.submit(); // Submit the form
                    }, 2000); // Wait 2 seconds to display the success message before submitting the form
                })
                .catch((error) => {
                    // Display error message if OTP verification fails
                    document.getElementById('verificationCodeError').textContent = error.message;
                });
        }


        // Initialize Firebase and reCAPTCHA
        window.onload = function () {
            renderReCAPTCHA();
        };

        function renderReCAPTCHA() {
            if (!window.recaptchaVerifier) {
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                    size: 'normal',
                    callback: function () {
                        console.log('reCAPTCHA resolved');
                    },
                    'expired-callback': function () {
                        console.error('reCAPTCHA expired. Resetting...');
                        renderReCAPTCHA();
                    }
                });
            }
            window.recaptchaVerifier.render();
        }
        // Function to send OTP
        function sendCodeAndContinue() {
            const phoneNumber = document.getElementById('number').value;

            // Validate phone number format
            const phoneError = validatePhone(phoneNumber);
            if (phoneError) {
                document.getElementById('phoneError').textContent = phoneError;
                return;
            }

            // Ensure reCAPTCHA is initialized
            if (!recaptchaVerifier) {
                renderReCAPTCHA();
                document.getElementById('error').textContent = "reCAPTCHA not initialized. Please try again.";
                document.getElementById('error').style.display = 'block';
                return;
            }

            // Use Firebase to send OTP
            firebase.auth().signInWithPhoneNumber(phoneNumber, recaptchaVerifier)
                .then((confirmationResult) => {
                    // Store the confirmation result for OTP verification
                    window.confirmationResult = confirmationResult;

                    // Display success message
                    document.getElementById('sentSuccess').style.display = 'block';

                    // Move to Step 2 after showing the success message
                    setTimeout(() => {
                        document.getElementById('step-1').style.display = 'none';
                        document.getElementById('step-2').style.display = 'block';
                    }, 2000); // Wait 2 seconds to show success message before transitioning
                })
                .catch((error) => {
                    console.error("Error during signInWithPhoneNumber:", error);
                    document.getElementById('error').textContent = error.message;
                    document.getElementById('error').style.display = 'block';
                });
        }


    </script>
@endsection
