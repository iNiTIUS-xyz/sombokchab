<?php

namespace Modules\MobileApp\Http\Controllers\Api\V1;

use App\MobileCategory;
use Illuminate\Routing\Controller;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Http\Resources\CategoryResource;

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

        $categories = Category::query()
            ->select('id', 'name')
            ->where('status_id', 1)
            ->whereIn('id', $categoryIds)
            ->whereExists(function ($q) {
                $q->selectRaw(1)
                ->from('products')
                ->whereColumn('products.category_id', 'categories.id')
                ->limit(1);
            }) // faster than whereHas
            ->with([
                'subcategories' => function ($q) {
                    $q->select('id', 'name', 'image_id', 'category_id')
                    ->where('status_id', 1)
                    ->inRandomOrder()
                    ->limit(4)
                    ->with('image:id,path');
                }
            ])
            ->orderBy('name')
            ->get()
            ->map(function ($category) {
                $category->subcategories->transform(function ($sub) {
                    $sub->image_url = $sub->image
                        ? render_image($sub->image, render_type: 'path')
                        : null;

                    unset($sub->image, $sub->image_id);
                    return $sub;
                });

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
