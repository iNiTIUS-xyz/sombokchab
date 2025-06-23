@extends('layouts.login-screens')

@section('content')
    <style>
        .input-group {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            width: 100%;
        }

        .input-group-append {
            margin-left: -1px;
            display: flex;
        }

        .input-group .form--control {
            position: relative;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0;
            margin-bottom: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .toggle-password {
            height: 50px;
            border: 1px solid #ddd;
            border-left: none;
            background: #fff;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            color: #666;
            cursor: pointer;
            transition: all 0.3s;
        }

        .toggle-password:hover {
            background: #f5f5f5;
        }

        .toggle-password i {
            width: 20px;
            height: 20px;
            display: inline-block;
        }
    </style>
    <div class="login-area">
        <div class="container">
            <div class="login-box-wrapper ptb--100">
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="login-form-header text-center mb-4">
                        <div class="logo-wrapper" style="margin-bottom: 20px;">
                            {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                        </div>
                        <h4 class="main-title center-text fw-500 mt-3">{{ __('Admin Login') }}</h4>
                        <p class="main-para mt-2">{{ __('Hello there, Sign in and start managing your website') }}</p>
                    </div>
                    @include('backend.partials.message')
                    <div class="error-message"></div>
                    <div class="login-form-wrap mt-4">
                        <div class="dashboard-input">
                            <label for="username" class="dashboard-label">{{ __('Email or username') }}</label>
                            <input type="text" class="form--control" id="username" name="username"
                                @if (request()->host() == 'safecart.bytesed.com') value="super_admin" @endif autofocus>
                        </div>
                        <div class="dashboard-input mt-4">
                            <label for="password" class="dashboard-label">{{ __('Password') }}</label>
                            <div class="input-group">
                                <input type="password" class="form--control" id="password" name="password"
                                    @if (request()->host() == 'safecart.bytesed.com') value="12345678" @endif>
                                <div class="input-group-append">
                                    <button class="p-2 toggle-password" type="button">
                                        <i class="la la-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 rmber-area mt-4">
                            <div class="col-6">
                                <div class="dashboard-checkbox">
                                    <input type="checkbox" name="remember" class="check-input" id="remember">
                                    <label class="checkbox-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('admin.forget.password') }}"
                                    class="forgot-password">{{ __('Forgot Password?') }}</a>
                            </div>
                        </div>
                        <div class="dashboard-btn-wrapper mt-4">
                            <button id="form_submit" type="submit"
                                class="btn-submit dashboard-bg w-100">{{ __('Login') }}</button>
                        </div>
                        @if (preg_match('/(xgenious)/', url('/')))
                            <div class="adminlogin-info">
                                <table class="table-default">
                                    <th>{{ __('Username') }}</th>
                                    <th>{{ __('Password') }}</th>
                                    <tbody>
                                        <tr>
                                            <td>super_admin</td>
                                            <td>12345678</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        (function($) {
            "use strict";

            $(document).ready(function($) {
                // Toggle password visibility
                $('.toggle-password').click(function() {
                    var passwordInput = $('#password');
                    var icon = $(this).find('i');

                    if (passwordInput.attr('type') === 'password') {
                        passwordInput.attr('type', 'text');
                        icon.removeClass('la-eye').addClass('la-eye-slash');
                    } else {
                        passwordInput.attr('type', 'password');
                        icon.removeClass('la-eye-slash').addClass('la-eye');
                    }
                });

                $(document).on('click', '#form_submit', function(e) {
                    e.preventDefault();
                    var el = $(this);
                    var erContainer = $(".error-message");
                    erContainer.html('');
                    el.text('{{ __('Please Wait..') }}');
                    $.ajax({
                        url: "{{ route('admin.login') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            username: $('#username').val(),
                            password: $('#password').val(),
                            remember: $('#remember').val(),
                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            erContainer.html('<div class="alert alert-danger"></div>');
                            $.each(errors.errors, function(index, value) {
                                erContainer.find('.alert.alert-danger').append(
                                    '<p>' + value + '</p>');
                            });
                            el.text('{{ __('Login') }}');
                        },
                        success: function(data) {
                            $('.alert.alert-danger').remove();
                            if (data.status == 'ok') {
                                el.text('{{ __('Redirecting') }}..');
                                erContainer.html('<div class="alert alert-' + data.type +
                                    '">' + data.msg + '</div>');
                                location.reload();
                            } else {
                                erContainer.html('<div class="alert alert-' + data.type +
                                    '">' + data.msg + '</div>');
                                el.text('{{ __('Login') }}');
                            }
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endsection
