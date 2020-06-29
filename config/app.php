<?php

require __DIR__ . '/../vendor/autoload.php';

/* Error Handler */
require_once __DIR__ . "/errorHandler.php";


/* Settings */
$settings = require_once __DIR__ . '/settings.php';


/* Container */
$container = require_once __DIR__ . "/container.php";


$app = new \App\App($container);

// /* Functions */
require_once __DIR__ . "/../src/functions.php";

/* Routes */
require_once __DIR__ . "/routes.php";


return $app;
