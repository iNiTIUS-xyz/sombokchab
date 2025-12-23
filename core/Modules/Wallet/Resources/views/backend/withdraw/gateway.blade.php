@extends('backend.admin-master')

@section('site-title', __('wallet payment methods'))

@section('style')
    {{-- Custom styles if needed --}}
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
                                                    <strong>Is Merchant Name</strong> :
                                                    {{ Str::ucfirst($gateway->merchant_name) }}
                                                    <br>
                                                    <strong>Is Merchant ID</strong> :
                                                    {{ Str::ucfirst($gateway->merchant_id) }}
                                                @else
                                                    @if ($gateway->filed)
                                                        {{ implode(' , ', unserialize($gateway->filed)) }}
                                                    @endif
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
                                                        data-merchant-name="{{ $gateway->merchant_name }}"
                                                        data-merchant-id="{{ $gateway->merchant_id }}"
                                                        data-filed="{{ json_encode($gateway->filed ? unserialize($gateway->filed) : []) }}"
                                                        data-route="{{ route('admin.wallet.withdraw.gateway.update', $gateway->id) }}"
                                                        class="btn  btn-sm btn-warning text-dark mb-2 me-1 update-gateway"
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

                        <div class="row mt-3" id="is_merchant" style="display: none;">
                            <div class="col-md-6">
                                <label>
                                    <input type="checkbox" name="merchant_name" value="yes">
                                    {{ __('Requires Merchant Name') }}
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label>
                                    <input type="checkbox" name="merchant_id" value="yes">
                                    {{ __('Requires Merchant ID') }}
                                </label>
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
                                {{ __('Is File (QR Code Upload)') }}
                            </label>
                        </div>

                        <div id="edit_fields_container">
                            <label>{{ __('Method Fields') }}</label>
                            <div class="gateway-filed-body" id="edit_gateway_filed_body">
                                <!-- Dynamic fields will be injected here -->
                            </div>
                        </div>

                        <div class="row mt-3" id="edit_is_merchant" style="display: none;">
                            <div class="col-md-6">
                                <label>
                                    <input type="checkbox" name="merchant_name" id="edit_merchant_name" value="yes">
                                    {{ __('Requires Merchant Name') }}
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label>
                                    <input type="checkbox" name="merchant_id" id="edit_merchant_id" value="yes">
                                    {{ __('Requires Merchant ID') }}
                                </label>
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

            $('#is_file_checkbox').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#filed_container').hide();
                    $('#filed_container input[name="filed[]"]').prop('required', false).prop('disabled',
                        true);
                    $('#is_merchant').show();
                } else {
                    $('#filed_container').show();
                    $('#filed_container input[name="filed[]"]').prop('required', true).prop('disabled',
                        false);
                    $('#is_merchant').hide();
                }
            });


            $('#edit_is_file_checkbox').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#edit_fields_container').hide();
                    $('#edit_fields_container input[name="filed[]"]').prop('required', false).prop(
                        'disabled', true);
                    $('#edit_is_merchant').show();
                } else {
                    $('#edit_fields_container').show();
                    $('#edit_fields_container input[name="filed[]"]').prop('required', true).prop(
                        'disabled', false);
                    $('#edit_is_merchant').hide();
                }
            });


            $(document).on('click', '.gateway-filed-add', function() {
                const container = $(this).closest('.gateway-filed-body');

                container.append(`
                <div class="row gateway-field-row mt-2">
                    <div class="col-md-10">
                        <input
                            class="form-control"
                            name="filed[]"
                            placeholder="{{ __('Enter field name') }}"
                            required
                        >
                    </div>
                    <div class="col-md-2 text-center">
                        <button type="button" class="btn btn-danger btn-sm gateway-filed-remove">
                            <i class="las la-trash-alt"></i>
                        </button>
                    </div>
                </div>
            `);
            });

            $(document).on('click', '.gateway-filed-remove', function() {
                $(this).closest('.gateway-field-row').remove();
            });


            $(document).on('click', '.update-gateway', function() {

                const id = $(this).data('id');
                const name = $(this).data('name');
                const status = $(this).data('status');
                const isFile = $(this).data('is-file');
                const merchantName = $(this).data('merchant-name') === 'yes';
                const merchantId = $(this).data('merchant-id') === 'yes';
                const routeUrl = $(this).data('route');

                let fields = $(this).data('filed') || [];

                if (typeof fields === 'string') {
                    try {
                        fields = JSON.parse(fields);
                    } catch {
                        fields = [];
                    }
                }

                $('#edit-gateway-form').attr('action', routeUrl);
                $('#edit_gateway_id').val(id);
                $('#edit_gateway_name').val(name);
                $('#edit_status_id').val(status);

                $('#edit_is_file_checkbox').prop('checked', isFile === 'yes');
                $('#edit_merchant_name').prop('checked', merchantName);
                $('#edit_merchant_id').prop('checked', merchantId);

                let html = '';

                if (Array.isArray(fields) && fields.length) {
                    fields.forEach((field, index) => {
                        html += `
                        <div class="row gateway-field-row mt-2">
                            <div class="col-md-10">
                                <input
                                    class="form-control"
                                    name="filed[]"
                                    value="${field}"
                                    placeholder="{{ __('Enter field name') }}"
                                >
                            </div>
                            <div class="col-md-2 text-center">
                                ${index === 0 ? `
                                                                                        <button type="button" class="btn btn-primary btn-sm gateway-filed-add">
                                                                                            <i class="las la-plus"></i>
                                                                                        </button>
                                                                                    ` : `
                                                                                        <button type="button" class="btn btn-danger btn-sm gateway-filed-remove">
                                                                                            <i class="las la-trash-alt"></i>
                                                                                        </button>
                                                                                    `}
                            </div>
                        </div>
                    `;
                    });
                } else {
                    html = `
                    <div class="row gateway-field-row mt-2">
                        <div class="col-md-10">
                            <input
                                class="form-control"
                                name="filed[]"
                                placeholder="{{ __('Enter field name') }}"
                            >
                        </div>
                        <div class="col-md-2 text-center">
                            <button type="button" class="btn btn-primary btn-sm gateway-filed-add">
                                <i class="las la-plus"></i>
                            </button>
                        </div>
                    </div>
                `;
                }

                $('#edit_gateway_filed_body').html(html);

                if (isFile === 'yes') {
                    $('#edit_fields_container').hide();
                    $('#edit_fields_container input').prop('required', false).prop('disabled', true);
                    $('#edit_is_merchant').show();
                } else {
                    $('#edit_fields_container').show();
                    $('#edit_fields_container input').prop('required', true).prop('disabled', false);
                    $('#edit_is_merchant').hide();
                }
            });

            $('#edit-gateway-form').on('submit', function() {
                if ($('#edit_is_file_checkbox').is(':checked')) {
                    $('#edit_fields_container input[name="filed[]"]')
                        .prop('required', false)
                        .prop('disabled', true);
                }
            });

            $('#add-gateway-modal, #edit-gateway-modal').on('hidden.bs.modal', function() {

                this.reset?.();

                $('#add_gateway_filed_body').html(`
                <div class="row gateway-field-row mt-2">
                    <div class="col-md-10">
                        <input
                            class="form-control"
                            name="filed[]"
                            placeholder="{{ __('Enter field name') }}"
                            required
                        >
                    </div>
                    <div class="col-md-2 text-center">
                        <button type="button" class="btn btn-primary btn-sm gateway-filed-add">
                            <i class="las la-plus"></i>
                        </button>
                    </div>
                </div>
            `);

                $('#filed_container, #edit_fields_container').show();
                $('#is_merchant, #edit_is_merchant').hide();

                $('#filed_container input, #edit_fields_container input')
                    .prop('required', true)
                    .prop('disabled', false);
            });

        });
    </script>
@endsection
