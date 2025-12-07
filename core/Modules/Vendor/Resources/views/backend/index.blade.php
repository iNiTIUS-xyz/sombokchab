@extends('backend.admin-master')

@section('site-title')
    {{ __('Vendors List') }}
@endsection

@section('style')
    <style>
        .badge {
            border: 1px solid white !important;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 dashboard-area">
        <div class="row">
            <div class="col-lg-12">
                {{--
            <x-msg.error />
            <x-msg.flash /> --}}

                <div class="mb-4">
                    <a class="cmn_btn btn_bg_profile" href="{{ route('admin.vendor.create') }}">
                        {{ __('Add New Vendor') }}
                    </a>
                </div>

                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Vendors List') }}</h4>
                    </div>
                    <div class="dashboard__card__body dashboard-recent-order mt-4">
                        <div class="table-wrap dashboard-table">
                            <div class="table-responsive">
                                <table class="table" id="dataTable">
                                    <thead class="head-bg">
                                        <tr>
                                            <th class="min-width-100">{{ __('Vendor Info') }}</th>
                                            <th class="min-width-250">{{ __('Shop Info') }}</th>
                                            <th class="min-width-100">{{ __('Status') }}</th>
                                            <th class="min-width-100">{{ __('Verify Status') }}</th>
                                            <th class="min-width-100">{{ __('Created On') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendors as $vendor)
                                            <tr class="table-cart-row">

                                                <td class="price-td" data-label="Name">
                                                    <div class="vendorList__item">
                                                        <span
                                                            class="vendorList__label vendor-label">{{ __('Vendor Name:') }}
                                                        </span>
                                                        <span class="vendorList__value vendor-value">
                                                            {{ $vendor->owner_name }}
                                                        </span>
                                                    </div>
                                                    <div class="vendorList__item">
                                                        <span
                                                            class="vendorList__label vendor-label">{{ __('Vendor Email:') }}
                                                        </span>
                                                        <span class="vendorList__value vendor-value">
                                                            {{ $vendor->vendor_shop_info?->email }}
                                                        </span>
                                                    </div>
                                                    <div class="vendorList__item">
                                                        <span
                                                            class="vendorList__label vendor-label">{{ __('Business Type:') }}
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
                                                                    class="vendorList__label vendor-label">{{ __('Shop
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Number:') }}
                                                                </span>
                                                                <span class="vendorList__value vendor-value">
                                                                    {{ $vendor->vendor_shop_info?->number }}</span>
                                                            </div>
                                                            @if (!empty($vendor->commission_type))
                                                                <div class="vendorList__item">
                                                                    <b class="vendorList__label vendor-label">{{ __('Commission
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Type:') }}
                                                                    </b>
                                                                    <b class="vendorList__value vendor-value">
                                                                        {{ $vendor->commission_type }}</b>
                                                                </div>
                                                                <div class="vendorList__item">
                                                                    <b class="vendorList__label vendor-label">{{ __('Commission
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Amount:') }}
                                                                    </b>
                                                                    <b class="vendorList__value vendor-value">
                                                                        {{ $vendor->commission_amount }}</b>
                                                                </div>
                                                                <div class="vendorList__item">
                                                                    <b class="vendorList__label vendor-label">{{ __('Update
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Commission:') }}
                                                                    </b>
                                                                    <button data-vendor-id="{{ $vendor->id }}"
                                                                        class="btn btn-sm btn-info update-individual-commission"
                                                                        data-bs-target="#vendor-commission"
                                                                        data-bs-toggle="modal">
                                                                        <i class="las la-pen"></i>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group badge m-0 p-0">
                                                        <button type="button"
                                                            class="status-btn {{ $vendor->status_id == 1 ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">

                                                            {{ $vendor->status_id == 1 ? __('Active') : __('Inactive') }}
                                                        </button>

                                                        <div class="dropdown-menu">

                                                            {{-- ACTIVE = 1 --}}
                                                            <form class="vendor-status-form"
                                                                data-vendor-id="{{ $vendor->id }}">
                                                                @csrf
                                                                <input type="hidden" name="status_id" value="1">
                                                                <button type="button" class="dropdown-item change-status">
                                                                    {{ __('Active') }}
                                                                </button>
                                                            </form>

                                                            {{-- INACTIVE = 2 --}}
                                                            <form class="vendor-status-form"
                                                                data-vendor-id="{{ $vendor->id }}">
                                                                @csrf
                                                                <input type="hidden" name="status_id" value="2">
                                                                <button type="button" class="dropdown-item change-status">
                                                                    {{ __('Inactive') }}
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </td>


                                                <td>
                                                    <div class="btn-group badge m-0 p-0">
                                                        <button type="button"
                                                            class="status-{{ $vendor->is_vendor_verified }} {{ $vendor->is_vendor_verified == 0 ? 'bg-danger status-close' : 'bg-primary status-open' }} dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            {{ ucfirst($vendor->is_vendor_verified == 0 ? __('Unverified') : __('Verified')) }}
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <form
                                                                action="{{ route('admin.vendor.varify.status', $vendor->id) }}"
                                                                method="POST"
                                                                id="status-form-activate-{{ $vendor->id }}">
                                                                @csrf
                                                                <input type="hidden" name="verify_status" value="1">
                                                                <button type="submit" class="dropdown-item">
                                                                    {{ __('Verified') }}
                                                                </button>
                                                            </form>
                                                            <form
                                                                action="{{ route('admin.vendor.varify.status', $vendor->id) }}"
                                                                method="POST"
                                                                id="status-form-deactivate-{{ $vendor->id }}">
                                                                @csrf
                                                                <input type="hidden" name="verify_status" value="0">
                                                                <button type="submit" class="dropdown-item">
                                                                    {{ __('Unverified') }}
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ date('M j, Y', strtotime($vendor->created_at)) }}
                                                </td>
                                                <td data-label="Actions">
                                                    <div class="action-icon">
                                                        @can('view-vendor')
                                                            <a href="#" class="btn btn-secondary btn-sm vendor-detail"
                                                                data-id="{{ $vendor->id }}" data-bs-toggle="modal"
                                                                data-bs-target="#vendor-details">
                                                                <i class="las la-file-invoice"></i>
                                                            </a>
                                                        @endcan

                                                        @can('edit-vendor')
                                                            <a href="{{ route('admin.vendor.edit', $vendor->id) }}"
                                                                class="btn btn-sm btn-warning text-dark"
                                                                title="{{ __('Edit') }}">
                                                                <i class="las la-pencil-alt"></i>
                                                            </a>
                                                        @endcan

                                                        @can('delete-vendor')
                                                            <a data-vendor-url="{{ route('admin.vendor.delete', $vendor->id) }}"
                                                                href="#1" class="btn btn-danger btn-sm delete-row"
                                                                title="{{ __('Delete') }}">
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

    {{-- Vendor Details Modal --}}
    <div class="modal fade" id="vendor-details" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="overflow: hidden;">
            <div class="modal-content custom__form">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ __('Vendor Details') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    {{-- Vendor Commission Modal --}}
    <div class="modal fade" id="vendor-commission" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content custom__form">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Vendor Commission') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.vendor.individual-commission-settings') }}"
                        id="individual_vendor_commission_settings" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="vendor_id" id="vendor_id">
                        <div class="form-group">
                            <label>{{ __('Select commission type') }}</label>
                            <select name="commission_type" id="commission_type" class="form-control">
                                <option value="">{{ __('Select an option') }}</option>
                                <option value="fixed_amount">{{ __('Fixed amount') }}</option>
                                <option value="percentage">{{ __('Percentage') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Enter percentage.') }}</label>
                            <input type="number" name="commission_amount" id="amount"
                                class="form-control form-control-sm" placeholder="{{ __('Enter percentage') }}">
                        </div>
                        <div class="form-group">
                            <button class="cmn_btn btn_bg_profile">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Remove old select-based handlers (if you had them)
        $(document).off("focus", ".status-dropdown select");
        $(document).off("change", ".status-dropdown select");

        // Handle dropdown-item clicks for status change
        $(document).on("click", ".change-status", function(e) {
            e.preventDefault();

            // find the enclosing form and data
            let button = $(this);
            let form = button.closest("form.vendor-status-form");
            let vendorId = form.data("vendor-id");
            let statusId = form.find('input[name="status_id"]').val();

            if (!confirm("Are you sure to change this vendor status?")) {
                return;
            }

            // prepare FormData
            let data = new FormData();
            data.append("_token", "{{ csrf_token() }}");
            data.append("status_id", statusId);
            data.append("vendor_id", vendorId);

            // send AJAX using your send_ajax_request helper
            send_ajax_request("post", data, "{{ route('admin.vendor.update-status') }}",
                // beforeSend
                () => {
                    toastr.warning("Request sent, please wait.");
                },
                // success callback
                (response) => {
                    toastr.success("Vendor Status Changed Successfully");

                    // update the button label and classes immediately in the row
                    // find the closest .btn-group for this form
                    let btnGroup = form.closest(".btn-group");
                    let btn = btnGroup.find("button.dropdown-toggle");

                    if (parseInt(statusId) === 1) {
                        btn.removeClass("bg-danger status-close").addClass("bg-primary status-open");
                        btn.text("{{ __('Active') }}");
                    } else {
                        btn.removeClass("bg-primary status-open").addClass("bg-danger status-close");
                        btn.text("{{ __('Inactive') }}");
                    }
                },
                // error callback
                (errors) => {
                    // use your error helper if available
                    if (typeof prepare_errors === "function") {
                        prepare_errors(errors);
                    } else {
                        ajax_toastr_error_message(errors);
                    }
                }
            );
        });
    </script>

    <script>
        $(document).on("click", ".vendor-detail", function(e) {
            e.preventDefault();
            let vendorId = $(this).data("id");
            $.ajax({
                url: "{{ route('admin.vendor.show') }}",
                type: "POST",
                data: {
                    id: vendorId,
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function() {
                    $("#vendor-details .modal-body").html("<p>Loading...</p>");
                },
                success: function(response) {
                    $("#vendor-details .modal-body").html(response);
                },
                error: function() {
                    $("#vendor-details .modal-body").html(
                        "<p class='text-danger'>Failed to load vendor details.</p>");
                }
            });
        });

        let previousValue;

        $(document).on("focus", ".status-dropdown select", function() {
            previousValue = $(this).val();
        });

        $(document).on("change", ".status-dropdown select", function() {
            let selectElement = $(this);
            let selectedValue = selectElement.val();

            if (!confirm("Are you sure to change this vendor status?")) {
                selectElement.val(previousValue);
                return;
            }

            let data = new FormData();
            data.append("_token", "{{ csrf_token() }}");
            data.append("status_id", selectedValue);
            data.append("vendor_id", selectElement.data("vendor-id"));
            send_ajax_request("post", data, "{{ route('admin.vendor.update-status') }}", () => {
                toastr.warning("Request sent, please wait.");
            }, () => {
                toastr.success("Vendor Status Changed Successfully");
            }, (data) => {
                prepare_errors(data);
            });
        });

        $(document).on("submit", "#individual_vendor_commission_settings", function(e) {
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

        $(document).on("click", ".update-individual-commission", function() {
            let vendor_id = $(this).attr("data-vendor-id");
            $("#individual_vendor_commission_settings  #vendor_id").val(vendor_id);
            send_ajax_request("GET", null, "{{ route('admin.vendor.get-vendor-commission-information') }}/" +
                vendor_id, () => {}, (response) => {
                    $("#individual_vendor_commission_settings #commission_type option[value=" + response
                        .commission_type + "]").attr("selected", true);
                    $("#individual_vendor_commission_settings  #amount").val(response.commission_amount);
                }, (errors) => {
                    ajax_toastr_error_message(errors)
                });
        });
    </script>
@endsection
