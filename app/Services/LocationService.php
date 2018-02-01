<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;

class LocationService
{

    public function findDistance($userLatitude, $userLongitude, $restLatitude, $restLongitude)
    {

        try {
            $client = new Client(['base_uri' => 'https://maps.googleapis.com/maps/api/distancematrix/']);
            $response = $client->request('GET', 'json', [
                'query' => [
                    'units' => 'metric',
                    'origins' => $userLatitude . ',' . $userLongitude,
                    'destinations' => $restLatitude . ',' . $restLongitude,
                    'mode' => ''
                ],
                'headers' => [
                    'user-key' => config('services.google.api_key'),
                ]
            ]);
        } catch (ClientException $exception) {
            return new JsonResponse($exception->getResponse());
        }

        $response = json_decode($response->getBody()->getContents(), true);
        return $response['rows'][0]['elements'][0];
    }
}