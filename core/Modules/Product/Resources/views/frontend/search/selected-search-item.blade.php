@foreach (request()->all() as $key => $value)
    @if ($value && !in_array($key, ['_token', 'page', 'keyword']))
        <li>
            <a class="click-hide close-search-selected-item" data-key="{{ $key }}" href="javascript:void(0)">
                {{ $value }}
            </a>
        </li>
    @endif
@endforeach

@if (count(request()->all()) > 0)
    <li>
        <a class="click-hide-parent clear-search text-danger rounded-btn" title="Clear Filter"
            href="{{ route('frontend.dynamic.page', ['slug' => 'shop']) }}">
            <i class="las la-times" style="font-size: 1rem; font-weight: bold;"></i>
        </a>
    </li>
@endif
