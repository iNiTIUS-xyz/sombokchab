@extends('backend.admin-master')
@section('site-title')
    {{ __('Privacy and policy') }}
@endsection
@section('style')
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Update mobile privacy policy page') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('admin.mobile.settings.privacy.policy') }}" method="post">
                            @csrf
                            <div class="form-group" id="product-list">
                                <label for="products">Select Privacy policy</label>
                                <select id="products" name="page" class="form-control">
                                    <option value="">Select Page</option>
                                    @foreach ($pages as $item)
                                        <option value="{{ $item->id }}"
                                            {{ get_static_option('mobile_privacy_and_policy') == $item->id ? 'selected' : '' }}>
                                            {{ $item->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
@endsection
