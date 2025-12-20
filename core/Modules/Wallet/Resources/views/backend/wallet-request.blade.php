@extends('backend.admin-master')

@section('site-title')
    {{ __('Wallet settings') }}
@endsection

@section('style')
    <style>
        .payment_attachment {
            width: 100px;
        }
    </style>
    <x-media.css />
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-error-msg />
                <x-flash-msg />
                <div class="dashboard__card card__two">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Withdraw Requests') }}</h4>
                    </div>
                    <div class="dashboard__card__body">
                        <div class="table-wrap">
                            <table id="dataTable" class="table-responsive table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Vendor Details') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Payment Method') }}</th>
                                        <th style="width: 30%">{{ __('Payment Method Details') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                        <th>{{ __('Note') }}</th>
                                        <th>{{ __('Created On') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrawRequests as $withdrawRequest)
                                        @php
                                            $fields = '';
                                        @endphp
                                        @if ($withdrawRequest->gateway_fields)
                                            @foreach (json_decode($withdrawRequest->gateway_fields) as $key => $value)
                                                @php
                                                    $fields .=
                                                        ucwords(str_replace('_', ' ', $key)) .
                                                        ': <strong>' .
                                                        $value .
                                                        '</strong> <br>';
                                                @endphp
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td>
                                                <div class="table-owner">
                                                    <span>
                                                        {{ __('Vendor Name:') }}
                                                        <strong>
                                                            {{ $withdrawRequest->vendor->owner_name ?? '' }}
                                                        </strong>
                                                    </span>
                                                    <br />
                                                    <span>
                                                        {{ __('Shop Name:') }}
                                                        <strong>
                                                            {{ $withdrawRequest->vendor->business_name ?? '' }}
                                                        </strong>
                                                    </span>
                                                    <br />
                                                    <span>
                                                        {{ __('Account Balance:') }}
                                                        <strong>
                                                            {{ float_amount_with_currency_symbol($withdrawRequest->wallet?->balance) ?? '' }}
                                                        </strong>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>
                                                    {{ float_amount_with_currency_symbol($withdrawRequest->amount) ?? '' }}
                                                </strong>
                                            </td>
                                            <td>
                                                <div class="table-paymentGateway">
                                                    <strong>{{ $withdrawRequest->gateway?->name }}</strong>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($withdrawRequest->qr_file)
                                                    <a href="{{ asset('core/public/' . $withdrawRequest->qr_file) }}"
                                                        target="__blank" title="View QR File">
                                                        <img src="{{ asset('core/public/' . $withdrawRequest->qr_file) }}"
                                                            width="100" height="100" />
                                                    </a>
                                                    <p>
                                                        <strong>
                                                            Merchant Name:
                                                        </strong>
                                                        {{ $withdrawRequest->merchant_name }}
                                                    </p>
                                                    <p>
                                                        <strong>
                                                            Merchant ID:
                                                        </strong>
                                                        {{ $withdrawRequest->merchant_id }}
                                                    </p>
                                                @else
                                                    <div class="table-fields">{!! $fields !!}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <x-status-span :status="$withdrawRequest->request_status" />
                                            </td>
                                            <td>
                                                @if ($withdrawRequest->request_status == 'pending' || $withdrawRequest->request_status == 'processing')
                                                    <button title="{{ __('Edit') }}" data-fields="{{ $fields }}"
                                                        data-id="{{ $withdrawRequest->id }}"
                                                        data-request-status="{{ $withdrawRequest->request_status }}"
                                                        id="update-wallet-request" data-bs-target="#updateWalletStatus"
                                                        data-bs-toggle="modal" class="btn btn-warning text-dark">
                                                        <i class="ti-pencil"></i>
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="table-notes">{{ $withdrawRequest?->note }}</div>
                                            </td>
                                            <td>
                                                {{ date('M j, Y', strtotime($withdrawRequest?->created_at)) }}
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateWalletStatus" tabindex="-1" aria-labelledby="updateWalletStatus" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.wallet.withdraw-request.update') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Update Withdraw Request') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <p class="request-fields-data"></p>
                        </div>

                        <input type="hidden" value="" name="id" />

                        <div class="form-group">
                            <label>{{ __('Status') }}</label>
                            <select name="request_status" class="form-select">
                                <option value="pending">{{ __('Pending') }}</option>
                                <option value="processing">{{ __('Processing') }}</option>
                                <option value="completed">{{ __('Completed') }}</option>
                                <option value="failed">{{ __('Failed') }}</option>
                                <option value="refunded">{{ __('Refunded') }}</option>
                                <option value="cancelled">{{ __('Cancelled') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Image') }}</label>
                            <input name="request_image" class="form-control" type="file" />
                        </div>

                        <div class="form-group">
                            <label>{{ __('Note') }}</label>
                            <textarea name="note" class="form-control" rows="4" placeholder="{{ __('Enter note') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <x-media.js />
    <script>
        $(document).on("click", "#update-wallet-request", function() {
            let id = $(this).data("id");
            let status = $(this).data("request-status");
            let fields = $(this).data("fields");

            $("#updateWalletStatus input[name=id]").val(id);
            $("#updateWalletStatus select[name=request_status]")
                .val(status)
                .change();

            $("#updateWalletStatus .request-fields-data").html(fields);
        });
    </script>
@endsection
