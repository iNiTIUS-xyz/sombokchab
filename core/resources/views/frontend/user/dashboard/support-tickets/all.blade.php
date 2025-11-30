@extends('frontend.user.dashboard.user-master')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
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

@section('section')
<a href="{{ route('frontend.support.ticket') }}" class="cmn_btn btn_bg_1">
    {{ __('Add New Support Ticket') }}
</a>
@if (count($all_tickets) > 0)
<div class="mt-4">
    <div class="table-responsive" style="overflow-x: unset !important;">
        <table class="table" id="dataTable">
            <thead>
                <tr>
                    <th>{{ __('Order No.') }}</th>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Date Created') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_tickets as $data)
                <tr>
                    <td>{{ $data->order_id }}</td>
                    <td>{{ $data->title }}</td>
                    <td>
                        <small>{{ $data->created_at->format('M d, Y') }}</small>
                    </td>
                    <td>
                        <span
                            class="text-capitalize badge {{ $data->status == 'close' ? 'status-close' : 'status-open' }}">
                            {{ $data->status == 'close' ? __('Closed') : __($data->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('user.dashboard.support.ticket.view', $data->id) }}"
                            class="btn btn-secondary btn-sm rounded-btn" title="{{ __('View Support Ticket') }}">
                            <i class="las la-file-alt"></i>
                        </a>
                        @if ($data->status == 'open')
                        <a href="javascript:;" class="status_change btn btn-danger btn-xs" data-id="{{ $data->id }}"
                            data-val="close" title="{{ __('Close Ticket') }}">
                            <i class="las la-times"></i>
                        </a>
                        @endif
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
@endsection

@section('script')
<script src="{{ asset('assets/frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/common/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
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
                    order: [
                        [0, 'desc']
                    ],
                    pagingType: "simple_numbers",
                    language: {
                        lengthMenu: "{{ __('_MENU_ entries per page') }}",
                        search: "{{ __('Filter:') }}",
                        info: "{{ __('Showing _START_ to _END_ of _TOTAL_ entries') }}",
                        infoEmpty: "{{ __('No entries available') }}",
                        infoFiltered: "{{ __('(filtered from _MAX_ total entries)') }}",

                        zeroRecords: "{{ __('No matching records found') }}",
                        emptyTable: "{{ __('No entries available') }}",
                        paginate: {
                            previous: "{{ __('Prev') }}",
                            next: "{{ __('Next') }}"
                        },
                        emptyTable: "{{ __('No data available in table') }}"
                    }
                });
            }
        });
</script>
<script>
    (function($) {
            "use strict";

            $(document).ready(function() {
                // Mobile navigation toggle
                $(document).on('click', '.bodyUser_overlay', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });
                $(document).on('click', '.mobile_nav', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });

                // Priority change handler
                $(document).on('click', '.change_priority', function(e) {
                    e.preventDefault();
                    var priority = $(this).data('val');
                    var id = $(this).data('id');
                    var currentPriority = $(this).parent().prev('button').text().trim();

                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('You are changing the priority to ') }}' + priority,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ee0000',
                        cancelButtonColor: '#55545b',
                        confirmButtonText: '{{ __('Yes, change it!') }}',
                        cancelButtonText: "{{ __('No') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'post',
                                url: "{{ route('user.dashboard.support.ticket.priority.change') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    priority: priority,
                                    id: id,
                                },
                                success: function(data) {
                                    if (data.success) {
                                        Swal.fire('Updated!',
                                            'Priority changed successfully.',
                                            'success');
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    }
                                }.bind(this),
                                error: function() {
                                    Swal.fire('Error!',
                                        'Failed to change priority.', 'error');
                                }
                            });
                        }
                    });
                });

                // Status change handler with SweetAlert2
                $(document).on('click', '.status_change', function(e) {
                    e.preventDefault();
                    var status = $(this).data('val');
                    var id = $(this).data('id');

                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('This action cannot be undone.') }}',
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
                                url: "{{ route('user.dashboard.support.ticket.status.change') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    status: status,
                                    id: id,
                                },
                                success: function(data) {
                                    if (data.success) {
                                        Swal.fire('Closed!', '', 'success');
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    }
                                },
                                error: function() {
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