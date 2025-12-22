@extends('backend.admin-master')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/media-uploader.css') }}">

    <style>
        .form-select {
            width: 100%;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            color: var(--paragraph-color);
            height: 48px !important;
            border: 1px solid var(--border-two) !important;
            border-radius: 5px !important;
        }

        .form-select:focus {
            box-shadow: 0 0 10px rgb(5 205 153 / 10%) !important;
            border-color: rgba(5, 205, 153, 0.3) !important;
        }
    </style>
@endsection

@section('site-title', __('Role list'))

@section('content')
    <div class="bodyContent">
        <div class="row">
            <div class="col-12">
                <div class="btn-wrapper mb-4">
                    <a data-bs-toggle="modal" data-bs-target="#createNewRoles" href="#1" class="cmn_btn btn_bg_profile"
                        data-text="Create New Role">
                        {{ __('Add New Role') }}
                    </a>
                </div>
            </div>
            <div class="col-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h3 class="dashboard__card__title">{{ __('Admin Roles') }}</h3>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="data-tables datatable-primary">
                            @if ($roles->isNotEmpty())
                                <table id="dataTable" class="table dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th style="display: none;">{{ __('Hierarchy') }}</th>
                                            <th>{{ __('Role') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $value)
                                            <tr>
                                                <td style="display: none;"> {{ $value->id }} </td>
                                                <td> {{ $value->name }} </td>
                                                <td>
                                                    @if ($value->name != 'Super Admin')
                                                        <a title="{{ __('Permission') }}"
                                                            class="btn btn-secondary btn-sm me-1 user_edit_btn"
                                                            href="{{ route('admin.roles.permissions', $value->id) }}">
                                                            <i class="ti-lock"></i>
                                                        </a>
                                                        <a title="{{ __('Edit') }}"
                                                            class="btn btn-warning text-dark btn-sm me-1 edit_role"
                                                            data-id="{{ $value->id }}" data-name="{{ $value->name }}"
                                                            data-bs-toggle="modal" href="#0"
                                                            data-action="{{ route('admin.roles.update', $value->id) }}"
                                                            data-bs-target="#editRoles">
                                                            <i class="ti-pencil"></i> </a>
                                                        <x-delete-popover type="role" :url="route('admin.roles.destroy', $value->id)" />
                                                    @else
                                                        --
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <span class="text-warning">You have no role yet.</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createNewRoles" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom__form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <b>{{ __('Add New Role') }}</b> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.roles.store') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-grup">
                            <label for="#">
                                {{ __('Name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Enter name') }}"
                                required="">
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
    <div class="modal fade" id="editRoles" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom__form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>{{ __('Edit Role') }}</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        @csrf
                        @method('PUT')

                        <div class="form-grup mt-4">
                            <label for="#">
                                {{ __('Name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Enter name') }}"
                                required="">
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
@endsection

@section('script')
    <script>
        (function($) {
            "use strict";

            $(document).on("click", ".edit_role", function(e) {
                e.preventDefault();

                let modalContainer = $("#editRoles");

                // Set the form action dynamically
                modalContainer.find("form").attr("action", $(this).data("action"));

                // Set hidden input ID
                modalContainer.find("input[name='id']").val($(this).data("id"));

                // Set name
                modalContainer.find("input[name='name']").val($(this).data("name"));
            });
        })(jQuery);
    </script>
    <script>
        $(document).ready(function() {
            // Function to get URL parameter by name
            function getUrlParameter(name) {
                name = name.replace(/[\[\]]/g, '\\$&');
                var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                    results = regex.exec(window.location.href);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, ' '));
            }

            // Check if create=add_new_role exists in URL
            var createParam = getUrlParameter('create');
            if (createParam === 'add_new_role') {
                // Open your modal here
                // Replace '#yourModalId' with your actual modal's ID
                $('#createNewRoles').modal('show');

                // Optional: Remove the parameter from URL without reloading
                if (history.pushState) {
                    var newurl = window.location.protocol + "//" + window.location.host +
                        window.location.pathname;
                    window.history.pushState({
                        path: newurl
                    }, '', newurl);
                }
            }
        });
    </script>
@endsection
