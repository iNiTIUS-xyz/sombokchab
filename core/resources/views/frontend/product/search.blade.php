@extends('frontend.frontend-page-master')

@section('page-title')
    {{ __("Products: Search Result") }}
@endsection

@section('style')

@endsection

@section('content')
<div class="shop-area-wrapper grid-only" id="shop">
    <div class="container">
        <div class="row">
            @if ($all_products->count() > 0)
                @foreach ($all_products as $product)
                    <x-frontend.product.product-card :product="$product" />
                @endforeach
            @else
                <div class="col-12 text-center">
                    <h3 class="mt-5">{{ __("No products found.") }}</h3>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $all_products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery-ui.min.css') }}">
<script src="{{ asset('assets/common/js/jquery-ui.min.js') }}"></script>
@endsection
