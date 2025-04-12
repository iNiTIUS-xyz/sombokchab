<?php

use Modules\DeliveryMan\Http\Controllers\AdminDeliveryManController;
use Modules\DeliveryMan\Http\Controllers\AdminDeliveryManPaymentGatewayController;
use Modules\DeliveryMan\Http\Controllers\AdminDeliveryManSettingsController;
use Modules\DeliveryMan\Http\Controllers\AdminDeliveryManZoneController;
use Modules\DeliveryMan\Http\Controllers\AssignDeliveryManController;
use Modules\DeliveryMan\Http\Controllers\DeliveryManPickupPointController;
use Modules\DeliveryMan\Http\Controllers\AdminDeliveryManUpdatePluginController;

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

Route::prefix("admin-home/delivery-man/wallet")->middleware(["auth:admin","setlang:backend"])
    ->as("admin.delivery-man.wallet.withdraw.")->controller(AdminDeliveryManPaymentGatewayController::class)
    ->group(function () {
        // write route for delivery man
        Route::get("/gateway","gateway")->name("gateway")->permission("delivery-man-wallet-gateway");
        Route::post("/gateway","storeGateway")->permission("delivery-man-wallet-gateway");
        Route::put("gateway/update/{id?}", "updateGateway")->name("gateway.update")->permission("delivery-man-wallet-gateway-update");
        Route::post("gateway/delete/{id}", "deleteGateway")->name("gateway.delete")->permission("delivery-man-wallet-gateway-delete");
    }
);

Route::prefix("admin-home/delivery-man/pickup-point")->middleware(["auth:admin","setlang:backend"])
    ->as("admin.delivery-man.pickup-point.")->controller(DeliveryManPickupPointController::class)->group(function () {
        Route::get("/", "index")->name("index")->permission("delivery-man-pickup-point");
        Route::get("/create", "create")->name("create")->permission("delivery-man-pickup-point-create");
        Route::post("/create", "store")->permission("delivery-man-pickup-point-create");
        Route::get("/edit/{id}", "edit")->name("edit")->permission("delivery-man-pickup-point-edit");
        Route::put("/edit/{id}", "update")->permission("delivery-man-pickup-point-edit");
        Route::get("/delete/{id}", "destroy")->name("delete")->permission("delivery-man-pickup-point-delete");
});

Route::prefix("admin-home/delivery-man")->middleware(["auth:admin","setlang:backend"])->as("admin.delivery-man.")->group(function () {
    Route::resource("zone",AdminDeliveryManZoneController::class)->except('show');

    // I can use resource controller
    Route::get("/", [AdminDeliveryManController::class,"index"])->name("index")->permission('delivery-man');
    Route::get("/details/{deliveryMan}", [AdminDeliveryManController::class, "details"])->name("details")->permission('delivery-man-details');
    Route::get("/ratings/{deliveryMan}", [AdminDeliveryManController::class, "ratings"])->name("ratings")->permission('delivery-man-ratings');
    Route::get("/history/{deliveryMan}", [AdminDeliveryManController::class, "history"])->name("history")->permission('delivery-man-history');
    Route::get("/tracking/{deliveryMan}", [AdminDeliveryManController::class, "tracking"])->name("tracking")->permission('delivery-man-tracking');
    Route::get("/tracking/{order_id?}/{deliveryMan?}", [AdminDeliveryManController::class,"trackSingleOrder"])->name("single-order-details")->permission('delivery-man-tracking');
    Route::get("add", [AdminDeliveryManController::class,"create"])->name("add")->permission('delivery-man-add');
    Route::post("store", [AdminDeliveryManController::class, "store"])->name("store")->permission('delivery-man-store');
    Route::get("search", [AdminDeliveryManController::class, "search"])->name("search")->permission('delivery-man-search');
    Route::get("edit/{deliveryMan}", [AdminDeliveryManController::class, "edit"])->name("edit")->permission('delivery-man-edit');
    Route::put("edit/{deliveryMan}", [AdminDeliveryManController::class, "update"])->name("update")->permission('delivery-man-edit');
    Route::post("delete/{deliveryMan}", [AdminDeliveryManController::class, "destroy"])->name("delete")->permission('delivery-man-delete');
    Route::put("change-status", [AdminDeliveryManController::class, "changeStatus"])->name("change-status")->permission('delivery-man-change-status');

    // delivery man settings route
    Route::get("settings", [AdminDeliveryManSettingsController::class, "settings"])->name("settings")->permission('delivery-man-settings');
    Route::put("settings", [AdminDeliveryManSettingsController::class,"handleSettings"])->permission('delivery-man-settings');
    Route::get("update", [AdminDeliveryManUpdatePluginController::class,"updatePlugin"]);
    Route::post("update", [AdminDeliveryManUpdatePluginController::class,"delivery_man_license_settings_update"])->name('license_update');
    Route::get("version-check", [AdminDeliveryManUpdatePluginController::class,"update_version_check"])->name('version_check');
});

Route::prefix("admin-home/assign-delivery-man")->middleware(["auth:admin","setlang:backend"])->as("admin.assign-delivery-man.")
    ->controller(AssignDeliveryManController::class)
    ->group(function () {
        Route::get("orders","orders")->name("orders")->permission("assign-delivery-man-orders");

        Route::get("orders/{order_id}","assign")->name("assign")->permission("assign-delivery-man-orders");
        Route::put("orders/{order_id}","handleAssign")->permission("assign-delivery-man-orders");
        // delivery man details route
        Route::get("delivery-man-details/{id?}", "deliveryManDetails")->name("delivery-man-details")->permission("assign-delivery-man-delivery-man-details");
        // find delivery man by delivery man zone
        Route::get("find-delivery-man", "findDeliveryMan")->name("find-delivery-man")->permission("assign-delivery-man-find-delivery-man");
        // search module route for delivery man
        Route::get("delivery-man-search", "deliveryManSearch")->name("delivery-man-search")->permission("assign-delivery-man-delivery-man-search");
    });