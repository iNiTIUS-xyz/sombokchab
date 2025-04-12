@php
    $permanentAddress = $deliveryMan->permanentAddress?->country?->address_one;
    $presentAddress = $deliveryMan->presentAddress?->country?->address_one;

    if ($deliveryMan->permanentAddress?->country?->address_two ?? false) {
        if (!empty($permanentAddress)) {
            $permanentAddress .= ', ';
        }
        $permanentAddress .= $deliveryMan->permanentAddress?->country?->address_two;
    }

    if ($deliveryMan->permanentAddress?->city?->name ?? false) {
        if (!empty($permanentAddress)) {
            $permanentAddress .= ', ';
        }
        $permanentAddress .= $deliveryMan->permanentAddress?->city?->name;
    }

    if ($deliveryMan->permanentAddress?->state?->name ?? false) {
        if (!empty($permanentAddress)) {
            $permanentAddress .= ', ';
        }
        $permanentAddress .= $deliveryMan->permanentAddress?->state?->name;
    }

    if ($deliveryMan->permanentAddress?->country?->name ?? false) {
        if (!empty($permanentAddress)) {
            $permanentAddress .= ', ';
        }
        $permanentAddress .= $deliveryMan->permanentAddress?->country?->name;
    }

    if ($deliveryMan->permanentAddress->zip_code ?? false) {
        if (!empty($permanentAddress)) {
            $permanentAddress .= ', ';
        }
        $permanentAddress .= $deliveryMan->permanentAddress->zip_code;
    }

    // those code are for present address
    if ($deliveryMan->presentAddress?->country?->address_two ?? false) {
        if (!empty($presentAddress)) {
            $presentAddress .= ', ';
        }
        $presentAddress .= $deliveryMan->presentAddress?->country?->address_two;
    }

    if ($deliveryMan->presentAddress?->city?->name ?? false) {
        if (!empty($presentAddress)) {
            $presentAddress .= ', ';
        }
        $presentAddress .= $deliveryMan->presentAddress?->city?->name;
    }

    if ($deliveryMan->presentAddress?->state?->name ?? false) {
        if (!empty($presentAddress)) {
            $presentAddress .= ', ';
        }
        $presentAddress .= $deliveryMan->presentAddress?->state?->name;
    }

    if ($deliveryMan->presentAddress?->country?->name ?? false) {
        if (!empty($presentAddress)) {
            $presentAddress .= ', ';
        }
        $presentAddress .= $deliveryMan->presentAddress?->country?->name;
    }

    if ($deliveryMan->presentAddress->zip_code ?? false) {
        if (!empty($presentAddress)) {
            $presentAddress .= ', ';
        }
        $presentAddress .= $deliveryMan->presentAddress->zip_code;
    }

    $assign = $assign ?? false;
@endphp

@if ($assign == false)
    <div class="request__item dashboard-orderInfo-item-contents-type">
        <strong>{{ __('Selected Delivery Man Info') }}</strong>
    </div>

    <hr>
@endif

<div class="request__item dashboard-orderInfo-item-contents-type">
    <span class="request__left dashboard-orderInfo-item-contents-type-left">{{ __('Name:') }}</span>

    @if ($assign === false)
        <span class="dashboard-orderInfo-item-contents-type-right">
            {{ $deliveryMan->full_name }}
        </span>
    @else
        <b>
            {{ $deliveryMan->full_name }}
        </b>
    @endif
</div>

<div class="request__item dashboard-orderInfo-item-contents-type">
    <span class="request__left dashboard-orderInfo-item-contents-type-left">{{ __('Contact Number:') }}</span>
    <span class="dashboard-orderInfo-item-contents-type-right">{{ $deliveryMan->phone }}</span>
</div>

<div class="request__item dashboard-orderInfo-item-contents-type">
    <span class="request__left dashboard-orderInfo-item-contents-type-left">{{ __('email:') }}</span>
    <span class="dashboard-orderInfo-item-contents-type-right">{{ $deliveryMan->email }}</span>
</div>

<div class="request__item dashboard-delivery-location border-top-1">
    <span>{{ __('Present Address:') }}</span>
    <a href="#1" class="dashboard-delivery-location-para">
        <i class="las la-map-marker-alt"></i>
        {{ $presentAddress }}
    </a>
</div>

<div class="request__item dashboard-delivery-location border-top-1">
    <span>{{ __('Permanent Address:') }}</span>
    <a href="#1" class="dashboard-delivery-location-para">
        <i class="las la-map-marker-alt"></i>
        {{ $permanentAddress }}
    </a>
</div>

<div class="request__item dashboard-orderInfo-item-contents-type">
    <span class="request__left dashboard-orderInfo-item-contents-type-left">{{ __('Zone:') }}</span>
    <span class="dashboard-orderInfo-item-contents-type-right">{{ $deliveryMan->zone?->name }}</span>
</div>

<div class="request__item dashboard-orderInfo-item-contents-type @if($deliveryMan->delivery_man_order_count < 1) d-none @endif">
    <span class="request__left dashboard-orderInfo-item-contents-type-left">{{ __('Total Complete Order:') }}</span>
    <span
        class="dashboard-orderInfo-item-contents-type-right">{{ $deliveryMan->delivery_man_order_count ?? '' }}</span>
</div>

<div class="request__item dashboard-orderInfo-item-contents-type @if($deliveryMan->delivery_man_queue_order_count < 0) d-none @endif">
    <span class="request__left dashboard-orderInfo-item-contents-type-left">{{ __('Total Queue Order:') }}</span>
    <span
        class="dashboard-orderInfo-item-contents-type-right">{{ $deliveryMan->delivery_man_queue_order_count ?? '' }}</span>
</div>

@if ($assign == false)
    <hr />
@endif
