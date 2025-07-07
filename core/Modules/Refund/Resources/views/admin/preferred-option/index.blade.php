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
            <div class="col-lg-7">
                <x-msg.error />
                <x-flash-msg />
                <div class="dashboard__card card__two">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Refund Options') }}</h4>
                    </div>
                    <div class="dashboard__card__body">
                        <div class="table-wrap">
                            <table class="table-responsive table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Serial No.') }}</th>
                                        <th>{{ __('Payment Method') }}</th>
                                        <th>{{ __('Payment Method Fields') }}</th>
                                        <th>{{ __('Is File') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($preferredOptions as $preferredOption)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $preferredOption->name }}</td>
                                            <td>
                                                @if($preferredOption->is_file == 'yes')
                                                    {{ __('File Upload Required') }}
                                                @else
                                                    @if($preferredOption->fields)
                                                        {{ implode(' , ', unserialize($preferredOption->fields)) }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <x-status-span :status="$preferredOption->is_file" />
                                            </td>
                                            <td>
                                                <x-status-span :status="$preferredOption->status?->name" />
                                            </td>
                                            <td>
                                                @can('refund-preferred-option-update')
                                                    <a href="javascript:;" title="{{ __('Edit Data') }}"
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

                                                @can('refund-preferred-option-update')
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
            <div class="col-lg-5">
                @can('refund-preferred-option-store')
                    <div class="dashboard__card card__two">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__title">{{ __('Refund Preferred Option Create') }}</h4>
                        </div>
                        <div class="dashboard__card__body custom__form">
                            <form class="" method="POST" action="{{ route('admin.refund.preferred-option.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="w-100">{{ __('Name:') }}</label>
                                    <input class="form-control" name="gateway_name"
                                        placeholder="{{ __('Enter gateway name') }}">

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

                                <div class="form-group overflow-auto" id="fields_container" style="max-height: 400px;">
                                    <div class="dashboard__card card__two">
                                        <div class="dashboard__card__header">
                                            <h4 class="dashboard__card__title">
                                                {{ __('Gateway field') }}
                                            </h4>
                                        </div>
                                        <div class="dashboard__card__body">
                                            <div class="form-group row">
                                                <div class="w-90 d-flex align-items-center">
                                                    <input class="form-control" name="filed[]"
                                                        placeholder="{{ __('Enter filed name') }}">
                                                </div>
                                                <div
                                                    class="col-md-1 d-flex flex-column align-items-center justify-content-center pb-2 gap-2">
                                                    <button type="button" class="btn btn-primary btn-sm gateway-filed-add">
                                                        <i class="las la-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm gateway-filed-remove">
                                                        <i class="las la-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Select Status') }}</label>
                                    <select name="status_id" class="form-control">
                                        <option value="">{{ __('Select Status') }}</option>
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="2">{{ __('Inactive') }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button class="cmn_btn btn_bg_profile">{{ __('Add') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="edit-gateway-modal" tabindex="-1" aria-labelledby="edit-gateway-modalLabel"
        aria-hidden="true">
        <form class="" method="POST" action="{{ route('admin.refund.preferred-option.update') }}">
            @method('PUT')
            @csrf
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    @can('refund-preferred-option-update')
                        <input type="hidden" value="" name="id" />

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ __('Refund preferred option update') }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body overflow-auto" style="max-height: 550px;">
                            <div class="form-group">
                                <label class="w-100">{{ __('Name') }}</label>
                                <input class="form-control" name="gateway_name" placeholder="{{ __('Enter gateway name') }}">
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
                                <label>{{ __('Select Status') }}</label>
                                <select name="status_id" class="form-control">
                                    <option value="">{{ __('Select Status') }}</option>
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="2">{{ __('inactive') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
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
        $(document).ready(function () {
            // Create section: Show/hide field group
            $('#is_file_checkbox').change(function () {
                $('#fields_container').toggle(!this.checked);
            });

            // Edit Modal: Show/hide field group
            $('#edit_is_file_checkbox').change(function () {
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
            $(document).on("click", ".gateway-filed-add", function () {
                $(this).closest('.form-group.row').parent().append(getGatewayFieldRow(''));
            });

            // Remove dynamic field row
            $(document).on("click", ".gateway-filed-remove", function () {
                const rows = $(this).closest('.gateway-filed-body').find('.form-group.row');
                if (rows.length > 1) {
                    $(this).closest('.form-group.row').remove();
                }
            });

            // When clicking edit button
            $(document).on("click", ".update-gateway", function () {
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