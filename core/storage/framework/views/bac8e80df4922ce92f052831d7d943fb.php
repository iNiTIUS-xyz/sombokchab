<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php echo e(get_static_option('site_title')); ?> -
        <?php if(request()->path() == 'admin-home'): ?>
            <?php echo e(get_static_option('site_tag_line')); ?>

        <?php else: ?>
            <?php echo $__env->yieldContent('site-title'); ?>
        <?php endif; ?>
    </title>
    <?php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'), 'full', false);
    ?>
    <?php echo $__env->make('frontend.partials.css-variable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(!empty($site_favicon)): ?>
        <link rel="icon" href="<?php echo e($site_favicon['img_url']); ?>" type="image/png">
        <?php echo render_favicon_by_id($site_favicon['img_url']); ?>

    <?php endif; ?>
    <!-- favicon -->
    <link rel=icon href="<?php echo e(asset('assets/favicon-dashboard.png')); ?>" sizes="16x16" type="icon/png">
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap5.min.css')); ?>">
    <!-- animate -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.css')); ?>">
    <!-- slick carousel  -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/slick.css')); ?>">
    <!-- LineAwesome -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/line-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/themify-icons.css')); ?>">
    <!-- Plugins css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/toastr.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins.css')); ?>">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">

    <?php echo $__env->yieldContent('style'); ?>
</head>

<body>
    <!-- Dashboard area Starts -->
    <div class="body-overlay"></div>

    <div class="dashboard-area dashboard-padding">
        <div class="container-fluid p-0">
            <div class="dashboard-contents-wrapper">
                <div class="dashboard-icon">
                    <div class="sidebar-icon">
                        <i class="las la-bars"></i>
                    </div>
                </div>
                <?php echo $__env->make('layouts.vendor.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="dashboard-right-contents mt-4 mt-lg-0">
                    <?php echo $__env->make('layouts.vendor.top-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="wrapper-container">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard area end -->

    <!-- jquery -->
    <script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
    <!-- jquery Migrate -->
    <script src="<?php echo e(asset('assets/js/jquery-migrate.min.js')); ?>"></script>
    <!-- bootstrap -->
    <script src="<?php echo e(asset('assets/js/bootstrap5.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <!-- toastr cdn -->
    <script src="<?php echo e(asset('assets/backend/js/toastr.min.js')); ?>"></script>
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
    <!-- Calendar js -->
    <script src="<?php echo e(asset('assets/js/calendar-bundle.js')); ?>"></script>
    <!-- Chart Js -->
    <script src="<?php echo e(asset('assets/js/chart.js')); ?>"></script>
    <!-- main js -->
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
    <!-- Javascript Helpers -->
    <script src="<?php echo e(asset('assets/js/helpers.js')); ?>"></script>

    <?php if (isset($component)) { $__componentOriginal6ab1178bba1bb12c26ebf3a473dec3ff = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6ab1178bba1bb12c26ebf3a473dec3ff = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.notification.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('notification.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6ab1178bba1bb12c26ebf3a473dec3ff)): ?>
<?php $attributes = $__attributesOriginal6ab1178bba1bb12c26ebf3a473dec3ff; ?>
<?php unset($__attributesOriginal6ab1178bba1bb12c26ebf3a473dec3ff); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6ab1178bba1bb12c26ebf3a473dec3ff)): ?>
<?php $component = $__componentOriginal6ab1178bba1bb12c26ebf3a473dec3ff; ?>
<?php unset($__componentOriginal6ab1178bba1bb12c26ebf3a473dec3ff); ?>
<?php endif; ?>

    <script>
        $(document).on('click', '.swal_delete_button', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '<?php echo e(__('Are you sure?')); ?>',
                text: '<?php echo e(__('You would not be able to revert this item!')); ?>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });

        // Calendar js
        // https://www.cssscript.com/demo/event-calendar-color

        new Calendar({
            id: '#custom-color-calendar',
        })

        /* Line Charts */
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: ['Sun', 'Mon', "Tue", 'Wed', 'Thu', "Fri", "Sat"],
                datasets: [{
                    data: [265, 270, 268, 272, 270, 267, 270],
                    label: "Earnings",
                    borderColor: "#05cd99",
                    borderWidth: 2,
                    fill: true,
                    backgroundColor: 'rgba(5, 205, 153,.08)',
                    fillBackgroundColor: "#f9503e",
                    pointBorderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointRadius: 3,
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "#05cd99",
                }, ]
            },
        });

        /* Line Chart Two */
        new Chart(document.getElementById("line-chart-two"), {
            type: 'line',
            data: {
                labels: ['Sun', 'Mon', "Tue", 'Wed', 'Thu', "Fri", "Sat"],
                datasets: [{
                    data: [368, 371, 369, 371, 370, 369, 370],
                    label: "Show Data",
                    borderColor: "#05cd99",
                    borderWidth: 2,
                    fill: false,
                    fillBackgroundColor: "#000",
                    pointBorderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointRadius: 3,
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "#05cd99",
                }, ]
            },
        });

        /* Line Chart Three */
        new Chart(document.getElementById("line-chart-three"), {
            type: 'line',
            data: {
                labels: ['Sun', 'Mon', "Tue", 'Wed', 'Thu', "Fri", "Sat"],
                datasets: [{
                    data: [366, 365, 368, 371, 370, 369, 370],
                    label: "Show Data",
                    borderColor: "#05cd99",
                    borderWidth: 2,
                    fill: false,
                    fillBackgroundColor: "#000",
                    pointBorderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointRadius: 3,
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "#05cd99",
                }, ]
            },
        });


        /*  Bar Charts */
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', "Mar", 'Apr', 'May', "Jun", "July", 'Aug', "Sep", 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: "Statement",
                    backgroundColor: "#e9edf7",
                    data: [100, 200, 150, 180, 130, 250, 120, 200, 70, 160, 100, 170],
                    barThickness: 15,
                    hoverBackgroundColor: '#05cd99',
                    hoverBorderColor: '#05cd99',
                    borderRadius: 5,
                    minBarLength: 50,
                    indexAxis: "x",
                    pointStyle: 'star',
                }, ]
            },
        });

        /*  Bar Charts Two */
        new Chart(document.getElementById("bar-chart-two"), {
            type: 'bar',
            data: {
                labels: ['Sun', 'Mon', "Tue", 'Wed', 'Thu', "Fri", "Sat"],
                datasets: [{
                    label: "On track",
                    backgroundColor: "#e9edf7",
                    data: [120, 270, 100, 310, 80, 200, 270],
                    barThickness: 15,
                    hoverBackgroundColor: '#05cd99',
                    hoverBorderColor: '#05cd99',
                    borderRadius: 5,
                    indexAxis: "x",
                    pointStyle: 'star',
                }, ]
            },
        });

        function convertToSlug(text) {
            return text
                .toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
        }

        /*
        ========================================
            media upload btn click
        ========================================
        */

        $(document).on("click", ".media_upload_form_btn", function () {
            // now let's find modal
            let prevModal = $(this).closest(".modal");

            if (prevModal.length > 0) {
                $(document).on("click", ".media_upload_modal_submit_btn , .modal-wrapper .close-select-button", function () {
                    $(".media_upload_modal_submit_btn").closest('.modal-wrapper').hide();
                    prevModal.modal("show");
                })
            }
        });
    </script>

    <?php echo $__env->yieldContent('script'); ?>
</body>

</html>
<?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/vendor/vendor-master.blade.php ENDPATH**/ ?>