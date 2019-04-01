<?php

// index
require INC_ROOT . '/app/routes/home.php';

// auth routes 
require INC_ROOT . '/app/routes/auth/register.php';
require INC_ROOT . '/app/routes/auth/login.php';
require INC_ROOT . '/app/routes/auth/activate.php';
require INC_ROOT . '/app/routes/auth/logout.php';

require INC_ROOT . '/app/routes/create_advert.php';
require INC_ROOT . '/app/routes/my_adverts.php';
require INC_ROOT . '/app/routes/advert_detail.php';
require INC_ROOT . '/app/routes/comment.php';
require INC_ROOT . '/app/routes/api_routes.php';

