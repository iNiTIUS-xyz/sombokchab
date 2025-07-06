@extends('backend.admin-master')

@section('style')
    <style>
        .card img {
            height: 110px;
        }

        .font-size-14 {
            font-size: 14px;
        }
    </style>
@endsection

@section('site-title')
    {{ __('All Store Orders') }}
@endsection

@section('content')
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title">{{ __('All Store Orders') }}</h3>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>{{ __('Serial No.') }}</th>
                            <th style="width:80px">{{ __('Image') }}</th>
                            <th>{{ __('Info') }}</th>
                            <th>{{ __('Total Product') }}</th>
                            <th>{{ __('Total Orders') }}</th>
                            <th>{{ __('Pending Order') }}</th>
                            <th>{{ __('Complete Order') }}</th>
                            <th>{{ __('Total Earning') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $vendor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="table-image">{!! render_image($vendor->logo) !!}</div>
                                </td>
                                <td>
                                    <h6>{{ $vendor->business_name }}</h6>
                                    <p class="font-size-14">
                                        <b>{{ __('Vendor:') }} </b>
                                        {{ $vendor->owner_name }} ({{ $vendor->username }})
                                    </p>
                                </td>
                                <td>{{ $vendor->product_count }}</td>
                                <td>{{ $vendor->total_order }}</td>
                                <td>{{ $vendor->pending_order }}</td>
                                <td>{{ $vendor->complete_order }}</td>
                                <td>
                                    <b>{{ float_amount_with_currency_symbol($vendor->total_earning) }}</b>
                                </td>
                                <td>
                                    {{-- <a href="{{ route('frontend.vendors.single', $vendor->username) }}"
                                        class="btn btn-sm btn-info" title="{{ __('Visit Store') }}">
                                        <i class="ti-list"></i>
                                    </a> --}}
                                    <a href="{{ route('admin.orders.vendor.order', $vendor->username) }}"
                                        class="btn btn-sm btn-primary" title="{{ __('See Orders') }}">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.orders.vendor.order', $vendor->username) }}"
                                        class="btn btn-sm btn-secondary" title="{{ __('Vendor info') }}">
                                        <i class="ti-info"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
