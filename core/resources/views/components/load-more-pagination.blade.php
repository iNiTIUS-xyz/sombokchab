@props(['all_products'])
{{-- Load more button instead of numbered pagination --}}
{{-- @if (($all_products['total_page'] ?? 0) > ($all_products['current_page'] ?? 1))
    <div class="row">
        <div class="col-lg-12 text-center mt-5">
            <button id="load_more_button" class="btn-load-more"
                data-current-page="{{ $all_products['current_page'] ?? 1 }}"
                data-total-pages="{{ $all_products['total_page'] ?? 1 }}">
                {{ __('Load More') }}
                <span class="btn-loading-spinner d-none">
                    <i class="las la-spinner la-spin"></i>
                </span>
            </button>
        </div>
    </div>
@endif --}}


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

<style>
    .btn-load-more {
        background-color: var(--main-color-one);
        color: #fff;
        border: none;
        padding: 12px 30px;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    .btn-load-more:hover {
        background-color: var(--main-color-two);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-load-more:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .btn-loading-spinner {
        margin-left: 8px;
        display: inline-block;
    }

    /* Animation for smooth loading of new items */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .new-loaded-item {
        animation: fadeIn 0.5s ease forwards;
    }
</style>
