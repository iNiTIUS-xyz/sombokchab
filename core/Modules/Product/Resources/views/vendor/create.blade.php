@extends('vendor.vendor-master')
@section('site-title')
    {{ __('Add new Product') }}
@endsection
@section('style')
    <x-media.css />
    <x-summernote.css />
    <x-product::variant-info.css />
    <x-select2.select2-css />

    <style>
        /* Normal inputs */
        /* ===== INVALID + FOCUS STYLE (like screenshot) ===== */
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
        }

        .select2-container--default .select2-selection.is-invalid:focus,
        .select2-container--default .select2-selection.is-invalid.select2-selection--single {
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
    <div class="dashboard-top-contents">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-inner-contents search-area top-searchbar-wrapper">
                    <div class="dashboard-flex-contetns">
                        <div class="dashboard-left-flex">
                            <h3 class="dashboard__card__title"> {{ __('Add New Product') }} </h3>
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
                    <div class="col-sm-4 col-md-3 col-lg-4 col-xl-3 col-xxl-2">
                        <div class="nav flex-column nav-pills border-1 radius-10" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-general-info-tab" data-bs-toggle="pill"
                                data-bs-target="#v-general-info-tab" type="button" role="tab"
                                aria-controls="v-general-info-tab" aria-selected="true">
                                <span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('General Info') }}
                            </button>
                            <button class="nav-link" id="v-pills-price-tab" data-bs-toggle="pill"
                                data-bs-target="#v-price-tab" type="button" role="tab" aria-controls="v-price-tab"
                                aria-selected="false">
                                <span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('Price') }}
                            </button>
                            <button class="nav-link" id="v-pills-images-tab-tab" data-bs-toggle="pill"
                                data-bs-target="#v-images-tab" type="button" role="tab" aria-controls="v-images-tab"
                                aria-selected="false">
                                <span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('Images') }}
                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-inventory-tab" type="button" role="tab"
                                aria-controls="v-inventory-tab" aria-selected="false">
                                <span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('Inventory') }}
                            </button>
                            <button class="nav-link" id="v-pills-tags-and-label" data-bs-toggle="pill"
                                data-bs-target="#v-tags-and-label" type="button" role="tab"
                                aria-controls="v-tags-and-label" aria-selected="false">
                                <span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('Tags & Label') }}
                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-attributes-tab" type="button" role="tab"
                                aria-controls="v-attributes-tab" aria-selected="false">
                                <span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('Attributes') }}
                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-categories-tab" type="button" role="tab"
                                aria-controls="v-categories-tab" aria-selected="false">
                                <span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('Categories') }}
                            </button>
                            <button class="nav-link" id="v-pills-delivery-option-tab" data-bs-toggle="pill"
                                data-bs-target="#v-delivery-option-tab" type="button" role="tab"
                                aria-controls="v-delivery-option-tab" aria-selected="false">
                                <span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('Delivery Options') }}
                            </button>
                            <button class="nav-link" id="v-pills-meta-tag-tab" data-bs-toggle="pill"
                                data-bs-target="#v-meta-tag-tab" type="button" role="tab"
                                aria-controls="v-meta-tag-tab" aria-selected="false">
                                <span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('Product Meta') }}
                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                data-bs-target="#v-settings-tab" type="button" role="tab"
                                aria-controls="v-settings-tab" aria-selected="false">
                                <span style='font-size:15px; padding-right: 7px;'>&#9679;</span>
                                {{ __('Product Settings') }}
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-9 col-lg-8 col-xl-9 col-xxl-10">
                        <form class="was-validated" novalidate data-request-route="{{ route('vendor.products.create') }}"
                            method="post" id="product-create-form">
                            @csrf
                            <div class="form-button">
                                <button type="submit" class="cmn_btn btn_bg_profile">
                                    {{ __('Add New Product') }}
                                </button>
                            </div>
                            <div class="tab-content margin-top-10" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-general-info-tab" role="tabpanel"
                                    aria-labelledby="v-general-info-tab">
                                    <x-product::general-info :brands="$data['brands']" />
                                </div>
                                <div class="tab-pane fade" id="v-price-tab" role="tabpanel"
                                    aria-labelledby="v-price-tab">
                                    <x-product::product-price :tax_classes="$data['tax_classes']" />
                                </div>
                                <div class="tab-pane fade" id="v-inventory-tab" role="tabpanel"
                                    aria-labelledby="v-inventory-tab">
                                    <x-product::product-inventory :units="$data['units']" />
                                </div>
                                <div class="tab-pane fade" id="v-images-tab" role="tabpanel"
                                    aria-labelledby="v-images-tab">
                                    <x-product::product-image />
                                </div>
                                <div class="tab-pane fade" id="v-tags-and-label" role="tabpanel"
                                    aria-labelledby="v-tags-and-label">
                                    <x-product::tags-and-badge :badges="$data['badges']" />
                                </div>
                                <div class="tab-pane fade" id="v-attributes-tab" role="tabpanel"
                                    aria-labelledby="v-attributes-tab">
                                    <x-product::product-attribute :is-first="true" :colors="$data['product_colors']" :sizes="$data['product_sizes']"
                                        :allAttributes="$data['all_attribute']" />
                                </div>
                                <div class="tab-pane fade" id="v-categories-tab" role="tabpanel"
                                    aria-labelledby="v-categories-tab">
                                    <x-product::categories :categories="$data['categories']" />
                                </div>
                                <div class="tab-pane fade" id="v-delivery-option-tab" role="tabpanel"
                                    aria-labelledby="v-delivery-option-tab">
                                    <x-product::delivery-option :deliveryOptions="$data['deliveryOptions']" />
                                </div>
                                <div class="tab-pane fade" id="v-meta-tag-tab" role="tabpanel"
                                    aria-labelledby="v-meta-tag-tab">
                                    <x-product::meta-seo />
                                </div>
                                <div class="tab-pane fade" id="v-settings-tab" role="tabpanel"
                                    aria-labelledby="v-settings-tab">
                                    <x-product::settings />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup type="vendor" />
