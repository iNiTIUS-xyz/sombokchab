@extends('vendor.vendor-master')

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
                {{--
            <x-msg.error />
            <x-msg.flash /> --}}
                <div class="btn-wrapper mb-4">
                    <a href="{{ route('vendor.campaigns.new') }}"
                        class="cmn_btn btn_bg_profile">{{ __('Add New Campaign') }}</a>
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Campaigns') }}</h4>
                        <div class="dashboard__card__header__right">
                            <x-bulk-action.dropdown />
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    <x-bulk-action.th />
                                    <th>{{ __('Campaign Name') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Publish Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_campaigns as $campaign)
                                        <tr>
                                            <x-bulk-action.td :id="$campaign->id" />
                                            <td>
                                                <p>
                                                    <strong>English :</strong> {{ $campaign->title }}
                                                </p>
                                                @if ($campaign->title_km)
                                                    <p>
                                                        <strong>Khmer :</strong> {{ $campaign->title_km }}
                                                    </p>
                                                @endif
                                            </td>
                                            <x-table.td-image :image="$campaign->image" />
                                            <td>
                                                @if ($campaign->status === 'publish')
                                                    <span class="badge bg-primary">{{ __('Published') }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('Unpublished') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-secondary btn-sm mb-2 me-1" title="{{ __('View') }}"
                                                    target="__blank"
                                                    href="{{ route('frontend.products.campaign', ['id' => $campaign->id, 'slug' => $campaign->slug]) }}">
                                                    <i class="las la-file-invoice"></i>
                                                </a>

                                                <x-table.btn.edit :route="route('vendor.campaigns.edit', $campaign->id)" />

                                                <x-delete-popover :url="route('vendor.campaigns.delete', $campaign->id)" />
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
    <x-bulk-action.js :route="route('vendor.campaigns.bulk.action')" />

    <script>
        $(document).ready(function() {
            $(document).on('click', '.campaign_edit_btn', function() {
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
