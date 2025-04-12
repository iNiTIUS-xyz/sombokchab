<div class="image-product-wrapper">
     <?php if(isset($product)): ?>
          <?php if (isset($component)) { $__componentOriginal20bde5cfd2347c1b53b38378abb498dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal20bde5cfd2347c1b53b38378abb498dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.media-upload','data' => ['type' => 'vendor','oldImage' => $product?->image,'title' => __('Feature Image'),'name' => 'image_id','dimentions' => '200x200']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'vendor','old_image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product?->image),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Feature Image')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image_id'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('200x200')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.media-upload','data' => ['type' => 'vendor','galleryImage' => $product?->gallery_images,'title' => __('Additional Image Gallery'),'name' => 'product_gallery','dimentions' => '200x200','multiple' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'vendor','gallery_image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product?->gallery_images),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Additional Image Gallery')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('product_gallery'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('200x200'),'multiple' => true]); ?>
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
     <?php else: ?>
          <?php if (isset($component)) { $__componentOriginal20bde5cfd2347c1b53b38378abb498dc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal20bde5cfd2347c1b53b38378abb498dc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.media-upload','data' => ['type' => 'vendor','title' => __('Feature Image'),'name' => 'image_id','dimentions' => '200x200']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'vendor','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Feature Image')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image_id'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('200x200')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.media-upload','data' => ['type' => 'vendor','title' => __('Additional Image Gallery'),'name' => 'product_gallery','dimentions' => '200x200','multiple' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'vendor','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Additional Image Gallery')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('product_gallery'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('200x200'),'multiple' => true]); ?>
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
     <?php endif; ?>
</div><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Product\Resources/views/components/product-image.blade.php ENDPATH**/ ?>