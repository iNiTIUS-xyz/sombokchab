@extends('backend.admin-master')

@section('site-title', __('wallet payment methods'))

@section('style')
    <style>
        .readonly-field {
            background-color: #f8f9fa;
            opacity: 0.7;
            cursor: not-allowed;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-12">
                <div class="btn-wrapper mb-4">
                    <a data-bs-toggle="modal" data-bs-target="#add-gateway-modal" href="#" class="cmn_btn btn_bg_profile">
                        {{ __('Add New Payment Method') }}
                    </a>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="dashboard__card card__two">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Wallet Payment Methods') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Payment Method') }}</th>
                                        <th>{{ __('Method Fields') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gateways as $key => $gateway)
                                        <tr>
                                            <td>{{ $gateway->name }}</td>
                                            <td>
                                                @if ($gateway->is_file == 'yes')
                                                    <strong>{{ __('Attachment Required') }}</strong>
                                                    <br>
                                                @endif
                                                @if ($gateway->filed)
                                                    {{ implode(' , ', unserialize($gateway->filed)) }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $gateway->status_id }} {{ $gateway->status_id == 1 ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ ucfirst($gateway->status_id == 1 ? __('Active') : __('Inactive')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form
                                                            action="{{ route('admin.wallet.withdraw.gateway.status.change', $gateway->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="1">
                                                            <button type="submit"
                                                                class="dropdown-item">{{ __('Active') }}</button>
                                                        </form>
                                                        <form
                                                            action="{{ route('admin.wallet.withdraw.gateway.status.change', $gateway->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="2">
                                                            <button type="submit"
                                                                class="dropdown-item">{{ __('Inactive') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @can('manage-wallet')
                                                    <a type="button" title="{{ __('Edit') }}"
                                                        data-name="{{ $gateway->name }}" data-id="{{ $gateway->id }}"
                                                        data-status="{{ $gateway->status_id }}"
                                                        data-is-file="{{ $gateway->is_file }}"
                                                        data-merchant-name="{{ $gateway->merchant_name ?? '' }}"
                                                        data-merchant-id="{{ $gateway->merchant_id ?? '' }}"
                                                        data-filed="{{ json_encode($gateway->filed ? unserialize($gateway->filed) : []) }}"
                                                        data-route="{{ route('admin.wallet.withdraw.gateway.update', $gateway->id) }}"
                                                        class="btn btn-sm btn-warning text-dark mb-2 me-1 update-gateway"
                                                        data-bs-toggle="modal" data-bs-target="#edit-gateway-modal">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('manage-wallet')
                                                    <x-table.btn.swal.delete :route="route(
                                                        'admin.wallet.withdraw.gateway.delete',
                                                        $gateway->id,
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

    <!-- Add Gateway Modal -->
    <div class="modal fade" id="add-gateway-modal" tabindex="-1" aria-hidden="true">
        <form method="POST" action="{{ route('admin.wallet.withdraw.gateway') }}">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>{{ __('Add Wallet Payment Method') }}</b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body overflow-auto" style="max-height:550px;">
                        <div class="form-group">
                            <label class="w-100">{{ __('Name:') }} <span class="text-danger">*</span></label>
                            <input class="form-control" name="gateway_name" required
                                placeholder="{{ __('Enter method name') }}">
                        </div>

                        <div class="form-group mt-3">
                            <label>
                                <input type="checkbox" name="is_file" id="add_is_file_checkbox" value="yes">
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
                            <label>{{ __('Select Status') }} <span class="text-danger">*</span></label>
                            <select name="status_id" class="form-control" required>
                                <option value="" disabled selected>{{ __('Select Status') }}</option>
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

    <!-- Edit Gateway Modal -->
    <div class="modal fade" id="edit-gateway-modal" tabindex="-1" aria-hidden="true">
        <form method="POST" action="" id="edit-gateway-form">
            @csrf
            <input type="hidden" name="id" id="edit_gateway_id">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>{{ __('Update Payment Method') }}</b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body overflow-auto" style="max-height:550px;">
                        <div class="form-group">
                            <label class="w-100">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input class="form-control" id="edit_gateway_name" name="gateway_name" required>
                        </div>

                        <div class="form-group mt-3">
                            <label>
                                <input type="checkbox" name="is_file" id="edit_is_file_checkbox" value="yes">
                                {{ __('Include Attachment (jpg, jpeg, png only)') }}
                            </label>
                        </div>

                        <div id="edit_fields_container">
                            <label>{{ __('Method Fields') }}</label>
                            <div class="gateway-filed-body" id="edit_gateway_filed_body">
                                <!-- Dynamic fields will be injected here -->
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label>{{ __('Select Status') }} <span class="text-danger">*</span></label>
                            <select id="edit_status_id" name="status_id" class="form-control" required>
                                <option value="">{{ __('Select Status') }}</option>
                                <option value="1">{{ __('Active') }}</option>
                                <option value="2">{{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <x-table.btn.swal.js />

    <script>
        $(document).ready(function() {

            /*==============================
            ADD FIELD (ADD & EDIT MODAL)
            ==============================*/
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

            /*==============================
            TOGGLE READONLY ON IS_FILE CHECKBOX (EDIT & ADD)
            ==============================*/
            /*
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
            */
            /*==============================
            EDIT GATEWAY - LOAD DATA
            ==============================*/
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
