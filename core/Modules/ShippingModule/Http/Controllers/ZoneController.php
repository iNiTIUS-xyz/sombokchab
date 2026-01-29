<?php

namespace Modules\ShippingModule\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\CountryManage\Entities\City;
use Modules\ShippingModule\Entities\Zone;
use Modules\CountryManage\Entities\Country;
use Modules\ShippingModule\Entities\ZoneState;
use Modules\ShippingModule\Entities\ZoneCountry;
use Modules\ShippingModule\Http\Requests\StoreShippingZoneRequest;

class ZoneController extends Controller
{
    public function index()
    {
        $data = [
            "zones" => Zone::with([
                "mrt_country"
            ])->get(),
        ];

        return view("shippingmodule::admin.index", $data);
    }

    public function create()
    {
        $data = [
            "countries" => Country::select("id", "name")->get(),
            "cities" => City::get(),
        ];

        return view("shippingmodule::admin.create", $data);
    }

    public function store(StoreShippingZoneRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $cityIds = isset($data["city_ids"]) ? array_values(array_filter(array_map('intval', $data["city_ids"]))) : null;

            Zone::create([
                "name" => $data["zone_name"],
                "city_ids" => $cityIds ?: null,
                "country_id" => $data["country_id"],
            ]);

            DB::commit();

            return response()->json([
                "success" => true,
                "type"    => "success",
                "msg"     => __("Zone successfully created."),
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                "success" => false,
                "type"    => "error",
                "msg"     => $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        $data = [
            "zone"      => Zone::with(["country", "country.zoneStates", "country.states"])->where("id", $id)->firstOrFail(),
            "countries" => Country::select("id", "name")->get(),
            "cities" => City::get(),
        ];

        return view("shippingmodule::admin.edit", $data);
    }

    public function update(StoreShippingZoneRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $cityIds = isset($data["city_ids"]) ? array_values(array_filter(array_map('intval', $data["city_ids"]))) : null;

            Zone::where('id', $id)->update([
                "name" => $data["zone_name"],
                "city_ids" => $cityIds ?: null,
                "country_id" => $data["country_id"],
            ]);

            DB::commit();

            return response()->json([
                "success" => true,
                "type"    => "success",
                "msg"     => __("Zone successfully updated."),
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                "success" => false,
                "type"    => "error",
                "msg"     => $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {

        try {
            DB::beginTransaction();

            Zone::where("id", $id)->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Successfully deleted shipping Zone.',
                ]);
            }

            return back()->with([
                'alert-type' => 'success',
                'message'    => 'Successfully deleted shipping Zone.',
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()->with([
                'alert-type' => 'error',
                'message'    => $e->getMessage(),
            ]);
        }
    }
}
