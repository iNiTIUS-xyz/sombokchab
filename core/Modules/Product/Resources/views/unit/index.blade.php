@extends('backend.admin-master')
@section('site-title')
    {{ __('Product Unit') }}
@endsection
@section('style')
    <x-datatable.css />
    <x-bulk-action.css />
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row g-4">
            <div class="col-lg-7">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h3 class="dashboard__card__title">{{ __('All Units') }}</h3>
                        <div class="dashboard__card__header__right">
                            @can('product-unit-delete')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                    <x-bulk-action.th />
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($product_units as $unit)
                                        <tr>
                                            <x-bulk-action.td :id="$unit->id" />
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $unit->name }}</td>
                                            <td>
                                                @can('product-unit-delete')
                                                    <x-table.btn.swal.delete :route="route('admin.products.units.delete', $unit->id)" />
                                                @endcan
                                                @can('product-unit-edit')
                                                    <a href="#1" data-bs-toggle="modal" data-bs-target="#unit_edit_modal"
                                                        class="btn btn-warning btn-xs mb-2 me-1 unit_edit_btn"
                                                        data-id="{{ $unit->id }}" data-name="{{ $unit->name }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
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
            @can('product-unit-create')
                <div class="col-lg-5">
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h3 class="dashboard__card__title">{{ __('Add New Unit') }}</h3>
                        </div>
                        <div class="dashboard__card__body custom__form mt-4">
                            <form action="{{ route('admin.products.units.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="{{ __('Name') }}">
                                </div>
                                <div class="btn-wrapper mt-4">
                                    <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Add New') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
    @can('product-unit-edit')
        <div class="modal fade" id="unit_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Update Unit') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.products.units.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="unit_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="edit_name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="{{ __('Name') }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Save Change') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('script')
    <x-datatable.js />
    <x-table.btn.swal.js />
    @can('product-unit-delete')
        <x-bulk-action.js :route="route('admin.products.units.bulk.action')" />
    @endcan

    <script>
        $(document).ready(function() {
            $(document).on('click', '.unit_edit_btn', function() {
                let el = $(this);
                let id = el.data('id');
                let name = el.data('name');
                let modal = $('#unit_edit_modal');

                modal.find('#unit_id').val(id);
                modal.find('#edit_name').val(name);

                modal.show();
            });
        });
    </script>
@endsection
