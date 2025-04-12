<div class="form-group">
    <label for="site_global_currency"><?php echo e(__('Site Global Currency')); ?></label>
    <select name="site_global_currency" class="form-control"
            id="site_global_currency">
  <?php $__currentLoopData = script_currency_list(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cur => $symbol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($cur); ?>"
  <?php if(get_static_option('site_global_currency') == $cur): ?> selected <?php endif; ?>><?php echo e($cur.' ( '.$symbol.' )'); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<div class="form-group">
    <label for="site_currency_symbol_position"><?php echo e(__('Currency Symbol Position')); ?></label>
    <?php $all_currency_position = ['left','right']; ?>
    <select name="site_currency_symbol_position" class="form-control"
            id="site_currency_symbol_position">
        <?php $__currentLoopData = $all_currency_position; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cur); ?>"
                    <?php if(get_static_option('site_currency_symbol_position') == $cur): ?> selected <?php endif; ?>><?php echo e(ucwords($cur)); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div class="form-group">
    <label for="enable_disable_decimal_point"><?php echo e(__('Enable/Disable Decimal Point')); ?></label>
    <select name="enable_disable_decimal_point" class="form-control" id="enable_disable_decimal_point">
        <option value="yes" <?php echo e(get_static_option('enable_disable_decimal_point') == 'yes' ? 'selected' : ''); ?>><?php echo e(__('Yes')); ?></option>
        <option value="no" <?php echo e(get_static_option('enable_disable_decimal_point') == 'no' ? 'selected' : ''); ?>><?php echo e(__('No')); ?></option>
    </select>
</div>

<div class="form-group">
    <label for="add_remove_sapce_between_amount_and_symbol"><?php echo e(__('Add/Remove Space Between Currency Symbol and Amount')); ?></label>
    <select name="add_remove_sapce_between_amount_and_symbol" class="form__control radius-5">
        <option value="yes" <?php echo e(get_static_option('add_remove_sapce_between_amount_and_symbol') == 'yes' ? 'selected' : ''); ?>><?php echo e(__('Yes')); ?></option>
        <option value="no" <?php echo e(get_static_option('add_remove_sapce_between_amount_and_symbol') == 'no' ? 'selected' : ''); ?>><?php echo e(__('No')); ?></option>
    </select>
</div>
<div class="form-group">
    <label for="add_remove_comman_form_amount"><?php echo e(__('Add/Remove comma (,) from amount')); ?></label>
    <select name="add_remove_comman_form_amount" class="form__control radius-5">
        <option value="yes" <?php echo e(get_static_option('add_remove_comman_form_amount') == 'yes' ? 'selected' : ''); ?>><?php echo e(__('Yes')); ?></option>
        <option value="no" <?php echo e(get_static_option('add_remove_comman_form_amount') == 'no' ? 'selected' : ''); ?>><?php echo e(__('No')); ?></option>
    </select>
</div>
<div class="form-group">
    <label for="add_remove_comman_form_amount"><?php echo e(__('Amount format by')); ?></label>
    <select name="amount_format_by" class="form__control radius-5">
        <option value="," <?php echo e(get_static_option('amount_format_by') == ',' ? 'selected' : ''); ?>><?php echo e(__('Comma')); ?></option>
        <option value="." <?php echo e(get_static_option('amount_format_by') == '.' ? 'selected' : ''); ?>><?php echo e(__('Dots')); ?></option>
    </select>
</div>

<div class="form-group">
    <label for="site_default_payment_gateway"><?php echo e(__('Default Payment Gateway')); ?></label>
    <select name="site_default_payment_gateway" class="form-control">
        <?php
            $all_gateways = \App\PaymentGateway::select("id","name")->get()->pluck("name");
        ?>
        <?php $__currentLoopData = $all_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($gateway); ?>" <?php if(get_static_option('site_default_payment_gateway') == $gateway): ?> selected <?php endif; ?>><?php echo e(ucwords(str_replace('_',' ',$gateway))); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<?php $global_currency = get_static_option('site_global_currency');?>


