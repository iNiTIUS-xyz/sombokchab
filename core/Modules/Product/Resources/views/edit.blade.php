@extends('backend.admin-master')
@section('site-title', __('Update Product'))

@section('style')
    <x-media.css />
    <x-summernote.css />
    <x-product::variant-info.css />
    <style>
        /* ===== INVALID + FOCUS STYLE ===== */
        .is-invalid {
            border-color: #dc3545 !important;
        }

        .is-invalid:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }

        /* ===== SELECT2 ===== */
        .select2-container--default .select2-selection.is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }

        /* ===== SUMMERNOTE ===== */
        .note-editor.is-invalid {
            border: 1px solid #dc3545 !important;
            border-radius: 6px;
        }

        .note-editor.is-invalid:focus-within {
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }
    </style>
@endsection

@section('content')
    @php
        $subCat = $product?->subCategory?->id ?? null;
        $childCat = $product?->childCategory?->pluck('id')->toArray() ?? null;
        $cat = $product?->category?->id ?? null;
        $selectedDeliveryOption = $product?->delivery_option?->pluck('delivery_option_id')?->toArray() ?? [];
    @endphp

    <div class="dashboard-top-contents">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-inner-contents search-area top-searchbar-wrapper">
                    <div class="dashboard-flex-contetns">
                        <div class="dashboard-left-flex d-flex align-items-center justify-content-between w-100">
                            <h3 class="heading-three fw-500"> {{ __('Update Product') }} </h3>
                            <div class="button-wrappers">
                                <a href="{{ route('admin.products.all') }}" class="cmn_btn btn_bg_profile">
                                    {{ __('Products List') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-products-add bg-white radius-20 mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="row g-4">
                    <div class="col-xxl-2 col-lg-3 col-md-3">
                        <div class="nav flex-column nav-pills border-1 radius-10" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-general-info-tab" data-bs-toggle="pill"
                                data-bs-target="#v-general-info-tab" type="button" role="tab"
                                aria-controls="v-general-info-tab" aria-selected="true"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> {{ __('General Info') }}
                            </button>
                            <button class="nav-link" id="v-pills-price-tab" data-bs-toggle="pill"
                                data-bs-target="#v-price-tab" type="button" role="tab" aria-controls="v-price-tab"
                                aria-selected="false"><span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('Price') }}
                            </button>
                            <button class="nav-link" id="v-pills-images-tab-tab" data-bs-toggle="pill"
                                data-bs-target="#v-images-tab" type="button" role="tab" aria-controls="v-images-tab"
                                aria-selected="false"><span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('Images') }}
                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-inventory-tab" type="button" role="tab"
                                aria-controls="v-inventory-tab" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> {{ __('Inventory') }}
                            </button>
                            <button class="nav-link" id="v-pills-tags-and-label" data-bs-toggle="pill"
                                data-bs-target="#v-tags-and-label" type="button" role="tab"
                                aria-controls="v-tags-and-label" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> {{ __('Tags & Label') }}
                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-attributes-tab" type="button" role="tab"
                                aria-controls="v-attributes-tab" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> {{ __('Attributes') }}
                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-categories-tab" type="button" role="tab"
                                aria-controls="v-categories-tab" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> {{ __('Categories') }}
                            </button>
                            <button class="nav-link" id="v-pills-delivery-option-tab" data-bs-toggle="pill"
                                data-bs-target="#v-delivery-option-tab" type="button" role="tab"
                                aria-controls="v-delivery-option-tab" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> {{ __('Delivery Options') }}
                            </button>
                            <button class="nav-link" id="v-pills-meta-tag-tab" data-bs-toggle="pill"
                                data-bs-target="#v-meta-tag-tab" type="button" role="tab"
                                aria-controls="v-meta-tag-tab" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span> {{ __('Product Meta') }}
                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-settings-tab" type="button" role="tab"
                                aria-controls="v-settings-tab" aria-selected="false"><span
                                    style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('Product Settings') }}
                            </button>
                        </div>
                    </div>

                    <div class="col-xxl-10 col-lg-9 col-md-9">
                        <!-- novalidate so browser won't try to auto-focus hidden invalid controls -->
                        <form data-request-route="{{ route('admin.products.edit', $product?->id ?? 0) }}" method="post"
                            id="product-create-form" novalidate>
                            @csrf
                            <input name="id" type="hidden" value="{{ $product?->id }}">

                            <div class="form-button">
                                <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Update Product') }}</button>
                            </div>

                            <div class="tab-content margin-top-10" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-general-info-tab" role="tabpanel"
                                    aria-labelledby="v-general-info-tab">
                                    <x-product::general-info :brands="$data['brands']" :product="$product" />
                                </div>
                                <div class="tab-pane fade" id="v-price-tab" role="tabpanel"
                                    aria-labelledby="v-price-tab">
                                    <x-product::product-price :product="$product" :tax_classes="$data['tax_classes']" />
                                </div>
                                <div class="tab-pane fade" id="v-inventory-tab" role="tabpanel"
                                    aria-labelledby="v-inventory-tab">
                                    <x-product::product-inventory :units="$data['units']" :inventory="$product?->inventory" :uom="$product?->uom" />
                                </div>
                                <div class="tab-pane fade" id="v-images-tab" role="tabpanel"
                                    aria-labelledby="v-images-tab">
                                    <x-product::product-image :product="$product" />
                                </div>
                                <div class="tab-pane fade" id="v-tags-and-label" role="tabpanel"
                                    aria-labelledby="v-tags-and-label">
                                    <x-product::tags-and-badge :badges="$data['badges']" :tag="$product?->tag" :singlebadge="$product?->badge_id" />
                                </div>
                                <div class="tab-pane fade" id="v-attributes-tab" role="tabpanel"
                                    aria-labelledby="v-attributes-tab">
                                    <x-product::product-attribute :inventorydetails="$product?->inventory?->inventoryDetails" :colors="$data['product_colors']" :sizes="$data['product_sizes']"
                                        :allAttributes="$data['all_attribute']" />
                                </div>
                                <div class="tab-pane fade" id="v-categories-tab" role="tabpanel"
                                    aria-labelledby="v-categories-tab">
                                    <x-product::categories :sub_categories="$sub_categories" :categories="$data['categories']" :child_categories="$child_categories"
                                        :selected_child_cat="$childCat" :selected_sub_cat="$subCat" :selectedcat="$cat" />
                                </div>
                                <div class="tab-pane fade" id="v-delivery-option-tab" role="tabpanel"
                                    aria-labelledby="v-delivery-option-tab">
                                    <x-product::delivery-option :selected_delivery_option="$selectedDeliveryOption" :deliveryOptions="$data['deliveryOptions']" />
                                </div>
                                <div class="tab-pane fade" id="v-meta-tag-tab" role="tabpanel"
                                    aria-labelledby="v-meta-tag-tab">
                                    <x-product::meta-seo :meta_data="$product?->metaData" />
                                </div>
                                <div class="tab-pane fade" id="v-settings-tab" role="tabpanel"
                                    aria-labelledby="v-settings-tab">
                                    <x-product::settings :product="$product" />
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-media.markup />
@endsection

