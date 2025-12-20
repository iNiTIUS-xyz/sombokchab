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
                {{--
            <x-msg.error />
            <x-msg.flash /> --}}
                <div class="mb-4">
                    @can('add-campaign')
                        <a href="{{ route('admin.campaigns.new') }}" class="cmn_btn btn_bg_profile">
                            {{ __('Add New Campaign') }}
                        </a>
                    @endcan
                </div>
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Campaigns') }}</h4>
                        <div class="dashboard__card__header__right">
                            @can('delete-campaign')
                                <x-bulk-action.dropdown />
                            @endcan
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-responsive">
                            <table class="table table-default" id="dataTable">
                                <thead>
                                    @can('view-campaign')
                                        <x-bulk-action.th />
                                    @endcan
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Publish Status') }}</th>
                                    <th>{{ __('Created On') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_campaigns as $campaign)
                                        <tr>
                                            @can('view-campaign')
                                                <x-bulk-action.td :id="$campaign->id" />
                                            @endcan
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
                                                <div class="btn-group badge">
                                                    <button type="button"
                                                        class="status-{{ $campaign->status }} {{ $campaign->status == 'publish' ? 'bg-primary status-open' : 'bg-danger status-close' }} dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ ucfirst($campaign->status == 'publish' ? __('Published') : __('Unpublished')) }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form
                                                            action="{{ route('admin.campaigns.change.status', $campaign->id) }}"
                                                            method="POST" id="status-form-activate-{{ $campaign->id }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="publish">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Publish') }}
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('admin.campaigns.change.status', $campaign->id) }}"
                                                            method="POST" id="status-form-deactivate-{{ $campaign->id }}">
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
                                                {{ date('M j, Y', strtotime($campaign->created_at)) }}
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-xs mb-2 me-1"
                                                    title="{{ __('View Campaign') }}"
                                                    href="{{ route('frontend.products.campaign', ['id' => $campaign->id, 'slug' => $campaign->slug]) }}">
                                                    <i class="ti-eye"></i>
                                                </a>
                                                @can('edit-campaign')
                                                    <x-table.btn.edit :route="route('admin.campaigns.edit', $campaign->id)" />
                                                @endcan

                                                @can('delete-campaign')
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

    @can('view-campaign')
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
                                        url: "{{ route('admin.campaigns.bulk.action') }}",
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
