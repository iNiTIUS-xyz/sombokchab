<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Helpers\CountryHelper;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Twilio\Rest\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use HTTP_Request2;
use HTTP_Request2_Exception;
use Gloudemans\Shoppingcart\Facades\Cart;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function redirectTo()
    {
        return route('homepage');
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
            'username.required' => sprintf(__('%s is required.'), ucfirst($user_login_type)),
            'username.string' => sprintf(__('Please enter a valid %s.'), $user_login_type),
            'password.required' => __('Password is required.'),
            'password.min' => __('Your password must be at least 6 characters long.'),
        ]);

        if (Auth::guard('admin')->attempt([$user_login_type => $request->username, 'password' => $request->password], $request->get('remember'))) {
            Auth::guard('vendor')->logout();
            return response()->json([
                'msg' => __('Signed in successfully... Redirecting...'),
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

    // public function sendOtp(Request $request)
    // {
    //     $phone = $request->input('phone');

    //     // Generate 6-digit OTP
    //     $otp = mt_rand(100000, 999999);

    //     // Store OTP in cache for 5 minutes
    //     Cache::put('otp_' . $phone, $otp, now()->addMinutes(5));

    //     // Send OTP via SMS API
    //     $response = Http::post('http://smpp.revesms.com:7788/sendtext', [
    //         'apikey' => '815956373c0aa115',
    //         'secretkey' => 'de18c381',
    //         'callerID' => '01969910564',
    //         'toUser' => $phone,
    //         'messageContent' => "Your verification code is: $otp",
    //     ]);

    //     if ($response->successful()) {
    //         return response()->json(['success' => true]);
    //     }

    //     return response()->json(['error' => 'Failed to send OTP.'], 500);
    // }

    // public function verifyOtp(Request $request)
    // {
    //     $phone = $request->input('phone');
    //     $otp = $request->input('otp');
    //     $storedOtp = Cache::get('otp_' . $phone);

    //     if ($storedOtp && $storedOtp == $otp) {
    //         Cache::forget('otp_' . $phone); // Clear OTP after verification
    //         return response()->json(['success' => true]);
    //     }

    //     return response()->json(['error' => 'Invalid OTP'], 422);
    // }

    public function sendOtp(Request $request)
    {
        $phone = $request->input('phone');

        // Ensure phone is in PlasGate format (Bangladesh example)
        $phone = preg_replace('/[^0-9]/', '', $phone); // keep numbers only
        if (str_starts_with($phone, '0')) {
            $phone = '88' . $phone; // convert 017xx → 88017xx
        }

        // Generate OTP
        $otp = mt_rand(100000, 999999);

        // Store OTP for 5 minutes
        Cache::put('otp_' . $phone, $otp, now()->addMinutes(5));

        // PlasGate credentials
        $secretKey  = '$5$rounds=535000$tnyb7wdR4yyObXuy$XyyR4qHUkXZsbPZM6F8jsUI/CB.ndQWZMg3J1juww03';
        $privateKey = 'oi8-uaNHqBkJ2yX7OLULVBbdwdz2bUjy-x3aSozfFXKeBIrK5S7WUjPZiCC9CvRY9zo-QHXWgUxqVMeEyQf3jA';
        $senderName = 'PlasGateUAT';

        // Build payload
        $payload = [
            'sender'     => $senderName,
            'to'         => $phone,
            'content'    => "Your login OTP code is: {$otp}",
            'dlr'        => 'yes',
            'dlr_method' => 'GET',
            'dlr_level'  => 2,
            'dlr_url'    => url('/sms/dlr-callback')
        ];

        // Send request
        $response = Http::withHeaders([
            'X-Secret'      => $secretKey,
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
        ])->post("https://cloudapi.plasgate.com/rest/send?private_key={$privateKey}", $payload);

        // ⛔️ DEBUG HERE
        dd([
            'phone'      => $phone,
            'otp'        => $otp,
            'cached_otp' => Cache::get('otp_' . $phone),
            'payload'    => $payload,
            'status'     => $response->status(),
            'response'   => $response->json(),
            'raw'        => $response->body(),
        ]);

        // Debug raw body
        // Log::info('PlasGate Response', ['body' => $response->body()]);

        if ($response->successful()) {
            $result = $response->json();

            // PlasGate returns status inside JSON. We must check it.
            if (isset($result['status']) && $result['status'] == 'ACCEPTED') {
                return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
            }

            return response()->json(['error' => 'API returned non-success', 'details' => $result], 500);
        }

        return response()->json([
            'error' => 'Failed to send OTP',
            'details' => $response->body()
        ], 500);
    }




    public function verifyOtp(Request $request)
    {
        $phone = $request->input('phone');
        $otp = $request->input('otp');

        $storedOtp = Cache::get('otp_' . $phone);

        if ($storedOtp && $storedOtp == $otp) {
            Cache::forget('otp_' . $phone);
            return response()->json(['success' => true, 'message' => 'OTP verified']);
        }

        return response()->json(['error' => 'Invalid or expired OTP'], 422);
    }


    // public function sendOtp(Request $request)
    // {
    //     $phone = $request->input('phone');
    //     $countryCode = substr($phone, 0, strpos($phone, substr($phone, 1))); // Extract country code, e.g., +880
    //     $mobileNumber = substr($phone, strlen($countryCode)); // Extract number without country code

    //     // Generate 6-digit OTP
    //     $otp = mt_rand(100000, 999999);

    //     // Store OTP and verification ID in cache for 5 minutes
    //     Cache::put('otp_' . $phone, $otp, now()->addMinutes(5));

    //     // Send OTP via MessageCentral API
    //     $httpRequest = new HTTP_Request2();
    //     $httpRequest->setUrl('https://cpaas.messagecentral.com/verification/v3/send?countryCode=' . urlencode(ltrim($countryCode, '+')) . '&customerId=C-85CEA3ED9911442&flowType=SMS&mobileNumber=' . urlencode($mobileNumber));
    //     $httpRequest->setMethod(HTTP_Request2::METHOD_POST);
    //     $httpRequest->setConfig(['follow_redirects' => TRUE]);
    //     $httpRequest->setHeader([
    //         'authToken' => 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJDLTg1Q0VBM0VEOTkxMTQ0MiIsImlhdCI6MTc1MDQ4NjQ0MSwiZXhwIjoxOTA4MTY2NDQxfQ.4cZhYPYEuo7-dPbZI5Kk_RIU5Hw-L2-dPGZnIkai2EQeeggi0gsb47QVuftpea2EKM1xwjbrm_Dclhpt7Jeyjg'
    //     ]);

    //     try {
    //         $response = $httpRequest->send();
    //         if ($response->getStatus() == 200) {
    //             $responseBody = json_decode($response->getBody(), true);
    //             Cache::put('verification_id_' . $phone, $responseBody['data']['verificationId'], now()->addMinutes(5));
    //             return response()->json(['success' => true]);
    //         } else {
    //             return response()->json(['error' => 'Failed to send OTP: ' . $response->getReasonPhrase()], 500);
    //         }
    //     } catch (HTTP_Request2_Exception $e) {
    //         return response()->json(['error' => 'Error sending OTP: ' . $e->getMessage()], 500);
    //     }
    // }

    // public function verifyOtp(Request $request)
    // {
    //     $phone = $request->input('phone');
    //     $otp = $request->input('otp');
    //     $storedOtp = Cache::get('otp_' . $phone);
    //     $verificationId = Cache::get('verification_id_' . $phone);
    //     $countryCode = substr($phone, 0, strpos($phone, substr($phone, 1))); // Extract country code
    //     $mobileNumber = substr($phone, strlen($countryCode)); // Extract number without country code

    //     if (!$verificationId) {
    //         return response()->json(['error' => 'Verification ID not found'], 422);
    //     }

    //     // Verify OTP via MessageCentral API
    //     $httpRequest = new HTTP_Request2();
    //     $httpRequest->setUrl('https://cpaas.messagecentral.com/verification/v3/validateOtp?countryCode=' . urlencode(ltrim($countryCode, '+')) . '&mobileNumber=' . urlencode($mobileNumber) . '&verificationId=' . urlencode($verificationId) . '&customerId=C-85CEA3ED9911442&code=' . urlencode($otp));
    //     $httpRequest->setMethod(HTTP_Request2::METHOD_GET);
    //     $httpRequest->setConfig(['follow_redirects' => TRUE]);
    //     $httpRequest->setHeader([
    //         'authToken' => 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJDLTg1Q0VBM0VEOTkxMTQ0MiIsImlhdCI6MTc1MDQ4NjQ0MSwiZXhwIjoxOTA4MTY2NDQxfQ.4cZhYPYEuo7-dPbZI5Kk_RIU5Hw-L2-dPGZnIkai2EQeeggi0gsb47QVuftpea2EKM1xwjbrm_Dclhpt7Jeyjg'
    //     ]);

    //     try {
    //         $response = $httpRequest->send();
    //         if ($response->getStatus() == 200 && $storedOtp == $otp) {
    //             Cache::forget('otp_' . $phone);
    //             Cache::forget('verification_id_' . $phone);
    //             return response()->json(['success' => true]);
    //         } else {
    //             return response()->json(['error' => 'Invalid OTP'], 422);
    //         }
    //     } catch (HTTP_Request2_Exception $e) {
    //         return response()->json(['error' => 'Error verifying OTP: ' . $e->getMessage()], 500);
    //     }
    // }

    public function showLoginForm()
    {
        $all_country = CountryHelper::getAllCountries();
        return view('frontend.user.login', compact('all_country'));
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            $userId = Auth::guard('web')->id();

            try {
                // Store all cart instances before session is destroyed
                Cart::instance('default')->store($userId);
                Cart::instance('wishlist')->store($userId);
                Cart::instance('compare')->store($userId);
            } catch (\Exception $e) {
                \Log::warning("Cart store failed for user {$userId}: " . $e->getMessage());
            }

            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('homepage')->with('status', __('You have been logged out successfully.'));
    }
}
