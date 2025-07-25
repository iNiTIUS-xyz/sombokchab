@extends('backend.admin-master')

@section('site-title')
    {{ __('Product Delivery Manage') }}
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
                        <a href="#1" data-bs-toggle="modal" data-bs-target="#delivery_manage_add_modal"
                            class="cmn_btn btn_bg_profile">
                            {{ __('Add New Delivery Option') }}
                        </a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Delivery Options') }}</h4>
                        @can('product-delivery-manage-delete')
                            <x-bulk-action.dropdown />
                        @endcan
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    <th>{{ __('Icon') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Sub Title') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($delivery_manages as $item)
                                        <tr>
                                            <td>
                                                <x-backend.preview-icon :class="$item->icon" />
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->sub_title }}</td>
                                            <td>
                                                @can('product-delivery_manage-edit')
                                                    <a href="#1" data-bs-toggle="modal" title="{{ __('Edit Data') }}"
                                                        data-bs-target="#delivery_manage_edit_modal"
                                                        class="btn btn-warning btn-sm btn-xs mb-2 me-1 text-dark delivery_manage_edit_btn"
                                                        data-id="{{ $item->id }}" data-title="{{ $item->title }}"
                                                        data-sub-title="{{ $item->sub_title }}"
                                                        data-icon="{{ $item->icon }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('product-delivery_manage-delete')
                                                    <x-table.btn.swal.delete :route="route('admin.delivery.option.delete', $item->id)" />
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

    @can('product-delivery_manage-create')
        <div class="modal fade" id="delivery_manage_add_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add Delivery Option') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.delivery.option.store') }}" method="post"
                                enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="delivery_manage_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Title') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="{{ __('Enter tfitle') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Sub Title') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="sub_title" name="sub_title"
                                    placeholder="{{ __('Enter sub title') }}" required="">
                            </div>
                            <div class="form-group">
                                <x-backend.icon-picker />
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

    @can('product-delivery_manage-edit')
        <div class="modal fade" id="delivery_manage_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Update Delivery Option') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.delivery.option.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="delivery_manage_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Title') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit-title" name="title"
                                    placeholder="{{ __('Enter title') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit-sub-title" name="sub_title"
                                    placeholder="{{ __('Enter sub title') }}" required="">
                            </div>
                            <x-backend.icon-picker />
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
    <x-backend.icon-picker-js />

    <script>
        $(document).ready(function() {
            $(document).on('click', '.delivery_manage_edit_btn', function() {
                let el = $(this);
                let id = el.data('id');
                let title = el.data('title');
                let sub_title = el.data('sub-title');
                let modal = $('#delivery_manage_edit_modal');

                modal.find('#delivery_manage_id').val(id);
                modal.find('#edit-title').val(title);
                modal.find('#edit-sub-title').val(sub_title);
                // modal.find('#edit-icon').val(icon);
                modal.find('.icp-dd').attr('data-selected', el.data('icon'));
                modal.find('.iconpicker-component i').attr('class', el.data('icon'));

                modal.show();
            });
        });
    </script>
@endsection
