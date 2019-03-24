<?php

/**
 * db config here
 */

use Illuminate\Database\Capsule\Manager as Capsule;

// instantiate db manager as capsule
$capsule = new Capsule;

$capsule->addConnection([
    'driver' => $app->config->get('db.driver'),
    'host' => $app->config->get('db.host'),
    'database' => $app->config->get('db.name'),
    'username' => $app->config->get('db.username'),
    'password' => $app->config->get('db.password'),
    'charset' => $app->config->get('db.charset'),
    'encoding' => $app->config->get('db.collation'),
]);

$capsule->bootEloquent();
