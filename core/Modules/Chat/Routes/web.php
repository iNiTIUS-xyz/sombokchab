<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\Chat\Http\Controllers\Admin\AdminLivechatController;
use Modules\Chat\Http\Controllers\ChatController;
use Modules\Chat\Http\Controllers\VendorChatController;
use Modules\Chat\Http\Controllers\AdminChatUpdatePluginController;

Route::controller(ChatController::class)->prefix("chat")
    ->as("frontend.chat.")->middleware(["auth:web","setlang:frontend","globalVariable"])->group(function (){
    Route::get("/live-chat/index", "index")->name('home');
    Route::post("fetch-chat-user-record", "fetch_user_chat_record")->name("fetch-user-chat-record");
    Route::post("message-send", "message_send")->name("message-send");
    Route::get("is-vendor-active/{id?}", "isVendorActive")->name("is-vendor-active");
});

Route::prefix('vendor-home/chat')->as('vendor.chat.')->middleware(['userEmailVerify','setlang:backend','auth:vendor','setlang:vendor'])
    ->controller(VendorChatController::class)->group(function (){
    Route::get("/", "index")->name('home');
    Route::post("fetch-chat-user-record", "fetch_chat_record")->name("fetch-vendor-chat-record");
    Route::post("message-send", "message_send")->name("message-send");
});

Route::prefix("admin-home/livechat")->as("admin.livechat.")->middleware(["auth:admin","setlang:backend"])->group(function (){
    Route::get("settings", [AdminLivechatController::class, "settings"])->name("settings")->permission('livechat-settings');
    Route::post("settings",[AdminLivechatController::class, "updateSettings"])->permission('livechat-settings');
    Route::controller(AdminChatUpdatePluginController::class)->group(function(){
        Route::get("/update-plugin", "updatePlugin")->name("chat_plugin_license_update");
        Route::post("/update-plugin", "refund_plugin_license_settings_update");
        Route::get("/refund-version-check", "update_version_check")->name("chat_plugin_version_check");
    });
});