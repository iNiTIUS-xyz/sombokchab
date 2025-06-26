{{-- <style>
    .user-shipping-address-item .before-hover{
        min-height: 100px !important;
    }
    .user-shipping-address-item .before-hover p span{
        height: 20px !important;
        width: 20px !important;
        background: var(--white);
        border: 2px solid var(--paragraph-color);
        border-radius: 50%;
    }
    

    .user-shipping-address-item .before-hover h6 .badge{
         background: var(--main-color-one) !important;
    }

    .user-shipping-address-item .before-hover:hover{
        color: var(--white) !important;
        border: 1px solid var(--main-color-one) !important;
        background: var(--main-color-one) !important;
    }
    
    .user-shipping-address-item .before-hover:hover h6{
        color: var(--main-color-two) !important;
    }
    .user-shipping-address-item .before-hover:hover p{
        color: var(--white) !important;
    }

    .user-shipping-address-item .before-hover:hover p span{
        background: var(--main-color-two);
        border: 2px solid var(--white);
    }

    .user-shipping-address-item .before-hover:hover h6 .badge{
         background: var(--main-color-two) !important;
    }


    .user-shipping-address-item.active .before-hover{
        color: var(--white) !important;
        border: 1px solid var(--main-color-one) !important;
        background: var(--main-color-one) !important;
    }
    
    .user-shipping-address-item.active .before-hover h6{
        color: var(--main-color-two) !important;
    }
    .user-shipping-address-item.active .before-hover p{
        color: var(--white) !important;
    }

    .user-shipping-address-item.active .before-hover h6 .badge{
        background: var(--white) !important;
        color: var(--main-color-one) !important;
    }

    .user-shipping-address-item.active .before-hover p span{
        background: var(--main-color-two);
        border: 2px solid var(--white);
    }

</style> --}}

