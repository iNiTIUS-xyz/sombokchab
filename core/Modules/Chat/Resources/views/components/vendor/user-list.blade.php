<li class="chat_wrapper__contact__list__item chat_item" data-user-id="{{ $vendorchat->user?->id }}">
    <div class="chat_wrapper__contact__list__flex">
        <div class="chat_wrapper__contact__list__thumb">
            <a href="#1">
                {!! render_image($vendorchat->user?->profile_image, defaultImage: true) !!}
            </a>
            <div class="notification__dots {{ Cache::has('user_is_online_' . $vendorchat->user?->id) ? "active" : "" }}"></div>
        </div>
        <div class="chat_wrapper__contact__list__contents">
            <div class="chat_wrapper__contact__list__contents__details">
                <h4 class="chat_wrapper__contact__list__contents__title"><a href="#1">{{ $vendorchat->user?->name }}</a></h4>
                <p class="chat_wrapper__contact__list__contents__para">{{ Cache::has('user_is_online_' . $vendorchat->user?->id) ? __("Online") : __("Offline") }}</p>
            </div>
            <span class="chat_wrapper__contact__list__time">
                {{ $vendorchat->user?->check_online_status?->diffForHumans() }}

                @if($vendorchat->vendor_unseen_msg_count > 0)
                    <br>
                    <span class="badge bg-danger text-right">{{ $vendorchat->vendor_unseen_msg_count }}</span>
                @endif
            </span>
        </div>
    </div>
</li>