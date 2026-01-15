<?php

namespace App\Http\Controllers;

use App\Action\CartAction;
use App\Action\CompareAction;
use App\Admin;
use App\Blog;
use App\BlogCategory;
use App\ContactInfoItem;
use App\Faq;
use App\HeaderSlider;
use App\Helpers\CartHelper;
use App\Helpers\CompareHelper;
use App\Helpers\FlashMsg;
use App\Helpers\HomePageStaticSettings;
use App\Helpers\WishlistHelper;
use App\Http\Services\CartService;
use App\Language;
use App\Mail\AdminResetEmail;
use App\Mail\BasicMail;
use App\Newsletter;
use App\Page;
use App\Shipping\ShippingAddress;
use App\Shipping\UserShippingAddress;
use App\StaticOption;
use App\User;
use Carbon\Carbon;
use Exception;
use Modules\ShippingModule\Entities\Zone;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Modules\Attributes\Entities\Brand;
use Modules\Attributes\Entities\Category;
use Modules\Attributes\Entities\Color;
use Modules\Attributes\Entities\Size;
use Modules\Attributes\Entities\Unit;
use Modules\Campaign\Entities\Campaign;
use Modules\CountryManage\Entities\City;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductAttribute;
use Modules\Product\Entities\ProductSubCategory;
use Modules\Product\Services\FrontendProductServices;
use Modules\ShippingModule\Entities\AdminShippingMethod;
use Modules\ShippingModule\Http\ShippingZoneServices;
use Modules\TaxModule\Entities\CountryTax;
use Modules\TaxModule\Entities\StateTax;
use Modules\TaxModule\Entities\TaxClassOption;
use Modules\TaxModule\Services\CalculateTaxBasedOnCustomerAddress;
use Modules\TaxModule\Services\CalculateTaxServices;
use Modules\Vendor\Entities\Vendor;
use Throwable;

ini_set('max_execution_time', 300);

class FrontendController extends Controller
{
    public function index()
    {
        $home_page_id = get_static_option('home_page');
        $page_details = Page::findOrfail($home_page_id);

        $static_field_data = Cache::remember('home_page_cache_key', 600, function () {
            return StaticOption::whereIn('option_name', HomePageStaticSettings::get_home_field(get_static_option('home_page_variant')))
                ->get()
                ->mapWithKeys(function ($item) {
                    return [
                        $item->option_name => $item->option_value,
                    ];
                })->toArray();
        });

        return view('frontend.frontend-home', compact('static_field_data', 'page_details'));
    }

    public function home_page_change($id)
    {
        $all_header_slider = HeaderSlider::all();
        $all_blog = Blog::where(['status' => 'publish'])->orderBy('id', 'desc')->take(get_static_option('home_page_01_latest_news_items'))->get(); //make a function to call all static option by home page
        $static_field_data = StaticOption::whereIn('option_name', HomePageStaticSettings::get_home_field($id))->get()->mapWithKeys(function ($item) {
            return [$item->option_name => $item->option_value];
        })->toArray();

        return view('frontend.frontend-home-demo')->with([
            'all_header_slider' => $all_header_slider,
            'all_blog'          => $all_blog,
            'static_field_data' => $static_field_data,
            'home_page'         => $id,
        ]);
    }

    public function flutterwave_pay_get()
    {
        return redirect_404_page();
    }

    public function blog_page()
    {
        $page_details = Page::findOrFail(get_static_option('blog_page'));

        return view('frontend.frontend-home', compact('page_details'));
    }

