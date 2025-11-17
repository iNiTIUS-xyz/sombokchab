@extends('backend.admin-master')

@section('style')

@endsection

@section('site-title', __('Create Pickup Point'))

@section('content')
    <x-error-msg />
    <x-msg.success />
    <div class="dashboard__card card__two">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title title">{{ __('Create Pickup Point') }}</h3>
            @can('manage-site-settings')
                <div class="btn-wrapper">
                    <a href="{{ route('admin.delivery-man.pickup-point.index') }}" class="cmn_btn btn_bg_profile">
                        {{ __('Pickup Point List') }}
                    </a>
                </div>
            @endcan
        </div>
        <div class="dashboard__card__body custom__form table-responsive">
            <form action="{{ route('admin.delivery-man.pickup-point.edit', $pickupPoint->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="pickup-point-name" class="mb-2">{{ __('Pickup Point Name') }} <span
                            class="text-danger">*</span> </label>
                    <input required id="pickup-point-name" name="name" value="{{ $pickupPoint->name ?? '' }}"
                        type="text" class="form-control form-control-sm"
                        placeholder="{{ __('Enter Pickup Point Name') }}" />
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pickup-point-zone-id" class="mb-2">{{ __('Select Delivery Zone') }} <span
                                    class="text-danger">*</span></label>
                            <select required id="pickup-point-zone-id" name="zone_id" class="form-control form-control-sm">
                                <option value="">{{ __('Select Delivery Man Zone') }}</option>
                                @foreach ($deliveryZones as $deliveryZone)
                                    <option {{ $deliveryZone->id == $pickupPoint->zone_id ? 'selected' : '' }}
                                        value="{{ $deliveryZone->id }}">{{ $deliveryZone->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pickup-point-vendor-id" class="mb-2">{{ __('Select Vendor') }}</label>

                            <select id="pickup-point-vendor-id" name="vendor_id" class="form-control form-control-sm">
                                <option value="">{{ __('Select Vendor') }}</option>

                                @foreach ($vendors as $vendor)
                                    <option {{ $vendor->id == $pickupPoint->vendor_id ? 'selected' : '' }}
                                        value="{{ $vendor->id }}">{{ $vendor->business_name }},
                                        <b>{{ __('Vendor Name:') }}</b> {{ $vendor->owner_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pickup-point-country-id" class="mb-2">{{ __('Select Country') }}</label>
                            <select id="pickup-point-country-id" name="country_id" class="form-control form-control-sm">
                                <option value="">{{ __('Select Country') }}</option>
                                @foreach ($countries as $country)
                                    <option {{ $country->id == $pickupPoint->country_id ? 'selected' : '' }}
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pickup-point-state-id" class="mb-2">{{ __('Select City') }}</label>
                            <select id="pickup-point-state-id" name="state_id" class="form-control form-control-sm">
                                <option value="">{{ __('Select City') }}</option>
                                @foreach ($states as $state)
                                    <option {{ $state->id == $pickupPoint->state_id ? 'selected' : '' }}
                                        value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pickup-point-city-id" class="mb-2">{{ __('Select State') }}</label>
                            <select id="pickup-point-city-id" name="city_id" type="text"
                                class="form-control form-control-sm">
                                <option value="">{{ __('Select State') }}</option>
                                @foreach ($cities as $city)
                                    <option {{ $city->id == $pickupPoint->state_id ? 'selected' : '' }}
                                        value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pickup-point-zip-code-id" class="mb-2">{{ __('Select Zip Code') }}</label>
                            <input id="pickup-point-zip-code-id" name="zip_code" value="{{ $pickupPoint->zip_code }}"
                                type="text" class="form-control form-control-sm"
                                placeholder="{{ __('Enter zip code') }}" />
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="pickup-point-contact-number" class="mb-2">{{ __('Contact Number') }} <span
                                    class="text-danger">*</span></label>
                            <input id="pickup-point-contact-number" name="contact_number"
                                value="{{ $pickupPoint->contact_number }}" type="text"
                                class="form-control form-control-sm" placeholder="{{ __('Enter contact number.') }}" />
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="pickup-point-operating-hours" class="mb-2">{{ __('Operating Hours') }} <span
                                    class="text-danger">*</span></label>
                            <input id="pickup-point-operating-hours" name="operating_hours"
                                value="{{ $pickupPoint->operating_hours }}" type="text"
                                class="form-control form-control-sm"
                                placeholder="{{ __('give a range of operating system.') }}" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pickup-point-address" class="mb-2">{{ __('Pickup point address') }} <span
                            class="text-danger">*</span></label>
                    <textarea id="pickup-point-address" type="text" name="address" class="form-control form-control-sm"
                        placeholder="{{ __('Enter pickup point address.') }}">{{ $pickupPoint->address }}
                    </textarea>
                </div>

                <div class="form-group mt-4">
                    <button class="cmn_btn btn_bg_profile" type="submit">{{ __('Create Pickup Point') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // fetch all states according to selected country
        $(document).on("change", "#pickup-point-country-id", function() {
            let country_id = $(this).val();

            // send request for fetching tax class option data
            send_ajax_request("get", '', "{{ route('country.state.info.ajax') }}?id=" + country_id, () => {}, (
                data) => {
                $("#pickup-point-state-id").html(data);
            }, (errors) => prepare_errors(errors))
        });

        // fetch all cities according to selected state
        $(document).on("change", "#pickup-point-state-id", function() {
            let state_id = $(this).val();

            // send request for fetching tax class option data
            send_ajax_request("get", '', "{{ route('state.city.info.ajax') }}?id=" + state_id, () => {}, (
            data) => {
                $("#pickup-point-city-id").html(data);
            }, (errors) => prepare_errors(errors))
        });
    </script>
@endsection
