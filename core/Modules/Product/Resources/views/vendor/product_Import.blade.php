@extends('vendor.vendor-master')

@section('site-title')
    {{ __('Import Products') }}
@endsection

@section('style')
@endsection

@section('content')
    <div class="dashboard-top-contents">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-inner-contents search-area top-searchbar-wrapper">
                    <div class="dashboard-flex-contetns">
                        <div class="dashboard-left-flex">
                            <h3 class="dashboard__card__title">
                                {{ __('Import Product') }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-products-add bg-white radius-20 mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form id="productFrom" action="{{ route('vendor.products.import.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="search_product">
                                    Product File
                                    <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" name="file" type="file" required="">
                                <small class="small">Mimes:xlsx</small>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Upload
                            </button>
                            <a href="{{ route('vendor.products.all') }}" class="btn default-theme-btn"
                                style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                Back
                            </a>
                        </form>
                        <div class="mt-3">
                            <span class="text-bark">
                                (1)
                                <b>
                                    name:
                                    required, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (1)
                                <b>
                                    category:
                                    required, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (1)
                                <b>
                                    sub_category_name:
                                    required, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (1)
                                <b>
                                    brand name:
                                    required, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (1)
                                <b>
                                    summary:
                                    required, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (2)
                                <b>
                                    description:
                                    required, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (3)
                                <b>
                                    price:
                                    required, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (4)
                                <b>
                                    sale_price:
                                    required, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (5)
                                <b>
                                    cost:
                                    required, numbar
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (6)
                                <b>
                                    status_id:
                                    required, numbar
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (7)
                                <b>
                                    product_type:
                                    required, numbar
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (8)
                                <b>
                                    min_purchase:
                                    required, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (9)
                                <b>
                                    max_purchase:
                                    required, number, 1/2
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (10)
                                <b>
                                    is_inventory_warn_able:
                                    required, number, 1/2
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (11)
                                <b>
                                    is_refundable:
                                    required, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (12)
                                <b>
                                    is_in_house:
                                    required, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (13)
                                <b>
                                    is_taxable:
                                    nullable, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (14)
                                <b>
                                    tax_class_id:
                                    required, number, 1/0
                                </b>
                            </span>
                            <br>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <a href="#" download="{{ asset('product_template.xlsx') }}"
                                    class="btn btn-warning waves-effect waves-light m-b-5">
                                    <i class="fa fa-file-alt m-r-5"></i>
                                    <span>
                                        Download Template
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
