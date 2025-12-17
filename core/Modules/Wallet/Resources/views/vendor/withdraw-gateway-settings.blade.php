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
                        data-bs-target="#staticBackdrop">
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
                                                <a href="" class="btn btn-warning text-dark btn-sm mb-2"
                                                    title="Edit">
                                                    <i class="las la-pencil-alt"></i>
                                                </a>
                                                <x-delete-popover :url="route(
                                                    'vendor.support.ticket.delete',
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
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
    </div>
@endsection

@section('script')
    <script>
        document.querySelector(".gateway-name")?.addEventListener("change", function() {

            let wrapper = document.querySelector(".gateway-information-wrapper");
            let selectedOption = this.options[this.selectedIndex];

            let fields = selectedOption.dataset.fileds;
            let isFile = selectedOption.dataset.is_file

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

            if (!fields) {
                return;
            }

            fields = JSON.parse(fields);
            let html = "";

            Object.values(fields).forEach(fieldName => {
                let label = fieldName === "Account Name" ?
                    "Account Holder Full Name" :
                    fieldName;

                let inputKey = fieldName.toLowerCase().replace(/\s+/g, "_");

                html += `
                <div class="form-group">
                    <label>${label}</label>
                    <input type="text"
                        name="gateway_filed[${inputKey}]"
                        class="form-control"
                        placeholder="Enter ${label}">
                </div>
        `;
            });

            wrapper.innerHTML = html;
        });
    </script>
@endsection
