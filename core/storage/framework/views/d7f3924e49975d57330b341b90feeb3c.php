<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Checkout')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/toastr.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/payment.css')); ?>">
    <?php if (isset($component)) { $__componentOriginal112ae6ec8d060969821a9f1e2b268f0e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal112ae6ec8d060969821a9f1e2b268f0e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.loader.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('loader.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal112ae6ec8d060969821a9f1e2b268f0e)): ?>
<?php $attributes = $__attributesOriginal112ae6ec8d060969821a9f1e2b268f0e; ?>
<?php unset($__attributesOriginal112ae6ec8d060969821a9f1e2b268f0e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal112ae6ec8d060969821a9f1e2b268f0e)): ?>
<?php $component = $__componentOriginal112ae6ec8d060969821a9f1e2b268f0e; ?>
<?php unset($__componentOriginal112ae6ec8d060969821a9f1e2b268f0e); ?>
<?php endif; ?>
    <style>
        .user-shipping-address-item.active .btn-outline-primary {
            color: #fff !important;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .checkout-shipping-method:hover {
            cursor: pointer;
        }

        .shippingMethod__wrapper {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            flex-wrap: wrap;
        }

        .shippingMethod__wrapper__item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 20px;
            border: 1px solid var(--border-color);
            background-color: var(--white);
        }

        .shippingMethod__wrapper__item.active {
            background-color: var(--main-color-one);
            border-color: var(--main-color-one);
            color: var(--white);
        }

        .shippingMethod__wrapper__item.active h6 {
            color: var(--white);
        }

        .shippingMethod__wrapper__item.active p {
            color: var(--white);
        }

        .checkout__card__footer__estimate__main {
            width: 230px;
            max-width: 300px;
        }

        .checkout__card__footer__estimate__item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 16px;
            font-weight: 400;
            line-height: 20px;
            color: var(--paragraph-color);
        }

        .checkout__card__footer__estimate__item:not(:last-child) {
            margin-bottom: 12px;
        }

        .shippingMethod__wrapper {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            flex-wrap: wrap;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php
    $carts = Cart::instance('default')->content();
    $itemsTotal = null;
    $enableTaxAmount = !\Modules\TaxModule\Services\CalculateTaxServices::isPriceEnteredWithTax();
    $shippingTaxClass = \Modules\TaxModule\Entities\TaxClassOption::where('class_id', get_static_option('shipping_tax_class'))->sum('rate');
    $tax = Modules\TaxModule\Services\CalculateTaxBasedOnCustomerAddress::init();
    $uniqueProductIds = $carts
    ->pluck('id')
    ->unique()
    ->toArray();

    $country_id = old('country_id') ?? 0;
    $state_id = old('state_id') ?? 0;
    $city_id = old('city') ?? 0;

    if (empty($uniqueProductIds)) {
    $taxProducts = collect([]);
    } else {
    if (\Modules\TaxModule\Services\CalculateTaxBasedOnCustomerAddress::is_eligible()) {
    $taxProducts = $tax
        ->productIds($uniqueProductIds)
        ->customerAddress($country_id, $state_id, $city_id)
        ->generate();
    } else {
    $taxProducts = collect([]);
    }
    }

    $carts = $carts->groupBy('options.vendor_id');

    $vendors = \Modules\Vendor\Entities\Vendor::with('shippingMethod', 'shippingMethod.zone')
    ->whereIn('id', $carts->keys())
    ->get();
?>

<?php $__env->startSection('content'); ?>
    <?php if($all_cart_items->count() > 0): ?>
        <div class="checkout-area-wrapper padding-top-20 padding-bottom-20">
            <div class="container">
                <?php if(!auth('web')->check()): ?>
                    <?php echo $__env->make('frontend.cart.partials.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <form action="<?php echo e(route('frontend.checkout')); ?>" class="billing-form checkout-billing-form" method="POST"
                    id="billing_info" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row g-4">
                        <div class="col-md-7 col-lg-7">
                            <?php if (isset($component)) { $__componentOriginalc28e9eb93bd068d65f007fa95d367024 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc28e9eb93bd068d65f007fa95d367024 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.stock_error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.stock_error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc28e9eb93bd068d65f007fa95d367024)): ?>
<?php $attributes = $__attributesOriginalc28e9eb93bd068d65f007fa95d367024; ?>
<?php unset($__attributesOriginalc28e9eb93bd068d65f007fa95d367024); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc28e9eb93bd068d65f007fa95d367024)): ?>
<?php $component = $__componentOriginalc28e9eb93bd068d65f007fa95d367024; ?>
<?php unset($__componentOriginalc28e9eb93bd068d65f007fa95d367024); ?>
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

                            <div class="checkout-inner-content">
                                <div class="billing-details-area-wrapper">
                                    <?php if(auth('web')->check()): ?>
                                        <div class="btn-wrapper">
                                            <button type="button"
                                                class="cmn-btn btn-bg-1 billing_details_click btn-small"><?php echo e(__('New Shipping Address')); ?></button>
                                        </div>
                                    <?php endif; ?>
                                        <div class="flex-start mt-4 user-shipping-address-wrapper d-flex position-relative">
                                            <?php $__currentLoopData = $all_user_shipping ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping_address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo $__env->make('frontend.cart.partials.shipping-address-option', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php echo csrf_field(); ?>

                                    <input type="hidden" name="coupon" id="coupon_code"
                                        value="<?php echo e(old('coupon') ?? request()->coupon); ?>">
                                    <input type="hidden" name="tax_amount">
                                    <input type="hidden" name="ship_to_another_address" id="ship_to_another_address">
                                    <input type="hidden" name="selected_shipping_option"
                                        value="<?php echo e($default_shipping->id); ?>">
                                    <input type="hidden" name="selected_payment_gateway"
                                        value="<?php echo e(get_static_option('site_default_payment_gateway')); ?>">
                                    <input type="hidden" name="agree" id="term_agree">
                                    <input type="file" name="cheque_payment_input" id="cheque_payment" class="d-none">
                                    <input type="file" name="bank_transfer_input" id="bank_transfer" class="d-none">
                                    <?php echo $__env->make('frontend.cart.partials.billing-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>

                                <div class="cart-items-wrapper">
                                    <?php echo $__env->make('frontend.cart.cart-items.cart-items-wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 col-lg-5">
                            <?php echo $__env->make('frontend.cart.partials.order-summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="row padding-top-100 padding-bottom-100">
            <div class="col-md-8 m-auto">
                <?php if (isset($component)) { $__componentOriginalc28e9eb93bd068d65f007fa95d367024 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc28e9eb93bd068d65f007fa95d367024 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.stock_error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.stock_error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc28e9eb93bd068d65f007fa95d367024)): ?>
<?php $attributes = $__attributesOriginalc28e9eb93bd068d65f007fa95d367024; ?>
<?php unset($__attributesOriginalc28e9eb93bd068d65f007fa95d367024); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc28e9eb93bd068d65f007fa95d367024)): ?>
<?php $component = $__componentOriginalc28e9eb93bd068d65f007fa95d367024; ?>
<?php unset($__componentOriginalc28e9eb93bd068d65f007fa95d367024); ?>
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

                <div class="w-50 m-auto">
                    <?php if (isset($component)) { $__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.page.empty','data' => ['image' => get_static_option('empty_cart_image'),'text' => filter_static_option_value(
                        'checkout_page_no_product_text',
                        $setting_text,
                        __('No products in your cart!'),
                    )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.page.empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('empty_cart_image')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(filter_static_option_value(
                        'checkout_page_no_product_text',
                        $setting_text,
                        __('No products in your cart!'),
                    ))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d)): ?>
