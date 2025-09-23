@extends('frontend.frontend-page-master')

@section('page-title')
    {{ __('Cart') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/common/css/toastr.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">

    <style>
        .table-list-content .custom--table tbody tr td {
            width: unset !important;
        }

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

        /*
    </style>
    <style>
        */

        /* Optional: Style the quantity display to look like an input */
        .quantity-display {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            min-width: 40px;
            text-align: center;
            font-weight: 500;
            user-select: none;
            /* Prevent text selection */
        }

        /* Disable button states when at limits */
        .product-quantity .plus:disabled,
        .product-quantity .substract:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
    {{-- <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable only if the table exists
            if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    paging: true,
                    lengthChange: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    responsive: true,
                    language: {
                        search: "Filter:"
                    }
                });
            }
        });
    </script>

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

            $(document).on('click', '.product-quantity .plus, .product-quantity .substract', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                if (isUpdating) return;

                const $button = $(this);
                const $row = $button.closest('tr');
                const $input = $row.find('.quantity-input');
                const $display = $row.find('.quantity-display');

                let currentVal = parseInt($input.val());
                let newVal = currentVal;

                // Get min and max values
                const maxQty = parseInt($input.data('max')) || 999;
                const minQty = parseInt($input.data('min')) || 1;

                // Determine if we're increasing or decreasing with validation
                if ($button.hasClass('plus')) {
                    if (currentVal < maxQty) {
                        newVal = currentVal + 1;
                    } else {
                        // Show message when trying to exceed max quantity
                        toastr.warning('Maximum quantity available: ' + maxQty);
                        return;
                    }
                } else if ($button.hasClass('substract')) {
                    if (currentVal > minQty) {
                        newVal = currentVal - 1;
                    } else {
                        // Show message when trying to go below minimum
                        toastr.warning('Minimum quantity is: ' + minQty);
                        return;
                    }
                }

                // Update both hidden input and visible display
                $input.val(newVal);
                $display.text(newVal);

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

                // Store the last valid quantity for potential rollback
                const $input = $row.find('.quantity-input');
                const $display = $row.find('.quantity-display');
                const lastValidQuantity = parseInt($input.data('last-valid-quantity')) || parseInt($input.val());

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

                        // Store the successful quantity as last valid
                        $input.data('last-valid-quantity', newQuantity);

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

                        // Revert both input and display to last valid quantity
                        $input.val(lastValidQuantity);
                        $display.text(lastValidQuantity);

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
