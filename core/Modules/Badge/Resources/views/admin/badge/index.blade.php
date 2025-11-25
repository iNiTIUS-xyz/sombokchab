@extends('backend.admin-master')

@section('site-title')
{{ __('Badges') }}
@endsection

@section('style')
<x-media.css />
<style>
    .badge_image {
        width: 50px;
        height: auto;
    }
</style>
@endsection

@section('content')
<div class="col-lg-12 col-ml-12">
    <div class="row">
        {{--
        <x-error-msg />
        <x-flash-msg /> --}}
        <div class="mb-4">
            @can('add-attribute')
            <a href="#1" data-bs-toggle="modal" data-bs-target="#badge_add_modal" class="cmn_btn btn_bg_profile">{{
                __('Add New Badge') }}</a>
            @endcan
        </div>
        <div class="col-lg-12">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title">{{ __('All Badges') }}</h4>
                    <div class="dashboard__card__header__right">
                        @can('view-attribute')
                        <x-bulk-action.dropdown />
                        @endcan
                        @can('delete-attribute')
                        <a class="cmn_btn btn_bg_danger" href="{{ route('admin.badge.trash') }}">{{ __('Trash Bin')
                            }}</a>
                        @endcan
                    </div>
                </div>
                <div class="dashboard__card__body mt-4">
                    <div class="table-responsive">
                        <table class="table table-default" id="dataTable">
                            <thead>
                                <x-bulk-action.th />
                                {{-- <th>{{ __('ID') }}</th> --}}
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($badges as $badge)
                                <tr>
                                    <x-bulk-action.td :id="$badge->id" />
                                    <td>{{ $badge->name }}</td>
                                    <td>
                                        {!! render_image_markup_by_attachment_id($badge->image, 'badge_image') !!}
                                    </td>
                                    <td>
                                        <div class="btn-group badge">
                                            <button type="button"
                                                class="status-{{ $badge->status }} {{ $badge->status == 'active' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ ucfirst($badge->status == 'active' ? __('Active') : __('Inactive'))
                                                }}
                                            </button>
                                            <div class="dropdown-menu">
                                                <form action="{{ route('admin.badge.status.change', $badge->id) }}"
                                                    method="POST" id="status-form-activate-{{ $badge->id }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="active">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Active') }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.badge.status.change', $badge->id) }}"
                                                    method="POST" id="status-form-deactivate-{{ $badge->id }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="in_active">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Inactive') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        @can('edit-attribute')
                                        @php
                                        $img = get_attachment_image_by_id($badge->image);
                                        $img_url = !empty($img) ? $img['img_url'] : '';
                                        @endphp
                                        <a href="#1" title="{{ __('Edit Data') }}" data-bs-toggle="modal"
                                            data-bs-target="#badge_edit_modal"
                                            class="btn btn-warning btn-sm text-dark btn-xs mb-2 me-1 badge_edit_btn"
                                            data-id="{{ $badge->id }}" data-name="{{ $badge->name }}"
                                            data-status="{{ $badge->status }}" data-image_id="{{ $badge->image }}"
                                            data-image_url="{{ $img_url }}"
                                            data-route="{{ route('admin.badge.update', $badge->id) }}">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        @endcan
                                        @can('delete-attribute')
                                        <x-delete-popover permissions="delete-badge"
                                            url="{{ route('admin.badge.delete', $badge->id) }}" />
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
<div class="modal fade" id="badge_add_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content custom__form">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Add Badge') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{ route('admin.badge.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body mx-3">
                    <div class="row">
                        <div class="form-group">
                            <label for="name">
                                {{ __('Name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="{{ __('Enter name') }}" required="">
                        </div>

                        <div class="form-group">
                            <label for="status">
                                {{ __('Status') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" name="status" id="status" required="">
                                <option value="" selected disabled>Select One</option>
                                <option value="active">{{ __('Active') }}</option>
                                <option value="in_active">{{ __('Inactive') }}</option>
                            </select>
                        </div>

                        <x-media.media-upload :name="'image'" :title="'Badge Image'" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Add') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan


@can('edit-attribute')
<div class="modal fade" id="badge_edit_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content custom__form">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Update Badge') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
            </div>
            <form action="" method="post" id="badge_edit_modal_form">
                @csrf
                <input type="hidden" name="id" id="badge_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="edit_name">
                                    {{ __('Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="{{ __('Enter name') }}" required="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label for="status">
                                    {{ __('Status') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="status" id="edit-status" required="">
                                    <option value="" selected disabled>{{ __('Select One') }}</option>
                                    <option value="active">{{ __('Active') }}</option>
                                    <option value="in_active">{{ __('Inactive') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <x-media.media-upload :name="'image'" :title="'Badge Image'" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
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
                                        url: "{{ route('admin.badge.bulk.action.delete') }}",
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
    $(function() {
            $(document).on('click', '.badge_edit_btn', function() {
                var el = $(this);
                var id = el.data('id');
                var name = el.data('name');
                var image = el.data('image_url');
                var image_id = el.data('image_id');
                var status = el.data('status');
                var action = el.data('route');

                var form = $('#badge_edit_modal_form');
                form.attr('action', action);
                form.find('#badge_id').val(id);
                form.find('#edit_name').val(name);
                form.find('#edit-status option[value="' + status + '"]').attr('selected', true);
                if (image_id != '') {
                    form.find('.media-upload-btn-wrapper .img-wrap').html(
                        '<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="' +
                        image + '" > </div></div></div>');
                    form.find('.media-upload-btn-wrapper input').val(image_id);
                    form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }
            });
        });
</script>
@endsection