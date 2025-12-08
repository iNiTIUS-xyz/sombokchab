@extends('backend.admin-master')
@section('site-title')
    {{ __('Shipping Method Update') }}
@endsection

@section('style')
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 dashboard-area">
        <div class="row">
            <div class="col-lg-12">

                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Edit Shipping Method') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form dashboard-recent-order mt-4">
                        <form action="{{ route('admin.shipping-method.update', $method->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="zone_id">
                                            {{ __('Shipping Zone') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="zone_id" id="zone_id" class="form-control" required="">
                                            @foreach ($all_zones as $zone)
                                                <option {{ $method->zone_id == $zone->id ? 'selected' : '' }}
                                                    value="{{ $zone->id }}">
                                                    {{ $zone->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">
                                            {{ __('Title') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input value="{{ $method->title }}" name="title" class="form-control"
                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                            placeholder="{{ __('Enter title') }}" required="" />
                                    </div>

                                    <div class="form-group">
                                        <label for="status">
                                            {{ __('Status') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="status" id="status" class="form-control" required="">
                                            @foreach ($all_publish_status as $key => $status)
                                                <option {{ $method->status_id == $key ? 'selected' : '' }}
                                                    value="{{ $key }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cost">
                                            {{ __('Cost') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input value="{{ $method->cost }}" type="number" id="cost" name="cost"
                                            class="form-control" placeholder="{{ __('Enter cost') }}" required="">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="cmn_btn btn_bg_profile">
                                            {{ __('Update') }}
                                        </button>
                                        <a href="{{ route('admin.shipping-method.index') }}"
                                            class="cmn_btn default-theme-btn"
                                            style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                            {{ __('Back') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
