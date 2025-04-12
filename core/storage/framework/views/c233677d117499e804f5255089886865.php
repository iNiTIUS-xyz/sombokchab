<span class="checkout-title fs-18 fw-500 color-light"> <i class="las la-exclamation-circle"></i>
    
    
    <?php echo __('Returning customer?'); ?>

    <a class="color-one fw-400" href="<?php echo e(route('user.login')); ?>">
        <?php echo __('Click here to login'); ?>

    </a>
</span>

<div class="checkout-form-open">
    <div class="signin-contents">
        <h4 class="contact-title"> <?php echo e(__('Sign In')); ?> </h4>
        <form action="<?php echo e(route('user.login')); ?>" method="post" class="login-form padding-top-20 register-form"
                id="login_form_order_page" onsubmit="return validateLoginForm()">
                <div class="error-wrap"></div>

                <div class="single-input mt-4">
                    <label class="label-title mb-3"> <?php echo e(__("Phone Number / Email")); ?> </label>
                    <input class="form--control" type="text" id="login_phone" name="phone"
                        placeholder="<?php echo e(__("Phone Number / Email")); ?>"
                        <?php if(request()->host() == 'safecart.bytesed.com'): ?> value="test_user" <?php endif; ?>>
                    <small id="login_phone_error" class="text-danger"></small>
                </div>
                <div class="single-input mt-4">
                    <label class="label-title mb-3"> <?php echo e(__("Password")); ?> </label>
                    <input class="form--control" type="password" id="login_password" name="password"
                        placeholder="<?php echo e(__('Password')); ?>"
                        <?php if(request()->host() == 'safecart.bytesed.com'): ?> value="12345678" <?php endif; ?>>
                    <small id="login_password_error" class="text-danger"></small>
                </div>
                <button class="btn-submit w-100" type="submit" id="login_btn"> <?php echo e(__("Sign In")); ?> </button>
            </form>
        <form class="login-form" id="login_form_order_page">
            <div class="single-input mt-4">
                <label class="label-title mb-2"> <?php echo e(__('Email Or User Name')); ?> </label>
                <input class="form--control" type="text" name="username"
                    placeholder="<?php echo e(filter_static_option_value('checkout_username', $setting_text, __('Username'))); ?>">
            </div>
            <div class="single-input mt-4">
                <label class="label-title mb-2"> <?php echo e(__('Password')); ?> </label>
                <input class="form--control" type="password" name="password"
                    placeholder="<?php echo e(filter_static_option_value('checkout_password', $setting_text, __('Password'))); ?>">
            </div>
            <button class="btn-submit w-100 mt-4" id="login_btn" type="submit">
                <?php echo filter_static_option_value('checkout_login_btn_text', $setting_text, __('Sign in')); ?>

            </button>
        </form>
        <div class="single-checbox mt-3">
            <div class="checkbox-inlines">
                <input class="check-input" name="remember" type="checkbox" id="check15">
                <label class="checkbox-label" for="check15"> <?php echo filter_static_option_value('checkout_remember_text', $setting_text, __('Remember me')); ?> </label>
            </div>
            <div class="forgot-password">
                <a href="forgot_password.html" class="forgot-btn color-one">
                    <?php echo e(filter_static_option_value('checkout_forgot_password', $setting_text, __('Forgot Password'))); ?>

                </a>
            </div>
        </div>
        <div class="signin-bottom-contents">
            <div class="or-contents mb-3">
                <span class="or-para"> Or </span>
            </div>
            <div class="signin-others">
                <?php if(get_static_option('enable_google_login')): ?>
                    <div class="single-other-signin">
                        <a href="<?php echo e(route('login.google.redirect')); ?>" class="btn-others w-100">
                            <img src="<?php echo e(asset('assets/frontend/img/icon/google-icon.svg')); ?>" alt="">
                            <span class="signin-para"> <?php echo e(__('Sign In With Google')); ?> </span>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if(get_static_option('enable_facebook_login')): ?>
                    <div class="single-other-signin">
                        <a href="<?php echo e(route('login.facebook.redirect')); ?>" class="btn-others w-100">
                            <img src="<?php echo e(asset('assets/frontend/img/icon/Facebook-icon.svg')); ?>" alt="">
                            <span class="signin-para"> <?php echo e(__('Sign In With facebook')); ?> </span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/cart/partials/login.blade.php ENDPATH**/ ?>