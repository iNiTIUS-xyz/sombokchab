@extends('backend.admin-master')

@section('site-title', __('Delivery man ratings'))

@section('style')
    <style>
        th,
        tr {
            padding: 4px 8px !important;
            text-align: center !important;
        }

        td {
            padding: 6px !important;
            text-align: center !important;
        }

        .user-image {
            width: 50px;
        }

        .username {
            text-align: left;
        }

        .user-info-wrapper {
            gap: 15px;
        }
    </style>
@endsection

@php
    $page = request()->page ?? 1;
@endphp

@section('content')
    <x-msg.success />
    <x-msg.error />

    <div class="dashboard-deliveryWrap mt-4">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <div class="dashboard__card__left">
                            <h2 class="dashboard__card__title">{{ $deliveryMan->full_name . ' ' . __('rating list') }}</h2>
                        </div>
                        @can('delivery-man')
                            <div class="dashboard__card__header__right">
                                <div class="btn-wrapper">
                                    <a href="{{ route('admin.delivery-man.index') }}" class="cmn_btn btn_bg_profile">
                                        {{ __('Add Delivery list') }}
                                    </a>
                                </div>
                            </div>
                        @endcan
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="dashboard-table table-wrap">
                            <div id="response-body" class="table-responsive table-responsive--md">
                                <table class="custom--table">
                                    <thead class="head-bg">
                                        <tr>
                                            <th>{{ __('Serial No.') }}</th>
                                            <th>{{ __('Rating') }}</th>
                                            <th>{{ __('Comment') }}</th>
                                            <th>{{ __('Customer') }}</th>
                                            <th>{{ __('Date') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deliveryMan->ratings as $rating)
                                            <tr>
                                                <td>{{ $page * $paginationLimit - $paginationLimit + $loop->iteration }}
                                                </td>
                                                <td>
                                                    @for ($i = 0; $i < $rating->rating; $i++)
                                                        <i class="las la-star text-warning"></i>
                                                    @endfor
                                                    ({{ $rating->rating }})
                                                </td>
                                                <td>{{ $rating->review }}</td>
                                                <td>
                                                    <div class="d-flex user-info-wrapper">
                                                        <div class="user-image">
                                                            {!! render_image($rating->user->profile_image, class: 'w-100') !!}
                                                        </div>

                                                        <div class="username">
                                                            {{ $rating->user->name }}<br>
                                                            {{ $rating->user->email }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $rating->created_at->format('d F Y H:i:A') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    {!! $deliveryMan->ratings->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
