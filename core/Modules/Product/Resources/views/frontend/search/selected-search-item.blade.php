{{-- <li> {{ __('Selected Filter:') }} </li>
@foreach (request()->all() as $key => $value)
    @if (!empty($value) && $key !== '_token')
        @if (!empty($value) && $key !== 'page')
            <li>
                <a class="click-hide close-search-selected-item" data-key="{{ $key }}" href="javascript:void(0)">
                    {{ $value }}
                </a>
            </li>
        @endif
    @endif
@endforeach
<li>
    <a class="click-hide-parent clear-search" href="{{ route('frontend.dynamic.page', ['slug' => 'shop']) }}">
        {{ __('Clear All') }}
    </a>
</li> --}}

<li>{{ __('Selected Filter:') }}</li>
@if (request()->id && $category = Modules\Attributes\Entities\Category::find(request()->id))
    <li class="selected-filter-item">
        {{ $category->name }}
        <span class="close-search-selected-item" data-key="category"><i class="las la-times"></i></span>
    </li>
@endif
@if (request()->sub_cat_id && $sub_category = Modules\Attributes\Entities\SubCategory::find(request()->sub_cat_id))
    <li class="selected-filter-item">
        {{ $sub_category->name }}
        <span class="close-search-selected-item" data-key="sub_category"><i class="las la-times"></i></span>
    </li>
@endif
@if (request()->child_category)
    <li class="selected-filter-item">
        {{ request()->child_category }}
        <span class="close-search-selected-item" data-key="child_category"><i class="las la-times"></i></span>
    </li>
@endif
@ повод (request()->brand)
    <li class="selected-filter-item">
        {{ request()->brand }}
        <span class="close-search-selected-item" data-key="brand"><i class="las la-times"></i></span>
    </li>
@endif
@if (request()->color)
    <li class="selected-filter-item">
        {{ request()->color }}
        <span class="close-search-selected-item" data-key="color"><i class="las la-times"></i></span>
    </li>
@endif
@if (request()->size)
    <li class="selected-filter-item">
        {{ request()->size }}
        <span class="close-search-selected-item" data-key="size"><i class="las la-times"></i></span>
    </li>
@endif
@if (request()->rating)
    <li class="selected-filter-item">
        {{ request()->rating }} {{ __('Star') }}
        <span class="close-search-selected-item" data-key="rating"><i class="las la-times"></i></span>
    </li>
@endif
@if (request()->min_price && request()->max_price)
    <li class="selected-filter-item">
        {{ site_currency_symbol() }}{{ request()->min_price }} - {{ site_currency_symbol() }}{{ request()->max_price }}
        <span class="close-search-selected-item" data-key="min_price"><i class="las la-times"></i></span>
    </li>
@endif
@if (request()->country)
    <li class="selected-filter-item">
        {{ \Modules\CountryManage\Entities\Country::find(request()->country)->name ?? request()->country }}
        <span class="close-search-selected-item" data-key="country"><i class="las la-times"></i></span>
    </li>
@endif
@if (request()->city)
    <li class="selected-filter-item">
        {{ request()->city }}
        <span class="close-search-selected-item" data-key="city"><i class="las la-times"></i></span>
    </li>
@endif
@if (request()->state)
    <li class="selected-filter-item">
        {{ request()->state }}
        <span class="close-search-selected-item" data-key="state"><i class="las la-times"></i></span>
    </li>
@endif
<li>
    <a class="click-hide-parent clear-search" href="{{ route('frontend.dynamic.page', ['slug' => 'shop']) }}">
        {{ __('Clear All') }}
    </a>
</li>
