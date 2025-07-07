@extends('backend.admin-master')
@section('site-title')
    {{ __('Country') }}
@endsection
@section('style')
    <x-media.css />
    <x-bulk-action.css />
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="card">
                    <form action="{{ route('admin.featured.product.create') }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h4 class="dashboard__card__title">{{ __('Add new mobile slider') }}</h4>
                        </div>
                        <div class="card-body custom__form my-5">
                            <div class="form-group">
                                <label for="category">Enable Category</label>
                                <input type="checkbox" id="category" name="category"
                                    {{ optional($selectedProduct)->type == 'category' ? 'checked' : '' }} />
                            </div>
                            <div class="form-group" id="product-list"
                                {{ optional($selectedProduct)->type == 'category' ? 'style=display:none' : '' }}>
                                <label for="products">Select Product</label>
                                <select id="products" name="featured_product[]" multiple class="form-control">
                                    <option value="">
                                        Select Product
                                    </option>
                                    @foreach ($products as $product)
                                        <option
                                            {{ in_array($product->id, json_decode(optional($selectedProduct)->ids) ?? []) ? 'selected' : '' }}
                                            value="{{ $product->id }}">
                                            {{ Str::limit($product->name, 20, '...') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group"
                                {{ optional($selectedProduct)->type == 'category' ? '' : 'style=display:none' }}
                                id="category-list">
                                <label for="products">Select Category</label>
                                <select id="products" name="featured_category[]" multiple class="form-control select2">
                                    <option value="" disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option
                                            {{ in_array($category->id, json_decode(optional($selectedProduct)->ids) ?? []) ? 'selected' : '' }}
                                            value="{{ $category->id }}">
                                            {{ Str::limit($category->name, 20, '...') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer mt-5">
                            <div class="form-group">
                                <button type="submit" class="cmn_btn btn_bg_profile">
                                    {{ __('Update') }}
                                </button>
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
    <x-media.js />
    <script>
        $(document).ready(function() {
            // Initialize on page load
            $(".select2").select2();
            // Handle category toggle
            $("#category").on("change", function() {
                if ($(this).is(":checked")) {
                    $("#product-list").fadeOut();
                    setTimeout(function() {
                        $("#category-list").fadeIn();
                        // Re-initialize for any new selects
                        $("#category-list select").select2();
                    }, 400);
                } else {
                    $("#category-list").fadeOut();
                    setTimeout(function() {
                        $("#product-list").fadeIn();
                        // Re-initialize for any new selects
                        $("#product-list select").select2();
                    }, 400);
                }
            });
        });
    </script>
@endsection
