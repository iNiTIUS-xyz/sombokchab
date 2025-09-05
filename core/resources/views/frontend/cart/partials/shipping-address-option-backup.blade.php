{{-- new desing  --}}
{{-- <style>
    .shipping-address-card {
        border: 2px solid #ddd;
        border-radius: 6px;
        padding: 12px 15px;
        background: #fff;
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 1.5;
        position: relative;
        width: 100%;
        cursor: pointer;
        transition: border-color 0.2s;
    }

    .user-shipping-address-item.active .shipping-address-card {
        border-color: #28a745;
    }

    .shipping-address-card .change-link {
        position: absolute;
        top: 10px;
        right: 12px;
        font-size: 13px;
        color: #0073bb;
        text-decoration: none;
    }

    .shipping-address-card .change-link:hover {
        text-decoration: underline;
    }

    .shipping-address-card p {
        margin: 0;
    }

    .shipping-address-card .instructions {
        color: #0073bb;
        font-size: 13px;
        margin-top: 4px;
        cursor: pointer;
    }

    .shipping-address-card .pickup-info {
        margin-top: 8px;
        font-size: 13px;
        color: #555;
    }

    .shipping-address-card .pickup-info a {
        color: #0073bb;
        text-decoration: none;
    }

    .shipping-address-card .pickup-info a:hover {
        text-decoration: underline;
    }

    .shipping-address-card .badge {
        background: #ffce00;
        color: #000;
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 4px;
        margin-left: 5px;
    }
</style>

@php
    $isDefault = $shipping_address->is_default ?? false;
@endphp

<li class="user-shipping-address-item @if ($isDefault) active @endif"
    data-name="{{ $shipping_address->name }}" data-email="{{ $shipping_address->email }}"
    data-address="{{ $shipping_address->address }}" data-country="{{ $shipping_address->country_id }}"
    data-state="{{ $shipping_address->state_id }}" data-city="{{ $shipping_address->city }}"
    data-phone="{{ $shipping_address->phone }}" data-zipcode="{{ $shipping_address->zip_code }}"
    data-states="{{ json_encode($shipping_address?->get_states?->toArray() ?? []) }}"
    data-cities="{{ json_encode($shipping_address?->get_cities?->toArray() ?? []) }}"
    data-country-tax="{{ json_encode($shipping_address?->country_taxs?->toArray() ?? []) }}"
    data-state-tax="{{ json_encode($shipping_address?->state_taxs?->toArray() ?? []) }}">

    <div class="shipping-address-card">
        <p><strong>{{ $shipping_address->shipping_address_name ?? $shipping_address->name }}</strong>
            @if ($isDefault)
                <span class="badge">Default</span>
            @endif
        </p>
        <p>{{ $shipping_address->address }}</p>
        <p>{{ $shipping_address->city }}, {{ $shipping_address->state?->name }} {{ $shipping_address->zip_code }}</p>
        <p>{{ $shipping_address->country?->name }}</p>
    </div>
</li>

<script>
    document.querySelectorAll('.user-shipping-address-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.user-shipping-address-item').forEach(i => i.classList.remove(
                'active'));
            this.classList.add('active');
        });
    });
</script> --}}


<style>
    .user-shipping-address-item .before-hover {
        min-height: 45px !important;
        text-align: left !important;
        margin: 5px 0px;
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
    }


    .user-shipping-address-item .before-hover span {
        margin-right: 5px;
    }

    .user-shipping-address-item .before-hover p.title {
        color: var(--black) !important;
        font-weight: bold;
    }
    
    .user-shipping-address-item .before-hover p.other_text {
        color: var(--paragraph-color) !important;
        font-size: 0.6em;
    }

    .user-shipping-address-item .before-hover p.checkbox {
        height: 20px !important;
        width: 20px !important;
        background: var(--white);
        border: 2px solid var(--paragraph-color);
        border-radius: 50%;
        position: relative;
    }

    .user-shipping-address-item .before-hover p.checkbox .inner {
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .user-shipping-address-item .before-hover span.badge {
        background: var(--black) !important;
    }


    /* Hover + Active States */
    .user-shipping-address-item.active .before-hover,
    .user-shipping-address-item .before-hover:hover {
        /* color: var(--paragraph-color) !important; */
        border: 1px solid var(--main-color-one) !important;
        background: transparent !important;
    }

    .user-shipping-address-item.active .before-hover p.title,
    .user-shipping-address-item .before-hover:hover p.title {
        color: var(--main-color-one) !important;
        font-weight: bold;
    }

    .user-shipping-address-item.active .before-hover p.other_text,
    .user-shipping-address-item .before-hover:hover p.other_text {
        color: var(--paragraph-color) !important;
    }

    .user-shipping-address-item .before-hover:hover p.checkbox {
        background: var(--main-color-two);
        border: 2px solid var(--white);
    }

    .user-shipping-address-item.active .before-hover p.checkbox,
    .user-shipping-address-item .before-hover:hover p.checkbox {
        border: 2px solid var(--white);
    }

    .user-shipping-address-item.active .before-hover p.checkbox .inner,
    .user-shipping-address-item .before-hover:hover p.checkbox .inner {
        background: var(--main-color-two) !important;
        /* Yellow circle */
        border: 2px solid var(--main-color-one) !important;
        /* White border */
        margin-bottom: 2px;
    }

    .user-shipping-address-item.active .before-hover span.badge,
    .user-shipping-address-item .before-hover:hover span.badge {
        background: var(--main-color-one) !important;
        color: var(--white) !important;
    }
</style>

@php
    $isDefault = $shipping_address->is_default ?? false;
@endphp

<div class="user-shipping-address-item mt-3 @if ($isDefault) active @endif"
    data-name="{{ $shipping_address->name }}" data-email="{{ $shipping_address->email }}"
    data-address="{{ $shipping_address->address }}" data-country="{{ $shipping_address->country_id }}"
    data-state="{{ $shipping_address->state_id }}" data-city="{{ $shipping_address->city }}"
    data-phone="{{ $shipping_address->phone }}" data-zipcode="{{ $shipping_address->zip_code }}"
    data-states="{{ json_encode($shipping_address?->get_states?->toArray() ?? []) }}"
    data-cities="{{ json_encode($shipping_address?->get_cities?->toArray() ?? []) }}"
    data-country-tax="{{ json_encode($shipping_address?->country_taxs?->toArray() ?? []) }}"
    data-state-tax="{{ json_encode($shipping_address?->state_taxs?->toArray() ?? []) }}">
    <div class="before-hover btn btn-outline-secondary" style="margin-right: 10px; width: 100%;">
        <span class="inner"></span>
        <span class="title">
          <b>{{ $shipping_address->shipping_address_name ?? $shipping_address->name }}</b>  
        </span>
        (<span class="other_text">{{ $shipping_address->phone }}</span>)
        &nbsp;-&nbsp; 
        <span class="other_text">{{ $shipping_address->address }}</span>
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
