@extends("backend.admin-master")

@section("style")
    <style>
        /* Custom Switch Css */
        .custom_switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }
        @media only screen and (max-width: 375px) {
            .custom_switch {
                width: 40px;
                height: 24px;
            }
        }
        .custom_switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .custom_switch input:checked + .sliderSwitch {
            background-color: var(--customer-profile);
        }
        .custom_switch input:checked + .sliderSwitch:before {
            -webkit-transform: translateX(20px);
            transform: translateX(20px);
        }
        @media only screen and (max-width: 375px) {
            .custom_switch input:checked + .sliderSwitch:before {
                -webkit-transform: translateX(16px);
                transform: translateX(16px);
            }
        }
        .custom_switch input:focus + .sliderSwitch {
            -webkit-box-shadow: 0 0 1px var(--main-color-one);
            box-shadow: 0 0 1px var(--main-color-one);
        }
        .custom_switch .sliderSwitch {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: 0.4s;
            transition: 0.4s;
        }
        .custom_switch .sliderSwitch:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            -webkit-transition: 0.4s;
            transition: 0.4s;
        }
        @media only screen and (max-width: 375px) {
            .custom_switch .sliderSwitch:before {
                height: 18px;
                width: 18px;
            }
        }
        .custom_switch .sliderSwitch.round {
            border-radius: 30px;
        }
        .custom_switch .sliderSwitch.round::before {
            border-radius: 50%;
        }
    </style>
@endsection

@section("site-title", __("Delivery man settings"))

@section("content")
    <x-msg.success />
    <x-msg.error />
    <div class="dashboard__card card__two">
        <div class="dashboard__card__header">
            <h4 class="dashboard__card__title">{{ __("Delivery man settings") }}</h4>
        </div>
        <div class="dashboard__card__body custom__form">
            <form action="{{ route("admin.delivery-man.settings") }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>
                        {{ __("Google map client key") }}
                        <input type="text" class="form-control form-control-sm mt-2" name="map_api_key_client" value="{{ get_static_option("map_api_key_client") ?? "" }}" placeholder="{{ __("Google map api client key") }}">
                    </label>
                </div>

                <div class="form-group">
                    <label>
                        {{ __("Google map server key") }}
                        <input type="text" class="form-control form-control-sm mt-2" name="map_api_server_key" value="{{ get_static_option("map_api_server_key") ?? "" }}" placeholder="{{ __("Google map api server key") }}">
                    </label>
                </div>

                <div class="form-group">
                    <label>
                        {{ __("Allow auto suggestion delivery man") }}
                        <label class="custom_switch mt-2">
                            <input type="checkbox" name="auto_suggestion_delivery_man" value="on" {{ get_static_option("auto_suggestion_delivery_man") == "on" ? "checked" : "" }}>
                            <span class="sliderSwitch round"></span>
                        </label>
                    </label>
                </div>

                <div class="form-group">
                    <label>
                        {{ __("Firebase Server key") }}
                        <input type="text" name="firebase_server_key" value="{{ get_static_option("firebase_server_key") }}" class="form-control">
                    </label>
                </div>

                <div class="form-group mt-4">
                    <button class="cmn_btn btn_bg_profile">{{ __("Update") }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("script")

@endsection