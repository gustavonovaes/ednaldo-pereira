<?php

namespace App;

use League\Route\Router;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

class App
{
  private ContainerInterface $container;

  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

  public function run(ServerRequestInterface $request): bool
  {
    $this->container->add(ServerRequestInterface::class, $request);

    $response = $this->router()->dispatch($request);
    return $this->sapiEmitter()->emit($response);
  }

  public function router(): Router
  {
    return $this->container->get(Router::class);
  }

  private function sapiEmitter(): SapiEmitter
  {
    return $this->container->get(SapiEmitter::class);
  }
}
