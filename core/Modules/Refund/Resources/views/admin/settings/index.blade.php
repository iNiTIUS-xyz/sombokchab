@extends('backend.admin-master')

@section('style')

@endsection

@section('site-title', __('Refund Settings'))

@section('content')
    <x-msg.error />
    <x-msg.flash />
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title">{{ __('Refund Settings') }}</h3>
        </div>
        <div class="dashboard__card__body custom__form mt-4">
            @can('refund-settings-update')
                <form method="POST" action="{{ route('admin.refund.settings.update') }}">
                    @csrf
                    @method('PUT')
                @endcan
                <div class="form-group">
                    <label for="how-long" class="form-label">{{ __('How long customer will be eligible for refund') }}</label>
                    <input type="number" id="how-long" class="form-control form-control-sm"
                        name="how_long_user_will_eligible_for_refund"
                        value="{{ get_static_option('how_long_user_will_eligible_for_refund') }}">
                </div>

                <div class="form-group">
                    <label for="courier_address" class="form-label">{{ __('Courier address') }}</label>
                    <textarea type="number" name="courier_address" id="courier_address">{{ get_static_option('courier_address') }}</textarea>
                </div>

                @can('refund-settings-update')
                    <div class="form-group">
                        <button class="cmn_btn btn_bg_profile">{{ __('Update settings') }}</button>
                    </div>
                </form>
            @endcan
        </div>
    </div>
@endsection

@section('script')
    <script></script>
@endsection
