@extends('vendor.vendor-master')
@section('site-title')
    {{ __('Vendor withdraw settings') }}
@endsection
@section('style')
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="cdashboard__card__header">
                        <h2 class="dashboard__card__title">{{ __('Payment Method Settings') }}</h2>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form method="post" action="{{ route('vendor.wallet.withdraw.gateway.update') }}"
                            id="withdraw-gateway-update">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>
                                    {{ __('Payment Method') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="gateway_name" class="form-select gateway-name">
                                    <option value="" selected disabled>
                                        {{ __('Select Payment Method') }}
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
                                    $gatewayFields = $adminGateways->find($savedGateway?->vendor_wallet_gateway_id);
                                    $fileds = $savedGateway?->fileds ? unserialize($savedGateway?->fileds) : [];
                                @endphp
                                @foreach (($gatewayFields?->filed ? unserialize($gatewayFields?->filed) : []) ?? [] as $key => $filed)
                                    @php
                                        $filed_name = ucfirst($filed);
                                        $key = str_replace(' ', '_', strtolower($filed));
                                        $filed = $fileds[$key] ?? '';
                                        // Replace "Account Name" with "Account Holder Full Name"
                                        $label =
                                            $filed_name === 'Account Name' ? 'Account Holder Full Name' : $filed_name;
                                    @endphp
                                    <div class="form-group">
                                        <label>
                                            {{ $label }}
                                        </label>
                                        <input type="text" name="gateway_filed[{{ $key }}]"
                                            class="form-control" value="{{ $filed }}"
                                            placeholder="Enter {{ str_replace('_', ' ', $filed_name) }}" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button type="submit" class="cmn_btn btn_bg_profile"> {{ __('Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="body-overlay-desktop"></div>
    <x-media.markup />
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
