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

        .btn-group button.dropdown-toggle.status-failed {
            color: #000000 !important;
        }

        .bg-warning,
        .status-failed.bg-warning {
            color: #000 !important;
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

        .status-failed .bg-warning {
            color: #000 !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h4 class="dashboard__card__title">
                {{ __('All Store Orders') }}
            </h4>
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
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_orders as $key => $order)
                                @php
                                    $status = strtolower($order->order_status);
                                    $statusClass = match ($status) {
                                        'canceled' => 'bg-danger',
                                        'pending' => 'bg-secondary',
                                        'complete' => 'bg-primary',
                                        'failed' => 'bg-warning text-dark',
                                        'rejected' => 'bg-info',
                                        default => 'bg-secondary',
                                    };

                                    $paymentStatus = strtolower($order->payment_status);
                                    $paymentStatusClass = match ($paymentStatus) {
                                        'canceled' => 'bg-danger',
                                        'pending' => 'bg-secondary',
                                        'complete' => 'bg-primary',
                                        'failed' => 'bg-warning text-dark',
                                        'rejected' => 'bg-info',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <tr class="completed">
                                    <td class="order-numb">
                                        {{ $order->order_number }}
                                    </td>
                                    <td>
                                        {{ $order->created_at->format('M d, Y') }}
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
                                                <form action="{{ route('admin.orders.change.status', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="order_status" value="pending">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Pending') }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.orders.change.status', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="order_status" value="complete">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Complete') }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.orders.change.status', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="order_status" value="failed">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Failed') }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.orders.change.status', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="order_status" value="rejected">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Rejected') }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.orders.change.status', $order->id) }}"
                                                    method="POST">
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
                                                <form
                                                    action="{{ route('admin.orders.payment.status.change', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="payment_status" value="pending">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Pending') }}
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.orders.payment.status.change', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="payment_status" value="complete">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Complete') }}
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('admin.orders.payment.status.change', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="payment_status" value="failed">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Failed') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-btn">
                                        <div class="btn-wrapper d-flex flex-wrap gap-2">
                                            @can('view-order')
                                                <a href="{{ route('admin.orders.generate.invoice', $order->id) }}"
                                                    class="btn btn-primary rounded-btn btn-sm" title="{{ __('View Invoice') }}">
                                                    <i class="ti-info"></i>
                                                </a>
                                            @endcan
                                            @can('view-order')
                                                <a href="{{ route('admin.orders.order.details', $order->id) }}"
                                                    class="btn btn-secondary rounded-btn btn-sm" title="{{ __('View details') }}">
                                                    <i class="las la-file-invoice"></i>
                                                </a>
                                            @endcan
                                            @can('edit-order')
                                                <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                    class="btn btn-warning text-dark rounded-btn btn-sm" title="{{ __('Edit') }}">
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
            });
        })(jQuery);
    </script>
@endsection
