<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use App\XGNotification;
use Illuminate\Http\Request;
use App\Helpers\CountryHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Modules\CountryManage\Entities\Country;
use Illuminate\Foundation\Auth\RegistersUsers;
use Modules\Wallet\Http\Services\WalletService;
use phpDocumentor\Reflection\Types\Null_;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |

    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @return string
     */
    public function redirectTo()
    {
        return route('user.home');
    }

    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'captcha_token' => ['nullable'],
            'username' => ['required', 'string', 'string', 'max:255', 'unique:users'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'agree_terms' => ['required'],
            'phone' => ['required', 'max:20', 'unique:users'],
            'phone_country_code' => ['nullable'],
        ], [
            'captcha_token.required' => __('google captcha is required'),
            'name.required' => __('name is required'),
            'name.max' => __('name is must be between 191 character'),
            'username.required' => __('username is required'),
            'username.max' => __('username is must be between 191 character'),
            'username.unique' => __('username is already taken'),
            'email.unique' => __('email is already taken'),
            // 'email.required' => __('email is required'),
            'password.required' => __('password is required'),
            'phone.required' => __('password is required'),
            'phone.unique' => __('phone is already taken'),
            'password.confirmed' => __('both password does not matched'),
            'required.required' => __('agreeing with terms and policies is required'),
        ]);
    }

    protected function adminValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:admins'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            //'country' => $data['country'],
            'state' => $data['state'] ?? null,
            'city' => $data['city'] ?? null,
            'username' => $data['username'],
            'phone' => $data['phone_country_code'] . $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        if (moduleExists("Wallet")) {
            WalletService::createWallet($user->id, "user");
        }

        $notification = new XGNotification();
        $notification->vendor_id  = null;
        $notification->delivery_man_id   = null;
        $notification->user_id   = $user->user_id;
        $notification->model  = 'App\User';
        $notification->model_id  = $user->id;
        $notification->message  = 'A new customer registerd successfully.';
        $notification->type  = 'create';
        $notification->is_read_admin  = 0;
        $notification->is_read_vendor  = 0;
        $notification->is_read_delivery_man  = 0;
        $notification->is_read_user  = 0;

        $notification->save();

        return $user;
    }

    protected function createAdmin(Request $request)
    {
        $this->adminValidator($request->all())->validate();
        $admin = Admin::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->route('admin.home');
    }

    public function showAdminRegistrationForm()
    {
        return view('auth.admin.register');
    }

    public function showRegistrationForm()
    {
        $all_country = Country::where('status', 'publish')->get();
        return view('frontend.user.register', compact('all_country'));
    }

    public function checkUserDataAvailability(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');

        $exists = false;
        $msg = '';

        if ($field === 'phone') {
            $exists = \DB::table('users')->where('phone', $value)->exists();
            $msg = 'Phone number already exists';
        } elseif ($field === 'email') {
            $exists = \DB::table('users')->where('email', $value)->exists();
            $msg = 'Email address already exists';
        } elseif ($field === 'username') {
            $exists = \DB::table('users')->where('username', $value)->exists();
            $msg = 'Username already taken';
        }

        if ($exists) {
            return response()->json(['error' => $msg], 409);
        }

        return response()->json(['success' => true], 200);
    }
}
