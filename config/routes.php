<?php

use App\Controllers\HomeController;
use App\Middlewares\ViewCompose;

router()->group('', function ($router) {

  $router->get('/', [HomeController::class, 'showHome'])->setName('home');

  $router->get('/hello-world', [HomeController::class, 'showHelloWorld'])->setName('hello-world');

})->lazyMiddleware(ViewCompose::class);