@endsection


@section('script')
    <x-select2.select2-js />
    <script src="{{ asset('assets/common/js/jquery-ui.min.js') }}" rel="stylesheet"></script>
    <x-media.js type="vendor" />
    <x-summernote.js />
    <x-product::variant-info.js :colors="$data['product_colors']" :sizes="$data['product_sizes']" :all-attributes="$data['all_attribute']" />

    <script>
        $(document).ready(function() {
            $("#country_id").select2()
            $("#state_id").select2();
            $("#city_id").select2();

            $('#child_category').select2({
                placeholder: "{{ __('Select Child Category') }}"
            });
        })

        $('#product-name , #product-slug').on('keyup', function() {
            let title_text = $(this).val();
            $('#product-slug').val(convertToSlug(title_text))
        });

        $(document).on('change', '.item_attribute_name', function() {
            let terms = $(this).find('option:selected').data('terms');
            let terms_html = '<option value=""><?php echo e(__('Select attribute value')); ?></option>';
            terms.map(function(term) {
                terms_html += '<option value="' + term + '">' + term + '</option>';
            });
            $(this).closest('.inventory_item').find('.item_attribute_value').html(terms_html);
        })

        // category -> subcategory (vendor routes)
        $(document).on("change", "#category", function() {
            let data = new FormData();
            data.append("_token", "{{ csrf_token() }}");
            data.append("category_id", $(this).val());

            send_ajax_request("post", data, '{{ route('vendor.product.category.sub-category') }}', function() {
                $("#sub_category").html("<option value=''>{{ __('Select Sub Category') }}</option>");
                $("#child_category").html("<option value=''>{{ __('Select Child Category') }}</option>");
            }, function(data) {
                $("#sub_category").html(data.html);
            }, function(xhr) {
                ajax_toastr_error_message(xhr);
            });
        });

        // subcategory -> child category (vendor routes)
        $(document).on("change", "#sub_category", function() {
            let data = new FormData();
            data.append("_token", "{{ csrf_token() }}");
            data.append("sub_category_id", $(this).val());

            send_ajax_request("post", data, '{{ route('vendor.product.category.child-category') }}', function() {
                $("#child_category").html("<option value=''>{{ __('Select Child Category') }}</option>");
                $("#select2-child_category-container").html('');
            }, function(data) {
                $("#child_category").html(data.html);
            }, function(xhr) {
                ajax_toastr_error_message(xhr);
            });
        });

        // delivery item toggle
        $(document).on("click", ".delivery-item", function() {
            $(this).toggleClass("active");
            $(this).effect("shake", {
                direction: "up",
                times: 1,
                distance: 2
            }, 'fast');
            let delivery_option = "";

            $.each($(".delivery-item.active"), function() {
                delivery_option += $(this).data("delivery-option-id") + " , ";
            })

            delivery_option = delivery_option.slice(0, -3)

            $(".delivery-option-input").val(delivery_option);
        });

        // badge selection
        $(document).on('click', '.badge-item', function(e) {
            $(".badge-item").removeClass("active");
            $(this).effect("shake", {
                direction: "up",
                times: 1,
                distance: 2
            }, 'fast');
            $(this).addClass("active");
            $("#badge_id_input").val($(this).attr("data-badge-id"));
        });

        $(document).on("click", ".close-icon", function() {
            $('#media_upload_modal').modal('hide');
        });
    </script>

    <!-- Tax Class toggle logic -->
    <script>
        $(document).ready(function() {
            function toggleTaxClass() {
                const isTaxable = $('select[name="is_taxable"]').val();
                const taxClassDiv = $('select[name="tax_class_id"]').closest('.col-sm-6');

                if (isTaxable === "0") {
                    // Non-Taxable → hide tax class and remove required
                    taxClassDiv.hide();
                    $('select[name="tax_class_id"]').prop('required', false);
                } else {
                    // Taxable → show tax class and make required
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

    <!-- Auto tab-switcher + custom pre-submit validator -->
    <script>
        (function($) {

            // Highlight invalid field (optional)
            function markInvalid($el) {

                $el.addClass('is-invalid');

                // SELECT2
                if ($el.hasClass('select2-hidden-accessible')) {
                    const $box = $el.next('.select2-container')
                        .find('.select2-selection');

                    $box.addClass('is-invalid');
                }

                // SUMMERNOTE
                if ($el.hasClass('summernote')) {
                    const $editor = $el.next('.note-editor');
                    $editor.addClass('is-invalid');
                }
            }


            // Focus correct visible UI element (select2, summernote, etc.)
            function focusField($el) {

                // SELECT2
                if ($el.hasClass('select2-hidden-accessible')) {
                    const id = $el.attr('id');
                    let $box = $('#select2-' + id + '-container').closest('.select2-container');
                    if (!$box.length) $box = $el.next('.select2-container');
                    if ($box.length) {
                        $box.trigger('focus');
                        return;
                    }
                }

                // SUMMERNOTE
                if ($el.hasClass('summernote')) {
                    const $editable = $el.next('.note-editor').find('.note-editable');
                    if ($editable.length) {
                        $editable.focus();
                        return;
                    }
                }

                // DEFAULT INPUT
                $el.trigger('focus');
            }

            function isImageMissing() {
                return $('.mediaUploads__card').first()
                    .find('.upload-thumb img').length === 0;
            }


            // Find first invalid required input
            function findInvalid($form) {
                const fields = $form.find('[required]').toArray();

                for (let el of fields) {
                    const $el = $(el);
                    const tag = (el.tagName || '').toLowerCase();

                    if ($el.prop('disabled')) continue;

                    // RADIO
                    if (el.type === 'radio') {
                        const name = $el.attr('name');
                        if (!$form.find(`input[name="${name}"]:checked`).length)
                            return $el;
                        continue;
                    }

                    // CHECKBOX
                    if (el.type === 'checkbox' && !$el.is(':checked')) return $el;

                    // SELECT
                    if (tag === 'select') {
                        const v = $el.val();
                        if (!v || v.length === 0) return $el;
                        continue;
                    }

                    // TEXTAREA + SUMMERNOTE
                    if (tag === 'textarea') {
                        let val = ($el.val() || '').trim();
                        if ($el.hasClass('summernote')) {
                            const html = $el.summernote('code') || '';
                            val = html.replace(/<[^>]+>/g, '').trim();
                        }
                        if (!val) return $el;
                        continue;
                    }

                    // FILE INPUT
                    if (el.type === 'file' && (!el.files || !el.files.length)) return $el;

                    // TEXT INPUT
                    if (!($el.val() || '').trim()) return $el;

                }
                if (isImageMissing()) {
                    return $('input[name="image_id"]');
                }
                return null;
            }

            // Switch tab and then focus field
            function switchTabAndFocus($el) {
                const pane = $el.closest('.tab-pane');
                const paneId = pane.attr('id');
                const btn = document.querySelector(`[data-bs-target="#${paneId}"]`);

                if (btn) {
                    const tab = new bootstrap.Tab(btn);
                    tab.show();

                    // Wait for tab animation to finish before focusing (critical!)
                    setTimeout(() => {
                        markInvalid($el);
                        focusField($el);

                        // Smooth scroll
                        const elNode = $el.get(0);
                        if (elNode && elNode.scrollIntoView) {
                            elNode.scrollIntoView({
                                behavior: "smooth",
                                block: "center"
                            });
                        }
                    }, 250); // ← this ensures reliable focusing
                }
            }


            $(document).on('input change', 'input, textarea, select', function() {
                const $el = $(this);

                // Remove invalid from the field itself
                $el.removeClass('is-invalid');

                // ✅ SELECT2 UI cleanup
                if ($el.hasClass('select2-hidden-accessible')) {
                    $el.next('.select2-container')
                        .find('.select2-selection')
                        .removeClass('is-invalid');
                }
            });


            $(document).on('summernote.change', '.summernote', function() {
                const $textarea = $(this);
                const $editor = $textarea.next('.note-editor');

                $textarea.removeClass('is-invalid');
                $editor.removeClass('is-invalid');
            });





            // Attach form validator
            $(document).on("submit", "#product-create-form", function(e) {
                e.preventDefault();

                const $form = $(this);

                // Remove old highlights
                $form.find('.is-invalid').removeClass('is-invalid');

                const $invalid = findInvalid($form);

                if ($invalid) {
                    switchTabAndFocus($invalid);
                    return false;
                }

                // All Valid → Continue AJAX
                send_ajax_request("post", new FormData(this), $form.attr("data-request-route"),
                    function() {
                        toastr.warning("Request sent successfully");
                    },
                    function(data) {
                        if (data.success) {
                            toastr.success("Product Created Successfully");
                            setTimeout(() => window.location.href = "{{ route('vendor.products.all') }}",
                                800);
                        }
                    },
                    function(xhr) {
                        ajax_toastr_error_message(xhr);
                    }
                );

                return false;
            });

        })(jQuery);
    </script>
@endsection
