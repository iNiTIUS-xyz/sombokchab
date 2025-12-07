@extends('frontend.frontend-page-master')

@section('page-title')
    {{ __('Vendor Reset Password') }}
@endsection

@section('content')
    <section class="sign-in-area-wrapper padding-top-20 padding-bottom-20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="sign-in register">
                        <div class="form-wrapper custom__form mt-4">
                            <!-- Display success/error messages -->
                            <div class="alert alert-danger" id="error" style="display: none;"></div>
                            <div class="alert alert-success" id="sentSuccess" style="display: none;">
                                OTP sent successfully.
                            </div>
                            <div class="alert alert-success" id="verifiedSuccess" style="display: none;">
                                Phone verified successfully.
                            </div>
                            <div class="alert alert-success" id="passwordUpdated" style="display: none;">
                                Password updated successfully.
                            </div>

                            <div id="step-1">
                                <form id="step1-form" method="POST" novalidate>
                                    @csrf
                                    <input type="hidden" name="verified_phone" id="verified_phone">
                                    <div class="form-group">
                                        <label>{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            placeholder="{{ __('Enter Phone Number') }}" required>
                                        <small class="text-danger" id="phoneError"></small>
                                    </div>
                                    <button type="button" class="btn btn-next step-button-outline mt-2"
                                        onclick="checkPhoneAndSendOTP()" id="sendOtpButton" disabled>
                                        {{ __('Send OTP') }}
                                    </button>
                                </form>
                            </div>
                            <!-- Step 2: Verify OTP -->
                            <div id="step-2" style="display: none;">
                                <div class="form-group">
                                    <label>Enter OTP</label>
                                    <input type="text" id="verificationCode" class="form-control"
                                        placeholder="6-digit Code">
                                    <small class="text-danger" id="verificationCodeError"></small>
                                </div>
                                <button type="button" class="btn btn-next step-button-outline mt-4"
                                    onclick="verifyPhoneOTP()">Verify OTP</button>
                                <button type="button" class="btn btn-prev step-button-outline mt-4"
                                    onclick="prevStep(1)">Back</button>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-link" id="resendOtpButton" onclick="resendOTP()"
                                        disabled>
                                        Resend OTP <span id="resendTimer">(60s)</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: Reset Password -->
                            <div id="step-3" style="display: none;">
                                <form id="reset-password-form" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" id="newPassword" name="newPassword" class="form-control"
                                            required>
                                        <small class="text-danger" id="newPasswordError"></small>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm New Password</label>
                                        <input type="password" id="confirmNewPassword" name="confirmNewPassword"
                                            class="form-control" required>
                                        <small class="text-danger" id="confirmNewPasswordError"></small>
                                    </div>
                                    <button type="button" class="btn btn-submit" onclick="updatePassword()">Update
                                        Password</button>
                                    <button type="button" class="btn btn-prev step-button-outline mt-4"
                                        onclick="prevStep(2)">Previous</button>
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
    <script>
        let resendTimeout = 60;
        let resendInterval;

        const phoneInput = document.getElementById('phone');
        const phoneError = document.getElementById('phoneError');
        const sendOtpButton = document.getElementById('sendOtpButton');

        // Message elements
        const errorDiv = document.getElementById('error');
        const sentSuccessDiv = document.getElementById('sentSuccess');
        const verifiedSuccessDiv = document.getElementById('verifiedSuccess');
        const passwordUpdatedDiv = document.getElementById('passwordUpdated');

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

        function showSentSuccess(message = 'OTP sent successfully!') {
            hideAllMessages();
            sentSuccessDiv.textContent = message;
            sentSuccessDiv.style.display = 'block';
        }

        function showVerifiedSuccess(message = 'Phone verified successfully!') {
            hideAllMessages();
            verifiedSuccessDiv.textContent = message;
            verifiedSuccessDiv.style.display = 'block';
        }

        function showPasswordUpdated(message = 'Password updated successfully!') {
            hideAllMessages();
            passwordUpdatedDiv.textContent = message;
            passwordUpdatedDiv.style.display = 'block';
        }


        function validatePhone(value) {
            // Updated regex to accept any country code with valid phone number
            const phoneRegex = /^\+(?:[0-9] ?){6,14}[0-9]$/;
            const msgPone = 'Invalid phone number format. Please include country code (e.g., +88016XXXXXXX).';
            return phoneRegex.test(value) ? '' : msgPone;
        }

        // Real-time phone validation
        phoneInput.addEventListener('input', () => {
            const errorMsg = validatePhone(phoneInput.value);
            phoneError.textContent = errorMsg;
            sendOtpButton.disabled = !!errorMsg;
        });

        function checkPhoneAndSendOTP() {
            const phoneVal = phoneInput.value.trim();
            const errorMsg = validatePhone(phoneVal);
            if (errorMsg) {
                phoneError.textContent = errorMsg;
                return;
            }

            hideAllMessages();

            // Check if phone exists in DB
            fetch("{{ route('vendor.check-phone-existence') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        phone: phoneVal
                    })
                })
                .then(resp => resp.json())
                .then(data => {
                    if (data.exists) {
                        sendOTP(phoneVal);
                    } else {
                        showError('This phone number is not registered!');
                    }
                })
                .catch(err => {
                    console.error('Error checking phone existence:', err);
                    showError('Server error. Please try again.');
                });
        }

        function sendOTP(phoneVal) {
            fetch("{{ route('send.otp') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        phone: phoneVal
                    })
                })
                .then(resp => resp.json())
                .then(data => {
                    if (data.success) {
                        showSentSuccess();
                        setTimeout(() => {
                            document.getElementById('step-1').style.display = 'none';
                            document.getElementById('step-2').style.display = 'block';
                            startResendTimer();
                        }, 1500);
                    } else {
                        showError(data.error || 'Failed to send OTP.');
                    }
                })
                .catch(err => {
                    console.error('Error sending OTP:', err);
                    showError('Server error. Please try again.');
                });
        }

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

        function resendOTP() {
            const phoneVal = document.getElementById('phone').value.trim();
            if (!phoneVal) {
                showError('Phone number is required.');
                return;
            }

            hideAllMessages();
            resendTimeout = 60;
            sendOTP(phoneVal);
        }

        function verifyPhoneOTP() {
            const codeVal = document.getElementById('verificationCode').value.trim();
            const phoneVal = document.getElementById('phone').value.trim();

            if (!codeVal) {
                document.getElementById('verificationCodeError').textContent = 'OTP code is required.';
                return;
            }
            document.getElementById('verificationCodeError').textContent = '';

            hideAllMessages();

            fetch("{{ route('verify.otp') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        phone: phoneVal,
                        otp: codeVal
                    })
                })
                .then(resp => resp.json())
                .then(data => {
                    if (data.success) {
                        showVerifiedSuccess();
                        document.getElementById('verified_phone').value = phoneVal;

                        setTimeout(() => {
                            document.getElementById('step-2').style.display = 'none';
                            document.getElementById('step-3').style.display = 'block';
                        }, 1500);
                    } else {
                        showError(data.error || 'Invalid OTP.');
                    }
                })
                .catch(err => {
                    console.error('Error verifying OTP:', err);
                    showError('Server error. Please try again.');
                });
        }

        function updatePassword() {
            const phone = document.getElementById('verified_phone').value;
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
                        showPasswordUpdated();
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

        function prevStep(stepNumber) {
            document.getElementById('step-' + (stepNumber + 1)).style.display = 'none';
            document.getElementById('step-' + stepNumber).style.display = 'block';
        }
    </script>
@endsection
