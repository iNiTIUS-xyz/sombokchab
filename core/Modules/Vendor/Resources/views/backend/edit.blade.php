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
                        <form id="vendor-create-form" data-action-url="{{ route('admin.vendor.edit', $vendor->id) }}">
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
                                                            class="form--control radius-10"
                                                            value="{{ $vendor->owner_name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Business Name') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input name="business_name" type="text"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Enter business name') }}"
                                                            value="{{ $vendor->business_name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Username') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input name="username" type="text"
                                                            placeholder="{{ __('Enter username') }}"
                                                            class="form--control radius-10"
                                                            value="{{ $vendor->username }}">
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Email') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input name="email" type="text"
                                                            placeholder="{{ __('Enter email') }}"
                                                            class="form--control radius-10" value="{{ $vendor->email }}">
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
                                                                name="country_id">
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
                                                            {{ __('Province') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="nice-select-two state_wrapper">
                                                            <select class="form-control" id="state_id" name="state_id">
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
                                                            {{ __('City') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="nice-select-two city_wrapper">
                                                            <select id="city_id" name="city_id" class="form-control">
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
                                                            {{ __('Postal Code') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="zip_code"
                                                            class="form--control radius-10"
                                                            value="{{ $vendor?->vendor_address?->zip_code }}">
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
                                                        <input value="{{ $vendor?->phone }}" name="number"
                                                            type="tel" class="form--control radius-10"
                                                            placeholder="{{ __('Enter Number') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Email') }}
                                                        </label>
                                                        <input value="{{ $vendor?->vendor_shop_info?->email }}"
                                                            type="text" name="shop_email"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Enter email') }}">
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
                                                                    class="form-control"
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
                                                                    class="form-control"
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
                                                                    class="form-control"
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
                                                                    class="form-control"
                                                                    value="{{ $vendor?->vendor_shop_info?->colors['store_paragraph_color'] ?? '' }}"
                                                                    id="store_paragraph_color">
                                                                <small>{{ __('you can change site paragraph color from there') }}</small>
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
                                                            name="bank_name" type="text"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Enter name') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Email') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input value="{{ $vendor?->vendor_bank_info?->bank_email }}"
                                                            name="bank_email" type="text"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Enter email') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Bank Code') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input value="{{ $vendor?->vendor_bank_info?->bank_code }}"
                                                            name="bank_code" type="tel"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Enter bank code') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="label-title color-light mb-2">
                                                            {{ __('Account Number') }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input value="{{ $vendor?->vendor_bank_info?->account_number }}"
                                                            name="account_number" type="tel"
                                                            class="form--control radius-10"
                                                            placeholder="{{ __('Enter account number') }}">
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
