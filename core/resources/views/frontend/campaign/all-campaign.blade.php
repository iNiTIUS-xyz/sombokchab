@extends('frontend.frontend-page-master')

@section('page-title')
    {{ __('All Campaigns') }}
@endsection

@section('content')
@if($all_campaigns->isNotEmpty())
<section class="popularProduct__area padding-top-20 padding-bottom-20">
    <div class="container container_1608">

        {{-- Section Header --}}
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-left section_borderBottom">
                    <h2 class="title">{{ __('All Campaigns') }}</h2>
                </div>
            </div>
        </div> --}}

        {{-- Campaign Cards --}}
        <div class="row gy-5 mt-1 pb-4">
            @foreach ($all_campaigns as $campaign)
                <div class="col-lg-4 col-md-6">
                    <div class="flashSale__single radius-10 overflow-hidden">

                        <a href="{{ route('frontend.products.campaign', $campaign->slug) }}"
                           class="flashSale__card position-relative d-block">

                            {{-- Image --}}
                            <div class="flashSale__thumb">
                                {!! render_image($campaign->campaignImage) !!}
                            </div>

                            {{-- Overlay --}}
                            <div class="flashSale__overlay"></div>

                            {{-- Content --}}
                            <div class="flashSale__content position-absolute w-100">
                                <h4 class="flashSale__title">
                                    {{ $campaign->title }}
                                </h4>

                                @if($campaign->end_date)
                                    <div class="global__countdown mt-3">
                                        <div class="flashCountdown flashCountdown-{{ $campaign->id }}"
                                             data-date="{{ $campaign->end_date->format('Y-m-d H:i:s') }}">
                                            <div class="global__countdown__item">
                                                <span class="counter-days global__countdown__count"></span>
                                                <span class="global__countdown__name">D</span>
                                            </div>
                                            <div class="global__countdown__item">
                                                <span class="counter-hours global__countdown__count"></span>
                                                <span class="global__countdown__name">H</span>
                                            </div>
                                            <div class="global__countdown__item">
                                                <span class="counter-minutes global__countdown__count"></span>
                                                <span class="global__countdown__name">M</span>
                                            </div>
                                            <div class="global__countdown__item">
                                                <span class="counter-seconds global__countdown__count"></span>
                                                <span class="global__countdown__name">S</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="row mt-4">
            <div class="col-lg-12">
                {{ $all_campaigns->links() }}
            </div>
        </div>

    </div>
</section>
@endif
@endsection
