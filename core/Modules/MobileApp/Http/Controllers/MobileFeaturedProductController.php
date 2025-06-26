<?php

namespace Modules\MobileApp\Http\Controllers;

use Modules\Attributes\Entities\Category;
use Modules\MobileApp\Entities\MobileFeaturedProduct;
use Modules\MobileApp\Http\Requests\StoreMobileFeaturedProductRequest;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;
use Illuminate\Routing\Controller;

class MobileFeaturedProductController extends Controller
{
    public function index()
    {
        $mobileFeaturedProducts = MobileFeaturedProduct::all();

        return view("mobileapp::mobile-featured-product.list", compact("mobileFeaturedProducts"));
    }

    public function create()
    {
        $categories = Category::select("id", "name")->get();
        $products = Product::select("id", "name")->get();
        $selectedProduct = MobileFeaturedProduct::first();

        return view("mobileapp::mobile-featured-product.create", compact(["products", "categories", "selectedProduct"]));
    }

    public function store(StoreMobileFeaturedProductRequest $request)
    {
        $bool = MobileFeaturedProduct::updateOrCreate(["id" => 1], $request->validated());

        return back()->with(['msg' => __('Feature product updated successfully.'), 'type' => 'success']);
    }

}
