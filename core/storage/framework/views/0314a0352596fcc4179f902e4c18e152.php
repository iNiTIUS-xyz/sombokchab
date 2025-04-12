<div class="table-wrap table-responsive all-user-campaign-table">
    <div class="order-history-inner text-center">
        <table class="table">
            <thead>
            <tr>
                <th>
                    <?php echo e(__('#')); ?>

                </th>
                <th>
                    <?php echo e(__('Tracking Number')); ?>

                </th>
                <th>
                    <?php echo e(__('Date')); ?>

                </th>
                <th>
                    <?php echo e(__('Status')); ?>

                </th>
                <th>
                    <?php echo e(__('Amount')); ?>

                </th>
                <th>
                    <?php echo e(__('Action')); ?>

                </th>
            </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $allOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="completed">
                        <td class="order-numb">
                            #<?php echo e($order->id); ?>

                        </td>
                        <td class="order-numb">
                            <?php echo e($order->order_number); ?>

                        </td>
                        <td class="date">
                            <?php echo e($order->created_at->format('F d, Y')); ?>

                        </td>
                        <td class="status">
                            <?php if($order->order_status == 'complete'): ?>
                                <span class="badge bg-success px-2 py-1"><?php echo e(__('Complete')); ?></span>
                            <?php elseif($order->order_status == 'pending'): ?>
                                <span class="badge bg-warning px-2 py-1"><?php echo e(__('Pending')); ?></span>
                            <?php elseif($order->order_status == 'failed'): ?>
                                <span class="badge bg-info px-2 py-1"><?php echo e(__('Failed')); ?></span>
                            <?php elseif($order->order_status == 'canceled'): ?>
                                <span class="badge bg-danger px-2 py-1"><?php echo e(__('Canceled')); ?></span>
                            <?php elseif($order->order_status == 'rejected'): ?>
                                <span class="badge px-2 py-1" style="background: rgb(138, 1, 14) !important;"><?php echo e(__('Rejected')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="amount">
                            <?php echo e(float_amount_with_currency_symbol($order->paymentMeta?->total_amount)); ?>

                        </td>
                        <td class="table-btn">
                            <div class="btn-wrapper">

                                <?php if($order->isCancelableStatus && $order->order_status == 'pending'): ?>
                                    <button onclick="confirmCancel(<?php echo e($order->id); ?>)"
                                            class="btn btn-warning btn-sm rounded-btn">
                                        <?php echo e(__('Cancel Order')); ?>

                                    </button>
                                <?php endif; ?>
                            

                                <!-- Cancel Order Confirmation Modal -->
                                <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelOrderModalLabel"><?php echo e(__('Confirm Order Cancellation')); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><?php echo e(__('Are you sure you want to cancel this order? This action cannot be undone.')); ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('No')); ?></button>
                                                <a href="#" id="confirmCancelBtn" class="btn btn-danger"><?php echo e(__('Yes')); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function confirmCancel(orderId) {
                                        // Set the confirmation button link dynamically
                                        document.getElementById('confirmCancelBtn').href = "<?php echo e(url('/user-home/orders/cancel')); ?>/" + orderId;
                                        // Show the modal
                                        var cancelModal = new bootstrap.Modal(document.getElementById('cancelOrderModal'));
                                        cancelModal.show();
                                    }
                                </script>


                                <?php if($order->is_delivered_count > 0): ?>
                                    <a href="<?php echo e(route('user.product.order.refund', $order->id)); ?>"
                                       class="btn btn-danger btn-sm rounded-btn">
                                        <?php echo e(__('Request refund')); ?></a>
                                <?php endif; ?>

                                <a href="<?php echo e(route('user.product.order.details', $order->id)); ?>"
                                   class="btn btn-secondary btn-sm rounded-btn"> <?php echo e(__('view details')); ?></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/components/user-orders-table.blade.php ENDPATH**/ ?>