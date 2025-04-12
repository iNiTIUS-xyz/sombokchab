<div class="accordion-wrapper">
    <div id="accordion-payment">
        <?php $__currentLoopData = $all_gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card">
                <div class="card-header" id="<?php echo e($loop->index); ?>_settings">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#settings_content_<?php echo e($loop->index); ?>" aria-expanded="false" >
                            <span class="page-title"> <?php echo e(str_replace("_"," ",$gateway->name)); ?></span>
                        </button>
                    </h5>
                </div>
                <div id="settings_content_<?php echo e($loop->index); ?>" class="collapse"  data-parent="#accordion-payment">
                    <div class="card-body">
                        <?php if(!empty($gateway->description)): ?>
                            <div class="payment-notice alert alert-warning">
                                <p><?php echo e($gateway->description); ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="instamojo_gateway"><strong><?php echo e(__('Enable/Disable')); ?> <?php echo e(ucfirst($gateway->name)); ?></strong></label>
                            <input type="hidden" name="<?php echo e($gateway->name); ?>_gateway">
                            <label class="switch">
                                <input type="checkbox" name="<?php echo e($gateway->name); ?>_gateway"  <?php if($gateway->status === 1 ): ?> checked <?php endif; ?> >
                                <span class="slider onff"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="instamojo_test_mode"><strong><?php echo e(sprintf(__('Enable Test Mode %s'),ucfirst($gateway->name))); ?></strong></label>

                            <label class="switch">
                                <input type="checkbox" name="<?php echo e($gateway->name); ?>_test_mode" <?php if($gateway->test_mode === 1): ?> checked <?php endif; ?>>
                                <span class="slider onff"></span>
                            </label>
                        </div>

                        <?php if (isset($component)) { $__componentOriginal0df8641fc6be7d03bbc3b12e975af785 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0df8641fc6be7d03bbc3b12e975af785 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media-upload','data' => ['required' => 'true','title' => ''.e(sprintf(__('%s Logo'),ucfirst($gateway->name))).'','name' => ''.e($gateway->name.'_logo').'','oldimage' => $gateway->oldImage]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => 'true','title' => ''.e(sprintf(__('%s Logo'),ucfirst($gateway->name))).'','name' => ''.e($gateway->name.'_logo').'','oldimage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($gateway->oldImage)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0df8641fc6be7d03bbc3b12e975af785)): ?>
<?php $attributes = $__attributesOriginal0df8641fc6be7d03bbc3b12e975af785; ?>
<?php unset($__attributesOriginal0df8641fc6be7d03bbc3b12e975af785); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0df8641fc6be7d03bbc3b12e975af785)): ?>
<?php $component = $__componentOriginal0df8641fc6be7d03bbc3b12e975af785; ?>
<?php unset($__componentOriginal0df8641fc6be7d03bbc3b12e975af785); ?>
<?php endif; ?>

                        <?php
                            $credentials = !empty($gateway->credentials) ? json_decode($gateway->credentials) : [];
                        ?>

                        <?php $__currentLoopData = $credentials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cre_name =>  $cre_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                                <label ><?php echo e(str_replace('_', ' ' , ucwords($cre_name))); ?></label>
                                <input type="text" name="<?php echo e($gateway->name.'_'.$cre_name); ?>" value="<?php echo e($cre_value); ?>" class="form-control">
                                <?php if($gateway->name == 'paytabs'): ?>
                                    <?php if($cre_name == 'region'): ?>
                                        <small class="text-secondary" style="font-size: 13px">GLOBAL, ARE, EGY, SAU, OMN, JOR</small>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\resources\views/backend/general-settings/payment-settings/payment-credential-settings.blade.php ENDPATH**/ ?>