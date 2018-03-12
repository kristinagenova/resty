<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Services\ZomatoService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home(Request $request, ZomatoService $service)
    {

        if (!$request->has('lat') || !$request->has('lon')) {
            $geo_location = $service->convertIP2GeoCoordinates($request->ip());

            $longitude = $geo_location['longitude'];
            $latitude = $geo_location['latitude'];
        } else {
            $limit = $request->get('count');
            $longitude = $request->get('lon');
            $latitude = $request->get('lat');
        }
        return $service->search($latitude, $longitude, $limit);

    }

    public function restaurant($restaurant_id, ZomatoService $service)
    {
        $restaurant = Restaurant::find($restaurant_id);

        if (!$restaurant) {
            $restaurant = $service->getRestaurant($restaurant_id);
        }

        return $restaurant;
    }
}