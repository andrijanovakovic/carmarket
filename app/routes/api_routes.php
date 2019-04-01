<?php

use Carbon\Carbon;

$app->post('/api/remove_comment/:comment_id', function ($comment_id) use ($app) {
    $comm = $app->advert_comment->where('id', $comment_id)->delete();
    
    $response = $app->response();
    $response['Content-Type'] = 'application/json';

    if ($comm) {
        $response_object = array('success' => true);
    } else {
        $response_object = array('success' => false, "reason" => "Comment with that id does not exist!");
    }

    $response->body(json_encode($response_object));
});

$app->post('/api/add_comment/:advert_id', function ($advert_id) use ($app) {
    $response = $app->response();
    $response['Content-Type'] = 'application/json';

    if (!$advert_id) {
        $response_object = array('success' => false, 'reason' => "No id...");
    } else {
        $request = $app->request;

        // get post content
        $comment_email = $request->post('comment_email');
        $comment_nickname = $request->post('comment_nickname');
        $comment_value = $request->post('comment_value');

        if ($comment_email && $comment_nickname && $comment_value) {

            $advert = $app->advert->where('id', $advert_id)->first();
            if ($advert) {
                // check email
                $result = file_get_contents("http://apilayer.net/api/check?access_key=1c4fb7c551e9cdc31b2cf89090d0ba80&email=".$comment_email."&smtp=1&format=1");
                $result_array = json_decode($result, true);
                if ($result_array["format_valid"] && $result_array["smtp_check"]) {
                    $new_comment = $app->advert_comment->create([
                        'value' => $comment_value,
                        'email' => $comment_email,
                        'nickname' => $comment_nickname,
                        'advert_id' => $advert_id,
                    ]);
                    
                    $response_object = array('success' => true, 'comment' => $new_comment);
                } else {
                    $response_object = array('success' => false, 'reason' => "Invalid email...");
                }
            } else {
                $response_object = array('success' => false, 'reason' => "Advert with that id does not exist!");
            }
        } else {
            $response_object = array('success' => false, 'reason' => "Fill in every field! (comment_email, comment_nickname, comment_value)");
        }
    }
    
    $response->body(json_encode($response_object));
});

$app->post('/api/get_last_n_comments/:number_of_rows', function ($number_of_rows) use ($app) {
    $response = $app->response();
    $response['Content-Type'] = 'application/json';

    if ($number_of_rows && is_numeric($number_of_rows)) {
        $comments = $app->advert_comment->orderBy('created_at', 'DESC')->take($number_of_rows)->get();

        if ($comments) {
            $response_object = array('success' => true, 'comments' => $comments);
        } else {
            $response_object = array('success' => false, "reason" => "Error while fetching comments, check sql query...");
        }
    } else {
        $response_object = array('success' => false, "reason" => "Number of rows undefined or not numeric...");
    }

    $response->body(json_encode($response_object));
});