<?php

return [
    'app' => [
        'url' => 'http://localhost:1234',
        'app_url' => 'http://localhost:1234/sp_n1_v3/public',
        'hash' => [
            'algo' => PASSWORD_BCRYPT,
            'cost' => 10,
        ],
        'upload_dir' => INC_ROOT . '/uploads/',
    ],
    'db' => [
        'driver' => 'mysql',
        'host' => '<mysql_host_ip_or_url_here>',
        'name' => 'sp_n1_v3',
        'username' => '<mysql_user_username_here>',
        'password' => '<mysql_user_password_here>',
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
        'username' => '<gmail_account_mail_here>',
        'password' => '<gmail_account_password_here>',
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
