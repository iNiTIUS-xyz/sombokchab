<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa)): ?>
<?php $attributes = $__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa; ?>
<?php unset($__attributesOriginalbc1bcd20222d67be5eb46ea1d22a74fa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa)): ?>
<?php $component = $__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa; ?>
<?php unset($__componentOriginalbc1bcd20222d67be5eb46ea1d22a74fa); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginald6c22cd6617e2f6bf867d0caa6f43bfa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald6c22cd6617e2f6bf867d0caa6f43bfa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.niceselect.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('niceselect.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald6c22cd6617e2f6bf867d0caa6f43bfa)): ?>
<?php $attributes = $__attributesOriginald6c22cd6617e2f6bf867d0caa6f43bfa; ?>
<?php unset($__attributesOriginald6c22cd6617e2f6bf867d0caa6f43bfa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald6c22cd6617e2f6bf867d0caa6f43bfa)): ?>
<?php $component = $__componentOriginald6c22cd6617e2f6bf867d0caa6f43bfa; ?>
<?php unset($__componentOriginald6c22cd6617e2f6bf867d0caa6f43bfa); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('section'); ?>
    <div class="bodyUser_overlay"></div>
    <div class="dashboard-form-wrapper">
        <h2 class="dashboard__card__title"><?php echo e(__('Edit Profile')); ?></h2>
        <div class="custom__form mt-4">
            <form action="<?php echo e(route('user.profile.update')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="name"><?php echo e(__('Name')); ?></label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?php echo e($user_details->name); ?>">
                </div>
                <div class="form-group">
                    <label for="email"><?php echo e(__('Email')); ?></label>
                    <input type="text" class="form-control" id="email" name="email"
                        value="<?php echo e($user_details->email); ?>">
                </div>
                <div class="form-group">
                    <label for="phone"><?php echo e(__('Phone')); ?></label>
                    <input type="tel" class="form-control" id="phone" name="phone"
                        value="<?php echo e($user_details->phone); ?>">
                </div>

                <div class="form-group">
                    <?php
                        $all_countries = DB::table('countries')
                            ->select('id', 'name')
                            ->where('status', 'publish')
                            ->get();
                    ?>

                    <label for="country"><?php echo e(__('Country')); ?></label>
                    <select id="country" class="form-control wide" name="country">
                        <option value="">Select Country</option>
                        <?php $__currentLoopData = $all_countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($country->id); ?>" <?php echo e($user_details->country == $country->id ? 'selected' : ''); ?>>
                                <?php echo e($country->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="state"><?php echo e(__('State')); ?></label>

                    <select class="form-control" id="state" name="state">
                        <option value=""><?php echo e(__('Select State')); ?></option>
                        <?php
                            $states = \Modules\CountryManage\Entities\State::where("country_id", $user_details->country ?? 0)->get();
                        ?>

                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($state->id); ?>" <?php echo e($state->id == $user_details->state ? 'selected' : ''); ?>>
                                <?php echo e($state->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="city"><?php echo e(__('City')); ?></label>

                    <select class="form-control" id="city" name="city">
                        <option value=""><?php echo e(__('Select City')); ?></option>
                        <?php
                            $cities = \Modules\CountryManage\Entities\City::where("state_id", $user_details->state ?? 0)->get();
                        ?>

                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($city->id); ?>" <?php echo e($user_details->city == $city->id ? 'selected' : ''); ?>>
                                <?php echo e($city->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="zipcode"><?php echo e(__('Zipcode')); ?></label>
                    <input type="text" class="form-control" id="zipcode" name="zipcode"
                        value="<?php echo e($user_details->zipcode); ?>">
                </div>
                <div class="form-group">
                    <label for="address"><?php echo e(__('Address')); ?></label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="<?php echo e($user_details->address); ?>">
                </div>
                <div class="form-group">
                    <?php if (isset($component)) { $__componentOriginal0df8641fc6be7d03bbc3b12e975af785 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0df8641fc6be7d03bbc3b12e975af785 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media-upload','data' => ['title' => __('Profile image'),'name' => 'image','oldimage' => $user_details->image]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Profile image')),'name' => 'image','oldimage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user_details->image)]); ?>
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
                    <small><?php echo e(__('Recommended image size 150x150')); ?></small>
                </div>

                <div class="btn-wrapper mt-4">
                    <button type="submit" class="cmn_btn btn_bg_2"><?php echo e(__('Save changes')); ?></button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="dashboard-form-wrapper" style="margin-top: 20px">
        <h2 class="dashboard__card__title"><?php echo e(__('Deactivate Account')); ?></h2>
        <div class="custom__form mt-4">
            <form action="<?php echo e(route('user.deactivate')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="password"><?php echo e(__('Password')); ?></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                </div>
                <div class="btn-wrapper mt-2">
                    <button type="submit" class="cmn_btn btn_bg_4"><?php echo e(__('Deactivate Account')); ?></button>
                </div>
            </form>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.markup','data' => ['userUpload' => true,'type' => 'user','imageUploadRoute' => route('user.upload.media.file')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['userUpload' => true,'type' => 'user','imageUploadRoute' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('user.upload.media.file'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75)): ?>
<?php $attributes = $__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75; ?>
<?php unset($__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75)): ?>
<?php $component = $__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75; ?>
<?php unset($__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginalfc21ac509768111c9db09ce0360a300e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfc21ac509768111c9db09ce0360a300e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.niceselect.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('niceselect.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfc21ac509768111c9db09ce0360a300e)): ?>
<?php $attributes = $__attributesOriginalfc21ac509768111c9db09ce0360a300e; ?>
<?php unset($__attributesOriginalfc21ac509768111c9db09ce0360a300e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfc21ac509768111c9db09ce0360a300e)): ?>
<?php $component = $__componentOriginalfc21ac509768111c9db09ce0360a300e; ?>
<?php unset($__componentOriginalfc21ac509768111c9db09ce0360a300e); ?>
<?php endif; ?>
    <script>
        (function($) {
            "use strict";

            $(document).on("change", "#country", function() {
                let id = $(this).val().trim();

                $.get('<?php echo e(route('country.state.info.ajax')); ?>', {
                    id: id
                }).then(function(data) {
                    $('#state').html(data);
                });
            });
            $(document).on("change", "#state", function() {
                let id = $(this).val().trim();

                $.get('<?php echo e(route('state.city.info.ajax')); ?>', {
                    id: id
                }).then(function(data) {
                    $('#city').html(data);
                });
            });

            $(document).ready(function() {
                $(document).on('click', '.bodyUser_overlay', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });
                $(document).on('click', '.mobile_nav', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });

                if ($('.nice-select').length) {
                    $('.nice-select').niceSelect();
                }
            });
        })(jQuery);
    </script>
    <?php if (isset($component)) { $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.js','data' => ['deleteRoute' => route('user.upload.media.file.delete'),'imgAltChangeRoute' => route('user.upload.media.file.alt.change'),'allImageLoadRoute' => route('user.upload.media.file.all'),'type' => 'user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['deleteRoute' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('user.upload.media.file.delete')),'imgAltChangeRoute' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('user.upload.media.file.alt.change')),'allImageLoadRoute' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('user.upload.media.file.all')),'type' => 'user']); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e)): ?>
<?php $attributes = $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e; ?>
<?php unset($__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e)): ?>
<?php $component = $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e; ?>
<?php unset($__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/user/dashboard/edit-profile.blade.php ENDPATH**/ ?>