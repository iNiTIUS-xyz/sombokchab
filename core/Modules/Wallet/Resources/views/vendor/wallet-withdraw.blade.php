@extends('vendor.vendor-master')

@section('site-title')
    {{ __('Wallet Withdrawals') }}
@endsection

@section('style')
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Your Wallet Withdrawals') }}</h4>
                    </div>
                    <div class="dashboard__card__body mt-4">

                        <div class="dashboard__card__body mt-4">
                            <div class="row g-4 justify-content-center">
                                <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                    <div class="single-orders bg-primary">
                                        <div class="orders-shapes text-white">
                                        </div>
                                        <div class="orders-flex-content">
                                            <div class="contents">
                                                <span class="order-para ff-rubik text-white">
                                                    {{ __('Available Balance for Withdraw') }} </span>
                                                <h2 class="order-titles text-white">
                                                    {{ float_amount_with_currency_symbol($current_balance) }} </h2>
                                            </div>
                                            <div class="icon text-white">
                                                <i class="las la-tasks text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                    <div class="single-orders">
                                        <div class="orders-shapes">
                                        </div>
                                        <div class="orders-flex-content">
                                            <div class="contents">
                                                <span class="order-para"> {{ __('Order Pending Balance') }} </span>
                                                <h2 class="order-titles">
                                                    {{ float_amount_with_currency_symbol($pending_balance) }} </h2>
                                            </div>
                                            <div class="icon">
                                                <i class="las la-file-invoice-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                    <div class="single-orders">
                                        <div class="orders-shapes">

                                        </div>
                                        <div class="orders-flex-content">
                                            <div class="contents">
                                                <span class="order-para ff-rubik"> {{ __('Order Completed Balance') }}
                                                </span>
                                                <h2 class="order-titles">
                                                    {{ float_amount_with_currency_symbol($total_complete_order_amount) }}
                                                </h2>
                                            </div>
                                            <div class="icon">
                                                <i class="las la-handshake"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                    <div class="single-orders bg-primary">
                                        <div class="orders-shapes">
                                        </div>
                                        <div class="orders-flex-content">
                                            <div class="contents">
                                                <span class="order-para ff-rubik text-white">
                                                    {{ __('Total Earnings from Orders') }} </span>
                                                <h2 class="order-titles text-white">
                                                    {{ float_amount_with_currency_symbol($total_order_amount) }} </h2>
                                            </div>
                                            <div class="icon text-white">
                                                <i class="las la-dollar-sign text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-5 mx-auto">
                                <div class="dashboard__card">
                                    <div class="dashboard__card__header">
                                        <h2 class="dashboard__card__title">
                                            {{ __('Withdraw Information') }}
                                        </h2>
                                    </div>
                                    <div class="dashboard__card__body custom__form mt-4">
                                        <form action="{{ route('vendor.wallet.withdraw') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>
                                                    {{ __('Withdraw Amount') }}
                                                    <span class="text-danger">*</span>
                                                    <small class="text-info">
                                                        ( Minimum withdrawal amount is =
                                                        ${{ get_static_option('minimum_withdraw_amount') }})
                                                    </small>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input name="withdraw_amount" type="number" id="withdraw_amount"
                                                    min="{{ get_static_option('minimum_withdraw_amount') }}"
                                                    max="{{ $current_balance }}" class="form-control" step="0.01"
                                                    placeholder="{{ __('Enter withdraw amount') }}"
                                                    min="{{ get_static_option('minimum_withdraw_amount') }}" required />
                                            </div>

                                            <div class="form-group">
                                                <label>
                                                    {{ __('Payment Method') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select name="gateway_name" class="form-select gateway-name" required>
                                                    <option value="" selected disabled>
                                                        {{ __('Select payment method') }}
                                                    </option>
                                                    @foreach ($vendorWalletGatewaySettingLists as $walletGateway)
                                                        <option value="{{ $walletGateway->id }}">
                                                            {{ $walletGateway->wallet_option_name }} (
                                                            {{ $walletGateway?->vendorWalletGateway?->name }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="btn-wrapper">
                                                    <button class="cmn_btn btn_bg_profile" type="submit">
                                                        {{ __('Send Withdraw Request') }}
                                                    </button>
                                                    <a href="{{ route('vendor.wallet.home') }}"
                                                        class="cmn_btn default-theme-btn"
                                                        style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                                        {{ __('Back') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="body-overlay-desktop"></div>
@endsection

@section('script')
@endsection
