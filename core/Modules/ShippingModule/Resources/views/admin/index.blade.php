@extends('backend.admin-master')

@section('site-title')
    {{ __('Shipping Zones') }}
@endsection

@section('site-title')
    {{ __('Shipping Zones') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12" id="shipping-zone-wrapper-box">
        <div class="row g-4">
            <div class="col-md-12">
                <x-flash-msg />
                <x-error-msg />
                <div class="mb-4">
                    @can('shipping-zone-create')
                        <a href="{{ route('admin.shipping.zone.create') }}" class="cmn_btn btn_bg_profile">
                            {{ __('Add New Shipping Zone') }}
                        </a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Shipping Zones') }}</h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Zone Name') }}</th>
                                        <th>{{ __('Countries') }}</th>
                                        <th>{{ __('States') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($zones as $zone)
                                        <tr>
                                            <td>{{ $zone->name }}</td>
                                            <td>
                                                <b>
                                                    {!! $zone?->country?->pluck('name')?->implode('</b>,<b> ') !!}
                                                </b>
                                            </td>
                                            <td>
                                                @foreach ($zone?->country as $country)
                                                    <b>
                                                        {{ $country->name }}
                                                        @if (!empty($country->zoneStates))
                                                            ->
                                                        @endif
                                                    </b>
                                                    {{ $country->zoneStates?->pluck('name')?->implode(', ') }}
                                                    <br />
                                                @endforeach
                                            </td>
                                            <td>
                                                @can('shipping-zone-edit')
                                                    <a class="btn btn-sm btn-warning text-dark" title="{{ __('Edit Data') }}"
                                                        href="{{ route('admin.shipping.zone.edit', $zone->id) }}">
                                                        <i class="las la-pen"></i>
                                                    </a>
                                                @endcan

                                                @can('shipping-zone-delete')
                                                    <a class="btn btn-sm btn-danger" title="{{ __('Delete Data') }}"
                                                        href="{{ route('admin.shipping.zone.delete', $zone->id) }}">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection