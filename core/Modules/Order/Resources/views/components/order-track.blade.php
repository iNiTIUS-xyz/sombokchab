@php
    $disableForm = $disableForm ?? false;
    $orderTracks = \Modules\Order\Services\OrderServices::orderTrackArray() ?? [];
    $orderTrack = [];
    $orderTrackIcons = ['', '', '', '', ''];

    try {
        if (!empty($order)) {
            $orderTrack = $order->orderTrack->pluck('name')->toArray() ?? [];
        }
    } catch (\Exception $e) {
        session()->flash('error', __('Failed to load order tracking information'));
    }
@endphp

<div class="dashboard__card">
    <div class="dashboard__card__header">
        <h4 class="dashboard__card__title">
            {{ __('Update order track status') }}
        </h4>
    </div>
    <div class="dashboard__card__body mt-4">
        @if ($disableForm === false)
            <form method="post" action="{{ route('admin.orders.update.order-track') }}" class="">
                @csrf
                @method('PUT')
                @if (!empty($order))
                    <input type="hidden" value="{{ $order->id }}" name="order_id">
                @else
                    <div class="alert alert-danger">
                        {{ __('Order information not available') }}
                    </div>
                @endif
        @endif

        @if (count($orderTracks) > 0)
            <div class="d-flex flex-wrap flex-xl-nowrap gap-3 justify-content-center">
                @foreach ($orderTracks as $track)
                    @php
                        $isDisabled = false;
                        $isChecked = false;

                        if (in_array($track, $orderTrack)) {
                            $isChecked = true;
                            $isDisabled = true;
                        }
                        if (in_array('assigned_delivery_man', $orderTrack) && $track == 'picked_by_courier') {
                            $track = 'assigned_delivery_man';
                            $isChecked = true;
                            $isDisabled = true;
                        }
                    @endphp

                    <div class="form-group text-center">
                        <label for="{{ $track }}">
                            {{ __(ucwords(str_replace(['-', '_'], ' ', $track))) }}
                        </label>
                        @if (!$disableForm)
                            <input {{ $isChecked ? 'checked' : '' }} {{ $isDisabled ? 'disabled' : '' }}
                                class="order-track-input" id="{{ $track }}" value="{{ $track }}"
                                type="checkbox" name="order_track[]" />
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="track-wrapper">
                <div class="track">
                    @foreach ($orderTracks as $track)
                        @php
                            $isActive = in_array($track, $orderTrack);

                            if (in_array('assigned_delivery_man', $orderTrack) && $track == 'picked_by_courier') {
                                $track = 'assigned_delivery_man';
                                $isActive = true;
                            }
                        @endphp

                        <div class="step {{ $isActive ? 'active' : '' }}">
                            <span class="icon">
                                <i class="las la-check"></i>
                            </span>
                            <small class="text">
                                {{ __(ucwords(str_replace(['-', '_'], ' ', $track))) }}
                            </small>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                {{ __('No order tracking steps are configured') }}
            </div>
        @endif

        @if ($disableForm === false)
            <div class="form-group">
                @if (!empty($order))
                    <button {{ count(array_diff($orderTracks, $orderTrack)) === 0 ? 'disabled' : '' }}
                        class="cmn_btn btn_bg_profile">
                        {{ __('Update') }}
                    </button>
                @else
                    <button disabled class="cmn_btn btn_bg_profile">
                        {{ __('Update') }}
                    </button>
                @endif
            </div>
            </form>
        @endif
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
