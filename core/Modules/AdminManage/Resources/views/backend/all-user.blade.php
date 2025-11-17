@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">
    {{-- @include('backend.partials.datatable.style-enqueue') --}}
@endsection
@section('site-title')
    {{ __('All Admins') }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        @include('backend/partials/message')
        @include('backend/partials/error')
        <div class="row">
            <div class="col-12">
                <div class="btn-wrapper mb-4">
                    <a href="{{ route('admin.new.user') }}" class="cmn_btn btn_bg_profile">
                        Add New Admin
                    </a>
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Admin Accounts') }}
                            <small>
                                (created by SuperAdmin)
                            </small>
                        </h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table id="dataTable" class="table">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Role') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_user as $data)
                                        <tr>
                                            <td>{{ $data->name }} ({{ $data->username }})</td>
                                            <td>
                                                @php
                                                    $img = get_attachment_image_by_id($data->image, null, true);
                                                @endphp
                                                @if (!empty($img))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb" src="{{ $img['img_url'] }}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php $img_url = $img['img_url']; @endphp
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($data->getRoleNames()))
                                                    @foreach ($data->getRoleNames() as $v)
                                                        {{ $v }}
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @can('manage-site-settings')
                                                    <a href="#1" data-id="{{ $data->id }}" data-bs-toggle="modal"
                                                        title="{{ __('Change Password') }}"
                                                        data-bs-target="#user_change_password_modal"
                                                        class="btn btn-sm btn-secondary mb-2 me-1 user_change_password_btn">
                                                        <i class="ti-key"></i>
                                                    </a>
                                                @endcan

                                                @can('manage-site-settings')
                                                    <a href="{{ route('admin.user.edit', $data->id) }}"
                                                        class="btn btn-lg btn-warning text-dark btn-sm mb-2 me-1 user_edit_btn" title="Edit Data">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan

                                                @can('manage-site-settings')
                                                    <x-delete-popover :url="route('admin.delete.user', $data->id)" />
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

    @can('admin-user-password-change')
        <div class="modal fade" id="user_change_password_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Change Admin Password') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    @include('backend/partials/error')
                    <form action="{{ route('admin.user.password.change') }}" id="user_password_change_modal_form" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="ch_user_id" id="ch_user_id">
                            <div class="form-group">
                                <label for="password">
                                    {{ __('Password') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="{{ __('Enter Password') }}"  required="">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">
                                    {{ __('Confirm Password') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="{{ __('Enter confirm Password') }}" required="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Change Password') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $(document).on('click', '.user_change_password_btn', function (e) {
                    e.preventDefault();
                    var el = $(this);
                    var form = $('#user_password_change_modal_form');
                    form.find('#ch_user_id').val(el.data('id'));
                });
                $('#all_user_table').DataTable({
                    "order": [
                        [0, "desc"]
                    ]
                });

            });

        })(jQuery);
    </script>
@endsection