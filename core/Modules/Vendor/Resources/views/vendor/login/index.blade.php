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
                        id="login_form_order_page">
                        @csrf
                        <div class="error-wrap"></div>
                        <div class="alert alert-success showLoginRedirect" style="display: none;"></div>

                        <div class="single-input">
                            <div class="phone-input">
                                <label class="label-title mb-2"> {{ __('Phone Number') }} </label>
                                <div class="d-flex">
                                    <select id="phone_country_code" class="form-select" style="width: 30% !important; border: 1px solid rgba(221, 221, 221, 0.4) !important; box-shadow: 0 0 10px rgba(255, 255, 255, 0.1) !important;">
                                        <option value="+1">+1</option>
                                        <option value="+880">+880</option>
                                        <option value="+855">+855</option>
                                    </select>
                                    <input id="number" name="phone" type="number" class="form--control radius-10"
                                        placeholder="{{ __('Phone Number') }}"
                                        style="width: 70% !important; border-radius: 0px;">
                                </div>
                                <small id="login_phone_error" class="text-danger"></small>
                            </div>

                            <div class="email-input" style="display: none;">
                                <label class="label-title mb-2"> {{ __('Email') }} </label>
                                <input class="form--control" type="email" name="email" id="login_email"
                                    placeholder="{{ __('Type Email') }}">
                                <small id="login_email_error" class="text-danger"></small>
                            </div>

                            <div class="toggle-input-type mb-3 text-end">
                                <button type="button" id="togglePhoneEmail"
                                    style="background: transparent; border: none; text-decoration: underline;">
                                    {{ __('Use Email') }}
                                </button>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="single-input">
                            <label class="label-title mb-2"> {{ __('Password') }} </label>
                            <div class="position-relative">
                                <input class="form--control" type="password" id="login_password" name="password"
                                    placeholder="{{ __('Type Password') }}">
                                <div class="toggle-password position-absolute"
                                    style="right: 10px; top: 45%; transform: translateY(-50%); cursor: pointer;">
                                    <span class="hide-icon" style="display: inline;"> <i
                                            class="las la-eye-slash"></i></span>
                                    <span class="show-icon" style="display: none;"> <i class="las la-eye"></i></span>
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
                            <input class="check-input" type="checkbox" id="login_remember" name="remember" checked>
                            <label class="checkbox-label" for="login_remember"> {{ __('Remember Me') }} </label>
                        </div>
                        <div class="forgot-password">
                            <a href="{{ route('vendor.forget.password') }}" class="forgot-btn color-one">
                                {{ __('Forgot Password?') }}
                            </a>
                        </div>
                    </div>

                    <div class="dashboard-bottom-contents" style="display: flex; justify-content: center;">
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
    <script src="{{ asset('assets/common/js/toastr.min.js') }}"></script>

    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {

                // Prefill form if cookies exist
                const rememberedType = getCookie("remembered_type");
                const rememberedValue = getCookie("remembered_value");
                const rememberedCode = getCookie("remembered_code");

                if (rememberedType === "email") {
                    $('.phone-input').hide();
                    $('.email-input').show();
                    $('#togglePhoneEmail').text('{{ __('Use Phone') }}');
                    $('#login_email').val(rememberedValue);
                } else if (rememberedType === "phone") {
                    $('.phone-input').show();
                    $('.email-input').hide();
                    $('#togglePhoneEmail').text('{{ __('Use Email') }}');
                    $('#number').val(rememberedValue);
                    $('#phone_country_code').val(rememberedCode);
                }

                // Toggle between phone and email input
                $('#togglePhoneEmail').on('click', function() {
                    if ($('.phone-input').is(':visible')) {
                        $('.phone-input').hide();
                        $('.email-input').show();
                        $(this).text('{{ __('Use Phone') }}');
                    } else {
                        $('.phone-input').show();
                        $('.email-input').hide();
                        $(this).text('{{ __('Use Email') }}');
                    }
                });

                $('.toggle-password').on('click', function() {
                    const input = $('#login_password');
                    const hideIcon = $(this).find('.hide-icon');
                    const showIcon = $(this).find('.show-icon');

                    if (input.attr('type') === 'password') {
                        input.attr('type', 'text');
                        hideIcon.hide();
                        showIcon.show();
                    } else {
                        input.attr('type', 'password');
                        showIcon.hide();
                        hideIcon.show();
                    }
                });

                $('.toggle-password').on('click', function() {
                    const input = $('#login_password');
                    const isPassword = input.attr('type') === 'password';
                    input.attr('type', isPassword ? 'text' : 'password');
                    $('.show-icon, .hide-icon').toggle();
                });

                $('#login_btn').on('click', function(e) {
                    e.preventDefault();

                    let form = $('#login_form_order_page');
                    let el = $(this);
                    let isEmail = $('.email-input').is(':visible');
                    let email = $('#login_email').val();
                    let phone = $('#number').val();
                    let code = $('#phone_country_code').val();
                    let password = $('#login_password').val();
                    let remember = $('#login_remember').is(':checked');

                    el.text('{{ __('Please Wait') }}');

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('vendor.login') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            [isEmail ? 'phone' : 'phone']: isEmail ? email : (code + phone),
                            password: password,
                            remember: remember
                        },
                        success: function(response) {
                            if (response.status === 'invalid') {
                                el.text('{{ __('Sign In') }}');
                                form.find('.error-wrap').html(
                                    `<div class="alert alert-danger">${response.msg}</div>`
                                );
                            } else {
                                // Save cookies
                                if (remember) {
                                    if (isEmail) {
                                        setCookie("remembered_type", "email", 7);
                                        setCookie("remembered_value", email, 7);
                                        eraseCookie("remembered_code");
                                    } else {
                                        setCookie("remembered_type", "phone", 7);
                                        setCookie("remembered_value", phone, 7);
                                        setCookie("remembered_code", code, 7);
                                    }
                                } else {
                                    eraseCookie("remembered_type");
                                    eraseCookie("remembered_value");
                                    eraseCookie("remembered_code");
                                }

                                form.find('.error-wrap').html('');
                                $(".showLoginRedirect").show().text(response.msg);
                                setTimeout(() => {
                                    location.reload();
                                }, 800);
                            }
                        },
                        error: function(xhr) {
                            el.text('{{ __('Sign In') }}');
                            const res = xhr.responseJSON;
                            let errorHtml = '<div class="alert alert-danger"><ul>';
                            if (res && res.errors) {
                                $.each(res.errors, function(key, messages) {
                                    errorHtml +=
                                        `<li>${capitalizeFirstLetter(messages[0])}</li>`;
                                });
                            } else if (res && res.msg) {
                                errorHtml += `<li>${res.msg}</li>`;
                            } else {
                                errorHtml +=
                                    `<li>{{ __('Something went wrong. Please try again.') }}</li>`;
                            }
                            errorHtml += '</ul></div>';
                            form.find('.error-wrap').html(errorHtml);
                        }
                    });
                });

                function capitalizeFirstLetter(string) {
                    return string.charAt(0).toUpperCase() + string.slice(1);
                }

                function setCookie(name, value, days) {
                    let expires = "";
                    if (days) {
                        const date = new Date();
                        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                        expires = "; expires=" + date.toUTCString();
                    }
                    document.cookie = name + "=" + (value || "") + expires + "; path=/";
                }

                function getCookie(name) {
                    const nameEQ = name + "=";
                    const ca = document.cookie.split(';');
                    for (let i = 0; i < ca.length; i++) {
                        let c = ca[i];
                        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                    }
                    return null;
                }

                function eraseCookie(name) {
                    document.cookie = name + '=; Max-Age=0; path=/;';
                }

            });

        })(jQuery);
    </script>
@endsection
