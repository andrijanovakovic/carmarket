<?php

$authentication_check = function ($required) use ($app) {
    return function () use ($required, $app) {
        if ((!$app->auth && $required) || ($app->auth && !$required)) {
            $app->redirect($app->urlFor('home'));
        }
    };
};

$authenticated = function () use ($authentication_check) {
    return $authentication_check(true);
};

$guest = function () use ($authentication_check) {
    return $authentication_check(false);
};
