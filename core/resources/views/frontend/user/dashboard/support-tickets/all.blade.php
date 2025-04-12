@extends('frontend.user.dashboard.user-master')
@section('style')
    <style>
        button.low,
        button.status-open {
            display: inline-block;
            background-color: #6bb17b;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            text-transform: capitalize;
            border: none;
            font-weight: 600;
        }

        button.high,
        button.status-close {
            display: inline-block;
            background-color: #c66060;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            text-transform: capitalize;
            border: none;
            font-weight: 600;
        }

        button.medium {
            display: inline-block;
            background-color: #70b9ae;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            text-transform: capitalize;
            border: none;
            font-weight: 600;
        }

        button.urgent {
            display: inline-block;
            background-color: #bfb55a;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            text-transform: capitalize;
            border: none;
            font-weight: 600;
        }
    </style>
@endsection
@section('section')
    <a href="{{ route('frontend.support.ticket') }}" class="cmn_btn btn_bg_2">{{ __('New Ticket') }}</a>
    @if (count($all_tickets) > 0)
        <div class="table-wrap mt-4">
            <div class="table-responsive" style="overflow-x: unset !important;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Order No.') }}</th>
                            <th>{{ __('Title') }}</th>
                            {{-- <th>{{ __('Priority') }}</th> --}}
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_tickets as $data)
                            <tr>
                                <td>#{{ $data->id }}</td>
                                <td>#{{ $data->order_id }}</td>
                                <td>{{ $data->title }}
                                    <p>{{ __('created at:') }} <small>{{ $data->created_at->format('D, d M Y') }}</small>
                                    </p>
                                </td>
                                {{-- <td>
                                    <div class="btn-group">
                                        <button type="button" class="{{ $data->priority }} dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ __($data->priority) }}
                                        </button>
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
                                    </div>
                                </td> --}}
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="status-{{ $data->status }} dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ __($data->status) }}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item status_change" data-id="{{ $data->id }}"
                                                data-val="open" href="#1">{{ __('Open') }}</a>
                                            <a class="dropdown-item status_change" data-id="{{ $data->id }}"
                                                data-val="close" href="#1">{{ __('Close') }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('user.dashboard.support.ticket.view', $data->id) }}"
                                        class="btn btn-primary btn-xs" target="_blank"><i class="las la-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="blog-pagination">
                {{ $all_tickets->links() }}
            </div>
        </div>
    @else
        <div class="nothing-found mt-4">
            <div class="alert alert-warning">{{ __('Nothing Found') }}</div>
        </div>
    @endif
@endsection

@section('script')
    <script src="{{ asset('assets/frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/common/js/bootstrap.min.js') }}"></script>

    <script>
        (function() {
            "use strict";

            $(document).ready(function() {
                $(document).on('click', '.bodyUser_overlay', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });
                $(document).on('click', '.mobile_nav', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });
            });

            $(document).on('click', '.change_priority', function(e) {
                e.preventDefault();
                //get value
                var priority = $(this).data('val');
                var id = $(this).data('id');
                var currentPriority = $(this).parent().prev('button').text();
                currentPriority = currentPriority.trim();
                $(this).parent().prev('button').removeClass(currentPriority).addClass(priority).text(priority);
                //ajax call
                $.ajax({
                    'type': 'post',
                    'url': "{{ route('user.dashboard.support.ticket.priority.change') }}",
                    'data': {
                        _token: "{{ csrf_token() }}",
                        priority: priority,
                        id: id,
                    },
                    success: function(data) {
                        $(this).parent().find('button.' + currentPriority).removeClass(
                            currentPriority).addClass(priority).text(priority);
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
                $(this).parent().prev('button').removeClass('status-' + currentStatus).addClass('status-' +
                    status).text(status);
                //ajax call
                $.ajax({
                    'type': 'post',
                    'url': "{{ route('user.dashboard.support.ticket.status.change') }}",
                    'data': {
                        _token: "{{ csrf_token() }}",
                        status: status,
                        id: id,
                    },
                    success: function(data) {
                        $(this).parent().prev('button').removeClass(currentStatus).addClass(status)
                            .text(status);
                    }
                })
            });


        })(jQuery);
    </script>
@endsection
