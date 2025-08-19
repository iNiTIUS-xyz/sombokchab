@extends('backend.admin-master')

@section('site-title')
    {{ __('Create Campaign') }}
@endsection

@section('style')
    {{--  --}}
    <style>
        .form-section {
            background: transparent;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
        }

        .accordion-button::after {
            margin-left: auto;
        }

        .delete-btn {
            background: none;
            border: none;
            color: red;
            font-size: 18px;
        }

        .accordion-item {
            background: var(--gray-two) !important;
        }

        .dashboard__card {
            height: auto !important;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Create Campaign') }}
                        </h4>
                        @can('campaigns')
                            <div class="btn-wrapper">
                                <a href="{{ route('admin.campaigns.all') }}" class="cmn_btn btn_bg_profile">
                                    {{ __('All Campaigns') }}
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="dashboard__card">
                            <div class="mb-3">
                                <label class="form-label">Campaign Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter campaign name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Campaign Subtitle <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter campaign subtitle">
                            </div>
                            <div class="mb-3">
                                <x-media-upload :title="__('Campaign Image')" name="image" :dimentions="'1920x1080'" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    Campaign Status
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select">
                                    <option>Published</option>
                                    <option>Draft</option>
                                    <option>Archived</option>
                                </select>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="discountCheck" checked>
                                <label class="form-check-label" for="discountCheck">Set Discount
                                    Percentage</label>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="15%">
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="dateCheck" checked>
                                <label class="form-check-label" for="dateCheck">Set Fixed Date Range</label>
                            </div>
                            <div class="mb-3 d-flex gap-2">
                                <input type="text" class="form-control">
                                <input type="text" class="form-control">
                            </div>
                            <button class="btn btn-success w-100">
                                Create Campaign
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="dashboard__card campain_product_section">
                            <label class="form-label">
                                Campaign Products
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control selec2">
                                @foreach ($all_products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}"
                                        data-sale_price="{{ $product->sale_price }}"
                                        data-stock="{{ optional($product->inventory)->stock_count ?? 0 }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="accordion" id="campaignProducts">
                            <div class="accordion-item mb-2">
                                <h2 class="accordion-header d-flex align-items-center">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#product1">
                                        Infant Baby Girl Outfits Long Sleeve Ruffle Romper + Floral Pants + Headband Set
                                    </button>
                                    <button type="button" class="btn btn-danger">
                                        <i class="ti-trash"></i>
                                    </button>
                                </h2>
                                <div id="product1" class="accordion-collapse collapse" data-bs-parent="#campaignProducts">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label class="form-label">Original Price</label>
                                                <input type="text" class="form-control" value="$40.00">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Price for Campaign</label>
                                                <input type="text" class="form-control" value="$34.00">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">No. of Units Available</label>
                                                <input type="text" class="form-control" value="40">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">No. of Units for Sale</label>
                                                <input type="text" class="form-control" value="15">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="date" class="form-control" value="2025-07-25">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="date" class="form-control" value="2025-07-30">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Repeat Product Items -->
                            <div class="accordion-item mb-2">
                                <h2 class="accordion-header d-flex align-items-center">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#product2">
                                        Long Sleeve Ruffle Romper + Floral Pants + Headband Set
                                    </button>
                                    <button type="button" class="btn btn-danger">
                                        <i class="ti-trash"></i>
                                    </button>
                                </h2>
                                <div id="product2" class="accordion-collapse collapse"
                                    data-bs-parent="#campaignProducts">
                                    <div class="accordion-body">
                                        <p>Product details form here...</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-2">
                                <h2 class="accordion-header d-flex align-items-center">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#product3">
                                        Floral Pants + Headband Set
                                    </button>
                                    <button type="button" class="btn btn-danger">
                                        <i class="ti-trash"></i>
                                    </button>
                                </h2>
                                <div id="product3" class="accordion-collapse collapse"
                                    data-bs-parent="#campaignProducts">
                                    <div class="accordion-body">
                                        <p>Product details form here...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{--  --}}
@endsection
