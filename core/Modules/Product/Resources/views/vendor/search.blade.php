@php
    if (auth()->guard('vendor')->check()) {
        $route = 'vendor';
    } else {
        $route ?? ($route = 'admin');
    }
@endphp
<table class="customs-tables pt-4 position-relative" id="myTable" style="text-align: left !important;">
    <div class="load-ajax-data"></div>
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
            <th> {{ __('Status') }} </th>
            <th> {{ __('Action') }} </th>
        </tr>
    </thead>
    <tbody>
        @forelse($products["items"] as $product)
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
                            <p class="font-weight-bold mb-1">{{ Str::limit($product->name, 50, '...') }}</p>
                            <p>{{ Str::words($product->summary, 5) }}</p>
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

                <td data-label="Status">
                    <x-product::table.status :statuses="$statuses" :statusId="$product?->status_id" :id="$product->id" />
                </td>

                <td data-label="Actions">
                    <div class="action-icon">
                        {{-- <a href="{{ route('frontend.products.single', $product->slug) }}"
                            class="icon eye btn-sm text-white btn btn-primary">
                            <i class="las la-eye"></i>
                        </a> --}}
                        <a href="{{ route($route . '.products.clone', $product->id) }}"
                            class="icon clone btn-sm text-white btn btn-secondary" title="{{ __('Create Duplicate') }}">
                            <i class="las la-copy"></i>
                        </a>

                        <a href="{{ route($route . '.products.edit', $product->id) }}"
                            class="icon edit btn-sm text-dark btn btn-warning" title="{{ __('Edit Data') }}">
                            <i class="las la-pencil-alt"></i>
                        </a>

                        <a data-product-url="{{ route($route . '.products.destroy', $product->id) }}" href="#1"
                            class="delete-row icon deleted btn-sm text-white btn btn-danger"
                            title="{{ __('Delete Data') }}">
                            <i class="las la-trash-alt"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-warning text-center">{{ __('No Product Available') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="custom-pagination-wrapper">
    <div class="pagination-info">
        <p>
            <strong>{{ __('Per Page:') }}</strong>
            <span>{{ $products['per_page'] }}</span>
        </p>
        <p>
            <strong>{{ __('From:') }}</strong>
            <span>{{ $products['from'] }}</span>
            <strong> {{ __('To:') }}</strong>
            <span>{{ $products['to'] }}</span>
        </p>
        <p>
            <strong>{{ __('Total Page:') }}</strong>
            <span>{{ $products['total_page'] }}</span>
        </p>
        <p>
            <strong>{{ __('Total Products:') }}</strong>
            <span>{{ $products['total_items'] }}</span>
        </p>
    </div>

    <div class="pagination">
        <ul class="pagination-list">
            <li class="wow ladeInRight" data-wow-delay="0.0s">
                <a disabled readonly="" href="{{ !$products['on_first_page'] ? $products['previous_page'] : '#1' }}"
                    class="page-number-arrow">
                    <i class="las la-angle-left"></i>
                </a>
            </li>
            @foreach ($products['links'] as $link)
                <li>
                    <a href="{{ $link }}"
                        class="page-number {{ $loop->iteration == $products['current_page'] ? 'current' : '' }}">
                        {{ $loop->iteration }}
                    </a>
                </li>
            @endforeach

            <li class="wow ladeInLeft" data-wow-delay="0.0s">
                <a href="{{ $products['hasMorePages'] ? $products['next_page'] : '#1' }}" class="page-number-arrow">
                    <i class="las la-angle-right"></i>
                </a>
            </li>
        </ul>
    </div>
</div>