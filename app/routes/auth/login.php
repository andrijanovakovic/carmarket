<?php

use Carbon\Carbon;

$app->get('/login', $guest(), function () use ($app) {
    $app->render('auth/login.php');
})->name('login');

$app->post('/login', $guest(), function () use ($app) {
    $request = $app->request;

    $identifier = $request->post('identifier');
    $password = $request->post('password');
    
    $remember_me = $request->post('remember_me');

    $v = $app->validation;

    $v->validate([
        'identifier' => [$identifier, 'required'],
        'password' => [$password, 'required'],
    ]);

    if ($v->passes()) {
        $user = $app->user
                ->where('username', $identifier)
                ->orWhere('email', $identifier)
                ->where('active_record', 1)
                ->first();
        // if user exists and passwords hashes are same
        if ($user && $app->hash->password_check($password, $user->password)) {
            $_SESSION[$app->config->get('auth.session')] = $user->id;

            if ($remember_me === 'on') {
                $remember_identifier = $app->randomlib->generateString(128);
                $remember_token = $app->randomlib->generateString(128);

                $user->update_remember_credentials(
                    $remember_identifier,
                    $app->hash->hash($remember_token)
                );

                $app->setCookie(
                    $app->config->get('auth.remember'),
                    "{$remember_identifier}___{$remember_token}",
                    Carbon::parse('+1 week')->timestamp,
                );
            }

            // now check if first log in
            $first_login = $app->user_info->where('user_id', $user->id)->first()->first_login;
            if ($first_login == 1) {
                $app->render('auth/first_login.php');
            } else {
                $app->response->redirect($app->urlFor('home'));
            }
        } else {
            $app->flash('global', 'Login unsuccessfull!');
            $app->response->redirect($app->urlFor('login'));
        }
    } else {
        $app->render('auth/login.php', [
            'request' => $request,
        ]);
        $flash_message = "";
        foreach ($v->errors()->all() as &$value) {
            $flash_message .= $value . "\n";
        }
        $app->flash('global', $flash_message);
    }
})->name('login.post');

$app->post('/first_login', $authenticated(), function () use ($app) {
    $request = $app->request;
    
    $first_name = $request->post('first_name');
    $last_name = $request->post('last_name');
    $country = $request->post('country');
    $city = $request->post('city');
    $address = $request->post('address');
    $zip = $request->post('zip');
    $gsm_number = $request->post('gsm_number');
    $gsm_number_1 = $request->post('gsm_number_1');
    $gsm_number_2 = $request->post('gsm_number_2');
    $stationary_number = $request->post('stationary_number');
    $stationary_number_1 = $request->post('stationary_number_1');
    $stationary_number_2 = $request->post('stationary_number_2');

    // current logged-in user
    $user_id = $_SESSION[$app->config->get('auth.session')];

    // insert into user_info
    $user_info = $app->user_info
                     ->where('user_id', $user_id)
                     ->update([
                         'first_name' => $first_name,
                         'last_name' => $last_name,
                         'country' => $country,
                         'city' => $city,
                         'address' => $address,
                         'zip' => $zip,
                         'gsm_number' => $gsm_number,
                         'gsm_number_1' => $gsm_number_1,
                         'gsm_number_2' => $gsm_number_2,
                         'stationary_number' =>$stationary_number,
                         'stationary_number_1' =>$stationary_number_1,
                         'stationary_number_2' =>$stationary_number_2,
                         'first_login' => 0,
                     ]);
    
    $app->response->redirect($app->urlFor('home'));
})->name('first_login.post');
