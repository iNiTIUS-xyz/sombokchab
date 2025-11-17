@extends('backend.admin-master')
@section('site-title')
    {{ __('Edit Attribute') }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Edit Attribute') }}</h4>
                        @can('view-attribute')
                            <a href="{{ route('admin.products.attributes.all') }}"
                                class="cmn_btn btn_bg_profile">{{ __('All Attributes') }}</a>
                        @endcan
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        @can('edit-attribute')
                            <form action="{{ route('admin.products.attributes.update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $attribute->id }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="title">
                                                {{ __('Title') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ $attribute->title }}" placeholder="{{ __('Enter title') }}">
                                        </div>
                                        <div class="form-group attributes-field attributess">
                                            <label for="attributes">
                                                {{ __('Terms') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            @forelse(json_decode($attribute->terms) as $terms)
                                                <div class="attribute-field-wrapper">
                                                    <input type="text" class="form-control" name="terms[]"
                                                        value="{{ $terms }}" required="">
                                                    <div class="icon-wrapper">
                                                        <span class="btn btn-sm btn-info add_attributes"><i
                                                                class="las la-plus"></i></span>
                                                        <span class="btn btn-sm btn-danger remove_attributes"><i
                                                                class="las la-minus"></i></span>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="attribute-field-wrapper">
                                                    <input type="text" class="form-control" name="terms[]"
                                                        placeholder="{{ __('terms') }}" required="">
                                                    <div class="icon-wrapper">
                                                        <span class="btn btn-sm btn-info add_attributes"><i
                                                                class="las la-plus"></i></span>
                                                        <span class="btn btn-sm btn-danger remove_attributes"><i
                                                                class="las la-minus"></i></span>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                        <button type="submit" class="cmn_btn btn_bg_profile">
                                            {{ __('Update') }}
                                        </button>
                                        <a href="{{ route('admin.products.attributes.all') }}"
                                            class="cmn_btn default-theme-btn"
                                            style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                            {{ __('Back') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.attribute-field-wrapper .add_attributes', function(e) {
                e.preventDefault();
                $(this).parent().parent().parent().append(' <div class="attribute-field-wrapper">\n' +
                    '<input type="text" class="form-control" name="terms[]" placeholder="{{ __('terms') }}" required="">\n' +
                    '<div class="icon-wrapper">\n' +
                    '<span class="btn btn-sm btn-info add_attributes"><i class="las la-plus"></i></span>\n' +
                    '<span class="btn btn-sm btn-danger remove_attributes"><i class="las la-minus"></i></span>\n' +
                    '</div>\n' +
                    '</div>');
            });

            $(document).on('click', '.attribute-field-wrapper .remove_attributes', function(e) {
                e.preventDefault();

                if ($(".attribute-field-wrapper").length > 1) {
                    $(this).parent().parent().remove();
                }
            });
        });
    </script>
@endsection
