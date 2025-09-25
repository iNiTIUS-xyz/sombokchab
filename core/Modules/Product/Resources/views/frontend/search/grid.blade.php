<div class="row mt-4">
    @forelse($all_products["items"] ?? [] as $product)
        <x-product::frontend.grid-style-07 :$product :$loop />
    @empty
        <div class="col-md-12">
            <div class="w-50 m-auto padding-top-100 padding-bottom-100">
                @if (Route::is('frontend.ajax.products.search'))
                    <x-frontend.page.empty :image="get_static_option('empty_cart_image')" :text="get_static_option('empty_cart_text') ?? __('No products found.')" />
                @else
                    <x-frontend.page.empty :image="get_static_option('empty_cart_image')" :text="get_static_option('empty_cart_text') ?? __('No products in your cart!')" />
                @endif
            </div>
            <h3 class="text-warning text-center">
                {{ __('No product found.') }}
            </h3>
        </div>
    @endforelse
</div>
