<?php

namespace Modules\Order\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\ShippingModule\Entities\AdminShippingMethod;
use Modules\ShippingModule\Entities\VendorShippingMethod;

class OrderShippingChargeService
{
    public static function getShippingCharge($shippingCost): array
    {

        $adminShippingMethodId = $shippingCost["admin"] ?? null;
        unset($shippingCost["admin"]);

        $vendorMethods = !empty($shippingCost) ? self::vendorShippingCharge($shippingCost) : collect([]);
        $vendorFallback = collect([]);
        $useAdminFallbackForVendor = false;

        if ($vendorMethods->isEmpty() && !empty($shippingCost)) {
            $vendorFallback = self::adminShippingChargeByIds(array_values($shippingCost));
            $useAdminFallbackForVendor = $vendorFallback->isNotEmpty();
        }

        return [
            "vendor" => $vendorMethods->isNotEmpty() ? $vendorMethods : $vendorFallback,
            "admin" => $useAdminFallbackForVendor ? null : self::adminShippingCharge($adminShippingMethodId),
        ];
    }

    private static function adminShippingCharge(?int $id)
    {
        $query = AdminShippingMethod::query()->where("status_id", 1);

        if (!empty($id)) {
            $query->where("id", $id);
        }

        $method = $query->first();

        return $method ?? AdminShippingMethod::query()
            ->where("status_id", 1)
            ->first();
    }

    private static function adminShippingChargeByIds(array $ids): Collection
    {
        if (empty($ids)) {
            return collect([]);
        }

        return AdminShippingMethod::query()
            ->where("status_id", 1)
            ->whereIn("id", $ids)
            ->get();
    }

    private static function vendorShippingCharge($shippingMethods)
    {
        if (empty($shippingMethods)) {
            return collect([]);
        }

        $shippingMethodQuery = VendorShippingMethod::query();
        $shippingMethodQuery->where(function ($query) use ($shippingMethods) {
            foreach ($shippingMethods as $vendorId => $methodId) {
                $query->orWhere([
                    ["id", "=", $methodId],
                    ["vendor_id", "=", $vendorId],
                    ["status_id", "=", 1],
                ]);
            }
        });

        // return shippingMethod collection
        return $shippingMethodQuery->get();
    }
}
