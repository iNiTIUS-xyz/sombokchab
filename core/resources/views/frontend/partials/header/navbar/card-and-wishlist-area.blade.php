<style>
    .single-right-content .login-account .accounts i {
        color: var(--heading-color-two);
        background: var(--main-color-two);
        border-radius: 30px;
        padding: 6px;
    }

    .single-right-content .login-account .accounts i:hover {
        color: var(--main-color-one);
        background: var(--white);
        border-radius: 30px;
        padding: 6px;
    }
</style>

<div class="single-icon">
    <a class="icon" href="{{ route('frontend.products.wishlist') }}">
        <i class="lar la-save"></i>
    </a>
    <a href="#1" class="icon-notification">
        {{ Cart::instance('wishlist')->content()->count() }}
    </a>
</div>
<div class="single-icon cart-shopping">
    <div class="single-icon cart-shopping">
        <a class="icon" href="{{ route('frontend.products.cart') }}">
            <i class="las la-shopping-cart"></i>
        </a>
        <a href="{{ route('frontend.products.cart') }}" class="icon-notification cart-item-count-amount">
            {{-- {{ Cart::instance('default')->content()->count() }} --}}
            {{ Cart::instance('default')->content()->sum('qty') }}
        </a>
        <div class="addto-cart-contents ">
            <div class="single-addto-cart-wrappers">
                @php
                    $cart = Cart::instance('default')->content();
                    $subtotal = 0;
                @endphp
                @forelse($cart as $cart_item)
                    @php
                        $subtotal += calculatePrice($cart_item->price, $cart_item?->options) * $cart_item->qty;
                    @endphp
                    <div class="single-addto-carts">
                        <div class="addto-cart-flex-contents">
                            <div class="addto-cart-thumb">
                                <a href="{{ route('frontend.products.single', $cart_item->options->slug ?? '') }}">
                                    {!! render_image($cart_item?->options?->image ?? 0) !!}
                                </a>
                            </div>
                            <div class="addto-cart-img-contents">
                                <h6 class="addto-cart-title">
                                    <a href="{{ route('frontend.products.single', $cart_item->options->slug ?? '') }}">
                                        {{ Str::words($cart_item->name, 5) }} </a>
                                    <p>
                                        @if (!empty($cart_item?->options?->color_name ?? null))
                                            {{ __('Color') }}: {{ $cart_item?->options?->color_name }} ,
                                        @endif

                                        @if (!empty($cart_item?->options?->size_name ?? null))
                                            {{ __('Size') }}: {{ $cart_item?->options?->size_name }} ,
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
                                </h6>
                                <div class="price-updates product__price mt-2">
                                    <div class="product__price">
                                        <span class="price-title fs-16 fw-500 product__price__current">
                                            {{ amount_with_currency_symbol(calculatePrice($cart_item->price, $cart_item?->options)) }}
                                        </span>
                                    </div>
                                    <div class="product__price">
                                        <del class="del-price fs-16 fw-500 product__price__current color-heading">
                                            {{ amount_with_currency_symbol(calculatePrice($cart_item?->options?->regular_price ?? $cart_item->price, $cart_item?->options)) }}
                                        </del>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <span class="addto-cart-counts color-heading fw-500 px-3"> {{ $cart_item->qty }} </span>

                        <a data-label="Close" data-product_hash_id="{{ $cart_item->rowId }}" href="#1"
                            class="ff-jost close-cart px-3">
                            <span class="icon-close color-heading"> <i class="las la-times"></i> </span>
                        </a>
                    </div>
                @empty
                    <div class="single-addto-carts">
                        <p class="text-center">{{ __('No Item in Cart') }}</p>
                    </div>
                @endforelse
            </div>

            @if ($cart->count() != 0)
                <div class="cart-total-amount">
                    <h6 class="amount-title"> {{ __('Total Amount:') }} </h6> <span class="fs-18 fw-500 color-light">
                        {{ site_currency_symbol() . $subtotal }} </span>
                </div>
                <div class="btn-wrapper mt-3">
                    <a href="{{ route('frontend.checkout') }}" class="cart-btn radius-0 w-100"> {{ __('Checkout') }}
                    </a>
                </div>
                <div class="btn-wrapper mt-3">
                    <a href="{{ route('frontend.products.cart') }}" class="cart-btn cart-btn-outline radius-0 w-100">
                        {{ __('View Cart') }} </a>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="single-icon">
    <a class="icon" href="{{ route('frontend.products.compare') }}">
        <i class="las la-retweet"></i>
    </a>
    <a href="#1" class="icon-notification compare-item-count-amount">
        {{ Cart::instance('compare')->content()->count() }}
    </a>
</div>
<div class="track-icon-list-item single-icon">
    <div class="login-account">
        @if (auth('web')->check())
            <a class="accounts" href="#1">
                <i class="las la-user"></i>
            </a>
            <ul class="account-list-item">
                <li class="list">
                    <a href="#" class="account_active">
                        {{ __('Welcome, ') }} {{ auth('web')->user()->name }}
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('user.home') }}">
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('user.home.edit.profile') }}">
                        {{ __('Edit Profile') }}
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('user.home.change.password') }}">
                        {{ __('Change Password') }}
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('user.product.order.all') }}">
                        {{ __('My Orders') }}
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('user.shipping.address.all') }}">
                        {{ __('Shipping Address') }}
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('user.home.support.tickets') }}">
                        {{ __('Support Tickets') }}
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('user.logout') }}"
                        onclick="event.preventDefault();document.getElementById('menu_logout_submit_btn').dispatchEvent(new MouseEvent('click'));">
                        {{ __('Sign Out') }}
                    </a>
                    <form action="{{ route('user.logout') }}" method="POST" style="display: none;">
                        @csrf
                        <button id="menu_logout_submit_btn" type="submit"></button>
                    </form>
                </li>
            </ul>
        @elseif (auth('vendor')->check())
            <a class="accounts" href="#1">
                <i class="las la-user"></i>
            </a>
            <ul class="account-list-item">
                <li class="list">
                    <a href="#" class="account_active">
                        {{ __('Welcome, ') }} {{ auth('vendor')->user()->username }}
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('vendor.home') }}">
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('vendor.products.all') }}">
                        {{ __('Products List') }}
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('vendor.products.inventory.all') }}">
                        {{ __('Inventory') }}
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('vendor.shipping-method.index') }}">
                        {{ __('Shipping Method') }}
                    </a>
                </li>
                </li>
                <li class="list">
                    <a href="{{ route('vendor.orders.list') }}">
                        {{ __('Orders List') }}
                    </a>
                </li>
                <li class="list">
                    <a href="{{ route('vendor.logout') }}">
                        {{ __('Sign Out') }}
                    </a>
                </li>
            </ul>
        @else
            <a class="accounts" href="#1">
                <i class="las la-user"></i>
                {{-- <span class="icon-title">{{ __('Account') }}</span> --}}
            </a>
            <ul class="account-list-item">
                <li class="list">
                    <a href="{{ route('user.login') }}">
                        {{ __('Sign In') }}
                    </a>
                </li>
                <li class="list"> <a href="{{ route('user.register') }}">
                        {{ __('Sign Up') }}
                    </a>
                </li>
            </ul>
        @endif
    </div>
</div>