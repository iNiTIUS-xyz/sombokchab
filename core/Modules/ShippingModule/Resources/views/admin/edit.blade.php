@extends('backend.admin-master')

@section('site-title')
    {{ __('Shipping Zones') }}
@endsection

@section('site-title')
    {{ __('Shipping Zones') }}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12" id="shipping-zone-wrapper-box">
        <div class="row g-4">
            <div class="col-md-12">
                <form id="shipping-zone-create-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $zone->id }}" />
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__title">
                                {{ __('Update Shipping Zone') }}
                            </h4>
                        </div>
                        <div class="dashboard__card__body custom__form mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Shipping Zone') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" name="zone_name" value="{{ $zone->name }}"
                                            placeholder="{{ __('Enter shipping zone.') }}" required="" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            {{ __('Country') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="country_id">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    @if ($zone->country_id == $country->id) selected @endif>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label>
                                            {{ __('City') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="city_id">
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    @if ($zone->city_id == $city->id) selected @endif>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <button class="cmn_btn btn_bg_profile">
                                {{ __('Update') }}
                            </button>
                            <a href="{{ route('admin.shipping.zone.all') }}" class="cmn_btn default-theme-btn"
                                style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on("change", "#country_select", function() {
            let val = $(this).val();
            let urlToRequest = "{{ route('frontend.get-states') }}" + "/" + $(this).val();

            send_ajax_request("get", null, urlToRequest, () => {
                $(this).parent().parent().find("#states_select").html(
                    `<option value="">{{ __("Please wait we're finding states") }}</option>`);
            }, (data) => {
                if (data.success) {
                    $(this).parent().parent().find("#states_select").parent().find(".multiple-options")
                        .html("");
                    $(this).parent().parent().find("#states_select").attr("name", "states[" + val + "][]");
                    $(this).parent().parent().find("#states_select").html(data.data);
                    $(this).parent().parent().find("#states_select").parent().find("ul").html(data.list);
                }
            }, (err) => {
                ajax_toastr_error_message(err)
            })
        });

        $(document).on("submit", "#shipping-zone-create-form", function(e) {
            e.preventDefault();

            send_ajax_request("POST", new FormData(e.target),
                "{{ route('admin.shipping.zone.update', $zone->id) }}", () => {}, (data) => {

                    ajax_toastr_success_message(data)

                    setTimeout(() => {
                        window.location.href = "{{ route('admin.shipping.zone.all') }}";
                    }, 1000);

                }, (err) => {
                    ajax_toastr_error_message(err)
                })
        });

        $(document).on("click", "#shipping_zone_plus_btn", function() {

            let data = `@include('shippingmodule::admin.shipping-zone-tr')`;
            $(this).parent().parent().parent().append(data);

            let row = $("#shipping-zone-create-form tbody tr")[$("#shipping-zone-create-form tbody tr").length - 1];

        });

        $(document).on("click", "#shipping_zone_minus_btn", function() {
            let tr = $(this).parent().parent();

            if (tr.parent().find("tr").length > 1) {
                tr.remove();
            }
        });
    </script>
@endsection
