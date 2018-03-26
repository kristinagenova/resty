<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Services\ZomatoService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

	/**
	 * @param Request $request
	 * @param ZomatoService $service
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
    public function home(Request $request, ZomatoService $service)
    {

        if (!$request->has('lat') || !$request->has('lon')) {
            $geo_location = $service->convertIP2GeoCoordinates($request->ip());

            $longitude = $geo_location['longitude'];
            $latitude = $geo_location['latitude'];
        } else {
            $limit = $request->get('count');
            $longitude = 55.873543;//$request->get('lon');
            $latitude = ‎ - 4.289058;    //$request->get('lat');
        }
        return $service->search($latitude, $longitude, $limit);

    }

	/**
	 * @param $restaurant_id
	 * @param ZomatoService $service
	 * @return Restaurant
	 */
    public function restaurant($restaurant_id, ZomatoService $service)
    {
        $restaurant = Restaurant::find($restaurant_id);

        if (!$restaurant) {
            $restaurant = $service->getRestaurant($restaurant_id);
        }

        return $restaurant;
    }
}