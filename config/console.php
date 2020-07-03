<?php

/* Settings */
$settings = require __DIR__ . '/settings.php';

/* Container */
$container = require __DIR__ . "/container.php";

$console = new Silly\Application();

$console->useContainer($container);

/* Commands */
require __DIR__ . "/commands.php";

return $console;
