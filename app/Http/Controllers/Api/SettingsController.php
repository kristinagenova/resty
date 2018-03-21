<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GeneralErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMealSettings;
use App\Http\Requests\UpdateUserSettings;
use App\MealSettings;
use App\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function getUserSettings(Request $request)
    {
        return $request->user();
    }

    /**
     * @param UpdateUserSettings $request
     * @return mixed
     * @throws GeneralErrorException
     */
    public function updateUserSettings(UpdateUserSettings $request)
    {

        $success = $request->user()
            ->update([
                'meal_frequency' => $request->input('meal_frequency')
            ]);

        if ($success) {
            return $request->user();
        } else {
            throw new GeneralErrorException('Try again later, we were not able to update the database');
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getMealSettings(Request $request)
    {
        return $request->user()->mealSettings;
    }

    /**
     * @param UpdateMealSettings $request
     * @return mixed
     */
    public function updateMealSettings(UpdateMealSettings $request)
    {

        /** @var User $user */
        $user = $request->user();

        MealSettings::where('user_id', $user['user_id'])->delete();

        $data = $request->input();



        foreach ($data['settings'] as $row) {
            $time = $row['hour'] . ':' . $row['minute'];
            $actual_notification_time = strtotime($time) - ($row['notification_time']*60);
            $row['actual_notification_time'] = date('H:i', $actual_notification_time);

            $user->mealSettings()->create($row);
        }
        return $user->mealSettings;
    }

}
