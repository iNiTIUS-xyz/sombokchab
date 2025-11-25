@extends('backend.admin-master')
@section('style')
<x-media.css />
@endsection
@section('site-title')
{{ __('Sign In /Sign Up Page Settings') }}
@endsection
@section('content')
@can('manage-page-settings')
<div class="col-lg-12 col-ml-12">
    <div class="row">
        <div class="col-lg-12">
            {{--
            <x-msg.success />
            <x-msg.error /> --}}
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title">{{ __('Sign In /Sign Up Page Settings') }}</h4>
                </div>
                <div class="dashboard__card__body custom__form mt-4">
                    <form action="{{ route('admin.page.settings.user.auth') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="toc_page_link">
                                        {{ __('Terms of Service and Conditions Link') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control form-select" id="toc_page_link" name="toc_page_link">
                                        <option value="">{{ __('Select Terms and condition page') }}</option>
                                        @foreach ($pages as $page)
                                        <option value="{{ $page->slug }}">{{ $page->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="privacy_policy_link">
                                        {{ __('Privacy Policy Link') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control form-select" id="privacy_policy_link"
                                        name="privacy_policy_link"
                                        value="{{ get_static_option('privacy_policy_link') }}">
                                        <option value="">{{ __('Select privacy policy page') }}</option>
                                        @foreach ($pages as $page)
                                        <option value="{{ $page->slug }}">{{ $page->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button class="cmn_btn btn_bg_profile">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<x-media.markup />
@endcan
@endsection
@section('script')
@can('manage-page-settings')
<x-media.js />
<x-iconpicker.js />
<script>
    (function($) {
                'use script'
                $(document).ready(function() {
                    $("#toc_page_link").val("{{ get_static_option('toc_page_link') }}");
                    $("#privacy_policy_link").val("{{ get_static_option('privacy_policy_link') }}");
                });
            })(jQuery)
</script>
@endcan
@endsection