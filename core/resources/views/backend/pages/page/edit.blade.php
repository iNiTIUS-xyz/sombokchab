@extends('backend.admin-master')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap-tagsinput.css') }}">
    <x-summernote.css />
    <x-media.css />
@endsection

@section('site-title')
    {{ __('Edit Page') }}
@endsection

@section('content')
    @php
        use App\CategoryMenu;
        $mega_menu_categories = CategoryMenu::get()->pluck('title', 'id');
        $selected_megamenu = get_static_option('megamenu');
    @endphp

    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Edit Page') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('admin.page.update', $page_post->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="title">
                                            {{ __('Title (English)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="{{ __('Enter title (English)') }}" value="{{ $page_post->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="title_km">
                                            {{ __('ចំណងជើង (ខ្មែរ)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="title_km" name="title_km"
                                            placeholder="{{ __('បញ្ចូលចំណងជើង (ខ្មែរ)') }}"
                                            value="{{ $page_post->title_km }}">
                                    </div>
                                    <div class="form-group mt-5">
                                        <label for="page_builder_status">
                                            <strong>
                                                {{ __('Page Builder Enable/Disable') }}
                                            </strong>
                                        </label>
                                        <label class="switch">
                                            <input type="checkbox" name="page_builder_status"
                                                @if (!empty($page_post->page_builder_status)) checked @endif>
                                            <span class="slider onff"></span>
                                        </label>
                                    </div>
                                    <div
                                        class="form-group classic-editor-wrapper @if (!empty($page_post->page_builder_status)) d-none @endif ">
                                        <label>
                                            {{ __('Content') }}
                                        </label>
                                        <textarea class="summernote" type="hidden" name="page_content">{!! $page_post->content !!}</textarea>
                                    </div>
                                    <div
                                        class="form-group classic-editor-wrapper @if (!empty($page_post->page_builder_status)) d-none @endif ">
                                        <label>
                                            {{ __('ខ្លឹមសារ (ខ្មែរ)') }}
                                        </label>
                                        <textarea class="summernote" type="hidden" name="page_content_km">{!! $page_post->content_km !!}</textarea>
                                    </div>
                                    <div
                                        class="btn-wrapper page-builder-btn-wrapper @if (empty($page_post->page_builder_status)) d-none @endif ">
                                        <a href="{{ route('admin.dynamic.page.builder', ['type' => 'dynamic-page', 'id' => $page_post->id]) }}"
                                            class="cmn_btn btn_bg_profile"> <i class="fas fa-external-link-alt "></i>
                                            {{ __('Open Page Builder') }}
                                        </a>
                                    </div>
                                    <div class="navbar_variants mt-5" style="display: none">
                                        <p class="mb-3 lead">
                                            {{ __('Navbar Variant') }}
                                        </p>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="navbar_variant"
                                                value="{{ $page_post->navbar_variant }}" name="navbar_variant">
                                        </div>
                                        @for ($i = 1; $i <= 3; $i++)
                                            <div class="img-select img-select-nav @if ($page_post->navbar_variant == $i) selected @endif"
                                                data-navbar_id="{{ $i }}">
                                                <div class="img-wrap">
                                                    <img src="{{ asset('assets/frontend/navbar-variant/0' . $i . '.jpg') }}"
                                                        data-nav_id="{{ $i }}" alt="">
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>
                                            <strong>
                                                {{ __('Breadcrumb Show/Hide') }}
                                            </strong>
                                        </label>
                                        <label class="switch role">
                                            <input type="checkbox" name="breadcrumb_status"
                                                @if (!empty($page_post->breadcrumb_status)) checked @endif>
                                            <span class="slider-yes-no"></span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            {{ __('Publish Status') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="publish" @if ($page_post->status == 'publish') selected @endif>
                                                {{ __('Publish') }}
                                            </option>
                                            <option value="draft" @if ($page_post->status == 'draft') selected @endif>
                                                {{ __('Unpublish') }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            {{ __('Visibility') }}
                                        </label>
                                        <select name="visibility" class="form-control">
                                            <option @if ($page_post->visibility === 'all') selected @endif value="all">
                                                {{ __('All') }}
                                            </option>
                                            <option @if ($page_post->visibility === 'user') selected @endif value="user">
                                                {{ __('Only Logged In User') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags">
                                            {{ __('Page Meta Tags (English)') }}
                                        </label>
                                        <input type="text" name="meta_tags" class="form-control"
                                            placeholder="{{ __('Enter page meta tags') }}"
                                            value="{{ $page_post->meta_tags }}" data-role="tagsinput" id="meta_tags">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags_km">
                                            {{ __('ស្លាកមេតាទំព័រ (ខ្មែរ)') }}
                                        </label>
                                        <input type="text" name="meta_tags_km" class="form-control"
                                            placeholder="{{ __('បញ្ចូលស្លាកមេតាទំព័រ (ខ្មែរ)') }}"
                                            value="{{ $page_post->meta_tags_km }}" data-role="tagsinput"
                                            id="meta_tags_km">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">
                                            {{ __('Page Meta Description') }}
                                        </label>
                                        <textarea name="meta_description" class="form-control" id="meta_description"
                                            placeholder="{{ __('Enter page meta description') }}">{{ $page_post->meta_description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description_km">
                                            {{ __('ការពិពណ៌នាមេតាទំព័រ (ខ្មែរ)') }}
                                        </label>
                                        <textarea name="meta_description_km" class="form-control" id="meta_description_km"
                                            placeholder="{{ __('បញ្ចូលការពិពណ៌នាមេតាទំព័រ (ខ្មែរ)') }}">{{ $page_post->meta_description_km }}</textarea>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="cmn_btn btn_bg_profile">
                                            {{ __('Update') }}
                                        </button>
                                        <a href="{{ route('admin.page') }}" class="cmn_btn default-theme-btn"
                                            style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                            {{ __('Back') }}
                                        </a>
                                    </div>
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
    <script src="{{ asset('assets/backend/js/bootstrap-tagsinput.js') }}"></script>
    <x-summernote.js />
    <script>
        $(document).ready(function() {
            $(document).on('change', 'input[name="page_builder_status"]', function() {
                if ($(this).is(':checked')) {
                    $('.classic-editor-wrapper').addClass('d-none');
                    $('.page-builder-btn-wrapper').removeClass('d-none');
                } else {
                    $('.classic-editor-wrapper').removeClass('d-none');
                    $('.page-builder-btn-wrapper').addClass('d-none');
                }
            });

            //For Navbar
            var imgSelect1 = $('.img-select-nav');
            var id = $('#navbar_variant').val();
            imgSelect1.removeClass('selected');
            $('img[data-nav_id="' + id + '"]').parent().parent().addClass('selected');
            $(document).on('click', '.img-select-nav img', function(e) {
                e.preventDefault();
                imgSelect1.removeClass('selected');
                $(this).parent().parent().addClass('selected').siblings();
                $('#navbar_variant').val($(this).data('nav_id'));
            });

            //For Footer
            var imgSelect2 = $('.img-select-footer');
            var id = $('#footer_variant').val();
            imgSelect2.removeClass('selected');
            $('img[data-foot_id="' + id + '"]').parent().parent().addClass('selected');
            $(document).on('click', '.img-select-footer img', function(e) {
                e.preventDefault();
                imgSelect2.removeClass('selected');
                $(this).parent().parent().addClass('selected').siblings();
                $('#footer_variant').val($(this).data('foot_id'));
            });
        });
    </script>
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
