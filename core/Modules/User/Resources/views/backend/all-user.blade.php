@extends('backend.admin-master')

@section('style')
<x-media.css />
<link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
<style>
    .swal2-confirm.swal2-styled.swal2-default-outline {
        background-color: var(--danger-color) !important;
    }

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

@section('site-title')
{{ __('Customer Accounts') }}
@endsection

@section('content')
{{--
<x-msg.error />
<x-msg.success /> --}}

<div class="col-12">
    @can('add-customer')
    <div class="btn-wrapper mb-4">
        <a href="{{ route('admin.frontend.new.user') }}" class="cmn_btn btn_bg_profile">
            Add New Customer
        </a>
    </div>
    @endcan
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h4 class="dashboard__card__title">{{ __('Customer Accounts') }}</h4>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead class="text-capitalize">
                        <tr>
                            <th>{{ __('Serial No') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Created On') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_user as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="text-left">{{ $user->name }} ({{ $user->username }})</td>
                            <td class="text-left">
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->created_at->format('M j, Y') }}
                            </td>
                            <td>
                                @can('edit-customer')
                                <a href="#" data-id="{{ $user->id }}" data-bs-toggle="modal"
                                    data-bs-target="#user_change_password_modal"
                                    class="btn btn-secondary btn-sm mb-2 me-1 user_change_password_btn"
                                    title="Change Password">
                                    <i class="ti-key"></i>
                                </a>
                                @endcan

                                @can('edit-customer')
                                <a href="javascript:;" title="{{ __('Edit Data') }}" data-id="{{ $user->id }}"
                                    data-username="{{ $user->username }}" data-name="{{ $user->name }}"
                                    data-email="{{ $user->email }}" data-phone="{{ $user->phone }}"
                                    data-address="{{ $user->address }}" data-state="{{ $user->state }}"
                                    data-city="{{ $user->city }}" data-zipcode="{{ $user->zipcode }}"
                                    data-country="{{ $user->country }}" data-bs-toggle="modal"
                                    data-bs-target="#user_edit_modal"
                                    class="btn btn-warning btn-sm text-dark mb-2 me-1 user_edit_btn">
                                    <i class="ti-pencil"></i>
                                </a>
                                @endcan

                                @can('delete-customer')
                                <x-delete-popover :url="route('admin.frontend.delete.user', $user->id)" />
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@can('edit-customer')
<div class="modal fade" id="user_edit_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.frontend.user.update') }}" id="user_edit_modal_form" method="post"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" id="user_id">
            <div class="modal-content custom__form">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Edit Customer Details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name" maxlength="30"
                                    oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                    placeholder="{{ __('Enter name') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="username">
                                    {{ __('Username') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="username" name="username" maxlength="25"
                                    placeholder="{{ __('Username') }}" aria-describedby="username_error">
                                <small id="username_error" class="text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">
                                    {{ __('Email') }}
                                </label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="{{ __('Email') }}" aria-describedby="email_error">
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
                                    oninput="this.value = this.value.replace(/[^0-9+]/g, '');"
                                    placeholder="{{ __('Phone') }}" aria-describedby="phone_error">
                                <small id="phone_error" class="text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="country">
                                    {{ __('Country') }}
                                </label>
                                <select id="country" name="country" class="form-select">
                                    <option value="">{{ __('Select country') }}</option>
                                    @foreach ($country as $item)
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
                                    {{ __('Province') }}
                                </label>
                                <select id="state_id" name="state" class="form-select">
                                    <option value="">{{ __('Select province') }}</option>

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
                                <label for="city">
                                    {{ __('City') }}
                                </label>
                                <select id="city_id" name="city" class="form-select">
                                    <option value="">{{ __('Select city') }}</option>
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
                                    {{ __('Postal Code') }}
                                </label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode" maxlength="5"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    placeholder="{{ __('Postal Code') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="address">
                                    {{ __('Address') }}
                                </label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="{{ __('Address') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button id="user_edit_update_btn" type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endcan

@can('edit-customer')
<div class="modal fade" id="user_change_password_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom__form">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Change User Password') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('admin.frontend.user.password.change') }}" id="user_password_change_modal_form"
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="ch_user_id" id="ch_user_id">
                    <div class="form-group">
                        <label for="password">
                            {{ __('Password') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control" name="password"
                            placeholder="{{ __('Enter Password') }}" required="">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">
                            {{ __('Confirm Password') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Change Password') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
<x-media.markup />
@endsection

@section('script')
{{--
<x-datatable.js /> --}}
<script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
<x-media.js />

<script>
    (function($) {
            "use strict";

            $(document).ready(function() {
                // Initialize modals
                var userEditModal = new bootstrap.Modal(document.getElementById('user_edit_modal'));
                var passwordChangeModal = new bootstrap.Modal(document.getElementById(
                    'user_change_password_modal'));

                // Password change button handler
                $(document).on('click', '.user_change_password_btn', function(e) {
                    e.preventDefault();
                    var userId = $(this).data('id');
                    $('#user_password_change_modal_form').find('#ch_user_id').val(userId);
                });

                // User edit button handler
                $(document).on('click', '.user_edit_btn', function(e) {
                    e.preventDefault();
                    var el = $(this);
                    var form = $('#user_edit_modal_form');

                    // Set basic user info
                    form.find('#user_id').val(el.data('id'));
                    form.find('#name').val(el.data('name'));
                    form.find('#username').val(el.data('username'));
                    form.find('#email').val(el.data('email'));
                    form.find('#phone').val(el.data('phone'));
                    form.find('#zipcode').val(el.data('zipcode'));
                    form.find('#address').val(el.data('address'));

                    // clear any previous messages / validation state
                    clearModalValidation();

                    // Set country and trigger change to load states
                    var countryId = el.data('country');

                    form.find('#country').val(countryId).trigger('change');

                    // After a delay (to allow states to load), set the state
                    setTimeout(function() {
                        var stateId = el.data('state');
                        if (stateId) {
                            form.find('#state_id').val(stateId).trigger('change');
                        }

                        // After another delay (to allow cities to load), set the city
                        setTimeout(function() {
                            var cityId = el.data('city');
                            if (cityId) {
                                form.find('#city_id').val(cityId);
                            }
                        }, 500);
                    }, 500);
                });
            });
        })(jQuery);
</script>

<script>
    (function($){
    "use strict";

    // fields to validate (AJAX uniqueness checks)
    const validateFields = ['username','email','phone'];

    // fields used in wiring (no password validation here)
    const allFields = ['username','email','phone'];

    // state (true = invalid)
    const errors = { username:false, email:false, phone:false };
    const touched = { username:false, email:false, phone:false };

    // find modal form and update button
    const $form = $('#user_edit_modal_form');
    let $updateBtn = $('#user_edit_update_btn');
    if(!$updateBtn.length){
        $updateBtn = $form.find('button[type="submit"]').first();
    }

    // email regex
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    function updateSubmitState(){
        const hasError = Object.values(errors).some(v => v === true);
        if(hasError){
            $updateBtn.prop('disabled', true).addClass('btn-disabled');
        } else {
            $updateBtn.prop('disabled', false).removeClass('btn-disabled');
        }
    }

    function setFieldError(field, message){
        const $input = $form.find('[name="'+field+'"]');
        const $err = $('#'+field+'_error');
        errors[field] = true;
        $input.removeClass('is-valid').addClass('is-invalid');
        if($err.length) $err.removeClass('field-success').addClass('field-error').text(message);
        updateSubmitState();
    }

    function setFieldSuccess(field, message){
        const $input = $form.find('[name="'+field+'"]');
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
        const $input = $form.find('[name="'+field+'"]');
        const $err = $('#'+field+'_error');
        errors[field] = false;
        $input.removeClass('is-invalid is-valid');
        if($err.length) $err.removeClass('field-error field-success').text('');
        updateSubmitState();
    }

    function clearModalValidation(){
        allFields.forEach(f => clearFieldMessage(f));
        // reset touched flags
        allFields.forEach(f => touched[f] = false);
    }

    function debounce(fn, wait = 400){
        let t;
        return function(){
            const ctx = this, args = arguments;
            clearTimeout(t);
            t = setTimeout(()=> fn.apply(ctx,args), wait);
        }
    }

    // AJAX uniqueness check - sends `field`, `value`, and `id` to ignore current user
    function checkFieldUnique(field, value){
        const userId = $form.find('[name="user_id"]').val() || '';

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
                value: value,
                id: userId
            },
            success: function(res){
                if(res && res.valid === false){
                    setFieldError(field, res.message || (field + ' already taken.'));
                } else {
                    const nice = {
                        username: 'Username available',
                        email: 'Email available',
                        phone: 'Phone available'
                    };
                    setFieldSuccess(field, nice[field] || 'Available');
                }
            },
            error: function(xhr){
                console.error('Validation request failed', xhr);
                setFieldError(field, 'Validation server error');
            }
        });
    }

    // attach listeners when modal form is present
    $(function(){
        // ensure csrf meta exists (if not present on page)
        if(!$('meta[name="csrf-token"]').length){
            $('head').append('<meta name="csrf-token" content="{{ csrf_token() }}">');
        }

        allFields.forEach(function(field){
            const $el = $form.find('[name="'+field+'"]');
            if(!$el.length) return;

            const debounced = debounce(function(){
                if(validateFields.includes(field)){
                    checkFieldUnique(field, $el.val().trim());
                }
            }, 350);

            $el.on('input change', function(){
                if(!touched[field]) touched[field] = true;

                const val = $el.val().trim();
                if(!val){
                    clearFieldMessage(field);
                    return;
                }

                // clear previous green message while typing
                const $errEl = $('#'+field+'_error');
                if($errEl.length) $errEl.removeClass('field-success').text('');
                $el.removeClass('is-valid is-invalid');

                // quick email format check
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

            // initial server check on modal open for prefilled values:
            // show only errors (taken) on load; successes won't show until user types
            $el.on('focus', function(){
                const initial = $el.val() ? $el.val().trim() : '';
                if(initial && validateFields.includes(field)){
                    // Do not mark field as touched yet, so success will be silent
                    setTimeout(()=> checkFieldUnique(field, initial), 250);
                }
            });
        });

        // final safeguard on submit: block if any invalid
        $form.on('submit', function(e){
            const hasError = Object.values(errors).some(v => v === true);
            if(hasError){
                e.preventDefault();
                const first = Object.keys(errors).find(k => errors[k]);
                if(first){
                    const $firstEl = $form.find('[name="'+first+'"]');
                    if($firstEl.length){
                        $('html,body').animate({ scrollTop: $firstEl.offset().top - 100 }, 250);
                        $firstEl.focus();
                    }
                }
                return false;
            }
            // allow submit (server must still validate)
        });

        // ensure update button state in case modal opened/closed
        $('#user_edit_modal').on('shown.bs.modal', function(){
            updateSubmitState();
        });

        $('#user_edit_modal').on('hidden.bs.modal', function(){
            clearModalValidation();
        });
    });

    // helper to update submit state from outer scope
    function updateSubmitState(){
        const hasError = Object.values(errors).some(v => v === true);
        if(hasError){
            $('#user_edit_update_btn').prop('disabled', true).addClass('btn-disabled');
        } else {
            $('#user_edit_update_btn').prop('disabled', false).removeClass('btn-disabled');
        }
    }

})(jQuery);
</script>
@endsection