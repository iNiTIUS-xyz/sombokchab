<!-- jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- NiceSelect CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nice-select2@2.0.0/dist/css/nice-select2.min.css">

<!-- NiceSelect JS -->
<script src="https://cdn.jsdelivr.net/npm/nice-select2@2.0.0/dist/js/nice-select2.min.js"></script>
<!-- Popular Porduct Starts -->
<section class="popularProduct__area padding-top-20 padding-bottom-20 ">
    <div class="container container_1608">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-left section_borderBottom">
                    <h2 class="title">{{ $section_title ?? '' }}</h2>
                    <div class="btn_wrapper">
                        <a href="{{ route('frontend.products.all') }}" class="viewAll_btn">
                            {{ __('View All') }} <i class="las la-angle-right"></i>
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
<!-- Popular Porduct end -->
<script>
$(document).ready(function() {
    $('.nice-select').niceSelect(); // for jQuery Nice Select
    // or for NiceSelect2:
    // NiceSelect.bind(document.querySelectorAll(".nice-select"));
});
</script>
