
<script>
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    (function ($) {
        "use strict";

        <?php if(!empty(get_static_option('site_sticky_navbar_enabled'))): ?>
        $(window).on('scroll', function () {

            if ($(window).width() > 992) {
                /*--------------------------
                sticky menu activation
               -------------------------*/
                var st = $(this).scrollTop();
                var mainMenuTop = $('.navbar-area');
                if ($(window).scrollTop() > 1000) {
                    // active sticky menu on scrollup
                    mainMenuTop.addClass('nav-fixed');
                } else {
                    mainMenuTop.removeClass('nav-fixed ');
                }
            }
        });
        <?php endif; ?>
        $(document).on('click','.language_dropdown ul li',function(e){
            var el = $(this);
            el.parent().parent().find('.selected-language').text(el.text());
            el.parent().removeClass('show');
            $.ajax({
                url : "<?php echo e(route('frontend.langchange')); ?>",
                type: "GET",
                data:{
                    'lang' : el.data('value')
                },
                success:function (data) {
                    location.reload();
                }
            })
        });
        $(document).on('click', '.newsletter-form-wrap .form-btn-2', function (e) {
            e.preventDefault();
            var email = $('.newsletter-form-wrap input[type="email"]').val();
            var errrContaner = $(this).parent().parent().parent().find('.form-message-show');
            errrContaner.html('');
            var paperIcon = 'lar la-paper-plane';
            var spinnerIcon = 'las la-spinner la-spin';
            var el = $(this);
            el.find('i').removeClass(paperIcon).addClass(spinnerIcon);
            $.ajax({
                url: "<?php echo e(route('frontend.subscribe.newsletter')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    email: email
                },
                success: function (data) {
                    errrContaner.html('<div class="alert alert-'+data.type+'">' + data.msg + '</div>');
                    el.find('i').addClass(paperIcon).removeClass(spinnerIcon);
                },
                error: function (data) {
                    el.find('i').addClass(paperIcon).removeClass(spinnerIcon);
                    var errors = data.responseJSON.errors;
                    errrContaner.html('<div class="alert alert-danger">' + errors.email[0] + '</div>');
                }
            });
        });

    <?php if (isset($component)) { $__componentOriginal49ce259fe083ca0ab8b153aeac0860ea = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal49ce259fe083ca0ab8b153aeac0860ea = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.page-builder.product-category-filter-one','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.page-builder.product-category-filter-one'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal49ce259fe083ca0ab8b153aeac0860ea)): ?>
<?php $attributes = $__attributesOriginal49ce259fe083ca0ab8b153aeac0860ea; ?>
<?php unset($__attributesOriginal49ce259fe083ca0ab8b153aeac0860ea); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal49ce259fe083ca0ab8b153aeac0860ea)): ?>
<?php $component = $__componentOriginal49ce259fe083ca0ab8b153aeac0860ea; ?>
<?php unset($__componentOriginal49ce259fe083ca0ab8b153aeac0860ea); ?>
<?php endif; ?>

    }(jQuery));
</script><?php /**PATH C:\wamp64\www\sombokchab\core\resources\views/frontend/partials/inline-script.blade.php ENDPATH**/ ?>