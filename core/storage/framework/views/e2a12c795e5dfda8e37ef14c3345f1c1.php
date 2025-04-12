<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Cart')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/toastr.css')); ?>">
    <style>
        .lds-ellipsis {
            display: inline-block;
            position: fixed;
            width: 80px;
            height: 80px;
            left: 50vw;
            top: 40vh;
            z-index: 50;
            display: none;
        }

        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: var(--main-color-one);
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(24px, 0);
            }
        }

        tr.disabled.table-cart-row td {
            background: #dddddd;
            cursor: no-drop;
        }


        .only-img-page-wrapper.cart .img-box img {
            height: 100%;
        }

        .only-img-page-wrapper.cart .img-box {
            height: 400px;
            display: flex;
            justify-content: center;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="cart-page-wrapper padding-top-20 padding-bottom-20">
        <?php
            $all_cart_items = \Gloudemans\Shoppingcart\Facades\Cart::content();
        ?>
        <?php if(empty($all_cart_items->count())): ?>
            <?php if (isset($component)) { $__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.page.empty','data' => ['image' => get_static_option('empty_cart_image'),'text' => get_static_option('empty_cart_text') ?? __('No products in your cart!')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.page.empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('empty_cart_image')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('empty_cart_text') ?? __('No products in your cart!'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d)): ?>
<?php $attributes = $__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d; ?>
<?php unset($__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d)): ?>
<?php $component = $__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d; ?>
<?php unset($__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d); ?>
<?php endif; ?>
        <?php else: ?>
            <div id="cart-container">
                <?php echo $__env->make('frontend.cart.cart-partial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endif; ?>
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        (function($) {
            'use script'

            $(document).on("click", ".move-wishlist", function(e) {
                let data = new FormData();
                data.append("rowId", $(this).attr("data-product_hash_id"));
                data.append("_token", "<?php echo e(csrf_token()); ?>");

                send_ajax_request("post", data, "<?php echo e(route('frontend.products.cart.move.to.wishlist')); ?>",
            () => {

                }, (data) => {
                    loadHeaderCardAndWishlistArea(data);
                    if ((data.type ?? '') == 'warning') {
                        toastr.warning(data.quantity_msg ?? 'Something went wrong')
                    } else {
                        ajax_toastr_success_message(data);
                    }

                    $(".cart-page-wrapper").load(location.href + " .cart-page-wrapper");
                }, (errors) => {
                    prepare_errors(errors)
                })
            });


            $(document).on("click", ".remove-cart", function(e) {
                let formData = new FormData();
                formData.append("rowId", $(this).attr("data-product_hash_id"));
                formData.append("_token", "<?php echo e(csrf_token()); ?>");

                send_ajax_request("post", formData, "<?php echo e(route('frontend.products.cart.ajax.remove')); ?>", () => {

                }, (data) => {
                    loadHeaderCardAndWishlistArea(data);

                    ajax_toastr_success_message(data);
                    $(".cart-page-wrapper").load(location.href + " .cart-page-wrapper");
                }, (errors) => {
                    prepare_errors(errors);
                })
            });

            $(document).ready(function() {
                $(document).on("click", ".cart-update-table", function() {
                    const el = $(this);
                    let tr = $('.cart-table-body tr');
                    let data = new FormData();
                    data.append("_token", "<?php echo e(csrf_token()); ?>")
                    el.text("<?php echo e(__("Updating....")); ?>")

                    $('.cart-table-body tr').each(function() {
                        data.append("rowId[]", $(this).data("product_hash_id"))
                        data.append("quantity[]", $(this).find(".quantity-input").val())
                        data.append("product_id[]", $(this).data("product-id"))
                        data.append("variant_id[]", $(this).data("varinat-id"))
                    })

                    send_ajax_request('post', data, "<?php echo e(route('frontend.products.cart.update.ajax')); ?>", () => {
                            $(this).find('.icon-close i').removeClass("la-times").addClass(
                                "la-spinner");
                            $('.cart-item-count-amount').html("<i class='las la-spinner'></i>");
                        }, (data) => {
                            el.text("<?php echo e(__("Update Cart")); ?>")

                            if (data.msg) {
                                if(data.type ?? false){
                                    toastr[data.type](data.msg);
                                }else{
                                    toastr.success(data.msg);
                                }
                            }

                            loadHeaderCardAndWishlistArea(data);

                        $('table.custom--table.table-border.radius-10').load(location.href + ' .custom--table.table-border.radius-10');
                            window.location.load('href=')
                        }, (err) => {
                            el.text("<?php echo e(__("Update Cart")); ?>")
                            if (err.responseJSON.error_type === 'cart') {
                                let messages = err.responseJSON.error_messages;

                                for (let i = 0; i < messages.length; i++) {
                                    setTimeout(() => toastr.error(messages[i]), i * 550)
                                }
                            }

                            if ($(this).data('type') === 'tr') {
                                $(this).closest("tr").removeClass("disabled");
                            }

                            $(this).find('.icon-close i').removeClass("la-spinner").addClass(
                                "la-times");

                            prepare_errors(err)
                        })
                });

                $(document).on('click', '.clear_cart', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '<?php echo e(route('frontend.products.cart.ajax.clear')); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                        },
                        success: function(data) {
                            if (data.type === 'success') {
                                toastr.success(data.msg);
                                setTimeout(function() {
                                    location.reload();
                                }, 500);
                            }
                        },
                        error: function(err) {
                            toastr.error('<?php echo e(__('An error occurred')); ?>');
                        }
                    });
                });

                $(document).on('click', '.value-button.plus.increase', function(e) {
                    e.preventDefault();
                    updateCartQuantity(this);
                });

                $(document).on('click', '.value-button.minus.decrease', function(e) {
                    e.preventDefault();
                    updateCartQuantity(this);
                });

                $(document).on('submit', '.discount-coupon', function(e) {
                    e.preventDefault();
                    let url = $(this).attr('action');
                    let data = $(this).serialize();
                    $('.lds-ellipsis').show();

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        success: function(data) {
                            $('.lds-ellipsis').hide();
                            $('#cart-container').html(data);
                        },
                        error: function(err) {
                            toastr.error('<?php echo e(__('An error occurred')); ?>');
                        }
                    });
                });
            });
        })(jQuery)

        function updateCartQuantity(context) {
            let all_item_info = $('.item_quantity_info');
            let cart_data = [];
            let this_btn = $(context);

            this_btn.closest('tr').css('opacity', '.2');

            for (let i = 0; i < all_item_info.length; i++) {
                cart_data.push({
                    id: $(all_item_info[i]).data('id'),
                    product_attribute: $(all_item_info[i]).data('attr'),
                    quantity: $(all_item_info[i]).val(),
                });
            }

            $('.lds-ellipsis').show();

            $.ajax({
                url: '<?php echo e(route('frontend.products.cart.update.ajax')); ?>',
                type: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    cart_data: cart_data,
                    coupon: $('#coupon_input').val()
                },
                success: function(data) {
                    $('.lds-ellipsis').hide();
                    this_btn.closest('tr').attr('opacity', '1');
                    $('#cart-container').html(data);
                },
                error: function(err) {
                    this_btn.closest('tr').attr('opacity', '1');
                    toastr.error('<?php echo e(__('An error occurred')); ?>');
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/cart/all.blade.php ENDPATH**/ ?>