@extends('vendor.vendor-master')
@section('site-title')
    {{ __('Update Campaign') }}
@endsection
@section('style')
    <x-media.css />
    <x-niceselect.css />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/flatpickr.min.css') }}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Update Campaign') }}</h4>
                        <div class="dashboard__card__header__right">
                            <a href="{{ route('frontend.products.campaign', $campaign->id) }}"
                                class="btn btn-info">
                                {{ __('View Campaign') }}
                            </a>
                        </div>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('vendor.campaigns.update') }}" method="POST">
                            @csrf
                            <div class="row g-4 new_campaign">
                                <div class="col-md-4">
                                    <div class="dashboard__card">
                                        <div class="dashboard__card__header">
                                            <h4 class="dashboard__card__title">{{ __('Update Info') }}</h4>
                                        </div>
                                        <div class="dashboard__card__body custom__form mt-4">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="{{ $campaign->id }}">
                                                <label for="campaign_name">{{ __('Campaign Name') }}</label>
                                                <input type="text" class="form-control" id="campaign_name"
                                                    name="campaign_name" placeholder="Campaign Name"
                                                    value="{{ $campaign->title }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="campaign_slug">{{ __('Campaign Slug') }}</label>
                                                <input type="text" class="form-control" id="campaign_slug"
                                                    name="campaign_slug" placeholder="Campaign Slug"
                                                    value="{{ $campaign->slug }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="campaign_subtitle">{{ __('Campaign Subtitle') }}</label>
                                                <input type="text" class="form-control" id="campaign_subtitle"
                                                    name="campaign_subtitle" placeholder="Campaign Subtitle"
                                                    value="{{ html_entity_decode($campaign->subtitle) }}">
                                            </div>

                                            <x-media-upload :title="__('Campaign Image')" :oldimage="$campaign->campaignImage" :name="'image'"
                                                :dimentions="'1920x1080'" />

                                            <div class="form-group">
                                                <label for="campaign_status">{{ __('Campaign Status') }}</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="draft"
                                                        @if ($campaign->status == 'draft') selected @endif>
                                                        {{ __('Draft') }}</option>
                                                    <option value="publish"
                                                        @if ($campaign->status == 'publish') selected @endif>
                                                        {{ __('Publish') }}</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <input type="checkbox" id="set_fixed_percentage">
                                                <label for="set_fixed_percentage">{{ __('Set Fixed Percentage') }}</label>
                                                <p class="text-small">
                                                    {{ __('when you set fixed percentage, you have to click on sync price button, to sync price selection with all prodcuts') }}
                                                </p>
                                                <div id="fixe_price_cut_container" style="display: none">
                                                    <input type="number" id="fixed_percentage_amount"
                                                        class="form-control mb-2"
                                                        placeholder="{{ __('Price Cut Percentage') }}">
                                                    <button type="button" class="btn btn-sm btn-primary mb-2"
                                                        id="fixed_price_sync_all">{{ __('Sync Price') }}</button>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <input type="checkbox" id="set_fixed_date"
                                                    @if ($campaign->start_date || $campaign->end_date) checked @endif>
                                                <label for="set_fixed_date">{{ __('Set Fixed Date') }}</label>
                                                <p class="text-small">
                                                    {{ __('when you set fixed date, you have to click on sync date button, to sync date selection with all prodcuts') }}
                                                </p>
                                                <div id="fixed_date_container"
                                                    @if (!$campaign->start_date && !$campaign->end_date) style="display: none" @endif>
                                                    <input type="text" name="campaign_start_date" id="fixed_from_date"
                                                        class="form-control mb-2 flatpickr"
                                                        placeholder="{{ __('From Date') }}"
                                                        value="{{ $campaign->start_date }}">
                                                    <input type="text" name="campaign_end_date" id="fixed_to_date"
                                                        class="form-control mb-2 flatpickr"
                                                        placeholder="{{ __('To Date') }}"
                                                        value="{{ $campaign->end_date }}">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        id="fixed_date_sync_all">{{ __('Sync Date') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row g-4">
                                        <div class="col-md-12">
                                            <div id="product_repeater_container">
                                                @if ($campaign->products)
                                                    @foreach ($campaign->products as $campaign_product)
                                                        <div class="dashboard__card">
                                                            <div class="dashboard__card__header">
                                                                <h4 class="dashboard__card__title">
                                                                    {{ __('Campaign Product') }}
                                                                </h4>
                                                                <span class="delete-campaign text-danger">
                                                                    <i class="las la-times-circle"></i>
                                                                </span>
                                                            </div>
                                                            <div class="dashboard__card__body custom__form mt-4">
                                                                <div class="form-group select_product">
                                                                    <label
                                                                        for="product_id">
                                                                        {{ __('Select Product') }}
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="hidden" name="campaign_product_id[]"
                                                                        class="campaign_product_id"
                                                                        value="{{ $campaign_product->id }}">
                                                                    <input type="hidden" name="product_id[]"
                                                                        class="product_id"
                                                                        value="{{ $campaign_product->product_id }}">
                                                                    <select id="product_id" class="form-control wide" required="">
                                                                        <option value="">
                                                                            Add Campaign Product
                                                                        </option>
                                                                        @foreach ($all_products as $product)
                                                                            <option value="{{ $product->id }}"
                                                                                data-price="{{ $product->price }}"
                                                                                data-sale_price="{{ $product->sale_price }}"
                                                                                data-stock="{{ optional($product->inventory)->stock_count ?? 0 }}"
                                                                                @if ($campaign_product->product_id == $product->id) selected @endif>
                                                                                {{ $product->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="product_original_price">
                                                                        {{ __('Original Price') }}
                                                                    </label>
                                                                    <input type="number"
                                                                        class="form-control product_original_price"
                                                                        disabled
                                                                        value="{{ optional($campaign_product->product)->sale_price }}"
                                                                        step="0.01">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="campaign_price">
                                                                        {{ __('Price for Campaign') }}
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="number" name="campaign_price[]"
                                                                        class="form-control campaign_price"
                                                                        value="{{ $campaign_product->campaign_price }}"
                                                                        step="0.01" required="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="available_num_of_units">
                                                                        {{ __('No. of Units Available') }}
                                                                    </label>
                                                                    <input type="number"
                                                                        class="form-control available_num_of_units"
                                                                        disabled
                                                                        value="{{ optional(optional($campaign_product->product)->inventory)->stock_count ?? 0 }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="units_for_sale">
                                                                        {{ __('No. of Units for Sale') }}
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="number" name="units_for_sale[]"
                                                                        class="form-control units_for_sale"
                                                                        value="{{ $campaign_product->units_for_sale }}" required="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="start_date">
                                                                        {{ __('Start Date') }}
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" name="start_date[]"
                                                                        class="form-control start_date flatpickr"
                                                                        value="{{ $campaign_product->start_date ?? $campaign->start_date }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="end_date">
                                                                        {{ __('End Date') }}
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" name="end_date[]"
                                                                        class="form-control end_date flatpickr" required=""
                                                                        value="{{ $campaign_product->end_date ?? $campaign->end_date }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if ($campaign->products->count() == 0)
                                                    @include('campaign::vendor.add_new_campaign_product')
                                                @endif
                                            </div>
                                            <div class="btn-wrapper">
                                                <button type="button" class="cmn_btn btn_bg_profile"
                                                    id="add_product_btn">
                                                    {{ __('Add Product') }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                            <div class="btn-wrapper">
                                                <button type="submit" class="cmn_btn btn_bg_profile">
                                                    {{ __('Update') }}
                                                </button>
                                                <a href="{{ route('vendor.campaigns.all') }}"
                                                    class="cmn_btn default-theme-btn"
                                                    style="color: var(--white); background: var(--paragraph-color); border: 2px solid var(--paragraph-color);">
                                                    {{ __('Back') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup />
    <div class="d-none">
        <input type="hidden" id="fixed_percentage">
        <input type="hidden" id="fixed_campaign_start_date">
        <input type="hidden" id="fixed_campaign_end_date">
    </div>
@endsection

@section('script')
    <x-media.js />
    <script src="{{ asset('assets/backend/js/flatpickr.js') }}"></script>
    <x-niceselect.js />

    <script>
        (function ($) {
            // Slug Generation
            $('#campaign_slug').on('keyup', function () {
                let title_text = $(this).val();
                $('#campaign_slug').val(convertToSlug(title_text));
            });

            // Init flatpickr and niceSelect
            function initPlugins() {

                if ($('.nice-select').length > 0) {
                    $('.nice-select').niceSelect('destroy');
                    $('.nice-select').niceSelect();
                }
            }

            flatpickr(".flatpickr", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });

            initPlugins();

            // Toggle Fixed Percentage Container
            $('#set_fixed_percentage').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#fixe_price_cut_container').slideDown();
                } else {
                    $('#fixe_price_cut_container').slideUp();
                    $('#fixed_percentage_amount').val('');
                }
            });

            // Toggle Fixed Date Container
            $('#set_fixed_date').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#fixed_date_container').slideDown();
                } else {
                    $('#fixed_date_container').slideUp();
                    $('#fixed_from_date, #fixed_to_date').val('');
                }
            });

            // Sync Fixed Dates to All
            $('#fixed_date_sync_all').on('click', function () {
                if ($('#set_fixed_date').is(':checked')) {
                    let from_date = $('#fixed_from_date').val();
                    let to_date = $('#fixed_to_date').val();
                    $('.start_date').val(from_date);
                    $('.end_date').val(to_date);
                    initPlugins();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: '{{ __('Set fixed date first') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });

            // Sync Price
            $('#fixed_price_sync_all').on('click', function () {
                let percentage = $('#fixed_percentage_amount').val().trim();
                if (!percentage.length) {
                    return Swal.fire({
                        icon: 'warning',
                        title: '{{ __('Set percentage first') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

                $('.product_original_price').each(function () {
                    let original_price = parseFloat($(this).val());
                    if (!isNaN(original_price)) {
                        let new_price = (original_price - (original_price * percentage / 100)).toFixed(2);
                        $(this).closest('.dashboard__card__body').find('.campaign_price').val(new_price);
                    }
                });
            });

            // Delete Campaign Product
            $(document).on('click', '.delete-campaign', function () {
                let container = $(this).closest('.dashboard__card');
                let campaign_id = container.find('.campaign_product_id').val();

                Swal.fire({
                    title: "{{ __('Do you want to delete this campaign?') }}",
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    confirmButtonColor: '#dd3333',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('{{ route('vendor.campaigns.delete.product') }}', {
                            _token: '{{ csrf_token() }}',
                            id: campaign_id
                        }).then(function (data) {
                            if (data) {
                                Swal.fire('Deleted!', '', 'success');
                                setTimeout(() => location.reload(), 1000);
                            }
                        });
                    }
                });
            });

            // Change product and auto-update fields
            $(document).on('change', '.select_product select', function () {
                let selected_product_id = $(this).val();
                let container = $(this).closest('.dashboard__card');

                $(this).siblings('.product_id').val(selected_product_id);

                let data = $(this).find('option:selected').data();
                let product_price = data['sale_price'] ?? 0;
                let stock = data['stock'] ?? 0;

                container.find('.product_original_price').val(product_price);
                container.find('.available_num_of_units').val(stock);

                if ($('#set_fixed_percentage').is(':checked')) {
                    let percentage = $('#fixed_percentage_amount').val().trim();
                    if (percentage) {
                        let new_price = (product_price - (product_price * percentage / 100)).toFixed(2);
                        container.find('.campaign_price').val(new_price);
                    }
                }
            });

            // Add New Product Campaign Section
            $('#add_product_btn').on('click', function () {
                let container = $('#product_repeater_container');
                let lastCard = container.find('.dashboard__card').last();
                let newCard = lastCard.clone();

                // Reset inputs
                newCard.find('input[type="text"], input[type="number"]').val('');
                newCard.find('select').val('').niceSelect('update');

                // Remove campaign_product_id to avoid conflict
                newCard.find('.campaign_product_id').val('');

                // Set fixed date if checked
                if ($('#set_fixed_date').is(':checked')) {
                    let from = $('#fixed_from_date').val();
                    let to = $('#fixed_to_date').val();
                    newCard.find('.start_date').val(from);
                    newCard.find('.end_date').val(to);
                }

                // Update delete button
                newCard.find('.delete-campaign').removeClass('delete-campaign').addClass('cross-btn');

                container.append(newCard.hide());
                newCard.slideDown('fast');

                initPlugins();
            });

            // Remove cloned product block
            $(document).on('click', '.cross-btn', function () {
                let container = $(this).closest('.dashboard__card');
                container.slideUp('fast', function () {
                    container.remove();
                });
            });

        })(jQuery);
    </script>
@endsection
