<!-- Banner area Starts -->
<div class="banner-area banner-two pt-0 mb-3">
    <div class="">
        <div class="row justify-content-center">
            {{-- <div class="col-lg-3 d-none d-lg-block">
            </div> --}}
            <div class="col-lg-12">


                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    {{-- Carousel Indicators --}}
                    <div class="carousel-indicators">
                        @for ($i = 0; $i < count($sliders['subtitle_'] ?? []); $i++)
                            <button type="button"
                                data-bs-target="#carouselExampleDark"
                                data-bs-slide-to="{{ $i }}"
                                @if ($i == 0) class="active" aria-current="true" @endif
                                aria-label="Slide {{ $i + 1 }}">
                            </button>
                        @endfor
                    </div>

                    {{-- Carousel Items --}}
                    <div class="carousel-inner">
                        @for ($i = 0; $i < count($sliders['subtitle_'] ?? []); $i++)
                            <div class="carousel-item @if ($i == 0) active @endif" data-bs-interval="3000">
                                {{-- Banner Image --}}
                                 {!! render_image($sliders['image_'][$i] ?? 0) !!}
                                <div class="carousel-caption d-none d-md-block">
                                    <span class="middle-span fw-500 text-light">{{ $sliders['subtitle_'][$i] ?? '' }}</span>
                                    <h2 class="banner-middle-title text-light fw-700 mt-3">
                                        <a href="{{ $sliders['btn_url_'][$i] ?? '#' }}">
                                            {!! str_replace(['[cl]', '[/cl]'], ["<span class='color-two'>", '</span>'], $sliders['title_'][$i] ?? '') !!}
                                        </a>
                                    </h2>
                                    <div class="btn-wrapper">
                                        <a href="{{ $sliders['btn_url_'][$i] ?? '#' }}" class="cmn-btn btn-bg-1 mt-4">
                                            {{ $sliders['btn_text_'][$i] ?? '' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    {{-- Carousel Controls --}}
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>


                {{-- <div class="banner-middle-content bg-item-two radius-10" style="height: 350px;">
                    <div class="global-slick-init dot-style-one banner-dots dot-color-two dot-absolute"
                         data-infinite="true" data-arrows="true" data-dots="true"
                         data-rtl="{{get_user_lang_direction() == 'rtl' ? 'true' : 'false'}}"
                         data-autoplaySpeed="3000"
                         data-autoplay="true">
                        @for ($i = 0; $i < count($sliders['subtitle_'] ?? []); $i++)
                                <div class="banner-middle-image" style="width: 100%;">
                                    <a href="{{ $sliders['btn_url_'][$i] ?? '#' }}" class="">
                                        <div class="banner-single-thumb" style="width: 100%;">
                                            {!! render_image($sliders['image_'][$i] ?? 0) !!}
                                        </div>
                                    </a>
                                    <div class="middle-content">
                                        <span
                                            class="middle-span fw-500 text-light">{{ $sliders['subtitle_'][$i] ?? '' }}</span>
                                        <h2 class="banner-middle-title text-light fw-700 mt-3">
                                            <a href="{{ $sliders['btn_url_'][$i] ?? '#' }}">{!! str_replace(['[cl]', '[/cl]'], ["<span class='color-two'>", '</span>'], $sliders['title_'][$i] ?? '') !!}</a>
                                        </h2>
                                        <div class="btn-wrapper">
                                            <a href="{{ $sliders['btn_url_'][$i] ?? '#' }}" class="cmn-btn btn-bg-1 mt-4">
                                                {{ $sliders['btn_text_'][$i] ?? '' }} </a>
                                        </div>
                                    </div>
                                </div>
                        @endfor
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<style>
    .banner-single-thumb img{
        width: 100%;
    }
    .carousel-item img{
        height: 300px;
        width: 100%;
        object-fit: cover;
    }
    .banner-middle-title a{
        padding: 5px;
        background: #0000003f;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
</style>
<!-- Banner area end -->
