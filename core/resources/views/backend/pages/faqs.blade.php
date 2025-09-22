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
                    @can('faq-create-faq')
                        <a href="#1" data-bs-toggle="modal" data-bs-target="#faq_add_modal"
                            class="cmn_btn btn_bg_profile">{{ __('Add New FAQ') }}</a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('FAQ Items') }}</h4>
                        <div class="dashboard__card__header__right">
                            @can('faq-faq-bulk-action')
                                <div class="bulk-delete-wrapper">
                                    <div class="select-box-wrap">
                                        <select name="bulk_option" id="bulk_option">
                                            <option value="">{{ __('Bulk Action') }}</option>
                                            <option value="delete">{{ __('Delete') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="btn-wrapper">
                                    <button class="btn btn-primary" id="bulk_delete_btn">
                                        {{ __('Apply') }}
                                    </button>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-wrap table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('faq-faq-bulk-action')
                                        <th class="no-sort">
                                            <div class="mark-all-checkbox">
                                                <input type="checkbox" class="all-checkbox">
                                            </div>
                                        </th>
                                    @endcan
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_faqs as $data)
                                        <tr>
                                            @can('faq-faq-bulk-action')
                                                <td>
                                                    <div class="bulk-checkbox-wrapper">
                                                        <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]"
                                                            value="{{ $data->id }}">
                                                    </div>
                                                </td>
                                            @endcan
                                            <td>{{ $data->title }}</td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $data->status }} {{ $data->status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ ucfirst($data->status == 'publish' ? __('Publish') : __('Draft')) }}
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
                                                                {{ __('Draft') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @can('faq-edit-faq')
                                                    <a href="#1" data-bs-toggle="modal" data-bs-target="#faq_item_edit_modal"
                                                        class="btn btn-warning btn-xs text-dark mb-2 me-1 faq_edit_btn"
                                                        data-id="{{ $data->id }}" data-title="{{ $data->title }}"
                                                        data-lang="{{ $data->lang }}" data-is_open="{{ $data->is_open }}"
                                                        data-description="{{ $data->description }}"
                                                        data-status="{{ $data->status }}" title="{{ __('Edit Data') }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('faq-clone-faq')
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
                                                @can('faq-delete-faq')
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


    @can('faq-edit-faq')
        <div class="modal fade" id="faq_add_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add FAQ Item') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.faq') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group mt-3">
                                    <label for="title">
                                        {{ __('Title') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="{{ __('Title') }}" required="">
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
                                        {{ __('Description') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="description" class="summernote"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mt-3">
                                    <label for="status">{{ __('Status') }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="publish">{{ __('Publish') }}</option>
                                        <option value="draft">{{ __('Draft') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button id="update" type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('faq-edit-faq')
        <div class="modal fade" id="faq_item_edit_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit FAQ Item') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.faq.update') }}" id="faq_edit_modal_form" method="post">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id" id="faq_id" value="">
                            <input type="hidden" name="lang" id="faq_lang" value="">

                            <div class="form-group">
                                <label for="edit_title">
                                    {{ __('Title') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_title" name="title"
                                    placeholder="{{ __('Title') }}" required="">
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
                                    {{ __('Description') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" id="edit_description" class="summernote"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="edit_status">
                                    {{ __('Status') }}
                                </label>
                                <select name="status" id="edit_status" class="form-control">
                                    <option value="publish">{{ __('Publish') }}</option>
                                    <option value="draft">{{ __('Draft') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
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
    @can('faq-faq-bulk-action')
        <x-bulk-action-js :url="route('admin.faq.bulk.action')" />
    @endcan
    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                // Initialize summernote
                $('.summernote').summernote({
                    height: 250, //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function (contents, $editable) {
                            $(this).val(contents);
                        }
                    }
                });

                // Edit FAQ button click handler
                $(document).on('click', '.faq_edit_btn', function () {
                    var el = $(this);
                    var id = el.data('id');
                    var title = el.data('title');
                    var description = el.data('description');
                    var status = el.data('status');
                    var is_open = el.data('is_open');
                    var lang = el.data('lang');

                    var form = $('#faq_edit_modal_form');

                    form.find('#faq_id').val(id);
                    form.find('#edit_title').val(title);
                    form.find('#faq_lang').val(lang);
                    form.find('#edit_status').val(status);

                    // Set the summernote content
                    form.find('.summernote').summernote('code', description);

                    // Set the checkbox state
                    if (is_open == 1) {
                        form.find('#edit_is_open').prop('checked', true);
                    } else {
                        form.find('#edit_is_open').prop('checked', false);
                    }
                });

                // Handle form submission to include summernote content
                $('#faq_edit_modal_form').on('submit', function () {
                    var description = $(this).find('.summernote').summernote('code');
                    $(this).find('#edit_description').val(description);
                    return true;
                });
            });
        })(jQuery);
    </script>
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    <x-media.js />
@endsection