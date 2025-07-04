<?php

namespace Modules\Inventory\Http\Controllers;

use App\Helpers\FlashMsg;
use Illuminate\Http\JsonResponse;
use Modules\Attributes\Entities\Color;
use Modules\Attributes\Entities\Size;
use Modules\Product\Entities\ProductInventoryDetails;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attributes\Entities\Brand;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Entities\DeliveryOption;
use Modules\Attributes\Entities\Tag;
use Modules\Attributes\Entities\Unit;
use Modules\Badge\Entities\Badge;
use Modules\Inventory\Http\Requests\UpdateInventoryRequest;
use Modules\Inventory\Http\Services\Backend\InventoryServices;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductAttribute;
use Modules\Product\Entities\ProductInventory;
use Modules\Product\Http\Services\Admin\AdminProductServices;
use Throwable;

class InventoryController extends Controller
{

    public function index()
    {
        $all_inventory_products = InventoryServices::fetch_inventory_product()->get();
        return view('inventory::backend.all', compact('all_inventory_products'));
    }

    public function edit(ProductInventory $item)
    {

        $data = [
            "brands" => Brand::select("id", "name")->get(),
            "badges" => Badge::where("status", "active")->get(),
            "units" => Unit::select("id", "name")->get(),
            "tags" => Tag::select("id", "tag_text as name")->get(),
            "categories" => Category::select("id", "name")->get(),
            "deliveryOptions" => DeliveryOption::select("id", "title", "sub_title", "icon")->get(),
            "all_attribute" => ProductAttribute::all()->groupBy('title')->map(fn($query) => $query[0]),
            "product_colors" => Color::all(),
            "product_sizes" => Size::all(),
        ];

        $inventory = $item->where('id', $item->id)->with('inventoryDetails')->first();
        $all_products = Product::all();
        $all_attribute = ProductAttribute::all()->groupBy('title')->map(fn($query) => $query[0]);
        $product_colors = Color::all();
        $product_sizes = Size::all();
        $product = (new AdminProductServices)->get_edit_product($item->product_id);

        return view('inventory::backend.edit')->with([
            'inventory' => $inventory,
            'all_products' => $all_products,
            'all_attributes' => $all_attribute,
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'data' => $data,
            'product' => $product
        ]);
    }

    public function update(UpdateInventoryRequest $request)
    {

        (new InventoryServices)->update($request->validated());

        return response()->json(FlashMsg::update_succeed(__('Product Inventory')));

    }

    public function destroy(Request $request)
    {
        $id = $request->query('id');
        $productInventory = ProductInventory::find($id);
        if ($productInventory) {
            $productInventory->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => __('Product inventory not found')], 404);
    }

    public function bulk_action(Request $request)
    {
        $deleted = ProductInventory::whereIn('id', $request->ids)->delete();
        if ($deleted) {
            back()->with(FlashMsg::delete_succeed(__('Product Inventory')));
        }
        return back()->with(FlashMsg::delete_failed(__('Product Inventory')));
    }

    private function insertInventoryDetails($inventory_id, $inventory_details)
    {
        foreach ($inventory_details as $details) {
            $product_inventory_details = ProductInventoryDetails::create([
                'inventory_id' => $inventory_id,
                'attribute_id' => $details['attribute_id'],
                'attribute_value' => $details['attribute_value'],
                'stock_count' => $details['stock_count'],
            ]);
        }
        return true;
    }

    private function deleteAllDetailsOfInventory($inventory_id)
    {
        return (bool) ProductInventoryDetails::where('inventory_id', $inventory_id)->delete();
    }
}
