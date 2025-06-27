<style>
    .user-shipping-address-item .before-hover {
        min-height: 45px !important;
        text-align: left !important;
        margin: 5px 0px;
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
    }


    .user-shipping-address-item .before-hover span{
        margin-right: 5px;
    }
    .user-shipping-address-item .before-hover span.title {
        color: var(--black) !important;
        font-weight: bold;
    }
    .user-shipping-address-item .before-hover span.checkbox {
        height: 20px !important;
        width: 20px !important;
        background: var(--white);
        border: 2px solid var(--paragraph-color);
        border-radius: 50%;
        position: relative;
    }
    .user-shipping-address-item .before-hover span.checkbox .inner {
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }
    .user-shipping-address-item .before-hover span.badge {
        background: var(--main-color-one) !important;
    }


    /* Hover + Active States */
    .user-shipping-address-item.active .before-hover,
    .user-shipping-address-item .before-hover:hover {
        color: var(--white) !important;
        border: 1px solid var(--main-color-one) !important;
        background: var(--main-color-one) !important;
    }
    
    .user-shipping-address-item.active .before-hover span.title,
    .user-shipping-address-item .before-hover:hover span.title {
        color: var(--main-color-two) !important;
        font-weight: bold;
    }
    .user-shipping-address-item.active .before-hover span.other_text,
    .user-shipping-address-item .before-hover:hover span.other_text {
        color: var(--white) !important;
    }

    /* .user-shipping-address-item .before-hover:hover span.checkbox {
        background: var(--main-color-two);
        border: 2px solid var(--white);
    } */

    .user-shipping-address-item.active .before-hover span.checkbox,
    .user-shipping-address-item .before-hover:hover span.checkbox {
        border: 2px solid var(--white);
    }

    .user-shipping-address-item.active .before-hover span.checkbox .inner,
    .user-shipping-address-item .before-hover:hover span.checkbox .inner {
        background: var(--main-color-two) !important; /* Yellow circle */
        border: 2px solid var(--main-color-one) !important; /* White border */
        margin-bottom: 2px;
    }

    .user-shipping-address-item.active .before-hover span.badge,
    .user-shipping-address-item .before-hover:hover span.badge {
        background: var(--main-color-two) !important;
        color: var(--black) !important;
    }

/* 

    .user-shipping-address-item.active .before-hover {
        color: var(--white) !important;
        border: 1px solid var(--main-color-one) !important;
        background: var(--main-color-one) !important;
    }
    
    .user-shipping-address-item.active .before-hover span.title {
        color: var(--main-color-two) !important;
    }
    .user-shipping-address-item.active .before-hover span.other_text {
        color: var(--white) !important;
    }

    .user-shipping-address-item.active .before-hover span.badge {
        background: var(--white) !important;
        color: var(--main-color-one) !important;
    }

    .user-shipping-address-item.active .before-hover span.checkbox {
        border: 2px solid var(--white);
    }

    .user-shipping-address-item.active .before-hover span.checkbox .inner {
        background: var(--main-color-two) !important; 
        border: 2px solid var(--main-color-one) !important; 
        margin-bottom: 2px;
    } */

</style>

@php
    $isDefault = $shipping_address->is_default ?? false;
@endphp

    <li class="user-shipping-address-item @if ($isDefault) active @endif" data-name="{{ $shipping_address->name }}"
        data-email="{{ $shipping_address->email }}" data-address="{{ $shipping_address->address }}"
        data-country="{{ $shipping_address->country_id }}" data-state="{{ $shipping_address->state_id }}"
        data-city="{{ $shipping_address->city }}" data-phone="{{ $shipping_address->phone }}"
        data-zipcode="{{ $shipping_address->zip_code }}"
        data-states="{{ json_encode($shipping_address?->get_states?->toArray() ?? []) }}"
        data-cities="{{ json_encode($shipping_address?->get_cities?->toArray() ?? []) }}"
        data-country-tax="{{ json_encode($shipping_address?->country_taxs?->toArray() ?? []) }}"
        data-state-tax="{{ json_encode($shipping_address?->state_taxs?->toArray() ?? []) }}">
        <div class="before-hover btn btn-outline-secondary" style="margin-right: 10px; width: 100%;">
            <span class="checkbox">
                <span class="inner"></span>
            </span>

            <span class="title">
                {{ $shipping_address->shipping_address_name ?? $shipping_address->name }}
                
            </span>
            <span class="other_text">( {{ $shipping_address->address }};</span> 
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