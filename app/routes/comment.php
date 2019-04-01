<?php

// add comment to advert
$app->post('/remove_comment/:advert_id/:comment_id', $authenticated, function ($advert_id, $comment_id) use ($app) {
    // get advert from db based on given id
    $advert = $app->advert->where('id', $advert_id)->first();
    $user_id = $_SESSION[$app->config->get('auth.session')];
    $comment = $app->advert_comment->where('id', $comment_id)->first();

    if (!$advert || $advert->user_id != $user_id || !$comment) {
        $app->flash('global', 'There was an error. Cannot delete comment!');
        $app->response->redirect($app->urlFor('home'));
    } else {
        $comm = $app->advert_comment->where('id', $comment_id)->delete();
        $app->flash('global', 'Comment deleted...');
        $app->response->redirect($app->config->get('app.app_url') . '/ad/' . $advert_id);
    }
})->name('comment.remove');

// add comment to advert
$app->post('/add_comment/:advert_id', function ($advert_id) use ($app) {    
    if (!$advert_id) {
        $app->flash('global', 'No advert...');
        $app->response->redirect($app->urlFor('home'));
    } else {
        $request = $app->request;
    
        // get post content
        $comment_email = $request->post('comment_email');
        $comment_nickname = $request->post('comment_nickname');
        $comment_value = $request->post('comment_value');

        if ($comment_email && $comment_nickname && $comment_value) {
            // check email
            $result = file_get_contents("http://apilayer.net/api/check?access_key=1c4fb7c551e9cdc31b2cf89090d0ba80&email=".$comment_email."&smtp=1&format=1");
            $result_array = json_decode($result, true);
            if ($result_array["format_valid"] && $result_array["smtp_check"]) {
                $app->advert_comment->create([
                    'value' => $comment_value,
                    'email' => $comment_email,
                    'nickname' => $comment_nickname,
                    'advert_id' => $advert_id,
                ]);
                
                $app->flash('global', 'Comment added...');
                $app->response->redirect($app->config->get('app.app_url') . '/ad/' . $advert_id);
            } else {
                $app->flash('global', 'Email-invalid');
                $app->response->redirect($app->config->get('app.app_url') . '/ad/' . $advert_id);
            }
        } else {
            $app->flash('global', 'Please fill in every given field when adding a comment...');
            $app->response->redirect($app->config->get('app.app_url') . '/ad/' . $advert_id);
        }
    }
})->name('comment.add');

$app->get('/comments', function () use ($app) {
    $comments = $app->advert_comment->orderBy('created_at', 'DESC')->get();
    $app->render('comments.php', [
        'comments' => $comments
    ]);
})->name('comments');
