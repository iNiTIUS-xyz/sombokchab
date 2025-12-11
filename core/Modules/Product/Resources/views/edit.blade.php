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
                        <form data-request-route="{{ route('admin.products.edit', $product?->id ?? 0) }}" method="post"
                            id="product-create-form">
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
    <script>
        (function() {
            // Safe tab auto-switcher for hidden-invalid controls inside tab-panes (Bootstrap pills/tabs)
            // Paste this near the end of your scripts (after select2, nice-select init).

            // Returns true if element is visible/focusable
            function isFocusable(el) {
                if (!el) return false;
                if (el.disabled) return false;
                try {
                    const st = window.getComputedStyle(el);
                    if (!st) return false;
                    if (st.display === 'none' || st.visibility === 'hidden' || st.opacity === '0') return false;
                    if (el.type === 'hidden') return false;
                    // offsetParent null usually means not in layout (display:none)
                    if (el.offsetParent === null && el.tagName.toLowerCase() !== 'body') return false;
                    return true;
                } catch (e) {
                    return false;
                }
            }

            // Try to find a visible substitute for a hidden control (handles select2, nice-select, wrappers)
            function findVisibleSubstitute(originalEl) {
                if (!originalEl) return null;
                if (isFocusable(originalEl)) return originalEl;

                // select2 container pattern
                if (originalEl.id) {
                    const s2 = document.querySelector('#select2-' + originalEl.id + '-container');
                    if (s2 && isFocusable(s2)) return s2;
                }

                // nice-select / custom wrappers common classes
                const wrapper = originalEl.closest(
                    '.nice-select-two, .nice-select, .select-wrapper, .select2-container');
                if (wrapper && isFocusable(wrapper)) return wrapper;

                // find same-name control in same tab/card that is visible
                if (originalEl.name) {
                    const container = originalEl.closest('.tab-pane, .card, .card-body') || document;
                    const candidate = container.querySelector('[name="' + CSS.escape(originalEl.name) +
                        '"]:not([type="hidden"])');
                    if (candidate && isFocusable(candidate)) return candidate;
                    if (candidate && candidate.id) {
                        const s2b = document.querySelector('#select2-' + candidate.id + '-container');
                        if (s2b && isFocusable(s2b)) return s2b;
                    }
                }

                // fallback: first visible focusable in same container
                const container = originalEl.closest('.tab-pane, .card, .card-body') || document;
                const fallback = container.querySelector(
                    'input:not([type=hidden]), textarea, select, [tabindex]:not([tabindex="-1"])');
                if (fallback && isFocusable(fallback)) return fallback;

                return null;
            }

            // Show the tab/pane (Bootstrap) and focus the visible element
            function showTabAndFocus(tabTargetSelector, originalEl) {
                return new Promise((resolve) => {
                    if (!tabTargetSelector) return resolve(false);
                    // find the pill/tab button
                    let tabButton = document.querySelector('[data-bs-target="' + tabTargetSelector + '"]') ||
                        document.querySelector('[data-target="' + tabTargetSelector + '"]') ||
                        document.querySelector('.nav [href="' + tabTargetSelector + '"]');

                    const afterShow = () => {
                        setTimeout(() => {
                            const pane = document.querySelector(tabTargetSelector);
                            const visible = findVisibleSubstitute(originalEl) || (pane ? pane
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
                            // small inline hint if there's a <small> text area next to visible
                            try {
                                const parent = (visible && visible.parentNode) || (originalEl &&
                                    originalEl.closest('.form-group'));
                                if (parent) {
                                    const small = parent.querySelector('small') || parent
                                        .querySelector('.text-muted');
                                    if (small && small.textContent.trim() === '') {
                                        small.textContent = 'This field is required';
                                        small.classList.remove('field-success');
                                        small.classList.add('field-error');
                                    }
                                }
                            } catch (e) {}
                            resolve(true);
                        }, 90);
                    };

                    if (!tabButton) return resolve(false);

                    // if Bootstrap's Tab API is available use it; otherwise click fallback
                    if (window.bootstrap && bootstrap.Tab) {
                        try {
                            document.addEventListener('shown.bs.tab', function once() {
                                document.removeEventListener('shown.bs.tab', once);
                                afterShow();
                            }, {
                                once: true
                            });
                            new bootstrap.Tab(tabButton).show();
                        } catch (e) {
                            tabButton.click();
                            setTimeout(afterShow, 200);
                        }
                    } else {
                        tabButton.click();
                        setTimeout(afterShow, 200);
                    }
                });
            }

            // Capture native 'invalid' events (useCapture=true so we intercept browser default)
            document.addEventListener('invalid', function(ev) {
                ev.preventDefault();
                ev.stopImmediatePropagation();

                const invalidEl = ev.target;
                // find enclosing tab-pane if any
                let pane = invalidEl.closest ? invalidEl.closest('.tab-pane') : null;
                if (!pane && invalidEl.name) {
                    const found = document.querySelector('.tab-pane [name="' + CSS.escape(invalidEl.name) +
                        '"]');
                    if (found) pane = found.closest('.tab-pane');
                }

                if (pane && pane.id) {
                    const target = '#' + pane.id;
                    showTabAndFocus(target, invalidEl).then(success => {
                        if (!success) {
                            try {
                                (findVisibleSubstitute(invalidEl) || invalidEl).focus();
                            } catch (e) {}
                        }
                    });
                } else {
                    // not inside a tab-pane; just focus visible substitute or the element itself
                    const visible = findVisibleSubstitute(invalidEl) || invalidEl;
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
            }, true); // capture phase

            // On submit: temporarily remove required from non-focusable controls to avoid browser error
            document.addEventListener('submit', function(ev) {
                try {
                    const form = ev.target;
                    if (!form || form.tagName.toLowerCase() !== 'form') return;
                    const requiredEls = Array.from(form.querySelectorAll('[required]'));
                    const removed = [];
                    requiredEls.forEach(el => {
                        if (!isFocusable(el)) {
                            removed.push({
                                el: el,
                                val: el.getAttribute('required')
                            });
                            el.removeAttribute('required');
                        }
                    });
                    // restore after short timeout
                    if (removed.length) {
                        setTimeout(() => {
                            removed.forEach(r => {
                                try {
                                    if (r.val !== null) r.el.setAttribute('required', r.val);
                                } catch (e) {}
                            });
                        }, 800);
                    }
                } catch (e) {
                    console.warn('submit-cleanup error', e);
                }
            }, true);

            // Dev helper: list hidden required fields in the console (call from console)
            window.__listHiddenRequired = function(formSelector) {
                try {
                    const form = document.querySelector(formSelector || 'form');
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

        })();
    </script>

    <script src="{{ asset('assets/common/js/jquery-ui.min.js') }}" rel="stylesheet"></script>
    <x-media.js />
    <x-summernote.js />
    <x-product::variant-info.js :colors="$data['product_colors']" :sizes="$data['product_sizes']" :all-attributes="$data['all_attribute']" />

    <script>
        $('#product-name , #product-slug').on('keyup', function() {
            let title_text = $(this).val();
            $('#product-slug').val(convertToSlug(title_text))
        });

        $(document).on("submit", "#product-create-form", function(e) {
            e.preventDefault();

            send_ajax_request("post", new FormData(e.target), $(this).attr("data-request-route"), function() {
                // toastr.warning("Request sent successfully ");
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
        })

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
            // $(this).effect( "shake", { direction: "up", times: 1, distance: 2}, 500 );
            $(this).addClass("active");
            $("#badge_id_input").val($(this).attr("data-badge-id"));
        });

        $(document).on("click", ".close-icon", function() {
            $('#media_upload_modal').modal('hide');
        });
    </script>

    <script>
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
