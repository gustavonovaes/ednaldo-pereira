<?php

/** @var \App\App $app */
$app = require_once __DIR__ . '/../config/app.php';

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
  $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$app->run($request);