@extends('backend.admin-master')
@section('site-title')
    {{ __('Category Page') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.success />
                @can('blog-category-create')
                    <div class="btn-wrapper mb-4">
                        <a data-bs-toggle="modal" data-bs-target="#new_category_modal" class="cmn_btn btn_bg_profile pull-right"
                            title="{{ __('New category') }}">
                            {{ __('New Category') }}
                        </a>
                    </div>
                @endcan
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Categories') }}</h4>
                        <div class="dashboard__card__header__right">
                            <div class="bulk-delete-wrapper">
                                @can('blog-category-delete')
                                    <x-bulk-action />
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    <x-bulk-th />
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_category as $data)
                                        <tr>
                                            <td>
                                                <x-bulk-delete-checkbox :id="$data->id" />
                                            </td>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $data->status }} {{ $data->status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ ucfirst($data->status == 'publish' ? __('Publish') : __('Draft')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form
                                                            action="{{ route('admin.blog.category.status.change', $data->id) }}"
                                                            method="POST" id="status-form-activate-{{ $data->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="publish">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Publish') }}
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('admin.blog.category.status.change', $data->id) }}"
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
                                                @can('blog-category-edit')
                                                    <a href="javascript;;" data-bs-toggle="modal"
                                                        data-bs-target="#category_edit_modal" title="{{ __('Edit Data') }}"
                                                        class="btn btn-warning btn-xs text-dark mb-2 me-1 category_edit_btn"
                                                        data-id="{{ $data->id }}" data-name="{{ $data->name }}"
                                                        data-lang="{{ $data->lang }}" data-status="{{ $data->status }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('blog-category-delete')
                                                    <x-delete-popover :url="route('admin.blog.category.delete', $data->id)" />
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
    @can('blog-category-create')
        <div class="modal fade" id="new_category_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add New Category') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.blog.category') }}" method="post">
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
                            <div class="form-group">
                                <label for="status">
                                    {{ __('Status') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="status" class="form-control" id="status" required="">
                                    <option value="publish">{{ __('Publish') }}</option>
                                    <option value="draft">{{ __('Draft') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>
                            <button id="submit" type="submit" class="btn btn-primary">
                                {{ __('Add') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    @can('blog-category-edit')
        <div class="modal fade" id="category_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Update Category') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.blog.category.update') }}" method="post">
                        <input type="hidden" name="id" id="category_id">
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
                            <div class="form-group">
                                <label for="edit_status">
                                    {{ __('Status') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="status" class="form-control" id="edit_status" required="">
                                    <option value="draft">{{ __('Draft') }}</option>
                                    <option value="publish">{{ __('Publish') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>
                            <button id="update" type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('script')
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                // Edit button click
                $(document).on('click', '.category_edit_btn', function () {
                    let el = $(this);
                    let id = el.data('id');
                    let name = el.data('name');
                    let status = el.data('status');

                    let modal = $('#category_edit_modal');
                    modal.find('#category_id').val(id);
                    modal.find('#edit_name').val(name);
                    modal.find('#edit_status').val(status);
                });
            });
        })(jQuery);
    </script>

@endsection