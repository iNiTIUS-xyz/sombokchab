@extends('backend.admin-master')
@section('site-title')
    {{ __('Product Category') }}
@endsection
@section('style')
    <x-media.css />
    <x-bulk-action.css />
@endsection

@php
    $statuses = \App\Status::all();
@endphp

@section('content')
    <div class="col-lg-12 col-ml-12">
        {{--
    <x-msg.error />
    <x-msg.flash /> --}}
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="mb-4">
                    @can('add-category')
                        <a href="#1" data-bs-toggle="modal" data-bs-target="#category_create_modal"
                            class="cmn_btn btn_bg_profile">{{ __('Add New Sub Category') }}</a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h3 class="dashboard__card__title">{{ __('Product Sub Categories') }}</h3>
                        <div class="dashboard__card__header__right">
                            @can('delete-category')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    <x-bulk-action.th />
                                    {{-- <th>{{ __('Serial No.') }}</th> --}}
                                    <th>{{ __('Category Name') }}</th>
                                    <th>{{ __('Main Category') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>

                                    @foreach ($all_sub_category as $category)
                                        <tr>
                                            @can('view-category')
                                                <x-bulk-action.td :id="$category->id" />
                                            @endcan
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>
                                                <p>
                                                    <strong>English :</strong> {{ $category->name }}
                                                </p>
                                                @if ($category->name_km)
                                                    <p>
                                                        <strong>Khmer :</strong> {{ $category->name_km }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td>{{ $category->category->name }}</td>
                                            <td>
                                                <div class="attachment-preview">
                                                    <div class="img-wrap">
                                                        {!! \App\Http\Services\Media::render_image($category->image) !!}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $category->status_id }} {{ $category->status_id == 1 ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ ucfirst($category->status_id == 1 ? __('Active') : __('Inactive')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form
                                                            action="{{ route('admin.subcategory.status.change', $category->id) }}"
                                                            method="POST" id="status-form-activate-{{ $category->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="1">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Active') }}
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('admin.subcategory.status.change', $category->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $category->id }}">
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
                                                @can('edit-category')
                                                    <a href="#1" title="{{ __('Edit') }}" data-bs-toggle="modal"
                                                        data-bs-target="#category_edit_modal"
                                                        class="btn btn-sm btn-warning text-dark mb-2 me-1 category_edit_btn"
                                                        data-id="{{ $category->id }}"
                                                        data-category="{{ $category->category?->id }}"
                                                        data-name="{{ $category->name }}"
                                                        data-name_km="{{ $category->name_km }}"
                                                        data-status="{{ $category->status_id }}"
                                                        data-slug="{{ $category->slug }}"
                                                        data-description="{{ $category->description }}"
                                                        data-imageid="{{ $category->image?->id }}"
                                                        data-image="{{ \App\Http\Services\Media::render_image($category->image, render_type: 'path') }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-category')
                                                    {{-- <x-table.btn.swal.delete :route="route('admin.subcategory.delete', $category->id)" /> --}}
                                                    <x-delete-popover :url="route('admin.subcategory.delete', $category->id)" />
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
    @can('edit-category')
        <div class="modal fade" id="category_edit_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Update Sub Category') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.subcategory.update') }}" method="post">
                        <input type="hidden" name="id" id="sub_category_id">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="edit_name">
                                            {{ __('Name (English)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="edit_name" name="name"
                                            placeholder="{{ __('Enter name (English)') }}" required="">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="edit_name_km">
                                            {{ __('ឈ្មោះ (ខ្មែរ)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="edit_name_km" name="name_km"
                                            placeholder="{{ __('បញ្ចូលឈ្មោះ (ខ្មែរ)') }}" required="">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="edit_slug">{{ __('Slug') }}</label>
                                <input type="text" class="form-control" id="edit_slug" name="slug"
                                    placeholder="{{ __('Enter slug') }}">
                            </div>
                        </div> --}}
                                <div class="col-md-6 mb-4">
                                    <div class="form-group edit-category-wrapper">
                                        <label for="name">
                                            {{ __('Category') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select type="text" class="form-control" id="category_id" name="category_id"
                                            required="">
                                            <option value="">{{ __('Select Category') }}</option>
                                            @foreach ($all_category as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-group edit-status-wrapper">
                                        <label for="edit_status">
                                            {{ __('Status') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="status_id" class="form-control" id="edit_status" required="">
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}">
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="edit_description">
                                            {{ __('Description') }}
                                        </label>
                                        <textarea type="text" class="form-control" id="edit_description" name="description"
                                            placeholder="{{ __('Description') }}" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <x-media-upload :title="__('Image')" name="image_id" :dimentions="'200x200'" />
                                </div>
                            </div>
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

    @can('add-category')
        <div class="modal fade" id="category_create_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Create Sub Category') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.subcategory.new') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="create-name">
                                            {{ __('Name (English)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="create-name" name="name"
                                            placeholder="{{ __('Enter name (english)') }}" required="">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="name_km">
                                            {{ __('ឈ្មោះ (ខ្មែរ)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="name_km" name="name_km"
                                            placeholder="{{ __('បញ្ចូលឈ្មោះ (ខ្មែរ)') }}" required="">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="slug">{{ __('Slug') }}</label>
                                <input type="text" class="form-control" id="create-slug" name="slug"
                                    placeholder="{{ __('Enter slug') }}">
                            </div>
                        </div> --}}
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="name">
                                            {{ __('Category') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select type="text" class="form-control" id="create_category_id"
                                            name="category_id" required="">
                                            <option value="">Select Category</option>
                                            @foreach ($all_category as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label for="status">
                                            {{ __('Status') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="status_id" class="form-control" id="status" required="">
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="description">
                                            {{ __('Description') }}
                                        </label>
                                        <textarea type="text" class="form-control" id="description" name="description"
                                            placeholder="{{ __('Description') }}" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <x-media-upload :title="__('Image')" :name="'image_id'" :dimentions="'200x200'" />
                                </div>
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
    <div class="body-overlay-desktop"></div>
    <x-media.markup />
@endsection

@section('script')
    <x-media.js />
    <x-table.btn.swal.js />
    @can('view-category')
        <script>
            (function($) {
                $(document).ready(function() {
                    $(document).on('click', '#bulk_delete_btn', function(e) {
                        e.preventDefault();

                        var bulkOption = $('#bulk_option').val();
                        var allCheckbox = $('.bulk-checkbox:checked');
                        var allIds = [];

                        allCheckbox.each(function(index, value) {
                            allIds.push($(this).val());
                        });

                        if (allIds.length > 0 && bulkOption == 'delete') {
                            Swal.fire({
                                title: '{{ __('Are you sure?') }}',
                                text: '{{ __('You would not be able to revert this action!') }}',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#ee0000',
                                cancelButtonColor: '#55545b',
                                confirmButtonText: '{{ __('Yes, delete them!') }}',
                                cancelButtonText: "{{ __('No') }}"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#bulk_delete_btn').text('{{ __('Deleting...') }}');

                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin.subcategory.bulk.action') }}",
                                        data: {
                                            _token: "{{ csrf_token() }}",
                                            ids: allIds,
                                        },
                                        success: function(data) {
                                            Swal.fire(
                                                '{{ __('Deleted!') }}',
                                                '{{ __('Selected data have been deleted.') }}',
                                                'success'
                                            );
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        },
                                        error: function() {
                                            Swal.fire(
                                                'Error!',
                                                'Failed to delete data.',
                                                'error'
                                            );
                                        }
                                    });
                                }
                            });
                        } else {
                            Swal.fire(
                                'Warning!',
                                '{{ __('Please select at least one item and choose delete option.') }}',
                                'warning'
                            );
                        }
                    });

                    // Handle "select all" checkbox
                    $('.all-checkbox').on('change', function(e) {
                        e.preventDefault();
                        var value = $(this).is(':checked');
                        var allChek = $(this).closest('table').find('.bulk-checkbox');

                        allChek.prop('checked', value);
                    });
                });
            })(jQuery);
        </script>
    @endcan

    <script>
        $(document).ready(function() {
            $(document).on('click', '.category_edit_btn', function() {
                let el = $(this);
                let id = el.data('id');
                let name = el.data('name');
                let name_km = el.data('name_km');
                let slug = el.data('slug');
                let description = el.data('description');
                let category = el.data("category");

                let status = el.data('status');
                let modal = $('#category_edit_modal');

                modal.find('#sub_category_id').val(id);
                modal.find('#category_id').val(category);
                modal.find('#edit_status option[value="' + status + '"]').attr('selected', true);
                modal.find('#edit_name').val(name);
                modal.find('#edit_name_km').val(name_km);
                modal.find('#edit_slug').val(slug);
                modal.find('#edit_description').val(description);
                modal.find(".edit-status-wrapper .list li[data-value='" + status + "']").trigger("click");
                modal.find(".edit-category-wrapper .list li[data-value='" + category + "']").trigger(
                    "click");
                modal.find(".modal-footer").trigger("click");

                let image = el.data('image');
                let imageid = el.data('imageid');

                if (imageid != '') {
                    modal.find('.media-upload-btn-wrapper .img-wrap').html(
                        '<div class="attachment-preview">' +
                        '<div class="thumbnail">' +
                        '<div class="centered">' +
                        '<img class="avatar user-thumb" src="' + image + '" > ' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );

                    modal.find('.media-upload-btn-wrapper input').val(imageid);
                    modal.find('.media-upload-btn-wrapper .media_upload_form_btn').text(
                        '{{ __('Change Image') }}');
                }

            });

            $('#create-name , #create-slug').on('keyup', function() {
                let title_text = $(this).val();
                $('#create-slug').val(convertToSlug(title_text))
            });

            $('#edit_name , #edit_slug').on('keyup', function() {
                let title_text = $(this).val();
                $('#edit_slug').val(convertToSlug(title_text))
            });
        });
    </script>
@endsection
