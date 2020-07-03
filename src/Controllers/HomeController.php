<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends BaseController
{
  public function showHome(ServerRequestInterface $request, array $args): ResponseInterface
  {
    return $this->render('home');
  }
}
