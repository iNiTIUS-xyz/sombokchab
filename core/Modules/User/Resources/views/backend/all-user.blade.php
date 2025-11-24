@extends('backend.admin-master')

@section('style')
<x-media.css />
<link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
<style>
    .swal2-confirm.swal2-styled.swal2-default-outline {
        background-color: var(--danger-color) !important;
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
                            <th>{{ __('Created At') }}</th>
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
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('Enter name') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="username">
                                    {{ __('Username') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="{{ __('Username') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">
                                    {{ __('Email') }}
                                </label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="{{ __('Email') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="phone">
                                    {{ __('Phone') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="{{ __('Phone') }}">
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
                                <input type="text" class="form-control" id="zipcode" name="zipcode"
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
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
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
@endsection