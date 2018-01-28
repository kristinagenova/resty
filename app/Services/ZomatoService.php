<?php

namespace App\Services;

use App\Restaurant;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;


class ZomatoService
{
    /**
     * @param float $latitude
     * @param float $longitude
     * @return Collection
     * @throws \Exception
     */
    public function search($latitude, $longitude, $limit = 20)
    {
        // validate the format of the coordinates
        $cacheKey = md5($latitude . '.' . $longitude . '.' . $limit);
        $response = cache($cacheKey);

        if (!$response) {

            $response = $this->getHTTPClient('search', ['lat' => $latitude, 'lon' => $longitude, 'count' => $limit]);

            $response = json_decode($response->getBody()->getContents(), true);
            cache([$cacheKey => $response], 120);
        }

        $collection = new Collection();

        foreach ($response['restaurants'] as $data) {
            $restaurant = Restaurant::find($data['restaurant']['id']);

            if (!$restaurant) {
                $restaurant = $this->createAndSaveRestaurant($data['restaurant']);
            }

            $collection->add($restaurant);
        }
        return $collection;
    }

    /**
     * @param array $query
     * @return JsonResponse|mixed|\Psr\Http\Message\ResponseInterface
     */
    protected function getHTTPClient(string $URI, array $query)
    {

        try {
            $client = new Client(['base_uri' => 'https://developers.zomato.com/api/v2.1/']);
            return $client->request('GET', $URI, [
                'query' => $query,
                'headers' => [
                    'user-key' => config('services.zomato.api_key'),
                ]
            ]);
        } catch (ClientException $exception) {
            return new JsonResponse($exception->getResponse());
        }

    }

    /**
     * @param array $data
     * @return Restaurant
     */
    public function createAndSaveRestaurant(Array $data)
    {
        return Restaurant::create([
            'restaurant_id' => $data['R']['res_id'],
            'name' => $data['name'],
            'url' => $data['url'],
            'address' => $data['location']['address'],
            'latitude' => $data['location']['latitude'],
            'longitude' => $data['location']['longitude'],
            'country_id' => $data['location']['country_id'],
            'cuisine' => $data['cuisines'],
            'average_cost' => $data['average_cost_for_two'],
            'price_range' => $data['price_range'],
            'aggregate_rating' => $data['user_rating']['aggregate_rating'],
            'rating_text' => $data['user_rating']['rating_text'],
            'votes' => $data['user_rating']['votes'],
            'photos_url' => $data['photos_url'],
            'menu_url' => $data['menu_url'],
            'featured_img' => $data['featured_image'],
            'online_delivery' => $data['has_online_delivery'],
            'table_booking' => $data['has_table_booking']
        ]);
    }

    /**
     * @param string $ip
     * @return array|JsonResponse
     * @throws \Exception
     */
    public function convertIP2GeoCoordinates($ip)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new \Exception("Not valid IP address");
        }


        try {
            $client = new Client(['base_uri' => 'http://freegeoip.net/json/']);
            $response = $client->request('GET', $ip);
        } catch (ClientException $exception) {
            return new JsonResponse($exception->getResponse());
        }


        //the api does not detect '-' on longitude
        $response = json_decode($response->getBody()->getContents(), true);
        $result = ['latitude' => $response['latitude'], 'longitude' => $response['longitude']];

        return $result;
    }

    /**
     * @param $restaurant_id
     * @return Restaurant
     */
    public function getRestaurant($restaurant_id)
    {

        $response = $this->getHTTPClient('restaurant', ['res_id' => $restaurant_id]);
        $data = json_decode($response->getBody()->getContents(), true);
        return $this->createAndSaveRestaurant($data);
    }

}