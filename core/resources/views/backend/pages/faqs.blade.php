@extends('backend.admin-master')

@section('site-title')
    {{ __('Faq') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
    <x-media.css />
    <x-summernote.css />
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row g-4">
            <div class="col-lg-12">
                <x-error-msg />
                <x-flash-msg />
                <div class="mb-4">
                    @can('add-faq')
                        <a href="#1" data-bs-toggle="modal" data-bs-target="#faq_add_modal"
                            class="cmn_btn btn_bg_profile">{{ __('Add New FAQ') }}</a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('FAQ Management') }}</h4>
                        <div class="dashboard__card__header__right">
                            @can('manage-faq')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-wrap table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('manage-faq')
                                        <th class="no-sort">
                                            <div class="mark-all-checkbox">
                                                <input type="checkbox" class="all-checkbox">
                                            </div>
                                        </th>
                                    @endcan
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Publish Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_faqs as $data)
                                        <tr>
                                            @can('manage-faq')
                                                <td>
                                                    <div class="bulk-checkbox-wrapper">
                                                        <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]"
                                                            value="{{ $data->id }}">
                                                    </div>
                                                </td>
                                            @endcan
                                            <td>
                                                <p>
                                                    <strong>English :</strong> {{ $data->title }}
                                                </p>
                                                @if ($data->title_km)
                                                    <p>
                                                        <strong>Khmer :</strong> {{ $data->title_km }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $data->status }} {{ $data->status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ ucfirst($data->status == 'publish' ? __('Publish') : __('Unpublish')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form action="{{ route('admin.faq.status.change', $data->id) }}"
                                                            method="POST" id="status-form-activate-{{ $data->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="publish">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Publish') }}
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.faq.status.change', $data->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $data->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="draft">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Unpublish') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @can('edit-faq')
                                                    <a href="#1" data-bs-toggle="modal"
                                                        data-bs-target="#faq_item_edit_modal"
                                                        class="btn btn-warning btn-xs text-dark mb-2 me-1 faq_edit_btn"
                                                        data-id="{{ $data->id }}" data-title="{{ $data->title }}"
                                                        data-title_km="{{ $data->title_km }}" data-lang="{{ $data->lang }}"
                                                        data-is_open="{{ $data->is_open }}"
                                                        data-description="{{ $data->description }}"
                                                        data-description_km="{{ $data->description_km }}"
                                                        data-status="{{ $data->status }}" title="{{ __('Edit Data') }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('add-faq')
                                                    <form action="{{ route('admin.faq.clone') }}" method="post"
                                                        style="display: inline-block">
                                                        @csrf
                                                        <input type="hidden" name="item_id" value="{{ $data->id }}">
                                                        <button type="submit" title="{{ __('Clone this to new draft') }}"
                                                            class="btn btn-xs btn-secondary btn-sm mb-2 me-1">
                                                            <i class="las la-copy"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                                @can('delete-faq')
                                                    <x-delete-popover :url="route('admin.faq.delete', $data->id)" />
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


    @can('edit-faq')
        <div class="modal fade" id="faq_add_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content custom__form" style="min-height: 450px; overflow-y: scroll;">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add New FAQ') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.faq') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group mt-3">
                                    <label for="title">
                                        {{ __('Title (English)') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="{{ __('Enter title (English)') }}" required="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mt-3">
                                    <label for="title_km">
                                        {{ __('ចំណងជើង (ខ្មែរ)') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="title_km" name="title_km"
                                        placeholder="{{ __('បញ្ចូលចំណងជើង (ខ្មែរ)') }}" required="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mt-3">
                                    <label for="is_open">{{ __('Is Open by Default') }}</label>
                                    <label class="switch">
                                        <input type="checkbox" name="is_open" id="is_open">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mt-3">
                                    <label for="description">
                                        {{ __('Description (English)') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="description" class="summernote"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mt-3">
                                    <label for="description">
                                        {{ __('ការពិពណ៌នា (ខ្មែរ)') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="description_km" class="summernote"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mt-3">
                                    <label for="status">{{ __('Publish Status') }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="publish">{{ __('Publish') }}</option>
                                        <option value="draft">{{ __('Unpublish') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button id="update" type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('edit-faq')
        <div class="modal fade" id="faq_item_edit_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content custom__form" style="min-height: 450px; overflow-y: scroll;">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit FAQ') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.faq.update') }}" id="faq_edit_modal_form" method="post">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id" id="faq_id" value="">
                            <input type="hidden" name="lang" id="faq_lang" value="">
                            <div class="form-group">
                                <label for="edit_title">
                                    {{ __('Title (English)') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_title" name="title"
                                    placeholder="{{ __('Title') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="edit_title_km">
                                    {{ __('ចំណងជើង (ខ្មែរ)') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_title_km" name="title_km"
                                    placeholder="{{ __('បញ្ចូលចំណងជើង (ខ្មែរ)') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="edit_is_open">{{ __('Is Open by Default') }}</label>
                                <label class="switch">
                                    <input type="checkbox" name="is_open" id="edit_is_open">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="edit_description">
                                    {{ __('Description (English)') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" id="edit_description" class="summernote"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="edit_description_km">
                                    {{ __('ការពិពណ៌នា (ខ្មែរ)') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="description_km" id="edit_description_km" class="summernote summernote_km"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="edit_status">
                                    {{ __('Publish Status') }}
                                </label>
                                <select name="status" id="edit_status" class="form-control">
                                    <option value="publish">{{ __('Publish') }}</option>
                                    <option value="draft">{{ __('Unpublish') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button id="update" type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    <x-media.markup />
@endsection
@section('script')
    <x-summernote.js />
    @can('manage-faq')
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
                                        url: "{{ route('admin.faq.bulk.action') }}",
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
        (function($) {
            "use strict";

            $(document).ready(function() {
                // Initialize summernote
                $('.summernote').summernote({
                    height: 250, //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            $(this).val(contents);
                        }
                    }
                });

                // Edit FAQ button click handler
                $(document).on('click', '.faq_edit_btn', function() {
                    var el = $(this);
                    var id = el.data('id');
                    var title = el.data('title');
                    var title_km = el.data('title_km');
                    var description = el.data('description');
                    var description_km = el.data('description_km');
                    var status = el.data('status');
                    var is_open = el.data('is_open');
                    var lang = el.data('lang');

                    var form = $('#faq_edit_modal_form');

                    form.find('#faq_id').val(id);
                    form.find('#edit_title').val(title);
                    form.find('#edit_title_km').val(title_km);
                    form.find('#faq_lang').val(lang);
                    form.find('#edit_status').val(status);

                    // Set the summernote content
                    form.find('.summernote').summernote('code', description);
                    form.find('.summernote_km').summernote('code', description_km);

                    // Set the checkbox state
                    if (is_open == 1) {
                        form.find('#edit_is_open').prop('checked', true);
                    } else {
                        form.find('#edit_is_open').prop('checked', false);
                    }
                });

                $('#faq_edit_modal_form').on('submit', function() {
                    var description = $(this).find('.summernote').summernote('code');
                    var description_km = $(this).find('.summernote_km').summernote('code');
                    $(this).find('#edit_description').val(description);
                    $(this).find('#edit_description_km').val(description_km);
                    return true;
                });
            });
        })(jQuery);
    </script>
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    <x-media.js />
@endsection
