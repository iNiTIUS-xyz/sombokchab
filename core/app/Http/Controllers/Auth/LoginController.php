<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Helpers\CountryHelper;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function redirectTo()
    {
        return route('homepage');
        // return route('user.home');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin.login');
    }

    public function adminLogin(Request $request)
    {
        $user_login_type = 'username';
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $user_login_type = 'email';
        }

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:6',
        ], [
            'username.required' => sprintf(__('%s required'), $user_login_type),
            'password.required' => __('password required'),
        ]);

        if (Auth::guard('admin')->attempt([$user_login_type => $request->username, 'password' => $request->password], $request->get('remember'))) {
            Auth::guard('vendor')->logout();
            return response()->json([
                'msg' => __('Login Success Redirecting'),
                'type' => 'success',
                'status' => 'ok',
            ]);
        }

        return response()->json([
            'msg' => sprintf(__('Incorrect account details. Please try again!!'), $user_login_type),
            'type' => 'danger',
            'status' => 'not_ok',
        ]);
    }
    public function sendOtp(Request $request)
    {
        $phone = $request->input('phone');

        // Generate 6-digit OTP
        $otp = mt_rand(100000, 999999);

        // Store OTP in cache for 5 minutes
        Cache::put('otp_' . $phone, $otp, now()->addMinutes(5));

        // Send OTP via SMS API
        $response = Http::post('http://smpp.revesms.com:7788/sendtext', [
            'apikey' => '815956373c0aa115',
            'secretkey' => 'de18c381',
            'callerID' => '01969910564',
            'toUser' => $phone,
            'messageContent' => "Your verification code is: $otp",
        ]);

        if ($response->successful()) {
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Failed to send OTP'], 500);
    }

    public function verifyOtp(Request $request)
    {
        $phone = $request->input('phone');
        $otp = $request->input('otp');
        $storedOtp = Cache::get('otp_' . $phone);

        if ($storedOtp && $storedOtp == $otp) {
            Cache::forget('otp_' . $phone); // Clear OTP after verification
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Invalid OTP'], 422);
    }

    public function showLoginForm()
    {
        $all_country = CountryHelper::getAllCountries();
        return view('frontend.user.login', compact('all_country'));
    }

}
