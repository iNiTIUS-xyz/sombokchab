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
        fetch_chat_data($(this).attr("data-vendor-id"));

        $("#chat_body").attr("data-current-vendor", $(this).attr("data-vendor-id"))

        channelName = {
            userId: "{{ auth('web')->id() }}",
            vendorId: $(this).attr("data-vendor-id"),
            type: "user"
        };

        if(users_list["vendor_id_" + channelName.vendorId] != true){
            // initialize livechat js
            liveChat.createChannel(channelName.userId,channelName.vendorId, channelName.type);
            liveChat.bindEvent('livechat-vendor-' + channelName.vendorId, function (data){
                if($("#chat_body").attr("data-current-vendor") == data.livechat?.vendor?.id) {
                    $("#chat_body").append(data.messageBlade);

                    scrollToBottom();
                }
            });

            users_list["vendor_id_" + channelName.vendorId] = true;
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
        form.append('vendor_id', $("#livechat-message-header").attr('data-vendor-id'));
        form.append('_token', "{{ csrf_token() }}");

        if($('#vendor-message-footer #message').val().length > 0 || file !== undefined){
            $('#vendor-message-footer #message').val("")
            $('#vendor-message-footer #message-file').val("")

            send_ajax_request("post", form, "{{ route("frontend.chat.message-send") }}", function (){}, function (response){
                $("#chat_body").append(response);
                $('#vendor-message-footer #message').val('');
                scrollToBottom();
            }, function (){

            })
        }else{
            toastr.warning("{{ __("Please write something for sending a message.") }}")
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
        // hare call an api for fetching data from a database if no data available then new item will be inserted
        let formData;

        formData = new FormData();
        formData.append("vendor_id", user_id);
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("from_user", 1)
        formData.append("request_from", "dashboard")

        send_ajax_request("post", formData,`{{ route("frontend.chat.fetch-user-chat-record") }}?page=${page}`,function (){

        }, function (response){

            if(page > 1) {
                $("#chat_body").children().not(":first").prepend(response.body);
            }else{
                $("#chat_body").html(`
                            <div class="pagination d-flex justify-content-center mb-3">
                                <button data-page="1" class="btn btn-info load-more-pagination">{{ __("Load More") }}</button>
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
</script>