@php
    $wishlist = $wishlist ?? false;
@endphp


<div class="cart-area">
    <div class="container container-one">
        <div class="cart-wrapper">
            <div class="row g-4">
                <div class="col-xl-8 mt-4 m-auto">
                    <div class="table-list-content table-cart-clear">
                        <div class="table-responsive table-responsive--md">
                            <table id="dataTable" class="custom--table table-border radius-10">
                                <thead class="head-bg">
                                    <tr>
                                        <th class="text-center"> {{ __('Product Name') }} </th>
                                        <th class="text-center"> {{ __('Unit Price') }} </th>
                                        @if (!Route::is('frontend.products.wishlist'))
                                            <th class="text-center">{{ __('Quantity') }} </th>
                                            <th class="text-center"> {{ __('Total Price') }} </th>
                                        @endif
                                        <th class="text-center"> {{ __('Action') }} </th>
                                    </tr>
                                </thead>
                                <tbody class="cart-table-body">
                                    @foreach ($all_cart_items as $key => $cart_item)
                                        @php
                                            $productModel = \Modules\Product\Entities\Product::find($cart_item->id);
                                            $campaign_product = $productModel->campaign_product ?? null;
                                            $campaignSoldCount = $productModel->campaign_sold_product ?? null;
                                            $stock_count = $campaign_product
                                                ? max(
                                                    0,
                                                    $campaign_product->units_for_sale -
                                                        optional($campaignSoldCount)->sold_count ??
                                                        0,
                                                )
                                                : optional($productModel->inventory)->stock_count;

                                            $in_stock_limit =
                                                (int) get_static_option('product_in_stock_limit_set') ?? 0;
                                            $stock_count = $stock_count > $in_stock_limit ? $stock_count : 0;
                                        @endphp
                                        <tr class="table-cart-row" data-product_hash_id="{{ $cart_item->rowId }}"
                                            data-product-id="{{ $key }}"
                                            data-varinat-id="{{ $cart_item?->options?->variant_id ?? 'admin' }}">
                                            <td data-label="Product Name">
                                                <div class="product-name-table">
                                                    <a
                                                        href="{{ route('frontend.products.single', $cart_item->options->slug ?? '') }}">
                                                        <div class="thumbs bg-image radius-10"
                                                            style="background-image: url({{ render_image($cart_item?->options['image'] ?? 0, render_type: 'path') }});">
                                                        </div>
                                                    </a>
                                                    <div class="carts-contents">
                                                        <a
                                                            href="{{ route('frontend.products.single', $cart_item->options->slug ?? '') }}">
                                                            <span class="name-title" title="{{ $cart_item->name }}">
                                                                {{ Str::limit($cart_item->name, 60, '...') }}
                                                            </span>
                                                            <br>
                                                            @if ($stock_count <= 0)
                                                                <span class="badge bg-danger">Out of Stock</span>
                                                            @endif
                                                        </a>

                                                        <p>
                                                            @if (!empty($cart_item?->options['color_name'] ?? null))
                                                                {{ __('Color:') }}
                                                                {{ $cart_item?->options['color_name'] }} ,
                                                            @endif

                                                            @if (!empty($cart_item?->options['size_name'] ?? null))
                                                                {{ __('Size:') }}
                                                                {{ $cart_item?->options['size_name'] ?? null }} ,
                                                            @endif

                                                            @if (!empty($cart_item?->options?->attributes ?? null))
                                                                @foreach ($cart_item?->options?->attributes as $key => $value)
                                                                    @if ($loop->last)
                                                                        {{ $key }} : {{ $value }}
                                                                    @else
                                                                        {{ $key }} : {{ $value }} ,
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </p>

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="price-td text-center" data-label="Unit Price">
                                                <div class="product__price ">
                                                    <span class="product__price__current ">
                                                        {{ amount_with_currency_symbol($cart_item->price) }}
                                                    </span>
                                                </div>
                                            </td>
                                            @if (!Route::is('frontend.products.wishlist'))
                                                <td data-label="Quantity">
                                                    <div class="product-quantity">
                                                        <span class="substract">
                                                            <i class="las la-minus"></i>
                                                        </span>
                                                        <input class="quantity-input" type="hidden"
                                                            value="{{ $cart_item->qty }}"
                                                            data-max="{{ $cart_item?->options ? $cart_item?->options['available_stock_qty'] : 100 }}"
                                                            data-min="1">
                                                        <span class="quantity-display">{{ $cart_item->qty }}</span>
                                                        <span class="plus">
                                                            <i class="las la-plus"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="color-one price-td text-center" data-label="Total Price">
                                                    <div class="product__price ">
                                                        <span class="product__price__current ">
                                                            {{ amount_with_currency_symbol($cart_item->price * $cart_item->qty ?? 0) }}
                                                        </span>
                                                    </div>
                                                </td>
                                            @endif
                                            <td data-label="Close" class="text-center">
                                                <div class="btn-group">
                                                    @if ($wishlist)
                                                        {{-- Move to Cart Button --}}
                                                        <a data-label="Move"
                                                            title="{{ $stock_count > 0 ? 'Move to cart' : 'Out of stock' }}"
                                                            data-type="tr"
                                                            data-product_hash_id="{{ $cart_item->rowId }}"
                                                            href="{{ $stock_count > 0 ? '#1' : 'javascript:void(0)' }}"
                                                            class="ff-jost move-cart px-3 btn mx-2 {{ $stock_count <= 0 ? 'disabled opacity-50 cursor-not-allowed btn-secondary' : 'btn-info' }}"
                                                            {{ $stock_count <= 0 ? 'aria-disabled=true disabled' : '' }}>
                                                            <span class="icon-close text-light">
                                                                <i class="las la-shopping-cart"></i>
                                                            </span>
                                                        </a>

                                                        {{-- Optional: Show Out of Stock badge --}}
                                                        {{-- @if ($stock_count <= 0)
                                                            <span class="badge bg-danger ms-2">Out of Stock</span>
                                                        @endif --}}

                                                        <a title="{{ __('Remove') }}" data-type="tr"
                                                            data-product_hash_id="{{ $cart_item->rowId }}"
                                                            href="#1"
                                                            class="ff-jost remove-wishlist px-3 btn btn-danger">
                                                            <span class="icon-close text-light">
                                                                <i class="las la-trash-alt"></i>
                                                            </span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if (!$wishlist)
                            <div class="table-update-btn margin-top-40 gap-4">
                                <a href="{{ route('frontend.checkout') }}"
                                    class="btn-table btn-border-1 btn-primary text-light">
                                    {{ __('Checkout') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all quantity inputs
        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('input', function() {
                const maxQty = parseInt(this.getAttribute('max')) || 0;
                let currentQty = parseInt(this.value);

                if (currentQty > maxQty) {
                    this.value = maxQty;
                }

                if (currentQty < 1 || isNaN(currentQty)) {
                    this.value = 1;
                }
            });
        });
    });
</script>
