<?php

namespace sp_n1_v3\Advert;

use Illuminate\Database\Eloquent\Model as Eloquent;

class AdvertComment extends Eloquent
{
    protected $table = 'advert_comment';

    protected $fillable = [
        'advert_id',
        'value',
        'nickname',
        'email',
        'ip_address',
        'ip_country_of_origin',
    ];
}
