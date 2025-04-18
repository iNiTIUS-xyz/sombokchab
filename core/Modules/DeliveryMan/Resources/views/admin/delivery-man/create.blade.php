@extends('backend.admin-master')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/common/css/delivery_man.css') }}" />
@endsection

@section('site-title', __('Create Delivery man'))

@section('content')

    <form action="{{ route('admin.delivery-man.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- 2nd delivery design -->
        <div class="dashboard-deliveryWrap">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="error-wrapper">
                        <x-msg.error />
                        <x-msg.success />
                    </div>
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h2 class="dashboard__card__title">{{ __('General Information1') }}</h2>
                        </div>
                        <div class="dashboard__card__body custom__form dashboard-delivery-info mt-4">
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('First Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="first_name" value="{{ old('first_name') ?? '' }}" type="text"
                                            class="form--control radius-10" placeholder="{{ __('Enter your first name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Last Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="last_name" value="{{ old('last_name') ?? '' }}" type="text"
                                            class="form--control radius-10" placeholder="{{ __('Enter your first name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Identity Type') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="dashboard-input-select">
                                            <select name="identity_type" class="js_niceSelect">
                                                @foreach ($identityTypes as $key => $identityType)
                                                    <option
                                                        {{ str_replace(' ', '_', $identityType) == (old('identity_type') ?? '') ? 'selected' : '' }}
                                                        value="{{ str_replace(' ', '_', strtolower($identityType)) }}">
                                                        {{ $identityType }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Identity Number') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="identity_number" value="{{ old('identity_number') ?? '' }}"
                                            type="text" class="form--control radius-10"
                                            placeholder="{{ __('Enter Identity Number') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="deliveryMan-uploadImage mt-4">
                                <div class="row g-4">
                                    <div class="col-lg-3">
                                        <div class="deliveryMan-uploadImage-item">
                                            <h5 class="deliveryMan-uploadImage-title">{{ __('Identity Image') }} <span
                                                    class="text-danger">*</span></h5>
                                            <div class="deliveryMan-uploadImage-wrap uploadedWrapperView mt-4">
                                                <div class="deliveryMan-uploadImage-flex">
                                                    <div class="deliveryMan-uploadImage-thumb uploadImageView">
                                                        <img class="uploadImageView-view"
                                                            src="{{ asset('assets/img/delivery-man/profile_hide.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="deliveryMan-uploadImage-contents">
                                                        <p class="deliveryMan-uploadImage-para">
                                                            {{ __('The picture should be 1:1 ratio') }}</p>
                                                        <div class="deliveryMan-uploadImage-file mt-4">
                                                            <a href="#1"
                                                                class="deliveryMan-uploadImage-file-btn radius-5">
                                                                <input name="identity_image" type="file"
                                                                    class="inputTagView" style="opacity: 0;">
                                                                {{ __('Choose File') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="deliveryMan-uploadImage-item">
                                            <h5 class="deliveryMan-uploadImage-title">
                                                {{ __('Upload Profile Image') }}
                                            </h5>
                                            <div class="deliveryMan-uploadImage-wrap uploadedWrapperView mt-4">
                                                <div class="deliveryMan-uploadImage-flex">
                                                    <div class="deliveryMan-uploadImage-thumb uploadImageView">
                                                        <img class="uploadImageView-view"
                                                            src="{{ asset('assets/img/delivery-man/profile_hide.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="deliveryMan-uploadImage-contents">
                                                        <p class="deliveryMan-uploadImage-para">
                                                            {{ __('The picture should be 1:1 ratio') }}</p>
                                                        <div class="deliveryMan-uploadImage-file mt-4">
                                                            <a href="#1"
                                                                class="deliveryMan-uploadImage-file-btn radius-5">
                                                                <input name="profile_image" type="file"
                                                                    class="inputTagView" style="opacity: 0;">
                                                                {{ __('Choose File') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-deliveryWrap">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="dashboard__card">
                        <div class="dashboard-single-profile">
                            <div class="dashboard__card__header">
                                <h2 class="dashboard__card__title">{{ __('Delivery Information') }}</h2>
                            </div>
                            <div class="dashboard__card__body custom__form dashboard-delivery-info mt-4">
                                <div class="custom-form">
                                    <div class="row g-4">
                                        <div class="col-sm-6">
                                            <div class="dashboard-input">
                                                <label
                                                    class="dashboard-label color-light mb-2">{{ __('Delivery man Type') }}
                                                    <span class="text-danger">*</span></label>
                                                <div class="dashboard-input-select">
                                                    <select name="delivery_man_type" class="js_niceSelect">
                                                        @foreach ($deliveryManTypes as $deliveryManType)
                                                            <option
                                                                {{ str_replace(' ', '_', strtolower($deliveryManType)) == (old('delivery_man_type') ?? '') ? 'selected' : '' }}
                                                                value="{{ str_replace(' ', '_', strtolower($deliveryManType)) }}">
                                                                {{ $deliveryManType }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="dashboard-input">
                                                <label class="dashboard-label color-light mb-2">{{ __('Delivery Zone') }}
                                                    <span class="text-danger">*</span></label>
                                                <div class="dashboard-input-select">
                                                    <select name="delivery_zone" class="js_niceSelect">
                                                        @foreach ($zones as $zone)
                                                            <option
                                                                {{ $zone->id == (old('delivery_zone') ?? '') ? 'selected' : '' }}
                                                                value="{{ $zone->id }}">{{ $zone->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="dashboard-input">
                                                <label class="dashboard-label color-light mb-2">{{ __('Vehicle Type') }}
                                                    <span class="text-danger">*</span></label>
                                                <div class="dashboard-input-select">
                                                    <select name="vehicle_type" class="js_niceSelect">
                                                        @foreach ($vehicleTypes as $vehicleType)
                                                            <option
                                                                {{ str_replace(' ', '_', $vehicleType) == (old('vehicle_type') ?? '') ? 'selected' : '' }}
                                                                value="{{ str_replace(' ', '_', $vehicleType) }}">
                                                                {{ $vehicleType }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="dashboard-input">
                                                <label class="dashboard-label color-light mb-2">{{ __('License Number') }}
                                                    <span class="text-danger">*</span></label>
                                                <input name="driving_license_number"
                                                    value="{{ old('driving_license_number') ?? '' }}" type="number"
                                                    class="form--control radius-10"
                                                    placeholder="{{ __('Enter driving license') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="deliveryMan-uploadImage mt-4">
                                        <div class="row g-4">
                                            <div class="col-lg-4">
                                                <div class="deliveryMan-uploadImage-item">
                                                    <h5 class="deliveryMan-uploadImage-title">
                                                        {{ __('Driving License Image') }} <span
                                                            class="text-danger">*</span></h5>
                                                    <div class="deliveryMan-uploadImage-wrap uploadedWrapperView mt-4">
                                                        <div class="deliveryMan-uploadImage-flex">
                                                            <div class="deliveryMan-uploadImage-thumb uploadImageView">
                                                                <img class="uploadImageView-view"
                                                                    src="{{ asset('assets/img/delivery-man/profile_hide.jpg') }}"
                                                                    alt="">
                                                            </div>
                                                            <div class="deliveryMan-uploadImage-contents">
                                                                <p class="deliveryMan-uploadImage-para">
                                                                    {{ __('The picture should be 1:1 ratio') }}</p>
                                                                <div class="deliveryMan-uploadImage-file mt-4">
                                                                    <a href="#1"
                                                                        class="deliveryMan-uploadImage-file-btn radius-5">
                                                                        <input name="driving_license_image" type="file"
                                                                            class="inputTagView" style="opacity: 0;" />
                                                                        {{ __('Choose File') }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-deliveryWrap">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="dashboard__card">
                        <div class="dashboard-single-profile">
                            <div class="dashboard__card__header">
                                <h2 class="dashboard__card__title">{{ __('Present Address') }}</h2>
                            </div>
                            <div class="dashboard__card__body custom__form dashboard-delivery-info mt-4">
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('Country') }}</label>
                                            <select id="country_id" class="form--control" name="present_country_id">
                                                <option value="">{{ __('Select present country') }}</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('City') }}</label>
                                            <select id="state_id" class="form--control" name="present_state_id">
                                                <option value="">{{ __('Select One') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('State') }}</label>
                                            <select id="city_id" class="form--control" name="present_city_id">
                                                <option value="">{{ __('Select One') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('Zip Code') }}</label>
                                            <input type="text" name="present_zip_code" class="form--control"
                                                placeholder="{{ __('Write your zip code') }}" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dashboard-input">
                                            <label
                                                class="dashboard-label color-light mb-2">{{ __('Address One') }}</label>
                                            <textarea name="present_address_one" class="form--control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dashboard-input">
                                            <label
                                                class="dashboard-label color-light mb-2">{{ __('Address Two') }}</label>
                                            <textarea name="present_address_two" class="form--control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-deliveryWrap">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="dashboard__card">
                        <div class="dashboard-single-profile">
                            <div class="dashboard__card__header">
                                <h2 class="dashboard__card__title">{{ __('Permanent Address') }}</h2>
                            </div>
                            <div class="dashboard__card__body custom__form dashboard-delivery-info mt-4">
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('Country') }}</label>
                                            <select id="permanent_country_id" class="form--control"
                                                name="permanent_country_id">
                                                <option value="">{{ __('Select present country') }}</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('City') }}</label>
                                            <select id="permanent_state_id" class="form--control"
                                                name="permanent_state_id">
                                                <option value="">{{ __('Select One') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('State') }}</label>
                                            <select id="permanent_city_id" class="form--control"
                                                name="permanent_city_id">
                                                <option value="">{{ __('Select One') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('Zip Code') }}</label>
                                            <input type="text" name="permanent_zip_code" class="form--control"
                                                placeholder="{{ __('Write your zip code') }}" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dashboard-input">
                                            <label
                                                class="dashboard-label color-light mb-2">{{ __('Address One') }}</label>
                                            <textarea name="permanent_address_one" class="form--control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dashboard-input">
                                            <label
                                                class="dashboard-label color-light mb-2">{{ __('Address Two') }}</label>
                                            <textarea name="permanent_address_two" class="form--control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-deliveryWrap">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h2 class="dashboard__card__title">{{ __('Account Information') }}</h2>
                        </div>
                        <div class="dashboard__card__body custom__form dashboard-delivery-info mt-4">
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Email Address') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="email" value="{{ old('email') ?? '' }}" type="text"
                                            class="form--control radius-10" placeholder="{{ __('Enter your email') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Phone Number') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="phone" value="{{ old('phone') ?? '' }}" type="tel"
                                            class="form--control radius-10" placeholder="{{ __('Enter Phone Number') }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Password') }}</label>
                                        <input name="password" value="{{ old('password') ?? '' }}" type="password"
                                            class="form--control radius-10" placeholder="{{ __('Enter Password') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="dashboard-input">
                                        <label
                                            class="dashboard-label color-light mb-2">{{ __('Confirm Password') }}</label>
                                        <input name="password_confirmation"
                                            value="{{ old('password_confirmation') ?? '' }}" type="password"
                                            class="form--control radius-10"
                                            placeholder="{{ __('Enter Confirm Password') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-btn-wrapper mt-4">
                                <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Submit All') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        // fetch all states according to selected country
        $(document).on("change", "#permanent_country_id", function() {
            let el = $(this);
            let country_id = el.val();

            // send request for fetching tax class option data
            send_ajax_request("get", '', "{{ route('country.state.info.ajax') }}?id=" + country_id, () => {}, (
                data) => {
                $("#permanent_state_id").html(data);
            }, (errors) => prepare_errors(errors))
        });

        // fetch all cities according to selected state
        $(document).on("change", "#permanent_state_id", function() {
            let el = $(this);
            let state_id = el.val();

            // send request for fetching tax class option data
            send_ajax_request("get", '', "{{ route('state.city.info.ajax') }}?id=" + state_id, () => {}, (
                data) => {
                $("#permanent_city_id").html(data);
            }, (errors) => prepare_errors(errors))
        });

        // fetch all states according to selected country
        $(document).on("change", "#country_id", function() {
            let el = $(this);
            let country_id = el.val();

            // send request for fetching tax class option data
            send_ajax_request("get", '', "{{ route('country.state.info.ajax') }}?id=" + country_id, () => {}, (
                data) => {
                $("#state_id").html(data);
            }, (errors) => prepare_errors(errors))
        });

        // fetch all cities according to selected state
        $(document).on("change", "#state_id", function() {
            let el = $(this);
            let state_id = el.val();

            // send request for fetching tax class option data
            send_ajax_request("get", '', "{{ route('state.city.info.ajax') }}?id=" + state_id, () => {}, (
                data) => {
                $("#city_id").html(data);
            }, (errors) => prepare_errors(errors))
        });
    </script>
@endsection
