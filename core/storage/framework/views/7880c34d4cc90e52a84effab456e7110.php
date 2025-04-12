<?php
    if (!isset($metaData)) {
        $metaData = null;
    }
?>

<h5><?php echo e(__("Product Meta")); ?></h5>
<div class="meta-body-wrapper mt-3">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="general-meta-info-tab" data-bs-toggle="tab"
                data-bs-target="#general-meta-info" type="button" role="tab" aria-controls="home"
                aria-selected="true">
                <?php echo e(__('General Meta Info')); ?></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="facebook-meta-tab" data-bs-toggle="tab" data-bs-target="#facebook-meta"
                type="button" role="tab" aria-controls="facebook-meta" aria-selected="false">
                <?php echo e(__('Facebook meta')); ?></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="twitter-meta-tab" data-bs-toggle="tab" data-bs-target="#twitter-meta"
                type="button" role="tab" aria-controls="twitter-meta" aria-selected="false">
                <?php echo e(__('Twitter meta')); ?></button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane py-4 fade show active" id="general-meta-info" role="tabpanel"
            aria-labelledby="general-meta-info-tab">
            
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title"><?php echo e(__('General Info')); ?></h4>
                </div>
                <div class="dashboard__card__body custom__form mt-4">
                    <div class="form-group dashboard-input">
                        <label for="general-title"><?php echo e(__('Title')); ?></label>
                        <input type="text" id="general-title" value="<?php echo e($metaData?->meta_title); ?>"
                            data-role="tagsinput" class="form--control radius-10 tags_input" name="general_title"
                            placeholder="<?php echo e(__('General info title')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="general-description"><?php echo e(__('Description')); ?></label>
                        <textarea type="text" id="general-description" name="general_description" class="form--control radius-10 py-2"
                            rows="6" placeholder="<?php echo e(__('General info description')); ?>"><?php echo e($metaData?->meta_description); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane py-4 fade" id="facebook-meta" role="tabpanel" aria-labelledby="facebook-meta-tab">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title"><?php echo e(__('Facebook Info')); ?></h4>
                </div>
                <div class="dashboard__card__body custom__form mt-4">
                    <div class="form-group dashboard-input">
                        <label for="facebook-title"><?php echo e(__('Title')); ?></label>
                        <input type="text" id="facebook-title" name="facebook_title"
                            value="<?php echo e($metaData?->facebook_meta_tags); ?>" data-role="tagsinput"
                            class="form--control radius-10 tags_input" placeholder="<?php echo e(__('General info title')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="facebook-description"><?php echo e(__('Description')); ?></label>
                        <textarea type="text" id="facebook-description" name="facebook_description" class="form--control radius-10 py-2"
                            rows="6" placeholder="<?php echo e(__('General info description')); ?>"><?php echo e($metaData?->facebook_meta_description); ?></textarea>
                    </div>
                    <?php if (isset($component)) { $__componentOriginal20bde5cfd2347c1b53b38378abb498dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal20bde5cfd2347c1b53b38378abb498dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.media-upload','data' => ['oldImage' => $metaData?->facebookImage,'title' => __('General Info Meta Image'),'name' => 'facebook_meta_image','dimentions' => '200x200']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['old_image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($metaData?->facebookImage),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('General Info Meta Image')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('facebook_meta_image'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('200x200')]); ?>
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
        <div class="tab-pane py-4 fade" id="twitter-meta" role="tabpanel" aria-labelledby="twitter-meta-tab">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title"><?php echo e(__('Twitter Info')); ?></h4>
                </div>
                <div class="dashboard__card__body custom__form mt-4">
                    <div class="form-group dashboard-input">
                        <label for="general-title"><?php echo e(__('Title')); ?></label>
                        <input type="text" id="twitter-title" value="<?php echo e($metaData?->twitter_meta_tags); ?>"
                            name="twitter_title" data-role="tagsinput" class="form--control radius-10 tags_input"
                            placeholder="<?php echo e(__('General info title')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="general-description"><?php echo e(__('Description')); ?></label>
                        <textarea type="text" id="twitter-description" name="twitter_description" class="form--control radius-10 py-2"
                            rows="6" placeholder="<?php echo e(__('General info description')); ?>"><?php echo e($metaData?->twitter_meta_description); ?></textarea>
                    </div>
                    <?php if (isset($component)) { $__componentOriginal20bde5cfd2347c1b53b38378abb498dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal20bde5cfd2347c1b53b38378abb498dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.media-upload','data' => ['oldImage' => $metaData?->twitterImage,'title' => __('General Info Meta Image'),'name' => 'twitter_meta_image','dimentions' => '200x200']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['old_image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($metaData?->twitterImage),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('General Info Meta Image')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('twitter_meta_image'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('200x200')]); ?>
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
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Product\Resources/views/components/meta-seo.blade.php ENDPATH**/ ?>