@extends('frontend.user.dashboard.user-master')

@section('section')
    <div class="dashboard-form-wrapper">
        <h2 class="dashboard__card__title">{{ __('Change Password') }}</h2>
        <div class="custom__form mt-4">
            <form action="{{ route('user.password.change') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="old_password">{{ __('Current password') }}</label>
                    <div class="input-group-custom">
                        <input type="password" class="form-control" id="old_password" name="old_password"
                            placeholder="{{ __('Current password') }}">
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
                    <small id="passwordHelp" class="form-text text-muted">
                        Password must contain: 8-20 characters, 1 uppercase, 1 lowercase, 1 number, no spaces
                    </small>
                    <small id="passwordError" class="form-text text-danger" style="display: none;"></small>
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
                    <small id="confirmHelp" class="form-text text-danger" style="display: none;"></small>
                    <small id="confirmSuccess" class="form-text text-success" style="display: none;">Passwords match!</small>
                </div>
                <div class="btn-wrapper mt-4">
                    <button type="submit" id="submitBtn" class="cmn_btn btn_bg_2" disabled>{{ __('Save Changes') }}</button>
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

        // Password validation elements
        const passwordField = document.getElementById('password');
        const confirmField = document.getElementById('password_confirmation');
        const passwordHelp = document.getElementById('passwordHelp');
        const passwordError = document.getElementById('passwordError');
        const confirmHelp = document.getElementById('confirmHelp');
        const confirmSuccess = document.getElementById('confirmSuccess');
        const submitBtn = document.getElementById('submitBtn');

        // Password validation function
        function validatePassword(password) {
            const errors = [];
            
            // Check length
            if (password.length < 8 || password.length > 20) {
                errors.push('8-20 characters');
            }
            
            // Check uppercase
            if (!/[A-Z]/.test(password)) {
                errors.push('1 uppercase');
            }
            
            // Check lowercase
            if (!/[a-z]/.test(password)) {
                errors.push('1 lowercase');
            }
            
            // Check number
            if (!/[0-9]/.test(password)) {
                errors.push('1 number');
            }
            
            // Check spaces
            if (/\s/.test(password)) {
                errors.push('no spaces');
            }
            
            return {
                isValid: errors.length === 0,
                errors: errors
            };
        }

        function validatePasswordMatch(password, confirmPassword) {
            if (password !== confirmPassword) {
                return 'Passwords do not match';
            }
            return '';
        }

        function updateSubmitButton() {
            const passwordValidation = validatePassword(passwordField.value);
            const confirmError = validatePasswordMatch(passwordField.value, confirmField.value);

            if (!passwordValidation.isValid || confirmError || passwordField.value === '' || confirmField.value === '') {
                submitBtn.disabled = true;
                submitBtn.classList.add('disabled');
            } else {
                submitBtn.disabled = false;
                submitBtn.classList.remove('disabled');
            }
        }

        passwordField.addEventListener('input', function() {
            const validation = validatePassword(this.value);
            
            if (validation.isValid) {
                passwordHelp.style.display = 'none';
                passwordError.style.display = 'none';
                this.classList.remove('is-invalid');
            } else {
                passwordHelp.style.display = 'block';
                passwordError.textContent = 'Missing: ' + validation.errors.join(', ');
                passwordError.style.display = 'block';
                this.classList.add('is-invalid');
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