@extends('vendor.vendor-master')
@section('site-title')
    {{ __('Vendor Create') }}
@endsection

@section('style')
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Your Wallet Withdrawals') }}</h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="row g-4 justify-content-center">
                            <div class="col-xxl-3 col-xl-4 col-sm-6 orders-child">
                                <div class="single-orders">
                                    <div class="orders-shapes">
                                    </div>
                                    <div class="orders-flex-content">
                                        <div class="contents">
                                            <span class="order-para ff-rubik"> {{ __('Current Balance') }} </span>
                                            <h2 class="order-titles">
                                                {{ float_amount_with_currency_symbol($current_balance) }} </h2>
                                        </div>
                                        <div class="icon">
                                            <i class="las la-tasks"></i>
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
                                            <span class="order-para"> {{ __('Pending Balance') }} </span>
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
                                            <span class="order-para ff-rubik"> {{ __('Order Completed Balance') }} </span>
                                            <h2 class="order-titles">
                                                {{ float_amount_with_currency_symbol($total_complete_order_amount) }} </h2>
                                        </div>
                                        <div class="icon">
                                            <i class="las la-handshake"></i>
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
                                            <span class="order-para ff-rubik"> {{ __('Total Earning') }} </span>
                                            <h2 class="order-titles">
                                                {{ float_amount_with_currency_symbol($total_order_amount) }} </h2>
                                        </div>
                                        <div class="icon">
                                            <i class="las la-dollar-sign"></i>
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
                                        {{-- <form action="{{ route('vendor.wallet.withdraw') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label>
                                                    {{ __('Withdraw Amount') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input name="withdraw_amount" type="number" id="withdraw_amount"
                                                    min="{{ get_static_option('minimum_withdraw_amount') }}"
                                                    max="{{ $current_balance }}" class="form-control"
                                                    placeholder="{{ __('Enter withdraw amount') }}" />
                                            </div>

                                            <div class="form-group">
                                                <label>{{ __('Payment Method') }}</label>
                                                <select name="gateway_name" class="form-select gateway-name">
                                                    <option value="" selected disabled>
                                                        {{ __('Select payment method') }}
                                                    </option>
                                                    @foreach ($adminGateways as $gateway)
                                                        <option
                                                            {{ $savedGateway?->vendor_wallet_gateway_id === $gateway->id ? 'selected' : '' }}
                                                            value="{{ $gateway->id }}"
                                                            data-fileds="{{ json_encode(unserialize($gateway->filed)) }}">
                                                            {{ $gateway->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group gateway-information-wrapper">
                                                @php
                                                    $gatewayFields = $savedGateway?->fileds ? unserialize($savedGateway?->fileds) : [];
                                                @endphp
                                                @foreach ($gatewayFields as $key => $value)
                                                    <div class="form-group">
                                                        <label>
                                                            {{ ucwords(str_replace('_', ' ', $key)) }}
                                                        </label>
                                                        <input type="text" name="gateway_filed[{{ $key }}]"
                                                            class="form-control" value="{{ $value }}"
                                                            placeholder="Enter {{ str_replace('_', ' ', $key) }}" />
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group">
                                                <hr>
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
                                        </form> --}}

                                        <form action="{{ route('vendor.wallet.withdraw') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label>
                                                    {{ __('Withdraw Amount') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input name="withdraw_amount" type="number" id="withdraw_amount"
                                                    min="{{ get_static_option('minimum_withdraw_amount') }}"
                                                    max="{{ $current_balance }}" class="form-control"
                                                    placeholder="{{ __('Enter withdraw amount') }}" />
                                            </div>

                                            <div class="form-group">
                                                <label>{{ __('Payment Method') }}</label>
                                                <select name="gateway_name" class="form-select gateway-name">
                                                    <option value="" selected disabled>
                                                        {{ __('Select payment method') }}
                                                    </option>
                                                    @foreach ($adminGateways as $gateway)
                                                        <option
                                                            {{ $savedGateway?->vendor_wallet_gateway_id === $gateway->id ? 'selected' : '' }}
                                                            value="{{ $gateway->id }}"
                                                            data-fileds="{{ json_encode(unserialize($gateway->filed)) }}">
                                                            {{ $gateway->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group gateway-information-wrapper">
                                                @php
                                                    $gatewayFields = $savedGateway?->fileds ? unserialize($savedGateway?->fileds) : [];
                                                @endphp
                                                @foreach ($gatewayFields as $key => $value)
                                                    @php
                                                        $label = ucwords(str_replace('_', ' ', $key));
                                                        if ($label === 'Account Name') {
                                                            $label = 'Account Holder Full Name';
                                                        }
                                                    @endphp
                                                    <div class="form-group">
                                                        <label>
                                                            {{ $label }}
                                                        </label>
                                                        <input type="text" name="gateway_filed[{{ $key }}]"
                                                            class="form-control" value="{{ $value }}"
                                                            placeholder="Enter {{ str_replace('_', ' ', $key) }}" />
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group">
                                                <hr>
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
    <script>
        $(document).on("change", ".gateway-name", function() {
            let gatewayInformation = "";
            $(".gateway-information-wrapper").fadeOut(150);

            JSON.parse($(this).find(":selected").attr("data-fileds")).forEach(function(value, index) {
                let gateway_name = value.toLowerCase().replaceAll(" ", "_").replaceAll("-", "_");

                gatewayInformation += `
                    <div class="form-group">
                        <label>
                            ${ value }
                            <input type="text" name="gateway_filed[${ gateway_name }]" class="form-control" placeholder="Enter ${ value.toLowerCase() }" />
                        </label>
                    </div>
                `;
            })

            $(".gateway-information-wrapper").html(gatewayInformation);
            $(".gateway-information-wrapper").fadeIn(250);
        })
    </script>
@endsection
