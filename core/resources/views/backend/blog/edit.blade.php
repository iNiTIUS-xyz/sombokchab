@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap-tagsinput.css') }}">
    <x-summernote.css />
    <x-media.css />
@endsection
@section('site-title')
    {{ __('Edit Blog') }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">

                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Edit Blog') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('admin.blog.update', $blog_post->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">
                                            {{ __('Title') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="title"
                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                            placeholder="{{ __('Enter title') }}" value="{{ $blog_post->title }}"
                                            required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Blog Content') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="summernote" name="blog_content">{!! $blog_post->blog_content !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="author">
                                            {{ __('Author') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="author"
                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                            placeholder="{{ __('Enter author') }}" value="{{ $blog_post->author }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">
                                            {{ __('Blog Tags') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="tags" data-role="tagsinput"
                                            placeholder="{{ __('Enter blog tags') }}" value="{{ $blog_post->tags }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_tags">{{ __('Meta Tags') }}</label>
                                        <input type="text" class="form-control" name="meta_tags" data-role="tagsinput"
                                            placeholder="{{ __('Enter meta tags') }}" value="{{ $blog_post->meta_tags }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">
                                            {{ __('Excerpt') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="excerpt" id="excerpt" class="form-control max-height-150" cols="30" rows="10"
                                            placeholder="{{ __('Enter excerpt') }}" required="">{{ $blog_post->excerpt }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_title">{{ __('Meta Title') }}</label>
                                        <input type="text" class="form-control" name="meta_title"
                                            placeholder="{{ __('Enter meta title') }}"
                                            value="{{ $blog_post->meta_title }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="og_meta_title">{{ __('Og Meta Title') }}</label>
                                        <input type="text" class="form-control" name="og_meta_title"
                                            placeholder="{{ __('Enter og meta title') }}"
                                            value="{{ $blog_post->og_meta_title }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_description">{{ __('Meta Description') }}</label>
                                        <textarea type="text" class="form-control" name="meta_description" rows="5" cols="10"
                                            placeholder="{{ __('Enter meta description') }}">{{ $blog_post->meta_description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="og_meta_description">{{ __('Og Meta Description') }}</label>
                                        <textarea type="text" class="form-control" name="og_meta_description" rows="5" cols="10"
                                            placeholder="{{ __('Enter og meta description') }}">{{ $blog_post->og_meta_description }} </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-media-upload :title="__('Blog Image')" name="image" id="image"
                                            :oldimage="$blog_post->image" />
                                        <small
                                            class="form-text text-danger">{{ __('Allowed image formats: jpg,jpeg,png') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-media-upload :title="__('Og Meta Image')" :oldimage="$blog_post->og_meta_image" name="og_meta_image"
                                            id="og_meta_image" />

                                        <small
                                            class="form-text text-danger">{{ __('Allowed image formats: jpg,jpeg,png') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">
                                            {{ __('Category') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="category" class="form-control" id="category" required="">
                                            <option value="">{{ __('Select Category') }}</option>
                                            @foreach ($all_category as $category)
                                                <option @if ($category->id == $blog_post->blog_categories_id) selected @endif
                                                    value="{{ $category->id }}">{{ purify_html($category->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">
                                            {{ __('Publish Status') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="status" class="form-control" id="status" required="">
                                            <option value="draft" {{ $blog_post->status == 'draft' ? 'selected' : '' }}>
                                                {{ __('Unpublish') }}
                                            </option>
                                            <option value="publish"
                                                {{ $blog_post->status == 'publish' ? 'selected' : '' }}>
                                                {{ __('Publish') }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" id="update" class="cmn_btn btn_bg_profile">
                                        {{ __('Update') }}
                                    </button>
                                    <a href="{{ route('admin.blog') }}" class="cmn_btn default-theme-btn"
                                        style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                        {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup />
@endsection
@section('script')
    <x-summernote.js />
    <x-media.js />
    <script src="{{ asset('assets/backend/js/bootstrap-tagsinput.js') }}"></script>

    <script>
        (function($) {
            <
            x - btn.update / >
                "use strict";
            $(document).ready(function() {
                $('.summernote').summernote({
                    height: 400, //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            $(this).prev('input').val(contents);
                        },
                        onPaste: function(e) {
                            let bufferText = ((e.originalEvent || e).clipboardData || window
                                .clipboardData).getData('text/plain');
                            e.preventDefault();
                            document.execCommand('insertText', false, bufferText);
                        }
                    }
                });

                if ($('.summernote').length > 0) {
                    $('.summernote').each(function(index, value) {
                        $(this).summernote('code', $(this).data('content'));
                    });
                }
            });
        })(jQuery)
    </script>
@endsection
