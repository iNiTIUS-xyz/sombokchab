
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Vendor Create')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/colorpicker.css')); ?>">
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
    <?php if (isset($component)) { $__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d)): ?>
<?php $attributes = $__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d; ?>
<?php unset($__attributesOriginale3fe6bb2f0f61d925063cbbce78cba4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d)): ?>
<?php $component = $__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d; ?>
<?php unset($__componentOriginale3fe6bb2f0f61d925063cbbce78cba4d); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal3321b247a065dca630ecc06232f9782c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3321b247a065dca630ecc06232f9782c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bulk-action.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bulk-action.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3321b247a065dca630ecc06232f9782c)): ?>
<?php $attributes = $__attributesOriginal3321b247a065dca630ecc06232f9782c; ?>
<?php unset($__attributesOriginal3321b247a065dca630ecc06232f9782c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3321b247a065dca630ecc06232f9782c)): ?>
<?php $component = $__componentOriginal3321b247a065dca630ecc06232f9782c; ?>
<?php unset($__componentOriginal3321b247a065dca630ecc06232f9782c); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select2.select2-css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select2.select2-css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade)): ?>
<?php $attributes = $__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade; ?>
<?php unset($__attributesOriginal7a9f1fc0e33dbb5b6865e47c39fccade); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade)): ?>
<?php $component = $__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade; ?>
<?php unset($__componentOriginal7a9f1fc0e33dbb5b6865e47c39fccade); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
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
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title"><?php echo e(__('Vendor Profile Update')); ?></h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form id="vendor-create-form" data-action-url="<?php echo e(route('vendor.profile.update', $vendor->id)); ?>">
                            <div class="toast toast-success"></div>
                            <?php echo csrf_field(); ?>
                            <input name="id" value="<?php echo e($vendor->id); ?>" type="hidden" />
                            <div class="d-flex flex-wrap gap-3 justify-content-between">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#basic-info" type="button" role="tab"
                                            aria-controls="basic-info" aria-selected="true">Basic
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#address" type="button" role="tab" aria-controls="address"
                                            aria-selected="false">Address
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#shop-info" type="button" role="tab"
                                            aria-controls="shop-info" aria-selected="false">Shop Info
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#bank-info" type="button" role="tab"
                                            aria-controls="bank-info" aria-selected="false">Bank Info
                                        </button>
                                    </li>
                                </ul>

                                <div class="submit_button">
                                    <button type="submit" class="cmn_btn btn_bg_profile">Submit</button>
                                </div>
                            </div>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="basic-info" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-6">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title"> Basic Info</h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Owner Name *
                                                                </label>
                                                                <input name="owner_name" type="text"
                                                                    class="form--control radius-10"
                                                                    value="<?php echo e($vendor->owner_name); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Business Name *
                                                                </label>
                                                                <input name="business_name" type="text"
                                                                    class="form--control radius-10"
                                                                    value="<?php echo e($vendor->business_name); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    Username *</label>
                                                                <input name="username" type="text"
                                                                    class="form--control radius-10"
                                                                    value="<?php echo e($vendor->username); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Business
                                                                    Category *</label>
                                                                <div class="nice-select-two">
                                                                    <select id="business_type" name="business_type_id"
                                                                        style="" class="form--control radius-10">
                                                                        <?php $__currentLoopData = $business_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($item->id); ?>"
                                                                                <?php echo e($item->id == $vendor->business_type_id ? 'selected' : ''); ?>>
                                                                                <?php echo e($item->name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    <?php echo e(__('Description')); ?>

                                                                </label>
                                                                <textarea name="description" class="form--control form--message radius-10" style="height: 100px"><?php echo e($vendor->description); ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <?php if (isset($component)) { $__componentOriginal20bde5cfd2347c1b53b38378abb498dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal20bde5cfd2347c1b53b38378abb498dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.media-upload','data' => ['oldImage' => $vendor?->vendor_shop_info?->logo,'title' => __('Logo'),'name' => 'logo_id','dimentions' => '200x200','type' => 'vendor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['old-image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($vendor?->vendor_shop_info?->logo),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Logo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('logo_id'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('200x200'),'type' => 'vendor']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal20bde5cfd2347c1b53b38378abb498dc)): ?>
<?php $attributes = $__attributesOriginal20bde5cfd2347c1b53b38378abb498dc; ?>
<?php unset($__attributesOriginal20bde5cfd2347c1b53b38378abb498dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal20bde5cfd2347c1b53b38378abb498dc)): ?>
<?php $component = $__componentOriginal20bde5cfd2347c1b53b38378abb498dc; ?>
<?php unset($__componentOriginal20bde5cfd2347c1b53b38378abb498dc); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginal20bde5cfd2347c1b53b38378abb498dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal20bde5cfd2347c1b53b38378abb498dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.media-upload','data' => ['oldImage' => $vendor?->vendor_shop_info?->cover_photo,'title' => __('Cover Photo'),'name' => 'cover_photo_id','dimentions' => '200x200','type' => 'vendor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['old-image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($vendor?->vendor_shop_info?->cover_photo),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Cover Photo')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('cover_photo_id'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('200x200'),'type' => 'vendor']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal20bde5cfd2347c1b53b38378abb498dc)): ?>
<?php $attributes = $__attributesOriginal20bde5cfd2347c1b53b38378abb498dc; ?>
<?php unset($__attributesOriginal20bde5cfd2347c1b53b38378abb498dc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal20bde5cfd2347c1b53b38378abb498dc)): ?>
<?php $component = $__componentOriginal20bde5cfd2347c1b53b38378abb498dc; ?>
<?php unset($__componentOriginal20bde5cfd2347c1b53b38378abb498dc); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title"><?php echo e(__('Address')); ?></h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    <?php echo e(__('Country *')); ?>

                                                                </label>
                                                                <div class="nice-select-two country_wrapper">
                                                                    <select class="form-control" id="country_id"
                                                                        name="country_id">
                                                                        <option value="">Select Country</option>
                                                                        <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($item->id); ?>"
                                                                                <?php echo e($vendor?->vendor_address?->country_id == $item->id ? 'selected' : ''); ?>>
                                                                                <?php echo e($item->name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            $states = \Modules\CountryManage\Entities\State::where(
                                                                'country_id',
                                                                31,
                                                            )->get();
                                                            // $states = $vendor?->vendor_address?->country_id ? \Modules\CountryManage\Entities\State::where('country_id', $vendor?->vendor_address?->country_id)->get() : [];
                                                        ?>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    <?php echo e(__('State *')); ?> </label>
                                                                <div class="nice-select-two state_wrapper">
                                                                    <select class="form-control" id="state_id"
                                                                        name="state_id">
                                                                        <option value="">Select State</option>
                                                                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($state->id); ?>"
                                                                                <?php echo e($vendor?->vendor_address?->state_id == $state->id ? 'selected' : ''); ?>>
                                                                                <?php echo e($state->name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                            $cities = $vendor?->vendor_address?->state_id
                                                                ? \App\City::where(
                                                                    'state_id',
                                                                    $vendor?->vendor_address?->state_id,
                                                                )->get()
                                                                : [];
                                                        ?>

                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    <?php echo e(__('City')); ?> </label>
                                                                <div class="nice-select-two city_wrapper">
                                                                    <select class="form-control" id="city_id"
                                                                        name="city_id">
                                                                        <option value="">Select City</option>
                                                                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($city->id); ?>"
                                                                                <?php echo e($vendor?->vendor_address?->city_id == $city->id ? 'selected' : ''); ?>>
                                                                                <?php echo e($city->name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    <?php echo e(__('Zip Code')); ?>

                                                                </label>
                                                                <input type="text" name="zip_code"
                                                                    class="form--control radius-10"
                                                                    value="<?php echo e($vendor?->vendor_address?->zip_code); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    <?php echo e(__('Address')); ?>

                                                                </label>
                                                                <textarea name="address" type="text" class="form--control radius-10" value=""><?php echo e($vendor?->vendor_address?->address); ?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    <?php echo e(__('Google Map Location')); ?>

                                                                </label>
                                                                <textarea name="google_map_location" type="text" class="form--control radius-10" value="">
                                                                    <?php if(!empty($vendor?->vendor_address?->google_map_location)): ?>
<?php echo $location_iframeHtml; ?>

<?php endif; ?>
                                                                </textarea>
                                                                <span class="mt-3">
                                                                    <?php echo e(__('Example: Google Map Embed Code.')); ?>

                                                                </span>
                                                                <pre><code>  &lt;iframe src="https://www.example.com" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"&gt;&lt;/iframe&gt;</code></pre>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="shop-info" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title"><?php echo e(__('Shop Info')); ?></h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    <?php echo e(__('Location')); ?>

                                                                </label>
                                                                <input value="<?php echo e($vendor?->vendor_shop_info?->location); ?>"
                                                                    name="location" type="text"
                                                                    class="form--control radius-10"
                                                                    placeholder="Set Location From Map">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    <?php echo e(__('Number')); ?>

                                                                </label>
                                                                <input value="<?php echo e($vendor?->vendor_shop_info?->number); ?>"
                                                                    name="number" type="tel"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    <?php echo e(__('Email Address')); ?>

                                                                </label>
                                                                <input value="<?php echo e($vendor?->vendor_shop_info?->email); ?>"
                                                                    type="text" name="email"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Facebook Link
                                                                </label>
                                                                <input
                                                                    value="<?php echo e($vendor?->vendor_shop_info?->facebook_url); ?>"
                                                                    type="text" name="facebook_url"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Facebook Link">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Website
                                                                </label>
                                                                <input
                                                                    value="<?php echo e($vendor?->vendor_shop_info?->website_url); ?>"
                                                                    type="text" name="website_url"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Website">
                                                            </div>
                                                        </div>


                                                        <!--color settings start -->
                                                        <span class="label-title color-light mt-3">
                                                            <?php echo e(__('Store Color Settings')); ?></span>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="store_color"><?php echo e(__('Main Color')); ?></label>
                                                                <input type="text" name="store_color"
                                                                    style="background-color: <?php echo e($vendor?->vendor_shop_info?->colors['store_color'] ?? ''); ?>;color: #fff;"
                                                                    class="form-control"
                                                                    value="<?php echo e($vendor?->vendor_shop_info?->colors['store_color'] ?? ''); ?>"
                                                                    id="store_color">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="store_secondary_color"><?php echo e(__('Secondary Color')); ?></label>
                                                                <input type="text" name="store_secondary_color"
                                                                    style="background-color: <?php echo e($vendor?->vendor_shop_info?->colors['store_secondary_color'] ?? ''); ?>;color: #fff;"
                                                                    class="form-control"
                                                                    value="<?php echo e($vendor?->vendor_shop_info?->colors['store_secondary_color'] ?? ''); ?>"
                                                                    id="store_secondary_color">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="store_heading_color"><?php echo e(__('Heading Color')); ?></label>
                                                                <input type="text" name="store_heading_color"
                                                                    style="background-color: <?php echo e($vendor?->vendor_shop_info?->colors['store_heading_color'] ?? ''); ?>;color: #fff;"
                                                                    class="form-control"
                                                                    value="<?php echo e($vendor?->vendor_shop_info?->colors['store_heading_color'] ?? ''); ?>"
                                                                    id="store_heading_color">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="store_paragraph_color"><?php echo e(__('Paragraph Color')); ?></label>
                                                                <input type="text" name="store_paragraph_color"
                                                                    style="background-color: <?php echo e($vendor?->vendor_shop_info?->colors['store_paragraph_color'] ?? ''); ?>;color: #fff;"
                                                                    class="form-control"
                                                                    value="<?php echo e($vendor?->vendor_shop_info?->colors['store_paragraph_color'] ?? ''); ?>"
                                                                    id="store_paragraph_color">
                                                                <small><?php echo e(__('you can change site paragraph color from there')); ?></small>
                                                            </div>
                                                        </div>
                                                        <!--color settings end -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="bank-info" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title">Bank Info</h4>
                                                    <br>
                                                    <?php if($vendor?->vendor_bank_info?->is_varify && $vendor?->vendor_bank_info?->varify_at): ?>
                                                        <p class="text-success">
                                                            Your bank information approved by admin
                                                        </p>
                                                    <?php else: ?>
                                                        <p class="text-warning">
                                                            Your bank information is pending. Wait for admin approval.
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="sdashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Name </label>
                                                                <input
                                                                    value="<?php echo e($vendor?->vendor_bank_info?->bank_name); ?>"
                                                                    name="bank_name" type="text"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Email </label>
                                                                <input
                                                                    value="<?php echo e($vendor?->vendor_bank_info?->bank_email); ?>"
                                                                    name="bank_email" type="text"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Bank Code
                                                                </label>
                                                                <input
                                                                    value="<?php echo e($vendor?->vendor_bank_info?->bank_code); ?>"
                                                                    name="bank_code" type="tel"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Code">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Account Number
                                                                </label>
                                                                <input
                                                                    value="<?php echo e($vendor?->vendor_bank_info?->account_number); ?>"
                                                                    name="account_number" type="tel"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Account Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="body-overlay-desktop"></div>

    <?php if (isset($component)) { $__componentOriginal0a0c44ec0e77c6e781a03c2fda86fc75 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a0c44ec0e77c6e781a03c2fda86fc75 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.markup','data' => ['type' => 'vendor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'vendor']); ?>
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
    <script src="<?php echo e(asset('assets/backend/js/colorpicker.js')); ?>"></script>
    <?php if (isset($component)) { $__componentOriginal579359c93efc143f4744524389ba1039 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal579359c93efc143f4744524389ba1039 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal579359c93efc143f4744524389ba1039)): ?>
<?php $attributes = $__attributesOriginal579359c93efc143f4744524389ba1039; ?>
<?php unset($__attributesOriginal579359c93efc143f4744524389ba1039); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal579359c93efc143f4744524389ba1039)): ?>
<?php $component = $__componentOriginal579359c93efc143f4744524389ba1039; ?>
<?php unset($__componentOriginal579359c93efc143f4744524389ba1039); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal9c9e2f22010721f1a8a11abf87b15b5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c9e2f22010721f1a8a11abf87b15b5e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.js','data' => ['type' => 'vendor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'vendor']); ?>
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
    <?php if (isset($component)) { $__componentOriginal00998a08d228f09b1bf9dc38aef52d23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal00998a08d228f09b1bf9dc38aef52d23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.btn.swal.js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table.btn.swal.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal00998a08d228f09b1bf9dc38aef52d23)): ?>
