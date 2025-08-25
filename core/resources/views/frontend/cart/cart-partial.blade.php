@php
    $wishlist = $wishlist ?? false;
@endphp
<div class="cart-area">
    <div class="container container-one">
        <div class="cart-wrapper">
            <div class="row g-4">
                {{-- @if (Route::is('frontend.products.wishlist'))
                    <div class="col-xl-8 mt-4 m-auto">
                        <div class="row justify-content-end">
                            <div class="col-xl-2">
                                <form action="{{ route('frontend.products.wishlist') }}" method="GET">
                                    <select name="sorting_by" class="form-control" onchange="this.form.submit()">
                                        <option value="price" @if (request('sorting_by') == 'price') selected @endif>
                                            Sorting By Price
                                        </option>
                                        <option value="name" @if (request('sorting_by') == 'name') selected @endif>
                                            Sorting By Name
                                        </option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-xl-8 mt-4 m-auto">
                        <div class="row justify-content-end">
                            <div class="col-xl-2">
                                <form action="{{ route('frontend.products.cart') }}" method="GET">
                                    <select name="sorting_by" class="form-control" onchange="this.form.submit()">
                                        <option value="price" @if (request('sorting_by') == 'price') selected @endif>
                                            Sorting By Price
                                        </option>
                                        <option value="name" @if (request('sorting_by') == 'name') selected @endif>
                                            Sorting By Name
                                        </option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif --}}
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
                                                        <a data-label="Move" title="Move to cart" data-type="tr"
                                                            data-product_hash_id="{{ $cart_item->rowId }}"
                                                            href="#1"
                                                            class="ff-jost move-cart px-3 btn btn-info mx-2">
                                                            <span class="icon-close text-light">
                                                                <i class="las la-shopping-cart"></i>
                                                            </span>
                                                        </a>
                                                        <a title="Remove" data-type="tr"
                                                            data-product_hash_id="{{ $cart_item->rowId }}"
                                                            href="#1"
                                                            class="ff-jost remove-wishlist px-3 btn btn-danger">
                                                            <span class="icon-close text-light">
                                                                <i class="las la-trash-alt"></i>
                                                            </span>
                                                        </a>
                                                    @else
                                                        <a data-label="Move" title="Add to save for later"
                                                            data-type="tr"
                                                            data-product_hash_id="{{ $cart_item->rowId }}"
                                                            href="#1"
                                                            class="ff-jost move-wishlist px-3 btn btn-info mx-2">
                                                            <span class="icon-close text-light">
                                                                <i class="lar la-save"></i>
                                                            </span>
                                                        </a>
                                                        <a data-label="Close" title="Remove" data-type="tr"
                                                            data-product_hash_id="{{ $cart_item->rowId }}"
                                                            href="#1"
                                                            class="ff-jost remove-cart px-3 btn btn-danger">
                                                            <span class="icon-close">
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
