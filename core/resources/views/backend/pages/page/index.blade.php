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
                <x-msg.error />
                <x-msg.flash />
                @can('page-new')
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
                            @can('page-bulk-action')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('page-bulk-action')
                                        <x-bulk-action.th />
                                    @endcan
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_pages as $page)
                                        <tr>
                                            @can('page-bulk-action')
                                                <x-bulk-action.td :id="$page->id" />
                                            @endcan
                                            <td>
                                                {{ $page->title }}
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
                                            </td>
                                            <td>{{ $page->created_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $page->status }} {{ $page->status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ ucfirst($page->status == 'publish' ? __('Publish') : __('Draft')) }}
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
                                                                {{ __('Draft') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @can('page-edit')
                                                    <a class="btn btn-xs btn-warning text-dark btn-sm mb-2 me-1"
                                                        title="{{ __('Edit Data') }}"
                                                        href="{{ route('admin.page.edit', $page->id) }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                @endcan
                                                @if (empty($dynamic_page_ids[$page->id]))
                                                    @can('page-delete')
                                                        <x-delete-popover :url="route('admin.page.delete', $page->id)" />
                                                    @endcan
                                                @endif
                                                @can('page-builder-dynamic-page')
                                                    @if (!empty($page->page_builder_status))
                                                        <a href="{{ route('admin.dynamic.page.builder', ['type' => 'dynamic-page', 'id' => $page->id]) }}"
                                                            class="btn btn-xs btn-secondary mb-2 me-1">
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
    @can('page-bulk-action')
        <x-bulk-action.js :route="route('admin.page.bulk.action')" />
    @endcan
@endsection