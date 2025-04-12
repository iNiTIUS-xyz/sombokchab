<?php $__env->startSection('content'); ?>
    <div class="login-area">
        <div class="container">
            <div class="login-box-wrapper ptb--100">
                <form method="POST" action="<?php echo e(route('admin.login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="login-form-header text-center mb-4">
                        <div class="logo-wrapper" style="margin-bottom: 20px;">
                            <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                        </div>
                        <h4 class="main-title center-text fw-500 mt-3"><?php echo e(__('Admin Login')); ?></h4>
                        <p class="main-para mt-2"><?php echo e(__('Hello there, Sign in and start managing your website')); ?></p>
                    </div>
                    <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="error-message"></div>
                    <div class="login-form-wrap mt-4">
                        <div class="dashboard-input">
                            <label for="username" class="dashboard-label"><?php echo e(__('Username')); ?></label>
                            <input type="text" class="form--control" id="username" name="username" <?php if(request()->host() == 'safecart.bytesed.com'): ?> value="super_admin" <?php endif; ?> autofocus>
                        </div>

                        <div class="dashboard-input mt-4">
                            <label for="password" class="dashboard-label"><?php echo e(__('Password')); ?></label>
                            <input type="password" class="form--control" id="password" name="password" <?php if(request()->host() == 'safecart.bytesed.com'): ?> value="12345678" <?php endif; ?>>
                        </div>
                        <div class="row mb-4 rmber-area mt-4">
                            <div class="col-6">
                                <div class="dashboard-checkbox">
                                    <input type="checkbox" name="remember" class="check-input" id="remember">
                                    <label class="checkbox-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="<?php echo e(route('admin.forget.password')); ?>"
                                    class="forgot-password"><?php echo e(__('Forgot Password?')); ?></a>
                            </div>
                        </div>
                        <div class="dashboard-btn-wrapper mt-4">
                            <button id="form_submit" type="submit"
                                class="btn-submit dashboard-bg w-100"><?php echo e(__('Login')); ?></button>
                        </div>
                        <?php if(preg_match('/(xgenious)/', url('/'))): ?>
                            <div class="adminlogin-info">
                                <table class="table-default">
                                    <th><?php echo e(__('Username')); ?></th>
                                    <th><?php echo e(__('Password')); ?></th>
                                    <tbody>
                                        <tr>
                                            <td>super_admin</td>
                                            <td>12345678</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function($) {

                $(document).on('click', '#form_submit', function(e) {
                    e.preventDefault();
                    var el = $(this);
                    var erContainer = $(".error-message");
                    erContainer.html('');
                    el.text('<?php echo e(__('Please Wait..')); ?>');
                    $.ajax({
                        url: "<?php echo e(route('admin.login')); ?>",
                        type: "POST",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            username: $('#username').val(),
                            password: $('#password').val(),
                            remember: $('#remember').val(),
                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            erContainer.html('<div class="alert alert-danger"></div>');
                            $.each(errors.errors, function(index, value) {
                                erContainer.find('.alert.alert-danger').append(
                                    '<p>' + value + '</p>');
                            });
                            el.text('<?php echo e(__('Login')); ?>');
                        },
                        success: function(data) {
                            $('.alert.alert-danger').remove();
                            if (data.status == 'ok') {
                                el.text('<?php echo e(__('Redirecting')); ?>..');
                                erContainer.html('<div class="alert alert-' + data.type +
                                    '">' + data.msg + '</div>');
                                location.reload();
                            } else {
                                erContainer.html('<div class="alert alert-' + data.type +
                                    '">' + data.msg + '</div>');
                                el.text('<?php echo e(__('Login')); ?>');
                            }
                        }
                    });
                });

            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login-screens', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/auth/admin/login.blade.php ENDPATH**/ ?>