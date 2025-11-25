<div class="breadcrumb-area breadcrumb-padding bg-item-badge">
    <div class="breadcrumb-shapes">
        <img src="{{ asset('assets/img/shop/badge-s1.png') }}" alt="">
        <img src="{{ asset('assets/img/shop/badge-s2.png') }}" alt="">
        <img src="{{ asset('assets/img/shop/badge-s3.png') }}" alt="">
    </div>

    <div class="container container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-contents">

                    <h2 class="details-title">
                        {{ $title }}
                    </h2>
                    <ul class="breadcrumb-list">
                        @if (!Route::is('frontend.products.single'))
                            <li class="list">
                                <a href="{{ route('homepage') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                        @endif
                        @if (!empty($innerTitle))
                            <li class="list">
                                <a href="{{ $routeName }}">
                                    {{ $innerTitle }}
                                </a>
                            </li>
                        @endif
                        @if (!empty($subInnerTitle))
                            <li class="list">
                                <a href="{{ $subRouteName }}">
                                    {{ $subInnerTitle }}
                                </a>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
