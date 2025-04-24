<?php
namespace Modules\Vendor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Vendor\Entities\Vendor;
use Modules\Wallet\Entities\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Vendor\Entities\BusinessType;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Vendor\Http\Requests\VendorRegistrationRequest;

class VendorLoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
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
            ->with(['msg' => __('You Logged Out !!'), 'type' => 'danger']);
    }

    public function login()
    {
        return view('vendor::vendor.login.index');
    }

    // public function vendor_login(Request $request): JsonResponse
    // {
    //     // First validate
    //     $req = $request->validate([
    //         'username' => 'nullable',
    //         'password' => 'min:6',
    //     ]);

    //     // Set login type
    //     $user_login_type = 'username';
    //     if (filter_var($req['username'], FILTER_VALIDATE_EMAIL)) {
    //         $user_login_type = 'email';
    //     }

    //     if (Auth::guard('vendor')->attempt([$user_login_type => $req['username'], 'password' => $req['password']], $request->get('remember'))) {
    //         Auth::guard('admin')->logout();
    //         return response()->json([
    //             'msg' => __('Login Success Redirecting'),
    //             'type' => 'success',
    //             'status' => 'ok',
    //         ]);
    //     }

    //     return response()->json([
    //         'msg' => sprintf(__('invalid %s or Password!!'), $user_login_type),
    //         'type' => 'danger',
    //         'status' => 'not_ok',
    //     ]);
    // }

    public function vendor_login(Request $request): JsonResponse
    {

        // $request->validate([
        //     'phone' => 'required|string',
        //     'password' => 'required|min:6',
        // ], [
        //     'phone.required' => __('Phone number or email is required'),
        //     'password.required' => __('Password is required'),
        //     'password.min' => __('Password must be at least 6 characters'),
        // ]);

        // $login_key = 'phone';
        // $input_value = $request->phone;

        // if (filter_var($input_value, FILTER_VALIDATE_EMAIL)) {
        //     $login_key = 'email';
        // }

        // if (Auth::guard('vendor')->attempt([$login_key => $request->phone, 'password' => $request->password], $request->get('remember'))) {

        //     Auth::guard('admin')->logout();

        //     return response()->json([
        //         'msg' => __('Login Success Redirecting'),
        //         'type' => 'success',
        //         'status' => 'ok',
        //     ]);

        // }

        // return response()->json([
        //     'msg' => sprintf(__('Incorrect account details. Please try again!!!!'), ucfirst($login_key)),
        //     'type' => 'danger',
        //     'status' => 'not_ok',
        // ]);


        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|min:6',
        ], [
            'phone.required' => __('Phone number or email is required'),
            'password.required' => __('Password is required'),
            'password.min' => __('Password must be at least 6 characters'),
        ]);

        $login_key = 'phone';
        $input_value = $request->phone;

        if (filter_var($input_value, FILTER_VALIDATE_EMAIL)) {
            $login_key = 'email';
        }

        $vendor = Vendor::where($login_key, $input_value)->first();

        if (!$vendor) {
            return response()->json([
                'msg' => __('Account not found.'),
                'type' => 'danger',
                'status' => 'invalid',
            ]);
        }

        if (!$vendor->is_vendor_verified) {
            return response()->json([
                'msg' => __('Your account is not verified. Please contact support.'),
                'type' => 'danger',
                'status' => 'invalid',
            ]);
        }

        // Attempt to log in
        if (Auth::guard('vendor')->attempt([$login_key => $input_value, 'password' => $request->password], $request->get('remember'))) {
            return response()->json([
                'msg' => __('Login Success. Redirecting...'),
                'type' => 'success',
                'status' => 'valid',
                'user_identification' => random_int(11111111, 99999999) . auth()->guard('web')->id() . random_int(11111111, 99999999),
            ]);
        }

        return response()->json([
            'msg' => ($login_key == 'email' ? __('Email') : __('Phone Number')) . __(' or Password does not match!'),
            'type' => 'danger',
            'status' => 'invalid',
        ]);

    }

    public function register()
    {
        abort_if(get_static_option('enable_vendor_registration') == 'off', 403);

        $data = [
            'business_type' => BusinessType::select()->get(),
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
        $data['is_vendor_verified'] = 0;
        $data['verified_at'] = null;

        // now create vendor
        $vendor = Vendor::create($data);
        // after creating vendor now need to create wallet
        if ($vendor) {
            Wallet::create([
                'user_id',
                'vendor_id' => $vendor->id,
                'balance' => 0,
                'pending_balance' => 0,
                'status' => 0,
            ]);
        }

        // now make login vendor here
        if (Auth::guard('vendor')->attempt(['username' => $vendor['username'], 'password' => $rawPassword], true)) {
            return redirect()->route('vendor.login')->with([
                'msg' => $vendor ? __('Registration success') : __('Registration failed'),
                'status' => (bool) $vendor,
            ]);
        }

        return $vendor ? [
            'msg' => __('registration success'),
            'type' => 'success',
        ] : [
            'msg' => __('Failed to register'),
            'type' => 'error',
        ];
    }

    public function checkVendorDataAvailability(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');

        $exists = false;

        if ($field === 'phone') {
            $exists = \DB::table('vendors')->where('phone', $value)->exists();
        } elseif ($field === 'email') {
            $exists = \DB::table('vendors')->where('email', $value)->exists();
        } elseif ($field === 'username') {
            $exists = \DB::table('vendors')->where('username', $value)->exists();
        }

        if ($exists) {
            return response()->json(['error' => ucfirst($field) . ' already exists.'], 409);
        }

        return response()->json(['success' => true], 200);
    }
}
