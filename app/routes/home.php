<?php

use Carbon\Carbon;

$app->get('/', function () use ($app) {

    // get all non-expired adverts
    $adverts = $app->advert->whereDate('expires', '>=', Carbon::now())->orderBy('created_at')->get();

    // for each advert get corresponding profile image
    $adverts->each(function ($advert) use ($app) {
        $img = $app->advert_image->where('advert_id', $advert->id)->first();
        if ($img) {
            $advert->profile_image = base64_encode($img->image);
        }
    });

    $all_ads_count = $app->advert->get()->count();
    $active_ads_count = $adverts->count();
    $inactive_ads_count = $all_ads_count - $active_ads_count;

    // render home.php with given adverts
    $app->render('home.php', [
        'adverts' => $adverts,
        'all_ads_count' => $all_ads_count,
        'active_ads_count' => $active_ads_count,
        'inactive_ads_count' => $inactive_ads_count,
    ]);
})->name('home');

$app->get('/all_users', function () use ($app) {
    $users = $app->user->where('active_record', 1)->get();

     // for each advert get corresponding profile image
     $users->each(function ($user) use ($app) {
        $user->ads_count = $app->advert->where('user_id', $user->id)->get()->count();
        $user->user_info = $app->user_info->where('user_id', $user->id)->first();
    });

    $app->render('all_users.php', [
        'users' => $users,
    ]);
})->name('all_users');