<?php if($global_currency != 'USD'): ?>
    <div class="form-group">
        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_usd_exchange_rate"><?php echo e(__($global_currency.' to USD Exchange Rate')); ?></label>
        <input type="text" class="form-control"
               name="site_<?php echo e(strtolower($global_currency)); ?>_to_usd_exchange_rate"
               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_usd_exchange_rate')); ?>">
        <span class="info-text"><?php echo e(sprintf(__('enter %1$s to USD exchange rate. eg: 1 %2$s = ? USD'),$global_currency,$global_currency)); ?></span>
    </div>
<?php endif; ?>

<?php if($global_currency != 'IDR'): ?>
    <div class="form-group">
        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_idr_exchange_rate"><?php echo e(__($global_currency.' to IDR Exchange Rate')); ?></label>
        <input type="text" class="form-control"
               name="site_<?php echo e(strtolower($global_currency)); ?>_to_idr_exchange_rate"
               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_idr_exchange_rate')); ?>">
        <span class="info-text"><?php echo e(sprintf(__('enter %1$s to USD exchange rate. eg: 1 %2$s = ? IDR'),$global_currency,$global_currency)); ?></span>
    </div>
<?php endif; ?>


<?php if($global_currency != 'INR'): ?>
    <div class="form-group">
        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_inr_exchange_rate"><?php echo e(__($global_currency.' to INR Exchange Rate')); ?></label>
        <input type="text" class="form-control"
               name="site_<?php echo e(strtolower($global_currency)); ?>_to_inr_exchange_rate"
               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_inr_exchange_rate')); ?>">
        <span class="info-text"><?php echo e(__('enter '.$global_currency.' to INR exchange rate. eg: 1'.$global_currency.' = ? INR')); ?></span>
    </div>
<?php endif; ?>

<?php if($global_currency != 'NGN'): ?>
    <div class="form-group">
        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_ngn_exchange_rate"><?php echo e(__($global_currency.' to NGN Exchange Rate')); ?></label>
        <input type="text" class="form-control"
               name="site_<?php echo e(strtolower($global_currency)); ?>_to_ngn_exchange_rate"
               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_ngn_exchange_rate')); ?>">
        <span class="info-text"><?php echo e(__('enter '.$global_currency.' to NGN exchange rate. eg: 1'.$global_currency.' = ? NGN')); ?></span>
    </div>
<?php endif; ?>

<?php if($global_currency != 'ZAR'): ?>
    <div class="form-group">
        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_zar_exchange_rate"><?php echo e(__($global_currency.' to ZAR Exchange Rate')); ?></label>
        <input type="text" class="form-control"
               name="site_<?php echo e(strtolower($global_currency)); ?>_to_zar_exchange_rate"
               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_zar_exchange_rate')); ?>">
        <span class="info-text"><?php echo e(sprintf(__('enter %1$s to USD exchange rate. eg: 1 %2$s = ? ZAR'),$global_currency,$global_currency)); ?></span>
    </div>
<?php endif; ?>


<?php if($global_currency != 'BRL'): ?>
    <div class="form-group">
        <label for="site_<?php echo e(strtolower($global_currency)); ?>_to_brl_exchange_rate"><?php echo e(__($global_currency.' to BRL Exchange Rate')); ?></label>
        <input type="text" class="form-control"
               name="site_<?php echo e(strtolower($global_currency)); ?>_to_brl_exchange_rate"
               value="<?php echo e(get_static_option('site_'.$global_currency.'_to_brl_exchange_rate')); ?>">
        <span class="info-text"><?php echo e(__('enter '.$global_currency.' to BRL exchange rate. eg: 1'.$global_currency.' = ? BRL')); ?></span>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/backend/general-settings/payment-settings/payment-common-settings.blade.php ENDPATH**/ ?>