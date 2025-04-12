@extends('frontend.frontend-master')
<!-- bootstrap -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap5.min.css') }}">
<!-- animate -->
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
<!-- slick carousel  -->
<link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
<!-- LineAwesome -->
<link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">
<!-- Plugins css -->
<link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
<!-- Main Stylesheet -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('content')
    <div class="breadcrumb-area breadcrumb-padding bg-item-badge">
        <div class="breadcrumb-shapes">
            <img src="{{ asset('assets/img/shop/badge-s1.png') }}" alt="">
            <img src="{{ asset('assets/img/shop/badge-s2.png') }}" alt="">
            <img src="{{ asset('assets/img/shop/badge-s3.png') }}" alt="">
        </div>
        <div class="container container-one">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-contents">
                        <h2 class="breadcrumb-title"> {{ __('Vendor Sign In') }} </h2>
                        {{-- <ul class="breadcrumb-list">
                            <li class="list"> <a href="{{ route('homepage') }}"> {{ __('Home') }} </a> </li>
                            <li class="list"> {{ __('Registration') }} </li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area end -->

    <!-- Vendor Signin area Starts -->
    <section class="vendor-registration-area padding-top-20 padding-bottom-20">
        <div class="container container-one">
            <div class="vendor-signin-wrapper">
                <div class="vendor-signin-wrapper-inner">
                    {{-- <h5 class="welcome-title center-text"> {{ __('Welcome Back!') }} </h5>
                    <h2 class="main-title center-text fw-500 mt-3"> {{ __('Vendor Sign In') }} </h2> --}}
                    <div class="dashboard-form mt-4">
                        <x-error-msg />
                        <x-msg.success />
                        <form data-form-url="{{ route('vendor.login') }}" method="post" id="vendor-login-form">
                            <div class="alert alert-small py-1 alert-success bg-success text-light display-login-alert"
                                style="display: none">{{ __('Success alert') }}</div>
                            @csrf
                            <div class="dashboard-input">
                                <label class="label-title mb-2"> {{ __('Phone Number or Email') }} </label>
                                <input class="form--control" type="text" name="username"
                                    placeholder="{{ __('Type Phone Number with Country Code or Email') }}">
                            </div>

                            <div class="dashboard-input mt-4">
                                <label class="label-title mb-2"> {{ __('Password') }} </label>
                                <input class="form--control" name="password" type="password"
                                    placeholder="{{ __('Type Password') }}">
                                {{-- <div class="toggle-password">
                                    <span class="show-icon"> <i class="las la-eye-slash"></i> </span>
                                    <span class="hide-icon"> <i class="las la-eye"></i> </span>
                                </div> --}}
                            </div>

                            

                            <div class="dashboard-btn-wrapper mt-4">
                                <button type="submit" class="btn-submit dashboard-bg w-100"> {{ __('Sign In') }}
                                </button>
                            </div>

                            <div
                                class="remember-password-flex d-flex flex-wrap justify-content-between align-items-center">
                                <div class="dashboard-checkbox add-money-checkbox mt-3">
                                    <input class="check-input" name="remember" type="checkbox" id="agree">
                                    <label class="checkbox-label" for="agree"> {{ __('Remember Me') }} </label>
                                </div>
                                <a href="{{route("vendor.forget.password.form")}}" class="forgot-password mt-3"> {{ __('Forgot Password?') }} </a>
                            </div>
                        </form>
                    </div>
                    <div class="dashboard-bottom-contents">
                        <div class="account-bottom">
                            <span class="account-title mt-3"> {{ __("Don't have account?") }} </span>
                            <a href="{{ route('vendor.register') }}" class="signup-login mt-3">
                                {{ __('Sign up') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Vendor Signin area end -->

    <!-- jquery -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <!-- jquery Migrate -->
    <script src="{{ asset('assets/js/jquery-migrate.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- bootstrap -->
    <script src="{{ asset('assets/js/bootstrap5.bundle.min.js') }}"></script>
    <!-- Lazy Load Js -->
    <script src="{{ asset('assets/js/jquery.lazy.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <!-- All Plugins js -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <!-- Range Slider -->
    <script src="{{ asset('assets/js/nouislider-8.5.1.min.js') }}"></script>
    <!-- All Plugins two js -->
    <script src="{{ asset('assets/js/plugin-two.js') }}"></script>
    <!-- Nice Scroll -->
    <script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- Javascript Helpers -->
    <script src="{{ asset('assets/js/helpers.js') }}"></script>
    <script>
        $(document).on("submit", "#vendor-login-form", function(e) {
            // make default
            e.preventDefault();




            send_ajax_request('post', new FormData(e.target), '', function() {

            }, function(data) {
                if (data.status == 'ok') {
                    $(".display-login-alert").text("Login success...");
                    $(".display-login-alert").fadeIn();
                    $(".display-login-alert").removeClass("alert-danger").addClass("alert-success");
                    $(".display-login-alert").removeClass("bg-danger").addClass("bg-success");
                    setTimeout(function() {
                        $(".display-login-alert").text("Redirecting....");
                    }, 500);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    $(".display-login-alert").text(data.msg);
                    $(".display-login-alert").removeClass("alert-success").addClass("alert-danger");
                    $(".display-login-alert").removeClass("bg-success").addClass("bg-danger");
                    $(".display-login-alert").fadeIn();
                }
            }, function(errors) {
                prepare_errors(errors)
            });
        });
    </script>

@endsection
