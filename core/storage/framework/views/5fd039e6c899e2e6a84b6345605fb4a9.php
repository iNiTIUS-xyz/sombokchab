<?php
    $product = json_decode(json_encode($message->message['product']));
?>

<?php if($message->from_user == 1): ?>
    <div class="chat_wrapper__details__inner__chat">
        <div class="chat_wrapper__details__inner__chat__flex">
            <div class="chat_wrapper__details__inner__chat__thumb">
                <?php echo render_image($data->user?->profile_image); ?>

            </div>
            <div class="chat_wrapper__details__inner__chat__contents">
                <p class="chat_wrapper__details__inner__chat__contents__para <?php echo e(!empty($product) ? "d-none" : ""); ?>"><?php echo e($message->message['message']); ?>

                    <?php if(!empty($message->file)): ?>
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

                <span class="chat_wrapper__details__inner__chat__contents__time mt-2">
                        <?php echo e($message->created_at->format("F d, Y")); ?>

                    </span>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if($message->from_user == 2): ?>
    <div class="chat_wrapper__details__inner__chat chat-reply">
        <div class="chat_wrapper__details__inner__chat__flex">
            <div class="chat_wrapper__details__inner__chat__thumb">
                <?php echo render_image($data->vendor?->logo); ?>

            </div>
            <div class="chat_wrapper__details__inner__chat__contents">
                <p class="chat_wrapper__details__inner__chat__contents__para">
                    <?php echo e($message->message['message']); ?>

                    <?php if(!empty($message->file)): ?>
                        <br />
                        <?php echo render_image($message->file, custom_path: \Modules\Chat\Services\UserChatService::FOLDER_PATH); ?>

                    <?php endif; ?>

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
                </p>
                <span class="chat_wrapper__details__inner__chat__contents__time mt-2">
                        <?php echo e($message->created_at->format("F d, Y")); ?>

                    </span>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Chat\Resources/views/components/vendor/message.blade.php ENDPATH**/ ?>