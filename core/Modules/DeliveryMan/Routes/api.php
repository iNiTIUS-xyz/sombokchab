<?php

use Illuminate\Http\Request;
use Modules\DeliveryMan\Http\Controllers\Api\DeliveryManApiController;
use Modules\DeliveryMan\Http\Controllers\Api\DeliveryManLoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here are have all routes for delivery man app those are wrapped
| with prefix api/delivery-man/v1
|
*/

Route::get('public-test', function (Request $request) {
    return ['success' => true];
});

// create login api here
Route::post("login",[DeliveryManLoginController::class, 'login']);
// this route will return symbol [currencyPosition rtl currency_code]
Route::get('site-currency-symbol', [DeliveryManApiController::class,"site_currency_symbol"]);
// translate string api
Route::post('/translate-string', [DeliveryManApiController::class, 'translateString'])->middleware("setlang:frontend");
// terms and condition page route
Route::get('terms-and-condition-page', [DeliveryManApiController::class, 'termsAndCondition']);
// privacy policy page route
Route::get('privacy-policy-page', [DeliveryManApiController::class, 'privacyPolicy']);
// send otp route
Route::post('/send-otp-in-mail', [DeliveryManApiController::class, 'sendOTP']);
// otp success route
// this route will be commented cause no need to verify email at this moment
//Route::post('/otp-success', [DeliveryManApiController::class, 'sendOTPSuccess']);
// reset password route
Route::post('/reset-password', [DeliveryManApiController::class, 'resetPassword']);