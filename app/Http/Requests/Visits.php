<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Visits extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /*
         * Format of the incoming request
            [
                latitude => value
                longitude => value
                restaurant_id => value
                visit_id => value // optional
             ];


         */
        return [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'restaurant_id' => 'required|int',
            'visit_id' => 'nullable|int',
        ];
    }
}
