<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $fillable = ["sub_category_id","product_id"];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductSubCategoryFactory::new();
    }
}
