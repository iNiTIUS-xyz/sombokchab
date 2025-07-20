@extends('backend.admin-master')

@section('site-title')
    {{ __('Vendor List') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 dashboard-area">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="mb-4">
                    <a class="cmn_btn btn_bg_profile" href="{{ route('admin.vendor.create') }}">
                        {{ __('Vendor Create') }}
                    </a>
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Vendor List') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body dashboard-recent-order mt-4">
                        <div class="table-wrap dashboard-table">
                            <div class="table-responsive">
                                <table class="table" id="dataTable">
                                    <thead class="head-bg">
                                        <tr>
                                            {{-- <th> {{ __('Serial No.') }} </th> --}}
                                            <th class="min-width-100"> {{ __('Vendor Info') }} </th>
                                            <th class="min-width-250"> {{ __('Shop Info') }} </th>
                                            <th class="min-width-100"> {{ __('Status') }} </th>
                                            <th class="min-width-100"> {{ __('Verify Status') }} </th>
                                            <th> {{ __('Actions') }} </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendors as $vendor)
                                            <tr class="table-cart-row">

                                                <td class="price-td" data-label="Name">
                                                    <div class="vendorList__item">
                                                        <span class="vendorList__label vendor-label">{{ __('Name:') }}
                                                        </span>
                                                        <span class="vendorList__value vendor-value">
                                                            {{ $vendor->owner_name }}
                                                        </span>
                                                    </div>
                                                    <div class="vendorList__item">
                                                        <span class="vendorList__label vendor-label">{{ __('Email:') }}
                                                        </span>
                                                        <span class="vendorList__value vendor-value">
                                                            {{ $vendor->vendor_shop_info?->email }}
                                                        </span>
                                                    </div>
                                                    <div class="vendorList__item">
                                                        <span class="vendorList__label vendor-label">{{ __('Business Type:') }}
                                                        </span>
                                                        <span class="vendorList__value vendor-value">
                                                            {{ $vendor->business_type?->name }}
                                                        </span>
                                                    </div>
                                                </td>

                                                <td class="price-td" data-label="Vendor Name">
                                                    <div class="vendorList__flex">
                                                        <div class="vendorList__thumb">
                                                            {!! \App\Http\Services\Media::render_image($vendor?->vendor_shop_info?->logo, attribute: "style='width:80px'") !!}
                                                        </div>
                                                        <div class="vendorList__inner">
                                                            <div class="vendorList__item">
                                                                <span
                                                                    class="vendorList__label vendor-label">{{ __('Shop Name:') }}
                                                                </span>
                                                                <span class="vendorList__value vendor-value">
                                                                    {{ $vendor->business_name }}</span>
                                                            </div>
                                                            <div class="vendorList__item">
                                                                <span
                                                                    class="vendorList__label vendor-label">{{ __('Shop Number:') }}
                                                                </span>
                                                                <span class="vendorList__value vendor-value">
                                                                    {{ $vendor->vendor_shop_info?->number }}</span>
                                                            </div>
                                                            @if (!empty($vendor->commission_type))
                                                                <div class="vendorList__item">
                                                                    <b class="vendorList__label vendor-label">{{ __('Commission Type:') }}
                                                                    </b>
                                                                    <b class="vendorList__value vendor-value">
                                                                        {{ $vendor->commission_type }}</b>
                                                                </div>
                                                                <div class="vendorList__item">
                                                                    <b class="vendorList__label vendor-label">{{ __('Commission Amount:') }}
                                                                    </b>
                                                                    <b class="vendorList__value vendor-value">
                                                                        {{ $vendor->commission_amount }}</b>
                                                                </div>
                                                                <div class="vendorList__item">
                                                                    <b class="vendorList__label vendor-label">{{ __('Update Commission:') }}
                                                                    </b>
                                                                    <button data-vendor-id="{{ $vendor->id }}"
                                                                        class="btn btn-sm btn-info update-individual-commission"
                                                                        data-bs-target="#vendor-commission" data-bs-toggle="modal">
                                                                        <i class="las la-pen"></i>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-label="Status">
                                                    <div class="status-dropdown">
                                                        <select data-vendor-id="{{ $vendor->id }}" name="status"
                                                            id="vendor-status"
                                                            class="badge @if($vendor->status_id == 1) bg-primary @else bg-danger @endif">
                                                            {!! status_option($type = 'option', $vendor->status_id) !!}
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="btn-group badge">
                                                        <button type="button"
                                                            class="status-{{ $vendor->is_vendor_verified }} {{ $vendor->is_vendor_verified == 0 ? 'bg-danger status-close' : 'bg-primary status-open' }} dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            {{ ucfirst($vendor->is_vendor_verified == 0 ? __('Unverified') : __('Verifyed')) }}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            {{-- Form for activating --}}
                                                            <form
                                                                action="{{ route('admin.vendor.varify.status', $vendor->id) }}"
                                                                method="POST" id="status-form-activate-{{ $vendor->id }}">
                                                                @csrf
                                                                <input type="hidden" name="verify_status" value="1">
                                                                <button type="submit" class="dropdown-item">
                                                                    {{ __('Verifyed') }}
                                                                </button>
                                                            </form>

                                                            <form
                                                                action="{{ route('admin.vendor.varify.status', $vendor->id) }}"
                                                                method="POST" id="status-form-deactivate-{{ $vendor->id }}">
                                                                @csrf
                                                                <input type="hidden" name="verify_status" value="0">
                                                                <button type="submit" class="dropdown-item">
                                                                    {{ __('Unverified') }}
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-label="Actions">
                                                    <div class="action-icon">
                                                        @can('vendor-details')
                                                            <a href="#1" class="btn btn-secondary btn-sm"
                                                                data-id="{{ $vendor->id }}" class="icon vendor-detail"
                                                                data-bs-toggle="modal" data-bs-target="#vendor-details"
                                                                title="{{ __('View Details') }}">
                                                                <i class="las la-file-invoice"></i>
                                                            </a>
                                                        @endcan

                                                        @can('vendor-edit')
                                                            <a href="{{ route('admin.vendor.edit', $vendor->id) }}"
                                                                class="btn btn-sm btn-warning text-dark"
                                                                title="{{ __('Edit Data') }}">
                                                                <i class="las la-pencil-alt"></i>
                                                            </a>
                                                        @endcan

                                                        @can('vendor-delete')
                                                            <a data-vendor-url="{{ route('admin.vendor.delete', $vendor->id) }}"
                                                                href="#1" class="btn btn-danger btn-sm delete-row"
                                                                title="{{ __('Delete Data') }}">
                                                                <i class="las la-trash-alt"></i>
                                                            </a>
                                                        @endcan
                                                    </div>
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

    @can('vendor-details')
        <!-- Modal -->
        <div class="modal fade" id="vendor-details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Vendor Details') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>
    @endcan

    @can('vendor-individual-commission-settings')
        <!-- Modal -->
        <div class="modal fade" id="vendor-commission" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="vendorCommission">{{ __('Vendor Commission') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.vendor.individual-commission-settings') }}"
                            id="individual_vendor_commission_settings" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="" name="vendor_id" id="vendor_id" />

                            <div class="form-group">
                                <label for="commission_type">{{ __('Select commission type') }}</label>
                                <select name="commission_type" id="commission_type" class="form-control">
                                    <option value="">{{ __('Select an option') }}</option>
                                    <option value="fixed_amount">{{ __('Fixed amount') }}</option>
                                    <option value="percentage">{{ __('Percentage') }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="amount">{{ __('Enter percentage.') }}</label>
                                <input class="form-control form-control-sm" type="number" name="commission_amount" id="amount"
                                    placeholder="{{ __('Enter percentage') }}" />
                            </div>

                            <div class="form-group">
                                <button class="cmn_btn btn_bg_profile">{{ __('Update vendor settings') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    <div class="body-overlay-desktop"></div>
@endsection

@section('script')
    <script>
        $(document).on("click", ".vendor-detail", function (e) {
            let data = new FormData(),
                id = $(this).data("id");
            data.append("id", id);
            data.append("_token", "{{ csrf_token() }}");

            send_ajax_request("post", data, "{{ route('admin.vendor.show') }}", () => {
                // before send request
            }, (data) => {
                // receive success response
                $("#vendor-details .modal-body").html(data);
            }, (data) => {
                prepare_errors(data);
            })
        });


        let previousValue;
        // Store the previous value when the select gains focus
        $(document).on("focus", ".status-dropdown select", function () {
            previousValue = $(this).val();
        });
        // Handle the change event
        $(document).on("change", ".status-dropdown select", function () {
            let selectElement = $(this);
            let selectedValue = selectElement.val();
            if (!confirm("Are you sure to change this vendor status?")) {
                // If the user cancels, revert to the previous value
                selectElement.val(previousValue);
                return;
            }

            // Proceed with the change
            let data = new FormData();
            data.append("_token", "{{ csrf_token() }}");
            data.append("status_id", selectedValue);
            data.append("vendor_id", selectElement.data("vendor-id"));

            send_ajax_request("post", data, "{{ route('admin.vendor.update-status') }}", () => {
                toastr.warning("Request sent, please wait.");
            }, (data) => {
                toastr.success("Vendor Status Changed Successfully");
            }, (data) => {
                prepare_errors(data);
            });
        });


        $(document).on("submit", "#individual_vendor_commission_settings", function (e) {
            e.preventDefault();
            let data = new FormData(e.target);

            send_ajax_request("post", data, $(this).attr("action"), () => {
                toastr.warning('{{ __('Individual commission updating request is sent.') }}');
            }, (response) => {
                ajax_toastr_success_message(response)
            }, (errors) => {
                ajax_toastr_error_message(errors)
            });
        });

        $(document).on("click", ".update-individual-commission", function () {
            let vendor_id = $(this).attr("data-vendor-id");
            $("#individual_vendor_commission_settings  #vendor_id").val(vendor_id)

            send_ajax_request("GET", null, "{{ route('admin.vendor.get-vendor-commission-information') }}/" +
                vendor_id, () => {

                }, (response) => {
                    $("#individual_vendor_commission_settings #commission_type option[value=" + response
                        .commission_type + "]").attr("selected", true);
                    $("#individual_vendor_commission_settings  #amount").val(response.commission_amount);
                }, (errors) => {
                    ajax_toastr_error_message(errors)
                });
        });

        $(document).on("submit", "#individual_vendor_commission_settings", function (e) {
            e.preventDefault();

            send_ajax_request("post", new FormData(e.target), $(this).attr("action"), () => {
                toastr.warning('{{ __('Individual commission updating request is sent.') }}');
            }, (response) => {
                ajax_toastr_success_message(response)
            }, (errors) => {
                ajax_toastr_error_message(errors)
            });
        });
    </script>
@endsection