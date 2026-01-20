@extends('frontend.frontend-page-master')

@section('site-title')
    {{ get_static_option('support_ticket_page_name') ?? __('Add New Support Ticket') }}
@endsection

@section('page-title')
    {{ get_static_option('support_ticket_page_name') ?? __('Add New Support Ticket') }}
@endsection

@section('page-meta-data')
    <meta name="description" content="{{ get_static_option('about_page_meta_description') }}">
    <meta name="tags" content="{{ get_static_option('about_page_meta_tags') }}">
@endsection

@section('style')
    <style>
        .support-ticket-wrapper .login-form p {
            font-size: 36px;
            line-height: 40px;
            text-align: center;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 50px
        }

        .support-ticket-wrapper .login-form form.account-form {
            padding: 0 60px
        }

        .support-ticket-wrapper .title {
            font-size: 36px;
            line-height: 46px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px
        }

        .support-ticket-wrapper textarea:focus {
            outline: 0;
            box-shadow: none
        }

        .support-ticket-wrapper textarea {
            max-height: 150px
        }

        .support-ticket-wrapper {
            padding: 50px;
            box-shadow: 0 0 40px 0 rgba(0, 0, 0, .05)
        }

        .support-ticket-wrapper .form-control {
            border: 1px solid #e2e2e2;
            border-radius: 0;
            height: 50px
        }

        .support-ticket-wrapper select.form-control:focus {
            outline: 0;
            box-shadow: none
        }

        .support-ticket-wrapper textarea.form-control {
            height: 150px
        }

        .support-ticket-wrapper checkbox.form-control {
            height: auto
        }
    </style>
@endsection
@section('content')
    <section class="support-ticket-page-area padding-top-50 padding-bottom-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="dashboard__card support-ticket-wrapper">
                        @if (auth()->guard('web')->check())
                            <div class="dashboard__card__header">
                                {{-- <h3 class="dashboard__card__title">Add New Support Ticket</h3> --}}
                            </div>
                            <div class="dashboard__card__body custom__form mt-4">
                                <x-msg.flash />
                                <x-msg.error />
                                <form action="{{ route('frontend.support.ticket.store') }}" method="post"
                                    class="support-ticket-form-wrapper" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="via" value="{{ __('website') }}">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Title') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="title"
                                            oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"
                                            placeholder="{{ __('Enter Title') }}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            {{ __('Support Category') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="departments" class="form-select" required>
                                            @foreach ($departments as $dep)
                                                <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('departments')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            {{ __('Order Number (No. - Date - Amount)') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="order_id" class="form-select" required>
                                            <option value="" selected>{{ __('Select A Order No') }}</option>
                                            @foreach ($user_orders as $order)
                                                <option value="{{ $order->order_number }}">
                                                    {{ $order->order_number }} -
                                                    {{ $order->created_at->format('M d, Y') }} -
                                                    {{ float_amount_with_currency_symbol($order->paymentMeta->total_amount ?? 0) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('order_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            {{ __('Description') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="description" class="form-control" cols="30" rows="10"
                                            placeholder="{{ __('Enter Description') }}" required></textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="btn-wrapper">
                                        <button type="submit" class="cmn_btn btn_bg_1 btn-success">
                                            {{-- {{ get_static_option('support_ticket_button_text') }} --}}
                                            {{ __('Submit') }}
                                        </button>
                                        <a href="{{ route('user.home.support.tickets') }}"
                                            class="cmn_btn default-theme-btn"
                                            style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                            {{ __('Back') }}
                                        </a>
                                    </div>
                                </form>
                            </div>
                        @else
                            @include('frontend.partials.ajax-login-form', [
                                'title' => get_static_option('support_ticket_login_notice'),
                            ])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    @include('frontend.partials.ajax-login-form-js')
@endsection
