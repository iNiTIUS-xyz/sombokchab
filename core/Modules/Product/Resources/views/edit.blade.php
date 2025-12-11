@extends('backend.admin-master')
@section('site-title', __('Update Product'))

@section('style')
    <x-media.css />
    <x-summernote.css />
    <x-product::variant-info.css />
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
                                <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Save Changes') }}</button>
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

            // -------- helpers --------
            function textTrimmed(el) {
                if (!el) return '';
                return (el.textContent || el.value || '').trim();
            }

            // Is element visible & focusable
            function isFocusable(el) {
                if (!el) return false;
                if (el.disabled) return false;
                try {
                    const st = window.getComputedStyle(el);
                    if (!st) return false;
                    if (st.display === 'none' || st.visibility === 'hidden' || st.opacity === '0') return false;
                    if (el.type === 'hidden') return false;
                    if (el.offsetParent === null && el.tagName.toLowerCase() !== 'body') return false;
                    return true;
                } catch (e) {
                    return false;
                }
            }

            // For Summernote: get editor content (text)
            function getSummernoteText(textareaEl) {
                // summernote creates sibling .note-editor .note-editable
                if (!textareaEl) return '';
                let editor = textareaEl.closest('.note-editor') || ($(textareaEl).nextAll('.note-editor')[0]);
                if (!editor) {
                    // sometimes textarea replaced, find by name
                    const name = textareaEl.name;
                    if (name) {
                        const otherEditor = document.querySelector('.note-editable[aria-label]');
                        if (otherEditor) editor = otherEditor.closest('.note-editor');
                    }
                }
                if (editor) {
                    const editable = editor.querySelector('.note-editable');
                    if (editable) return (editable.textContent || '').trim();
                }
                // fallback to textarea value
                return (textareaEl.value || '').trim();
            }

            // For media upload widgets: check hidden input used by x-media-upload
            function isMediaPresent(form, name) {
                // common pattern: hidden input with name image or gallery[] etc.
                // check any input[name="<name>"] with value
                try {
                    const el = form.querySelector('[name="' + CSS.escape(name) + '"]');
                    if (!el) return false;
                    if (el.type === 'file') {
                        // file inputs: check files length
                        return el.files && el.files.length > 0;
                    }
                    return (el.value || '').toString().trim() !== '';
                } catch (e) {
                    return false;
                }
            }

            // Find a visible substitute to focus inside the pane (select2 container, note-editable, first visible input)
            function findVisibleControlFor(originalEl, pane) {
                if (!originalEl) return null;

                // If original is visible, return it
                if (isFocusable(originalEl)) return originalEl;

                // If summernote textarea, return its editable div
                if (originalEl.classList && originalEl.classList.contains('summernote')) {
                    const editable = (pane || document).querySelector('.note-editable');
                    if (editable && isFocusable(editable)) return editable;
                }

                // Select2 pattern
                if (originalEl.id) {
                    const s2 = document.querySelector('#select2-' + originalEl.id + '-container');
                    if (s2 && (!pane || pane.contains(s2))) return s2;
                }

                // nice-select / custom wrapper
                const wrap = originalEl.closest('.nice-select-two, .nice-select, .select-wrapper, .select2-container');
                if (wrap && (!pane || pane.contains(wrap))) return wrap;

                // find same-name visible field inside pane
                if (originalEl.name && pane) {
                    const candidate = pane.querySelector('[name="' + CSS.escape(originalEl.name) +
                        '"]:not([type="hidden"])');
                    if (candidate && isFocusable(candidate)) return candidate;
                    if (candidate && candidate.id) {
                        const s2b = document.querySelector('#select2-' + candidate.id + '-container');
                        if (s2b && pane.contains(s2b)) return s2b;
                    }
                }

                // fallback: first visible focusable in pane
                if (pane) {
                    const fallback = pane.querySelector(
                        'input:not([type=hidden]), textarea, select, [tabindex]:not([tabindex="-1"])');
                    if (fallback && isFocusable(fallback)) return fallback;
                }

                return null;
            }

            // Show the tab/pane and focus inside it
            function showTabAndFocus(tabTargetSelector, originalEl) {
                return new Promise((resolve) => {
                    if (!tabTargetSelector) return resolve(false);
                    let tabButton = document.querySelector('[data-bs-target="' + tabTargetSelector + '"]') ||
                        document.querySelector('[data-target="' + tabTargetSelector + '"]') ||
                        document.querySelector('.nav [href="' + tabTargetSelector + '"]');

                    const afterShow = () => {
                        setTimeout(() => {
                            const pane = document.querySelector(tabTargetSelector);
                            const visible = findVisibleControlFor(originalEl, pane) || (pane ? pane
                                    .querySelector('input,textarea,select,[tabindex]') : null) ||
                                originalEl;
                            try {
                                if (visible && typeof visible.focus === 'function') visible.focus({
                                    preventScroll: true
                                });
                            } catch (e) {
                                try {
                                    originalEl.focus();
                                } catch (_) {}
                            }
                            try {
                                if (visible) visible.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                            } catch (e) {}

                            // show an inline small hint if present
                            try {
                                const parent = (visible && visible.parentNode) || (originalEl &&
                                    originalEl.closest('.form-group'));
                                if (parent) {
                                    const small = parent.querySelector('small') || parent
                                        .querySelector('.text-muted');
                                    if (small && small.textContent.trim() === '') {
                                        small.textContent = '{{ __('This field is required') }}';
                                        small.classList.remove('field-success');
                                        small.classList.add('field-error');
                                    }
                                }
                            } catch (e) {}

                            resolve(true);
                        }, 120);
                    };

                    if (!tabButton) return resolve(false);

                    if (window.bootstrap && bootstrap.Tab) {
                        try {
                            document.addEventListener('shown.bs.tab', function once() {
                                document.removeEventListener('shown.bs.tab', once);
                                afterShow();
                            }, {
                                once: true
                            });
                            new bootstrap.Tab(tabButton).show();
                        } catch (err) {
                            tabButton.click();
                            setTimeout(afterShow, 250);
                        }
                    } else {
                        tabButton.click();
                        setTimeout(afterShow, 250);
                    }
                });
            }

            // -------- core validator --------
            function findFirstInvalid(form) {
                // 1) normal required inputs that are visible/focusable
                const requiredEls = Array.from(form.querySelectorAll('[required]'));

                // We'll test the logical value for each required element; return the first failing element (prefer a visible one).
                for (let i = 0; i < requiredEls.length; i++) {
                    const el = requiredEls[i];

                    // skip disabled
                    if (el.disabled) continue;

                    const tag = (el.tagName || '').toLowerCase();

                    // Special-case Summernote textareas: check editor content
                    if (el.classList && el.classList.contains('summernote')) {
                        const txt = getSummernoteText(el);
                        if (!txt) {
                            return el;
                        }
                        continue; // ok
                    }

                    // Special-case selects that are transformed (select2/nice-select): if select is hidden, check visible wrapper existence or value
                    if (tag === 'select') {
                        const val = (el.value || '').toString().trim();
                        // If select is present but empty value considered invalid
                        if (val === '' || el.selectedIndex === -1) {
                            // but if the select is not focusable (hidden), ensure we still return it to switch tab
                            return el;
                        }
                        continue;
                    }

                    // File / media widget
                    if (el.type === 'file') {
                        if (!(el.files && el.files.length > 0)) {
                            return el;
                        }
                        continue;
                    }

                    // Hidden inputs used by media uploader (x-media) - check by name presence
                    if ((el.type === 'hidden') && (el.name && el.name.toLowerCase().indexOf('image') !== -1 || el.name
                            .toLowerCase().indexOf('gallery') !== -1)) {
                        if ((el.value || '').trim() === '') {
                            // treat as invalid (so we can switch to images tab)
                            return el;
                        }
                        continue;
                    }

                    // Standard fallback for inputs/textareas
                    if ((tag === 'input' || tag === 'textarea')) {
                        const val = (el.value || '').toString().trim();
                        if (val === '') {
                            return el;
                        }
                        continue;
                    }

                    // Other controls (e.g., custom components) — if value empty treat invalid
                    try {
                        if (!el.value && el.value !== 0) {
                            return el;
                        }
                    } catch (e) {}
                }

                // 2) If none matched above, also check Summernote editors that might not have the textarea required attribute (just in case)
                const summernotes = Array.from(form.querySelectorAll('.summernote'));
                for (let s of summernotes) {
                    const txt = getSummernoteText(s);
                    const isReq = s.hasAttribute('required') || s.getAttribute('data-required') === '1';
                    if (isReq && !txt) return s;
                }

                return null; // no invalids
            }

            // -------- submit handling (main) --------
            $(document).on('submit', '#product-create-form', function(e) {
                const form = this;
                form.noValidate = true; // ensure browser won't auto-focus hidden invalid controls

                // Run our custom validator
                const firstInvalid = findFirstInvalid(form);

                if (!firstInvalid) {
                    // All good — proceed with existing AJAX submission (we block default and call your send_ajax_request below).
                    // Let the later submit handler trigger (we call preventDefault here then manual send).
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    // perform original AJAX submission
                    send_ajax_request("post", new FormData(form), $(form).attr("data-request-route"),
                function() {
                        // before
                    }, function(data) {
                        if (data.success) {
                            toastr.success("Product updated Successfully");
                            toastr.success("You are redirected to products list page");
                            setTimeout(() => {
                                window.location.href = "{{ route('admin.products.all') }}";
                            }, 800);
                        }
                    }, function(xhr) {
                        ajax_toastr_error_message(xhr);
                    });

                    return false;
                }

                // Found invalid control - switch to its tab and focus
                e.preventDefault();
                e.stopImmediatePropagation();

                // determine the tab-pane that contains the invalid control
                let pane = null;
                try {
                    pane = firstInvalid.closest ? firstInvalid.closest('.tab-pane') : null;
                } catch (ex) {
                    pane = null;
                }

                // if the invalid element is a hidden media hidden input (x-media), try find images pane by checking name
                if (!pane && firstInvalid.name && (firstInvalid.name.toLowerCase().indexOf('image') !== -1 ||
                        firstInvalid.name.toLowerCase().indexOf('gallery') !== -1)) {
                    pane = form.querySelector('#v-images-tab');
                }

                // fallback: find by name inside panes
                if (!pane && firstInvalid.name) {
                    const found = form.querySelector('.tab-pane [name="' + CSS.escape(firstInvalid.name) +
                    '"]');
                    if (found) pane = found.closest('.tab-pane');
                }

                // fallback: search panes for label containing text of this control
                let tabTarget = null;
                if (pane && pane.id) {
                    tabTarget = '#' + pane.id;
                } else {
                    // try to find label text
                    const lab = form.querySelector('label[for="' + (firstInvalid.id || '') + '"]') || (
                        firstInvalid.closest ? firstInvalid.closest('.form-group')?.querySelector('label') :
                        null);
                    const labelText = lab ? lab.textContent.trim().split('\n')[0] : '';
                    if (labelText) {
                        const panes = Array.from(form.querySelectorAll('.tab-pane'));
                        for (let p of panes) {
                            if (p.innerText && p.innerText.indexOf(labelText) !== -1) {
                                tabTarget = '#' + (p.id || '');
                                pane = p;
                                break;
                            }
                        }
                    }
                }

                if (!tabTarget && pane && pane.id) tabTarget = '#' + pane.id;

                if (tabTarget) {
                    showTabAndFocus(tabTarget, firstInvalid).then((ok) => {
                        if (!ok) {
                            // fallback: try focusing original
                            try {
                                firstInvalid.focus();
                            } catch (e) {}
                        }
                    });
                } else {
                    // no tab found - focus the visible substitute or element itself
                    const visible = findVisibleControlFor(firstInvalid, null) || firstInvalid;
                    try {
                        visible.focus();
                    } catch (e) {}
                    try {
                        visible.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    } catch (e) {}
                }

                return false;
            });

            // Helper for debugging in console:
            window.__listHiddenRequired = function(formSelector) {
                try {
                    const form = document.querySelector(formSelector || '#product-create-form');
                    if (!form) return console.warn('no form found');
                    const arr = Array.from(form.querySelectorAll('[required]')).filter(el => !isFocusable(el)).map(
                        el => ({
                            name: el.name || el.id || '',
                            outer: el.outerHTML
                        }));
                    console.log('hidden required fields', arr);
                    return arr;
                } catch (e) {
                    console.error(e);
                }
            };

            // Initialize any cosmetic UI after DOM ready
            $(document).ready(function() {
                // If you use nice-select/select2 anywhere, init them here (you likely already do elsewhere)
                if ($('.nice-select').length) $('.nice-select').niceSelect();
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
