<?php

use Illuminate\Http\Request;
use Modules\Chat\Http\Controllers\Api\UserChatApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'user/chat', 'middleware' => 'auth:sanctum'], function () {
    Route::controller(UserChatApiController::class)->group(function (){
        Route::get("list", "index")->name('home');
        Route::post("fetch-chat-user-record", "fetch_user_chat_record")->name("fetch-user-chat-record");
        Route::post("message-send", "message_send")->name("message-send");
        Route::get("is-vendor-active/{id?}", "isVendorActive")->name("is-vendor-active");
    });
});