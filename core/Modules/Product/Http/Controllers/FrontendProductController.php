<?php

namespace Modules\Product\Http\Controllers;

use App\Action\CartAction;
use App\Action\CompareAction;
use App\AdminShopManage;
use App\PaymentGateway;
use Modules\Attributes\Entities\ChildCategory;
use Modules\Attributes\Entities\SubCategory;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\CampaignProduct;
use App\Helpers\CartHelper;
use App\Helpers\CompareHelper;
use App\Helpers\FlashMsg;
use App\Helpers\WishlistHelper;
use App\Mail\TrackOrder;
use App\Page;
use App\StaticOption;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attributes\Entities\Category;
use Modules\MobileApp\Http\Resources\Api\MobileFeatureProductResource;
use Modules\Order\Entities\SubOrderItem;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\ProductRating;
use Modules\Product\Entities\ProductReviews;
use Modules\Product\Entities\ProductSellInfo;
use Modules\Product\Entities\ProductSubCategory;
use Modules\Product\Entities\ProductTag;
use Modules\Product\Entities\ProductUnit;
use Modules\Product\Entities\ProductUom;
use Modules\Product\Entities\SaleDetails;
use Modules\Product\Http\Services\Api\ApiProductServices;
use Modules\Product\Services\FrontendProductServices;

class FrontendProductController extends Controller
{
    public function download_invoice($id)
    {
        $order_details = ProductSellInfo::with("sale_details")->findOrFail($id);

        $db_order_details = json_decode($order_details->order_details, true);
        $db_order_details = is_string($db_order_details) ? json_decode($db_order_details, true) : $db_order_details;
        $products = Product::whereIn('id', array_keys($db_order_details))->get();
        $user_shipping_address = getUserShippingAddress($order_details->shipping_address_id);
        $customPaper = array(0, 0, 1280, 720);
        // 

        //        return view('frontend.partials.product.pdf', compact('order_details', 'products', 'user_shipping_address'));

        $pdf = PDF::loadView('frontend.partials.product.pdf', compact('order_details', 'products', 'user_shipping_address'))->setPaper($customPaper, 'landscape');
        return $pdf->download('product-order-invoice.pdf');
    }

