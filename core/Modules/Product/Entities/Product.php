<?php

namespace Modules\Product\Entities;

use App\Http\Traits\NotificationRelation;
use App\MediaUpload;
use App\MetaData;
use App\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Attributes\Entities\Brand;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Entities\ChildCategory;
use Modules\Attributes\Entities\Color;
use Modules\Attributes\Entities\DeliveryOption;
use Modules\Attributes\Entities\Size;
use Modules\Attributes\Entities\SubCategory;
use Modules\Badge\Entities\Badge;
use Modules\Campaign\Entities\CampaignProduct;
use Modules\Campaign\Entities\CampaignSoldProduct;
use Modules\Order\Entities\SubOrderItem;
use Modules\TaxModule\Entities\TaxClass;
use Modules\TaxModule\Entities\TaxClassOption;
use Modules\Vendor\Entities\Vendor;
use Modules\Vendor\Entities\VendorAddress;
class Product extends Model
{
    use SoftDeletes, NotificationRelation;

    protected $with = ["image","badge","uom","uom.unit"];
    protected $fillable = ["name","slug","summary","description","brand_id","status_id","cost","price","sale_price","image_id","badge_id","min_purchase","max_purchase","is_refundable","is_inventory_warn_able","is_in_house","admin_id","vendor_id","is_taxable","tax_class_id", "product_status"];

    public function category() : HasOneThrough
    {
        return $this->hasOneThrough(Category::class,ProductCategory::class,'product_id','id','id','category_id');
    }

    public function subCategory(): HasOneThrough
    {
        return $this->hasOneThrough(SubCategory::class,ProductSubCategory::class,"product_id","id","id","sub_category_id");
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'product_sub_categories', 'product_id', 'sub_category_id');
    }
    
    public function taxOptions() : HasManyThrough
    {
        return $this->hasManyThrough(TaxClassOption::class,TaxClass::class,'id','class_id','tax_class_id','id');
    }

    public function manySubCategory(): HasManyThrough
    {
        return $this->hasManyThrough(SubCategory::class,ProductSubCategory::class,"product_id","id","id","sub_category_id");
    }
    public function childCategory(): hasManyThrough
    {
        return $this->hasManyThrough(ChildCategory::class, ProductChildCategory::class,"product_id","id","id","child_category_id");
    }
    public function childCategorySingle(): HasOneThrough
    {
        return $this->hasOneThrough(ChildCategory::class, ProductChildCategory::class,"product_id","id","id","child_category_id");
    }

    // this is changed old version is above this line
    public function color(): HasManyThrough
    {
        return $this->hasManyThrough(Color::class,ProductInventoryDetail::class,"product_id","id","id","color");
    }

    public function vendor(): HasOne
    {
        return $this->hasOne(Vendor::class, "id", "vendor_id");
    }

    public function vendorAddress(): HasOneThrough
    {
        return $this->hasOneThrough(VendorAddress::class, Vendor::class,"id","vendor_id","vendor_id","id");
    }

    public function vendor_product(): HasMany
    {
        return $this->hasMany(Vendor::class, "id", "vendor_id");
    }

    //    this is changed an old version is above this line
    public function size(): HasManyThrough
    {
        return $this->hasManyThrough(Size::class,ProductInventoryDetail::class,"product_id","id","id","size");
    }

    public function productDeliveryOption(): hasManyThrough
    {
        return $this->hasManyThrough(DeliveryOption::class, ProductDeliveryOption::class,"product_id","id","id","delivery_option_id");
    }

    public function brand() : hasOne
    {
        return $this->hasOne(Brand::class,"id","brand_id");
    }

    public function status() : hasOne
    {
        return $this->hasOne(Status::class,"id","status_id");
    }

    public function badge() : hasOne
    {
        return $this->hasOne(Badge::class, "id","badge_id");
    }

    public function metaData(): MorphOne
    {
        return $this->morphOne(MetaData::class,"meta_taggable");
    }

    public function image(): hasOne
    {
        return $this->hasOne(MediaUpload::class,"id","image_id");
    }

    public function inventory(): hasOne
    {
        return $this->hasOne(ProductInventory::class,"product_id","id");
    }

    public function product_category(){
        return $this->hasOne(ProductCategory::class,"product_id","id");
    }

    public function product_sub_category(): HasOne
    {
        return $this->hasOne(ProductSubCategory::class,"product_id","id");
    }

    public function delivery_option(): hasMany
    {
        return $this->hasMany(ProductDeliveryOption::class,"product_id","id");
    }

    public function product_child_category() : hasMany
    {
        return $this->hasMany(ProductChildCategory::class,"product_id","id");
    }

    public function product_gallery() : hasMany
    {
        return $this->hasMany(ProductGallery::class,"product_id","id");
    }

    public function inventoryDetail() : hasMany
    {
        return $this->hasMany(ProductInventoryDetail::class,"product_id","id");
    }

    public function uom() : hasOne
    {
        return $this->hasOne(ProductUom::class,"product_id","id");
    }

    public function tag() : hasMany
    {
        return $this->hasMany(ProductTag::class, "product_id","id");
    }

    public function gallery_images(): HasManyThrough
    {
        return $this->hasManyThrough(MediaUpload::class, ProductGallery::class,"product_id","id","id","image_id");
    }

    public function campaign_sold_product(): HasOne
    {
        return $this->hasOne(CampaignSoldProduct::class,"product_id","id");
    }

    public function campaign_product(): HasOne
    {
        return $this->hasOne(CampaignProduct::class,"product_id","id");
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(ProductRating::class,"product_id","id");
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductRating::class,"product_id","id");
    }

    function ratingCount() {
        return $this->ratings->count();
    }

    public function orderItems(){
        return $this->hasMany(SubOrderItem::class,"product_id", "id");
    }

    protected static function boot()
    {
        parent::boot(); //  Change the autogenerated stub

        static::updated(function (){
            \Log::info("Product model update event triggered");
        });
    }


    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    // }

    // public function subcategories()
    // {
    //     return $this->belongsToMany(ProductSubCategory::class, 'product_sub_category', 'product_id', 'sub_category_id');
    // }
}
