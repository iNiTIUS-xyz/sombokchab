<?php

namespace Modules\Refund\Http\Traits;

use App\XGNotification;
use Illuminate\Support\Facades\DB;
use Modules\Order\Entities\SubOrderItem;
use Modules\Refund\Entities\RefundRequest;
use Illuminate\Database\Eloquent\Collection;
use Modules\Refund\Entities\RefundRequestFile;
use Modules\Refund\Entities\RefundRequestTrack;
use Modules\Refund\Entities\RefundRequestProduct;

trait RefundRequestData
{
    private array $itemIds = [];
    private array $items = [];
    private Collection|array $products;
    private RefundRequest $refundRequest;
    private array $fileNames = [];


    private function validatedRefundRequest(): bool
    {
        try {
            DB::beginTransaction();

            // 1. Prepare item data
            $this->prepareRequestItemData();

            // 2. Load products
            $this->requestItemProduct();

            // 3. Store main refund request
            $this->storeRefundRequest();

            // 4. Store refund product items
            $this->storeRefundProductItems();

            // 5. Store request track
            $this->storeRefundRequestTrack($this->refundRequest->id, 'Request sent', auth()->id());

            // 6. Upload files
            $this->storeFile();

            // 7. Save file names in DB
            $this->saveRefundRequestFiles();

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();

            // DEBUG PROPER ERROR (IMPORTANT)
            // dd([
            //     "error" => $exception->getMessage(),
            //     "line"  => $exception->getLine(),
            //     "file"  => $exception->getFile(),
            // ]);

            return false;
        }
    }


    private function saveRefundRequestFiles(): bool
    {
        return RefundRequestFile::insert($this->fileNames);
    }

    private function storeFile()
    {
        foreach ($this->data["files"] ?? [] as $file) {
            $filename = time() . rand(1111, 9999);
            $extension = $file->extension();
            $filename = $filename . '.' . $extension;
            $this->fileNames[] = [
                "refund_request_id" => $this->refundRequest->id,
                "file" => $filename . '.' . $extension,
                "created_at" => now()
            ];

            $file->move($this->refundRequestFilePath, $filename . '.' . $extension);
        }

        return $this->fileNames;
    }

    private function storeRefundProductItems(): bool
    {
        return RefundRequestProduct::insert($this->refundProductsValidation());
    }

    private function refundProductsValidation(): array
    {
        $refundRequestProducts = [];

        foreach ($this->items as $item) {

            $item = (object) $item;

            $productItem = $this->products->find($item->item_id);

            if (!$productItem) {
                throw new \Exception("Invalid product item id: {$item->item_id}");
            }

            $refundRequestProducts[] = [
                'refund_request_id' => $this->refundRequest->id,
                'product_id' => $productItem->product_id,
                'variant_id' => $productItem->variant_id,
                'amount' => $productItem->price,
                'quantity' => $item->quantity,
                'reason_id' => $item->reason,
                'other_reason' => $item->other_reason ?? '',
                'created_at' => now()
            ];
        }

        return $refundRequestProducts;
    }


    public function storeRefundRequestTrack(int $id, string $name, int $userId, string $type = 'create')
    {
        $timestamp = $type === 'create' ? ["created_at" => now()] : ["updated_at" => now()];

        return RefundRequestTrack::create([
            "refund_request_id" => $id,
            "name" => $name,
            "updated_by" => $userId,
            "table" => activeGuard(),
        ] + $timestamp);
    }

    private function storeRefundRequest()
    {
        $this->refundRequest = RefundRequest::create($this->storeRefundRequestData());

        return $this->refundRequest;
    }

    private function storeRefundRequestData()
    {
        $qrFileName = null;

        if (isset($this->data['qr_file']) && $this->data['qr_file']) {
            if (!file_exists(public_path('uploads/refund-qr'))) {
                mkdir(public_path('uploads/refund-qr'), 0777, true);
            }

            $filename = time() . rand(1111, 9999) . '.' . $this->data['qr_file']->getClientOriginalExtension();
            $this->data['qr_file']->move(public_path('uploads/refund-qr'), $filename);
            $qrFileName = 'uploads/refund-qr/' . $filename;
        }

        $data =  [
            "additional_information" => $this->data["additional_information"],
            "preferred_option_id" => $this->data["preferred_option"],
            "preferred_option_fields" => $this->data["preferred_option_fields"],
            "order_id" => $this->orderId,
            "status" => $this->defaultRefundStatus ?? '',
            "user_id" => auth()->id(),
            "qr_file" => $qrFileName,
        ];

        return $data;
    }


    private function requestItemProduct()
    {
        $this->products = SubOrderItem::query()
            ->with($this->with)
            ->whereRelation("product", "is_refundable", 1)
            ->whereIn('id', $this->itemIds)
            ->get();

        if ($this->products->count() !== count($this->itemIds)) {
            throw new \Exception("Some product items not found or not refundable.");
        }

        return $this->products;
    }

    private function prepareRequestItemData(): array
    {
        foreach ($this->data["request_item_id"] ?? [] as $item) {
            $this->itemIds[] = $item;

            $this->items[] = [
                "item_id" => $item,
                "quantity" => $this->data["refund_quantity"][$item] ?? 0,
                "reason" => $this->data["refund_reason"][$item] ?? 0
            ];
        }

        return $this->items;
    }
}
