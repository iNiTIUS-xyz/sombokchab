@php
    $product = json_decode(json_encode($message->message['product']));
@endphp

@if($message->from_user == 1)
    <div class="chat_wrapper__details__inner__chat">
        <div class="chat_wrapper__details__inner__chat__flex">
            <div class="chat_wrapper__details__inner__chat__thumb">
                {!! render_image($data->user?->profile_image) !!}
            </div>
            <div class="chat_wrapper__details__inner__chat__contents">
                <p class="chat_wrapper__details__inner__chat__contents__para {{ !empty($product) ? "d-none" : "" }}">{{ $message->message['message'] }}
                    @if(!empty($message->file))
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

                <span class="chat_wrapper__details__inner__chat__contents__time mt-2">
                        {{ $message->created_at->format("F d, Y") }}
                    </span>
            </div>
        </div>
    </div>
@endif

@if($message->from_user == 2)
    <div class="chat_wrapper__details__inner__chat chat-reply">
        <div class="chat_wrapper__details__inner__chat__flex">
            <div class="chat_wrapper__details__inner__chat__thumb">
                {!! render_image($data->vendor?->logo) !!}
            </div>
            <div class="chat_wrapper__details__inner__chat__contents">
                <p class="chat_wrapper__details__inner__chat__contents__para">
                    {{ $message->message['message'] }}
                    @if(!empty($message->file))
                        <br />
                        {!! render_image($message->file, custom_path: \Modules\Chat\Services\UserChatService::FOLDER_PATH) !!}
                    @endif

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
                </p>
                <span class="chat_wrapper__details__inner__chat__contents__time mt-2">
                        {{ $message->created_at->format("F d, Y") }}
                    </span>
            </div>
        </div>
    </div>
@endif