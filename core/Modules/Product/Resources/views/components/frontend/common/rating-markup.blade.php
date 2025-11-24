@php
    $product = $product ?? null;
    $avg_rattings = $avgRattings ?? null;
    $ratingCount = $ratingCount ?? null;

    // determine rating and count
    $ratingValue = !empty($product)
        ? ($product->reviews_avg_rating ?? 0)
        : ($avg_rattings ?? 0);

    $ratingCountValue = !empty($product)
        ? ($product->reviews_count ?? 0)
        : ($ratingCount ?? 0);

    // convert rating to width percentage
    $rating_width = round($ratingValue * 20);
@endphp

<div class="ratings">
    {{-- always show background 5 stars --}}
    <span class="hide-rating"></span>

    {{-- filled stars --}}
    <span class="show-rating" style="width: {{ $rating_width }}%!important"></span>
</div>

<p>
    <span class="total-ratings">
        ({{ $ratingCountValue }})
    </span>
</p>
