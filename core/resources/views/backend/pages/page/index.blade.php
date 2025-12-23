@extends('backend.admin-master')

@section('site-title')
    {{ __('All Pages') }}
@endsection

@section('style')
    <x-bulk-action.css />
@endsection

@section('content')
    @php
        $pages = [];
    @endphp
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                {{--
            <x-msg.error />
            <x-msg.flash /> --}}
                @can('add-page')
                    <div class="btn-wrapper mb-4">
                        <a href="{{ route('admin.page.new') }}" class="cmn_btn btn_bg_profile" title="{{ __('Add New Page') }}">
                            {{ __('Add New Page') }}
                        </a>
                    </div>
                @endcan
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">
                            {{ __('All Pages') }}
                        </h4>
                        <div class="dashboard__card__header__right">
                            @can('view-page')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('view-page')
                                        <x-bulk-action.th />
                                    @endcan
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Publish Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_pages as $page)
                                        <tr>
                                            @can('view-page')
                                                <x-bulk-action.td :id="$page->id" />
                                            @endcan
                                            <td>
                                                <p>
                                                    <strong>English :</strong> {{ $page->title }}
                                                    @if (isset($dynamic_page_ids[$page->id]))
                                                        @if ($dynamic_page_ids[$page->id] == 'home_page')
                                                            <strong class="text-primary"> -
                                                                {{ __('Current Home Page') }}</strong>
                                                        @elseif($dynamic_page_ids[$page->id] == 'blog_page')
                                                            <strong class="text-primary"> -
                                                                {{ __('Current Blog Page') }}</strong>
                                                        @elseif($dynamic_page_ids[$page->id] == 'product_page')
                                                            <strong class="text-primary"> -
                                                                {{ __('Current Product Page') }}</strong>
                                                        @endif
                                                    @endif
                                                </p>
                                                @if ($page->title_km)
                                                    <p>
                                                        <strong>Khmer :</strong> {{ $page->title_km }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td>{{ date('M j, Y', strtotime($page->created_at)) }}</td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $page->status }} {{ $page->status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ ucfirst($page->status == 'publish' ? __('Publish') : __('Unpublish')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form action="{{ route('admin.page.status.change', $page->id) }}"
                                                            method="POST" id="status-form-activate-{{ $page->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="publish">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Publish') }}
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.page.status.change', $page->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $page->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="draft">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Unpublish') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @can('edit-page')
                                                    <a class="btn btn-warning text-dark btn-sm mb-2 me-1"
                                                        title="{{ __('Edit') }}"
                                                        href="{{ route('admin.page.edit', $page->id) }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @if (empty($dynamic_page_ids[$page->id]))
                                                    @can('delete-page')
                                                        <x-delete-popover :url="route('admin.page.delete', $page->id)" />
                                                    @endcan
                                                @endif
                                                @can('edit-page')
                                                    @if (!empty($page->page_builder_status))
                                                        <a href="{{ route('admin.dynamic.page.builder', ['type' => 'dynamic-page', 'id' => $page->id]) }}"
                                                            class="btn btn-xs btn-primary mb-2 me-1">
                                                            {{ __('Open Page Builder') }}
                                                        </a>
                                                    @endif
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
    @can('view-page')
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
                                        url: "{{ route('admin.page.bulk.action') }}",
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
