@extends('frontend.user.dashboard.user-master')
@section('style')
    <x-loader.css />
@endsection
@section('section')
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            {{-- <h5 class="dashboard__card__title">{{ __('Edit Shipping Address') }}</h5> --}}
            {{-- <div class="btn-wrapper">
                <a href="{{ route('user.shipping.address.all') }}" class="cmn_btn btn_bg_2">{{ __('All Shipping Address') }}</a>
            </div> --}}
        </div>
        <div class="dashboard__card__body custom__form mt-4">
            <form action="{{ route('user.shipping.address.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $address->id }}">
                <div class="form-row row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label-title">
                                {{ __('Shipping Address Name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form--control" type="text" name="shipping_address_name"
                                value="{{ $address->shipping_address_name }}" required
                                placeholder="{{ __('Shipping Address Name') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">{{ __('Full Name') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ $address->name }}" placeholder="{{ __('Enter Full Name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="text" class="form-control" name="email" id="email"
                                value="{{ $address->email }}" placeholder="{{ __('Enter Email') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">{{ __('Phone Number') }}<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="phone" id="phone"
                                value="{{ $address->phone }}" placeholder="{{ __('Enter Phone Number') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">{{ __('Country') }}<span class="text-danger">*</span></label>
                            <select class="form-select" name="country" id="country" required>
                                <option value="">{{ __('Select Country') }}</option>
                                @foreach ($all_country as $country)
                                    <option value="{{ $country->id }}"
                                        {{ $address->country_id == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="state">{{ __('City') }}<span class="text-danger">*</span></label>
                            <select class="form-select" name="state" id="state">
                                <option value="">{{ __('Select City') }}</option>
                                @if ($address->state_id)
                                    <option value="{{ $address->state_id }}" selected>{{ $address->state->name ?? '' }}
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="city">{{ __('Province') }}</label>
                            <select class="form-select" name="city" id="city">
                                <option value="">{{ __('Select Province') }}</option>
                                @if ($address->city)
                                    <option value="{{ $address->city }}" selected>{{ $address->city }}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zipcode">{{ __('Postal Code') }}</label>
                            <input type="text" class="form-control" name="zipcode" id="zipcode"
                                value="{{ $address->zip_code }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="country">{{ __('Is Default') }}</label>
                            <select class="form-select" name="is_default" required>
                                <option value="1" @if ($address->is_default == 1) selected @endif>Yes</option>
                                <option value="0" @if ($address->is_default == 0) selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">{{ __('Address') }}<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" id="address" rows="3">{{ $address->address }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="btn-wrapper">
                            <button type="submit" class="cmn_btn btn_bg_1">{{ __('Save') }}</button>
                            <a href="{{ route('user.shipping.address.all') }}" class="cmn_btn default-theme-btn"
                                style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <x-loader.html />
@endsection
@section('script')
    <script>
        (function($) {
            "use strict";
            $(document).ready(function($) {
                $(document).on('click', '.bodyUser_overlay', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });

                $(document).on('click', '.mobile_nav', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });

                $('#country').on('change', function() {
                    let id = $(this).val();
                    $('.lds-ellipsis').show();

                    $.get('{{ route('country.info.ajax') }}', {
                        id: id
                    }).then(function(data) {
                        $('.lds-ellipsis').hide();
                        $('#state').html('<option value="">{{ __('Select City') }}</option>');
                        data.states.map(function(e) {
                            $('#state').append('<option value="' + e.id + '">' + e
                                .name + '</option>');
                        });
                    });
                });

                $(document).on("change", "#state", function() {
                    let country_id = $("#country").val();
                    let state_id = $("#state").val();

                    send_ajax_request("get", "",
                        `{{ route('frontend.get-tax-based-on-billing-address') }}?country_id=${country_id}&state_id=${state_id}&city_id=`,
                        () => {}, (data) => {
                            // do success action
                            $('.cart-items-wrapper').html(data.cart_items);

                            let cityhtml =
                                "<option value=''> {{ __('Select Province') }} </option>";
                            data?.cities?.forEach((city) => {
                                cityhtml += "<option value='" + city.id + "'>" + city.name +
                                    "</option>";
                            });

                            $("#city").html(cityhtml);
                        }, (errors) => {
                            prepare_errors(errors);
                        })
                });
            });
        })(jQuery);
    </script>


    <script>
        $(document).ready(function() {
            $('#name').on('blur', function() {
                var name = $(this).val();

                if (name.length > 0) {
                    $.ajax({
                        url: '{{ route('user.shipping.address.exists') }}',
                        type: 'POST',
                        data: {
                            name: name,
                            id: {{ $address->id }},
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('.name-message').remove();

                            if (response.exists) {
                                $('#name').after(
                                    '<p class="text-danger name-message">This name is already taken. Please choose another one.</p>'
                                );
                            } else {
                                $('#name').after(
                                    '<p class="text-success name-message">This name is available!</p>'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error: " + error);
                            // Handle error here, like showing a generic error message
                            $('.name-message').remove();
                            $('#name').after(
                                '<p class="text-danger name-message">An error occurred. Please try again later.</p>'
                            );
                        }
                    });
                } else {
                    $('.name-message').remove();
                }
            });
        });
    </script>
@endsection
