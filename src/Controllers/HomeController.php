<?php

namespace App\Controllers;

use App\DTO\HelloData;
use Psr\Http\Message\ResponseInterface;

class HomeController extends BaseController
{
  public function showHome(): ResponseInterface
  {
    return $this->render('home');
  }

  public function showHelloWorld(): ResponseInterface
  {
    $helloData = HelloData::fromRequest($this->request());

    return $this->render('hello', [
      'name' => $helloData->name,
    ]);
  }
}
