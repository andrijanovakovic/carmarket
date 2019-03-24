<?php

/**
 * `User` model here for `user` table
 */

namespace sp_n1_v3\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserInfo extends Eloquent
{
    protected $table = 'user_info';

    protected $fillable = [
        'first_login',
        'user_id',
        'date_of_birth',
        'first_name',
        'last_name',
        'user_type_id',
        'city',
        'country',
        'address',
        'gsm_number',
        'gsm_number_1',
        'gsm_number_2',
        'stationary_number',
        'stationary_number_1',
        'stationary_number_2',
        'zip',
    ];
}
