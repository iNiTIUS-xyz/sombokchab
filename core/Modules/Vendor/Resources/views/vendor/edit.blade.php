@extends('vendor.vendor-master')
@section('site-title')
    {{ __('Edit Profile') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/colorpicker.css') }}">
    <x-media.css />
    <x-datatable.css />
    <x-bulk-action.css />
    <x-select2.select2-css />
@endsection
@section('content')
    <style>
        .btn-disabled {
            pointer-events: none !important;
            opacity: 0.5 !important;
            cursor: not-allowed !important;
        }

        .field-error {
            color: #dc3545 !important;
            /* red */
        }

        .field-success {
            color: #28a745 !important;
            /* green */
        }
    </style>
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                {{--
            <x-msg.error />
            <x-msg.flash /> --}}
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Edit Profile') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form id="vendor-create-form" data-action-url="{{ route('vendor.profile.update', $vendor->id) }}">
                            <div class="toast toast-success"></div>
                            @csrf
                            <input name="id" value="{{ $vendor->id }}" type="hidden" />
                            <div class="d-flex flex-wrap gap-3 justify-content-between">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#basic-info" type="button" role="tab"
                                            aria-controls="basic-info" aria-selected="true">Basic
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#address" type="button" role="tab" aria-controls="address"
                                            aria-selected="false">Address
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#shop-info" type="button" role="tab"
                                            aria-controls="shop-info" aria-selected="false">Shop Info
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#bank-info" type="button" role="tab"
                                            aria-controls="bank-info" aria-selected="false">Bank Info
                                        </button>
                                    </li>
                                </ul>

                                <div class="submit_button">
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
                                                    <h4 class="dashboard__card__title"> Basic Info</h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    Vendor Name
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input name="owner_name" type="text" maxlength="30"
                                                                    class="form--control radius-10"
                                                                    value="{{ $vendor->owner_name }}" required
                                                                    placeholder="{{ __('Enter Vendor Name') }}"
                                                                    oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');">

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    Business Name
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input name="business_name" type="text" maxlength="30"
                                                                    class="form--control radius-10" pattern="[A-Za-z\s]+"
                                                                    title="Only letters allowed"
                                                                    value="{{ $vendor->business_name }}" required=""
                                                                    placeholder="{{ __('Enter Business Name') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    Username
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input name="username" type="text" maxlength="25"
                                                                    class="form--control radius-10"
                                                                    value="{{ $vendor->username }}" required=""
                                                                    placeholder="{{ __('Enter Username') }}">
                                                                <small class="text-danger" id="username_error"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Business
                                                                    Category
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="nice-select-two">
                                                                    <select id="business_type" name="business_type_id"
                                                                        style="" class="form--control radius-10"
                                                                        required="">
                                                                        @foreach ($business_type as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $item->id == $vendor->business_type_id ? 'selected' : '' }}>
                                                                                {{ $item->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    {{ __('Description') }}
                                                                </label>
                                                                <textarea name="description" class="form--control form--message radius-10"
                                                                    placeholder="{{ __('Enter Description') }}" cols="30" rows="10">{{ $vendor->description }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <x-media.media-upload :old-image="$vendor?->vendor_shop_info?->logo" :title="__('Logo')" :name="'logo_id'"
                                                :dimentions="'200x200'" type="vendor" />
                                            <x-media.media-upload :old-image="$vendor?->vendor_shop_info?->cover_photo" :title="__('Cover Photo')" :name="'cover_photo_id'"
                                                :dimentions="'200x200'" type="vendor" />
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title">{{ __('Address') }}</h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    {{ __('Country') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="nice-select-two country_wrapper">
                                                                    <select class="form-control" id="country_id"
                                                                        name="country_id" required="">
                                                                        <option value="">Select City</option>
                                                                        @foreach ($country as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $vendor?->vendor_address?->country_id == $item->id ? 'selected' : '' }}>
                                                                                {{ $item->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    {{ __('City') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="nice-select-two state_wrapper">
                                                                    <select class="form-control" id="state_id"
                                                                        name="state_id" required="">
                                                                        <option value="">Select City</option>
                                                                        @foreach ($states as $state)
                                                                            <option value="{{ $state->id }}"
                                                                                {{ $vendor?->vendor_address?->state_id == $state->id ? 'selected' : '' }}>
                                                                                {{ $state->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    {{ __('Province') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="nice-select-two city_wrapper">
                                                                    <select class="form-control" id="city_id"
                                                                        name="city_id" required="">
                                                                        <option value="">Select Province</option>
                                                                        @foreach ($cities as $city)
                                                                            <option value="{{ $city->id }}"
                                                                                {{ $vendor?->vendor_address?->city_id == $city->id ? 'selected' : '' }}>
                                                                                {{ $city->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    {{ __('Postal Code') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" name="zip_code" maxlength="5"
                                                                    class="form--control radius-10"
                                                                    value="{{ $vendor?->vendor_address?->zip_code }}"
                                                                    placeholder="{{ __('Enter Postal Code') }}" required
                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');">

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    {{ __('Address') }}
                                                                </label>
                                                                <textarea cols="30" rows="10" name="address" type="text" class="form--control radius-10"
                                                                    placeholder="{{ __('Enter Address') }}">{{ $vendor?->vendor_address?->address }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    {{ __('Google Map Location') }}
                                                                </label>

                                                                <div class="embed-map-container">
                                                                    <iframe class="embed-map-frame" frameborder="0"
                                                                        scrolling="no" marginheight="0" marginwidth="0"
                                                                        src="https://maps.google.com/maps?hl=en&q=Dhaka&t=&z=14&ie=UTF8&iwloc=B&output=embed">
                                                                    </iframe>
                                                                </div>

                                                                {{-- <span class="mt-3">
                                                                {{ __('Example: Google Map Embed Code.') }}
                                                            </span>
                                                            <pre><code>&lt;iframe src="https://www.example.com" width="600" height="450"&gt;&lt;/iframe&gt;</code></pre>
                                                            --}}
                                                            </div>
                                                        </div>

                                                        <style>
                                                            .embed-map-container {
                                                                width: 100%;
                                                                /* Full width */
                                                                height: 300px;
                                                                /* Increase height (you can change this) */
                                                                position: relative;
                                                                overflow: hidden;
                                                                border-radius: 10px;
                                                                /* Optional rounded corners */
                                                            }

                                                            .embed-map-frame {
                                                                width: 100% !important;
                                                                /* Full width */
                                                                height: 100% !important;
                                                                /* Match container height */
                                                                border: 0;
                                                            }
                                                        </style>



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
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title">{{ __('Shop Info') }}</h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    {{ __('Link/URL') }}
                                                                </label>
                                                                <input value="{{ $vendor?->vendor_shop_info?->location }}"
                                                                    name="location" type="text"
                                                                    class="form--control radius-10"
                                                                    placeholder="Set Link/URL From Map">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    {{ __('Phone Number') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" name="number"
                                                                    value="{{ $vendor?->phone }}"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter Phone Number') }}"
                                                                    maxlength="15"
                                                                    oninput="this.value = this.value.replace(/[^0-9+]/g, '');">

                                                                <small class="text-danger" id="number_error"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    {{ __('Email') }}
                                                                </label>
                                                                <input value="{{ $vendor?->vendor_shop_info?->email }}"
                                                                    type="text" name="email"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter Email') }}">
                                                                <small class="text-danger" id="email_error"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    Facebook Link
                                                                </label>
                                                                <input
                                                                    value="{{ $vendor?->vendor_shop_info?->facebook_url }}"
                                                                    type="text" name="facebook_url"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter Facebook Link') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    Website Link
                                                                </label>
                                                                <input
                                                                    value="{{ $vendor?->vendor_shop_info?->website_url }}"
                                                                    type="text" name="website_url"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter Website Link') }}">
                                                            </div>
                                                        </div>
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
                                                                <small
                                                                    class="text-danger">{{ __('You may change the site
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        paragraph color from here') }}</small>
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
                                                    <h4 class="dashboard__card__title">Bank Info</h4>
                                                </div>
                                                <div class="sdashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    Name
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input
                                                                    value="{{ $vendor?->vendor_bank_info?->bank_name }}"
                                                                    name="bank_name" type="text" maxlength="30"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter name') }}" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    Email
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input
                                                                    value="{{ $vendor?->vendor_bank_info?->bank_email }}"
                                                                    name="bank_email" type="text"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter email') }}" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    Bank Code
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input
                                                                    value="{{ $vendor?->vendor_bank_info?->bank_code }}"
                                                                    name="bank_code" type="number"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter code') }}" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    Account Number
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input
                                                                    value="{{ $vendor?->vendor_bank_info?->account_number }}"
                                                                    name="account_number" type="number"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter account number') }}"
                                                                    required="">
                                                            </div>
                                                        </div>
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

    <x-media.markup type="vendor" />
@endsection
@section('script')
    <script>
        (function($) {
            "use strict";

            // fields we will validate
            const fields = ['username', 'email', 'number'];

            // track invalid state (true = invalid)
            const errors = {
                username: false,
                email: false,
                number: false
            };

            // track whether user has interacted with field (only show "available" after interaction)
            const touched = {
                username: false,
                email: false,
                number: false
            };

            // submit button
            let $submitBtn = $('.submit_button button').first();
            if (!$submitBtn.length) {
                $submitBtn = $('button[type="submit"]').first();
            }

            function updateSubmitState() {
                const hasError = Object.values(errors).some(v => v === true);
                if (hasError) {
                    $submitBtn.prop('disabled', true);
                    $submitBtn.addClass('btn-disabled');
                } else {
                    $submitBtn.prop('disabled', false);
                    $submitBtn.removeClass('btn-disabled');
                }
            }

            function setFieldError(field, message) {
                const $input = $('input[name="' + field + '"]');
                const $err = $('#' + field + '_error');

                errors[field] = true;
                $input.removeClass('is-valid').addClass('is-invalid');
                $err.removeClass('field-success').addClass('field-error').text(message);

                updateSubmitState();
            }

            function setFieldSuccess(field, message) {
                const $input = $('input[name="' + field + '"]');
                const $err = $('#' + field + '_error');

                errors[field] = false;
                // only show success when user has interacted with the field
                if (touched[field]) {
                    $input.removeClass('is-invalid').addClass('is-valid');
                    $err.removeClass('field-error').addClass('field-success').text(message);
                } else {
                    // if not touched, clear messages and classes (silence)
                    $input.removeClass('is-invalid is-valid');
                    $err.removeClass('field-error field-success').text('');
                }

                updateSubmitState();
            }

            function clearFieldMessage(field) {
                const $input = $('input[name="' + field + '"]');
                const $err = $('#' + field + '_error');
                errors[field] = false;
                $input.removeClass('is-invalid is-valid');
                $err.removeClass('field-error field-success').text('');
                updateSubmitState();
            }

            // debounce helper
            function debounce(fn, wait = 400) {
                let t;
                return function() {
                    const ctx = this,
                        args = arguments;
                    clearTimeout(t);
                    t = setTimeout(() => fn.apply(ctx, args), wait);
                };
            }

            // AJAX check
            function checkFieldUnique(field, value) {
                const vendorId = $('input[name="id"]').val() || '';

                if (!value) {
                    clearFieldMessage(field);
                    return;
                }

                $.ajax({
                    url: '{{ route('vendor.validate-field') }}',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        field: field,
                        value: value,
                        id: vendorId
                    },
                    success: function(res) {
                        // res: { valid: true } or { valid: false, message: "..." }
                        if (res && res.valid === false) {
                            // always show error (even if not touched) because it's a real problem
                            setFieldError(field, res.message || (field + ' already taken.'));
                        } else {
                            // available — show success only if user touched the field
                            const nice = {
                                username: 'Username available',
                                email: 'Email available',
                                number: 'Phone number available'
                            };
                            setFieldSuccess(field, nice[field] || 'Available');
                        }
                    },
                    error: function(xhr) {
                        console.error('Unique check failed', xhr);
                        // treat server error as temporary problem — show a soft error and block submit
                        setFieldError(field, 'Validation server error');
                    }
                });
            }

            // attach listeners
            $(function() {
                if (!$('meta[name="csrf-token"]').length) {
                    $('head').append('<meta name="csrf-token" content="{{ csrf_token() }}">');
                }

                fields.forEach(function(field) {
                    const $el = $('input[name="' + field + '"]');
                    if (!$el.length) return;

                    // mark touched on first user input/interaction
                    $el.on('focus', function() {
                        // don't flip touched on focus if already true
                        if (!touched[field]) {
                            // only mark touched on actual typing/change (not just focus)
                            // so we set a flag that focus happened; actual typing will set touched true below
                            $el.data('hadFocus', true);
                        }
                    });

                    // debounced check
                    const debounced = debounce(function() {
                        checkFieldUnique(field, $el.val().trim());
                    }, 450);

                    $el.on('input change', function() {
                        const v = $(this).val().trim();

                        // mark touched when the user types (first time)
                        if (!touched[field]) {
                            // require the user to actually change the value after focusing
                            if ($el.data('hadFocus') || v.length > 0) {
                                touched[field] = true;
                            }
                        }

                        if (!v) {
                            clearFieldMessage(field);
                            return;
                        }

                        // clear existing success while typing
                        $('#' + field + '_error').removeClass('field-success').text('');
                        $(this).removeClass('is-valid is-invalid');

                        debounced();
                    });

                    // Initial server check: only show errors (taken) on load, but do NOT show "available" messages
                    const initial = $el.val() ? $el.val().trim() : '';
                    if (initial) {
                        // call but ensure touched[field] is false so setFieldSuccess will be silent
                        setTimeout(() => checkFieldUnique(field, initial), 250);
                    }
                });

                // final safeguard on submit
                $('#vendor-create-form').on('submit', function(e) {
                    const hasError = Object.values(errors).some(v => v === true);
                    if (hasError) {
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
                        }
                        return false;
                    }
                    // allow submit
                });

                updateSubmitState();
            });

        })(jQuery);
    </script>



    <script src="{{ asset('assets/backend/js/colorpicker.js') }}">
        < /> <
        x - datatable.js / >
            <
            x - media.js type = "vendor" / >
            <
            x - table.btn.swal.js / >
            <
            x - select2.select2 - js / >
            <
            script >
            function validateZipCode(value) {
                const trimmed = value.trim();

                if (!trimmed) return "Postal Code is required";

                // Cambodia uses exactly 5 digits
                if (!/^[0-9]{5}$/.test(trimmed)) {
                    return "Postal Code must be exactly 5 digits (Cambodia format)";
                }

                return "";
            }

        const zipField = document.querySelector('input[name="zip_code"]');
        const zipErrorEl = document.getElementById('zipCodeError');

        zipField.addEventListener('input', () => {
            zipErrorEl.textContent = validateZipCode(zipField.value);
        });


        $('#country_id,#state_id,#city_id').select2()
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

        //     send_ajax_request("post", data, "{{ route('vendor.get.state') }}", function() {}, (data) => {
        //         option = "<option value=''>Select an state</option>";
        //         option += data.option;
        //         $("#state_id").html(option);
        //         $(".state_wrapper .list").html(data.li);
        //     }, (data) => {
        //         prepare_errors(data);
        //     })
        // });

        // $(document).on("change", "#state_id", function() {
        //     let data = new FormData();

        //     data.append("country_id", $("#country_id").val());
        //     data.append("state_id", $(this).val());
        //     data.append("_token", "{{ csrf_token() }}");

        //     send_ajax_request("post", data, "{{ route('vendor.get.city') }}", function() {}, (data) => {
        //         option = "<option value=''>Select an city</option>";
        //         option += data.option;

        //         $("#city_id").html(option);
        //         $(".city_wrapper .list").html(data.li);
        //     }, (data) => {
        //         prepare_errors(data);
        //     })
        // });

        $(document).on("keyup keydown click change", "input[name=username]", function() {
            $(this).val(convertToSlug($(this).val()))
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
