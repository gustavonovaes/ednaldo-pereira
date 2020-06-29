<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;

class HomeController extends BaseController
{
  public function showHome(): ResponseInterface
  {
    return $this->render('home');
  }

  public function showHelloWorld(): ResponseInterface
  {
    $name = $this->request('name') ?: 'Undefined';

    return $this->render('hello', [
      'name' => $name,
    ]);
  }
}
