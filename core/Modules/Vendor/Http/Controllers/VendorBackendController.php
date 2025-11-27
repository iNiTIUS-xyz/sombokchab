<?php

namespace Modules\Vendor\Http\Controllers;

use App\City;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;
use Modules\Vendor\Entities\BusinessType;
use Modules\Vendor\Entities\Vendor;
use Modules\Vendor\Http\Requests\Backend\UpdateVendorRequest;
use Modules\Vendor\Http\Requests\Backend\VendorStoreRequest;
use Modules\Vendor\Http\Services\DummyVendorDeleteServices;
use Modules\Vendor\Http\Services\VendorServices;
use Modules\Wallet\Http\Services\WalletService;

class VendorBackendController extends Controller {
    public function index() {
        $vendors = Vendor::query()
            ->with(["vendor_address", "vendor_shop_info", "business_type:id,name"])
            ->latest()
            ->get();

        $ids = DummyVendorDeleteServices::dummyVendorId();
        $dummyCount = DB::table('vendors')->whereIn('id', $ids)->count();
        return view("vendor::backend.index", compact("vendors", 'dummyCount'));
    }

    public function show(Request $request): string {
        $id = $request->validate(["id" => "required"]);
        $vendor = Vendor::with(["vendor_address", "vendor_shop_info", "business_type", "vendor_bank_info"])
            ->where($id)->first();

        return view("vendor::backend.details", compact("vendor"))->render();
    }

    public function update_status(Request $request) {
        $data = $request->validate([
            "status_id" => "required",
            "vendor_id" => "required",
        ]);

        Vendor::where("id", $data["vendor_id"])->update([
            "status_id" => $data["status_id"],
        ]);

        return response()->json(["success" => true, "type" => "success"]);
    }

    public function create() {
        $data = [
            "country"       => Country::select("id", "name")->orderBy("name", "ASC")->get(),
            "business_type" => BusinessType::select()->get(),
            'states'        => State::where("country_id", 31)->orderBy("name", "ASC")->get(),
            'cities'        => City::orderBy("name", "ASC")->get(),
        ];

        return view("vendor::backend.create", with($data));
    }

