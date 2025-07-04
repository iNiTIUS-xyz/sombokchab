@extends('backend.admin-master')

@section('site-title')
    {{ __('All Tickets') }}
@endsection

@section('style')
    <x-bulk-action.css />
    <style>
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
    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.flash />
                <x-msg.error />
                @can('support-tickets-create')
                    <div class="btn-wrapper d-flex mb-4">
                        <a href="{{ route('admin.support.ticket.new') }}" class="cmn_btn btn_bg_profile">
                            {{ __('Add New Ticket') }}
                        </a>
                    </div>
                @endcan
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Support Tickets') }}</h4>
                        <div class="dashboard__card__header__right d-flex">
                            @can('support-tickets-bulk-action')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-default">
                                <thead class="text-center">
                                    @can('support-tickets-bulk-action')
                                        <x-bulk-action.th />
                                    @endcan
                                    <th class="text-center">{{ __('Serial No.') }}</th>
                                    <th class="text-center">{{ __('Title') }}</th>
                                    <th class="text-center">{{ __('Department') }}</th>
                                    <th class="text-center">{{ __('User') }}</th>
                                    <th class="text-center">{{ __('Priority') }}</th>
                                    <th class="text-center">{{ __('Status') }}</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_tickets as $data)
                                        <tr>
                                            @can('support-tickets-bulk-action')
                                                <x-bulk-action.td :id="$data->id" />
                                            @endcan
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->title }}</td>
                                            <td>{{ $data->department->name ?? __('anonymous') }}</td>
                                            <td>
                                                {{ $data->user->name ?? __('anonymous') }}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="{{ $data->priority }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ ucfirst($data->priority) }}
                                                    </button>
                                                    @can('support-tickets-priority-change')
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item change_priority" data-id="{{ $data->id }}"
                                                                data-val="low" href="#1">{{ __('Low') }}</a>
                                                            <a class="dropdown-item change_priority" data-id="{{ $data->id }}"
                                                                data-val="high" href="#1">{{ __('High') }}</a>
                                                            <a class="dropdown-item change_priority" data-id="{{ $data->id }}"
                                                                data-val="medium" href="#1">{{ __('Medium') }}</a>
                                                            <a class="dropdown-item change_priority" data-id="{{ $data->id }}"
                                                                data-val="urgent" href="#1">{{ __('Urgent') }}</a>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-capitalize badge {{ $data->status == 'close' ? 'status-close' : 'status-open' }}">
                                                    {{ $data->status == 'close' ? __('Closed') : __($data->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @can('support-tickets-view')
                                                    <x-view-icon :url="route('admin.support.ticket.view', $data->id)" />
                                                @endcan
                                                @can('support-tickets-delete')
                                                    <x-delete-popover :url="route('admin.support.ticket.delete', $data->id)" />
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $all_tickets->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @can('support-tickets-bulk-action')
        <x-bulk-action.js :route="route('admin.support.ticket.bulk.action')" />
    @endcan

    <script>
        (function () {
            "use strict";

            $(document).on('click', '.change_priority', function (e) {
                e.preventDefault();
                //get value
                var priority = $(this).data('val');
                var id = $(this).data('id');
                var currentPriority = $(this).parent().prev('button').text();
                currentPriority = currentPriority.trim();

                // Capitalize first letter of the new priority
                var capitalizedPriority = priority.charAt(0).toUpperCase() + priority.slice(1);

                $(this).parent().prev('button')
                    .removeClass(currentPriority.toLowerCase())
                    .addClass(priority)
                    .text(capitalizedPriority);

                //ajax call
                $.ajax({
                    'type': 'post',
                    'url': "{{ route('admin.support.ticket.priority.change') }}",
                    'data': {
                        _token: "{{ csrf_token() }}",
                        priority: priority,
                        id: id,
                    },
                    success: function (data) {
                        // Success callback if needed
                    }
                })
            });

            $(document).on('click', '.status_change', function (e) {
                e.preventDefault();
                //get value
                var status = $(this).data('val');
                var id = $(this).data('id');
                var currentStatus = $(this).parent().prev('button').text();
                currentStatus = currentStatus.trim();

                // Capitalize first letter of the new status
                var capitalizedStatus = status.charAt(0).toUpperCase() + status.slice(1);

                $(this).parent().prev('button')
                    .removeClass('status-' + currentStatus.toLowerCase())
                    .addClass('status-' + status)
                    .text(capitalizedStatus);

                //ajax call
                $.ajax({
                    'type': 'post',
                    'url': "{{ route('admin.support.ticket.status.change') }}",
                    'data': {
                        _token: "{{ csrf_token() }}",
                        status: status,
                        id: id,
                    },
                    success: function (data) {
                        // Success callback if needed
                    }
                })
            });
        })(jQuery);
    </script>
@endsection