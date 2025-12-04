@php
    if (auth()->guard('vendor')->check()) {
        $route = 'vendor';
    } else {
        $route ?? ($route = 'admin');
    }
@endphp
<table class="customs-tables pt-4 position-relative" id="dataTable">
    <thead class="head-bg">
        <tr>
            <th class="check-all-rows p-3">
                <div class="mark-all-checkbox">
                    <input type="checkbox" class="all-checkbox">
                </div>
            </th>
            <th> {{ __('Name') }} </th>
            <th> {{ __('Brand') }} </th>
            <th> {{ __('Categories') }} </th>
            <th> {{ __('Stock Qty') }} </th>
            <th> {{ __('Approval Status') }} </th>
            <th> {{ __('Publish Status') }} </th>
            <th> {{ __('Created On') }} </th>
            <th> {{ __('Action') }} </th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
            <tr class="table-cart-row">
                <td data-label="Check All">
                    <x-product::table.bulk-delete-checkbox :id="$product->id" />
                </td>
                <td class="product-name-info ">
                    <div class="d-flex gap-2">
                        <div class="logo-brand position-relative">
                            <div class="image-box">
                                {!! render_image($product->image) !!}
                            </div>

                            @if (false)
                                <button data-product-id="{{ $product->id }}" data-bs-target="#mediaUpdateModalId"
                                    data-bs-toggle="modal"
                                    class="product-image-change-action-button btn btn-sm btn-outline-primary position-absolute top-0 left-0 rounded-circle">
                                    <i class="las la-pen"></i>
                                </button>
                            @endif
                        </div>
                        <div class="product-summary">
                            <p class="font-weight-bold mb-1">
                                <strong>English :</strong> {{ Str::limit($product->name, 50, '...') }}
                            </p>
                            @if ($product->name_km)
                                <p><strong>Khm :</strong> {{ Str::limit($product->name_km, 50) }}</p>
                            @endif
                        </div>
                    </div>
                </td>
                <td data-label="Image" class="text-left">
                    <div class="d-flex gap-2">
                        @if ($product?->brand?->image_id)
                            <div class="logo-brand product-brand">
                                {!! $product?->brand?->image_id ? render_image($product?->brand?->image_id) : '' !!}
                            </div>
                        @endif
                        <b class="">
                            {{ $product?->brand?->name }}
                        </b>
                    </div>
                </td>
                <td class="price-td " data-label="Name">
                    <span class="category-field">
                        @if ($product?->category?->name)
                            <b> {{ __('Category') }}: </b>
                        @endif{{ $product?->category?->name }}
                    </span> <br>
                    <span class="category-field">
                        @if ($product?->subCategory?->name)
                            <b> {{ __('Sub Category') }}: </b>
                        @endif{{ $product?->subCategory?->name }}
                    </span><br>
                </td>
                <td class="price-td" data-label="Quantity">
                    <span class="quantity-number"> {{ $product?->inventory?->stock_count }}</span>
                </td>
                <td>
                    <span style="color: white; !important"
                        class="badge
                            @if ($product->product_status == 'publish') bg-primary status-open
                            @elseif ($product->product_status == 'unpublish')
                                bg-warning status-close
                            @elseif($product->product_status == 'rejected')
                                bg-danger status-close @endif
                        ">
                        @if ($product->product_status == 'publish')
                            {{ __('Approved') }}
                        @elseif ($product->product_status == 'unpublish')
                            {{ __('Pending') }}
                        @elseif($product->product_status == 'rejected')
                            {{ __('Rejected') }}
                        @endif
                    </span>
                </td>
                <td data-label="Status">
                    @if ($product->status_id == 1)
                        <span class="badge bg-primary">Published</span>
                    @else
                        <span class="badge bg-warning">Unpublished</span>
                    @endif
                </td>
                <td>
                    {{ $product->created_at->format('M j, Y') }}
                </td>
                <td data-label="Actions">
                    <a href="{{ route($route . '.products.clone', $product->id) }}"
                        class="icon clone btn-sm text-white btn btn-secondary" title="{{ __('Create Duplicate') }}">
                        <i class="las la-copy"></i>
                    </a>

                    <a href="{{ route($route . '.products.edit', $product->id) }}"
                        class="icon edit btn-sm text-dark btn btn-warning" title="{{ __('Edit Product') }}">
                        <i class="las la-pencil-alt"></i>
                    </a>

                    <a data-product-url="{{ route($route . '.products.destroy', $product->id) }}" href="#1"
                        class="delete-row icon deleted btn-sm text-white btn btn-danger"
                        title="{{ __('Delete Data') }}">
                        <i class="las la-trash-alt"></i>
                    </a>
                    {{-- </div> --}}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-warning text-center">{{ __('No Product Available') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
