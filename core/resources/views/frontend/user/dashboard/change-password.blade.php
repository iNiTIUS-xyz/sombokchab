@extends('frontend.user.dashboard.user-master')

@section('section')
    <div class="dashboard-form-wrapper">
        <h2 class="dashboard__card__title">{{ __('Change Password') }}</h2>
        <div class="custom__form mt-4">
            <form action="{{ route('user.password.change') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="old_password">{{ __('Old Password') }}</label>
                    <input type="password" class="form-control" id="old_password" name="old_password"
                        placeholder="{{ __('Old Password') }}">
                </div>
                <div class="form-group">
                    <label for="password">{{ __('New Password') }}</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="{{ __('New Password') }}">
                    <small id="passwordHelp" class="form-text" style="display: none;"></small>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="{{ __('Confirm Password') }}">
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
    <script>
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
