@extends('frontend.user.dashboard.user-master')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <style>
        #dataTable_wrapper>.row:first-child {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        #dataTable_wrapper>.row:first-child .col-12 {
            flex: 1 1 50%;
            max-width: 50%;
        }

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

@section('section')
    <div class="dashboard__card__order">
        <div class="dashboard__card__header">
        </div>
        <div class="dashboard__card__table mt-4">
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>
                                {{ __('Order No.') }}
                            </th>
                            <th>
                                {{ __('Order Date') }}
                            </th>
                            <th>
                                {{ __('Status') }}
                            </th>
                            <th>
                                {{ __('Total Amount') }}
                            </th>
                            <th>
                                {{ __('Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_orders as $order)
                            <tr class="completed">
                                <td class="order-numb">
                                    {{ $order->order_number }}
                                </td>
                                <td class="date">
                                    {{ $order->created_at->format('M j, Y') }}
                                </td>
                                <td class="status">
                                    @if ($order->hasRefundRequest && $order->refundRequest->currentTrackStatus)
                                        {{ __('Refund:') }}
                                        <span class="badge bg-light text-dark px-2 py-1">
                                            {{ __(ucwords(str_replace('_', ' ', $order->refundRequest->currentTrackStatus->name))) }}
                                        </span>
                                    @else
                                        @if ($order->order_status == 'complete')
                                            <span class="badge bg-primary px-2 py-1">{{ __('Complete') }}</span>
                                        @elseif ($order->order_status == 'pending')
                                            <span class="badge bg-warning px-2 py-1">{{ __('Pending') }}</span>
                                        @elseif ($order->order_status == 'failed')
                                            <span class="badge px-2 py-1"
                                                style="background: rgb(145, 2, 2) !important;">{{ __('Failed') }}</span>
                                        @elseif ($order->order_status == 'canceled')
                                            <span class="badge bg-danger px-2 py-1">{{ __('Canceled') }}</span>
                                        @elseif ($order->order_status == 'rejected')
                                            <span class="badge px-2 py-1"
                                                style="background: rgb(138, 1, 14) !important;">{{ __('Rejected') }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="amount">
                                    <div class="product__price ">
                                        <span class="product__price__current ">
                                            {{ float_amount_with_currency_symbol($order->paymentMeta?->total_amount) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="table-btn">
                                    <div class="btn-wrapper">
                                        @if ($order->isDeliveredStatus && !$order->hasRefundRequest)
                                            <a href="{{ route('user.product.order.refund', $order->id) }}"
                                                class="btn btn-warning btn-sm rounded-btn"
                                                title="{{ __('Request Refund') }}" style="width: 40px;">
                                                <i class="las la-undo"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route('user.product.order.details', $order->order_number) }}"
                                            class="btn btn-secondary btn-sm rounded-btn" title="{{ __('View Details') }}"
                                            style="width: 40px;">
                                            <i class="las la-file-alt"></i>
                                        </a>
                                        @if ($order->isCancelableStatus && $order->order_status == 'pending')
                                            <button class="btn btn-danger btn-sm rounded-btn swal_cancel_button"
                                                title="{{ __('Cancel Order') }}" data-order-id="{{ $order->id }}"
                                                style="width: 40px;">
                                                <i class="las la-times"></i>
                                            </button>
                                        @endif

                                        <a href="{{ route('user.product.order.reorder', $order->id) }}"
                                            class="btn btn-info btn-sm rounded-btn" title="{{ __('Re-order') }}"
                                            style="width: 40px;">
                                            <i class="las la-retweet"></i>
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
                        text: '{{ __('This action cannot be undone.') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ee0000',
                        cancelButtonColor: '#55545b',
                        confirmButtonText: 'Yes, delete it!',
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
    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    paging: true,
                    lengthChange: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    responsive: true,
                    order: [
                        [0, 'desc']
                    ],
                    pagingType: "simple_numbers",
                    language: {
                        lengthMenu: "{{ __('_MENU_ entries per page') }}",
                        search: "{{ __('Filter:') }}",
                        info: "{{ __('Showing _START_ to _END_ of _TOTAL_ entries') }}",
                        infoEmpty: "{{ __('No entries available') }}",
                        infoFiltered: "{{ __('(filtered from _MAX_ total entries)') }}",

                        zeroRecords: "{{ __('No matching records found') }}",
                        emptyTable: "{{ __('No entries available') }}",
                        paginate: {
                            previous: "{{ __('Prev') }}",
                            next: "{{ __('Next') }}"
                        },
                        emptyTable: "{{ __('No data available in table') }}"
                    }
                });
            }
        });
    </script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $(document).on('click', '.swal_cancel_button', function(e) {
                    e.preventDefault();
                    const orderId = $(this).data('order-id');

                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('This action cannot be undone.') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ee0000',
                        cancelButtonColor: '#55545b',
                        confirmButtonText: '{{ __('Yes, cancel it!') }}',
                        cancelButtonText: "{{ __('No') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'get',
                                url: "{{ url('/user-home/orders/cancel') }}/" +
                                    orderId,
                                data: {
                                    _token: "{{ csrf_token() }}",
                                },
                                success: function(data) {
                                    console.log('AJAX Response:', data);
                                    if (data.success) {
                                        Swal.fire('Cancelled!', '', 'success');
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    } else {
                                        Swal.fire('Error!', data.message ||
                                            'Failed to cancel order.', 'error');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('AJAX Error:', xhr.responseText,
                                        status, error);
                                    Swal.fire('Error!', 'Failed to cancel order.',
                                        'error');
                                }
                            });
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endsection
