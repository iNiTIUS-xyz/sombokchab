@extends('backend.admin-master')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/common/css/delivery_man.css') }}" />
@endsection

@section('site-title', __('Delivery man edit'))

@section('content')

    <div class="error-wrapper">
        <x-msg.error />
        <x-msg.success />
    </div>

    <h2 class="common-title-two"> {{ __('Other delivery Style') }}</h2>

    <form action="{{ route('admin.delivery-man.update', $deliveryMan->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- 2nd delivery design -->
        <div class="dashboard-deliveryWrap mt-4">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h2 class="dashboard__card__title">{{ __('General Information') }}</h2>
                        </div>
                        <div class="dashboard__card__body dashboard-delivery-info mt-4">
                            <div class="custom-form">
                                <div class="dashboard-flex-input">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('First Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="first_name" value="{{ old('first_name') ?? $deliveryMan->first_name }}"
                                            type="text" class="form--control radius-10"
                                            placeholder="{{ __('Enter your first name') }}">
                                    </div>
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Last Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="last_name" value="{{ old('last_name') ?? $deliveryMan->last_name }}"
                                            type="text" class="form--control radius-10"
                                            placeholder="{{ __('Enter your first name') }}">
                                    </div>
                                </div>

                                <div class="dashboard-flex-input mt-4">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Identity Type') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="dashboard-input-select">
                                            <select name="identity_type" class="js_niceSelect">
                                                @foreach ($identityTypes as $key => $identityType)
                                                    <option
                                                        {{ str_replace(' ', '_', strtolower($identityType)) == (old('identity_type') ?? $deliveryMan->credentials?->identity_type) ? 'selected' : '' }}
                                                        value="{{ str_replace(' ', '_', strtolower($identityType)) }}">
                                                        {{ $identityType }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Identity Number') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="identity_number"
                                            value="{{ old('identity_number') ?? $deliveryMan->credentials?->identity_number }}"
                                            type="text" class="form--control radius-10"
                                            placeholder="{{ __('Enter Identity Number') }}">
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
                                                            {!! render_image(
                                                                $deliveryMan->credentials?->identity_image,
                                                                class: 'uploadImageView-view',
                                                                custom_path: \Modules\DeliveryMan\Services\AdminDeliveryManServices::IMAGE_DIRECTORY,
                                                            ) !!}
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
                                                    {{ __('Upload Profile Image') }} <span class="text-danger">*</span>
                                                </h5>
                                                <div class="deliveryMan-uploadImage-wrap uploadedWrapperView mt-4">
                                                    <div class="deliveryMan-uploadImage-flex">
                                                        <div class="deliveryMan-uploadImage-thumb uploadImageView">
                                                            {!! render_image(
                                                                $deliveryMan->profile_img,
                                                                custom_path: \Modules\DeliveryMan\Services\AdminDeliveryManServices::IMAGE_DIRECTORY,
                                                            ) !!}
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
        </div>

        <div class="dashboard-deliveryWrap mt-4">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="single-flex-dashbaord-two dashboard-profile-padding bg-white radius-10">
                        <div class="dashboard-single-profile">
                            <div class="seller-title-flex-contents">
                                <h2 class="dashboard-common-title">{{ __('Delivery Information') }}</h2>
                            </div>
                            <div class="dashboard-delivery-info mt-3">
                                <div class="custom-form">
                                    <div class="dashboard-flex-input mt-4">
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('Delivery man Type') }}
                                                <span class="text-danger">*</span></label>
                                            <div class="dashboard-input-select">
                                                <select name="delivery_man_type" class="js_niceSelect">
                                                    @foreach ($deliveryManTypes as $deliveryManType)
                                                        <option
                                                            {{ str_replace(' ', '_', strtolower($deliveryManType)) == (old('delivery_man_type') ?? $deliveryMan->delivery_man_type) ? 'selected' : '' }}
                                                            value="{{ str_replace(' ', '_', strtolower($deliveryManType)) }}">
                                                            {{ $deliveryManType }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('Delivery Zone') }}
                                                <span class="text-danger">*</span></label>
                                            <div class="dashboard-input-select">
                                                <select name="delivery_zone" class="js_niceSelect">
                                                    @foreach ($zones as $zone)
                                                        <option
                                                            {{ $zone->id == (old('delivery_zone') ?? $deliveryMan->zone_id) ? 'selected' : '' }}
                                                            value="{{ $zone->id }}">{{ $zone->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dashboard-flex-input mt-4">
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('Vehicle Type') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="dashboard-input-select">
                                                <select name="vehicle_type" class="js_niceSelect">
                                                    @foreach ($vehicleTypes as $vehicleType)
                                                        <option
                                                            {{ str_replace(' ', '_', $vehicleType) == (old('vehicle_type') ?? $deliveryMan->credentials?->vehicle_type) ? 'selected' : '' }}
                                                            value="{{ str_replace(' ', '_', $vehicleType) }}">
                                                            {{ $vehicleType }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('License Number') }}
                                                <span class="text-danger">*</span></label>
                                            <input name="driving_license_number"
                                                value="{{ old('driving_license_number') ?? $deliveryMan->credentials->license_number }}"
                                                type="number" class="form--control radius-10"
                                                placeholder="{{ __('Enter driving license') }}">
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
                                                                {!! render_image(
                                                                    $deliveryMan->credentials?->license_image,
                                                                    custom_path: \Modules\DeliveryMan\Services\AdminDeliveryManServices::IMAGE_DIRECTORY,
                                                                ) !!}
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
        <div class="dashboard-deliveryWrap mt-4">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="single-flex-dashbaord-two dashboard-profile-padding bg-white radius-10">
                        <div class="dashboard-single-profile">
                            <div class="seller-title-flex-contents">
                                <h2 class="dashboard-common-title">{{ __('Present Address') }}</h2>
                            </div>

                            @php
                                $presentAddress = $deliveryMan->presentAddress;
                                // if country is selected then load all states
                                $presentAddressStates = \Modules\CountryManage\Entities\State::where('country_id', $presentAddress->country_id)->get();
                                $presentAddressCities = \Modules\CountryManage\Entities\City::where('state_id', $presentAddress->state_id)->get();
                            @endphp

                            <div class="dashboard-delivery-info mt-3">
                                <div class="custom-form">
                                    <div class="dashboard-flex-input mt-4">
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('Country') }}</label>
                                            <select id="country_id" class="form--control" name="present_country_id">
                                                <option value="">{{ __('Select present country') }}</option>
                                                @foreach ($countries as $country)
                                                    <option
                                                        {{ (old('present_country_id') ?? $presentAddress?->country_id) == $country->id ? 'selected' : '' }}
                                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('State') }}</label>
                                            <select id="state_id" class="form--control" name="present_state_id">
                                                <option value="">{{ __('First select country') }}</option>
                                                @foreach ($presentAddressStates as $presentState)
                                                    <option
                                                        {{ (old('present_state_id') ?? $presentAddress?->state_id) == $presentState->id ? 'selected' : '' }}
                                                        value="{{ $presentState->id }}">{{ $presentState->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('City') }}</label>
                                            <select id="city_id" class="form--control" name="present_city_id">
                                                <option value="">{{ __('First select state') }}</option>
                                                @foreach ($presentAddressCities as $presentCity)
                                                    <option
                                                        {{ (old('present_city_id') ?? $presentAddress?->city_id) == $presentCity->id ? 'selected' : '' }}
                                                        value="{{ $presentCity->id }}">{{ $presentCity->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="dashboard-flex-input mt-4">
                                        <div class="dashboard-input">
                                            <label class="dashboard-label color-light mb-2">{{ __('Zip Code') }}</label>
                                            <input value="{{ old('present_zip_code') ?? $presentAddress->zip_code }}"
                                                type="text" name="present_zip_code" class="form--control"
                                                placeholder="{{ __('Write your zip code') }}" />
                                        </div>
                                        <div class="dashboard-input">
                                            <label
                                                class="dashboard-label color-light mb-2">{{ __('Address One') }}</label>
                                            <textarea name="present_address_one" class="form--control">{{ old('present_address_one') ?? $presentAddress->address_one }}</textarea>
                                        </div>
                                        <div class="dashboard-input">
                                            <label
                                                class="dashboard-label color-light mb-2">{{ __('Address Two') }}</label>
                                            <textarea name="present_address_two" class="form--control">{{ old('present_address_two') ?? $presentAddress->address_two }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-deliveryWrap mt-4">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="single-flex-dashbaord-two dashboard-profile-padding bg-white radius-10">
                        <div class="dashboard-single-profile">
                            <div class="seller-title-flex-contents">
                                <h2 class="dashboard-common-title">{{ __('Permanent Address') }}</h2>
                            </div>

                            @php
                                $permanentAddress = $deliveryMan->permanentAddress;
                                // if country is selected then load all states
                                $permanentAddressStates = \Modules\CountryManage\Entities\State::where('country_id', $permanentAddress->country_id)->get();
                                $permanentAddressCities = \Modules\CountryManage\Entities\City::where('state_id', $permanentAddress->state_id)->get();
                            @endphp

                            <div class="dashboard-delivery-info mt-3">
                                <div class="dashboard-flex-input mt-4">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Identity Type') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="dashboard-input-select">
                                            <select name="identity_type" class="js_niceSelect">
                                                @foreach ($identityTypes as $key => $identityType)
                                                    <option
                                                        {{ str_replace(' ', '_', strtolower($identityType)) == (old('identity_type') ?? $deliveryMan->credentials?->identity_type) ? 'selected' : '' }}
                                                        value="{{ str_replace(' ', '_', strtolower($identityType)) }}">
                                                        {{ $identityType }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Identity Number') }}
                                            <span class="text-danger">*</span></label>
                                        <input name="identity_number"
                                            value="{{ old('identity_number') ?? $deliveryMan->credentials?->identity_number }}"
                                            type="text" class="form--control radius-10"
                                            placeholder="{{ __('Enter Identity Number') }}">
                                    </div>
                                </div>
                                <div class="deliveryMan-uploadImage mt-4">
                                    <div class="row g-4">
                                        <div class="col-lg-3">
                                            <div class="deliveryMan-uploadImage-item">
                                                <h5 class="deliveryMan-uploadImage-title">{{ __('Identity Image') }}
                                                    <span class="text-danger">*</span>
                                                </h5>
                                                <div class="deliveryMan-uploadImage-wrap uploadedWrapperView mt-4">
                                                    <div class="deliveryMan-uploadImage-flex">
                                                        <div class="deliveryMan-uploadImage-thumb uploadImageView">
                                                            {!! render_image(
                                                                $deliveryMan->credentials?->identity_image,
                                                                class: 'uploadImageView-view',
                                                                custom_path: \Modules\DeliveryMan\Services\AdminDeliveryManServices::IMAGE_DIRECTORY,
                                                            ) !!}
                                                        </div>
                                                        <div class="deliveryMan-uploadImage-contents">
                                                            <p class="deliveryMan-uploadImage-para">
                                                                {{ __('The picture should be 1:1 ratio') }}</p>
                                                            <div class="deliveryMan-uploadImage-file mt-4">
                                                                <a href="javascript:void(0)"
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
                                                    {{ __('Upload Profile Image') }} <span class="text-danger">*</span>
                                                </h5>
                                                <div class="deliveryMan-uploadImage-wrap uploadedWrapperView mt-4">
                                                    <div class="deliveryMan-uploadImage-flex">
                                                        <div class="deliveryMan-uploadImage-thumb uploadImageView">
                                                            {!! render_image(
                                                                $deliveryMan->profile_img,
                                                                custom_path: \Modules\DeliveryMan\Services\AdminDeliveryManServices::IMAGE_DIRECTORY,
                                                            ) !!}
                                                        </div>
                                                        <div class="deliveryMan-uploadImage-contents">
                                                            <p class="deliveryMan-uploadImage-para">
                                                                {{ __('The picture should be 1:1 ratio') }}</p>
                                                            <div class="deliveryMan-uploadImage-file mt-4">
                                                                <a href="javascript:void(0)"
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
        </div>

        <div class="dashboard-deliveryWrap mt-4">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h2 class="dashboard__card__title">{{ __('Delivery Information') }}</h2>
                        </div>
                        <div class="dashboard__card__body dashboard-delivery-info mt-4">
                            <div class="custom-form">
                                <div class="dashboard-flex-input">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Delivery man Type') }}
                                            <span class="text-danger">*</span></label>
                                        <div class="dashboard-input-select">
                                            <select name="delivery_man_type" class="js_niceSelect">
                                                @foreach ($deliveryManTypes as $deliveryManType)
                                                    <option
                                                        {{ str_replace(' ', '_', strtolower($deliveryManType)) == (old('delivery_man_type') ?? $deliveryMan->delivery_man_type) ? 'selected' : '' }}
                                                        value="{{ str_replace(' ', '_', strtolower($deliveryManType)) }}">
                                                        {{ $deliveryManType }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Delivery Zone') }}
                                            <span class="text-danger">*</span></label>
                                        <div class="dashboard-input-select">
                                            <select name="delivery_zone" class="js_niceSelect">
                                                @foreach ($zones as $zone)
                                                    <option
                                                        {{ $zone->id == (old('delivery_zone') ?? $deliveryMan->zone_id) ? 'selected' : '' }}
                                                        value="{{ $zone->id }}">{{ $zone->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard-flex-input mt-4">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Vehicle Type') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="dashboard-input-select">
                                            <select name="vehicle_type" class="js_niceSelect">
                                                @foreach ($vehicleTypes as $vehicleType)
                                                    <option
                                                        {{ str_replace(' ', '_', $vehicleType) == (old('vehicle_type') ?? $deliveryMan->credentials?->vehicle_type) ? 'selected' : '' }}
                                                        value="{{ str_replace(' ', '_', $vehicleType) }}">
                                                        {{ $vehicleType }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('License Number') }}
                                            <span class="text-danger">*</span></label>
                                        <input name="driving_license_number"
                                            value="{{ old('driving_license_number') ?? $deliveryMan->credentials->license_number }}"
                                            type="number" class="form--control radius-10"
                                            placeholder="{{ __('Enter driving license') }}">
                                    </div>
                                </div>
                                <div class="deliveryMan-uploadImage mt-4">
                                    <div class="row g-4">
                                        <div class="col-lg-4">
                                            <div class="deliveryMan-uploadImage-item">
                                                <h5 class="deliveryMan-uploadImage-title">
                                                    {{ __('Driving License Image') }} <span class="text-danger">*</span>
                                                </h5>
                                                <div class="deliveryMan-uploadImage-wrap uploadedWrapperView mt-4">
                                                    <div class="deliveryMan-uploadImage-flex">
                                                        <div class="deliveryMan-uploadImage-thumb uploadImageView">
                                                            {!! render_image(
                                                                $deliveryMan->credentials?->license_image,
                                                                custom_path: \Modules\DeliveryMan\Services\AdminDeliveryManServices::IMAGE_DIRECTORY,
                                                            ) !!}
                                                        </div>
                                                        <div class="deliveryMan-uploadImage-contents">
                                                            <p class="deliveryMan-uploadImage-para">
                                                                {{ __('The picture should be 1:1 ratio') }}</p>
                                                            <div class="deliveryMan-uploadImage-file mt-4">
                                                                <a href="javascript:void(0)"
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
        <div class="dashboard-deliveryWrap mt-4">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h2 class="dashboard__card__title">{{ __('Present Address') }}</h2>
                            <div class="dashboard__card__header__right">
                                @php
                                    $presentAddress = $deliveryMan->presentAddress;
                                    // if country is selected then load all states
                                    $presentAddressStates = \Modules\CountryManage\Entities\State::where('country_id', $presentAddress->country_id)->get();
                                    $presentAddressCities = \Modules\CountryManage\Entities\City::where('state_id', $presentAddress->state_id)->get();
                                @endphp
                            </div>
                        </div>

                        <div class="dashboard__card__body dashboard-delivery-info mt-4">
                            <div class="custom-form">
                                <div class="dashboard-flex-input mt-4">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Country') }}</label>
                                        <select id="country_id" class="form--control" name="present_country_id">
                                            <option value="">{{ __('Select present country') }}</option>
                                            @foreach ($countries as $country)
                                                <option
                                                    {{ (old('present_country_id') ?? $presentAddress?->country_id) == $country->id ? 'selected' : '' }}
                                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('State') }}</label>
                                        <select id="state_id" class="form--control" name="present_state_id">
                                            <option value="">{{ __('First select country') }}</option>
                                            @foreach ($presentAddressStates as $presentState)
                                                <option
                                                    {{ (old('present_state_id') ?? $presentAddress?->state_id) == $presentState->id ? 'selected' : '' }}
                                                    value="{{ $presentState->id }}">{{ $presentState->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('City') }}</label>
                                        <select id="city_id" class="form--control" name="present_city_id">
                                            <option value="">{{ __('First select state') }}</option>
                                            @foreach ($presentAddressCities as $presentCity)
                                                <option
                                                    {{ (old('present_city_id') ?? $presentAddress?->city_id) == $presentCity->id ? 'selected' : '' }}
                                                    value="{{ $presentCity->id }}">{{ $presentCity->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="dashboard-flex-input mt-4">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Zip Code') }}</label>
                                        <input value="{{ old('present_zip_code') ?? $presentAddress->zip_code }}"
                                            type="text" name="present_zip_code" class="form--control"
                                            placeholder="{{ __('Write your zip code') }}" />
                                    </div>
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Address One') }}</label>
                                        <textarea name="present_address_one" class="form--control">{{ old('present_address_one') ?? $presentAddress->address_one }}</textarea>
                                    </div>
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Address Two') }}</label>
                                        <textarea name="present_address_two" class="form--control">{{ old('present_address_two') ?? $presentAddress->address_two }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-deliveryWrap mt-4">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h2 class="dashboard__card__title">{{ __('Permanent Address') }}</h2>
                            <div class="dashboard__card__header__right">
                                @php
                                    $permanentAddress = $deliveryMan->permanentAddress;
                                    // if country is selected then load all states
                                    $permanentAddressStates = \Modules\CountryManage\Entities\State::where('country_id', $permanentAddress->country_id)->get();
                                    $permanentAddressCities = \Modules\CountryManage\Entities\City::where('state_id', $permanentAddress->state_id)->get();
                                @endphp
                            </div>
                        </div>
                        <div class="dashboard__card__body dashboard-delivery-info mt-4">
                            <div class="dashboard-flex-input mt-4">
                                <div class="dashboard-input">
                                    <label class="dashboard-label color-light mb-2">{{ __('Country') }}</label>
                                    <select id="permanent_country_id" class="form--control" name="permanent_country_id">
                                        <option value="">{{ __('Select present country') }}</option>
                                        @foreach ($countries as $country)
                                            <option
                                                {{ (old('permanent_country_id') ?? $permanentAddress?->country_id) == $country->id ? 'selected' : '' }}
                                                value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="dashboard-input">
                                    <label class="dashboard-label color-light mb-2">{{ __('State') }}</label>
                                    <select id="permanent_state_id" class="form--control" name="permanent_state_id">
                                        <option value="">{{ __('First select country') }}</option>
                                        @foreach ($permanentAddressStates as $permanentState)
                                            <option
                                                {{ (old('permanent_state_id') ?? $permanentAddress?->state_id) == $permanentState->id ? 'selected' : '' }}
                                                value="{{ $permanentState->id }}">{{ $permanentState->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="dashboard-input">
                                    <label class="dashboard-label color-light mb-2">{{ __('City') }}</label>
                                    <select id="permanent_city_id" class="form--control" name="permanent_city_id">
                                        <option value="">{{ __('First select state') }}</option>
                                        @foreach ($permanentAddressCities as $permanentCity)
                                            <option
                                                {{ (old('permanent_city_id') ?? $permanentAddress?->city_id) == $permanentCity->id ? 'selected' : '' }}
                                                value="{{ $permanentCity->id }}">{{ $permanentCity->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="dashboard-flex-input mt-4">
                                <div class="dashboard-input">
                                    <label class="dashboard-label color-light mb-2">{{ __('Zip Code') }}</label>
                                    <input value="{{ old('permanent_zip_code') ?? $permanentAddress->zip_code }}"
                                        type="text" name="permanent_zip_code" class="form--control"
                                        placeholder="{{ __('Write your zip code') }}" />
                                </div>
                                <div class="dashboard-input">
                                    <label class="dashboard-label color-light mb-2">{{ __('Address One') }}</label>
                                    <textarea name="permanent_address_one" class="form--control">{{ old('permanent_address_one') ?? $permanentAddress->address_one }}</textarea>
                                </div>
                                <div class="dashboard-input">
                                    <label class="dashboard-label color-light mb-2">{{ __('Address Two') }}</label>
                                    <textarea name="permanent_address_two" class="form--control">{{ old('permanent_address_two') ?? $permanentAddress->address_two }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-deliveryWrap mt-4">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h2 class="dashboard__card__title">{{ __('Account Information') }}</h2>
                        </div>
                        <div class="dashboard__card__body dashboard-delivery-info mt-4">
                            <div class="custom-form">
                                <div class="dashboard-flex-input mt-4">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Email') }}</label>
                                        <input value="{{ old('email') ?? $deliveryMan->email }}" name="email"
                                            value="{{ old('email') ?? '' }}" type="text"
                                            class="form--control radius-10" placeholder="{{ __('Enter Email') }}">
                                    </div>
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Phone Number') }}</label>
                                        <input value="{{ old('phone') ?? $deliveryMan->phone }}" name="phone"
                                            value="{{ old('phone') ?? '' }}" type="tel"
                                            class="form--control radius-10"
                                            placeholder="{{ __('Enter Phone Number') }}">
                                    </div>
                                </div>
                                <div class="dashboard-flex-input mt-4">
                                    <div class="dashboard-input">
                                        <label class="dashboard-label color-light mb-2">{{ __('Password') }}</label>
                                        <input name="password" value="{{ old('password') ?? '' }}" type="password"
                                            class="form--control radius-10" placeholder="{{ __('Enter Password') }}">
                                    </div>
                                    <div class="dashboard-input">
                                        <label
                                            class="dashboard-label color-light mb-2">{{ __('Confirm Password') }}</label>
                                        <input name="password_confirmation"
                                            value="{{ old('password_confirmation') ?? '' }}" type="password"
                                            class="form--control radius-10"
                                            placeholder="{{ __('Enter Confirm Password') }}">
                                    </div>
                                </div>

                                <div class="dashboard-btn-wrapper mt-4">
                                    <button type="submit"
                                        class="dashboard-btn btn-bg-dashboard radius-5">{{ __('Submit All') }}</button>
                                </div>
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
                el.parent().parent().find("#permanent_state_id").html(data);
            }, (errors) => prepare_errors(errors))
        });

        // fetch all cities according to selected state
        $(document).on("change", "#permanent_state_id", function() {
            let el = $(this);
            let state_id = el.val();

            // send request for fetching tax class option data
            send_ajax_request("get", '', "{{ route('state.city.info.ajax') }}?id=" + state_id, () => {}, (
                data) => {
                el.parent().parent().find("#permanent_city_id").html(data);
            }, (errors) => prepare_errors(errors))
        });

        // fetch all states according to selected country
        $(document).on("change", "#country_id", function() {
            let el = $(this);
            let country_id = el.val();

            // send request for fetching tax class option data
            send_ajax_request("get", '', "{{ route('country.state.info.ajax') }}?id=" + country_id, () => {}, (
                data) => {
                el.parent().parent().find("#state_id").html(data);
            }, (errors) => prepare_errors(errors))
        });

        // fetch all cities according to selected state
        $(document).on("change", "#state_id", function() {
            let el = $(this);
            let state_id = el.val();

            // send request for fetching tax class option data
            send_ajax_request("get", '', "{{ route('state.city.info.ajax') }}?id=" + state_id, () => {}, (
                data) => {
                el.parent().parent().find("#city_id").html(data);
            }, (errors) => prepare_errors(errors))
        });
    </script>
@endsection
