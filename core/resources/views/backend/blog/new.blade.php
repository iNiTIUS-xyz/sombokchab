@extends('backend.admin-master')

@section('style')
    <x-summernote.css />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap-tagsinput.css') }}">
    <x-media.css />
@endsection

@section('site-title')
    {{ __('Add New Blog') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Add New Blog') }} </h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.blog.new') }}" method="post" enctype="multipart/form-data">@csrf
                            <div class="row g-4">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="title">
                                            {{ __('Title') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="title"
                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                            placeholder="{{ __('Enter title') }}" required="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Content') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="blog_content" class="summernote"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="author">
                                            {{ __('Author') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="author"
                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                            placeholder="{{ __('Enter author') }}" required="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="title">
                                            {{ __('Blog Tags') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="tags" data-role="tagsinput"
                                            placeholder="{{ __('Enter blog tags') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_tags">{{ __('Meta Tags') }}</label>
                                        <input type="text" class="form-control" name="meta_tags" data-role="tagsinput"
                                            placeholder="{{ __('Enter meta tags') }}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="title">
                                            {{ __('Excerpt') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="excerpt" id="excerpt" class="form-control max-height-150" cols="30" rows="10"
                                            placeholder="{{ __('Enter excerpt') }}" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_title">{{ __('Meta Title') }}</label>
                                        <input type="text" class="form-control" name="meta_title"
                                            placeholder="{{ __('Enter meta title') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="og_meta_title">{{ __('Og Meta Title') }}</label>
                                        <input type="text" class="form-control" name="og_meta_title"
                                            placeholder="{{ __('Enter ot meta title') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_description">{{ __('Meta Description') }}</label>
                                        <textarea type="text" class="form-control" name="meta_description" rows="5" cols="10"
                                            placeholder="{{ __('Enter meta description') }}"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="og_meta_description">{{ __('Og Meta Description') }}</label>
                                        <textarea type="text" class="form-control" name="og_meta_description" rows="5" cols="10"
                                            placeholder="{{ __('Enter og meta description') }}"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-media-upload :title="__('Blog Image')" name="image" id="image" />
                                        <small
                                            class="form-text text-danger">{{ __('Allowed image formats: jpg,jpeg,png') }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-media-upload :title="__('Og Meta Image')" name="og_meta_image" id="og_meta_image" />
                                        <small
                                            class="form-text text-danger">{{ __('Allowed image formats: jpg,jpeg,png') }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="category_list" class="form-group">
                                        <label for="category">
                                            {{ __('Category') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="category" class="form-control" required="">
                                            <option value="">{{ __('Select Category') }}</option>
                                            @foreach ($all_category as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ purify_html($category->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="status">
                                            {{ __('Publish Status') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="status" class="form-control" id="status" required="">
                                            <option value="draft">{{ __('Unpublish') }}</option>
                                            <option value="publish">{{ __('Publish') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" id="submit" class="cmn_btn btn_bg_profile">
                                        {{ __('Add') }}
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
    <script src="{{ asset('assets/backend/js/bootstrap-tagsinput.js') }}"></script>
    <x-summernote.js />
    <x-media.js />
    <script>
        $(document).on('summernote.change', "textarea[name='blog_content']", function() {
            var data = $("textarea[name='blog_content']").summernote('code');
            $("textarea[name='blog_content']").val(data)
        })
    </script>
@endsection
