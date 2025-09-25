@props(['all_products'])

@if (($all_products['total_page'] ?? 0) > 1)
    <ul class="pagination-list">
        @foreach ($all_products['links'] as $link)
            <li>
                <a data-page-index="{{ $loop->iteration }}" href="{{ $link }}"
                    class="page-number {{ $loop->iteration == $all_products['current_page'] ? 'current' : '' }}">
                    {{ $loop->iteration }}
                </a>
            </li>
        @endforeach
    </ul>
@endcan
