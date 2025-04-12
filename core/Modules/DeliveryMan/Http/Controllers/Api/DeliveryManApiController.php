<?php

namespace Modules\DeliveryMan\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Language;
use App\Mail\BasicMail;
use App\Page;
use App\XGNotification;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use Modules\DeliveryMan\Entities\DeliveryMan;
use Modules\DeliveryMan\Entities\DeliveryManOrder;
use Modules\DeliveryMan\Entities\DeliveryManZone;
use Modules\DeliveryMan\Http\Requests\Api\PresentAndPermanentAddressUpdateRequest;
use Modules\DeliveryMan\Http\Requests\Api\UpdateDeliveryManProfileRequest;
use Modules\DeliveryMan\Http\Resources\DeliveryManNotificationResource;
use Modules\DeliveryMan\Services\AdminDeliveryManServices;
use Modules\DeliveryMan\Services\DeliveryManNotificationService;
use Modules\DeliveryMan\Services\DeliveryManServices;
use Validator;

final class DeliveryManApiController extends Controller
{
    /**
     * @throws Exception
     */
    public function profileUpdate(UpdateDeliveryManProfileRequest $request): JsonResponse
    {
        $data = $request->validated();
        $oldDeliveryMan = DeliveryMan::with("zone","credentials","presentAddress","permanentAddress")->find(auth()->user()->id);

        // first we need to create delivery man
        AdminDeliveryManServices::updateDeliveryMan($data, $oldDeliveryMan);

        // store delivery man credentials
        AdminDeliveryManServices::updateCredentials($data, $oldDeliveryMan->credentials, auth()->user()->id);

        return response()->json([
            "status" => true,
            "msg" => __("Delivery man profile is updated")
        ]);
    }

    public function updateDeliveryManAddress(PresentAndPermanentAddressUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $oldDeliveryMan = DeliveryMan::with("zone","credentials","presentAddress","permanentAddress")->find(auth()->user()->id);

        // store permanent address
        AdminDeliveryManServices::updatePermanentAddress($data, $oldDeliveryMan);
        // store present address
        AdminDeliveryManServices::updatePresentAddress($data, $oldDeliveryMan);

        return response()->json([
            "status" => true,
            "msg" => __("Successfully updated present address and permanent address")
        ]);
    }

    public function updateFirebaseToken(Request $request): JsonResponse
    {
        $data = $request->validate([
            "token" => "required|string"
        ]);

        DeliveryMan::where("id", auth()->user()->id)->update([
            "firebase_device_token" => $data["token"]
        ]);

        return response()->json([
            "msg" => __("Successfully updated firebase token."),
            "status" => true
        ]);
    }

