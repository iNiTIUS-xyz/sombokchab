<div class="chat_wrapper__details__header__flex" id="livechat-message-header" data-user-id="{{ $data->user->id }}">
    <div class="chat_wrapper__details__header__thumb">
        <a href="#1">
            {!! render_image($data->user?->profile_image, defaultImage: true) !!}
        </a>
        <div class="notification__dots {{ Cache::has("user_is_online_" . $data->user->id) ? "active" : "" }}"></div>
    </div>
    <div class="chat_wrapper__details__header__contents">
        <div class="chat_wrapper__contact__list__contents__flex flex-between">
            <h4 class="chat_wrapper__details__header__contents__title"><a href="#1">{{ $data->user->name }}</a></h4>
        </div>
        <p class="chat_wrapper__details__header__contents__para">{{ Cache::has("user_is_online_" . $data->user->id) ? "Online" : "Offline" }}</p>
    </div>
</div>