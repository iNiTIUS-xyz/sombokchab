<?php $__env->startSection('section'); ?>
    <div class="dashboard-form-wrapper ">
        <h2 class="dashboard__card__title"><?php echo e(__('Change Password')); ?></h2>
        <div class="custom__form mt-4">
            <form action="<?php echo e(route('user.password.change')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="old_password"><?php echo e(__('Old Password')); ?></label>
                    <input type="password" class="form-control" id="old_password" name="old_password"
                        placeholder="<?php echo e(__('Old Password')); ?>">
                </div>
                <div class="form-group">
                    <label for="password"><?php echo e(__('New Password')); ?></label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="<?php echo e(__('New Password')); ?>">
                </div>
                <div class="form-group">
                    <label for="password_confirmation"><?php echo e(__('Confirm Password')); ?></label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="<?php echo e(__('Confirm Password')); ?>">
                </div>
                <div class="btn-wrapper mt-4">
                    <button type="submit" class="cmn_btn btn_bg_2"><?php echo e(__('Save changes')); ?></button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/user/dashboard/change-password.blade.php ENDPATH**/ ?>