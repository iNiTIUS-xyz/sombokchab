<?php
    $type = $type ?? 'admin';
?>

<div class="single-icon-flex">
    <?php if(auth('vendor')->check()): ?>
        <div class="single-icon notifications-parent">
            <a class="btn btn-outline-danger site-health-btn btn-icon-text" href="<?php echo e(route('frontend.vendors.single', auth('vendor')->user()->username ?? "")); ?>">
                <i class="las la-eye"></i> <span class="d-none d-sm-inline-block"><?php echo e(__("Visit Store")); ?></span>
            </a>
        </div>
    <?php elseif(auth('admin')->check()): ?>
        <div class="single-icon notifications-parent">
            <a class="btn btn-outline-danger site-health-btn btn-icon-text" href="<?php echo e(route('homepage')); ?>">
                <i class="las la-eye"></i> <span class="d-none d-sm-inline-block"><?php echo e(__("Visit Site")); ?></span>
            </a>
        </div>
    <?php endif; ?>
  
    <?php if(auth('admin')->check()): ?>
        <div class="single-icon notifications-parent">
            <a class="btn btn-danger site-health-btn btn-icon-text" href="<?php echo e(route('admin.health')); ?>">
                <i class="las la-stethoscope"></i> <span class="d-none d-sm-inline-block"><?php echo e(__("Health")); ?></span>
            </a>
        </div>
    <?php endif; ?>

    <?php if(auth('admin')->check()): ?>
        <?php if(auth('admin')->user()->hasRole('Super Admin')): ?>
            <?php
                $isDummy=\Modules\Product\Http\Services\Admin\DummyProductDeleteServices::isDummyProduct();
            ?>
            <?php if($isDummy): ?>
                <div class="single-icon notifications-parent">
                    <a class="btn btn-danger site-health-btn btn-icon-text" id="remove-dummy-data" href="<?php echo e(route('admin.products.delete_dummy_product')); ?>">
                        <i class="las la-stethoscope"></i> <span class="d-none d-sm-inline-block"><?php echo e(__("Remove Dummy Data")); ?></span>
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
    <div class="single-icon notifications-parent">
        <span class="notification-icon" id="top-bar-notification-icon"> <i class="las la-bell"></i> </span>
        <div class="notification-list-wrapper">
            <h6 class="notification-title"> <?php echo e(__('Notifications')); ?> </h6>
            <ul class="notification-list">
                <?php $__currentLoopData = xgNotifications(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // get model namespace and make a class
                        $namespace = new $notification->model();
                        $productName = '';

                        // this line will be executed when a notification type is product
                        if ($notification->type == 'product') {
                            $productName = $namespace->select('id', 'name')->find($notification->model_id)?->name;
                        }

                        // this method will generate
                        $href = \App\Http\Services\NotificationService::generateUrl($type, $notification);
                    ?>

                    <li class="list <?php echo e($notification->type == 'stock_out' ? 'bg bg-warning' : ''); ?>">
                        <div class="notification-list-flex">
                            <div class="notification-icon">
                                <i class="las la-bell"></i>
                            </div>

                            <div class="notification-contents">
                                <a class="list-title" href="<?php echo e($href); ?>">
                                    <?php echo str_replace(
                                        ['{product_name}', '{vendor_text}','{order_id}'],
                                        ["<b>$productName</b>", "", "#$notification->model_id"],
                                        formatNotificationText(strip_tags($notification->message)),
                                    ); ?> </a>
                                <span class="list-sub"> <?php echo e($notification->created_at->diffForHumans()); ?> </span>
                            </div>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php if($type == 'vendor'): ?>
                <a href="<?php echo e(route("vendor.notifications")); ?>" class="all-notification"> <?php echo e(__('See All Notification')); ?> </a>
            <?php else: ?>
                <a href="<?php echo e(route("admin.notifications")); ?>" class="all-notification"> <?php echo e(__('See All Notification')); ?> </a>
            <?php endif; ?>
        </div>
        <span class="badge-icon" id="top-bar-notification-count"> <?php echo e(xgUnReadNotifications()); ?> </span>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/components/notification/header.blade.php ENDPATH**/ ?>