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


use Modules\Refund\Http\Controllers\AdminReasonController;
use Modules\Refund\Http\Controllers\RefundController;
use Modules\Refund\Http\Controllers\RefundPreferredOptionController;
use Modules\Refund\Http\Controllers\RefundSettingsController;
use Modules\Refund\Http\Controllers\AdminRefundUpdatePluginController;

Route::prefix('admin-home/refund')->as("admin.refund.")->middleware(['setlang:backend', 'adminglobalVariable', 'auth:admin'])->group(function () {
    /*==============================================
                    Refund Module
    ==============================================*/
    Route::controller(RefundController::class)->group(function () {
        Route::get("request", "index")->name("request")->permission("refund-request");
        Route::get("request/{id}", "viewRequest")->name("view-request")->permission("refund-request");
        Route::put("update-track-status/{id}", "updateTrackStatus")->name("update-track-status")->permission("refund-update-track-status");
    });

    Route::controller(AdminReasonController::class)->prefix("reason")->as("reason.")->group(function () {
        Route::get("/", "index")->name("index")->permission("refund-reason");
        Route::post("/store", "store")->name("store")->permission("refund-reason-store");
        Route::put("/update", "update")->name("update")->permission("refund-reason-update");
        Route::get("/delete/{reason}", "destroy")->name("delete")->permission("refund-reason-delete");
    });

    Route::controller(RefundPreferredOptionController::class)->prefix("preferred-option")->as("preferred-option.")->group(function () {
        Route::get("/", "index")->name("index")->permission("refund-preferred-option");
        Route::post("/store", "store")->name("store")->permission("refund-preferred-option-store");
        Route::put("update/{id?}", "update")->name("update")->permission("refund-preferred-option-update");
        Route::post("status-chnage/{id}", "statusChange")->name("status.change");
        Route::post("delete/{id}", "delete")->name("delete")->permission("refund-preferred-option-delete");
    });

    Route::controller(RefundSettingsController::class)->prefix("settings")->as("settings.")->group(function () {
        Route::get("/", "index")->name("index")->permission("refund-settings");
        Route::put("/update", "update")->name("update")->permission("refund-settings-update");
    });
    Route::controller(AdminRefundUpdatePluginController::class)->group(function () {
        Route::get("/update-plugin", "updatePlugin")->name('refund_plugin_license_update');
        Route::post("/update-plugin", "refund_plugin_license_settings_update")->name("refund_plugin_license_update");
        Route::get("/refund-version-check", "update_version_check")->name("refund_plugin_version_check");
    });
});
