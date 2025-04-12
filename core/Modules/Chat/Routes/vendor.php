<?php

use Modules\Chat\Http\Controllers\Api\VendorChatApiController;

Route::group(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function () {
    Route::prefix('chat')->controller(VendorChatApiController::class)->group(function () {
        Route::get("list", "index")->name('home');
        Route::post("fetch-chat-user-record", "fetch_chat_record")->name("fetch-vendor-chat-record");
        Route::post("message-send", "message_send")->name("message-send");
    });
});