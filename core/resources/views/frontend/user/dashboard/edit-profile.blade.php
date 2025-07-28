@extends('frontend.user.dashboard.user-master')

@section('style')
    <x-media.css />
    <x-niceselect.css />
@endsection

@section('section')
    @php
        $states = \Modules\CountryManage\Entities\State::where('country_id', 31)->get();
        $cities = \Modules\CountryManage\Entities\City::get();
    @endphp
    <div class="bodyUser_overlay"></div>
    <div class="dashboard-form-wrapper">
        <h2 class="dashboard__card__title">{{ __('Edit Profile') }}</h2>
        <div class="custom__form mt-4">
            <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                {{ __('Full Name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user_details->name }}" placeholder="{{ __('Enter Full Name') }}" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">{{ __('Username') }}</label>
                            <input type="text" name="username" class="form-control" value="{{ $user_details->username }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user_details->email }}" placeholder="{{ __('Enter Email') }}">
                            <span id="email-error" class="text-danger" style="display:none;">Please enter a valid email
                                address.</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">{{ __('Address') }}</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $user_details->address }}" placeholder="{{ __('Enter Postal Code') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="state">
                                {{ __('City') }}
                            </label>
                            <select class="form-select" id="state" name="state">
                                <option value="">
                                    {{ __('Select City') }}
                                </option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ $state->id == $user_details->state ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city">
                                {{ __('Province') }}
                            </label>
                            <select class="form-select" id="city" name="city">
                                <option value="">{{ __('Select Province') }}</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ $user_details->city == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="zipcode">{{ __('Postal Code') }}</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode"
                                value="{{ $user_details->zipcode }}" placeholder="{{ __('Enter Postal Code') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            @php
                                $all_countries = DB::table('countries')
                                    ->select('id', 'name')
                                    ->where('status', 'publish')
                                    ->get();
                            @endphp

                            <label for="country">{{ __('Country') }}</label>
                            <select id="country" class="form-select wide" name="country">
                                @foreach ($all_countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ $user_details->country == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-media-upload :title="__('Profile image')" name="image" :oldimage="$user_details->image" />
                            <small>{{ __('Recommended image size 150x150') }}</small>
                        </div>
                    </div>
                </div>
                <div class="btn-wrapper mt-4">
                    <button type="submit" class="cmn_btn btn_bg_1 btn-success">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="dashboard-form-wrapper" style="margin-top: 20px">
        <h2 class="dashboard__card__title">{{ __('Chgange Phone Number') }}</h2>
        <div class="custom__form mt-4">
            <form action="{{ route('user.chnage.phone') }}" method="post">
                @csrf
                <div class="phone-input mb-4">
                    <label class="label-title mb-2">
                        {{ __('Phone Number') }}
                    </label>
                    <div class="d-flex">
                        <select id="country_code" name="country_code" class="form-select"
                            style="width: 15% !important; border: 1px solid rgba(221, 221, 221, 0.4) !important; box-shadow: 0 0 10px rgba(255, 255, 255, 0.1) !important;">
                            <option value="+1">+1</option>
                            <option value="+880">+880</option>
                            <option value="+855">+855</option>
                        </select>
                        <input id="phone" name="phone" type="number" class="form--control radius-10"
                            placeholder="{{ __('Phone Number') }}" required
                            style="width: 70% !important; border-radius: 0px;">
                        <button type="button" onclick="sendOtpCode()" class="btn btn-success" style="width: 15% !important; color: #000; background-color: rgba(221, 221, 221, 0.4); border: 1px solid rgba(221, 221, 221, 0.4) !important; box-shadow: 0 0 10px rgba(255, 255, 255, 0.1) !important;">
                            Send Code
                        </button>
                    </div>
                    <p id="showMessage"></p>
                </div>
                <div class="form-group mb-3">
                    <label for="password">
                        {{ __('Otp Code') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="otp_code" placeholder="{{ __('Enter OTP code') }}" required>
                </div>
                <div class="btn-wrapper mt-2">
                    <button type="submit" class="btn btn-success">
                        {{ __('Chnage Phone Number') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="dashboard-form-wrapper" style="margin-top: 20px">
        <h2 class="dashboard__card__title">{{ __('Deactivate Account') }}</h2>
        <div class="custom__form mt-4">
            <form action="{{ route('user.deactivate') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="password">
                        {{ __('Password') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="{{ __('Enter Password') }}" required>
                </div>
                <div class="btn-wrapper mt-2">
                    <button type="submit" class="cmn_btn btn_bg_4">{{ __('Deactivate Account') }}</button>
                </div>
            </form>
        </div>
    </div>

    <x-media.markup :userUpload="true" type="user" :imageUploadRoute="route('user.upload.media.file')" />
@endsection

@section('script')
    <x-niceselect.js />

    <script>
        function sendOtpCode() {
            var countryCode = $("#country_code").val();
            var phoneNumber = $("#phone").val();
            var fullNumber = countryCode + phoneNumber;

            if (!phoneNumber) {
                alert("Please enter a valid phone number.");
                return;
            }

            $.ajax({
                url: "{{ route('user.send.opt.code') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    phone: fullNumber
                },
                beforeSend: function () {
                    $("button[onclick='sendOtpCode()']").text("Sending...");
                },
                success: function (response) {

                    $("#showMessage").text(`
                        <span class="text-success"> OTP Code has been sent successfully! Please check you inbox.</span>
                    `);
                },
                error: function (xhr) {
                    $("#showMessage").text(`
                        <span class="text-danger">Failed to send OTP. Please try again.</span>
                    `);
                },
                complete: function () {
                    $("button[onclick='sendOtpCode()']").text("Send Code");
                }
            });
        }
    </script>


    <script>
        (function($) {
            "use strict";

            // $(document).on("change", "#country", function() {
            //     let id = $(this).val().trim();

            //     $.get('{{ route('country.state.info.ajax') }}', {
            //         id: id
            //     }).then(function(data) {
            //         $('#state').html(data);
            //     });
            // });
            // $(document).on("change", "#state", function() {
            //     let id = $(this).val().trim();

            //     $.get('{{ route('state.city.info.ajax') }}', {
            //         id: id
            //     }).then(function(data) {
            //         $('#city').html(data);
            //     });
            // });

            $(document).ready(function() {
                $(document).on('click', '.bodyUser_overlay', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });
                $(document).on('click', '.mobile_nav', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });

                if ($('.nice-select').length) {
                    $('.nice-select').niceSelect();
                }
            });
        })(jQuery);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const emailInput = document.getElementById('email');
            const errorSpan = document.getElementById('email-error');

            emailInput.addEventListener('blur', function() {
                const email = emailInput.value.trim();
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailPattern.test(email)) {
                    errorSpan.style.display = 'block';
                    emailInput.classList.add('is-invalid');
                } else {
                    errorSpan.style.display = 'none';
                    emailInput.classList.remove('is-invalid');
                }
            });
        });
    </script>

    <x-media.js :deleteRoute="route('user.upload.media.file.delete')" :imgAltChangeRoute="route('user.upload.media.file.alt.change')" :allImageLoadRoute="route('user.upload.media.file.all')" type="user">
    </x-media.js>
@endsection
