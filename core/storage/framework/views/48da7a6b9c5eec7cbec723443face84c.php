<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d)): ?>
<?php $attributes = $__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d; ?>
<?php unset($__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d)): ?>
<?php $component = $__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d; ?>
<?php unset($__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('My Orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('section'); ?>
    <!-- Dashboard area Starts -->
    <div class="wallet__history">
        <?php if (isset($component)) { $__componentOriginalae73592a9186217aa45553528a0de34b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalae73592a9186217aa45553528a0de34b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalae73592a9186217aa45553528a0de34b)): ?>
<?php $attributes = $__attributesOriginalae73592a9186217aa45553528a0de34b; ?>
<?php unset($__attributesOriginalae73592a9186217aa45553528a0de34b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalae73592a9186217aa45553528a0de34b)): ?>
<?php $component = $__componentOriginalae73592a9186217aa45553528a0de34b; ?>
<?php unset($__componentOriginalae73592a9186217aa45553528a0de34b); ?>
<?php endif; ?>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="<?php echo e(asset('assets/frontend/img/static/orders-shapes3.png')); ?>" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-dollar-sign"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles">
                                <?php echo e(float_amount_with_currency_symbol($total_wallet_balance)); ?>

                            </h2>
                            <span class="order-para"><?php echo e(__('Wallet Balance')); ?> </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="dashboard__card__header dashboard-settings">
                    <div class="dashboard__card__header__left">
                        <h4 class="dashboard__card__title"><?php echo e(__('Wallet History')); ?> </h4>
                        <div class="notice-board">
                            <p class="dashboard__card__para text-danger">
                                <?php echo e(__('You can deposit to your wallet from here.')); ?>

                            </p>
                        </div>
                    </div>
                    <button type="button" class="cmn_btn btn_bg_2" data-bs-toggle="modal"
                        data-bs-target="#payoutRequestModal"><?php echo e(__('Deposit To Your Wallet')); ?></button>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="single-dashboard-order table-wrap">
                    <div class="table-responsive table-responsive--md">
                        <table class="table-responsive table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('SL NO')); ?></th>
                                    <th><?php echo e(__('Sub Order ID')); ?></th>
                                    <th><?php echo e(__('Transaction ID:')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <th><?php echo e(__('Date Time')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>#<?php echo e($history->id ?? ''); ?></td>
                                        <td><?php echo e($history->sub_order_id ? '#' . $history->sub_order_id : ''); ?></td>
                                        <td><?php echo e($history->transaction_id ?? ''); ?></td>
                                        <td><?php echo e($history->amount ? float_amount_with_currency_symbol($history->amount) : ''); ?></td>
                                        <td>
                                            <span
                                                class="badge bg-<?php echo e($history->type == 4 || $history->type == 1 ? 'success' : ($history->type == 5 ? 'danger' : 'warning')); ?>">
                                                <?php if($history->type == 4): ?>
                                                    <?php echo e(__('Deposit')); ?>

                                                <?php elseif($history->type == 5): ?>
                                                    <?php echo e(__('Due to pay')); ?>

                                                <?php elseif($history->type == 1): ?>
                                                    <?php echo e(__('Incoming')); ?>

                                                <?php else: ?>
                                                    <?php echo e(__('Outgoing')); ?>

                                                <?php endif; ?>

                                            </span>
                                        </td>
                                        <td>
                                            <?php echo e($history->created_at->format('H:i:s d-m-Y')); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <?php echo $histories->links(); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Status Modal -->
    <div class="modal fade" id="payoutRequestModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
        aria-hidden="true">
        <form action="<?php echo e(route('user-home.wallet.deposit')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title text-warning" id="couponModal">
                            <?php echo e(__('You can deposit to your wallet from the available payment gateway.')); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for=""><?php echo e(__('Deposit Amount')); ?></label>
                        <input type="number" class="form-control" name="amount"
                            placeholder="<?php echo e(__('Enter Deposit Amount')); ?>">
                        <div class="confirm-bottom-content">
                            <br>
                            <?php echo render_payment_gateway_for_form(); ?>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    
    <script>
        (function($) {
            "use strict";

            $(document).on('click', '.payment-gateway-wrapper > ul > li', function(e) {
                e.preventDefault();

                let gateway = $(this).data('gateway');
                if (gateway === 'manual_payment') {
                    $('.manual_transaction_id').removeClass('d-none');
                } else {
                    $('.manual_transaction_id').addClass('d-none');
                }

                $(this).addClass('selected').siblings().removeClass('selected');
                $('.payment-gateway-wrapper').find(('input')).val($(this).data('gateway'));
                $('.payment_gateway_passing_clicking_name').val($(this).data('gateway'));
            });


            $(document).ready(function() {

                $(document).on('click', '.bodyUser_overlay', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });
                $(document).on('click', '.mobile_nav', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });

                $(document).on('click', '.edit_status_modal', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    let status = $(this).data('status');

                    $('#order_id').val(order_id);
                    $('#status').val(status);
                    $('.nice-select').niceSelect('update');
                });

            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Wallet\Resources/views/frontend/user/wallet-history.blade.php ENDPATH**/ ?>