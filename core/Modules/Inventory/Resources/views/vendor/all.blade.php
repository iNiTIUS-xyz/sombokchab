@extends('vendor.vendor-master')

@section('site-title')
    {{ __('Product Inventory') }}
@endsection

@section('style')
    <x-datatable.css />
    <x-bulk-action.css />

    <style>
        #DataTables_Table_0_wrapper>.row:first-child {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        #DataTables_Table_0_wrapper>.row:first-child .col-12 {
            flex: 1 1 50%;
            max-width: 50%;
        }

        /* Optional: Align content inside each column */
        #DataTables_Table_0_length {
            text-align: left;
        }

        #DataTables_Table_0_filter {
            text-align: right;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Product Inventory') }}
                        </h4>
                        @can('product-inventory-delete')
                            <x-bulk-action.dropdown />
                        @endcan
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                    <x-bulk-action.th />
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('SKU') }}</th>
                                    <th>{{ __('Stock') }}</th>
                                    <th>{{ __('Sold') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_inventory_products as $inventory)
                                        <tr>
                                            <x-bulk-action.td :id="$inventory->id" />
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $inventory?->product?->name }}</td>
                                            <td>{{ $inventory->sku }}</td>
                                            <td>{{ $inventory->stock_count ?? 0 }}</td>
                                            <td>{{ $inventory->sold_count ?? 0 }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <x-table.btn.edit :route="route('vendor.products.inventory.edit', $inventory->id)" />
                                                    <x-table.btn.swal.delete :route="route('vendor.products.inventory.delete', ['id' => $inventory->id,])" />
                                                </div>
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
@endsection
    @section('script')
            <x-datatable.js />
            <x-table.btn.swal.js />
        </div>
        <x-bulk-action.js :route="route('admin.products.inventory.bulk.action')" />
    @endsection