<li class="chat_wrapper__contact__list__item chat_item" data-vendor-id="{{ $userChat->vendor?->id }}">
    <div class="chat_wrapper__contact__list__flex">
        <div class="chat_wrapper__contact__list__thumb">
            <a href="#1">
                {!! render_image($userChat->vendor?->logo, defaultImage: true) !!}
            </a>
            <div class="notification__dots {{ Cache::has('user_is_online_' . $userChat->vendor?->id) ? "active" : "" }}"></div>
        </div>
        <div class="chat_wrapper__contact__list__contents">
            <div class="chat_wrapper__contact__list__contents__details">
                <h4 class="chat_wrapper__contact__list__contents__title"><a href="#1">{{ $userChat->vendor?->business_name }}</a></h4>
                <p class="chat_wrapper__contact__list__contents__para">{{ Cache::has('vendor_is_online_' . $userChat->vendor?->id) ? __("Online") : __("Offline") }}</p>
            </div>
            <span class="chat_wrapper__contact__list__time">
                {{ $userChat->vendor?->check_online_status ? $userChat->vendor?->check_online_status?->diffForHumans() : "" }}

                @if($userChat->user_unseen_msg_count > 0)
                    <br>
                    <span class="badge bg-danger text-right">{{ $userChat->user_unseen_msg_count }}</span>
                @endif
            </span>
        </div>
    </div>
</li>