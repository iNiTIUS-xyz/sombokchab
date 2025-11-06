@extends('backend.admin-master')

@section('style')
    <x-summernote.css />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
@endsection

@section('site-title')
    {{ __('Send Mail to All Subscribers') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-0">
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
            </div>
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Send Mail to All Subscribers') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('admin.newsletter.mail') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="subject">
                                    {{ __('Subject') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="subject" name="subject"
                                    placeholder="{{ __('Enter subject') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="message">{{ __('Message') }}</label>
                                <textarea name="message" id="message" class="summernote" placeholder="{{ __('Write your message...') }}"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Send Mail') }}</button>
                                <a href="{{ route('admin.newsletter') }}" class="cmn_btn default-theme-btn"
                                    style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                    {{ __('Back') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/js/summernote-bs4.js') }}"></script>
    <x-summernote.js />
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize Summernote
            $('.summernote').summernote({
                height: 250,
                placeholder: '{{ __('Write your email message here...') }}'
            });
            $('form').on('submit', function() {
                var content = $('.summernote').summernote('code');
                $('textarea[name="message"]').val(content);
            });
        });
    </script>
@endsection
