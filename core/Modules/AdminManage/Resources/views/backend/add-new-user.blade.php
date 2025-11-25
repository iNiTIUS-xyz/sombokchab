@extends('backend.admin-master')
@section('site-title')
{{ __('Add New Admin') }}
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
@endsection
@section('content')
<div class="col-lg-12 col-ml-12">
    <div class="row">
        {{-- @include('backend/partials/message')
        @include('backend/partials/error') --}}
        <div class="col-12">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title">{{ __('Add New Admin') }}</h4>
                </div>
                <div class="dashboard__card__body custom__form mt-4">
                    <form action="{{ route('admin.new.user') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">
                                {{ __('Name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="{{ __('Enter full name') }}" required="">
                        </div>
                        <div class="form-group">
                            <label for="username">
                                {{ __('Username') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="{{ __('Enter username') }}" required="">
                            <small class="text text-danger">
                                {{ __('Remember this username, user will login using this username') }}
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="email">
                                {{ __('Email') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="{{ __('Enter email') }}" required="">
                        </div>
                        <div class="form-group">
                            <label for="password">
                                {{ __('Password') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="{{ __('Enter password') }}" required="">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">
                                {{ __('Confirm Password') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="{{ __('Enter password confirmation') }}"
                                required="">
                        </div>
                        <div class="form-group">
                            <label for="role">
                                {{ 'Role' }}
                                <span class="text-danger">*</span>
                            </label>
                            <select name="role" class="form-select" required="">
                                <option value="">{{ __('Select role') }}</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="site_favicon">
                                {{ __('Profile Image') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap">
                                    @php
                                    $image = get_attachment_image_by_id(get_static_option('image'), null, true);
                                    $image_btn_label = __('Upload image');
                                    @endphp
                                    @if (!empty($image))
                                    <div class="attachment-preview">
                                        <div class="thumbnail">
                                            <div class="centered">
                                                <img class="avatar user-thumb" src="{{ $image['img_url'] }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @php $image_btn_label = __('Change image'); @endphp
                                    @endif
                                </div>
                                <input type="hidden" id="image" name="image" value="{{ get_static_option('image') }}">
                                <button type="button" class="btn btn-secondary media_upload_form_btn"
                                    data-btntitle="{{ __('Select Image') }}" data-modaltitle="{{ __('Upload Image') }}"
                                    data-bs-toggle="modal" data-bs-target="#media_upload_modal">
                                    {{ __($image_btn_label) }}
                                </button>
                            </div>
                            <small class="form-text text-danger">
                                {{ __('Allowed image formats: jpg,jpeg,png') }}
                            </small>
                        </div>
                        <button type="submit" class="cmn_btn btn_bg_profile mt-4">
                            {{ __('Add') }}
                        </button>
                        <a href="{{ route('admin.all.user') }}" class="cmn_btn default-theme-btn"
                            style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                            Back
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
<script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
@include('backend.partials.media-upload.media-js')
@endsection