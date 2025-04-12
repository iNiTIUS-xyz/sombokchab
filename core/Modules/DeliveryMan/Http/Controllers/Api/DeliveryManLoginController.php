<?php

namespace Modules\DeliveryMan\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\DeliveryMan\Entities\DeliveryMan;
use Modules\DeliveryMan\Http\Requests\Api\DeliveryManLoginRequest;

class DeliveryManLoginController extends Controller
{
    /**
     * @param DeliveryManLoginRequest $request
     * @return JsonResponse
     */
    final public function login(DeliveryManLoginRequest $request)
    {
        $validatedData = $request->validated();

        $deliveryMan = DeliveryMan::select('id', 'password', 'email')->where('email', $validatedData["email"])->first();

        if (!$deliveryMan || !Hash::check($validatedData["password"], $deliveryMan->password)) return response()->json([
            'message' => __('Invalid email or Password')
        ])->setStatusCode(422);

        $token = $deliveryMan->createToken(Str::slug(get_static_option('site_title', 'safecart')) . 'api_keys')->plainTextToken;

        return response()->json([
            'users' => $deliveryMan,
            'token' => $token,
        ]);
    }

    public function logout(){
        auth("sanctum")->user()->tokens()->delete();

        return response()->json([
            'message' => __('Logout Success'),
        ]);
    }
}
