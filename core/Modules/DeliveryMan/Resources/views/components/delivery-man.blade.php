<label for="delivery_man_id_{{ $deliveryMan->id }}" class="d-block mt-4">
    <div class="deliveryMan__card">
        <div class="row g-4 align-items-center">
            <div class="col-lg-3">
                <div class="deliveryMan__card__checkThumb">
                    <div class="deliveryMan__card__checkbox">
                        <input name="delivery_man_id" class="delivery-man-input"
                            id="delivery_man_id_{{ $deliveryMan->id }}" type="radio" value="{{ $deliveryMan->id }}" />
                    </div>
                    <div class="deliveryMan__card__thumb">
                        {!! render_image(
                            $deliveryMan->profile_img,
                            custom_path: \Modules\DeliveryMan\Services\AdminDeliveryManServices::IMAGE_DIRECTORY,
                        ) !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-9 px-2">
                <div class="deliveryMan__card__details">
                    <div class="deliveryMan__card__details__header">
                        <h5 class="deliveryMan__car__details__title">{{ $deliveryMan->full_name }}</h5>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="deliveryMan__card__left">
                                <h6 class="deliveryMan__card__left__title mt-2">{{ __('Total Order') }}
                                    ({{ $deliveryMan->delivery_man_order_count ?? '' }})</h6>
                                <div class="deliveryMan__card__left__rating flex-column mt-2">
                                    <p class="deliveryManT__cart__left_rating_title">
                                        {{ __('Rating') }}
                                    </p>
                                    <div class="deliveryManT__cart__left_rating_title">
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                        <i class="las la-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="deliveryMan__card__right">
                                <p class="deliveryMan__card__right__queue">{{ __('Queue') }}
                                    ({{ $deliveryMan->delivery_man_queue_order_count }})</p>
                                <div class="deliveryMan__card__right__zone mt-3">
                                    <p>{{ __('Zone') }}:</p>
                                    <strong>{{ $deliveryMan?->zone?->name ?? '' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</label>
