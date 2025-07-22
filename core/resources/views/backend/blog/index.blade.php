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
                <x-msg.error />
                <x-msg.success />
            </div>
            @can('blog-new')
                <div class="btn-wrapper mb-4">
                    <a href="{{ route('admin.blog.new') }}" class="cmn_btn btn_bg_profile">{{ __('Add New') }}</a>
                </div>
            @endcan
            <div class="col-lg-12 mt-2">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Blog Items') }}</h4>
                        <div class="dashboard__card__header__right">
                            <div class="bulk-delete-wrapper">
                                @can('blog-bulk-action')
                                    <x-bulk-action />
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
                                    <th>{{ __('Status') }}</th>
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
                                                        {{ ucfirst($data->status == 'publish' ? __('Publish') : __('Draft')) }}
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
                                                                {{ __('Draft') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ date_format($data->created_at, 'd M Y') }}</td>
                                            <td>
                                                @can('blog-edit')
                                                    <x-edit-icon :url="route('admin.blog.edit', $data->id)" />
                                                @endcan
                                                @can('blog-clone')
                                                    <x-clone-icon :action="route('admin.blog.clone')" :id="$data->id" />
                                                @endcan
                                                @can('blog-delete')
                                                    <x-view-icon :url="route('frontend.blog.single', $data->slug)" />
                                                @endcan
                                                @can('blog-delete')
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
    @can('blog-bulk-action')
        <x-bulk-action.js :route="route('admin.blog.bulk.action')" />
    @endcan
@endsection