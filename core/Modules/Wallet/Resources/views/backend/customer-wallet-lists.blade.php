@extends('backend.admin-master')

@section('site-title')
    {{ __('Customer Wallets List') }}
@endsection

@section('style')
    <x-media.css />
    <style>
        table.dataTable th.dt-type-numeric div.dt-column-header,
        table.dataTable th.dt-type-numeric div.dt-column-footer,
        table.dataTable th.dt-type-date div.dt-column-header,
        table.dataTable th.dt-type-date div.dt-column-footer,
        table.dataTable td.dt-type-numeric div.dt-column-header,
        table.dataTable td.dt-type-numeric div.dt-column-footer,
        table.dataTable td.dt-type-date div.dt-column-header,
        table.dataTable td.dt-type-date div.dt-column-footer {
            flex-direction: row !important;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-error-msg />
                <x-flash-msg />
            </div>
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <div class="dashboard__card__header__left">
                            <h4 class="dashboard__card__title">{{ __('Customer Wallets List') }}</h4>
                            <p class="dashboard__card__para text-primary mt-2">
                                {{ __('You can active/inactive status from here. If status is inactive user will not be able to use his/her wallet balance.') }}
                            </p>
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @if ($type == 'vendor')
                                        <th>{{ __('Store Name') }}</th>
                                    @endif
                                    <th>{{ __('Customer Details') }}</th>
                                    <th>{{ __('Wallet Balance') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </thead>
                                <tbody>
                                    @forelse($wallet_lists ?? [] as $data)
                                        <tr>
                                            @if ($type == 'vendor')
                                                <td>{{ $data?->vendor?->business_name }}</td>
                                            @endif
                                            <td>
                                                <ul>
                                                    @if ($type == 'vendor')
                                                        <li>
                                                            <strong>
                                                                {{ __('Name') }}:
                                                            </strong>
                                                            {{ $data?->vendor?->owner_name }}
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                {{ __('Email') }}:
                                                            </strong>
                                                            {{ $data?->vendor?->vendor_shop_info?->email }}
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                {{ __('Phone') }}:
                                                            </strong>
                                                            {{ $data?->vendor?->vendor_shop_info?->number }}
                                                        </li>
                                                    @else
                                                        <li>
                                                            <strong>
                                                                {{ __('Name') }}:
                                                            </strong>
                                                            {{ $data?->user?->name }}
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                {{ __('Email') }}:
                                                            </strong>
                                                            {{ $data?->user?->email }}
                                                        </li>
                                                        <li>
                                                            <strong>
                                                                {{ __('Phone') }}:
                                                            </strong>
                                                            {{ $data?->user?->phone }}
                                                        </li>
                                                    @endif
                                                </ul>

                                            </td>
                                            <td>{{ float_amount_with_currency_symbol($data?->balance ?? 0) }}</td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $data->status }} {{ $data->status == 0 ? 'bg-danger status-close' : 'bg-primary status-open' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ ucfirst($data->status == 0 ? __('Inactive') : __('Active')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- Form for activating --}}
                                                        <form action="{{ route('admin.wallet.status', $data->id) }}"
                                                            method="POST" id="status-form-activate-{{ $data->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="1">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Active') }}
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('admin.wallet.status', $data->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $data->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="0">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Inactive') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center py-4" colspan="4">
                                                {{ __('No Data Available') }}
                                            </td>
                                        </tr>
                                    @endforelse
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
    <x-media.js />
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $(document).on('click', '.swal_status_change', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{ __('Are you sure to change status?') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ee0000',
                        cancelButtonColor: '#55545b',
                        confirmButtonText: 'Yes, change it!',
                        cancelButtonText: "{{ __('No') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });
            });
        })(jQuery)
    </script>
@endsection
