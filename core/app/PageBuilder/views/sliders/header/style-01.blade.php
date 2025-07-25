<!-- Banner area Starts -->
<div class="banner-area banner-two pt-0 mb-5">
    <div class="">
        <div class="row justify-content-center">
            {{-- <div class="col-lg-3 d-none d-lg-block">
            </div> --}}
            <div class="col-lg-12">
                <div class="banner-middle-content bg-item-two radius-10" style="height: 350px;">
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
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .banner-single-thumb img{
        width: 100%;
    }
</style>
<!-- Banner area end -->
