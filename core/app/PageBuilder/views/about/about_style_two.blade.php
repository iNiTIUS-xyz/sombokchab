<div class="about-area-wrapper padding-top-20 padding-bottom-20">
    <div class="container">
        <div class="row sec custom-reverse @if ($image_position == 'left') flex-row-reverse @endif">
            <div class="col-lg-6">
                <div class="content-box">
                    <h4 class="title">{{ html_entity_decode($title) }}</h4>
                    <div class="advantage-box support-area-wrapper">
                        <div class="support-item-wrap">
                            @foreach ($all_features['title_'] as $title)
                                <div class="single-support-item">
                                    <div class="icon-box">
                                        <i class="{{ $all_features['icon_'][$loop->index] ?? "" }} icon"></i>
                                    </div>
                                    <div class="content">
                                        <h5 class="title">{{ $title }}</h5>
                                        <p class="info">{{ $all_features['description_'][$loop->index] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="img-box">
                    {!! render_image($section_image) !!}
                </div>
            </div>
        </div>
    </div>
</div>
