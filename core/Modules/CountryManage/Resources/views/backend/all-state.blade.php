@extends('backend.admin-master')
@section('site-title')
    {{ __('Provinces') }}
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
                @can('state-new')
                    <div class="btn-wrapper mb-4">
                        <button class="cmn_btn btn_bg_profile" data-bs-target="#state_create_modal" data-bs-toggle="modal">
                            {{ __('Add New Province') }}
                        </button>
                    </div>
                @endcan
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Provinces') }}</h4>
                        <div class="dashboard__card__header__right">
                            @can('state-bulk-action')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('state-bulk-action')
                                        <x-bulk-action.th />
                                    @endcan
                                    {{-- <th>{{ __('Serial No.') }}</th> --}}
                                    <th>{{ __('Province Name') }}</th>
                                    <th>{{ __('Country') }}</th>
                                    <th>{{ __('Publish Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_states as $state)
                                        <tr>
                                            @can('state-bulk-action')
                                                <x-bulk-action.td :id="$state->id" />
                                            @endcan
                                            <td>{{ $state->name }}</td>
                                            <td>{{ optional($state->country)->name }}</td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $state->status }} {{ $state->status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ ucfirst($state->status == 'publish' ? __('Publish') : __('Unpublish')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        {{-- Form for activating --}}
                                                        <form action="{{ route('admin.state.status.update', $state->id) }}"
                                                            method="POST" id="status-form-activate-{{ $state->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="publish">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Publish') }}
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.state.status.update', $state->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $state->id }}">
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
                                                @can('state-update')
                                                    <a href="javascript:;" title="{{ __('Edit Data') }}" data-bs-toggle="modal"
                                                        data-bs-target="#state_edit_modal"
                                                        class="btn btn-warning text-dark btn-sm btn-xs mb-2 me-1 state_edit_btn"
                                                        data-id="{{ $state->id }}" data-name="{{ $state->name }}"
                                                        data-country_id="{{ $state->country_id }}"
                                                        data-status="{{ $state->status }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('state-delete')
                                                    <x-table.btn.swal.delete :route="route('admin.state.delete', $state->id)" />
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
    @can('state-update')
        <div class="modal fade" id="state_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Update Province') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.state.update') }}" method="post">
                        <input type="hidden" name="id" id="state_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="edit_name">
                                    {{ __('Province Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="{{ __('Enter province name') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="edit_country_id">
                                    {{ __('Country') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="country_id" class="form-control" id="edit_country_id" required="">
                                    @foreach ($all_countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    @can('state-new')
        <div class="modal fade" id="state_create_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Create Province') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.state.new') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body p-4">
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Province Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('Enter Province Name') }}" required="">
                            </div>

                            <div class="form-group">
                                <label for="country_id">
                                    {{ __('Country') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="country_id" class="form-control" id="country_id" required="">
                                    @foreach ($all_countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
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
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">{{ __('Add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('script')
    <x-table.btn.swal.js />
    @can('state-bulk-action')
        <x-bulk-action.js :route="route('admin.state.bulk.action')" />
    @endcan

    <script>
        $(document).ready(function () {
            $(document).on('click', '.state_edit_btn', function () {
                let el = $(this);
                let id = el.data('id');
                let name = el.data('name');
                let country_id = el.data('country_id');
                let status = el.data('status');
                let modal = $('#state_edit_modal');

                modal.find('#state_id').val(id);
                modal.find('#edit_status option[value="' + status + '"]').attr('selected', true);
                modal.find('#edit_name').val(name);
                modal.find('#edit_country_id').val(country_id);
            });
        });
    </script>
@endsection