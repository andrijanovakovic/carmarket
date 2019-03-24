<?php

namespace sp_n1_v3\Advert;

use Illuminate\Database\Eloquent\Model as Eloquent;

class AdvertImage extends Eloquent
{
    protected $table = 'advert_image';

    protected $fillable = [
        'advert_id',
        'image',
    ];
}
