@php
    if (!isset($product)) {
        $product = null;
    }
@endphp

<div class="general-info-wrapper dashboard__card">
    <div class="dashboard__card__header">
        <h4 class="dashboard__card__title"> {{ __('General Information') }} </h4>
    </div>
    <div class="dashboard__card__body custom__form general-info-form">
        <form action="#">
            <div class="row g-3 mt-2">
                <div class="col-sm-6">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2">
                            {{ __('Name (English)') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form--control radius-10 form-control" id="product-name"
                            value="{{ $product?->name ?? '' }}" name="name" aria-describedby="product-name-error"
                            required placeholder="{{ __('Enter product name in English') }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2">
                            {{ __('ឈ្មោះ (ខ្មែរ)') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form--control radius-10 form-control"
                            value="{{ $product?->name_km ?? '' }}" name="name_km" required
                            placeholder="{{ __('បញ្ចូលឈ្មោះផលិតផលជាភាសាខ្មែរ') }}">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2">
                            {{ __('Slug') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form--control radius-10" id="product-slug"
                            value="{{ $product?->slug ?? '' }}" name="slug" required
                            placeholder="{{ __('Enter product slug') }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2">
                            {{ __('Short Description (English)') }}
                            <span class="text-danger">*</span>
                        </label>
                        <textarea style="height: 120px" class="form--control form--message  radius-10 form-control" name="summery" required
                            placeholder="{{ __('Enter short description in English') }}">{{ $product?->summary ?? '' }}</textarea>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2">
                            {{ __('ការពិពណ៌នាសង្ខេប (ភាសាខ្មែរ)') }}
                            <span class="text-danger">*</span>
                        </label>
                        <textarea style="height: 120px" class="form--control form--message  radius-10 form-control" name="summery_km" required
                            placeholder="{{ __('បញ្ចូលការពិពណ៌នាខ្លីជាភាសាខ្មែរ') }}">{{ $product?->summary_km ?? '' }}</textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2">
                            {{ __('Description (English)') }}
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form--control summernote radius-10 form-control" name="description"
                            placeholder="{{ __('Type description in English') }}" required>{!! $product?->description !!}</textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2">
                            {{ __('ការពិពណ៌នា (ខ្មែរ)') }}
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form--control summernote radius-10 form-control" name="description_km"
                            placeholder="{{ __('វាយពណ៌នាជាភាសាខ្មែរ') }}" required>{!! $product?->description_km !!}</textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2">
                            {{ __('Brand') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="nice-select-two">
                            <select name="brand" class="form-control" id="brand_id" required>
                                <option value="">
                                    {{ __('Select brand') }}
                                </option>
                                @foreach ($brands as $item)
                                    <option {{ $item->id == $product?->brand_id ? 'selected' : '' }}
                                        value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
