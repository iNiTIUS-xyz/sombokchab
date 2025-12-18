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
                        {{ __('Add New Payment Method ') }}
                    </button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="dashboard__card card__two">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Payment Method Settings') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body">
                        <div class="table-responsive ">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Payment Method Name') }}</th>
                                        <th>{{ __('Payment Method Details') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendorWalletGatewaySettingLists as $paymentWalletGateway)
                                        <tr>
                                            <td>
                                                {{ $paymentWalletGateway?->vendorWalletGateway?->name }}
                                            </td>
                                            <td>
                                                @if ($paymentWalletGateway->gateway_qr_file)
                                                    <a target="__blank"
                                                        href="{{ asset($paymentWalletGateway->gateway_qr_file) }}">
                                                        <img src="{{ asset($paymentWalletGateway->gateway_qr_file) }}"
                                                            alt="" width="100" height="100">
                                                    </a>
                                                @else
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
                                                    data-fileds="{{ json_encode(unserialize($paymentWalletGateway->fileds)) }}"
                                                    data-is_file="{{ $paymentWalletGateway->gateway_qr_file ? 'yes' : 'no' }}">
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

        <!-- Modal -->
        <div class="modal fade" id="createPaymentMethod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ __('Add New Payment Method ') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('vendor.wallet.withdraw.gateway.create') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
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
                                        <option value="{{ $gateway->id }}" data-is_file="{{ $gateway->is_file }}"
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
        <div class="modal fade" id="updatePaymentMethod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ __('Update Payment Method') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" enctype="multipart/form-data" class="update-form">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
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
                                        <option value="{{ $gateway->id }}" data-is_file="{{ $gateway->is_file }}"
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
        function renderFields(wrapper, fields, isFile, oldValues = {}) {
            wrapper.innerHTML = "";

            if (isFile === 'yes') {
                wrapper.innerHTML = `
                <div class="form-group">
                    <label>{{ __('Upload Document') }}</label>
                    <input type="file"
                        name="gateway_qr_file"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.pdf">
                </div>
            `;
                return;
            }

            if (!fields) return;

            fields = Object.values(fields);
            let html = "";

            fields.forEach(fieldName => {
                let key = fieldName.toLowerCase().replace(/\s+/g, "_");
                let value = oldValues[key] ?? "";

                html += `
                <div class="form-group">
                    <label>${fieldName}</label>
                    <input type="text"
                        name="gateway_filed[${key}]"
                        class="form-control"
                        value="${value}"
                        placeholder="Enter ${fieldName}">
                </div>
            `;
            });

            wrapper.innerHTML = html;
        }

        // CREATE MODAL
        document.querySelector('#createPaymentMethod .gateway-name')
            ?.addEventListener('change', function() {

                let option = this.options[this.selectedIndex];
                let wrapper = document.querySelector('#createPaymentMethod .gateway-information-wrapper');

                renderFields(
                    wrapper,
                    JSON.parse(option.dataset.fileds || '{}'),
                    option.dataset.is_file
                );
            });

        // UPDATE MODAL OPEN
        document.querySelectorAll('.edit-gateway').forEach(btn => {
            btn.addEventListener('click', function() {

                let modal = document.querySelector('#updatePaymentMethod');
                let form = modal.querySelector('.update-form');
                let select = modal.querySelector('.gateway-name');
                let wrapper = modal.querySelector('.gateway-information-wrapper');

                // set action
                form.action = this.dataset.route;

                let oldFields = JSON.parse(this.dataset.fileds || '{}');

                // select gateway
                select.value = this.dataset.gateway;

                let option = select.options[select.selectedIndex];

                renderFields(
                    wrapper,
                    JSON.parse(option.dataset.fileds || '{}'),
                    option.dataset.is_file,
                    oldFields
                );
            });
        });

        // UPDATE GATEWAY CHANGE
        document.querySelector('#updatePaymentMethod .gateway-name')
            ?.addEventListener('change', function() {

                let option = this.options[this.selectedIndex];
                let wrapper = document.querySelector('#updatePaymentMethod .gateway-information-wrapper');

                renderFields(
                    wrapper,
                    JSON.parse(option.dataset.fileds || '{}'),
                    option.dataset.is_file
                );
            });
    </script>
@endsection
