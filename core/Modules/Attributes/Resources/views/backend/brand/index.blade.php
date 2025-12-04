@extends('backend.admin-master')

@section('site-title')
    {{ __('Product Brand') }}
@endsection

@section('style')
    <x-media.css />
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    {{--
                <x-msg.error />
                <x-msg.flash /> --}}
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-4">
                    @can('add-attribute')
                        <a href="#1" data-bs-toggle="modal" data-bs-target="#brand_manage_create_modal"
                            class="cmn_btn btn_bg_profile">
                            {{ __('Add New Brand') }}
                        </a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Brands') }}</h4>
                        <div class="dashboard__card__header__right">
                            @can('view-attribute')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('view-attribute')
                                        <x-bulk-action.th />
                                    @endcan
                                    <th>{{ __('Logo') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $item)
                                        <tr>
                                            @can('view-attribute')
                                                <x-bulk-action.td :id="$item->id" />
                                            @endcan
                                            {{-- <td width="80px">{{ $loop->iteration }}</td> --}}
                                            <td>
                                                <div class="attachment-preview">
                                                    <div class="img-wrap">
                                                        {!! render_image($item->logo, size: 'full') !!}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p>
                                                    <strong>English :</strong> {{ $item->name }}
                                                </p>
                                                @if ($item->name_km)
                                                    <p>
                                                        <strong>Khmer :</strong> {{ $item->name_km }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td class="w-40">
                                                <p>
                                                    <strong>English :</strong> {{ $item->description }}
                                                </p>
                                                @if ($item->description_km)
                                                    <p>
                                                        <strong>Khmer :</strong> {{ $item->description_km }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td>
                                                @can('edit-attribute')
                                                    <a href="#1" data-bs-toggle="modal"
                                                        data-bs-target="#brand_manage_edit_modal" title="{{ __('Edit') }}"
                                                        class="btn  btn-warning text-dark btn-sm brand_manage_edit_btn"
                                                        data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                        data-name_km="{{ $item->name_km }}" data-slug="{{ $item->slug }}"
                                                        data-title="{{ $item->title }}"
                                                        data-description="{{ $item->description }}"
                                                        data-description_km="{{ $item->description_km }}"
                                                        data-logo-id="{{ $item->image_id }}"
                                                        data-logo="{{ \App\Http\Services\Media::render_image($item->logo, render_type: 'path') }}"
                                                        data-banner-id="{{ $item->banner_id }}"
                                                        data-banner="{{ \App\Http\Services\Media::render_image($item->banner, render_type: 'path') }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('delete-attribute')
                                                    <x-table.btn.swal.delete class="margin-bottom-0" :route="route('admin.brand.manage.delete', $item->id)" />
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
    @can('edit-attribute')
        <div class="modal fade" id="brand_manage_edit_modal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Update Brand') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.brand.manage.update') }}" method="post">
                        @csrf
                        <input type="hidden" value="" id="edit-brand-id" name="id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="edit-name">
                                            {{ __('Name (English)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="edit-name" name="name"
                                            placeholder="{{ __('Enter brand name') }}">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="edit-name-km">
                                            {{ __('ឈ្មោះ (ខ្មែរ)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="edit-name-km" name="name_km"
                                            placeholder="{{ __('បញ្ចូលឈ្មោះម៉ាក (ខ្មែរ)') }}">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="name">
                                            {{ __('Description (English)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" id="edit-description" name="description"
                                            placeholder="{{ __('Enter brand Description Optional') }}"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="edit-description-km">
                                            {{ __('ការពិពណ៌នា (ខ្មែរ)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" id="edit-description-km" name="description_km"
                                            placeholder="{{ __('បញ្ចូលម៉ាក ការពិពណ៌នា ស្រេចចិត្ត (ខ្មែរ)') }}"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <x-media-upload :title="__('Logo')" :name="'image_id'" :dimentions="'200x200'" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <x-media-upload :title="__('Banner')" :name="'banner_id'" :dimentions="'200x200'" />
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

    @can('add-attribute')
        <div class="modal fade" id="brand_manage_create_modal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Create Brand') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.brand.manage.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="name">
                                            {{ __('Name') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="create-name" name="name"
                                            placeholder="{{ __('Enter brand name') }}">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="create-name-km">
                                            {{ __('ឈ្មោះ (ខ្មែរ)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="create-name-km" name="name_km"
                                            placeholder="{{ __('បញ្ចូលឈ្មោះម៉ាក (ខ្មែរ)') }}">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="description">
                                            {{ __('Description') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" id="description" name="description"
                                            placeholder="{{ __('Enter brand Description Optional') }}"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="description-km">
                                            {{ __('ការពិពណ៌នា (ខ្មែរ)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" id="description-km" name="description_km"
                                            placeholder="{{ __('បញ្ចូលម៉ាក ការពិពណ៌នា ស្រេចចិត្ត (ខ្មែរ)') }}"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <x-media-upload :title="__('Logo')" :name="'image_id'" :dimentions="'200x200'" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <x-media-upload :title="__('Banner')" :name="'banner_id'" :dimentions="'200x200'" />
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
    <x-media.markup />
@endsection

@section('script')
    <x-table.btn.swal.js />
    <x-backend.icon-picker-js />
    <x-media.js />
    @can('view-attribute')
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
                                        url: "{{ route('admin.brand.manage.bulk.action') }}",
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
            $(document).on('click', '.brand_manage_edit_btn', function() {
                let el = $(this);
                let id = el.data('id');
                let name = el.data('name');
                let slug = el.data('slug');
                let title = el.data('title');
                let name_km = el.data('name_km');
                let description = el.data('description');
                let description_km = el.data('description_km');
                let modal = $('#brand_manage_edit_modal');

                modal.find('#edit-brand-id').val(id);
                modal.find('#edit-title').val(title);
                modal.find('#edit-name-km').val(name_km);
                modal.find('#edit-description').val(description);
                modal.find('#edit-description-km').val(description_km);
                modal.find('#edit-name').val(name);
                modal.find('#edit-slug').val(slug);

                let logo = el.data('logo');
                let banner = el.data('banner');
                let logo_id = el.data('logo-id');
                let banner_id = el.data('banner-id');

                if (logo_id != '') {
                    modal.find('#image_id .media-upload-btn-wrapper .img-wrap').html(
                        '<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="' +
                        logo + '" > </div></div></div>');
                    modal.find('#image_id .media-upload-btn-wrapper input').val(logo_id);
                    modal.find('#image_id .media-upload-btn-wrapper .media_upload_form_btn').text(
                        'Change Image');
                }

                if (banner_id != '') {
                    modal.find('#banner_id .media-upload-btn-wrapper .img-wrap').html(
                        '<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="' +
                        banner + '" > </div></div></div>');
                    modal.find('#banner_id .media-upload-btn-wrapper input').val(banner_id);
                    modal.find('#banner_id .media-upload-btn-wrapper .media_upload_form_btn').text(
                        'Change Image');
                }

                modal.show();
            });
        });

        $('#create-name , #create-slug').on('keyup', function() {
            let title_text = $(this).val();
            $('#create-slug').val(convertToSlug(title_text))
        });

        $('#edit-name , #edit-slug').on('keyup', function() {
            let title_text = $(this).val();
            $('#edit-slug').val(convertToSlug(title_text))
        });
    </script>
@endsection
