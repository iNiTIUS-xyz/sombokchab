<div class="table-wrap table-responsive all-user-campaign-table">
    <div class="order-history-inner">
        <table class="table">
            <thead>
            <tr>
                <th>
                    {{ __('Order No.') }}
                </th>
                <th>
                    {{ __('Tracking Number') }}
                </th>
                <th>
                    {{ __('Date') }}
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
                @foreach ($allOrders as $order)
                    <tr class="completed">
                        <td class="order-numb">
                            {{ $order->id }}
                        </td>
                        <td class="order-numb">
                            {{ $order->order_number }}
                        </td>
                        <td class="date">
                            {{ $order->created_at->format('M j, Y') }}
                        </td>
                        {{-- <td class="status">
                            @if ($order->order_status == 'complete')
                                <span class="badge bg-primary px-2 py-1">{{ __('Complete') }}</span>
                            @elseif ($order->order_status == 'pending')
                                <span class="badge bg-warning px-2 py-1">{{ __('Pending') }}</span>
                            @elseif ($order->order_status == 'failed')
                                <span class="badge bg-info px-2 py-1">{{ __('Failed') }}</span>
                            @elseif ($order->order_status == 'canceled')
                                <span class="badge bg-danger px-2 py-1">{{ __('Canceled') }}</span>
                            @elseif ($order->order_status == 'rejected')
                                <span class="badge px-2 py-1" style="background: rgb(138, 1, 14) !important;">{{ __('Rejected') }}</span>
                            @endif
                        </td> --}}
                        <td class="status">
                            @if ($order->hasRefundRequest && $order->refundRequest->currentTrackStatus)
                                Refund: 
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
                                    <span class="badge px-2 py-1" style="background: rgb(138, 1, 14) !important;">{{ __('Rejected') }}</span>
                                @endif
                            @endif
                        </td>
                        <td class="amount">
                            {{ float_amount_with_currency_symbol($order->paymentMeta?->total_amount) }}
                        </td>
                        {{-- <td class="table-btn">
                            <div class="btn-wrapper">

                                @if ($order->isCancelableStatus && $order->order_status == 'pending')
                                    <button onclick="confirmCancel({{ $order->id }})"
                                            class="btn btn-danger btn-sm rounded-btn">
                                        {{ __('Cancel Order') }}
                                    </button>
                                @endif
                            

                                <!-- Cancel Order Confirmation Modal -->
                                <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelOrderModalLabel">{{ __('Are you sure?') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ __('Are you sure you want to cancel this order? This action cannot be undone.') }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('No') }}</button>
                                                <a href="#" id="confirmCancelBtn" class="btn btn-danger">{{ __('Yes') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function confirmCancel(orderId) {
                                        // Set the confirmation button link dynamically
                                        document.getElementById('confirmCancelBtn').href = "{{ url('/user-home/orders/cancel') }}/" + orderId;
                                        // Show the modal
                                        var cancelModal = new bootstrap.Modal(document.getElementById('cancelOrderModal'));
                                        cancelModal.show();
                                    }
                                </script>


                                @if ($order->is_delivered_count > 0)
                                    <a href="{{ route('user.product.order.refund', $order->id) }}"
                                       class="btn btn-danger btn-sm rounded-btn">
                                        {{ __('Request refund') }}</a>
                                @endif

                                <a href="{{ route('user.product.order.details', $order->id) }}"
                                   class="btn btn-secondary btn-sm rounded-btn"> {{ __('View Details') }}</a>
                            </div>
                        </td> --}}
                        <td class="table-btn">
                            <div class="btn-wrapper">
                                @if ($order->isDeliveredStatus && !$order->hasRefundRequest)
                                    <a href="{{ route('user.product.order.refund', $order->id) }}"
                                    class="btn btn-warning btn-sm rounded-btn" title="Request Refund" style="width: 40px;">
                                        {{-- {{ __('Request Refund') }} --}}
                                        <i class="las la-undo"></i>
                                    </a>
                                @endif

                                <a href="{{ route('user.product.order.details', $order->id) }}"
                                class="btn btn-secondary btn-sm rounded-btn" title="View Details" style="width: 40px;"> 
                                    {{-- {{ __('View Details') }} --}}
                                    <i class="las la-file-alt"></i>
                                </a>
                                @if ($order->isCancelableStatus && $order->order_status == 'pending')
                                    <button class="btn btn-danger btn-sm rounded-btn swal_cancel_button" title="Cancel" data-order-id="{{ $order->id }}" style="width: 40px;">
                                        {{-- {{ __('Cancel Order') }}  --}}
                                        <i class="las la-times"></i>
                                    </button>
                                @endif

                            </div>
                        </td>

                        @section('script')
                        <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
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
                                            cancelButtonText: '{{ __('No') }}'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.ajax({
                                                    type: 'get',
                                                    url: "{{ url('/user-home/orders/cancel') }}/" + orderId,
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
                                                            Swal.fire('Error!', data.message || 'Failed to cancel order.', 'error');
                                                        }
                                                    },
                                                    error: function(xhr, status, error) {
                                                        console.error('AJAX Error:', xhr.responseText, status, error);
                                                        Swal.fire('Error!', 'Failed to cancel order.', 'error');
                                                    }
                                                });
                                            }
                                        });
                                    });
                                });
                            })(jQuery);
                        </script>
                        <x-datatable.js />
                    @endsection
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>