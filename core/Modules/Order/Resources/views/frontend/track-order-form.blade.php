@extends('frontend.frontend-page-master')

@section('site-title')
    {{ __('Order Tracking') }}
@endsection

@section('page-title')
    {{ __('Order Tracking') }}
@endsection

@section('content')
    <div class="sign-in-area-wrapper padding-top-20 padding-bottom-20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="sign-in register">
                        <h3 class="custom__form mt-4">{{ __('Order Tracking') }}</h3>
                        <div class="form-wrapper custom__form mt-4">
                            <x-msg.flash />
                            <x-msg.error />

                            @if (session()->has('info'))
                                <div class="alert alert-{{ session('type') }}">
                                    {!! session('info') !!}
                                </div>
                            @endif

                            <form method="get" action="{{ route('frontend.products.track.order') }}">
                                <div class="form-group mt-2">
                                    <label for="order_id">{{ __('Tracking Number ') }}</label>
                                    <input type="text" name="order_id" class="form-control" id="order_id"
                                        placeholder="{{ __('Tracking Number ') }}">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="phone">{{ __('Phone') }}</label>
                                    <input type="number" name="phone" class="form-control" id="phone"
                                        placeholder="{{ __('Phone Number') }}">
                                </div>

                                <div class="btn-wrapper mt-4">
                                    <button type="submit" class="cmn_btn btn_bg_1 btn_small">
                                        {{ __('Track your order') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex align-items-center pt-5">
                    <img src="{{ asset('assets/img/tracking/treaking-image.webp') }}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