<?php $attributes = $__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d; ?>
<?php unset($__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d)): ?>
<?php $component = $__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d; ?>
<?php unset($__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d); ?>
<?php endif; ?>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <div class="popup_modal_checkout_overlay"></div>

    <div class="checkout-inner-content popup_modal_checkout">
        <div class="billing-details-area-wrapper position-relative">
            <div class="d-flex justify-content-end position-absolute top-0 right-0 w-100">
                <h3 class="title d-none">
                    <?php echo e(filter_static_option_value('checkout_billing_section_title', $setting_text, __('Billing details'))); ?>

                </h3>
                <div class="checkout_modal_close"><i class="las la-times"></i> </div>
            </div>
            <form action="<?php echo e(route('frontend.checkout')); ?>" class="billing-form" method="POST" id="shopping_address"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <?php
                    $modal = true;
                ?>

                <?php echo $__env->make('frontend.cart.partials.billing-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </form>

            
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalb2218846a3b052d68d61d1d2b4cea3a8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb2218846a3b052d68d61d1d2b4cea3a8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.loader.html','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('loader.html'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb2218846a3b052d68d61d1d2b4cea3a8)): ?>
<?php $attributes = $__attributesOriginalb2218846a3b052d68d61d1d2b4cea3a8; ?>
<?php unset($__attributesOriginalb2218846a3b052d68d61d1d2b4cea3a8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb2218846a3b052d68d61d1d2b4cea3a8)): ?>
<?php $component = $__componentOriginalb2218846a3b052d68d61d1d2b4cea3a8; ?>
<?php unset($__componentOriginalb2218846a3b052d68d61d1d2b4cea3a8); ?>
<?php endif; ?>
    <input type="hidden" value="" id="checkout_tax_percentage" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC-p_XBbow_dJCi5TKLw69gIXITC4hvkE&libraries=places&callback=initialize" async defer></script>

