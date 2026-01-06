@extends('backend.admin-master')

@section('site-title')
    {{ __('App Campaigns') }}
@endsection

@section('style')
    <style>
        .available-form-field.form-field-space li:not(:last-child),
        .available-form-field.main-fields li:not(:last-child) {
            margin-bottom: 0 !important;
        }


        .select2-container--default .select2-selection--multiple {
            max-height: 100px;
            overflow-y: auto;
        }

        /* Red close icon */
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #dc3545 !important;
            font-weight: bold;
        }

        /* Optional: darker red on hover */
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #a71d2a !important;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('App Campaigns') }}
                        </h4>
                    </div>
                    <div class="dashboard__card__body custom__form">
                        <form action="{{ route('admin.mobile.campaign.update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <div class="form-group" id="product-list">
                                        <label for="products">Select Campaign</label>
                                        <select id="products" name="campaign_ids[]" class="form-control select2" multiple>
                                            @foreach ($campaigns as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $selectedCampaign ? (in_array($item->id, json_decode($selectedCampaign->campaign_ids)) ? 'selected' : '') : '' }}>
                                                    {{ $item->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="form-group" id="product-list">
                                        <label>Limit of Campaign</label>
                                        <input type="number" name="limit" class="form-control"
                                            value="{{ $selectedCampaign ? $selectedCampaign->limit : '' }}" />
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
