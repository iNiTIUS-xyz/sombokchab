@extends('backend.admin-master')

@section('site-title')
    {{ __('Product Inventory') }}
@endsection

@section('style')
    <x-bulk-action.css />
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Product Inventory') }}</h4>
                        @can('product-inventory-delete')
                            <x-bulk-action.dropdown />
                        @endcan
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    @can('product-inventory-bulk-action')
                                        <x-bulk-action.th />
                                    @endcan
                                    {{-- <th>{{ __('ID') }}</th> --}}
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('SKU') }}</th>
                                    <th>{{ __('Stock') }}</th>
                                    <th>{{ __('Sold') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_inventory_products as $inventory)
                                        <tr>
                                            @can('product-inventory-bulk-action')
                                                <x-bulk-action.td :id="$inventory->id" />
                                            @endcan
                                            {{-- <td>{{ $inventory->id }}</td> --}}
                                            <td>{{ $inventory?->product?->name }}</td>
                                            <td>{{ $inventory->sku }}</td>
                                            <td>{{ $inventory->stock_count ?? 0 }}</td>
                                            <td>{{ $inventory->sold_count ?? 0 }}</td>
                                            <td>
                                                @can('product-inventory-edit')
                                                    <x-table.btn.edit :route="route('admin.products.inventory.edit', $inventory->id)" />
                                                @endcan
                                                @can('product-inventory-delete')
                                                                                <x-table.btn.swal.delete :route="route('admin.products.inventory.delete', [
                                                        'id' => $inventory->id,
                                                    ])" />
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <x-table.btn.swal.js />
    @can('product-inventory-bulk-action')
        <x-bulk-action.js :route="route('admin.products.inventory.bulk.action')" />
    @endcan
@endsection