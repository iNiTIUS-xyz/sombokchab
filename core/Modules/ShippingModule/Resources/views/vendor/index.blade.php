@extends('vendor.vendor-master')
@section('site-title')
    {{ __('Shipping Method List') }}
@endsection

@section('style')
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 dashboard-area">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <a href="{{ route('vendor.shipping-method.create') }}" class="cmn_btn btn_bg_profile mb-4">
                    Create Shipping Method
                </a>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Shipping Methods') }}</h4>
                    </div>
                    <div class="dashboard__card__body mt-4 dashboard-recent-order">
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                    {{-- <th>{{ __('ID') }}</th> --}}
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Zone') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Cost') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_shipping_methods as $method)
                                        <tr>
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ optional($method)->title }}</td>
                                            <td>{{ optional($method->zone)->name }}</td>
                                            <td>
                                                <x-status-span :status="optional($method)->status?->name" />
                                            </td>
                                            <td>{{ amount_with_currency_symbol(optional($method)->cost) }}</td>

                                            <td>
                                                @if (!$method->is_default)
                                                    <form action="{{ route('vendor.shipping-method.make-default') }}"
                                                        method="post" style="display: inline">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $method->id }}">
                                                        <button class="btn btn-info btn-xs mb-2 me-1"
                                                            title="{{ __('Make Default') }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M6 2a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6H6zm7 1.5L18.5 9H13V3.5z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button type="button" class="btn btn-success btn-xs px-2 mb-2 me-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                d="M6 2a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6H6zm7 1.5L18.5 9H13V3.5z" />
                                                        </svg>
                                                        {{ __('Default') }}
                                                    </button>
                                                @endif
                                                <a href="{{ route('vendor.shipping-method.edit', $method->id) }}"
                                                    class="btn btn-warning btn-xs mb-2 me-1" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>

                                                @if (!$method->is_default)
                                                    <x-delete-popover :url="route('vendor.shipping-method.destroy', $method->id)" style="margin: 0px !important" />
                                                @endif
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

@section('script')
@endsection
