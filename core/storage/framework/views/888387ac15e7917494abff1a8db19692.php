<div class="user-shipping-address-item"
     data-name="<?php echo e($shipping_address->name); ?>"
     data-email="<?php echo e($shipping_address->email); ?>"
     data-address="<?php echo e($shipping_address->address); ?>"
     data-country="<?php echo e($shipping_address->country_id); ?>"
     data-state="<?php echo e($shipping_address->state_id); ?>"
     data-city="<?php echo e($shipping_address->city); ?>"
     data-phone="<?php echo e($shipping_address->phone); ?>"
     data-zipcode="<?php echo e($shipping_address->zip_code); ?>"
     data-states="<?php echo e(json_encode($shipping_address?->get_states?->toArray() ?? [])); ?>"
     data-cities="<?php echo e(json_encode($shipping_address?->get_cities?->toArray() ?? [])); ?>"
     data-country-tax="<?php echo e(json_encode($shipping_address?->country_taxs?->toArray() ?? [])); ?>"
     data-state-tax="<?php echo e(json_encode($shipping_address?->state_taxs?->toArray() ?? [])); ?>"
>
    <div class="before-hover btn btn-outline-secondary">
        <?php echo e($shipping_address->shipping_address_name ?? $shipping_address->name); ?>

    </div>

    <div class="after-hover position-absolute top-0 bg-color-one text-light d-none">
        <p><?php echo e(__("Shipping Address Name")); ?>: <b><?php echo e($shipping_address->shipping_address_name); ?></b></p>
        <p><?php echo e(__("Name")); ?>: <b><?php echo e($shipping_address->name); ?></b></p>
        <p><?php echo e(__("Email")); ?>: <b><?php echo e($shipping_address->email); ?></b></p>
        <p><?php echo e(__("Address")); ?>: <b><?php echo e($shipping_address->address); ?></b></p>
        <p><?php echo e(__("Country")); ?>: <b><?php echo e($shipping_address?->country?->name); ?></b></p>
        <p><?php echo e(__("State")); ?>: <b><?php echo e($shipping_address?->state?->name); ?></b></p>
        <p><?php echo e(__("City")); ?>: <b><?php echo e($shipping_address?->cities?->name); ?></b></p>
        <p><?php echo e(__("Mobile")); ?>: <b><?php echo e($shipping_address->phone); ?></b></p>
        <p><?php echo e(__("Zip Code")); ?>: <b><?php echo e($shipping_address->zip_code); ?></b></p>
    </div>
</div><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/cart/partials/shipping-address-option.blade.php ENDPATH**/ ?>