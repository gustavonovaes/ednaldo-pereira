<?php

/* Settings */
$settings = require __DIR__ . '/settings.php';

/* Container */
$container = require __DIR__ . "/container.php";

$app = new \App\App($container);

/* Routes */
require __DIR__ . "/routes.php";

return $app;
