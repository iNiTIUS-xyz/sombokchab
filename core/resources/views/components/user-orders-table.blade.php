<div class="table-wrap table-responsive all-user-campaign-table">
    <div class="order-history-inner text-center">
        <table class="table">
            <thead>
            <tr>
                <th>
                    {{ __('#') }}
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
                    {{ __('Amount') }}
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
                            #{{ $order->id }}
                        </td>
                        <td class="order-numb">
                            {{ $order->order_number }}
                        </td>
                        <td class="date">
                            {{ $order->created_at->format('F d, Y') }}
                        </td>
                        <td class="status">
                            @if ($order->order_status == 'complete')
                                <span class="badge bg-success px-2 py-1">{{ __('Complete') }}</span>
                            @elseif ($order->order_status == 'pending')
                                <span class="badge bg-warning px-2 py-1">{{ __('Pending') }}</span>
                            @elseif ($order->order_status == 'failed')
                                <span class="badge bg-info px-2 py-1">{{ __('Failed') }}</span>
                            @elseif ($order->order_status == 'canceled')
                                <span class="badge bg-danger px-2 py-1">{{ __('Canceled') }}</span>
                            @elseif ($order->order_status == 'rejected')
                                <span class="badge px-2 py-1" style="background: rgb(138, 1, 14) !important;">{{ __('Rejected') }}</span>
                            @endif
                        </td>
                        <td class="amount">
                            {{ float_amount_with_currency_symbol($order->paymentMeta?->total_amount) }}
                        </td>
                        <td class="table-btn">
                            <div class="btn-wrapper">

                                @if ($order->isCancelableStatus && $order->order_status == 'pending')
                                    <button onclick="confirmCancel({{ $order->id }})"
                                            class="btn btn-warning btn-sm rounded-btn">
                                        {{ __('Cancel Order') }}
                                    </button>
                                @endif
                            

                                <!-- Cancel Order Confirmation Modal -->
                                <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelOrderModalLabel">{{ __('Confirm Order Cancellation') }}</h5>
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
                                   class="btn btn-secondary btn-sm rounded-btn"> {{ __('view details') }}</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>