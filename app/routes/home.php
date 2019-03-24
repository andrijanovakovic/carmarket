<?php


$app->get('/', function () use ($app) {
    $adverts = $app->advert->orderBy('created_at')->get();
    $adverts->each(function ($advert) use ($app) {
        $img = $app->advert_image->where('advert_id', $advert->id)->first();
        if ($img) {
            $advert->profile_image = base64_encode($img->image);
        }
    });
    $app->render('home.php', [
        'adverts' => $adverts,
    ]);
})->name('home');
