<?php

namespace Modules\Attributes\Http\Controllers;

use App\Helpers\FlashMsg;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Entities\SubCategory;
use Modules\Attributes\Http\Requests\StoreSubCategoryRequest;
use Modules\Attributes\Http\Requests\UpdateCategoryRequest;
use Modules\Attributes\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{

    public function index(): View|Factory|Application
    {
        $all_category = Category::with(["image:id,path", "status"])->get();
        $all_sub_category = SubCategory::with("image:id,path", "status", "category:id,name")->get();

        return view('attributes::backend.sub_category.all', compact(['all_category', "all_sub_category"]));
    }

    public function store(StoreSubCategoryRequest $request): RedirectResponse
    {
        $product_category = SubCategory::create($request->validated());

        return $product_category
            ? back()->with(FlashMsg::create_succeed(__('Product sub category')))
            : back()->with(FlashMsg::create_failed(__('Product sub category')));
    }

    public function update(UpdateSubCategoryRequest $request): RedirectResponse
    {
        $updated = SubCategory::find($request->id)->update($request->validated());

        return $updated
            ? back()->with(FlashMsg::update_succeed(__('Product sub category')))
            : back()->with(FlashMsg::update_failed(__('Product sub category')));
    }

    public function destroy(SubCategory $item): ?bool
    {
        return $item->delete();
    }

    public function bulk_action(Request $request): JsonResponse
    {
        SubCategory::WhereIn('id', $request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function getSubcategoriesForSelect(Request $request)
    {
        $sub_category = SubCategory::where("category_id", $request->category_id)->get();
        $options = view("attributes::backend.sub_category.sub-category-option", compact("sub_category"))->render();
        $lists = view("attributes::backend.sub_category.sub_category-list", compact("sub_category"))->render();

        return response()->json(["option" => $options, "list" => $lists]);
    }
}
