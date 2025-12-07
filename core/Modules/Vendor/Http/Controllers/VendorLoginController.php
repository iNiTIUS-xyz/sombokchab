<?php

namespace Modules\Vendor\Http\Controllers;

use App\XGNotification;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Vendor\Entities\BusinessType;
use Modules\Vendor\Entities\Vendor;
use Modules\Vendor\Http\Requests\VendorRegistrationRequest;
use Modules\Wallet\Entities\Wallet;

class VendorLoginController extends Controller
{
    use AuthenticatesUsers;

    public function redirectTo()
    {
        return route('vendor.home');
    }

    public function username()
    {
        return 'username';
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('vendor.login')
            ->with(['msg' => __('Sign out successful.'), 'type' => 'success']);
    }

    public function login()
    {
        return view('vendor::vendor.login.index');
    }

    public function vendor_login(Request $request)
    {
        // Custom validation to check phone number content
        $validator = \Validator::make($request->all(), [
            'phone'    => [
                'required_without:email',
                function ($attribute, $value, $fail) {
                    $countryCode = ['+1', '+880', '+855']; // Match your country code options
                    $phoneNumber = str_replace($countryCode, '', $value); // Remove country code
                    if (empty(trim($phoneNumber))) {
                        $fail(__('Phone number or email is required.'));
                    }
                },
            ],
            // 'email' => 'required_without:phone|email',
            'password' => 'required|min:8',
        ], [
            'phone.required_without' => __('Phone number or email is required.'),
            // 'email.required_without' => __('Phone number or email is required.'),
            // 'email.email' => __('Invalid email format.'),
            'password.required'      => __('Password is required.'),
            'password.min'           => __('Account credentials do not match.'),
        ]);

        if ($validator->fails()) {
            \Log::info('Validation Errors: ' . json_encode($validator->errors()));
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $login_key = 'phone';
        $input_value = $request->phone;

        if ($request->filled('email')) {
            $login_key = 'email';
            $input_value = $request->email;
        } elseif (filter_var($input_value, FILTER_VALIDATE_EMAIL)) {
            $login_key = 'email';
        }

        $vendor = Vendor::where($login_key, $input_value)->first();

        if (!$vendor) {
            return response()->json([
                'msg'    => __('Account not found.'),
                'type'   => 'danger',
                'status' => 'invalid',
            ], 404);
        }

        if (!$vendor->is_vendor_verified) {
            return response()->json([
                'msg'    => __('Your account is not verified. Please contact support.'),
                'type'   => 'danger',
                'status' => 'invalid',
            ], 403);
        }

        $credentials = [
            $login_key => $input_value,
            'password' => $request->password,
        ];

        if (Auth::guard('vendor')->attempt($credentials, $request->get('remember'))) {
            return response()->json([
                'msg'                 => __('Signed in successfully... Redirecting...'),
                'type'                => 'success',
                'status'              => 'valid',
                'user_identification' => random_int(11111111, 99999999) . auth()->guard('vendor')->id() . random_int(11111111, 99999999),
            ]);
        }

        return response()->json([
            'msg'    => __('Account credentials do not match.'),
            'type'   => 'danger',
            'status' => 'invalid',
        ], 401);
    }

    public function register()
    {
        abort_if(get_static_option('enable_vendor_registration') == 'off', 403);

        $data = [
            'business_type' => BusinessType::get(),
        ];

        return view('vendor::vendor.register.index', $data);
    }

    public function vendor_registration(VendorRegistrationRequest $request)
    {
        abort_if(get_static_option('enable_vendor_registration') == 'off', 403);
        // store validated data into a temporary variable
        $data = $request->all() ?? $request->validated();
        // now change password value and make it hash
        $rawPassword = $data['password'];
        $data['password'] = Hash::make($data['password']);
        // if you want to register automatically as verified vendor then change null to 1 and Carbon::now()
        $data['is_vendor_verified'] = null; // 1
        $data['verified_at'] = null; // Carbon::now();
        $data['phone'] = $data['phone_country_code'] . $data['phone'];
        $data['owner_name'] = $request->username;
        // dd($data, $request->all());
        // now create vendor
        $vendor = Vendor::create($data);

        // after creating vendor now need to create wallet
        if ($vendor) {
            Wallet::create([
                'user_id',
                'vendor_id'       => $vendor->id,
                'balance'         => 0,
                'pending_balance' => 0,
                'status'          => 0,
            ]);
        }

        $notification = new XGNotification();
        $notification->vendor_id = $vendor->id;
        $notification->delivery_man_id = null;
        $notification->user_id = null;
        $notification->model = 'Modules\Vendor\Entities\Vendor';
        $notification->model_id = $vendor->id;
        $notification->message = 'A new vendor registerd successfully.';
        $notification->type = 'vendor_register';
        $notification->is_read_admin = 0;
        $notification->is_read_vendor = 0;
        $notification->is_read_delivery_man = 0;
        $notification->is_read_user = 0;
        $notification->save();

        // now make login vendor here
        if (Auth::guard('vendor')->attempt(['username' => $vendor['username'], 'password' => $rawPassword], true)) {
            return redirect()->route('vendor.login')->with([
                'msg'    => $vendor ? __('Registration success') : __('Registration failed'),
                'status' => (bool) $vendor,
            ]);
        }

        return $vendor ? [
            'msg'  => __('registration success.'),
            'type' => 'success',
        ] : [
            'msg'  => __('Failed to register.'),
            'type' => 'error',
        ];
    }

    public function checkVendorDataAvailability(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');

        $exists = false;

        $msg = '';

        if ($field === 'phone') {
            $exists = \DB::table('vendors')->where('phone', $value)->exists();

            $msg = 'Phone number already exists.';
        } elseif ($field === 'email') {
            $exists = \DB::table('vendors')->where('email', $value)->exists();

            $msg = 'Email address already exists.';
        } elseif ($field === 'username') {
            $exists = \DB::table('vendors')->where('username', $value)->exists();

            $msg = 'Username already taken.';
        }

        if ($exists) {
            return response()->json(['error' => $msg], 409);
        }

        return response()->json(['success' => true], 200);
    }
}
