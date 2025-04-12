<?php

namespace Modules\DeliveryMan\Services;

use Exception;

class GoogleMapServices
{
    public static function geocodeAddress(string $address): array
    {
        try {
            $lat = 0;
            $lng = 0;

            $data_location = "https://maps.google.com/maps/api/geocode/json?key=".get_static_option("map_api_server_key")."&address=".str_replace(" ", "+", $address)."&sensor=false";
            $data = file_get_contents($data_location);

            usleep(200000);
            // turn this on to see if we are being blocked
            // echo $data;
            $data = json_decode($data);

            if ($data->status=="OK") {
                $lat = $data->results[0]->geometry->location->lat;
                $lng = $data->results[0]->geometry->location->lng;

                if($lat && $lng) {
                    return [
                        'status' => true,
                        'lat' => $lat,
                        'long' => $lng,
                        'google_place_id' => $data->results[0]->place_id
                    ];
                }
            }
            if($data->status == 'OVER_QUERY_LIMIT') {
                return [
                    'status' => false,
                    'message' => __('Google Amp API OVER_QUERY_LIMIT, Please update your google map api key or try tomorrow')
                ];
            }

        } catch (Exception $e) {

        }

        return ['lat' => null, 'long' => null, 'status' => false];
    }
}