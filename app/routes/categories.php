<?php

$app->get('/categories', function () use ($app) {
    $app->render('categories.php');
})->name('categories');
