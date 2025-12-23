@extends('backend.admin-master')

@section('site-title')
    {{ __('Shipping Zones') }}
@endsection

@section('site-title')
    {{ __('Shipping Zones') }}
@endsection

@section('style')
    <x-bulk-action.css />
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12" id="shipping-zone-wrapper-box">
        <div class="row g-4">
            <div class="col-md-12">
                <div class="mb-4">
                    @can('manage-shipping-settings')
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
                                    @foreach ($zones as $key => $zone)
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
                                                @can('manage-shipping-settings')
                                                    <a class="btn btn-sm btn-warning text-dark" title="{{ __('Edit') }}"
                                                        href="{{ route('admin.shipping.zone.edit', $zone->id) }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan

                                                @can('manage-shipping-settings')
                                                    <a class="btn btn-sm btn-danger swal-delete" title="{{ __('Delete') }}"
                                                        href="javascript:void(0)"
                                                        data-route="{{ route('admin.shipping.zone.delete', $zone->id) }}">
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

@section('script')
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $(document).on('click', '.swal-delete', function(e) {
                    e.preventDefault();

                    const $btn = $(this);
                    const route = $btn.data('route') || $btn.attr('href');

                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('This action cannot be undone.') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ee0000',
                        cancelButtonColor: '#55545b',
                        confirmButtonText: '{{ __('Yes, delete it!') }}',
                        cancelButtonText: "{{ __('No') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: route,
                                type: 'GET',
                                success: function(data) {
                                    // customize success condition if your API returns more info
                                    Swal.fire('{{ __('Deleted!') }}', '',
                                        'success');
                                    setTimeout(function() {
                                        location.reload();
                                    }, 800);
                                },
                                error: function(xhr) {
                                    const msg = xhr.responseJSON && xhr.responseJSON
                                        .message ?
                                        xhr.responseJSON.message :
                                        '{{ __('Something went wrong. Please try again.') }}';
                                    Swal.fire('{{ __('Error') }}', msg, 'error');
                                }
                            });
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endsection
