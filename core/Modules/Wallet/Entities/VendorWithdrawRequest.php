<?php

namespace Modules\Wallet\Entities;

use App\Http\Traits\NotificationRelation;
use Illuminate\Database\Eloquent\Model;
use Modules\Vendor\Entities\Vendor;

class VendorWithdrawRequest extends Model
{
    use NotificationRelation;

    protected $fillable = [
        "amount",
        "gateway_id",
        "vendor_id",
        "request_status",
        "gateway_fields",
        "note",
        "image",
        "qr_file",
    ];

    public function gateway()
    {
        return $this->belongsTo(VendorWalletGateway::class, "gateway_id", "id");
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, "vendor_id", "vendor_id");
    }
}
