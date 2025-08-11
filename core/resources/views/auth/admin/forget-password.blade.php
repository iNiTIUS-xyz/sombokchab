@extends('layouts.login-screens')
@section('content')
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('admin.forget.password') }}" style="border-radius: 15px;">
                    @csrf
                    <div class="login-form-head" style="border-radius: 15px 15px 0px 0px;">
                        <h4>{{ __('Reset Password') }}</h4>
                    </div>
                    @include('backend.partials.message')
                    @include('backend.partials.error')
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="username">{{ __('Username or Email') }}</label>
                            <input type="text" id="username" name="username">
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">{{ __('Send Reset Password Link') }} <i
                                    class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
