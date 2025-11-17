<?php

namespace Modules\Attributes\Http\Controllers;

use App\Helpers\FlashMsg;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Attributes\Entities\ProductAttribute;
use Modules\Attributes\Http\Services\DummyAttributeDeleteServices;
use DB;

class AttributesController extends Controller
{
    private const BASE_PATH = 'attributes::backend.attribute.';


    public function index(): Application|Factory|View
    {
        $all_attributes = ProductAttribute::query()
            ->latest()
            ->all();
        $ids = DummyAttributeDeleteServices::dummyAttributeId();
        $dummyCount = DB::table('product_attributes')->whereIn('id', $ids)->count();
        return view(self::BASE_PATH . "all-attribute", compact('all_attributes', 'dummyCount'));
    }


    public function create(): View|Factory|Application
    {
        return view(self::BASE_PATH . 'new-attribute');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'terms' => 'required|array',
        ]);

        $product_attribute = ProductAttribute::create([
            'title' => $request->title,
            'terms' => json_encode($request->terms)
        ]);

        return $product_attribute->id
            ? back()->with(FlashMsg::create_succeed('Product Attribute'))
            : back()->with(FlashMsg::create_failed('Product Attribute'));
    }


    public function edit(ProductAttribute $item)
    {
        return view(self::BASE_PATH . 'edit-attribute')->with(['attribute' => $item]);
    }


    public function update(Request $request, ProductAttribute $productAttribute): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'terms' => 'required|array',
        ]);
        $updated = ProductAttribute::find($request->id)->update([
            'title' => $request->title,
            'terms' => json_encode($request->terms)
        ]);

        return $updated
            ? back()->with(FlashMsg::update_succeed('Product Attribute'))
            : back()->with(FlashMsg::update_failed('Product Attribute'));
    }


    public function destroy(ProductAttribute $item): ?bool
    {
        return $item->delete();
    }


    public function bulk_action(Request $request)
    {
        ProductAttribute::whereIn('id', $request->ids)->delete();
        return back()->with(FlashMsg::item_delete());
    }



    public function get_details(Request $request): JsonResponse
    {
        $variant = ProductAttribute::findOrFail($request->id);
        return response()->json($variant);
    }
    public function delete_dummy_attribute()
    {
        $delete = DummyAttributeDeleteServices::destroy();
        if ($delete) {
            return response()->json(['success' => true, 'type' => 'success']);
        }
        return response()->json(['success' => false, 'type' => 'danger']);
    }
}
