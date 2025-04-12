<!-- emoji manage js -->
<script src="<?php echo e(asset("assets/js/uikit-icons.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/js/vanillaEmojiPicker.js")); ?>"></script>
<?php if (isset($component)) { $__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'chat::components.livechat-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('chat::livechat-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac)): ?>
<?php $attributes = $__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac; ?>
<?php unset($__attributesOriginalf1c79c8ea18e2860687f4d18fb9318ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac)): ?>
<?php $component = $__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac; ?>
<?php unset($__componentOriginalf1c79c8ea18e2860687f4d18fb9318ac); ?>
<?php endif; ?>

<script>
    function initLiveChat(userId){
        // initialize livechat js
        const liveChat = new LiveChat();
        // create livechat channel
        liveChat.createChannel(userId, "<?php echo e($vendor?->id); ?>","user");
        // listener
        liveChat.bindEvent('livechat-vendor-' + "<?php echo e($vendor?->id); ?>", function (data){
            $(".livechat-message-body").append(data.messageBlade);
            scrollBottom();
        });

        return liveChat;
    }

    // default behaviour
    initLiveChat("<?php echo e(auth('web')->id()); ?>");

    $(document).on("click","#open-chat-product",function (){
        if($(this).attr("data-is-user-logged-in")){
            // now replace vendor information
            vendor_information($(this));
            // now get status of vendor is vendor active or not
            is_vendor_active($(this));
            // now enable preloader for chat box
            livechat_preloader(true);
            // this method will fetch all previous data if you have
            fetch_chat_data(true);

            sendMessage('','',$("#open-chat-product").attr('data-vendor-id'),"<?php echo e($id); ?>");
        }
    });

    function scrollBottom(){
        const scrollingElement = (document.querySelector("#chatContact__inner") || document.body);
        let scrollSmoothlyToBottom = document.querySelector("#chatContact__inner");

        $(scrollingElement).animate({
            scrollTop: scrollSmoothlyToBottom.scrollHeight,
        }, 500);
    }

    $(document).on("click","#chatContact__contents #send", function (){
        // prepare chat post data
        let file = $('#chatContact__contents .chatContact__contents__footer__bottom #message-file')[0].files[0];
        let message = $('#chatContact__contents .chatContact__contents__footer__input #message').val();
        let vendorId = $("#open-chat-product").attr('data-vendor-id');

        if(message.length > 0 || file !== undefined){
            $('#chatContact__contents .chatContact__contents__footer__input #message').val("")
            $('#chatContact__contents .chatContact__contents__footer__bottom #message-file').val("")
            $('#chatContact__contents .uploadImage').text("");

            sendMessage(message,file,vendorId);
        }else{
            toastr.warning("<?php echo e(__("Please write something for sending a message.")); ?>")
        }
    });

    function sendMessage(message,file,vendor_id,product_id = '', disabledAppend = false){
        let form = new FormData();
        form.append('message', message);
        form.append('file', file !== undefined && file != '' ? file : '');
        form.append('from_user', '1');
        form.append('vendor_id', vendor_id);
        form.append('product_id', product_id);
        form.append('_token', "<?php echo e(csrf_token()); ?>");

        send_ajax_request("post", form, "<?php echo e(route("frontend.chat.message-send")); ?>", function (){
        }, function (response){
            //todo:: now append new message if successfully sent
            // new message will got from server response
            if(disabledAppend){
                return true;
            }else{
                $(".livechat-message-body").append(response);
            }

            scrollBottom();
        }, function (errors){
            prepare_errors(errors);
        });
    }

    function is_vendor_active(buttonElement){
        send_ajax_request("get", null,`<?php echo e(route("frontend.chat.is-vendor-active")); ?>/${buttonElement.attr('data-vendor-id')}`, function (){
            $("#chatContact__contents .chatContact__contents__header__team__contents .chatContact__contents__header__team__activity").html(`<div class="typing-loader"></div>`);
        }, function (response){
            $("#chatContact__contents .chatContact__contents__header__team__contents .chatContact__contents__header__team__activity").text(response.msg)
        }, function (errors){
            prepare_errors(errors);
        })
    }

    function vendor_information(buttonElement){
        $("#chatContact__contents .chatContact__contents__header__team__author__item img").attr("src", buttonElement.attr('data-vendor-logo'))
        $("#chatContact__contents .chatContact__contents__header__team__name a").text(buttonElement.attr('data-vendor-name'))
    }

    function livechat_preloader(enable){
        enable ? $('#chat__preloader').fadeIn('slow') : $('#chat__preloader').fadeOut('slow');
    }

    /*
    ========================================
        Attach File js
    ========================================
    */
    let uploadImage = document.querySelector(".uploadImage");
    let inputTag = document.querySelector(".inputTag");

    if(inputTag != null) {
        inputTag.addEventListener('change', ()=> {
            let inputTag = document.querySelector(".inputTag").files[0];

            uploadImage.innerText = inputTag.name;
        });
    }

    /*-------------------------------------------
        Chat Contact show hide
    ------------------------------------------*/
    $(document).on('click','.chatContact__btn', function() {
        let el = $(this);

        el.toggleClass('showChat');
        $('#chatContact #chatContact__contents').toggleClass('showChat');
    });

    // close chat
    $(document).on('click', '.close_chat', function() {
        $(this).closest('#chatContact').find('.chatContact__btn i').text('comment');
        $(this).closest('#chatContact').find('.chatContact__btn').removeClass('showChat');
        $(this).closest('#chatContact').find('#chatContact__contents').removeClass('showChat');
    })

    //chat question text value
    $(document).on('click', '.findFaq', function(event) {
        let el = $(this);
        let value = el.text();
        let parentWrap = el.closest('#chatContact__contents');
        parentWrap.find('#chatContact__faq, #chatContact__main').addClass('d-none');
        parentWrap.find('#chatContact__chat, #chatContact__team').removeClass('d-none');
        parentWrap.find('.replayfaqText').text(value);

    });

    // emoji picker
    new EmojiPicker({
        trigger: [
            {
                selector: '.emoji_picker',
                insertInto: '.emoji_show'
            }
        ],
        closeButton: true,
        //specialButtons: green
    });

    $(document).on('click', '#login_btn', function (e) {
        let formContainer = $(this).closest('form');
        let el = $(this);
        let phone = formContainer.find('#login_phone').val();
        let password = formContainer.find('#login_password').val();
        let remember = $('#login_form_order_page #login_remember').val();

        el.text('<?php echo e(__("Please Wait")); ?>');

        $.ajax({
            type: 'post',
            url: "<?php echo e(route('user.ajax.login')); ?>",
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                phone: phone,
                password: password,
                remember: remember,
            },
            success: async function (data) {
                if (data.status === 'invalid') {
                    el.text('<?php echo e(__("Login")); ?>')
                    formContainer.find('.error-wrap').html('<div class="alert alert-danger">' + data.msg + '</div>');
                } else {
                    let id = data?.user_identification?.substring(8, data?.user_identification.length - 8)

                    initLiveChat(id);

                    formContainer.find('.error-wrap').html('');
                    toastr.success("<?php echo e(__("Successfully logged in ")); ?>")

                    el.closest('#chatContact').find('#chatContact__form, #chatContact__login').addClass('d-none');
                    el.closest('#chatContact').find('#chatContact__inner, #chatContact__faq, #chatContact__footer, #chatContact__main, .chatContact__contents__header__team').removeClass('d-none');

                    $("header").load(location.href + " header");

                    $($("#open-chat-product")).attr("data-is-user-logged-in", true);

                    // now replace vendor information
                    vendor_information($("#open-chat-product"));
                    // now get status of vendor is vendor active or not
                    is_vendor_active($("#open-chat-product"));
                    // now enable preloader for chat box
                    livechat_preloader(false);
                    // this method will fetch all previous data if you have
                    await fetch_chat_data(true);

                    sendMessage('', '', $("#open-chat-product").attr('data-vendor-id'), "<?php echo e($id); ?>");
                }
            },
            error: function (data) {
                var response = data.responseJSON.errors;
                formContainer.find('.error-wrap').html('<ul class="alert alert-danger"></ul>');
                $.each(response, function (value, index) {
                    formContainer.find('.error-wrap ul').append('<li>' + index + '</li>');
                });
                el.text('<?php echo e(__("Login")); ?>');
            }
        });
    });

    $(document).on("click",".load-more-pagination", function (){
        let el = $(this);
        let page = parseInt(el.attr('data-page'));
        let nextPage = page + 1;

        fetch_chat_data('', nextPage, function (){
            el.attr("data-page",nextPage);
        });
    });

    function fetch_chat_data(isFromProduct, page = 1, callback){
        // hare call a api for fetching data from database if no data available then new item will be inserted
        let formData,
         vendor_id = "<?php echo e($vendor->id ?? ""); ?>",
         product_id = "<?php echo e($id); ?>";

        formData = new FormData();
        formData.append("vendor_id", vendor_id);
        formData.append("product_id", isFromProduct ? product_id : '');
        formData.append("_token", "<?php echo e(csrf_token()); ?>");
        formData.append("from_user", 1);

        send_ajax_request("post", formData,`<?php echo e(route("frontend.chat.fetch-user-chat-record")); ?>?page=${page}`,function (){

        }, function (data){
            if(page > 1){
                $(".livechat-message-body").prepend(data);
            }else{
                $(".livechat-message-body").html(data);
                // now scroll bottom with an animation
                scrollBottom();
            }

            livechat_preloader(false);

            if (typeof callback === "function") {
                callback();
            }
        }, function (errors){
            prepare_errors(errors);
        })
    }
</script><?php /**PATH C:\wamp64\www\sombokchab\core\Modules/Chat\Resources/views/components/frontend-js.blade.php ENDPATH**/ ?>