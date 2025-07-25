@extends('backend.admin-master')
@section('site-title')
    {{ __('Edit Admin') }}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        @include('backend/partials/message')
        @include('backend/partials/error')
        <div class="row">
            <div class="col-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Edit Admin') }}</h4>
                        <div class="btn-wrapper">
                            <a class="cmn_btn btn_bg_profile" href="{{ route('admin.all.user') }}">{{ __('Admin Accounts') }}</a>
                        </div>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('admin.user.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $admin->id }}">
                            <div class="form-group">
                                <label for="email">
                                    {{ __('Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" value="{{ $admin->name }}" name="name"
                                    placeholder="{{ __('Enter email') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Email') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control" value="{{ $admin->email }}" name="email"
                                    placeholder="{{ __('Enter name') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="role">
                                    {{ 'Role' }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="role" class="form-select" required="">
                                    <option value="">{{ __('Select role') }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"
                                            @if (in_array($role, $adminRole)) selected @endif>{{ $role }}</option>
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
                                            $image = get_attachment_image_by_id($admin->image, null, true);
                                            $image_btn_label = __('Upload Image');
                                        @endphp
                                        @if (!empty($image))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{ $image['img_url'] }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            @php  $image_btn_label = __('Change Image'); @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" id="image" name="image" value="{{ $admin->image }}">
                                    <button type="button" class="btn btn-secondary media_upload_form_btn"
                                        data-btntitle="{{ __('Select Image') }}"
                                        data-modaltitle="{{ __('Upload Image') }}" data-bs-toggle="modal"
                                        data-bs-target="#media_upload_modal">
                                        {{ __($image_btn_label) }}
                                    </button>
                                </div>
                                <small class="form-text text-danger">{{ __('Allowed image formats: jpg,jpeg,png') }}</small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="cmn_btn btn_bg_profile">
                                    {{ __('Update') }}
                                </button>
                                <a href="{{ route('admin.all.user') }}" class="cmn_btn default-theme-btn"
                                    style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                    Back
                                </a>
                            </div>
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
