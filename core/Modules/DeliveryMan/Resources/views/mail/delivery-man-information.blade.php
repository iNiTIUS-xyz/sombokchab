<div>
    <h4>{{ __("Delivery man information") }}</h4>
</div>

<table>
    <tr>
        <td style="width: 20%">
            {!! render_image($deliveryMan->profile_img,attribute: 'style="max-width:100%"', custom_path: \Modules\DeliveryMan\Services\AdminDeliveryManServices::IMAGE_DIRECTORY) !!}
        </td>
        <td>
            <h4>{{ $deliveryMan->full_name }}</h4>
            <p><b>{{ __("Contact:") }} </b> {{ $deliveryMan->phone }}</p>
        </td>
    </tr>
</table>