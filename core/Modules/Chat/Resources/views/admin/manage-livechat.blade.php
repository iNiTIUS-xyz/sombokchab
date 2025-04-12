@extends('backend.admin-master')

@section('site-title', __('Livechat settings'))

@section('style')

@endsection

@section('content')
    <div class="row g-4">
        <div class="col-xxl-6">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h2 class="dashboard__card__title">{{ __('Live Chat settings') }}</h2>
                </div>
                <div class="dashboard__card__body custom__form mt-4">
                    <x-msg.flash />
                    <x-msg.error />
                    <form action="{{ route('admin.livechat.settings') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">{{ __('Pusher App Id') }}</label>
                                    <input type="text" value="{{ env('pusher_app_id') }}" name="PUSHER_APP_ID"
                                        class="form-control" placeholder="{{ __('Write pusher app id') }}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">{{ __('Pusher App Key') }}</label>
                                    <input type="text" value="{{ env('pusher_app_key') }}" name="PUSHER_APP_KEY"
                                        class="form-control" placeholder="{{ __('Write pusher app key') }}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">{{ __('Pusher App Secret') }}</label>
                                    <input type="text" value="{{ env('pusher_app_secret') }}" name="PUSHER_APP_SECRET"
                                        class="form-control" placeholder="{{ __('Write pusher app secret') }}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
