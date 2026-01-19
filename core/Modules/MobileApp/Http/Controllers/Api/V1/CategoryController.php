<?php

namespace Modules\MobileApp\Http\Controllers\Api\V1;

use App\MobileCategory;
use Illuminate\Routing\Controller;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Http\Resources\CategoryResource;
use Modules\Product\Entities\ProductCategory;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /* 
    * fetch all country list from database
    */
    public function allCategory()
    {

        $selectedCategory = MobileCategory::query()->first();

        $categoryIds = $selectedCategory ? json_decode($selectedCategory->category_ids, true) : [];

        $categories = Category::query()
            ->when(isset($selectedCategory) && $categoryIds, function ($q) use ($categoryIds) {
                $q->whereIn('id', $categoryIds);
            })
            ->select("id", "name", "image_id")
            ->with("image")
            ->where('status_id', 1)
            ->whereHas("product")
            ->orderBy('name', 'asc')->get()
            ->transform(function ($item) {
                $image_url = null;
                if (!empty($item->image_id)) {
                    $image_url = render_image($item->image, render_type: 'path');
                }

                $item->image_url = $image_url ?: null;
                unset($item->image);
                unset($item->image_id);
                return $item;
            });

        return response()->json([
            "categories" => $categories,
            "success" => true,
        ]);
    }

    /* 
    * fetch all state list based on provided country id from database
    */
    public function singleCategory($id)
    {
        if (empty($id)) {
            return response()->json([
                'message' => __('provide a valid id')
            ])->setStatusCode(422);
        }

        $categories = Category::select('id', 'name', 'image_id')->with("image")->where('id', $id)->first();

        $image_url = null;
        if (!empty($categories->image_id)) {
            $image_url = render_image($categories->image, render_type: 'path');
        }
        $categories->image_url = $image_url ?: null;
        unset($categories->image);


        return response()->json([
            "category" => $categories,
            "success" => true,
        ]);
    }

    public function allCategories()
    {
        // before change please mind it this method is also used on vendor api
        return CategoryResource::collection(Category::with("image", "subcategory", "subcategory.image", "subcategory.childcategory", "subcategory.childcategory.image")->get());
    }

    public function selectedCategoriesWithSubcategories()
    {
        $selectedCategory = MobileCategory::select('category_ids')->first();

        $categoryIds = $selectedCategory
            ? json_decode($selectedCategory->category_ids, true)
            : [];

        if (empty($categoryIds)) {
            return response()->json([
                'selected_category' => [
                    'title' => 'Selected Categories',
                    'categories' => [],
                ],
                'success' => true,
            ]);
        }

        /** -----------------------------
         * Load categories
         * ---------------------------- */
        $categories = Category::query()
            ->select('id', 'name')
            ->where('status_id', 1)
            ->whereIn('id', $categoryIds)
            ->whereExists(function ($q) {
                $q->selectRaw(1)
                ->from((new ProductCategory)->getTable())
                ->whereColumn('product_categories.category_id', 'categories.id')
                ->limit(1);
            })
            ->orderBy('name')
            ->get();

        /** -----------------------------
         * Load ALL subcategories (one query)
         * ---------------------------- */
        $allSubcategories = DB::table('sub_categories')
            ->select('id', 'name', 'image_id', 'category_id')
            ->where('status_id', 1)
            ->whereIn('category_id', $categories->pluck('id'))
            ->get()
            ->groupBy('category_id');

        /** -----------------------------
         * Attach 4 RANDOM per category (PHP-side)
         * ---------------------------- */
        $categories->transform(function ($category) use ($allSubcategories) {

            $subs = $allSubcategories[$category->id] ?? collect();

            $category->subcategory = $subs
                ->shuffle()
                ->take(4)
                ->map(function ($sub) {
                    return [
                        'id' => $sub->id,
                        'name' => $sub->name,
                        'category_id' => $sub->category_id,
                        'image_url' => !empty($sub->image_id)
                            ? render_image($sub->image_id, render_type: 'path')
                            : null,
                    ];
                })
                ->values();

            return $category;
        });

        return response()->json([
            'selected_category' => [
                'title' => 'Selected Categories',
                'categories' => $categories,
            ],
            'success' => true,
        ]);
    }


}
