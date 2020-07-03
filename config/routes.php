<?php

use App\Controllers\HomeController;
use App\Controllers\SessionController;
use App\Middlewares\ViewCompose;

$app->router()->group('', function ($router) {

  $router->get('/', [SessionController::class, 'showLogin'])->setName('login');
  $router->post('/', [SessionController::class, 'login']);

  $router->get('/home', [HomeController::class, 'showHome'])->setName('home');

})->lazyMiddleware(ViewCompose::class);
