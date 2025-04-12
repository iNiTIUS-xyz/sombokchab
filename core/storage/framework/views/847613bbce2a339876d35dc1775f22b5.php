<?php $__env->startSection('page-title', __('Compare')); ?>

<?php $__env->startSection('style'); ?>
    <style>
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

<?php
    $setting_text = \App\StaticOption::whereIn('option_name', ['product_in_stock_text', 'product_out_of_stock_text', 'details_tab_text', 'additional_information_text', 'reviews_text', 'your_reviews_text', 'write_your_feedback_text', 'post_your_feedback_text'])
        ->get()
        ->mapWithKeys(fn($item) => [$item->option_name => $item->option_value])
        ->toArray();
?>

<?php $__env->startSection('content'); ?>
    <!-- Compare Area Starts -->
    <section class="compare-area padding-top-100 padding-bottom-100">
        <div class="container container-one">
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = \Gloudemans\Shoppingcart\Facades\Cart::instance("compare")->content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $product_inventory = \Modules\Product\Entities\ProductInventory::where('product_id', $product->id)->first();

                        $campaign_product = $product->campaign_product ?? null;
                        $campaignSoldCount = $product?->campaign_sold_product;
                        $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : optional($product->inventory)->stock_count;

                        if ($product->options->variant_id ?? false) {
                            $product_inventory_details = \Modules\Product\Entities\ProductInventoryDetail::where('id', $product->options->variant_id)->first();
                            $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : $product_inventory_details->stock_count;
                        } else {
                            $product_inventory_details = null;
                        }

                        $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ? $stock_count : 0;
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-compare text-center">
                            <div class="compare-thumbs">
                                <?php if(!is_int($product->options->image)): ?>
                                    <a href="#1"> <?php echo render_image($product->options->image); ?> </a>
                                <?php endif; ?>
                            </div>
                            <div class="compare-contents mt-3">
                                <h4 class="common-title">
                                    <a href="<?php echo e(route('frontend.products.single', $product->options->slug ?? '')); ?>">
                                        <?php echo e($product->name); ?>

                                    </a>
                                </h4>
                                <ul class="compare-review-list mt-2">
                                    <li class="rating-wrap">
                                        <div class="ratings">
                                            <span class="hide-rating"></span>
                                            <span class="show-rating"
                                                style="width: <?php echo e($product->options->avg_review * 20); ?>%!important"></span>
                                        </div>
                                        <p> <span class="total-ratings">(<?php echo e($product->options->review_count ?? 0); ?>)</span>
                                        </p>
                                    </li>
                                </ul>
                                <h4 class="common-price-title-two color-one mt-3">
                                    <?php echo e(float_amount_with_currency_symbol($product->price)); ?> </h4>
                                <ul class="compare-content-list mt-3">
                                    <li class="list">
                                        <span class="model"> <?php echo e(__('SKU:')); ?> <?php echo e($product->options->sku); ?> </span>
                                    </li>
                                    <li class="list">
                                        <p class="common-para">
                                            <?php echo e(strip_tags($product->options->sort_description)); ?>

                                        </p>
                                    </li>
                                    <li class="list">
                                        <?php if($stock_count > 0): ?>
                                            <span
                                                class="availability"><?php echo e(filter_static_option_value('product_in_stock_text', $setting_text, __('In stock'))); ?>

                                                (<?php echo e($stock_count); ?>)
                                            </span>
                                        <?php else: ?>
                                            <span
                                                class="availability text-danger"><?php echo e(filter_static_option_value('product_out_of_stock_text', $setting_text, __('Out of stock'))); ?></span>
                                        <?php endif; ?>
                                    </li>
                                    <?php if($product->options->color_name ?? null): ?>
                                        <li class="list"><?php echo e(__('Color:')); ?> <b class="">
                                                <?php echo e($product->options->color_name); ?> </b> </li>
                                    <?php endif; ?>
                                    <?php if($product->options->size_name ?? null): ?>
                                        <li class="list"><?php echo e(__('Size:')); ?> <b class="">
                                                <?php echo e($product->options->size_name); ?> </b> </li>
                                    <?php endif; ?>
                                    <?php if($product->options->attributes ?? null): ?>
                                        <?php $__currentLoopData = $product->options->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list"><?php echo e($key); ?>: <b class=""> <?php echo e($value); ?>

                                                </b> </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                </ul>
                                <div class="btn-wrapper mt-3">
                                    <a href="#1" data-product_hash_id="<?php echo e($product->rowId); ?>"
                                        class="btn btn-danger px-5 py-2 remove_compare_item_ajax"><?php echo e(__('Remove')); ?> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12">
                        <div class=" cart-page-wrapper">
                            <?php if (isset($component)) { $__componentOriginal6dae9f4823cf03323ce96ab1f18c3a4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6dae9f4823cf03323ce96ab1f18c3a4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.page.empty','data' => ['image' => get_static_option('compare_empty_image'),'text' => get_static_option('compare_title') ?? __('No products in your compare page!')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.page.empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('compare_empty_image')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('compare_title') ?? __('No products in your compare page!'))]); ?>
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
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- Compare Area end -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        (function($) {
            'use strict'

            $(document).on('click', '.remove_compare_item_ajax', function(e) {
                e.preventDefault();

                let formData = new FormData();
                formData.append("rowId", $(this).attr("data-product_hash_id"));
                formData.append("_token", "<?php echo e(csrf_token()); ?>");

                send_ajax_request("post", formData, "<?php echo e(route('frontend.products.compare.ajax.remove')); ?>",
                    () => {

                    }, (data) => {
                        loadHeaderCardAndWishlistArea(data);
                        ajax_toastr_success_message(data);
                        $(".compare-area").load(location.href + " .compare-area");
                    }, (errors) => {
                        prepare_errors(errors);
                    })
            });
        })(jQuery)
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/frontend/compare/all.blade.php ENDPATH**/ ?>