<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Attributes\Entities\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\factories\ProductSubCategoryFactory;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $fillable = ["sub_category_id","product_id"];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
    
    protected static function newFactory()
    {
        return ProductSubCategoryFactory::new();
    }
}
