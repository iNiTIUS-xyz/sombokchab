
<script>
    /*
    ========================================
        Chat Click and Active Class
    ========================================
    */
    let oldChannelName = "";
    let liveChat, channelName;
    liveChat = new LiveChat();

    $(document).on('click', '.chat_item', function() {

        // first need to remove all active class and after that add active class to clicked item
        $(this).addClass('active').siblings().removeClass('active');
        $('.chat_wrapper__contact__close, .body-overlay').removeClass('active');
        // now fetch all old conversations from request with header and body
        fetch_chat_data($(this).attr("data-user-id"));

        $("#chat_body").attr("data-current-user", $(this).attr("data-user-id"))

        channelName = {
            userId: $(this).attr("data-user-id"),
            vendorId: "<?php echo e(auth('vendor')->id()); ?>",
            type: "vendor"
        };

        if(users_list["user_id_" + channelName.userId] != true){

            // initialize livechat js
            liveChat.createChannel(channelName.userId,channelName.vendorId, channelName.type);
            liveChat.bindEvent('livechat-user-' + channelName.userId, function (data){
                if($("#chat_body").attr("data-current-user") ==  + data.livechat?.user?.id) {
                    $("#chat_body").append(data.messageBlade);

                    scrollToBottom();
                }
            });

            users_list["user_id_" + channelName.userId] = true;
            oldChannelName = channelName;
        }

        $(this).find(".chat_wrapper__contact__list__time .badge").fadeOut();
    });

    $(document).on("click","#vendor-send-message-to-user", function (){
        // prepare chat post data
        let file = $('#vendor-message-footer #message-file')[0].files[0];

        let form = new FormData();
        form.append('message', $('#vendor-message-footer #message').val());
        form.append('file', file !== undefined ? file : '');
        form.append('from_user', '1');
        form.append('user_id', $("#livechat-message-header").attr('data-user-id'));
        form.append('_token', "<?php echo e(csrf_token()); ?>");

        if($('#vendor-message-footer #message').val().length > 0 || file !== undefined){
            $('#vendor-message-footer #message').val("")
            $('#vendor-message-footer #message-file').val("")

            send_ajax_request("post", form, "<?php echo e(route("vendor.chat.message-send")); ?>", function (){}, function (response){
                $("#chat_body").append(response);
                $('#vendor-message-footer #message').val('');
                scrollToBottom();
            }, function (){

            })
        } else {
            toastr.warning("<?php echo e(__("Please write something for sending a message.")); ?>")
        }
    });

    $(document).on("click",".load-more-pagination", function (){
        let el = $(this);
        let page = parseInt(el.attr('data-page'));
        let nextPage = page + 1;

        fetch_chat_data($('#livechat-message-header').attr('data-user-id'), nextPage, function (){
            el.attr("data-page",nextPage);
        });
    });

    function fetch_chat_data(user_id, page = 1, callback){
        // hare call a api for fetching data from database if no data available then new item will be inserted
        let formData;

        formData = new FormData();
        formData.append("user_id", user_id);
        formData.append("_token", "<?php echo e(csrf_token()); ?>");
        formData.append("from_user", 2)

        send_ajax_request("post", formData,`<?php echo e(route("vendor.chat.fetch-vendor-chat-record")); ?>?page=${page}`,function (){

        }, function (response){

            if(page > 1) {
                $("#chat_body").children().not(":first").prepend(response.body);
            }else{
                $("#chat_body").html(`
                            <div class="pagination d-flex justify-content-center mb-3">
                                <button data-page="1" class="btn btn-info load-more-pagination"><?php echo e(__("Load More")); ?></button>
                            </div>` + response.body);
                $("#chat_header").html(response.header);

                scrollToBottom();
            }
            // $(".livechat-message-body").html(response.data);
            // livechat_preloader(false);

            $("#vendor-message-footer").removeClass("d-none");
            $("#chat_header").removeClass("d-none");

            if (typeof callback === "function") {
                callback();
            }
        }, function (){

        })
    }

    function scrollToBottom(){
        const scrollingElement = (document.querySelector("#chat_body") || document.body);
        let scrollSmoothlyToBottom = document.querySelector("#chat_body");

        $(scrollingElement).animate({
            scrollTop: scrollSmoothlyToBottom.scrollHeight,
        }, 500);
    }

    /*
    ========================================
       Chat Responsive Sidebar Css
    ========================================
    */
    $(document).on('click', '.close_chat, .body-overlay', function() {
        $('.chat_wrapper__contact__close, .body-overlay').removeClass('active');
    });
    $(document).on('click', '.chat_sidebar', function() {
        $('.chat_wrapper__contact__close, .body-overlay').addClass('active');
    });

    (function (){
        /*
        ========================================
            Attach File js
        ========================================
        */

        let uploadImage = document.querySelector("#uploadImage");
        let inputTag = document.querySelector("#inputTag");

        if(inputTag != null) {
            inputTag.addEventListener('change', ()=> {

                let inputTagFile = document.querySelector("#inputTag").files[0];

                uploadImage.innerText = inputTagFile.name;
            });
        };
    })();
</script><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Chat\Resources/views/components/vendor/vendor-chat-js.blade.php ENDPATH**/ ?>