@extends('frontend.frontend-page-master')

@section('page-title')
    {{ $campaign->title }}
@endsection

@section('style')
<style>
    /* ===============================
        Campaign Hero Banner
    =============================== */
    .campaign-hero-area {
        position: relative;
        height: 240px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .campaign-hero-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        z-index: 1;
    }

    .campaign-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            rgba(0,0,0,0.4) 0%,
            rgba(0,0,0,0.85) 100%
        );
        z-index: 2;
    }

    .campaign-hero-content {
        position: relative;
        z-index: 3;
        color: #fff;
        text-align: center;
    }

    .campaign-hero-title {
        font-size: 42px;
        font-weight: 700;
        color: #fff;
    }

    .global__countdown {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .global__countdown__count {
        background: var(--main-color-one);
        color: #fff;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 600;
        min-width: 55px;
    }

    .global__countdown__name {
        font-size: 13px;
        display: block;
        margin-top: 4px;
        color: #fff;
    }
</style>
@endsection

@section('content')

{{-- ===============================
    Campaign Hero Banner
=============================== --}}
<section class="campaign-hero-area">
    <div class="campaign-hero-bg"
        {!! render_background_image_markup_by_attachment_id($campaign->campaignImage?->id) !!}>
    </div>

    <div class="campaign-hero-overlay"></div>

    <div class="container container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="campaign-hero-content">

                    @if($campaign->end_date)
                        <div class="global__countdown mt-4">
                            <div class="flashCountdown campaign-counter"
                                 data-date="{{ $campaign->end_date->format('Y-m-d H:i:s') }}">
                                <div class="global__countdown__item">
                                    <span class="counter-days global__countdown__count"></span>
                                    <span class="global__countdown__name">Days</span>
                                </div>
                                <div class="global__countdown__item">
                                    <span class="counter-hours global__countdown__count"></span>
                                    <span class="global__countdown__name">Hours</span>
                                </div>
                                <div class="global__countdown__item">
                                    <span class="counter-minutes global__countdown__count"></span>
                                    <span class="global__countdown__name">Minutes</span>
                                </div>
                                <div class="global__countdown__item">
                                    <span class="counter-seconds global__countdown__count"></span>
                                    <span class="global__countdown__name">Seconds</span>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===============================
    Campaign Products
=============================== --}}
<section class="shop-area padding-top-50 padding-bottom-50">
    <div class="container container-one">

        {{-- View Toggle --}}
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-5">
                <div class="shop-left">
                    <div class="single-shops">
                        <ul class="shop-flex-icon tabs">
                            <li class="shop-icons" data-tab="tab-grid">
                                <a href="#1" class="icon">
                                    <i class="las la-bars"></i>
                                </a>
                            </li>
                            <li class="shop-icons active" data-tab="tab-grid2">
                                <a href="#1" class="icon">
                                    <i class="las la-border-all"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grid View --}}
        <div id="tab-grid2" class="tab-content-item active">
            <div class="row mt-4">
                @foreach ($products['items'] as $product)
                    <x-product::frontend.campaign-grid-style-01 :$product />
                @endforeach
            </div>
        </div>

        {{-- List View --}}
        <div id="tab-grid" class="tab-content-item">
            <div class="row mt-4">
                @foreach ($products['items'] as $product)
                    <x-product::frontend.campaign-list-style-01 :$product />
                @endforeach
            </div>
        </div>

        {{-- Pagination --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="custom-pagination mt-4 mt-lg-5">
                    <nav>
                        <ul class="pagination justify-content-center">
                            @if ($products['total_page'] > 1)

                                @if (!empty($products['previous_page'] ?? []))
                                    <li class="page-item">
                                        <a href="{{ $products['previous_page'] }}" class="page-link">‹</a>
                                    </li>
                                @endif

                                @foreach ($products['links'] as $link)
                                    <li class="page-item {{ $loop->iteration == $products['current_page'] ? 'active' : '' }}">
                                        <a href="{{ $link }}" class="page-link">
                                            {{ $loop->iteration }}
                                        </a>
                                    </li>
                                @endforeach

                                @if (!empty($products['next_page'] ?? []))
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products['next_page'] }}">›</a>
                                    </li>
                                @endif

                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        loopcounter('campaign-counter');
    });
</script>
@endsection
