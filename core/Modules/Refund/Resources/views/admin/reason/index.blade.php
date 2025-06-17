@extends('backend.admin-master')

@section('site-title', __('Refund Reasons'))

@section('style')

@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-md-12">
                <x-msg.error />
                <x-msg.flash />
                @can('refund-reason-store')
                    <button data-bs-toggle="modal" data-bs-target="#refundReasonModal" class="cmn_btn btn_bg_profile mb-4">
                        {{ __('Add Reason') }}
                    </button>
                @endcan
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h3 class="dashboard__card__title">{{ __('Refund Reasons') }}</h3>
                        
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-wrap table-responsive all-user-campaign-table">
                            <div class="order-history-inner text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Serial No.') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reasons as $reason)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $reason->name }}</td>
                                                <td>
                                                    @can('refund-reason-update')
                                                        <button data-id="{{ $reason->id }}" data-name="{{ $reason->name }}"
                                                            data-bs-toggle="modal" data-bs-target="#editRefundReasonModal"
                                                            class="btn btn-warning btn-sm" title="{{ __('Edit') }}">
                                                            <i class="ti-pencil"></i>
                                                        </button>
                                                    @endcan
                                                    @can('refund-reason-delete')
                                                        <a href="{{ route('admin.refund.reason.delete', $reason->id) }}"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="ti-trash"></i>
                                                        </a>
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

                @can('refund-reason-update')
                    <!-- Modal -->
                    <div class="modal fade" id="editRefundReasonModal" tabindex="-1"
                        aria-labelledby="editRefundReasonModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content custom__form">
                                <form action="#" method="POST" id="edit-refund-reason-form">
                                    @csrf
                                    @method('PUT')

                                    <input id="reason_id" name="id" value="" type="hidden" />

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editRefundReasonModal">{{ __('Add new reason') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="reason_name" class="form-label">{{ __('Reason Name') }}</label>
                                            <input type="text" name="name" class="form-control" id="reason_name"
                                                placeholder="{{ __('Write reason name.') }}">
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

                @can('refund-reason-store')
                    <!-- Modal -->
                    <div class="modal fade" id="refundReasonModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content custom__form">
                                <form action="#" method="post" id="new-refund-reason-form">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Add new reason') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="reason_name" class="form-label">
                                                {{ __('Reason Name') }}
                                                <input type="text" name="name" class="form-control" id="reason_name"
                                                    placeholder="{{ __('Write reason name.') }}">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
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
