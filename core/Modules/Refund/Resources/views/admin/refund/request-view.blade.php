@extends('backend.admin-master')

@section('site-title', __('Refund request view'))

@section('style')
<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

    body {
        background-color: #eeeeee;
        font-family: 'Open Sans', serif
    }

    .container {
        margin-top: 50px;
        margin-bottom: 50px
    }

    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem
    }

    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 5px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px;
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -13px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #FF5722
    }

    .track .step::before {
        height: 5px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 13px;
    }

    .track .step.active .icon {
        background: #ee5435;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 30px;
        height: 30px;
        line-height: 30px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px
    }

    ul.row,
    ul.row-sm {
        list-style: none;
        padding: 0
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }

    .btn-warning {
        color: #ffffff;
        background-color: #ee5435;
        border-color: #ee5435;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #ff2b00;
        border-color: #ff2b00;
        border-radius: 1px
    }

    .stepDetails {
        /*display: none;*/
        visibility: hidden;
        opacity: 0;
        transition: all .3s;
        height: 0;
    }

    .stepDetails.show {
        /*display: block;*/
        visibility: visible;
        opacity: 1;
        height: auto;
    }
</style>
@endsection

@php
$order = $request->order;
@endphp

@section('content')
{{--
<x-msg.success />
<x-msg.error /> --}}

