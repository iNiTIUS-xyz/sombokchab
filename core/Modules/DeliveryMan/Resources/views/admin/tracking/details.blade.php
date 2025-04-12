<div class="dashboard-timeTracking">
    <div class="dashboard-timeTracking--item radius-10">
        <div class="dashboard-timeTracking--details--flex">
            <div class="dashboard-timeTracking--details--author">
                <div class="dashboard-timeTracking--details--author--flex">
                    <div class="dashboard-timeTracking--details--author--thumb">
                        {!! render_image($order->deliveryMan?->profile_img, custom_path: \Modules\DeliveryMan\Services\AdminDeliveryManServices::IMAGE_DIRECTORY) !!}
                    </div>
                    <div class="dashboard-timeTracking--details--author--contents">
                        <h6 class="dashboard-timeTracking--details--author--contents--title">{{ $order->deliveryMan?->full_name }}</h6>
                    </div>
                </div>
            </div>
            <span class="status_btn completed radius-5">{{__("Contact")}}</span>
        </div>
        <div class="dashboard-timeTracking--item--details border-top-1">
            <span class="dashboard-timeTracking--item--details--oderId mb-3">{{ __("Order Id") }} <strong>{{ $order->order_id }}</strong></span>
            <div class="dashboard-timeTracking--item--details--contact">
                <div class="dashboard-timeTracking--item--details--contact--item">
                    <span class="dashboard-timeTracking--item--details--contact--item--icon"><i class="las la-envelope"></i></span>
                    <a href="{{ $order->deliveryMan?->email }}" class="dashboard-timeTracking--item--details--contact--item--para">{{ $order->deliveryMan?->email }}</a>
                </div>
                <div class="dashboard-timeTracking--item--details--contact--item">
                    <span class="dashboard-timeTracking--item--details--contact--item--icon"><i class="las la-phone"></i></span>
                    <a href="tel:{{ $order->deliveryMan?->phone }}" class="dashboard-timeTracking--item--details--contact--item--para">{{ $order->deliveryMan?->phone }}</a>
                </div>
                <div class="dashboard-timeTracking--item--details--contact--item">
                    <span class="dashboard-timeTracking--item--details--contact--item--icon"><i class="las la-map-marker-alt"></i></span>
                    <p class="dashboard-timeTracking--item--details--contact--item--para">{{ $deliveryManAddress }}</p>
                </div>
            </div>
        </div>
        <div class="dashboard-timeTracking--item--location border-top-1">
            <div class="dashboard-timeTracking--item--location--single">
                <div class="dashboard-timeTracking--item--location--single--flex">
                    <div class="dashboard-timeTracking--item--location--single--left">
                        <span class="dashboard-timeTracking--item--location--single--icon"><i class="las la-map-marker-alt"></i></span>
                    </div>
                    <div class="dashboard-timeTracking--item--location--single--right">
                        <span class="dashboard-timeTracking--item--location--single--para">{{ __("From") }}</span>
                        <h6 class="dashboard-timeTracking--item--location--single--title">{{ $pickupPointAddress }}</h6>
                    </div>
                </div>
            </div>
            <div class="dashboard-timeTracking--item--location--single">
                <div class="dashboard-timeTracking--item--location--single--flex">
                    <div class="dashboard-timeTracking--item--location--single--left">
                        <span class="dashboard-timeTracking--item--location--single--icon"><i class="las la-map-marker-alt"></i></span>
                    </div>
                    <div class="dashboard-timeTracking--item--location--single--right">
                        <span class="dashboard-timeTracking--item--location--single--para">{{ __("To") }}</span>
                        <h6 class="dashboard-timeTracking--item--location--single--title">{{ $deliveryOrderAddress }}</h6>
                    </div>
                </div>
            </div>
            <div class="dashboard-timeTracking--item--location--time mt-4">
                @php
                    $readyForPickup = $order->orderTrack->where("name","ready_for_pickup")->first();
                @endphp

                @if(!empty($readyForPickup))
                    <span class="tracking-time-para">{{ __("Departure time at") }} {{ $readyForPickup->created_at->format("d F Y H:i:A") }}</span>
                @endif
                <span class="tracking-time-para">{{ __("Arrival time at") }} {{ \Carbon\Carbon::parse($order->delivery_date)->format("d F Y H:i:A") }}</span>
            </div>
        </div>
        <div class="dashboard-timeTracking--details--flex border-top-1">
            <div class="dashboard-timeTracking--details--author">
                <div class="dashboard-timeTracking--details--author--flex">
                    <div class="dashboard-timeTracking--details--author--thumb">
                        <img src="assets/img/delivery-man/dm1.png" alt="">
                    </div>
                    <div class="dashboard-timeTracking--details--author--contents">
                        <h6 class="dashboard-timeTracking--details--author--contents--title">{{ $order->order?->address?->name ?? '' }}</h6>
{{--                        <span class="dashboard-timeTracking--details--author--contents--para">5 of 10</span>--}}
                    </div>
                </div>
            </div>
            <span class="status_btn completed radius-5">{{ __("Contact") }}</span>
        </div>
        <div class="dashboard-timeTracking--item--details border-top-1">
            <div class="dashboard-timeTracking--item--details--contact">
                <div class="dashboard-timeTracking--item--details--contact--item">
                    <span class="dashboard-timeTracking--item--details--contact--item--icon"><i class="las la-envelope"></i></span>
                    <a href="{{ $order->order?->address?->email }}" class="dashboard-timeTracking--item--details--contact--item--para">{{ $order->order?->address?->email }}</a>
                </div>
                <div class="dashboard-timeTracking--item--details--contact--item">
                    <span class="dashboard-timeTracking--item--details--contact--item--icon"><i class="las la-phone"></i></span>
                    <a href="tel:{{ $order->order?->address?->phone }}" class="dashboard-timeTracking--item--details--contact--item--para">{{ $order->order?->address?->phone }}</a>
                </div>
                <div class="dashboard-timeTracking--item--details--contact--item">
                    <span class="dashboard-timeTracking--item--details--contact--item--icon"><i class="las la-map-marker-alt"></i></span>
                    <p class="dashboard-timeTracking--item--details--contact--item--para">{{ $deliveryOrderAddress }}</p>
                </div>
            </div>
        </div>
    </div>
</div>