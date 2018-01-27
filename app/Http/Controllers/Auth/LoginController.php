<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use InvalidArgumentException;
use Socialite;

class LoginController extends Controller
{

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param string $network
     * @return \Illuminate\Http\Response
     */
    public function redirectToSocialNetwork($network)
    {
        return Socialite::driver($network)->redirect();
    }


    /**
     * Obtain the user information from a given Social network.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleSocialNetworkCallbacks($network)
    {
        $user = Socialite::driver($network)->user();

        if ($user) {
            $user = $this->saveUser($user, $network);
        }

        return $user;
    }

    /**
     * @param $data
     * @param $network
     * @return User
     */
    protected function saveUser($data, $network)
    {

        if (!$network) {
            throw new InvalidArgumentException('Network is required parameter');
        }

        $user = User::where(['social_network_token' => $data->token, 'social_network' => $network])->first();

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
                'name' => $data->getName(),
                'email' => $data->getEmail(),
                'social_network' => $network,
                'avatar' => $data->getAvatar()
            ]);
            $user->social_network_token = $data->token;
            $user->api_token = encrypt($data->token);
            $user->save();
        }

        return $user;

    }
}
