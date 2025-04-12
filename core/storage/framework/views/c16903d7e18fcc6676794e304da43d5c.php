<?php
    $auth = auth('web')->check();
?>

<div class="chatContact" id="chatContact">
    <div class="chatContact__contents" id="chatContact__contents">
        <div class="chatContact__contents__header">
            <div class="chatContact__contents__header__close">
                <p class="chatContact__contents__header__close__icon close_chat"><i class="las la-minus"></i></p>
                <p class="chatContact__contents__header__close__icon close_chat"><i class="las la-times"></i></p>
            </div>
            <div class="chatContact__contents__header__login text-center <?php echo e($auth ? "d-none" : ""); ?>" id="chatContact__login">
                <span class="chatContact__contents__header__say"><img src="<?php echo e(asset("assets/img/chat/wave_emoji.png")); ?>" alt=""></span>
                <h6 class="chatContact__contents__header__title mt-3"><?php echo e(__("Please login to chat with vendor")); ?></h6>
                <p class="chatContact__contents__header__para mt-2"><?php echo e(__("Welcome! Please provide your question/issue below. We'll respond ASAP. Thank you!")); ?></p>
            </div>
            <div class="chatContact__contents__header__team <?php echo e($auth ? "" : "d-none"); ?>" id="chatContact__team">
                <div class="chatContact__contents__header__team__flex">
                    <div class="chatContact__contents__header__team__author">
                        <a href="#1" class="chatContact__contents__header__team__author__item"><img src="" alt=""></a>
                    </div>
                    <div class="chatContact__contents__header__team__contents">
                        <h5 class="chatContact__contents__header__team__name"><a href="#1"></a></h5>
                        <p class="chatContact__contents__header__team__activity mt-1"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="chatContact__contents__inner__form custom_form <?php echo e($auth ? "d-none" : ""); ?>" id="chatContact__form">
            <form action="#">
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="error-wrap"></div>
                    </div>

                    <div class="col-sm-12">
                        <div class="single_input">
                            <label for="username" class="form-label"><?php echo e(__("Phone Number / Email")); ?> </label>
                            <input class="form--control radius-10" type="text" id="login_phone" name="phone"
                                placeholder="<?php echo e(__("Phone Number with Country Code / Email")); ?>">
                            
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="single_input">
                            <label for="password" class="form-label"><?php echo e(__("Password")); ?></label>
                            <input type="password" id="login_password" name="password" class="form--control radius-10" placeholder="<?php echo e(__("Password")); ?>">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="btn-wrapper" id="form_infoSubmit">
                            <button type="button" class="submit_btn w-100 radius-10" id="login_btn"><?php echo e(__("Login")); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="chatContact__contents__inner <?php echo e($auth ? "" : "d-none"); ?>" id="chatContact__inner">
            <div class="preloader__chat" id="chat__preloader">
                <div class="preloader__wrapper">
                    <div class="circle circle-1"></div>
                    <div class="circle circle-2"></div>
                    <div class="circle circle-3"></div>
                    <div class="circle circle-4"></div>
                    <div class="circle circle-5"></div>
                </div>
            </div>
            <div class="pagination d-flex justify-content-center">
                <button data-page="1" class="btn btn-info load-more-pagination"><?php echo e(__("Load More")); ?></button>
            </div>
            <div class="chatContact__contents__inner__faq livechat-message-body" id="chatContact__chat">

            </div>
        </div>
        <div class="chatContact__contents__footer <?php echo e($auth ? "" : "d-none"); ?>" id="chatContact__footer">
            <div class="chatContact__contents__footer__input">
                <textarea class="emoji_show" id="message" name="message" cols="100" rows="5" placeholder="<?php echo e(__("Write a message...")); ?>"></textarea>
            </div>
            <div class="chatContact__contents__footer__bottom">
                <div class="chatContact__contents__footer__bottom__left">
                    <a href="#1" class="chatContact__contents__footer__icon attachment">
                        <i class="las la-paperclip"></i>
                        <input class="inputTag" id="message-file" type="file" name="name" except="jpeg, jpg, png, gif, pdf">
                    </a>
                    <a href="#1" class="chatContact__contents__footer__icon"><i class="las la-meh emoji_picker"></i></a>
                </div>
                <div class="chatContact__contents__footer__bottom__right">
                    <a href="#1" id="send" class="chatSumbit"><i class="las la-paper-plane"></i></a>
                </div>
            </div>
            <small class="uploadImage"></small>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\sombokchab\core\Modules/Chat\Resources/views/components/live-chat-modal.blade.php ENDPATH**/ ?>