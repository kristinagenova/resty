<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public $fillable = [
        'user_id',
        'restaurant_id',
        'success',
        'count',
    ];
    protected $primaryKey = 'visit_id';
}
