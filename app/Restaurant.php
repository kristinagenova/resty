<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;
    /**
     * @var string
     */
    protected $primaryKey = 'restaurant_id';
    protected $fillable = [
        'restaurant_id',
        'name',
        'url',
        'address',
        'latitude',
        'longitude',
        'country_id',
        'cuisine',
        'average_cost',
        'price_range',
        'aggregate_rating',
        'rating_text',
        'votes',
        'photos_url',
        'menu_url',
        'featured_img',
        'online_delivery',
        'table_booking',
    ];
}
