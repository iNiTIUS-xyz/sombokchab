@php
    $modal = $modal ?? false;
    $states = DB::table('states')->where('country_id', !$modal && $defaultShippingAddress ? $defaultShippingAddress->country_id : 31)->get();
@endphp

<div class="checkout-inner mt-4">
    <h4 class="title"> {{ __('Billing Details') }} </h4>
    <div class="checkout-contents">
        <div class="checkout-form mt-2">
            @if ($modal)
                <div class="input-flex-item">
                    <div class="single-input mt-4">
                        <label class="label-title mb-3">
                            {{ __('Shipping Address Name') }}
                        </label>
                        <input class="form--control" type="text" name="shipping_address_name"
                            value="{{ old('shipping_address_name') ?? '' }}"
                            placeholder="{{ __('Shipping Address Name.') }}">
                    </div>
                </div>
            @endif

            <div class="input-flex-item">
                <div class="single-input mt-3">
                    <div class="input-group">
                        <span><label class="label-title mb-3"> {{ __('Full name') }} </label></span>
                        <input class="form--control" id="{{ !$modal ? 'name' : 'modal_name' }}" type="text"
                            name="full_name" 
                            value="{{ old('full_name', !$modal && $defaultShippingAddress ? $defaultShippingAddress->name : '') }}"
                            placeholder="{{ __('Enter full name') }}">
                    </div>
                </div>
            </div>

            <div class="input-flex-item">
                <div class="single-input mt-4">
                    <label class="label-title mb-3"> {{ __('Address') }} </label>
                    <input class="form--control" type="text" name="address" 
                        value="{{ old('address', !$modal && $defaultShippingAddress ? $defaultShippingAddress->address : '') }}"
                        id="{{ !$modal ? 'address' : 'modal_address' }}" 
                        placeholder="{{ __('Enter Address') }}">
                </div>
                <div class="single-input mt-4">
                    <label class="label-title mb-3"> {{ __('Postal code') }} </label>
                    <input class="form--control" type="text" name="zip_code" 
                        value="{{ old('zip_code', !$modal && $defaultShippingAddress ? $defaultShippingAddress->zip_code : '') }}"
                        id="{{ !$modal ? 'zipcode' : 'modal_zipcode' }}" 
                        placeholder="{{ __('Enter Postal code') }}">
                </div>
            </div>

            <div class="input-flex-item">
                <div class="single-input mt-4">
                    <label class="label-title mb-3"> {{ __('Country') }} </label>
                    <select @class(['form--control', 'modal-country' => !$modal]) 
                        id="{{ !$modal ? 'country_id' : 'modal_country_id' }}"
                        type="text" name="country_id">
                        @foreach ($countries as $country)
                            <option {{ (old('country_id', !$modal && $defaultShippingAddress ? $defaultShippingAddress->country_id : 0) == $country->id) ? 'selected' : '' }}
                                value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="single-input mt-4">
                    <label class="label-title mb-3"> {{ __('City') }} </label>
                    <select id="{{ !$modal ? 'state_id' : 'modal_state_id' }}" 
                        @class(['form--control select-state', 'modal-states' => !$modal])
                        type="text" name="state_id">
                        <option value="">{{ __('Select a city') }}</option>
                        @foreach ($states as $state)
                            <option {{ (old('state_id', !$modal && $defaultShippingAddress ? $defaultShippingAddress->state_id : '') == $state->id) ? 'selected' : '' }}
                                value="{{ $state->id }}">
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="single-input mt-4">
                    <label class="label-title mb-3"> {{ __('Province') }} </label>
                    <select id="{{ !$modal ? 'city_id' : 'modal_city_id' }}" 
                        @class(['form--control select-state', 'modal-cities' => !$modal])
                        type="text" name="city">
                        <option value="">{{ __('Select city first...') }}</option>
                        @if (!$modal && $defaultShippingAddress && $defaultShippingAddress->city)
                            <option {{ old('city', !$modal && $defaultShippingAddress ? $defaultShippingAddress->city : '') == $defaultShippingAddress->city ? 'selected' : '' }}
                                value="{{ $defaultShippingAddress->city }}">
                                {{ $defaultShippingAddress->city }}
                            </option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="input-flex-item">
                <div class="single-input mt-4">
                    <label class="label-title mb-3"> {{ __('Phone number') }} </label>
                    <input class="form--control" type="tel" name="phone" 
                        value="{{ old('phone', !$modal && $defaultShippingAddress ? $defaultShippingAddress->phone : '') }}"
                        id="{{ !$modal ? 'phone' : 'modal_phone' }}" 
                        placeholder="{{ __('Enter phone Number') }}">
                </div>
                <div class="single-input mt-4">
                    <label class="label-title mb-3"> {{ __('Email Address') }} </label>
                    <input class="form--control" type="text" name="email" 
                        value="{{ old('email', !$modal && $defaultShippingAddress ? $defaultShippingAddress->email : '') }}"
                        id="{{ !$modal ? 'email' : 'modal_email' }}" 
                        placeholder="{{ __('Enter email') }}">
                </div>
            </div>

            @if (!$modal)
                <div class="input-flex-item">
                    <div class="single-input mt-4">
                        <label class="label-title mb-3"> {{ __('Order Notes') }} </label>
                        <textarea class="form--control form--message" name="note" id="message"
                            placeholder="{{ __('Enter your message here') }}">{{ old('note', !$modal && $defaultShippingAddress ? $defaultShippingAddress->note : '') }}</textarea>
                    </div>
                </div>

                @include('frontend.cart.partials.create-account')
            @else
                <button class="btn btn-primary mt-3">{{ __('Create Shipping Address') }}</button>
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