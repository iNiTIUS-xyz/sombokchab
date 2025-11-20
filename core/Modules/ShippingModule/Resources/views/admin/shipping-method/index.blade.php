@extends('backend.admin-master')

@section('site-title')
    {{ __('Shipping Methods List') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 dashboard-area">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="mb-4">
                    @can('manage-shipping-settings')
                        <a href="{{ route('admin.shipping-method.create') }}" class="cmn_btn btn_bg_profile"
                            title="{{ __('Create Shipping Method') }}">
                            {{ __('Create Shipping Method') }}
                        </a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Shipping Methods') }}</h4>
                    </div>
                    <div class="dashboard__card__body dashboard-recent-order mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    <th>{{ __('Shipping Method Name') }}</th>
                                    <th>{{ __('Zone') }}</th>
                                    <th>{{ __('Cost') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_shipping_methods as $method)
                                        <tr>
                                            <td>{{ optional($method)->title }}</td>
                                            <td>{{ optional($method->zone)->name }}</td>
                                            <td>
                                                {{ amount_with_currency_symbol(optional($method)->cost) }}
                                            </td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $method->status_id }} {{ $method->status_id == 1 ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ ucfirst($method->status_id == 1 ? __('Active') : __('Inactive')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form
                                                            action="{{ route('admin.shipping-method.shipping-method.status.change', $method->id) }}"
                                                            method="POST" id="status-form-activate-{{ $method->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="1">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Active') }}
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('admin.shipping-method.shipping-method.status.change', $method->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $method->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="2">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Inactive') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @can('manage-shipping-settings')
                                                    <a href="{{ route('admin.shipping-method.edit', $method->id) }}"
                                                        class="btn btn-warning text-dark btn-xs mb-2 me-1"
                                                        title="{{ __('Edit Data') }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                @endcan

                                                @can('manage-shipping-settings')
                                                    @if (!$method->is_default)
                                                        <form action="{{ route('admin.shipping-method.make-default') }}" method="post"
                                                            style="display: inline">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $method->id }}">
                                                            <button class="btn btn-info btn-xs mb-2 me-1">
                                                                {{ __('Make Default') }}
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-success btn-xs px-4 mb-2 me-1" disabled>
                                                            {{ __('Default') }}
                                                        </button>
                                                    @endif
                                                @endcan
                                                @can('manage-shipping-settings')
                                                    @if (!$method->is_default)
                                                        <a href="{{ route('admin.shipping-method.destroy', $method->id) }}"
                                                            class="btn btn-danger btn-xs mb-2 me-1" title="{{ __('Delete Data') }}">
                                                            <i class="las la-trash"></i>
                                                        </a>
                                                    @endif
                                                @endcan
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