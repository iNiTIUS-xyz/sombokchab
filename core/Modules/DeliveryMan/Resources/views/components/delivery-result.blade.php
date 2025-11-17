<table class="custom--table">
    <thead class="head-bg">
    <tr>
        <th>{{ __("Name") }}</th>
        <th>{{ __("Contact") }}</th>
        <th>{{ __("Zone") }}</th>
        <th>{{ __("Order") }}</th>
        <th>{{ __("Status") }}</th>
        <th>{{ __("Actions") }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($deliveryMans as $deliveryMan)
        <tr class="table-cart-row">
            <td data-label="Name">
                <div class="table-delivery-man-author">
                    <div class="table-delivery-man-author-flex">
                        <div class="table-delivery-man-author-thumb">
                            {!! render_image($deliveryMan->profile_img, custom_path: \Modules\DeliveryMan\Services\AdminDeliveryManServices::IMAGE_DIRECTORY) !!}
                        </div>
                        <div class="table-delivery-man-author-contents">
                            <h6 class="table-delivery-man-author-name">{{ $deliveryMan->full_name ?? "" }}</h6>
                            @if($deliveryMan->ratings_avg_rating)
                                <p class="table-delivery-man-author-rating mt-2">
                                    <span class="icon"><i class="las la-star"></i></span>
                                    {{ $deliveryMan->ratings_avg_rating }} {{ __("Rating") }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </td>
            <td class="price-td" data-label="Contact">
                <div class="table-delivery-man-contact">
                    <p class="table-delivery-man-contact-mail">{{ $deliveryMan->email ?? "" }}</p>
                    <span class="table-delivery-man-contact-number mt-2">{{ $deliveryMan->phone ?? "" }}</span>
                </div>
            </td>
            <td class="price-td" data-label="Zone">
                <div class="table-delivery-man-zone">
                    <p class="table-delivery-man-para">
                        {{ $deliveryMan->zone?->name ?? "" }}
                    </p>
                </div>
            </td>
            <td class="price-td" data-label="Order">
                <div class="table-delivery-man-order">
                    <p class="table-delivery-man-para"><b>{{ __("Total Order") }}</b> {{ $deliveryMan->delivery_man_total_orders_count }}</p>
                    <p class="table-delivery-man-para"><b>{{ __("Completed Order") }}</b> {{ $deliveryMan->delivery_man_order_count }}</p>
                    <span class="table-delivery-man-para mt-2"><b>{{ __("Queue Order") }}</b> {{ $deliveryMan->delivery_man_total_orders_count - $deliveryMan->delivery_man_order_count }}</span>
                </div>
            </td>
            <td data-label="Status">
                <span @class(["status_para text-capitalize",($deliveryMan->status ?? 'active') == "active"  => "completed"])>
                    {{ \Modules\DeliveryMan\Enums\DeliveryManStatusEnum::get_status($deliveryMan->status ?? 'active') }}
                </span>

                <button data-name="{{ $deliveryMan->full_name ?? "" }}" data-phone="{{ $deliveryMan->phone ?? "" }}" data-id="{{ $deliveryMan->id ?? "" }}"
                        data-status="{{ \Modules\DeliveryMan\Enums\DeliveryManStatusEnum::get_status($deliveryMan->status ?? 'active') }}"
                        type="button" class="btn btn-sm btn-outline-primary change-delivery-man-status"
                        data-bs-toggle="modal" data-bs-target="#changeStatusModal">
                    <i class="las la-pen"></i>
                </button>
            </td>

            <td data-label="Actions">
                <div class="status-action">
                    <span class="status-action-icon" data-bs-toggle="dropdown" aria-expanded="false"> <i class="las la-ellipsis-v"></i> </span>
                    <ul class="dropdown-menu">
                        @can('manage-site-settings')
                            <li class="single-item">
                                <a class="dropdown-item" data-route="{{ route("admin.delivery-man.details", $deliveryMan->id) }}" href="{{ route("admin.delivery-man.details", $deliveryMan->id) }}">{{ __("View") }}</a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="single-item">
                                <a class="dropdown-item" data-route="{{ route("admin.delivery-man.ratings", $deliveryMan->id) }}" href="{{ route("admin.delivery-man.ratings", $deliveryMan->id) }}">{{ __("Ratings") }}</a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="single-item">
                                <a class="dropdown-item" data-route="{{ route("admin.delivery-man.tracking", $deliveryMan->id) }}" href="{{ route("admin.delivery-man.tracking", $deliveryMan->id) }}">{{ __("On Going Tracking") }}</a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="single-item">
                                <a class="dropdown-item" href="{{ route("admin.delivery-man.history", $deliveryMan->id) }}">{{ __("History") }}</a>
                            </li>
                        @endcan
                        @can('manage-site-settings')
                            <li class="single-item">
                                <a class="dropdown-item" href="{{ route("admin.delivery-man.edit", $deliveryMan->id) }}">{{ __("Edit") }}</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="delivery-man-pagination-link">
    {!! $deliveryMans->links() !!}
</div>