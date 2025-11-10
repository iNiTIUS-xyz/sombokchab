@extends('backend.admin-master')

@section('site-title')
    {{ __('All Store Sub Orders') }}
@endsection

@section('style')
    <style>
        .btn-group button.dropdown-toggle {
            border: 1px solid #ffffff !important;
            color: #ffffff !important;
        }

        .btn-group button.dropdown-toggle.status-pending {
            color: #000000 !important;
        }

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
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h4 class="dashboard__card__title">{{ __('All Store Sub Orders') }}</h4>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>{{ __('Order No.') }}</th>
                            <th>{{ __('Store Name') }}</th>
                            <th>{{ __('Order Date') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Order Status') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_orders as $order)
                            @php
                                $status = strtolower($order->order_status);
                                $statusClass = match ($status) {
                                    'canceled' => 'bg-danger',
                                    'pending' => 'bg-warning',
                                    'complete' => 'bg-success',
                                    'failed' => 'bg-warning',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <tr class="completed">
                                <td class="order-numb">
                                    {{ $order->order_number }}
                                </td>
                                <td class="order-numb">
                                    {{ $order->vendor?->business_name }}
                                </td>
                                <td class="date">
                                    {{ $order->order->created_at->format('M j, Y') }}
                                </td>
                                <td class="amount">
                                    {{ float_amount_with_currency_symbol($order->total_amount) }}
                                </td>
                                <td class="status">
                                    <div class="btn-group badge">
                                        <button type="button"
                                            class="status-{{ $status }} {{ $statusClass }} dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ ucfirst($status) }}
                                        </button>
                                        <div class="dropdown-menu">
                                            {{-- Pending --}}
                                            <form action="{{ route('admin.orders.sub.change.status', $order->id) }}"
                                                method="POST" id="status-form-pending-{{ $order->id }}">
                                                @csrf
                                                <input type="hidden" name="order_status" value="pending">
                                                <button type="submit" class="dropdown-item">
                                                    {{ __('Pending') }}
                                                </button>
                                            </form>
                                            {{-- Complete --}}
                                            <form action="{{ route('admin.orders.sub.change.status', $order->id) }}"
                                                method="POST" id="status-form-complete-{{ $order->id }}">
                                                @csrf
                                                <input type="hidden" name="order_status" value="complete">
                                                <button type="submit" class="dropdown-item">
                                                    {{ __('Complete') }}
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.orders.sub.change.status', $order->id) }}"
                                                method="POST" id="status-form-canceled-{{ $order->id }}">
                                                @csrf
                                                <input type="hidden" name="order_status" value="canceled">
                                                <button type="submit" class="dropdown-item">
                                                    {{ __('Canceled') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ date('M j, Y', strtotime($order->created_at)) }}
                                </td>
                                <td class="table-btn">
                                    @can('orders-details')
                                        <div class="btn-wrapper">
                                            <a href="{{ route('admin.orders.details', $order->id) }}"
                                                class="btn btn-secondary rounded-btn" title="{{ __('View details') }}">
                                                <i class="las la-file-invoice"></i>
                                            </a>
                                        </div>
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
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                $(document).on('click', '.bodyUser_overlay', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });
                $(document).on('click', '.mobile_nav', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });

                $(document).on('click', '.swal_delete_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('You would not be able to revert this item!') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ee0000',
                        cancelButtonColor: '#55545b',
                        confirmButtonText: "{{ __('Yes, delete it!') }}",
                        cancelButtonText: "{{ __('No') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });
            })
        })(jQuery)
    </script>
@endsection