<script>
    function initialize() {
        // Prevent 'enter' key from submitting the form when picking place
        $('form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

        const geocoder = new google.maps.Geocoder();

        // 1) Set default lat/lng for Phnom Penh (or wherever you like)
        let latitude = parseFloat(document.getElementById("address-latitude").value) || 11.5564;
        let longitude = parseFloat(document.getElementById("address-longitude").value) || 104.9282;

        // 2) Create the map
        const map = new google.maps.Map(document.getElementById("address-map"), {
            center: { lat: latitude, lng: longitude },
            zoom: 13,
        });

        // 3) Create a draggable marker
        const marker = new google.maps.Marker({
            map: map,
            position: { lat: latitude, lng: longitude },
            draggable: true,
            visible: true
        });

        // 4) Autocomplete for the floating input (#address-input)
        const locationInput = document.getElementById("address-input");
        const autocomplete = new google.maps.places.Autocomplete(locationInput);

        google.maps.event.addListener(autocomplete, "place_changed", function () {
            marker.setVisible(false);
            const place = autocomplete.getPlace();

            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                locationInput.value = "";
                return;
            }

            // Center the map on the selected place
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            // Move the marker
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            // Update hidden lat/lng fields
            const lat = place.geometry.location.lat();
            const lng = place.geometry.location.lng();
            setLocationCoordinates(lat, lng);

            // Update the "id=address" input
            if (place.formatted_address) {
                document.getElementById("address").value = place.formatted_address;
            } else {
                document.getElementById("address").value = place.name || "";
            }
        });

        // 5) If the user drags the marker, reverse geocode the new position
        google.maps.event.addListener(marker, "dragend", function (e) {
            const lat = e.latLng.lat();
            const lng = e.latLng.lng();
            setLocationCoordinates(lat, lng);

            geocoder.geocode({ location: { lat, lng } }, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK && results[0]) {
                    // Update both inputs
                    locationInput.value = results[0].formatted_address;
                    document.getElementById("address").value = results[0].formatted_address;
                } else {
                    console.error("Geocoder failed: " + status);
                }
            });
        });

        // 6) If the user types in #address (main shipping address), geocode on "blur" or "change"
        const addressEl = document.getElementById("address");
        addressEl.addEventListener("change", function() {
            geocodeAddress(addressEl.value, geocoder, map, marker);
        });
        // You could also do:
        // addressEl.addEventListener("blur", function() {
        //    geocodeAddress(addressEl.value, geocoder, map, marker);
        // });

        // Helper: geocode the typed address, move the marker & update fields
        function geocodeAddress(address, geocoder, map, marker) {
            if (!address) return;
            geocoder.geocode({ address: address }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK && results[0]) {
                    const latLng = results[0].geometry.location;
                    map.setCenter(latLng);
                    map.setZoom(17);
                    marker.setPosition(latLng);

                    // Update hidden fields
                    const lat = latLng.lat();
                    const lng = latLng.lng();
                    setLocationCoordinates(lat, lng);

                    // Update the floating input
                    locationInput.value = results[0].formatted_address;
                } else {
                    console.error("Geocode was not successful: " + status);
                }
            });
        }

        // Helper to set lat/lng in hidden fields
        function setLocationCoordinates(lat, lng) {
            document.getElementById("address-latitude").value = lat;
            document.getElementById("address-longitude").value = lng;
        }
    }
