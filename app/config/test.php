<?php

return [
    'app' => [
        'url' => 'http://localhost:1234',
        'hash' => [
            'algo' => PASSWORD_BCRYPT,
            'cost' => 10,
        ],
        'upload_dir' => INC_ROOT . '/uploads/',
    ],
    'db' => [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'name' => 'sp_n1_v3',
        'username' => '<place_your_mysql_user_username>',
        'password' => '<place_your_mysql_user_username>',
        'charset' => "utf8mb4",
        'collation' => 'utf8mb4_unicode_ci',
    ],
    'auth' => [
        'session' => 'user_id',
        'remember' => 'user_r',
    ],
    'mail' => [
        'smtp_debug' => 2,
        'smtp_auth' => true,
        'smtp_secure' => 'tls',
        'smtp_auto_tls' => false,
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'username' => '<place_your_username_here_for_gmail>',
        'password' => '<place_your_password_here_for_gmail>',
        'smtp_keep_alive' => true,
        'mailer' => 'smtp',
        'smtp_options_ssl_verify_peer' => false,
        'smtp_options_ssl_verify_peer_name' => false,
        'smtp_options_ssl_allow_self_signed' => true,
    ],
    'twig' => [
        'debug' => true,
    ],
    'csrf' => [
        'key' => 'csrf_token',
    ],
];
