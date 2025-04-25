@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Vendor Forgot Password') }}
@endsection
{{-- @section('content')
    <section class="sign-in-area-wrapper padding-top-100 padding-bottom-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="sign-in register">
                        <h2 class="single-title">{{ __('Forget Password ?') }}</h2>
                        <div class="form-wrapper custom__form mt-4">
                            <x-msg.error />
                            <x-msg.success />
                            <form action="{{ route('vendor.forget.password') }}" method="post" enctype="multipart/form-data"
                                class="register-form">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control"
                                        placeholder="{{ __('Username') }}">
                                </div>
                                <div class="form-group btn-wrapper">
                                    <button type="submit"
                                        class="btn-default rounded-btn">{{ __('Send Reset Mail') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection --}}


@section('content')
<section class="sign-in-area-wrapper padding-top-20 padding-bottom-20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6">
                <div class="sign-in register">
                    
                    <div class="form-wrapper custom__form mt-4">
                        <!-- Display success/error messages -->
                        <div class="alert alert-danger" id="error" style="display: none;"></div>
                        <div class="alert alert-success" id="sentSuccess" style="display: none;">OTP Sent Successfully!</div>
                        <div class="alert alert-success" id="verifiedSuccess" style="display: none;">Phone Verified Successfully!</div>
                        <div class="alert alert-success" id="passwordUpdated" style="display: none;">Password Updated Successfully!</div>

                        <!-- Step 1: Enter Phone -->
                        <div id="step-1">
                            <form id="step1-form" method="POST" novalidate>
                                @csrf
                                <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <input type="hidden" name="verified_phone" id="verified_phone"> 
                                
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" id="phone" name="phone" class="form-control" 
                                           placeholder="Enter Phone Number" required>
                                    <small class="text-danger" id="phoneError"></small>
                                </div>
                                
                                <!-- reCAPTCHA container for Firebase -->
                                <div id="recaptcha-container"></div>
                                
                                <button type="button" class="btn btn-next step-button-outline mt-4" 
                                        onclick="checkPhoneAndSendOTP()" id="sendOtpButton" disabled>
                                    Send OTP
                                </button>
                            </form>
                        </div>

                        <!-- Step 2: Verify OTP -->
                        {{-- <div id="step-2" style="display: none;">
                            <div class="form-group">
                                <label>Enter OTP</label>
                                <input type="text" id="verificationCode" class="form-control" placeholder="6-digit Code">
                                <small class="text-danger" id="verificationCodeError"></small>
                            </div>
                            
                            <button type="button" class="btn btn-next step-button-outline mt-4" onclick="verifyPhoneOTP()">Verify OTP</button>
                            <button type="button" class="btn btn-prev step-button-outline mt-4" onclick="prevStep(1)">Previous</button>
                        </div> --}}

                        <div id="step-2" style="display: none;">
                            <div class="form-group">
                                <label>Enter OTP</label>
                                <input type="text" id="verificationCode" class="form-control" placeholder="6-digit Code">
                                <small class="text-danger" id="verificationCodeError"></small>
                            </div>
                            
                            <button type="button" class="btn btn-next step-button-outline mt-4" onclick="verifyPhoneOTP()">Verify OTP</button>
                            <button type="button" class="btn btn-prev step-button-outline mt-4" onclick="prevStep(1)">Back</button>
                            
                            <div class="mt-3">
                                <button type="button" class="btn btn-link" id="resendOtpButton" onclick="resendOTP()" disabled>
                                    Resend OTP <span id="resendTimer">(60s)</span>
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Reset Password -->
                        <div id="step-3" style="display: none;">
                            <form id="reset-password-form" method="POST">
                                @csrf
                                <!-- phone is carried in hidden field verified_phone -->
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" id="newPassword" name="newPassword" class="form-control" required>
                                    <small class="text-danger" id="newPasswordError"></small>
                                </div>
                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <input type="password" id="confirmNewPassword" name="confirmNewPassword" class="form-control" required>
                                    <small class="text-danger" id="confirmNewPasswordError"></small>
                                </div>
                                <button type="button" class="btn btn-submit" onclick="updatePassword()">Update Password</button>
                                <button type="button" class="btn btn-prev step-button-outline mt-4" onclick="prevStep(2)">Previous</button>
                            </form>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    <script>
        // -------------------------------------------------------
        // 1) Initialize Firebase
        // -------------------------------------------------------
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

        // -------------------------------------------------------
        // 2) Global DOM refs and variables
        // -------------------------------------------------------
        let recaptchaVerifier = null;
        let confirmationResult = null;

        const phoneInput      = document.getElementById('phone');
        const phoneError      = document.getElementById('phoneError');
        const sendOtpButton   = document.getElementById('sendOtpButton');

        // "Message" elements (so we can show/hide them)
        const errorDiv        = document.getElementById('error');
        const sentSuccessDiv  = document.getElementById('sentSuccess');
        const verifiedSuccessDiv = document.getElementById('verifiedSuccess');
        const passwordUpdatedDiv  = document.getElementById('passwordUpdated');

        // -------------------------------------------------------
        // 3) Helpers to show/hide messages
        // -------------------------------------------------------
        function hideAllMessages() {
            errorDiv.style.display = 'none';
            sentSuccessDiv.style.display = 'none';
            verifiedSuccessDiv.style.display = 'none';
            passwordUpdatedDiv.style.display = 'none';
        }

        function showError(message) {
            hideAllMessages();
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
        }

        function showSentSuccess(message = 'OTP Sent Successfully!') {
            hideAllMessages();
            sentSuccessDiv.textContent = message;
            sentSuccessDiv.style.display = 'block';
        }

        function showVerifiedSuccess(message = 'Phone Verified Successfully!') {
            hideAllMessages();
            verifiedSuccessDiv.textContent = message;
            verifiedSuccessDiv.style.display = 'block';
        }

        function showPasswordUpdated(message = 'Password Updated Successfully!') {
            hideAllMessages();
            passwordUpdatedDiv.textContent = message;
            passwordUpdatedDiv.style.display = 'block';
        }

        // -------------------------------------------------------
        // 4) Render the Firebase reCAPTCHA on page load
        // -------------------------------------------------------
        window.onload = function() {
            renderFirebaseRecaptcha();
        };

        function renderFirebaseRecaptcha() {
            recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                size: 'normal',
                callback: () => {
                    console.log("Firebase reCAPTCHA solved.");
                },
                'expired-callback': () => {
                    console.log("Firebase reCAPTCHA expired; re-initializing...");
                    renderFirebaseRecaptcha();
                }
            });
            recaptchaVerifier.render();
        }

        // -------------------------------------------------------
        // 5) Validate phone format (basic)
        // -------------------------------------------------------
        function validatePhone(value) {
            // Adjust this REGEX as you need
            const phoneRegex = /^(\+855\d{8,9}|\+8801\d{9}|\+1\d{10})$/;
            return phoneRegex.test(value) ? '' : 'Invalid phone number format.';
        }

        // Real-time validation
        phoneInput.addEventListener('input', () => {
            const errorMsg = validatePhone(phoneInput.value);
            phoneError.textContent = errorMsg;
            sendOtpButton.disabled = !!errorMsg; // disable if errorMsg is not empty
        });

        // -------------------------------------------------------
        // 6) Step 1: Check phone in DB, then send OTP
        // -------------------------------------------------------
        function checkPhoneAndSendOTP() {
            const phoneVal = phoneInput.value.trim();
            const errorMsg = validatePhone(phoneVal);
            if (errorMsg) {
                phoneError.textContent = errorMsg;
                return;
            }

            // Hide all old messages first
            hideAllMessages();
            
            // 1) Check if phone exists in DB
            fetch("{{ route('vendor.check-phone-existence') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ phone: phoneVal })
            })
            .then(resp => resp.json())
            .then(data => {
                if (data.exists) {
                    // 2) If phone exists -> send OTP via Firebase
                    sendFirebaseOTP(phoneVal);
                } else {
                    // If phone does not exist -> show error
                    showError('This phone number is not registered!');
                }
            })
            .catch(err => {
                console.error('Error checking phone existence:', err);
                showError('Server error. Please try again.');
            });
        }

        // Function to start resend OTP timer
        function startResendTimer() {
            let resendOtpButton = document.getElementById("resendOtpButton");
            let resendTimer = document.getElementById("resendTimer");
            
            resendOtpButton.disabled = true;
            resendTimer.textContent = `(${resendTimeout}s)`;

            resendInterval = setInterval(() => {
                resendTimeout--;
                resendTimer.textContent = `(${resendTimeout}s)`;

                if (resendTimeout <= 0) {
                    clearInterval(resendInterval);
                    resendOtpButton.disabled = false;
                    resendTimer.textContent = "";
                }
            }, 1000);
        }

        // Function to resend OTP
        function resendOTP() {
            const phoneVal = document.getElementById('phone').value.trim();

            if (!phoneVal) {
                showError('Phone number is required.');
                return;
            }

            hideAllMessages();
            
            // Resend OTP via Firebase
            firebase.auth().signInWithPhoneNumber(phoneVal, recaptchaVerifier)
                .then(result => {
                    confirmationResult = result;
                    showSentSuccess('OTP Resent Successfully!');
                    resendTimeout = 60; // Reset timer
                    startResendTimer(); // Restart countdown
                })
                .catch(error => {
                    console.error("Error resending OTP:", error);
                    showError(error.message);
                });
        }

        // Actually send the OTP
        function sendFirebaseOTP(phoneVal) {
            if (!recaptchaVerifier) {
                renderFirebaseRecaptcha();
            }

            firebase.auth().signInWithPhoneNumber(phoneVal, recaptchaVerifier)
                .then(result => {
                    confirmationResult = result;
                    showSentSuccess('OTP Sent Successfully!');
                    
                    // Move to Step 2 and start the resend timer
                    setTimeout(() => {
                        document.getElementById('step-1').style.display = 'none';
                        document.getElementById('step-2').style.display = 'block';
                        startResendTimer();
                    }, 1500);
                })
                .catch(error => {
                    console.error("Error sending OTP:", error);
                    showError(error.message);
                });
        }

        // -------------------------------------------------------
        // 7) Step 2: Verify OTP
        // -------------------------------------------------------
        function verifyPhoneOTP() {
            const codeVal = document.getElementById('verificationCode').value.trim();
            if (!codeVal) {
                document.getElementById('verificationCodeError').textContent = 'OTP code is required.';
                return;
            }
            document.getElementById('verificationCodeError').textContent = '';

            hideAllMessages();

            confirmationResult.confirm(codeVal)
                .then(result => {
                    // Verified
                    showVerifiedSuccess('Phone Verified Successfully!');
                    // Fill hidden input with phone
                    document.getElementById('verified_phone').value = phoneInput.value.trim();

                    // Move to Step 3
                    setTimeout(() => {
                        document.getElementById('step-2').style.display = 'none';
                        document.getElementById('step-3').style.display = 'block';
                    }, 1500);
                })
                .catch(error => {
                    console.error("Error verifying OTP:", error);
                    showError(error.message);
                });
        }

        // -------------------------------------------------------
        // 8) Step 3: Update password in the DB
        // -------------------------------------------------------
        function updatePassword() {
            const phone   = document.getElementById('verified_phone').value;
            const newPass = document.getElementById('newPassword').value.trim();
            const confirm = document.getElementById('confirmNewPassword').value.trim();

            // Basic validations
            if (newPass.length < 8) {
                document.getElementById('newPasswordError').textContent = 'Password must be at least 8 characters.';
                return;
            } else {
                document.getElementById('newPasswordError').textContent = '';
            }

            if (newPass !== confirm) {
                document.getElementById('confirmNewPasswordError').textContent = 'Passwords do not match.';
                return;
            } else {
                document.getElementById('confirmNewPasswordError').textContent = '';
            }

            hideAllMessages();

            // Send request to server to update
            fetch("{{ route('vendor.update-forgot-password') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    phone: phone,
                    password: newPass,
                    password_confirmation: confirm
                })
            })
            .then(resp => resp.json())
            .then(data => {
                if (data.status === 'success') {
                    showPasswordUpdated('Password Updated Successfully!');
                    
                    // Redirect to the login page after a short delay
                    setTimeout(() => {
                        window.location.href = "{{ route('vendor.login') }}";
                    }, 2000);

                } else {
                    showError(data.message || 'Error updating password.');
                }
            })
            .catch(err => {
                console.error("Error updating password:", err);
                showError('Server error. Please try again.');
            });
        }

        // -------------------------------------------------------
        // 9) Utility: go back to previous step
        // -------------------------------------------------------
        function prevStep(stepNumber) {
            document.getElementById('step-' + (stepNumber + 1)).style.display = 'none';
            document.getElementById('step-' + stepNumber).style.display = 'block';
        }
    </script>
@endsection