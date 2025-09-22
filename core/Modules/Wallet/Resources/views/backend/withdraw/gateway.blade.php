@extends('backend.admin-master')

@section('site-title', __('Vendor wallet payment methods'))

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
        <div class="row">
            <x-msg.error />
            <x-flash-msg />
            <div class="col-12">
                <div class="btn-wrapper mb-4">
                    <a data-bs-toggle="modal" data-bs-target="#add-gateway-modal" href="#1" class="cmn_btn btn_bg_profile"
                        data-text="Create New Role">
                        {{ __('Add New Payment Method') }}
                    </a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="dashboard__card card__two">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Vendor Wallet Payment Methods') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Payment Method') }}</th>
                                        <th>{{ __('Method Field/s') }}</th>
                                        <th>{{ __('Is File') }}</th>
                                        <th>{{ __('Method Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gateways as $gateway)
                                        <tr>
                                            <td>{{ $gateway->name }}</td>
                                            <td>
                                                @if($gateway->is_file == 'yes')
                                                    {{ __('File Upload Required') }}
                                                @else
                                                    @if($gateway->filed)
                                                        {{ implode(' , ', unserialize($gateway->filed)) }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <x-status-span :status="$gateway->is_file" />
                                            </td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $gateway->status_id }} {{ $gateway->status_id == 1 ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ ucfirst($gateway->status_id == 1 ? __('Active') : __('Inactive')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form action="{{ route('admin.wallet.withdraw.gateway.status.change', $gateway->id) }}"
                                                            method="POST" id="status-form-activate-{{ $gateway->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="1">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Active') }}
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.wallet.withdraw.gateway.status.change', $gateway->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $gateway->id }}">
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
                                                @can('wallet-withdraw-gateway-update')
                                                    <button type="button" title="{{ __('Edit Data') }}"
                                                        data-name="{{ $gateway->name }}" data-id="{{ $gateway->id }}"
                                                        data-status="{{ $gateway->status_id }}"
                                                        data-is-file="{{ $gateway->is_file }}"
                                                        data-blog-filed="{{ json_encode(unserialize($gateway->filed)) }}"
                                                        class="btn btn-sm btn-warning text-dark mb-2 me-1 update-gateway"
                                                        data-bs-toggle="modal" data-bs-target="#edit-gateway-modal">
                                                        <i class="ti-pencil"></i>
                                                    </button>
                                                @endcan

                                                @can('wallet-withdraw-gateway-delete')
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
    <div class="modal fade" id="add-gateway-modal" tabindex="-1" aria-hidden="true" aria-labelledby="add-gateway-modalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom__form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <b>{{ __('Create Wallet Payment Method') }}</b> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="" method="POST" action="{{ route('admin.wallet.withdraw.gateway') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="w-100">{{ __('Name:') }}</label>
                            <input class="form-control" name="gateway_name" required
                                placeholder="{{ __('Enter method name') }}">
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_file" id="is_file_checkbox" value="yes">
                                {{ __('Is File') }}
                            </label>
                        </div>

                        <div class="dashboard__card card__two overflow-auto" id="filed_container" style="max-height: 400px;">
                            <div class="dashboard__card__header">
                                <h4 class="dashboard__card__title">
                                    {{ __('Method field') }}
                                </h4>
                            </div>
                            <div class="dashboard__card__body">
                                <div class="form-group row">
                                    <div class="w-90 d-flex align-items-center">
                                        <input class="form-control" name="filed[]" required
                                            placeholder="{{ __('Enter filed name') }}">
                                    </div>
                                    <div class="col-md-1 d-flex flex-column align-items-center justify-content-center pb-2 gap-2">
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
                        <div class="form-group">
                            <label>{{ __('Select Status') }}</label>
                            <select name="status_id" class="form-control" required>
                                <option value="">{{ __('Select Status') }}</option>
                                <option value="1">{{ __('Active') }}</option>
                                <option value="2">{{ __('Inactive') }}</option>
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

    @can('wallet-withdraw-gateway-update')
        <!-- Edit Gateway Modal -->
        <div class="modal fade" id="edit-gateway-modal" tabindex="-1" aria-labelledby="edit-gateway-modalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <form class="" method="POST" action="{{ route('admin.wallet.withdraw.gateway.update') }}">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="" name="id" />
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Update wallet withdraw gateway') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="w-100">{{ __('Name:') }}</label>
                                <input class="form-control" name="gateway_name" required placeholder="{{ __('Enter gateway name') }}">
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="is_file" id="edit_is_file_checkbox" value="yes">
                                    {{ __('Is File') }}
                                </label>
                            </div>

                            <div class="dashboard__card" id="edit_filed_container">
                                <div class="dashboard__card__header">
                                    <h4 class="dashboard__card__title">{{ __('Gateway field') }}</h4>
                                </div>
                                <div class="card-body gateway-filed-body">
                                    <!-- Fields will be added dynamically -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Select Status') }}</label>
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
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('script')
    <x-table.btn.swal.js />
    <script>
        $(document).ready(function() {
            // For add modal - show/hide fields based on checkbox
            $('#is_file_checkbox').change(function() {
                if(this.checked) {
                    $('#filed_container').hide();
                    $('#filed_container input').removeAttr('required');
                } else {
                    $('#filed_container').show();
                    $('#filed_container input').attr('required', 'required');
                }
            });

            // For edit modal - show/hide fields based on checkbox
            $('#edit_is_file_checkbox').change(function() {
                if(this.checked) {
                    $('#edit_filed_container').hide();
                    $('#edit_filed_container input').removeAttr('required');
                } else {
                    $('#edit_filed_container').show();
                    $('#edit_filed_container input').attr('required', 'required');
                }
            });
        });

        $(document).on("click", ".update-gateway", function() {
            let fileds = JSON.parse($(this).attr("data-blog-filed"));
            let isFile = $(this).attr("data-is-file");

            $("#edit-gateway-modal input[name='gateway_name']").val($(this).attr("data-name"));
            $("#edit-gateway-modal select[name='status_id'] option[value='" + $(this).attr("data-status") + "']")
                .attr("selected", true);
            $("#edit-gateway-modal input[name='id']").val($(this).attr("data-id"));

            // Set the checkbox state and field visibility
            if(isFile == 'yes') {
                $("#edit_is_file_checkbox").prop('checked', true);
                $("#edit_filed_container").hide();
                $("#edit_filed_container input").removeAttr('required');
            } else {
                $("#edit_is_file_checkbox").prop('checked', false);
                $("#edit_filed_container").show();
                $("#edit_filed_container input").attr('required', 'required');
            }

            // Populate fields
            let list_filed = "";
            if (fileds && fileds.length > 0) {
                fileds.forEach(function(value, index, array) {
                    list_filed += `
                        <div class="form-group row">
                            <div class="w-90 d-flex align-items-center">
                                <input class="form-control" value="${value}" name="filed[]" placeholder="{{ __('Enter filed name') }}" required>
                            </div>
                            <div class="col-md-1 d-flex flex-column align-items-center justify-content-center pb-2 gap-2">
                                <button type="button" class="btn btn-primary btn-sm gateway-filed-add">
                                    <i class="las la-plus"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm gateway-filed-remove">
                                    <i class="las la-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    `;
                });
            } else {
                list_filed = `<div class="form-group row">
                    <div class="w-90 d-flex align-items-center">
                        <input class="form-control" name="filed[]" placeholder="{{ __('Enter filed name') }}" required>
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

            $(".gateway-filed-body").html(list_filed);
        });

        $(document).on("click", ".gateway-filed-add", function() {
            let elem = $(this).parent().parent();
            let clone = elem.clone();
            clone.find('input').val('');
            elem.parent().append(clone);
        });

        $(document).on("click", ".gateway-filed-remove", function() {
            if ($(".gateway-filed-remove").length == 1) {
                return null;
            }
            $(this).closest('.form-group.row').remove();
        });

        $(document).on("click", ".update-withdraw-gateway", function(e) {
            e.preventDefault();
            send_ajax_request("PUT")
        });
    </script>
@endsection