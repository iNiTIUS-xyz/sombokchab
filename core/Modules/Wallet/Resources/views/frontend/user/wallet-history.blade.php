@extends('frontend.user.dashboard.user-master')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <style>
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 500px !important;
                margin: 16.5rem auto !important;
            }
        }
    </style>
@endsection

@section('site-title')
    {{ __('My Orders') }}
@endsection

@section('section')
    <div class="wallet__history">
        <x-msg.error />
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="{{ asset('assets/frontend/img/static/orders-shapes3.png') }}" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="contents">
                            <h2 class="order-titles">
                                {{ float_amount_with_currency_symbol($total_wallet_balance) }}
                            </h2>
                            <span class="order-para">{{ __('Wallet Balance') }} </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="dashboard__card__header dashboard-settings">
                    <div class="dashboard__card__header__left">
                        <h4 class="dashboard__card__title">{{ __('Wallet History') }} </h4>
                        <div class="notice-board">
                            <p class="dashboard__card__para text-danger">
                                {{ __('You can deposit to your wallet from here.') }}
                            </p>
                        </div>
                    </div>
                    <button type="button" class="cmn_btn btn_bg_1" data-bs-toggle="modal"
                        data-bs-target="#payoutRequestModal">{{ __('Deposit to Your Wallet') }}</button>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="single-dashboard-order table-wrap">
                    <div class="table-responsive table-responsive--md">
                        <table class="table-responsive table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{ __('Sub Order ID') }}</th>
                                    <th>{{ __('Transaction ID') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Date Time') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $history)
                                    <tr>
                                        <td>
                                            {{ $history->sub_order_id ? '#' . $history->sub_order_id : '' }}</td>
                                        <td>{{ $history->transaction_id ?? '' }}</td>
                                        <td>
                                            {{ $history->amount ? float_amount_with_currency_symbol($history->amount) : '' }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $history->type == 4 || $history->type == 1 ? 'success' : ($history->type == 5 ? 'danger' : 'warning') }}">
                                                @if ($history->type == 4)
                                                    {{ __('Deposit') }}
                                                @elseif($history->type == 5)
                                                    {{ __('Due') }}
                                                @elseif($history->type == 1)
                                                    {{ __('Incoming') }}
                                                @else
                                                    {{ __('Outgoing') }}
                                                @endif

                                            </span>
                                        </td>
                                        <td>
                                            {{ $history->created_at->format('M j, Y') }}
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
    <!--Status Modal -->
    <div class="modal fade" id="payoutRequestModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
        aria-hidden="true">
        <form action="{{ route('user-home.wallet.deposit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="couponModal">
                            {{ __('Deposit to your wallet') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <label for="">{{ __('Deposit Amount') }}</label> --}}
                        <input type="number" class="form-control" name="amount"
                            placeholder="{{ __('Enter deposit amount') }}">
                        <div class="confirm-bottom-content">
                            <br>
                            {!! render_payment_gateway_for_form() !!}
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-tow">
                        <button type="submit" class="btn btn-primary">{{ __('Confirm') }}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Close') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@section('script')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
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

    <script>
        (function($) {
            "use strict";

            $(document).on('click', '.payment-gateway-wrapper > ul > li', function(e) {
                e.preventDefault();

                let gateway = $(this).data('gateway');
                if (gateway === 'manual_payment') {
                    $('.manual_transaction_id').removeClass('d-none');
                } else {
                    $('.manual_transaction_id').addClass('d-none');
                }

                $(this).addClass('selected').siblings().removeClass('selected');
                $('.payment-gateway-wrapper').find(('input')).val($(this).data('gateway'));
                $('.payment_gateway_passing_clicking_name').val($(this).data('gateway'));
            });


            $(document).ready(function() {

                $(document).on('click', '.bodyUser_overlay', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });
                $(document).on('click', '.mobile_nav', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });

                $(document).on('click', '.edit_status_modal', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    let status = $(this).data('status');

                    $('#order_id').val(order_id);
                    $('#status').val(status);
                    $('.nice-select').niceSelect('update');
                });

            });

        })(jQuery);
    </script>
@endsection
