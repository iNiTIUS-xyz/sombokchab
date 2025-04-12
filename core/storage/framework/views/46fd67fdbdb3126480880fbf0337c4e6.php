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
    <style>
        .deliveryMan__card {
            border: 1px solid rgba(221, 221, 221, 0.4);
            padding: 10px;
            border-radius: 7px;
        }

        .deliveryMan__car__details__title {
            font-size: 16px;
            font-weight: 500;
            color: var(--heading-color);
        }

        .deliveryMan__card__checkThumb {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .deliveryMan__card__left__title {
            font-size: 14px;
            font-weight: 400;
            color: var(--light-color);
        }

        .deliveryMan__card__left__rating {
            display: flex;
            align-items: flex-start;
            font-size: 14px;
            color: var(--review-color);
            gap: 2px;
        }

        .deliveryMan__card__right p {
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            color: var(--light-color);
        }

        .deliveryMan__card__thumb {
            max-width: 50px;
        }

        .file-extension-image {
            height: 100%;
        }

        .file-extension-image img {
            max-width: 100%;
            max-height: 100%;
            margin: auto;
        }

        .delivery-man-image {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .delivery-man-image-wrapper {
            height: 100px;
            width: 40%;
            margin: auto;
            display: flex;
            justify-content: center;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('My Orders')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-recent-order">
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($component)) { $__componentOriginalef2154c4b1054a3a28aacfea8e05a555 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalef2154c4b1054a3a28aacfea8e05a555 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('flash-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalef2154c4b1054a3a28aacfea8e05a555)): ?>
<?php $attributes = $__attributesOriginalef2154c4b1054a3a28aacfea8e05a555; ?>
<?php unset($__attributesOriginalef2154c4b1054a3a28aacfea8e05a555); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalef2154c4b1054a3a28aacfea8e05a555)): ?>
<?php $component = $__componentOriginalef2154c4b1054a3a28aacfea8e05a555; ?>
<?php unset($__componentOriginalef2154c4b1054a3a28aacfea8e05a555); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6)): ?>
<?php $attributes = $__attributesOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6; ?>
<?php unset($__attributesOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6)): ?>
<?php $component = $__componentOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6; ?>
<?php unset($__componentOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6); ?>
<?php endif; ?>
            </div>

            <div class="col-md-12">
                <div class="dashboard__card dashboard-table bg-white">
                    <div id="product-list-title-flex"
                        class="dashboard__card__header product-list-title-flex d-flex flex-wrap align-items-center justify-content-between">
                        <h3 class="dashboard__card__title cursor-pointer"><?php echo e(__('Search Delivery Man Module')); ?> <i
                                class="las la-angle-down"></i>
                        </h3>
                        <button id="product-search-button" type="submit"
                            class="cmn_btn btn_bg_profile btn-sm"><?php echo e(__('Search')); ?></button>
                    </div>
                    <form id="delivery-man-search-form"
                        action="<?php echo e(route('admin.assign-delivery-man.delivery-man-search')); ?>" method="GET">
                        <div class="dashboard__card__body custom__form mt-4">
                            <div class="row g-4">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="label-1" for="search-name"><?php echo e(__('Name')); ?></label>
                                        <input name="name" class="form--control input-height-1" id="search-name"
                                            value="<?php echo e(request()->name ?? old('name')); ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="label-1" for="search-email"><?php echo e(__('Email')); ?></label>
                                        <input name="email" class="form--control input-height-1" id="search-email"
                                            value="<?php echo e(request()->email ?? old('email')); ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="label-1" for="search-number"><?php echo e(__('Number')); ?></label>
                                        <input name="number" class="form--control input-height-1" id="search-number"
                                            value="<?php echo e(request()->number ?? old('number')); ?>" />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="label-1" for="search-zone"><?php echo e(__('Zone')); ?></label>
                                        <select name="zone_id" id="search-zone" class="form-control">
                                            <option value=""><?php echo e(__('Select delivery zone')); ?></option>
                                            <?php $__currentLoopData = $all_zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleZone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($singleZone->id == $request->zone_id ? 'selected' : ''); ?>

                                                    value="<?php echo e($singleZone->id); ?>"><?php echo e($singleZone->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-deliveryWrap mt-4">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <div class="dashboard__card__header__left">
                            <h2 class="dashboard__card__title"><?php echo e(__('Order Information')); ?></h2>
                        </div>
                    </div>
                    <div class="dashboard__card__body dashboard-orderInfo mt-4">
                        <div class="row g-4">
                            <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                <div class="dashboard__card dashboard-orderInfo-item radius-10">
                                    <div class="dashboard__card__header dashboard-orderInfo-item-top">
                                        <div class="dashboard__card__header__left">
                                            <h4 class="dashboard__card__title"><?php echo e(__('Order ID:')); ?>

                                                <span class="dashboard-orderInfo-item-title-id"><?php echo e($order->id); ?></span>
                                            </h4>
                                            <p class="dashboard__card__para dashboard-orderInfo-item-para mt-2">
                                                <?php echo e(__('Date of Order:')); ?>

                                                <span><?php echo e($order->created_at?->format('d M Y')); ?></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="dashboard__card__body dashboard-orderInfo-item-contents mt-4">

                                        <div class="request__item dashboard-orderInfo-item-contents-type">
                                            <span
                                                class="request__left dashboard-orderInfo-item-contents-type-left"><?php echo e(__('Status:')); ?></span>
                                            <span class="status_btn completed radius-5"><?php echo e($order->status); ?></span>
                                        </div>
                                        <div class="request__item dashboard-orderInfo-item-contents-type">
                                            <span
                                                class="dashboard-orderInfo-item-contents-type-left"><?php echo e(__('Payment Status:')); ?></span>
                                            <span
                                                class="status_btn cancel radius-5 text-capitalize"><?php echo e($order->payment_status); ?></span>
                                        </div>
                                        <div class="request__item dashboard-orderInfo-item-contents-type">
                                            <span
                                                class="dashboard-orderInfo-item-contents-type-left"><?php echo e(__('Payment Method:')); ?></span>
                                            <span
                                                class="dashboard-orderInfo-item-contents-type-right delivery"><?php echo e($order->payment_gateway); ?></span>
                                        </div>
                                        <div class="request__item dashboard-orderInfo-item-contents-type">
                                            <span
                                                class="dashboard-orderInfo-item-contents-type-left"><?php echo e(__('Order Type:')); ?></span>
                                            <span
                                                class="status_btn completed radius-5 text-capitalize"><?php echo e($order->order_status); ?></span>
                                        </div>
                                        <div class="request__item dashboard-orderInfo-item-contents-type">
                                            <span
                                                class="dashboard-orderInfo-item-contents-type-left"><?php echo e(__('Total Payment:')); ?></span>
                                            <span
                                                class="dashboard-orderInfo-item-contents-type-right price"><?php echo e(float_amount_with_currency_symbol($order->paymentMeta?->total_amount ?? 0)); ?></span>
                                        </div>

                                        <div class="edit-profile-btn-wrapper mt-4">
                                            <a href="<?php echo e(route('admin.orders.generate.invoice', $order->id)); ?>"
                                                class="edit-profile dashboard-bg radius-5">
                                                <i class="las la-print"></i>
                                                <?php echo e(__('Print Invoice')); ?>

                                            </a>

                                            <?php if($order->delivery_man_count): ?>
                                                <button type="button"
                                                    class="btn btn-primary dashboard-bg radius-5 change-delivery-man">
                                                    <?php echo e(__('Change delivery man')); ?>

                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="dashboard-orderInfo-item-top mt-4">
                                        <h4 class="dashboard-orderInfo-item-title"><?php echo e(__('Delivery Information')); ?></h4>
                                    </div>

                                    <hr>

                                    <?php
                                        $deliveryOrderAddress = '';

                                        if ($order->address?->country?->address ?? false) {
                                            if (!empty($deliveryOrderAddress)) {
                                                $deliveryOrderAddress .= ', ';
                                            }
                                            $deliveryOrderAddress .= $order->address?->country?->address;
                                        }

                                        if ($order->address?->city?->name ?? false) {
                                            if (!empty($deliveryOrderAddress)) {
                                                $deliveryOrderAddress .= ', ';
                                            }
                                            $deliveryOrderAddress .= $order->address?->city?->name;
                                        }

                                        if ($order->address?->state?->name ?? false) {
                                            if (!empty($deliveryOrderAddress)) {
                                                $deliveryOrderAddress .= ', ';
                                            }
                                            $deliveryOrderAddress .= $order->address?->state?->name;
                                        }

                                        if ($order->address?->country?->name ?? false) {
                                            if (!empty($deliveryOrderAddress)) {
                                                $deliveryOrderAddress .= ', ';
                                            }
                                            $deliveryOrderAddress .= $order->address?->country?->name;
                                        }

                                        if ($order->address->zip_code ?? false) {
                                            if (!empty($deliveryOrderAddress)) {
                                                $deliveryOrderAddress .= ', ';
                                            }
                                            $deliveryOrderAddress .= $order->address->zip_code;
                                        }
                                    ?>

                                    <div class="request__item dashboard-orderInfo-item-contents-type">
                                        <span
                                            class="dashboard-orderInfo-item-contents-type-left"><?php echo e(__('Name:')); ?></span>
                                        <span class="dashboard-orderInfo-item-contents-type-right">
                                            <?php echo e($order->address?->name); ?>

                                        </span>
                                    </div>

                                    <div class="request__item dashboard-orderInfo-item-contents-type">
                                        <span
                                            class="dashboard-orderInfo-item-contents-type-left"><?php echo e(__('Contact Number:')); ?></span>
                                        <span class="dashboard-orderInfo-item-contents-type-right">
                                            <?php echo e($order->address?->phone); ?>

                                        </span>
                                    </div>

                                    <div class="request__item dashboard-orderInfo-item-contents-type">
                                        <span
                                            class="dashboard-orderInfo-item-contents-type-left"><?php echo e(__('email:')); ?></span>
                                        <span class="dashboard-orderInfo-item-contents-type-right">
                                            <?php echo e($order->address?->email); ?>

                                        </span>
                                    </div>

                                    <div class="request__item dashboard-delivery-location border-top-1">
                                        <span class="dashboard-delivery-location-para">
                                            <?php echo e(__('Delivery Address:')); ?>

                                        </span>
                                        <a href="#1" class="dashboard-delivery-location-para">
                                            <i class="las la-map-marker-alt"></i>
                                            <?php echo e($deliveryOrderAddress); ?>

                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                <?php if($order->delivery_man_count > 0): ?>
                                    <div class="dashboard__card assign-delivery-man-details">
                                        <div class="dashboard__card__header">
                                            <h3 class="dashboard__card__title"><?php echo e(__('Assigned Delivery Man')); ?></h3>
                                        </div>

                                        <div class="dashboard__card__body mt-4">
                                            <div
                                                class="d-flex flex-column justify-content-between align-items-center assigned-delivery-man-wrapper">
                                                <div class="delivery-man-image-wrapper">
                                                    <?php echo render_image(
                                                        $order->deliveryMan?->deliveryMan?->profile_img,
                                                        class: 'delivery-man-image-class',
                                                        custom_path: \Modules\DeliveryMan\Services\AdminDeliveryManServices::IMAGE_DIRECTORY,
                                                    ); ?>

                                                </div>

                                                <div class="delivery-man-information w-100 mt-4">
                                                    <?php
                                                        $deliveryMan = $order->deliveryMan?->deliveryMan;

                                                        $assign = true;
                                                    ?>

                                                    <?php echo $__env->make('deliveryman::admin.assign-delivery-man.delivery-man-details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div
                                    class="dashboard__card dashboard-orderInfo-item show-delivery-man radius-10 <?php echo e($order->delivery_man_count > 0 ? 'd-none' : ''); ?>">
                                    <div class="dashboard__card__header dashboard-orderInfo-item-top">
                                        <h4 class="dashboard__card__title dashboard-orderInfo-item-title">
                                            <?php echo e(__('Delivery Man List')); ?></h4>
                                    </div>
                                    <div class="dashboard__card__body mt-4">
                                        <div class="dashboard-orderInfo-item-contents" id="delivery-man-cards-wrapper">
                                            <?php echo $__env->make('deliveryman::admin.assign-delivery-man.delivery-man-result', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                <?php if($order->delivery_man_count > 0): ?>
                                    <div class="dashboard__card assign-delivery-man-information assign-delivery-man-details">
                                        <div class="dashboard__card__header">
                                            <h3 class="dashboard__card__title"><?php echo e(__('Delivery Information')); ?></h3>
                                        </div>
                                        <div class="dashboard__card__body custom__form mt-4">
                                            <div>
                                                <div class="dashboard-input">
                                                    <label for="commission_type" class="dashboard-label">
                                                        <?php echo e(__('Delivery Man Pickup Point')); ?>

                                                    </label>
                                                    <div class="dashboard-input-select">
                                                        <div class="single-input">
                                                            <input class="form-control" type="text" disabled readonly
                                                                value="<?php echo e($order->deliveryMan?->pickupPoint?->name); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if($order->deliveryMan->deliveryMan?->delivery_man_type !== 'Employee'): ?>
                                                    <div class="dashboard-input">
                                                        <label for="commission_type"
                                                            class="dashboard-label"><?php echo e(__('Commission Type')); ?></label>
                                                        <div class="dashboard-input-select">
                                                            <div class="single-input">
                                                                <input class="form-control" type="text" disabled
                                                                    readonly
                                                                    value="<?php echo e($order->deliveryMan?->commission_type); ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="dashboard-input">
                                                        <label for="commission_amount" class="dashboard-label">
                                                            <?php echo e(__('Commission Amount')); ?>

                                                        </label>
                                                        <div class="dashboard-input-select">
                                                            <div class="single-input">
                                                                <input class="form-control" type="text" disabled
                                                                    readonly
                                                                    value="<?php echo e($order->deliveryMan?->commission_amount); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="dashboard-input">
                                                    <label
                                                        class="dashboard-label"><?php echo e(__('Delivery Date & Time')); ?></label>
                                                    <div class="dashboard-input-select">
                                                        <div class="single-input">
                                                            <input type="text" disabled readonly class="form-control"
                                                                value="<?php echo e($order?->deliveryMan?->delivery_date ?? ''); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div
                                    class="dashboard__card dashboard-orderInfo-item show-delivery-man radius-10 <?php echo e($order->delivery_man_count > 0 ? 'd-none' : ''); ?>">
                                    <div class="dashboard__card__header dashboard-orderInfo-item-top">
                                        <h4 class="dashboard__card__title dashboard-orderInfo-item-title">
                                            <?php echo e(__('Assign Delivery Man')); ?></h4>
                                    </div>
                                    <div class="dashboard__card__body custom__form mt-4">
                                        <div id="delivery_man_details" class="dashboard-orderInfo-item-contents">

                                        </div>
                                        <form action="<?php echo e(route('admin.assign-delivery-man.assign', $order->id)); ?>"
                                            method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>

                                            <input type="hidden" id="delivery_man_id" name="delivery_man_id" />

                                            <div id="delivery_man_commission_fields" class="mb-4">

                                            </div>

                                            <div class="dashboard-input">
                                                <label class="dashboard-label"><?php echo e(__('Delivery Date & Time')); ?></label>
                                                <div class="dashboard-input-select">
                                                    <div class="single-input">
                                                        <input name="date" type="date"
                                                            class="form--control flat_picker_date"
                                                            placeholder="<?php echo e(__('Delivery Date')); ?>">
                                                    </div>
                                                    <div class="single-input mt-4">
                                                        <input name="time" type="time"
                                                            class="form--control flat_picker_time"
                                                            placeholder="<?php echo e(__('Delivery Time')); ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <?php if($order->delivery_man_count > 0): ?>
                                                <div class="edit-profile-btn-wrapper center-text mt-4">
                                                    <button type="submit"
                                                        class="cmn_btn btn_bg_profile edit-profile dashboard-bg radius-5 w-100"><?php echo e(__('Change Delivery man')); ?></button>
                                                </div>
                                            <?php else: ?>
                                                <div class="edit-profile-btn-wrapper center-text mt-4">
                                                    <button type="submit"
                                                        class="cmn_btn btn_bg_profile edit-profile dashboard-bg radius-5 w-100"><?php echo e(__('Assign Delivery man')); ?></button>
                                                </div>
                                            <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).on("click", ".change-delivery-man", function() {
            $('.assign-delivery-man-details').addClass("d-none");
            $('.show-delivery-man').removeClass("d-none");
        });

        // search delivery man module
        $(document).on("click", "#product-search-button", function(e) {
            e.preventDefault();
            // get form data and make it as an string
            const actionUrl = $("#delivery-man-search-form").attr("action");
            const urlString = parseFormDataAsString(document.getElementById("delivery-man-search-form"));
            // this line of code will change url
            changeUrlWithoutReload(urlString);
            // now run a ajax request

            send_ajax_request("GET", "", actionUrl + "?" + urlString, () => {}, (data) => {
                // get all cards from response
                $("#delivery-man-cards-wrapper").html(data);
            }, (errors) => {
                prepare_errors(errors)
            })
        });

        // get delivery man details from ajax request when change or checked
        $(document).on("change", ".delivery-man-input", function() {
            // do action here
            // send ajax request for fetching data from url
            let currentValue = $(this).val();

            send_ajax_request("GET", "", "<?php echo e(route('admin.assign-delivery-man.delivery-man-details')); ?>/" + $(this)
                .val(), () => {
                    // before request sent
                    $("#delivery_man_id").val('');
                }, (data) => {
                    // this is success method
                    $("#delivery_man_id").val(currentValue);
                    $("#delivery_man_details").html(data.html)

                    // check if delivery man type is not employee then show commission type and commission amount fields into the form
                    // load those field from controller
                    $("#delivery_man_commission_fields").html(data.fields);
                }, (errors) => {
                    // do some work if needed when your request is contain any error
                    // error mean's request status 422 mean's validation error
                    prepare_errors(errors) // this method will show toastr message
                })
        })

        // first get specific delivery zone delivery man
        $(document).on("change", "#delivery-man-zone", function() {
            // check this value is not empty
            if ($(this).val().length < 1) return;

            // now get data from ajax request
            send_ajax_request("get", null, '<?php echo e(route('admin.assign-delivery-man.find-delivery-man')); ?>', () => {},
                (data) => {
                    // do success work
                }, (errors) => {
                    // do some work if needed when your request is contain any error
                    // error mean's request status 422 mean's validation error
                    prepare_errors(errors) // this method will show toastr message
                })
        })

        $("#delivery-man-search-form").fadeOut();

        $(document).on("click", "#product-list-title-flex h3", function() {
            $("#delivery-man-search-form").fadeToggle();
        })

        $(document).ready(function() {
            $(".flat_picker_date").flatpickr({
                enableTime: false,
                dateFormat: "d-m-Y"
            });

            $(".flat_picker_time").flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i"
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/DeliveryMan\Resources/views/admin/assign-delivery-man/assign.blade.php ENDPATH**/ ?>