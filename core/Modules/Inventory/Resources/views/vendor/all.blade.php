@extends('vendor.vendor-master')

@section('site-title')
    {{ __('Product Inventory') }}
@endsection

@section('style')
    <x-bulk-action.css />

    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">

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
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    <x-bulk-action.th />
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
    </div>
@endsection

@section('script')
    {{-- <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function () {
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
                    // Add this for pagination style
                    pagingType: "simple_numbers" // options: simple, simple_numbers, full, full_numbers
                });
            }
        });
    </script>

    <x-table.btn.swal.js />
    <x-bulk-action.js :route="route('admin.products.inventory.bulk.action')" />
@endsection