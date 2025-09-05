
@php
    $isDefault = $shipping_address->is_default ?? false;
@endphp

<label class="option-card">
    <input
        type="radio"
        name="shipping_address_id"
        value="{{ $shipping_address->id }}"
        class="option-input"
        @checked($isDefault)
    />

    <span class="option-radio" aria-hidden="true"></span>

    <span class="option-text">
        <span class="option-title">
        {{ $shipping_address->shipping_address_name ?? $shipping_address->name }}
        </span>
        <span class="option-sub">
        ({{ $shipping_address->phone }}) - {{ $shipping_address->address }}
        @if ($isDefault)
            <span class="option-badge">Default</span>
        @endif
        </span>
    </span>
</label>

<!-- Keep the rich details hidden if you still want them -->
<div class="visually-hidden"
    data-name="{{ $shipping_address->name }}"
    data-email="{{ $shipping_address->email }}"
    data-address="{{ $shipping_address->address }}"
    data-country="{{ $shipping_address->country_id }}"
    data-state="{{ $shipping_address->state_id }}"
    data-city="{{ $shipping_address->city }}"
    data-phone="{{ $shipping_address->phone }}"
    data-zipcode="{{ $shipping_address->zip_code }}"
    data-states='@json($shipping_address?->get_states?->toArray() ?? [])'
    data-cities='@json($shipping_address?->get_cities?->toArray() ?? [])'
    data-country-tax='@json($shipping_address?->country_taxs?->toArray() ?? [])'
    data-state-tax='@json($shipping_address?->state_taxs?->toArray() ?? [])'>
</div>
