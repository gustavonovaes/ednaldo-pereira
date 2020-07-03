<?php

namespace App\Controllers;

use App\DTO\LoginData;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SessionController extends BaseController
{
  public function showLogin(): ResponseInterface
  {
    return $this->render('login');
  }

  public function login(ServerRequestInterface $request): ResponseInterface
  {
    $loginData = LoginData::fromRequest($request);

    // $this->auth()->login($loginData);

    return $this->redirectTo('home');
  }
}
