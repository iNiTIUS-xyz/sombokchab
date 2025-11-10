@extends('frontend.frontend-page-master')
@section('site-title')
    {{ __('Track Order') }}
@endsection
@section('page-title')
    {{ __('Track Order') }}
@endsection

@section('content')
<div class="track-order-section py-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4">
                    <h4 class="mb-3 text-center">{{ __('Track Your Order') }}</h4>
                    <x-msg.flash />
                    <x-msg.error />

                    <form method="GET" action="{{ route('frontend.track.order') }}">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Order Number') }}</label>
                            <input type="text" name="order_number" class="form-control"
                                   value="{{ request('order_number') }}"
                                   placeholder="Enter your order number" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('Phone Number') }}</label>
                            <input type="text" name="phone" class="form-control"
                                   value="{{ request('phone') }}"
                                   placeholder="+8801XXXXXXXXX" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            {{ __('Track Order') }}
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-5 d-none d-md-block text-center">
                <img src="{{ asset('assets/frontend/img/track-order.png') }}" class="img-fluid" alt="Track Order">
            </div>
        </div>
    </div>
</div>
@endsection