@section('script')
    <script src="{{ asset('assets/common/js/jquery-ui.min.js') }}"></script>
    <x-media.js />
    <x-summernote.js />
    <x-product::variant-info.js :colors="$data['product_colors']" :sizes="$data['product_sizes']" :all-attributes="$data['all_attribute']" />

    <script>
        (function($) {
            'use strict';

            const form = $('#product-create-form');

            /* ================= MARK INVALID ================= */
            function markInvalid(el) {
                const $el = $(el).addClass('is-invalid');

                // Select2
                if ($el.hasClass('select2-hidden-accessible')) {
                    $el.next('.select2-container')
                        .find('.select2-selection')
                        .addClass('is-invalid');
                }

                // Summernote
                if ($el.hasClass('summernote')) {
                    $el.next('.note-editor').addClass('is-invalid');
                }
            }

            function clearInvalid(el) {
                const $el = $(el).removeClass('is-invalid');

                // Select2
                if ($el.hasClass('select2-hidden-accessible')) {
                    $el.next('.select2-container')
                        .find('.select2-selection')
                        .removeClass('is-invalid');
                }

                // Summernote
                if ($el.hasClass('summernote')) {
                    $el.next('.note-editor').removeClass('is-invalid');
                }
            }

            /* ================= FIND FIRST REQUIRED ================= */
            function findFirstInvalid() {
                const fields = form[0].querySelectorAll('[required]');

                for (const el of fields) {
                    if (el.disabled) continue;

                    // Summernote
                    if (el.classList.contains('summernote')) {
                        const text = $(el).summernote('code')
                            .replace(/<[^>]+>/g, '')
                            .trim();
                        if (!text) return el;
                        continue;
                    }

                    // Select / input
                    if (!el.value || !el.value.trim()) {
                        return el;
                    }
                }
                return null;
            }

            /* ================= SWITCH TAB & FOCUS ================= */
            function focusField(el) {
                const $el = $(el);

                // Switch tab
                const pane = el.closest('.tab-pane');
                if (pane) {
                    const btn = document.querySelector(`[data-bs-target="#${pane.id}"]`);
                    if (btn) new bootstrap.Tab(btn).show();
                }

                setTimeout(() => {
                    // Summernote
                    if ($el.hasClass('summernote')) {
                        const editable = $el.next('.note-editor').find('.note-editable');
                        editable.focus();
                        return;
                    }

                    // Select2
                    if ($el.hasClass('select2-hidden-accessible')) {
                        $el.next('.select2-container')
                            .find('.select2-selection')
                            .trigger('focus');
                        return;
                    }

                    // Normal input
                    el.focus();
                }, 250);
            }

            /* ================= SUBMIT HANDLER ================= */
            form.on('submit', function(e) {
                e.preventDefault();

                const invalid = findFirstInvalid();
                if (invalid) {
                    markInvalid(invalid);
                    focusField(invalid);
                    return false;
                }

                // ✅ VALID → AJAX SUBMIT
                send_ajax_request(
                    'post',
                    new FormData(this),
                    $(this).data('request-route'),
                    function() {},
                    function(data) {
                        if (data.success) {
                            toastr.success('Product updated successfully');
                            setTimeout(() => {
                                window.location.href = "{{ route('admin.products.all') }}";
                            }, 800);
                        }
                    },
                    function(xhr) {
                        ajax_toastr_error_message(xhr);
                    }
                );
            });

            /* ================= REMOVE RED BORDER ON INPUT ================= */
            $(document).on('input change', 'input, textarea, select', function() {
                clearInvalid(this);
            });

            /* ================= SUMMERNOTE CHANGE FIX ================= */
            $(document).on('summernote.change', '.summernote', function() {
                const text = $(this).summernote('code')
                    .replace(/<[^>]+>/g, '')
                    .trim();

                if (text.length > 0) {
                    clearInvalid(this);
                }
            });

        })(jQuery);
    </script>


    <script>
        // other page scripts unchanged:
        $('#product-name , #product-slug').on('keyup', function() {
            let title_text = $(this).val();
            $('#product-slug').val(convertToSlug(title_text))
        });

        // NOTE: we removed the earlier duplicate submit handler to avoid conflicts
        // send_ajax_request is called from the validator when form is valid.

        let inventory_item_id = 0;
        $(document).on("click", ".delivery-item", function() {
            $(this).toggleClass("active");
            $(this).effect("shake", {
                direction: "up",
                times: 1,
                distance: 2
            }, 500);

            let delivery_option = "";
            $.each($(".delivery-item.active"), function() {
                delivery_option += $(this).data("delivery-option-id") + " , ";
            })

            delivery_option = delivery_option.slice(0, -3)
            $(".delivery-option-input").val(delivery_option);
        });

        $(document).on("change", "#category", function() {
            let data = new FormData();
            data.append("_token", "{{ csrf_token() }}");
            data.append("category_id", $(this).val());

            send_ajax_request("post", data, '{{ route('admin.product.category.sub-category') }}', function() {
                $("#sub_category").html("<option value=''>Select Sub Category</option>");
                $("#child_category").html("<option value=''>Select Child Category</option>");
                $("#select2-child_category-container").html('');
            }, function(data) {
                $("#sub_category").html(data.html);
            }, function(xhr) {
                ajax_toastr_error_message(xhr);
            });
        });

        $(document).on("change", "#sub_category", function() {
            let data = new FormData();
            data.append("_token", "{{ csrf_token() }}");
            data.append("sub_category_id", $(this).val());

            send_ajax_request("post", data, '{{ route('admin.product.category.child-category') }}', function() {
                $("#child_category").html("<option value=''>Select Child Category</option>");
                $("#select2-child_category-container").html('');
            }, function(data) {
                $("#child_category").html(data.html);
            }, function(xhr) {
                ajax_toastr_error_message(xhr);
            });
        });

        $(document).on('click', '.badge-item', function(e) {
            $(".badge-item").removeClass("active");
            $(this).addClass("active");
            $("#badge_id_input").val($(this).attr("data-badge-id"));
        });

        $(document).on("click", ".close-icon", function() {
            $('#media_upload_modal').modal('hide');
        });

        $(document).ready(function() {
            function toggleTaxClass() {
                const isTaxable = $('select[name="is_taxable"]').val();
                const taxClassDiv = $('select[name="tax_class_id"]').closest('.col-sm-6');

                if (isTaxable === "0") {
                    taxClassDiv.hide();
                    $('select[name="tax_class_id"]').prop('required', false);
                } else {
                    taxClassDiv.show();
                    $('select[name="tax_class_id"]').prop('required', true);
                }
            }

            toggleTaxClass();
            $('select[name="is_taxable"]').on('change', function() {
                toggleTaxClass();
            });
        });
    </script>
@endsection
