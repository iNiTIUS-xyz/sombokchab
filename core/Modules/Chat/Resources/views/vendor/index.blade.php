@extends('vendor.vendor-master')
@section('site-title', __('Chat module'))

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/vendor-chat.css') }}" />
@endsection

@section('content')
    <div class="dashboard__body">
        <div class="dashboard__inner">
            <div class="chat_wrapper">
                <div class="chat_wrapper__flex">
                    <div class="chat_sidebar d-lg-none">
                        <i class="las la-bars"></i>
                    </div>
                    <div class="chat_wrapper__contact radius-10">
                        <div class="chat_wrapper__contact__close">
                            <div class="close_chat d-lg-none"> <i class="las la-times"></i> </div>
                            <ul class="chat_wrapper__contact__list">
                                @foreach ($vendor_chat_list as $vendor_chat)
                                    <x-chat::vendor.user-list :vendorchat="$vendor_chat" />
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="chat_wrapper__details radius-10">
                        <div class="chat_wrapper__details__header d-none" id="chat_header">

                        </div>

                        <div class="chat_wrapper__details__inner vendor-chat-body" id="chat_body">
                        </div>

                        <div class="chat_wrapper__details__footer profile-border-top d-none" id="vendor-message-footer">
                            <div class="chat_wrapper__details__footer__form custom-form">
                                <form action="#">
                                    <div class="single-input">
                                        <textarea name="message" class="form--control form-message" id="message" placeholder="{{ __('Enter your message') }}"></textarea>
                                    </div>
                                </form>
                                <div class="hat-wrapper-details-footer-btn btn_flex justify-content-end mt-2">
                                    <label class="dropMedia dashboard_table__title__btn btn-outline-border radius-5"
                                        for="message-file">
                                        <input type="file" class="dropMedia__uploader" id="message-file">
                                        <span class="dropMedia__file" id="uploadImage"><i class="fa-solid fa-paperclip"></i>
                                            {{ __('Attach Files') }}</span>
                                    </label>
                                    <a href="#1" class="dashboard_table__title__btn btn_bg_profile radius-5"
                                        id="vendor-send-message-to-user">{{ __('Send Message') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let users_list = {
            {{ $arr }}
        };
    </script>
    <x-chat::livechat-js />
    <x-chat::vendor.vendor-chat-js />
@endsection
