<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'social_network',
        'avatar',
        'meal_frequency',
        'player_id',
    ];

    protected $hidden = [
        'social_network',
        'social_network_token',
    ];

    public function mealSettings()
    {
        return $this->hasMany(MealSettings::class, 'user_id', 'user_id');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class, 'user_id', 'user_id');
    }
}
