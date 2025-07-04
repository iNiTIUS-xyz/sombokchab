@extends('vendor.vendor-master')

@section('site-title')
    {{ __('All Tickets') }}
@endsection

@section('style')
    <x-datatable.css />
    <x-bulk-action.css />
@endsection

@section('content')
    <style>
        .swal_delete_button {
            margin: 0px !important
        }

        .badge.status-open {
            display: inline-block;
            background-color: #41695A;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            border: none;
            font-weight: 600;
        }

        .badge.status-close {
            display: inline-block;
            background-color: #dd0303;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            border: none;
            font-weight: 600;
        }

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

    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.flash />
                <x-msg.error />
                <div class="btn-wrapper mb-4">
                    <a href="{{ route('vendor.support.ticket.new') }}"
                        class="cmn_btn btn_bg_profile">{{ __('Add New Support Tickets') }}
                    </a>
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Support Tickets') }}</h4>
                        <div class="dashboard__card__header__right">
                            <x-bulk-action.dropdown />
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        @if (count($all_tickets) > 0)
                            <div class="table-wrap mt-4">
                                <div class="table-responsive" style="overflow-x: unset !important;">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('ID') }}</th>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Department') }}</th>
                                                <th>{{ __('Date Created') }}</th>
                                                <th>{{ __('Priority') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_tickets as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->title }}</td>
                                                    <td>{{ $data->department->name ?? __('anonymous') }}</td>
                                                    <td><small>{{ $data->created_at->format('M j, Y') }}</small></td>
                                                    <td class="text-capitalize">{{ ucfirst($data->priority) }}</td>
                                                    <td>
                                                        <span
                                                            class="text-capitalize badge {{ $data->status == 'close' ? 'status-close' : 'status-open' }}">
                                                            {{ $data->status == 'close' ? __('Closed') : __($data->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if ($data->status == 'open')
                                                            <a href="#1" class="ticket_status_change btn btn-danger btn-xs"
                                                                data-id="{{ $data->id }}" data-val="close" title="Close Ticket">
                                                                <i class="las la-times"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('vendor.support.ticket.view', $data->id) }}"
                                                            class="btn btn-primary btn-xs" target="_blank"
                                                            title="View Support Ticket">
                                                            <i class="las la-eye"></i>
                                                        </a>

                                                        <x-delete-popover :url="route('vendor.support.ticket.delete', $data->id)"
                                                            style="margin: 0px !important" />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="nothing-found mt-4">
                                <div class="alert alert-warning">
                                    {{ __('No support ticket found.') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <x-bulk-action.js :route="route('vendor.support.ticket.bulk.action')" />
    <x-datatable.js />
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>

    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                $('.table-wrap table').DataTable({
                    "order": [
                        [1, "desc"]
                    ],
                    'columnDefs': [{
                        'targets': 'no-sort',
                        'orderable': false
                    }]
                });

                // Status change handler with SweetAlert2
                $(document).on('click', '.ticket_status_change', function (e) {
                    e.preventDefault();
                    var status = $(this).data('val');
                    var id = $(this).data('id');

                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('You would not be able to revert this item!') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ee0000',
                        cancelButtonColor: '#55545b',
                        confirmButtonText: '{{ __('Yes, close it!') }}',
                        cancelButtonText: "{{ __('No') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'post',
                                url: "{{ route('vendor.support.ticket.status.change') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    status: status,
                                    id: id,
                                },
                                success: function (data) {
                                    if (data.success) {
                                        Swal.fire('Closed!', '', 'success');
                                        setTimeout(function () {
                                            location.reload();
                                        }, 1000);
                                    }
                                },
                                error: function () {
                                    Swal.fire('Error!', 'Failed to change status.',
                                        'error');
                                }
                            });
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endsection