@extends('backend.admin-master')

@section('site-title')
    {{ __('All Store Orders') }}
@endsection

@section('style')
    <style>
        .btn-group button.dropdown-toggle {
            border: 1px solid #ffffff !important;
            color: #ffffff !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <x-msg.error />
            <x-msg.flash />
        </div>
    </div>
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h4 class="dashboard__card__title">{{ __('All Store Orders') }}</h4>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="all-user-campaign-table">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>{{ __('Order No.') }}</th>
                                <th>{{ __('Order Date') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Order Status') }}</th>
                                <th>{{ __('Payment Status') }}</th>
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
                                        'pending' => 'bg-secondary',
                                        'complete' => 'bg-success',
                                        'failed' => 'bg-warning',
                                        'rejected' => 'bg-info',
                                        default => 'bg-secondary',
                                    };

                                    $paymentStatus = strtolower($order->payment_status);
                                    $paymentStatusClass = match ($paymentStatus) {
                                        'canceled' => 'bg-danger',
                                        'pending' => 'bg-secondary',
                                        'complete' => 'bg-success',
                                        'failed' => 'bg-warning',
                                        'rejected' => 'bg-info',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <tr class="completed">
                                    <td class="order-numb">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="date">
                                        {{ $order->created_at->format('F d, Y') }}
                                    </td>
                                    <td class="amount">
                                        {{ float_amount_with_currency_symbol($order->paymentMeta->total_amount ?? 0) }}
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
                                                <form action="{{ route('admin.orders.change.status', $order->id) }}"
                                                    method="POST" id="status-form-pending-{{ $order->id }}">
                                                    @csrf
                                                    <input type="hidden" name="order_status" value="pending">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Pending') }}
                                                    </button>
                                                </form>
                                                {{-- Complete --}}
                                                <form action="{{ route('admin.orders.change.status', $order->id) }}"
                                                    method="POST" id="status-form-complete-{{ $order->id }}">
                                                    @csrf
                                                    <input type="hidden" name="order_status" value="complete">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Complete') }}
                                                    </button>
                                                </form>
                                                {{-- Failed --}}
                                                <form action="{{ route('admin.orders.change.status', $order->id) }}"
                                                    method="POST" id="status-form-failed-{{ $order->id }}">
                                                    @csrf
                                                    <input type="hidden" name="order_status" value="failed">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Failed') }}
                                                    </button>
                                                </form>

                                                {{-- Rejected --}}
                                                <form action="{{ route('admin.orders.change.status', $order->id) }}"
                                                    method="POST" id="status-form-rejected-{{ $order->id }}">
                                                    @csrf
                                                    <input type="hidden" name="order_status" value="rejected">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Rejected') }}
                                                    </button>
                                                </form>
                                                {{-- Canceled --}}
                                                <form action="{{ route('admin.orders.change.status', $order->id) }}"
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
                                    <td class="status">
                                        <div class="btn-group badge">
                                            <button type="button"
                                                class="status-{{ $paymentStatus }} {{ $paymentStatusClass }} dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ ucfirst($paymentStatus) }}
                                            </button>
                                            <div class="dropdown-menu">
                                                {{-- Pending --}}
                                                <form
                                                    action="{{ route('admin.orders.payment.status.change', $order->id) }}"
                                                    method="POST" id="status-form-pending-{{ $order->id }}">
                                                    @csrf
                                                    <input type="hidden" name="payment_status" value="pending">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Pending') }}
                                                    </button>
                                                </form>
                                                {{-- Complete --}}
                                                <form
                                                    action="{{ route('admin.orders.payment.status.change', $order->id) }}"
                                                    method="POST" id="status-form-complete-{{ $order->id }}">
                                                    @csrf
                                                    <input type="hidden" name="payment_status" value="complete">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Complete') }}
                                                    </button>
                                                </form>
                                                {{-- Failed --}}
                                                <form
                                                    action="{{ route('admin.orders.payment.status.change', $order->id) }}"
                                                    method="POST" id="status-form-failed-{{ $order->id }}">
                                                    @csrf
                                                    <input type="hidden" name="payment_status" value="failed">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Failed') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ date('d M Y', strtotime($order->created_at)) }}
                                    </td>
                                    <td class="table-btn">
                                        <div class="btn-wrapper d-flex flex-wrap gap-2">
                                            @can('orders-generate-invoice')
                                                <a href="{{ route('admin.orders.generate.invoice', $order->id) }}"
                                                    class="btn btn-info rounded-btn" title="{{ __('View Invoice') }}">
                                                    <i class="ti-info"></i>
                                                </a>
                                            @endcan
                                            @can('orders-details')
                                                <a href="{{ route('admin.orders.order.details', $order->id) }}"
                                                    class="btn btn-secondary rounded-btn" title="{{ __('View details') }}">
                                                    <i class="las la-file-invoice"></i>
                                                </a>
                                            @endcan
                                            {{-- @can('orders-download-invoice')
                                            <a href="{{ route('admin.orders.download.invoice', $order->id) }}"
                                                class="btn btn-primary rounded-btn" title="{{ __('Download Data') }}">
                                                <i class="las la-download"></i>
                                            </a>
                                            @endcan --}}
                                            @can('orders-update')
                                                <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                    class="btn btn-warning text-dark rounded-btn"
                                                    title="{{ __('Edit Data') }}">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                            @endcan
                                        </div>
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
                        confirmButtonColor: '#3085d6',
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
