<?php

namespace App\Middlewares;

use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ViewCompose implements MiddlewareInterface
{
  private Engine $engine;

  public function __construct(Engine $engine)
  {
    $this->engine = $engine;
  }
  
  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    $this->engine->addData([
      'version' => '0.0.1'
    ]);

    return $handler->handle($request);
  }
}
