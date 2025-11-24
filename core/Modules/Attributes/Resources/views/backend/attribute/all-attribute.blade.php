@extends('backend.admin-master')

@section('style')
<x-bulk-action.css />
@endsection

@section('site-title')
{{ __('All Attributes') }}
@endsection

@section('content')
<div class="col-lg-12 col-ml-12">
    <div class="row">
        <div class="col-lg-12">
            {{--
            <x-msg.error />
            <x-msg.flash /> --}}
            <div class="mb-4">
                @can('add-attribute')
                <div class="btn-wrapper">
                    <a href="{{ route('admin.products.attributes.store') }}" class="cmn_btn btn_bg_profile">
                        {{ __('Add New Attribute') }}
                    </a>
                </div>
                @endcan
            </div>
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title">{{ __('All Attributes') }}</h4>
                    <div class="dashboard__card__header__right">
                        @can('view-attribute')
                        <x-bulk-action.dropdown />
                        @endcan
                    </div>
                </div>
                <div class="dashboard__card__body mt-4">
                    <div class="table-responsive">
                        <table class="table table-default" id="dataTable">
                            <thead>
                                <x-bulk-action.th />
                                {{-- <th>{{ __('ID') }}</th> --}}
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Terms') }}</th>
                                <th>{{ __('Action') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($all_attributes as $attribute)
                                <tr>
                                    <x-bulk-action.td :id="$attribute->id" />
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{ $attribute->title }}</td>
                                    <td>
                                        <ul>
                                            @foreach (json_decode($attribute->terms) as $term)
                                            <li>{{ $term }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        @can('edit-attribute')
                                        <x-table.btn.edit
                                            :route="route('admin.products.attributes.edit', $attribute->id)" />
                                        @endcan
                                        @can('delete-attribute')
                                        <x-table.btn.swal.delete :route="route(
                                                        'admin.products.attributes.delete',
                                                        $attribute->id,
                                                    )" />
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<x-table.btn.swal.js />
@can('delete-attribute')
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
                                        url: "{{ route('admin.products.attributes.bulk.action') }}",
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
@endcan
@endsection