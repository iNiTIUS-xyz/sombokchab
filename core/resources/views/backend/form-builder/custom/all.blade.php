@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0 !important;
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
@endsection

@section('site-title')
    {{ __('All Custom Form') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />

                @can('form-builder-custom-new')
                    <div class="btn-wrapper mb-4">
                        <a href="#1" data-bs-toggle="modal" data-bs-target="#create_new_custom_form"
                            class="btn btn-primary btn-lg text-light" title="{{ __('Add New Form') }}">
                            {{ __('Add New Form') }}
                        </a>
                    </div>
                @endcan
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('All Custom Form') }}
                        </h4>
                        <div class="dashboard__card__header__right">
                            @can('form-builder-custom-bulk-action')
                                <div class="bulk-delete-wrapper">
                                    <div class="select-box-wrap">
                                        <select name="bulk_option" id="bulk_option">
                                            <option value="">
                                                {{ __('Bulk Action') }}
                                            </option>
                                            <option value="delete">
                                                {{ __('Delete') }}
                                            </option>
                                        </select>
                                        <button class="btn btn-primary btn-sm" id="bulk_delete_btn">
                                            {{ __('Apply') }}
                                        </button>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card-body mt-4">
                        <div class="table-wrap table-responsive">
                            <table class="table table-default" id="all_blog_table dataTable">
                                <thead>
                                    @can('form-builder-custom-bulk-action')
                                        <th class="no-sort">
                                            <div class="mark-all-checkbox">
                                                <input type="checkbox" class="all-checkbox">
                                            </div>
                                        </th>
                                    @endcan
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_forms as $data)
                                        <tr>
                                            @can('form-builder-custom-bulk-action')
                                                <td>
                                                    <div class="bulk-checkbox-wrapper">
                                                        <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]"
                                                            value="{{ $data->id }}">
                                                    </div>
                                                </td>
                                            @endcan
                                            <td>{{ $data->title }}</td>
                                            <td>
                                                @can('form-builder-custom-edit')
                                                    <x-edit-icon :url="route('admin.form.builder.edit', $data->id)" />
                                                @endcan
                                                @can('form-builder-custom-delete')
                                                    <x-delete-popover :url="route('admin.form.builder.delete', $data->id)" />
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
    @can('form-builder-custom-new')
        <div class="modal fade" id="create_new_custom_form" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add New Form') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.form.builder.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="text">
                                    {{ __('Title') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="title" placeholder="{{ __('Enter Title') }}"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label for="text">
                                    {{ __('Receiving Email') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control" name="email" placeholder="{{ __('Enter email') }}"
                                    required="">
                                <span class="info-text">
                                    {{ __('your will get mail with all info of from to this email') }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="text">
                                    {{ __('Button Title') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="button_title"
                                    placeholder="{{ __('Enter button title') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="success_message">
                                    {{ __('Success Message') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="success_message"
                                    placeholder="{{ __('Enter form submit success message') }}" required="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('script')
    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {

            $(document).on('click', '#bulk_delete_btn', function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox = $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function (index, value) {
                    allIds.push($(this).val());
                });
                if (allIds != '' && bulkOption == 'delete') {
                    $(this).text('{{ __('Deleting...') }}');
                    $.ajax({
                        'type': "POST",
                        'url': "{{ route('admin.form.builder.bulk.action') }}",
                        'data': {
                            _token: "{{ csrf_token() }}",
                            ids: allIds
                        },
                        success: function (data) {
                            location.reload();
                        }
                    });
                }

            });

            $('.all-checkbox').on('change', function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if (value == true) {
                    allChek.prop('checked', true);
                } else {
                    allChek.prop('checked', false);
                }
            });

            $('.table-wrap > table').DataTable({
                "order": [
                    [1, "desc"]
                ],
                'columnDefs': [{
                    'targets': 'no-sort',
                    'orderable': false
                }],
                language: {
                    search: "Keyword:"
                }
            });
        });
    </script>
@endsection