@extends('backend.admin-master')

@section('style')

@endsection

@section('site-title', __('Delivery man history'))

@php
    use Modules\DeliveryMan\Services\DeliveryManServices;
@endphp

@section('content')
    <div class="error-wrapper">
        <x-msg.error />
        <x-msg.success />
    </div>

    <!-- 2nd delivery design -->
    <div class="dashboard-deliveryWrap">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title"> {{ __('Delivery man history') }}</h4>
                    </div>
                    <div class="dashboard__card__body dashboard-delivery-info mt-4">
                        <div class="table-responsive table-wrap">
                            <table class="table table-response">
                                <thead>
                                    <tr>
                                        <th>{{ __('Order Id') }}</th>
                                        <th>{{ __('Pickup Point') }}</th>
                                        <th>{{ __('Delivery Address') }}</th>
                                        <th>{{ __('Payment Type') }}</th>
                                        <th>{{ __('Commission') }}</th>
                                        <th>{{ __('Order Status') }}</th>
                                        <th>{{ __('Assigned Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($deliveryManOrders as $singleOrder)
                                        @php
                                            $orderTrack = $singleOrder->orderTrack->first();
                                            $pickupPoint = $singleOrder->pickupPoint;
                                            $deliveryManAddr = $singleOrder->deliveryMan?->presentAddress ?? '';

                                            $deliveryOrderAddress = DeliveryManServices::generateDeliveryOrderAddress($singleOrder);
                                            $pickupPointAddress = DeliveryManServices::generatePickupPointAddress($pickupPoint);
                                            $deliveryManAddress = DeliveryManServices::generateDeliveryManAddress($deliveryManAddr);
                                        @endphp
                                        <tr>
                                            <td>{{ $singleOrder->order_id }}</td>
                                            <td>{{ $pickupPointAddress }}</td>
                                            <td>{{ $deliveryOrderAddress }}</td>
                                            <td>{{ $singleOrder->payment_type }}</td>
                                            <td>
                                                @if ($singleOrder->commission_type)
                                                    <b>{{ __('Type') }} </b> {{ $singleOrder->commission_type }}<br />
                                                @endif
                                                @if ($singleOrder->commission_amount)
                                                    <b>{{ __('Amount') }} </b>
                                                    {{ float_amount_with_currency_symbol($singleOrder->commission_amount) }}
                                                @endif
                                            </td>
                                            <td>{{ ucwords(str_replace(['_', '-'], [' ', ''], $orderTrack->name)) }}</td>
                                            <td>{{ $singleOrder->created_at->format('d F Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-warning py-4">
                                                <b>{{ __('Order history not found') }}</b>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {!! $deliveryManOrders->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
