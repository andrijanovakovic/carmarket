<?php

use Carbon\Carbon;

// detail view advert
$app->get('/ad/:advert_id', function ($advert_id) use ($app) {

    // get advert from db based on given id
    $advert = $app->advert->where('id', $advert_id)->first();

    if (!$advert) {
        $app->notFound();
    } else {
        // get images for the advert
        $images = $app->advert_image->where('advert_id', $advert->id)->get();

        $images->map(function ($image) {
            $image['val'] = base64_encode($image->image);
            return $image;
        });

        $advert->images = $images;

        // increment views for the advert
        $app->advert->find($advert_id)->increment('views', 1);

        $user = $app->user->select('email')->where('id', $advert->user_id)->first();
        $user_info = $app->user_info->where('id', $advert->user_id)->first();

        // render advert_detail.php with advert data
        $app->render('advert_detail.php', [
            'advert' => $advert,
            'owner_email' => $user,
            'owner_info' => $user_info,
        ]);
    }
})->name('advert.detail');


// advert edit get
$app->get('/edit/ad/:advert_id', $authenticated, function ($advert_id) use ($app) {

    // get advert from db based on given id
    $advert = $app->advert->where('id', $advert_id)->first();
    $user_id = $_SESSION[$app->config->get('auth.session')];

    if (!$advert || $advert->user_id != $user_id) {
        $app->notFound();
    } else {
        // get images for the advert
        $images = $app->advert_image->where('advert_id', $advert->id)->get();

        // map over each image and encode to base64 so browser can show
        $images->map(function ($image) {
            $image['val'] = base64_encode($image->image);
            return $image;
        });

        $advert->images = $images;

        // car make year and month format is `2012/06`, here we need to split that
        if ($advert->car_make_year_and_month) {
            $cmyan = explode('/', $advert->car_make_year_and_month);
            $advert->car_make_year = $cmyan[0];
            $advert->car_make_month = $cmyan[1];
        }

        // same for first registration date as above
        if ($advert->car_first_registration_date) {
            $cfrd = explode('/', $advert->car_first_registration_date);
            $advert->car_first_registration_year = $cfrd[0];
            $advert->car_first_registration_month = $cfrd[1];
        }

        // render advert_detail.php with advert data
        $app->render('advert_edit.php', [
            'advert' => $advert,
        ]);
    }
})->name('advert.edit');


// advert edit post
$app->post('/edit/ad/:advert_id', $authenticated, function ($advert_id) use ($app) {

    // get advert from db based on given id
    $advert = $app->advert->where('id', $advert_id)->first();
    $user_id = $_SESSION[$app->config->get('auth.session')];

    if (!$advert || $advert->user_id != $user_id) {
        $app->flash('global', 'The advert you are trying to edit doesn\'t exist or you don\'t have appropriate rights to edit it!');
        $app->response->redirect($app->urlFor('home'));
    } else {

        $request = $app->request;

        $car_manufacturer = $request->post('car_manufacturer');
        $car_model = $request->post('car_model');

        $make_year = strval($request->post('make_year'));
        $make_month = strval($request->post('make_month'));
        $car_make_year_and_month = $make_year.'/'.$make_month;

        $first_reg_year = strval($request->post('first_reg_year'));
        $first_reg_month = strval($request->post('first_reg_month'));
        $car_first_registration_date = $first_reg_year.'/'.$first_reg_month;

        $car_mileage = $request->post('car_mileage');
        $car_price = $request->post('car_price');
        $engine_transmission = $request->post('engine_transmission');
        $engine_power = $request->post('engine_power');
        $engine_displacement = $request->post('engine_displacement');
        $engine_fuel = $request->post('engine_fuel');
        $body_color = $request->post('body_color');
        $body_door_count = $request->post('body_door_count');
        $description = $request->post('description');

        $car = $app->advert->find($advert_id)->update([
                'car_manufacturer' => $car_manufacturer,
                'car_model' => $car_model,
                'car_make_year_and_month' => $car_make_year_and_month,
                'car_first_registration_date' => $car_first_registration_date,
                'car_mileage' => $car_mileage,
                'car_price' => $car_price,
                'engine_transmission' => $engine_transmission,
                'engine_power' => $engine_power,
                'engine_displacement' => $engine_displacement,
                'engine_fuel' => $engine_fuel,
                'body_color' => $body_color,
                'body_door_count' => $body_door_count,
                'description' => $description,
                'expires' => Carbon::now()->addMonth(1),
            ]);
    

        $app->flash('global', 'Advert successfully edited');
        $app->response->redirect($app->config->get('app.app_url') . '/ad/' . $advert_id);
    }
})->name('advert.edit.post');

// delete
$app->post('/ad/:advert_id', $authenticated, function ($advert_id) use ($app) {

    // get advert from db based on given id
    $advert = $app->advert->where('id', $advert_id)->first();
    $user_id = $_SESSION[$app->config->get('auth.session')];

    if (!$advert || $advert->user_id != $user_id) {
        $app->flash('global', 'The advert you are trying to edit doesn\'t exist or you don\'t have appropriate rights to edit it!');
        $app->response->redirect($app->urlFor('home'));
    } else {
        $app->advert->where('id', $advert_id)->delete();
        $app->advert_image->where('advert_id', $advert_id)->delete();

        $app->flash('global', 'Advert successfully deleted.');
        $app->response->redirect($app->urlFor('home'));
    }
})->name('advert_delete');

