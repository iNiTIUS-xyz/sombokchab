@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Sign In') }}
@endsection
@section('content')
    <!-- SignIn Area Starts -->
    <section class="signin-area padding-top-20 padding-bottom-20">
        <div class="container-three">
            <div class="signin-wrappers">
                <div class="signin-contents">
                    {{-- <form method="post" class="login-form padding-top-20 register-form"
                        id="login_form_order_page" onsubmit="return validateLoginForm()">
                        <div class="error-wrap"></div>
                        @csrf --}}
                    <form action="{{ route('user.login') }}" method="post" class="login-form padding-top-20 register-form"
                        id="login_form_order_page">
                        <div class="error-wrap"></div>
                        @csrf
                        <div class="single-input">
                            <label class="label-title mb-2"> {{ __("Phone Number or Email") }} </label>
                            <input class="form--control" type="text" id="login_phone" name="phone"
                                placeholder="{{ __("Type Phone Number without Country Code or Email") }}">
                            <small id="login_phone_error" class="text-danger"></small>
                        </div>

                        <div class="dashboard-input mt-4">
                            <label class="label-title mb-2"> {{ __('Password') }} </label>
                            <input class="form--control" name="password" id="login_password" type="password"
                                placeholder="{{ __('Type Password') }}">
                            <div class="toggle-password">
                                <span class="show-icon" style="display: inline;"> <i class="las la-eye-slash"></i> </span>
                                <span class="hide-icon" style="display: none;"> <i class="las la-eye"></i> </span>
                            </div>
                            <small id="login_password_error" class="text-danger"></small>
                        </div>

                        {{-- <div class="single-input mt-4">
                            <label class="label-title mb-2"> {{ __("Password") }} </label>
                            <input class="form--control" type="password" id="login_password" name="password"
                                placeholder="{{ __('Type Password') }}"
                                >
                            <div class="toggle-password">
                                <span class="show-icon" style="display: inline;"> <i class="las la-eye-slash"></i> </span>
                                <span class="hide-icon" style="display: none;"> <i class="las la-eye"></i> </span>
                            </div>
                            
                        </div> --}}
                        <div class="dashboard-btn-wrapper mt-4">
                            <button type="submit" class="btn-submit dashboard-bg w-100"> {{ __('Sign In') }}</button>
                        </div>
                    </form>

                    {{-- <form action="{{ route('user.login') }}" method="post" class="login-form padding-top-20 register-form"
                        id="login_form_order_page" onsubmit="return validateLoginForm()">
                        <div class="error-wrap"></div>
                    
                        <!-- Toggle Button for Phone/Email -->
                        <div class="toggle-input-type mb-3">
                            <button type="button" id="togglePhoneEmail" class="btn btn-outline-secondary">
                                {{ __('Use Email') }}
                            </button>
                        </div>
                    
                        <!-- Phone Input (Default) -->
                        <div class="single-input phone-input">
                            <label class="label-title mb-2"> {{ __('Phone Number') }} </label>
                            <div class="d-flex">
                                <select id="phone_country_code" class="form-select" style="width: 30% !important; border: 1px solid rgba(221, 221, 221, 0.4) !important; box-shadow: 0 0 10px rgba(255, 255, 255, 0.1) !important;">
                                    <option value="+1" selected>+1</option>
                                    <option value="+880">+880</option>
                                    <option value="+855">+855</option>
                                </select>
                                <input id="number" name="phone" type="text" class="form--control radius-10" placeholder="{{ __('Phone Number') }}" required style="width: 70% !important; border-radius: 0px;">
                            </div>
                            <small id="login_phone_error" class="text-danger"></small>
                        </div>
                    
                        <!-- Email Input (Hidden by Default) -->
                        <div class="single-input email-input" style="display: none;">
                            <label class="label-title mb-2"> {{ __('Email') }} </label>
                            <input class="form--control" type="email" name="phone" id="login_email" placeholder="{{ __('Type Email') }}" required>
                            <small id="login_email_error" class="text-danger"></small>
                        </div>
                    
                        <!-- Password Input with Toggle Eye -->
                        <div class="single-input mt-4">
                            <label class="label-title mb-2"> {{ __("Password") }} </label>
                            <div class="position-relative">
                                <input class="form--control" type="password" id="login_password" name="password" placeholder="{{ __('Type Password') }}">
                                <div class="toggle-password position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                    <span class="show-icon" style="display: inline;"> <i class="las la-eye-slash"></i> </span>
                                    <span class="hide-icon" style="display: none;"> <i class="las la-eye"></i> </span>
                                </div>
                            </div>
                            <small id="login_password_error" class="text-danger"></small>
                        </div>
                    
                        <div class="dashboard-btn-wrapper">
                            <button type="submit" class="btn-submit dashboard-bg w-100"> {{ __('Sign In') }}</button>
                        </div>
                    </form> --}}
                    
                    
                    <div class="single-checbox mt-3">
                        <div class="checkbox-inlines">
                            <input class="check-input" type="checkbox" id="login_remember" name="remember">
                            <label class="checkbox-label" for="login_remember"> {{ __("Remember Me") }} </label>
                        </div>
                        <div class="forgot-password">
                            <a href="{{ route('user.forget.password') }}" class="forgot-btn color-one"> {{ __("Forgot Password?") }} </a>
                        </div>
                    </div>
                    {{-- <div class="signin-bottom-contents">
                        <div class="or-contents mb-2">
                            <span class="or-para"> {{ __("Or") }} </span>
                        </div>
                        <div class="signin-others">
                            <div class="row g-2">
                                <div class="col-md-12">
                                    @if (get_static_option('enable_google_login'))
                                        <a href="{{ route('login.google.redirect') }}" class="special-account">
                                            <img src="{{ asset('assets/frontend/img/icon/google-icon.svg') }}" alt="icon">
                                            <p class="special-account-para">{{ __("Login With Google") }}</p>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="dashboard-bottom-contents">
                        <div class="account-bottom">
                            <span class="account-title mt-3"> {{ __("Don't have an account?") }} </span>
                            <a href="{{ route('user.register') }}" class="signup-login mt-3">
                                {{ __('Sign up') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SignIn Area end -->
@endsection
@section('script')
    @include('frontend.partials.google-captcha')
    @include('frontend.partials.gdpr-cookie')
    @include('frontend.partials.inline-script')
    @include('frontend.partials.twakto')
    <x-sweet-alert-msg />
    <script src="{{ asset('assets/common/js/toastr.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $(document).on('click', '#login_btn', function(e) {
                    e.preventDefault();
                    let formContainer = $('#login_form_order_page');
                    let el = $(this);
                    let phone = $('#login_form_order_page #login_phone').val();
                    let password = $('#login_form_order_page #login_password').val();
                    let remember = $('#login_form_order_page #login_remember').val();

                    el.text('{{ __('Please Wait') }}');

                    $.ajax({
                        type: 'post',
                        url: "{{ route('user.ajax.login') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            phone: phone,
                            password: password,
                            remember: remember,
                        },
                        success: function(data) {
                            if (data.status === 'invalid') {
                                el.text('{{ __('Login') }}');
                                formContainer.find('.error-wrap').html(
                                    '<div class="alert alert-danger">' + data.msg +
                                    '</div>');
                            } else {
                                formContainer.find('.error-wrap').html('');
                                el.text('{{ __('Login Success.. Redirecting ..') }}');
                                setTimeout(function() {
                                    location.reload();
                                }, 500);
                            }
                        },
                        error: function(data) {
                            let response = data['responseJSON']['errors'];

                            formContainer.find('.error-wrap').html(
                                '<ul class="alert alert-danger"></ul>');
                            $.each(response, function(value, index) {
                                formContainer.find('.error-wrap ul').append('<li>' +
                                    capitalizeFirstLetter(index[0]) + '</li>');
                            });
                            el.text('{{ __('Login') }}');
                        }
                    });
                });

                $('.nav-item .nav-link').on('click', function() {
                    $('#forgot-password').removeClass('active');
                });
            });
        })(jQuery)

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>

    {{-- <script>
        function validatePhoneOrEmail(value) {
            const phoneRegex = /^(\+855\d{8,9}|\+8801\d{9}|\+1\d{10})$/; // Phone number format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email format

            if (phoneRegex.test(value) || emailRegex.test(value)) {
                return ''; // Valid input
            }
            return 'Enter a valid phone number or email';
        }

        function validatePassword(value) {
            return value.trim() === '' ? 'Password is required' : '';
        }

        function validateLoginForm() {
            const phoneOrEmailField = document.getElementById('login_phone');
            const passwordField = document.getElementById('login_password');
            const phoneErrorField = document.getElementById('login_phone_error');
            const passwordErrorField = document.getElementById('login_password_error');

            // Validate phone/email
            const phoneOrEmailError = validatePhoneOrEmail(phoneOrEmailField.value.trim());
            phoneErrorField.textContent = phoneOrEmailError;

            // Validate password
            const passwordError = validatePassword(passwordField.value);
            passwordErrorField.textContent = passwordError;

            // Prevent form submission if there are errors
            return phoneOrEmailError === '' && passwordError === '';
        }

        // Real-time validation
        document.getElementById('login_phone').addEventListener('input', function () {
            const errorMessage = validatePhoneOrEmail(this.value.trim());
            document.getElementById('login_phone_error').textContent = errorMessage;
        });

        document.getElementById('login_password').addEventListener('input', function () {
            const errorMessage = validatePassword(this.value.trim());
            document.getElementById('login_password_error').textContent = errorMessage;
        });
    </script> --}}

    <script>
        // Toggle Password Visibility
        const passwordInput = document.getElementById('login_password');
            const showIcon = document.querySelector('.show-icon');
            const hideIcon = document.querySelector('.hide-icon');

            showIcon.addEventListener('click', function () {
                passwordInput.type = 'text';
                showIcon.style.display = 'none';
                hideIcon.style.display = 'inline';
            });

            hideIcon.addEventListener('click', function () {
                passwordInput.type = 'password';
                showIcon.style.display = 'inline';
                hideIcon.style.display = 'none';
            });
    </script>

    <!-- JavaScript for Toggle Functionality and Password Visibility -->
    {{-- <script>
        // Toggle Phone/Email
        document.getElementById('togglePhoneEmail').addEventListener('click', function () {
            const phoneInput = document.querySelector('.phone-input');
            const emailInput = document.querySelector('.email-input');
            const toggleButton = this;

            if (phoneInput.style.display === 'none') {
                phoneInput.style.display = 'block';
                emailInput.style.display = 'none';
                toggleButton.textContent = '{{ __('Use Email') }}';
            } else {
                phoneInput.style.display = 'none';
                emailInput.style.display = 'block';
                toggleButton.textContent = '{{ __('Use Phone') }}';
            }
        });

        
    </script> --}}
@endsection
