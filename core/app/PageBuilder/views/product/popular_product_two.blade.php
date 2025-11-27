<section class="popularProduct__area padding-top-20 padding-bottom-20 ">
    <div class="container container_1608">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-left section_borderBottom">
                    <h2 class="title">{{ __($section_title ?? '') }}</h2>
                    <div class="btn_wrapper">
                        <a href="{{ route('frontend.products.all') }}" class="viewAll_btn">
                            {{ __('View All') }}
                            <i class="las la-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gy-5 mt-1">
            @foreach ($all_products as $product)
                <x-product::frontend.grid-style-05 :$product />
            @endforeach
        </div>
    </div>
</section>
