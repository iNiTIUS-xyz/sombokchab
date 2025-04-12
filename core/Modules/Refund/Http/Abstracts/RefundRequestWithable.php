<?php

namespace Modules\Refund\Http\Abstracts;

abstract class RefundRequestWithable
{
    protected array|string|null $with = ["product","variant"];
    protected array $data;
    protected int $orderId;
    protected string $defaultRefundStatus = "pending";
    protected string $refundRequestFilePath = "assets/refund-file";
}