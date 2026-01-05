@php
    $titles = $sliders['title_'] ?? [];
@endphp

@if (!empty($titles))
<!-- Banner area Starts -->
<div class="banner-area banner-two pt-0 mb-3">
    <div class="">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div id="carouselExampleDark"
                     class="carousel carousel-dark slide"
                     data-bs-ride="carousel">

                    {{-- Indicators --}}
                    <div class="carousel-indicators">
                        @for ($i = 0; $i < count($titles); $i++)
                            <button type="button"
                                data-bs-target="#carouselExampleDark"
                                data-bs-slide-to="{{ $i }}"
                                @if ($i === 0) class="active" aria-current="true" @endif
                                aria-label="Slide {{ $i + 1 }}">
                            </button>
                        @endfor
                    </div>

                    {{-- Slides --}}
                    <div class="carousel-inner">
                        @for ($i = 0; $i < count($titles); $i++)
                            <div class="carousel-item @if ($i === 0) active @endif"
                                 data-bs-interval="3000">

                                {{-- Banner Image --}}
                                {!! render_image($sliders['image_'][$i] ?? 0) !!}

                                <div class="carousel-caption d-none d-md-block">

                                    <h2 class="banner-middle-title text-light fw-700 mt-3">
                                        <a href="{{ $sliders['btn_url_'][$i] ?? '#' }}">
                                            {!! __(str_replace(
                                                ['[cl]', '[/cl]'],
                                                ["<span class='color-two'>", '</span>'],
                                                $titles[$i]
                                            )) !!}
                                        </a>
                                    </h2>

                                    @if (!empty($sliders['btn_text_'][$i]))
                                        <div class="btn-wrapper">
                                            <a href="{{ $sliders['btn_url_'][$i] ?? '#' }}"
                                               class="cmn-btn btn-bg-1 mt-4">
                                                {{ __($sliders['btn_text_'][$i]) }}
                                            </a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        @endfor
                    </div>

                    {{-- Controls --}}
                    <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#carouselExampleDark"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">{{ __('Previous') }}</span>
                    </button>

                    <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#carouselExampleDark"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">{{ __('Next') }}</span>
                    </button>

                </div>

            </div>
        </div>
    </div>
</div>
@endif
<!-- Banner area end -->

<style>
    .banner-single-thumb img {
        width: 100%;
    }

    .carousel-item img {
        height: 300px;
        width: 100%;
        object-fit: cover;
    }

    .banner-middle-title a {
        padding: 5px;
        background: #0000003f;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
</style>
<!-- Banner area end -->
