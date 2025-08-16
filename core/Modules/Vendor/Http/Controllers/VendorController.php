<?php

namespace Modules\Vendor\Http\Controllers;

use App\Mail\BasicMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Campaign\Entities\Campaign;
use Modules\Order\Entities\SubOrder;
use Modules\Product\Entities\Product;
use Modules\Vendor\Entities\Vendor;
use Modules\Vendor\Http\Services\VendorServices;
use Illuminate\Http\JsonResponse;
use Modules\CountryManage\Entities\State;
use Modules\CountryManage\Entities\City;

class VendorController extends Controller
{
    public function adminIndex()
    {
        return "Admin Index method rendered";
    }

    public function index()
    {
        $income_daily = SubOrder::selectRaw("DATE_FORMAT(created_at, '%a') as label, SUM(total_amount) as amount")
            ->where('vendor_id', auth("vendor")->id())
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('label')
            ->get();

        // Income Statement (Weekly - Last 4 weeks)
        $income_weekly = SubOrder::selectRaw("YEARWEEK(created_at, 1) as week, SUM(total_amount) as amount")
            ->where('vendor_id', auth("vendor")->id())
            ->whereBetween('created_at', [Carbon::now()->subWeeks(4), Carbon::now()])
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('week')
            ->get();

        // Income Statement (Monthly - Current Year)
        $income_monthly = SubOrder::selectRaw("DATE_FORMAT(created_at, '%b') as label, SUM(total_amount) as amount")
            ->where('vendor_id', auth("vendor")->id())
            ->whereYear('created_at', Carbon::now()->year)
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('label')
            ->get();

        // Income Statement (Yearly - Last 5 Years)
        $income_yearly = SubOrder::selectRaw("YEAR(created_at) as label, SUM(total_amount) as amount")
            ->where('vendor_id', auth("vendor")->id())
            ->whereYear('created_at', '>=', Carbon::now()->subYears(5)->year)
            ->whereHas('orderTrack', fn($q) => $q->where('name', 'delivered'))
            ->groupBy('label')
            ->get();

        return view("vendor::vendor.home.index", compact(
            'income_daily',
            'income_weekly',
            'income_monthly',
            'income_yearly',
        ));
    }


    public function user_email_verify_index()
    {
        $user_details = Auth::guard('vendor')->user();

        if ($user_details->email_verified == 1) {
            return redirect()->route('vendor.home');
        }

        if (empty($user_details->email_verify_token)) {
            Vendor::find($user_details->id)->update(['email_verify_token' => \Str::random(8)]);

            $user_details = Vendor::find($user_details->id);
            $message_body = __('Here is your verification code') . ' <span class="verify-code">' . $user_details->email_verify_token . '</span>';

            try {
                Mail::to($user_details->email)->send(new BasicMail([
                    'subject' => __('Verify your email address'),
                    'message' => $message_body
                ]));
            } catch (\Exception $e) {
                //
            }
        }

        return view('vendor::vendor.vendor.email-verify');
    }

    public function reset_user_email_verify_code()
    {
        $user_details = Auth::guard('vendor')->user();
        if ($user_details->email_verified == 1) {
            return redirect()->route('vendor.home');
        }

        $message_body = __('Here is your verification code') . ' <span class="verify-code">' . $user_details->email_verify_token . '</span>';

        try {
            Mail::to($user_details->email)->send(new BasicMail([
                'subject' => __('Verify your email address'),
                'message' => $message_body
            ]));
        } catch (\Exception $e) {
            return redirect()->route('vendor.email.verify')->with(['msg' => $e->getMessage(), 'type' => 'danger']);
        }

        return redirect()->route('vendor.email.verify')->with(['msg' => __('Resend Verify Email Success'), 'type' => 'success']);
    }

    public function user_email_verify(Request $request)
    {
        $request->validate([
            'verification_code' => 'required'
        ], [
            'verification_code.required' => __('verify code is required')
        ]);

        $user_details = Auth::guard('vendor')->user();
        $user_info = Vendor::where(['id' => $user_details->id, 'email_verify_token' => $request->verification_code])->first();

        if (empty($user_info)) {
            return redirect()->back()->with(['msg' => __('your verification code is wrong, try again'), 'type' => 'danger']);
        }

        $user_info->email_verified = 1;
        $user_info->save();

        return redirect()->route('vendor.home');
    }

    public function get_state(Request $request): JsonResponse
    {
        $id = $request->validate(["country_id" => "required"]);
        $states = State::where("country_id", $id)->get();

        return response()->json(["success" => true, "type" => "success"] + render_view_for_nice_select($states));
    }
    public function get_city(Request $request): JsonResponse
    {
        $id = $request->validate(["country_id" => "required", "state_id" => "required"]);
        $states = City::where($id)->get();

        return response()->json(["success" => true, "type" => "success"] + render_view_for_nice_select($states));
    }
}
