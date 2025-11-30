@extends('backend.admin-master')

@section('site-title')
{{ __('Inventory Management') }}
@endsection

@section('style')
<x-bulk-action.css />
<style>
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
            {{--
            <x-msg.error />
            <x-msg.flash /> --}}
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title">{{ __('Inventory Management') }}</h4>
                    @can('delete-product-inventory')
                    <x-bulk-action.dropdown />
                    @endcan
                </div>
                <div class="dashboard__card__body mt-4">
                    <div class="table-responsive">
                        <table class="table" id="dataTable">
                            <thead>
                                @can('view-product-inventory')
                                <x-bulk-action.th />
                                @endcan
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('SKU') }}</th>
                                <th>{{ __('Stock') }}</th>
                                <th>{{ __('Sold') }}</th>
                                <th>{{ __('Action') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($all_inventory_products as $inventory)
                                <tr>
                                    @can('view-product-inventory')
                                    <x-bulk-action.td :id="$inventory->id" />
                                    @endcan
                                    <td>{{ $inventory?->product?->name }}</td>
                                    <td>{{ $inventory->sku }}</td>
                                    <td>{{ $inventory->stock_count ?? 0 }}</td>
                                    <td>{{ $inventory->sold_count ?? 0 }}</td>
                                    <td>
                                        @can('edit-product-inventory')
                                        <x-table.btn.edit
                                            :route="route('admin.products.inventory.edit', $inventory->id)" />
                                        @endcan
                                        @can('delete-product-inventory')
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
@can('view-product-inventory')
<script>
    (function($) {
                $(document).ready(function() {
                    $(document).on('click', '#bulk_delete_btn', function(e) {
                        e.preventDefault();

                        var bulkOption = $('#bulk_option').val();
                        var allCheckbox = $('.bulk-checkbox:checked');
                        var allIds = [];

                        allCheckbox.each(function(index, value) {
                            allIds.push($(this).val());
                        });

                        if (allIds.length > 0 && bulkOption == 'delete') {
                            Swal.fire({
                                title: '{{ __('Are you sure?') }}',
                                text: '{{ __('You would not be able to revert this action!') }}',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#ee0000',
                                cancelButtonColor: '#55545b',
                                confirmButtonText: '{{ __('Yes, delete them!') }}',
                                cancelButtonText: "{{ __('No') }}"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#bulk_delete_btn').text('{{ __('Deleting...') }}');

                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin.products.inventory.bulk.action') }}",
                                        data: {
                                            _token: "{{ csrf_token() }}",
                                            ids: allIds,
                                        },
                                        success: function(data) {

                                            Swal.fire(
                                                '{{ __('Deleted!') }}',
                                                '{{ __('Selected data have been deleted.') }}',
                                                'success'
                                            );
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        },
                                        error: function() {
                                            Swal.fire(
                                                'Error!',
                                                'Failed to delete data.',
                                                'error'
                                            );
                                        }
                                    });
                                }
                            });
                        } else {
                            Swal.fire(
                                'Warning!',
                                '{{ __('Please select at least one item and choose delete option.') }}',
                                'warning'
                            );
                        }
                    });

                    // Handle "select all" checkbox
                    $('.all-checkbox').on('change', function(e) {
                        e.preventDefault();
                        var value = $(this).is(':checked');
                        var allChek = $(this).closest('table').find('.bulk-checkbox');

                        allChek.prop('checked', value);
                    });
                });
            })(jQuery);
</script>
@endcan
@endsection