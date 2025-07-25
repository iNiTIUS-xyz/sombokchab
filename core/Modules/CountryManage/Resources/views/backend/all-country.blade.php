@extends('backend.admin-master')
@section('site-title')
    {{ __('Country') }}
@endsection
@section('style')
    <x-bulk-action.css />
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <x-msg.error />
        <x-msg.flash />
        <div class="row">
            <div class="col-lg-12">
                @can('country-new')
                    <div class="btn-wrapper mb-4">
                        <button class="cmn_btn btn_bg_profile" data-bs-toggle="modal"
                            data-bs-target="#country_new_modal">{{ __('Add New Country') }}</button>
                    </div>
                @endcan
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Countries') }}</h4>
                        <div class="dashboard__card__header__right">
                            @can('country-bulk-action')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('country-bulk-action')
                                        <x-bulk-action.th />
                                    @endcan
                                    {{-- <th>{{ __('Serial No.') }}</th> --}}
                                    <th>{{ __('Country Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_countries as $country)
                                        <tr>
                                            @can('country-bulk-action')
                                                <x-bulk-action.td :id="$country->id" />
                                            @endcan
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ $country->name }}</td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $country->status }} {{ $country->status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ ucfirst($country->status == 'publish' ? __('Publish') : __('Draft')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- Form for activating --}}
                                                        <form action="{{ route('admin.country.status.update', $country->id) }}"
                                                            method="POST" id="status-form-activate-{{ $country->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="publish">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Publish') }}
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.country.status.update', $country->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $country->id }}">
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
                                                @can('country-update')
                                                    <a href="javascript:;" title="{{ __('Edit Data') }}" data-bs-toggle="modal"
                                                        data-bs-target="#country_edit_modal"
                                                        class="btn btn-warning text-dark btn-sm btn-xs mb-2 me-1 country_edit_btn"
                                                        data-id="{{ $country->id }}" data-name="{{ $country->name }}"
                                                        data-status="{{ $country->status }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('country-delete')
                                                    <x-table.btn.swal.delete :route="route('admin.country.delete', $country->id)" />
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
    @can('country-update')
        <div class="modal fade" id="country_edit_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Update Country') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.country.update') }}" method="post">
                        <input type="hidden" name="id" id="country_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="edit_name">
                                    {{ __('Country Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="{{ __('Enter country name') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="edit_status">{{ __('Status') }}</label>
                                <select name="status" class="form-control" id="edit_status">
                                    <option value="publish">{{ __('Publish') }}</option>
                                    <option value="draft">{{ __('Unpublish') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan


    @can('country-new')
        <div class="modal fade" id="country_new_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add New Country') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.country.new') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="model-body p-4">
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Country Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('Enter country name') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="status">{{ __('Status') }}</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="publish">{{ __('Publish') }}</option>
                                    <option value="draft">{{ __('Unpublish') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('script')
    <x-table.btn.swal.js />
    @can('country-bulk-action')
        <x-bulk-action.js :route="route('admin.country.bulk.action')" />
    @endcan

    <script>
        $(document).ready(function () {
            $(document).on('click', '.country_edit_btn', function () {
                let el = $(this);
                let id = el.data('id');
                let name = el.data('name');
                let status = el.data('status');
                let modal = $('#country_edit_modal');

                modal.find('#country_id').val(id);
                modal.find('#edit_status option[value="' + status + '"]').attr('selected', true);
                modal.find('#edit_name').val(name);
            });
        });
    </script>
@endsection