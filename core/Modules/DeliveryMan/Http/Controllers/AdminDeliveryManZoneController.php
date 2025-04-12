<?php

namespace Modules\DeliveryMan\Http\Controllers;

use App\Exceptions\InvalidCoordinatesException;
use App\Http\Controllers\Controller;
use DB;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;
use Modules\DeliveryMan\Entities\DeliveryManZone;
use Modules\DeliveryMan\Services\GoogleMapServices;

class AdminDeliveryManZoneController extends Controller
{
    public function __construct(){
        $this->middleware("permission:delivery-man-zone|delivery-man-zone-create|delivery-man-zone-edit",["only" => ["index","create","store","show","edit","update"]]);
        $this->middleware("permission:delivery-man-zone",['only' => ['index']]);
        $this->middleware("permission:delivery-man-zone-create",['only' => ['create','store']]);
        $this->middleware("permission:delivery-man-zone-update",['only' => ['edit','update']]);
        $this->middleware("permission:delivery-man-zone-delete",['only' => ['destroy']]);
    }
    const PAGINATION_LIMIT = 20;

    public function index()
    {
        $paginationLimit = self::PAGINATION_LIMIT;
        $deliveryZones = DeliveryManZone::select("id","name","is_active")->latest("id")->paginate($paginationLimit);

        return view("deliveryman::admin.index", compact('deliveryZones','paginationLimit'));
    }

    public function create()
    {
        return view("deliveryman::admin.create");
    }

    /**
     * @throws InvalidCoordinatesException
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|unique:zones|max:191',
            'coordinates' => 'required',
        ]);

        // Example: Parsing coordinates from a string like "23.8342,90.2992),(23.6984,90.3391"
        $points = explode('),(', trim($validator['coordinates'], '()'));
        $polygon = "POLYGON((";

        foreach ($points as $point) {
            $coords = explode(',', $point);
            if (count($coords) != 2 || !is_numeric($coords[0]) || !is_numeric($coords[1])) {
                // Handle invalid coordinates here (e.g., return an error response)
                throw new InvalidCoordinatesException('Invalid coordinates provided.');
            }

            $polygon .= $coords[1] . " " . $coords[0] . ",";
            // Note the order longitude then latitude
        }

        // Close the loop by repeating the first point
        $polygon .= explode(',', $points[0])[1] . " " . explode(',', $points[0])[0];
        $polygon .= "))";

        // first create deliveryManZone without coordinates column value this value should store latter cause here we need to use raw sql
        $zone = DeliveryManZone::create([
            "name" => $validator['name'],
            "is_active" => 1
        ]);

        // run raw sql for update delivery_man_zones
        DB::statement("UPDATE delivery_man_zones SET coordinates = ST_GeomFromText(?) WHERE id = ?", [$polygon, $zone->id]);

        // return back with response data
        return back()->with([
            "success" => true,
            "msg" => __("Successfully created delivery man zone"),
            "type" => "success"
        ]);
    }

    public function show($id)
    {
        return view("deliveryman::admin.edit");
    }

    public function edit($id)
    {
        $zone = DeliveryManZone::where('id', $id)
            ->selectRaw('ST_AsText(coordinates) as polygon, ST_AsText(ST_Centroid(`coordinates`)) as center,id,name')
            ->first();
        $current_zone = coordinatesArray($zone->polygon);
        $center_lat = trim(explode(' ', $zone->center)[1], 'POINT()');
        $center_lng = trim(explode(' ', $zone->center)[0], 'POINT()');

//        $address = "Dhaka, Dhaka, Bangladesh, 24727";
//        GoogleMapServices::geocodeAddress($address);

        return view("deliveryman::admin.edit", compact('zone','current_zone','center_lat','center_lng'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'name' => 'required|unique:zones|max:191',
            'coordinates' => 'nullable',
        ]);

        if(!empty($validator['coordinates'])){
            // Example: Parsing coordinates from a string like "23.8342,90.2992),(23.6984,90.3391"
            $points = explode('),(', trim($validator['coordinates'], '()'));
            $polygon = "POLYGON((";

            foreach ($points as $point) {
                $coords = explode(',', $point);
                if (count($coords) != 2 || !is_numeric($coords[0]) || !is_numeric($coords[1])) {
                    // Handle invalid coordinates here (e.g., return an error response)
                    throw new InvalidCoordinatesException('Invalid coordinates provided.');
                }

                $polygon .= $coords[1] . " " . $coords[0] . ",";
                // Note the order longitude then latitude
            }

            // Close the loop by repeating the first point
            $polygon .= explode(',', $points[0])[1] . " " . explode(',', $points[0])[0];
            $polygon .= "))";

            // first create deliveryManZone without coordinates column value this value should store latter cause here we need to use raw sql

            DB::statement("UPDATE delivery_man_zones SET coordinates = ST_GeomFromText(?), name = ? WHERE id = ?", [$polygon, $validator["name"], $id]);
            return back()->with([
                "success" => true,
                "msg" => __("Successfully updated delivery man zone"),
                "type" => "success"
            ]);
        }else{
            DeliveryManZone::where("id", $id)->update([
                "name" => $validator['name']
            ]);
        }

        // return back with response data
        return back()->with([
            "success" => true,
            "msg" => __("Successfully updated delivery man zone"),
            "type" => "success"
        ]);
    }

    public function destroy($id)
    {
    }
}
