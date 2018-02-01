<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Visits;
use App\Restaurant;
use App\Services\LocationService;
use App\User;
use App\Visit;
use Illuminate\Http\Request;

class VisitsController extends Controller
{

    /**
     * @param Visits $request
     * @param LocationService $service
     * @return array|mixed
     * @throws \ErrorException
     */
    public function recordVisit(Visits $request, LocationService $service)
    {
        $data = $request->input();
        $user = $request->user();
        $restaurant = Restaurant::find($data['restaurant_id']);
        if (!$restaurant) {
            throw new \ErrorException('Restaurant not found');
        }
        $response = $service->findDistance($data['latitude'], $data['longitude'], $restaurant['latitude'], $restaurant['longitude']);

        if (!$data['visit_id']) {
            if ($response['distance']['value'] <= 50) {
                //should probably return some success message instead
                return $this->saveModel($user, $restaurant, true);
            } else {
                $visit = $this->saveModel($user, $restaurant, false);
                return [$visit['visit_id'], $response['duration']['value'] + 300]; //300sec = 5min
            }
        }
        if ($response['distance']['value'] <= 50) {
            $visit = Visit::find($data['visit_id']);
            $visit->success = true;
            $visit->save();
            //return some success message
        } else {
            return [$data['visit_id'], $response['duration']['value'] + 300]; //300sec = 5min
        }

    }

    /**
     * @param User $user
     * @param Restaurant $restaurant
     * @param bool $success
     * @return mixed
     */
    private function saveModel(User $user, Restaurant $restaurant, bool $success)
    {
        return Visit::create([
            'user_id' => $user->user_id,
            'restaurant_id' => $restaurant->restaurant_id,
            'success' => $success
        ]);

    }

    public function getVisits(Request $request)
    {
        return Visit::where('user_id', $request->user()->user_id)
            ->where('success', true)->get();
    }
}