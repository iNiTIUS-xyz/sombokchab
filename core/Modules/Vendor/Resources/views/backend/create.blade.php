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
                    <form id="vendor-create-form" data-action-url="{{ route('admin.vendor.create') }}">
                        <div class="toast toast-success"></div>
                        @csrf
                        <div class="d-flex justify-content-between">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#basic-info" type="button" role="tab" aria-controls="basic-info"
                                        aria-selected="true">
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
                                        data-bs-target="#shop-info" type="button" role="tab" aria-controls="shop-info"
                                        aria-selected="false">
                                        {{ __('Shop Info') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#bank-info" type="button" role="tab" aria-controls="bank-info"
                                        aria-selected="false">
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
                                                    {{ __('Basic Info*') }}
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
                                                                class="form--control radius-10" maxlength="30"
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
                                                                maxlength="30"
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
                                                    <div class="col-sm-12">
                                                        <div class="single-input">
                                                            <label class="label-title">
                                                                {{ __('Description') }}
                                                            </label>
                                                            <textarea name="description"
                                                                class="form--control form--message radius-10"
                                                                style="height: 100px"></textarea>
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
                            <div class="tab-pane fade mt-4" id="address" role="tabpanel" aria-labelledby="profile-tab">
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
                                                                    style="display: none;">
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
                                                                    style="display: none;">
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
                                                                    style="display: none;">
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
                                                                class="form--control radius-10" placeholder="Zip Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="single-input">
                                                            <label class="label-title">
                                                                {{ __('Address') }}
                                                            </label>
                                                            <textarea name="address" type="text"
                                                                class="form--control radius-10"
                                                                placeholder="{{ __('Enter address') }}"></textarea>
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
                                                                placeholder="{{ __('Enter email') }}">
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
                                                            </label>
                                                            <input name="bank_name" type="text" maxlength="30"
                                                                class="form--control radius-10"
                                                                placeholder="{{ __('Type Name') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="single-input">
                                                            <label class="label-title">
                                                                {{ __('Email') }}
                                                            </label>
                                                            <input name="bank_email" type="text"
                                                                class="form--control radius-10"
                                                                placeholder="{{ __('Type Email') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="single-input">
                                                            <label class="label-title">
                                                                {{ __('Bank Code') }}
                                                            </label>
                                                            <input name="bank_code" type="tel"
                                                                class="form--control radius-10" placeholder="Type Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="single-input">
                                                            <label class="label-title">
                                                                {{ __('Account Number') }}
                                                            </label>
                                                            <input name="account_number" type="tel"
                                                                class="form--control radius-10"
                                                                placeholder="{{ __('Type Account Number') }}">
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
    (function($){
    "use strict";

    // FIELDS TO VALIDATE (server unique checks will run only for username, email, number)
    const validateFields = ['username','email','number'];
    // include password fields for match-check only
    const allFields = ['username','email','number','password','password_confirmation'];

    // state
    const errors = { username:false, email:false, number:false, password:false, password_confirmation:false };
    const touched = { username:false, email:false, number:false, password:false, password_confirmation:false };

    // submit button
    let $submitBtn = $('.submit_button button').first();
    if(!$submitBtn.length) $submitBtn = $('button[type="submit"]').first();

    // email regex (basic, practical)
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // helper: update submit enable/disable
    function updateSubmitState(){
        const hasError = Object.values(errors).some(v => v === true);
        if(hasError){
            $submitBtn.prop('disabled', true).addClass('btn-disabled');
        } else {
            $submitBtn.prop('disabled', false).removeClass('btn-disabled');
        }
    }

    // message helpers
    function setFieldError(field, message){
        const $input = $('input[name="'+field+'"]');
        const $err   = $('#'+field+'_error');
        errors[field] = true;
        $input.removeClass('is-valid').addClass('is-invalid');
        if($err.length) $err.removeClass('field-success').addClass('field-error').text(message);
        updateSubmitState();
    }

    function setFieldSuccess(field, message){
        const $input = $('input[name="'+field+'"]');
        const $err   = $('#'+field+'_error');
        errors[field] = false;
        if(touched[field]){
            $input.removeClass('is-invalid').addClass('is-valid');
            if($err.length) $err.removeClass('field-error').addClass('field-success').text(message);
        } else {
            $input.removeClass('is-invalid is-valid');
            if($err.length) $err.removeClass('field-error field-success').text('');
        }
        updateSubmitState();
    }

    function clearFieldMessage(field){
        const $input = $('input[name="'+field+'"]');
        const $err   = $('#'+field+'_error');
        errors[field] = false;
        $input.removeClass('is-invalid is-valid');
        if($err.length) $err.removeClass('field-error field-success').text('');
        updateSubmitState();
    }

    // debounce helper
    function debounce(fn, wait=400){
        let t;
        return function(){
            const ctx = this, args = arguments;
            clearTimeout(t);
            t = setTimeout(() => fn.apply(ctx, args), wait);
        }
    }

    // AJAX uniqueness check (only for username/email/number)
    function checkFieldUnique(field, value){
        if(!value){
            clearFieldMessage(field);
            return;
        }

        // for email: validate format first
        if(field === 'email' && !emailRegex.test(value)){
            setFieldError('email','Invalid email address');
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
            success: function(res){
                if(res && res.valid === false){
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
            error: function(xhr){
                console.error('Unique check failed', xhr);
                setFieldError(field, 'Validation server error');
            }
        });
    }

    // Password match check (client-side)
    function validatePasswordMatch(){
        const pw = $('input[name="password"]').val() || '';
        const cpw = $('input[name="password_confirmation"]').val() || '';
        const $err = $('#password_confirmation_error');

        // on create page, passwords are required; if both empty consider error (adjust if you allow empty)
        if(!pw && !cpw){
            // If you want to require password on create, uncomment next two lines:
            // errors['password_confirmation'] = true;
            // if($err.length) $err.text('Password is required').addClass('field-error');

            // For flexible behavior (let server-side enforce required), just clear messages:
            clearFieldMessage('password_confirmation');
            clearFieldMessage('password');
            return;
        }

        if(pw !== cpw){
            setFieldError('password_confirmation','Passwords do not match');
        } else {
            setFieldSuccess('password_confirmation','Passwords match');
            errors['password'] = false;
        }
    }

    // Email <-> shop_email bi-directional sync (shop_email NOT validated)
    let syncing = false;
    function normalizeEmail(v){ return v.replace(/\s+/g,'').toLowerCase(); }

    function syncFields($src, $tgt){
        if(syncing) return;
        const v = $src.val() ? normalizeEmail($src.val()) : '';
        if($tgt.val() !== v){
            syncing = true;
            $tgt.val(v).trigger('input');
            // release next tick
            setTimeout(()=> syncing = false, 0);
        }
    }

    // attach listeners
    $(function(){
        // ensure csrf meta exists
        if(!$('meta[name="csrf-token"]').length){
            $('head').append('<meta name="csrf-token" content="{{ csrf_token() }}">');
        }

        // initialize fields
        allFields.forEach(function(field){
            const $el = $('input[name="'+field+'"]');
            if(!$el.length) return;

            const deb = debounce(function(){
                if(validateFields.includes(field)){
                    checkFieldUnique(field, $el.val().trim());
                }
            }, 350);

            $el.on('input change', function(){
                // mark touched on first typed input
                if(!touched[field]){
                    touched[field] = true;
                }

                // handle password fields separately
                if(field === 'password' || field === 'password_confirmation'){
                    validatePasswordMatch();
                    return;
                }

                const val = $el.val().trim();
                if(!val){
                    clearFieldMessage(field);
                    return;
                }

                // special: email format check immediately while typing (avoid calling AJAX if invalid)
                if(field === 'email'){
                    if(!emailRegex.test(val)){
                        // show format error but don't permanently block until user fixes
                        setFieldError('email','Invalid email address');
                        return;
                    } else {
                        // clear format error to allow AJAX unique check
                        // but only clear the message if it was format error (we can't confidently detect message origin)
                        // so if current error text equals 'Invalid email address', clear it
                        const $err = $('#email_error');
                        if($err.length && $err.text().trim() === 'Invalid email address'){
                            clearFieldMessage('email');
                        }
                    }
                }

                // while typing clear previous green success message for clarity
                const $errEl = $('#'+field+'_error');
                if($errEl.length) $errEl.removeClass('field-success').text('');
                $el.removeClass('is-valid is-invalid');

                deb();
            });

            // run initial server check to detect taken values on load (will show errors only; successes silent because touched=false)
            const initial = $el.val() ? $el.val().trim() : '';
            if(initial && validateFields.includes(field)){
                // for email, only run AJAX if it's valid format on load
                if(field === 'email' && !emailRegex.test(initial)){
                    // show format error on load if email pre-filled but invalid
                    setFieldError('email','Invalid email address');
                } else {
                    setTimeout(()=> checkFieldUnique(field, initial), 250);
                }
            }
        });

        // set up email <-> shop_email sync (bi-directional)
        const $email = $('input[name="email"]');
        const $shopEmail = $('input[name="shop_email"]');

        if($email.length && $shopEmail.length){
            $email.on('input', debounce(()=> syncFields($email,$shopEmail), 80));
            $shopEmail.on('input', debounce(()=> syncFields($shopEmail,$email), 80));
            // align on load: prefer primary email if present
            const e = $email.val() ? normalizeEmail($email.val()) : '';
            const s = $shopEmail.val() ? normalizeEmail($shopEmail.val()) : '';
            if(e && !s) $shopEmail.val(e);
            else if(s && !e) $email.val(s);
        }

        // final submit safeguard
        $('#vendor-create-form').on('submit', function(e){
            const hasError = Object.values(errors).some(v => v === true);
            if(hasError){
                e.preventDefault();
                // focus first invalid field
                const first = Object.keys(errors).find(k => errors[k]);
                if(first){
                    const $firstEl = $('input[name="'+first+'"]');
                    if($firstEl.length){
                        $('html,body').animate({ scrollTop: $firstEl.offset().top - 100 }, 250);
                        $firstEl.focus();
                    }
                }
                return false;
            }
            // allow submit; server side must validate again
        });

        updateSubmitState();
    });

})(jQuery);
</script>



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

        // $(document).on("change", "#country_id", function () {
        //     let data = new FormData();

        //     data.append("country_id", $(this).val());
        //     data.append("_token", "{{ csrf_token() }}");

        //     send_ajax_request("post", data, "{{ route('admin.vendor.get.state') }}", function () { }, (data) => {
        //         $("#state_id").html("<option value=''>{{ __('Select an state') }}</option>" + data.option);
        //         $(".state_wrapper .list").html(data.li);
        //     }, (data) => {
        //         prepare_errors(data);
        //     })
        // });

        // $(document).on("change", "#state_id", function () {
        //     let data = new FormData();

        //     data.append("country_id", $("#country_id").val());
        //     data.append("state_id", $(this).val());
        //     data.append("_token", "{{ csrf_token() }}");

        //     send_ajax_request("post", data, "{{ route('admin.vendor.get.city') }}", function () { }, (data) => {
        //         $("#city_id").html("<option value=''>{{ __('Select an city') }}</option>" + data.option);
        //         $(".city_wrapper .list").html(data.li);
        //     }, (data) => {
        //         prepare_errors(data);
        //     })
        // });

        $(document).on("keyup keydown click change", "input[name=username]", function() {
            $(this).val(convertToSlug($(this).val()))
        });
</script>
@endsection