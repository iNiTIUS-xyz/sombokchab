@extends('backend.admin-master')

@section('style')
    <x-bulk-action.css />
@endsection

@section('site-title')
    {{ __('All Attributes') }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="mb-4">
                    @can('attributes-new')
                        <div class="btn-wrapper">
                            <a href="{{ route('admin.products.attributes.store') }}"
                                class="cmn_btn btn_bg_profile">{{ __('Add New Attribute') }}</a>
                        </div>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Attributes') }}</h4>
                        <div class="dashboard__card__header__right">
                            @can('attributes-bulk-action')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    <x-bulk-action.th />
                                    {{-- <th>{{ __('ID') }}</th> --}}
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Terms') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_attributes as $attribute)
                                        <tr>
                                            <x-bulk-action.td :id="$attribute->id" />
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ $attribute->title }}</td>
                                            <td>
                                                <ul>
                                                    @foreach (json_decode($attribute->terms) as $term)
                                                        <li>{{ $term }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                @can('attributes-edit')
                                                    <x-table.btn.edit :route="route('admin.products.attributes.edit', $attribute->id)" />
                                                @endcan
                                                @can('attributes-delete')
                                                    <x-table.btn.swal.delete :route="route(
                                                        'admin.products.attributes.delete',
                                                        $attribute->id,
                                                    )" />
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

@section('script')
    @can('attributes-delete')
        <x-bulk-action.js :route="route('admin.products.attributes.bulk.action')" />
    @endcan
    <x-table.btn.swal.js />
@endsection
