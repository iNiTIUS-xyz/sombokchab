<table class="customs-tables pt-4 position-relative" id="productDataTable">
    <thead class="head-bg">
        <tr>
            <th class="check-all-rows p-3">
                <div class="mark-all-checkbox text-center">
                    <input type="checkbox" class="all-checkbox">
                </div>
            </th>
            <th> {{ __('Name') }} </th>
            <th> {{ __('Brand') }} </th>
            <th> {{ __('Categories') }} </th>
            <th> {{ __('Stock Qty') }} </th>
            <th> {{ __('Publish Status') }} </th>
            <th> {{ __('Status') }} </th>
            <th> {{ __('Created At') }} </th>
            <th> {{ __('Actions') }} </th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
            <tr class="table-cart-row" data-product-id-row="{{ $product->id }}">
                <td>
                    @can('product-bulk-destroy')
                        <x-product::table.bulk-delete-checkbox :id="$product->id" />
                    @endcan
                </td>
                <td>
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
                                {{ Str::limit($product->name, 25, '...') }}
                            </p>
                            <p>{{ Str::words($product->summary, 5) }}</p>
                        </div>
                    </div>
                </td>

                <td>
                    <div class="d-flex gap-2">
                        <div class="logo-brand product-brand">
                            {!! render_image($product?->brand?->logo) !!}
                        </div>
                        <b class="">{{ $product?->brand?->name }}</b>
                    </div>
                </td>

                <td>
                    <span class="category-field">
                        @if ($product?->category?->name)
                            <b> {{ __('Category') }}: </b>
                        @endif
                        {{ $product?->category?->name }}
                    </span> <br>
                    <span class="category-field">
                        @if ($product?->subCategory?->name)
                            <b> {{ __('Sub Category') }}: </b>
                        @endif
                        {{ $product?->subCategory?->name }}
                    </span><br>
                </td>

                <td>
                    <span class="quantity-number"> {{ $product?->inventory?->stock_count }}</span>
                </td>

                <td>
                    <div class="btn-group badge">
                        <button type="button"
                            class="status-{{ $product?->product_status }} {{ $product?->product_status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ ucfirst($product->product_status == 'publish' ? __('Publish') : __('Unpublish')) }}
                        </button>
                        <div class="dropdown-menu">
                            {{-- Form for activating --}}
                            <form action="{{ route('admin.products.status.change', $product->id) }}" method="POST"
                                id="status-form-activate-{{ $product->id }}">
                                @csrf
                                <input type="hidden" name="product_status" value="publish">
                                <button type="submit" class="dropdown-item">
                                    {{ __('Publish') }}
                                </button>
                            </form>
                            <form action="{{ route('admin.products.status.change', $product->id) }}" method="POST"
                                id="status-form-deactivate-{{ $product->id }}">
                                @csrf
                                <input type="hidden" name="product_status" value="unpublish">
                                <button type="submit" class="dropdown-item">
                                    {{ __('Unpublish') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </td>

                <td>

                    <div class="btn-group badge">
                        <button type="button"
                            class="status-{{ $product?->status_id }} {{ $product?->status_id == 1 ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ ucfirst($product->status_id == 1 ? __('Active') : __('Inactive')) }}
                        </button>
                        <div class="dropdown-menu">
                            {{-- Form for activating --}}
                            <form action="{{ route('admin.products.update.status') }}" method="POST"
                                id="status-form-activate-{{ $product->id }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="status_id" value="1">
                                <button type="submit" class="dropdown-item">
                                    {{ __('Active') }}
                                </button>
                            </form>
                            <form action="{{ route('admin.products.update.status') }}" method="POST"
                                id="status-form-deactivate-{{ $product->id }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="status_id" value="2">
                                <button type="submit" class="dropdown-item">
                                    {{ __('Inactive') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </td>

                <td>
                    {{ date('d-M-Y', strtotime($product->created_at)) }}
                </td>
                <td>
                    <div class="btn-group">
                        {{-- <a href="{{ route('frontend.products.single', $product->slug) }}"
                            class="btn btn-success btn-sm" title="{{ __('View Data') }}">
                            <i class="las la-eye"></i>
                        </a> --}}

                        @can('product-update')
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="btn btn-warning text-dark btn-sm" title="{{ __('Edit Product') }}">
                                <i class="las la-pencil-alt"></i>
                            </a>
                        @endcan

                        @can('product-clone')
                            <a href="{{ route('admin.products.clone', $product->id) }}" class="btn btn-secondary btn-sm"
                                title="{{ __('Duplicate Data') }}">
                                <i class="las la-copy"></i>
                            </a>
                        @endcan

                        @can('product-destroy')
                            <a data-product-url="{{ route('admin.products.destroy', $product->id) }}" href="#1"
                                class="delete-row btn btn-danger btn-sm deleted" title="{{ __('Delete Data') }}">
                                <i class="las la-trash-alt"></i>
                            </a>
                        @endcan
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-warning text-center">
                    {{ __('No Product Found') }}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- <div class="custom-pagination-wrapper">
    <div class="pagination-info d-flex gap-3">
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
            @foreach ($products['links'] as $link)
                <li>
                    <a href="{{ $link }}"
                        class="page-number {{ $loop->iteration == $products['current_page'] ? 'current' : '' }}">
                        {{ $loop->iteration }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div> --}}
