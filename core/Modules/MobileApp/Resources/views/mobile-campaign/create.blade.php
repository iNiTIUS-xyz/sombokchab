@extends('backend.admin-master')

@section('site-title')
    {{ __('Campaign') }}
@endsection

@section('style')

@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('Update Mobile Campaign') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body custom__form">
                        <form action="{{ route('admin.mobile.campaign.update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <div class="form-group" id="product-list">
                                        <label for="products">Select Campaign</label>
                                        <select id="products" name="campaign[]" class="form-control select2" multiple>
                                            @foreach ($campaigns as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $selectedCampaignIds ? (in_array($item->id, $selectedCampaignIds) ? 'selected' : '') : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="form-group">
                                        <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Update') }}</button>
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
    <script>
        $(".select2").select2();
    </script>
@endsection
