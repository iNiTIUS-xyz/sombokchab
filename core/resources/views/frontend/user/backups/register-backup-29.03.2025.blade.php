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
                    <!--<h4 class="single-title">{{ __('Create Account') }}</h4>-->
                    <div class="form-wrapper custom__form mt-4">
                        <x-msg.error />
                        <x-msg.flash />
                        
                        <div class="alert alert-danger" id="error" style="display: none;"></div>
                        <div class="alert alert-success" id="sentSuccess" style="display: none;">OTP Sent Successfully!</div>
                        <div class="alert alert-success" id="verifiedSuccess" style="display: none;">Account Created Successfully!</div>

                        <!-- Step 1: Account Details and Phone Number -->
                        <div id="step-1">
                            <form id="account-form" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <input type="hidden" name="phone" id="verified_phone">

                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Phone Number -->
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Phone Number *') }} </label>
                                            <input type="text" id="number" name="phone" class="form--control radius-10" placeholder="Phone Number (with country code) *" required>
                                            <small class="text-danger" id="phoneError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Name *') }} </label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name *') }}" required>
                                            <small class="text-danger" id="nameError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Username *') }} </label>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="{{ __('Username *') }}" required>
                                            <small class="text-danger" id="usernameError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Email') }} </label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('Email') }}">
                                            <small class="text-danger" id="emailError"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Password *') }} </label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password *') }}" required>
                                            <small>
                                                <ul>
                                                    <li>Minimum 8 characters</li>
                                                </ul>
                                            </small>
                                            <small class="text-danger" id="passwordError"></small>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label-title color-light mb-2"> {{ __('Confirm Password *') }} </label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password *') }}" required>
                                            <small class="text-danger" id="passwordConfirmError"></small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="box-wrap form-check">
                                        <input type="checkbox" class="form-check-input" id="toc_and_privacy" name="agree_terms" required>
                                        <label class="form-check-label" for="toc_and_privacy">
                                            {{ __('Accept all') }}
                                            <a href="{{ url(get_static_option('toc_page_link')) }}" class="text-active">{{ __('Terms and Conditions') }}</a> &amp;
                                            <a href="{{ url(get_static_option('privacy_policy_link')) }}" class="text-active">{{ __('Privacy Policy') }}</a>
                                        </label>
                                    </div>
                                    <small class="text-danger" id="termsError"></small>
                                </div>
                                <div id="recaptcha-container"></div>
                                <button type="button" class="btn btn-next step-button-outline mt-4" onclick="sendCodeAndContinue()" id="continueButton" disabled>Continue</button>
                            </form>
                        </div>

                        <!-- Step 2: OTP Verification -->
                        <div id="step-2" style="display: none;">
                            <div id="verification-form" class="mb-3">
                                <form>
                                    <div class="form-group d-flex">
                                        <input type="text" id="verificationCode" class="form-control" placeholder="Enter verification code">
                                        <button type="button" class="btn btn-submit" onclick="verifyAndCreateAccount()">Verify & Create Account</button>
                                    </div>
                                    <button class="btn btn-outline-success">Resend Code</button>
                                    <small class="text-danger" id="verificationCodeError"></small>
                                </form>
                            </div>
                            <button type="button" class="btn btn-prev step-button-outline mt-4" onclick="prevStep()">Back</button>
                        </div>

                        <div class="signin__account__para d-flex justify-content-center mt-4">
                            <p class="info">{{ __('Already Have account?') }}</p>
                            <a href="{{ route('user.login') }}" class="active">
                                <strong>{{ __('Sign in') }}</strong>
                            </a>
                        </div>
                    </div>

                    <script>
                        // Real-time Validation
                        const phoneField = document.getElementById('number');
                        const nameField = document.getElementById('name');
                        const usernameField = document.getElementById('username');
                        const emailField = document.getElementById('email');
                        const passwordField = document.getElementById('password');
                        const confirmPasswordField = document.getElementById('password_confirmation');
                        const termsCheckbox = document.getElementById('toc_and_privacy');
                        const continueButton = document.getElementById('continueButton');
                    
                        function validatePhone(value) {
                            const phoneRegex = /^(\+855\d{8,9}|\+8801\d{9}|\+1\d{10})$/;
                            return !phoneRegex.test(value) ? 'Invalid phone number format' : '';
                        }
                    
                        function validateEmail(value) {
                            if (value.trim() === '') {
                                return ''; // Email is optional, so no error if it's empty
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
                    
                        function validateTerms(isChecked) {
                            return !isChecked ? 'You must accept the terms and conditions' : '';
                        }
                    
                        async function checkFieldAvailability(field, value) {
                            if (value.trim() === '') return ''; // Skip validation for empty fields
                    
                            try {
                                const response = await fetch("{{ route('check.user.data.availability') }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                    },
                                    body: JSON.stringify({ field, value })
                                });
                    
                                if (response.ok) {
                                    return ''; // No error
                                }
                    
                                const errorResponse = await response.json();
                                return errorResponse.error || 'Server error. Please try again later.';
                            } catch (error) {
                                console.error('Error during field availability check:', error);
                                return 'Server error. Please try again later.';
                            }
                        }
                    
                        function updateValidationMessage(fieldId, message) {
                            document.getElementById(fieldId).textContent = message;
                        }
                    
                        function updateContinueButton() {
                            const errors = [
                                document.getElementById('phoneError').textContent,
                                document.getElementById('emailError').textContent,
                                document.getElementById('usernameError').textContent,
                                validatePassword(passwordField.value),
                                validateConfirmPassword(confirmPasswordField.value, passwordField.value),
                                validateTerms(termsCheckbox.checked),
                            ].filter((error) => error !== '');
                    
                            continueButton.disabled = errors.length > 0;
                        }
                    
                        // Event listeners for real-time validation
                        phoneField.addEventListener('input', async () => {
                            const errorMessage = await checkFieldAvailability('phone', phoneField.value) || validatePhone(phoneField.value);
                            updateValidationMessage('phoneError', errorMessage);
                            updateContinueButton();
                        });
                    
                        emailField.addEventListener('input', async () => {
                            const errorMessage = await checkFieldAvailability('email', emailField.value) || validateEmail(emailField.value);
                            updateValidationMessage('emailError', errorMessage);
                            updateContinueButton();
                        });
                    
                        usernameField.addEventListener('input', async () => {
                            const errorMessage = await checkFieldAvailability('username', usernameField.value);
                            updateValidationMessage('usernameError', errorMessage);
                            updateContinueButton();
                        });
                    
                        passwordField.addEventListener('input', () => {
                            const message = validatePassword(passwordField.value);
                            updateValidationMessage('passwordError', message);
                            updateContinueButton();
                        });
                    
                        confirmPasswordField.addEventListener('input', () => {
                            const message = validateConfirmPassword(confirmPasswordField.value, passwordField.value);
                            updateValidationMessage('passwordConfirmError', message);
                            updateContinueButton();
                        });
                    
                        termsCheckbox.addEventListener('change', () => {
                            const message = validateTerms(termsCheckbox.checked);
                            updateValidationMessage('termsError', message);
                            updateContinueButton();
                        });
                    
                        function sendCodeAndContinue() {
                            const phoneError = validatePhone(phoneField.value);
                            if (phoneError) {
                                updateValidationMessage('phoneError', phoneError);
                                return;
                            }
                    
                            firebase.auth().signInWithPhoneNumber(phoneField.value, window.recaptchaVerifier)
                                .then((confirmationResult) => {
                                    window.confirmationResult = confirmationResult;
                                    document.getElementById('sentSuccess').style.display = 'block';
                                    document.getElementById('step-1').style.display = 'none';
                                    document.getElementById('step-2').style.display = 'block';
                                })
                                .catch((error) => {
                                    updateValidationMessage('error', error.message);
                                });
                        }
                    
                        function verifyAndCreateAccount() {
                            const code = document.getElementById('verificationCode').value;
                            if (!code) {
                                updateValidationMessage('verificationCodeError', 'Verification code is required');
                                return;
                            }
                    
                            window.confirmationResult.confirm(code)
                                .then(() => {
                                    document.getElementById('verified_phone').value = phoneField.value;
                                    document.getElementById('verifiedSuccess').style.display = 'block';
                                    document.getElementById('account-form').submit();
                                })
                                .catch((error) => {
                                    updateValidationMessage('error', error.message);
                                });
                        }
                    
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
                                        console.error('reCAPTCHA expired');
                                        renderReCAPTCHA();
                                    }
                                });
                            }
                            window.recaptchaVerifier.render();
                        }
                    </script>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    #account-form label{
        font-size: 16px;
        font-weight: bold;

    }
