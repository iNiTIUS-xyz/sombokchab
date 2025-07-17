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
                            <x-bulk-action.dropdown />
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
    <x-bulk-action.js :route="route('vendor.campaigns.bulk.action')" />

    <script>
        $(document).ready(function () {
            $(document).on('click', '.campaign_edit_btn', function () {
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
        $(document).ready(function () {
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