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
                {{--
            <x-msg.error />
            <x-flash-msg /> --}}
                <div class="dashboard__card card__two">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Refund Payment Methods') }}</h4>
                    </div>
                    <div class="dashboard__card__body">
                        <div class="table-wrap">
                            <table class="table-responsive table" id="dataTable">
                                <thead>
                                    <tr>
                                        {{-- <th>{{ __('Serial No.') }}</th> --}}
                                        <th>{{ __('Payment Method') }}</th>
                                        <th>{{ __('Method Fields') }}</th>
                                        <th>{{ __('Is File') }}</th>
                                        <th>{{ __('Payment Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($preferredOptions as $preferredOption)
                                        <tr>
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ $preferredOption->name }}</td>
                                            <td>
                                                @if ($preferredOption->is_file == 'yes')
                                                    {{ __('File Upload Required') }}
                                                @else
                                                    @if ($preferredOption->fields)
                                                        {{ implode(' , ', unserialize($preferredOption->fields)) }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <x-status-span :status="$preferredOption->is_file" />
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
                                                        data-blog-filed="{{ json_encode(unserialize($preferredOption->fields)) }}"
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
                                {{ __('Is File') }}
                            </label>
                        </div>

                        <!-- unified dashboard card / field body -->
                        <div class="dashboard__card card__two overflow-auto" id="filed_container">
                            <div class="dashboard__card__header">
                                <h4 class="dashboard__card__title">{{ __('Method field') }}</h4>
                            </div>
                            <div class="dashboard__card__body">
                                <div class="form-group row gateway-filed-body" id="add_gateway_filed_body">
                                    <!-- initial single row (JS will clone this via gateway-filed-add) -->
                                    <div class="form-group row mb-2">
                                        <div class="w-90 d-flex align-items-center">
                                            <input class="form-control" name="filed[]"
                                                placeholder="{{ __('Enter filed name') }}">
                                        </div>
                                        <div
                                            class="col-md-1 d-flex flex-column align-items-center justify-content-center pb-2 gap-2">
                                            <button type="button" class="btn btn-primary btn-sm gateway-filed-add"
                                                title="{{ __('Add') }}">
                                                <i class="las la-plus"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm gateway-filed-remove"
                                                title="{{ __('Remove') }}">
                                                <i class="las la-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
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
        <form class="" method="POST" action="{{ route('admin.refund.preferred-option.update') }}">
            @method('PUT')
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
                                <input class="form-control" name="gateway_name"
                                    placeholder="{{ __('Enter gateway name') }}">
                                <small class="info">
                                    {{ __('If you want to merge refund value to user wallet, then use Wallet like this') }} .
                                    {{ __('Only for wallet') }}
                                </small>
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="is_file" id="edit_is_file_checkbox" value="yes">
                                    {{ __('Is File') }}
                                </label>
                            </div>

                            <div class="dashboard__card" id="edit_fields_container">
                                <div class="dashboard__card__header">
                                    <h4 class="dashboard__card__title">{{ __('Gateway field') }}</h4>
                                </div>
                                <div class="card-body gateway-filed-body">
                                    <!-- Fields will be added here dynamically -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label>
                                    {{ __('Select Status') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="status_id" class="form-control" required="">
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
            // Create section: Show/hide field group
            $('#is_file_checkbox').change(function() {
                $('#fields_container').toggle(!this.checked);
            });

            // Edit Modal: Show/hide field group
            $('#edit_is_file_checkbox').change(function() {
                if (this.checked) {
                    $('#edit_fields_container').hide();
                    $('.gateway-filed-body').html('');
                } else {
                    $('#edit_fields_container').show();
                    if ($('.gateway-filed-body').children().length === 0) {
                        $('.gateway-filed-body').html(getGatewayFieldRow(''));
                    }
                }
            });

            // Add dynamic field row
            $(document).on("click", ".gateway-filed-add", function() {
                $(this).closest('.form-group.row').parent().append(getGatewayFieldRow(''));
            });

            // Remove dynamic field row
            $(document).on("click", ".gateway-filed-remove", function() {
                const rows = $(this).closest('.gateway-filed-body').find('.form-group.row');
                if (rows.length > 1) {
                    $(this).closest('.form-group.row').remove();
                }
            });

            // When clicking edit button
            $(document).on("click", ".update-gateway", function() {
                let fileds = JSON.parse($(this).attr("data-blog-filed"));
                let isFile = $(this).attr("data-is-file") === 'yes';

                $("#edit-gateway-modal input[name='gateway_name']").val($(this).attr("data-name"));
                $("#edit-gateway-modal select[name='status_id']").val($(this).attr("data-status"));
                $("#edit-gateway-modal input[name='id']").val($(this).attr("data-id"));
                $("#edit_is_file_checkbox").prop('checked', isFile);

                if (isFile) {
                    $('#edit_fields_container').hide();
                    $('.gateway-filed-body').html('');
                } else {
                    $('#edit_fields_container').show();
                    let fieldsHtml = '';
                    if (fileds.length > 0) {
                        fileds.forEach(field => {
                            fieldsHtml += getGatewayFieldRow(field);
                        });
                    } else {
                        fieldsHtml = getGatewayFieldRow('');
                    }
                    $('.gateway-filed-body').html(fieldsHtml);
                }
            });
        });

        // Helper: Generate input row
        function getGatewayFieldRow(value = '') {
            return `
                <div class="form-group row">
                    <div class="w-90 d-flex align-items-center">
                        <input class="form-control" name="filed[]" value="${value}" placeholder="Enter field name">
                    </div>
                    <div class="col-md-1 d-flex flex-column align-items-center justify-content-center pb-2 gap-2">
                        <button type="button" class="btn btn-primary btn-sm gateway-filed-add">
                            <i class="las la-plus"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm gateway-filed-remove">
                            <i class="las la-trash-alt"></i>
                        </button>
                    </div>
                </div>`;
        }
    </script>
@endsection
