<?php

use Carbon\Carbon;

$app->get('/create_advert', $authenticated(), function () use ($app) {
    $app->render('create_advert.php');
})->name('create_advert');

$app->post('/create_advert', $authenticated(), function () use ($app) {
    $request = $app->request;

    // store images here
    $advert_images_blobs = array();
    
    // uploads = selected images
    if (isset($_FILES['uploads'])) {

        // array of allowed formats
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'bmp');

        // actual files
        $selected_files = $_FILES['uploads'];

        // number of selected files to upload
        $selected_files_count = count($selected_files['name']);

        for ($i = 0 ; $i < $selected_files_count ; $i++) {
            // if no error with image
            if ($selected_files['error'][$i] === 0) {

                // explote (split) to get extension
                $file_ext = explode('.', $selected_files['name'][$i]);
                // get extension
                $actual_ext = strtolower(end($file_ext));

                // upload file if extension supported
                if (in_array($actual_ext, $allowed_extensions)) {

                    // create unique id for the file name
                    $name = uniqid('', true).'.'.$actual_ext;

                    // select destionation for the wanted file
                    $file_destination = INC_ROOT.'\\uploads\\'.$name;

                    // get binary data
                    $file_content = file_get_contents($selected_files['tmp_name'][$i]);

                    // push to array of binary images
                    array_push($advert_images_blobs, $file_content);
                }
            }
        }
    } else {
        $app->render('create_advert.php');
    }
    
    // current logged-in user
    $user_id = $_SESSION[$app->config->get('auth.session')];

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

    $car = $app->advert->create([
            'user_id' => $user_id,
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
    
    $images_count = count($advert_images_blobs);
    $images_data = array();
    
    for ($i = 0 ; $i < $images_count ; $i++) {
        array_push($images_data, array('advert_id' => $car->id, 'image' =>$advert_images_blobs[$i]));
    }

    $app->advert_image->insert($images_data);

    $app->flash('global', 'Congratulations! Your car ad has been posted!');
        
    $app->response->redirect($app->urlFor('home'));
})->name('create_advert.post');
