@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Cart') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/common/css/toastr.css') }}">
    <style>
        .lds-ellipsis {
            display: inline-block;
            position: fixed;
            width: 80px;
            height: 80px;
            left: 50vw;
            top: 40vh;
            z-index: 50;
            display: none;
        }

        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: var(--main-color-one);
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(24px, 0);
            }
        }

        tr.disabled.table-cart-row td {
            background: #dddddd;
            cursor: no-drop;
        }


        .only-img-page-wrapper.cart .img-box img {
            height: 100%;
        }

        .only-img-page-wrapper.cart .img-box {
            height: 400px;
            display: flex;
            justify-content: center;
        }
    </style>
@endsection

@section('content')
    <div class="cart-page-wrapper padding-top-20 padding-bottom-20">
        @php

            if (request('sorting_by')) {
                $all_cart_items = \Gloudemans\Shoppingcart\Facades\Cart::content()->sortBy(request('sorting_by'));
            } else {
                $all_cart_items = \Gloudemans\Shoppingcart\Facades\Cart::content();
            }

        @endphp

        @if (empty($all_cart_items->count()))
            <x-frontend.page.empty :image="get_static_option('empty_cart_image')" :text="get_static_option('empty_cart_text') ?? __('No products in your cart!')" />
        @else
            <div id="cart-container">
                @include('frontend.cart.cart-partial')
            </div>
        @endif
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        (function($) {
            'use strict';

            // Shared flag to prevent multiple updates
            let isUpdating = false;

            // Move to wishlist handler
            $(document).on("click", ".move-wishlist", function(e) {
                e.preventDefault();
                let data = new FormData();
                data.append("rowId", $(this).attr("data-product_hash_id"));
                data.append("_token", "{{ csrf_token() }}");

                send_ajax_request("post", data, "{{ route('frontend.products.cart.move.to.wishlist') }}",
                    () => {},
                    (data) => {
                        loadHeaderCardAndWishlistArea(data);
                        if ((data.type ?? '') == 'warning') {
                            toastr.warning(data.quantity_msg ?? 'Something went wrong');
                        } else {
                            ajax_toastr_success_message(data);
                        }
                        $(".cart-page-wrapper").load(location.href + " .cart-page-wrapper");
                    },
                    (errors) => {
                        prepare_errors(errors);
                    }
                );
            });

            // Remove from cart handler
            $(document).on("click", ".remove-cart", function(e) {
                e.preventDefault();
                let formData = new FormData();
                formData.append("rowId", $(this).attr("data-product_hash_id"));
                formData.append("_token", "{{ csrf_token() }}");

                send_ajax_request("post", formData, "{{ route('frontend.products.cart.ajax.remove') }}",
                    () => {},
                    (data) => {
                        loadHeaderCardAndWishlistArea(data);
                        ajax_toastr_success_message(data);
                        $(".cart-page-wrapper").load(location.href + " .cart-page-wrapper");
                    },
                    (errors) => {
                        prepare_errors(errors);
                    }
                );
            });

            // Quantity button handlers with proper debouncing
            $(document).on('click', '.product-quantity .plus, .product-quantity .substract', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                if (isUpdating) return;

                const $button = $(this);
                const $row = $button.closest('tr');
                const $input = $row.find('.quantity-input');
                let currentVal = parseInt($input.val());
                let newVal = currentVal;

                // Determine if we're increasing or decreasing
                if ($button.hasClass('plus')) {
                    newVal = currentVal + 1;
                } else if ($button.hasClass('substract') && currentVal > 1) {
                    newVal = currentVal - 1;
                } else {
                    return; // Don't allow quantity less than 1
                }

                // Immediately update the UI
                $input.val(newVal);

                // Update the cart
                updateCartItem($row, newVal);
            });

            // Clear cart handler
            $(document).on('click', '.clear_cart', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('frontend.products.cart.ajax.clear') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        if (data.type === 'success') {
                            toastr.success(data.msg);
                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        }
                    },
                    error: function(err) {
                        toastr.error('{{ __('An error occurred') }}');
                    }
                });
            });

            // Coupon handler
            $(document).on('submit', '.discount-coupon', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let data = $(this).serialize();
                $('.lds-ellipsis').show();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        $('.lds-ellipsis').hide();
                        $('#cart-container').html(data);
                    },
                    error: function(err) {
                        toastr.error('{{ __('An error occurred') }}');
                    }
                });
            });

            // Unified cart update function
            function updateCartItem($row, newQuantity) {
                isUpdating = true;

                // Show loading state
                $row.css('opacity', '0.5');
                $row.find('.plus, .substract').prop('disabled', true);

                const data = {
                    rowId: $row.data('product_hash_id'),
                    quantity: newQuantity,
                    product_id: $row.data('product-id'),
                    variant_id: $row.data('varinat-id'),
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('frontend.products.cart.update.ajax') }}",
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        // Update UI
                        $row.css('opacity', '1');
                        $row.find('.plus, .substract').prop('disabled', false);

                        // Update total price
                        const priceText = $row.find('.price-td').first().text();
                        const price = parseFloat(priceText.replace(/[^\d.-]/g, ''));
                        const newTotal = price * newQuantity;
                        $row.find('.price-td.color-one').text(amount_with_currency_symbol(newTotal));

                        // Show message if exists
                        if (response.msg) {
                            toastr[response.type || 'success'](response.msg);
                        }

                        // Update header cart
                        if (typeof loadHeaderCardAndWishlistArea === 'function') {
                            loadHeaderCardAndWishlistArea(response);
                        }
                    },
                    error: function(xhr) {
                        $row.css('opacity', '1');
                        $row.find('.plus, .substract').prop('disabled', false);

                        // Revert the quantity if update failed
                        $row.find('.quantity-input').val($row.data('last-valid-quantity') || 1);

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            prepare_errors(xhr.responseJSON.errors);
                        } else {
                            toastr.error('{{ __('An error occurred while updating quantity') }}');
                        }
                    },
                    complete: function() {
                        isUpdating = false;
                    }
                });
            }

            // Store last valid quantity on focus
            $(document).on('focus', '.quantity-input', function() {
                $(this).closest('tr').data('last-valid-quantity', $(this).val());
            });
        })(jQuery);
    </script>
@endsection
