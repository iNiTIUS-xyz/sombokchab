@extends('backend.admin-master')
@section('site-title')
    {{ __('Add New Customer') }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        @include('backend/partials/message')
        @include('backend/partials/error')
        <div class="row">
            <!-- basic form start -->
            <div class="col-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Add New Customer') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('admin.frontend.new.user') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name">
                                            {{ __('Name') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="{{ __('Enter full name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="username">
                                            {{ __('Username') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="{{ __('Enter username') }}">
                                        {{-- <small class="text text-danger">
                                            {{ __('Remember this username, user will login using this username') }}
                                        </small> --}}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">
                                            {{ __('Email') }}
                                        </label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="{{ __('Enter email') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="phone">
                                            {{ __('Phone') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="{{ __('Enter phone') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="country">
                                            {{ __('Country') }}
                                        </label>
                                        <select name="country" class="form-select">
                                            <option value="" disabled selected>{{ __('Select country') }}</option>
                                            @foreach ($country as $item)
                                                <option value="{{ $item->id }}" @if ($item->id == 31) selected @endif>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="city">
                                            {{ __('Province') }}
                                        </label>
                                        <select name="city" class="form-select">
                                            <option value="" disabled selected>{{ __('Select province') }}</option>
                                            @foreach ($states as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="state">
                                            {{ __('City') }}
                                        </label>
                                        <select name="state" class="form-select">
                                            <option value="" disabled selected>{{ __('Select city') }}</option>

                                            @foreach ($cities as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="zipcode">
                                            {{ __('Postal code') }}
                                        </label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode"
                                            placeholder="{{ __('Enter postal code') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="address">
                                            {{ __('Address') }}
                                        </label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="{{ __('Enter address') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="password">
                                            {{ __('Password') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="{{ __('Enter password') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="password_confirmation">
                                            {{ __('Confirm Password') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation"
                                            placeholder="{{ __('Enter password confirmation') }}">
                                    </div>
                                </div>
                            </div>
                            @can('add-user')
                            <button type="submit" class="cmn_btn btn_bg_profile mt-4">
                                {{ __('Add') }}
                            </button>
                            <a href="{{ route('admin.all.frontend.user') }}" class="cmn_btn default-theme-btn"
                                style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                {{ __('Back') }}
                            </a>
                            @endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on("change", "#country", function () {
            let data = new FormData();

            data.append("country_id", $(this).val());
            data.append("_token", "{{ csrf_token() }}");

            send_ajax_request("post", data, "{{ route('admin.vendor.get.state') }}", function () { }, (data) => {
                $("#state_id").html("<option value=''>{{ __('Select City') }}</option>" + data.option);
                $(".state_wrapper .list").html(data.li);
            }, (data) => {
                prepare_errors(data);
            })
        });

        $(document).on("change", "#state_id", function () {
            let data = new FormData();

            data.append("country_id", $("#country").val());
            data.append("state_id", $(this).val());
            data.append("_token", "{{ csrf_token() }}");

            send_ajax_request("post", data, "{{ route('admin.vendor.get.city') }}", function () { }, (data) => {
                $("#city_id").html("<option value=''>{{ __('Select Province') }}</option>" + data.option);
                $(".city_wrapper .list").html(data.li);
            }, (data) => {
                prepare_errors(data);
            })
        });
    </script>
@endsection