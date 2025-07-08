@extends('backend.admin-master')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/common/css/delivery_man.css') }}" />

    <style>
        .data-table-style tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }
    </style>
@endsection

@section('site-title', __('Delivery man list'))

@section('content')

    <x-msg.success />
    <x-msg.error />

    <div class="dashboard-deliveryWrap">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <div class="dashboard__card__left">
                            <h2 class="dashboard__card__title">{{ __('Delivery Man List') }}</h2>
                        </div>
                        <div class="dashboard__card__header__right d-flex">
                            @can('delivery-man-search')
                                <div class="dashboard__card__search">
                                    <div class="dashboard__card__search__icon">
                                        <input value="{{ request()->name ?? '' }}" id="delivery_man_search_name" type="text"
                                            class="form--control radius-5" placeholder="{{ __('Search Here...') }}">
                                        <span class="icon"><i class="las la-search"></i></span>
                                    </div>
                                </div>
                                <div class="dashboard__card__header__right__item">
                                    <select class="js_niceSelect select_delivery_zone form-control form-control-sm"
                                        id="delivery_man_zone_id">
                                        <option value="0">{{ __('All zone') }}</option>
                                        @foreach ($deliveryZones as $deliveryZone)
                                            <option {{ (request()->zone_id ?? 0) == $deliveryZone->id ? 'selected' : '' }}
                                                value="{{ $deliveryZone->id }}">{{ $deliveryZone->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if (request()->has('name') || request()->has('zone_id'))
                                    <div class="dashboard__card__header__right__item">
                                        <div class="btn-wrapper">
                                            <button class="btn btn-sm btn-danger" id="reset-search">{{ __('Reset') }}</button>
                                        </div>
                                    </div>
                                @endif
                            @endcan

                            @can('delivery-man-add')
                                <div class="dashboard__card__header__right__item">
                                    <div class="btn-wrapper">
                                        <a href="{{ route('admin.delivery-man.add') }}"
                                            class="cmn_btn btn_bg_profile">{{ __('Add Delivery Man') }}</a>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="dashboard-table table-wrap">
                            <div id="response-body" class="table-responsive">
                                @include('deliveryman::components.delivery-result')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('delivery-man-change-status')
        <!-- Modal -->
        <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <form action="{{ route('admin.delivery-man.change-status') }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="modal-content custom__form">
                        <div class="modal-header">
                            <h5 class="modal-title" id="changeStatusModalTitle">{{ __('Change Delivery Man Status') }}</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body change-form-delivery-man-status">
                            <input type="hidden" name="id" />
                            <div class="form-group">
                                <label for="">{{ __('Name') }}</label>
                                <input readonly disabled type="text" class="form-control" name="name" id="name" />
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('Phone') }}</label>
                                <input readonly disabled type="text" class="form-control" name="phone" id="phone" />
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('Status') }}</label>
                                <select name="status" id="status">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}">{{ str($status)->ucfirst() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button class="btn btn-primary">{{ __('Save Changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endcan
@endsection

@section('script')
    <script>
        $(document).on("click", ".change-delivery-man-status", function() {
            let name = $(this).attr("data-name");
            let phone = $(this).attr("data-phone");
            let status = $(this).attr("data-status");
            let id = $(this).attr("data-id");

            let formData = $('.change-form-delivery-man-status');
            formData.find('input[name=name]').val(name);
            formData.find('input[name=phone]').val(phone);
            formData.find('select[name=status]').val(status);
            formData.find('input[name=id]').val(id);
        });

        // search delivery man by name
        $(document).on("click", "#reset-search", function(e) {
            e.preventDefault();
            let allQueryString = "";

            changeUrlWithoutReload("?" + allQueryString, "delivery man", {})

            send_ajax_request("get", "", "{{ route('admin.delivery-man.search') }}?" + allQueryString, () => {

            }, (response) => {
                $("#response-body").html(response);
            }, (errors) => prepare_errors(errors))
        });

        // search delivery man by name
        $(document).on("change", "#delivery_man_search_name", function(e) {
            e.preventDefault();
            const name = $(this).val();
            let allQueryString = window.location.search.substring(1);
            let oldPage = allQueryString.split("name=");
            allQueryString = allQueryString.replace("name=" + oldPage[1], "name=" + name)

            if (!allQueryString.includes("name=")) {
                allQueryStringOld = allQueryString;
                allQueryString = "name=" + name;
                // check allquerystring if length is bigger then one then it will concat
                if (allQueryStringOld.length > 0) {
                    allQueryString = allQueryString + "&" + allQueryStringOld;
                }
            }

            changeUrlWithoutReload("?" + allQueryString, "delivery man", {})

            send_ajax_request("get", "", "{{ route('admin.delivery-man.search') }}?" + allQueryString, () => {

            }, (response) => {
                $("#response-body").html(response);
            }, (errors) => prepare_errors(errors))
        });

        // search delivery man by name
        $(document).on("change", "#delivery_man_zone_id", function(e) {
            e.preventDefault();
            const name = $(this).val();
            let allQueryString = window.location.search.substring(1);
            let oldPage = allQueryString.split("zone_id=");
            allQueryString = allQueryString.replace("zone_id=" + oldPage[1], "zone_id=" + name)

            if (!allQueryString.includes("zone_id=")) {
                allQueryStringOld = allQueryString;
                allQueryString = "zone_id=" + name;
                // check allquerystring if length is bigger then one then it will concat
                if (allQueryStringOld.length > 0) {
                    allQueryString = allQueryString + "&" + allQueryStringOld;
                }
            }

            changeUrlWithoutReload("?" + allQueryString, "delivery man", {})

            send_ajax_request("get", "", "{{ route('admin.delivery-man.search') }}?" + allQueryString, () => {

            }, (response) => {
                $("#response-body").html(response);
            }, (errors) => prepare_errors(errors))
        });

        // make pagination in here with query string
        $(document).on("click", ".delivery-man-pagination-link a", function(e) {
            e.preventDefault();
            const pageNum = $(this).attr("href").split("page=")[1];
            let allQueryString = window.location.search.substring(1);
            let oldPage = allQueryString.split("page=");
            allQueryString = allQueryString.replace("page=" + oldPage[1], "page=" + pageNum)

            if (!allQueryString.includes("page=")) {
                allQueryStringOld = allQueryString;
                allQueryString = "page=" + pageNum;
                // check allquerystring if length is bigger then one then it will concat
                if (allQueryStringOld.length > 0) {
                    allQueryString = allQueryString + "&" + allQueryStringOld;
                }
            }

            changeUrlWithoutReload("?" + allQueryString, "delivery man", {})

            send_ajax_request("get", "", "{{ route('admin.delivery-man.search') }}?" + allQueryString, () => {

            }, (response) => {
                $("#response-body").html(response);
            }, (errors) => prepare_errors(errors))
        });
    </script>
@endsection
