@extends('frontend.user.dashboard.user-master')
@section('style')
    <x-media.css />
    <x-niceselect.css />
@endsection
@section('section')
    @php

        $states = \Modules\CountryManage\Entities\State::where('country_id', 31)->get();
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
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user_details->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">{{ __('Username') }}</label>
                            <input type="text" class="form-control" value="{{ $user_details->username }}" readonly
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="{{ $user_details->email }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">{{ __('Phone') }}</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                value="{{ $user_details->phone }}">
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
                            <select id="country" class="form-control wide" name="country">
                                @foreach ($all_countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ $user_details->country == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
        
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="state">{{ __('City') }}</label>
        
                            <select class="form-control" id="state" name="state">
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
                            <label for="zipcode">{{ __('Postal Code') }}</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode"
                                value="{{ $user_details->zipcode }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">{{ __('Address') }}</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $user_details->address }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <x-media-upload :title="__('Profile image')" name="image" :oldimage="$user_details->image" />
                            <small>{{ __('Recommended image size 150x150') }}</small>
                        </div>
                    </div>
                </div>
                
                

                
                
                {{-- <div class="form-group">
                    <label for="city">{{ __('City') }}</label>

                    <select class="form-control" id="city" name="city">
                        <option value="">{{ __('Select City') }}</option>
                        @php
                            $cities = \Modules\CountryManage\Entities\City::where("state_id", $user_details->state ?? 0)->get();
                        @endphp

                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ $user_details->city == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
                
                
                

                <div class="btn-wrapper mt-4">
                    <button type="submit" class="cmn_btn btn_bg_2">{{ __('Save Changes') }}</button>
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
                    <label for="password">{{ __('Password') }}</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password"
                        required>
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
        (function($) {
            "use strict";

            $(document).on("change", "#country", function() {
                let id = $(this).val().trim();

                $.get('{{ route('country.state.info.ajax') }}', {
                    id: id
                }).then(function(data) {
                    $('#state').html(data);
                });
            });
            $(document).on("change", "#state", function() {
                let id = $(this).val().trim();

                $.get('{{ route('state.city.info.ajax') }}', {
                    id: id
                }).then(function(data) {
                    $('#city').html(data);
                });
            });

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
    <x-media.js :deleteRoute="route('user.upload.media.file.delete')" :imgAltChangeRoute="route('user.upload.media.file.alt.change')" :allImageLoadRoute="route('user.upload.media.file.all')" type="user">
    </x-media.js>
@endsection
