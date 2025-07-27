@extends('vendor.vendor-master')
@section('site-title')
    {{ __('New Ticket') }}
@endsection
@section('style')
    <x-niceselect.css />
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-12">
                <x-msg.flash />
                <x-msg.error />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('New Ticket') }}</h4>
                        {{-- <a href="{{ route('vendor.support.ticket.all') }}"
                            class="cmn_btn btn_bg_profile">{{ __('All Support Tickets') }}</a> --}}
                    </div>
                    <form action="{{ route('vendor.support.ticket.new') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="dashboard__card__body custom__form mt-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Title') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="title"
                                            placeholder="{{ __('Enter Title') }}" required="">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">

                                    <div class="form-group">
                                        <label>
                                            {{ __('Subject') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="{{ __('Enter Subject') }}" required="">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">

                                    <div class="form-group">
                                        <label>
                                            {{ __('Priority') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="priority" class="form-select" required="">
                                            <option value="low">{{ __('Low') }}</option>
                                            <option value="medium">{{ __('Medium') }}</option>
                                            <option value="high">{{ __('High') }}</option>
                                            <option value="urgent">{{ __('Urgent') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Support Category') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="departments" class="form-select" required="">
                                            @foreach ($departments as $dep)
                                                <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Description') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="description" class="form-control" cols="30" rows="10"
                                            placeholder="{{ __('Enter Description') }}" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="btn-wrapper">
                                        <button type="submit" class="cmn_btn btn_bg_1 btn-success">
                                            {{ get_static_option('support_ticket_button_text') }}
                                        </button>
                                        <a href="{{ route('vendor.support.ticket.all') }}" class="cmn_btn default-theme-btn"
                                            style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                            {{ __('Back') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <x-niceselect.js />
@endsection
