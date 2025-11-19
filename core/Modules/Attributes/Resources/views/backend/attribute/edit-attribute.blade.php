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
                            <form action="{{ route('admin.products.attributes.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $attribute->id }}">
                                <div class="row">
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label>{{ __('Title (English)') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ $attribute->title }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label>{{ __('ចំណងជើង (ខ្មែរ)') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title_km"
                                                value="{{ $attribute->title_km }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <div class="form-group attributes-field product-variants">
                                            <label>{{ __('Terms') }} <span class="text-danger">*</span></label>
                                            <div class="row attribute-term-wrapper">
                                                @php
                                                    $terms_en = json_decode($attribute->terms) ?? [];
                                                    $terms_km = json_decode($attribute->terms_km) ?? [];
                                                @endphp

                                                @foreach ($terms_en as $key => $term)
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <input type="text" class="form-control" name="terms[]"
                                                                    value="{{ $term }}"
                                                                    placeholder="Enter terms (English)" required>
                                                            </div>

                                                            <div class="col-md-5 mb-2">
                                                                <input type="text" class="form-control" name="terms_km[]"
                                                                    value="{{ $terms_km[$key] ?? '' }}"
                                                                    placeholder="បញ្ចូលលក្ខខណ្ឌ (ខ្មែរ)" required>
                                                            </div>

                                                            <div class="col-md-1 mb-2">
                                                                <div class="icon-wrapper">
                                                                    @if ($loop->index == 0)
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-success mt-2 addAttributeTerms">
                                                                            <i class="las la-plus"></i>
                                                                        </button>
                                                                    @endif
                                                                    @if ($loop->index > 0)
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger mt-2 removeAttributeTerms">
                                                                            <i class="las la-minus"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Update') }}</button>
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

                // Add new Term
                $(document).on('click', '.addAttributeTerms', function(e) {
                    e.preventDefault();

                    var termField = `
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <input type="text" class="form-control" name="terms[]"
                                        placeholder="Enter terms (English)" required>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <input type="text" class="form-control" name="terms_km[]"
                                        placeholder="បញ្ចូលលក្ខខណ្ឌ (ខ្មែរ)" required>
                                </div>
                                <div class="col-md-1 mb-2">
                                    <div class="icon-wrapper">
                                        <button type="button" class="btn btn-sm btn-danger mt-2 removeAttributeTerms">
                                            <i class="las la-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    $('.attribute-term-wrapper').append(termField);
                });

                // Remove Term
                $(document).on('click', '.removeAttributeTerms', function(e) {
                    e.preventDefault();
                    $(this).closest('.col-md-12').remove();
                });
            });
        })(jQuery)
    </script>
@endsection
