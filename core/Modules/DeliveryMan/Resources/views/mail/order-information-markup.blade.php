<table>
    <tr>
        <th>{{ __("Serial No.") }}</th>
        <th>{{ __("Name:") }}</th>
        <th>{{ __("Quantity") }}</th>
    </tr>
    @foreach($order['orderItems'] as $product)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <th>
                {{ $product?->product?->name ?? "" }}
                <br/>
                {{ $product?->variant?->productColor ? __("Color:") . $product?->variant?->productColor?->name . ' , ' : "" }}
                {{ $product?->variant?->productSize ? __("Size:") . $product?->variant?->productSize?->name . ' , ' : "" }}
                @foreach($product?->variant?->attribute ?? [] as $attr)
                    {{ $attr->attribute_name }}
                    : {{ $attr->attribute_value }}

                    @if(!$loop->last)
                        ,
                    @endif
                @endforeach
            </th>
            <th>{{ $product->quantity ?? "" }}</th>
        </tr>
    @endforeach
</table>