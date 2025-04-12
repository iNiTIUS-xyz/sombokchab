<div class="chat_wrapper__details__header__flex" id="livechat-message-header" data-vendor-id="{{ $data->vendor->id }}">
    <div class="chat_wrapper__details__header__thumb">
        <a href="{{ route("frontend.vendors.single", $data->vendor?->username) }}">
            {!! render_image($data->vendor?->logo, defaultImage: true) !!}
        </a>
        <div class="notification__dots {{ Cache::has("user_is_online_" . $data->vendor->id) ? "active" : "" }}"></div>
    </div>
    <div class="chat_wrapper__details__header__contents">
        <div class="chat_wrapper__contact__list__contents__flex flex-between">
            <h4 class="chat_wrapper__details__header__contents__title"><a href="{{ route("frontend.vendors.single", $data->vendor?->username) }}">{{ $data->vendor->business_name }}</a></h4>
        </div>
        <p class="chat_wrapper__details__header__contents__para">{{ Cache::has("vendor_is_online_" . $data->vendor->id) ? "Online" : "Offline" }}</p>
    </div>
</div>