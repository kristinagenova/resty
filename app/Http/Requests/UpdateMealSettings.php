<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMealSettings extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        \Log::info("message", $this);
        /*
         * Format of the incoming request. The number of elements in the
         * array would be repeated as many times as the frequency of meals
         * are set in the user profile.

        [
            'settings' => [
                0 => [
                    hour => value,
                    minute => value,
                    notification_time => value
                ],
                ...
            ]
        ]

         */

        $mealFrequency = $this->user()->meal_frequency;
        return [
            'settings' => 'required|size:' . $mealFrequency,
            'settings.*.hour' => 'required|int|min:0|max:23',
            'settings.*.minute' => 'required|int|min:0|max:60',
            'settings.*.notification_time' => 'required|int|min:0|max:120',
        ];
    }
}
