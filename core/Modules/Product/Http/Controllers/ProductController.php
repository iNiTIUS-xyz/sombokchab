<?php

namespace Modules\Product\Http\Controllers;

use App\Status;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
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
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\ProductGallery;
use Modules\Product\Entities\ProductSubCategory;
use Modules\Product\Http\Requests\ProductStoreRequest;
use Modules\Product\Http\Services\Admin\AdminProductServices;
use Modules\Product\Http\Services\Admin\DummyProductDeleteServices;
use Modules\TaxModule\Entities\TaxClass;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $products = AdminProductServices::productSearch($request, "admin");

        $statuses = Status::all();
        $categories = Category::get();
        $sub_categories = SubCategory::get();
        $brands = Brand::select(["id", "name"])->get();

        return view('product::index', compact("products", "statuses", "categories", "sub_categories", "brands"));
    }

    public function create()
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
            "image_id"        => "nullable",
            "product_gallery" => "nullable",
            "product_id"      => "required|exists:products,id",
        ]);

        // find product
        Product::findOrFail($data['product_id'])->update([
            'image_id' => $data['image_id'],
        ]);

        // update those value in product table
        if (!empty(($data["product_gallery"] ?? []) ?? ($data->product_gallery ?? []))) {
            ProductGallery::where("product_id", $data['product_id'])->delete();

            ProductGallery::insert((new AdminProductServices)->prepareProductGalleryData($data, $data['product_id']));
        }

        return response()->json([
            "type" => "success",
            "msg"  => __("Successfully updated product image"),
        ]);
    }

    public function show($id)
    {
        return view('product::show');
    }

    public function edit(int $id)
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

    public function clone($id)
    {
        return (new AdminProductServices)->clone($id)
            ? back()->with([
                'message'    => 'Product Cloned Successfully.',
                'alert-type' => 'success',
            ])
            : back()->with([
                'message'    => 'Product Cloning Failed.',
                'alert-type' => 'error',
            ]);
    }

    private function validateUpdateStatus($req)
    {
        return Validator::make($req, [
            "id"        => "required",
            "status_id" => "required",
        ])->validated();
    }

    public function update_status(Request $request)
    {
        $data = $this->validateUpdateStatus($request->all());

        $product = Product::findOrFail($data['id']);
        $product->status_id = $data['status_id'];
        $product->save();

        return redirect()->back()->with([
            'message'    => 'Status changed successfully.',
            'alert-type' => 'success',
        ]);
    }

    public function productStatusChange(Request $request, $id)
    {

        $product = Product::findOrFail($id);
        $product->product_status = $request->product_status;

        if ($request->product_status === 'rejected') {
            $product->status_id = 2;
        }

        $product->save();

        return redirect()->back()->with([
            'message'    => 'Product approval status changed successfully.',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        return (new AdminProductServices)->delete($id);
    }

    public function bulk_destroy(Request $request): JsonResponse
    {
        return response()->json((new AdminProductServices)->bulk_delete_action($request->ids) ? ["success" => true, "type" => "success"] : ["success" => false, "type" => "danger"]);
    }

    public function trash()
    {
        $products = Product::with('category', 'subCategory', 'childCategory', 'brand', 'inventory')->onlyTrashed()->get();
        return view('product::trash', compact("products"));
    }

    public function restore($id)
    {
        $restore = Product::onlyTrashed()->findOrFail($id)->restore();
        return back()->with(
            $restore
                ? [
                    'message' => 'Trash Product Restored Successfully.',
                    'alert-type' => 'success',
                ]
                : [
                    'message' => 'Trash Product Restore Failed.',
                    'alert-type' => 'success',
                ]
        );
    }

    public function trash_delete($id)
    {
        return (new AdminProductServices)->trash_delete($id)
            ? back()->with([
                'message'    => 'Trash Product Deleted Successfully.',
                'alert-type' => 'success',
            ])
            : back()->with([
                'message'    => 'Trash Product Deleting Failed.',
                'alert-type' => 'error',
            ]);
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
            "brands"          => Brand::select("id", "name")->get(),
            "badges"          => Badge::where("status", "active")->get(),
            "units"           => Unit::select("id", "name")->get(),
            "tags"            => Tag::select("id", "tag_text as name")->get(),
            "categories"      => Category::select("id", "name")->get(),
            "deliveryOptions" => DeliveryOption::select("id", "title", "sub_title", "icon")->get(),
            "all_attribute"   => ProductAttribute::all()->groupBy('title')->map(fn($query) => $query[0]),
            "product_colors"  => Color::all(),
            "product_sizes"   => Size::all(),
            "tax_classes"     => TaxClass::all(),
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
        try {

            if ($request->type === 'delete') {
                return response()->json((new AdminProductServices)->bulk_delete_action($request->ids) ? ["success" => true, "type" => "success"] : ["success" => false, "type" => "danger"]);
            }

            $products = Product::query()
                ->select(['id', 'status_id'])
                ->whereIn('id', $request->ids)
                ->get();

            foreach ($products as $product) {
                $updateProduct = Product::findOrFail($product->id);
                $updateProduct->status_id = $request->type === 'active' ? 1 : 2;
                $updateProduct->save();
            }

            return response()->json([
                'success' => true,
                'type'    => 'success',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'msg'    => $e->getMessage()
            ]);
        }
    }

    public function productImport()
    {
        return view('product::product_import');
    }

    public function importProduct(Request $request)
    {
        try {

            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:xlsx,csv,txt|max:2048',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $file = $request->file('file');

            $data = Excel::toArray([], $file);

            if (!empty($data) && count($data) > 0) {

                $rows = $data[0];

                foreach ($rows as $index => $row) {

                    if ($index == 0) {
                        continue;
                    }

                    $brand = Brand::firstOrCreate(
                        ['name' => $row[3]]
                    );

                    $taxClasess = TaxClass::firstOrCreate(
                        ['name' => $row[17]]
                    );

                    $product = Product::create([
                        "name"                   => $row[0],
                        "slug"                   => strtolower(str_replace(' ', '-', $row[0])),
                        "brand_id"               => $brand->id ?? null,
                        "summary"                => $row[4],
                        "description"            => $row[5],
                        "price"                  => $row[6],
                        "sale_price"             => $row[7],
                        "cost"                   => $row[8],
                        "status_id"              => $row[9] == 1 ? 1 : 2,
                        "product_type"           => $row[10] == 1 ? 1 : 2,
                        "min_purchase"           => $row[11],
                        "max_purchase"           => $row[12],
                        "is_inventory_warn_able" => $row[13] == 1 ? 1 : 2,
                        "is_refundable"          => $row[14] == 1 ? 1 : 0,
                        "is_in_house"            => $row[15] == 1 ? 1 : 0,
                        "admin_id"               => auth('admin')->user()->id,
                        "is_taxable"             => $row[16] == 1 ? 1 : 0,
                        "tax_class_id"           => $taxClasess->id,
                    ]);

                    $category = Category::firstOrCreate(
                        ['name' => $row[1]]
                    );

                    $productCategory = new ProductCategory();
                    $productCategory->product_id = $product->id;
                    $productCategory->category_id = $category->id;
                    $productCategory->save();

                    $subCategory = SubCategory::firstOrCreate(
                        ['name' => $row[2]]
                    );

                    $productSubCategory = new ProductSubCategory();
                    $productSubCategory->product_id = $product->id;
                    $productSubCategory->sub_category_id = $subCategory->id;
                    $productSubCategory->save();
                }
            }

            DB::commit();

            return redirect()->back()->with([
                'alert-type' => 'success',
                'message'    => 'Products imported successfully!',
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with([
                'alert-type' => 'error',
                'message'    => 'Import failed: ' . $e->getMessage(),
            ]);
        }
    }
}
