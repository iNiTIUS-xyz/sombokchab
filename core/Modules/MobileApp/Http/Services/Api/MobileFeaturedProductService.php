<?php

namespace Modules\MobileApp\Http\Services\Api;

use App\MobileProduct;
use Modules\MobileApp\Entities\MobileFeaturedProduct;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Product\_IH_Product_C;

class MobileFeaturedProductService
{
    public static function getProducts()
    {
        $selectedProduct = MobileProduct::query()->first();

        if (!$selectedProduct || empty($selectedProduct->product_ids)) {
            return collect();
        }

        $productIds = json_decode($selectedProduct->product_ids, true);

        if (!is_array($productIds) || empty($productIds)) {
            return collect();
        }

        return Product::query()
            ->withCount([
                'inventoryDetail',
                'ratings',
                'orderItems',
            ])
            ->withAvg('ratings', 'rating')
            ->with([
                'vendor',
                'category',
                'subCategory',
                'childCategory',
                'campaign_product' => function ($query) {
                    productCampaignConditionWith($query);
                },
                'inventory',
                'badge',
            ])
            ->when(get_static_option('vendor_enable', 'on') !== 'on', function ($query) {
                $query->whereNull('vendor_id');
            })
            ->whereIn('id', $productIds)
            ->orderByRaw('FIELD(id, ' . implode(',', $productIds) . ')')
            ->get();
    }

}
