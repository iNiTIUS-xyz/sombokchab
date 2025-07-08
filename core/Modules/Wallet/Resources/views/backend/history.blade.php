@extends('backend.admin-master')

@section('site-title')
    {{ __('History Lists') }}
@endsection

@section('style')
    <x-media.css />
    <style>
        .payment_attachment {
            width: 100px;
        }

        .btn-group button.dropdown-toggle {
            border: none !important;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-error-msg />
                <x-flash-msg />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Customer Deposit History') }}</h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Serial No.') }}</th>
                                        <th>{{ __('User Details') }}</th>
                                        <th>{{ __('Payment Method') }}</th>
                                        <th>{{ __('Deposit Amount') }}</th>
                                        <th>{{ __('Manual Payment Image') }}</th>
                                        <th>{{ __('Deposit Date') }}</th>
                                        <th>{{ __('Payment Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wallet_history_lists as $history)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <p><strong>{{ __('Name: ') }}</strong>{{ $history->user?->name }}</p>
                                                <p><strong>{{ __('Email: ') }}</strong>{{ $history->user?->email }}</p>
                                                <p><strong>{{ __('Phone: ') }}</strong>{{ $history->user?->phone }}</p>
                                                <p>
                                                    <strong>{{ __('Email Verified Status: ') }}</strong>
                                                    <x-status.table.verified-status
                                                        :status="$history->user?->user_verified_status" />
                                                </p>
                                            </td>
                                            <td>
                                                @if ($history->payment_gateway == 'manual_payment')
                                                    {{ ucfirst(str_replace('_', ' ', $history->payment_gateway)) }}
                                                @else
                                                    {{ $history->payment_gateway == 'authorize_dot_net' ? __('Authorize.Net') : ucfirst(str_replace('_', ' ', $history->payment_gateway)) }}
                                                @endif
                                            </td>
                                            <td>{{ float_amount_with_currency_symbol($history->amount) }}</td>
                                            <td>
                                                <span class="img_100">
                                                    @if (empty($history->manual_payment_image))
                                                        <img src="{{ asset('assets/static/img/no_image.png') }}" alt="">
                                                    @else
                                                        <img src="{{ asset('assets/uploads/manual-payment/' . $history->manual_payment_image) }}"
                                                            alt="">
                                                    @endif
                                                </span>
                                            </td>
                                            <td>{{ $history->created_at }}</td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $history->payment_status }} {{ $history->payment_status == 'pending' ? 'bg-danger status-close' : '' }} {{ $history->payment_status === 'complete' ? 'bg-primary status-open' : '' }} {{ $history->payment_status === 'cancel' ? 'bg-warning status-open' : '' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ ucfirst($history->payment_status) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form action="{{ route('admin.wallet.history.status', $history->id) }}"
                                                            method="POST" id="status-form-activate-{{ $history->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="pending">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Pending') }}
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('admin.wallet.history.status', $history->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $history->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="complete">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Complete') }}
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.wallet.history.status', $history->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $history->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="cancel">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Cancel') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-secondary"
                                                    href="{{ route('admin.wallet.history.details', $history->id) }}"
                                                    title="{{ __('View Details') }}">
                                                    <i class="ti-receipt"></i>
                                                </a>
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
    <x-media.js />
    @can('wallet-history-records-status')
        <script>
            (function ($) {
                "use strict";

                $(document).on('click', '.swal_status_change_button', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '{{ __('Are you sure to change status?') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#55545b',
                        confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });
            })(jQuery)
        </script>
    @endcan
@endsection