<?php

namespace Modules\Attributes\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Attributes\Entities\ProductAttribute;
use Modules\Attributes\Http\Services\DummyAttributeDeleteServices;

class AttributesController extends Controller {
    private const BASE_PATH = 'attributes::backend.attribute.';

    public function index(): Application | Factory | View {
        $all_attributes = ProductAttribute::query()
            ->latest()
            ->get();
        $ids = DummyAttributeDeleteServices::dummyAttributeId();
        $dummyCount = DB::table('product_attributes')->whereIn('id', $ids)->count();
        return view(self::BASE_PATH . "all-attribute", compact('all_attributes', 'dummyCount'));
    }

    public function create(): View | Factory | Application {
        return view(self::BASE_PATH . 'new-attribute');
    }

    public function store(Request $request) {
        $request->validate([
            'title'    => 'required|string',
            'title_km' => 'required|string',
            'terms'    => 'required|array',
            'terms_km' => 'required|array',
        ]);

        $product_attribute = ProductAttribute::create([
            'title'    => $request->title,
            'title_km' => $request->title_km,
            'terms'    => json_encode($request->terms),
            'terms_km' => json_encode($request->terms_km),
        ]);

        return $product_attribute->id
        ? back()->with([
            'message'    => 'Product Attribute Created Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Product Attribute Creation Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function edit(ProductAttribute $item) {
        return view(self::BASE_PATH . 'edit-attribute')->with(['attribute' => $item]);
    }

    public function update(Request $request, ProductAttribute $productAttribute): RedirectResponse {
        $request->validate([
            'title'    => 'required|string',
            'title_km' => 'required|string',
            'terms'    => 'required|array',
            'terms_km' => 'required|array',
        ]);

        $updated = ProductAttribute::find($request->id)->update([
            'title'    => $request->title,
            'title_km' => $request->title_km,
            'terms'    => json_encode($request->terms),
            'terms_km' => json_encode($request->terms_km),
        ]);

        return $updated
        ? back()->with([
            'message'    => 'Product Attribute Updated Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Product Attribute Updating Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function destroy(ProductAttribute $item): ?bool {
        return $item->delete();
    }

    public function bulk_action(Request $request) {
        ProductAttribute::whereIn('id', $request->ids)->delete();
        return back()->with([
            'message'    => 'Product Attribute Deleted Successfully.',
            'alert-type' => 'success',
        ]);
    }

    public function get_details(Request $request): JsonResponse {
        $variant = ProductAttribute::findOrFail($request->id);
        return response()->json($variant);
    }

    public function delete_dummy_attribute() {
        $delete = DummyAttributeDeleteServices::destroy();
        if ($delete) {
            return response()->json(['success' => true, 'type' => 'success']);
        }
        return response()->json(['success' => false, 'type' => 'danger']);
    }
}
