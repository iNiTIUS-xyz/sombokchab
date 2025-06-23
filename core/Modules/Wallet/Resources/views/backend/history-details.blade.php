@extends('backend.admin-master')
@section('title', __('History Details'))
@section('style')
    <style>
        .custom_table.style-04 table tbody tr td, .custom_table.style-04 table tbody tr th {
            border: 1px solid var(--border-color);
        }
    </style>
@endsection
@section('content')

<div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-error-msg />
                <x-flash-msg />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('History Details') }}</h4>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-wrap">
                            <table class="table table-responsive">
                                <tbody>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <td>{{ $history_details->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <td>{{ $history_details->user?->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Email') }}</th>
                                        <td>{{ $history_details->user?->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Phone') }}</th>
                                        <td>{{ $history_details->user?->phone }}</td>
                                    </tr>

                                    <tr>
                                        <th>{{ __('Email Verified Status') }}</th>
                                        <td> <x-status.table.verified-status :status="$history_details->user?->email_verified"/></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Payment Gateway') }}</th>
                                        <td>
                                            @if($history_details->payment_gateway == 'manual_payment')
                                                {{ ucfirst(str_replace('_',' ',$history_details->payment_gateway)) }}
                                            @else
                                                {{ $history_details->payment_gateway == 'authorize_dot_net' ? __('Authorize.Net') : ucfirst(str_replace('_', ' ', $history_details->payment_gateway)) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Payment Status') }}</th>
                                        <td>
                                            @if ($history_details->payment_status == '' || $history_details->payment_status == 'cancel')
                                                <span class="badge bg-danger">{{ __('Cancel') }}</span>
                                            @elseif ($history_details->payment_status == '' || $history_details->payment_status == 'complete')
                                                <span class="badge bg-success">{{ ucfirst($history_details->payment_status) }}</span>
                                            @else
                                                <span
                                                    class="badge bg-warning">{{ ucfirst($history_details->payment_status) }}</span>
                                                @if($history_details->payment_status == 'pending')
                                                    <x-status.table.status-change :title="__('')" :class="'btn btn-danger wallet_history_status_change'" :url="route('admin.wallet.history.status',$history_details->id)"/>
                                                @endif
                                            @endif
                                            {{-- @if($history_details->payment_status == '' || $history_details->payment_status == 'cancel')
                                                <span class="btn btn-danger btn-sm">{{ __('Cancel') }}</span>
                                            @else
                                                <span class="btn btn-success btn-sm">{{ ucfirst($history_details->payment_status) }}</span>
                                                
                                            @endif --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Deposit Amount') }}</th>
                                        <td>{{ float_amount_with_currency_symbol($history_details->amount) }}</td>
                                    </tr>
                                    @if($history_details->payment_gateway == 'manual_payment')
                                    <tr>
                                        <th>{{ __('Manual Payment Image') }}</th>
                                        <td>
                                            <span class="img_100">
                                                @if(empty($history_details->manual_payment_image))
                                                    <img src="{{ asset('assets/static/img/no_image.png') }}" alt="">
                                                @else
                                                    <img src="{{ asset('assets/uploads/manual-payment/'.$history_details->manual_payment_image) }}" alt="">
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>{{ __('Deposit Date') }}</th>
                                        <td>{{ $history_details->created_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="customMarkup__single__title">{{ __('History Details') }}</h4>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('script')
    <x-sweet-alert.sweet-alert2-js />
    <script>


        $(document).on('click','.swal_status_change_button',function(e){
            e.preventDefault();

            Swal.fire({
                title: '{{__("Are you sure to change status?")}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ee0000',
                cancelButtonColor: '#55545b',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: "{{ __('No') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });
    </script>
@endsection
