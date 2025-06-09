@extends('backend.admin-master')

@section('site-title', __('Delivery man zone'))

@section('content')
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h4 class="dashboard__card__title">{{ __('Delivery zone list') }}</h4>
            @can('delivery-man-zone-create')
                <div class="btn-wrapper">
                    <a href="{{ route('admin.delivery-man.zone.create') }}"
                        class="cmn_btn btn_bg_profile">{{ __('Create Zone') }}</a>
                </div>
            @endcan
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <td>{{ __('Serial No:') }}</td>
                                <td>{{ __('Name') }}</td>
                                <td>{{ __('Status') }}</td>
                                <td>{{ __('Actions') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveryZones as $zone)
                                @php
                                    $page = request()->page ?? 1;
                                @endphp

                                <tr>
                                    <td>{{ $page * $paginationLimit - $paginationLimit + $loop->iteration }}</td>
                                    <td>{{ $zone->name }}</td>
                                    <td>
                                        <x-status-span :status="$zone->is_active == 1 ? 'Active' : 'In-Active'" />
                                    </td>
                                    <td>
                                        @can('delivery-man-zone-delete')
                                            <x-table.btn.swal.delete :route="route('admin.delivery-man.zone.destroy', $zone->id)" />
                                        @endcan
                                        @can('delivery-man-zone-update')
                                            <x-table.btn.edit :route="route('admin.delivery-man.zone.edit', $zone->id)" />
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
@endsection
