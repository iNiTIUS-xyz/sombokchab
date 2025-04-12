<?php
    $msg_text = $message->message;
    $condition = null;

    if($message->from_user == 1){
        $condition = true;
    }else{
        $condition = false;
    }
    $product = json_decode(json_encode($msg_text['product']));
?>
<div class="chatContact__contents__inner__chat__item <?php echo e($condition ? "" : "chatReply"); ?>">
    <?php if(!$condition): ?>
        <span class="chatReply__img margin-top-20"><?php echo $message->from_user == 1 ? $userimage : $vendorimage; ?></span>
    <?php endif; ?>

    <div class="">
        <small <?php if($condition): ?> class="text-right-time" <?php endif; ?> ><?php echo e($message->created_at->diffForHumans()); ?></small>
        <p class="chatContact__contents__inner__chat__item__para <?php echo e(($msg_text['message'] || $message->file) ? "" : "d-none"); ?>">

            <?php echo e($msg_text['message'] ?? ""); ?>


            <?php if($message->file != ''): ?>
                <br />
                <?php echo render_image($message->file, custom_path: \Modules\Chat\Services\UserChatService::FOLDER_PATH); ?>

            <?php endif; ?>
        </p>

        <?php if(!empty($product)): ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?php echo e($product->image); ?>" class="img-fluid rounded-start" alt="<?php echo e($product->name); ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($product->name); ?></h5>
                            <p class="card-text">
                                <?php echo e(__("Category: ")); ?> <?php echo e($product->category); ?> ,<?php echo e(__("Brand:")); ?> <?php echo e($product->brand); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if($condition): ?>
        <span class="chatReply__img"><?php echo $message->from_user == 1 ? $userimage : $vendorimage; ?></span>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Chat\Resources/views/components/user-message.blade.php ENDPATH**/ ?>