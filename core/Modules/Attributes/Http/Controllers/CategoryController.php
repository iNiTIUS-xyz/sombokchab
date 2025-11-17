<?php

namespace Modules\Attributes\Http\Controllers;

use App\Helpers\FlashMsg;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Http\Requests\StoreCategoryRequest;
use Modules\Attributes\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

    public function index(): View|Factory|Application
    {
        $all_category = Category::query()
            ->with(["image:id,path", "status"])
            ->latest()
            ->get();

        return view('attributes::backend.category.all')->with(['all_category' => $all_category]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = strtolower(str_replace(' ', '-', $request->name));

        $subCategoryExit = Category::query()
            ->where('name', $request->name)
            ->first();

        if ($subCategoryExit) {
            return back()->with([
                'type' => 'danger',
                'msg' => __('Category already exist with this name.')
            ]);
        }

        $product_category = Category::create($data);

        return $product_category
            ? back()->with(FlashMsg::create_succeed(__('Product Category')))
            : back()->with(FlashMsg::create_failed(__('Product Category')));
    }

    public function update(UpdateCategoryRequest $request)
    {

        $data = $request->validated();
        $data['slug'] = strtolower(str_replace(' ', '-', $request->name));

        $subCategoryExit = Category::query()
            ->where('id', '!=', $request->id)
            ->where('name', $request->name)
            ->first();

        if ($subCategoryExit) {
            return back()->with([
                'type' => 'danger',
                'msg' => __('Category already exist with this name.')
            ]);
        }

        $updated = Category::find($request->id)->update($data);

        return $updated
            ? back()->with(FlashMsg::update_succeed(__('Product Category')))
            : back()->with(FlashMsg::update_failed(__('Product Category')));
    }

    public function destroy(Category $item): ?bool
    {
        return $item->delete();
    }

    public function bulk_action(Request $request): JsonResponse
    {
        Category::WhereIn('id', $request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function statusChange(Request $request, $id)
    {
        Category::where('id', $id)->update([
            'status_id' => $request->status,
        ]);

        return redirect()->back()->with([
            'msg' => __('Category status changed successfully.'),
            'type' => 'success'
        ]);
    }
}
