@extends('backend.admin-master')
@section('site-title')
{{ __('Add New Customer') }}
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">

<style>
    /* Validation styles */
    .field-error {
        color: #dc3545 !important;
    }

    /* red */
    .field-success {
        color: #28a745 !important;
    }

    /* green */
    .is-valid {
        border-color: #28a745 !important;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .btn-disabled {
        pointer-events: none !important;
        opacity: 0.5 !important;
        cursor: not-allowed !important;
    }
</style>
@endsection

@section('content')
<div class="col-lg-12 col-ml-12">
    {{-- @include('backend/partials/message')
    @include('backend/partials/error') --}}
    <div class="row">
        <!-- basic form start -->
        <div class="col-12">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title">{{ __('Add New Customer') }}</h4>
                </div>
                <div class="dashboard__card__body custom__form mt-4">
                    <form id="customer-create-form" action="{{ route('admin.frontend.new.user') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">
                                        {{ __('Name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" maxlength="30"
                                        oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                        placeholder="{{ __('Enter full name') }}">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="username">
                                        {{ __('Username') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="username" name="username" maxlength="25"
                                        placeholder="{{ __('Enter username') }}" aria-describedby="username_error">
                                    <small id="username_error" class="text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email">
                                        {{ __('Email') }}
                                    </label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="{{ __('Enter email') }}" aria-describedby="email_error">
                                    <small id="email_error" class="text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="phone">
                                        {{ __('Phone') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="phone" name="phone" maxlength="15"
                                        placeholder="{{ __('Enter phone') }}" aria-describedby="phone_error"
                                        oninput="this.value = this.value.replace(/[^0-9+]/g, '');">
                                    <small id="phone_error" class="text-muted"></small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="country">
                                        {{ __('Country') }}
                                    </label>
                                    <select name="country" id="country" class="form-select">
                                        <option value="" disabled selected>{{ __('Select country') }}</option>
                                        @foreach ($country as $item)
                                        <option value="{{ $item->id }}" @if ($item->id == 31) selected @endif>
                                            {{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="city">
                                        {{ __('Province') }}
                                    </label>
                                    <select name="city" id="state_id" class="form-select">
                                        <option value="" disabled selected>{{ __('Select province') }}</option>
                                        @foreach ($states as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="state">
                                        {{ __('City') }}
                                    </label>
                                    <select name="state" id="city_id" class="form-select">
                                        <option value="" disabled selected>{{ __('Select city') }}</option>
                                        @foreach ($cities as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="zipcode">
                                        {{ __('Postal code') }}
                                    </label>
                                    <input type="text" class="form-control" id="zipcode" name="zipcode" maxlength="5"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        placeholder="{{ __('Enter postal code') }}">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="address">
                                        {{ __('Address') }}
                                    </label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="{{ __('Enter address') }}">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="password">
                                        {{ __('Password') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="{{ __('Enter password') }}"
                                        aria-describedby="password_confirmation_error">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="password_confirmation">
                                        {{ __('Confirm Password') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation"
                                        placeholder="{{ __('Enter password confirmation') }}"
                                        aria-describedby="password_confirmation_error">
                                    <small id="password_confirmation_error" class="text-muted"></small>
                                </div>
                            </div>
                        </div>

                        @can('add-customer')
                        <button id="customer_add_btn" type="submit" class="cmn_btn btn_bg_profile mt-4">
                            {{ __('Add') }}
                        </button>
                        <a href="{{ route('admin.all.frontend.user') }}" class="cmn_btn default-theme-btn"
                            style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                            {{ __('Back') }}
                        </a>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // country -> state, state -> city ajax handlers (unchanged, keep as you had)
    $(document).on("change", "#country", function () {
        let data = new FormData();

        data.append("country_id", $(this).val());
        data.append("_token", "{{ csrf_token() }}");

        send_ajax_request("post", data, "{{ route('admin.vendor.get.state') }}", function () { }, (data) => {
            $("#state_id").html("<option value=''>{{ __('Select City') }}</option>" + data.option);
            $(".state_wrapper .list").html(data.li);
        }, (data) => {
            prepare_errors(data);
        })
    });

    $(document).on("change", "#state_id", function () {
        let data = new FormData();

        data.append("country_id", $("#country").val());
        data.append("state_id", $(this).val());
        data.append("_token", "{{ csrf_token() }}");

        send_ajax_request("post", data, "{{ route('admin.vendor.get.city') }}", function () { }, (data) => {
            $("#city_id").html("<option value=''>{{ __('Select Province') }}</option>" + data.option);
            $(".city_wrapper .list").html(data.li);
        }, (data) => {
            prepare_errors(data);
        })
    });
</script>

<script>
    (function($){
    "use strict";

    // fields to perform uniqueness check (server)
    const validateFields = ['username','email','phone'];

    // all fields that need wiring (passwords included for match-check)
    const allFields = ['username','email','phone','password','password_confirmation'];

    // state: true = invalid
    const errors = { username:false, email:false, phone:false, password:false, password_confirmation:false };
    const touched = { username:false, email:false, phone:false, password:false, password_confirmation:false };

    // find submit button
    let $submitBtn = $('#customer_add_btn');
    if(!$submitBtn.length){
        $submitBtn = $('button[type="submit"]').first();
    }

    // email regex
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    function updateSubmitState(){
        const hasError = Object.values(errors).some(v => v === true);
        if(hasError){
            $submitBtn.prop('disabled', true).addClass('btn-disabled');
        } else {
            $submitBtn.prop('disabled', false).removeClass('btn-disabled');
        }
    }

    function setFieldError(field, message){
        const $input = $('[name="'+field+'"]');
        const $err = $('#'+field+'_error');
        errors[field] = true;
        $input.removeClass('is-valid').addClass('is-invalid');
        if($err.length) $err.removeClass('field-success').addClass('field-error').text(message);
        updateSubmitState();
    }

    function setFieldSuccess(field, message){
        const $input = $('[name="'+field+'"]');
        const $err = $('#'+field+'_error');
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
        const $input = $('[name="'+field+'"]');
        const $err = $('#'+field+'_error');
        errors[field] = false;
        $input.removeClass('is-invalid is-valid');
        if($err.length) $err.removeClass('field-error field-success').text('');
        updateSubmitState();
    }

    function debounce(fn, wait = 400){
        let t;
        return function(){
            const ctx = this, args = arguments;
            clearTimeout(t);
            t = setTimeout(()=> fn.apply(ctx,args), wait);
        }
    }

    // ajax uniqueness check - replace route if you use other name
    function checkFieldUnique(field, value){
        if(!value){
            clearFieldMessage(field);
            return;
        }

        // client-side email format check to avoid useless requests
        if(field === 'email' && !emailRegex.test(value)){
            setFieldError('email', 'Invalid email address');
            return;
        }

        $.ajax({
            url: "{{ route('admin.frontend.validate-field') }}",
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
                    const successMsg = {
                        username: 'Username available',
                        email: 'Email available',
                        phone: 'Phone available'
                    };
                    setFieldSuccess(field, successMsg[field] || 'Available');
                }
            },
            error: function(xhr){
                console.error('Validation request failed', xhr);
                setFieldError(field, 'Validation server error');
            }
        });
    }

    // password match
    function validatePasswordMatch(){
        const pw = $('[name="password"]').val() || '';
        const cpw = $('[name="password_confirmation"]').val() || '';
        const $err = $('#password_confirmation_error');

        if(!pw && !cpw){
            // If you want to force client-side required, set errors here; otherwise leave server to enforce.
            clearFieldMessage('password_confirmation');
            clearFieldMessage('password');
            return;
        }

        if(pw !== cpw){
            setFieldError('password_confirmation', 'Passwords do not match');
        } else {
            setFieldSuccess('password_confirmation', 'Passwords match');
            errors['password'] = false;
        }
    }

    $(function(){
        // ensure csrf meta exists
        if(!$('meta[name="csrf-token"]').length){
            $('head').append('<meta name="csrf-token" content="{{ csrf_token() }}">');
        }

        // attach listeners to fields
        allFields.forEach(function(field){
            const $el = $('[name="'+field+'"]');
            if(!$el.length) return;

            const debounced = debounce(function(){
                if(validateFields.includes(field)){
                    checkFieldUnique(field, $el.val().trim());
                }
            }, 350);

            $el.on('input change', function(){
                if(!touched[field]) touched[field] = true;

                // handle passwords separately
                if(field === 'password' || field === 'password_confirmation'){
                    validatePasswordMatch();
                    return;
                }

                const val = $el.val().trim();
                if(!val){
                    clearFieldMessage(field);
                    return;
                }

                // while typing clear previous green success
                const $errEl = $('#'+field+'_error');
                if($errEl.length) $errEl.removeClass('field-success').text('');
                $el.removeClass('is-valid is-invalid');

                // email quick format check client-side
                if(field === 'email'){
                    if(!emailRegex.test(val)){
                        setFieldError('email', 'Invalid email address');
                        return;
                    } else {
                        const $e = $('#email_error');
                        if($e.length && $e.text().trim() === 'Invalid email address') {
                            clearFieldMessage('email');
                        }
                    }
                }

                debounced();
            });

            // initial server check on prefilled values (will show taken errors if any)
            const initial = $el.val() ? $el.val().trim() : '';
            if(initial && validateFields.includes(field)){
                if(field === 'email' && !emailRegex.test(initial)){
                    setFieldError('email', 'Invalid email address');
                } else {
                    setTimeout(()=> checkFieldUnique(field, initial), 250);
                }
            }
        });

        // prevent form submission while there are errors
        $('#customer-create-form').on('submit', function(e){
            const hasError = Object.values(errors).some(v => v === true);
            if(hasError){
                e.preventDefault();
                const first = Object.keys(errors).find(k => errors[k]);
                if(first){
                    const $firstEl = $('[name="'+first+'"]');
                    if($firstEl.length){
                        $('html,body').animate({ scrollTop: $firstEl.offset().top - 100 }, 250);
                        $firstEl.focus();
                    }
                }
                return false;
            }
            // otherwise allow submission; server-side validation must still be performed.
        });

        // initialize submit state
        updateSubmitState();
    });
})(jQuery);
</script>
@endsection