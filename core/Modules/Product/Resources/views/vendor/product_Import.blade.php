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
                                    name :
                                    required, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (2)
                                <b>
                                    sku :
                                    nullable, number|text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (3)
                                <b>
                                    category :
                                    required, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (4)
                                <b>
                                    subcategory :
                                    nullable, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (5)
                                <b>
                                    childcategory :
                                    nullable, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (6)
                                <b>
                                    unit :
                                    required, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (7)
                                <b>
                                    brand :
                                    nullable, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (8)
                                <b>
                                    author :
                                    nullable, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (9)
                                <b>
                                    alert_quantity :
                                    nullable, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (10)
                                <b>
                                    vat_percent :
                                    nullable, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (11)
                                <b>
                                    minimum_sale_price :
                                    nullable, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (12)
                                <b>
                                    minimum_wholesale_price :
                                    nullable, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (13)
                                <b>
                                    barcode :
                                    nullable, number|text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (14)
                                <b>
                                    purchase_price :
                                    required, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (15)
                                <b>
                                    selling_price :
                                    required, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (16)
                                <b>
                                    discount_type :
                                    required, Amount|Percentage
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (17)
                                <b>
                                    discount_value :
                                    nullable, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (18)
                                <b>
                                    wholesale_price :
                                    nullable, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (19)
                                <b>
                                    minimum_wholesale_quantity :
                                    nullable, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (20)
                                <b>
                                    size :
                                    nullable, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (21)
                                <b>
                                    color :
                                    nullable, text
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (22)
                                <b>
                                    opening_stock_qty :
                                    nullable, number
                                </b>
                            </span>
                            <br>
                            <span class="text-bark">
                                (23)
                                <b>
                                    opening_stock_purchase_price_rate :
                                    nullable, number
                                </b>
                            </span>
                            <br>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <a href="https://amarsolution.com/product-export?type=template" download=""
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
