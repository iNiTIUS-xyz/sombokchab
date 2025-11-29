@extends('backend.admin-master')
@section('style')
<x-media.css />
@endsection
@section('site-title')
{{ __('Blogs') }}
@endsection
@section('content')
<div class="col-lg-12 col-ml-12">
    <div class="row">
        <div class="col-lg-12">
            {{--
            <x-msg.error />
            <x-msg.success /> --}}
        </div>
        @can('add-blog')
        <div class="btn-wrapper mb-4">
            <a href="{{ route('admin.blog.new') }}" class="cmn_btn btn_bg_profile">{{ __('Add New Blog') }}</a>
        </div>
        @endcan
        <div class="col-lg-12 mt-2">
            <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title">{{ __('All Blog') }}</h4>
                    <div class="dashboard__card__header__right">
                        <div class="bulk-delete-wrapper">
                            @can('view-blog')
                            <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="dashboard__card__body mt-4">
                    <div class="table-responsive">
                        <table class="table table-default" id="dataTable">
                            <thead>
                                <x-bulk-th />
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Author') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Publish Status') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Action') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($all_blog as $data)
                                <tr>
                                    <td>
                                        <x-bulk-delete-checkbox :id="$data->id" />
                                    </td>
                                    <td>{{ $data->title }}</td>
                                    <td>
                                        {!! render_attachment_preview_for_admin($data->image) !!}
                                    </td>
                                    <td>{{ $data->author }}</td>
                                    <td>
                                        @if (!empty($data->blog_categories_id))
                                        {{ get_blog_category_by_id($data->blog_categories_id) }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group badge">
                                            <button type="button"
                                                class="status-{{ $data->status }} {{ $data->status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ ucfirst($data->status == 'publish' ? __('Publish') : __('Unpublish'))
                                                }}
                                            </button>
                                            <div class="dropdown-menu">
                                                <form action="{{ route('admin.blog.status.change', $data->id) }}"
                                                    method="POST" id="status-form-activate-{{ $data->id }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="publish">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Publish') }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.blog.status.change', $data->id) }}"
                                                    method="POST" id="status-form-deactivate-{{ $data->id }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="draft">
                                                    <button type="submit" class="dropdown-item">
                                                        {{ __('Unpublish') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ date('M j, Y', strtotime($data->created_at)) }}</td>
                                    <td>
                                        @can('edit-blog')
                                        <x-edit-icon :url="route('admin.blog.edit', $data->id)" />
                                        @endcan
                                        @can('add-blog')
                                        <x-clone-icon :action="route('admin.blog.clone')" :id="$data->id" />
                                        @endcan
                                        {{-- @can('blog-delete')
                                        <x-view-icon :url="route('frontend.blog.single', $data->slug)" />
                                        @endcan --}}
                                        @can('delete-blog')
                                        <x-delete-popover :url="route('admin.blog.delete', $data->id)" />
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
@can('view-blog')
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
                                        url: "{{ route('admin.blog.bulk.action') }}",
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