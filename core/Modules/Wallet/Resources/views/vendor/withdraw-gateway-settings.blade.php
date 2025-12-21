@extends('vendor.vendor-master')

@section('site-title')
    {{ __('Vendor withdraw settings') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-wrapper" style="width: 98%">
                    <button type="button" class="cmn_btn btn_bg_profile mb-3" data-bs-toggle="modal"
                        data-bs-target="#createPaymentMethod">
                        {{ __('Add New Withdraw Options') }}
                    </button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="dashboard__card card__two">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Withdraw Options') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body">
                        <div class="table-responsive ">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Option Name') }}</th>
                                        <th>{{ __('Method Name') }}</th>
                                        <th>{{ __('Method Details') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendorWalletGatewaySettingLists as $paymentWalletGateway)
                                        <tr>
                                            <td>{{ $paymentWalletGateway->wallet_option_name }}</td>
                                            <td>
                                                {{ $paymentWalletGateway?->vendorWalletGateway?->name }}
                                            </td>
                                            <td>
                                                @if ($paymentWalletGateway->gateway_qr_file)
                                                    <a target="__blank"
                                                        href="{{ asset('core/public/' . $paymentWalletGateway->gateway_qr_file) }}">
                                                        <img src="{{ asset('core/public/' . $paymentWalletGateway->gateway_qr_file) }}"
                                                            alt="" width="100" height="100">
                                                    </a>
                                                    <br>
                                                    <p>
                                                        <strong>
                                                            Merchant Name:
                                                        </strong>
                                                        {{ $paymentWalletGateway->merchant_name }}
                                                    </p>
                                                    <p>
                                                        <strong>
                                                            Merchant ID:
                                                        </strong>
                                                        {{ $paymentWalletGateway->merchant_id }}
                                                    </p>
                                                @elseif($paymentWalletGateway->fileds)
                                                    @php
                                                        $fileds = unserialize($paymentWalletGateway->fileds);
                                                    @endphp

                                                    @foreach ($fileds as $key => $info)
                                                        <p>
                                                            <strong>
                                                                {{ ucfirst(str_replace('_', ' ', $key)) }}:
                                                            </strong>
                                                            {{ $info }}
                                                        </p>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-warning text-dark btn-sm mb-2 edit-gateway"
                                                    data-bs-toggle="modal" data-bs-target="#updatePaymentMethod"
                                                    data-route="{{ route('vendor.wallet.withdraw.gateway.update', $paymentWalletGateway->id) }}"
                                                    data-gateway="{{ $paymentWalletGateway->vendor_wallet_gateway_id }}"
                                                    data-wallet_option_name="{{ $paymentWalletGateway->wallet_option_name }}"
                                                    data-merchant_name="{{ $paymentWalletGateway->merchant_name ?? '' }}"
                                                    data-merchant_id="{{ $paymentWalletGateway->merchant_id ?? '' }}"
                                                    data-fileds="{{ $paymentWalletGateway->fileds ? json_encode(unserialize($paymentWalletGateway->fileds)) : '{}' }}"
                                                    data-is_file="{{ $paymentWalletGateway->gateway_qr_file ? 'yes' : 'no' }}"
                                                    data-has_qr="{{ $paymentWalletGateway->gateway_qr_file ? 'yes' : 'no' }}">
                                                    <i class="las la-pencil-alt"></i>
                                                </button>
                                                <x-delete-popover :url="route(
                                                    'vendor.wallet.withdraw.gateway.delete',
                                                    $paymentWalletGateway->id,
                                                )" style="margin: 0px !important" />
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

        <!-- Create Modal -->
        <div class="modal fade" id="createPaymentMethod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ __('Add New Withdraw Options') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('vendor.wallet.withdraw.gateway.create') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Withdrawal Options Name</label>
                                <input type="text" name="wallet_option_name" class="form-control"
                                    placeholder="Enter Withdrawal Options Name">
                            </div>
                            <div class="form-group">
                                <label>
                                    {{ __('Withdraw Method') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="gateway_name" class="form-select gateway-name">
                                    <option value="" selected disabled>
                                        {{ __('Select Withdraw Method') }}
                                    </option>
                                    @foreach ($adminGateways as $gateway)
                                        <option value="{{ $gateway->id }}" data-is_file="{{ $gateway->is_file }}"
                                            data-merchant_id="{{ $gateway->merchant_id }}"
                                            data-merchant_name="{{ $gateway->merchant_name }}"
                                            data-fileds="{{ json_encode(unserialize($gateway->filed)) }}">
                                            {{ $gateway->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group gateway-information-wrapper"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Update Modal -->
        <div class="modal fade" id="updatePaymentMethod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ __('Update Withdraw Options') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" enctype="multipart/form-data" class="update-form">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Withdrawal Options Name</label>
                                <input type="text" name="wallet_option_name" class="form-control wallet-option-name"
                                    placeholder="Enter Withdrawal Options Name">
                            </div>
                            <div class="form-group">
                                <label>
                                    {{ __('Withdraw Method') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="gateway_name" class="form-select gateway-name">
                                    <option value="" selected disabled>
                                        {{ __('Select Withdraw Method') }}
                                    </option>
                                    @foreach ($adminGateways as $gateway)
                                        <option value="{{ $gateway->id }}" data-is_file="{{ $gateway->is_file }}"
                                            data-merchant_id="{{ $gateway->merchant_id }}"
                                            data-merchant_name="{{ $gateway->merchant_name }}"
                                            data-fileds="{{ json_encode(unserialize($gateway->filed)) }}">
                                            {{ $gateway->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group gateway-information-wrapper"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function renderFields(
            wrapper,
            fields,
            isFile,
            oldValues = {},
            oldMerchant = {},
            hasQr = 'no',
            hasMerchantName = 'no',
            hasMerchantId = 'no'
        ) {
            wrapper.innerHTML = "";

            let merchantHtml = '';

            if (hasMerchantName === 'yes') {
                merchantHtml += `
                <div class="form-group mb-2">
                    <label>Merchant Name</label>
                    <input type="text"
                        name="merchant_name"
                        class="form-control"
                        value="${oldMerchant.name || ''}"
                        placeholder="Enter Merchant Name">
                </div>
            `;
            }

            if (hasMerchantId === 'yes') {
                merchantHtml += `
                <div class="form-group mb-2">
                    <label>Merchant ID</label>
                    <input type="text"
                        name="merchant_id"
                        class="form-control"
                        value="${oldMerchant.id || ''}"
                        placeholder="Enter Merchant ID">
                </div>
            `;
            }

            /* ---------- FILE BASED GATEWAY ---------- */
            if (isFile === 'yes') {
                let qrHtml = '';
                if (hasQr === 'yes') {
                    qrHtml = `
                    <p class="text-success">
                        <small>Current QR / Document already uploaded. Upload new to replace.</small>
                    </p>
                `;
                }

                wrapper.innerHTML = `
                ${qrHtml}
                <div class="form-group mb-2">
                    <label>{{ __('Upload Document / QR') }}</label>
                    <input type="file"
                        name="gateway_qr_file"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.pdf">
                </div>
                ${merchantHtml}
            `;
                return;
            }

            /* ---------- NORMAL TEXT FIELDS ---------- */
            let html = '';

            if (fields && Object.keys(fields).length > 0) {
                Object.values(fields).forEach(fieldName => {
                    let key = fieldName.toLowerCase().replace(/\s+/g, "_");
                    let value = oldValues[key] ?? "";

                    html += `
                    <div class="form-group mt-2">
                        <label>${fieldName}</label>
                        <input type="text"
                            name="gateway_filed[${key}]"
                            class="form-control"
                            value="${value}"
                            placeholder="Enter ${fieldName}">
                    </div>
                `;
                });
            }

            wrapper.innerHTML = html + merchantHtml;
        }

        /* ===================== CREATE MODAL ===================== */
        document
            .querySelector('#createPaymentMethod .gateway-name')
            ?.addEventListener('change', function() {
                let option = this.options[this.selectedIndex];
                let wrapper = document.querySelector(
                    '#createPaymentMethod .gateway-information-wrapper'
                );

                renderFields(
                    wrapper,
                    JSON.parse(option.dataset.fileds || '{}'),
                    option.dataset.is_file, {}, {},
                    'no',
                    option.dataset.merchant_name,
                    option.dataset.merchant_id
                );
            });

        /* ===================== UPDATE MODAL ===================== */
        document.querySelectorAll('.edit-gateway').forEach(btn => {
            btn.addEventListener('click', function() {
                let modal = document.querySelector('#updatePaymentMethod');
                let form = modal.querySelector('.update-form');
                let select = modal.querySelector('.gateway-name');
                let wrapper = modal.querySelector('.gateway-information-wrapper');
                let walletInput = modal.querySelector('.wallet-option-name');

                /* Set form action */
                form.action = this.dataset.route;

                /* Wallet option name */
                walletInput.value = this.dataset.wallet_option_name || '';

                /* Select gateway */
                select.value = this.dataset.gateway;

                let selectedOption = select.options[select.selectedIndex];

                let oldFields = JSON.parse(this.dataset.fileds || '{}');
                let oldMerchant = {
                    name: this.dataset.merchant_name,
                    id: this.dataset.merchant_id
                };

                renderFields(
                    wrapper,
                    JSON.parse(selectedOption.dataset.fileds || '{}'),
                    selectedOption.dataset.is_file,
                    oldFields,
                    oldMerchant,
                    this.dataset.has_qr,
                    selectedOption.dataset.merchant_name,
                    selectedOption.dataset.merchant_id
                );

                /* Change gateway inside update modal */
                select.onchange = function() {
                    let opt = this.options[this.selectedIndex];
                    renderFields(
                        wrapper,
                        JSON.parse(opt.dataset.fileds || '{}'),
                        opt.dataset.is_file, {}, {},
                        'no',
                        opt.dataset.merchant_name,
                        opt.dataset.merchant_id
                    );
                };
            });
        });
    </script>
@endsection
