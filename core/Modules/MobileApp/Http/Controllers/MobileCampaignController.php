<?php

namespace Modules\MobileApp\Http\Controllers;

use App\MobileProduct;
use App\MobileCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;
use Modules\Campaign\Entities\Campaign;
use Modules\Attributes\Entities\Category;
use Modules\MobileApp\Entities\MobileCampaign;

class MobileCampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth:admin"]);
    }

    public function index()
    {
        $campaigns = Campaign::latest()->get();
        $selectedCampaign = MobileCampaign::first();

        return view("mobileapp::mobile-campaign.create", compact('campaigns', 'selectedCampaign'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'campaign_ids' => 'required|array',
                'limit' => 'required|integer',
            ]);

            DB::beginTransaction();

            MobileCampaign::updateOrCreate(
                ['id' => 1],
                [
                    'campaign_ids' => json_encode($request->campaign_ids),
                    'limit' => $request->limit,
                ]
            );

            DB::commit();

            return back()->with([
                'alert-type' => 'success',
                'message' => 'Mobile campaign updated successfully.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with([
                'alert-type' => 'error',
                'message' => 'Something went wrong. Please try again.',
            ]);
        }
    }
    public function category()
    {
        $categories = Category::latest()->get();
        $selectedCategory = MobileCategory::first();

        return view("mobileapp::mobile-category.create", compact('categories', 'selectedCategory'));
    }

    public function categoryUpdate(Request $request)
    {
        try {
            $request->validate([
                'category_ids' => 'required|array',
                'limit' => 'required|integer',
            ]);

            DB::beginTransaction();

            MobileCategory::updateOrCreate(
                ['id' => 1],
                [
                    'category_ids' => json_encode($request->category_ids),
                    'limit' => $request->limit,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            DB::commit();

            return back()->with([
                'alert-type' => 'success',
                'message' => 'Mobile category updated successfully.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with([
                'alert-type' => 'error',
                'message' => 'Something went wrong. Please try again.',
            ]);
        }
    }
    public function product()
    {
        $products = Product::latest()->get();
        $selectedProduct = MobileProduct::first();

        return view("mobileapp::mobile-product.create", compact('products', 'selectedProduct'));
    }

    public function productUpdate(Request $request)
    {
        try {
            $request->validate([
                'product_ids' => 'required|array',
                'limit' => 'required|integer',
            ]);

            DB::beginTransaction();

            MobileProduct::updateOrCreate(
                ['id' => 1],
                [
                    'product_ids' => json_encode($request->product_ids),
                    'limit' => $request->limit,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            DB::commit();

            return back()->with([
                'alert-type' => 'success',
                'message' => 'Mobile product updated successfully.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with([
                'alert-type' => 'error',
                'message' => 'Something went wrong. Please try again.',
            ]);
        }
    }
}
