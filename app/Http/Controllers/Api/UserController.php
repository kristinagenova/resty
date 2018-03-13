<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;


class UserController extends Controller
{

    /**
     * @param Request $request
     */
    public function user(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        if ($request->input('detailed', false)) {
            $user->load(['visits', 'mealSettings']);
        }

        return $user;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function one_signal(Request $request)
    {

        $success = $request->user()
            ->update([
                'player_id' => $request->input('player_id')
            ]);

        if ($success) {
            return $request->user();
        } else {
            throw new GeneralErrorException('Try again later, we were not able to update the database');
        }
    }
}