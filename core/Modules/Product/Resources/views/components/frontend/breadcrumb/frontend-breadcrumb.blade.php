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
                        <li class="list">
                            <a href="{{ $routeName }}">
                                {{ $innerTitle }}
                            </a>
                        </li>
                        @if (isset($subInnerTitle) && $subInnerTitle)
                            <li class="list">
                                <a href="{{ $subRouteName }}">
                                    {{ $subInnerTitle ?? '' }}
                                </a>
                            </li>
                        @endif
                        @if (isset($chidInnerTitle) && !empty($chidInnerTitle))
                            <li class="list">
                                <a href="{{ $childRouteName }}">
                                    {{ $chidInnerTitle ?? '' }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
