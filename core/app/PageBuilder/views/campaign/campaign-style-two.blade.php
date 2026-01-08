@if($campaigns->isNotEmpty())

<section class="popularProduct__area padding-top-20 padding-bottom-20 ">
    <div class="container container_1608">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-left section_borderBottom">
                    <h2 class="title">{{ __($section_title ?? __('Campaigns')) }}</h2>
                    <div class="btn_wrapper">
                        <a href="{{ route('frontend.dynamic.campaigns.page') }}" class="viewAll_btn">
                            {{ __('View All Campaigns') }}
                            <i class="las la-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Campaign Cards --}}
        <div class="row gy-5 mt-1">
            @foreach ($campaigns as $campaign)
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

                            {{-- Content on image --}}
                            <div class="flashSale__content position-absolute w-100">

                                <h4 class="flashSale__title">
                                    {{ $campaign->title }}
                                </h4>

                                @if($campaign->end_date)
                                    <div class="global__countdown mt-3">
                                        <div class="flashCountdown flashCountdown-{{ $campaign->id }}" data-date="{{ $campaign->end_date->format('Y-m-d H:i:s') }}">
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
    </div>
</section>
@endif
