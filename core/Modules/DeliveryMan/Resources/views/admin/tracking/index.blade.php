@extends('backend.admin-master')

@section('site-title', __('Tracking Delivery Man'))

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/common/css/delivery_man.css') }}" />
@endsection

@php
    use Modules\DeliveryMan\Services\DeliveryManServices;
@endphp

@section('content')

    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <div class="dashboard__card__left">
                <h2 class="dashboard__card__title">{{ __('Real time Tracking') }}</h2>
            </div>
            <div class="dashboard__card__right">
            </div>
        </div>
        <div class="dashboard__card__body dashboard-tracking mt-4">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="dashboard-timeTracking">
                                @foreach ($ordersList as $deliveryManOrder)
                                    @php

                                        $orderTrack = $deliveryManOrder->orderTrack->first();
                                        $pickupPoint = $deliveryManOrder->pickupPoint;

                                        // check latest order track name is delivered or not. if delivered then continue
                                        $deliveryOrderAddress = DeliveryManServices::generateDeliveryOrderAddress($deliveryManOrder);
                                        $pickupPointAddress = DeliveryManServices::generatePickupPointAddress($pickupPoint);
                                    @endphp
                                    <div data-item-id="{{ $deliveryManOrder->order_id ?? '' }}"
                                        class="dashboard-timeTracking--item radius-10">
                                        <div class="dashboard-timeTracking--item--head">
                                            <div class="dashboard-timeTracking--item--head--flex">
                                                <div class="dashboard-timeTracking--item--head--left">
                                                    <span
                                                        class="dashboard-timeTracking--item--head--para">{{ __('Order Id') }}</span>
                                                    <h5 class="dashboard-timeTracking--item--id mt-1">
                                                        #{{ $deliveryManOrder->order_id }}</h5>
                                                </div>
                                                <div class="dashboard-timeTracking--item--head--right">
                                                    <span
                                                        class="status_btn completed radius-5">{{ ucwords(str_replace(['_', '-'], [' ', ''], $orderTrack->name)) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dashboard-timeTracking--item--location border-top-1">
                                            <div class="dashboard-timeTracking--item--location--single">
                                                <div class="dashboard-timeTracking--item--location--single--flex">
                                                    <div class="dashboard-timeTracking--item--location--single--left">
                                                        <span
                                                            class="dashboard-timeTracking--item--location--single--icon"><i
                                                                class="las la-map-marker-alt"></i></span>
                                                    </div>
                                                    <div class="dashboard-timeTracking--item--location--single--right">
                                                        <span
                                                            class="dashboard-timeTracking--item--location--single--para">{{ __('From') }}</span>
                                                        <h6 class="dashboard-timeTracking--item--location--single--title">
                                                            {{ $pickupPointAddress }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard-timeTracking--item--location--single">
                                                <div class="dashboard-timeTracking--item--location--single--flex">
                                                    <div class="dashboard-timeTracking--item--location--single--left">
                                                        <span
                                                            class="dashboard-timeTracking--item--location--single--icon"><i
                                                                class="las la-map-marker-alt"></i></span>
                                                    </div>
                                                    <div class="dashboard-timeTracking--item--location--single--right">
                                                        <span
                                                            class="dashboard-timeTracking--item--location--single--para">{{ __('To') }}</span>
                                                        <h6 class="dashboard-timeTracking--item--location--single--title">
                                                            {{ $deliveryOrderAddress }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6 order-details">

                        </div>
                    </div>

                    {!! $ordersList->links() !!}
                </div>
                <div class="col-md-6">
                    <div id="map"></div>
                    <div id="directions-panel" class="d-none"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ get_static_option('map_api_key_client') }}&libraries=drawing,places&v=3.45.8">
    </script>

    <script>
        $(document).on("click", ".dashboard-timeTracking--item", function() {
            $('.dashboard-timeTracking--item.active').removeClass("active");

            $(this).addClass("active");
            let orderId = $(this).attr("data-item-id");

            send_ajax_request("GET", "", "{{ route('admin.delivery-man.single-order-details') }}/" + orderId +
                "/{{ $deliveryMan->id }}", () => {}, (response) => {
                    $(".order-details").html(response.html)

                    initMap({
                        from: response.from,
                        to: response.to,
                        currentLat: Number(response.latitude),
                        currentLong: Number(response.longitude)
                    });

                }, (errors) => {
                    prepare_errors(errors)
                })
        });

        let directionsService;
        let directionsRenderer;
        let map;
        let route;
        let currentLocationMarker;

        function initMap(address = {
            from: "",
            to: "",
            fromLat: 0,
            fromLong: 0,
            currentLat: null,
            currentLong: null
        }) {
            directionsService = null;
            directionsRenderer = null;
            map = null;
            route = null;
            currentLocationMarker = null;

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 20,
            });
            directionsRenderer.setMap(map);
            directionsRenderer.setPanel(document.getElementById('directions-panel'));

            let request = {
                origin: address.from,
                destination: address.to,
                travelMode: 'DRIVING'
            };

            directionsService.route(request, function(result, status) {
                if (status == 'OK') {
                    directionsRenderer.setDirections(result);
                    route = result.routes[0];
                }
            });

            if (address.currentLat == null && address.currentLong == null)
                return;

            // Add a marker for your current location 23.864574,90.662568,13
            currentLocationMarker = new google.maps.Marker({
                position: {
                    lat: address.currentLat,
                    lng: address.currentLong
                },
                map: map,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 15, // Adjust the size of the marker as needed
                    fillColor: '#05cd99', // You can choose the color
                    fillOpacity: 1,
                    strokeWeight: 0
                }
            });
        }
    </script>
@endsection
