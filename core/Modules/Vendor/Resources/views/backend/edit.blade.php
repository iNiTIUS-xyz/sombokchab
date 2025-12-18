@extends('backend.admin-master')
@section('site-title')
    {{ __('Vendor Profile Update') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/colorpicker.css') }}">
    <x-media.css />
    <x-bulk-action.css />
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Vendor Profile Update') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <!-- novalidate added -->
                        <form id="vendor-create-form" data-action-url="{{ route('admin.vendor.edit', $vendor->id) }}"
                            novalidate>
                            <div class="toast toast-success"></div>
                            @csrf
                            <input name="id" value="{{ $vendor->id }}" type="hidden" />
                            <div class="dashboard__card__header">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#basic-info" type="button" role="tab"
                                            aria-controls="basic-info" aria-selected="true">{{ __('Basic') }}
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#address" type="button" role="tab" aria-controls="address"
                                            aria-selected="false">{{ __('Address') }}
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#shop-info" type="button" role="tab"
                                            aria-controls="shop-info" aria-selected="false">{{ __('Shop Info') }}
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#bank-info" type="button" role="tab"
                                            aria-controls="bank-info" aria-selected="false">{{ __('Bank Info') }}
                                        </button>
                                    </li>
                                </ul>
                                <div class="submit_button">
                                    <a href="{{ route('admin.vendor.all') }}" class="cmn_btn default-theme-btn"
                                        style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                        {{ __('Back') }}
                                    </a>
                                    <button type="submit" class="cmn_btn btn_bg_profile">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="basic-info" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-6">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title">
                                                        {{ __('Basic Info') }}
                                                        <span class="text-danger">*</span>
                                                    </h4>
                                                    @if ($vendor->is_vendor_verified && $vendor->verified_at)
                                                        <p class="text-success">
                                                            The vendor is verified
                                                        </p>
                                                    @else
                                                        <p class="text-warning">
                                                            The vendor is not verified.
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="dashboard__card__body custom__form mt-4 single-reg-form">

                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Vendor Name') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input name="owner_name" type="text"
                                                            placeholder="{{ __('Enter vendor name') }}"
                                                            class="form--control radius-10" maxlength="30"
                                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                                            value="{{ $vendor->owner_name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Business Name') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input name="business_name" type="text" maxlength="30"
                                                            class="form--control radius-10"
                                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                                            placeholder="{{ __('Enter business name') }}"
                                                            value="{{ $vendor->business_name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Username') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input id="username" name="username" type="text"
                                                            maxlength="25" placeholder="{{ __('Enter username') }}"
                                                            class="form--control radius-10"
                                                            value="{{ $vendor->username }}" required>
                                                        <small id="username_error" class="text-muted"></small>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Email') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input id="email" name="email" type="email"
                                                            placeholder="{{ __('Enter email') }}"
                                                            class="form--control radius-10" value="{{ $vendor->email }}"
                                                            required>
                                                        <small id="email_error" class="text-muted"></small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Business Category') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="nice-select-two">
                                                            <select id="business_type" name="business_type_id"
                                                                style="display: none;">
                                                                @foreach ($business_type as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $item->id == $vendor->business_type_id ? 'selected' : '' }}>
                                                                        {{ $item->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" id="taxIdWrapper" style="display: none;">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Tax ID') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input id="tax_id" name="tax_id" type="text"
                                                            maxlength="13" class="form--control radius-10"
                                                            placeholder="{{ __('Enter Tax ID') }}"
                                                            data-original="{{ old('tax_id', $vendor?->tax_id ?? '') }}"
                                                            value="{{ old('tax_id', $vendor?->tax_id ?? '') }}"
                                                            aria-describedby="tax_id_error"
                                                            oninput="this.value = this.value.toUpperCase();" />
                                                        <small id="tax_id_error" class="text-muted"></small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Description') }}
                                                        </label>
                                                        <textarea name="description" class="form--control form--message radius-10" style="height: 100px"
                                                            placeholder="{{ __('Enter description') }}">{{ $vendor->description }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Is Verified') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="is_vendor_verified" class="form--control">
                                                            <option value="1"
                                                                @if ($vendor->is_vendor_verified == 1) selected @endif>
                                                                Yes
                                                            </option>
                                                            <option value="0"
                                                                @if ($vendor->is_vendor_verified == 0) selected @endif>
                                                                No
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <x-media.media-upload :old-image="$vendor?->vendor_shop_info?->logo" :title="__('Logo')" :name="'logo_id'"
                                                :dimentions="'200x200'" />
                                            <x-media.media-upload :old-image="$vendor?->vendor_shop_info?->cover_photo" :title="__('Cover Photo')" :name="'cover_photo_id'"
                                                :dimentions="'200x200'" />
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <h4 class="dashboard__card__title"> {{ __('Address') }} </h4>
                                                <div class="dashboard__card__body custom__form mt-4 single-reg-form">

                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Country') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="nice-select-two country_wrapper">
                                                            <select class="form-control" id="country_id"
                                                                name="country_id" required>
                                                                <option value="">
                                                                    {{ __('Select Country') }}
                                                                </option>
                                                                @foreach ($country as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $vendor?->vendor_address?->country_id == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('City') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="nice-select-two city_wrapper">
                                                            <select id="city_id" name="city_id" class="form-control"
                                                                required>
                                                                <option value="" disabled>
                                                                    {{ __('Select City') }}
                                                                </option>
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->id }}"
                                                                        {{ $vendor?->vendor_address?->city_id == $city->id ? 'selected' : '' }}>
                                                                        {{ $city->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Province') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="nice-select-two state_wrapper">
                                                            <select class="form-control" id="state_id" name="state_id"
                                                                required>
                                                                <option value="" disabled>
                                                                    {{ __('Select Province') }}
                                                                </option>
                                                                @foreach ($states as $state)
                                                                    <option value="{{ $state->id }}"
                                                                        {{ $vendor?->vendor_address?->state_id == $state->id ? 'selected' : '' }}>
                                                                        {{ $state->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Postal Code') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="zip_code"
                                                            class="form--control radius-10" maxlength="5"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                            value="{{ $vendor?->vendor_address?->zip_code }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Address') }}
                                                        </label>
                                                        <textarea name="address" type="text" placeholder="{{ __('Enter address') }}" class="form--control radius-10">{{ $vendor?->vendor_address?->address }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="shop-info" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <h4 class="dashboard__card__title">
                                                    {{ __('Shop Info') }}
                                                </h4>
                                                <div class="dashboard__card__body custom__form mt-4 single-reg-form">
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Location') }}
                                                        </label>
                                                        <input value="{{ $vendor?->vendor_shop_info?->location }}"
                                                            name="location" type="text"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Set Location From Map') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Phone Number') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input id="number" name="number" type="tel"
                                                            maxlength="15"
                                                            oninput="this.value = this.value.replace(/[^0-9+]/g, '');"
                                                            placeholder="{{ __('Enter Number') }}"
                                                            class="form--control radius-10" value="{{ $vendor->phone }}"
                                                            required>
                                                        <small id="number_error" class="text-muted"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Email') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input id="email" name="email" type="email"
                                                            placeholder="{{ __('Enter email') }}"
                                                            class="form--control radius-10" value="{{ $vendor->email }}"
                                                            required>
                                                        <small id="email_error" class="text-muted"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Facebook Link') }}
                                                        </label>
                                                        <input value="{{ $vendor?->vendor_shop_info?->facebook_url }}"
                                                            type="text" name="facebook_url"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Enter facebook link') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Website') }}
                                                        </label>
                                                        <input value="{{ $vendor?->vendor_shop_info?->website_url }}"
                                                            type="text" name="website_url"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Enter Website') }}">
                                                    </div>
                                                    <div class="row mt-4">
                                                        <!--color settings start -->
                                                        <span class="label-title color-light mt-3">
                                                            {{ __('Store Color Settings') }}
                                                        </span>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="store_color">
                                                                    {{ __('Main Color') }}
                                                                </label>
                                                                <input type="text" name="store_color"
                                                                    style="background-color: {{ $vendor?->vendor_shop_info?->colors['store_color'] ?? '' }};color: #fff;"
                                                                    class="form-control" placeholder="Select color"
                                                                    value="{{ $vendor?->vendor_shop_info?->colors['store_color'] ?? '' }}"
                                                                    id="store_color">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="store_secondary_color">{{ __('Secondary Color') }}</label>
                                                                <input type="text" name="store_secondary_color"
                                                                    style="background-color: {{ $vendor?->vendor_shop_info?->colors['store_secondary_color'] ?? '' }};color: #fff;"
                                                                    class="form-control" placeholder="Select color"
                                                                    value="{{ $vendor?->vendor_shop_info?->colors['store_secondary_color'] ?? '' }}"
                                                                    id="store_secondary_color">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="store_heading_color">{{ __('Heading Color') }}</label>
                                                                <input type="text" name="store_heading_color"
                                                                    style="background-color: {{ $vendor?->vendor_shop_info?->colors['store_heading_color'] ?? '' }};color: #fff;"
                                                                    class="form-control" placeholder="Select color"
                                                                    value="{{ $vendor?->vendor_shop_info?->colors['store_heading_color'] ?? '' }}"
                                                                    id="store_heading_color">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="store_paragraph_color">{{ __('Paragraph Color') }}</label>
                                                                <input type="text" name="store_paragraph_color"
                                                                    style="background-color: {{ $vendor?->vendor_shop_info?->colors['store_paragraph_color'] ?? '' }};color: #fff;"
                                                                    class="form-control" placeholder="Select color"
                                                                    value="{{ $vendor?->vendor_shop_info?->colors['store_paragraph_color'] ?? '' }}"
                                                                    id="store_paragraph_color">
                                                                <small>{{ __('you can change site paragraph color from
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                there') }}</small>
                                                            </div>
                                                        </div>
                                                        <!--color settings end -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="bank-info" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title">
                                                        {{ __('Bank Info') }}
                                                    </h4>
                                                    <br>
                                                    @if ($vendor?->vendor_bank_info?->is_varify && $vendor?->vendor_bank_info?->varify_at)
                                                        <p class="text-success">
                                                            The vendor bank information approved
                                                        </p>
                                                    @else
                                                        <p class="text-warning">
                                                            The vendor bank information is pending.
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="dashboard__card__body custom__form mt-4 single-reg-form">
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Name') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input value="{{ $vendor?->vendor_bank_info?->bank_name }}"
                                                            maxlength="30" name="bank_name" type="text"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Enter name') }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Email') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input value="{{ $vendor?->vendor_bank_info?->bank_email }}"
                                                            name="bank_email" type="text"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Enter email') }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Bank Code') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input value="{{ $vendor?->vendor_bank_info?->bank_code }}"
                                                            name="bank_code" type="tel"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Enter bank code') }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Account Number') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input value="{{ $vendor?->vendor_bank_info?->account_number }}"
                                                            name="account_number" type="tel"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Enter account number') }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Verification Status') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="is_varify" class="form-control">
                                                            <option value="" selected disabled>
                                                                Select Status
                                                            </option>
                                                            <option value="1"
                                                                @if ($vendor?->vendor_bank_info?->is_varify == 1) selected @endif>
                                                                Verify
                                                            </option>
                                                            <option value="0"
                                                                @if ($vendor?->vendor_bank_info?->is_varify == 0) selected @endif>
                                                                Rejected
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="body-overlay-desktop"></div>

    <x-media.markup />
@endsection

@section('script')
    <style>
        /* add if you don't already have them in your stylesheet */
        .field-error {
            color: #dc3545 !important;
        }

        .field-success {
            color: #28a745 !important;
        }


        .btn-disabled {
            pointer-events: none !important;
            opacity: 0.5 !important;
            cursor: not-allowed !important;
        }
    </style>

    <script>
        (function($) {
            "use strict";

            // --- CONFIG ---
            const validateFields = ['username', 'email', 'number'];
            const allFields = ['username', 'email', 'number', 'password', 'password_confirmation', 'tax_id'];

            // state
            const errors = {
                username: false,
                email: false,
                number: false,
                password: false,
                password_confirmation: false,
                tax_id: false
            };
            const touched = {
                username: false,
                email: false,
                number: false,
                password: false,
                password_confirmation: false,
                tax_id: false
            };

            // submit button
            let $submitBtn = $('.submit_button button').first();
            if (!$submitBtn.length) $submitBtn = $('button[type="submit"]').first();

            // regexes
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const taxIdRegex = /^[A-Z]\d{12}$/; // 1 letter + 12 digits

            // helper functions
            function updateSubmitState() {
                const hasError = Object.values(errors).some(v => v === true);
                const taxVisible = $('#taxIdWrapper').length && $('#taxIdWrapper').is(':visible');
                const taxRequiredAndEmpty = taxVisible && (!$('#tax_id').val() || !$('#tax_id').val().trim());
                if (hasError || taxRequiredAndEmpty) {
                    $submitBtn.prop('disabled', true).addClass('btn-disabled');
                } else {
                    $submitBtn.prop('disabled', false).removeClass('btn-disabled');
                }
            }

            function setFieldError(field, message) {
                const $input = $('input[name="' + field + '"]');
                const $err = $('#' + field + '_error');
                errors[field] = true;
                $input.removeClass('is-valid').addClass('is-invalid');
                if ($err.length) $err.removeClass('field-success').addClass('field-error').text(message);
                updateSubmitState();
            }

            function setFieldSuccess(field, message) {
                const $input = $('input[name="' + field + '"]');
                const $err = $('#' + field + '_error');
                errors[field] = false;
                if (touched[field]) {
                    $input.removeClass('is-invalid').addClass('is-valid');
                    if ($err.length) $err.removeClass('field-error').addClass('field-success').text(message);
                } else {
                    $input.removeClass('is-invalid is-valid');
                    if ($err.length) $err.removeClass('field-error field-success').text('');
                }
                updateSubmitState();
            }

            function clearFieldMessage(field) {
                const $input = $('input[name="' + field + '"]');
                const $err = $('#' + field + '_error');
                errors[field] = false;
                $input.removeClass('is-invalid is-valid');
                if ($err.length) $err.removeClass('field-error field-success').text('');
                updateSubmitState();
            }

            function debounce(fn, wait = 400) {
                let t;
                return function() {
                    const ctx = this,
                        args = arguments;
                    clearTimeout(t);
                    t = setTimeout(() => fn.apply(ctx, args), wait);
                }
            }

            // AJAX uniqueness check (edit: pass id so server ignores current vendor)
            function checkFieldUnique(field, value) {
                if (!value) {
                    clearFieldMessage(field);
                    return;
                }

                if (field === 'email' && !emailRegex.test(value)) {
                    setFieldError('email', 'Invalid email address');
                    return;
                }

                const vendorId = $('input[name="id"]').val() || '';

                $.ajax({
                    url: '{{ route('admin.vendor.validate-field') }}',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        field: field,
                        value: value,
                        id: vendorId
                    },
                    success: function(res) {
                        if (res && res.valid === false) {
                            setFieldError(field, res.message || (field + ' already taken.'));
                        } else {
                            const nice = {
                                username: 'Username is available',
                                email: 'Email is available',
                                number: 'Phone number is available'
                            };
                            setFieldSuccess(field, nice[field] || 'Available');
                        }
                    },
                    error: function(xhr) {
                        console.error('Unique check failed', xhr);
                        setFieldError(field, 'Validation server error');
                    }
                });
            }

            // password match check
            function validatePasswordMatch() {
                const pw = $('input[name="password"]').val() || '';
                const cpw = $('input[name="password_confirmation"]').val() || '';

                if (!pw && !cpw) {
                    clearFieldMessage('password_confirmation');
                    clearFieldMessage('password');
                    return;
                }

                if (pw !== cpw) {
                    setFieldError('password_confirmation', 'Passwords do not match');
                } else {
                    setFieldSuccess('password_confirmation', 'Passwords match');
                    errors['password'] = false;
                }
            }

            // tax validation
            function validateTaxIdField() {
                const $tax = $('#tax_id');
                if (!$tax.length) return;
                const val = ($tax.val() || '').toUpperCase().trim();

                if ($('#taxIdWrapper').length && !$('#taxIdWrapper').is(':visible')) {
                    clearFieldMessage('tax_id');
                    return;
                }

                if (!val) {
                    setFieldError('tax_id', 'Tax ID is required');
                    return;
                }

                if (!taxIdRegex.test(val)) {
                    setFieldError('tax_id', 'Tax ID must be 1 letter followed by 12 digits (e.g., L000000000000)');
                } else {
                    setFieldSuccess('tax_id', '');
                }
            }

            // find option values whose label contains 'business' (case-insensitive)
            function getBusinessOptionValues() {
                const vals = [];
                $('#business_type option').each(function() {
                    const txt = ($(this).text() || '').trim().toLowerCase();
                    if (txt && txt.includes('business')) vals.push(String($(this).val()));
                });
                return vals;
            }

            // --- CORE TOGGLE LOGIC: show tax if BUSINESS, hide & CLEAR if INDIVIDUAL/other ---
            // NOTE: We store server original tax value in data-original attribute on the tax input.
            function toggleTaxBasedOnBusinessUsingValue(businessVals) {
                const curVal = String($('#business_type').val() || '');
                const original = $('#tax_id').data('original') ? String($('#tax_id').data('original')) : '';
                const isBusiness = businessVals.indexOf(curVal) !== -1;

                if (isBusiness) {
                    // show & restore original server value (if any). If user has typed a value, keep it.
                    $("#taxIdWrapper").show();
                    $("#tax_id").attr('required', 'required');

                    const currentVal = String($('#tax_id').val() || '').trim();
                    if (!currentVal && original) {
                        $('#tax_id').val(original.toUpperCase());
                    }
                    if (typeof validateTaxIdField === 'function') validateTaxIdField();
                } else {
                    // hide and clear tax (per your request: "if selected/created with individual then tax id empty")
                    $("#taxIdWrapper").hide();
                    $('#tax_id').val(''); // CLEAR regardless of original
                    $("#tax_id").removeAttr('required');
                    if (typeof clearFieldMessage === 'function') clearFieldMessage('tax_id');
                }

                if (typeof updateSubmitState === 'function') updateSubmitState();
            }

            // --- Initialization ---
            $(function() {
                // ensure CSRF meta exists (for AJAX)
                if (!$('meta[name="csrf-token"]').length) {
                    $('head').append('<meta name="csrf-token" content="{{ csrf_token() }}">');
                }

                // Attach listeners to inputs for validation + uniqueness
                allFields.forEach(function(field) {
                    const $el = $('input[name="' + field + '"]');
                    if (!$el.length) return;

                    const deb = debounce(function() {
                        if (validateFields.includes(field)) {
                            checkFieldUnique(field, $el.val().trim());
                        }
                        if (field === 'tax_id') validateTaxIdField();
                    }, 350);

                    $el.on('input change', function() {
                        if (!touched[field]) touched[field] = true;

                        if (field === 'password' || field === 'password_confirmation') {
                            validatePasswordMatch();
                            return;
                        }

                        if (field === 'tax_id') {
                            // force uppercase and validate
                            $el.val(($el.val() || '').toUpperCase());
                            validateTaxIdField();
                            return;
                        }

                        const val = $el.val() ? $el.val().trim() : '';
                        if (!val) {
                            clearFieldMessage(field);
                            return;
                        }

                        if (field === 'email') {
                            if (!emailRegex.test(val)) {
                                setFieldError('email', 'Invalid email address');
                                return;
                            } else {
                                const $err = $('#email_error');
                                if ($err.length && $err.text().trim() ===
                                    'Invalid email address') {
                                    clearFieldMessage('email');
                                }
                            }
                        }

                        const $errEl = $('#' + field + '_error');
                        if ($errEl.length) $errEl.removeClass('field-success').text('');
                        $el.removeClass('is-valid is-invalid');

                        deb();
                    });

                    // run initial server check for prefilled values (silent successes)
                    const initial = $el.val() ? $el.val().trim() : '';
                    if (initial && validateFields.includes(field)) {
                        if (field === 'email' && !emailRegex.test(initial)) {
                            setFieldError('email', 'Invalid email address');
                        } else {
                            setTimeout(() => checkFieldUnique(field, initial), 250);
                        }
                    }
                });

                // sync email <-> shop_email if present (optional)
                const $email = $('input[name="email"]');
                const $shopEmail = $('input[name="shop_email"]');
                let syncing = false;

                function normalizeEmail(v) {
                    return v.replace(/\s+/g, '').toLowerCase();
                }

                function syncFields($src, $tgt) {
                    if (syncing) return;
                    const v = $src.val() ? normalizeEmail($src.val()) : '';
                    if ($tgt.val() !== v) {
                        syncing = true;
                        $tgt.val(v).trigger('input');
                        setTimeout(() => syncing = false, 0);
                    }
                }
                if ($email.length && $shopEmail.length) {
                    $email.on('input', debounce(() => syncFields($email, $shopEmail), 80));
                    $shopEmail.on('input', debounce(() => syncFields($shopEmail, $email), 80));
                    const e = $email.val() ? normalizeEmail($email.val()) : '';
                    const s = $shopEmail.val() ? normalizeEmail($shopEmail.val()) : '';
                    if (e && !s) $shopEmail.val(e);
                    else if (s && !e) $email.val(s);
                }

                // init select2 if available
                if ($.fn.select2) {
                    try {
                        $("#business_type").select2({
                            width: '100%'
                        });
                        $("#country_id").select2({
                            width: '100%'
                        });
                        $("#state_id").select2({
                            width: '100%'
                        });
                        $("#city_id").select2({
                            width: '100%'
                        });
                    } catch (e) {
                        console.warn('select2 init failed', e);
                    }
                }

                // compute business option values (scan by text)
                let businessOptionValues = getBusinessOptionValues();

                // initial toggle (small delay to allow select2/server values to settle)
                setTimeout(function() {
                    businessOptionValues = getBusinessOptionValues();
                    toggleTaxBasedOnBusinessUsingValue(businessOptionValues);
                }, 80);

                // bindings: native change + select2 events + click fallback
                $('#business_type').on('change', function() {
                    toggleTaxBasedOnBusinessUsingValue(businessOptionValues);
                });

                $(document).on('select2:select select2:unselect', '#business_type', function() {
                    setTimeout(function() {
                        toggleTaxBasedOnBusinessUsingValue(businessOptionValues);
                    }, 30);
                });

                $(document).on('click', '#business_type + .select2-container .select2-results__option',
                    function() {
                        setTimeout(function() {
                            toggleTaxBasedOnBusinessUsingValue(businessOptionValues);
                        }, 40);
                    });

                // safety binding for tax input
                $(document).on('input change', '#tax_id', debounce(validateTaxIdField, 150));

                // -----------------------------
                // Auto-tab-switch on missing required fields
                // This runs BEFORE the final submit safeguard so it can intercept and switch tabs.
                // -----------------------------
                // ensure native validation is off
                const f = document.getElementById('vendor-create-form');
                if (f) f.noValidate = true;

                $(document).on('submit', '#vendor-create-form', function(evt) {
                    const form = this;
                    form.noValidate = true; // double-safety
                    const requiredEls = form.querySelectorAll('[required]');
                    let firstMissing = null;

                    for (let i = 0; i < requiredEls.length; i++) {
                        const el = requiredEls[i];
                        if (el.disabled) continue;
                        try {
                            if (el.validity && el.validity.valueMissing) {
                                firstMissing = el;
                                break;
                            }
                        } catch (err) {}
                        const tag = (el.tagName || '').toLowerCase();
                        if ((tag === 'input' || tag === 'textarea') && String(el.value).trim() === '') {
                            firstMissing = el;
                            break;
                        }
                        if (tag === 'select' && (el.value === '' || el.selectedIndex === -1)) {
                            firstMissing = el;
                            break;
                        }
                    }

                    if (!firstMissing) return; // nothing missing - allow other handlers continue

                    // prevent other handlers & submission
                    evt.preventDefault();
                    evt.stopImmediatePropagation();

                    console.debug('[auto-tab-switch] missing required:', firstMissing.name ||
                        firstMissing);

                    // find containing pane
                    let pane = firstMissing.closest ? firstMissing.closest('.tab-pane') : null;

                    // fallback: look for a matching element by name inside tab-pane
                    if (!pane && firstMissing.name) {
                        const selector = '.tab-pane [name="' + CSS.escape(firstMissing.name) + '"]';
                        const foundInPane = form.querySelector(selector);
                        if (foundInPane) pane = foundInPane.closest('.tab-pane');
                    }

                    // fallback: climb up
                    if (!pane) {
                        let p = firstMissing.parentNode;
                        for (let depth = 0; p && depth < 8; depth++, p = p.parentNode) {
                            if (p.classList && p.classList.contains('tab-pane')) {
                                pane = p;
                                break;
                            }
                        }
                    }

                    // determine tab target
                    let tabTarget = null;
                    if (pane && pane.id) {
                        tabTarget = '#' + pane.id;
                    } else {
                        const lbl = form.querySelector('label[for="' + (firstMissing.id || '') +
                                '"]') ||
                            (firstMissing.closest ? firstMissing.closest('.single-input')
                                ?.querySelector('label') : null);
                        const labelText = lbl ? lbl.textContent.trim().split('\n')[0] : '';
                        if (labelText) {
                            const panes = form.querySelectorAll('.tab-pane');
                            for (let j = 0; j < panes.length; j++) {
                                const paneEl = panes[j];
                                if (paneEl.innerText && paneEl.innerText.indexOf(labelText) !== -1) {
                                    tabTarget = '#' + (paneEl.id || '');
                                    pane = paneEl;
                                    break;
                                }
                            }
                        }
                    }

                    if (tabTarget) {
                        let tabButton = document.querySelector('[data-bs-target="' + tabTarget +
                                '"]') ||
                            document.querySelector('[data-target="' + tabTarget + '"]') ||
                            document.querySelector('.nav [href="' + tabTarget + '"]');

                        if (tabButton) {
                            if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
                                try {
                                    const tab = new bootstrap.Tab(tabButton);
                                    tab.show();
                                } catch (err) {
                                    tabButton.click();
                                }
                            } else {
                                try {
                                    tabButton.click();
                                } catch (err) {
                                    $(tabButton).trigger('click');
                                }
                            }
                        }

                        setTimeout(function() {
                            let focusEl = firstMissing;
                            if (pane && firstMissing.name) {
                                const real = pane.querySelector('[name="' + CSS.escape(
                                    firstMissing.name) + '"]');
                                if (real) focusEl = real;
                            }

                            try {
                                const style = window.getComputedStyle(focusEl);
                                if (style && (style.display === 'none' || style.visibility ===
                                        'hidden')) {
                                    const alt = pane ? pane.querySelector('[name="' + CSS
                                        .escape(firstMissing.name) +
                                        '"]:not([type="hidden"])') : null;
                                    if (alt) focusEl = alt;
                                }

                                focusEl.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                                focusEl.focus({
                                    preventScroll: true
                                });
                            } catch (err) {
                                try {
                                    focusEl.focus();
                                } catch (e) {}
                            }

                            const parent = focusEl.parentNode || focusEl.closest(
                                '.single-input') || focusEl.closest('.form-group');
                            if (parent) {
                                const smallEl = parent.querySelector('small') || parent
                                    .querySelector('.text-muted');
                                if (smallEl && smallEl.textContent.trim() === '') {
                                    smallEl.textContent =
                                        '{{ __('This field is required') }}';
                                    smallEl.classList.remove('field-success');
                                    smallEl.classList.add('field-error');
                                }
                            }
                        }, 300);

                        return false;
                    } else {
                        try {
                            firstMissing.focus();
                        } catch (err) {}
                        return false;
                    }
                });
                // -----------------------------
                // End auto-tab-switch
                // -----------------------------

                // final submit safeguard (existing)
                $('#vendor-create-form').on('submit', function(e) {
                    // validate tax if visible
                    if ($('#taxIdWrapper').is(':visible')) {
                        validateTaxIdField();
                    }

                    const hasError = Object.values(errors).some(v => v === true);
                    const taxVisible = $('#taxIdWrapper').length && $('#taxIdWrapper').is(':visible');
                    const taxRequiredAndEmpty = taxVisible && (!$('#tax_id').val() || !$('#tax_id')
                        .val().trim());

                    if (hasError || taxRequiredAndEmpty) {
                        e.preventDefault();
                        const first = Object.keys(errors).find(k => errors[k]);
                        if (first) {
                            const $firstEl = $('input[name="' + first + '"]');
                            if ($firstEl.length) {
                                $('html,body').animate({
                                    scrollTop: $firstEl.offset().top - 100
                                }, 250);
                                $firstEl.focus();
                            }
                        } else if (taxRequiredAndEmpty) {
                            $('html,body').animate({
                                scrollTop: $('#taxIdWrapper').offset().top - 100
                            }, 250);
                            $('#tax_id').focus();
                        }
                        return false;
                    }
                    // allow submit; server must still re-validate
                });

                // initial submit state update
                updateSubmitState();
            });

        })(jQuery);
    </script>


    <script src="{{ asset('assets/backend/js/colorpicker.js') }}"></script>
    <x-media.js />
    <x-table.btn.swal.js />
    <script>
        $(document).ready(function() {
            $("#business_type").select2();
            $("#country_id").select2();
            $("#state_id").select2();
            $("#city_id").select2();
        });

        $(document).on("submit", "#vendor-create-form", function(e) {
            e.preventDefault();
            let url = $(this).data("action-url"),
                data = new FormData(e.target);

            send_ajax_request("post", data, url, () => {
                // write some code for preloader <i class="las la-spinner"></i>
                $(".submit_button button").append('<i class="las la-spinner"></i>');
                toastr.warning("Request Send.. Please Wait...");
            }, (data) => {
                $("#state_id").html(data.option);
                $(".state_wrapper .list").html(data.li);
                $(".submit_button button i").remove()
                toastr.success("Vendor account updated successfully....");
            }, (data) => {
                toastr.error("Some error found.");
                prepare_errors(data);
                $(".submit_button button i").remove()
            });
        });


        // $(document).on("change", "#country_id", function() {
        //     let data = new FormData();
        //     data.append("country_id", $(this).val());
        //     data.append("_token", "{{ csrf_token() }}");

        //     send_ajax_request(
        //         "post",
        //         data,
        //         "{{ route('admin.vendor.get.state') }}",
        //         function() {},
        //         (data) => {
        //             $("#state_id").html("<option value=''>{{ __('Select a state') }}</option>" + data.option);
        //             $(".state_wrapper .list").html(data.li);
        //         },
        //         (data) => {
        //             prepare_errors(data);
        //         }
        //     );
        // });

        // $(document).on("change", "#state_id", function() {
        //     let data = new FormData();
        //     data.append("country_id", $("#country_id").val());
        //     data.append("state_id", $(this).val());
        //     data.append("_token", "{{ csrf_token() }}");

        //     send_ajax_request(
        //         "post",
        //         data,
        //         "{{ route('admin.vendor.get.city') }}",
        //         function() {},
        //         (data) => {
        //             $("#city_id").html("<option value=''>{{ __('Select a city') }}</option>" + data.option);
        //             $(".city_wrapper .list").html(data.li);
        //         },
        //         (data) => {
        //             prepare_errors(data);
        //         }
        //     );
        // });

        $(document).on("keyup keydown click change", "input[name=username]", function() {
            $(this).val(convertToSlug($(this).val()));
        });
    </script>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                initColorPicker('#store_color');
                initColorPicker('#store_secondary_color');
                initColorPicker('#store_main_color_two');
                initColorPicker('#store_heading_color');
                initColorPicker('#store_paragraph_color');
                initColorPicker('input[name="portfolio_home_color"');
                initColorPicker('input[name="logistics_home_color"');

                function initColorPicker(selector) {
                    $(selector).ColorPicker({
                        color: '#852aff',
                        onShow: function(colpkr) {
                            $(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function(colpkr) {
                            $(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function(hsb, hex, rgb) {
                            $(selector).css('background-color', '#' + hex);
                            $(selector).val('#' + hex);
                        }
                    });
                }
            });
        }(jQuery));
    </script>
@endsection
