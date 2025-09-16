@extends('vendor.vendor-master')

@section('site-title')
    {{ __('Product Inventory') }}
@endsection

@section('style')
    <x-bulk-action.css />

    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
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
                        <div class="bulk-delete-wrapper my-3">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value="">{{ __('Bulk Action') }}</option>
                                    <option value="delete">{{ __('Delete') }}</option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn">
                                    {{ __('Apply') }}
                                </button>
                            </div>
                        </div>
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
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

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
                        search: "Filter:"
                    }
                });
            }
        });
    </script>
    <x-table.btn.swal.js />
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
                            text: '{{ __('This action cannot be undone.') }}',
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
                                    url: "{{ route('vendor.products.inventory.bulk.action') }}",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        ids: allIds,
                                    },
                                    success: function(data) {
                                        Swal.fire(
                                            '{{ __('Deleted!') }}',
                                            '{{ __('Selected tickets have been deleted.') }}',
                                            'success'
                                        );
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    },
                                    error: function() {
                                        Swal.fire(
                                            'Error!',
                                            'Failed to delete tickets.',
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
@endsection
