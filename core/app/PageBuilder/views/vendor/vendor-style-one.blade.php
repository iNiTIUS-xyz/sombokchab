<!-- Trending Porduct end -->
<section class="allProduct__area padding-top-20 padding-bottom-20">
    <div class="container container_1608">
        <div class="row  g-4 mt-4">
            <div class="col-lg-12">
                <div class="section__title text-left section_borderBottom">
                    <div class="allProduct__tab">
                        <h2 class="title">
                            {{ __('Popular Stores') }}
                        </h2>
                    </div>
                    <div class="btn_wrapper">
                        <a href="{{ route('frontend.vendors') }}" class="viewAll_btn">
                            {{ __('View All Stores') }}
                            <i class="las la-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="" id="all_vendor_list">
            <div class="row g-4 mt-4">
                @foreach ($vendors as $vendor)
                    <x-vendor::style-one :vendor="$vendor" />
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- All Porduct end -->