<?php $attributes = $__attributesOriginal00998a08d228f09b1bf9dc38aef52d23; ?>
<?php unset($__attributesOriginal00998a08d228f09b1bf9dc38aef52d23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal00998a08d228f09b1bf9dc38aef52d23)): ?>
<?php $component = $__componentOriginal00998a08d228f09b1bf9dc38aef52d23; ?>
<?php unset($__componentOriginal00998a08d228f09b1bf9dc38aef52d23); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginala34b824a201f14e7e09beb6785e605e8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala34b824a201f14e7e09beb6785e605e8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select2.select2-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('select2.select2-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala34b824a201f14e7e09beb6785e605e8)): ?>
<?php $attributes = $__attributesOriginala34b824a201f14e7e09beb6785e605e8; ?>
<?php unset($__attributesOriginala34b824a201f14e7e09beb6785e605e8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala34b824a201f14e7e09beb6785e605e8)): ?>
<?php $component = $__componentOriginala34b824a201f14e7e09beb6785e605e8; ?>
<?php unset($__componentOriginala34b824a201f14e7e09beb6785e605e8); ?>
<?php endif; ?>
    <script>
        $('#country_id,#state_id,#city_id').select2()
        $(document).on("submit", "#vendor-create-form", function(e) {
            e.preventDefault();
            let url = $(this).data("action-url"),
                data = new FormData(e.target);

            send_ajax_request("post", data, url, () => {
                // write some code for preloader <i class="las la-spinner"></i>
                $(".submit_button button").append('<i class="las la-spinner"></i>');
                toastr.warning("Request Send.. Please Wait...");
            }, (data) => {
                $("#state_id").html(data.option);
                $(".state_wrapper .list").html(data.li);
                $(".submit_button button i").remove()
                toastr.success("Vendor account updated successfully....");

            }, (data) => {
                toastr.error("Some error found.");
                prepare_errors(data);
                $(".submit_button button i").remove()
            });
        });

        $(document).on("change", "#country_id", function() {
            let data = new FormData();

            data.append("country_id", $(this).val());
            data.append("_token", "<?php echo e(csrf_token()); ?>");

            send_ajax_request("post", data, "<?php echo e(route('vendor.get.state')); ?>", function() {}, (data) => {
                option = "<option value=''>Select an state</option>";
                option += data.option;
                $("#state_id").html(option);
                $(".state_wrapper .list").html(data.li);
            }, (data) => {
                prepare_errors(data);
            })
        });

        $(document).on("change", "#state_id", function() {
            let data = new FormData();

            data.append("country_id", $("#country_id").val());
            data.append("state_id", $(this).val());
            data.append("_token", "<?php echo e(csrf_token()); ?>");

            send_ajax_request("post", data, "<?php echo e(route('vendor.get.city')); ?>", function() {}, (data) => {
                option = "<option value=''>Select an city</option>";
                option += data.option;

                $("#city_id").html(option);
                $(".city_wrapper .list").html(data.li);
            }, (data) => {
                prepare_errors(data);
            })
        });

        $(document).on("keyup keydown click change", "input[name=username]", function() {
            $(this).val(convertToSlug($(this).val()))
        });
    </script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                initColorPicker('#store_color');
                initColorPicker('#store_secondary_color');
                initColorPicker('#store_main_color_two');
                initColorPicker('#store_heading_color');
                initColorPicker('#store_paragraph_color');
                initColorPicker('input[name="portfolio_home_color"');
                initColorPicker('input[name="logistics_home_color"');

                function initColorPicker(selector) {
                    $(selector).ColorPicker({
                        color: '#852aff',
                        onShow: function(colpkr) {
                            $(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function(colpkr) {
                            $(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function(hsb, hex, rgb) {
                            $(selector).css('background-color', '#' + hex);
                            $(selector).val('#' + hex);
                        }
                    });
                }
            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.vendor-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Vendor\Resources/views/vendor/edit.blade.php ENDPATH**/ ?>