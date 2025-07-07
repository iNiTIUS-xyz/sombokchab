@extends('backend.admin-master')

@section('site-title', __('Tax Settings'))

@section('content')
    <div>
        <x-msg.flash />
        <x-msg.error />
    </div>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h3 class="dashboard__card__title">
                            {{ __('Tax Settings') }}
                        </h3>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('admin.tax-module.settings') }}" method="post" class="row">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="tax_system">
                                    {{ __('Select Tax System') }}
                                    <span id="enable-info-about-tax-system">
                                        <i class="las la-info-circle"></i>
                                    </span>
                                </label>
                                <div>
                                    <select class="form-select" name="tax_system" id="tax_system">
                                        <option {{ get_static_option('tax_system') == 'zone_wise_tax_system' ? 'selected' : '' }}
                                            value="zone_wise_tax_system">
                                            {{ __('Zone wise tax system') }}
                                        </option>
                                        <option {{ get_static_option('tax_system') == 'advance_tax_system' ? 'selected' : '' }}
                                            value="advance_tax_system">
                                            {{ __('Advance Tax system') }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="">
                                
                                <div class="col-md-12 p-0 m-0" id="advance_tax_system_settings">
                                    <div class="form-group row">
                                        <label for="prices_entered_with_tax">
                                            {{ __('Prices entered with tax') }}
                                        </label>
                                        <fieldset id="prices_entered_with_tax">
                                            <ul>
                                                <li>
                                                    <label>
                                                        <input name="prices_include_tax"
                                                            {{ get_static_option('prices_include_tax') == 'yes' ? 'checked' : '' }}
                                                            value="yes" type="radio" style="" class="">
                                                        Yes, I will enter prices inclusive of tax
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input name="prices_include_tax"
                                                            {{ get_static_option('prices_include_tax') == 'no' ? 'checked' : '' }}
                                                            value="no" type="radio" style="" class="">
                                                        No, I will enter prices exclusive of tax
                                                    </label>
                                                </li>
                                            </ul>
                                        </fieldset>
                                    </div>
                                    <div class="form-group row">
                                        <label for="calculate_tax_based_on">
                                            {{ __('Calculate tax based on') }}
                                        </label>
                                        <div>
                                            <select name="calculate_tax_based_on" id="calculate_tax_based_on" class="form-select">
                                                <option
                                                    {{ get_static_option('calculate_tax_based_on') == 'customer_billing_address' ? 'selected' : '' }}
                                                    value="customer_billing_address">
                                                    {{ __('Customer Billing Address') }}
                                                </option>
                                                <option
                                                    {{ get_static_option('calculate_tax_based_on') == 'vendor_shop_address' ? 'selected' : '' }}
                                                    value="vendor_shop_address">
                                                    {{ __('Vendor Base Address') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="shipping_tax_class">
                                            {{ __('Shipping tax class') }}
                                        </label>
                                        <div>
                                            <select name="shipping_tax_class" id="shipping_tax_class" class="form-select">
                                                <option value="shipping_tax_class_based_on_cart_items">
                                                    {{ __('Shipping tax class based on cart items') }}
                                                </option>
                                                @foreach ($taxClasses as $taxClass)
                                                    <option
                                                        {{ get_static_option('shipping_tax_class') == $taxClass->id ? 'selected' : '' }}
                                                        value="{{ $taxClass->id }}">
                                                        {{ $taxClass->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="mt-2">
                                                <a href="{{ route('admin.tax-module.tax-class') }}" class="text-primary">
                                                    {{ __('Add tax class') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tax_round_at_subtotal">
                                            {{ __('Rounding') }}
                                        </label>
                                        <div>
                                            <label for="tax_round_at_subtotal" class="form-check-label">
                                                <input name="tax_round_at_subtotal"
                                                    {{ get_static_option('tax_round_at_subtotal') ? 'checked' : '' }}
                                                    id="tax_round_at_subtotal" type="checkbox" class="form-control-check"
                                                    value="1">
                                                <span>{{ __('Round tax at subtotal level, instead of rounding per line') }}

                                                </span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tax_round_at_subtotal">
                                            {{ __('Display prices in the shop') }}
                                        </label>
                                        <div>
                                            <select id="display_price_in_the_shop" name="display_price_in_the_shop"
                                                class="form-control">
                                                <option
                                                    {{ get_static_option('display_price_in_the_shop') == 'including' ? 'selected' : '' }}
                                                    value="including">
                                                    {{ __('Including tax') }}
                                                </option>
                                                <option
                                                    {{ get_static_option('display_price_in_the_shop') == 'exclusive' ? 'selected' : '' }}
                                                    value="exclusive">
                                                    {{ __('Exclusive tax') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    @if (false)
                                        <div class="form-group row">
                                            <label for="tax_round_at_subtotal">
                                                {{ __('Display tax totals') }}
                                            </label>
                                            <div>
                                                <select id="display_tax_total" name="display_tax_total" class="form-control">
                                                    <option
                                                        {{ get_static_option('display_tax_total') == 'itemized' ? 'selected' : '' }}
                                                        value="itemized">
                                                        {{ __('Itemized') }}
                                                    </option>
                                                    <option {{ get_static_option('display_tax_total') == 'single' ? 'selected' : '' }}
                                                        value="single">
                                                        {{ __('As a single total') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="cmn_btn btn_bg_profile">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                            <div class="">
                                <div class="info-tax-system d-none">
                                    <p>
                                        {{ __('Our Advanced Tax System offers unparalleled features for seamless tax management.') }}
                                    </p>
                                    <p>
                                        {{ __('With the ability to select multiple taxes across various regions, you can effortlessly comply with global regulations.') }}
                                    </p>
                                    <p>
                                        {{ __('Choose to display taxes individually per product or as a subtotal at checkout, providing transparency and a streamlined customer experience.') }}
                                    </p>
                                    <p>
                                        {{ __('Simplify tax calculations, enhance efficiency, and ensure compliance with ease.') }}
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script>
        $(document).on("click", "#enable-info-about-tax-system", function() {
            $(".info-tax-system").toggleClass("d-none");
        });

        tax_system();

        $(document).on("change", "#tax_system", function() {
            tax_system();
        });

        function tax_system() {
            let tax_system = $("#tax_system").val();
            if (tax_system == 'zone_wise_tax_system') {
                $("#advance_tax_system_settings").fadeOut();
                return "";
            }

            $("#advance_tax_system_settings").fadeIn();
        }
    </script>
@endsection
