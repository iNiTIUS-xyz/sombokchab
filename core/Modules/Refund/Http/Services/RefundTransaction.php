<?php

namespace Modules\Refund\Http\Services;

use Modules\Refund\Entities\RefundRequestProduct;

class RefundTransaction
{
    public static function get_refund_item_total_amount($id): float|int
    {
        $totalAmount = 0;
        $refundRequestProducts = RefundRequestProduct::where("refund_request_id", $id)->get();

        foreach($refundRequestProducts as $product){
            $totalAmount += $product->amount * $product->quantity;
        }

        return $totalAmount;
    }
}