@extends('vendor.vendor-master')

@section('site-title')
    {{ __('Product Inventory') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <x-bulk-action.css />

    <style>
        #dataTable th,
        #dataTable td {
            text-align: left !important;
            vertical-align: middle;
        }

        #dataTable {
            width: 100%;
            border-collapse: collapse;
        }

        #dataTable th {
            font-weight: 600;
        }

        table.dataTable th.dt-type-numeric div.dt-column-header,
        table.dataTable th.dt-type-numeric div.dt-column-footer,
        table.dataTable th.dt-type-date div.dt-column-header,
        table.dataTable th.dt-type-date div.dt-column-footer,
        table.dataTable td.dt-type-numeric div.dt-column-header,
        table.dataTable td.dt-type-numeric div.dt-column-footer,
        table.dataTable td.dt-type-date div.dt-column-header,
        table.dataTable td.dt-type-date div.dt-column-footer {
            flex-direction: row !important;
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
                        @can('delete-product-inventory')
                            <x-bulk-action.dropdown />
                        @endcan
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    <x-bulk-action.th />
                                    <th style="width: 50%">{{ __('Name') }}</th>
                                    <th style="width: 10%">{{ __('SKU') }}</th>
                                    <th style="width: 10%">{{ __('Stock') }}</th>
                                    <th style="width: 10%">{{ __('Sold') }}</th>
                                    <th style="width: 10%">{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_inventory_products as $inventory)
                                        <tr>
                                            <x-bulk-action.td :id="$inventory->id" />
                                            <td>{{ $inventory?->product?->name }}</td>
                                            <td>{{ $inventory->sku }}</td>
                                            <td>{{ $inventory->stock_count ?? 0 }}</td>
                                            <td>{{ $inventory->sold_count ?? 0 }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <x-table.btn.edit :route="route('vendor.products.inventory.edit', $inventory->id)" />
                                                    <x-table.btn.swal.delete :route="route('vendor.products.inventory.delete', [
                                                        'id' => $inventory->id,
                                                    ])" />
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
    </div>
@endsection

@section('script')
    <x-table.btn.swal.js />
    <x-bulk-action.js :route="route('admin.products.inventory.bulk.action')" />
    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    paging: true,
                    lengthChange: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    responsive: true,
                    language: {
                        search: "Filter:",
                        paginate: {
                            previous: "Prev",
                            next: "Next"
                        }
                    },
                    pagingType: "simple_numbers"
                });
            }
        });
    </script>
@endsection
