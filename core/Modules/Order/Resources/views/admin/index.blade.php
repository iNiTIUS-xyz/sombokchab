@extends('backend.admin-master')

@section('site-title')
    {{ __('All Store Sub Orders') }}
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
                            {{-- <th>{{ __('Tracking Number') }}</th> --}}
                            <th>{{ __('Store Name') }}</th>
                            <th>{{ __('Order Date') }}</th>
                            <th>{{ __('Order Status') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_orders as $order)
                            <tr class="completed">
                                <td class="order-numb">
                                    {{ $order->order_number }}
                                </td>
                                {{-- <td class="order-numb">
                                    {{ $order->order_number }}
                                </td> --}}
                                <td class="order-numb">
                                    Store Name
                                </td>
                                <td class="date">
                                    {{ $order->order->created_at->format('F d, Y') }}
                                </td>
                                <td class="status">
                                    @if ($order->order_status == 'complete')
                                        <span class="badge bg-primary px-2 py-1">{{ __('Complete') }}</span>
                                    @elseif ($order->order_status == 'pending')
                                        <span class="badge bg-warning px-2 py-1">{{ __('Pending') }}</span>
                                    @elseif ($order->order_status == 'canceled')
                                        <span class="badge bg-danger px-2 py-1">{{ __('Canceled') }}</span>
                                    @endif
                                </td>
                                <td class="amount">
                                    {{ float_amount_with_currency_symbol($order->total_amount) }}
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
