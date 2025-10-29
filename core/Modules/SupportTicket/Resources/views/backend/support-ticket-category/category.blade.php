@extends('backend.admin-master')

@section('site-title')
    {{ __('Support Departments') }}
@endsection

@section('style')
    <x-bulk-action.css />
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">

        <x-msg.flash />
        <x-msg.error />
        <div class="btn-wrapper mb-4">
            <button class="cmn_btn btn_bg_profile" data-bs-toggle="modal" data-bs-target="#new_support_modal">
                {{ __('Add New Department') }}
            </button>
        </div>
        <div class="dashboard__card">
            <div class="dashboard__card__header">
                <h4 class="dashboard__card__title">{{ __('Support Ticket Departments') }}</h4>
                @can('support-tickets-department-bulk-action')
                    <x-bulk-action.dropdown />
                @endcan
            </div>
            <div class="dashboard__card__body mt-4">
                <div class="table-responsive">
                    <table class="table table-default" id="dataTable">
                        <thead>
                            @can('support-tickets-department-bulk-action')
                                <x-bulk-action.th />
                            @endcan
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Publish Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </thead>
                        <tbody>
                            @foreach ($all_category as $data)
                                <tr>
                                    @can('support-tickets-department-bulk-action')
                                        <x-bulk-action.td :id="$data->id" />
                                    @endcan
                                    <td>{{ $data->name }}</td>
                                    <td>
                                        <div class="btn-group badge">
                                            <button type="button"
                                                class="status-{{ $data->status }} {{ $data->status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ ucfirst($data->status == 'publish' ? __('Publish') : __('Unpublish')) }}
                                            </button>
                                            <div class="dropdown-menu">
                                                {{-- Form for activating --}}
                                                <form action="{{ route('admin.support.ticket.change.status', $data->id) }}"
                                                    method="POST" id="status-form-activate-{{ $data->id }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="publish">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Publish') }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.support.ticket.change.status', $data->id) }}"
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
                                        @can('support-tickets-department-update')
                                            <a href="#1" title="{{ __('Edit Data') }}" data-bs-toggle="modal"
                                                data-bs-target="#category_edit_modal"
                                                class="btn btn-lg btn-warning text-dark btn-sm mb-2 me-1 category_edit_btn"
                                                data-id="{{ $data->id }}" data-name="{{ $data->name }}"
                                                data-status="{{ $data->status }}">
                                                <i class="ti-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('support-tickets-department-delete')
                                            @can('newsletter-delete')
                                                <x-delete-popover :url="route('admin.support.ticket.department.delete', $data->id)" />
                                            @endcan
                                            {{-- <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-2 me-1" role="button"
                                                data-bs-toggle="popover" data-bs-trigger="focus" data-bs-html="true"
                                                title="{{ __('Delete Data') }}"
                                                data-content="<h6>{{ __('Are you sure to delete this category item?') }}</h6><form method='post' action='{{ route('admin.support.ticket.department.delete', $data->id) }}'><input type='hidden' name='_token' value='{{ csrf_token() }}'><br><input type='submit' class='btn btn-danger btn-sm' value='{{ __('Yes, Please') }}'></form>">
                                                <i class="ti-trash"></i>
                                            </a> --}}
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

    @can('support-tickets-department')
        <div class="modal fade" id="new_support_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add New Support Ticket Department') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>

                    <form action="{{ route('admin.support.ticket.department') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="category_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('Enter name') }}">
                            </div>
                            <div class="form-group">
                                <label for="status">
                                    {{ __('Status') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="status" class="form-select" id="status">
                                    <option value="publish">{{ __('Publish') }}</option>
                                    <option value="draft">{{ __('Draft') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endcan

    @can('support-tickets-department-update')
        <div class="modal fade" id="category_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Update Support Ticket Department') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.support.ticket.department.update') }}" method="post">
                        <input type="hidden" name="id" id="category_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="edit_name">
                                    {{ __('Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="{{ __('Enter name') }}">
                            </div>
                            <div class="form-group">
                                <label for="edit_status">
                                    {{ __('Status') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="status" class="form-select" id="edit_status">
                                    <option value="draft">{{ __('Draft') }}</option>
                                    <option value="publish">{{ __('Publish') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('script')
    @can('support-tickets-department-bulk-action')
        <x-bulk-action.js :route="route('admin.support.ticket.department.bulk.action')" />
    @endcan
    <script>
        $(document).ready(function () {
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

            $(document).on('click', '.category_edit_btn', function () {
                var el = $(this);
                var id = el.data('id');
                var name = el.data('name');
                var status = el.data('status');
                var modal = $('#category_edit_modal');
                modal.find('#category_id').val(id);
                modal.find('#edit_status option[value="' + status + '"]').attr('selected', true);
                modal.find('#edit_name').val(name);
            });
        });
    </script>
@endsection