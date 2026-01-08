@extends('frontend.user.dashboard.user-master')

@section('site-title')
    {{ __('My Orders') }}
@endsection

@section('section')
    <div class="dashboard__card__order">
        <div class="dashboard__card__header">
        </div>
        <div class="dashboard__card__table ">
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>
                                {{ __('Order Items') }}
                            </th>
                            <th>
                                {{ __('Order Date') }}
                            </th>
                            <th>
                                {{ __('Status') }}
                            </th>
                            <th>
                                {{ __('Order No.') }}
                            </th>
                            <th>
                                {{ __('Total Amount') }}
                            </th>
                            <th>
                                {{ __('Payment Status') }}
                            </th>
                            <th>
                                {{ __('Action') }}
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($all_orders as $order)
                            @php
                                $suborders = $order->suborders ?? collect();
                            @endphp
                            <tr>
                                <td class="align-middle text-start">
                                    @foreach ($suborders as $sub)
                                        @foreach ($sub->orderItem as $item)
                                            @php
                                                $product = $item->product;
                                                $vendor = $sub->vendor?->business_name ?? 'Admin Shop';

                                                $image = $product?->image;
                                                if (!empty($item->variant?->attr_image)) {
                                                    $image = $item->variant->attr_image;
                                                }
                                                $isLast = $loop->last && $loop->parent->last;
                                            @endphp

                                            <div class="d-flex align-items-center mb-2"
                                                style="{{ $isLast ? '' : 'border-bottom:1px solid #eee; padding-bottom:8px;' }}">

                                                <div style="width:55px; margin-right:10px;">
                                                    {!! render_image($image, class: 'img-fluid rounded') !!}
                                                </div>

                                                <div style="line-height: 18px;">
                                                    <strong class="d-block" style="font-size:14px;">
                                                        {{ Str::limit($product?->name, 40) }}
                                                    </strong>

                                                    <small class="text-muted d-block mb-0">
                                                        {{ __('Vendor:') }} {{ $vendor }}
                                                    </small>

                                                    <small class="text-muted d-block mb-0">
                                                        {{ __('Qty:') }} {{ $item->quantity }}
                                                    </small>

                                                    <small class="text-success fw-bold d-block mb-0">
                                                        {{ amount_with_currency_symbol($item->price) }}
                                                    </small>
                                                </div>

                                            </div>
                                        @endforeach
                                    @endforeach
                                </td>

                                <!-- ORDER DATE -->
                                <td class="align-middle text-start">
                                    {{ $order->created_at->format('M d, Y') }}
                                </td>

                                <!-- STATUS -->
                                <td class="align-middle text-start">
                                    @if ($order->order_status == 'complete')
                                        <span class="badge bg-primary">Complete</span>
                                    @elseif ($order->order_status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($order->order_status == 'failed')
                                        <span class="badge bg-danger">Failed</span>
                                    @elseif ($order->order_status == 'canceled')
                                        <span class="badge bg-danger">Canceled</span>
                                    @elseif ($order->order_status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>

                                <!-- ORDER NO -->
                                <td class="align-middle text-start">{{ $order->order_number }}</td>

                                <!-- TOTAL -->
                                <td class="align-middle text-start">
                                    {{ float_amount_with_currency_symbol($order->paymentMeta?->total_amount) }}
                                </td>

                                <td>
                                    @if ($order->payment_status == 'complete')
                                        <span class="badge bg-primary">Complete</span>
                                    @elseif ($order->payment_status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($order->payment_status == 'failed')
                                        <span class="badge bg-danger">Failed</span>
                                    @elseif ($order->payment_status == 'canceled')
                                        <span class="badge bg-danger">Canceled</span>
                                    @elseif ($order->payment_status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>

                                <!-- ACTION -->
                                <td class="align-middle text-start table-btn">
                                    <div class="btn-wrapper">
                                        <a href="{{ route('user.product.order.details', $order->order_number) }}"
                                            class="btn btn-secondary btn-sm rounded-btn mt-2"
                                            title="{{ __('View Details') }}" style="width: 40px;">
                                            <i class="las la-file-alt"></i>
                                        </a>
                                        <a href="{{ route('user.product.order.reorder', $order->id) }}"
                                            class="btn btn-info btn-sm rounded-btn mt-2" title="{{ __('Re-order') }}"
                                            style="width: 40px;">
                                            <i class="las la-retweet"></i>
                                        </a>
                                        @if (
                                            $order->payment_status == 'pending' &&
                                                ($order->payment_gateway == 'abapayway' || $order->payment_gateway == 'acledapay'))
                                            <a href="{{ route('user.product.order.reorder', $order->id) }}"
                                                class="btn btn-success btn-sm rounded-btn mt-2"
                                                title="{{ __('Re Payment') }}" style="width: 40px;">
                                                <i class="las la-money-bill"></i>
                                            </a>
                                        @endif
                                        @if ($order->isDeliveredStatus && !$order->hasRefundRequest)
                                            <a href="{{ route('user.product.order.refund', $order->id) }}"
                                                class="btn btn-warning btn-sm rounded-btn mt-2"
                                                title="{{ __('Request Refund') }}" style="width: 40px;">
                                                <i class="las la-undo"></i>
                                            </a>
                                        @endif
                                        @if ($order->isCancelableStatus && $order->order_status == 'pending')
                                            <button class="btn btn-danger btn-sm rounded-btn swal_cancel_button mt-2"
                                                title="{{ __('Cancel Order') }}" data-order-id="{{ $order->id }}"
                                                style="width: 40px;">
                                                <i class="las la-times"></i>
                                            </button>
                                        @endif
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
