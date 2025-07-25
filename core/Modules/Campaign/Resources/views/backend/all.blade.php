@extends('backend.admin-master')

@section('site-title')
    {{ __('All Campaigns') }}
@endsection

@section('style')
    <x-bulk-action.css />
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="mb-4">
                    @can('campaigns-new')
                        <a href="{{ route('admin.campaigns.new') }}" class="cmn_btn btn_bg_profile">
                            {{ __('Add New Campaign') }}
                        </a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Campaigns') }}</h4>
                        <div class="dashboard__card__header__right">
                            @can('campaigns-delete')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('campaigns-bulk-action')
                                        <x-bulk-action.th />
                                    @endcan
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_campaigns as $campaign)
                                        <tr>
                                            @can('campaigns-bulk-action')
                                                <x-bulk-action.td :id="$campaign->id" />
                                            @endcan
                                            <td>{{ $campaign->title }}</td>
                                            <x-table.td-image :image="$campaign->image" />
                                            <td>
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $campaign->status }} {{ $campaign->status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ ucfirst($campaign->status == 'publish' ? __('Publish') : __('Draft')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form action="{{ route('admin.campaigns.change.status', $campaign->id) }}"
                                                            method="POST" id="status-form-activate-{{ $campaign->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="publish">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Publish') }}
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.campaigns.change.status', $campaign->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $campaign->id }}">
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
                                                <a class="btn btn-success btn-xs mb-2 me-1" title="{{ __('View Campaign') }}"
                                                    href="{{ route('frontend.products.campaign', ['id' => $campaign->id, 'slug' => $campaign->slug]) }}">
                                                    <i class="ti-eye"></i>
                                                </a>
                                                @can('campaigns-edit')
                                                    <x-table.btn.edit :route="route('admin.campaigns.edit', $campaign->id)" />
                                                @endcan

                                                @can('campaigns-delete')
                                                    <x-delete-popover :url="route('admin.campaigns.delete', $campaign->id)" />
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
    @can('campaigns-bulk-action')
        <x-bulk-action.js :route="route('admin.campaigns.bulk.action')" />
    @endcan

    <script>
        $(document).ready(function () {
            $(document).on('click', '.campaign_edit_btn', function () {
                let el = $(this);
                let id = el.data('id');
                let name = el.data('name');
                let modal = $('#campaign_edit_modal');

                modal.find('#campaign_id').val(id);
                modal.find('#edit_name').val(name);

                modal.show();
            });
        });
    </script>
@endsection