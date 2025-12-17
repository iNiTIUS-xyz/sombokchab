@extends('vendor.vendor-master')

@section('site-title')
    {{ __('Wallet settings') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
            </div>

            <div class="col-lg-12">
                <div class="dashboard__card card__two">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Withdraw Requests') }}</h4>
                    </div>
                    <div class="dashboard__card__body">
                        <div class="table-responsive ">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Payment Method') }}</th>
                                        <th style="width: 30%">{{ __('Payment Method Details') }}</th>
                                        <th>{{ __('QR File') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Note') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($withdrawRequests); --}}
                                    @foreach ($withdrawRequests as $withdrawRequest)
                                        @php
                                            $fields = '';
                                        @endphp
                                        @if ($withdrawRequest->gateway_fields)
                                            @foreach (json_decode($withdrawRequest->gateway_fields) as $key => $value)
                                                @php
                                                    $fields .= ucwords(str_replace('_', ' ', $key)) . ' => ' . $value;
                                                    if (!$loop->last) {
                                                        $fields .= ' , ';
                                                    }
                                                @endphp
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td>
                                                <strong>${{ $withdrawRequest->amount ?? '' }}</strong>
                                            </td>
                                            <td>
                                                <div class="table-paymentGateway">
                                                    {{ $withdrawRequest->gateway->name }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-fields">{{ $fields }}</div>
                                            </td>
                                            <td>
                                                <a href="{{ asset($withdrawRequest->qr_file) }}" target="__blank">
                                                    <img src="{{ asset($withdrawRequest->qr_file) }}" alt="qr file" />
                                                </a>
                                            </td>
                                            <td>
                                                <x-status-span :status="$withdrawRequest->request_status" />
                                            </td>
                                            <td>
                                                <div class="table-notes">{{ $withdrawRequest->note ?? '' }}</div>
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
@endsection