</style>
@endsection
@section('script')

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
        function phoneSendAuth() {
            const number = $("#number").val();
            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier)
                .then(function (confirmationResult) {
                    window.confirmationResult = confirmationResult;
                    coderesult = confirmationResult;
                    console.log(coderesult);
                    $("#successRegsiter").text("OTP sent successfully. Please check your phone.").show();
                    $("#verification-form").show(); // Show the verification form
                })
                .catch(function (error) {
                    console.error(error);
                    $("#error").text(error.message).show();
                });
        }

        function codeverify() {
            const code = $("#verificationCode").val();
            coderesult.confirm(code)
                .then(function (result) {
                    const user = result.user;
                    console.log(user);

                    // Display success message
                    $("#successRegsiter").text("Your phone number has been verified successfully!").show();

                    // Set the verified phone number in the hidden input field
                    const phoneNumber = $("#number").val();
                    $("#verified_phone").val(phoneNumber);
                })
                .catch(function (error) {
                    console.error(error);
                    $("#error").text(error.message).show();
                });
        }


        window.onload = function () {
            render();
        };

        function render() {
            if (!window.recaptchaVerifier) {
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
                    'recaptcha-container',
                    {
                        size: 'normal',
                        callback: function (response) {
                            console.log("reCAPTCHA resolved");
                        },
                        'expired-callback': function () {
                            console.error("reCAPTCHA expired. Reinitializing...");
                            render();
                        }
                    }
                );
            }
            window.recaptchaVerifier.render().then((widgetId) => {
                console.log("reCAPTCHA Widget ID:", widgetId);
            });
        }
    </script>
    
    <script>
    // Global variable to store the reCAPTCHA verifier
    let recaptchaVerifier;

    window.onload = function () {
        renderReCAPTCHA();
    };

    // Function to render reCAPTCHA
    function renderReCAPTCHA() {
        if (!recaptchaVerifier) {
            recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                size: 'normal', // Can be 'normal' or 'invisible'
                callback: function (response) {
                    console.log("reCAPTCHA resolved:", response);
                },
                'expired-callback': function () {
                    console.error("reCAPTCHA expired. Please resolve it again.");
                    renderReCAPTCHA();
                }
            });
        }
        recaptchaVerifier.render().then((widgetId) => {
            console.log("reCAPTCHA rendered with widget ID:", widgetId);
        });
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

                // Move to Step 2
                setTimeout(() => {
                    document.getElementById('step-1').style.display = 'none';
                    document.getElementById('step-2').style.display = 'block';
                }, 2000);
            })
            .catch((error) => {
                console.error("Error during signInWithPhoneNumber:", error);
                document.getElementById('error').textContent = error.message;
                document.getElementById('error').style.display = 'block';
            });
    }

    // Function to verify OTP and create account
    function verifyAndCreateAccount() {
        const code = document.getElementById('verificationCode').value;

        if (!code) {
            document.getElementById('verificationCodeError').textContent = 'Verification code is required';
            return;
        }

        window.confirmationResult.confirm(code)
            .then((result) => {
                // OTP verified, proceed with account creation
                document.getElementById('verified_phone').value = document.getElementById('number').value;
                document.getElementById('verifiedSuccess').style.display = 'block';

                // Submit the account creation form
                setTimeout(() => {
                    document.getElementById('account-form').submit();
                }, 2000);
            })
            .catch((error) => {
                console.error("Error during OTP verification:", error);
                document.getElementById('error').textContent = error.message;
                document.getElementById('error').style.display = 'block';
            });
    }
</script>


@endsection
@section('script')

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

@endsection
