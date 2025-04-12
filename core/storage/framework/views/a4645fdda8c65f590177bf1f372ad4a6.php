<!-- bootstrap -->
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap5.min.css')); ?>">
<!-- animate -->
<link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.css')); ?>">
<!-- slick carousel  -->
<link rel="stylesheet" href="<?php echo e(asset('assets/css/slick.css')); ?>">
<!-- LineAwesome -->
<link rel="stylesheet" href="<?php echo e(asset('assets/css/line-awesome.min.css')); ?>">
<!-- Plugins css -->
<link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins.css')); ?>">
<!-- Main Stylesheet -->
<link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-area breadcrumb-padding bg-item-badge">
        <div class="breadcrumb-shapes">
            <img src="<?php echo e(asset('assets/img/shop/badge-s1.png')); ?>" alt="">
            <img src="<?php echo e(asset('assets/img/shop/badge-s2.png')); ?>" alt="">
            <img src="<?php echo e(asset('assets/img/shop/badge-s3.png')); ?>" alt="">
        </div>
        <div class="container container-one">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-contents">
                        <h2 class="breadcrumb-title"> <?php echo e(__('Vendor Sign In')); ?> </h2>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area end -->

    <!-- Vendor Signin area Starts -->
    <section class="vendor-registration-area padding-top-20 padding-bottom-20">
        <div class="container container-one">
            <div class="vendor-signin-wrapper">
                <div class="vendor-signin-wrapper-inner">
                    
                    <div class="dashboard-form mt-4">
                        <?php if (isset($component)) { $__componentOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-msg','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6)): ?>
<?php $attributes = $__attributesOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6; ?>
<?php unset($__attributesOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6)): ?>
<?php $component = $__componentOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6; ?>
<?php unset($__componentOriginal8b6fcedff2ec1fbf29bfef12ce3dc2e6); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal5836ea34a6758bf192c104f6f2992c55 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5836ea34a6758bf192c104f6f2992c55 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.success','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5836ea34a6758bf192c104f6f2992c55)): ?>
<?php $attributes = $__attributesOriginal5836ea34a6758bf192c104f6f2992c55; ?>
<?php unset($__attributesOriginal5836ea34a6758bf192c104f6f2992c55); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5836ea34a6758bf192c104f6f2992c55)): ?>
<?php $component = $__componentOriginal5836ea34a6758bf192c104f6f2992c55; ?>
<?php unset($__componentOriginal5836ea34a6758bf192c104f6f2992c55); ?>
<?php endif; ?>
                        <form data-form-url="<?php echo e(route('vendor.login')); ?>" method="post" id="vendor-login-form">
                            <div class="alert alert-small py-1 alert-success bg-success text-light display-login-alert"
                                style="display: none"><?php echo e(__('Success alert')); ?></div>
                            <?php echo csrf_field(); ?>
                            <div class="dashboard-input">
                                <label class="label-title mb-2"> <?php echo e(__('Phone Number or Email')); ?> </label>
                                <input class="form--control" type="text" name="username"
                                    placeholder="<?php echo e(__('Type Phone Number with Country Code or Email')); ?>">
                            </div>

                            <div class="dashboard-input mt-4">
                                <label class="label-title mb-2"> <?php echo e(__('Password')); ?> </label>
                                <input class="form--control" name="password" type="password"
                                    placeholder="<?php echo e(__('Type Password')); ?>">
                                
                            </div>

                            

                            <div class="dashboard-btn-wrapper mt-4">
                                <button type="submit" class="btn-submit dashboard-bg w-100"> <?php echo e(__('Sign In')); ?>

                                </button>
                            </div>

                            <div
                                class="remember-password-flex d-flex flex-wrap justify-content-between align-items-center">
                                <div class="dashboard-checkbox add-money-checkbox mt-3">
                                    <input class="check-input" name="remember" type="checkbox" id="agree">
                                    <label class="checkbox-label" for="agree"> <?php echo e(__('Remember Me')); ?> </label>
                                </div>
                                <a href="<?php echo e(route("vendor.forget.password.form")); ?>" class="forgot-password mt-3"> <?php echo e(__('Forgot Password?')); ?> </a>
                            </div>
                        </form>
                    </div>
                    <div class="dashboard-bottom-contents">
                        <div class="account-bottom">
                            <span class="account-title mt-3"> <?php echo e(__("Don't have account?")); ?> </span>
                            <a href="<?php echo e(route('vendor.register')); ?>" class="signup-login mt-3">
                                <?php echo e(__('Sign up')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Vendor Signin area end -->

    <!-- jquery -->
    <script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
    <!-- jquery Migrate -->
    <script src="<?php echo e(asset('assets/js/jquery-migrate.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- bootstrap -->
    <script src="<?php echo e(asset('assets/js/bootstrap5.bundle.min.js')); ?>"></script>
    <!-- Lazy Load Js -->
    <script src="<?php echo e(asset('assets/js/jquery.lazy.min.js')); ?>"></script>
    <!-- Slick Slider -->
    <script src="<?php echo e(asset('assets/js/slick.js')); ?>"></script>
    <!-- All Plugins js -->
    <script src="<?php echo e(asset('assets/js/plugins.js')); ?>"></script>
    <!-- Range Slider -->
    <script src="<?php echo e(asset('assets/js/nouislider-8.5.1.min.js')); ?>"></script>
    <!-- All Plugins two js -->
    <script src="<?php echo e(asset('assets/js/plugin-two.js')); ?>"></script>
    <!-- Nice Scroll -->
    <script src="<?php echo e(asset('assets/js/jquery.nicescroll.min.js')); ?>"></script>
    <!-- main js -->
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
    <!-- Javascript Helpers -->
    <script src="<?php echo e(asset('assets/js/helpers.js')); ?>"></script>
    <script>
        $(document).on("submit", "#vendor-login-form", function(e) {
            // make default
            e.preventDefault();




            send_ajax_request('post', new FormData(e.target), '', function() {

            }, function(data) {
                if (data.status == 'ok') {
                    $(".display-login-alert").text("Login success...");
                    $(".display-login-alert").fadeIn();
                    $(".display-login-alert").removeClass("alert-danger").addClass("alert-success");
                    $(".display-login-alert").removeClass("bg-danger").addClass("bg-success");
                    setTimeout(function() {
                        $(".display-login-alert").text("Redirecting....");
                    }, 500);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    $(".display-login-alert").text(data.msg);
                    $(".display-login-alert").removeClass("alert-success").addClass("alert-danger");
                    $(".display-login-alert").removeClass("bg-success").addClass("bg-danger");
                    $(".display-login-alert").fadeIn();
                }
            }, function(errors) {
                prepare_errors(errors)
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Vendor\Resources/views/vendor/login/index.blade.php ENDPATH**/ ?>