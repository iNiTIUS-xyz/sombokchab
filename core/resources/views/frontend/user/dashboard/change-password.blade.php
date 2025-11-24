@extends('frontend.user.dashboard.user-master')

@section('style')
    <style>
        /* Custom input group styles */
        .input-group-custom {
            position: relative;
            display: flex;
            width: 100%;
        }

        .input-group-custom .form-control {
            flex: 1;
            padding-right: 40px;
            /* Space for the button */
        }

        .input-group-btn {
            background: transparent;
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            display: flex;
            align-items: center;
            border-radius: 0 8px 8px 0;
        }

        .btn-toggle-password {
            background: transparent;
            border: none;
            padding: 0 10px;
            height: 100%;
            cursor: pointer;
            color: gray;
            outline: none;
        }

        .btn-toggle-password:hover {
            color: #e9e9e9;
        }

        .btn-toggle-password:focus {
            box-shadow: none;
        }

        /* Disabled button styles */
        .disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }
    </style>
@endsection

@section('section')
    <div class="dashboard-form-wrapper">
        <div class="custom__form mt-4">
            <form action="{{ route('user.password.change') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="old_password">
                        {{ __('Current Password') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group-custom">
                        <input type="password" class="form-control" id="old_password" name="old_password"
                            placeholder="{{ __('Enter Current Password') }}" required="">
                        <span class="input-group-btn">
                            <button type="button" class="btn-toggle-password" data-target="old_password">
                                <i class="la la-eye"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">
                        {{ __('New Password') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group-custom">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="{{ __('Enter New Password') }}" required="">
                        <span class="input-group-btn">
                            <button type="button" class="btn-toggle-password" data-target="password">
                                <i class="la la-eye"></i>
                            </button>
                        </span>
                    </div>
                    <small id="passwordHelp" class="form-text text-muted">
                        {{-- Password must contain: 8-20 characters, 1 uppercase, 1 lowercase, 1 number, no spaces --}}
                    </small>
                    <small id="passwordError" class="form-text text-danger" style="display: none;"></small>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">
                        {{ __('Confirm Password') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group-custom">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            placeholder="{{ __('Enter Confirm Password') }}" required="">
                        <span class="input-group-btn">
                            <button type="button" class="btn-toggle-password" data-target="password_confirmation">
                                <i class="la la-eye"></i>
                            </button>
                        </span>
                    </div>
                    <small id="confirmHelp" class="form-text text-danger" style="display: none;"></small>
                    <small id="confirmSuccess" class="form-text text-success" style="display: none;">
                        {{ __('Passwords match!') }}
                    </small>
                </div>
                <div class="btn-wrapper mt-4">
                    <button type="submit" id="submitBtn" class="cmn_btn btn_bg_1" disabled>{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Password toggle functionality
        document.querySelectorAll('.btn-toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('la-eye');
                    icon.classList.add('la-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('la-eye-slash');
                    icon.classList.add('la-eye');
                }
            });
        });

        // Password validation elements
        const passwordField = document.getElementById('password');
        const confirmField = document.getElementById('password_confirmation');
        const passwordHelp = document.getElementById('passwordHelp');
        const passwordError = document.getElementById('passwordError');
        const confirmHelp = document.getElementById('confirmHelp');
        const confirmSuccess = document.getElementById('confirmSuccess');
        const submitBtn = document.getElementById('submitBtn');

        // New password validation function
        function validatePassword(value) {
            const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!.*\s).{8,20}$/;
            if (!re.test(value)) {
                return 'Password must have 8-20 characters with 1 uppercase, 1 lowercase, 1 number, and no spaces';
            }
            return '';
        }

        // Confirm password validation function
        function validateConfirmPassword(confirmVal, passwordVal) {
            return confirmVal !== passwordVal ? 'Passwords do not match' : '';
        }

        // Update submit button state
        function updateSubmitButton() {
            const passwordError = validatePassword(passwordField.value);
            const confirmError = validateConfirmPassword(confirmField.value, passwordField.value);

            if (passwordError || confirmError || passwordField.value === '' || confirmField.value === '') {
                submitBtn.disabled = true;
                submitBtn.classList.add('disabled');
            } else {
                submitBtn.disabled = false;
                submitBtn.classList.remove('disabled');
            }
        }

        // Password field validation
        passwordField.addEventListener('input', function() {
            const error = validatePassword(this.value);

            if (error) {
                passwordHelp.style.display = 'block';
                passwordError.textContent = error;
                passwordError.style.display = 'block';
            } else {
                passwordHelp.style.display = 'none';
                passwordError.style.display = 'none';
            }

            updateSubmitButton();
            checkPasswordMatch();
        });

        // Confirm password field validation
        confirmField.addEventListener('input', function() {
            checkPasswordMatch();
            updateSubmitButton();
        });

        // Check if passwords match
        function checkPasswordMatch() {
            const error = validateConfirmPassword(confirmField.value, passwordField.value);

            if (passwordField.value === '') {
                confirmHelp.style.display = 'none';
                confirmSuccess.style.display = 'none';
                return;
            }

            if (error) {
                confirmHelp.textContent = error;
                confirmHelp.style.display = 'block';
                confirmSuccess.style.display = 'none';
            } else {
                confirmHelp.style.display = 'none';
                confirmSuccess.style.display = 'block';
            }
        }
        updateSubmitButton();
    </script>
@endsection
