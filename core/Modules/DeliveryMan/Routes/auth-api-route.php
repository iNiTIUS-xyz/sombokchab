<?php

// all route that are witten in this file those are wrapped with prefix api/delivery-man/v1 and middleware sanctum
use Modules\DeliveryMan\Http\Controllers\Api\DeliveryManApiController;
use Modules\DeliveryMan\Http\Controllers\Api\DeliveryManApiWalletController;
use Modules\DeliveryMan\Http\Controllers\Api\DeliveryManLocationController;
use Modules\DeliveryMan\Http\Controllers\Api\DeliveryManLoginController;
use Modules\DeliveryMan\Http\Controllers\Api\DeliveryManOrderController;
use Modules\DeliveryMan\Http\Controllers\Api\DeliveryManWithdrawController;
use Modules\DeliveryMan\Http\Controllers\DeliveryManCountryController;

Route::get('profile', [DeliveryManApiController::class,"profile"]);
// write route for a delivery man order list
Route::get('order-list', [DeliveryManApiController::class, 'orderList']);
// write route for a delivery man order list
Route::get('tracking/{order_id}', [DeliveryManApiController::class, 'trackSingleOrder']);
// country route with search
Route::get('/country', [DeliveryManCountryController::class, 'country']);
// state route with search
Route::get('/state/{country_id}', [DeliveryManCountryController::class, 'stateByCountryId']);
// city route with search
Route::get('/city/{state_id}', [DeliveryManCountryController::class, 'cityByCountryId']);
// dashboard information
Route::get('dashboard',[DeliveryManApiController::class,"dashboard"]);
// get all delivery man zone lists
Route::get("zone-list", [DeliveryManApiController::class,"zoneList"]);
// get vehicle type lists
Route::get("essential-data", [DeliveryManApiController::class,"essentialData"]);
// write update location route here
Route::post("update-location", [DeliveryManLocationController::class,"updateLocation"]);
// this route will remove authentication token
Route::get('logout', [DeliveryManLoginController::class, 'logout']);
// ratings api route writes here
Route::get("ratings",[DeliveryManApiController::class,"ratings"]);
// Order history api route with pagination
Route::get("history",[DeliveryManApiController::class,"orderHistory"]);
// delete account route
Route::get('delete-account', [DeliveryManApiController::class, 'deleteAccount']);
// change password route are here
Route::post('change-password', [DeliveryManApiController::class, 'changePassword']);
// update firebase subscribes token in delivery_mans table
Route::post('update-subscribe-token', [DeliveryManApiController::class, 'updateFirebaseToken']);
// update delivery man address
Route::post('update-present-address',[DeliveryManApiController::class,"updateDeliveryManAddress"]);
// update profile information
Route::post('profile-update', [DeliveryManApiController::class,"profileUpdate"]);
// wallet withdraw request list
Route::get("wallet-payment-gateway-list", [DeliveryManApiWalletController::class, "walletGatewayList"]);
// save wallet gateway information for delivery man
Route::post("wallet-payment-gateway-save", [DeliveryManApiWalletController::class,"saveWalletGateway"]);
// wallet history list route here
Route::get("wallet-history", [DeliveryManApiWalletController::class, "walletHistory"]);
// wallet information route here
Route::get("wallet-info", [DeliveryManApiWalletController::class, "walletInfo"]);
// wallet withdrawal request
Route::get("withdrawal-request", [DeliveryManWithdrawController::class, "withdrawRequests"]);
// wallet withdrawal request
Route::post("withdrawal-request", [DeliveryManWithdrawController::class, "handleWithdraw"]);
// update order status
Route::post("update-order-status", [DeliveryManOrderController::class,"changeOrderStatus"]);
// Notification list api route
Route::get("notification-list", [DeliveryManApiController::class,"notification"]);
// Notification update api route
Route::get("notification-update", [DeliveryManApiController::class,"updateNotification"]);