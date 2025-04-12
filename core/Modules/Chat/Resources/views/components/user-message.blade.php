@php
    $msg_text = $message->message;
    $condition = null;

    if($message->from_user == 1){
        $condition = true;
    }else{
        $condition = false;
    }
    $product = json_decode(json_encode($msg_text['product']));
@endphp
<div class="chatContact__contents__inner__chat__item {{ $condition ? "" : "chatReply" }}">
    @if(!$condition)
        <span class="chatReply__img margin-top-20">{!! $message->from_user == 1 ? $userimage : $vendorimage !!}</span>
    @endif

    <div class="">
        <small @if($condition) class="text-right-time" @endif >{{ $message->created_at->diffForHumans() }}</small>
        <p class="chatContact__contents__inner__chat__item__para {{ ($msg_text['message'] || $message->file) ? "" : "d-none" }}">

            {{ $msg_text['message'] ?? "" }}

            @if($message->file != '')
                <br />
                {!! render_image($message->file, custom_path: \Modules\Chat\Services\UserChatService::FOLDER_PATH) !!}
            @endif
        </p>

        @if(!empty($product))
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ $product->image }}" class="img-fluid rounded-start" alt="{{ $product->name }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">
                                {{ __("Category: ") }} {{ $product->category }} ,{{ __("Brand:") }} {{ $product->brand }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if($condition)
        <span class="chatReply__img">{!! $message->from_user == 1 ? $userimage : $vendorimage !!}</span>
    @endif
</div>