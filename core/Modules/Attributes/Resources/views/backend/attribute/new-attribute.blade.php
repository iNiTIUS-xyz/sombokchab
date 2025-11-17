@extends('backend.admin-master')

@section('site-title')
    {{ __('New Variant') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Add New Variant') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        @can('product-attribute-create')
                            <form action="{{ route('admin.products.attributes.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="title">
                                                {{ __('Title (English)') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ old('title') }}" placeholder="{{ __('Enter title') }}"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label>
                                                {{ __('ចំណងជើង (ខ្មែរ)') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="title_km"
                                                value="{{ old('title_km') }}" placeholder="{{ __('បញ្ចូលចំណងជើង (ខ្មែរ)') }}"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <div class="form-group">
                                            <label for="attributes">
                                                {{ __('Terms') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="terms[]"
                                                        placeholder="{{ __('Enter terms (English)') }}" required="">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" name="terms_km[]"
                                                        placeholder="{{ __('Enter terms (ខ្មែរ)') }}" required="">
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="mt-2 add_attributes btn btn-sm btn-success">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="attributes-field"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="cmn_btn btn_bg_profile">
                                            {{ __('Add') }}
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
        (function($) {
            $(document).ready(function() {
                $(document).on('click', '.add_attributes', function(e) {
                    e.preventDefault();
                    var el = `<div class="col-md-6 mb-2">
                                <input type="text" class="form-control" name="terms[]" placeholder="{{ __('Enter terms (English)') }}" required="">
                            </div>
                            <div class="col-md-5 mb-2">
                                <input type="text" class="form-control" name="terms_km[]" placeholder="{{ __('Enter terms (ខ្មែរ)') }}" required="">
                            </div>
                            <div class="col-md-1 mb-2">
                                <span class="mt-2 remove_attributes btn btn-sm btn-danger">
                                    <i class="ti-minus"></i>
                                </span>
                            </div>`;
                    $('.attributes-field').append(el);
                });

                $(document).on('click', '.remove_attributes', function(e) {
                    e.preventDefault();
                });
            });
        })(jQuery)
    </script>
@endsection
