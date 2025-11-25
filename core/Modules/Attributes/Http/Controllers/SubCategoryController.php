<?php

namespace Modules\Attributes\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Entities\SubCategory;
use Modules\Attributes\Http\Requests\StoreSubCategoryRequest;
use Modules\Attributes\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller {

    public function index(): View | Factory | Application {
        $all_category = Category::query()
            ->with(["image:id,path", "status"])
            ->latest()
            ->get();
        $all_sub_category = SubCategory::query()
            ->with("image:id,path", "status", "category:id,name")
            ->latest()
            ->get();

        return view('attributes::backend.sub_category.all', compact(['all_category', "all_sub_category"]));
    }

    public function store(StoreSubCategoryRequest $request) {
        $data = $request->validated();
        $data['slug'] = strtolower(str_replace(' ', '-', $request->name));

        $subCategoryExit = SubCategory::query()
            ->where('name', $request->name)
            ->first();

        if ($subCategoryExit) {
            return back()->with([
                'alert-type' => 'error',
                'message'    => __('Sub Category already exist with this name.'),
            ]);
        }

        $product_category = SubCategory::create($data);

        return $product_category
        ? back()->with([
            'message'    => 'Product Sub Category Created Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Product Sub Category Creation failed.',
            'alert-type' => 'error',
        ]);
    }

    public function update(UpdateSubCategoryRequest $request) {
        $data = $request->validated();
        $data['slug'] = strtolower(str_replace(' ', '-', $request->name));

        $subCategoryExit = SubCategory::query()
            ->where('id', '!=', $request->id)
            ->where('name', $request->name)
            ->first();

        if ($subCategoryExit) {
            return back()->with([
                'alert-type' => 'danger',
                'message'    => __('Sub Category already exist with this name.'),
            ]);
        }

        $updated = SubCategory::find($request->id)->update($data);

        return $updated
        ? back()->with([
            'message'    => 'Product Sub Category Updated Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Product Sub Category Updating failed.',
            'alert-type' => 'error',
        ]);
    }

    public function destroy(SubCategory $item): ?bool {
        return $item->delete();
    }

    public function bulk_action(Request $request): JsonResponse {
        SubCategory::WhereIn('id', $request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function getSubcategoriesForSelect(Request $request) {
        $sub_category = SubCategory::where("category_id", $request->category_id)->get();
        $options = view("attributes::backend.sub_category.sub-category-option", compact("sub_category"))->render();
        $lists = view("attributes::backend.sub_category.sub_category-list", compact("sub_category"))->render();

        return response()->json(["option" => $options, "list" => $lists]);
    }

    public function statusChange(Request $request, $id) {
        SubCategory::where('id', $id)->update([
            'status_id' => $request->status,
        ]);

        return redirect()->back()->with([
            'message'    => __('Sub Category status changed successfully.'),
            'alert-type' => 'success',
        ]);
    }
}