    public function store(VendorStoreRequest $request) {
        $data = $request->validated();
        $data["password"] = \Hash::make($data["password"]);

        DB::beginTransaction();

        try {
            // store vendor
            $vendor = VendorServices::store_vendor($data + ["status_id" => 1]);
            // create wallet for this vendor if wallet module is exists
            if (moduleExists("Wallet")) {
                WalletService::createWallet($vendor->id, "vendor");
            }

            // get vendor id and create an array for next insert
            $vendor_id = ["vendor_id" => $vendor->id];
            // store vendor address
            VendorServices::store_vendor_address($data + $vendor_id);
            // store Shop Info
            $data['email'] = $data['shop_email'];
            VendorServices::store_vendor_shop_info($data + $vendor_id);
            // store vendor bank
            VendorServices::store_vendor_bank_info($data + $vendor_id);
            // Database Commit
            DB::commit();

            return response()->json(["success" => true, "type" => "success"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["msg" => $e, "custom_msg" => "Failed to create vendor account..", "success" => false, "type" => "danger"])->setStatusCode(422);
        }
    }

    public function edit($vendor) {
        $data = [
            "country"       => Country::select("id", "name")->orderBy("name", "ASC")->get(),
            "business_type" => BusinessType::select()->get(),
            "vendor"        => Vendor::with([
                "vendor_address",
                "vendor_shop_info",
                "business_type",
                "vendor_bank_info",
                "vendor_shop_info.cover_photo",
                "vendor_shop_info.logo",
            ])->findOrFail($vendor),
            'states'        => State::where("country_id", 31)->orderBy("name", "ASC")->get(),
            'cities'        => City::orderBy("name", "ASC")->get(),
        ];

        return view("vendor::backend.edit", with($data));
    }

    public function varifyStatus(Request $request, $id) {
        $vendor = Vendor::findOrFail($id);
        $vendor->is_vendor_verified = $request->verify_status == 1 ? 1 : 0;
        $vendor->verified_at = $request->verify_status == 1 ? now() : null;
        $vendor->save();

        return redirect()->back()->with([
            'message'    => 'Vendor verify status changed successfully.',
            'alert-type' => 'success',
        ]);
    }

    public function update($vendor, UpdateVendorRequest $request) {
        $data = $request->validated();

        DB::beginTransaction();

        // colors set
        $colors = [
            'store_color'           => $request->store_color ?? null,
            'store_heading_color'   => $request->store_heading_color ?? null,
            'store_secondary_color' => $request->store_secondary_color ?? null,
            'store_paragraph_color' => $request->store_paragraph_color ?? null,
        ];

        $data = array_merge($request->validated(), ['colors' => $colors]);

        try {
            // store vendor
            VendorServices::store_vendor(VendorServices::prepare_data_for_update($data + ["status_id" => 1], "vendor") + ["id" => $data["id"]], "update");
            // store vendor address
            VendorServices::store_vendor_address(VendorServices::prepare_data_for_update($data, "vendor_address"), "update");
            // store Shop Info
            VendorServices::store_vendor_shop_info(VendorServices::prepare_data_for_update($data, "vendor_shop_info"), "update");
            // store vendor bank
            VendorServices::store_vendor_bank_info(VendorServices::prepare_data_for_update($data, "vendor_bank_info"), "update");
            // Database Commit
            DB::commit();
            return response()->json(["success" => true, "type" => "success"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["msg" => $e, "custom_msg" => "Failed to create vendor account", "success" => false, "type" => "danger"])->setStatusCode(422);
        }
    }

    public function get_state(Request $request) {
        $id = $request->validate(["country_id" => "required"]);
        $states = State::where("country_id", $id)->get();

        return response()->json(["success" => true, "type" => "success"] + render_view_for_nice_select($states));
    }

    public function get_city(Request $request) {
        $id = $request->validate(["country_id" => "required", "state_id" => "required"]);
        $states = City::where($id)->get();

        return response()->json(["success" => true, "type" => "success"] + render_view_for_nice_select($states));
    }

    public function destroy(Vendor $vendor): ?bool {
        return $vendor->delete();
    }

    public function settings() {

        return view("vendor::backend.settings");
    }

    public function updateSettings(Request $req) {
        // update all vendor settings in
        $reqSettings = $req->validate([
            "vendor_enable"               => "nullable",
            "enable_vendor_registration"  => "nullable",
            "disable_vendor_email_verify" => "nullable",
            "order_vendor_list"           => "nullable",
            "vendor_firebase_server_key"  => "nullable",
        ]);

        $reqSettings["vendor_enable"] = $reqSettings["vendor_enable"] ?? null;

        update_static_option("vendor_enable", $reqSettings["vendor_enable"]);
        update_static_option("enable_vendor_registration", $reqSettings["enable_vendor_registration"] ?? 'off');
        update_static_option("disable_vendor_email_verify", $reqSettings["disable_vendor_email_verify"] ?? null);
        update_static_option("order_vendor_list", $reqSettings["order_vendor_list"] ?? null);
        update_static_option("vendor_firebase_server_key", $reqSettings["vendor_firebase_server_key"] ?? null);

        return back()->with([
            "message"    => __("Vendor settings updated successfully."),
            "alert-type" => "success",
        ]);
    }

    public function commissionSettings() {
        $vendor = Vendor::select(["id", "owner_name", "username"])->get();

        return view("vendor::backend.commission-settings", compact("vendor"));
    }

    public function updateCommissionSettings(Request $request) {
        $data = $request->validate([
            "system_type"       => "required",
            "commission_type"   => "nullable",
            "commission_amount" => "nullable",
        ]);
        // step two is to saving data on database
        update_static_option("system_type", $data["system_type"]);
        update_static_option("commission_type", $data["commission_type"]);
        update_static_option("commission_amount", $data["commission_amount"]);

        return response()->json([
            "msg"     => __("Global vendor commission settings updated successfully."),
            "success" => true,
            "type"    => "success",
        ]);
    }
    public function updateIndividualCommissionSettings(Request $request) {
        // step one is need to validate vendor commission data
        $data = $request->validate([
            "vendor_id"         => "required|exists:vendors,id",
            "commission_type"   => "required|string",
            "commission_amount" => "required",
        ]);

        $query = Vendor::where("id", $data["vendor_id"])->update([
            "commission_type"   => $data["commission_type"],
            "commission_amount" => $data["commission_amount"],
        ]);

        return response()->json([
            "msg"     => $query ? __("Successfully updated individual vendor commission") : __("Failed to update vendor commission data"),
            "success" => (bool) $query,
        ]);
    }

    public function getVendorCommissionInformation($id) {
        // this method will send vendor commission type and vendor commission amount
        return Vendor::select("commission_type", "commission_amount")
            ->without('status')->where("id", $id)->first();
    }
    public function delete_dummy_vendor() {
        $delete = DummyVendorDeleteServices::destroy();
        if ($delete) {
            return response()->json(['success' => true, 'type' => 'success']);
        }
        return response()->json(['success' => false, 'type' => 'danger']);
    }

    public function validateField(Request $request) {
        $field = $request->input('field');
        $value = $request->input('value');
        $id = $request->input('id') ?: null; // vendor id to ignore when updating

        $allowed = ['username', 'email', 'number'];
        if (!in_array($field, $allowed)) {
            return response()->json(['valid' => false, 'message' => 'Invalid field.'], 200);
        }

        // map form field -> db column
        $column = ($field === 'number') ? 'phone' : $field;

        // empty = valid (no check)
        if ($value === null || $value === '') {
            return response()->json(['valid' => true], 200);
        }

        $exists = Vendor::where($column, $value)
            ->when($id, fn($q) => $q->where('id', '!=', $id))
            ->exists();

        if ($exists) {
            return response()->json([
                'valid'   => false,
                'message' => ucfirst($field) . ' already taken.',
            ], 200);
        }

        return response()->json(['valid' => true], 200);
    }
}