    public function sendOTPSuccess(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'user_id' => 'required|integer',
            'email_verified' => 'required|integer',
        ]);

        if ($validate->fails()){
            return response()->json([
                'validation_errors' => $validate->messages()
            ])->setStatusCode(422);
        }

        if(!in_array($request->email_verified,[0,1])){
            return response()->json([
                'message' => __('email verify code must have to be 1 or 0'),
            ])->setStatusCode(422);
        }

        $user = (new DeliveryMan)->where('id', $request->user_id)->update([
            'email_verified' =>  $request->email_verified
        ]);

        if(is_null($user)){
            return response()->json([
                'message' => __('Something went wrong, please try after sometime,'),
            ])->setStatusCode(422);
        }

        return response()->json([
            'message' => __('Email Verify Success'),
        ]);
    }

    public function sendOTP(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email' => 'required',
        ]);

        if ($validate->fails()){
            return response()->json([
                'validation_errors' => $validate->messages()
            ])->setStatusCode(422);
        }

        $otp_code = sprintf("%d", random_int(111111, 999999));
        $user_email = DeliveryMan::where('email', $request->email)->first();

        if (!is_null($user_email)) {
            try {
                DeliveryMan::where('email', $request->email)->update([
                    "verify_token" => $otp_code,
                ]);

                $message_body = __('Here is your otp code') . ' <span class="verify-code">' . $otp_code . '</span>';
                Mail::to($request->email)->send(new BasicMail([
                    'subject' => __('Your OTP Code'),
                    'message' => $message_body
                ]));
            } catch (Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ])->setStatusCode(422);
            }

            return response()->json([
                'email' => $request->email,
                'otp' => $otp_code,
            ]);

        }

        return response()->json([
            'message' => __('Email Does not Exists'),
        ])->setStatusCode(422);

    }

    //reset password
    public function resetPassword(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
            'otp' => 'required'
        ]);

        if ($validate->fails()){
            return response()->json([
                'validation_errors' => $validate->messages()
            ])->setStatusCode(422);
        }

        $email = $request->email;

        $user = DeliveryMan::select('email','verify_token')
            ->where('email', $email)
            ->first();

        // check delivery man email verify token with requested otp data
        if($user->verify_token != $request->otp){
            return response()->json([
                "msg" => __("Otp not correct please try again with correct otp."),
                "status" => false
            ]);
        }

        if (!is_null($user)) {
            DeliveryMan::where('email', $user->email)->update([
                'password' => Hash::make($request->password),
            ]);
            
            return response()->json([
                'message' => 'success',
            ]);
        } else {
            return response()->json([
                'message' => __('Email Not Found'),
            ])->setStatusCode(422);
        }
    }
    public function changePassword(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6',
        ]);

        if ($validate->fails()){
            return response()->json([
                'validation_errors' => $validate->messages()
            ])->setStatusCode(422);
        }

        $user = DeliveryMan::select('id','password')->where('id', auth('sanctum')->user()->id)->first();
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => __('Current Password is Wrong'),
            ])->setStatusCode(422);
        }

        DeliveryMan::where('id',auth('sanctum')->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json([
            'current_password' => $request->current_password,
            'new_password' => $request->new_password,
        ]);
    }

    public function deleteAccount(): JsonResponse
    {
        $user_id = auth('sanctum')->user()->id;

        $user = DeliveryMan::with('userCountry','shipping','userState')
            ->where('id',$user_id)->delete();

        return response()->json([
            "status" => $user
        ]);
    }

    public function orderHistory(): JsonResponse
    {
        return response()->json(DeliveryManServices::histories(auth()->user()->id));
    }

    public function ratings(): DeliveryMan
    {
        return DeliveryManServices::ratings(auth()->user()->id);
    }

    public function termsAndCondition(): JsonResponse
    {
        $selected_page = get_static_option("checkout_page_terms_link_url");

        $page = Page::where('slug', $selected_page)->select( "title","content")->first();
        return response()->json($page);
    }

    public function privacyPolicy(): JsonResponse
    {
        $selected_page = get_static_option("mobile_privacy_and_policy");

        $page = Page::where('id', $selected_page)->select( "title","content")->first();
        return response()->json($page);
    }

    /**
     * @return JsonResponse
     */
    public function profile(): JsonResponse
    {
        // delivery man profile information
        $deliveryMan = DeliveryMan::with([
            "credentials",
            "zone:id,name",
            "presentAddress.country:id,name",
            "permanentAddress.country:id,name",
            "presentAddress.state:id,name",
            "permanentAddress.state:id,name",
            "presentAddress.city:id,name",
            "permanentAddress.city:id,name",
        ])->where("id",auth('sanctum')->user()->id)->first()->toArray();

        return response()->json([
            "status" => true,
            "deliveryMan" => $deliveryMan,
        ]);
    }


    /**
     * @return JsonResponse
     */
    public function orderList(): JsonResponse
    {
        // get delivery man id from auth
        // display last 10 transaction
        // display last 10 order
        // display current order list
        // display last 10 review
        $deliveryMan = DeliveryMan::find(auth()->user()->id);

        $ordersList = DeliveryManOrder::with([
            "order.address",
            "order.address.country",
            "order.address.state",
            "order.address.cityInfo",
            "pickupPoint",
            "pickupPoint.country:id,name",
            "pickupPoint.state:id,name,country_id",
            "pickupPoint.city:id,name,state_id",
            "orderTrack" => function ($query){
                return $query->select("order_tracks.id","order_id","name")
                    ->orderByDesc("order_tracks.id")->latest('id')->limit(1);
            }
        ])->whereDoesntHave("orderTrack", function ($orderTrackQuery) {
            $orderTrackQuery->where("name", "delivered");
        })->whereHas("orderTrack")
        ->where("delivery_man_id", auth()->user()->id)->get();

        return response()->json([
            "delivery_man" => $deliveryMan,
            "order_list" => $ordersList
        ]);
    }

    public function trackSingleOrder(int $order_id): JsonResponse
    {
        $delivery_man_id = auth('sanctum')->user()->id;

        // check delivery man and order id if exist then go forward
        $order = DeliveryManOrder::with([
            "order",
            "order.address",
            "order.address.country:id,name",
            "order.address.state:id,name,country_id",
            "order.address.cityInfo:id,name,state_id",
            "orderTrack" => function ($query){
                return $query->select("order_tracks.id","order_id","name")
                    ->orderByDesc("order_tracks.id")->latest('id')->limit(1);
            },
            "deliveryMan",
            "pickupPoint",
            "pickupPoint.country:id,name",
            "pickupPoint.state:id,name,country_id",
            "pickupPoint.city:id,name,state_id",
        ])->where("order_id", $order_id)
        ->where("delivery_man_id", $delivery_man_id)->first();

        // check if order is empty then send response wrong
        if(empty($order)){
            return response()->json([
                "status" => false,
                "msg" => __("No order found")
            ], 404);
        }

        $pickupPoint = $order->pickupPoint;
        $deliveryManAddr = $order->deliveryMan?->presentAddress ?? "";

        $deliveryOrderAddress = DeliveryManServices::generateDeliveryOrderAddress($order);
        $pickupPointAddress = DeliveryManServices::generatePickupPointAddress($pickupPoint);
        $deliveryManAddress = DeliveryManServices::generateDeliveryManAddress($deliveryManAddr);

        return response()->json([
            "order" => $order,"deliveryOrderAddress" => $deliveryOrderAddress,
            "pickupPointAddress" => $pickupPointAddress,"deliveryManAddress" => $deliveryManAddress,
            "from" => $pickupPointAddress,
            "to" => $deliveryOrderAddress,
            "latitude" => $order->deliveryMan?->latitude,
            "longitude" => $order->deliveryMan?->longitude,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function site_currency_symbol(): JsonResponse
    {
        // get user language direction
        $is_rtl_on_or_not = get_user_lang_direction() == 1 ?? false;

        return response()->json([
            "symbol" => site_currency_symbol(),
            "currencyPosition" => get_static_option('site_currency_symbol_position'),
            "rtl" => $is_rtl_on_or_not,
            "currency_code" => get_static_option("site_global_currency"),
            "language" => Language::where("default",1)->first()
        ]);
    }

    public function translateString(Request $request)
    {
        $translate_able_array = json_decode($request->get('strings'),true);

        $translated_array = [];
        if($request->has('strings')){
            foreach($translate_able_array as $key => $string)
            {
                $translated_array[$key] = __($key);
            }
        }

        return response()->json([
            'strings'=> $translated_array
        ]);
    }

    public function dashboard(Request $request)
    {
        $deliveryMans = AdminDeliveryManServices::getDeliveryMan($request, auth('sanctum')->user()->id);

        $totalIncome = 0;
        // this line gives you the sum of commission amount
        $orders = DB::table(DeliveryManOrder::getTableName())
            ->select("order_tracks.*",DB::raw('(CASE WHEN commission_type = "amount" THEN commission_amount ELSE (total_amount * commission_amount) / 100 END) AS order_commission_amount'))
            ->leftJoin("order_tracks",DeliveryManOrder::getTableName().".order_id","=","order_tracks.order_id")
            ->where("delivery_man_id", auth('sanctum')->user()->id)
            ->where("order_tracks.name", "delivered")
            ->get();

        foreach($orders as $order){
            $totalIncome += $order->order_commission_amount;
        }

        $deliveryMans->total_earnings = $totalIncome;
        $deliveryMans->delivery_man_queue_order = $deliveryMans->delivery_man_total_orders_count - $deliveryMans->delivery_man_order_count;

        return $deliveryMans;
    }

    public function zoneList(): JsonResponse
    {
        return response()->json([
            "zones" => DeliveryManZone::select("id","name")->get()
        ]);
    }

    public function essentialData(): JsonResponse
    {
        return response()->json([
            "unread_notification_count" => xgUnReadNotifications('delivery_man'),
            "deliveryManTypes" => deliveryManTypes(),
            "vehicleTypes" => vehicleTypes(),
            "identityTypes" => identityTypes(),
            "availableStatus" => [
                "on_the_way",
                "ready_for_pickup",
                "delivered",
            ],
            "file_path" => asset(AdminDeliveryManServices::IMAGE_DIRECTORY)
        ]);
    }

    public function notification(){
        return DeliveryManNotificationResource::collection(XGNotification::where("delivery_man_id", auth()->user()->id)->latest()->paginate(15));
    }

    public function updateNotification()
    {
        XGNotification::where('is_read_delivery_man', 0)->where('delivery_man_id', auth()->user()->id)->update(['is_read_delivery_man' => 1]);

        return response()->json([
            "msg" => __("Notification updated")
        ]);
    }
}
