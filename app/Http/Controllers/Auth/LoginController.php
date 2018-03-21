<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;


class LoginController extends Controller
{

    public function getSocialToken($user_id, $token){
        try {
            $client = new Client(['base_uri' => 'https://graph.facebook.com/']);
            $response = $client->request('GET', 'me', [
                'query' => [
                    'access_token' => $token,
                    'fields' => 'id,name,email,picture',
                ],
            ]);
        } catch (ClientException $exception) {
            return new JsonResponse($exception->getResponse());
        }

        $response = json_decode($response->getBody()->getContents(), true);
        if ($response['id'] == $user_id){
            return $this->saveUser($response, "facebook", $token);
        }
    }



    /**
     * @param $data
     * @param $network
     * @param $token
     * @return User
     */
    protected function saveUser($data, $network, $token)
    {

        if (!$network) {
            throw new InvalidArgumentException('Network is required parameter');
        }


        $user = User::where(['social_network_token' => $token, 'social_network' => $network])->first();

        if (!$user) {
            switch ($network) {
                case 'twitter':
                    $data->email = time() . '@' . config('app.url');
                    break;
                case 'github':
                    $data->name = $data->nickname;
                    break;
            }

            $user = new User([
                'name' => $data['name'],
                'email' => $data['email'],
                'social_network' => $network,
                'avatar' => $data['picture']['data']['url'],
            ]);
            $user->social_network_token = $token;
            $user->api_token = encrypt($token);
            $user->save();
        }

        return $user;

    }
}
