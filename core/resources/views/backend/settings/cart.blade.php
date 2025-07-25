@extends('backend.admin-master')
@section('style')
    <x-media.css />
@endsection
@section('site-title')
    {{ __('Cart Page Settings') }}
@endsection
@section('content')
    @can('page-settings-cart-page')
        <div class="col-lg-12 col-ml-12">
            <div class="row">
                <div class="col-lg-12">
                    <x-msg.success />
                    <x-msg.error />
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__title">
                                {{ __('Cart Page Settings') }}
                            </h4>
                        </div>
                        <div class="dashboard__card__body custom__form mt-4">
                            <form action="{{ route('admin.page.settings.cart') }}" method="POST">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="empty_cart_text">
                                                {{ __('Empty Cart Text') }}
                                            </label>
                                            <input type="text" placeholder="{{ __('Enter empty cart text') }}"
                                                class="form-control" id="empty_cart_text" name="empty_cart_text"
                                                value="{{ get_static_option('empty_cart_text') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="back_to_home_text">
                                                {{ __('Back to Home Text') }}
                                            </label>
                                            <input type="text" placeholder="{{ __('Enter back to home text') }}"
                                                class="form-control" id="back_to_home_text" name="back_to_home_text"
                                                value="{{ get_static_option('back_to_home_text') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-media-upload :oldimage="get_static_option('empty_cart_image')" :name="'empty_cart_image'" :dimentions="'465X465'"
                                                :title="__('Empty Cart Image')" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="clear_cart_text">
                                                {{ __('Clear Cart Button Text') }}
                                            </label>
                                            <input type="text" placeholder="{{ __('Enter clear cart button text') }}"
                                                class="form-control" id="clear_cart_text" name="clear_cart_text"
                                                value="{{ get_static_option('clear_cart_text') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="update_cart_text">
                                                {{ __('Update Cart Button Text') }}
                                            </label>
                                            <input type="text" placeholder="{{ __('Enter update cart button text') }}"
                                                class="form-control" id="update_cart_text" name="update_cart_text"
                                                value="{{ get_static_option('update_cart_text') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="cart_continue_shopping_text">
                                                {{ __('Continue Shopping Button Text') }}
                                            </label>
                                            <input type="text" placeholder="{{ __('Enter continue shopping button text') }}"
                                                class="form-control" id="cart_continue_shopping_text"
                                                name="cart_continue_shopping_text"
                                                value="{{ get_static_option('cart_continue_shopping_text') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="cart_coupon_discount_title">
                                                {{ __('Coupon Discount Title') }}
                                            </label>
                                            <input type="text" placeholder="{{ __('Enter coupon discount title') }}"
                                                class="form-control" id="cart_coupon_discount_title"
                                                name="cart_coupon_discount_title"
                                                value="{{ get_static_option('cart_coupon_discount_title') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="cart_coupon_discount_subtitle">
                                                {{ __('Coupon Discount Subtitle') }}
                                            </label>
                                            <input type="text" placeholder="{{ __('Enter coupon discount subtitle') }}"
                                                class="form-control" id="cart_coupon_discount_subtitle"
                                                name="cart_coupon_discount_subtitle"
                                                value="{{ get_static_option('cart_coupon_discount_subtitle') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="cart_coupon_discount_placeholder">
                                                {{ __('Coupon Discount Placeholder') }}
                                            </label>
                                            <input type="text" placeholder="{{ __('Enter coupon discount placeholder') }}"
                                                class="form-control" id="cart_coupon_discount_placeholder"
                                                name="cart_coupon_discount_placeholder"
                                                value="{{ get_static_option('cart_coupon_discount_placeholder') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="cart_apply_coupon_text">
                                                {{ __('Apply Coupon Button Text') }}
                                            </label>
                                            <input type="text" placeholder="{{ __('Enter apply coupon button text') }}"
                                                class="form-control" id="cart_apply_coupon_text" name="cart_apply_coupon_text"
                                                value="{{ get_static_option('cart_apply_coupon_text') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="cart_total_title">
                                                {{ __('Cart Total Title') }}
                                            </label>
                                            <input type="text" placeholder="{{ __('Enter cart total title') }}"
                                                class="form-control" id="cart_total_title" name="cart_total_title"
                                                value="{{ get_static_option('cart_total_title') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="cart_proceed_to_checkout_text">
                                                {{ __('Proceed to Checkout Button Text') }}
                                            </label>
                                            <input type="text"
                                                placeholder="{{ __('Enter proceed to checkout button text') }}"
                                                class="form-control" id="cart_proceed_to_checkout_text"
                                                name="cart_proceed_to_checkout_text"
                                                value="{{ get_static_option('cart_proceed_to_checkout_text') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button class="cmn_btn btn_bg_profile">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-media.markup />
    @endcan
@endsection
@section('script')
    <x-media.js />
@endsection
