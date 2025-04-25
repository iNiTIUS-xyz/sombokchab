@extends('frontend.frontend-page-master')

@section('page-title')
    {{ __('Vendor Sign In') }}
@endsection

@section('content')
    <section class="signin-area padding-top-20 padding-bottom-20">
        <div class="container-three">
            <div class="signin-wrappers">
                <div class="signin-contents">
                    <form action="{{ route('vendor.login') }}" method="post" class="login-form padding-top-20 register-form"
                        id="login_form_order_page" onsubmit="return validateLoginForm()">
                        @csrf
                        <div class="error-wrap"></div>
                        <div class="single-input">
                            <div class="phone-input">
                                <label class="label-title mb-1"> {{ __('Phone Number') }} </label>
                                <div class="d-flex">
                                    <select id="phone_country_code" class="form-select"
                                        style="width: 30% !important; border: 1px solid rgba(221, 221, 221, 0.4) !important; box-shadow: 0 0 10px rgba(255, 255, 255, 0.1) !important;">
                                        <option value="+1" selected>+1</option>
                                        <option value="+880">+880</option>
                                        <option value="+855">+855</option>
                                    </select>
                                    <input id="number" name="phone" type="text" class="form--control radius-10"
                                        placeholder="{{ __('Phone Number') }}" required
                                        style="width: 70% !important; border-radius: 0px;">
                                </div>
                                <small id="login_phone_error" class="text-danger"></small>
                            </div>
                            <div class="email-input" style="display: none;">
                                <label class="label-title mb-2"> {{ __('Email') }} </label>
                                <input class="form--control" type="email" name="email" id="login_email"
                                    placeholder="{{ __('Type Email') }}" required>
                                <small id="login_email_error" class="text-danger"></small>
                            </div>
                            <div class="toggle-input-type mb-3 text-end">
                                <button type="button" id="togglePhoneEmail"
                                    style="background: transparent; border: none; text-decoration: underline;">
                                    {{ __('Use Email') }}
                                </button>
                            </div>
                        </div>
                        <!-- Password Input with Toggle Eye -->
                        <div class="single-input">
                            <label class="label-title mb-2"> {{ __('Password') }} </label>
                            <div class="position-relative">
                                <input class="form--control" type="password" id="login_password" name="password"
                                    placeholder="{{ __('Type Password') }}">
                                <div class="toggle-password position-absolute"
                                    style="right: 10px; top: 45%; transform: translateY(-50%); cursor: pointer;">
                                    <span class="hide-icon" style="display: inline;"> <i class="las la-eye-slash"></i>
                                    </span>
                                    <span class="show-icon" style="display: none;"> <i class="las la-eye"></i> </span>
                                </div>
                            </div>
                            <small id="login_password_error" class="text-danger"></small>
                        </div>

                        <div class="dashboard-btn-wrapper">
                            <button type="submit" id="login_btn" class="btn-submit dashboard-bg w-100">
                                {{ __('Sign In') }}
                            </button>
                        </div>
                    </form>
                    <div class="single-checbox mt-3">
                        <div class="checkbox-inlines">
                            <input class="check-input" type="checkbox" id="login_remember" name="remember">
                            <label class="checkbox-label" for="login_remember"> {{ __('Remember Me') }} </label>
                        </div>
                        <div class="forgot-password">
                            <a href="{{ route('user.forget.password') }}" class="forgot-btn color-one">
                                {{ __('Forgot Password?') }} </a>
                        </div>
                    </div>
                    <div class="dashboard-bottom-contents">
                        <div class="account-bottom">
                            <span class="account-title mt-3"> {{ __("Don't have an account?") }} </span>
                            <a href="{{ route('vendor.register') }}" class="signup-login mt-3">
                                {{ __('Sign Up') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                    let isEmail = $('.email-input').is(':visible');
                    let phone = $('#number').val();
                    let email = $('#login_email').val();
                    let password = $('#login_password').val();
                    let remember = $('#login_remember').is(':checked');
                    let countryCode = $('#phone_country_code').val();

                    let loginInput = isEmail ? email : (countryCode + phone);

                    el.text('{{ __('Please Wait') }}');

                    $.ajax({
                        type: 'post',
                        url: "{{ route('vendor.login') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            [isEmail ? 'phone' : 'phone']: loginInput,
                            password: password,
                            remember: remember,
                        },
                        success: function(data) {
                            if (data.status === 'invalid') {
                                el.text('{{ __('Sign In') }}');
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
                            let response = data.responseJSON.errors || {};
                            formContainer.find('.error-wrap').html(
                                '<ul class="alert alert-danger"></ul>');
                            $.each(response, function(key, errors) {
                                formContainer.find('.error-wrap ul').append('<li>' +
                                    capitalizeFirstLetter(errors[0]) + '</li>');
                            });
                            el.text('{{ __('Sign In') }}');
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
        // Toggle Password Visibility
        const passwordInput = document.getElementById('login_password');
        const showIcon = document.querySelector('.show-icon');
        const hideIcon = document.querySelector('.hide-icon');

        showIcon.addEventListener('click', function() {
            passwordInput.type = 'text';
            showIcon.style.display = 'none';
            hideIcon.style.display = 'inline';
        });

        hideIcon.addEventListener('click', function() {
            passwordInput.type = 'password';
            showIcon.style.display = 'inline';
            hideIcon.style.display = 'none';
        });

        // Toggle Phone/Email
        document.getElementById('togglePhoneEmail').addEventListener('click', function() {
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
    </script>
@endsection
