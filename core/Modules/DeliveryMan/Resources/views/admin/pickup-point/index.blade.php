@extends('backend.admin-master')

@section('style')

@endsection

@section('site-title', __('Pickup point list'))

@section('content')
    <x-error-msg />
    <x-msg.success />
    <div class="dashboard__card card__two">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title">{{ __('Pickup Point List') }}</h3>

            @can('delivery-man-pickup-point-create')
                <div class="btn-wrapper">
                    <a href="{{ route('admin.delivery-man.pickup-point.create') }}"
                        class="cmn_btn btn_bg_profile">{{ __('Create Pickup Point') }}</a>
                </div>
            @endcan
        </div>

        <div class="dashboard__card__body">
            <div class="table-wrap table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Serial No:') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Zone') }}</th>
                            <th>{{ __('Vendor') }}</th>
                            <th>{{ __('Info') }}</th>
                            <th>{{ __('Address') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pickupPoints as $pickupPoint)
                            <tr>
                                <td>
                                    {{ ($pickupPoints->currentpage() - 1) * $pickupPoints->perpage() + $loop->index + 1 }}
                                </td>
                                <td>{{ $pickupPoint->name }}</td>
                                <td>{{ $pickupPoint->zone->name }}</td>
                                <td>
                                    {{ $pickupPoint->vendor?->owner_name }}
                                    @if ($pickupPoint->vendor?->business_name ?? false)
                                        <br>
                                        <b>{{ __('Store:') }}</b> {{ $pickupPoint->vendor?->business_name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($pickupPoint->contact_number ?? false)
                                        <b>{{ __('Contact Number') }}</b> {{ $pickupPoint->contact_number }} <br>
                                    @endif

                                    {{ $pickupPoint->operating_hours }} <br>
                                </td>
                                <td>
                                    @if ($pickupPoint->country?->name ?? false)
                                        {{ $pickupPoint->country?->name }}
                                    @endif
                                    @if ($pickupPoint->state?->name ?? false)
                                        , {{ $pickupPoint->state?->name }}
                                    @endif
                                    @if ($pickupPoint->city?->name ?? false)
                                        , {{ $pickupPoint->city?->name }}
                                    @endif
                                    <br />
                                    <b>{{ $pickupPoint->address }}</b>
                                </td>
                                <td>
                                    @can('delivery-man-pickup-point-edit')
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.delivery-man.pickup-point.edit', $pickupPoint->id) }}">{{ __('Edit') }}</a>
                                    @endcan
                                    @can('delivery-man-pickup-point-delete')
                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('admin.delivery-man.pickup-point.delete', $pickupPoint->id) }}">{{ __('Delete') }}</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
