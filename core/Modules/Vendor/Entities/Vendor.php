<?php

namespace Modules\Vendor\Entities;

use App\Http\Traits\NotificationRelation;
use App\MediaUpload;
use App\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\SubOrder;
use Modules\Order\Entities\SubOrderItem;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductRating;
use Modules\ShippingModule\Entities\VendorShippingMethod;
use Modules\Vendor\Database\factories\VendorFactory;
use Modules\Wallet\Entities\Wallet;

class Vendor extends Authenticatable {
    use SoftDeletes;
    use HasApiTokens;
    use NotificationRelation;
    use HasFactory;

    protected $with = ["status"];

    protected $fillable = [
        "owner_name",
        "username",
        "password",
        "business_name",
        "business_type_id",
        "tax_id",
        "description",
        "description_km",
        "status_id",
        "email",
        "email_verified",
        "email_verify_token",
        "phone",
        "is_vendor_verified",
        "verified_at",
        "passport_or_nid",
        "commission_type",
        "commission_amount",
        "check_online_status",
        "firebase_device_token",
    ];

    protected $casts = [
        "check_online_status" => "datetime",
    ];

    public function vendor_address() {
        return $this->hasOne(VendorAddress::class);
    }

    public function shippingMethod() {
        return $this->hasMany(VendorShippingMethod::class, "vendor_id", "id");
    }

    public function product() {
        return $this->hasMany(Product::class, "vendor_id", "id");
    }

    public function vendorProductRating() {
        return $this->hasManyThrough(ProductRating::class, Product::class, "vendor_id", "product_id", "id", "id");
    }

    public function vendor_shop_info() {
        return $this->hasOne(VendorShopInfo::class);
    }

    public function vendor_bank_info() {
        return $this->hasOne(VendorBankInfo::class);
    }

    public function business_type(): BelongsTo {
        return $this->belongsTo(BusinessType::class);
    }

    public function status(): BelongsTo {
        return $this->belongsTo(Status::class);
    }

    public function wallet() {
        return $this->hasOne(Wallet::class, "vendor_id", "id");
    }

    public function logo() {
        return $this->hasOneThrough(MediaUpload::class, VendorShopInfo::class, "vendor_id", "id", "id", "logo_id");
    }

    public function cover_photo() {
        return $this->hasOneThrough(
            MediaUpload::class,
            VendorShopInfo::class,
            "vendor_id",
            "id",
            "id",
            "cover_photo_id"
        );
    }

    public function subOrder() {
        return $this->hasMany(SubOrder::class, "vendor_id", "id");
    }

    public function order() {
        return $this->hasManyThrough(Order::class, SubOrder::class, "vendor_id", "id", "id", "id");
    }

    public function orderItems() {
        return $this->hasManyThrough(SubOrderItem::class, SubOrder::class, "vendor_id", "sub_order_id", "id", "id");
    }

    protected $hidden = [
        "password",
        "remember_token",
    ];

    protected static function newFactory() {
        return VendorFactory::new ();
    }
}
