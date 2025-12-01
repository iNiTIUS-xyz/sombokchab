@php
    $orderMap = [
        'desc' => 'Product Listing: Latest',
        'asc' => 'Product Listing: Oldest',
        'a-z' => 'Product Name: A → Z',
        'z-a' => 'Product Name: Z → A',
        'price_low_to_high' => 'Product Price: Low to High',
        'price_high_to_low' => 'Product Price: High to Low',
    ];

    $dependencies = [
        'category' => ['sub_category', 'child_category'],
        'sub_category' => ['child_category'],
    ];

    $activeFilters = collect(request()->all())
        ->filter(function ($value, $key) {
            return $value &&
                !in_array($key, ['_token', 'page', 'keyword']);
        });
@endphp


@foreach ($activeFilters as $key => $value)

    @php
        // Default label
        $displayValue = $value;

        // ORDER BY LABELS
        if ($key === 'order_by') {
            $displayValue = $orderMap[$value] ?? $value;
        }

        // BRAND LABEL
        if ($key === 'brand') {
            $displayValue = "Brand: {$value}";
        }

        // PRICE LABELS
        if ($key === 'min_price') {
            $displayValue = "Price Min: " . site_currency_symbol() . $value;
        }

        if ($key === 'max_price') {
            $displayValue = "Price Max: " . site_currency_symbol() . $value;
        }

        // RATING LABEL
        if ($key === 'rating') {
            $stars = str_repeat('★', intval($value)) . str_repeat('☆', 5 - intval($value));
            $displayValue = "Rating: {$stars}";
        }

        // CASCADING REMOVAL
        $removeTargets = json_encode($dependencies[$key] ?? []);
    @endphp


    <li class="selected-filter-item">
        <span>{!! $displayValue !!}</span>

        <button type="button"
                class="remove-filter-btn close-search-selected-item"
                data-key="{{ $key }}"
                data-remove-list='{{ $removeTargets }}'>
            <i class="las la-times"></i>
        </button>
    </li>
@endforeach


@if ($activeFilters->count() > 1)
    <li class="clear-all-list">
        <button class="clear-search text-danger rounded-btn" title="Clear Filters" type="button">
            Remove All
        </button>
    </li>
@endif
