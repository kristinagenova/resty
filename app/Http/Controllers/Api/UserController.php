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

}