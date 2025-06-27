@extends('backend.admin-master')
@section('site-title')
    {{ __('Shipping Zones') }}
@endsection
@section('site-title')
    {{ __('Shipping Zones') }}
@endsection

@section('style')
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12" id="shipping-zone-wrapper-box">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="margin-top-40">
                    <x-flash-msg />
                    <x-error-msg />
                </div>
            </div>
            <div class="col-md-12">
                <form id="shipping-zone-create-form">
                    <div class="dashboard__card py-5">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__title">{{ __('Create Shipping Zone') }}</h4>
                        </div>
                        <div class="dashboard__card__body custom__form my-5">
                            @csrf
                            <div class="form-group">
                                <label>
                                    {{ __('Zone Name') }}
                                </label>
                                <input class="form-control" name="zone_name"
                                    placeholder="{{ __('Enter shipping zone') }}" />
                            </div>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>{{ __('Country') }}</th>
                                        <th>{{ __('States') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $rand = random_int(9999999, 11111111);
                                    @endphp
                                    @include('shippingmodule::admin.shipping-zone-tr')
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <button class="cmn_btn btn_bg_profile">
                                {{ __('Add') }}
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
        $(document).on("submit", "#shipping-zone-create-form", function (e) {
            e.preventDefault();
            send_ajax_request("POST", new FormData(e.target), "{{ route('admin.shipping.zone.store') }}", () => { },
                (data) => {
                    ajax_toastr_success_message(data)
                    setTimeout(() => {
                        // window.location.reload();
                        window.location.href = "{{ route('admin.shipping.zone.all') }}";
                    }, 1000);
                }, (err) => {
                    ajax_toastr_error_message(err)
                })
        });

        $(document).on("click", "#shipping_zone_plus_btn", function () {

            let data = `@include('shippingmodule::admin.shipping-zone-tr')`;
            $(this).parent().parent().parent().append(data);

            let row = $("#shipping-zone-create-form tbody tr")[$("#shipping-zone-create-form tbody tr").length - 1];

        });

        $(document).on("click", "#shipping_zone_minus_btn", function () {
            let tr = $(this).parent().parent();

            if (tr.parent().find("tr").length > 1) {
                tr.remove();
            }
        });

    </script>
@endsection