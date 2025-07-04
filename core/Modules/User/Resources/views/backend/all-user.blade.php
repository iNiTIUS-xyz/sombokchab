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
    {{ __('All Users') }}
@endsection

@section('content')
    <x-msg.error />
    <x-msg.success />

    <div class="col-12">
        <div class="btn-wrapper mb-4">
            <a href="{{ route('admin.frontend.new.user') }}" class="cmn_btn btn_bg_profile">
                Add New User
            </a>
        </div>
        <div class="dashboard__card">
            <div class="dashboard__card__header">
                <h4 class="dashboard__card__title">{{ __('All Users') }}</h4>
            </div>
            <div class="dashboard__card__body mt-4">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead class="text-capitalize">
                            <tr>
                                <th>{{ __('Serial No.') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_user as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-left">{{ $user->name }} ({{ $user->username }})</td>
                                    <td class="text-left">
                                        {{ $user->email }}
                                        @if ($user->email_verified == 1)
                                            <i class="las la-check-circle text-success"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @can('frontend-all-user-email-status')
                                            <form action="{{ route('admin.all.frontend.user.email.status') }}" method="post"
                                                style="display: inline">
                                                @csrf
                                                <input type="hidden" value="{{ $user->id }}" name="user_id">
                                                <input type="hidden" value="{{ $user->email_verified }}" name="email_verified">
                                                @if ($user->email_verified == 1)
                                                    <button type="submit" class="btn btn-sm btn-xs mb-2 me-1 btn-success"
                                                        title="{{ __('Enable Email Verif') }}">
                                                        <i class="ti-email"></i>
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-sm btn-xs mb-2 me-1 btn-dark"
                                                        title="{{ __('Disable Email Verify') }}">
                                                        <i class="ti-email"></i>
                                                    </button>
                                                @endif
                                            </form>
                                        @endcan

                                        @can('frontend-user-password-change')
                                            <a href="#" data-id="{{ $user->id }}" data-bs-toggle="modal"
                                                data-bs-target="#user_change_password_modal"
                                                class="btn btn-secondary btn-sm mb-2 me-1 user_change_password_btn"
                                                title="Change Password">
                                                <i class="ti-unlock"></i>
                                            </a>
                                        @endcan

                                        @can('frontend-user-update')
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

                                        @can('frontend-delete-user')
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

    @can('frontend-user-update')
        <div class="modal fade" id="user_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit User Details') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.frontend.user.update') }}" id="user_edit_modal_form" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('Enter name') }}">
                            </div>
                            <div class="form-group">
                                <label for="username">{{ __('Username') }}</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="{{ __('Username') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="{{ __('Email') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="{{ __('Phone') }}">
                            </div>
                            <div class="form-group">
                                <label for="country">{{ __('Country') }}</label>
                                <select id="country" name="country" class="form-control">
                                    <option value="">{{ __('Select Country') }}</option>
                                    @foreach ($country as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">{{ __('City') }}</label>
                                <select id="city_id" name="city" class="form-control">
                                    <option value="">{{ __('Select City') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="state">{{ __('Province') }}</label>
                                <select id="state_id" name="state" class="form-control">
                                    <option value="">{{ __('Select province') }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="zipcode">{{ __('Postal Code') }}</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode"
                                    placeholder="{{ __('Postal Code') }}">
                            </div>
                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="{{ __('Address') }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('frontend-user-password-change')
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
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="{{ __('Enter Password') }}">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="{{ __('Confirm Password') }}">
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
    {{-- <x-datatable.js /> --}}
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    <x-media.js />

    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                // Initialize modals
                var userEditModal = new bootstrap.Modal(document.getElementById('user_edit_modal'));
                var passwordChangeModal = new bootstrap.Modal(document.getElementById(
                    'user_change_password_modal'));

                // Password change button handler
                $(document).on('click', '.user_change_password_btn', function (e) {
                    e.preventDefault();
                    var userId = $(this).data('id');
                    $('#user_password_change_modal_form').find('#ch_user_id').val(userId);
                });

                // User edit button handler
                $(document).on('click', '.user_edit_btn', function (e) {
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
                    setTimeout(function () {
                        var stateId = el.data('state');
                        if (stateId) {
                            form.find('#state_id').val(stateId).trigger('change');
                        }

                        // After another delay (to allow cities to load), set the city
                        setTimeout(function () {
                            var cityId = el.data('city');
                            if (cityId) {
                                form.find('#city_id').val(cityId);
                            }
                        }, 500);
                    }, 500);
                });


                $(document).on("change", "#country", function () {
                    var countryId = $(this).val();
                    var stateSelect = $("#state_id");

                    if (!countryId) {
                        stateSelect.html('<option value="">{{ __('Select State') }}</option>');
                        return;
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.vendor.get.state') }}",
                        data: {
                            country_id: countryId,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            console.log(response); // For debugging

                            // First clear the current options
                            stateSelect.html(
                                '<option value="">{{ __('Select State') }}</option>');

                            // Check if response has the pre-formatted options
                            if (response.success && response.option) {
                                // Directly append the pre-formatted options
                                stateSelect.append(response.option);

                                // If you need to select a specific value after loading
                                // var selectedStateId = stateSelect.attr('data-state-id');
                                // if (selectedStateId) {
                                //     stateSelect.val(selectedStateId);
                                // }
                            }
                        },
                        error: function (xhr) {
                            console.error(xhr.responseText);
                            stateSelect.html(
                                '<option value="">{{ __('Error loading states') }}</option>'
                            );
                        }
                    });
                });

                $(document).on("change", "#state_id", function () {
                    var stateId = $(this).val();
                    var countryId = $("#country").val();
                    var citySelect = $("#city_id");

                    if (!stateId || !countryId) {
                        citySelect.html('<option value="">{{ __('Select City') }}</option>');
                        return;
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.vendor.get.city') }}",
                        data: {
                            country_id: countryId,
                            state_id: stateId,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            console.log(response); // For debugging

                            // First clear the current options
                            citySelect.html(
                                '<option value="">{{ __('Select City') }}</option>');

                            // Check if response has the pre-formatted options
                            if (response.success && response.option) {
                                // Directly append the pre-formatted options
                                citySelect.append(response.option);

                                // If you need to select a specific value after loading
                                // var selectedCityId = citySelect.attr('data-city-id');
                                // if (selectedCityId) {
                                //     citySelect.val(selectedCityId);
                                // }
                            }
                        },
                        error: function (xhr) {
                            console.error(xhr.responseText);
                            citySelect.html(
                                '<option value="">{{ __('Error loading cities') }}</option>'
                            );
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endsection