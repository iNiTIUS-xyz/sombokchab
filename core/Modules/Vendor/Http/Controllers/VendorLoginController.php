<?php
namespace Modules\Vendor\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Vendor\Entities\BusinessType;
use Modules\Vendor\Entities\Vendor;
use Modules\Vendor\Http\Requests\VendorRegistrationRequest;
use Modules\Wallet\Entities\Wallet;

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
        // Validate the input
        $req = $request->validate([
            'username' => 'required',       // Ensure username is provided
            'password' => 'required|min:6', // Ensure password is provided
        ]);

                                       // Determine login type (email, phone, or username)
        $user_login_type = 'username'; // Default is username

        if (filter_var($req['username'], FILTER_VALIDATE_EMAIL)) {
            $user_login_type = 'email'; // If the input is a valid email, set type to email
        } elseif (preg_match('/^\+?(1|855|880)\d{9,15}$/', $req['username'])) {
            $user_login_type = 'phone'; // If the input matches phone number format, set type to phone
        }

        // Attempt login with the determined login type and password
        if (Auth::guard('vendor')->attempt([$user_login_type => $req['username'], 'password' => $req['password']], $request->get('remember'))) {
            // Logout admin guard to prevent conflicts
            Auth::guard('admin')->logout();

            return response()->json([
                'msg'    => __('Login Success Redirecting'),
                'type'   => 'success',
                'status' => 'ok',
            ]);
        }

        // Return error response if login fails
        return response()->json([
            'msg'    => sprintf(__('Incorrect account details. Please try again!!!!'), ucfirst($user_login_type)),
            'type'   => 'danger',
            'status' => 'not_ok',
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
        $rawPassword      = $data['password'];
        $data['password'] = \Hash::make($data['password']);

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

        // now make login vendor here
        if (Auth::guard('vendor')->attempt(['username' => $vendor['username'], 'password' => $rawPassword], true)) {
            return redirect()->route('vendor.login')->with([
                'msg'    => $vendor ? __('Registration success') : __('Registration failed'),
                'status' => (bool) $vendor,
            ]);
        }

        return $vendor ? [
            'msg'  => __('registration success'),
            'type' => 'success',
        ] : [
            'msg'  => __('Failed to register'),
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
