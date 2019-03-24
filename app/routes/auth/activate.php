<?php
$app->get('/activate', $guest(), function () use ($app) {
    $request = $app->request;
    
    $email = $request->get('email');
    $identifier = $request->get('identifier');

    $identifier_hashed = $app->hash->hash($identifier);

    $user = $app->user->where('email', $email)
        ->where('active_record', 0)
        ->first();

    if (!$user || !$app->hash->hash_check($user->active_hash, $identifier_hashed)) {
        $app->flash('global', 'There was a problem activating your account');
        $app->response->redirect($app->urlFor('home'));
    } else {
        $user->activate_account();
        $app->flash('global', 'Your account has been successfully activated! You can now log-in!');
        $app->response->redirect($app->urlFor('login'));
    }
})->name('activate');
