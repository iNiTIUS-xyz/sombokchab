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
use Modules\Attributes\Entities\ChildCategory;
use Modules\Attributes\Http\Requests\ChildCategoryStoreRequest;
use Modules\Attributes\Http\Requests\ChildCategoryUpdateRequest;

class ChildCategoryController extends Controller
{

    public function index(): View|Factory|Application
    {
        $all_category = Category::all();
        $all_child_category = ChildCategory::with("sub_category", "category", "image", "status")->paginate(20);

        return view('attributes::backend.child-category.all', compact('all_category', 'all_child_category'));
    }

    public function store(ChildCategoryStoreRequest $request): RedirectResponse
    {

        $data = $request->validated();
        $data['slug'] = strtolower(str_replace(' ', '-', $request->name));

        $subCategoryExit = ChildCategory::query()
            ->where('name', $request->name)
            ->first();

        if ($subCategoryExit) {
            return back()->with([
                'type' => 'danger',
                'msg' => __('Child category already exist with this name.')
            ]);
        }

        $product_category = ChildCategory::create($data);

        return $product_category->id
            ? back()->with(FlashMsg::create_succeed(__('Product Child-Category')))
            : back()->with(FlashMsg::create_failed(__('Product Child-Category')));
    }

    public function update(ChildCategoryUpdateRequest $request)
    {

        $data = $request->validated();
        $data['slug'] = strtolower(str_replace(' ', '-', $request->name));

        $subCategoryExit = ChildCategory::query()
            ->where('id', '!=', $request->id)
            ->where('name', $request->name)
            ->first();

        if ($subCategoryExit) {
            return back()->with([
                'type' => 'danger',
                'msg' => __('Child category already exist with this name.')
            ]);
        }

        $updated = ChildCategory::query()
            ->where("id", $request->id)
            ->update($data);

        return $updated ? back()->with(FlashMsg::update_succeed(__('Product Child Category'))) : back()->with(FlashMsg::update_failed(__('Product Child-Category')));
    }

    public function destroy(ChildCategory $item): ?bool
    {
        return $item->delete();
    }

    public function bulk_action(Request $request): JsonResponse
    {
        ChildCategory::WhereIn('id', $request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function getSubcategoriesOfCategory($id): JsonResponse
    {
        $all_subcategory = ChildCategory::where('category_id', $id)
            ->select("id", "name")->get();
        return response()->json($all_subcategory);
    }
}
