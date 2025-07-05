@extends('vendor.vendor-master')

@section('style')
    <x-datatable.css />

    <style>
        #DataTables_Table_0_wrapper>.row:first-child {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        #DataTables_Table_0_wrapper>.row:first-child .col-12 {
            flex: 1 1 50%;
            max-width: 50%;
        }

        /* Optional: Align content inside each column */
        #DataTables_Table_0_length {
            text-align: left;
        }

        #DataTables_Table_0_filter {
            text-align: right;
        }
    </style>
@endsection

@section('site-title')
    {{ __('My Orders') }}
@endsection

@section('content')
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title">{{ __('My Orders') }}</h3>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="all-user-campaign-table">
                <div class="table-wrap table-responsive order-history-inner">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Order No.') }}</th>
                                {{-- <th>{{ __('Tracking Number') }}</th> --}}
                                <th>
                                    {{ __('Order Date') }}
                                </th>
                                <th>
                                    {{ __('Status') }}
                                </th>
                                <th>
                                    {{ __('Amount') }}
                                </th>
                                <th>
                                    {{ __('Action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_orders as $order)
                                <tr class="completed">
                                    {{-- <td class="order-numb">
                                        {{ $order->id }}
                                    </td> --}}
                                    <td class="order-numb">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="date">
                                        {{ $order->order->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="status">
                                        @if ($order->order->order_status == 'complete')
                                            <span class="badge bg-primary px-2 py-1">{{ __('Complete') }}</span>
                                        @elseif ($order->order->order_status == 'pending')
                                            <span class="badge bg-warning px-2 py-1">{{ __('Pending') }}</span>
                                        @elseif ($order->order->order_status == 'failed')
                                            <span class="badge px-2 py-1"
                                                style="background: rgb(145, 2, 2) !important;">{{ __('Failed') }}</span>
                                        @elseif ($order->order->order_status == 'rejected')
                                            <span class="badge px-2 py-1"
                                                style="background: rgb(138, 1, 14) !important;">{{ __('Rejected') }}</span>
                                        @elseif ($order->order->order_status == 'canceled')
                                            <span class="badge bg-danger px-2 py-1">{{ __('Canceled') }}</span>
                                        @endif
                                    </td>
                                    <td class="amount">
                                        {{ float_amount_with_currency_symbol($order->total_amount) }}
                                    </td>
                                    <td class="table-btn">
                                        <div class="btn-wrapper">
                                            <a href="{{ route('vendor.orders.details', $order->id) }}"
                                                class="btn btn-success btn-sm rounded-btn" title="Order Details">
                                                <i class="las la-eye"></i>
                                            </a>
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
        (function ($) {
            "use strict";
            $(document).ready(function () {

                $(document).on('click', '.bodyUser_overlay', function () {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });
                $(document).on('click', '.mobile_nav', function () {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });

                $(document).on('click', '.swal_delete_button', function (e) {
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

    <x-datatable.js />
@endsection