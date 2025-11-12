<?php

namespace Modules\Order\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\ShippingModule\Entities\AdminShippingMethod;
use Modules\ShippingModule\Entities\VendorShippingMethod;

class OrderShippingChargeService
{
    public static function getShippingCharge($shippingCost): array
    {

        $adminShippingMethodId = $shippingCost["admin"] ?? 0;
        unset($shippingCost["admin"]);

        return [
            "vendor" => !empty($shippingCost) ? self::vendorShippingCharge($shippingCost) : collect([]),
            "admin" => self::adminShippingCharge($adminShippingMethodId),
        ];
    }

    private static function adminShippingCharge(int $id)
    {
        return AdminShippingMethod::query()
            ->where("status_id", 1)
            // ->where("id", $id)
            ->first();
    }

    private static function vendorShippingCharge($shippingMethods)
    {
        $shippingMethodQuery = VendorShippingMethod::query();
        // run a loop for getting multiple Cost Summary and for that I am using orWhere method
        foreach ($shippingMethods as $vendorId => $methodId) {
            $shippingMethodQuery->where([
                ["id", "=", $methodId],
                ["vendor_id", "=", $vendorId],
                ["status_id", "=", 1]
            ]);
        }

        // return shippingMethod collection
        return $shippingMethodQuery->get();
    }
}
