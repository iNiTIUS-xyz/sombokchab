<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Vendor Create')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
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
                <?php if (isset($component)) { $__componentOriginal54abcd52ec2e8ec857d4d6feae648c79 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.flash','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.flash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79)): ?>
<?php $attributes = $__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79; ?>
<?php unset($__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54abcd52ec2e8ec857d4d6feae648c79)): ?>
<?php $component = $__componentOriginal54abcd52ec2e8ec857d4d6feae648c79; ?>
<?php unset($__componentOriginal54abcd52ec2e8ec857d4d6feae648c79); ?>
<?php endif; ?>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title"><?php echo e(__('Your wallet withdraw page')); ?></h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="row g-4 justify-content-center">
                            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                <div class="single-orders">
                                    <div class="orders-shapes">
                                    </div>
                                    <div class="orders-flex-content">
                                        <div class="contents">
                                            <span class="order-para ff-rubik"> <?php echo e(__('Current Balance')); ?> </span>
                                            <h2 class="order-titles">
                                                <?php echo e(float_amount_with_currency_symbol($current_balance)); ?> </h2>
                                        </div>
                                        <div class="icon">
                                            <i class="las la-tasks"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                <div class="single-orders">
                                    <div class="orders-shapes">
                                    </div>
                                    <div class="orders-flex-content">
                                        <div class="contents">
                                            <span class="order-para"> <?php echo e(__('Pending Balance')); ?> </span>
                                            <h2 class="order-titles">
                                                <?php echo e(float_amount_with_currency_symbol($pending_balance)); ?> </h2>
                                        </div>
                                        <div class="icon">
                                            <i class="las la-file-invoice-dollar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                <div class="single-orders">
                                    <div class="orders-shapes">

                                    </div>
                                    <div class="orders-flex-content">
                                        <div class="contents">
                                            <span class="order-para ff-rubik"> <?php echo e(__('Order Completed Balance')); ?> </span>
                                            <h2 class="order-titles">
                                                <?php echo e(float_amount_with_currency_symbol($total_complete_order_amount)); ?> </h2>
                                        </div>
                                        <div class="icon">
                                            <i class="las la-handshake"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                <div class="single-orders">
                                    <div class="orders-shapes">
                                    </div>
                                    <div class="orders-flex-content">
                                        <div class="contents">
                                            <span class="order-para ff-rubik"> <?php echo e(__('Total Earning')); ?> </span>
                                            <h2 class="order-titles">
                                                <?php echo e(float_amount_with_currency_symbol($total_order_amount)); ?> </h2>
                                        </div>
                                        <div class="icon">
                                            <i class="las la-dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="dashboard__card">
                                    <div class="dashboard__card__header">
                                        <h2 class="dashboard__card__title"><?php echo e(__('Withdraw information')); ?></h2>
                                    </div>
                                    <div class="dashboard__card__body custom__form mt-4">
                                        <form action="<?php echo e(route('vendor.wallet.withdraw')); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group">
                                                <label><?php echo e(__('Input withdraw amount')); ?></label>
                                                <input name="withdraw_amount" type="number" id="withdraw_amount"
                                                    min="<?php echo e(get_static_option('minimum_withdraw_amount')); ?>"
                                                    max="<?php echo e($current_balance); ?>" class="form-control"
                                                    placeholder="<?php echo e(__('Write withdraw amount')); ?>" />
                                            </div>

                                            <div class="form-group">
                                                <label><?php echo e(__('Select an gateway')); ?></label>
                                                <select name="gateway_name" class="form-control gateway-name">
                                                    <option value=""><?php echo e(__('Select an gateway')); ?></option>
                                                    <?php $__currentLoopData = $adminGateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            <?php echo e($savedGateway?->vendor_wallet_gateway_id === $gateway->id ? 'selected' : ''); ?>

                                                            value="<?php echo e($gateway->id); ?>"
                                                            data-fileds="<?php echo e(json_encode(unserialize($gateway->filed))); ?>">
                                                            <?php echo e($gateway->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="form-group gateway-information-wrapper">
                                                <?php $__currentLoopData = ($savedGateway?->fileds ? unserialize($savedGateway?->fileds) : []) ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $filed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-group">
                                                        <label><?php echo e($filed); ?></label>
                                                        <input type="text" name="gateway_filed[<?php echo e($key); ?>]"
                                                            class="form-control" value="<?php echo e($filed); ?>"
                                                            placeholder="Write <?php echo e(str_replace('_', ' ', $filed)); ?>" />
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <div class="form-group">
                                                <button class="cmn_btn btn_bg_profile"
                                                    type="submit"><?php echo e(__('Send Withdraw Request')); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="body-overlay-desktop"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).on("change", ".gateway-name", function() {
            let gatewayInformation = "";
            $(".gateway-information-wrapper").fadeOut(150);

            JSON.parse($(this).find(":selected").attr("data-fileds")).forEach(function(value, index) {
                let gateway_name = value.toLowerCase().replaceAll(" ", "_").replaceAll("-", "_");

                gatewayInformation += `
                    <div class="form-group">
                        <label>
                            ${ value }
                            <input type="text" name="gateway_filed[${ gateway_name }]" class="form-control" placeholder="Write ${ value.toLowerCase() }" />
                        </label>
                    </div>
                `;
            })

            $(".gateway-information-wrapper").html(gatewayInformation);
            $(".gateway-information-wrapper").fadeIn(250);
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.vendor-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Wallet\Resources/views/vendor/wallet-withdraw.blade.php ENDPATH**/ ?>