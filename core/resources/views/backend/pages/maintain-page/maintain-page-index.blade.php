@extends('backend.admin-master')
@section('site-title')
    {{ __('Maintenance Page Settings') }}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/flatpickr.min.css') }}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Maintenance Page Settings') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('admin.maintains.page.settings') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="maintain_page_title">{{ __('Title') }}</label>
                                        <input type="text" class="form-control" id="maintain_page_title"
                                            value="{{ get_static_option('maintain_page_title') }}"
                                            name="maintain_page_title" placeholder="{{ __('Title') }}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="maintain_page_description">{{ __('Description') }}</label>
                                        <textarea name="maintain_page_description" id="maintain_page_description" class="form-control max-height-150"
                                            cols="30" rows="10">{{ get_static_option('maintain_page_description') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="maintain_page_logo"><strong>{{ __('Logo') }}</strong></label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                @php
                                                    $blog_img = get_attachment_image_by_id(get_static_option('maintain_page_logo'), null, true);
                                                    $blog_image_btn_label = __('Upload Image');
                                                @endphp
                                                @if (!empty($blog_img))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb"
                                                                    src="{{ $blog_img['img_url'] }}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php  $blog_image_btn_label = __('Change Image'); @endphp
                                                @endif
                                            </div>
                                            <input type="hidden" id="maintain_page_logo" name="maintain_page_logo"
                                                value="">
                                            <button type="button" class="btn btn-secondary media_upload_form_btn"
                                                data-btntitle="Select Maintains Logo Image"
                                                data-modaltitle="Upload Maintains Logo Image" data-bs-toggle="modal"
                                                data-bs-target="#media_upload_modal">
                                                {{ __($blog_image_btn_label) }}
                                            </button>
                                        </div>
                                        <small class="form-text text-danger">{{ __('Allowed image format: jpg,jpeg,png. Recommended image size 300x100') }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label
                                            for="maintain_page_background_image"><strong>{{ __('Background Image') }}</strong></label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                @php
                                                    $maintain_page_background_image = get_attachment_image_by_id(get_static_option('maintain_page_background_image'), null, true);
                                                    $maintain_page_background_image_btn_label = __('Upload Image');
                                                @endphp
                                                @if (!empty($maintain_page_background_image))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb"
                                                                    src="{{ $maintain_page_background_image['img_url'] }}"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php  $maintain_page_background_image_btn_label = __('Change Image'); @endphp
                                                @endif
                                            </div>
                                            <input type="hidden" id="maintain_page_background_image"
                                                name="maintain_page_background_image" value="">
                                            <button type="button" class="btn btn-secondary media_upload_form_btn"
                                                data-btntitle="{{ __('Select Background Image') }}"
                                                data-modaltitle="{{ __('Upload Background Image') }}" data-bs-toggle="modal"
                                                data-bs-target="#media_upload_modal">
                                                {{ __($maintain_page_background_image_btn_label) }}
                                            </button>
                                        </div>
                                        <small class="form-text text-danger">{{ __('Allowed image format: jpg,jpeg,png. Recommended image size 1920x1000') }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('Countdown') }}</label>
                                        <input type="date" name="maintain_page_countdown" class="form-control flatpickr"
                                            value="{{ get_static_option('maintain_page_countdown') }}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit"
                                        class="cmn_btn btn_bg_profile">{{ __('Update Settings') }}</button>
                                </div>
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
    <script src="{{ asset('assets/backend/js/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
        flatpickr(".flatpickr", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
    </script>
@endsection
