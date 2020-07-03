<?php

require __DIR__ . '/../config/bootstrap.php';

/** @var \App\App $app */
$app = require __DIR__ . '/../config/app.php';

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
  $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$app->run($request);