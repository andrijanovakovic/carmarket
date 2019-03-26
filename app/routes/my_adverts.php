<?php

use Carbon\Carbon;

$app->get('/my_adverts', $authenticated(), function () use ($app) {
    // current logged-in user
    $user_id = $_SESSION[$app->config->get('auth.session')];

    // get all adverts from current signed-in user
    $adverts = $app->advert->where('user_id', $user_id)->orderBy('created_at')->get();

    // for each advert get corresponding profile image
    $adverts->each(function ($advert) use ($app) {
        $img = $app->advert_image->where('advert_id', $advert->id)->first();
        if ($img) {
            $advert->profile_image = base64_encode($img->image);
        }

        // check if ad expired
        if (Carbon::parse($advert->expires)->lt(Carbon::now())) {
            $advert->expired = true;
        }
    });

    $app->render('my_adverts.php', [
        'adverts' => $adverts,
    ]);
})->name('my_adverts');
