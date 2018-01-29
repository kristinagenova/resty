<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealSettings extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'meal_setting_id';


    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'hour',
        'minute',
        'notification_time',
    ];
}
