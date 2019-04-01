<?php

// slim templater dependencies
use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

// provides app config
use Noodlehaus\Config;
use RandomLib\Factory as RandomLib;

// import models
use sp_n1_v3\User\User;
use sp_n1_v3\User\UserInfo;
use sp_n1_v3\User\UserType;
use sp_n1_v3\Advert\Advert;
use sp_n1_v3\Advert\AdvertImage;
use sp_n1_v3\Advert\AdvertComment;
use sp_n1_v3\Helpers\Hash;
use sp_n1_v3\Validation\Validator;
use sp_n1_v3\Middleware\BeforeRequest;
use sp_n1_v3\Middleware\Csrf;
use sp_n1_v3\Mail\Mailer;

use Illuminate\Support;

// config sessions
session_cache_limiter(false); // headers
session_start(); // start session

// display all errors that occur
ini_set('display_errors', 'On');

// get project root and set to INC_ROOT
define('INC_ROOT', dirname(__DIR__));

// include all dependencies installed by composer
require INC_ROOT . '/vendor/autoload.php';

// instantiate our app
$app = new Slim([
    // set app mode based on mode written in INC_ROOT/mode.php
    'mode' => file_get_contents(INC_ROOT . '/mode.php'), // app mode
    'view' => new Twig(), // app template engine
    'templates.path' => INC_ROOT . '/app/views',
]);

// add middleware
$app->add(new BeforeRequest);
$app->add(new Csrf);

// load app config based on app mode
$app->configureMode($app->config('mode'), function () use ($app) {
    $app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
});

// init db
require 'database.php';

// route filtering, protected routes
require 'route_filters.php';

// routing
require 'routes.php';

// initial user state
$app->auth = false;
$app->current_user_info = false;

// set user model into Eloquent container
$app->container->set('user', function () {
    return new User;
});
$app->container->set('user_info', function () {
    return new UserInfo;
});
$app->container->set('user_type', function () {
    return new UserType;
});
$app->container->set('advert', function () {
    return new Advert;
});
$app->container->set('advert_image', function () {
    return new AdvertImage;
});
$app->container->set('advert_comment', function () {
    return new AdvertComment;
});


$app->container->singleton('hash', function () use ($app) {
    return new Hash($app->config);
});

$app->container->singleton('validation', function () use ($app) {
    return new Validator($app->user);
});

$app->container->singleton('mail', function () use ($app) {
    $mailer = new PHPMailer();  // create a new object

    // smtp config
    $mailer->IsSMTP();
    $mailer->SMTPDebug = $app->config->get('mail.smtp_debug');
    $mailer->SMTPAuth = $app->config->get('mail.smtp_auth');
    $mailer->SMTPSecure = $app->config->get('mail.smtp_secure');
    $mailer->SMTPAutoTLS = $app->config->get('mail.smtp_auto_tls');
    $mailer->SMTPKeepAlive = true;
    $mailer->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => $app->config->get('mail.smtp_options_ssl_verify_peer'),
            'verify_peer_name' => $app->config->get('mail.smtp_options_ssl_verify_peer_name'),
            'allow_self_signed' => $app->config->get('mail.smtp_options_ssl_allow_self_signed')
        )
    );

    $mailer->Host = $app->config->get('mail.host');
    $mailer->Port = $app->config->get('mail.port');
    $mailer->Mailer = $app->config->get('mail.mailer');

    $mailer->Username = $app->config->get('mail.username');
    $mailer->Password = $app->config->get('mail.password');

    $mailer->SetFrom($app->config->get('mail.username'), 'CarMarket');
    $mailer->CharSet = 'UTF-8';

    $mailer->isHTML();

    return new Mailer($app->view, $mailer);
});

// random generator
$app->container->singleton('randomlib', function () {
    $factory = new RandomLib;
    return $factory->getMediumStrengthGenerator();
});

// render engine options
$view = $app->view();
$view->parserOptions = [
    'debug' => $app->config->get("twig.debug"),
];
$view->parserExtensions = [
    new TwigExtension, // generate url's within views
    new \Twig\Extension\DebugExtension(),
];
