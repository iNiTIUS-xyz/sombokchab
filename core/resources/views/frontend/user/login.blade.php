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
                    {{-- <h2 class="single-title"> {{ __("Sign In") }} </h2> --}}
                    <form action="{{ route('user.login') }}" method="post" class="login-form padding-top-20 register-form"
                        id="login_form_order_page" onsubmit="return validateLoginForm()">
                        <div class="error-wrap"></div>

                        <div class="single-input">
                            <label class="label-title mb-2"> {{ __("Phone Number or Email") }} </label>
                            <input class="form--control" type="text" id="login_phone" name="phone"
                                placeholder="{{ __("Type Phone Number with Country Code or Email") }}">
                            <small id="login_phone_error" class="text-danger"></small>
                        </div>
                        <div class="single-input mt-4">
                            <label class="label-title mb-2"> {{ __("Password") }} </label>
                            <input class="form--control" type="password" id="login_password" name="password"
                                placeholder="{{ __('Password') }}"
                                >
                            <small id="login_password_error" class="text-danger"></small>
                        </div>
                        <button class="btn-submit w-100" type="submit" id="login_btn"> {{ __("Sign In") }} </button>
                    </form>
                    <div class="single-checbox mt-3">
                        <div class="checkbox-inlines">
                            <input class="check-input" type="checkbox" id="login_remember" name="remember">
                            <label class="checkbox-label" for="login_remember"> {{ __("Remember Me") }} </label>
                        </div>
                        <div class="forgot-password">
                            <a href="{{ route('user.forget.password') }}" class="forgot-btn color-one"> {{ __("Forgot Password?") }} </a>
                        </div>
                    </div>
                    <div class="signin-bottom-contents">
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
                                {{-- <div class="col-md-6">
                                    @if (get_static_option('enable_facebook_login'))
                                        <a href="{{ route('login.facebook.redirect') }}" class="special-account">
                                            <img src="{{ asset('assets/frontend/img/icon/Facebook-icon.svg') }}" alt="icon">
                                            <p class="special-account-para">{{ __("Login With Facebook") }}</p>
                                        </a>
                                    @endif
                                </div> --}}
                            </div>
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

    <script>
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
    </script>
@endsection
