@extends('backend.admin-master')

@section('site-title')
{{ __('Add New Ticket') }}
@endsection

@section('style')
<style>
    .switch-field {
        display: flex;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .switch-field input {
        position: absolute !important;
        clip: rect(0, 0, 0, 0);
        height: 1px;
        width: 1px;
        border: 0;
        overflow: hidden;
    }

    .switch-field label {
        background-color: #e4e4e4;
        color: rgba(0, 0, 0, 0.6);
        font-size: 14px;
        line-height: 1;
        text-align: center;
        padding: 8px 16px;
        margin-right: -1px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        transition: all 0.1s ease-in-out;
    }

    .switch-field label:hover {
        cursor: pointer;
    }

    .switch-field input:checked+label {
        background-color: var(--main-color-one);
        color: #fff;
        box-shadow: none;
    }

    .switch-field label:first-of-type {
        border-radius: 4px 0 0 4px;
    }

    .switch-field label:last-of-type {
        border-radius: 0 4px 4px 0;
    }
</style>
@endsection

@section('content')
<div class="col-lg-12 col-ml-12">
    <div class="row">
        <div class="col-12">
            {{--
            <x-msg.flash />
            <x-msg.error /> --}}
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title">
                        {{ __('Add New Ticket') }}
                    </h4>
                </div>
                <div class="dashboard__card__body custom__form mt-4">
                    <form action="{{ route('admin.support.ticket.new') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>
                                        {{ __('Title') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="title"
                                        placeholder="{{ __('Enter title') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>{{ __('Subject') }}</label>
                                    <input type="text" class="form-control" name="subject"
                                        placeholder="{{ __('Enter subject') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>
                                        {{ __('Priority') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="priority" class="form-select">
                                        <option value="low">{{ __('Low') }}</option>
                                        <option value="medium">{{ __('Medium') }}</option>
                                        <option value="high">{{ __('High') }}</option>
                                        <option value="urgent">{{ __('Urgent') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>
                                        {{ __('Departments') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="departments" class="form-select">
                                        @foreach ($departments as $dep)
                                        <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>{{ __('Select User Type') }} <span class="text-danger">*</span></label>
                                    <div class="switch-field">
                                        <input type="radio" id="switch_customer" name="user_type" value="customer"
                                            checked="checked" />
                                        <label for="switch_customer">{{ __('Customer') }}</label>
                                        <input type="radio" id="switch_vendor" name="user_type" value="vendor" />
                                        <label for="switch_vendor">{{ __('Vendor') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" id="customer_field">
                                <div class="form-group">
                                    <label>
                                        {{ __('Customer') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="user_id" id="user_id"
                                        class="form-control select2 customer_select wide">
                                        <option value="">{{ __('Select Customer') }}</option>
                                        @foreach ($all_users as $user)
                                        <option value="{{ $user->id }}">{{ $user->username }} ( {{ $user->phone }} )
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 d-none" id="vendor_field">
                                <div class="form-group">
                                    <label>
                                        {{ __('Vendor') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="vendor_id" id="vendor_id"
                                        class="form-control select2 vendor_select wide">
                                        <option value="">{{ __('Select Vendor') }}</option>
                                        @foreach ($all_vendors as $vendors)
                                        <option value="{{ $vendors->id }}">
                                            {{ $vendors->owner_name }} ( {{ $vendors->phone }} )
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        {{ __('Description') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="description" class="form-control" cols="30" rows="10"
                                        placeholder="{{ __('Enter description') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        @can('add-support-ticket')
                        <div class="btn-wrapper mt-4">
                            <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Add') }}</button>
                            <a href="{{ route('admin.support.ticket.all') }}" class="cmn_btn default-theme-btn"
                                style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                {{ __('Back') }}
                            </a>
                        </div>
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
    (function($) {
            "use strict";

            $(document).ready(function() {
                // Initialize Select2
                $('.select2.customer_select').select2({
                    placeholder: "{{ __('Select Customer') }}",
                });

                $('.select2.vendor_select').select2({
                    placeholder: "{{ __('Select Vendor') }}",
                });


                // Toggle between customer and vendor fields
                $('input[name="user_type"]').change(function() {
                    if ($(this).val() === 'customer') {
                        $('#customer_field').removeClass('d-none');
                        $('#vendor_field').addClass('d-none');
                        $('#vendor_id').val('').trigger('change');
                    } else {
                        $('#customer_field').addClass('d-none');
                        $('#vendor_field').removeClass('d-none');
                        $('#user_id').val('').trigger('change');
                    }
                });

                // Form validation to ensure one of them is selected
                $('form').submit(function(e) {
                    if ($('input[name="user_type"]:checked').val() === 'customer' && !$('#user_id').val()) {
                        e.preventDefault();
                        alert('Please select a customer');
                        return false;
                    }

                    if ($('input[name="user_type"]:checked').val() === 'vendor' && !$('#vendor_id').val()) {
                        e.preventDefault();
                        alert('Please select a vendor');
                        return false;
                    }
                });
            });

        })(jQuery);
</script>
@endsection