    final public function category_wise_blog_page(int $id, $slug = null)
    {
        $all_blogs = Blog::where(['blog_categories_id' => $id])->orderBy('id', 'desc')
            ->paginate(get_static_option('blog_page_item'));

        if ($all_blogs->isEmpty()) {
            abort(404);
        }

        $all_recent_blogs = Blog::orderBy('id', 'desc')->take(get_static_option('blog_page_recent_post_widget_item'))->get();
        $all_category = BlogCategory::where(['status' => 'publish'])->orderBy('id', 'desc')->get();
        $blogCategory = BlogCategory::where(['id' => $id, 'status' => 'publish'])->first();
        $category_name = $blogCategory?->name;

        // this code will match upcoming slug from request and the founded blog are same or not if not then throw 404 page
        if (is_string($slug)) {
            abort_if(Str::slug($category_name) !== $slug, 404);
        }

        return view('frontend.pages.blog.blog-category')->with([
            'all_blogs'        => $all_blogs,
            'all_categories'   => $all_category,
            'category_name'    => $category_name,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }

    public function tags_wise_blog_page($tag)
    {
        $all_blogs = Blog::Where('tags', 'LIKE', '%' . $tag . '%')
            ->orderBy('id', 'desc')->paginate(get_static_option('blog_page_item'));
        if ($all_blogs->isEmpty()) {
            abort(404);
        }

        $all_recent_blogs = Blog::orderBy('id', 'desc')->take(get_static_option('blog_page_recent_post_widget_item'))->get();
        $all_category = BlogCategory::where(['status' => 'publish'])->orderBy('id', 'desc')->get();

        return view('frontend.pages.blog.blog-tags')->with([
            'all_blogs'        => $all_blogs,
            'all_categories'   => $all_category,
            'tag_name'         => $tag,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }

    public function blog_search_page(Request $request)
    {
        $all_recent_blogs = Blog::orderBy('id', 'desc')->take(get_static_option('blog_page_recent_post_widget_item'))->get();
        $all_category = BlogCategory::where(['status' => 'publish'])->orderBy('id', 'desc')->get();
        $all_blogs = Blog::Where('title', 'LIKE', '%' . $request->search . '%')
            ->orderBy('id', 'desc')->paginate(get_static_option('blog_page_item'));

        return view('frontend.pages.blog.blog-search')->with([
            'all_blogs'        => $all_blogs,
            'all_categories'   => $all_category,
            'search_term'      => $request->search,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }

    public function blog_single_page($slug)
    {
        $blog_post = Blog::where('slug', $slug)->first();

        if (empty($blog_post)) {
            abort('404');
        }

        $all_recent_blogs = Blog::orderBy('id', 'desc')->paginate(get_static_option('blog_page_recent_post_widget_item'));
        $all_category = BlogCategory::where(['status' => 'publish'])->orderBy('id', 'desc')->get();

        $all_related_blog = Blog::Where('blog_categories_id', $blog_post->blog_categories_id)->orderBy('id', 'desc')->take(6)->get();

        // insert blog page visit count += 1
        $blog_post->increment('visit_count');

        return view('frontend.pages.blog.blog-single')->with([
            'blog_post'        => $blog_post,
            'all_categories'   => $all_category,
            'all_recent_blogs' => $all_recent_blogs,
            'all_related_blog' => $all_related_blog,
        ]);
    }

    public function dynamic_single_page($slug)
    {
        $page_post = Page::where('slug', $slug)->first();
        $vendor = Vendor::where('username', $slug)->first();

        $preserved_pages = [
            'home_page',
            'product_page',
            'blog_page',
        ];

        $static_option = StaticOption::whereIn('option_name', $preserved_pages)->get()->mapWithKeys(function ($item) {
            return [$item->option_name => $item->option_value];
        })->toArray();

        $pages_id_slugs = Page::whereIn('id', array_values($static_option))->get()->mapWithKeys(function ($item) {
            return [$item->id => $item->slug];
        })->toArray();

        if (in_array($slug, $pages_id_slugs) && $slug === $pages_id_slugs[$static_option['home_page']]) {
            return redirect()->route('homepage');
        } elseif (in_array($slug, $pages_id_slugs) && $slug === $pages_id_slugs[$static_option['blog_page']]) {
            return $this->fallbackBlogPage($page_post);
        } elseif (in_array($slug, $pages_id_slugs) && $slug === $pages_id_slugs[$static_option['product_page']]) {
            return $this->fallbackProductPage($page_post);
        } elseif (empty($page_post) && !empty($vendor)) {
            return $this->fallbackProductPage($page_post, $vendor);
        }

        if (!is_null($page_post)) {
            return view('frontend.pages.dynamic-single', compact('page_post'));
        }

        abort(404);
    }

    public function dynamic_shop_single_page(Request $request)
    {
        $products = Product::query()
            ->with([
                'category',
                'campaign_product',
                'campaign_sold_product',
                'inventory',
            ])
            ->when($request->category_id != 'all' && $request->category_id, function ($q) use ($request) {
                $q->whereHas('category', function ($q2) use ($request) {
                    $q2->where('categories.id', $request->category_id); // 👈 prefix with table name
                });
            })
            ->when($request->brand_id, function ($q) use ($request) {
                $q->where('brand_id', $request->brand_id);
            })
            ->when($request->keyword, function ($q) use ($request) {
                $q->where('name', 'LIKE', "%" . $request->keyword . "%");
            })
            ->when($request->order_by, function ($q) use ($request) {
                switch ($request->order_by) {
                    case 'latest':
                        $q->orderBy('id', 'desc');
                        break;
                    case 'oldest':
                        $q->orderBy('id', 'asc');
                        break;
                    case 'price_low_high':
                        $q->orderBy('sale_price', 'asc');
                        break;
                    case 'price_high_low':
                        $q->orderBy('sale_price', 'desc');
                        break;
                    default:
                        $q->orderBy('id', 'desc');
                        break;
                }
            })
            ->paginate(10);

        return view('frontend.pages.product-list', compact('products'));
    }

    public function dynamic_campaign_page()
    {
        $now = Carbon::now();

        $all_campaigns = Campaign::query()
            ->with('campaignImage')
            ->where('status', 'publish')
            ->whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->where('start_date', '<=', $now)
            ->where('end_date', '>', $now)
            ->orderBy('end_date', 'asc')
            ->paginate(12);

        return view('frontend.campaign.all-campaign', compact('all_campaigns'));
    }

    public function showAdminForgetPasswordForm()
    {
        return view('auth.admin.forget-password');
    }

    public function sendAdminForgetPasswordMail(Request $request)
    {
        $request->validate(['username' => 'required|string:max:191']);

        $user_info = Admin::where('username', $request->username)->orWhere('email', $request->username)->first();

        if (!empty($user_info)) {
            $token_id = Str::random(30);
            $existing_token = DB::table('password_resets')->where('email', $user_info->email)->delete();
            if (empty($existing_token)) {
                DB::table('password_resets')->insert(['email' => $user_info->email, 'token' => $token_id]);
            }
            $message = 'Here is you password reset link, If you did not request to reset your password just ignore this mail. <a class="btn" href="' . route('admin.reset.password', ['user' => $user_info->username, 'token' => $token_id]) . '">Click Reset Password</a>';
            $data = [
                'username' => $user_info->username,
                'message'  => $message,
            ];

            try {
                Mail::to($user_info->email)->send(new AdminResetEmail($data));
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'msg'  => $e->getMessage(),
                    'type' => 'success',
                ]);
            }

            return redirect()->back()->with([
                'msg'  => __('Check Your Mail For Reset Password Link'),
                'type' => 'success',
            ]);
        }

        return redirect()->back()->with([
            'msg'  => __('Your Username or Email Is Wrong!!!'),
            'type' => 'danger',
        ]);
    }

    public function showAdminResetPasswordForm($username, $token)
    {
        return view('auth.admin.reset-password')->with([
            'username' => $username,
            'token'    => $token,
        ]);
    }

    public function AdminResetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'username' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user_info = Admin::where('username', $request->username)->first();
        $user = Admin::findOrFail($user_info->id);
        $token_iinfo = DB::table('password_resets')->where(['email' => $user_info->email, 'token' => $request->token])->first();
        if (!empty($token_iinfo)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('admin.login')->with(['msg' => __('Password Changed Successfully.'), 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => __('Unable to change the Password. Please try again or check your old Password.'), 'type' => 'danger']);
    }

    public function lang_change(Request $request)
    {
        session()->put('lang', $request->lang);

        return redirect()->route('homepage');
    }

    /** ======================================================================================
     *                  OTHER PAGE FUNCTIONS
     * ======================================================================================*/
    public function about_page()
    {
        return view('frontend.pages.about');
    }

    public function faq_page()
    {
        $all_faq = Faq::where(['status' => 'publish'])->get();

        return view('frontend.pages.faq-page')->with([
            'all_faqs' => $all_faq,
        ]);
    }

    public function contact_page()
    {
        $all_contact_info = ContactInfoItem::get();

        return view('frontend.pages.contact-page')->with([
            'all_contact_info' => $all_contact_info,
        ]);
    }

    public function products_subcategory($id, $any = '')
    {
        $default_item_count = get_static_option('default_item_count');
        $all_products = Product::where('status', 'publish')
            ->whereJsonContains('sub_category_id', "$id")
            ->orderBy('id', 'desc')
            ->paginate($default_item_count);

        $category_name = ProductSubCategory::find($id)->title;

        if (empty($category_name)) {
            abort(404);
        }

        return view('frontend.pages.product.subcategory')->with([
            'all_products'  => $all_products,
            'category_name' => $category_name,
        ]);
    }

    public function subscribe_newsletter(Request $request)
    {
        $request->validate(['email' => 'required|string|email|max:191|unique:newsletters']);

        $verify_token = Str::random(32);

        Newsletter::create([
            'email'        => $request->email,
            'verified'     => 0,
            'verify_token' => $verify_token,
        ]);

        $message = __('Verify your email to get all news from ') . get_static_option('site_title') . '<div class="btn-wrap"> <a class="anchor-btn" href="' . route('subscriber.verify', ['token' => $verify_token]) . '">' . __('verify email') . '</a></div>';

        $data = [
            'message' => $message,
            'subject' => __('verify your email'),
        ];
        try {
            //send verify mail to newsletter subscriber
            Mail::to($request->email)->send(new BasicMail($data));
        } catch (Throwable $th) {
            //throw $th;
        }

        return response()->json(['type' => 'success', 'msg' => __('Thanks for subscribing to our newsletter.')]);
    }

    public function subscriber_verify(Request $request)
    {
        $newsletter = Newsletter::where('token', $request->token)->first();
        $title = __('Sorry');
        $description = __('your token is expired');
        if (!empty($newsletter)) {
            Newsletter::where('token', $request->token)->update([
                'verified' => 1,
            ]);
            $title = __('Thanks');
            $description = __('we are really thankful to you for subscribe our newsletter');
        }

        return view('frontend.thankyou', compact('title', 'description'));
    }

    public function newsletter_unsubscribe($id)
    {
        Newsletter::where('id', $id)->update(['subscribe_status' => 0]);
        // Redirect to the homepage with a flash message
        return redirect()->to('/')->with([
            'type' => 'danger',
            'msg',
            'You have been unsubscribed..!',
        ]);
    }

    public function showUserForgetPasswordForm()
    {
        return view('frontend.user.forget-password');
    }

    public function sendUserForgetPasswordMail(Request $request)
    {
        $request->validate([
            'username' => 'required|string:max:191',
        ]);

        $user_info = User::where('username', $request->username)
            ->orWhere('email', $request->username)->first();

        if (!empty($user_info)) {
            $token_id = Str::random(30);
            $existing_token = DB::table('password_resets')->where('email', $user_info->email)->delete();
            if (empty($existing_token)) {
                DB::table('password_resets')->insert(['email' => $user_info->email, 'token' => $token_id]);
            }

            $message = __('Here is you password reset link, If you did not request to reset your password just ignore this mail.') . ' <a class="btn" href="' . route('user.reset.password', ['user' => $user_info->username, 'token' => $token_id]) . '">' . __('Click Reset Password') . '</a>';
            $data = [
                'username' => $user_info->username,
                'message'  => $message,
            ];
            try {
                Mail::to($user_info->email)->send(new AdminResetEmail($data));
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'type' => 'danger',
                    'msg'  => $e->getMessage(),
                ]);
            }

            return redirect(route('user.home'))->with([
                'msg'  => __('Check Your Mail For Reset Password Link'),
                'type' => 'success',
            ]);
        }

        return redirect()->back()->with([
            'msg'  => __('Your Username or Email Is Wrong!!!'),
            'type' => 'danger',
        ]);
    }

    public function checkPhoneInDb(Request $request)
    {
        $phone = $request->input('phone');

        // Check if phone is in DB
        $user = User::where('phone', $phone)->first();
        if (!$user) {
            return response()->json(['found' => false]);
        }

        // If user found, generate a token (purely ephemeral for the route)
        // We do NOT want to send mail or store in password_resets
        // So we skip DB insert if you truly do not want to track it
        $token = Str::random(40);

        // Return JSON: found=true, plus user ID & token
        return response()->json([
            'found' => true,
            'user'  => $user->id,
            'token' => $token,
        ]);
    }

    public function showVendorForgetPasswordForm()
    {
        return view('frontend.vendor.forget-password');
    }
    public function sendVendorForgetPasswordMail(Request $request)
    {
        $request->validate([
            'username' => 'required|string:max:191',
        ]);

        $vendor_info = Vendor::where('username', $request->username)
            ->orWhere('email', $request->username)->first();

        if (!empty($vendor_info)) {
            $token_id = Str::random(30);
            $existing_token = DB::table('password_resets')->where('email', $vendor_info->email)->delete();
            if (empty($existing_token)) {
                DB::table('password_resets')->insert(['email' => $vendor_info->email, 'token' => $token_id]);
            }

            $message = __('Here is you password reset link, If you did not request to reset your password just ignore this mail.') . ' <a class="btn" href="' . route('vendor.reset.password', ['user' => $vendor_info->username, 'token' => $token_id]) . '">' . __('Click Reset Password') . '</a>';
            $data = [
                'username' => $vendor_info->username,
                'message'  => $message,
            ];
            try {
                Mail::to($vendor_info->email)->send(new AdminResetEmail($data));
            } catch (Exception $e) {
                return redirect()->back()->with([
                    'type' => 'danger',
                    'msg'  => $e->getMessage(),
                ]);
            }

            return redirect(route('vendor.forget.password.form'))->with([
                'msg'  => __('Check Your Mail For Reset Password Link'),
                'type' => 'success',
            ]);
        }

        return redirect()->back()->with([
            'msg'  => __('Your Username or Email Is Wrong!!!'),
            'type' => 'danger',
        ]);
    }
    public function showVendorResetPasswordForm($username, $token)
    {
        return view('frontend.vendor.reset-password')->with([
            'username' => $username,
            'token'    => $token,
        ]);
    }
    public function VendorResetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'username' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user_info = Vendor::where('username', $request->username)->first();
        $user = Vendor::findOrFail($user_info->id);
        $token_iinfo = DB::table('password_resets')->where(['email' => $user_info->email, 'token' => $request->token])->first();
        if (!empty($token_iinfo)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('vendor.login')->with(['msg' => __('Password Changed Successfully.'), 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => __('Unable to change the Password. Please try again or check your old Password..'), 'type' => 'danger']);
    }
    public function showUserResetPasswordForm($username, $token)
    {
        return view('frontend.user.reset-password')->with([
            'username' => $username,
            'token'    => $token,
        ]);
    }
    public function UserResetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'username' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user_info = User::where('username', $request->username)->first();
        $user = User::findOrFail($user_info->id);
        $token_iinfo = DB::table('password_resets')->where(['email' => $user_info->email, 'token' => $request->token])->first();
        if (!empty($token_iinfo)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('user.login')->with(['msg' => __('Password Changed Successfully.'), 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => __('Unable to change the Password. Please try again or check your old Password..'), 'type' => 'danger']);
    }

    public function ajax_login(Request $request)
    {
        // Custom validation
        $validator = \Validator::make($request->all(), [
            'phone'    => [
                'required_without:email',
                function ($attribute, $value, $fail) {
                    $countryCode = ['+1', '+880', '+855']; // Adjust as needed
                    $phoneNumber = str_replace($countryCode, '', $value);
                    if (empty(trim($phoneNumber))) {
                        $fail(__('Phone number or email is required.'));
                    }
                },
            ],
            'password' => 'required|min:8',
        ], [
            'phone.required_without' => __('Phone number or email is required.'),
            'password.required'      => __('Password is required.'),
            'password.min'           => __('Password must be at least 8 characters.'),
        ]);

        if ($validator->fails()) {
            \Log::info('Validation Errors: ' . json_encode($validator->errors()));
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Determine login field
        $login_key = 'phone';
        $input_value = $request->phone;

        if ($request->filled('email')) {
            $login_key = 'email';
            $input_value = $request->email;
        } elseif (filter_var($input_value, FILTER_VALIDATE_EMAIL)) {
            $login_key = 'email';
        }

        $user = User::where($login_key, $input_value)->first();

        if (!$user) {
            return response()->json([
                'msg'    => __('Account not found.'),
                'type'   => 'danger',
                'status' => 'invalid',
            ]);
        }

        if ($user->deactive_status == 1) {
            return response()->json([
                'msg'    => __('Your account is deactivated. Please contact support.'),
                'type'   => 'danger',
                'status' => 'invalid',
            ]);
        }

        // Attempt login
        if (Auth::guard('web')->attempt([$login_key => $input_value, 'password' => $request->password], $request->get('remember'))) {
            try {
                // 🛒 Restore all cart instances for this user
                $userId = Auth::guard('web')->id();

                Cart::instance('default')->restore($userId);
                Cart::instance('wishlist')->restore($userId);
                Cart::instance('compare')->restore($userId);
            } catch (\Exception $e) {
                \Log::warning("Cart restore failed for user {$userId}: " . $e->getMessage());
            }

            return response()->json([
                'msg'                 => __('Signed in successfully... Redirecting...'),
                'type'                => 'success',
                'status'              => 'valid',
                'user_identification' => random_int(11111111, 99999999) . $user->id . random_int(11111111, 99999999),
            ]);
        }

        return response()->json([
            'msg'    => __('Account credentials do not match.'),
            'type'   => 'danger',
            'status' => 'invalid',
        ]);
    }

    public function user_campaign()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('user.campaign.new');
        }

        return view('frontend.user.login')->with(['title' => __('Login To Create New Campaign.')]);
    }

    public function addUserShippingAddress(Request $request)
    {
        if (!auth('web')->check()) {
            return back()->with(FlashMsg::explain('danger', __('Please login to add new address.')));
        }

        $request->validate([
            'name'    => 'required|string|max:191',
            'address' => 'required|string|max:191',
        ]);

        $UserShippingAddress = UserShippingAddress::create([
            'user_id' => auth('web')->user()->id,
            'name'    => $request->name,
            'address' => $request->address,
        ]);

        $all_user_shipping = UserShippingAddress::where('user_id', auth('web')->user()->id)->get();

        return view('frontend.cart.checkout-user-shipping', compact('all_user_shipping'));
    }

    public function getProductAttributeHtml(Request $request)
    {
        $product = Product::where('slug', $request->slug)->first();
        if ($product) {
            return view('frontend.partials.product-attributes', compact('product'));
        }
    }

    public function cartPage(Request $request)
    {
        $default_shipping_cost = CartAction::getDefaultShippingCost();

        $all_cart_items = CartHelper::getItems();

        CartAction::validateItemQuantity();

        $all_cart_items = CartHelper::getItems();

        $products = Product::whereIn('id', array_keys($all_cart_items))->get();

        $subtotal = CartAction::getCartTotalAmount($all_cart_items, $products);
        $subtotal_with_tax = $subtotal + $default_shipping_cost;
        $total = CartAction::calculateCoupon($request, $subtotal_with_tax, $products);

        return view('frontend.cart.all', compact('all_cart_items', 'products', 'subtotal', 'default_shipping_cost', 'total'));
    }

    public function checkoutPage(Request $request): Application | Factory | View
    {
        $default_shipping_cost = CartAction::getDefaultShippingCost();
        $default_shipping = CartAction::getDefaultShipping();
        $user = getUserByGuard('web');

        $all_user_shipping = [];
        $defaultShippingAddress = null;

        if (auth('web')->check()) {
            $all_user_shipping = ShippingAddress::with(['get_cities', 'get_states', 'country:id,name', 'state:id,name,country_id', 'cities:id,name', 'country_taxs', 'state_taxs'])
                ->where('user_id', getUserByGuard('web')->id)->get();

            // Fetch the default shipping address
            $defaultShippingAddress = ShippingAddress::with(['get_cities', 'get_states', 'country:id,name', 'state:id,name,country_id', 'cities:id,name', 'country_taxs', 'state_taxs'])
                ->where('user_id', getUserByGuard('web')->id)
                ->where('is_default', true)
                ->first();
        }

        $countries = Country::where('status', 'publish')->get();
        $states = State::where('status', 'publish')->get();
        $cities = City::where('status', 'publish')->get();
        // if not campaign
        $all_cart_items = Cart::content();

        $prd_ids = $all_cart_items?->pluck('id')?->toArray();

        $products = Product::with('category', 'subCategory', 'childCategory')->whereIn('id', $prd_ids)->get();

        $subtotal = Cart::subtotal(2, '.', '');
        $subtotal_with_shipping = $subtotal + $default_shipping_cost;
        $coupon_amount = CartService::calculateCoupon($request, $subtotal, $products, 'DISCOUNT', $default_shipping_cost);

        $total = CartService::calculateCoupon($request, $subtotal_with_shipping, $products);

        $setting_text = StaticOption::select('option_name', 'option_value')->whereIn('option_name', [
            'checkout_page_no_product_text',
            'returning_customer_text',
            'toggle_login_text',
            'checkout_username',
            'checkout_password',
            'checkout_remember_text',
            'checkout_forgot_password',
            'checkout_login_btn_text',
            'have_coupon_text',
            'enter_coupon_text',
            'coupon_placeholder',
            'apply_coupon_btn_text',
            'checkout_billing_section_title',
            'checkout_billing_city',
            'checkout_billing_zipcode',
            'checkout_billing_address',
            'checkout_billing_email',
            'checkout_billing_phone',
            'checkout_order_note',
            'create_account_text',
            'create_account_username',
            'create_account_password',
            'create_account_confirmed_password',
            'ship_to_another_text',
            'shipping_state',
            'shipping_city',
            'shipping_zipcode',
            'shipping_address',
            'shipping_email',
            'shipping_phone',
            'order_summary_title',
            'subtotal_text',
            'discount_text',
            'shipping_text',
            'total_text',
            'checkout_place_order',
            'checkout_return_cart',
            'checkout_page_terms_text',
            'checkout_page_terms_link_url',
        ])->pluck('option_value', 'option_name')->toArray();

        return view('frontend.cart.checkout', compact(
            'all_cart_items',
            'all_user_shipping',
            'products',
            'subtotal',
            'countries',
            'states',
            'cities',
            'default_shipping_cost',
            'default_shipping',
            'total',
            'user',
            'coupon_amount',
            'setting_text',
            'defaultShippingAddress'
        ));
    }

    public function checkoutShippingMethods(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $shippingAddress = ShippingAddress::findOrFail($request->shipping_address_id);

        $zones = Zone::query()
            ->where('city_id', $shippingAddress->city)
            ->orWhere('city_id', $user->city)
            ->pluck('id');

        if ($zones->isEmpty()) {
            $adminShippingMethod = AdminShippingMethod::query()
                ->with('zone')
                ->where('is_default', 1)
                ->get();
        } else {
            $adminShippingMethod = AdminShippingMethod::query()
                ->with('zone')
                ->whereIn('zone_id', $zones)
                ->get();
        }

        if ($adminShippingMethod->count()  == 0) {
            $adminShippingMethod = AdminShippingMethod::query()
                ->with('zone')
                ->where('is_default', 1)
                ->get();
        }

        $html = view('frontend.cart.shipping-methods', compact('adminShippingMethod'))->render();

        return response()->json([
            'html' => $html,
        ]);
    }


    public function cartItemsBasedOnBillingAddress(Request $request)
    {
        $carts = Cart::instance('default')->content();
        $itemsTotal = null;
        $enableTaxAmount = !CalculateTaxServices::isPriceEnteredWithTax();
        $shippingTaxClass = TaxClassOption::where('class_id', get_static_option('shipping_tax_class'))->sum('rate');
        $tax = CalculateTaxBasedOnCustomerAddress::init();
        $uniqueProductIds = $carts->pluck('id')->unique()->toArray();

        $country_id = $request->country_id ?? 0;
        $state_id = $request->state_id ?? 0;
        $city_id = $request->city_id ?? 0;

        if (empty($uniqueProductIds)) {
            $taxProducts = collect([]);
        } else {
            if (CalculateTaxBasedOnCustomerAddress::is_eligible()) {
                $taxProducts = $tax
                    ->productIds($uniqueProductIds)
                    ->customerAddress($country_id, $state_id, $city_id)
                    ->generate();
            } else {
                $taxProducts = collect([]);
            }
        }

        $carts = $carts->groupBy('options.vendor_id');

        $vendors = Vendor::with('shippingMethod', 'shippingMethod.zone')
            ->whereIn('id', array_keys($carts?->toArray() ?? []))->get();

        $cartItems = view('frontend.cart.cart-items.cart-items-wrapper', compact('enableTaxAmount', 'itemsTotal', 'carts', 'vendors', 'taxProducts', 'shippingTaxClass'))->render();

        $id = null;
        $type = null;

        if (empty($state_id) && empty($city_id)) {
            $id = $country_id;
            $type = 'country';
        } elseif (empty($city_id)) {
            $id = $state_id;
            $type = 'state';
        }

        // prepare data for send response
        $data = ShippingZoneServices::getMethods($id, $type);
        $taxAmount = get_static_option('tax_system') == 'zone_wise_tax_system' ? ['tax_amount' => $data?->tax_amount] : [];
        $states = $type == 'country' ? ['states' => $data?->states] : [];
        $cities = $type == 'state' ? ['cities' => $data?->cities] : [];

        return response()->json([
            'cart_items' => $cartItems,
        ] + $taxAmount + $states + $cities);
    }

    public function wishlistPage(Request $request)
    {
        $all_wishlist_items = WishlistHelper::getItems();
        $products = Product::whereIn('id', array_keys($all_wishlist_items))->get();

        return view('frontend.wishlist.all', compact('all_wishlist_items', 'products'));
    }

    public function productsComparePage()
    {
        $all_compare_items = CompareHelper::getItems();
        $all_compare_items = [
            array_pop($all_compare_items),
            array_pop($all_compare_items),
        ];

        $products = Product::with('additionalInfo', 'category', 'inventory')
            ->whereIn('id', $all_compare_items)
            ->get();
        $product_ids = $products->pluck('id')->toArray();

        $categories = CompareAction::getCategories($products);
        $all_attributes = CompareAction::getAllProductsAttributes($products);

        return view('frontend.compare.all', compact(
            'all_compare_items',
            'products',
            'product_ids',
            'categories',
            'all_attributes'
        ));
    }

    public function topRatedProducts(): View | Factory | string | Application
    {
        $products = Product::where('status_id', 1)
            ->withAvg('ratings', 'rating')
            ->with('campaign_product', 'inventoryDetail', 'inventory', 'campaign_sold_product')
            ->orderBy('ratings_avg_rating', 'DESC')
            ->take(request()->limit ?? 5)
            ->get();

        if (\request()->isMethod('post')) {
            if (\request()->style == 'two') {
                return view('frontend.partials.product_filter_style_two', compact('products'))->render();
            }
        }

        return view('frontend.partials.filter-item', compact('products'));
    }

    public function topSellingProducts()
    {
        $products = Product::where('status_id', 1)
            ->withAvg('ratings', 'rating')
            ->with('campaign_product', 'inventoryDetail', 'inventory', 'campaign_sold_product')
            ->orderBy('sold_count', 'DESC')
            ->take(request()->limit ?? 5)
            ->get();

        if (\request()->isMethod('post')) {
            if (\request()->style == 'two') {
                return view('frontend.partials.product_filter_style_two', compact('products'))->render();
            }
        }

        return view('frontend.partials.filter-item', compact('products'));
    }

    public function newProducts()
    {
        $products = Product::where('status_id', 1)
            ->withAvg('ratings', 'rating')
            ->with('campaign_product', 'inventoryDetail', 'inventory', 'campaign_sold_product')
            ->orderBy('created_at', 'DESC')
            ->take(request()->limit ?? 5)
            ->get();

        if (\request()->isMethod('post')) {
            if (\request()->style == 'two') {
                return view('frontend.partials.product_filter_style_two', compact('products'))->render();
            }
        }

        return view('frontend.partials.filter-item', compact('products'));
    }

    public function campaignProduct(Request $req)
    {
        $limit = $this->validated_item_count($req);
        $products = Product::where('status', 'publish')
            ->withAvg('rating', 'rating')
            ->join('campaign_products', 'campaign_products.product_id', '=', 'products.id')
            ->orderBy('campaign_products.id', 'DESC')
            ->where('campaign_products.end_date', '>', date('Y-m-d H:i:s'))
            ->take($limit)
            ->get();

        return view('frontend.partials.product_filter_style_two', compact('products'))->render();
    }

    public function discountedProduct(Request $req)
    {
        $limit = $this->validated_item_count($req);

        $products = Product::where('status', 'publish')
            ->withAvg('rating', 'rating')
            ->with('inventory')
            ->where('price', '>', '0')
            ->orderBy('products.id', 'DESC')
            ->take($limit)
            ->get();

        return view('frontend.partials.product_filter_style_two', compact('products'))->render();
    }

    private function validated_item_count($req)
    {
        if ($req->limit ?? false) {
            $data = Validator::make($req->all(), ['limit' => 'required']);

            return $data->safe()->only('limit')['limit'];
        }

        return null;
    }

    public function filterCategoryProducts(Request $request)
    {
        $request->validate([
            'id'         => 'required|exists:product_categories',
            'item_count' => 'required|numeric',
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
    public function campaignPage($id, $any = '')
    {
        $campaign = Campaign::with(['products', 'products.product'])->findOrFail($id);
        $products = optional($campaign->products);

        return view('frontend.campaign.index', compact('campaign'));
    }

    public function changeSiteCurrency(Request $request)
    {
        $request->validate(['currency' => 'required|string|max:191']);
        if (array_key_exists($request->currency, getAllCurrency())) {
            update_static_option('site_global_currency', $request->currency);
        }

        return true;
    }

    public function changeSiteLanguage(Request $request)
    {
        $language = Language::where('slug', $request->language)->first();

        session()->put('lang', $request->language);

        return redirect()->back()->with([
            'msg'  => __('Site language successfully changed.'),
            'type' => 'success',
        ]);
    }

    /** =====================================================================
     *                          AJAX FUNCTIONS
     * ===================================================================== */
    public function getCountryInfo(Request $request)
    {
        $request->validate(['id' => 'required|exists:countries']);

        $country_tax = CountryTax::where('country_id', $request->id)->first();
        $shipping_options = getCountryShippingCost('country', $request->id);
        $default_shipping = CartAction::getDefaultShipping();
        $default_shipping_cost = CartAction::getDefaultShippingCost();
        $states = State::select('id', 'name')->where('country_id', $request->id)->get();
        $tax = $country_tax ? $country_tax->tax_percentage : 0;

        return response()->json([
            'tax'                   => $tax,
            'states'                => $states,
            'shipping_options'      => $shipping_options,
            'default_shipping'      => $default_shipping,
            'default_shipping_cost' => $default_shipping_cost,
        ], 200);
    }

    public function getCountryStateInfo(Request $request)
    {
        $request->validate(['id' => 'required']);

        $states = State::select('id', 'name')->where('country_id', $request->id)->get();
        $html = "<option value=''>Select City</option>";
        foreach ($states as $state) {
            $html .= "<option value='" . $state->id . "'>" . $state->name . '</option>';
        }

        return $html;
    }

    public function getCountryCityInfo(Request $request)
    {
        $request->validate(['id' => 'required']);

        $cities = City::select('id', 'name')->where('state_id', $request->id)->get();

        $html = "<option value=''>" . __('Select Province') . '</option>';
        foreach ($cities as $city) {
            $html .= "<option value='" . $city->id . "'>" . $city->name . '</option>';
        }

        return $html;
    }

    public function getStates($country_id)
    {
        $states = State::where('country_id', $country_id)->get();

        $html = "<option value=''>" . __('Select City') . '</option>';
        foreach ($states as $state) {
            $html .= "<option value='" . $state->id . "'>" . $state->name . '</option>';
        }

        $list = "<li data-value='' class='option'>" . __('Select City') . '</li>';
        foreach ($states as $state) {
            $list .= "<li data-value='" . $state->id . "' class='option'>" . $state->name . '</option>';
        }

        return response()->json(['success' => true, 'data' => $html, 'list' => $list]);
    }

    public function getStateInfo(Request $request)
    {
        $request->validate(['id' => 'required|exists:states']);

        $state_tax = StateTax::where('state_id', $request->id)->first();
        $default_shipping = CartAction::getDefaultShipping();
        $default_shipping_cost = CartAction::getDefaultShippingCost();
        $shipping_options = getCountryShippingCost('state', $request->id);
        $tax = $state_tax ? $state_tax->tax_percentage : 0;

        return response()->json([
            'tax'                   => $tax,
            'shipping_options'      => $shipping_options,
            'default_shipping'      => $default_shipping,
            'default_shipping_cost' => $default_shipping_cost,
        ], 200);
    }

    private function fallbackProductPage($page_post = null, $vendor = null)
    {
        $page_name = $page_post->name ?? 'Product';
        $display_item_count = request()->get('count') ?? 15;
        $all_category = Category::where('status_id', '1')->with('subcategory', 'subcategory.childcategory')->withCount('product')->get();
        $all_attributes = ProductAttribute::all();
        $all_tags = [];
        $all_units = Unit::all();
        $all_colors = Color::whereHas('product')->get();
        $all_sizes = Size::whereHas('product')->get();
        $all_brands = Brand::with('products')->get();

        $maximum_available_price = Product::query()->max('price');

        $min_price = request()->get('pr_min') ?? Product::query()->min('sale_price');
        $max_price = request()->get('pr_max') ?? $maximum_available_price;

        $item_style = request()->get('s') ?? 'grid';
        $sort_by = request()->get('sort');

        $request = request();
        if (!empty($vendor)) {
            $request->vendor_username = $vendor->username;
        }

        if ($request->count ?? true) {
            $request->count = get_static_option('default_item_count', 16);
        }

        // turn ?id=12 into ?category=Shoes
        if ($request->filled('id')) {
            if ($cat = \Modules\Attributes\Entities\Category::find($request->id)) {
                $request->merge(['category' => $cat->name]);
            }
        }

        // turn ?sub_cat_id=34 into ?sub_category=Sneakers
        if ($request->filled('sub_cat_id')) {
            if ($sub = \Modules\Attributes\Entities\SubCategory::find($request->sub_cat_id)) {
                $request->merge(['sub_category' => $sub->name]);
            }
        }

        // map category_id → category name for filters
        if ($request->filled('category_id') && $cat = \Modules\Attributes\Entities\Category::find($request->category_id)) {
            $request->merge(['category' => $cat->name]);
        }

        // map keyword → name param for productSearch
        if ($request->filled('keyword')) {
            $request->merge(['name' => $request->keyword]);
        }

        $all_products = FrontendProductServices::productSearch($request, 'frontend.ajax');

        // if (count($all_products['items'] ?? []) <= $display_item_count) {
        //     request()->page = 1;
        // }

        //  $all_products = FrontendProductServices::productSearch($request, 'frontend.ajax');
        // For AJAX requests, return JSON response
        if ($request->ajax()) {
            return response()->json([
                'grid'          => view('product::frontend.grid-style-07', ['all_products' => $all_products])->render(),
                'list'          => view('product::frontend.list-style-02', ['all_products' => $all_products])->render(),
                'showing_items' => __('Showing') . ' ' . $all_products['from'] . '-' . $all_products['to'] . ' ' . __('of') . ' ' . $all_products['total_items'] . ' ' . __('results'),
                'total_page'    => $all_products['total_page'],
            ]);
        }

        return view('frontend.dynamic-redirect.product', compact(
            'all_category',
            'all_attributes',
            'all_tags',
            'all_colors',
            'all_sizes',
            'all_units',
            'all_products',
            'all_brands',
            'min_price',
            'max_price',
            'display_item_count',
            'sort_by',
            'maximum_available_price',
            'item_style',
            'page_post',
            'page_name',
            'vendor'
        ));
    }

    private function fallbackBlogPage($page_post = null)
    {
        $page_name = $page_post->name ?? 'Blog';

        $all_blogs = Blog::with('category')->where('status', 'publish')->paginate();

        return view('frontend.dynamic-redirect.blog', [
            'padding_top'     => 100,
            'padding_bottom'  => 100,
            'all_blogs'       => $all_blogs,
            'readMoreBtnText' => __('Read More'),
            'page_post'       => $page_post,
            'page_name'       => $page_name,
        ]);
    }

    public function search(Request $request)
    {
        $all_products = FrontendProductServices::productSearch($request, 'frontend.ajax');

        $selected_search = view('product::frontend.search.selected-search-item')->render();
        $grid = view('product::frontend.search.grid', compact('all_products'))->render();
        $list = view('product::frontend.search.list', compact(['all_products']))->render();
        $paginationList = view('components.search-product-list-pagination', compact('all_products'))->render();
        $showing_items = __('Showing') . ' ' . $all_products['from'] . '-' . $all_products['to'] . ' ' . __('of') . ' ' . $all_products['total_items'] . ' ' . __('results');

        return [
            'pagination_list' => $paginationList,
            'grid'            => $grid,
            'list'            => $list,
            'selected_search' => $selected_search,
            'showing_items'   => $showing_items,
        ];
    }

    public function searchResults(Request $request)
    {
        $query = Product::with(['category']);

        // Search by product name
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by category if selected
        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }

        // Paginate results (12 per page)
        $all_products = $query->paginate(12);

        return view('frontend.product.search', compact('all_products'))
            ->with('showing_items', 'Showing ' . $all_products->firstItem() . '-' . $all_products->lastItem() . ' of ' . $all_products->total() . ' results');
    }

    public function checkPhoneExistence(Request $request)
    {
        $request->validate(['phone' => 'required']);

        $exists = User::where('phone', $request->phone)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function updateForgotPassword(Request $request)
    {
        $request->validate([
            'phone'                 => 'required',
            'password'              => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ]);

        // Here, you would fetch the user by phone
        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not found',
            ], 404);
        }

        // Update the password
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['status' => 'success']);
    }

