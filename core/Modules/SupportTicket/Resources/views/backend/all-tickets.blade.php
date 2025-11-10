@extends('backend.admin-master')

@section('site-title')
    {{ __('Customer Support Tickets') }}
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
                        <h4 class="dashboard__card__title">{{ __('Customer Support Tickets') }}</h4>
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
                                    <th class="text-center">{{ __('Ticket ID') }}</th>
                                    <th class="text-center">{{ __('Title') }}</th>
                                    <th class="text-center">{{ __('Department') }}</th>
                                    <th class="text-center">{{ __('Customer') }}</th>
                                    <th class="text-center">{{ __('Priority') }}</th>
                                    <th class="text-center">{{ __('Status') }}</th>
                                    <th class="text-center">{{ __('Created At') }}</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_tickets as $data)
                                        <tr>
                                            @can('support-tickets-bulk-action')
                                                <x-bulk-action.td :id="$data->id" />
                                            @endcan
                                            <td>{{ $data->id }}</td>
                                            <td>{{ $data->title }}</td>
                                            <td>{{ $data->department?->name }}</td>
                                            <td>
                                                {{ $data->user?->name }}
                                            </td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button" class="{{ $data->priority }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        style="width: 90px; text-align: left;">
                                                        {{ $data->priority ? ucfirst($data->priority) : 'Set Priority' }}
                                                    </button>
                                                    @can('support-tickets-priority-change')
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item change_priority"
                                                                data-id="{{ $data->id }}" data-val="low"
                                                                href="javascript:;">
                                                                {{ __('Low') }}
                                                            </a>
                                                            <a class="dropdown-item change_priority"
                                                                data-id="{{ $data->id }}" data-val="medium"
                                                                href="javascript:;">
                                                                {{ __('Medium') }}
                                                            </a>
                                                            <a class="dropdown-item change_priority"
                                                                data-id="{{ $data->id }}" data-val="high"
                                                                href="javascript:;">
                                                                {{ __('High') }}
                                                            </a>
                                                            <a class="dropdown-item change_priority"
                                                                data-id="{{ $data->id }}" data-val="urgent"
                                                                href="javascript:;">
                                                                {{ __('Urgent') }}
                                                            </a>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $data->status }} {{ $data->status == 'close' ? __('bg-danger status-close') : __('bg-primary status-open') }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ ucfirst($data->status == 'close' ? __('Closed') : __($data->status)) }}
                                                    </button>
                                                    @can('support-tickets-status-change')
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item status_change"
                                                                data-id="{{ $data->id }}" data-val="open"
                                                                href="javascript:;">
                                                                {{ __('Open') }}
                                                            </a>
                                                            <a class="dropdown-item status_change"
                                                                data-id="{{ $data->id }}" data-val="close"
                                                                href="javascript:;">
                                                                {{ __('Close') }}
                                                            </a>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </td>
                                            <td>
                                                {{ date('M j, Y', strtotime($data->created_at)) }}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @can('support-tickets-bulk-action')
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
                                        url: "{{ route('admin.support.ticket.bulk.action') }}",
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

    <script>
        (function() {
            "use strict";

            $(document).on('click', '.change_priority', function(e) {
                e.preventDefault();
                //get value
                var priority = $(this).data('val');
                var id = $(this).data('id');
                var currentPriority = $(this).parent().prev('button').text();
                currentPriority = currentPriority.trim();

                // Capitalize first letter of the new priority
                // var capitalizedPriority = priority.charAt(0).toUpperCase() + priority.slice(1);
                var capitalizedPriority = priority ? priority.charAt(0).toUpperCase() + priority.slice(1) :
                    'Set Priority';

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
                    success: function(data) {
                        if (data == 'ok') {
                            toastr.success('Support ticket priority changed successfully.');

                            setTimeout(function() {
                                location.reload();
                            }, 800);
                        }
                    }
                })
            });

            $(document).on('click', '.status_change', function(e) {
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
                    success: function(data) {

                        if (data == 'ok') {
                            toastr.success('Support ticket status changed successfully.');

                            setTimeout(function() {
                                location.reload();
                            }, 800);
                        }
                    }
                })
            });
        })(jQuery);
    </script>
@endsection
