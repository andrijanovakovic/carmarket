<?php

$app->get("/register", $guest(), function () use ($app) {
    $app->render('auth/register.php');
})->name('register');

$app->post("/register", $guest(), function () use ($app) {// sent data
    $request = $app->request;
    
    $email = $request->post('email');
    $username = $request->post('username');
    $password = $request->post('password');
    $password_confirm = $request->post('password_confirm');
    
    // validate data
    $v = $app->validation;
    $v->validate([
            'email' => [$email, 'required|email|uniqueEmail'],
            'username' => [$username, 'required|alnumDash|max(32)|min(8)|uniqueUsername'],
            'password' => [$password, 'required|min(8)'],
            'password_confirm' => [$password_confirm, 'required|matches(password)'],
        ]);
    
    if ($v->passes()) {
        $identifier = $app->randomlib->generateString(128);

        // insert record into user
        $user = $app->user->create([
                'email' => $email,
                'username' => $username,
                'password' => $app->hash->password($password),
                'active_record' => 0,
                'active_hash' => $app->hash->hash($identifier),
            ]);

        // select row from `user_type` where type = 'regular' => for regular users
        $regular_user = $app->user_type->where('type', 'regular')->first();
        
        // insert record in user_type
        $user_info = $app->user_info->create([
            'user_id' => $user->id,
            'user_type_id' => $regular_user->id,
            'first_login' => 1, // after the first log-in this changes to 0
        ]);

        $app->mail->send('email/auth/registered.php', ['user' => $user, 'identifier' => $identifier], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Thanks for registering.');
        });
    
        $app->flash('global', 'You have been registered! Please check you e-mail for activation link.');
        
        $app->response->redirect($app->urlFor('home'));
    } else {
        $app->render('auth/register.php', [
                'errors' => $v->errors(),
                'request' => $request,
            ]);
    }
})->name("register.post");
