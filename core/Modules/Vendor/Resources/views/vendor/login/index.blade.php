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
                                <label class="label-title mb-2">
                                    {{ __('Phone Number') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="d-flex">
                                    <select id="phone_country_code" class="form-select"
                                        style="width: 30% !important; border: 1px solid rgba(221, 221, 221, 0.4) !important; box-shadow: 0 0 10px rgba(255, 255, 255, 0.1) !important;">
                                        <option value="+1">+1</option>
                                        <option value="+880">+880</option>
                                        <option value="+855">+855</option>
                                    </select>
                                    <input id="number" name="phone" type="number" class="form--control radius-10"
                                        placeholder="{{ __('Enter Phone Number') }}"
                                        style="width: 70% !important; border-radius: 0px;">
                                </div>
                                <small id="login_phone_error" class="text-danger"></small>
                            </div>

                            <div class="email-input" style="display: none;">
                                <label class="label-title mb-2">
                                    {{ __('Email') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input class="form--control" type="email" name="email" id="login_email"
                                    placeholder="{{ __('Enter Email') }}">
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
                            <label class="label-title mb-2">
                                {{ __('Password') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="position-relative">
                                <input class="form--control" type="password" id="login_password" name="password"
                                    placeholder="{{ __('Enter Password') }}">
                                <div class="toggle-password position-absolute"
                                    style="right: 10px; top: 45%; transform: translateY(-50%); cursor: pointer;">
                                    <span class="hide-icon" style="display: inline;">
                                        <i class="las la-eye-slash"></i>
                                    </span>
                                    <span class="show-icon" style="display: none;">
                                        <i class="las la-eye"></i>
                                    </span>
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
                            <label class="checkbox-label" for="login_remember"> {{ __('Remember me') }} </label>
                        </div>
                        <div class="forgot-password">
                            <a href="{{ route('vendor.forget.password') }}" class="forgot-btn color-one">
                                {{ __('Forgot Password?') }}
                            </a>
                        </div>
                    </div>

                    <div class="dashboard-bottom-contents" style="display: flex; justify-content: center;">
                        <div class="account-bottom">
                            <span class="account-title mt-3"> {{ __('Dont have account') }} </span>
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

                /* ===============================
                    READ COOKIES & PREFILL FORM
                =============================== */
                const rememberedType = getCookie("vendor_remembered_type");
                const rememberedValue = getCookie("vendor_remembered_value");
                const rememberedCode = getCookie("vendor_remembered_code");
                const rememberedMe = getCookie("vendor_remember_me_checked");

                const phoneDiv = $('.phone-input');
                const emailDiv = $('.email-input');
                const phoneInput = $('#number');
                const emailInput = $('#login_email');
                const codeInput = $('#phone_country_code');
                const toggleBtn = $('#togglePhoneEmail');
                const rememberCheckbox = $('#login_remember');

                // Restore "Remember Me" checkbox state
                rememberCheckbox.prop("checked", rememberedMe === "yes");

                // Only restore phone/email if Remember Me was used
                if (rememberedMe === "yes") {

                    if (rememberedType === "email") {
                        phoneDiv.hide();
                        emailDiv.show();
                        toggleBtn.text('{{ __('Use Phone') }}');
                        emailInput.val(rememberedValue);

                    } else if (rememberedType === "phone") {
                        phoneDiv.show();
                        emailDiv.hide();
                        toggleBtn.text('{{ __('Use Email') }}');
                        phoneInput.val(rememberedValue);
                        if (rememberedCode) codeInput.val(rememberedCode);
                    }

                } else {
                    // User did NOT choose remember me → Reset fields
                    phoneInput.val("");
                    emailInput.val("");
                }


                /* ===============================
                    TOGGLE PHONE / EMAIL FIELDS
                =============================== */
                toggleBtn.on("click", function() {
                    if (phoneDiv.is(":visible")) {
                        phoneDiv.hide();
                        emailDiv.show();
                        toggleBtn.text('{{ __('Use Phone') }}');
                    } else {
                        phoneDiv.show();
                        emailDiv.hide();
                        toggleBtn.text('{{ __('Use Email') }}');
                    }
                });






                /* ===============================
                    LOGIN CLICK HANDLER
                =============================== */
                $('#login_btn').on('click', function(e) {
                    e.preventDefault();

                    let form = $('#login_form_order_page');
                    let el = $(this);
                    let isEmail = emailDiv.is(':visible');

                    let phone = $('#number').val();
                    let email = $('#login_email').val();
                    let code = $('#phone_country_code').val();
                    let password = $('#login_password').val();
                    let remember = rememberCheckbox.is(':checked');

                    el.text('{{ __('Please Wait') }}');

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('vendor.login') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            [isEmail ? 'phone' : 'phone']: isEmail ? email : (code + phone),
                            password: password,
                            remember: remember,
                        },
                        success: function(response) {

                            if (response.status === "invalid") {
                                el.text('{{ __('Sign In') }}');
                                form.find('.error-wrap').html(
                                    `<div class="alert alert-danger">${response.msg}</div>`
                                );
                                return;
                            }

                            // =======================
                            // SAVE COOKIES
                            // =======================
                            if (remember) {

                                if (isEmail) {
                                    setCookie("vendor_remembered_type", "email", 7);
                                    setCookie("vendor_remembered_value", email, 7);
                                    eraseCookie("vendor_remembered_code");

                                } else {
                                    setCookie("vendor_remembered_type", "phone", 7);
                                    setCookie("vendor_remembered_value", phone, 7);
                                    setCookie("vendor_remembered_code", code, 7);
                                }

                                setCookie("vendor_remember_me_checked", "yes", 7);

                            } else {
                                eraseCookie("vendor_remembered_type");
                                eraseCookie("vendor_remembered_value");
                                eraseCookie("vendor_remembered_code");
                                eraseCookie("vendor_remember_me_checked");
                            }

                            form.find('.error-wrap').html('');
                            $(".showLoginRedirect").show().text(response.msg);

                            setTimeout(() => location.reload(), 800);
                        },

                        error: function(xhr) {
                            el.text('{{ __('Sign In') }}');

                            let res = xhr.responseJSON;
                            let html = '<div class="alert alert-danger"><ul>';

                            if (res?.errors) {
                                $.each(res.errors, function(key, msgs) {
                                    html +=
                                        `<li>${capitalizeFirstLetter(msgs[0])}</li>`;
                                });
                            } else if (res?.msg) {
                                html += `<li>${res.msg}</li>`;
                            } else {
                                html += `<li>{{ __('Something went wrong.') }}</li>`;
                            }

                            html += '</ul></div>';
                            form.find('.error-wrap').html(html);
                        }
                    });
                });


                /* ===============================
                    HELPERS
                =============================== */

                function capitalizeFirstLetter(s) {
                    return s.charAt(0).toUpperCase() + s.slice(1);
                }

                function setCookie(name, value, days) {
                    let expires = "";
                    if (days) {
                        const d = new Date();
                        d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
                        expires = "; expires=" + d.toUTCString();
                    }
                    document.cookie = name + "=" + (value || "") + expires + "; path=/";
                }

                function getCookie(name) {
                    const nameEQ = name + "=";
                    const parts = document.cookie.split(";");
                    for (let c of parts) {
                        while (c.charAt(0) === " ") c = c.substring(1);
                        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length);
                    }
                    return null;
                }

                // FIXED DELETE FUNCTION
                function eraseCookie(name) {
                    document.cookie = name + "=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
                }

            });

        })(jQuery);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('login_password');
            const showIcon = document.querySelector('.show-icon');
            const hideIcon = document.querySelector('.hide-icon');
            if (showIcon && hideIcon && passwordInput) {
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
            }
        });
    </script>
@endsection
