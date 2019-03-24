<?php

namespace sp_n1_v3\Advert;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Advert extends Eloquent
{
    protected $table = 'advert';

    protected $fillable = [
        'user_id',
        'car_manufacturer',
        'car_model',
        'car_make_year_and_month',
        'car_first_registration_date',
        'car_mileage',
        'car_price',
        'engine_transmission',
        'engine_power',
        'engine_displacement',
        'engine_fuel',
        'body_color',
        'body_door_count',
        'description',
    ];
}