<style>
    .user-shipping-address-item .before-hover {
        min-height: 40px !important;
        text-align: left !important;
        margin: 5px 0px;
    }
    .user-shipping-address-item .before-hover span.checkbox {
        height: 20px !important;
        width: 20px !important;
        background: var(--white);
        border: 2px solid var(--paragraph-color);
        border-radius: 50%;
        position: relative;
    }

    .user-shipping-address-item .before-hover span.badge {
        background: var(--main-color-one) !important;
    }

    .user-shipping-address-item .before-hover:hover {
        color: var(--white) !important;
        border: 1px solid var(--main-color-one) !important;
        background: var(--main-color-one) !important;
    }
    
    .user-shipping-address-item .before-hover:hover span.title {
        color: var(--main-color-two) !important;
        font-weight: bold;
    }
    .user-shipping-address-item .before-hover:hover span.other_text {
        color: var(--white) !important;
    }

    .user-shipping-address-item .before-hover:hover span.checkbox {
        background: var(--main-color-two);
        border: 2px solid var(--white);
    }

    .user-shipping-address-item .before-hover:hover span.badge {
        background: var(--main-color-two) !important;
    }

    .user-shipping-address-item.active .before-hover {
        color: var(--white) !important;
        border: 1px solid var(--main-color-one) !important; /* Dark green border */
        background: var(--main-color-one) !important; /* Dark green background */
    }
    
    .user-shipping-address-item.active .before-hover span.title {
        color: var(--main-color-two) !important;
    }
    .user-shipping-address-item.active .before-hover span.other_text {
        color: var(--white) !important;
    }

    .user-shipping-address-item.active .before-hover span.badge {
        background: var(--white) !important;
        color: var(--main-color-one) !important; /* Match the green background */
    }

    .user-shipping-address-item.active .before-hover span.checkbox {
        background: var(--main-color-two) !important; /* Yellow circle */
        border: 2px solid var(--white) !important; /* White border */
        position: relative;
    }

    .user-shipping-address-item.active .before-hover span.checkbox::after {
        content: '';
        width: 12px;
        height: 12px;
        background: var(--main-color-two); /* Yellow fill */
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

@php
    $isDefault = $shipping_address->is_default ?? false;
@endphp

<li class="">
    <div class="user-shipping-address-item @if ($isDefault) active @endif" data-name="{{ $shipping_address->name }}"
        data-email="{{ $shipping_address->email }}" data-address="{{ $shipping_address->address }}"
        data-country="{{ $shipping_address->country_id }}" data-state="{{ $shipping_address->state_id }}"
        data-city="{{ $shipping_address->city }}" data-phone="{{ $shipping_address->phone }}"
        data-zipcode="{{ $shipping_address->zip_code }}"
        data-states="{{ json_encode($shipping_address?->get_states?->toArray() ?? []) }}"
        data-cities="{{ json_encode($shipping_address?->get_cities?->toArray() ?? []) }}"
        data-country-tax="{{ json_encode($shipping_address?->country_taxs?->toArray() ?? []) }}"
        data-state-tax="{{ json_encode($shipping_address?->state_taxs?->toArray() ?? []) }}">
        <div class="before-hover btn btn-outline-secondary" style="margin-right: 10px; width: 100%;">
            <span class="checkbox"></span>

            <span class="title">
                {{ $shipping_address->shipping_address_name ?? $shipping_address->name }}
                
            </span>
            <span class="other_text">( {{ $shipping_address->address }}</span>; 
            <span class="other_text">{{ $shipping_address->phone }} )</span>  
            
            @if ($isDefault)
                <span class="badge">Default</span>
            @endif
        </div>

        <div class="after-hover position-absolute top-0 bg-color-one text-light d-none">
            <p>{{ __('Shipping Address Name') }}: <b>{{ $shipping_address->shipping_address_name }}</b></p>
            <p>{{ __('Name') }}: <b>{{ $shipping_address->name }}</b></p>
            <p>{{ __('Email') }}: <b>{{ $shipping_address->email }}</b></p>
            <p>{{ __('Address') }}: <b>{{ $shipping_address->address }}</b></p>
            <p>{{ __('Country') }}: <b>{{ $shipping_address?->country?->name }}</b></p>
            <p>{{ __('State') }}: <b>{{ $shipping_address?->state?->name }}</b></p>
            <p>{{ __('City') }}: <b>{{ $shipping_address?->cities?->name }}</b></p>
            <p>{{ __('Mobile') }}: <b>{{ $shipping_address->phone }}</b></p>
            <p>{{ __('Zip Code') }}: <b>{{ $shipping_address->zip_code }}</b></p>
        </div>
    </div>
</li>




{{-- <div class="user-shipping-address-item {{ $isDefault ? 'active' : '' }}"
     data-name="{{ $shipping_address->name }}"
     data-email="{{ $shipping_address->email }}"
     data-address="{{ $shipping_address->address }}"
     data-phone="{{ $shipping_address->phone }}"
     data-zipcode="{{ $shipping_address->zip_code }}"
     data-country="{{ $shipping_address->country_id }}"
     data-state="{{ $shipping_address->state_id }}"
     data-city="{{ $shipping_address->city_id }}"
     data-states="{{ json_encode(\DB::table('states')->where('country_id', $shipping_address->country_id)->get()) }}"
     data-cities="{{ json_encode(\DB::table('cities')->where('state_id', $shipping_address->state_id)->get()) }}"
     data-country-tax="{{ json_encode(['tax_amount' => $shipping_address->tax_amount ?? 0]) }}"
     data-state-tax="{{ json_encode(['tax_amount' => $shipping_address->tax_amount ?? 0]) }}">
    <div class="user-address-content">
        <h6 class="title">{{ $shipping_address->name }}</h6>
        <p>{{ $shipping_address->address }}</p>
        <p>{{ $shipping_address->phone }}</p>
        <p>{{ $shipping_address->email }}</p>
        <p>{{ $shipping_address->zip_code }}</p>
        @if ($isDefault)
            <span class="badge bg-success">Default</span>
        @endif
    </div>
    <div class="btn-wrapper">
        <button type="button" class="btn btn-outline-primary btn-sm">{{ __('Select') }}</button>
    </div>
</div> --}}