<?php

// index
require INC_ROOT . '/app/routes/home.php';

// auth routes 
require INC_ROOT . '/app/routes/auth/register.php';
require INC_ROOT . '/app/routes/auth/login.php';
require INC_ROOT . '/app/routes/auth/activate.php';
require INC_ROOT . '/app/routes/auth/logout.php';

require INC_ROOT . '/app/routes/categories.php';
require INC_ROOT . '/app/routes/create_advert.php';

