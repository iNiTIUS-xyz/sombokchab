<?php

namespace Modules\Refund\Observers;

use Modules\Refund\Entities\RefundRequest;
use Modules\Refund\Http\Services\RefundNotificationService;

class RefundRequestObserver
{
    public function created(RefundRequest $refundRequest): void
    {
        RefundNotificationService::init($refundRequest)
            ->setType("refund_request")
            ->send($refundRequest, "created");
    }

    public function updated(RefundRequest $refundRequest): void
    {
    }

    public function deleted(RefundRequest $refundRequest): void
    {
    }

    public function restored(RefundRequest $refundRequest): void
    {
    }

    public function forceDeleted(RefundRequest $refundRequest): void
    {
    }
}
