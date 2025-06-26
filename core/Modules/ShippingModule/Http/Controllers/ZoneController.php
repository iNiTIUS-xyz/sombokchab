<?php

namespace Modules\ShippingModule\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CountryManage\Entities\Country;
use Modules\ShippingModule\Entities\Zone;
use Modules\ShippingModule\Entities\ZoneCountry;
use Modules\ShippingModule\Entities\ZoneState;
use Modules\ShippingModule\Http\Requests\StoreShippingZoneRequest;

class ZoneController extends Controller
{
    public function index()
    {
        $data = [
            "zones" => Zone::with("country", "country.zoneStates")->get(),
        ];

        return view("shippingmodule::admin.index", $data);
    }

    public function create()
    {
        $data = [
            "countries" => Country::select("id", "name")->get(),
        ];

        return view("shippingmodule::admin.create", $data);
    }

    public function store(StoreShippingZoneRequest $request)
    {
        $data = $request->validated();

        $zone = Zone::create(["name" => $data["zone_name"]]);
        $this->insertAllCountryAndStates($request, $zone);

        return response()->json([
            "success" => true,
            "type" => "success",
            "msg" => __("Successfully inserted country and states")
        ]);
    }

    public function edit($id)
    {
        $data = [
            "zone" => Zone::with(["country", "country.zoneStates", "country.states"])->where("id", $id)->firstOrFail(),
            "countries" => Country::select("id", "name")->get(),
            "id" => $id
        ];

        return view("shippingmodule::admin.edit", $data);
    }

    public function update(StoreShippingZoneRequest $request, $id)
    {
        $data = $request->validated();

        $this->deleteAllCountryStatesAndZone($id);

        Zone::where("id", $id)->update(["name" => $data["zone_name"]]);

        $zone = Zone::where("id", $id)->first();

        $this->insertAllCountryAndStates($request, $zone);

        return response()->json([
            "success" => true,
            "type" => "success",
            "msg" => __("Successfully updated country and states")
        ]);
    }

    public function destroy($id)
    {

        $this->deleteAllCountryStatesAndZone($id, "delete");

        return back()->with(["msg" => "Successfully deleted zone"]);
    }

    public function deleteAllCountryStatesAndZone($zoneId, $type = "update")
    {

        ZoneCountry::where("zone_id", $zoneId)->delete();

        if ($type == 'delete') {
            Zone::where("id", $zoneId)->delete();
        }

        return true;
    }

    private function insertAllCountryAndStates($data, $zone): bool
    {

        $states = [];

        foreach ($data["country"] as $countryInt) {

            $country = ZoneCountry::create([
                "zone_id" => $zone->id,
                "country_id" => $countryInt
            ]);

            foreach ($data["states"][$countryInt] ?? [] as $state) {
                $states[] = [
                    "zone_country_id" => $country->id,
                    "state_id" => $state
                ];
            }
        }

        !empty($states) ? ZoneState::insert($states) : '';

        return true;
    }
}