    public function checkVendorPhoneExistence(Request $request)
    {
        $request->validate(['phone' => 'required']);

        $exists = Vendor::where('phone', $request->phone)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function updateVendorForgotPassword(Request $request)
    {
        $request->validate([
            'phone'                 => 'required',
            'password'              => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ]);

        // Here, you would fetch the vendor by phone
        $vendor = Vendor::where('phone', $request->phone)->first();
        if (!$vendor) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Vendor not found',
            ], 404);
        }

        // Update the password
        $vendor->password = Hash::make($request->password);
        $vendor->save();

        return response()->json(['status' => 'success']);
    }

    public function searchByImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Save uploaded image temporarily
        $uploadedPath = $request->file('image')->store('uploads/search-images', 'public');
        $uploadedImage = storage_path('app/public/' . $uploadedPath);

        // Get image hash for comparison
        $uploadedHash = $this->generateImageHash($uploadedImage);

        // Find similar products in the database
        $similarProducts = $this->findSimilarProducts($uploadedHash);

        return response()->json(['products' => $similarProducts]);
    }

    private function generateImageHash($imagePath)
    {
        $image = Image::make($imagePath)->resize(256, 256)->greyscale();
        $imageData = $image->encode('jpg');
        return md5($imageData);
    }

    private function findSimilarProducts($uploadedHash)
    {
        $products = Product::all();
        $matchingProducts = [];

        foreach ($products as $product) {
            if (!$product->image) {
                continue;
            }

            $productImagePath = storage_path('app/public/' . $product->image);
            if (!file_exists($productImagePath)) {
                continue;
            }

            $productHash = $this->generateImageHash($productImagePath);

            if ($this->hammingDistance($uploadedHash, $productHash) <= 5) { // Adjust threshold
                $matchingProducts[] = $product;
            }
        }

        return $matchingProducts;
    }

    private function hammingDistance($hash1, $hash2)
    {
        $dist = 0;
        for ($i = 0; $i < strlen($hash1); $i++) {
            if ($hash1[$i] !== $hash2[$i]) {
                $dist++;
            }
        }
        return $dist;
    }

    public function changeCurrencySymbol(Request $request)
    {
        Session::put('new_currency_symbol', $request->currency);
        return true;
    }
}