</script>


    <script>
        <?php if(get_static_option('tax_system') == 'advance_tax_system'): ?>
            $(document).on("change", "#country_id", function() {
                let country_id = $(this).val();

                send_ajax_request("get", "",
                    `<?php echo e(route('frontend.get-tax-based-on-billing-address')); ?>?country_id=${country_id}&state_id=&city_id=`,
                    () => {}, (data) => {
                        // do success action hare
                        $('.cart-items-wrapper').html(data.cart_items);

                        let statehtml = "<option value=''> <?php echo e(__('Select an state')); ?> </option>";
                        data?.states?.forEach((state) => {
                            statehtml += "<option value='" + state.id + "'>" + state.name + "</option>";
                        });

                        $(this).parent().parent().find(".select-state").html(statehtml);
                        calculateOrderSummeryForAdvanceTax();
                    }, (errors) => {
                        prepare_errors(errors);
                    })
            });

            $(document).on("change", "#state_id", function() {
                let country_id = $("#country_id").val();
                let state_id = $("#state_id").val();

                send_ajax_request("get", "",
                    `<?php echo e(route('frontend.get-tax-based-on-billing-address')); ?>?country_id=${country_id}&state_id=${state_id}&city_id=`,
                    () => {}, (data) => {
                        // do success action hare
                        $('.cart-items-wrapper').html(data.cart_items);

                        let cityhtml = "<option value=''> <?php echo e(__('Select an city')); ?> </option>";
                        data?.cities?.forEach((city) => {
                            cityhtml += "<option value='" + city.id + "'>" + city.name + "</option>";
                        });

                        $("#city_id").html(cityhtml);

                        calculateOrderSummeryForAdvanceTax();
                    }, (errors) => {
                        prepare_errors(errors);
                    })
            });

            $(document).on("change", "#city_id", function() {
                let country_id = $("#country_id").val();
                let state_id = $("#state_id").val();
                let city_id = $("#city_id").val();

                send_ajax_request("get", "",
                    `<?php echo e(route('frontend.get-tax-based-on-billing-address')); ?>?country_id=${country_id}&state_id=${state_id}&city_id=${city_id}`,
                    () => {}, (data) => {
                        // do success action hare
                        $('.cart-items-wrapper').html(data.cart_items);
                        calculateOrderSummeryForAdvanceTax();
                    }, (errors) => {
                        prepare_errors(errors);
                    })
            });

            function getTotalTax() {
                let totalAmount = 0;

                $(".vendor_tax_amount").each(function() {
                    let st = $(this).text();

                    if (st.includes("Inclusive Tax")) {
                        totalAmount += 0;
                    } else {
                        totalAmount += replaceSymbol(st);
                    }
                });

                return totalAmount;
            }

            function calculateOrderSummeryForAdvanceTax() {
                let discountAmount = Number($("#coupon_amount").text().trim().replace("<?php echo e(site_currency_symbol()); ?>", ""))
                let subTotal = getSubTotals();
                let totalTax = getTotalTax();
                let totalShippingCost = getTotalShippingCost();
                let decimalPoint = 1;

                let vendorTaxAmount = '';

                $(".vendor_tax_amount").each(function() {
                    let st = $(this).text();

                    if (st.includes("<?php echo e(__('Inclusive Tax')); ?>")) {
                        vendorTaxAmount = "<?php echo e(__('Inclusive Tax')); ?>";
                    } else {
                        vendorTaxAmount = 0;
                    }
                });

                <?php if($enableTaxAmount): ?>
                    $("#checkout_tax_amount").text(amount_with_currency_symbol(totalTax.toFixed(decimalPoint)))
                <?php else: ?>
                    $("#checkout_tax_amount").text("<?php echo e(__('Inclusive Tax')); ?>")
                <?php endif; ?>

                $("#checkout_items_total").text(amount_with_currency_symbol(subTotal.toFixed(decimalPoint)))
                $("#checkout_delivery_cost").text(amount_with_currency_symbol(totalShippingCost.toFixed(decimalPoint)));
                $("#total_payment_amount").text(amount_with_currency_symbol(((subTotal - discountAmount) + totalTax +
                    totalShippingCost).toFixed(decimalPoint)));
                $("#checkout_total").text(amount_with_currency_symbol(((subTotal - discountAmount) + totalTax +
                    totalShippingCost).toFixed(decimalPoint)));
            }
        <?php endif; ?>

        <?php if(get_static_option('tax_system') == 'zone_wise_tax_system'): ?>
            $(document).on("change", "#country_id", function() {
                // first i need to get all states
                // get all shipping methods
                // insert all shipping methods on .all-shipping-options hare
                // Add tax amount to all the orders
                let country_id = $(this).val();
                let data = new FormData();
                data.append("id", country_id);
                data.append("type", "country");
                data.append("_token", "<?php echo e(csrf_token()); ?>");

                send_ajax_request("POST", data, "<?php echo e(route('frontend.shipping.module.methods')); ?>", () => {

                }, (data) => {
                    if (data.success) {
                        let statehtml = "<option value=''> <?php echo e(__('Select an state')); ?> </option>";
                        data?.states?.forEach((state) => {
                            statehtml += "<option value='" + state.id + "'>" + state.name +
                                "</option>";
                        });

                        $("#checkout_tax_percentage").val(data.tax_amount);
                        // Now first i need to get all orders tax filed and insert tax amount
                        // After those data we need to calculate every order
                        $('#tax_amount').html(data.tax_amount + "%");
                        $(this).parent().parent().find(".select-state").html(statehtml);

                        calculateAmount(data);
                        calculateOrderSummary();
                    }
                }, function(xhr) {
                    ajax_toastr_error_message(xhr);
                })
            });

            $(document).on("change", "#state_id", function() {
                // first, i need to get all states
                // to get all shipping methods
                // to insert all shipping methods on .all-shipping-options hare
                // Add tax amount to all the orders
                let state_id = $(this).val();
                let data = new FormData();
                data.append("id", state_id);
                data.append("type", "state");
                data.append("_token", "<?php echo e(csrf_token()); ?>");

                send_ajax_request("POST", data, "<?php echo e(route('frontend.shipping.module.methods')); ?>", () => {

                }, (data) => {
                    if (data.success) {
                        $("#checkout_tax_percentage").val(data.tax_amount);

                        // now first i need to get all orders tax filed and insert tax amount
                        // after those data we need to calculate every order
                        $('#tax_amount').html(data.tax_amount + "%");

                        let cityhtml = "<option value=''> <?php echo e(__('Select an city')); ?> </option>";
                        data?.cities?.forEach((city) => {
                            cityhtml += "<option value='" + city.id + "'>" + city.name +
                                "</option>";
                        });

                        $("#city_id").html(cityhtml);

                        calculateAmount(data);
                        calculateOrderSummary();
                    }
                }, function(xhr) {
                    ajax_toastr_error_message(xhr);
                })
            });
        <?php endif; ?>

        function getSubTotals() {
            let totalAmount = 0;

            $(".vendor_subtotal").each(function() {
                totalAmount += replaceSymbol($(this).text());
            });
            return totalAmount;
        }

        function getTotalShippingCost() {
            let totalAmount = 0;

            $(".vendor_shipping_cost").each(function() {
                totalAmount += replaceSymbol($(this).text());
            });

            return totalAmount;
        }

        function replaceSymbol(text) {
            let amount_format="<?php echo e(get_static_option('amount_format_by')); ?>";
            return parseFloat((text.replace("<?php echo e(site_currency_symbol()); ?>", "")).replace(amount_format,''));
        }

        let defaultGateway = $('#site_global_payment_gateway').val();

        $('.payment-gateway-wrapper ul li[data-gateway="' + defaultGateway + '"]').addClass('selected');

        $(document).on("click", ".wallet-payment-input", function() {
            if ($(this).is(':checked')) {
                $('.payment-card').fadeOut();
                $('.payment-gateway-wrapper').find(('input')).val('Wallet');
                $('.payment_gateway_passing_clicking_name').val('Wallet');
            } else {
                $('.payment-card').fadeIn();
                $('.payment-gateway-wrapper').find(('input')).val('');
                $('.payment_gateway_passing_clicking_name').val('');
            }
        });

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

        $(document).on("click", ".user-shipping-address-item", function() {
            let states = JSON.parse($(this).attr("data-states"));
            let cities = JSON.parse($(this).attr("data-cities"));
            let countryTax = JSON.parse($(this).attr("data-country-tax"));
            let stateTax = JSON.parse($(this).attr("data-state-tax"));

            let statehtml = "<option value=''>Please Select State</option>";
            let selectedState = $(this).attr('data-state');

            let cityhtml = "<option value=''>Please Select City</option>";
            let selectedCity = $(this).attr('data-city');

            states.forEach((state) => {
                if (state.id == selectedState) {
                    statehtml += "<option " + 'selected' + " value='" + state.id + "'>" + state.name +
                        "</option>";
                } else {
                    statehtml += "<option  value='" + state.id + "'>" + state.name + "</option>";
                }
            });

            cities.forEach((city) => {
                if (city.id == selectedCity) {
                    cityhtml += "<option " + 'selected' + " value='" + city.id + "'>" + city.name +
                        "</option>";
                } else {
                    cityhtml += "<option  value='" + city.id + "'>" + city.name + "</option>";
                }
            });

            $("#checkout_tax_percentage").val(countryTax.tax_amount)
            $("#checkout_tax_percentage").val(stateTax.tax_amount)

            calculateOrderSummary();

            $(".modal-states").html(statehtml);
            $(".modal-cities").html(cityhtml);


            $("#country_id option:selected").attr("selected", false)
            $("#country_id option[value=" + $(this).attr("data-country") + "]").attr("selected", true)

            $(".billing-form #name").val($(this).data('name'));
            $(".billing-form #address").val($(this).data('address'));

            $("#city_id option:selected").attr("selected", false)
            $("#city_id option[value=" + $(this).attr("data-city") + "]").attr("selected", true);


            $(".billing-form #zipcode").val($(this).data('zipcode'));
            $(".billing-form #phone").val($(this).data('phone'));
            $(".billing-form #email").val($(this).data('email'));

            $(".checkout_modal_close").trigger("click");

            $(".user-shipping-address-item").removeClass("active");
            $(this).toggleClass("active");
        });

        $(document).ready(function() {
            <?php if(get_static_option('tax_system') == 'advance_tax_system'): ?>
                calculateOrderSummeryForAdvanceTax();
            <?php else: ?>
                // calculate order summary according to cart items
                calculateOrderSummary();
            <?php endif; ?>

            // now get default shipping cost
            selectDefaultShippingMethod();
        });

        $(document).on("click", ".checkout-shipping-method", function() {
            let shippingTax = Number($(this).attr("data-shipping-percentage"));
            let shippingCost = Number($(this).attr("data-shipping-cost"));
            let shippingCostId = $(this).attr("data-shipping-cost-id");
            let currencySymbol = "<?php echo e(site_currency_symbol()); ?>";
            let subTotal = $(this).parent().parent().find("#vendor_subtotal").text().replace(currencySymbol, "");
            let total = parseFloat(subTotal) + parseFloat(shippingCost);

            if ($(this).hasClass("active")) {

            } else {
                $(this).parent().find(".checkout-shipping-method").removeClass("active");
                $(this).addClass("active");
                $(this).parent().parent().find("#vendor_shipping_cost").html(amount_with_currency_symbol(shippingCost))
                $(this).parent().parent().find("#shipping_cost").val(shippingCostId);

                calculateAmount();
                <?php if(get_static_option('tax_system') == 'advance_tax_system'): ?>
                    calculateOrderSummeryForAdvanceTax()
                <?php else: ?>
                    calculateOrderSummary();
                <?php endif; ?>
            }
        });


        $(document).on('click', '#terms_check', function() {
            $('#billing_info input[name=agree]').val(1);
        });

        $(document).on('click', '#place_order', function(e) {
            e.preventDefault();

            selectDefaultShippingMethod();

            $('.checkout-billing-form').trigger('submit');
        });

        $(document).on("click", ".apply-coupon", function() {
            let url = $(this).attr('data-action');
            let coupon = $(this).parent().find('input[name=coupon]').val();

            $('.lds-ellipsis').show();
            $('#coupon_code').val(coupon); // for shipping code
            $('#discount_summery').hide();
            $('#discount_summery #coupon_amount').html("<?php echo e(site_currency_symbol()); ?>" + 0);

            submitCoupon(url, coupon);
        });

        $(document).on("submit", "#discount-coupon", function(e) {
            e.preventDefault();

            let url = $(this).attr('action');
            let coupon = $(this).find('input[name=coupon]').val();

            $('.lds-ellipsis').show();
            $('#coupon_code').val(coupon); // for shipping code
            $('#discount_summery').hide();
            $('#discount_summery #coupon_amount').html("<?php echo e(site_currency_symbol()); ?>" + 0);

            submitCoupon(url, coupon);
        })

        function submitCoupon(url, coupon) {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    coupon: coupon,
                },
                success: function(data) {
                    $('.lds-ellipsis').hide();
                    if (data.type == 'success') {
                        toastr.success('<?php echo e(__('Coupon applied')); ?>');
                        $('#coupon_amount').text(amount_with_currency_symbol(data.coupon_amount));
                        $('#coupon_code').val(coupon);
                        $('#discount_summery').show();
                    } else {
                        toastr.error('<?php echo e(__('Coupon invalid')); ?>');
                    }

                    <?php if(get_static_option('tax_system') == 'advance_tax_system'): ?>
                        calculateOrderSummeryForAdvanceTax();
                    <?php else: ?>
                        calculateOrderSummary();
                    <?php endif; ?>
                },
                error: function(err) {
                    $('.lds-ellipsis').hide();
                    toastr.error('<?php echo e(__('Something went wrong')); ?>');
                }
            });
        }

        // please make sure this method is called before submitting checkout form
        function selectDefaultShippingMethod() {
            $(".card-footer .checkout-shipping-method.active").each(function() {
                let shippingCost = $(this).attr("data-shipping-cost");
                let shippingCostId = $(this).attr("data-shipping-cost-id");

                $(this).parent().parent().find(".vendor_shipping_cost").text(amount_with_currency_symbol(
                    shippingCost));
                $(this).parent().parent().find(".shipping_cost").val(shippingCostId);
            })
        }

        function calculateAmount(data) {
            let currencySymbol = "<?php echo e(site_currency_symbol()); ?>";

            $(".card #vendor_tax_amount").each(function() {
                let subTotal = parseFloat($(this).parent().parent().find("#vendor_subtotal").text().trim().replace(
                    currencySymbol, ""));
                let shippingCost = parseFloat($(this).parent().parent().find("#vendor_shipping_cost").text().trim()
                    .replace(currencySymbol, ""))
                let taxAmount = null;
                let mainSubTotal = 0;
                <?php if(get_static_option('tax_system') !== 'advance_tax_system'): ?>
                    taxAmount = data?.tax_amount ?? parseFloat($(this).parent().parent().find("#vendor_tax_amount")
                        .text().trim().replace("%", "").replace(currencySymbol, ''));
                    // now calculate subtotal with tax amount

                    $(this).text(taxAmount + "%")

                    mainSubTotal = subTotal * taxAmount / 100;
                <?php endif; ?>

                $(this).parent().parent().find("#vendor_total").text(amount_with_currency_symbol((subTotal +
                    shippingCost + mainSubTotal).toFixed(1)))
            });
        }

        function calculateOrderSummary() {
            let taxAmount = $("#checkout_tax_percentage").val();
            let discountAmount = $("#coupon_amount").text().trim().replace("<?php echo e(site_currency_symbol()); ?>", "");

            discountAmount = parseFloat(discountAmount === '' ? 0 : discountAmount);
            taxAmount = taxAmount == '' ? parseFloat("0") : parseFloat(taxAmount);

            let subTotal = getSubTotals();
            let totalTax = (subTotal - discountAmount) * taxAmount / 100;
            let totalShippingCost = getTotalShippingCost();

            <?php if($enableTaxAmount): ?>
                $("#checkout_tax_amount").text(amount_with_currency_symbol(totalTax.toFixed(2)))
            <?php endif; ?>

            $("#checkout_items_total").text(amount_with_currency_symbol(subTotal.toFixed(2)))
            $("#checkout_delivery_cost").text(amount_with_currency_symbol(totalShippingCost.toFixed(2)));
            $("#total_payment_amount").text(amount_with_currency_symbol(((subTotal - discountAmount) + totalTax +
                totalShippingCost).toFixed(2)));

            $("#checkout_total").text(amount_with_currency_symbol(((subTotal - discountAmount) + totalTax +
                totalShippingCost).toFixed(2)));
        }
    </script>
    <?php if(moduleExists('ShippingModule')): ?>
        <?php echo $__env->make('shippingmodule::frontend.shipping-charge', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <script>
        $(document).on("submit", "#shopping_address", function(e) {
            e.preventDefault();
            let currentForm = $(this);
            send_ajax_request("POST", new FormData(e.target), "<?php echo e(route('frontend.shipping.address.store')); ?>",
                () => {}, (data) => {
                    ajax_toastr_success_message(data);

                    $(".user-shipping-address-wrapper").append(data.option)
                    currentForm.trigger("reset");
                },
                function(xhr) {
                    ajax_toastr_error_message(xhr);
                })
        })

        $(document).on("change", "#modal_country_id", function() {
            let country_id = $(this).val();
            let data = new FormData();
            data.append("country_id", country_id);

            send_ajax_request("get", "", "<?php echo e(route('frontend.get-states')); ?>/" + country_id, () => {}, (data) => {
                if (data.success) {
                    $(this).parent().parent().find("#modal_state_id").html(data.data);
                }
            }, function(xhr) {
                ajax_toastr_error_message(xhr);
            })
        });
        $(document).on("change", "#modal_state_id", function() {
            // first, i need to get all states
                // to get all shipping methods
                // to insert all shipping methods on .all-shipping-options hare
                // Add tax amount to all the orders
                let state_id = $(this).val();
                let data = new FormData();
                data.append("id", state_id);
                data.append("type", "state");
                data.append("_token", "<?php echo e(csrf_token()); ?>");

                send_ajax_request("POST", data, "<?php echo e(route('frontend.shipping.module.methods')); ?>", () => {

                }, (data) => {
                    if (data.success) {
                        $("#checkout_tax_percentage").val(data.tax_amount);

                        // now first i need to get all orders tax filed and insert tax amount
                        // after those data we need to calculate every order
                        $('#tax_amount').html(data.tax_amount + "%");

                        let cityhtml = "<option value=''> <?php echo e(__('Select an city')); ?> </option>";
                        data?.cities?.forEach((city) => {
                            cityhtml += "<option value='" + city.id + "'>" + city.name +
                                "</option>";
                        });

                        $("#modal_city_id").html(cityhtml);

                        calculateAmount(data);
                        calculateOrderSummary();
                    }
                }, function(xhr) {
                    ajax_toastr_error_message(xhr);
                })
        });

        $(document).on('click', '.billing_details_click', function() {
            $('.popup_modal_checkout, .popup_modal_checkout_overlay').toggleClass('show');
        });

        $(document).on('click', '.popup_modal_checkout_overlay, .checkout_modal_close', function() {
            $('.popup_modal_checkout, .popup_modal_checkout_overlay').removeClass('show');
        });
        $(document).on("click",".create-accounts",function(){
            if($(this).hasClass("active")){
                $("input[name='create_account']").val('');
                $("input[name='password']").val('');
                $("input[name='password_confirmation']").val('');
            }else{
                $("input[name='create_account']").val(1);
            }
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/cart/checkout.blade.php ENDPATH**/ ?>