@extends('frontend.user.dashboard.user-master')

@section('section')
    <div class="dashboard-form-wrapper">
        <h2 class="dashboard__card__title">{{ __('Change Password') }}</h2>
        <div class="custom__form mt-4">
            <form action="{{ route('user.password.change') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="old_password">{{ __('Old Password') }}</label>
                    <div class="input-group-custom">
                        <input type="password" class="form-control" id="old_password" name="old_password"
                            placeholder="{{ __('Old Password') }}">
                        <span class="input-group-btn">
                            <button type="button" class="btn-toggle-password" data-target="old_password">
                                <i class="la la-eye"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">{{ __('New Password') }}</label>
                    <div class="input-group-custom">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="{{ __('New Password') }}">
                        <span class="input-group-btn">
                            <button type="button" class="btn-toggle-password" data-target="password">
                                <i class="la la-eye"></i>
                            </button>
                        </span>
                    </div>
                    <small id="passwordHelp" class="form-text" style="display: none;"></small>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <div class="input-group-custom">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            placeholder="{{ __('Confirm Password') }}">
                        <span class="input-group-btn">
                            <button type="button" class="btn-toggle-password" data-target="password_confirmation">
                                <i class="la la-eye"></i>
                            </button>
                        </span>
                    </div>
                    <small id="confirmHelp" class="form-text" style="display: none;"></small>
                    <small id="confirmSuccess" class="form-text text-success" style="display: none;">Passwords
                        match!</small>
                </div>
                <div class="btn-wrapper mt-4">
                    <button type="submit" id="submitBtn" class="cmn_btn btn_bg_2">{{ __('Save Changes') }}</button>
                </div>
            </form>
        </div>
    </div>

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
            background: #faf7f7;
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

        // Password validation
        const passwordField = document.getElementById('password');
        const confirmField = document.getElementById('password_confirmation');
        const passwordHelp = document.getElementById('passwordHelp');
        const confirmHelp = document.getElementById('confirmHelp');
        const confirmSuccess = document.getElementById('confirmSuccess');
        const submitBtn = document.getElementById('submitBtn');

        // Password requirements: 8-20 characters, 1 uppercase, 1 lowercase, 1 number
        function validatePassword(password) {
            if (password.length < 8) {
                return 'Password must be at least 8 characters long';
            }
            if (password.length > 20) {
                return 'Password must not exceed 20 characters';
            }
            if (!/[A-Z]/.test(password)) {
                return 'Password must contain at least one uppercase letter';
            }
            if (!/[a-z]/.test(password)) {
                return 'Password must contain at least one lowercase letter';
            }
            if (!/[0-9]/.test(password)) {
                return 'Password must contain at least one number';
            }
            if (/\s/.test(password)) {
                return 'Password must not contain spaces';
            }
            return '';
        }

        function validatePasswordMatch(password, confirmPassword) {
            if (password !== confirmPassword) {
                return 'Passwords do not match';
            }
            return '';
        }

        function updateSubmitButton() {
            const passwordError = validatePassword(passwordField.value);
            const confirmError = validatePasswordMatch(passwordField.value, confirmField.value);

            if (passwordError || confirmError || passwordField.value === '' || confirmField.value === '') {
                submitBtn.disabled = true;
                submitBtn.classList.add('disabled');
            } else {
                submitBtn.disabled = false;
                submitBtn.classList.remove('disabled');
            }
        }

        passwordField.addEventListener('input', function() {
            const error = validatePassword(this.value);
            if (error) {
                passwordHelp.textContent = error;
                passwordHelp.className = 'form-text text-danger';
                passwordHelp.style.display = 'block';
                this.classList.add('is-invalid');
            } else {
                passwordHelp.textContent = 'Password meets all requirements';
                passwordHelp.className = 'form-text text-success';
                passwordHelp.style.display = 'block';
                this.classList.remove('is-invalid');
            }
            updateSubmitButton();
            checkPasswordMatch();
        });

        confirmField.addEventListener('input', function() {
            checkPasswordMatch();
            updateSubmitButton();
        });

        function checkPasswordMatch() {
            const error = validatePasswordMatch(passwordField.value, confirmField.value);

            if (passwordField.value === '') {
                confirmHelp.style.display = 'none';
                confirmSuccess.style.display = 'none';
                confirmField.classList.remove('is-invalid');
                return;
            }

            if (error) {
                confirmHelp.textContent = error;
                confirmHelp.className = 'form-text text-danger';
                confirmHelp.style.display = 'block';
                confirmSuccess.style.display = 'none';
                confirmField.classList.add('is-invalid');
            } else {
                confirmHelp.style.display = 'none';
                confirmSuccess.style.display = 'block';
                confirmField.classList.remove('is-invalid');
            }
        }

        // Initialize button state
        updateSubmitButton();
    </script>
@endsection