<div class="dashboard__card">
    <div class="dashboard__card__header">
        <h3 class="dashboard__card__title">
            {{ __('Refund Request Details') }}
        </h3>
    </div>
    <div class="dashboard__card__body mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Orders Details') }}
                        </h4>
                        <div class="dashboard__card__header__right">
                            <b>{{ __('Order ID') }}</b>
                            <h6>#{{ $order?->id }}</h6>
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Transaction ID') }}
                            </span>
                            <span class="request__right">{{ $order?->transaction_id }}</span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Payment Gateway') }}
                            </span>
                            <span class="request__right">
                                {{ render_payment_gateway_name($order?->payment_gateway) }}
                            </span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Payment Status') }}
                            </span>
                            <span class="request__right">
                                {{ str($order?->order_status)->ucfirst() }}
                            </span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Total Products') }}
                            </span>
                            <span class="request__right">{{ $order?->order_items_count }}</span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Items Total') }}
                            </span>
                            <span class="request__right">
                                {{ float_amount_with_currency_symbol($order?->paymentMeta?->sub_total) }}
                            </span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Discount Amount') }}

                            </span>
                            <span class="request__right">
                                {{ float_amount_with_currency_symbol($order?->paymentMeta?->coupon_amount) }}
                            </span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Cost Summary') }}
                            </span>
                            <span class="request__right">
                                {{ float_amount_with_currency_symbol($order?->paymentMeta?->shipping_cost) }}
                            </span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Tax Amount') }}
                            </span>
                            <span class="request__right">
                                {{ float_amount_with_currency_symbol($order?->paymentMeta?->tax_amount) }}
                            </span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Total Amount') }}
                            </span>
                            <span class="request__right">
                                {{ float_amount_with_currency_symbol($order?->paymentMeta?->total_amount) }}
                            </span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Total Refund Amount') }}
                            </span>
                            <span class="request__right">
                                {{ float_amount_with_currency_symbol($order?->paymentMeta?->total_amount) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Refund Request Information') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Request Id') }}

                            </span>
                            <span class="request__right">{{ $request?->id }}</span>
                        </div>

                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Additional info') }}: </span>
                            <span class="request__right">{{ $request->additional_information }}</span>
                        </div>

                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Preferred Option') }}

                            </span>
                            <span class="request__right">{{ $request?->preferredOption?->name }}</span>
                        </div>

                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Total Products') }}

                            </span>
                            <span class="request__right">{{ $request->order?->order_items_count }}</span>
                        </div>

                        @if (json_decode($request->preferred_option_fields))
                        <div class="request__item">
                            <span class="request__left">{{ $request?->preferredOption?->name }}: </span>
                            <span class="request__right">
                                @foreach (json_decode($request->preferred_option_fields) ?? [] as $key => $value)
                                <span>{{ $key }}: </span><b>{{ $value }}</b>
                                @endforeach
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Billing Information') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Name') }}

                            </span>
                            <span class="request__right">{{ $order?->address?->name }}</span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Email') }}

                            </span>
                            <span class="request__right">{{ $order?->address?->email }}</span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Phone Number') }}

                            </span>
                            <span class="request__right">{{ $order?->address?->phone }}</span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Country') }}

                            </span>
                            <span class="request__right">{{ $order?->address?->country?->name }}</span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('State') }}

                            </span>
                            <span class="request__right">{{ $order?->address?->state?->name }}</span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('City') }}

                            </span>
                            <span class="request__right">{{ $order?->address?->city }}</span>
                        </div>
                        <div class="request__item">
                            <span class="request__left">
                                {{ __('Zip Code') }}

                            </span>
                            <span class="request__right">{{ $order?->address?->zipcode }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-4">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ $request->order?->order_items_count > 1 ? __('Refund Request Items') : __('Refund Request
                            Item') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-wrap mt-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Serial No.') }}</th>
                                            <th style="width: 60px">
                                                {{ __('Image') }}
                                            </th>
                                            <th>{{ __('Info') }}</th>
                                            <th>{{ __('QTY') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($request->requestProduct as $item)
                                        @php
                                        $product = $request->products->find($item->product_id);
                                        $variant = $request->productVariant->find($item->variant_id);
                                        @endphp

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{!! render_image($product->image, class: 'w-100 h-100') !!}</td>
                                            <td>
                                                <h6>{{ $product->name }}</h6>
                                                @if ($variant)
                                                <p>
                                                    @if ($variant->productColor)
                                                    {{ $variant->productColor->name }},
                                                    @endif
                                                    @if ($variant->productSize)
                                                    {{ $variant->productSize->name }}
                                                    @endif

                                                    @foreach ($variant->attribute as $attr)
                                                    , {{ $attr->attribute_name }}:
                                                    {{ $attr->attribute_value }}
                                                    @endforeach
                                                </p>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->quantity }}
                                            </td>
                                            <td>{{ float_amount_with_currency_symbol($item->amount) }}</td>
                                            <td>{{ float_amount_with_currency_symbol($item->amount * $item->quantity) }}
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

            <div class="col-md-3 mt-4">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h3 class="dashboard__card__title">
                            {{ __('Request Track Update') }}
                        </h3>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('admin.refund.update-track-status', $request->id) }}" method="post">
                            @php
                            $current_status = str_replace(
                            ' ',
                            '_',
                            strtolower($request->currentTrackStatus?->name),
                            );
                            @endphp
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">
                                    {{ __('Current Status') }}</label>
                                <input type="text" disabled readonly class="form-control"
                                    value="{{ ucwords(str_replace('_', ' ', $request->currentTrackStatus?->name)) }}">
                            </div>
                            @php
                            $statuses = \Modules\Refund\Http\Services\RefundTrackStatus::get($current_status);
                            @endphp

                            @if (count($statuses) > 0)
                            <div class="form-group">
                                <label class="form-label">
                                    {{ __('Select Status') }}</label>
                                <select class="form-control" name="track_status" id="track_status">
                                    <option value="">
                                        {{ __('Select a status') }}
                                    </option>
                                    @foreach ($statuses as $key => $trackStatus)
                                    <option value="{{ $key }}">
                                        {{ __($trackStatus) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group reason-table-wrapper">

                            </div>

                            <div class="form-group">
                                <button class="cmn_btn btn_bg_profile">
                                    {{ __('Update') }}
                                </button>
                                <a href="{{ route('admin.refund.request') }}" class="cmn_btn default-theme-btn"
                                    style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                    {{ __('Back') }}
                                </a>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            @if (isset($request->qr_file))
            <div class="col-md-3 mt-4">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h3 class="dashboard__card__title">
                            {{ __('Request QR File') }}
                        </h3>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <a href="{{ asset($request->qr_file) }}" target="__blank">
                            <img src="{{ asset($request->qr_file) }}" alt="" width="100%" height="100%">
                        </a>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-6 mt-4">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h3 class="dashboard__card__title">
                            {{ __('Request Track View') }}
                        </h3>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="track">
                            @foreach ($request->requestTrack as $track)
                            @php
                            $trackCondition =
                            $track->reason->count() > 0 || $track->deductedAmount->count() > 0;
                            @endphp
                            <div class="step active">
                                <span class="icon">
                                    <i class="las la-check "></i>
                                </span>
                                <small class="text">
                                    {{ ucwords(str_replace(['-', '_'], ' ', $track->name)) }}
                                    @if ($trackCondition)
                                    <i class="las la-question-circle {{ $trackCondition ? 'stepText' : '' }}"
                                        data-type="{{ $trackCondition ? ($track->deductedAmount->count() > 0 ? 'deductedAmount' : 'reason') : '' }}"
                                        data-collection="{{ $trackCondition ? json_encode($track->deductedAmount?->count() > 0 ? $track->deductedAmount?->toArray() : $track->reason?->toArray()) : '' }}"
                                        data-refund_fee="{{ $request->refund_fee }}"
                                        style="{{ $track->reason->count() > 0 || $track->deductedAmount->count() > 0 ? 'font-weight: bold' : '' }}"></i>
                                    @endif
                                </small>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).on("click", ".stepText", function() {
            let requestTrackJson = JSON.parse($(this).attr("data-collection"));
            let requestTrackType = $(this).attr("data-type");
            let refundFee = $(this).attr("data-refund_fee");
            let requestTrackHTML = ``;
            if (requestTrackType === 'deductedAmount') {
                requestTrackHTML =
                    `<table class='table table-responsive'><thead><tr><th>{{ __('Cause') }}</th><th>{{ __('Amount') }}</th></tr></thead><tbody>`
            }

            Object.keys(requestTrackJson).forEach(function(key) {
                let item = requestTrackJson[key] ?? [];

                // here need to check request track type
                if (requestTrackType == 'reason') {
                    requestTrackHTML += `<p>${item.reason}</p>`;
                } else if (requestTrackType == 'deductedAmount') {
                    requestTrackHTML += `
                    <tr>
                        <td>${item.reason}</td>
                        <td>${item.amount}</td>
                    </tr>
                `;
                }
            });


            if (requestTrackType === 'deductedAmount') {
                requestTrackHTML += `
                    <tr>
                        <td>{{ __('Refund fee') }}</td>
                        <td>${refundFee}</td>
                    </tr>
                `;
                requestTrackHTML += `</tbody></table>`;
            }

            $('.stepDetails').toggleClass('show');
            $('.stepDetails').html(requestTrackHTML);
        });

        $(document).on("click", ".reason-add", function() {
            let tr = $(this).closest("tr"),
                newRow = tr.clone();

            tr.after(newRow);
        })

        $(document).on("click", ".reason-remove", function() {
            if ($('.reason-remove').length > 1) {
                $(this).closest("tr").remove();
            }
        })

        $(document).on("change", "#track_status", function() {
            if ($(this).val() == "cancel" || $(this).val() == "canceled_by_delivery_man") {
                let table = `<table class="reason-table table table-responsive">
                <thead>
                    <tr>
                        <th>{{ __('Reason') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <textarea type="text" rows="4" name="reason[]"></textarea>
                        </td>
                        <td>
                            <button type="button" class="reason-add btn btn-sm btn-info"><i class="las la-plus"></i></button>
                            <button type="button" class="reason-remove btn btn-sm btn-danger"><i class="las la-minus"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>`;

                $(".reason-table-wrapper").html(table);
            } else if ($(this).val() == "payment_returned") {
                let table = `<table class="reason-table table table-responsive">
                    <thead>
                        <tr>
                            <th>{{ __('Reason') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" rows="4" name="deducted_amount_reason[]" class="form-control" />
                            </td>
                            <td>
                                <input type="text" rows="4" name="deducted_amount[]" class="form-control" />
                            </td>
                            <td>
                                <button type="button" class="reason-add btn btn-sm btn-info"><i class="las la-plus"></i></button>
                                <button type="button" class="reason-remove btn btn-sm btn-danger"><i class="las la-minus"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <label>
                        {{ __('Refund Fee') }}
                        <input class="form-control" name="refund_fee" value="" />
                    </label>
                </div>`;

                $(".reason-table-wrapper").html(table);
            } else {
                $(".reason-table-wrapper").html('')
            }
        })
</script>
@endsection