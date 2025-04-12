<?php if(moduleExists('Chat') && $product->vendor_id): ?>
    <div class="chatContact__btnWrapper mt-3">
        <div class="chatContact__btn"
             data-is-user-logged-in="<?php echo e(auth("web")->check() ?? false); ?>"
             data-vendor-id="<?php echo e($product->vendor?->id); ?>"
             data-vendor-name="<?php echo e($product->vendor?->business_name); ?>"
             data-vendor-logo="<?php echo e(render_image($product->vendor?->logo, render_type: 'path')); ?>"
             id="open-chat<?php echo e($from == 'product' ? '-product' : ''); ?>">
            <i class="las la-comment"></i> <?php echo e(__("Chat")); ?>

        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Chat\Resources/views/components/live-chat-button.blade.php ENDPATH**/ ?>