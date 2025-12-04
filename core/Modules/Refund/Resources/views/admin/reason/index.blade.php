@extends('backend.admin-master')

@section('site-title', __('Refund Reasons'))

@section('content')
<div class="col-lg-12 col-ml-12">
    {{--
    <x-msg.error />
    <x-msg.flash /> --}}
    @can('manage-refund-request-settings')
    <button data-bs-toggle="modal" data-bs-target="#refundReasonModal" class="cmn_btn btn_bg_profile mb-4">
        {{ __('Add Reason') }}
    </button>
    @endcan
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title">{{ __('Refund Reasons') }}</h3>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="table-wrap  all-user-campaign-table">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>{{ __('Refund Reasons') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reasons as $reason)
                            <tr>
                                <td>{{ $reason->name }}</td>
                                <td>
                                    @can('manage-refund-request-settings')
                                    <button data-id="{{ $reason->id }}" data-name="{{ $reason->name }}"
                                        data-bs-toggle="modal" data-bs-target="#editRefundReasonModal"
                                        class="btn btn-warning text-dark btn-sm mb-2 edit-reason"
                                        title="{{ __('Edit Data') }}">
                                        <i class="ti-pencil"></i>
                                    </button>
                                    @endcan
                                    @can('manage-refund-request-settings')
                                    {{-- <a href="" class="btn btn-danger btn-sm" title="{{ __('Delete Data') }}">
                                        <i class="ti-trash"></i>
                                    </a> --}}

                                    <x-delete-popover :url="route('admin.refund.reason.delete', $reason->id)" />
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

    @can('manage-refund-request-settings')
    <!-- Modal -->
    <div class="modal fade" id="editRefundReasonModal" tabindex="-1" aria-labelledby="editRefundReasonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content custom__form">
                <form action="#" method="POST" id="edit-refund-reason-form">
                    @csrf
                    @method('PUT')

                    <input id="reason_id" name="id" value="" type="hidden" />

                    <div class="modal-header">
                        <h5 class="modal-title" id="editRefundReasonModal">{{ __('Update Reason') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="reason_name" class="form-label">
                                {{ __('Reason Title') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" id="reason_name"
                                placeholder="{{ __('Enter reason title') }}" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close')
                            }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan

    @can('manage-refund-request-settings')
    <!-- Modal -->
    <div class="modal fade" id="refundReasonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content custom__form">
                <form action="#" method="post" id="new-refund-reason-form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Add New Reason') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="reason_name" class="form-label">
                                {{ __('Reason Title') }}
                                <span class="text-danger">*</span>
                                <input type="text" name="name" class="form-control" id="reason_name"
                                    placeholder="{{ __('Enter reason title') }}" required="">
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close')
                            }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('script')
<script>
    $(document).on("click", ".edit-reason", function() {
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-name");
            let form = $("#edit-refund-reason-form");

            form.find("#reason_name").val(name);
            form.find("#reason_id").val(id);
        });

        $(document).on("submit", "#new-refund-reason-form", function(e) {
            e.preventDefault();

            send_ajax_request("POST", new FormData(e.target), "{{ route('admin.refund.reason.store') }}", () => {},
                (response) => {
                    ajax_toastr_success_message(response);
                    if (response.success) {
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    }
                }, (errors) => {
                    prepare_errors(errors);
                })
        });

        $(document).on("submit", "#edit-refund-reason-form", function(e) {
            e.preventDefault();

            send_ajax_request("POST", new FormData(e.target), "{{ route('admin.refund.reason.update') }}",
                () => {}, (response) => {
                    ajax_toastr_success_message(response);
                    if (response.success) {
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    }
                }, (errors) => {
                    prepare_errors(errors);
                })
        });
</script>
@endsection