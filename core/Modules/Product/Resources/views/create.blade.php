@extends('backend.admin-master')
@section('site-title')
    {{ __('Add new Product') }}
@endsection
@section('style')
    <x-media.css />
    <x-summernote.css />
    <x-product::variant-info.css />
    <x-select2.select2-css />
@endsection
@section('content')
    <div class="dashboard-top-contents">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-inner-contents search-area top-searchbar-wrapper">
                    <div class="dashboard-flex-contetns">
                        <div class="dashboard-left-flex">
                            <h3 class="dashboard-common-title-two"> {{ __('Add New Product') }} </h3>
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
                    <div class="col-sm-8 col-md-9 col-lg-8 col-xl-9 col-xxl-10">
                        <!-- novalidate added so native validation won't block focusing fields in hidden tabs -->
                        <form data-request-route="{{ route('admin.products.create') }}" method="post"
                            id="product-create-form" novalidate>
                            @csrf
                            <div class="form-button">
                                <button class="cmn_btn btn_bg_profile">{{ __('Add New Product') }}</button>
                            </div>
                            <div class="tab-content mt-4" id="v-pills-tabContent">
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
    <x-media.markup />
@endsection

@section('script')
    <x-select2.select2-js />
    <x-media.js />
    <x-summernote.js />
    <x-product::variant-info.js :colors="$data['product_colors']" :sizes="$data['product_sizes']" :all-attributes="$data['all_attribute']" />
    <script>
        (function($) {
            'use strict';

            // helper to find the first required field (including those in hidden tabs)
            function findFirstMissingRequired(form) {
                const requiredEls = form.querySelectorAll('[required]');
                for (let i = 0; i < requiredEls.length; i++) {
                    const el = requiredEls[i];
                    if (el.disabled) continue;
                    const tag = (el.tagName || '').toLowerCase();

                    // Prefer HTML5 validity check when available (valueMissing)
                    try {
                        if (el.validity && el.validity.valueMissing) {
                            return el;
                        }
                    } catch (e) {}

                    // Fallback checks
                    if ((tag === 'input' || tag === 'textarea') && String(el.value).trim() === '') {
                        return el;
                    }
                    if (tag === 'select' && (el.value === '' || el.selectedIndex === -1)) {
                        return el;
                    }
                }
                return null;
            }

            // Attempts to find a visible/focusable element inside the pane corresponding to the original control
            function findVisibleControlFor(originalEl, pane) {
                if (!originalEl) return null;

                // 1) If original is visible, return it
                try {
                    const style = window.getComputedStyle(originalEl);
                    if (style && style.display !== 'none' && style.visibility !== 'hidden' && originalEl
                        .offsetParent !== null) {
                        return originalEl;
                    }
                } catch (e) {}

                // 2) If it's a select used by Select2 (select is hidden), look for the select2 container
                if (originalEl.id) {
                    // Common Select2 container id pattern: select2-<id>-container or select2-<id>-results etc.
                    let sel2 = document.querySelector('#select2-' + originalEl.id + '-container');
                    if (!sel2) sel2 = document.querySelector('#select2-' + originalEl.id + '-selection');
                    if (!sel2) sel2 = document.querySelector('.select2-container--default[aria-hidden="false"]');
                    if (sel2 && pane && pane.contains(sel2)) return sel2;
                }

                // 3) If original is replaced by a "nice-select" or other widget, attempt to find sibling widget
                // nice-select often transforms <select> into .nice-select or .nice-select-wrapper
                let siblingWidget = originalEl.closest('.nice-select-two') || originalEl.closest('.nice-select') ||
                    originalEl.closest('.select-wrapper');
                if (siblingWidget && pane && pane.contains(siblingWidget)) return siblingWidget;

                // 4) Look for any visible input/select/textarea inside the pane with same name
                if (originalEl.name) {
                    const candidate = pane.querySelector('[name="' + CSS.escape(originalEl.name) +
                        '"]:not([type="hidden"])');
                    if (candidate) {
                        try {
                            const style2 = window.getComputedStyle(candidate);
                            if (style2 && style2.display !== 'none' && style2.visibility !== 'hidden' && candidate
                                .offsetParent !== null) {
                                return candidate;
                            }
                        } catch (e) {}
                        // if candidate exists but hidden, try select2 for that candidate id too
                        if (candidate.id) {
                            const sel2b = document.querySelector('#select2-' + candidate.id + '-container');
                            if (sel2b && pane.contains(sel2b)) return sel2b;
                        }
                    }
                }

                // 5) Last resort: find first visible focusable control inside the pane
                const focusable = pane.querySelector(
                    'input:not([type=hidden]), textarea, select, [tabindex]:not([tabindex="-1"])');
                if (focusable) return focusable;

                return null;
            }

            // Show the tab identified by target (e.g. "#v-price-tab"), then focus inside the pane after it's shown.
            function showTabAndFocus(tabTarget, focusOriginalEl) {
                return new Promise((resolve) => {
                    // find nav button
                    let tabButton = document.querySelector('[data-bs-target="' + tabTarget + '"]') ||
                        document.querySelector('[data-target="' + tabTarget + '"]') ||
                        document.querySelector('.nav [href="' + tabTarget + '"]');

                    if (!tabButton) {
                        // nothing to show; resolve immediately
                        return resolve(false);
                    }

                    // Listen for shown event once
                    const onShown = function(e) {
                        // remove listener
                        try {
                            tabButton.removeEventListener('shown.bs.tab', onShown);
                            document.removeEventListener('shown.bs.tab', onShown);
                        } catch (err) {}
                        // wait a tick to let rendering complete
                        setTimeout(() => {
                            // find pane
                            const pane = document.querySelector(tabTarget);
                            let focusEl = pane ? findVisibleControlFor(focusOriginalEl, pane) :
                                focusOriginalEl;

                            if (focusEl) {
                                // if the found element is a typical widget container (like select2), try to focus it appropriately
                                try {
                                    if (focusEl.classList && focusEl.classList.contains(
                                            'select2-container')) {
                                        // focus the inner focusable element if exists
                                        const inner = focusEl.querySelector(
                                            '.select2-selection, .select2-selection__rendered');
                                        if (inner && typeof inner.focus === 'function') inner
                                            .focus();
                                        else focusEl.focus();
                                    } else if (typeof focusEl.focus === 'function') {
                                        focusEl.focus({
                                            preventScroll: true
                                        });
                                    } else {
                                        // fallback: try focusing child
                                        const child = focusEl.querySelector(
                                            'input, textarea, select, [tabindex]');
                                        if (child && typeof child.focus === 'function') child
                                            .focus({
                                                preventScroll: true
                                            });
                                    }
                                } catch (err) {
                                    try {
                                        focusEl.focus();
                                    } catch (e) {}
                                }

                                // scroll into view for user
                                try {
                                    focusEl.scrollIntoView({
                                        behavior: 'smooth',
                                        block: 'center'
                                    });
                                } catch (e) {}

                                // show inline hint if possible
                                const parent = focusEl.parentNode || focusEl.closest('.form-group');
                                if (parent) {
                                    const small = parent.querySelector('small') || parent
                                        .querySelector('.text-muted');
                                    if (small && small.textContent.trim() === '') {
                                        small.textContent = '{{ __('This field is required') }}';
                                        small.classList.remove('field-success');
                                        small.classList.add('field-error');
                                    }
                                }
                                return resolve(true);
                            } else {
                                return resolve(false);
                            }
                        }, 90);
                    };

                    // Use bootstrap Tab API when available so events fire reliably
                    if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
                        try {
                            const tabObj = new bootstrap.Tab(tabButton);
                            // Attach global shown listener - we listen to document because some bootstrap versions fire there
                            document.addEventListener('shown.bs.tab', onShown, {
                                once: true
                            });
                            tabObj.show();
                        } catch (err) {
                            // fallback to click then listen a small delay
                            tabButton.click();
                            setTimeout(() => onShown(), 200);
                        }
                    } else {
                        // fallback to click
                        tabButton.click();
                        // try to detect the pane update after short delay
                        setTimeout(() => onShown(), 200);
                    }
                });
            }

            // Main submit interception
            $(document).on('submit', '#product-create-form', function(evt) {
                const form = this;
                form.noValidate = true; // ensure native validation doesn't block
                const firstMissing = findFirstMissingRequired(form);

                if (!firstMissing) {
                    // let existing handlers run
                    return;
                }

                // prevent submission and other handlers
                evt.preventDefault();
                evt.stopImmediatePropagation();

                console.debug('[auto-tab-switch] missing required field:', firstMissing.name || firstMissing
                    .id || firstMissing);

                // try to find the tab pane containing that element
                let pane = firstMissing.closest ? firstMissing.closest('.tab-pane') : null;
                if (!pane && firstMissing.name) {
                    const selector = '.tab-pane [name="' + CSS.escape(firstMissing.name) + '"]';
                    const found = form.querySelector(selector);
                    if (found) pane = found.closest('.tab-pane');
                }
                if (!pane) {
                    // climb parents up to find .tab-pane
                    let p = firstMissing.parentNode;
                    for (let depth = 0; p && depth < 10; depth++, p = p.parentNode) {
                        if (p.classList && p.classList.contains('tab-pane')) {
                            pane = p;
                            break;
                        }
                    }
                }

                let tabTarget = pane && pane.id ? ('#' + pane.id) : null;

                if (!tabTarget) {
                    // fallback: attempt to map by label text (best-effort)
                    const label = form.querySelector('label[for="' + (firstMissing.id || '') + '"]') ||
                        (firstMissing.closest ? firstMissing.closest('.form-group')?.querySelector('label') :
                            null);
                    const labelText = label ? label.textContent.trim().split('\n')[0] : '';
                    if (labelText) {
                        const panes = form.querySelectorAll('.tab-pane');
                        for (let j = 0; j < panes.length; j++) {
                            if (panes[j].innerText && panes[j].innerText.indexOf(labelText) !== -1) {
                                tabTarget = '#' + (panes[j].id || '');
                                pane = panes[j];
                                break;
                            }
                        }
                    }
                }

                if (tabTarget) {
                    // show the tab and focus inside it
                    showTabAndFocus(tabTarget, firstMissing).then((ok) => {
                        if (!ok) {
                            // if we couldn't focus, try direct focus after small delay
                            try {
                                firstMissing.focus();
                            } catch (e) {}
                        }
                    });
                    return false;
                } else {
                    // no tab mapping found — try to focus the control directly
                    try {
                        firstMissing.focus();
                    } catch (e) {}
                    return false;
                }
            });

        })(jQuery);
    </script>

    <script>
        $(document).ready(function() {
            $('#child_category').select2({
                placeholder: "{{ __('Select Child Category') }}"
            });
        })

        $('#product-name , #product-slug').on('keyup', function() {
            let title_text = $(this).val();
            $('#product-slug').val(convertToSlug(title_text))
        });


        $(document).on('click', '.add_item_attribute', function(e) {
            let container = $(this).closest('.inventory_item');
            let attribute_name_field = container.find('.item_attribute_name');
            let attribute_value_field = container.find('.item_attribute_value');
            let attribute_name = attribute_name_field.find('option:selected').text();
            let attribute_value = attribute_value_field.find('option:selected').text();

            let container_id = container.data('id');

            if (!container_id) {
                container_id = 0;
            }

            if (attribute_name_field.val().length && attribute_value_field.val().length) {
                let attribute_repeater = '';
                attribute_repeater += '<div class="form-row">';
                attribute_repeater += '<input type="hidden" name="item_attribute_id[' + container_id +
                    '][]" value="">';
                attribute_repeater += '<div class="col">';
                attribute_repeater += '<div class="form-group">';
                attribute_repeater += '<input type="text" class="form-control" name="item_attribute_name[' +
                    container_id + '][]" value="' + attribute_name + '" readonly />';
                attribute_repeater += '</div>';
                attribute_repeater += '</div>';
                attribute_repeater += '<div class="col">';
                attribute_repeater += '<div class="form-group">';
                attribute_repeater += '<input type="text" class="form-control" name="item_attribute_value[' +
                    container_id + '][]" value="' + attribute_value + '" readonly />';
                attribute_repeater += '</div>';
                attribute_repeater += '</div>';
                attribute_repeater += '<div class="col-auto">';
                attribute_repeater += '<button class="btn btn-danger remove_details_attribute"> x </button>';
                attribute_repeater += '</div>';
                attribute_repeater += '</div>';

                container.find('.item_selected_attributes').append(attribute_repeater);

                attribute_name_field.val('');
                attribute_value_field.val('');
            } else {
                toastr.warning('<?php echo e(__('Select both attribute name and value')); ?>');
            }
        });

        $(document).on('change', '.item_attribute_name', function() {
            let terms = $(this).find('option:selected').data('terms');
            let terms_html = '<option value=""><?php echo e(__('Select attribute value')); ?></option>';
            terms.map(function(term) {
                terms_html += '<option value="' + term + '">' + term + '</option>';
            });
            $(this).closest('.inventory_item').find('.item_attribute_value').html(terms_html);
        })

        // ====== AUTO TAB SWITCHER (for vertical nav-pills) ======
        // Runs before the normal submit handler and switches to tab that contains
        // the first missing required field, focusing it.
        (function($) {
            'use strict';

            // Ensure native validation is off
            document.addEventListener('DOMContentLoaded', function() {
                const f = document.getElementById('product-create-form');
                if (f) f.noValidate = true;
            });

            $(document).on('submit', '#product-create-form', function(e) {
                const form = this;
                form.noValidate = true; // double safety

                // find required elements in DOM (note: some components may mark required via JS)
                const requiredEls = form.querySelectorAll('[required]');
                let firstMissing = null;

                for (let i = 0; i < requiredEls.length; i++) {
                    const el = requiredEls[i];
                    // skip disabled
                    if (el.disabled) continue;

                    // prefer HTML5 validity if available
                    try {
                        if (el.validity && el.validity.valueMissing) {
                            firstMissing = el;
                            break;
                        }
                    } catch (err) {}

                    // fallback checks
                    const tag = (el.tagName || '').toLowerCase();
                    if ((tag === 'input' || tag === 'textarea') && String(el.value).trim() === '') {
                        firstMissing = el;
                        break;
                    }
                    if (tag === 'select' && (el.value === '' || el.selectedIndex === -1 || el.selectedIndex ===
                            0 && el.value === '')) {
                        firstMissing = el;
                        break;
                    }
                }

                if (!firstMissing) return; // no missing required field — let other handlers run

                // prevent submit & other handlers (AJAX)
                e.preventDefault();
                e.stopImmediatePropagation();

                console.debug('[product auto-tab-switch] missing required:', firstMissing.name || firstMissing);

                // try to find the .tab-pane containing the missing field
                let pane = firstMissing.closest ? firstMissing.closest('.tab-pane') : null;

                // fallback: find matching element by name inside tab-pane (in case widget moved original)
                if (!pane && firstMissing.name) {
                    const selector = '.tab-pane [name="' + CSS.escape(firstMissing.name) + '"]';
                    const foundInPane = form.querySelector(selector);
                    if (foundInPane) pane = foundInPane.closest('.tab-pane');
                }

                // fallback: climb up parents
                if (!pane) {
                    let p = firstMissing.parentNode;
                    for (let depth = 0; p && depth < 8; depth++, p = p.parentNode) {
                        if (p.classList && p.classList.contains('tab-pane')) {
                            pane = p;
                            break;
                        }
                    }
                }

                // determine tab target id
                let tabTarget = null;
                if (pane && pane.id) {
                    tabTarget = '#' + pane.id;
                } else {
                    // last-ditch: map by label text
                    const lbl = form.querySelector('label[for="' + (firstMissing.id || '') + '"]') ||
                        (firstMissing.closest ? firstMissing.closest('.form-group')?.querySelector('label') :
                            null);
                    const labelText = lbl ? lbl.textContent.trim().split('\n')[0] : '';
                    if (labelText) {
                        const panes = form.querySelectorAll('.tab-pane');
                        for (let j = 0; j < panes.length; j++) {
                            const paneEl = panes[j];
                            if (paneEl.innerText && paneEl.innerText.indexOf(labelText) !== -1) {
                                tabTarget = '#' + (paneEl.id || '');
                                pane = paneEl;
                                break;
                            }
                        }
                    }
                }

                if (tabTarget) {
                    // find nav trigger button with matching data-bs-target
                    let tabButton = document.querySelector('[data-bs-target="' + tabTarget + '"]') ||
                        document.querySelector('[data-target="' + tabTarget + '"]') ||
                        document.querySelector('.nav [href="' + tabTarget + '"]');

                    if (tabButton) {
                        // use bootstrap Tab API if available
                        if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
                            try {
                                const tab = new bootstrap.Tab(tabButton);
                                tab.show();
                            } catch (err) {
                                tabButton.click();
                            }
                        } else {
                            try {
                                tabButton.click();
                            } catch (err) {
                                $(tabButton).trigger('click');
                            }
                        }
                    }

                    // after switch focus the real control inside pane
                    setTimeout(function() {
                        let focusEl = firstMissing;
                        if (pane && firstMissing.name) {
                            const real = pane.querySelector('[name="' + CSS.escape(firstMissing.name) +
                                '"]');
                            if (real) focusEl = real;
                        }

                        try {
                            const style = window.getComputedStyle(focusEl);
                            if (style && (style.display === 'none' || style.visibility === 'hidden')) {
                                const alt = pane ? pane.querySelector('[name="' + CSS.escape(
                                    firstMissing.name) + '"]:not([type="hidden"])') : null;
                                if (alt) focusEl = alt;
                            }

                            focusEl.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                            focusEl.focus({
                                preventScroll: true
                            });
                        } catch (err) {
                            try {
                                focusEl.focus();
                            } catch (e) {}
                        }

                        // show inline required helper if present
                        const parent = focusEl.parentNode || focusEl.closest('.form-group');
                        if (parent) {
                            const smallEl = parent.querySelector('small') || parent.querySelector(
                                '.text-muted');
                            if (smallEl && smallEl.textContent.trim() === '') {
                                smallEl.textContent = '{{ __('This field is required') }}';
                                smallEl.classList.remove('field-success');
                                smallEl.classList.add('field-error');
                            }
                        }
                    }, 250);

                    return false;
                } else {
                    // fallback: try to focus missing field
                    try {
                        firstMissing.focus();
                    } catch (err) {}
                    return false;
                }
            });
        })(jQuery);
        // ====== END AUTO TAB SWITCHER ======
    </script>

    <script>
        $(document).on("submit", "#product-create-form", function(e) {
            e.preventDefault();

            send_ajax_request("post", new FormData(e.target), $(this).attr("data-request-route"), function() {

            }, function(data) {
                if (data.success) {
                    toastr.success("Product Created Successfully");
                    toastr.success("You are redirected to products list page");
                    setTimeout(() => {
                        window.location.href = "{{ route('admin.products.all') }}";
                    }, 800);
                }
            }, function(xhr) {
                ajax_toastr_error_message(xhr);
            });
        })
    </script>

    <script>
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

        $(document).on("change", "#category", function() {
            let data = new FormData();
            data.append("_token", "{{ csrf_token() }}");
            data.append("category_id", $(this).val());

            send_ajax_request("post", data, '{{ route('admin.product.category.sub-category') }}', function() {
                $("#sub_category").html("<option value=''>{{ __('Select Sub Category') }}</option>");
                $("#child_category").html("<option value=''>{{ __('Select Child Category') }}</option>");
                $("#select2-child_category-container").html('');
            }, function(data) {
                $("#sub_category").html(data.html);
            }, function() {

            });
        });

        $(document).on("change", "#sub_category", function() {
            let data = new FormData();
            data.append("_token", "{{ csrf_token() }}");
            data.append("sub_category_id", $(this).val());

            send_ajax_request("post", data, '{{ route('admin.product.category.child-category') }}', function() {
                $("#child_category").html("<option value=''>{{ __('Select Child Category') }}</option>");
                $("#select2-child_category-container").html('');
            }, function(data) {
                $("#child_category").html(data.html);
            }, function() {

            });
        });

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

            // Run on page load (in case of edit)
            toggleTaxClass();

            // Run when user changes taxable option
            $('select[name="is_taxable"]').on('change', function() {
                toggleTaxClass();
            });
        });
    </script>
@endsection
