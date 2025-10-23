<?php

namespace App\Enums;

class CouponEnum
{
    /**
     * Return values for discount_on field
     */
    public static function discountOptions()
    {
        return [
            'all' => __('All Products'),
            'product' => __('Product'),
            'category' => __('Category'),
            'subcategory' => __('Sub Category'),
            // 'childcategory' => __('Child Category'),
            'shipping' => __('Shipping')
        ];
    }
}
