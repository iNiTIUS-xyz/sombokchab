@extends('backend.admin-master')

@section('site-title', __('Refund Requests'))

@section('style')

@endsection

@section('content')
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title">
                {{ __('Refund Requests') }}
            </h3>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="table-responsive">
                <table id="dataTable" class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Serial No.') }}</th>
                            <th>{{ __('User Details') }}</th>
                            <th>{{ __('Order Details') }}</th>
                            <th>{{ __('Refund Details') }}</th>
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
                                        <b>{{ $request->order?->order_number }}</b>
                                        <br>
                                        {{ __('Status') }}:
                                        @if ($request->order?->order_status == 'complete')
                                            <span class="badge bg-primary px-2 py-1">{{ __('Complete') }}</span>
                                        @elseif ($request->order?->order_status == 'pending')
                                            <span class="badge bg-warning px-2 py-1">{{ __('Pending') }}</span>
                                        @elseif ($request->order?->order_status == 'failed')
                                            <span class="badge bg-danger px-2 py-1">{{ __('Failed') }}</span>
                                        @elseif ($request->order?->order_status == 'canceled')
                                            <span class="badge bg-danger px-2 py-1">{{ __('Canceled') }}</span>
                                        @elseif ($request->order?->order_status == 'rejected')
                                            <span class="badge px-2 py-1"
                                                style="background: rgb(138, 1, 14) !important;">{{ __('Rejected') }}</span>
                                        @endif
                                        <br>
                                        {{ __('Amount') }}:
                                        {{ float_amount_with_currency_symbol($request->order?->paymentMeta?->total_amount) }}<br>
                                    </span>
                                </td>

                                <td>
                                    <span class="user-info text-left">
                                        <b>{{ $request->id }}</b><br>
                                        {{ __('Status') }}: 
                                        <span class="badge bg-secondary">{{ __(ucwords(str_replace('_', ' ', $request->currentTrackStatus?->name))) }}</span>
                                        {{-- <span class="badge bg-secondary">{{ __(ucwords($request->status)) }}</span>  --}}
                                        <br>
                                        {{ __('Total Product:') }} {{ $request->request_product_count }}<br>
                                    </span>
                                </td>

                                <td>
                                    @can('refund-request')
                                        <a class="btn btn-secondary btn-sm" title="{{ __('View') }}"
                                            href="{{ route('admin.refund.view-request', $request->id) }}">
                                            <i class="ti-receipt"></i>
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
                            <h5 class="modal-title" id="editRefundReasonModal">
                                {{ __('Edit reason') }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="reason_name" class="form-label">
                                    {{ __('Reason Name') }}
                                    <input type="text" name="name" class="form-control" id="reason_name"
                                        placeholder="{{ __('Enter reason name.') }}">
                                </label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
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
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ __('Add New Reason') }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="reason_name" class="form-label">
                                    {{ __('Reason Name') }}
                                    <input type="text" name="name" class="form-control" id="reason_name"
                                        placeholder="{{ __('Enter reason name.') }}">
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add') }}
                            </button>
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
