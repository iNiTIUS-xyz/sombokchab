@extends('frontend.user.dashboard.user-master')
@section('style')
    <x-datatable.css />
@endsection
@section('site-title')
    {{ __('My Orders') }}
@endsection
@section('section')
    <div class="dashboard__card__refund">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title">{{ __('My Refund Requests') }}</h3>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="table-wrap table-responsive all-user-campaign-table">
                <div class="order-history-inner">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('SL No.') }}</th>
                                <th>{{ __('Order Info') }}</th>
                                <th>{{ __('Refund Info') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($refundRequests as $request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <span class="user-info">
                                            <b>{{ $request->order?->id }}</b><br>
                                            {{ __('Status') }}:
                                            @if ($request->order?->order_status == 'complete')
                                                <span class="badge bg-success px-2 py-1">{{ __('Complete') }}</span>
                                            @elseif ($request->order?->order_status == 'pending')
                                                <span class="badge bg-warning px-2 py-1">{{ __('Pending') }}</span>
                                            @elseif ($request->order?->order_status == 'failed')
                                                <span class="badge bg-danger px-2 py-1">{{ __('Failed') }}</span>
                                            @elseif ($request->order?->order_status == 'canceled')
                                                <span class="badge bg-danger px-2 py-1">{{ __('Canceled') }}</span>
                                            @elseif ($request->order?->order_status == 'rejected')
                                                <span class="badge px-2 py-1"
                                                    style="background: rgb(138, 1, 14) !important;">{{ __('Rejected') }}</span>
                                            @endif
                                            <br>
                                            {{-- <span class="text-capitalize badge bg-light text-dark">{{ $request->order?->order_status }}</span> <br> --}}
                                            {{ __('Amount') }}
                                            {{ float_amount_with_currency_symbol($request->order?->paymentMeta?->total_amount) }}<br>
                                        </span>
                                    </td>

                                    <td>
                                        <span class="user-info ">
                                            <b>#{{ $request->id }}</b><br>
                                            {{ __('Status') }}:
                                            <span
                                                class="badge bg-light text-dark">{{ __(ucwords(str_replace('_', ' ', $request->currentTrackStatus?->name))) }}</span>
                                            <br>
                                            {{ __('Total Product:') }} {{ $request->request_product_count }}<br>
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('user.product.refund-request.view', $request->id) }}"
                                            class="btn btn-secondary btn-sm rounded-btn" title="View Details"
                                            style="width: 40px;">
                                            {{-- {{ __('View Details') }} --}}
                                            <i class="las la-file-alt"></i>
                                        </a>
                                        <a class="btn btn-secondary btn-sm rounded-btn"
                                            href="{{ route('user.product.refund-request.view', $request->id) }}">
                                            {{ __('View Details') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination">
                {!! $refundRequests->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                $(document).on('click', '.bodyUser_overlay', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });
                $(document).on('click', '.mobile_nav', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });

                $(document).on('click', '.swal_delete_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('This action cannot be undone.') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ee0000',
                        cancelButtonColor: '#55545b',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });
            })
        })(jQuery)
    </script>

    <x-datatable.js />
@endsection
