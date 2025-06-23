@extends('backend.admin-master')

@section('site-title', __('Role list'))

@section('style')
    <x-datatable.css />
    <style>
        .swal2-confirm.swal2-styled.swal2-default-outline {
            background-color: var(--danger-color) !important;
        }
    </style>

@endsection

@section('content')
    <div class="bodyContent">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="btn-wrapper mb-4">
                        <a data-bs-toggle="modal" data-bs-target="#createNewRoles" href="#1" class="cmn_btn btn_bg_profile"
                            data-text="Create New Role">
                            {{ __('Create New Role') }}
                        </a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h3 class="dashboard__card__title">{{ __('Admin Roles') }}</h3>
                        </div>
                        <div class="dashboard__card__body mt-4">
                            <x-error-msg />
                            <x-flash-msg />
                            <div class="data-tables table-wrap datatable-primary">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $value)
                                            <tr>
                                                <td> {{ $loop->iteration }} </td>
                                                <td> {{ $value->name }} </td>
                                                <td>
                                                    @if ($value->name != 'Super Admin')
                                                        <a class="btn btn-secondary btn-sm me-1 user_edit_btn"
                                                            href="{{ route('admin.roles.permissions', $value->id) }}">
                                                            <i class="ti-lock"></i>
                                                        </a>

                                                        <a class="btn btn-warning btn-sm me-1 edit_role"
                                                            data-id="{{ $value->id }}" data-name="{{ $value->name }}"
                                                            data-bs-toggle="modal" href="#0"
                                                            data-action="{{ route('admin.roles.update', $value->id) }}"
                                                            data-bs-target="#editRoles">
                                                            <i class="ti-pencil"></i> </a>

                                                        <x-delete-popover type="role" :url="route('admin.roles.destroy', $value->id)" />
                                                        {{-- <x-delete-popover type="role" :url="route('admin.roles.destroy', $value->id)" /> --}}

                                                        {{-- <div class="dropdown custom-dropdown mb-10">
                                                            <button class="dropdown-toggle" type="button"
                                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="las la-ellipsis-h"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('admin.roles.permissions', $value->id) }}">
                                                                        <i class="ti-lock"></i> Permissions </a>
                                                                </li>
                                                            </ul>
                                                        </div> --}}
                                                    @else
                                                        --
                                                    @endif
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
    </div>

    <div class="modal fade" id="createNewRoles" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content custom__form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('New Role') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.roles.store') }}" method="post">
                    <div class="modal-body">

                        @csrf
                        <div class="form-grup">
                            <label for="#">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Enter name') }}">
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
        <div class="modal-dialog">
            <div class="modal-content custom__form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit Role') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        @csrf
                        @method('PUT')
                        <div class="form-grup">
                            <label for="#">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" placeholder="{{ __('enter name') }}">
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
    <x-datatable.js />
    <script>
        (function($) {
            "use strict";

            $(document).on("click", ".edit_role", function(e) {
                e.preventDefault();

                let modalContainer = $("#editRoles");
                modalContainer.find("form").attr("action", $(this).data("action"));
                modalContainer.find("input[name='id']").val($(this).data("id"));
                modalContainer.find("input[name='name']").val($(this).data("name"));

            })
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
