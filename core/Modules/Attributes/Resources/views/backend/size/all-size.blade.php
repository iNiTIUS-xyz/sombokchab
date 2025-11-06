@extends('backend.admin-master')

@section('site-title')
    {{ __('All Sizes') }}
@endsection

@section('style')
    <x-bulk-action.css />
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-20">
        <div class="row g-4">
            <div class="col-lg-12">
                <x-error-msg />
                <x-flash-msg />
                <div class="mb-4">
                    @can('sizes-new')
                        <a href="#1" data-bs-toggle="modal" data-bs-target="#size_add_modal" class="cmn_btn btn_bg_profile">
                            {{ __('Add New Size') }}
                        </a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Sizes') }}</h4>
                        @can('sizes-bulk-action')
                            <x-bulk-action.dropdown />
                        @endcan
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('sizes-bulk-action')
                                        <x-bulk-action.th />
                                    @endcan
                                    {{-- <th>{{ __('ID') }}</th> --}}
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Size Code') }}</th>
                                    <th>{{ __('Slug') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($product_sizes as $product_size)
                                        <tr>
                                            @can('sizes-bulk-action')
                                                <x-bulk-action.td :id="$product_size->id" />
                                            @endcan
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ $product_size->name }}</td>
                                            <td>{{ $product_size->size_code }}</td>
                                            <td>{{ $product_size->slug }}</td>
                                            <td>
                                                @can('sizes-update')
                                                    <a href="#1" data-bs-toggle="modal" data-bs-target="#size_edit_modal"
                                                        class="btn btn-warning text-dark btn-xs mb-2 me-1 size_edit_btn"
                                                        data-id="{{ $product_size->id }}"
                                                        data-name="{{ $product_size->name }}"
                                                        data-size_code="{{ $product_size->size_code }}"
                                                        data-slug="{{ $product_size->slug }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('sizes-delete')
                                                    <x-table.btn.swal.delete :route="route('admin.product.sizes.delete', $product_size->id)" />
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

    @can('sizes-new')
        <div class="modal fade" id="size_add_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add New Size') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.product.sizes.new') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('Enter name') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="size_code">
                                    {{ __('Size Code') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="size_code" name="size_code"
                                    placeholder="{{ __('Enter size code') }}" required="">
                            </div>
                            {{-- <div class="form-group">
                                <label for="slug">{{ __('Slug') }}</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                    placeholder="{{ __('Enter slug') }}">
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('sizes-update')
        <div class="modal fade" id="size_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit Size') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.product.sizes.update') }}" method="post">
                        <input type="hidden" name="id" id="size_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="edit_name">
                                    {{ __('Name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="{{ __('Enter name') }}" required="">
                            </div>
                            <div class="form-group">
                                <label for="edit_size_code">
                                    {{ __('Size Code') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="edit_size_code" name="size_code"
                                    placeholder="{{ __('Enter size code') }}" required="">
                            </div>
                            {{-- <div class="form-group">
                                <label for="edit_slug">{{ __('Slug') }}</label>
                                <input type="text" class="form-control" id="edit_slug" name="slug"
                                    placeholder="{{ __('Enter slug') }}">
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('script')
    <x-table.btn.swal.js />

    @can('sizes-bulk-action')
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
                                        url: "{{ route('admin.product.sizes.bulk.action') }}",
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
    <script>
        $(document).ready(function() {
            $(document).on('click', '.size_edit_btn', function() {
                let el = $(this);
                let modal = $('#size_edit_modal');

                modal.find('#size_id').val(el.data('id'));
                modal.find('#edit_name').val(el.data('name'));
                modal.find('#edit_size_code').val(el.data('size_code'));
                modal.find('#edit_slug').val(el.data('slug'));
            });
        });
    </script>
@endsection