    public function product_review(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'rating' => 'required',
            'review_text' => 'required|max:1000'
        ]);

        $user = Auth::guard('web')->user();
        $existing_record = ProductReviews::where(['user_id' => $user->id, 'product_id' => $request->product_id])->select('id')->first();

        if (!$existing_record) {
            $product_review = new ProductReviews();
            $product_review->user_id = $user->id;
            $product_review->product_id = $request->product_id;
            $product_review->rating = $request->rating;
            $product_review->review_text = trim($request->review_text);
            $product_review->save();

            return response()->json(['type' => 'success', 'msg' => 'Your review is submitted']);
        }

        return response()->json(['type' => 'danger', 'msg' => 'Your have already submitted review on this product']);
    }

    public function render_reviews(Request $request)
    {
        $reviews = ProductReviews::with('user')->where('product_id', $request->product_id)
            ->orderBy('created_at', 'desc')->take($request->items)->get();
        $review_markup = view('product::frontend.product_reviews', compact('reviews'))->render();

        return response()->json([
            'type' => 'success',
            'markup' => $review_markup
        ]);
    }

    public function storeReview($slug, Request $request)
    {
        // validate request here
        $validatedData = $request->validate([
            "comment" => "nullable|string",
            "rating" => "required|integer"
        ]);

        $user = Auth::guard('web')->user();

        // first need to fetch product id by using slug
        $product = Product::select('id')->where('slug', trim(strip_tags($slug)))->whereHas('orderItems', function ($query) use ($user) {
            $query->whereHas('order', function ($subQuery) use ($user) {
                $subQuery->where('user_id', $user->id);
            });
        })->firstOrFail();

        // now check this user is already rated or not
        $alreadyRated = ProductRating::where('product_id', $product->id)->where('user_id', $user->id)->count();

        if (!$alreadyRated) {
            ProductRating::create([
                "product_id" => $product->id,
                "review_msg" => $validatedData['comment'],
                "rating" => $validatedData['rating'],
                "user_id" => $user->id
            ]);

            return back()->with([
                'type' => 'success',
                'msg' => __('Your valuable comment are stored.')
            ]);
        }

        return back()->with([
            'type' => 'warning',
            'msg' => __('You have already rated for this product.')
        ]);
    }

    public function productDetailsPage($slug)
    {

        $date = now();
        $product = Product::where('slug', $slug)
            ->with([
                'category',
                'childCategorySingle',
                'tag',
                'color',
                'size',
                'campaign_product' => function ($campaignProduct) use ($date) {
                    $campaignProduct->whereDate("end_date", ">=", $date)->whereDate("start_date", "<=", $date);
                },
                'inventoryDetail',
                'inventoryDetail.productColor',
                'inventoryDetail.productSize',
                'inventoryDetail.attribute',
                'reviews',
                'reviews.user',
                'inventory',
                'gallery_images',
                'productDeliveryOption',
                'campaign_sold_product',
                'metaData',
                'vendor' => function ($item) {
                    $item->withAvg("vendorProductRating", "product_ratings.rating")->withCount("product", "vendorProductRating");
                },
                'vendor.product',
                'vendor.vendor_address' => function ($item) {
                    $item->with("country");
                },
                'vendor.product.campaign_product',
                'vendor.product.reviews',
                'vendor.product.inventory',
                'vendor.product.campaign_sold_product',
                'vendor.product.badge',
                'vendor.product.uom',
                'taxOptions:tax_class_options.id,country_id,state_id,city_id,rate',
                'vendorAddress:vendor_addresses.id,country_id,state_id,city_id'
            ])
            ->withAvg("reviews", 'rating')
            ->withCount("reviews")
            ->withSum("taxOptions", "rate")
            ->where("status_id", 1)
            ->firstOrFail();
        if (!empty($product->vendor_id) && get_static_option("calculate_tax_based_on") == 'vendor_shop_address') {
            $vendorAddress = $product->vendorAddress;
            $product = tax_options_sum_rate($product, $vendorAddress->country_id, $vendorAddress->state_id, $vendorAddress->city_id);
        } elseif (empty($product->vendor_id) && get_static_option("calculate_tax_based_on") == 'vendor_shop_address') {
            $vendorAddress = AdminShopManage::select("id", "country_id", "state_id", "city as city_id")->first();

            $product = tax_options_sum_rate($product, $vendorAddress->country_id, $vendorAddress->state_id, $vendorAddress->city_id);
        }

        // get selected attributes in this product ( $available_attributes )
        $inventoryDetails = optional($product->inventoryDetail);
        $product_inventory_attributes = $inventoryDetails->toArray();


        $all_included_attributes = array_filter(array_column($product_inventory_attributes, 'attribute', 'id'));
        $all_included_attributes_prd_id = array_keys($all_included_attributes);




        $available_attributes = [];  // FRONTEND : All displaying attributes
        $product_inventory_set = []; // FRONTEND : attribute_store
        $additional_info_store = []; // FRONTEND : $additional_info_store

        foreach ($all_included_attributes as $id => $included_attributes) {
            $single_inventory_item = [];
            foreach ($included_attributes as $included_attribute_single) {

                $available_attributes[$included_attribute_single['attribute_name']][$included_attribute_single['attribute_value']] = 1;

                // individual inventory item
                $single_inventory_item[$included_attribute_single['attribute_name']] = $included_attribute_single['attribute_value'];



                if (optional($inventoryDetails->find($id))->productColor) {
                    $single_inventory_item['Color'] = optional(optional($inventoryDetails->find($id))->productColor)->name;
                }

                if (optional($inventoryDetails->find($id))->productSize) {
                    $single_inventory_item['Size'] = optional(optional($inventoryDetails->find($id))->productSize)->name;
                }
            }

            $item_additional_price = optional(optional($product->inventoryDetail)->find($id))->additional_price ?? 0;
            $item_additional_stock = optional(optional($product->inventoryDetail)->find($id))->stock_count ?? 0;
            $image = get_attachment_image_by_id(optional(optional($product->inventoryDetail)->find($id))->image)['img_url'] ?? '';

            $product_inventory_set[] = $single_inventory_item;

            $sorted_inventory_item = $single_inventory_item;
            ksort($sorted_inventory_item);

            $additional_info_store[md5(json_encode($sorted_inventory_item))] = [
                'pid_id' => $id, // ProductInventoryDetails->id
                'additional_price' => $item_additional_price,
                'stock_count' => $item_additional_stock,
                'image' => $image,
            ];
        }

        $productColors = $product->color->unique();
        $productSizes = $product->size->unique();

        if ((empty($available_attributes) && !empty($product_inventory_attributes)) || count($all_included_attributes) < $product->inventoryDetail->count()) {
            $sorted_inventory_item = [];
            $product_id = $product_inventory_attributes[0]['id'];
            // check inventory color and size exists or not

            if (!empty($product->inventoryDetail)) {
                foreach ($product->inventoryDetail as $inventory) {
                    // if this inventory has attributes, then it will fire a continue statement
                    if (in_array($inventory->product_id, $all_included_attributes_prd_id)) {
                        continue;
                    }

                    $single_inventory_item = [];

                    if (optional($inventoryDetails->find($product_id))->color) {
                        $single_inventory_item['Color'] = optional($inventory->productColor)->name;
                    }

                    if (optional($inventoryDetails->find($product_id))->size) {
                        $single_inventory_item['Size'] = optional($inventory->productSize)->name;
                    }

                    $product_inventory_set[] = $single_inventory_item;

                    $item_additional_price = optional($inventory)->additional_price ?? 0;
                    $item_additional_stock = optional($inventory)->stock_count ?? 0;
                    $image = get_attachment_image_by_id(optional($inventory)->image)['img_url'] ?? '';

                    $sorted_inventory_item = $single_inventory_item;
                    ksort($sorted_inventory_item);

                    $additional_info_store[md5(json_encode($sorted_inventory_item))] = [
                        'pid_id' => $product_id,
                        'additional_price' => $item_additional_price,
                        'stock_count' => $item_additional_stock,
                        'image' => $image,
                    ];
                }
            }
        }

        $available_attributes = array_map(fn($i) => array_keys($i), $available_attributes);


        $product_category = $product?->category?->id;
        $product_id = $product->id;
        $related_products = Product::with('campaign_product', 'campaign_sold_product', 'reviews', 'inventory', 'badge', 'uom')->where('status_id', 1)
            ->whereIn('id', function ($query) use ($product_id, $product_category) {
                $query->select('product_categories.product_id')
                    ->from(with(new ProductCategory())->getTable())
                    ->where('product_id', '!=', $product_id)
                    ->where('category_id', '=', $product_category)
                    ->get();
            })
            ->inRandomOrder()
            ->take(5)
            ->get();

        // (bool) Check logged-in user bought this item (needed for review)
        $user = getUserByGuard(); // default guard is web

        $user_rated_already = !!!ProductRating::where('product_id', optional($product)->id)->where('user_id', optional($user)->id)->count();

        $user_has_item = $user
            ? SubOrderItem::query()->whereHas("order", function ($query) use ($user) {
                $query->where("user_id", $user->id);
            })->where('product_id', $product->id)->count()
            : null;

        $setting_text = StaticOption::whereIn('option_name', [
            'product_in_stock_text',
            'product_out_of_stock_text',
            'details_tab_text',
            'additional_information_text',
            'reviews_text',
            'your_reviews_text',
            'write_your_feedback_text',
            'post_your_feedback_text',
        ])->get()->mapWithKeys(fn($item) => [$item->option_name => $item->option_value])->toArray();

        // sidebar data
        $all_category = ProductCategory::all();
        $all_units = ProductUom::all();
        $maximum_available_price = Product::query()->with('category')->max('price');
        $min_price = request()->pr_min ? request()->pr_min : Product::query()->min('price');
        $max_price = request()->pr_max ? request()->pr_max : $maximum_available_price;
        $all_tags = ProductTag::all();
        $paymentGateways = PaymentGateway::with('oldImage')->where("status", 1)->get();

        if (empty($product_inventory_set[0] ?? [])) {
            $product_inventory_set = "";
        }

        return view('product::frontend.details', compact(
            'product',
            'related_products',
            'user_has_item',
            'user_rated_already',
            'available_attributes',
            'product_inventory_set',
            'additional_info_store',
            'all_category',
            'all_units',
            'maximum_available_price',
            'min_price',
            'max_price',
            'all_tags',
            'productColors',
            'productSizes',
            'setting_text',
            'paymentGateways'
        ));
    }

    public function productQuickViewPage($slug)
    {
        $date = now();
        $product = Product::where('slug', $slug)
            ->with([
                'category',
                'tag',
                'color',
                'size',
                'campaign_product' => function ($campaignProduct) use ($date) {
                    $campaignProduct->whereDate("end_date", ">=", $date)->whereDate("start_date", "<=", $date);
                },
                'inventoryDetail',
                'inventoryDetail.productColor',
                'inventoryDetail.productSize',
                'inventoryDetail.attribute',
                'reviews',
                'reviews.user',
                'inventory',
                'gallery_images',
                'productDeliveryOption',
                'campaign_sold_product',
                'vendor' => function ($item) {
                    $item->withAvg("vendorProductRating", "product_ratings.rating")->withCount("product", "vendorProductRating");
                },
                'vendor.product',
                'vendor.vendor_address' => function ($item) {
                    $item->with("country");
                },
                'vendor.product.campaign_product',
                'vendor.product.reviews',
                'vendor.product.inventory',
                'vendor.product.campaign_sold_product',
                'vendor.product.badge',
                'vendor.product.uom',
                'taxOptions:tax_class_options.id,country_id,state_id,city_id,rate',
                'vendorAddress:vendor_addresses.id,country_id,state_id,city_id'
            ])
            ->withAvg("reviews", 'rating')
            ->withCount("reviews")
            // this line of code will return sum of tax rate for example I have 2 tax one is 5 percent another one is 10 percent then this will return 15 percent
            ->withSum("taxOptions", "rate")
            // call a function for campaign this function will add condition to this table
            ->where("status_id", 1)
            ->firstOrFail();

        if (!empty($product->vendor_id) && get_static_option("calculate_tax_based_on") == 'vendor_shop_address') {
            $vendorAddress = $product->vendorAddress;
            $product = tax_options_sum_rate($product, $vendorAddress->country_id, $vendorAddress->state_id, $vendorAddress->city_id);
        } elseif (empty($product->vendor_id) && get_static_option("calculate_tax_based_on") == 'vendor_shop_address') {
            $vendorAddress = AdminShopManage::select("id", "country_id", "state_id", "city as city_id")->first();

            $product = tax_options_sum_rate($product, $vendorAddress->country_id, $vendorAddress->state_id, $vendorAddress->city_id);
        }

        // get selected attributes in this product ( $available_attributes )
        $inventoryDetails = optional($product->inventoryDetail);
        $product_inventory_attributes = $inventoryDetails->toArray();

        $all_included_attributes = array_filter(array_column($product_inventory_attributes, 'attribute', 'id'));
        $all_included_attributes_prd_id = array_keys($all_included_attributes);

        $available_attributes = [];  // FRONTEND : All displaying attributes
        $product_inventory_set = []; // FRONTEND : attribute_store
        $additional_info_store = []; // FRONTEND : $additional_info_store

        foreach ($all_included_attributes as $id => $included_attributes) {
            $single_inventory_item = [];
            foreach ($included_attributes as $included_attribute_single) {
                $available_attributes[$included_attribute_single['attribute_name']][$included_attribute_single['attribute_value']] = 1;

                // individual inventory item
                $single_inventory_item[$included_attribute_single['attribute_name']] = $included_attribute_single['attribute_value'];

                if (optional($inventoryDetails->find($id))->productColor) {
                    $single_inventory_item['Color'] = optional(optional($inventoryDetails->find($id))->productColor)->name;
                }

                if (optional($inventoryDetails->find($id))->productSize) {
                    $single_inventory_item['Size'] = optional(optional($inventoryDetails->find($id))->productSize)->name;
                }
            }

            $item_additional_price = optional(optional($product->inventoryDetail)->find($id))->additional_price ?? 0;
            $item_additional_stock = optional(optional($product->inventoryDetail)->find($id))->stock_count ?? 0;
            $image = get_attachment_image_by_id(optional(optional($product->inventoryDetail)->find($id))->image)['img_url'] ?? '';

            $product_inventory_set[] = $single_inventory_item;

            $sorted_inventory_item = $single_inventory_item;
            ksort($sorted_inventory_item);

            $additional_info_store[md5(json_encode($sorted_inventory_item))] = [
                'pid_id' => $id, // ProductInventoryDetails->id
                'additional_price' => $item_additional_price,
                'stock_count' => $item_additional_stock,
                'image' => $image,
            ];
        }

        $productColors = $product->color->unique();
        $productSizes = $product->size->unique();

        if ((empty($available_attributes) && !empty($product_inventory_attributes)) || count($all_included_attributes) < $product->inventoryDetail->count()) {
            $sorted_inventory_item = [];
            $product_id = $product_inventory_attributes[0]['id'];
            // check inventory color and size exists or not

            if (!empty($product->inventoryDetail)) {
                foreach ($product->inventoryDetail as $inventory) {
                    // if this inventory has attributes then it will fire continue statement
                    if (in_array($inventory->product_id, $all_included_attributes_prd_id)) {
                        continue;
                    }

                    $single_inventory_item = [];

                    if (optional($inventoryDetails->find($product_id))->color) {
                        $single_inventory_item['Color'] = optional($inventory->productColor)->name;
                    }

                    if (optional($inventoryDetails->find($product_id))->size) {
                        $single_inventory_item['Size'] = optional($inventory->productSize)->name;
                    }

                    $product_inventory_set[] = $single_inventory_item;

                    $item_additional_price = optional($inventory)->additional_price ?? 0;
                    $item_additional_stock = optional($inventory)->stock_count ?? 0;
                    $image = get_attachment_image_by_id(optional($inventory)->image)['img_url'] ?? '';

                    $sorted_inventory_item = $single_inventory_item;
                    ksort($sorted_inventory_item);

                    $additional_info_store[md5(json_encode($sorted_inventory_item))] = [
                        'pid_id' => $product_id,
                        'additional_price' => $item_additional_price,
                        'stock_count' => $item_additional_stock,
                        'image' => $image,
                    ];
                }
            }
        }

        $available_attributes = array_map(fn($i) => array_keys($i), $available_attributes);

        $sub_category_arr = json_decode($product->sub_category_id, true);
        $ratings = ProductRating::where('product_id', $product->id)->with('user')->get();
        $avg_rating = $ratings->count() ? round($ratings->sum('rating') / $ratings->count()) : null;

        // related products
        $product_category = $product?->category?->id;
        $product_id = $product->id;
        $related_products = Product::with('campaign_product', 'campaign_sold_product', 'reviews', 'inventory', 'badge', 'uom')->where('status_id', 1)
            ->whereIn('id', function ($query) use ($product_id, $product_category) {
                $query->select('product_categories.product_id')
                    ->from(with(new ProductCategory())->getTable())
                    ->where('product_id', '!=', $product_id)
                    ->where('category_id', '=', $product_category)
                    ->get();
            })
            ->inRandomOrder()
            ->take(5)
            ->get();

        // (bool) Check logged-in user bought this item (needed for review)
        $user = getUserByGuard('web');

        $user_has_item = $user ? !!SaleDetails::join("product_sell_infos", "product_sell_infos.id", "=", "sale_details.order_id")
            ->where('product_sell_infos.user_id', $user->id)
            ->where('sale_details.item_id', $product->id)->count()
            : null;

        $user_rated_already = ProductRating::where('product_id', optional($product)->id)->where('user_id', optional($user)->id)->count();

        $setting_text = StaticOption::whereIn('option_name', [
            'product_in_stock_text',
            'product_out_of_stock_text',
            'details_tab_text',
            'additional_information_text',
            'reviews_text',
            'your_reviews_text',
            'write_your_feedback_text',
            'post_your_feedback_text',
        ])->get()->mapWithKeys(fn($item) => [$item->option_name => $item->option_value])->toArray();


        // sidebar data
        $all_category = ProductCategory::all();
        $all_units = ProductUom::all();
        $maximum_available_price = Product::query()->with('category')->max('price');
        $min_price = request()->pr_min ? request()->pr_min : Product::query()->min('price');
        $max_price = request()->pr_max ? request()->pr_max : $maximum_available_price;
        $all_tags = ProductTag::all();
        $paymentGateways = PaymentGateway::with('oldImage')->where("status", 1)->get();

        return view('frontend.product.quick-view', compact(
            'product',
            'related_products',
            'user_has_item',
            'ratings',
            'avg_rating',
            'available_attributes',
            'product_inventory_set',
            'additional_info_store',
            'all_category',
            'all_units',
            'maximum_available_price',
            'min_price',
            'max_price',
            'all_tags',
            'productColors',
            'productSizes',
            'setting_text',
            'user_rated_already',
            'paymentGateways'
        ))->render();
    }

    public function products(Request $request)
    {
        $page_details = Page::findOrFail(get_static_option('product_page'));
        return view('frontend.frontend-home', compact('page_details'));
    }

    public function getProductAttributeHtml(Request $request)
    {
        $product = Product::where('slug', $request->slug)->first();
        if ($product) {
            return view('frontend.partials.product-attributes', compact('product'));
        }
    }

    public function products_category(Request $request, $slug, $any = "")
    {

        $default_item_count = get_static_option('default_item_count');

        $all_products = Product::query()
            ->when(!empty($slug), function ($query) use ($slug) {
                $query->whereHas("category", function ($cat_query) use ($slug) {
                    $cat_query->where("slug", $slug);
                });
            })
            ->when(!empty($request->sub_cat_id), function ($query) use ($request) {
                $query->whereHas("subCategory", function ($sub_cat_query) use ($request) {
                    $sub_cat_query->where("sub_categories.id", $request->sub_cat_id);
                });
            })
            ->with([
                'campaign_product',
                'category',
                'ratings',
                'inventory',
                'campaign_sold_product'
            ])
            ->when(!empty($request->order_by), function ($query) use ($request) {
                switch ($request->order_by) {
                    case 'asc':
                        $query->orderBy('id', 'asc');
                        break;
                    case 'desc':
                        $query->orderBy('id', 'desc');
                        break;
                    case 'a-z':
                        $query->orderBy('name', 'asc'); // Replace `name` with your actual column
                        break;
                    case 'z-a':
                        $query->orderBy('name', 'desc');
                        break;
                    case 'price_low_to_high':
                        $query->orderBy('sale_price', 'asc');
                        break;
                    case 'price_high_to_low':
                        $query->orderBy('sale_price', 'desc');
                        break;
                    default:
                        // Optionally, set a default order
                        $query->orderBy('id', 'desc');
                        break;
                }
            })
            ->orderBy('id', 'desc')
            ->paginate($default_item_count);

        $category_name = Category::where("slug", $slug)->first()?->name;

        if (empty($category_name)) {
            abort(404);
        }

        return view('frontend.pages.product.category')->with([
            'all_products' => $all_products,
            'category_name' => $category_name,
        ]);
    }

    public function products_subcategory($slug)
    {
        $default_item_count = get_static_option('default_item_count');
        $all_products = Product::with('campaign_product', 'campaign_sold_product', 'inventory')->where('status_id', 1)
            ->whereHas('subCategory', function ($query) use ($slug) {
                $query->where("slug", $slug);
            })
            ->orderBy('id', 'desc')
            ->paginate($default_item_count);

        $category_name = SubCategory::where("slug", $slug)->first()->name ?? '';

        if (empty($category_name)) {
            abort(404);
        }

        return view('frontend.pages.product.subcategory')->with([
            'all_products' => $all_products,
            'category_name' => $category_name,
        ]);
    }

    public function products_child_category($slug)
    {
        $default_item_count = get_static_option('default_item_count');
        $all_products = Product::with("campaign_product", "campaign_sold_product", "inventory")
            ->where('status_id', 1)
            ->whereHas('childCategory', function ($query) use ($slug) {
                $query->where("slug", $slug);
            })
            ->orderBy('id', 'desc')
            ->paginate($default_item_count);

        $category_name = ChildCategory::where("slug", $slug)->first()->name ?? '';
        if (empty($category_name)) {
            abort(404);
        }

        return view('frontend.pages.product.child_category')->with([
            'all_products' => $all_products,
            'category_name' => $category_name,
        ]);
    }

    public function cartPage(Request $request)
    {
        return view('frontend.cart.all');
    }

    public function updateCart(Request $request)
    {
        return $request->all();
    }

    public function moveToWishlist(Request $request)
    {
        if (!Auth::guard("web")->check()) {
            return response()->json([
                'type' => 'warning',
                'quantity_msg' => __('Sign up or Sign in to wishlist items.')
            ]);
        }

        $username = Auth::guard("web")->user()->id;
        ;
        // first of all get cart item from cart package
        $cart_data = (array) Cart::instance("default")->get($request->rowId);
        $options = [];

        foreach ($cart_data["options"] as $key => $value) {
            $options[$key] = $value;
        }

        DB::beginTransaction();
        try {
            Cart::instance("wishlist")->restore($username);
            Cart::instance("wishlist")->add(['id' => $cart_data['id'], 'name' => $cart_data["name"], 'qty' => $cart_data['qty'], 'price' => $cart_data["price"], 'weight' => '0', 'options' => $options]);
            Cart::instance("wishlist")->store($username);
            // now remove this item from cart
            Cart::instance("default")->remove($request->rowId);

            DB::commit();

            return response()->json([
                'type' => 'success',
                'msg' => 'Item added to save for later',
                'header_area' => view("frontend.partials.header.navbar.card-and-wishlist-area")->render()
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'type' => 'error',
                'error_msg' => __('Something went wrong!'),
                'msg' => $exception
            ]);
        }
    }

    public function moveToCart(Request $request)
    {
        $username = Auth::guard("web")->user()->id;
        ;
        // first of all get cart item from cart package
        $cart_data = (array) Cart::instance("wishlist")->get($request->rowId);
        $options = [];

        foreach ($cart_data["options"] as $key => $value) {
            $options[$key] = $value;
        }

        Cart::instance("default")->add(['id' => $cart_data['id'], 'name' => $cart_data["name"], 'qty' => $cart_data['qty'], 'price' => $cart_data["price"], 'weight' => '0', 'options' => $options]);
        // now remove this item from cart
        Cart::instance("wishlist")->remove($request->rowId);

        return response()->json([
            'success' => true,
            'msg' => __("Successfully moved item to cart."),
            'header_area' => view("frontend.partials.header.navbar.card-and-wishlist-area")->render()
        ]);
    }

    public function wishlistPage(Request $request)
    {
        return view('frontend.wishlist.all');
    }

    public function productsComparePage(Request $request)
    {
        return view('frontend.compare.all');
    }

    public function topRatedProducts()
    {
        $products = Product::where('status', 'publish')
            ->withAvg('rating', 'rating')
            ->with('rating')
            ->orderBy('rating_avg_rating', 'DESC')
            ->take(5)
            ->get();

        return view('frontend.partials.filter-item', compact('products'));
    }

    public function topSellingProducts()
    {
        $products = Product::where('status', 'publish')
            ->withAvg('rating', 'rating')
            ->with('rating')
            ->orderBy('sold_count', 'DESC')
            ->take(5)
            ->get();

        return view('frontend.partials.filter-item', compact('products'));
    }

    public function newProducts()
    {
        $products = Product::where('status', 'publish')
            ->withAvg('rating', 'rating')
            ->with('rating')
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        return view('frontend.partials.filter-item', compact('products'));
    }

    function filterCategoryProducts(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:product_categories',
            'item_count' => 'required|numeric'
        ]);

        $products = Product::where('status', 'publish')
            ->where('category_id', $request->id)
            ->withAvg('rating', 'rating')
            ->with('rating')
            ->take($request->item_count)
            ->get();

        return view('frontend.partials.filter-item', compact('products'));
    }

    /** ======================================================================
     *                          CAMPAIGN PAGE
     * ======================================================================*/
    public function campaignPage($id, $any = "")
    {
        $campaign = Campaign::with(['products', 'products.product'])->findOrFail($id);
        $campaign_product_ids = optional($campaign->products)->pluck('id')->toArray();
        $campaign_products = CampaignProduct::whereIn('id', $campaign_product_ids)->with('product.rating')->paginate();

        return view('frontend.campaign.index', compact('campaign', 'campaign_products'));
    }

    public function flashSalePage()
    {
        # code...
    }

    /** ======================================================================
     *                  PAYMENT STATUS FUNCTIONS
     * ======================================================================*/
    public function product_payment_success($id)
    {
        $extract_id = substr($id, 6);
        $extract_id = substr($extract_id, 0, -6);

        $payment_details = ProductSellInfo::findOrFail($extract_id);

        $order_details = SaleDetails::where('order_id', $extract_id)->get();

        $product_ids = $order_details->pluck('item_id')->toArray();
        $products = Product::whereIn('id', $product_ids)->get();
        CartHelper::clear();
        return view('frontend.payment.payment-success')->with([
            'payment_details' => $payment_details,
            'order_details' => $order_details,
            'products' => $products,
        ]);
    }

    public function product_payment_cancel()
    {
        return view('frontend.payment.payment-cancel');
    }

    public function trackOrderPage()
    {
        return view('frontend.pages.track-order');
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|numeric',
            'email' => 'required|email'
        ]);

        $sell_info = ProductSellInfo::where('id', $request->order_id)
            ->where('email', $request->email)
            ->first();

    }

    public function search(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|exists:product_categories',
            'search_query' => 'nullable|string|max:191'
        ]);

        $category_data = [];
        $product_data = [];

        $all_products = ApiProductServices::productSearch($request, "frontend.ajax", "frontend");

        $products = $all_products["items"];
        unset($all_products["items"]);
        $additional = $all_products;
        $product_url = $all_products["path"];

        foreach ($products as $singleProduct) {
            $category = $singleProduct->category;

            // check category already exists or not
            // this condition is responsible for making unique category
            if ($category_data[$category->id] ?? false)
                continue;

            $category_data[$category->id] = [
                'title' => $category->name,
                'url' => route('frontend.products.category', $category->slug)
            ];
        }

        $product_data = MobileFeatureProductResource::collection($products);

        return response()->json([
            'products' => $product_data,
            'categories' => $category_data,
            'product_url' => $product_url
        ]);
    }

}
