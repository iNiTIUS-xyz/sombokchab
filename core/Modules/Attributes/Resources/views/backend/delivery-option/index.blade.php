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
                {{--
            <x-msg.error />
            <x-msg.flash /> --}}
                <div class="mb-4">
                    @can('add-attribute')
                        <a href="#1" data-bs-toggle="modal" data-bs-target="#delivery_manage_add_modal"
                            class="cmn_btn btn_bg_profile">
                            {{ __('Add New Delivery Option') }}
                        </a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Delivery Options') }}
                        </h4>
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
                                            <td>
                                                <p>
                                                    <strong>English :</strong> {{ $item->title }}
                                                </p>
                                                @if ($item->title_km)
                                                    <p>
                                                        <strong>Khmer :</strong> {{ $item->title_km }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td>
                                                <p>
                                                    <strong>English :</strong> {{ $item->sub_title }}
                                                </p>
                                                @if ($item->sub_title_km)
                                                    <p>
                                                        <strong>Khmer :</strong> {{ $item->sub_title_km }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td>
                                                @can('edit-attribute')
                                                    <a href="#1" data-bs-toggle="modal" title="{{ __('Edit') }}"
                                                        data-bs-target="#delivery_manage_edit_modal"
                                                        class="btn btn-warning btn-sm btn-xs mb-2 me-1 text-dark delivery_manage_edit_btn"
                                                        data-id="{{ $item->id }}" data-title="{{ $item->title }}"
                                                        data-sub-title="{{ $item->sub_title }}"
                                                        data-title_km="{{ $item->title_km }}"
                                                        data-sub-title_km="{{ $item->sub_title_km }}"
                                                        data-icon="{{ $item->icon }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-attribute')
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

    @can('add-attribute')
        <div class="modal fade" id="delivery_manage_add_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add Delivery Option') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.delivery.option.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="delivery_manage_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Title (English)') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="{{ __('Enter title (English)') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="km_title">
                                    {{ __('ចំណងជើង (ភាសាខ្មែរ)') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="km_title" name="title_km"
                                    placeholder="{{ __('បញ្ចូលចំណងជើង (ភាសាខ្មែរ)') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="sub_title">
                                    {{ __('Sub Title (English)') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="sub_title" name="sub_title"
                                    placeholder="{{ __('Enter sub title') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="km_sub_title">
                                    {{ __('ចំណងជើងរង (ភាសាខ្មែរ)') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="km_sub_title" name="sub_title_km"
                                    placeholder="{{ __('បញ្ចូលចំណងជើងរង (ភាសាខ្មែរ)') }}" required="">
                            </div>
                            <div class="form-group">
                                <x-backend.icon-picker />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('edit-attribute')
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
                                <label for="edit-title">
                                    {{ __('Title') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit-title" name="title"
                                    placeholder="{{ __('Enter title') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="edit-title-km">
                                    {{ __('ចំណងជើង (ខ្មែរ)') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit-title-km" name="title_km"
                                    placeholder="{{ __('បញ្ចូលចំណងជើង (ខ្មែរ)') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="edit-sub-title">
                                    {{ __('Sub Title (English)') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit-sub-title" name="sub_title"
                                    placeholder="{{ __('Enter sub title') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="edit-sub-title">
                                    {{ __('ចំណងជើងរង (ខ្មែរ)') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit-sub-title-km" name="sub_title_km"
                                    placeholder="{{ __('បញ្ចូលចំណងជើងរង (ខ្មែរ)') }}" required="">
                            </div>
                            <x-backend.icon-picker />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
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
                let title_km = el.data('title_km');
                let sub_title = el.data('sub-title');
                let sub_title_km = el.data('sub-title_km');
                let modal = $('#delivery_manage_edit_modal');

                modal.find('#delivery_manage_id').val(id);
                modal.find('#edit-title').val(title);
                modal.find('#edit-title-km').val(title_km);
                modal.find('#edit-sub-title').val(sub_title);
                modal.find('#edit-sub-title-km').val(sub_title_km);
                // modal.find('#edit-icon').val(icon);
                modal.find('.icp-dd').attr('data-selected', el.data('icon'));
                modal.find('.iconpicker-component i').attr('class', el.data('icon'));

                modal.show();
            });
        });
    </script>
@endsection
