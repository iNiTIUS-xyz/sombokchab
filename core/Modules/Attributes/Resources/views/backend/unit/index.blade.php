@extends('backend.admin-master')
@section('site-title')
    {{ __('Product Unit') }}
@endsection
@section('style')
    <x-bulk-action.css />
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row g-4">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="mb-4">
                    @can('units-new')
                        <a href="#1" data-bs-toggle="modal" data-bs-target="#unit_add_modal"
                            class="cmn_btn btn_bg_profile">
                            {{ __('Add New Unit') }}
                        </a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h3 class="dashboard__card__title">{{ __('All Units') }}</h3>
                        <div class="dashboard__card__header__right">
                            @can('units-bulk-action')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('units-bulk-action')
                                        <x-bulk-action.th />
                                    @endcan
                                    {{-- <th>{{ __('ID') }}</th> --}}
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($product_units as $unit)
                                        <tr>
                                            @can('units-bulk-action')
                                                <x-bulk-action.td :id="$unit->id" />
                                            @endcan
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ $unit->name }}</td>
                                            <td>
                                                @can('units-update')
                                                    <a href="#1" title="{{ __('Edit Data') }}" data-bs-toggle="modal"
                                                        data-bs-target="#unit_edit_modal"
                                                        class="btn btn-warning text-dark btn-sm btn-xs mb-2 me-1 unit_edit_btn"
                                                        data-id="{{ $unit->id }}" data-name="{{ $unit->name }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('units-delete')
                                                    <x-table.btn.swal.delete :route="route('admin.units.delete', $unit->id)" />
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
    @can('units-new')
    <div class="modal fade" id="unit_add_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom__form">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Unit') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{ route('admin.units.store') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">
                                {{ __('Name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="{{ __('Enter name') }}" required="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
    @can('units-update')
        <div class="modal fade" id="unit_edit_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Update Unit') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.units.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="unit_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="edit_name">
                                    {{ __('Name') }}
                                <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="{{ __('Enter name') }}" required="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('script')
    <x-table.btn.swal.js />
    @can('units-delete')
        <x-bulk-action.js :route="route('admin.units.bulk.action')" />
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
