<?php

namespace sp_n1_v3\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserType extends Eloquent
{
    protected $table = 'user_type';

    protected $fillable = [
        'type',
    ];
}
