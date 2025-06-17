@extends('backend.admin-master')

@section('site-title', __('Refund Requests'))

@section('style')

@endsection

@section('content')
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title">{{ __('Refund Requests') }}</h3>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="table-wrap table-responsive all-user-campaign-table">
                <div class="order-history-inner text-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Serial No.') }}</th>
                                <th>{{ __('User Info') }}</th>
                                <th>{{ __('Order Info') }}</th>
                                <th>{{ __('Refund Info') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($refundRequests as $request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <span class="user-info text-left">
                                            {{ $request->user?->name }}<br>
                                            {{ $request->user?->email }}
                                            @if ($request->user?->phone)
                                                <br>
                                                {{ $request->user?->phone }}
                                            @endif
                                        </span>
                                    </td>

                                    <td>
                                        <span class="user-info text-left">
                                            <b>#{{ $request->order?->id }}</b><br>
                                            {{ __('Status') }}:
                                            {{ __(ucwords(str_replace('_', ' ', $request->currentTrackStatus?->name))) }}<br>
                                            {{ __('Amount') }}
                                            {{ float_amount_with_currency_symbol($request->order?->paymentMeta?->total_amount) }}<br>
                                        </span>
                                    </td>

                                    <td>
                                        <span class="user-info text-left">
                                            <b>#{{ $request->id }}</b><br>
                                            {{ __('Status') }} {{ $request->status }}<br>
                                            {{ __('Total Product:') }} {{ $request->request_product_count }}<br>
                                        </span>
                                    </td>

                                    <td>
                                        @can('refund-request')
                                            <a class="cmn_btn btn btn-primary btn_bg_profile btn-sm" title="{{ __('View') }}"
                                                href="{{ route('admin.refund.view-request', $request->id) }}">
                                                <i class="ti-eye"></i>
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
        <div class="modal fade" id="editRefundReasonModal" tabindex="-1" aria-labelledby="editRefundReasonModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content custom__form">
                    <form action="#" method="POST" id="edit-refund-reason-form">
                        @csrf
                        @method('PUT')

                        <input id="reason_id" name="id" value="" type="hidden" />

                        <div class="modal-header">
                            <h5 class="modal-title" id="editRefundReasonModal">{{ __('Add new reason') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('refund-reason-store')
        <!-- Modal -->
        <div class="modal fade" id="refundReasonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content custom__form">
                    <form action="#" method="post" id="new-refund-reason-form">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Add new reason') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
