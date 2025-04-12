<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('support_ticket_page_name') ?? 'Support Ticket'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('support_ticket_page_name') ?? 'Support Ticket'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('about_page_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('about_page_meta_tags')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .support-ticket-wrapper .login-form p {
            font-size: 36px;
            line-height: 40px;
            text-align: center;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 50px
        }

        .support-ticket-wrapper .login-form form.account-form {
            padding: 0 60px
        }

        .support-ticket-wrapper .title {
            font-size: 36px;
            line-height: 46px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px
        }

        /* .support-ticket-wrapper button[type=submit]:hover {
                background-color: var(--secondary-color);
                color: #fff
            }

            .support-ticket-wrapper button[type=submit] {
                display: inline-block;
                border: none;
                background-color: var(--main-color-two);
                color: #fff;
                padding: 10px 30px;
                font-weight: 600;
                transition: all .4s
            } */

        .support-ticket-wrapper textarea:focus {
            outline: 0;
            box-shadow: none
        }

        .support-ticket-wrapper textarea {
            max-height: 150px
        }

        .support-ticket-wrapper {
            padding: 50px;
            box-shadow: 0 0 40px 0 rgba(0, 0, 0, .05)
        }

        .support-ticket-wrapper .form-control {
            border: 1px solid #e2e2e2;
            border-radius: 0;
            height: 50px
        }

        .support-ticket-wrapper select.form-control:focus {
            outline: 0;
            box-shadow: none
        }

        .support-ticket-wrapper textarea.form-control {
            height: 150px
        }

        .support-ticket-wrapper checkbox.form-control {
            height: auto
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="support-ticket-page-area padding-top-120 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="dashboard__card support-ticket-wrapper">
                        <?php if(auth()->guard('web')->check()): ?>
                            <div class="dashboard__card__header">
                                <h3 class="dashboard__card__title">
                                    <?php echo e(get_static_option('support_ticket_form_title')); ?></h3>
                            </div>
                            <div class="dashboard__card__body custom__form mt-4">
                                <?php if (isset($component)) { $__componentOriginal54abcd52ec2e8ec857d4d6feae648c79 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.flash','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.flash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79)): ?>
<?php $attributes = $__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79; ?>
<?php unset($__attributesOriginal54abcd52ec2e8ec857d4d6feae648c79); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54abcd52ec2e8ec857d4d6feae648c79)): ?>
<?php $component = $__componentOriginal54abcd52ec2e8ec857d4d6feae648c79; ?>
<?php unset($__componentOriginal54abcd52ec2e8ec857d4d6feae648c79); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalae73592a9186217aa45553528a0de34b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalae73592a9186217aa45553528a0de34b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalae73592a9186217aa45553528a0de34b)): ?>
<?php $attributes = $__attributesOriginalae73592a9186217aa45553528a0de34b; ?>
<?php unset($__attributesOriginalae73592a9186217aa45553528a0de34b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalae73592a9186217aa45553528a0de34b)): ?>
<?php $component = $__componentOriginalae73592a9186217aa45553528a0de34b; ?>
<?php unset($__componentOriginalae73592a9186217aa45553528a0de34b); ?>
<?php endif; ?>
                                <form action="<?php echo e(route('frontend.support.ticket.store')); ?>" method="post"
                                    class="support-ticket-form-wrapper" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="via" value="<?php echo e(__('website')); ?>">
                                    
                                    <div class="form-group">
                                        <label><?php echo e(__('Subject')); ?></label>
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="<?php echo e(__('Subject')); ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label><?php echo e(__('Departments')); ?></label>
                                        <select name="departments" class="form-control">
                                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($dep->id); ?>"><?php echo e($dep->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo e(__('Order Number (No. - Date - Amount)')); ?></label>
                                        <select name="order_id" class="form-control">
                                            <option value="" selected>Select A Order</option>
                                            <?php $__currentLoopData = $user_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($order->id); ?>"><?php echo e($order->order_number); ?> - <?php echo e($order->created_at->format('F d, Y')); ?> - <?php echo e(float_amount_with_currency_symbol($order->paymentMeta->total_amount ?? 0)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo e(__('Description')); ?></label>
                                        <textarea name="description" class="form-control" cols="30" rows="10" placeholder="<?php echo e(__('Description')); ?>"></textarea>
                                    </div>
                                    <div class="btn-wrapper">
                                        <button type="submit" class="cmn_btn btn_bg_2 default-theme-btn">
                                            <?php echo e(get_static_option('support_ticket_button_text')); ?>

                                        </button>
                                    </div>
                                </form>
                            </div>
                        <?php else: ?>
                            <?php echo $__env->make('frontend.partials.ajax-login-form', [
                                'title' => get_static_option('support_ticket_login_notice'),
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('frontend.partials.ajax-login-form-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/user/dashboard/support-tickets/create.blade.php ENDPATH**/ ?>