<div class="dashboard-input mt-4">
    <label for="commission_type" class="dashboard-label color-light mb-2">{{ __("Delivery Man Pickup Point") }}</label>
    <div class="dashboard-input-select">
        <div class="single-input">
            <select name="pickup_point_id" id="commission_type" class="form-control">
                <option value="">{{ __("Select Delivery man pickup point") }}</option>
                @foreach($deliveryManPickupPoints as $pickupPoint)
                    <option value="{{ $pickupPoint->id }}">{{ $pickupPoint->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

@if($deliveryMan->delivery_man_type != "employee")
    <div class="dashboard-input mt-4">
        <label for="commission_type" class="dashboard-label color-light mb-2">{{ __("Commission Type") }}</label>
        <div class="dashboard-input-select">
            <div class="single-input">
                <select name="commission_type" id="commission_type" class="form-control">
                    <option value="">{{ __("Select commission type") }}</option>
                    <option value="percentage">{{ __("Percentage") }}</option>
                    <option value="amount">{{ __("Amount") }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="dashboard-input mt-4">
        <label for="commission_amount" class="dashboard-label color-light mb-2">{{ __("Commission Amount") }}</label>
        <div class="dashboard-input-select">
            <div class="single-input">
                <input name="commission_amount" id="commission_amount" class="form-control" placeholder="{{ __("Enter commission amount") }}" />
            </div>
        </div>
    </div>
@endif