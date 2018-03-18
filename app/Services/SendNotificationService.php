<?php

namespace App\Services;


use App\MealSettings;
use App\User;


class SendNotificationService
{
    /**
     * @return mixed|void
     */
    public function SendNotification()
    {
        $userIDs = array();

        $allEntries = MealSettings::all();
        foreach ($allEntries as $entry){
            if ($entry->actual_notification_time == date('H:i')) {
                $userIDs[] = $entry->user_id;
            }
        }
        $player_ids = User::find($userIDs)->pluck('player_id');
        if ($player_ids == null) {
            return;
        }

        return $this->sendMessage($player_ids);
    }


    /**
     * @param $player_ids
     * @return mixed
     */
    function sendMessage($player_ids)
    {

        $content = array(
            "en" => 'Check out the restaurants around you',
        );

        $fields = array(
            'app_id' => "29a5bbed-5860-40ac-a573-fd1d743b486a",
            'include_player_ids' => $player_ids,
            'contents' => $content
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

}