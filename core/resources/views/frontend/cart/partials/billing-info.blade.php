@php
    $modal = $modal ?? false;
    $states = DB::table('states')->where('country_id', 31)->get();
    $cities = DB::table('cities')->get();
@endphp

<div class="checkout-inner mt-1">
    {{-- Hidden synced billing fields --}}
    <input type="hidden" id="full_name" name="full_name">
    <input type="hidden" id="address" name="address">
    <input type="hidden" id="zip_code" name="zip_code">
    <input type="hidden" id="country_id" name="country_id">
    <input type="hidden" id="state_id" name="state_id">
    <input type="hidden" id="city_id" name="city">
    <input type="hidden" id="phone" name="phone">
    <input type="hidden" id="email" name="email">

    <div class="checkout-contents">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4>
                    {{ __('New Shipping Address') }}
                </h4>
            </div>
        </div>
        <div class="checkout-form mt-2">
            @if ($modal)
                {{-- Shipping Address Name --}}
                <div class="single-input mt-4">
                    <label class="label-title mb-3">
                        {{ __('Shipping Address Name') }}
                    </label>
                    <input class="form--control" type="text" name="shipping_address_name"
                        value="{{ old('shipping_address_name') }}"
                        placeholder="{{ __('Enter shipping address name') }}">
                </div>

                {{-- Full Name --}}
                <div class="single-input mt-4">
                    <label class="label-title mb-3">
                        {{ __('Full Name') }}
                    </label>
                    <input class="form--control" id="modal_full_name" type="text" name="full_name"
                        value="{{ old('full_name') }}" placeholder="{{ __('Enter full name') }}">
                </div>

                {{-- Address & Postal Code --}}
                <div class="row">
                    <div class="col-md-6 mt-4">
                        <label class="label-title mb-3">
                            {{ __('Address') }}
                        </label>
                        <input class="form--control" id="modal_address" type="text" name="address"
                            value="{{ old('address') }}" placeholder="{{ __('Enter Address') }}">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label class="label-title mb-3">
                            {{ __('Postal Code') }}
                        </label>
                        <input class="form--control" id="modal_zip_code" type="text" name="zip_code"
                            value="{{ old('zip_code') }}" placeholder="{{ __('Enter Postal Code') }}">
                    </div>
                </div>

                {{-- Country / State / City --}}
                <div class="row mt-4">
                    <div class="col-md-4">
                        <label class="label-title mb-3">
                            {{ __('Country') }}
                        </label>
                        <select class="form--control" id="modal_country_id" name="country_id">
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="label-title mb-3">
                            {{ __('Province') }}
                        </label>
                        <select class="form--control" id="modal_state_id" name="state_id">
                            <option value="">
                                {{ __('Select Province') }}
                            </option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="label-title mb-3">
                            {{ __('City') }}
                        </label>
                        <select class="form--control" id="modal_city_id" name="city">
                            <option value="">
                                {{ __('Select City') }}
                            </option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Phone & Email --}}
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label class="label-title mb-3">
                            {{ __('Phone Number') }}
                        </label>
                        <input class="form--control" id="modal_phone" type="tel" name="phone"
                            value="{{ old('phone') }}" placeholder="{{ __('Enter Phone Number') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="label-title mb-3">
                            {{ __('Email Address') }}
                        </label>
                        <input class="form--control" id="modal_email" type="email" name="email"
                            value="{{ old('email') }}" placeholder="{{ __('Enter Email Address') }}">
                    </div>
                </div>

                {{-- Notes --}}
                <div class="single-input mt-4">
                    <label class="label-title mb-3">
                        {{ __('Order Notes') }}
                    </label>
                    <textarea class="form--control" name="note" id="modal_note"
                        placeholder="{{ __('Enter your note (optional)') }}">{{ old('note') }}</textarea>
                </div>

                @include('frontend.cart.partials.create-account')

                <button type="submit" class="btn btn-primary mt-4 w-100">
                    {{ __('Create Shipping Address') }}
                </button>
            @endif
        </div>
    </div>
</div>

<style>
    #address-map-container {
        width: 100%;
        height: 400px;
        position: relative;
    }

    #address-map {
        width: 100%;
        height: 100%;
    }
</style>
