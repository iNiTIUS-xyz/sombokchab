@extends('backend.admin-master')

@section('site-title')
    {{ __('Add New Ticket') }}
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
                        <h4 class="dashboard__card__title">
                            {{ __('Add New Ticket') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('admin.support.ticket.new') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Title') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="title"
                                            placeholder="{{ __('Enter title') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>{{ __('Subject') }}</label>
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="{{ __('Enter subject') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Priority') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="priority" class="form-select">
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
                                            {{ __('Departments') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="departments" class="form-select">
                                            @foreach ($departments as $dep)
                                                <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Customer') }}
                                        </label>
                                        <select name="user_id" class="form-select wide">
                                            <option value="" disabled selected>{{ __('Select Customer') }}</option>
                                            @foreach ($all_users as $user)
                                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Vendor') }}
                                        </label>
                                        <select name="vendor_id" class="form-select wide">
                                            <option value="" disabled selected>{{ __('Select Vendor') }}</option>
                                            @foreach ($all_vendors as $vendors)
                                                <option value="{{ $vendors->id }}">
                                                    {{ $vendors->owner_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <small class="text-danger">Either Customer or Vendor must be selected.</small>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Description') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="description" class="form-control" cols="30" rows="10"
                                            placeholder="{{ __('Enter description') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                            @can('support-tickets-create')
                                <div class="btn-wrapper mt-4">
                                    <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Add') }}</button>
                                    <a href="{{ route('admin.support.ticket.all') }}" class="cmn_btn default-theme-btn"
                                        style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                        {{ __('Back') }}
                                    </a>
                                </div>
                            @endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <x-niceselect.js />
@endsection