@extends('backend.admin-master')

@section('site-title', __('All Cities'))

@section('style')
    <x-select2.select2-css />
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            margin-top: 0px;
            height: 46px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <x-msg.error />
            <x-msg.flash />
        </div>
    </div>
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="mb-4">
                <x-btn.add-modal :title="__('Add New City')" />
            </div>
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title">
                        {{ __('All Cities') }}
                    </h4>
                    <div class="dashboard__card__header__right">
                        <x-bulk-action.dropdown />
                    </div>
                </div>
                <div class="dashboard__card__body mt-4">
                    <!-- Table Start -->
                    <div class="custom_table table-wrap style-04 search_result">
                        @include('countrymanage::city.search-result')
                    </div>
                    <!-- Table End -->
                </div>
            </div>
        </div>
    </div>

    @include('countrymanage::city.add-modal')
    @include('countrymanage::city.edit-modal')
@endsection

@section('script')

    <x-select2.select2-js />

    <script>
        (function($) {
            $(document).ready(function() {
                $(document).on('click', '#bulk_delete_btn', function(e) {
                    e.preventDefault();

                    var bulkOption = $('#bulk_option').val();
                    var allCheckbox = $('.bulk-checkbox:checked');
                    var allIds = [];

                    allCheckbox.each(function(index, value) {
                        allIds.push($(this).val());
                    });

                    if (allIds.length > 0 && bulkOption == 'delete') {
                        Swal.fire({
                            title: '{{ __('Are you sure?') }}',
                            text: '{{ __('You would not be able to revert this action!') }}',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#ee0000',
                            cancelButtonColor: '#55545b',
                            confirmButtonText: '{{ __('Yes, delete them!') }}',
                            cancelButtonText: "{{ __('No') }}"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#bulk_delete_btn').text('{{ __('Deleting...') }}');

                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('admin.city.delete.bulk.action') }}",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        ids: allIds,
                                    },
                                    success: function(data) {
                                        Swal.fire(
                                            '{{ __('Deleted!') }}',
                                            '{{ __('Selected data have been deleted.') }}',
                                            'success'
                                        );
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1000);
                                    },
                                    error: function() {
                                        Swal.fire(
                                            'Error!',
                                            'Failed to delete data.',
                                            'error'
                                        );
                                    }
                                });
                            }
                        });
                    } else {
                        Swal.fire(
                            'Warning!',
                            '{{ __('Please select at least one item and choose delete option.') }}',
                            'warning'
                        );
                    }
                });

                // Handle "select all" checkbox
                $('.all-checkbox').on('change', function(e) {
                    e.preventDefault();
                    var value = $(this).is(':checked');
                    var allChek = $(this).closest('table').find('.bulk-checkbox');

                    allChek.prop('checked', value);
                });
            });
        })(jQuery);
    </script>

    @include('countrymanage::city.city-js')

    <script>
        $(document).on('click', '.swal_status_change_button', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '{{ __('Are you sure?') }}',
                text: '{{ __('You would change status any time') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#55545b',
                confirmButtonText: "{{ __('Yes, Change it!') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });
    </script>
@endsection
