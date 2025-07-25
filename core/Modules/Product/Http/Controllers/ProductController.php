<?php

namespace Modules\Product\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Attributes\Entities\Brand;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Entities\ChildCategory;
use Modules\Attributes\Entities\Color;
use Modules\Attributes\Entities\DeliveryOption;
use Modules\Attributes\Entities\Size;
use Modules\Attributes\Entities\SubCategory;
use Modules\Attributes\Entities\Tag;
use Modules\Attributes\Entities\Unit;
use Modules\Badge\Entities\Badge;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductAttribute;
use Modules\Product\Entities\ProductGallery;
use Modules\Product\Http\Requests\ProductStoreRequest;
use Modules\Product\Http\Services\Admin\AdminProductServices;
use Modules\Product\Http\Services\Admin\DummyProductDeleteServices;
use Modules\TaxModule\Entities\TaxClass;

class ProductController extends Controller
{

    public function index(Request $request): Renderable
    {
        $products = AdminProductServices::productSearch($request, "admin");

        $statuses = Status::all();

        return view('product::index', compact("products", "statuses"));
    }

    public function create(): Renderable
    {
        $data = $this->productData();

        return view('product::create', compact('data'));
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        return response()->json((new AdminProductServices)->store($data) ? ["success" => true, "type" => "success"] : ["success" => false, "type" => "danger"]);
    }

    public function updateImage(Request $request)
    {
        $data = $request->validate([
            "image_id" => "nullable",
            "product_gallery" => "nullable",
            "product_id" => "required|exists:products,id"
        ]);

        // find product
        Product::findOrFail($data['product_id'])->update([
            'image_id' => $data['image_id']
        ]);

        // update those value in product table
        if (!empty(($data["product_gallery"] ?? []) ?? ($data->product_gallery ?? []))) {
            ProductGallery::where("product_id", $data['product_id'])->delete();

            ProductGallery::insert((new AdminProductServices)->prepareProductGalleryData($data, $data['product_id']));
        }

        return response()->json([
            "type" => "success",
            "msg" => __("Successfully updated product image")
        ]);
    }

    public function show($id)
    {
        return view('product::show');
    }

    public function edit(int $id): Renderable
    {
        $data = $this->productData();

        $product = (new AdminProductServices)->get_edit_product($id, "single");

        $subCat = $product?->subCategory?->id ?? null;
        $cat = $product?->category?->id ?? null;

        $sub_categories = SubCategory::select("id", "name")->where("category_id", $cat)->where("status_id", 1)->get();
        $child_categories = ChildCategory::select("id", "name")->where("sub_category_id", $subCat)->where("status_id", 1)->get();

        return view('product::edit', compact("data", "product", "sub_categories", "child_categories"));
    }


    public function update(ProductStoreRequest $request, $id)
    {
        $data = $request->validated();

        return response()->json(
            (new AdminProductServices)->update($data, $id)
            ? ["success" => true, "type" => "success"]
            : ["success" => false, "type" => "danger"]
        );
    }

    public function clone($id): RedirectResponse
    {
        return (new AdminProductServices)->clone($id) ? back()->with(FlashMsg::clone_succeed('Product')) : back()->with(FlashMsg::clone_failed('Product'));
    }

    private function validateUpdateStatus($req)
    {
        return Validator::make($req, [
            "id" => "required",
            "status_id" => "required",
        ])->validated();
    }

    public function update_status(Request $request)
    {
        $data = $this->validateUpdateStatus($request->all());

        $product = Product::findOrFail($data['id']);
        $product->status_id = $data['status_id'];
        $product->save();

        return redirect()->back()->with(FlashMsg::item_new('Status changed successfully.'));
    }

    public function productStatusChange(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->product_status = $request->product_status;
        $product->save();

        return redirect()->back()->with(FlashMsg::item_new('Product Status changed successfully.'));
    }

    public function destroy($id)
    {
        return (new AdminProductServices)->delete($id);
    }

    public function bulk_destroy(Request $request): JsonResponse
    {
        return response()->json((new AdminProductServices)->bulk_delete_action($request->ids) ? ["success" => true, "type" => "success"] : ["success" => false, "type" => "danger"]);
    }

    public function trash(): Renderable
    {
        $products = Product::with('category', 'subCategory', 'childCategory', 'brand', 'inventory')->onlyTrashed()->get();
        return view('product::trash', compact("products"));
    }

    public function restore($id)
    {
        $restore = Product::onlyTrashed()->findOrFail($id)->restore();
        return back()->with($restore ? FlashMsg::restore_succeed('Trashed Product') : FlashMsg::restore_failed('Trashed Product'));
    }

    public function trash_delete($id)
    {
        return (new AdminProductServices)->trash_delete($id) ? back()->with(FlashMsg::delete_succeed('Trashed Product')) : back()->with(FlashMsg::delete_failed('Trashed Product'));
    }

    public function trash_bulk_destroy(Request $request)
    {
        return response()->json((new AdminProductServices)->trash_bulk_delete_action($request->ids) ? ["success" => true, "type" => "success"] : ["success" => false, "type" => "danger"]);
    }

    public function trash_empty(Request $request)
    {
        $ids = explode('|', $request->ids);
        return response()->json((new AdminProductServices)->trash_bulk_delete_action($ids) ? ["success" => true, "type" => "success"] : ["success" => false, "type" => "danger"]);
    }

    public function productSearch(Request $request): string
    {
        $products = AdminProductServices::productSearch($request);
        $statuses = Status::all();

        return view('product::search', compact("products", "statuses"))->render();
    }

    public function productData(): array
    {
        return [
            "brands" => Brand::select("id", "name")->get(),
            "badges" => Badge::where("status", "active")->get(),
            "units" => Unit::select("id", "name")->get(),
            "tags" => Tag::select("id", "tag_text as name")->get(),
            "categories" => Category::select("id", "name")->get(),
            "deliveryOptions" => DeliveryOption::select("id", "title", "sub_title", "icon")->get(),
            "all_attribute" => ProductAttribute::all()->groupBy('title')->map(fn($query) => $query[0]),
            "product_colors" => Color::all(),
            "product_sizes" => Size::all(),
            "tax_classes" => TaxClass::all(),
        ];
    }
    public function delete_dummy_product()
    {
        $delete = DummyProductDeleteServices::destroy();
        // $delete=true;
        if ($delete) {
            return response()->json(['success' => true, 'type' => 'success']);
        }
        return response()->json(['success' => false, 'type' => 'danger']);
    }

    public function bulkAction(Request $request)
    {
        $products = Product::query()
            ->select(['id', 'status_id'])
            ->whereIn('id', $request->ids)
            ->get();

        foreach ($products as $product) {
            $updateProduct = Product::findOrFail($product->id);
            $updateProduct->status_id = $request->status == 'active' ? 1 : 2;
            $updateProduct->save();
        }

        return response()->json([
            'status' => true,
            'msg' => 'Product successfully updated',
        ]);
    }
}
