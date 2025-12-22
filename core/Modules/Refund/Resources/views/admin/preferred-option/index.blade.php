@extends('backend.admin-master')

@section('site-title', __('Vendor withdraw gateway page'))

@section('style')
    <style>
        .w-90 {
            width: 90%;
        }

        .w-20 {
            width: 20%;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row g-4">
            <div class="col-12">
                <div class="btn-wrapper mb-4">
                    <a data-bs-toggle="modal" data-bs-target="#add-refund-modal" href="#1" class="cmn_btn btn_bg_profile"
                        data-text="Create New Role">
                        {{ __('Add New Refund Payment Method') }}
                    </a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="dashboard__card card__two">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Refund Payment Methods') }}</h4>
                    </div>
                    <div class="dashboard__card__body">
                        <div class="table-wrap">
                            <table class="table-responsive table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Payment Method') }}</th>
                                        <th>{{ __('Method Fields') }}</th>
                                        <th>{{ __('Payment Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($preferredOptions as $key => $preferredOption)
                                        <tr>
                                            <td>{{ $preferredOption->name }}</td>
                                            <td>
                                                @if ($preferredOption->is_file == 'yes')
                                                    <strong>{{ __('Attachment Required') }}</strong>
                                                    <br>
                                                @endif
                                                @if ($preferredOption->fields)
                                                    {{ implode(' , ', unserialize($preferredOption->fields)) }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $preferredOption->status_id }} {{ $preferredOption->status_id == 1 ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ ucfirst($preferredOption->status_id == 1 ? __('Active') : __('Inactive')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form
                                                            action="{{ route('admin.refund.preferred-option.status.change', $preferredOption->id) }}"
                                                            method="POST"
                                                            id="status-form-activate-{{ $preferredOption->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="1">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Active') }}
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('admin.refund.preferred-option.status.change', $preferredOption->id) }}"
                                                            method="POST"
                                                            id="status-form-deactivate-{{ $preferredOption->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="2">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Inactive') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @can('manage-refund-request-settings')
                                                    <a href="javascript:;" title="{{ __('Edit') }}"
                                                        data-name="{{ $preferredOption->name }}"
                                                        data-id="{{ $preferredOption->id }}"
                                                        data-status="{{ $preferredOption->status_id }}"
                                                        data-is-file="{{ $preferredOption->is_file }}"
                                                        data-filed="{{ json_encode(unserialize($preferredOption->fields)) }}"
                                                        data-route="{{ route('admin.refund.preferred-option.update', $preferredOption->id) }}"
                                                        class="btn btn-sm btn-warning text-dark mb-2 me-1 update-gateway"
                                                        data-bs-toggle="modal" data-bs-target="#edit-gateway-modal">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan

                                                @can('manage-refund-request-settings')
                                                    <x-table.btn.swal.delete :route="route(
                                                        'admin.refund.preferred-option.delete',
                                                        $preferredOption->id,
                                                    )" />
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

    <!-- Add Refund Modal  -->
    <div class="modal fade" id="add-refund-modal" tabindex="-1" aria-hidden="true" aria-labelledby="add-refund-modalLabel">
        <form method="POST" action="{{ route('admin.refund.preferred-option.store') }}">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>{{ __('Create Refund Payment Method') }}</b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body overflow-auto" style="max-height:550px;">
                        <div class="form-group">
                            <label class="w-100">
                                {{ __('Name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" name="gateway_name" placeholder="{{ __('Enter method name') }}"
                                required>

                            <small class="info">
                                {{ __('If you want to merge refund value to user wallet, then use Wallet like this') }}<br>
                                {{ __('Only for wallet') }}
                            </small>
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_file" id="is_file_checkbox" value="yes">
                                {{ __('Include Attachment (jpg, jpeg, png only)') }}
                            </label>
                        </div>

                        <div id="filed_container">
                            <label>{{ __('Method Fields') }}</label>
                            <div class="gateway-filed-body" id="add_gateway_filed_body">
                                <div class="row gateway-field-row mt-2">
                                    <div class="col-md-10">
                                        <input class="form-control" name="filed[]"
                                            placeholder="{{ __('Enter field name') }}" required>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <button type="button" class="btn btn-primary btn-sm gateway-filed-add">
                                            <i class="las la-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label>
                                {{ __('Select Status') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select name="status_id" class="form-control" required>
                                <option value="">{{ __('Select Status') }}</option>
                                <option value="1">{{ __('Active') }}</option>
                                <option value="2">{{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="edit-gateway-modal" tabindex="-1" aria-labelledby="edit-gateway-modalLabel"
        aria-hidden="true">
        <form class="" method="POST" action="" id="edit-gateway-form">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    @can('manage-refund-request-settings')
                        <input type="hidden" value="" name="id" />

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ __('Refund Payment Method Update') }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body overflow-auto" style="max-height: 550px;">
                            <div class="form-group">
                                <label class="w-100">
                                    {{ __('Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" name="gateway_name" placeholder="{{ __('Enter gateway name') }}"
                                    id="edit_gateway_name">
                                <small class="info">
                                    {{ __('If you want to merge refund value to user wallet, then use Wallet like this') }} .
                                    {{ __('Only for wallet') }}
                                </small>
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="is_file" id="edit_is_file_checkbox" value="yes">
                                    {{ __('Is File (QR Code Upload)') }}
                                </label>
                            </div>

                            <div id="edit_fields_container">
                                <label>{{ __('Method Fields') }}</label>
                                <div class="gateway-filed-body" id="edit_gateway_filed_body">
                                    <!-- Dynamic fields will be injected here -->
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label>
                                    {{ __('Select Status') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="status_id" class="form-control" required="" id="edit_status_id">
                                    <option value="">{{ __('Select Status') }}</option>
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="2">{{ __('inactive') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    @endcan
                </div>
            </div>
        </form>
    </div>
@endsection


@section('script')
    <x-table.btn.swal.js />

    <script>
        $(document).ready(function() {


            $(document).on('click', '.gateway-filed-add', function() {
                let container = $(this).closest('.gateway-filed-body');

                container.append(`
                    <div class="row gateway-field-row mt-2">
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="filed[]" placeholder="{{ __('Enter field name') }}">
                        </div>
                        <div class="col-md-2 text-center">
                            <button type="button" class="btn btn-danger btn-sm gateway-filed-remove">
                                <i class="las la-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                `);
            });

            /*==============================
            REMOVE FIELD
            ==============================*/
            $(document).on('click', '.gateway-filed-remove', function() {
                $(this).closest('.gateway-field-row').remove();
            });

            function toggleFileFieldsReadonly(checkboxId, bodyId) {
                $(document).on('change', checkboxId, function() {
                    let $inputs = $(bodyId + ' input[name="filed[]"]');
                    if ($(this).is(':checked')) {
                        $inputs.prop('readonly', true)
                            .prop('required', false)
                            .addClass('readonly-field');
                    } else {
                        $inputs.prop('readonly', false)
                            .prop('required', true)
                            .removeClass('readonly-field');
                    }
                });
            }

            toggleFileFieldsReadonly('#edit_is_file_checkbox', '#edit_gateway_filed_body');
            toggleFileFieldsReadonly('#add_is_file_checkbox', '#add_gateway_filed_body');

            $(document).on('click', '.update-gateway', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let status = $(this).data('status');
                let isFile = $(this).data('is-file');
                let route = $(this).data('route');
                let fields = $(this).data('filed') || [];

                if (typeof fields === 'string') {
                    try {
                        fields = JSON.parse(fields);
                    } catch (e) {
                        fields = [];
                    }
                }

                // Reset form
                $('#edit-gateway-form')[0].reset();
                $('#edit_gateway_filed_body').empty();

                // Set values
                $('#edit-gateway-form').attr('action', route);
                $('#edit_gateway_id').val(id);
                $('#edit_gateway_name').val(name);
                $('#edit_status_id').val(status);
                $('#edit_is_file_checkbox').prop('checked', isFile === 'yes');

                let htmlCode = '';
                if (fields.length === 0) {
                    fields = ['']; // at least one empty field
                }

                fields.forEach((field, index) => {
                    let value = field || '';
                    htmlCode += `
                        <div class="row gateway-field-row mt-2">
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="filed[]" value="${value}" placeholder="{{ __('Enter field name') }}">
                            </div>
                            <div class="col-md-2 text-center">
                                ${index === 0
                                    ? `<button type="button" class="btn btn-primary btn-sm gateway-filed-add"><i class="las la-plus"></i></button>`
                                    : `<button type="button" class="btn btn-danger btn-sm gateway-filed-remove"><i class="las la-trash-alt"></i></button>`
                                }
                            </div>
                        </div>
                    `;
                });

                $('#edit_gateway_filed_body').html(htmlCode);

                // Trigger change to apply readonly if needed
                $('#edit_is_file_checkbox').trigger('change');
            });

            /*==============================
            RESET MODALS ON CLOSE
            ==============================*/
            $('#add-gateway-modal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                $('#add_gateway_filed_body').html(`
                    <div class="row gateway-field-row mt-2">
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="filed[]" placeholder="{{ __('Enter field name') }}" required>
                        </div>
                        <div class="col-md-2 text-center">
                            <button type="button" class="btn btn-primary btn-sm gateway-filed-add">
                                <i class="las la-plus"></i>
                            </button>
                        </div>
                    </div>
                `);
                $('#add_is_file_checkbox').trigger('change');
            });

            $('#edit-gateway-modal').on('hidden.bs.modal', function() {
                $('#edit_gateway_filed_body').empty();
                $('#edit-gateway-form')[0].reset();
            });
        });
    </script>
@endsection
