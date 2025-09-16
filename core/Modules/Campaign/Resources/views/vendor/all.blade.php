@extends('vendor.vendor-master')

@section('site-title')
    {{ __('All Campaigns') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
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
                <div class="btn-wrapper mb-4">
                    <a href="{{ route('vendor.campaigns.new') }}"
                        class="cmn_btn btn_bg_profile">{{ __('Add New Campaign') }}</a>
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Campaigns') }}</h4>
                        <div class="dashboard__card__header__right">
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
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    <x-bulk-action.th />
                                    <th>{{ __('Campaign Name') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_campaigns as $campaign)
                                        <tr>
                                            <x-bulk-action.td :id="$campaign->id" />
                                            <td>{{ $campaign->title }}</td>
                                            <x-table.td-image :image="$campaign->image" />
                                            <td><x-status-span :status="$campaign->status" /></td>
                                            <td>
                                                <a class="btn btn-primary btn-xs mb-2 me-1" title="{{ __('View') }}"
                                                    href="{{ route('frontend.products.campaign', ['id' => $campaign->id, 'slug' => $campaign->slug]) }}">
                                                    <i class="ti-eye"></i>
                                                </a>

                                                <x-table.btn.edit :route="route('vendor.campaigns.edit', $campaign->id)" />

                                                <x-delete-popover :url="route('vendor.campaigns.delete', $campaign->id)" />
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
                                    url: "{{ route('vendor.campaigns.bulk.action') }}",
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

    <script>
        $(document).ready(function() {
            $(document).on('click', '.campaign_edit_btn', function() {
                let el = $(this);
                let id = el.data('id');
                let name = el.data('name');
                let modal = $('#campaign_edit_modal');

                modal.find('#campaign_id').val(id);
                modal.find('#edit_name').val(name);

                modal.show();
            });
        });
    </script>

    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable only if the table exists
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
@endsection
