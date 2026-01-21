<?php

namespace App\Http\Services;

use App\Shipping\ShippingAddress;
use Illuminate\Http\JsonResponse;

class ShippingAddressServices
{
    public static function store($data, $isApi = false): JsonResponse
    {
        $data['name'] = auth()->user()->name;
        $query = ShippingAddress::create($data);

        if (!$isApi) {
            $loadView = view("frontend.cart.partials.shipping-address-option", with(["shipping_address" => $query]))->render();
        }

        return response()->json([
            'success' => (bool) $query ?? false,
            "msg" => !empty($query) ? "New Shipping Address Created Successfully." : "Failed to create new shipping address",
            'data' => $query,
            "option" => !$isApi ? $loadView : null
        ]);
    }

    public static function update($id, $data)
    {
        $address = ShippingAddress::find($id);
        if ($address) {
            $address->update($data);
            return response()->json([
                'success' => true,
                'msg' => "Shipping Address Updated Successfully.",
                'data' => $address
            ]);
        }
        return response()->json(['success' => false, 'msg' => "Address not found"]);
    }
}
