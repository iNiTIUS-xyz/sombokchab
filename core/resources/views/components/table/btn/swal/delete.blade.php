<a tabindex="0"
    class="btn btn-sm btn-danger mb-2 me-1 swal-delete {{ $class ?? '' }} @if (isset($selector)) {{ $selector }} @endif"
    data-route="{{ $route }}" title="{{ __('Delete') }}">
    <i class="las la-trash-alt"></i>
</a>
