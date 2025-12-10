@extends('backend.admin-master')
@section('site-title')
    {{ __('Vendor Create') }}
@endsection
@section('style')
    <x-media.css />
    <x-datatable.css />
    <x-bulk-action.css />
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        {{--
    <x-msg.error />
    <x-msg.flash /> --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Create Vendor') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <!-- NOTE: novalidate added to disable native HTML5 validation -->
                        <form id="vendor-create-form" data-action-url="{{ route('admin.vendor.create') }}" novalidate>
                            <div class="toast toast-success"></div>
                            @csrf
                            <div class="d-flex justify-content-between">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#basic-info" type="button" role="tab"
                                            aria-controls="basic-info" aria-selected="true">
                                            {{ __('Basic') }}
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#address" type="button" role="tab" aria-controls="address"
                                            aria-selected="false">
                                            {{ __('Address') }}
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#shop-info" type="button" role="tab"
                                            aria-controls="shop-info" aria-selected="false">
                                            {{ __('Shop Info') }}
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#bank-info" type="button" role="tab"
                                            aria-controls="bank-info" aria-selected="false">
                                            {{ __('Bank Info') }}
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="basic-info" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-lg-6 mt-4">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title">
                                                        {{ __('Basic Info') }}
                                                    </h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Vendor Name') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input name="owner_name" type="text"
                                                                    class="form--control radius-10" maxlength="30" required
                                                                    oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                                                    placeholder="{{ __('Enter vendor Name') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Business Name') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input name="business_name" type="text"
                                                                    class="form--control radius-10"
                                                                    oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                                                    maxlength="30" required
                                                                    placeholder="{{ __('Enter business Name') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Email') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input id="email" name="email" type="email"
                                                                    class="form--control radius-10" maxlength="191"
                                                                    placeholder="{{ __('Enter email') }}"
                                                                    aria-describedby="email_error" required>
                                                                <small id="email_error" class="text-muted"></small>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Username') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input id="username" name="username" type="text"
                                                                    class="form--control radius-10" maxlength="25"
                                                                    placeholder="{{ __('Enter username') }}"
                                                                    aria-describedby="username_error" required>
                                                                <small id="username_error" class="text-muted"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Password') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input id="password" name="password" type="password"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter password') }}"
                                                                    aria-describedby="password_error" minlength="8"
                                                                    required>
                                                                <small id="password_error" class="text-muted"></small>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Confirm Password') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input id="password_confirmation"
                                                                    name="password_confirmation" type="password"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Confirm password') }}"
                                                                    aria-describedby="password_confirmation_error"
                                                                    minlength="8" required>
                                                                <small id="password_confirmation_error"
                                                                    class="text-muted"></small>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Business Category') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="nice-select-two">
                                                                    <select id="business_type" name="business_type_id"
                                                                        style="display: none;">
                                                                        @foreach ($business_type as $item)
                                                                            <option value="{{ $item->id }}">
                                                                                {{ $item->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12" id="taxIdWrapper" style="display: none;">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Tax ID') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input id="tax_id" name="tax_id" type="text"
                                                                    maxlength="13" class="form--control radius-10"
                                                                    placeholder="{{ __('Enter Tax ID') }}"
                                                                    aria-describedby="tax_id_error"
                                                                    oninput="this.value = this.value.toUpperCase();" />
                                                                <small id="tax_id_error" class="text-muted"></small>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Description') }}
                                                                </label>
                                                                <textarea name="description" class="form--control form--message radius-10" style="height: 100px"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="label-title color-light mb-2">
                                                                    {{ __('Is Verified') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <select name="is_vendor_verified" class="form--control">
                                                                    <option value="1">
                                                                        Yes
                                                                    </option>
                                                                    <option value="0">
                                                                        No
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <x-media-upload :title="__('Logo')" name="logo_id" dimentions="200x200" />
                                            <x-media-upload :title="__('Cover Photo')" name="cover_photo_id"
                                                dimentions="200x200" />
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade mt-4" id="address" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title">
                                                        {{ __('Address') }}
                                                    </h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Country') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="nice-select-two country_wrapper">
                                                                    <select id="country_id" name="country_id"
                                                                        style="display: none;" required>
                                                                        <option value="">
                                                                            {{ __('Select Country') }}
                                                                        </option>
                                                                        @foreach ($country as $item)
                                                                            <option value="{{ $item->id }}">
                                                                                {{ $item->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Province') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="nice-select-two state_wrapper">
                                                                    <select id="state_id" name="state_id"
                                                                        style="display: none;" required>
                                                                        <option value="">
                                                                            {{ __('Select Province') }}
                                                                        </option>
                                                                        @foreach ($states as $state)
                                                                            <option value="{{ $state->id }}">
                                                                                {{ $state->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('City') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="nice-select-two city_wrapper">
                                                                    <select id="city_id" name="city_id"
                                                                        style="display: none;" required>
                                                                        <option value="">
                                                                            {{ __('Select City') }}
                                                                        </option>
                                                                        @foreach ($cities as $city)
                                                                            <option value="{{ $city->id }}">
                                                                                {{ $city->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Postal Code') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" name="zip_code" maxlength="5"
                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                                    class="form--control radius-10" placeholder="Zip Code"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Address') }}
                                                                </label>
                                                                <textarea name="address" type="text" class="form--control radius-10" placeholder="{{ __('Enter address') }}"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade mt-4" id="shop-info" role="tabpanel"
                                    aria-labelledby="contact-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title">
                                                        {{ __('Shop Info') }}
                                                    </h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Location') }}
                                                                </label>
                                                                <input name="location" type="url"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter location from map') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Phone Number') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input id="number" name="number" type="tel"
                                                                    class="form--control radius-10" maxlength="15"
                                                                    inputmode="tel"
                                                                    placeholder="{{ __('Enter phone number') }}"
                                                                    aria-describedby="number_error"
                                                                    oninput="this.value = this.value.replace(/[^0-9+]/g, '');"
                                                                    required>
                                                                <small id="number_error" class="text-muted"></small>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Email Address') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" name="shop_email"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter email') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Facebook Link') }}
                                                                </label>
                                                                <input type="url" name="facebook_url"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter facebook link') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Website') }}
                                                                </label>
                                                                <input type="url" name="website_url"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Enter Website') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade mt-4" id="bank-info" role="tabpanel"
                                    aria-labelledby="contact-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title">
                                                        {{ __('Bank Info') }}
                                                    </h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Name') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input name="bank_name" type="text" maxlength="30"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Type Name') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Email') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input name="bank_email" type="text"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Type Email') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Bank Code') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input name="bank_code" type="tel"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Code" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title">
                                                                    {{ __('Account Number') }}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input name="account_number" type="tel"
                                                                    class="form--control radius-10"
                                                                    placeholder="{{ __('Type Account Number') }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit_button mt-4">
                                <button type="submit" class="cmn_btn btn_bg_profile">
                                    {{ __('Add') }}
                                </button>
                                <a href="{{ route('admin.vendor.all') }}" class="cmn_btn default-theme-btn"
                                    style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                    {{ __('Back') }}
                                </a>
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
        /* add once in your blade or global CSS */
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

            /*
              Full client-side script for vendor-create page with robust tax toggle:
              - Detects option values whose label contains "Business" (case-insensitive).
              - Uses the actual <select>.value to decide whether to show tax_id.
              - Binds native change and Select2 events with small timeouts to avoid timing races.
              - All previous validations remain: uniqueness checks (username/email/number), password match,
                tax_id validation (1 letter + 12 digits), and final submit safeguard.
            */

            // FIELDS TO VALIDATE (server unique checks will run only for username, email, number)
            const validateFields = ['username', 'email', 'number'];
            // include password fields + tax_id for client-side checks
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
            const taxIdRegex = /^[A-Z]\d{12}$/; // will uppercase input for validation

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

            // AJAX uniqueness check (username/email/number)
            function checkFieldUnique(field, value) {
                if (!value) {
                    clearFieldMessage(field);
                    return;
                }

                if (field === 'email' && !emailRegex.test(value)) {
                    setFieldError('email', 'Invalid email address');
                    return;
                }

                $.ajax({
                    url: "{{ route('admin.vendor.validate-field') }}",
                    method: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        field: field,
                        value: value
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

            // Password match check
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

            // Tax ID validation (only when visible/required)
            function validateTaxIdField() {
                const $tax = $('#tax_id');
                if (!$tax.length) return;
                const val = ($tax.val() || '').toUpperCase().trim();

                // if hidden -> clear
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
                    setFieldSuccess('tax_id', 'Valid Tax ID');
                }
            }

            // Email <-> shop_email bi-directional sync (optional)
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

            // Utility: find option values whose text includes "business" (case-insensitive)
            function getBusinessOptionValues() {
                const vals = [];
                $('#business_type option').each(function() {
                    const txt = ($(this).text() || '').trim().toLowerCase();
                    if (txt && txt.includes('business')) {
                        vals.push(String($(this).val()));
                    }
                });
                return vals;
            }

            // Main toggle using reliable <select>.value
            function toggleTaxBasedOnBusinessUsingValue(businessVals) {
                const curVal = String($('#business_type').val() || '');
                const isBusiness = businessVals.indexOf(curVal) !== -1;

                if (isBusiness) {
                    $("#taxIdWrapper").show();
                    $("#tax_id").attr('required', 'required');
                    if (typeof validateTaxIdField === 'function') validateTaxIdField();
                } else {
                    $("#taxIdWrapper").hide();
                    $("#tax_id").val('');
                    $("#tax_id").removeAttr('required');
                    if (typeof clearFieldMessage === 'function') clearFieldMessage('tax_id');
                }

                if (typeof updateSubmitState === 'function') updateSubmitState();
            }

            $(function() {
                // ensure csrf meta exists
                if (!$('meta[name="csrf-token"]').length) {
                    $('head').append('<meta name="csrf-token" content="{{ csrf_token() }}">');
                }

                // initialize inputs listeners
                allFields.forEach(function(field) {
                    const $el = $('input[name="' + field + '"]');
                    if (!$el.length) return;

                    const deb = debounce(function() {
                        if (validateFields.includes(field)) {
                            checkFieldUnique(field, $el.val().trim());
                        }
                        if (field === 'tax_id') {
                            validateTaxIdField();
                        }
                    }, 350);

                    $el.on('input change', function() {
                        if (!touched[field]) touched[field] = true;

                        if (field === 'password' || field === 'password_confirmation') {
                            validatePasswordMatch();
                            return;
                        }

                        if (field === 'tax_id') {
                            // force uppercase on input
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

                    // initial server-side check on load for prefilled values (silent success)
                    const initial = $el.val() ? $el.val().trim() : '';
                    if (initial && validateFields.includes(field)) {
                        if (field === 'email' && !emailRegex.test(initial)) {
                            setFieldError('email', 'Invalid email address');
                        } else {
                            setTimeout(() => checkFieldUnique(field, initial), 250);
                        }
                    }
                });

                // email/shop_email sync
                const $email = $('input[name="email"]');
                const $shopEmail = $('input[name="shop_email"]');
                if ($email.length && $shopEmail.length) {
                    $email.on('input', debounce(() => syncFields($email, $shopEmail), 80));
                    $shopEmail.on('input', debounce(() => syncFields($shopEmail, $email), 80));
                    const e = $email.val() ? normalizeEmail($email.val()) : '';
                    const s = $shopEmail.val() ? normalizeEmail($shopEmail.val()) : '';
                    if (e && !s) $shopEmail.val(e);
                    else if (s && !e) $email.val(s);
                }

                // initialize select2 (if used)
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

                // initial toggle (small timeout to let select2 settle)
                setTimeout(function() {
                    businessOptionValues = getBusinessOptionValues(); // refresh in case dynamic
                    toggleTaxBasedOnBusinessUsingValue(businessOptionValues);
                }, 80);

                // native change binding
                $('#business_type').on('change', function() {
                    toggleTaxBasedOnBusinessUsingValue(businessOptionValues);
                });

                // select2 events (robust)
                $(document).on('select2:select select2:unselect', '#business_type', function() {
                    setTimeout(function() {
                        toggleTaxBasedOnBusinessUsingValue(businessOptionValues);
                    }, 30);
                });

                // click fallback for some select2 versions
                $(document).on('click', '#business_type + .select2-container .select2-results__option',
                    function() {
                        setTimeout(function() {
                            toggleTaxBasedOnBusinessUsingValue(businessOptionValues);
                        }, 40);
                    });

                // extra binding for tax input (safety)
                $(document).on('input change', '#tax_id', debounce(validateTaxIdField, 150));

                // final submit safeguard
                $('#vendor-create-form').on('submit', function(e) {
                    // validate tax one last time if visible
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
                    // allow submit; server-side should re-validate
                });

                // initial state update for submit button
                updateSubmitState();
            });
        })(jQuery);
    </script>

    <!-- ===== AUTO-TAB-SWITCH SCRIPT (must appear BEFORE the final ajax submit handler) ===== -->
    <script>
        (function($) {
            "use strict";

            // Ensure the form's native validation is off
            document.addEventListener('DOMContentLoaded', function() {
                const f = document.getElementById('vendor-create-form');
                if (f) f.noValidate = true;
            });

            // Auto-tab-switch handler
            $(document).on('submit', '#vendor-create-form', function(e) {
                const form = this;
                form.noValidate = true; // double safety
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

                if (!firstMissing) return; // no missing required field, let other handlers proceed

                // prevent submission and other handlers (like AJAX)
                e.preventDefault();
                e.stopImmediatePropagation();

                console.debug('[auto-tab-switch] missing required:', firstMissing.name || firstMissing);

                // try find tab-pane that contains the field
                let pane = firstMissing.closest ? firstMissing.closest('.tab-pane') : null;

                // fallback A: find matching name inside a tab-pane
                if (!pane && firstMissing.name) {
                    const selector = '.tab-pane [name="' + CSS.escape(firstMissing.name) + '"]';
                    const foundInPane = form.querySelector(selector);
                    if (foundInPane) pane = foundInPane.closest('.tab-pane');
                }

                // fallback B: climb up
                if (!pane) {
                    let p = firstMissing.parentNode;
                    for (let depth = 0; p && depth < 8; depth++, p = p.parentNode) {
                        if (p.classList && p.classList.contains('tab-pane')) {
                            pane = p;
                            break;
                        }
                    }
                }

                let tabTarget = null;
                if (pane && pane.id) {
                    tabTarget = '#' + pane.id;
                } else {
                    // fallback: try map by label text
                    const lbl = form.querySelector('label[for="' + (firstMissing.id || '') + '"]') ||
                        (firstMissing.closest ? firstMissing.closest('.single-input')?.querySelector('label') :
                            null);
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
                    // find nav trigger button
                    let tabButton = document.querySelector('[data-bs-target="' + tabTarget + '"]') ||
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

                    // after small delay, focus the corresponding control inside the pane
                    setTimeout(function() {
                        let focusEl = firstMissing;
                        if (pane && firstMissing.name) {
                            const real = pane.querySelector('[name="' + CSS.escape(firstMissing.name) +
                                '"]');
                            if (real) focusEl = real;
                        }

                        try {
                            const style = window.getComputedStyle(focusEl);
                            if (style && (style.display === 'none' || style.visibility === 'hidden')) {
                                const alt = pane ? pane.querySelector('[name="' + CSS.escape(
                                    firstMissing.name) + '"]:not([type="hidden"])') : null;
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

                        // show inline required message if small exists
                        const parent = focusEl.parentNode || focusEl.closest('.single-input') || focusEl
                            .closest('.form-group');
                        if (parent) {
                            const smallEl = parent.querySelector('small') || parent.querySelector(
                                '.text-muted');
                            if (smallEl && smallEl.textContent.trim() === '') {
                                smallEl.textContent = '{{ __('This field is required') }}';
                                smallEl.classList.remove('field-success');
                                smallEl.classList.add('field-error');
                            }
                        }
                    }, 300);

                    return false;
                } else {
                    // fallback: just focus the missing field
                    try {
                        firstMissing.focus();
                    } catch (err) {}
                    return false;
                }
            });
        })(jQuery);
    </script>
    <!-- ===== END AUTO-TAB-SWITCH SCRIPT ===== -->

    <x-datatable.js />
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
                // write some code for preloader
                $(".submit_button button").append('<i class="las la-spinner"></i>');
                toastr.warning("Request Send.. Please Wait...");
            }, (data) => {
                $("#state_id").html(data.option);
                $(".state_wrapper .list").html(data.li);
                $(".submit_button button i").remove()
                toastr.success("Successfully Created Vendor Account....");
            }, (data) => {
                prepare_errors(data);
                $(".submit_button button i").remove()
            })
        })

        $(document).on("keyup keydown click change", "input[name=username]", function() {
            $(this).val(convertToSlug($(this).val()))
        });
    </script>
@endsection
